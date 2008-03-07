<?php
include_once('header.php');

$xoopsOption['template_main'] = 'smartcareer_posting.html';
include_once(XOOPS_ROOT_PATH . "/header.php");

$xoTheme->addStylesheet(SMARTCAREER_URL . 'include/internal.css');

$op = '';

if (isset($_GET['op'])) $op = $_GET['op'];
if (isset($_POST['op'])) $op = $_POST['op'];

$smartcareer_posting_handler = xoops_getModuleHandler('posting');
$postingid = isset($_GET['postingid']) ? intval($_GET['postingid']) : 0 ;

if ($postingid) {
	$postingObj = $smartcareer_posting_handler->get($postingid);
	$xoopsTpl->assign('smartcareer_posting', $postingObj->toArray());
	$xoopsTpl->assign('smartcareer_posting_requirements', $postingObj->getRequirements(true));
	$xoopsTpl->assign('mid', $xoopsModule->getVar('mid'));
	//$xoopsTpl->assign('categoryPath', '<a href="posting.php">' . _MD_SMARTCAREER_POSTING_LISTING . '</a>' . $postingObj->getVar('title'));
	if(is_object($xoopsUser)){
		$smartcareer_user_handler = xoops_getModuleHandler('user');
		$user = $smartcareer_user_handler->getByUid($xoopsUser->getVar('uid'));
		$xoopsTpl->assign('applied',$user->hasApplied($postingid));
	}

}
include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";

$criteria = new CriteriaCompo();
$criteria->add(new Criteria('posting_date', time(), '<'));
$criteria->add(new Criteria('closing_date', time(), '>'));
$criteria->add(new Criteria('status', 1));
if(isset($_GET['posting_sortsel']) && $_GET['posting_sortsel'] == 'date'){
	$criteria->setSort('date');
	$criteria->setOrder($_GET['posting_ordersel']);
	$SortedPostingObjs = $smartcareer_posting_handler->getObjects($criteria);
}else{
	$postingObjs = $smartcareer_posting_handler->getObjects($criteria, 1);
	//$sortVal = $_GET['posting_sortsel'] == 'departmentid' ? $smartcareer_posting_handler->getDepartmentArray() : $smartcareer_posting_handler->getAreaArray();
	foreach($postingObjs as $postingObj){
		$sortArray[$postingObj->id()] = $postingObj->getVar($_GET['posting_sortsel']);
	}
	$_GET['posting_ordersel'] == 'ASC' ? asort($sortArray) : arsort($sortArray) ;
	foreach($sortArray as $key => $sortVal){
		$SortedPostingObjs[] = $postingObjs[$key];
	}
}

$objectTable = new SmartObjectTable($smartcareer_posting_handler, false, array());
$objectTable->setObjects($SortedPostingObjs);
$objectTable->isForUserSide();
$objectTable->hideFilterAndLimit();

$objectTable->addColumn(new SmartObjectColumn('departmentid'));
$objectTable->addColumn(new SmartObjectColumn('areaid'), 'left', 200);
$objectTable->addColumn(new SmartObjectColumn('title', 'left'));
$objectTable->addColumn(new SmartObjectColumn('posting_date', 'center', 100));
$objectTable->addColumn(new SmartObjectColumn('closing_date', 'center', 100));
//$objectTable->addQuickSearch(array('subject', 'body'));

$objectTable->disableColumnsSorting();
$objectTable->setCustomTemplate('smartcareer_posting_table.html');

$xoopsTpl->assign('smartcareer_postings', $objectTable->fetch());
$xoopsTpl->assign('smartcareer_dyn_css', 'th#smartcareer_posting_sort_' . $objectTable->_sortsel . ' {background-color: #ae0029;}');

$xoopsTpl->assign('categoryPath', _MD_SMARTCAREER_POSTING_LISTING);

$xoopsTpl->assign('module_home', smart_getModuleName(true, true));
include_once("footer.php");
?>