<?php
include_once("admin_header.php");
smart_xoops_cp_header();

smart_adminMenu(4, _AM_SCAREER_STATS );

include_once XOOPS_ROOT_PATH . '/class/template.php';
$xoopsTpl =& new XoopsTpl();

$start = isset($_REQUEST['start']) && $_REQUEST['start'] != '' ? strtotime($_REQUEST['start']) : 0;
$end = isset($_REQUEST['end']) && $_REQUEST['end'] != '' ? strtotime($_REQUEST['end']) : 0;

$smartcareer_application_handler = xoops_getModuleHandler('application');

$byPost = $smartcareer_application_handler->getApplicationByPosting($start, $end);
$byDept = $smartcareer_application_handler->getApplicationByDept($start, $end);
$byArea = $smartcareer_application_handler->getApplicationByArea($start, $end);
$bySource = $smartcareer_application_handler->getApplicationBySource($start, $end);
if(empty($byPost)){
	$xoopsTpl->assign('no_app', true);
}else{
	$xoopsTpl->assign('byPost', $byPost);
	$xoopsTpl->assign('byDept', $byDept);
	$xoopsTpl->assign('byArea', $byArea);
	$xoopsTpl->assign('bySource', $bySource);
}
$sform = new XoopsThemeForm(_AM_SCAREER_FILTER_DATE, "form", xoops_getenv('PHP_SELF'));

// Date start
$start_time = $start != 0 ? $start : (time() - 365*24*3600);
$date_start = new XoopsFormTextDateSelect(_AM_SCAREER_DATE_START, 'start', $size = 15, $start_time);
$sform -> addElement( $date_start );

// Datesub
$end_time = $end != 0 ? $end : time();
$date_end = new XoopsFormTextDateSelect(_AM_SCAREER_DATE_END, 'end', $size = 15,$end_time);
$sform -> addElement( $date_end );

//$button_tray = new XoopsFormElementTray('', '');
$butt_create = new XoopsFormButton('', '', _AM_SCAREER_SUBMIT, 'submit');
//$button_tray->addElement($butt_create);

$sform->addElement($butt_create);

$sform->assign($xoopsTpl);

$xoopsTpl->display( 'db:smartcareer_stats.html' );

smart_modFooter();
xoops_cp_footer();

?>