<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The main entry file of the plugin.
 *
 * Provide the site-wide setting and specific configuration for each assignment.
 *
 * @package    plagiarism_programming
 * @copyright  2019 Benedikt Schneider (@Nullmann)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace plagiarism_programming\privacy;

defined('MOODLE_INTERNAL') || die();

use \core_privacy\local\metadata\collection;
use \core_privacy\local\request\approved_userlist;
use \core_privacy\local\request\userlist;
// Used for exporting user data.
use \core_privacy\local\request\writer;
use \core_privacy\local\request\helper;

// This plugin stores personal user data.
class provider implements
    \core_privacy\local\metadata\provider,
    \core_privacy\local\request\core_userlist_provider,
    \core_plagiarism\privacy\plagiarism_provider,
    \core_plagiarism\privacy\plagiarism_user_provider
    {
        /**
         * Updates the collection variable so it can be shown in <moodleroot>/admin/tool/dataprivacy/pluginregistry.php
         * @see \core_privacy\local\metadata\provider::get_metadata()
         * @param collection $collection the metadata of all plugins.
         * @return collection Updated collection with this plugins metadata.
         */
    public static function get_metadata(collection $collection) : collection {

        // Describes the files saved by the plugin. Here, it is dataroot/temp/plagiarism_report/<cmid>/<userid>/<source_code>.
        $collection->add_subsystem_link(
            'core_files',
            [],
            'privacy:metadata:plagiarism_programming_files'
            );

        // Describes relevant database entries. Only one table saves user relevent data.
        $collection->add_database_table(
            'plagiarism_programming_reslt',
            [
                'student1_id' => 'privacy:plagiarism_programming_reslt:student1_id',
                'student2_id' => 'privacy:plagiarism_programming_reslt:student2_id',
                'similarity1' => 'privacy:plagiarism_programming_reslt:similarity1',
                'similarity2' => 'privacy:plagiarism_programming_reslt:similarity2',
                'comparison' => 'privacy:plagiarism_programming_reslt:comparison',
                'comments' => 'privacy:plagiarism_programming_reslt:comments',
                'mark' => 'privacy:plagiarism_programming_reslt:mark',

            ],
            'privacy:metadata:plagiarism_programming_reslt'
            );

        // The code is uploaded to moss.stanford.edu
        $collection->add_external_location_link('moss_stanford', [
            'userid' => 'privacy:metadata:moss_stanford:userid',
            'source_code' => 'privacy:metadata:moss_stanford:source_code',
        ], 'privacy:metadata:moss_stanford');

        return $collection;
    }

    /**
     * Get the list of users who have data within a context.
     * @see \core_privacy\local\request\core_userlist_provider::get_users_in_context()
     * @param   userlist    $userlist   The userlist containing the list of users who have data in this context/plugin combination.
     */
    public static function get_users_in_context(userlist $userlist) {
        $context = $userlist->get_context();

        if (!$context instanceof \context_module) {
            return;
        }

        $params = ['instanceid' => $context->instanceid];

        // Use a union instead of 2 separate sql statements to avoid duplicates.
        $sql = "(SELECT result.student1_id AS studid
                FROM {plagiarism_programming_reslt} AS result
                JOIN {plagiarism_programming_rpt} AS report ON result.reportid = report.id
                WHERE report.cmid = :instanceid)
                    UNION
                (SELECT result.student2_id AS studid
                FROM {plagiarism_programming_reslt} AS result
                JOIN {plagiarism_programming_rpt} AS report ON result.reportid = report.id
                WHERE report.cmid = :instanceid)";

        $userlist->add_from_sql('userid', $sql, $params);
    }

    /**
     * Delete multiple users within a single context.
     * This will be called when a user has requested the right to be forgotten when per-role overrides exist,
     * or when performing a per-role expiry of a context.
     * All attempts should be made to delete this data where practical while still allowing the plugin to be used by other users.
     * @see \core_privacy\local\request\core_userlist_provider::delete_data_for_users()
     * @param approved_userlist $userlist The approved context and user information to delete information for.
     */
    public static function delete_data_for_users(approved_userlist $userlist) {
        global $DB;
        foreach($userlist AS $user) {
            $DB->delete_records('plagiarism_programming_reslt', ['student1_id' => $user->id]);
            $DB->delete_records('plagiarism_programming_reslt', ['student2_id' => $user->id]);
        }
    }

    /**
     * Delete all user information for the provided users and context.
     * @see \core_plagiarism\privacy\plagiarism_user_provider::delete_plagiarism_for_users()
     * @param  array    $userids   The users to delete
     * @param  \context $context   The context to refine the deletion.
     */
    public static function delete_plagiarism_for_users(array $userids, \context $context) {
        foreach($userids AS $userid) {
            delete_plagiarism_for_user($userid, $context);
        }
    }

    /**
     * Delete all user information for the provided user and context.
     * @see \core_plagiarism\privacy\plagiarism_provider::delete_plagiarism_for_user()
     * @param  int      $userid    The user to delete
     * @param  \context $context   The context to refine the deletion.
     */
    public static function delete_plagiarism_for_user(int $userid, \context $context) {
        global $DB;

        if (empty($context) || !$context instanceof \context_module) {
            return;
        }

        // Get all reports with this course module id.
        $reports = $DB->get_records('plagiarism_programming_rpt', ['cmid' => $context->instanceid], '', 'id');

        // Delete all result rows in which the user is present.
        foreach ($reports AS $report)  {
            $params = [
                'reportid' => $report->id,
                'userid1' => $userid,
                'userid2' => $userid
            ];
            $DB->delete_records_select('plagiarism_programming_reslt',
                "reportid = :reportid AND (student1_id = :userid1 OR student2_id = :userid2)",
                $params);
        }
    }

    /**
     * Delete all user data information for the provided context, not the instance itself.
     * This will be called when a context expires, defined in the retention periods.
     * @see \core_plagiarism\privacy\plagiarism_provider::delete_plagiarism_for_context()
     * @param  \context $context The context to delete user data for.
     */
    public static function delete_plagiarism_for_context(\context $context) {
        global $DB;

        if (empty($context) || !$context instanceof \context_module) {
            return;
        }

        // As this covers all users and not a single one, everything can be deleted, as we do not need students to compare to.
        $reports = $DB->get_records('plagiarism_programming_rpt', ['cmid' => $context->instanceid], '', 'id');
        foreach ($reports AS $report)  {
            $DB->delete_records('plagiarism_programming_reslt', ['reportid' => $report->id]);
        }

        // Delete the report itself.
        $DB->delete_records('plagiarism_programming_rpt', ['cmid' => $context->instanceid]);
    }

    /**
     * Export all plagiarism data from each plagiarism plugin for the specified userid and context.
     * Exporting user data is explained in https://docs.moodle.org/dev/Privacy_API#Exporting_data
     * @see \core_plagiarism\privacy\plagiarism_provider::export_plagiarism_user_data()
     * @param int $userid The user to export.
     * @param \context $context The context_module_id of the assign instance.
     * @param array $subcontext The attempt number of the assign instance.
     * @param array $linkarray The weird and wonderful link array used to display information for a specific item
     */
    public static function export_plagiarism_user_data(int $userid, \context $context, array $subcontext, array $linkarray) {
        global $CFG, $DB;
        require_once("$CFG->dirroot/user/lib.php");

        if (empty($userid)) {
            return;
        } else {
            $userarray = user_get_users_by_id(array('userid' => $userid));
            $user = $userarray[$userid];
        }

        $params = [
            'userid' => $userid
        ];
        // Get the results in which the user is in the student1_id column.
        $sql = "SELECT result.id, student1_id, similarity1, similarity2, reportid, mark, detector
                FROM {plagiarism_programming_rpt} report
                JOIN {plagiarism_programming_reslt} result ON report.id = result.reportid
                  WHERE result.student1_id = :userid";
        $scans1 = $DB->get_records_sql($sql, $params);

        // Get the results in which the user is in the student2_id column.
        $sql = "SELECT result.id, student2_id, similarity1, similarity2, reportid, mark, detector
                FROM {plagiarism_programming_rpt} report
                JOIN {plagiarism_programming_reslt} result ON report.id = result.reportid
                  WHERE result.student2_id = :userid";
        $scans2 = $DB->get_records_sql($sql, $params);

        // Merge both results into one StdClass for exporting.
        $scans = (object)array_merge($scans1, $scans2);

        $path = array_merge($subcontext, [get_string('privacy:path', 'plagiarism_programming')]);

        // Write to the folder structure <assign name>/<attempt #>/<privacy:path>
        writer::with_context($context)
            ->export_data($path, (object)$scans);

        // Write generic module intro files (area files).
        helper::export_context_files($context, $user);

        // The function export_metadata is not needed. For example it is not saved when the user looked at the similarity results.
    }

}