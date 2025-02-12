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
 * Tiny html_component plugin for moodle.
 * @module      tiny_html_components/plugin
 * @copyright   2023 Gerbault Cédric, Anthony Durif, Université Clermont Auvergne
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// import {getTinyMCE} from 'editor_tiny/loader';
// import {getPluginMetadata} from 'editor_tiny/utils';

// import {component, pluginName} from './common';
// import * as Commands from './commands';
// import * as Configuration from './configuration';
// import * as Options from './options';


// // Setup the tiny_html_components Plugin to add a button and menu option.
// export default new Promise(async(resolve) => {
//     const [
//         tinyMCE,
//         setupCommands,
//         pluginMetadata,
//     ] = await Promise.all([
//         getTinyMCE(),
//         Commands.getSetup(),
//         getPluginMetadata(component, pluginName),
//     ]);
//     // Note: The PluginManager.add function does not accept a Promise.
//     // Any asynchronous code must be run before this point.
//     tinyMCE.PluginManager.add(`${component}/plugin`, (editor) => {
//         Options.register(editor);
//         // Setup the Commands (buttons, menu items, and so on).
//         setupCommands(editor);
//         return pluginMetadata;
//     });
//     // Resolve the htmltiny_html_components Plugin and include configuration.
//     resolve([`${component}/plugin`, Configuration]);
// });


import { getTinyMCE } from "editor_tiny/loader";
import { getPluginMetadata } from "editor_tiny/utils";

import { component, pluginName } from "./common";
import * as Commands from "./commands";
import * as Configuration from "./configuration";
import * as Options from "./options";

// Async function to initialize the plugin.
async function initPlugin() {
  const [tinyMCE, setupCommands, pluginMetadata] = await Promise.all([
    getTinyMCE(),
    Commands.getSetup(),
    getPluginMetadata(component, pluginName),
  ]);

  // PluginManager.add cannot accept a Promise.
  tinyMCE.PluginManager.add(`${component}/plugin`, (editor) => {
    Options.register(editor);
    setupCommands(editor);
    return pluginMetadata;
  });

  return [`${component}/plugin`, Configuration];
}

// Export a Promise without using `async` inside `new Promise()`
export default new Promise((resolve) => {
  initPlugin()
    .then(resolve)
    .catch((err) => {
      console.error("Error initializing plugin:", err);
    });
});