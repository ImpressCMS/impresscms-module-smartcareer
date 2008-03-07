<?php

/**
* $Id$
* Module: SmartCareer
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

/**  Text edited by RJB on 3/10/07 */
if (!defined("XOOPS_ROOT_PATH")) {
 	die("XOOPS root path not defined");
}

// posting

define("_CO_SMARTCAREER_POSTING_DEPARTMENTID", "Department");
define("_CO_SMARTCAREER_POSTING_DEPARTMENTID_DSC", "");
define("_CO_SMARTCAREER_POSTING_AREAID", "Area");
define("_CO_SMARTCAREER_POSTING_AREAID_DSC", "Area to which this posting is related");
define("_CO_SMARTCAREER_POSTING_TITLE", "Title");
define("_CO_SMARTCAREER_POSTING_TITLE_DSC", "");
define("_CO_SMARTCAREER_POSTING_DETAILS", "Details");
define("_CO_SMARTCAREER_POSTING_DETAILS_DSC", "");
define("_CO_SMARTCAREER_POSTING_STATUS", "Status");
define("_CO_SMARTCAREER_POSTING_STATUS_DSC", "");
define("_CO_SMARTCAREER_POSTING_POSTING_DATE", "Posting date");
define("_CO_SMARTCAREER_POSTING_POSTING_DATE_DSC", "");
define("_CO_SMARTCAREER_POSTING_CLOSING_DATE", "Closing date");
define("_CO_SMARTCAREER_POSTING_CLOSING_DATE_DSC", "");
define("_CO_SMARTCAREER_POSTING_REQUIREMENTS", "Requirements");
define("_CO_SMARTCAREER_POSTING_REQUIREMENTS_DSC", "");

define("_CO_SMARTCAREER_POSTING_STATUS_ONLINE", "Online");
define("_CO_SMARTCAREER_POSTING_STATUS_OFFLINE", "Offline");

// application

define("_CO_SMARTCAREER_APPLICATION_POSTINGID", "Posting");
define("_CO_SMARTCAREER_APPLICATION_POSTINGID_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_USERID", "User");
define("_CO_SMARTCAREER_APPLICATION_USERID_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_RELATED_EXPERIENCE", "Related experience");
define("_CO_SMARTCAREER_APPLICATION_RELATED_EXPERIENCE_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_SOURCE", "I heard about this posting here:");
define("_CO_SMARTCAREER_APPLICATION_SOURCE_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_RELEVANCE", "Relevance");
define("_CO_SMARTCAREER_APPLICATION_STATUS", "Status");
define("_CO_SMARTCAREER_APPLICATION_STATUS_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_APPLICATION_DATE", "Date");
define("_CO_SMARTCAREER_APPLICATION_APPLICATION_DATE_DSC", "");
define("_CO_SMARTCAREER_APPLICATION_COMMENT", "Comment");
define("_CO_SMARTCAREER_APPLICATION_COMMENT_DSC", "Internal use only");
// user

