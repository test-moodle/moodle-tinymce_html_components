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
 * Tiny html_component configuration.
 * @module      tiny_html_components/commands
 * @copyright   2023 Gerbault Cédric, Anthony Durif, Université Clermont Auvergne
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// import {getButtonImage} from 'editor_tiny/utils';
// import {handleAction} from './ui';
// import {get_string as getString} from 'core/str';
// import {
//     component,
//     buttonName,
//     icon,
// } from './common';

// export const getSetup = async() => {
//     const [
//         buttonText,
//         buttonImage,
//     ] = await Promise.all([
//         getString('addhtml_components', component),
//         getButtonImage('icon', component),
//     ]);

//     return (editor) => {
//         // Register the Filter WS Icon.
//         editor.ui.registry.addIcon(icon, buttonImage.html);
//         // Register the Menu Button.
//         editor.ui.registry.addButton(buttonName, {
//             icon,
//             tooltip: buttonText,
//             onAction: () => handleAction(editor),
//         });

//         // Add the Filter WS Menu Item.
//         // This allows it to be added to a standard menu, or a context menu.
//         editor.ui.registry.addMenuItem(buttonName, {
//             icon,
//             text: buttonText,
//             onAction: () => handleAction(editor),
//         });
//     };
// };




/* eslint-disable no-console */

define([
    'editor_tiny/utils',
    'core/str',
    'tiny_html_components/ui',
    'tiny_html_components/common'
], function(utils, str, ui, common) {
    'use strict';

    console.log("working: tiny_html_components/commands is loaded");

    const {getButtonImage} = utils;
    const {handleAction} = ui;
    const {get_string: getString} = str;
    const {component, buttonName, icon} = common;

    const getSetup = function() {
        console.log("working: TinyMCE plugin setup started");

        return function(editor) {
            console.log("working: TinyMCE editor instance detected");

            // Load text and image resources asynchronously.
            Promise.all([
                getString('addhtml_components', component),
                getButtonImage('icon', component),
            ]).then(([buttonText, buttonImage]) => {
                // Register the Filter WS Icon.
                editor.ui.registry.addIcon(icon, buttonImage.html);

                // Register the Menu Button.
                editor.ui.registry.addButton(buttonName, {
                    icon,
                    tooltip: buttonText,
                    onAction: () => handleAction(editor),
                });

                // Add the Filter WS Menu Item (for menus and context menus).
                editor.ui.registry.addMenuItem(buttonName, {
                    icon,
                    text: buttonText,
                    onAction: () => handleAction(editor),
                });

                console.log("working: TinyMCE plugin setup complete");
            }).catch(error => {
                console.error("Error in TinyMCE plugin setup:", error);
            });
        };
    };

    // Return the module as an AMD-compatible object.
    return {
        getSetup: getSetup
    };
});
