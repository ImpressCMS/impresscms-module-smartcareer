<?php

/**
* $Id: common.php,v 1.10 2007/10/22 15:45:48 marcan Exp $
* Module: SmartCareer
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

/**  Text edited by RJB on 3/10/07 */
if (!defined("XOOPS_ROOT_PATH")) {
 	die("XOOPS root path not defined");
}

// posting

define("_CO_SMARTCAREER_POSTING_DEPARTMENTID", "Secteur");
define("_CO_SMARTCAREER_POSTING_DEPARTMENTID_DSC", "");
define("_CO_SMARTCAREER_POSTING_AREAID", "Lieu de travail");
define("_CO_SMARTCAREER_POSTING_AREAID_DSC", "");
define("_CO_SMARTCAREER_POSTING_TITLE", "Poste");
define("_CO_SMARTCAREER_POSTING_TITLE_DSC", "");
define("_CO_SMARTCAREER_POSTING_DETAILS", "Description");
define("_CO_SMARTCAREER_POSTING_DETAILS_DSC", "");
define("_CO_SMARTCAREER_POSTING_STATUS", "Statut");
define("_CO_SMARTCAREER_POSTING_STATUS_DSC", "");
define("_CO_SMARTCAREER_POSTING_POSTING_DATE", "Date d'affichage");
define("_CO_SMARTCAREER_POSTING_POSTING_DATE_DSC", "");
define("_CO_SMARTCAREER_POSTING_CLOSING_DATE", "Date de clôture");
define("_CO_SMARTCAREER_POSTING_CLOSING_DATE_DSC", "");
define("_CO_SMARTCAREER_POSTING_REQUIREMENTS", "Exigences");
define("_CO_SMARTCAREER_POSTING_REQUIREMENTS_DSC", "");

define("_CO_SMARTCAREER_POSTING_STATUS_ONLINE", "En ligne");
define("_CO_SMARTCAREER_POSTING_STATUS_OFFLINE", "Hors ligne");

// application

define("_CO_SMARTCAREER_APPLICATION_POSTINGID", "Poste");
define("_CO_SMARTCAREER_APPLICATION_POSTINGID_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_USERID", "Candidat");
define("_CO_SMARTCAREER_APPLICATION_USERID_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_RELATED_EXPERIENCE", "Expérience pertinente");
define("_CO_SMARTCAREER_APPLICATION_RELATED_EXPERIENCE_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_SOURCE", "J’ai entendu parler de cette offre par :");
define("_CO_SMARTCAREER_APPLICATION_SOURCE_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_RELEVANCE", "Pertinence");
define("_CO_SMARTCAREER_APPLICATION_STATUS_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_STATUS", "Statut");
define("_CO_SMARTCAREER_APPLICATION_STATUS_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_APPLICATION_DATE", "Date/candidature");
define("_CO_SMARTCAREER_APPLICATION_APPLICATION_DATE_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_COMMENT", "Commentaire");
define("_CO_SMARTCAREER_APPLICATION_COMMENT_DSC", "Usage interne seulement");
define("_CO_SMARTCAREER_APPLICATION_REQUIREMENT_USERID", "Candidat");
// user

