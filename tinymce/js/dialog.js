/** var corresponding to an alert component */
var HtmlComponentsAlert = {
    insert : function() {
        var close = (document.querySelector('input[name="close"]:checked').value == "1") ? "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" : "";
        return "<div class='alert alert-" + document.getElementById('alert_type').value + "'>" + close + "A simple alert—check it out!</div>";
    },

    preview : function() {
        return this.insert();
    },

    display : function () {
        document.getElementById('alert_fields').hidden = false;
        document.getElementById('card_fields').hidden = true;
        document.getElementById('collapse_fields').hidden = true;
        document.getElementById('button_fields').hidden = true;
        document.getElementById('button_tooltip_pos_form-group').hidden = (document.querySelector('input[name="button_tooltip"]:checked').value == "0");
    },
};

/** var corresponding to a card component */
var HtmlComponentsCard = {
    insert : function () {
        var nb_cards = document.getElementById('card_nb').value;
        var card_background = document.getElementById('card_background').value;
        var card_display = document.querySelector('input[name="card_display"]:checked').value;
        var card_orientation = (card_background != "image") ? "portrait" : document.querySelector('input[name="card_orientation"]:checked').value;
        var card_disposition = document.getElementById('card_disposition').value;
        var div_class = (nb_cards <= 1) ? "col-3" : "col-" + Math.round(12/card_disposition);
        var card_class = (card_background == "image" || card_background == "classic") ? "" : "text-white bg-" + card_background;
        var btn_class = (card_background == "image" || card_background == "secondary" || card_background == "classic") ? "primary" : "light";
        var img_pattern = GeoPattern.generate(Math.random().toString(16).substr(2, 10));
        var background = (card_background == "image") ? "<img src='" + img_pattern.toDataUri() + "' class='card-img-top img-fluid' alt='' style='max-height: 220px;'>" : "<div class='card-header'>CARD HEADER</div>" ;

        if (card_orientation == "portrait") {
            var card_html = (card_display == "horizontal") ? "<div class='" + div_class +"' style='margin-bottom: 20px;'>" : "";
            var card_style = (card_display == "vertical") ? "style='width: 20rem;'" : "";
            card_html += "<div class='card shadow-lg h-100 " + card_class + "' " + card_style + ">" + background +
                    "<div class='card-body'>" +
                        "<h5 class='card-title'>Card title</h5>" +
                        "<p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>" +
                        "<a href='#' class='btn btn-" + btn_class + "'>Go somewhere</a>" +
                    "</div>" +
            "</div>";
            card_html += (card_display == "horizontal") ? "</div>" : "<br/>";
        } else {
            var div_class = (nb_cards <= 1) ? "col-4" : "col-" + Math.round(12/card_disposition);
            var card_html = "<div class='" + div_class + "' style='padding-left: initial; margin-bottom: 20px;'>";
            card_html += "<div class='card shadow-lg h-100'><div class='row no-gutters'>" +
                    "<div class='col-4'><img src='" + img_pattern.toDataUri() + "' class='card-img img-fluid' /></div>" +
                    "<div class='col-8'>" +
                        "<div class='card-body'>" +
                        "<h5 class='card-title'>Card title</h5>" +
                        "<p class='card-text'>Some quick example text to build on the card title. This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>" +
                        "<a href='#' class='btn btn-" + btn_class + "'>Go somewhere</a>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
                "</div>" +
            "</div>";
        }

        var txt = "<div class='text-center'><div class='col-12 justify-content-center " + ((card_display == "vertical") ? "" : "card-deck") +"'>";
        for (var i = 1; i <= nb_cards; i++) {
            txt += card_html;
        }
        txt += "</div></div>";

        return txt;
    },

    preview : function() {
        return this.insert();
    },

    display : function () {
        document.getElementById('alert_fields').hidden = true;
        document.getElementById('card_nb_form-group').hidden = false;
        document.getElementById('card_fields').hidden = false;
        document.getElementById('card_background_form-group').hidden = false;
        document.getElementById('card_display_form-group').hidden = false;
        document.getElementById('card_orientation_form-group').hidden = (document.getElementById('card_background').value != "image");
        if (document.querySelector('input[name="card_display"]:checked').value != "horizontal") {
            document.getElementById('card_disposition_form-group').hidden = true;
        } else {
            document.getElementById('card_disposition_form-group').hidden = (document.getElementById('nb_cards').value == 1);
        }
        document.getElementById('collapse_fields').hidden = true;
        document.getElementById('nav_nb_form-group').hidden = true;
        document.getElementById('button_fields').hidden = true;
        document.getElementById('button_tooltip_pos_form-group').hidden = (document.querySelector('input[name="button_tooltip"]:checked').value == "0");
    },

    change : function () {
        var card_orientation = document.querySelector('input[name="card_orientation"]:checked').value;
        document.querySelectorAll('option[data-orientation="only_portrait"]').forEach((selector) => {
            selector.hidden = (card_orientation == "landscape");
        });
        if (document.getElementById('card_disposition').options[document.getElementById('card_disposition').selectedIndex].hidden) {
            // Selected value is not coherent with possible choices.
            document.getElementById('card_disposition').selectedIndex = 0;
        }
    }
}

