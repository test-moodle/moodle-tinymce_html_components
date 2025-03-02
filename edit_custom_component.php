<?php

use core_competency\api;
use core_competency\external\performance_helper;

require(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.php');
require_once('custom_component_form.php');

require_login();

$context = context_user::instance($USER->id);

$id = optional_param('id', null, PARAM_ALPHANUM);
$preview = optional_param('preview', 1, PARAM_BOOL);

$PAGE->set_context($context);

$PAGE->set_pagelayout('profile');
if ($id) {
    $PAGE->set_url('/lib/editor/tiny/plugins/html_components/edit_custom_component.php', array('id' => $id));
    $PAGE->set_title(fullname($USER));
    $PAGE->set_heading($PAGE->title);
    $PAGE->navbar->add(get_string('profile', 'moodle'), new moodle_url('/user/profile.php', array('id' => $USER->id)));
    $PAGE->navbar->add(get_string('custom_components_title', 'tiny_html_components'), new moodle_url('lib/editor/tiny/plugins/html_components/custom_components.php'));
    $PAGE->navbar->add(get_string('custom_components_edit', 'tiny_html_components'), new moodle_url('lib/editor/tiny/plugins/html_components/edit_custom_components.php', array('id' => $id)));
} else {
    $PAGE->set_url('/lib/editor/tiny/plugins/html_components/edit_custom_component.php');
    $PAGE->set_title(fullname($USER));
    $PAGE->set_heading($PAGE->title);
    $PAGE->navbar->add(get_string('profile', 'moodle'), new moodle_url('/user/profile.php', array('id' => $USER->id)));
    $PAGE->navbar->add(get_string('custom_components_title', 'tiny_html_components'), new moodle_url('lib/editor/tiny/plugins/html_components/custom_components.php'));
}

echo $OUTPUT->header();

echo html_writer::tag('h2', get_string('custom_components_edit', 'tiny_html_components'));

$component = ($id) ? $DB->get_record('tiny_html_components_custom', array('id' => $id), '*', MUST_EXIST) : null;
$form = new custom_component_form($PAGE->url, array('component' => $component));

if ($form->is_cancelled()) {
    //Annulation du formulaire
    redirect($PAGE->url);
    exit;
} else {
    if ($datas = $form->get_data()) {
        $component = new stdClass();
        $component->userid = $USER->id;
        $component->code = strtolower(str_replace(' ', '_', $datas->name));
        $component->name = $datas->name;
        $component->content = $datas->content['text'];
        if ($id) {
            $component->id = $id;
            $DB->update_record('tiny_html_components_custom', $component);
        } else {
            $id = $DB->insert_record('tiny_html_components_custom', $component);
        }

        if ($id !== false) {
            redirect(new moodle_url('/lib/editor/tiny/plugins/html_components/edit_custom_component.php', array('id' => $id)));
        }
    } else {
        //Affichage du formulaire
        $form->display();
    }
}

echo $OUTPUT->footer();