define("_CO_SMARTCAREER_USER_USERID", "User ID");
define("_CO_SMARTCAREER_USER_USERID_DSC", "");
define("_CO_SMARTCAREER_USER_UID", "Linked User ID");
define("_CO_SMARTCAREER_USER_UID_DSC", "");
define("_CO_SMARTCAREER_USER_UNAME", "User");
define("_CO_SMARTCAREER_USER_UNAME_DSC", "");
define("_CO_SMARTCAREER_USER_EMAIL", "Email");
define("_CO_SMARTCAREER_USER_PASSWORD", "Password");
define("_CO_SMARTCAREER_USER_PASSWORD_CONFIRM", "Confirm Password");
define("_CO_SMARTCAREER_USER_LASTNAME", "Last name");
define("_CO_SMARTCAREER_USER_LASTNAME_DSC", "");
define("_CO_SMARTCAREER_USER_FIRSTNAME", "First name");
define("_CO_SMARTCAREER_USER_FIRSTNAME_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS", "Address");
define("_CO_SMARTCAREER_USER_ADDRESS_NO", "No.");
define("_CO_SMARTCAREER_USER_ADDRESS_NO_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_STREET", "St.");
define("_CO_SMARTCAREER_USER_ADDRESS_STREET_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_UNIT", "Apt.");
define("_CO_SMARTCAREER_USER_ADDRESS_UNIT_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_CITY", "City");
define("_CO_SMARTCAREER_USER_ADDRESS_CITY_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_PROV", "Province");
define("_CO_SMARTCAREER_USER_ADDRESS_PROV_DSC", "");
define("_CO_SMARTCAREER_USER_ADDRESS_POSTALCODE", "Postal code");
define("_CO_SMARTCAREER_USER_ADDRESS_POSTALCODE_DSC", "");
define("_CO_SMARTCAREER_USER_PHONE", "Phone numbers");
define("_CO_SMARTCAREER_USER_PHONE_HOME", "Home");
define("_CO_SMARTCAREER_USER_PHONE_HOME_DSC", "");
define("_CO_SMARTCAREER_USER_PHONE_CELL", "Cellular");
define("_CO_SMARTCAREER_USER_PHONE_CELL_DSC", "");
define("_CO_SMARTCAREER_USER_PHONE_OTHER", "Other");
define("_CO_SMARTCAREER_USER_PHONE_OTHER_DSC", "");
define("_CO_SMARTCAREER_USER_LANGUAGE", "LANGUAGE NORMALLY USED");
define("_CO_SMARTCAREER_USER_FRENCH_SPOKEN", "French (spoken)");
define("_CO_SMARTCAREER_USER_FRENCH_SPOKEN_DSC", "");
define("_CO_SMARTCAREER_USER_FRENCH_WRITTEN", "French (written)");
define("_CO_SMARTCAREER_USER_FRENCH_WRITTEN_DSC", "");
define("_CO_SMARTCAREER_USER_ENGLISH_SPOKEN", "English (spoken)");
define("_CO_SMARTCAREER_USER_ENGLISH_SPOKEN_DSC", "");
define("_CO_SMARTCAREER_USER_ENGLISH_WRITTEN", "English (written)");
define("_CO_SMARTCAREER_USER_ENGLISH_WRITTEN_DSC", "");
define("_CO_SMARTCAREER_USER_LANGUAGE_OTHER", "Other language (please specify)");
define("_CO_SMARTCAREER_USER_LANGUAGE_OTHER_DSC", "");
define("_CO_SMARTCAREER_USER_DIPLOMA", "DEGREES AND DIPLOMAS");
define("_CO_SMARTCAREER_USER_HIGHSCHOOL", "Secondary");
define("_CO_SMARTCAREER_USER_HIGHSCHOOL_DSC", "");
define("_CO_SMARTCAREER_USER_HIGHSCHOOL_DIPLOMA", "Specify diploma obtained");
define("_CO_SMARTCAREER_USER_HIGHSCHOOL_DIPLOMA_DSC", "");
define("_CO_SMARTCAREER_USER_COLLEGE", "College");
define("_CO_SMARTCAREER_USER_COLLEGEL_DSC", "");
define("_CO_SMARTCAREER_USER_COLLEGE_DIPLOMA", "Specify degree obtained");
define("_CO_SMARTCAREER_USER_COLLEGE_DIPLOMA_DSC", "");
define("_CO_SMARTCAREER_USER_UNIVERSITY", "University");
define("_CO_SMARTCAREER_USER_UNIVERSITY_DSC", "");
define("_CO_SMARTCAREER_USER_UNIVERSITY_DIPLOMA", "Specify degree obtained");
define("_CO_SMARTCAREER_USER_UNIVERSITY_DIPLOMA_DSC", "");
define("_CO_SMARTCAREER_USER_OTHER_DIPLOMA", "Other studies (graduate studies or continuing education): Please specify");
define("_CO_SMARTCAREER_USER_OTHER_DIPLOMA_DSC", "");
define("_CO_SMARTCAREER_USER_EXPERIENCE", "GENERAL EXPERIENCE – RESUME");
define("_CO_SMARTCAREER_USER_RESUME", "Resume");
define("_CO_SMARTCAREER_USER_RESUME_DSC", "*Word or PDF file, MAX 2Mo.");
define("_CO_SMARTCAREER_USER_ALREADY_WORKED", "Have you previously been employed by Prestige?");
define("_CO_SMARTCAREER_USER_REFERENCE", "Letter of presentation");
define("_CO_SMARTCAREER_USER_REFERENCE_DSC", "*Word or PDF file, MAX 2Mo.");
define("_CO_SMARTCAREER_USER_ALREADY_WORKED_DSC", "");
define("_CO_SMARTCAREER_USER_ALREADY_WORKED_SIMILAR", "Have you previously worked in a company similar to Prestige?");
define("_CO_SMARTCAREER_USER_ALREADY_WORKED_SIMILAR_DSC", "");
define("_CO_SMARTCAREER_USER_AVAILABILITY", "Availability ");
define("_CO_SMARTCAREER_USER_AVAILABILITY_DSC", "");
define("_CO_SMARTCAREER_USER_STATUS", "Status");
define("_CO_SMARTCAREER_USER_STATUS_DSC", "");

define("_CO_SMARTCAREER_USER_CREATED_MAIL_SUBJECT", "Your account created on %s");
define("_CO_SMARTCAREER_USER_CREATED_ERROR", "An error occured while creating the user.");
define("_CO_SMARTCAREER_USER_CREATED_ADM_MAIL_SUBJECT", "Account created on %s");
define("_CO_SMARTCAREER_PREV_JOB1", "Previous Job #1");
define("_CO_SMARTCAREER_PREV_JOB2", "Previous Job #2");
define("_CO_SMARTCAREER_PREV_JOB3", "Previous Job #3");
define("_CO_SMARTCAREER_PREV_JOB_TITLE", "Title of position");
define("_CO_SMARTCAREER_PREV_JOB_CIE", "Company");
define("_CO_SMARTCAREER_PREV_JOB_FROM", "From");
define("_CO_SMARTCAREER_PREV_JOB_TO", "To");
define("_CO_SMARTCAREER_USER_COMMENT", "Comment");
define("_CO_SMARTCAREER_USER_COMMENT_DSC", "Internal use only");
define("_CO_SMARTCAREER_ALL", "All");
define("_CO_SMARTCAREER_USER_NOTIF", "I want to be notified for: (Please select all the options you are interested in)");
define("_CO_SMARTCAREER_USER_NOTIF_AREA", "In the following areas:");
define("_CO_SMARTCAREER_USER_NOTIF_DEPT", "In the following Departments:");
define("_CO_SMARTCAREER_NEW_POSTING_SUBJECT", "New Job Posting on Prestige Telecom carrer center");
define("_CO_SCAREER_APPLICATION_REQUIREMENT_APPLICATIONIDID", "Application");
define("_CO_SCAREER_APPLICATION_REQUIREMENT_REQUIREMENTID", "Requirement");
define("_CO_SCAREER_APPLICATION_REQUIREMENT_VALUE", "Value");
define("_MD_SMARTCAREER_REQ_ERROR", "Please fill properly the requirement section.");
define("_MD_SMARTCAREER_EXP_ERROR", "Please fill properly the related experience section.");
define("_MD_SMARTCAREER_SOURCE_ERROR", "Please indicate from where you heard about this opportunity.");

?>