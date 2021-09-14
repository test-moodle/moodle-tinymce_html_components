<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin upgrade script.
 *
 * @package  tinymce_html_components
 * @author  2021 Anthony Durif
 * @copyright 2021 Anthony Durif, Université Clermont Auvergne
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Custom uninstallation procedure.
 */
function xmldb_tinymce_html_components_uninstall() {
    global $DB;

    $dbman = $DB->get_manager();
    $table = new xmldb_table('tinymce_components_custom');
    if ($dbman->table_exists($table->getName())) {
        $dbman->drop_table($table);
    }

    return true;
}