/** var corresponding to a jumbotron component */
var HtmlComponentsJumbotron = {
    insert : function () {
        return "<div class='jumbotron'><h1>Hello, world!</h1>" +
                "<p class='lead'>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>" +
                "<hr/><p>It uses utility classes for typography and spacing to space content out within the larger container.</p>" +
                "<a class='btn btn-primary btn-lg' href='#' role='button'>Learn more</a>" +
            "</div>";
    },

    preview : function() {
        return "<div class='jumbotron' style='background-color: #e9ecef;'><h1>Hello, world!</h1>" +
                "<p class='lead'>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>" +
                "<hr/><p>It uses utility classes for typography and spacing to space content out within the larger container.</p>" +
                "<a class='btn btn-primary btn-lg' href='#' role='button'>Learn more</a>" +
            "</div>";
    },

    display : function () {
        document.getElementById('alert_fields').hidden = true;
        document.getElementById('card_fields').hidden = true;
        document.getElementById('collapse_fields').hidden = true;
        document.getElementById('nav_nb_form-group').hidden = true;
        document.getElementById('button_fields').hidden = true;
        document.getElementById('button_tooltip_pos_form-group').hidden = (document.querySelector('input[name="button_tooltip"]:checked').value == "0");
    },
}

/** var corresponding to an accordion component */
var HtmlComponentsAccordion = {
    insert : function () {
        var nb_collapse = document.getElementById('collapse_nb').value;
        var collapse_class = (document.querySelector('input[name="collapse_show"]:checked') == null) ? "collapse show" : "collapse";
        var txt = "<div class='accordion' id='accordionExample'>";

        for (var i = 1; i <= nb_collapse; i++) {
            txt += "<div class='card'>" +
                "    <div class='card-header' id='heading" + i + "'>" +
                "      <h3 class='mb-0'>" +
                "        <button class='btn btn-link btn-block text-left collapsed' type='button' data-toggle='collapse' data-target='#collapse" + i + "' aria-expanded='false' aria-controls='collapse" + i + "'>" +
                "          Collapsible Group Item #" + i + "" +
                "        </button>" +
                "      </h3>" +
                "    </div>" +
                "    <div id='collapse" + i + "' class='" + collapse_class + "' aria-labelledby='heading" + i + "' data-parent='#accordionExample'>" +
                "      <div class='card-body'>" +
                "        Content Collapse #" + i + "<br/>" +
                "       Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et." +
                "      </div>" +
                "    </div>" +
                "  </div>";
        }

        txt += "</div>";
        return txt;
    },

    preview : function() {
        return this.insert();
    },

    display : function () {
        document.getElementById('alert_fields').hidden = true;
        document.getElementById('card_fields').hidden = true;
        document.getElementById('collapse_fields').hidden = false;
        document.getElementById('nav_nb_form-group').hidden = true;
        document.getElementById('button_fields').hidden = true;
        document.getElementById('button_tooltip_pos_form-group').hidden = (document.querySelector('input[name="button_tooltip"]:checked').value == "0");
    },
}