define("_CO_SMARTCAREER_USER_USERID", "ID");
define("_CO_SMARTCAREER_USER_USERID_DSC", "");
define("_CO_SMARTCAREER_USER_UID", "User ID lié");
define("_CO_SMARTCAREER_USER_UID_DSC", "");
define("_CO_SMARTCAREER_USER_UNAME", "Candidat");
define("_CO_SMARTCAREER_USER_UNAME_DSC", "");
define("_CO_SMARTCAREER_USER_EMAIL", "Courriel");
define("_CO_SMARTCAREER_USER_PASSWORD", "Mot de passe");
define("_CO_SMARTCAREER_USER_PASSWORD_CONFIRM", "Confirmation du mot de passe");
define("_CO_SMARTCAREER_USER_LASTNAME", "Nom");
define("_CO_SMARTCAREER_USER_LASTNAME_DSC", "");
define("_CO_SMARTCAREER_USER_FIRSTNAME", "Prénom");
define("_CO_SMARTCAREER_USER_FIRSTNAME_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS", "Adresse");
define("_CO_SMARTCAREER_USER_ADDRESS_NO", "N<sup>o</sup>");
define("_CO_SMARTCAREER_USER_ADDRESS_NO_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_STREET", "Rue");
define("_CO_SMARTCAREER_USER_ADDRESS_STREET_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_UNIT", "App.");
define("_CO_SMARTCAREER_USER_ADDRESS_UNIT_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_CITY", "Ville");
define("_CO_SMARTCAREER_USER_ADDRESS_CITY_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_PROV", "Province");
define("_CO_SMARTCAREER_USER_ADDRESS_PROV_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_POSTALCODE", "Code postal");
define("_CO_SMARTCAREER_USER_ADDRESS_POSTALCODE_DSC", "");
define("_CO_SMARTCAREER_USER_PHONE", "Numéros de téléphone");
define("_CO_SMARTCAREER_USER_PHONE_HOME", "Résidentiel");
define("_CO_SMARTCAREER_USER_PHONE_HOME_DSC", "");
define("_CO_SMARTCAREER_USER_PHONE_CELL", "Cellulaire");
define("_CO_SMARTCAREER_USER_PHONE_CELL_DSC", "");
define("_CO_SMARTCAREER_USER_PHONE_OTHER", "Autre");
define("_CO_SMARTCAREER_USER_PHONE_OTHER_DSC", "");
define("_CO_SMARTCAREER_USER_LANGUAGE", "Langue d'usage courant");
define("_CO_SMARTCAREER_USER_FRENCH_SPOKEN", "Français (parlé)");
define("_CO_SMARTCAREER_USER_FRENCH_SPOKEN_DSC", "");
define("_CO_SMARTCAREER_USER_FRENCH_WRITTEN", "Français (écrit)");
define("_CO_SMARTCAREER_USER_FRENCH_WRITTEN_DSC", "");
define("_CO_SMARTCAREER_USER_ENGLISH_SPOKEN", "Anglais (parlé)");
define("_CO_SMARTCAREER_USER_ENGLISH_SPOKEN_DSC", "");
define("_CO_SMARTCAREER_USER_ENGLISH_WRITTEN", "Anglais (écrit)");
define("_CO_SMARTCAREER_USER_ENGLISH_WRITTEN_DSC", "");
define("_CO_SMARTCAREER_USER_LANGUAGE_OTHER", "Autres (préciser)");
define("_CO_SMARTCAREER_USER_LANGUAGE_OTHER_DSC", "");
define("_CO_SMARTCAREER_USER_DIPLOMA", "Diplômes et attestations d'études");
define("_CO_SMARTCAREER_USER_HIGHSCHOOL", "Secondaire");
define("_CO_SMARTCAREER_USER_HIGHSCHOOL_DSC", "");
define("_CO_SMARTCAREER_USER_HIGHSCHOOL_DIPLOMA", "Précisez le diplôme obtenu");
define("_CO_SMARTCAREER_USER_HIGHSCHOOL_DIPLOMA_DSC", "");
define("_CO_SMARTCAREER_USER_COLLEGE", "Collégial");
define("_CO_SMARTCAREER_USER_COLLEGEL_DSC", "");
define("_CO_SMARTCAREER_USER_COLLEGE_DIPLOMA", "Précisez le diplôme obtenu");
define("_CO_SMARTCAREER_USER_COLLEGE_DIPLOMA_DSC", "");
define("_CO_SMARTCAREER_USER_UNIVERSITY", "Universitaire");
define("_CO_SMARTCAREER_USER_UNIVERSITY_DSC", "");
define("_CO_SMARTCAREER_USER_UNIVERSITY_DIPLOMA", "Précisez le diplôme obtenu");
define("_CO_SMARTCAREER_USER_UNIVERSITY_DIPLOMA_DSC", "");
define("_CO_SMARTCAREER_USER_OTHER_DIPLOMA", "Autres études (postuniversitaires ou formation continue) : préciser");
define("_CO_SMARTCAREER_USER_OTHER_DIPLOMA_DSC", "");
define("_CO_SMARTCAREER_USER_EXPERIENCE", "Curriculum Vitae");
define("_CO_SMARTCAREER_USER_RESUME", "CV : Fichier Word ou PDF, MAX 2Mo.");
define("_CO_SMARTCAREER_USER_RESUME_DSC", "");
define("_CO_SMARTCAREER_USER_REFERENCE", "Lettre de présentation : Fichier Word ou PDF, MAX 2Mo.");
define("_CO_SMARTCAREER_USER_REFERENCE_DSC", "");
define("_CO_SMARTCAREER_USER_ALREADY_WORKED", "Avez-vous déjà été à l’emploi de Prestige ?");
define("_CO_SMARTCAREER_USER_ALREADY_WORKED_DSC", "");
define("_CO_SMARTCAREER_USER_ALREADY_WORKED_SIMILAR", "Avez-vous déjà travaillé pour une entreprise en télécommunications ?");
define("_CO_SMARTCAREER_USER_ALREADY_WORKED_SIMILAR_DSC", "");
define("_CO_SMARTCAREER_USER_AVAILABILITY", "Disponibilité");
define("_CO_SMARTCAREER_USER_AVAILABILITY_DSC", "");
define("_CO_SMARTCAREER_USER_STATUS", "Statut");
define("_CO_SMARTCAREER_USER_STATUS_DSC", "");
define("_CO_SMARTCAREER_USER_COMMENT", "Commentaire");
define("_CO_SMARTCAREER_USER_COMMENT_DSC", "Usage interne seulement");

