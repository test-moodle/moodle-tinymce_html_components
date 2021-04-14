(function() {

    // Load plugin specific language pack
    tinymce.PluginManager.requireLangPack('html_components');

    tinymce.create('tinymce.plugins.HtmlComponents', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {

            // Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('html_components');
            ed.addCommand('html_components', function() {
                lang = ed.getParam('language');
                ed.windowManager.open({
                    file : ed.getParam("moodle_plugin_base") + 'html_components/dialog.php?lang=' + lang ,
                    width : 1500 + ed.getLang('html_components.delta_width', 0),
                    height : 800 + ed.getLang('html_components.delta_height', 0),
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Register html_components button
            ed.addButton('html_components', {
                title : 'html_components.title',
                cmd : 'html_components',
                image : url + '/img/components.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected.
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('html_components', n.nodeName == 'IMG');
            });

        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Html components insertion plugin',
                authorurl : '',
                infourl : '',
                version : "1.0"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('html_components', tinymce.plugins.HtmlComponents);
})();