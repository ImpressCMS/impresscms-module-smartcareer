<?php

/**
* $Id$
* Module: SmartCareer
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

if (!defined("XOOPS_ROOT_PATH")) {
 	die("XOOPS root path not defined");
}

$modversion['name'] = _MI_SCAREER_MD_NAME;
$modversion['version'] = 1.0;
$modversion['description'] = _MI_SCAREER_MD_DESC;
$modversion['author'] = "INBOX International";
$modversion['credits'] = "The SmartFactory";
$modversion['help'] = "";
$modversion['license'] = "GNU General Public License (GPL)";
$modversion['official'] = 0;
$modversion['image'] = "images/module_logo.gif";
$modversion['dirname'] = "smartcareer";

// Added by marcan for the About page in admin section
$modversion['developer_website_url'] = "http://smartfactory.ca";
$modversion['developer_website_name'] = "The SmartFactory";
$modversion['developer_email'] = "info@smartfactory.ca";
$modversion['status_version'] = "Beta 1";
$modversion['status'] = "Beta";
$modversion['date'] = "unreleased";

$modversion['people']['developers'][] = "[url=http://smartfactory.ca/userinfo.php?uid=1]marcan[/url] (Marc-André Lanciault)";
$modversion['people']['developers'][] = "[url=http://smartfactory.ca/userinfo.php?uid=112]felix[/url] (Félix Tousignant)";

//$modversion['people']['testers'][] = "Rob Butterworth";

//$modversion['people']['translators'][] = "translator 1";

//$modversion['people']['documenters'][] = "documenter 1";

//$modversion['people']['other'][] = "other 1";

$modversion['warning'] = _CO_SOBJECT_WARNING_BETA;

$modversion['author_word'] = "";

$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

$modversion['onInstall'] = "include/onupdate.inc.php";
$modversion['onUpdate'] = "include/onupdate.inc.php";

/**
 * SmartObject Hack : defining the items managed by this module
 */
$modversion['object_items'][1] = 'posting';
$modversion['object_items'][2] = 'application';
$modversion['object_items'][3] = 'requirement';
$modversion['object_items'][4] = 'application_requirement';
$modversion['object_items'][5] = 'user';

// Search
$modversion['hasSearch'] = 0;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "smartcareer_search";

// Menu
$modversion['hasMain'] = 1;

/*
$modversion['sub'][1]['name'] = _MI_SCAREER_ECARDS;
$modversion['sub'][1]['url'] = "sendecard.php";

$modversion['sub'][2]['name'] = _MI_SCAREER_ARCHIVE;
$modversion['sub'][2]['url'] = "message.php";
*/

/*
$modversion['blocks'][1]['file'] = "new_adds.php";
$modversion['blocks'][1]['name'] = _MI_SCAREER_NEW_ADDS;
$modversion['blocks'][1]['show_func'] = "new_adds_show";
$modversion['blocks'][1]['edit_func'] = "new_adds_edit";
$modversion['blocks'][1]['template'] = "smartcareer_new_adds.html";

*/
global $xoopsModule;
// Templates
$i = 0;

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_header.html';
$modversion['templates'][$i]['description'] = 'Header template of all pages';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_footer.html';
$modversion['templates'][$i]['description'] = 'Footer template of all pages';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_index.html';
$modversion['templates'][$i]['description'] = 'Display Index page';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_index_english.html';
$modversion['templates'][$i]['description'] = '';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_index_french.html';
$modversion['templates'][$i]['description'] = '';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_posting.html';
$modversion['templates'][$i]['description'] = '';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_apply.html';
$modversion['templates'][$i]['description'] = '';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_user.html';
$modversion['templates'][$i]['description'] = '';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_posting_table.html';
$modversion['templates'][$i]['description'] = '';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_stats.html';
$modversion['templates'][$i]['description'] = '';

$i++;
$modversion['templates'][$i]['file'] = 'smartcareer_search.html';
$modversion['templates'][$i]['description'] = '';

// Config Settings (only for modules that need config settings generated automatically)
$i = 0;

//common prefs for all module uses

$modversion['config'][$i]['name'] = 'default_editor';
$modversion['config'][$i]['title'] = '_CO_SOBJECT_EDITOR';
$modversion['config'][$i]['description'] = '_CO_SOBJECT_EDITOR_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
include_once(XOOPS_ROOT_PATH."/modules/smartobject/include/functions.php");
$modversion['config'][$i]['options'] = smart_getEditors();
$modversion['config'][$i]['default'] = 'dhtmltextarea';
$i++;

$modversion['config'][$i]['name'] = 'index_text';
$modversion['config'][$i]['title'] = '_MI_SCAREER_INDTXT';
$modversion['config'][$i]['description'] = '_MI_SCAREER_INDTXTDSC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$i++;

/*
$i++;
$modversion['config'][$i]['name'] = 'show_subcats';
$modversion['config'][$i]['title'] = '_MI_SCAREER_SHOW_SUBCATS';
$modversion['config'][$i]['description'] = '_MI_SCAREER_SHOW_SUBCATS_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'all';
$modversion['config'][$i]['options'] = array(_MI_SCAREER_SHOW_SUBCATS_NO  => 'no',
                                   		_MI_SCAREER_SHOW_SUBCATS_NOTEMPTY   => 'nonempty',
                                  		 _MI_SCAREER_SHOW_SUBCATS_ALL => 'all');
*/

?>