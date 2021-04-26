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

defined('MOODLE_INTERNAL') || die();

/**
 * Plugin for Moodle tinymce html_components.
 *
 * @package    tinymce_html_components
 * @author  2020 Anthony Durif
 * @copyright 2020 Anthony Durif, Université Clermont Auvergne
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tinymce_html_components extends editor_tinymce_plugin {
    /** @var array list of buttons defined by this plugin */
    protected $buttons = array('html_components');

    protected function update_init_params(array &$params, context $context, array $options = null) {

        // Add button after 'table' in advancedbuttons2.
        $this->add_button_after($params, 3, ',html_components', 'table');

        // Add JS file, which uses default name.
        $this->add_js_plugin($params);
    }

    /**
     * Function to return the possible <option> for a background.
     * @param $component the component name.
     * @return string the html code to insert.
     */
    public static function get_types_background($component) {
        $str = "";
        if (!in_array($component, array("card", "alert", "button"))) {
            return $str;
        }

        if ($component == "card") {
            $str .= '<option value="image">' . get_string('card_image', 'tinymce_html_components') . '</option>';
            $str .= '<option value="classic">' . get_string('card_classic', 'tinymce_html_components') . '</option>';
        }
        $str .= '<option value="info">' . get_string('alert_info', 'tinymce_html_components') . '</option>
                <option value="warning">' . get_string('alert_warning', 'tinymce_html_components') . '</option>
                <option value="success">' . get_string('alert_success', 'tinymce_html_components') . '</option>
                <option value="danger">' . get_string('alert_danger', 'tinymce_html_components') . '</option>
                <option value="primary">' . get_string('alert_primary', 'tinymce_html_components') . '</option>
                <option value="secondary">' . get_string('alert_secondary', 'tinymce_html_components') . '</option>
                <option value="dark">' . get_string('alert_dark', 'tinymce_html_components') . '</option>';

        return $str;
    }
}