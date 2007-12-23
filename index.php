<?php
include_once('header.php');

if (!is_object($xoopsUser)) {
	redirect_header(XOOPS_URL . '/user.php', 3, _MD_SCAREER_NEEDTOBECONNECTED);
	exit;
}

$xoopsOption['template_main'] = 'smartcareer_index.html';
include_once(XOOPS_ROOT_PATH . "/header.php");

$op = isset($_POST['op']) ? $_POST['op'] : 'default';
$uid = $xoopsUser->uid();

$smartcareer_user_handler = xoops_getModuleHandler('user');
$smartcareer_list_handler = xoops_getModuleHandler('list');

switch ($op) {
	case 'smartcareer_list_submit':
		$smartcareer_user_handler->deleteListsByUid($uid);

		if (isset($_POST['smartcareer_selected_lists'])) {
			foreach($_POST['smartcareer_selected_lists'] as $listid) {
				$smartcareer_user_handler->addUserToList($uid, $listid);
			}
		}
		redirect_header(SMARTCAREER_URL, 2, _MD_SCAREER_LISTS_UPDATED);
		exit;

	break;

	default:
		$aLists = $smartcareer_list_handler->getObjects(null, true, false);

		$aSubscribedList = $smartcareer_user_handler->getListidsForUid($uid);
		$xoopsTpl->assign('smartcareer_subscribedlists', $aSubscribedList);

		$xoopsTpl->assign('smartcareer_lists', $aLists);
		$xoopsTpl->assign('module_home', smart_getModuleName(false, true));
	break;
}

include_once("footer.php");
?>