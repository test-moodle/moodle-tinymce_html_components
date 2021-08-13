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
 * Plugin for Moodle tinymce html_components.
 *
 * @package    tinymce_html_components
 * @author  2020 Anthony Durif
 * @copyright 2020 Anthony Durif, Université Clermont Auvergne
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('NO_MOODLE_COOKIES', true); // Session not used here.
require(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.php');
require_once('lib.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/lib/editor/tinymce/plugins/html_components/dialog.php');
$stringmanager = get_string_manager();
$editor = get_texteditor('tinymce');
$plugin = $editor->get_plugin('html_components');
$htmllang = get_html_lang();
$session = $DB->get_record('sessions', array('sid' => $_COOKIE["MoodleSession"]));
$currentuser = ($session) ? $DB->get_record('user', array('id' => $session->userid)) : null;

header('Content-Type: text/html; charset=utf-8');
header('X-UA-Compatible: IE=edge');
?>

<!DOCTYPE html>
<html <?php echo $htmllang ?>
<head>
    <title><?php print_string('html_components:desc', 'tinymce_html_components'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo new moodle_url('/lib/editor/tinymce/plugins/html_components/styles.css'); ?>">
    <script type="text/javascript" src="<?php echo $editor->get_tinymce_base_url(); ?>/tiny_mce_popup.js"></script>
    <script type="text/javascript" src="<?php echo $plugin->get_tinymce_file_url('js/dialog.js'); ?>"></script>
    <!-- script to generate base64 image for card component -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/geopattern/1.2.3/js/geopattern.min.js"></script>
</head>
<body >
<style>
    body, fieldset {
        font-size: inherit;
        padding: 15px;
    }
</style>
<div>
    <form onsubmit="HtmlComponentsDialog.insert(); return false;" action="#" class="form-horizontal">
        <fieldset>
            <legend><?php print_string('choice_legend', 'tinymce_html_components'); ?></legend>
            <div class="form-group row">
                <label for="component" class="col-sm-3 col-form-label">
                    <?php print_string('component', 'tinymce_html_components'); ?>
                </label>
                <div class="col-sm-9">
                    <select id="component" name="component" class="form-control" onchange="HtmlComponentsDialog.change();">
                        <!-- Components list, alphabetic sort (in french) -->
                        <?php echo tinymce_html_components::get_available_components($currentuser); ?>
                    </select>
                </div>
            </div>

            <!-- Alert -->
            <div id="alert_fields" hidden>
                <div class="form-group row" id="alert_type_form-group">
                    <label for="type" class="col-sm-3 col-form-label">
                        <?php print_string('alert_type', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <select id="alert_type" name="alert_type" class="form-control" onchange="HtmlComponentsDialog.change();">
                            <?php echo tinymce_html_components::get_types_background('alert'); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="alert_close_form-group">
                    <label for="close" class="col-sm-3 col-form-label">
                        <?php print_string('alert_close', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="close" id="close_yes"
                                   value="1" onchange="HtmlComponentsDialog.change();">
                            <label class="form-check-label" for="close_yes"><?php print_string('yes'); ?></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="close" id="close_no"
                                   value="0" onchange="HtmlComponentsDialog.change();" checked>
                            <label class="form-check-label" for="close_no"><?php print_string('no'); ?></label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card -->
            <div id="card_fields" hidden>
                <div class="form-group row" id="card_background_form-group">
                    <label for="type" class="col-sm-3 col-form-label">
                        <?php print_string('card_background', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <select id="card_background" name="card_background" class="form-control"
                                onchange="HtmlComponentsDialog.change();">
                            <?php echo tinymce_html_components::get_types_background('card'); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="card_display_form-group">
                    <label for="close" class="col-sm-3 col-form-label">
                        <?php print_string('card_display', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="card_display" id="card_display_h"
                                   value="horizontal" onchange="HtmlComponentsDialog.change();" checked>
                            <label class="form-check-label" for="card_display_h">
                                <?php print_string('card_display_horizontal', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="card_display" id="card_display_v"
                                   value="vertical" onchange="HtmlComponentsDialog.change();">
                            <label class="form-check-label" for="card_display_v">
                                <?php print_string('card_display_vertical', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="card_orientation_form-group" hidden>
                    <label for="close" class="col-sm-3 col-form-label">
                        <?php print_string('card_orientation', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="card_orientation" id="card_orientation_portrait"
                                   value="portrait" onchange="HtmlComponentsDialog.change();" checked>
                            <label class="form-check-label" for="card_orientation_portrait">
                                <?php print_string('card_orientation_portrait', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="card_orientation" id="card_orientation_landscape"

                                   value="landscape" onchange="HtmlComponentsDialog.change();">
                            <label class="form-check-label" for="card_orientation_landscape">
                                <?php print_string('card_orientation_landscape', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="card_nb_form-group">
                    <label for="card_nb" class="col-sm-3 col-form-label">
                        <?php print_string('card_nb', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <input id="card_nb" name="card_nb" type="number" min="1" value="1" size="30"
                               class="form-control" onchange="HtmlComponentsDialog.change();" />
                    </div>
                </div>
                <div class="form-group row" id="card_disposition_form-group">
                    <label for="card_disposition" class="col-sm-3 col-form-label">
                        <?php print_string('card_disposition', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <select id="card_disposition" name="card_disposition" class="form-control col-3"
                                onchange="HtmlComponentsDialog.change();">
                            <option value="2">
                                2 <?php print_string('card_disposition_line', 'tinymce_html_components'); ?>
                            </option>
                            <option value="3">
                                3 <?php print_string('card_disposition_line', 'tinymce_html_components'); ?>
                            </option>
                            <option value="4">
                                4 <?php print_string('card_disposition_line', 'tinymce_html_components'); ?>
                            </option>
                            <option value="6" data-orientation="only_portrait">
                                6 <?php print_string('card_disposition_line', 'tinymce_html_components'); ?>
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Accordion/Collapse -->
            <div id="collapse_fields" hidden>
                <div class="form-group row" id="collapse_nb_form-group">
                    <label for="collapse_nb" class="col-sm-3 col-form-label">
                        <?php print_string('accordion_nb', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <input id="collapse_nb" name="collapse_nb" type="number" min="1" value="1"
                               size="30" class="form-control" onchange="HtmlComponentsDialog.change();" />
                    </div>
                </div>
                <div class="form-group row" id="collapse_nb_form-group">
                    <span class="col-sm-3"></span>
                    <label class="form-check-label col-sm-9" style="padding-left: 40px;">
                        <input class="form-check-input" type="checkbox" name="collapse_show"
                               onchange="HtmlComponentsDialog.change();">
                        <?php print_string('accordion_show', 'tinymce_html_components'); ?>
                    </label>
                </div>
            </div>

            <!-- Navigation menu -->
            <div class="form-group row" id="nav_nb_form-group" hidden>
                <label for="nav_nb" class="col-sm-3 col-form-label">
                    <?php print_string('nav_nb', 'tinymce_html_components'); ?>
                </label>
                <div class="col-sm-9">
                    <input id="nav_nb" name="nav_nb" type="number" min="1" value="1" size="30"
                           class="form-control" onchange="HtmlComponentsDialog.change();" />
                </div>
            </div>

            <!-- Button -->
            <div id="button_fields" hidden>
                <div class="form-group row" id="button_nb_form-group">
                    <label for="button_nb" class="col-sm-3 col-form-label">
                        <?php print_string('button_nb', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <input id="button_nb" name="button_nb" type="number" min="1" value="1" size="30"
                               class="form-control" onchange="HtmlComponentsDialog.change();" />
                    </div>
                </div>
                <div class="form-group row" id="button_type_form-group">
                    <label for="button_type" class="col-sm-3 col-form-label">
                        <?php print_string('button_type', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <select id="button_type" name="button_type" class="form-control" onchange="HtmlComponentsDialog.change();">
                            <?php echo tinymce_html_components::get_types_background('button'); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="button_style_form-group">
                    <label for="button_style" class="col-sm-3 col-form-label">
                        <?php print_string('button_style', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="button_style" id="button_style_full"
                                   value="full" onchange="HtmlComponentsDialog.change();" checked>
                            <label class="form-check-label" for="button_style_full">
                                <?php print_string('button_style_full', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="button_style" id="button_style_outline"
                                   value="outline" onchange="HtmlComponentsDialog.change();">
                            <label class="form-check-label" for="button_style_outline">
                                <?php print_string('button_style_outline', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="button_size_form-group">
                    <label for="button_size" class="col-sm-3 col-form-label">
                        <?php print_string('button_size', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="button_size" id="button_size_sm"
                                   value="sm" onchange="HtmlComponentsDialog.change();">
                            <label class="form-check-label" for="button_size_sm">
                                <?php print_string('button_size_sm', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="button_size" id="button_size_med"
                                   value="med" onchange="HtmlComponentsDialog.change();" checked>
                            <label class="form-check-label" for="button_size_med">
                                <?php print_string('button_size_med', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="button_size" id="button_size_lg"
                                   value="lg" onchange="HtmlComponentsDialog.change();">
                            <label class="form-check-label" for="button_size_lg">
                                <?php print_string('button_size_lg', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="button_size" id="button_size_block"
                                   value="block" onchange="HtmlComponentsDialog.change();">
                            <label class="form-check-label" for="button_size_block">
                                <?php print_string('button_size_block', 'tinymce_html_components'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="button_tooltip_form-group">
                    <label for="close" class="col-sm-3 col-form-label">
                        <?php print_string('button_tooltip', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="button_tooltip" id="button_tooltip_yes"
                                   value="1" onchange="HtmlComponentsDialog.change();">
                            <label class="form-check-label" for="button_tooltip_yes">
                                <?php print_string('yes'); ?>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="button_tooltip" id="button_tooltip_no"
                                   value="0" onchange="HtmlComponentsDialog.change();" checked>
                            <label class="form-check-label" for="button_tooltip_no">
                                <?php print_string('no'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="button_tooltip_pos_form-group" hidden>
                    <label for="button_type" class="col-sm-3 col-form-label">
                        <?php print_string('button_tooltip_pos', 'tinymce_html_components'); ?>
                    </label>
                    <div class="col-sm-9">
                        <select id="button_tooltip_pos" name="button_tooltip_pos" class="form-control"
                                onchange="HtmlComponentsDialog.change();">
                            <option value="top">
                                <?php print_string('button_tooltip_top', 'tinymce_html_components'); ?>
                            </option>
                            <option value="right">
                                <?php print_string('button_tooltip_right', 'tinymce_html_components'); ?>
                            </option>
                            <option value="bottom">
                                <?php print_string('button_tooltip_bottom', 'tinymce_html_components'); ?>
                            </option>
                            <option value="left">
                                <?php print_string('button_tooltip_left', 'tinymce_html_components'); ?>
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <p style="text-align: right;">
                <a href="<?php $customurl = new moodle_url('/lib/editor/tinymce/plugins/html_components/custom_components.php');
                    echo $customurl->out(); ?>" target="_blank">
                        <?php print_string('custom_components_link', 'tinymce_html_components'); ?>
                </a>
            </p>

        </fieldset>
        <fieldset>
            <legend><?php print_string('preview_legend', 'tinymce_html_components'); ?></legend>
            <p style="margin-bottom: 20px; font-weight: bold;">
                <i><?php print_string('preview_desc', 'tinymce_html_components'); ?></i>
            </p>
            <div id="component_preview"></div>
        </fieldset>
        <div class="mceActionPanel">
            <input type="button" id="insert" name="insert" value="{#insert}" onclick="HtmlComponentsDialog.insert();" />
            <input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" />
        </div>
    </form>
</div>