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

if( !defined("SMARTCAREER_DIRNAME") ){
	define("SMARTCAREER_DIRNAME", 'smartcareer');
}

if( !defined("SMARTCAREER_URL") ){
	define("SMARTCAREER_URL", XOOPS_URL.'/modules/'.SMARTCAREER_DIRNAME.'/');
}
if( !defined("SMARTCAREER_ROOT_PATH") ){
	define("SMARTCAREER_ROOT_PATH", XOOPS_ROOT_PATH.'/modules/'.SMARTCAREER_DIRNAME.'/');
}

if( !defined("SMARTCAREER_IMAGES_URL") ){
	define("SMARTCAREER_IMAGES_URL", SMARTCAREER_URL.'images/');
}

if( !defined("SMARTCAREER_ADMIN_URL") ){
	define("SMARTCAREER_ADMIN_URL", SMARTCAREER_URL.'admin/');
}

/** Include SmartObject framework **/
include_once XOOPS_ROOT_PATH.'/modules/smartobject/class/smartloader.php';

/*
 * Including the common language file of the module
 */
$fileName = SMARTCAREER_ROOT_PATH . 'language/' . $GLOBALS['xoopsConfig']['language'] . '/common.php';
if (!file_exists($fileName)) {
	$fileName = SMARTCAREER_ROOT_PATH . 'language/english/common.php';
}

include_once($fileName);

include_once(SMARTCAREER_ROOT_PATH . "include/functions.php");

// Creating the SmartModule object
$smartcareerModule =& smart_getModuleInfo(SMARTCAREER_DIRNAME);

// Find if the user is admin of the module
$smartcareer_isAdmin = smart_userIsAdmin(SMARTCAREER_DIRNAME);

$myts = MyTextSanitizer::getInstance();
if(is_object($smartcareerModule)){
	$smartcareer_moduleName = $smartcareerModule->getVar('name');
}

// Creating the SmartModule config Object
$smartcareerConfig =& smart_getModuleConfig(SMARTCAREER_DIRNAME);

include_once(SMARTCAREER_ROOT_PATH . "class/list.php");
include_once(SMARTCAREER_ROOT_PATH . "class/user.php");
include_once(SMARTCAREER_ROOT_PATH . "class/recipient.php");
include_once(SMARTCAREER_ROOT_PATH . "class/message.php");

?>