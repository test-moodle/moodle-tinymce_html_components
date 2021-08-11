TinyMCE plugin to insert HTML components
==================================
Moodle plugin which allows you to insert in the TinyMCE editor some html components.

Goals
------------
The main goal of the plugin is to allow course managers and teacher to improve their courses displays and add interactivity thanks to html components without coding it directly.<br/>
These components (mostly from Bootstrap) are add with the TinyMCE editor and customizable thanks to available options.

Requirements
------------
- Moodle 3.7 or later.
-> Tests on Moodle 3.7 to 3.11.0 (tests on older moodle versions not made yet).
- Use Boost theme or a theme which extends Boost theme (use bootstrap).

Installation
------------
1. Local plugin installation

- With git:
> git clone https://github.com/andurif/moodle-tinymce_html_components.git lib/editor/tinymce/plugins/html_components

- Download way:
> Download the zip from <a href="https://github.com/andurif/moodle-tinymce_html_components/archive/refs/heads/main.zip" target="_blank">https://github.com/andurif/moodle-tinymce_html_components/archive/refs/heads/main.zip </a>, unzip it in lib/editor/tinymce/plugins/ folder and rename it "html_components" if necessary or install it from the "Install plugin" page if you have the right permissions.

2. Then visit your Admin Notifications page to complete the installation.


Presentation / Features
------------
For now this plugin allows you to easily add these html/bootstrap components:
- Accordion
- Alert
- Button
- Jumbotron
- Navigation menu
- Card
<p>Be careful, for some component you will have to edit to edit html source code in editor to change display
(Acccordion component for example to edit text or to change attributess id value if you use several to avoid conflicts).</p>

In the newest version of the plugin a first integration of personalized components has been implemented.<br/>
This integration allows a user to create a custom component and to save it in order to reuse it later via the plugin.

Possible improvements
-----
- Integration of other components, eg icons, timelines, carousels, breadcrumps ... (some developments are in progress).
- Add other options to facilitate the integration of components by users.
- Personalization linked to the theme used (use the primary variable css $ for example).
- Using Bootstrap 5.
- Code optimization.
<p>This is a first version of the plugin so feel free to propose some improvements and/or developments/pull requests to improve this plugin.</p>  

Abous us
------
<a href="https://www.uca.fr" target="_blank">Université Clermont Auvergne</a> - 2021.<br/>
