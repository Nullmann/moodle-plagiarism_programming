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
 * Build the form used for site-wide configuration
 *
 * This form is assessible by Site Administration -> Plugins -> Plagiarism Prevention -> Programming Assignment
 *
 * @package    plagiarism_programming
 * @copyright  2015 thanhtri, 2019 Benedikt Schneider (@Nullmann)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die('Direct access to this script is forbidden.');

require_once($CFG->dirroot . '/lib/formslib.php');

/**
 * Wrapper class for this form
 * @package    plagiarism_programming
 * @copyright  2015 thanhtri, 2019 Benedikt Schneider (@Nullmann)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plagiarism_setup_form extends moodleform {

    /**
     * Form definition. Inherited.
     * {@inheritDoc}
     * @see moodleform::definition()
     */
    protected function definition() {
        $mform = &$this->_form;

        $mform->addElement('header', 'explanation', get_string('programmingexplain', 'plagiarism_programming'));
        // If the plugin is used.
        $mform->addElement('checkbox', 'programming_use', get_string('use_programming', 'plagiarism_programming'));

        /* Course selection is crappy javascript and superseeded by moodle capabilites.

        // Enable the plugin at the course level or for whole moodle.
        $enablelevel = array();
        $enablelevel[] = $mform->createElement('radio', 'level_enabled', '', get_string('enable_global', 'plagiarism_programming'),
            'global', array('class' => 'plagiarism_programming_enable_level'
        ));
        $enablelevel[] = $mform->createElement('radio', 'level_enabled', '', get_string('enable_course', 'plagiarism_programming'),
            'course', array('class' => 'plagiarism_programming_enable_level'
        ));
        $mform->addGroup($enablelevel, 'level_enabled', '   ', array(
            '  '
        ), false);
        $mform->setDefault('level_enabled', 'global');

        $mform->addElement('html', html_writer::tag('div', get_string('account_instruction', 'plagiarism_programming')));
        */

        /* Jplag is currently not supported!

         $mform->addElement('header', 'jplag_config', get_string('jplag', 'plagiarism_programming'));
         $jplag_link = html_writer::link('https://www.ipd.uni-karlsruhe.de/jplag/', ' https://www.ipd.uni-karlsruhe.de/jplag/');
         $mform->addElement('html', html_writer::tag('div',
         get_string('jplag_account_instruction', 'plagiarism_programming'). $jplag_link));
         $mform->addElement('text', 'jplag_user', get_string('jplag_username', 'plagiarism_programming'));
         $mform->setType('jplag_user', PARAM_TEXT);
         $mform->addElement('password', 'jplag_pass', get_string('jplag_password', 'plagiarism_programming'));
         $mform->setType('jplag_pass', PARAM_TEXT);
         */

        $mform->addElement('header', 'moss_config', get_string('moss', 'plagiarism_programming'));
        $mosslink = html_writer::link('http://theory.stanford.edu/~aiken/moss/', ' http://theory.stanford.edu/~aiken/moss/');
        $mform->addElement('html', html_writer::tag('div', get_string('moss_account_instruction', 'plagiarism_programming') . $mosslink));

        $mform->addElement('html', html_writer::tag('div', get_string('moss_id_help', 'plagiarism_programming')));
        $mform->addElement('text', 'programming_moss_user_id', get_string('moss_id', 'plagiarism_programming'));
        $mform->setType('programming_moss_user_id', PARAM_TEXT);

        $mform->addElement('html', html_writer::tag('div', get_string('moss_id_help_2', 'plagiarism_programming')));
        $mform->addElement('textarea', 'programming_moss_email', '', 'wrap="virtual" rows="20" cols="80"');

        // $mform->addElement('header', 'proxy_config', get_string('proxy_config', 'plagiarism_programming'));
        // $mform->addElement('text', 'proxy_host', get_string('proxy_host', 'plagiarism_programming'));
        // $mform->addElement('text', 'proxy_port', get_string('proxy_port', 'plagiarism_programming'));
        // $mform->addElement('text', 'proxy_user', get_string('proxy_user', 'plagiarism_programming'));
        // $mform->addElement('text', 'proxy_pass', get_string('proxy_pass', 'plagiarism_programming'));

        $this->add_action_buttons(true);
    }


    /**
     * For extra validation.
     *
     * @param array $data array of ("fieldname"=>value) of submitted data
     * @param array $files array of uploaded files "element_name"=>tmp_file_path
     * @return array of "element_name"=>"error_description" if there are errors,
     *         or an empty array if everything is OK (true allowed for backwards compatibility too).
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        /*
         * Comment out jplag stuff!
         *
         * global $CFG;
         * $empty_user = empty($data['jplag_user']);
         * $empty_pass = empty($data['jplag_pass']);
         * if (!$empty_user && $empty_pass) { //missing username
         * $errors['jplag_pass'] = get_string('password_missing', 'plagiarism_programming');
         * } else if (!$empty_pass && $empty_user) { // missing password
         * $errors['jplag_user'] = get_string('username_missing', 'plagiarism_programming');
         * } else if (!$empty_user && !$empty_pass) { // check if the user changed his username and password
         * $proxyhost = isset($CFG->proxyhost)?$CFG->proxyhost:'';
         * $proxyport = isset($CFG->proxyport)?$CFG->proxyport:'';
         * $proxyuser = isset($CFG->proxyuser)?$CFG->proxyuser:'';
         * $proxypass = isset($CFG->proxypassword)?$CFG->proxypassword:'';
         * $pass = $data['jplag_pass'];
         * $user = $data['jplag_user'];
         * $old_setting = get_config('plagiarism_programming');
         * if (!(isset($old_setting->jplag_user) && isset($old_setting->jplag_pass)) ||
         * $user != $old_setting->jplag_user || $pass!=$old_setting->jplag_pass) {
         * // change credential, recheck username and password
         * include_once(__DIR__.'/jplag/jplag_stub.php');
         * $jplag_stub = new jplag_stub($data['jplag_user'], $data['jplag_pass'],
         * $proxyhost, $proxyport, $proxyuser, $proxypass);
         * $check_result = $jplag_stub->check_credential();
         * if ($check_result !==true) {
         * $errors['jplag_user'] = $check_result['message'];
         * }
         * }
         * }
         */

        if (! empty($data['moss_email'])) {
            // Search for user id in the perl script.
            $pattern = '/\$userid=([0-9]+);/';
            $match = array();
            preg_match($pattern, $data['moss_email'], $match);
            if (! $match) {
                $errors['moss_email'] = get_string('moss_userid_notfound', 'plagiarism_programming');
            }
        }

        return $errors;
    }
}