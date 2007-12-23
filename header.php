<?php

/**
* $Id$
* Module: SmartCareer
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

include_once "../../mainfile.php";

if( !defined("SMARTCAREER_DIRNAME") ){
	define("SMARTCAREER_DIRNAME", 'smartcareer');
}

include_once XOOPS_ROOT_PATH.'/modules/' . SMARTCAREER_DIRNAME . '/include/common.php';
smart_loadCommonLanguageFile();

include_once SMARTCAREER_ROOT_PATH . "include/functions.php";
?>