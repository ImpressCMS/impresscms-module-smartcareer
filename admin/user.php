<?php

/**
* $Id$
* Module: SmartCareer
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

function edituser($showmenu = false, $userid = 0, $parentid =0)
{
	global $smartcareer_user_handler;

	$userObj = $smartcareer_user_handler->get($userid);

	if (!$userObj->isNew()){

		if ($showmenu) {
			smart_adminMenu(2, _AM_SCAREER_USERS . " > " . _CO_SOBJECT_EDITING);
		}

		smart_collapsableBar('createdapplications', _AM_SCAREER_APPLICATIONS, _AM_SCAREER_APPLICATIONS_DSC);
		$smartcareer_application_handler = xoops_getModuleHandler('application');
		include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('userid', $userid));
		$objectTable = new SmartObjectTable($smartcareer_application_handler, $criteria, array('edit', 'delete'));
		$objectTable->addCustomAction('viewApplication');
		$objectTable->addColumn(new SmartObjectColumn('application_date', 'left', 150, 'getAdminViewItemLink'));
		$objectTable->addColumn(new SmartObjectColumn('postingid', 'left', false));
		$objectTable->addColumn(new SmartObjectColumn('userid', 'left', 200, 'getUserLink'));
		$objectTable->addColumn(new SmartObjectColumn('related_experience', 'left', 150));
		$objectTable->addColumn(new SmartObjectColumn('comment', 'left', 250));
		$objectTable->addColumn(new SmartObjectColumn('relevance', 'center', 100));
		$objectTable->addColumn(new SmartObjectColumn('status', 'center', 100));


		$objectTable->render();

		echo "<br />";
		smart_close_collapsable('createdapplications');

		smart_collapsableBar('useredit', _AM_SCAREER_USER_EDIT, _AM_SCAREER_USER_EDIT_INFO);

		$sform = $userObj->getForm(_AM_SCAREER_USER_EDIT, 'adduser');
		$sform->display();
		smart_close_collapsable('useredit');


		echo "<br>";


	} else {
		if ($showmenu) {
			smart_adminMenu(2, _AM_SCAREER_USERS . " > " . _CO_SOBJECT_CREATINGNEW);
		}

		smart_collapsableBar('usercreate', _AM_SCAREER_USER_CREATE, _AM_SCAREER_USER_CREATE_INFO);
		$sform = $userObj->getForm(_AM_SCAREER_USER_CREATE, 'adduser');
		$sform->display();
		smart_close_collapsable('usercreate');


	}
}

include_once("admin_header.php");
include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";

$smartcareer_user_handler = xoops_getModuleHandler('user');

$op = '';

if (isset($_GET['op'])) $op = $_GET['op'];
if (isset($_POST['op'])) $op = $_POST['op'];

$userid = isset($_GET['userid']) ? intval($_GET['userid']) : 0 ;

switch ($op) {
	case "mod":
	case "changedField":

		smart_xoops_cp_header();

		edituser(true, $userid);
		break;


	case "adduser":
        include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_user_handler);
		$controller->storeFromDefaultForm(_AM_SCAREER_USER_CREATED, _AM_SCAREER_USER_MODIFIED);

		break;

	case "del":
	    include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_user_handler);
		$controller->handleObjectDeletion();

		break;

	case "view" :
		$userObj = $smartcareer_user_handler->get($userid);

		smart_xoops_cp_header();

		smart_adminMenu(2, _AM_SCAREER_USER_VIEW . ' > ' . $userObj->getVar('name'));

		smart_collapsableBar('userview', $userObj->getVar('firstname').'&nbsp;'. $userObj->getVar('lastname') .'&nbsp;'. $userObj->getEditItemLink(), _AM_SCAREER_USER_VIEW_DSC);

		$userObj->hideFieldFromSingleView(array('password', 'password_confirm', 'section_personnal_info', 'section_notif', 'notif_area', 'notif_dept'));
		$userObj->displaySingleObject();

		echo "<br />";

		smart_close_collapsable('userview');
		echo "<br>";
		smart_collapsableBar('createdapplications', _AM_SCAREER_APPLICATIONS, _AM_SCAREER_APPLICATIONS_DSC);
		$smartcareer_application_handler = xoops_getModuleHandler('application');
		include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('userid', $userid));
		$objectTable = new SmartObjectTable($smartcareer_application_handler, $criteria, array('edit', 'delete'));
		$objectTable->addCustomAction('viewApplication');
		$objectTable->addColumn(new SmartObjectColumn('application_date', 'left', 150, 'getAdminViewItemLink'));
		$objectTable->addColumn(new SmartObjectColumn('postingid', 'left', false));
		$objectTable->addColumn(new SmartObjectColumn('userid', 'left', 200, 'getUserLink'));
		$objectTable->addColumn(new SmartObjectColumn('related_experience', 'left', 150));
		$objectTable->addColumn(new SmartObjectColumn('comment', 'left', 250));
		$objectTable->addColumn(new SmartObjectColumn('relevance', 'center', 100));
		$objectTable->addColumn(new SmartObjectColumn('status', 'center', 100));


		$objectTable->render();

		echo "<br />";
		smart_close_collapsable('createdapplications');

		break;

	default:

		smart_xoops_cp_header();

		smart_adminMenu(2, _AM_SCAREER_USERS);

		smart_collapsableBar('createdusers', _AM_SCAREER_USERS, _AM_SCAREER_USERS_DSC);

		include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";
		$objectTable = new SmartObjectTable($smartcareer_user_handler);
		$objectTable->addColumn(new SmartObjectColumn('uname', 'left', 200, 'getUserLink'));
		$objectTable->addColumn(new SmartObjectColumn('lastname'));
		$objectTable->addColumn(new SmartObjectColumn('firstname'));
		$objectTable->addColumn(new SmartObjectColumn('address_city'));
		$objectTable->addColumn(new SmartObjectColumn('phone_home'));

		$objectTable->addIntroButton('adduser', 'user.php?op=mod', _AM_SCAREER_USER_CREATE);

		$objectTable->addQuickSearch(array('uname', 'email', 'lastname', 'firstname', 'highschool_diploma', 'college_diploma', 'university_diploma', 'other_diploma', 'comment', 'address_city', 'address_prov'));

		$objectTable->render();

		echo "<br />";
		smart_close_collapsable('createdusers');
		echo "<br>";

		break;
}

smart_modFooter();
xoops_cp_footer();

?>