define("_CO_SMARTCAREER_USER_CREATED_MAIL_SUBJECT", "Votre profil a été créé sur %s");
define("_CO_SMARTCAREER_USER_CREATED_ERROR", "Une erreur est survenu à la création de cet utilisateur.");
define("_CO_SMARTCAREER_USER_CREATED_ADM_MAIL_SUBJECT", "Compte créé sur %s");
define("_CO_SMARTCAREER_PREV_JOB1", "Emploi précédent #1");
define("_CO_SMARTCAREER_PREV_JOB2", "Emploi précédent #2");
define("_CO_SMARTCAREER_PREV_JOB3", "Emploi précédent #3");
define("_CO_SMARTCAREER_PREV_JOB_TITLE", "Titre");
define("_CO_SMARTCAREER_PREV_JOB_CIE", "Compagnie");
define("_CO_SMARTCAREER_PREV_JOB_FROM", "De");
define("_CO_SMARTCAREER_PREV_JOB_TO", "À");
define("_CO_SMARTCAREER_ALL", "Tous");
define("_CO_SMARTCAREER_USER_NOTIF", "Je désire recevoir un courriel m'informant des nouvelles offres d'emplois : (Veuillez cocher toutes les options qui vous intéressent)");
define("_CO_SMARTCAREER_USER_NOTIF_AREA", "dans les villes suivantes :");
define("_CO_SMARTCAREER_USER_NOTIF_DEPT", "dans les secteurs suivants :");
define("_CO_SMARTCAREER_NEW_POSTING_SUBJECT", "Nouvelle offre d'emploi sur le site de Prestige Telecom");
define("_CO_SCAREER_APPLICATION_REQUIREMENT_APPLICATIONIDID", "Candidature");
define("_CO_SCAREER_APPLICATION_REQUIREMENT_REQUIREMENTID", "Exigence");
define("_CO_SCAREER_APPLICATION_REQUIREMENT_VALUE", "Cote");
define("_MD_SMARTCAREER_REQ_ERROR", "Remplissez correctement la section des exigences S.V.P.");
define("_MD_SMARTCAREER_EXP_ERROR", "Indiquez vos années d'expériences S.V.P.");
define("_MD_SMARTCAREER_SOURCE_ERROR", "Indiquez d'où avez-vous entndu parler de cette offre S.V.P.");
?>