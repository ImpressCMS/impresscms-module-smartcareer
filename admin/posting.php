<?php

/**
* $Id$
* Module: SmartCareer
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

function editposting($showmenu = false, $postingid = 0, $parentid =0)
{
	global $smartcareer_posting_handler;

	$postingObj = $smartcareer_posting_handler->get($postingid);
	if ($postingObj->getVar('published') != 1){
		$postingObj->hideFieldFromForm('status');
	}
	$postingObj->hideFieldFromForm('published');
	if (!$postingObj->isNew()){

		if ($showmenu) {
			smart_adminMenu(1, _AM_SCAREER_POSTINGS . " > " . _CO_SOBJECT_EDITING);
		}
		smart_collapsableBar('postingedit', _AM_SCAREER_POSTING_EDIT, _AM_SCAREER_POSTING_EDIT_INFO);

		$sform = $postingObj->getForm(_AM_SCAREER_POSTING_EDIT, 'addposting');
		if ($postingObj->getVar('published') == 0){
			$sform->addCustomButton('publish',_AM_SCAREER_POSTING_PUBLISH , "this.form.elements.op.value='publish'");
		}
		$sform->display();
		smart_close_collapsable('postingedit');
	} else {
		if ($showmenu) {
			smart_adminMenu(1, _AM_SCAREER_POSTINGS . " > " . _CO_SOBJECT_CREATINGNEW);
		}
		$postingObj->setVar('closing_date', time()+3600*24*30);
		smart_collapsableBar('postingcreate', _AM_SCAREER_POSTING_CREATE, _AM_SCAREER_POSTING_CREATE_INFO);
		$sform = $postingObj->getForm(_AM_SCAREER_POSTING_CREATE, 'addposting');
		$sform->addCustomButton('publish',_AM_SCAREER_POSTING_PUBLISH , "this.form.elements.op.value='publish'");
		$sform->display();
		smart_close_collapsable('postingcreate');
	}
}

include_once("admin_header.php");
include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";

$smartcareer_posting_handler = xoops_getModuleHandler('posting');

$op = '';

if (isset($_GET['op'])) $op = $_GET['op'];
if (isset($_POST['op'])) $op = $_POST['op'];

$postingid = isset($_GET['postingid']) ? intval($_GET['postingid']) : 0 ;

switch ($op) {
	case "mod":
	case "changedField":

		smart_xoops_cp_header();

		editposting(true, $postingid);
		break;
	case "publish":
	case "addposting":
        include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_posting_handler);
		$controller->storeFromDefaultForm(_AM_SCAREER_POSTING_CREATED, _AM_SCAREER_POSTING_MODIFIED);

		break;

	case "del":
	    include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_posting_handler);
		$controller->handleObjectDeletion();

		break;

	case "view" :
		$postingObj = $smartcareer_posting_handler->get($postingid);

		smart_xoops_cp_header();

		smart_adminMenu(1, _AM_SCAREER_POSTING_VIEW . ' > ' . $postingObj->getVar('name'));

		smart_collapsableBar('postingview', $postingObj->getVar('name') . $postingObj->getEditItemLink(), _AM_SCAREER_POSTING_VIEW_DSC);
		$postingObj->doHideFieldFromSingleView('published');
		$postingObj->displaySingleObject();

		echo "<br />";
		smart_close_collapsable('postingview');
		echo "<br>";

		break;

	default:

		smart_xoops_cp_header();

		smart_adminMenu(1, _AM_SCAREER_POSTINGS);

		smart_collapsableBar('createdpostings', _AM_SCAREER_POSTINGS, _AM_SCAREER_POSTINGS_DSC);

		include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";
		$objectTable = new SmartObjectTable($smartcareer_posting_handler);
		$objectTable->addColumn(new SmartObjectColumn('posting_date', 'left', 150));
		$objectTable->addColumn(new SmartObjectColumn('title'));
		$objectTable->addColumn(new SmartObjectColumn('departmentid', 'left', 200));
		$objectTable->addColumn(new SmartObjectColumn('areaid', 'left', 200));
		$objectTable->addColumn(new SmartObjectColumn('status', 'center', 200));

		$objectTable->addIntroButton('addposting', 'posting.php?op=mod', _AM_SCAREER_POSTING_CREATE);

		$objectTable->addQuickSearch(array('subject', 'body'));

		$objectTable->render();

		echo "<br />";
		smart_close_collapsable('createdpostings');
		echo "<br>";

		break;
}

smart_modFooter();
xoops_cp_footer();

?>