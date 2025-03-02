<?php

use core_competency\api;
use core_competency\external\performance_helper;

require(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.php');

require_login();

$deleteid = optional_param('deleteid', 0, PARAM_ALPHANUM);

$context = context_user::instance($USER->id);
$PAGE->set_context($context);

$PAGE->set_pagelayout('standard');
$PAGE->set_url('/lib/editor/tiny/plugins/html_components/custom_components.php');
$PAGE->set_title(fullname($USER));
$PAGE->set_heading($PAGE->title);
$PAGE->navbar->add(get_string('profile','moodle'), new moodle_url('/user/profile.php', array('id' => $USER->id)));
$PAGE->navbar->add('Composants Tiny customs', new moodle_url('lib/editor/tiny/plugins/html_components/custom_components.php'));

echo $OUTPUT->header();

echo html_writer::tag('h2', get_string('custom_components_link', 'tiny_html_components'));

if ($deleteid) {
    try {
        $DB->delete_records('tiny_html_components_custom', array('id' => $deleteid));
    }
    catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

$customs = $DB->get_records('tiny_html_components_custom', array('userid' => $USER->id), 'name ASC');
echo html_writer::link(new moodle_url('/lib/editor/tiny/plugins/html_components/edit_custom_component.php'),
        get_string('custom_components_create', 'tiny_html_components'), array('class' => 'btn btn-outline-info pull-right'));

if ($customs) {
    echo html_writer::start_tag('fieldset', array('style' => 'margin-top: 50px;'));
    echo html_writer::start_tag('table', array('class' => 'table table-condensed'));
    foreach ($customs as $custom) {
        echo html_writer::start_tag('tr');
        echo html_writer::tag('td', $custom->name, array('width' => '60%'));
        echo html_writer::start_tag('td');
        echo html_writer::link(new moodle_url('/lib/editor/tiny/plugins/html_components/edit_custom_component.php',
            array('id' => $custom->id)), get_string('custom_components_edit', 'tiny_html_components'), array('class' => 'btn btn-outline-secondary'));
        echo html_writer::end_tag('td');
        echo html_writer::start_tag('td');
        echo html_writer::link(new moodle_url('/lib/editor/tiny/plugins/html_components/custom_components.php',
            array('deleteid' => $custom->id)), get_string('custom_components_delete', 'tiny_html_components'), array('class' => 'btn btn-outline-secondary'));
        echo html_writer::end_tag('td');
        echo html_writer::end_tag('tr');
    }
    echo html_writer::end_tag('table');
    echo html_writer::end_tag('fieldset');

    echo "</table></fieldset>";
}

echo $OUTPUT->footer();