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

$xoopsTpl->assign("smartcareer_adminpage", smart_getModuleAdminLink());
$xoopsTpl->assign("isAdmin", $smartcareer_isAdmin);
$xoopsTpl->assign('smartcareer_url', SMARTCAREER_URL);
$xoopsTpl->assign('smartcareer_images_url', SMARTCAREER_IMAGES_URL);

$xoTheme->addStylesheet(SMARTCAREER_URL . 'module.css');

$xoopsTpl->assign("ref_smartfactory", "SmartCareer is developed by The SmartFactory (http://smartfactory.ca), a division of INBOX International (http://inboxinternational.com)");

include_once(XOOPS_ROOT_PATH . '/footer.php');

?>