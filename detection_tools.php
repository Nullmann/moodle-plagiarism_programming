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
 * Define the various entry call of different detection engines in the system
 *
 * @package    plagiarism_programming
 * @copyright  2015 thanhtri, 2019 Benedikt Schneider (@Nullmann)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die('Direct access to this script is forbidden.');

global $detectiontools;
/*
$detectiontools['jplag'] = array (
    'name' => 'JPlag',
    'code_file' => 'jplag_tool.php',
    'class_name' => 'jplag_tool',
    'submit_handler' => 'jplag_submit',
    'check_handler' => 'jplag_check_result',
    'display_report_handle' => 'jplag_display_report_link'
);
*/
$detectiontools['moss'] = array (
    'name' => 'MOSS',
    'code_file' => 'moss_tool.php',
    'class_name' => 'moss_tool',
    'submit_handler' => 'moss_submit',
    'check_handler' => 'moss_check_result',
    'display_report_handle' => 'moss_display_report_link'
);
