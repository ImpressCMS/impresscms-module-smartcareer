<?php
include_once('header.php');

$xoopsOption['template_main'] = 'smartcareer_apply.html';
include_once(XOOPS_ROOT_PATH . "/header.php");


$smartcareer_posting_handler = xoops_getModuleHandler('posting');
$smartcareer_application_handler = xoops_getModuleHandler('application');

$op = '';

if (isset($_GET['op'])) $op = $_GET['op'];
if (isset($_POST['op'])) $op = $_POST['op'];

$postingid = isset($_GET['postingid']) ? intval($_GET['postingid']) : 0 ;
$postingid = isset($_POST['postingid']) ? intval($_POST['postingid']) : $postingid ;

if ($op == 'addapplication' && $postingid) {
		$smartcareer_application_handler->addEventHook('beforeInsert', 'customBeforeInsert');
        include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobjectcontroller.php";
        $controller = new SmartObjectController($smartcareer_application_handler);
		$controller->storeFromDefaultForm(_MD_SMARTCAREER_APPLY_SUBMITTED, false, 'posting.php');
}

if (!$postingid) {
	redirect_header('posting.php', 3, _NOPERM);
	exit;
}
$smartcareer_user_handler = xoops_getModuleHandler('user');
if (is_object($xoopsUser)) {
	$userid = $xoopsUser->uid();
} else {
	redirect_header('posting.php', 3, _NOPERM);
	exit;
}

$userObj = $smartcareer_user_handler->getByUid($userid);

$postingObj = $smartcareer_posting_handler->get($postingid);

$requirementsObj = $postingObj->getRequirements();
$requirementsArray = array();
foreach($requirementsObj as $requirementObj) {
	$requirementsArray[$requirementObj->id()] = $requirementObj->toArray();
}
$xoopsTpl->assign('smartcareer_application_requirements', $requirementsArray);
$xoopsTpl->assign('userid', $userObj->id());
$xoopsTpl->assign('smartcareer_application_postingid', $postingid);
$xoopsTpl->assign('smartcareer_application_related_experience', $smartcareer_application_handler->getRelated_experienceArray());
$xoopsTpl->assign('smartcareer_application_source', $smartcareer_application_handler->getSourceArray());
$xoopsTpl->assign('smartcareer_posting', $postingObj->toArray());
$xoopsTpl->assign('smartcareer_posting_requirements', $postingObj->getRequirements(true));
$xoopsTpl->assign('categoryPath', '<a href="posting.php">' . _MD_SMARTCAREER_POSTING_LISTING . '</a>');

$xoopsTpl->assign('module_home', smart_getModuleName(true, true));
include_once("footer.php");
?>