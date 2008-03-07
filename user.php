<?php
/**
* $Id: user.php,v 1.2 2007/09/28 18:51:14 marcan Exp $
* Module: SmartContent
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

include_once('header.php');
include_once(XOOPS_ROOT_PATH . "/modules/smartobject/class/smartjax.php");

$xoopsOption['template_main'] = 'smartcareer_user.html';
include_once(XOOPS_ROOT_PATH . "/header.php");

$xoTheme->addStylesheet(SMARTCAREER_URL . 'include/internal.css');

$op = '';

if (isset($_GET['op'])) $op = $_GET['op'];
if (isset($_POST['op'])) $op = $_POST['op'];

$smartcareer_user_handler = xoops_getModuleHandler('user');
if (is_object($xoopsUser) && $xoopsUser->isAdmin() && isset($_REQUEST['userid'])){
	$userid = $_REQUEST['userid'];
}
elseif (is_object($xoopsUser)) {
	$userid = $xoopsUser->uid();
} else {
	$userid = 0;
}

if (!$op) $op = 'mod';
switch ($op) {
	case "adduser":
        include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_user_handler);
		$controller->storeFromDefaultForm(_MD_SMARTCAREER_USER_PROFILE_CREATED, _MD_SMARTCAREER_USER_PROFILE_UPDATED, SMARTCAREER_URL.'posting.php');

		break;

	case "del":

	    include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_user_handler);
		$controller->handleObjectDeletionFromUserSide();

		break;

	case "mod":
	case "changedField":

		$userObj = $smartcareer_user_handler->getByUid($userid);

		$userObj->hideFieldFromForm(array('uid', 'comment', 'status'));
		$userObj->showFieldOnForm(array('uname', 'email', 'password', 'password_confirm'));
		$userObj->setVar('uid', $userid);

		if (!$userObj->isNew()) {
			$userObj->makeFieldReadOnly(array('uname', 'email'));
		} else {
			$userObj->hideFieldFromForm(array('uname', 'password', 'password_confirm'));
		}

		if (isset($_POST['op'])) {
			$controller = new SmartObjectController($smartcareer_user_handler);
			$controller->postDataToObject($userObj);

			if ($_POST['op'] == 'changedField') {

				switch($_POST['changedField']) {
					case 'projectid':

					break;
				}
			}
		}

		if (!$userObj->isNew()){
			$sform = $userObj->getForm(_MD_SMARTCAREER_LOG_EDIT, 'adduser');
			$sform->assign($xoopsTpl);
			$xoopsTpl->assign('categoryPath', '<a href="user.php">' . _MD_SMARTCAREER_LOG_MYLOG . '</a> > ' . _MD_SMARTCAREER_LOG_EDIT);
			$xoopsTpl->assign('edit_page', 1);
		} else {
			$userObj->setVar('status', 1);
			$sform = $userObj->getForm(_MD_SMARTCAREER_LOG_CREATE, 'adduser');
			$xoopsTpl->assign('categoryPath', _MD_SMARTCAREER_LOG_CREATE);
			$xoopsTpl->assign('create_page', 1);
			$sform->assign($xoopsTpl);
		}



		break;
}

$xoopsTpl->assign('module_home', smart_getModuleName(true, true));

include_once("footer.php");
?>