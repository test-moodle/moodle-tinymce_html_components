Plugin Tiny d'insertion de composants HTML
==================================
Plugin moodle permettant des composants html via l'éditeur Tiny.

Objectif
------------
L'objectif du plugin est de permettre d'enrichir facilement le visuel des cours et d'ajouter de l'intéractivité grâce à des composants html sans que les enseignants n'aient à maitriser le code html. <br/>
Ces composants (principalement présent dans Bootstrap) seront ajoutés via l'éditeur Tiny et personnalisables grâce aux quelques options présentes.

Pré-requis
------------
- Moodle en version 4.1 ou plus récente.
-> Tests effectués sur des versions 4.1.
- Utilisation de l'éditeur Tiny
- Utilisation du thème Boost ou d'un thème qui étend le thème Boost (qui utilise bootstrap).

Installation
------------
1. Installation du plugin

- Avec git:
> git clone https://github.com/andurif/moodle-tinymce_html_components.git lib/editor/tinymce/plugins/html_components

- Téléchargement:
> Télécharger le zip depuis <a href="https://github.com/andurif/moodle-tinymce_html_components/archive/refs/heads/main.zip" target="_blank" >https://github.com/andurif/moodle-tinymce_html_components/archive/refs/heads/main.zip </a>, dézipper l'archive dans le dossier lib/editor/tinymce/plugins/ et renommer le si besoin le dossier en "html_components" ou installez-le depuis la page d'installation des plugins si vous possédeez les bons droits..

2. Aller sur la page de notifications pour finaliser l'installation du plugin.


Présentation
------------
Le plugin permet pour l'instant d'insérer facilement les composants html/bootstrap suivants:
- Accordéon
- Alerte
- Bouton
- Jumbotron
- Menu de navigation
- Vignette
<p>Attention, pour éditer le visuel de certains composants vous serez obligé de modifier le code source html depuis l'éditeur
(L'élément accordéon par exemple pour mdofier le contenu ou la valeur des attributs id pour éviter les conflits si vous utilisez plusieurs accordéons dans la même page).</p>

Dans la dernière version du plugin, une première intégration d'éléments personnalisés a été développé.<br/>
Cette intégration permet à un utilisateur de créer ses propres composants, de les enregistrer et de les réutiliser plus tard via ce plugin.

Pistes d'améliorations
-----
- Intégrer d'autres composants, ex: icônes, timeline, carousel, breadcrump... (certains ajouts sont en cours de développement)
- Intégrer davantage d'options pour faciliter les ajouts par les enseignants. 
- Personnalisation en relation avec le thème utilisé (utilisation variable $primary par exemple).  
- Utilisation de Bootstrap 5.
- Optimiser le code.
<p>Ceci est la première version du plugin donc n'hésitez pas à proposer des améliorations et/ou des développements/pull pour enrichir le plugin.</p>  </p>

A propos
------
<a href="https://www.uca.fr" target="_blank">Université Clermont Auvergne</a> - 2023.<br/>