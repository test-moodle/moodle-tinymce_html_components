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

namespace tiny_html_components;

use context;
use editor_tiny\plugin;
use editor_tiny\plugin_with_buttons;
use editor_tiny\plugin_with_menuitems;
use editor_tiny\plugin_with_configuration;




/**
 * Tiny html_component plugin for Moodle.
 *
 * @package    tiny_html_components
 * @copyright  2023 Gerbault Cédric, Anthony Durif, Université Clermont Auvergne 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class plugininfo extends plugin implements
    plugin_with_buttons,
    plugin_with_menuitems,
    plugin_with_configuration {
    


    public static function get_available_buttons(): array {
        return [
            'tiny_html_components/html_componentstiny_html_components',
        ];
    }

    public static function get_available_menuitems(): array {
        return [
            'tiny_html_components/html_componentstiny_html_components',
        ];
    }

    public static function get_plugin_configuration_for_context(
        context $context,
        array $options,
        array $fpoptions,
        ?\editor_tiny\editor $editor = null
    ): array {

        $customContent = self :: getAvailableComponents() ;

        return [
            'customcomponents' => $customContent,
        ];
    }

    /**
     * Function to return all the available components as <option>.
     * We check here if the current user has own custom components to list or to use.
     * @return string
     * @throws coding_exception
     */
    public static function getAvailableComponents()
    {
        global $DB;
        global $USER;


        $customs = $DB->get_records('tiny_html_components_custom', array('userid' => $USER->id), 'name ASC');
        
        if ($customs) {
            
            $customComponents = [];
            foreach ($customs as $custom) {
                
                array_push($customComponents,[
                    'value' => 'custom',
                    'custom-component' => $custom->code,
                    'custom-component-content' => htmlspecialchars($custom->content),
                    'name' => $custom -> name,
                ]);
            }
            return json_encode($customComponents);
        }
        else{
            return null;
        }

        
    }
}