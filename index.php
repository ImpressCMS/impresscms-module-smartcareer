<?php
include_once('header.php');

$xoopsOption['template_main'] = 'smartcareer_index.html';
include_once(XOOPS_ROOT_PATH . "/header.php");

$xoTheme->addStylesheet('li a#carriere{background-color: #ae0029;');

$xoopsTpl->assign('smartcareer_index_text', $myts->displayTarea($xoopsModuleConfig['index_text'], true));

$xoopsTpl->assign('smartcareer_module_name', $smartcareer_moduleName);
$xoopsTpl->assign('smartcareer_index_template', 'db:smartcareer_index_' . $xoopsConfig['language'] . '.html');

include_once("footer.php");
?>