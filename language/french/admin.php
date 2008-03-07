<?php

/**
* $Id: admin.php,v 1.4 2007/10/22 13:36:06 marcan Exp $
* Module: SmartCareer
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

/**  Text edited by RJB on 3/10/07 */


if (!defined("XOOPS_ROOT_PATH")) {
 	die("XOOPS root path not defined");
}


define("_AM_SCAREER_INDEX", "Index");
define("_AM_SCAREER_POSTINGS", "Offres d'emploi");
define("_AM_SCAREER_APPLICATIONS", "Candidatures");
define("_AM_SCAREER_USERS", "Candidats");
define("_AM_SCAREER_STATS", "Statistiques");
define("_AM_SCAREER_APPLICATION", "Candidature");
// Posting

define("_AM_SCAREER_POSTINGS", "Offres d'emploi");
define("_AM_SCAREER_POSTINGS_DSC", "Ensemble des offres d'emploi");
define("_AM_SCAREER_POSTING_CREATE", "Ajouter une offre d'emploi");
define("_AM_SCAREER_POSTING", "Offre d'emploi");
define("_AM_SCAREER_POSTING_CREATE_INFO", "Veuillez remplir le formulaire suivant afin de créer une nouvelle offre d'emploi.");
define("_AM_SCAREER_POSTING_EDIT", "Modifier cette offre d'emploi");
define("_AM_SCAREER_POSTING_EDIT_INFO", "Veuillez remplir le formulaire suivant afin de modifier cette offre d'emploi.");
define("_AM_SCAREER_POSTING_MODIFIED", "L'offre d'emploi a été modifiée.");
define("_AM_SCAREER_POSTING_CREATED", "L'offre d'emploi a éré créée.");
define("_AM_SCAREER_POSTING_VIEW", "Information de l'offre d'emploi");
define("_AM_SCAREER_POSTING_VIEW_DSC", "Voici les informations relatives à cette offre d'emploi.");
define("_AM_SCAREER_MANDATORY", "Obligatoire :");
define("_AM_SCAREER_DELETE", "Supprimer");
define("_AM_SCAREER_POSTING_PUBLISH", "Publier");
// Candidature

define("_AM_SCAREER_APPLICATIONS", "Candidatures");
define("_AM_SCAREER_APPLICATIONS_DSC", "Ensembles des candidatures du système");
define("_AM_SCAREER_APPLICATION_CREATE", "Ajouter une candidature");
define("_AM_SCAREER_APPLICATION", "Candidatures");
define("_AM_SCAREER_APPLICATION_CREATE_INFO", "");
define("_AM_SCAREER_APPLICATION_EDIT", "Modifier une candidature");
define("_AM_SCAREER_APPLICATION_EDIT_INFO", "");
define("_AM_SCAREER_APPLICATION_MODIFIED", "La candidature a été modifiée.");
define("_AM_SCAREER_APPLICATION_CREATED", "La candidature a été créée.");
define("_AM_SCAREER_APPLICATION_VIEW", "Information de la candidature");
define("_AM_SCAREER_APPLICATION_VIEW_DSC", "");


// User

define("_AM_SCAREER_USERS", "Liste des candidats");
define("_AM_SCAREER_USERS_DSC", "Ensemble des usagers - module Ressources humaines");
define("_AM_SCAREER_USER_CREATE", "Ajouter un utilisateur");
define("_AM_SCAREER_USER", "Candidats");
define("_AM_SCAREER_USER_CREATE_INFO", "Remplissez le formulaire suivant pour créer un utilisateur");
define("_AM_SCAREER_USER_EDIT", "Modifier l'utilisateur");
define("_AM_SCAREER_USER_EDIT_INFO", "Remplissez le formulaire suivant pour modifier un utilisateur");
define("_AM_SCAREER_USER_MODIFIED", "L'utilisateur a été modifié.");
define("_AM_SCAREER_USER_CREATED", "L'utilisateur a été créé.");
define("_AM_SCAREER_USER_VIEW", "Information de l'utilisateur");
define("_AM_SCAREER_USER_VIEW_DSC", "");

//Stats
define("_AM_SCAREER_FILTER_DATE", "Période:");
define("_AM_SCAREER_DATE_START", "À partir de ");
define("_AM_SCAREER_DATE_END", "jusqu'à ");
define("_AM_SCAREER_SUBMIT", "Envoyer");
define("_AM_SCAREER_BY_POST", "Nombre de candidatures par offre");
define("_AM_SCAREER_BY_DEPT", "Nombre de candidatures par secteurs d'activités");
define("_AM_SCAREER_BY_AREA", "Nombre de candidatures par région");
define("_AM_SCAREER_NO_APP", "Aucune candidature pour la période sélectionnée");
define("_AM_SCAREER_BY_SOURCE", "Nombre de candidatures par source");

//search
define("_AM_SCAREER_SEARCH_REQUIREMENTS", "Recherche exigences");
define("_AM_SCAREER_SEARCH_REQUIREMENTS_INFO", "Recherche par mots clés dans l'ensemble des dossiers de candidatures pour relever des compétences spécifiques.");
define("_AM_SCAREER_SEARCH", "Recherche");
define("_AM_SCAREER_KEYWORD", "Exigence");
define("_AM_SCAREER_SEARCH_MIN", "Cote minimale");
?>