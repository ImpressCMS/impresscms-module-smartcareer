<?php
include_once('header.php');

$xoopsOption['template_main'] = 'smartcareer_message.html';
include_once(XOOPS_ROOT_PATH . "/header.php");

$smartcareer_message_handler = xoops_getModuleHandler('message');
$smartcareer_list_handler = xoops_getModuleHandler('list');

$op = '';

if (isset($_GET['op'])) $op = $_GET['op'];
if (isset($_POST['op'])) $op = $_POST['op'];

$smartcareer_message_handler = xoops_getModuleHandler('message');
$messageid = isset($_GET['messageid']) ? intval($_GET['messageid']) : 0 ;

if ($messageid) {
	$op = 'view';
}

switch ($op) {
	case "view" :
		$messageObj = $smartcareer_message_handler->get($messageid);

		$xoopsTpl->assign('smartcareer_message', $messageObj->toArray());
		$xoopsTpl->assign('categoryPath', '<a href="message.php">' . _MD_SCAREER_MESSAGES_HISTORY . '</a> > ' . $messageObj->getVar('subject'));

		break;

	default:

		include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";

		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('archived', 1));
		$criteria->add(new Criteria('status', SMARTCAREER_MESSAGE_STATUS_SENT));

		$objectTable = new SmartObjectTable($smartcareer_message_handler, $criteria, array());
		$objectTable->isForUserSide();

		$objectTable->addColumn(new SmartObjectColumn('date', 'center', 200));
		$objectTable->addColumn(new SmartObjectColumn('subject'));

		$objectTable->addQuickSearch(array('subject', 'body'));

		$xoopsTpl->assign('smartcareer_messages', $objectTable->fetch());
		$xoopsTpl->assign('categoryPath', _MD_SCAREER_MESSAGES_HISTORY);

		break;
}
$xoopsTpl->assign('module_home', smart_getModuleName(false, true));
include_once("footer.php");
?>