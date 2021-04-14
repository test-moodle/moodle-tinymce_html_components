Plugin TinyMCE d'insertion de composants HTML
==================================
Plugin moodle permettant des composants html via l'éditeur TinyMCE.

Objectif
------------
L'objectif du plugin est de permettre d'enrichir facielement le visuel les cours et d'ajouter de l'intéractivité grâce à des composants html sans que les enseignants aient à maitriser le code html. <br/>
Ces composants (principalement présent dans Bootstrap) seront ajoutés via l'éditeur TinyMCE et personnalisables grâce aux quelques options présentes.

Pré-requis
------------
- Moodle en version 3.7 ou plus récente.
-> Tests effectués sur des versions 3.7 à 3.10.3 (tests sur des versions précédentes par encore effectués).
- Utilisation du thème Boost ou d'un thème qui étend le thème Boost (qui utilise bootstrap).

Installation
------------
1. Installation du plugin

- Avec git:
> git clone https://github.com/andurif/moodle-tinymce_html_components.git lib/editor/tinymce/plugins/html_components

- Téléchargement:
> Télécharger le zip depuis https://github.com/andurif//moodle-tinymce_html_components/archive/master.zip, dézipper l'archive dans le dossier lib/editor/tinymce/plugins/ et renommer le si besoin le dossier en "html_components" ou installez-le depuis la page d'installation des plugins si vous possédeez les bons droits..

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

Pistes d'améliorations
-----
- Intégrer d'autres composants, ex: icônes, timeline, carousel, breadcrump... (certains ajouts sont en cours de développement)
- Intégrer des éléments personnalisé, plus complexes et propre à l'utilisateur.
- Intégrer davantage d'options pour faciliter les ajouts par les enseignants. 
- Personnalisation en relation avec le thème utilisé (utilisation variable $primary par exemple).  
- Utilisation de Bootstrap 5.
- Optimiser le code.

A propos
------
<a href="https://www.uca.fr" target="_blank">Université Clermont Auvergne</a> - 2021.<br/>
