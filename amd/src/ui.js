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
 * Tiny html_component modal display and event management.
 * @module      tiny_html_components/ui
 * @copyright   2023 Gerbault Cédric, Anthony Durif, Université Clermont Auvergne
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


import Templates from 'core/templates';
import url from 'core/url';
import  {getCustomComponents} from './options';
import {get_string as getString} from 'core/str';
import {exception as displayException} from 'core/notification';
import Modal from 'tiny_html_components/modal';
import ModalEvents from 'core/modal_events';
import ModalFactory from 'core/modal_factory';
import {components} from 'tiny_html_components/components';



export const handleAction = (editor) => {
    displayDialogue(editor);
};


/**
 * Get the template context for the dialogue.
 *
 * @param {Editor} editor
 * @returns {object} data
 */
const getTemplateContext = async(editor) => {
    let selectList = [];
    let promise = [];
    let customGroup = false;
    let customComponent = [];

    components.forEach(item => {
        promise.push(
        getString(item.name,'tiny_html_components'));
    });
    if(typeof getCustomComponents(editor) !== 'undefined'){
        customComponent = JSON.parse(getCustomComponents(editor));
        customGroup = true;
    }
    await Promise.all(promise)
    .then ((values)=>{
        values.forEach((element,index) => {
            let params ={};
            params.id = components[index].id;
            params.string = element;
            selectList.push(params);
        });
    });
    const customUrl = await url.fileUrl("/lib/editor/tiny/plugins/html_components/custom_components.php","");
    return Object.assign({},{selectList},{customUrl},{customComponent},{customGroup});
};



/**
 * Generate and diplay the Dialogue, then add eventListeners.
 *
 * @param {Editor} editor
 */
const displayDialogue = async(editor) => {
    const modal = await ModalFactory.create({
        type: Modal.TYPE,
        templateContext: await getTemplateContext(editor),
        large: true,
    });
    modal.show();
    const $root = modal.getRoot();
    const root = $root[0];
    root.addEventListener('change', (event) => {
        handleModalChange(event, modal, editor);
    });
    $root.on(ModalEvents.save,(event,modal)=>{
        handleDialogueSubmission(editor, modal);
    });
};

/**
 * Handle the change in options and adjust correlated preview at the same time
 * @param {Event} event
 * @param {Modal} modal
 */
const handleModalChange = async (event,modal) => {
    const preview = modal.getRoot()[0].querySelector('#component_preview');
    const options = modal.getRoot()[0].querySelector('#options-placeholder');
    switch(event.target.dataset.holder){
        case 'component-selector':{
            preview.innerHTML = "";
            const selected = components[event.target.value];
            if(event.target.value == 'custom'){
                var txt = document.createElement("textarea");
                txt.innerHTML = event.target.options[event.target.selectedIndex].dataset.content;
                preview.innerHTML = txt.value + '&nbsp';
            }
            else{
                if(selected.params){
                    await Templates.renderForPromise(`tiny_html_components/components/${selected.name}`,{})
                    .then(({html,js})=>{
                        Templates.replaceNodeContents('#options-placeholder',html,js);
                    }).catch((error) => displayException(error));
                }
                else {
                    options.innerHTML = "";
                }
                preview.innerHTML = selected.code() + '&nbsp';
            }
        break;
        }
        case 'params':{
            refreshPreview(preview);
        break;
        }
        case 'options':{
                toggleTargetVisibility(event,'toggle');
                refreshPreview(preview);
        break;
        }
    }
};

/**
 * Handle the dialogue submission, inserting at the caret position the content previewed
 * @param {Editor} editor
 * @param {Modal} modal
 */
const handleDialogueSubmission = (editor,modal) => {

   const contentToAdd = modal.getRoot()[0].querySelector('#component_preview');
    editor.insertContent(contentToAdd.innerHTML);
    editor.save();
    modal.destroy();
};

const refreshPreview =(preview)=>{
    preview.innerHTML= "";
    let parentComp = components[document.getElementById('component').value];
    preview.innerHTML =  parentComp.code() + '&nbsp';
};

const toggleTargetVisibility= (event) =>{
    const target = event.target.dataset.target;
    const element = document.getElementById(target);
    element.classList.toggle('d-none');
};

