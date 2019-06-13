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
 * Responds to ajax call related to the plagiarism report.
 *
 * @package    plagiarism_programming
 * @copyright  2015 thanhtri, 2019 Benedikt Schneider (@Nullmann)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define('AJAX_SCRIPT', true);

require_once(__DIR__.'/../../config.php');
require_login();
require_once(__DIR__.'/reportlib.php');
global $DB;

$resultid = required_param('id', PARAM_INT);
$task = required_param('task', PARAM_TEXT);
$resultrecord = $DB->get_record('plagiarism_programming_reslt', array('id' => $resultid));
$reportrecord = $DB->get_record('plagiarism_programming_rpt', array('id' => $resultrecord->reportid));
$context = context_module::instance($reportrecord->cmid);

// Only teachers can mark a pair in the comparison view.
require_capability('mod/assignment:grade', $context);

if ($task == 'mark') {
    $action = required_param('action', PARAM_ALPHA);
    assert($action == 'Y' || $action == 'N' || $action == '');
    $resultrecord->mark = $action;
    $DB->update_record('plagiarism_programming_reslt', $resultrecord);
    echo 'OK';
} else if ($task == 'get_history') {
    $ratetype = optional_param('rate_type', 'avg', PARAM_TEXT);
    $similarityhistory = plagiarism_programming_get_student_similarity_history($resultrecord, 'asc');
    $history = array();
    setlocale(LC_TIME, current_language()); // For date output in time_text.
    if ($ratetype == 'avg') {
        $i = 0;
        foreach ($similarityhistory as $pair) {
            $history[$pair->id] = array(
                'time' => $pair->time_created,
                'similarity' => floor(($pair->similarity1 + $pair->similarity2) / 2),
                'time_text' =>strftime('%d %b', $pair->time_created)
            );
            $i++;
            if ($i == 6) {
                break;
            }
        }
    } else {
        // Else the ratetype is max.
        $i = 0;
        foreach ($similarityhistory as $pair) {
            $history[$pair->id] = array(
                'time' => $pair->time_created,
                'similarity' => floor(max($pair->similarity1, $pair->similarity2)),
                'time_text' =>strftime('%d %b', $pair->time_created)
            );
            $i++;
            if ($i == 6) {
                break;
            }
        }
    }
    echo json_encode($history);
}