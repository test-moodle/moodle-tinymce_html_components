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
// $Id: insert_cloze.php,v 1.4 2013/18/03.

/**
 * Page to create/edit a custom components of tinymce html_components plugin.
 *
 * @package tinymce_html_components
 * @author  2021 Anthony Durif
 * @copyright 2021 Anthony Durif, Université Clermont Auvergne
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_competency\api;
use core_competency\external\performance_helper;

require(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.php');
require_once('custom_component_form.php');

require_login();

$context = context_user::instance($USER->id);

$id = optional_param('id', null, PARAM_ALPHANUM);
$preview = optional_param('preview', 1, PARAM_BOOL);

$PAGE->set_context($context);

$PAGE->set_pagelayout('standard');
if ($id) {
    $PAGE->set_url('/lib/editor/tinymce/plugins/html_components/edit_custom_component.php', array('id' => $id));
    $PAGE->set_title(fullname($USER));
    $PAGE->set_heading($PAGE->title);
    $PAGE->navbar->add(get_string('profile', 'moodle'), new moodle_url('/user/profile.php', array('id' => $USER->id)));
    $PAGE->navbar->add(get_string('custom_components_title', 'tinymce_html_components'), new moodle_url('lib/editor/tinymce/plugins/html_components/custom_components.php'));
    $PAGE->navbar->add(get_string('custom_components_edit', 'tinymce_html_components'), new moodle_url('lib/editor/tinymce/plugins/html_components/edit_custom_components.php', array('id' => $id)));
} else {
    $PAGE->set_url('/lib/editor/tinymce/plugins/html_components/edit_custom_component.php');
    $PAGE->set_title(fullname($USER));
    $PAGE->set_heading($PAGE->title);
    $PAGE->navbar->add(get_string('profile', 'moodle'), new moodle_url('/user/profile.php', array('id' => $USER->id)));
    $PAGE->navbar->add(get_string('custom_components_title', 'tinymce_html_components'), new moodle_url('lib/editor/tinymce/plugins/html_components/custom_components.php'));
}

echo $OUTPUT->header();

echo html_writer::tag('h2', get_string('custom_components_edit', 'tinymce_html_components'));

$component = ($id) ? $DB->get_record('tinymce_components_custom', array('id' => $id), '*', MUST_EXIST) : null;
$form = new custom_component_form($PAGE->url, array('component' => $component));

if ($form->is_cancelled()) {
    // Annulation du formulaire.
    redirect($PAGE->url);
    exit;
} else {
    if ($datas = $form->get_data()) {
        $component = new stdClass();
        $component->user_id = $USER->id;
        $component->code = strtolower(str_replace(' ', '_', $datas->name));
        $component->name = $datas->name;
        $component->content = $datas->content['text'];
        if ($id) {
            $component->id = $id;
            $DB->update_record('tinymce_components_custom', $component);
        } else {
            $id = $DB->insert_record('tinymce_components_custom', $component);
        }

        if ($id !== false) {
            redirect(new moodle_url('/lib/editor/tinymce/plugins/html_components/edit_custom_component.php', array('id' => $id)));
        }
    } else {
        // Affichage du formulaire.
        $form->display();
    }
}

echo $OUTPUT->footer();