<?php

/**
* $Id$
* Module: SmartCareer
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

function editapplication($showmenu = false, $applicationid = 0, $parentid =0)
{
	global $smartcareer_application_handler;

	$smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');

	$applicationObj = $smartcareer_application_handler->get($applicationid);

	if (!$applicationObj->isNew()){

		if ($showmenu) {
			smart_adminMenu(0, _AM_SCAREER_APPLICATIONS . " > " . _CO_SOBJECT_EDITING);
		}
		smart_collapsableBar('applicationedit', _AM_SCAREER_APPLICATION_EDIT, _AM_SCAREER_APPLICATION_EDIT_INFO);

		$applicationObj->makeFieldReadOnly('postingid');

		$sform = $applicationObj->getForm(_AM_SCAREER_APPLICATION_EDIT, 'addapplication');
		$sform->display();
		smart_close_collapsable('applicationedit');
	} else {
		if ($showmenu) {
			smart_adminMenu(0, _AM_SCAREER_APPLICATIONS . " > " . _CO_SOBJECT_CREATINGNEW);
		}

		if (isset($_POST['op'])) {
			$controller = new SmartObjectController($smartcareer_application_handler);
			$controller->postDataToObject($applicationObj);

			if ($_POST['op'] == 'changedField') {

				switch($_POST['changedField']) {
					case 'postingid':
					break;
				}
			}
		}

		if ($applicationObj->getVar('postingid', 'e') == 0) {
			$applicationObj->hideFieldFromForm(array('application_date', 'userid', 'related_experience', 'status'));
		}


		smart_collapsableBar('applicationcreate', _AM_SCAREER_APPLICATION_CREATE, _AM_SCAREER_APPLICATION_CREATE_INFO);
		$sform = $applicationObj->getForm(_AM_SCAREER_APPLICATION_CREATE, 'addapplication');
		$sform->display();
		smart_close_collapsable('applicationcreate');
	}
}

include_once("admin_header.php");
include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";

$smartcareer_application_handler = xoops_getModuleHandler('application');

$op = '';

if (isset($_GET['op'])) $op = $_GET['op'];
if (isset($_POST['op'])) $op = $_POST['op'];

$applicationid = isset($_GET['applicationid']) ? intval($_GET['applicationid']) : 0 ;

switch ($op) {
	case "mod":
	case "changedField":

		smart_xoops_cp_header();

		editapplication(true, $applicationid);
		break;


	case "addapplication":
        include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_application_handler);
		$controller->storeFromDefaultForm(_AM_SCAREER_APPLICATION_CREATED, _AM_SCAREER_APPLICATION_MODIFIED);

		break;

	case "del":
	    include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_application_handler);
		$controller->handleObjectDeletion();

		break;

	case "view" :
		$applicationObj = $smartcareer_application_handler->get($applicationid);

		smart_xoops_cp_header();

		smart_adminMenu(0, _AM_SCAREER_APPLICATION_VIEW . ' > ' . $applicationObj->getVar('name'));

		smart_collapsableBar('applicationview', $applicationObj->getVar('name') . $applicationObj->getEditItemLink(), _AM_SCAREER_APPLICATION_VIEW_DSC);

		$applicationObj->displaySingleObject();

		//afficher les reqs
		$application_requirementsObj = $applicationObj->getApplication_requirements();
		$smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');
		echo "<br/><br/><table class='outer'>";
		echo "<th colspan='2'>"._CO_SMARTCAREER_POSTING_REQUIREMENTS."</th>";
		foreach($application_requirementsObj as $application_requirementObj){
			$requirementObj = $smartcareer_requirement_handler->get($application_requirementObj->getVar('requirementid', 'e'));
			echo "<tr><td class='odd'>".$requirementObj->getVar('name')."</td><td class='even'>";
			echo $application_requirementObj->getVar('value')."</td></tr>";
		}
		echo "</table><br />";

		smart_close_collapsable('applicationview');
		echo "<br>";

		break;

	default:

		smart_xoops_cp_header();

		smart_adminMenu(0, _AM_SCAREER_APPLICATIONS);

		smart_collapsableBar('createdapplications', _AM_SCAREER_APPLICATIONS, _AM_SCAREER_APPLICATIONS_DSC);

		include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";
		$objectTable = new SmartObjectTable($smartcareer_application_handler, false, array('edit', 'delete'));
		$objectTable->addCustomAction('viewApplication');// SMARTOBJECT_URL."images/actions/view_choose.png");
		$objectTable->addColumn(new SmartObjectColumn('application_date', 'left', 150, 'getAdminViewItemLink'));
		$objectTable->addColumn(new SmartObjectColumn('postingid', 'left', false));
		$objectTable->addColumn(new SmartObjectColumn('userid', 'left', 200, 'getUserLink'));
		$objectTable->addColumn(new SmartObjectColumn('related_experience', 'left', 150));
		$objectTable->addColumn(new SmartObjectColumn('relevance', 'center', 100));
		$objectTable->addColumn(new SmartObjectColumn('status', 'center', 100));
//$objectTable->addIntroButton('mod', 'application.php?op=mod', _AM_SCAREER_POSTING_CREATE);

		$objectTable->addFilter('postingid', 'getPostingList');
		$objectTable->addFilter('status', 'getStatusArray');

		//$objectTable->addQuickSearch(array('subject', 'body'));

		$objectTable->render();

		echo "<br />";
		smart_close_collapsable('createdapplications');
		echo "<br>";

		break;
}

smart_modFooter();
xoops_cp_footer();

?>