/** var corresponding to navigation menu component */
var HtmlComponentsNavLinks = {
    insert : function () {
        var nb_links = document.getElementById('nav_nb').value;
        var txt = "<ul class='nav nav-pills' style='list-style: none;'><li class='nav-item'>" +
            "<a href='#' class='nav-link active' style='border: 1px solid white;'>Tabs #1</a></li>";

        if (nb_links > 1) {
            for (var i = 2; i <= nb_links; i++) {
                txt += "<li class='nav-item'><a href='#' class='nav-link active' style='border: 1px solid white;'>Tabs #" + i + "</a></li>";
            }
        }

        txt += "</ul><hr/>";
        return txt;
    },

    preview : function() {
        return this.insert();
    },

    display : function () {
        document.getElementById('alert_fields').hidden = true;
        document.getElementById('card_fields').hidden = true;
        document.getElementById('collapse_fields').hidden = true;
        document.getElementById('nav_nb_form-group').hidden = false;
        document.getElementById('button_fields').hidden = true;
        document.getElementById('button_tooltip_pos_form-group').hidden = (document.querySelector('input[name="button_tooltip"]:checked').value == "0");
    },
}

/** var corresponding to navigation menu component */
var HtmlComponentsButton = {
    insert : function () {
        var nb_btns = document.getElementById('button_nb').value;
        var type = document.getElementById('button_type').value;
        var style = document.querySelector('input[name="button_style"]:checked').value;
        var size = document.querySelector('input[name="button_size"]:checked').value;
        var btn_class = ((style == "full") ? "btn-" + type : "btn-" + style + "-" + type) + " " + ((size == "med") ? "" : "btn-" + size);
        var btn_style = (style == "full") ? "style='color:white; margin-right:3px;'" : "style='margin-right:3px;'";
        var tooltip = (document.querySelector('input[name="button_tooltip"]:checked').value == "1");
        var btn_html = "<a href='#' role='button' class='btn " + btn_class + "'" + btn_style +
            ((tooltip) ? "data-toggle='tooltip' data-placement='" + document.getElementById('button_tooltip_pos').value + "' title='Tooltip on the button'" : "") + ">Button</a>";
        var txt = "";

        if (nb_btns >= 0) {
            for (var i = 1; i <= nb_btns; i++) {
                txt += btn_html;
            }
        }

        return txt;
    },

    preview : function() {
        return this.insert();
    },

    display : function () {
        document.getElementById('alert_fields').hidden = true;
        document.getElementById('card_fields').hidden = true;
        document.getElementById('collapse_fields').hidden = true;
        document.getElementById('nav_nb_form-group').hidden = true;
        document.getElementById('button_fields').hidden = false;
        document.getElementById('button_tooltip_pos_form-group').hidden = (document.querySelector('input[name="button_tooltip"]:checked').value == "0");
    },
}

/** var corresponding to a custom component */
var HtmlComponentsCustom = {
    insert : function() {
        // Returns the given html code as attribute for this component.
        return document.querySelector('option:checked').getAttribute('custom-component-content');
    },

    preview : function() {
        return this.insert();
    },

    display : function () {
        document.getElementById('alert_fields').hidden = true;
        document.getElementById('card_fields').hidden = true;
        document.getElementById('collapse_fields').hidden = true;
        document.getElementById('button_fields').hidden = true;
        document.getElementById('button_tooltip_pos_form-group').hidden = true;
    },
};

/** var corresponding to the principal object with functions used globally in the plugin. */
var HtmlComponentsDialog = {
    change: function () {
        var component = document.getElementById('component').value;
        if (component !== "") {
            var object = getObject(component)
            if (typeof object.change === "function") {
                // Execution of the specific component "change" function.
                object.change();
            }
            object.display();
            this.preview(component);
        }
        return;
    },

    preview: function (component) {
        if (component !== "") {
            var object = getObject(component);
            document.getElementById('component_preview').innerHTML = object.preview();
        }
    },

    insert: function() {
        var component = document.getElementById('component').value;
        if (component !== "") {
            var object = getObject(component);
            tinyMCEPopup.editor.execCommand('mceInsertContent', false, object.insert() + "<br/>");
        }
        tinyMCEPopup.close();
    }
};

/**
 * Return the right var in function of the given element we want to insert.
 * @param component the component to insert.
 * @returns var
 */
function getObject(component) {
    return window["HtmlComponents" + component];
}