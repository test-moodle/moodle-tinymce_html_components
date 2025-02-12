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

require_once("$CFG->libdir/formslib.php");


class custom_component_form extends moodleform
{
    protected function definition()
    {
        $mform = $this->_form;
        $component = $this->_customdata['component'];

        $preview = ($component->content) ? $component->content : get_string('custom_components_preview_msg', 'tiny_html_components');

        $mform->addElement('html', html_writer::link(new moodle_url('/lib/editor/tiny/plugins/html_components/custom_components.php'),
            get_string('custom_components_back', 'tiny_html_components'), array('class' => 'pull-right btn btn-secondary')));

        $mform->addElement('header', 'creation', get_string('custom_components_construct', 'tiny_html_components'));
        $name = $mform->addElement('text','name', get_string('custom_components_name', 'tiny_html_components'));
        $mform->addHelpButton('name', 'custom_components_name', 'tiny_html_components');
        $mform->addRule('name', get_string('missingfullname'), 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);

        $mform->setDefault('name', $component->name);
        $editor = $mform->createElement('editor', 'content', get_string('custom_components_content', 'tiny_html_components'), array('rows' => 10), array('maxfiles' => EDITOR_UNLIMITED_FILES,
            'noclean' => true, 'context' => $this->context, 'subdirs' => true));
        if ($component) {
            $editor->setValue(array('text' => $component->content)); // Set the default value.
        }
        $mform->addElement($editor);
        $mform->setType('content', PARAM_RAW);
        $mform->addRule('content', get_string('required'), 'required', null, 'client');
        $mform->addHelpButton('content', 'custom_components_content', 'tiny_html_components');

        $mform->addElement('header', 'preview', get_string('preview'));
        $mform->addElement('html', $preview);

        $this->add_action_buttons(get_string('cancel'), get_string('save'));
    }

    public function validation($data, $files)
    {
    }
}