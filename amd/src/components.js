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
 * Tiny html_component Components list.
 * @module      tiny_html_components/components
 * @copyright   2023 Gerbault Cédric, Anthony Durif, Université Clermont Auvergne
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

const components = [
    {
        id : 0,
        name: "accordion",
        params :true,
        code: function () {
            var nb_collapse = document.getElementById('collapse_nb').value;
            var collapse_class = (!document.querySelector('input[name="collapse_show"]').checked) ? "collapse show" : "collapse";
            var uniq ='_' + Math.random().toString(36).substring(2, 9);
            var txt ="<div class='accordion' id='accordion"+ uniq +"'>";
            for (var i = 1; i <= nb_collapse; i++){
                txt +=
                  "<div class='card'>" +
                  "    <div class='card-header' id='heading" +
                  uniq +
                  "_" +
                  i +
                  "'>" +
                  "      <h3 class='mb-0'>" +
                  "        <button class='btn btn-link btn-block" +
                  " text-left collapsed' type='button' data-toggle='collapse' data-target='#collapse" +
                  uniq +
                  "_" +
                  i +
                  "' aria-expanded='false' aria-controls='collapse" +
                  uniq +
                  "_" +
                  i +
                  "'>" +
                  "          Collapsible Group Item #" +
                  i +
                  "" +
                  "        </button>" +
                  "      </h3>" +
                  "    </div>" +
                  "    <div id='collapse" +
                  uniq +
                  "_" +
                  i +
                  "' class='" +
                  collapse_class +
                  "' aria-labelledby='heading" +
                  uniq +
                  "_" +
                  i +
                  "' data-parent='#accordion" +
                  uniq +
                  "'>" +
                  "      <div class='card-body'>" +
                  "        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor" +
                  " incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud" +
                  " exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure" +
                  " dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. " +
                  "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit " +
                  "anim id est laborum." +
                  "      </div>" +
                  "    </div>" +
                  "  </div>";
            }
            txt += "</div>";
            return txt;
        },

    },
    {
        id:1,
        name: "alert",
        params : true,
        code: function() {
            var close = (document.querySelector('input[name="close"]:checked').value == "1")?
            "<button type='button' class='close m-auto' data-dismiss='alert'"+
            " aria-label='Close'><span aria-hidden='true'>&times;</span></button>" : "";
            return "<div class='alert alert-" + document.getElementById('alert_type').value +
             "'>" + close + "Alert contents!</div>";
       },
    },
    {
        id: 2,
        name: "button",
        params : true,
        code: function () {
            var nb_btns = document.getElementById('button_nb').value;
            var type = document.getElementById('button_type').value;
            var dropdown = document.querySelector('input[name="button_dropdown"]').checked;
            var style = document.querySelector('input[name="button_style"]:checked').value;
            var size = document.querySelector('input[name="button_size"]:checked').value;
            var btn_class = ((style == "full") ? "btn-" + type : "btn-" +
            style + "-" + type) + " " + ((size == "med") ? "" : "btn-" + size);
            var btn_style = (style == "full") ? "style='color:white; margin-right:3px;'" : "style='margin-right:3px;'";
            var tooltip = (document.querySelector('input[name="button_tooltip"]:checked').value == "1");
            if (dropdown == false) {
                var btn_html = "<a href='#' role='button' class='btn " + btn_class + "'" + btn_style +
                    ((tooltip) ? "data-toggle='tooltip' data-placement='" + document.getElementById('button_tooltip_pos').value +
                    "' title='Tooltip on the button'" : "") + ">Button</a>";
            } else {
                var class_block = (size == "block") ? " btn-block" : "";
                var btn_html = "<div class='dropdown custom_html_dropdown" +  class_block +
                "'><a class='dropdown-toggle btn " + btn_class + "'" + btn_style +
                    ((tooltip) ? "data-toggle='tooltip' data-placement='" + document.getElementById('button_tooltip_pos').value +
                    "' title='Tooltip on the button'" : "") +
                    " data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Dropdown Button</a>" +
                    "<div class='dropdown-menu'>";
                var nb_items = document.getElementById('button_dropdown_nb').value;
                if (nb_items >= 0) {
                    for (var i = 1; i <= nb_items; i++) {
                        btn_html += "<a class='dropdown-item' href='#'>Sub Item #" + i +"</a>";
                    }
                }
                btn_html += "</div></div>";
            }
            var txt = "";
            if (nb_btns >= 0) {
                for (var i = 1; i <= nb_btns; i++) {
                    txt += btn_html;
                }
            }
            txt = (dropdown === null) ? txt : ((size == "block") ? "<div style='display: grid;'>" + txt + "</div>" :
            "<div style='display: flex; flex-wrap: wrap;'>" + txt + "</div>");
            return txt;
        },
    },
    {
        id: 3,
        params: false,
        name: "jumbotron",
        code: function() {return "<div class='jumbotron' style='background-color: #e9ecef;'><h1>Hello, world!</h1>" +
        "<p class='lead'>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to"+
        " featured content or information.</p>" +
        "<hr/><p>It uses utility classes for typography and spacing to space content out within the larger container.</p>" +
        "<a class='btn btn-primary btn-lg' href='#' role='button'>Learn more</a>" +
    "</div>";},
    },
    {
        id:4,
        name: "nav",
        params : true,
        code: function () {
            var nb_links = document.getElementById('nav_nb').value;
            var txt = "<ul class='nav nav-pills' style='list-style: none;'><li class='nav-item'>" +
                "<a href='#' class='nav-link active' style='border: 1px solid white;'>Tabs #1</a></li>";
            if (nb_links > 1) {
                for (var i = 2; i <= nb_links; i++) {
                    txt += "<li class='nav-item'><a href='#' class='nav-link active' style='border: 1px solid white;'>Tabs #" +
                    i + "</a></li>";
                }
            }
            txt += "</ul><hr/>";
            return txt;
        },
    },
    {
        id:5,
        params:true,
        name: "card",
        code: function () {
            var nb_cards = document.getElementById('card_nb').value;
            var card_background = document.getElementById('card_background').value;
            var card_display = document.querySelector('input[name="card_display"]:checked').value;
            var card_orientation = (card_background != "image") ? "portrait" :
            document.querySelector('input[name="card_orientation"]:checked').value;
            var card_disposition = document.getElementById('card_disposition').value;
            var div_class = "col-xl-" + Math.round(12/card_disposition) + " col-lg-" +
                 Math.round(12/card_disposition) + " col-sm-"+Math.round(12/card_disposition)+" col-xs-" +Math.round(12/card_disposition);
            var card_class = (card_background == "image" || card_background == "classic") ? "" :
            "text-white bg-" + card_background;
            var btn_class = (card_background == "image" || card_background == "secondary" || card_background == "classic")
            ? "primary" : "light";
            var background = (card_background == "image") ? "<img src='/lib/editor/tiny/plugins/html_components/pix/card-placeholder.png'"+
            " class='card-img-top img-fluid' alt=''>" : "<div class='card-header'>CARD HEADER</div>" ;
            if (card_orientation == "portrait") {
                var card_html = "<div class='" + div_class +"' style='margin-bottom: 20px;'>";
                card_html += "<div class='card shadow-lg h-100 " + card_class + "'>" + background +
                        "<div class='card-body'>" +
                            "<h5 class='card-title'>Card title</h5>" +
                            "<p class='card-text'>Some quick example text to build on"+
                            "the card title and make up the bulk of the card's content.</p>" +
                        "</div>" +
                        "<div class='card-footer' style='background-color: inherit; border-top: none;'><a href='#' class='btn btn-"+
                        btn_class + "'>Go somewhere</a></div>" +
                "</div>";
                card_html += "</div>";
            }
            var txt = "<div class='text-center'><div class='col-12 justify-content-center " +
             ((card_display == "vertical") ? "" :"card-deck") +"'"
             +((card_display == "vertical") ? "style='display: grid; justify-items:center;'" : "") + ">";
            for (var i = 1; i <= nb_cards; i++) {
                txt += card_html;
            }
            txt += "</div></div>";
            return txt;
        },
    },
];
export default {
    components,
};
