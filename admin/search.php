<?php
include_once("admin_header.php");
smart_xoops_cp_header();

smart_adminMenu(3, _AM_SCAREER_SEARCH );

smart_collapsableBar('searchrequirements', _AM_SCAREER_SEARCH_REQUIREMENTS, _AM_SCAREER_SEARCH_REQUIREMENTS_INFO);

include_once XOOPS_ROOT_PATH . '/class/template.php';
$xoopsTpl =& new XoopsTpl();
$keyword = isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != '' ? $_REQUEST['keyword'] : '';
$cote = isset($_REQUEST['cote']) && $_REQUEST['cote'] != '' ? $_REQUEST['cote'] : 0;
$keywords_array = explode(' ', $keyword);


if ($keyword != '') {
	$smartcareer_application_requirement_handler = xoops_getModuleHandler('application_requirement');
	$smartcareer_application_requirement_handler->setGeneralSQLForSearch();
	include_once SMARTOBJECT_ROOT_PATH."class/smartobjecttable.php";
	$criteria = new CriteriaCompo();

	foreach ($keywords_array as $keyword_elt) {
		if($keyword_elt != ''){
			$criteria->add(new Criteria('name', '%'.$keyword_elt.'%', 'LIKE'), 'OR');
			$criteria->add(new Criteria('type', 2), 'AND');
			$criteria->add(new Criteria('value', 1), 'AND');
		}
	}
	foreach ($keywords_array as $keyword_elt) {
		if($keyword_elt != ''){
			$criteria->add(new Criteria('name', '%'.$keyword_elt.'%', 'LIKE'), 'OR');
			$criteria->add(new Criteria('type', 1), 'AND');
			$criteria->add(new Criteria('value', $cote, '>='), 'AND');
		}
	}


	$criteria->setSort('name');
	$criteria->setOrder('ASC');
	$objectTable = new SmartObjectTable($smartcareer_application_requirement_handler, $criteria, array());
	$objectTable-> addExtraParams(array('keyword' => $keyword, 'cote' => $cote));
	$objectTable->addColumn(new SmartObjectColumn('application_date', 'left'));
	$objectTable->addColumn(new SmartObjectColumn('userid', 'left'));
	$objectTable->addColumn(new SmartObjectColumn('postingid', 'left'));
	$objectTable->addColumn(new SmartObjectColumn('applicationid', 'left'));
	$objectTable->addColumn(new SmartObjectColumn('requirementid', 'left'));
	$objectTable->addColumn(new SmartObjectColumn('value', 'left'));


	$xoopsTpl->assign('table', $objectTable->fetch());
}
$sform = new XoopsThemeForm(_AM_SCAREER_SEARCH, "form", xoops_getenv('PHP_SELF'));
$keyword_text = new XoopsFormText(_AM_SCAREER_KEYWORD, 'keyword', 50, 255, $keyword);
$sform -> addElement( $keyword_text );
$cote_text = new XoopsFormText(_AM_SCAREER_SEARCH_MIN, 'cote', 2, 2, $cote);
$sform -> addElement( $cote_text );
$butt_create = new XoopsFormButton('', '', _AM_SCAREER_SUBMIT, 'submit');
$sform->addElement($butt_create);

$sform->assign($xoopsTpl);

$xoopsTpl->display( 'db:smartcareer_search.html' );

smart_close_collapsable('searchrequirements');

smart_modFooter();
xoops_cp_footer();

?>