<?php

if (!defined("XOOPS_ROOT_PATH")) {
 	die("XOOPS root path not defined");
}

global $modversion;
if( ! empty( $_POST['fct'] ) && ! empty( $_POST['op'] ) && $_POST['fct'] == 'modulesadmin' && $_POST['op'] == 'update_ok' && $_POST['dirname'] == $modversion['dirname'] ) {
	// referer check
	$ref = xoops_getenv('HTTP_REFERER');
	if( $ref == '' || strpos( $ref , XOOPS_URL.'/modules/system/admin.php' ) === 0 ) {
		/* module specific part */



		/* General part */

		// Keep the values of block's options when module is updated (by nobunobu)
		include dirname( __FILE__ ) . "/updateblock.inc.php" ;

	}
}

// this needs to be the latest db version
define('SMARTCAREER_DB_VERSION', 2);

function smartcareer_db_upgrade_1() {
	xoops_debug('executing db upgrade 1');
}
function smartcareer_db_upgrade_2() {
	xoops_debug('executing db upgrade 2');
}

function xoops_module_update_smartcareer($module) {

	include_once(XOOPS_ROOT_PATH . "/modules/smartobject/class/smartdbupdater.php");
	$dbupdater = new SmartobjectDbupdater();
	$dbupdater->moduleUpgrade($module);
    return true;
}

function xoops_module_install_smartcareer($module) {

    ob_start();

	include_once(XOOPS_ROOT_PATH . "/modules/" . $module->getVar('dirname') . "/include/functions.php");

	//smartcareer_create_upload_folders();

    $feedback = ob_get_clean();
    if (method_exists($module, "setMessage")) {
        $module->setMessage($feedback);
    }
    else {
        echo $feedback;
    }

	return true;
}


?>