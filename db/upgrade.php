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
 * Plugin upgrade script.
 *
 * @package  tinymce_html_components
 * @author  2021 Anthony Durif
 * @copyright 2021 Anthony Durif, Université Clermont Auvergne
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_tiny_html_components_upgrade($oldversion) {
    global $CFG, $DB;

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.9.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.10.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2021080100) {
        $dbman = $DB->get_manager();

        $table = new xmldb_table('tinymce_html_components_custom');
        $table->add_field('id', XMLDB_TYPE_INTEGER, 11, null, true, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, 11, null, true, null, null);
        $table->add_field('code', XMLDB_TYPE_TEXT, 255, null, true, null, null);
        $table->add_field('name', XMLDB_TYPE_TEXT, 255, null, true, null, null);
        $table->add_field('content', XMLDB_TYPE_TEXT, null, null, false, null, null);
        $pk = new xmldb_key('primary');
        $pk->set_attributes(XMLDB_KEY_PRIMARY, array('id'), null, null);
        $table->addKey($pk);

        if (!$dbman->table_exists($table->getName())) {
            $dbman->create_table($table);
        }

        // Add savepoint.
        upgrade_plugin_savepoint(true, 2021080100, 'tinymce', 'html_components');
    }

    return true;
}

