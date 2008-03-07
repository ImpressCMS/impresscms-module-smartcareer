<?php
// $Id$
// ------------------------------------------------------------------------ //
// 				 XOOPS - PHP Content Management System                      //
//					 Copyright (c) 2000 XOOPS.org                           //
// 						<http://www.xoops.org/>                             //
// ------------------------------------------------------------------------ //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //

// You may not change or alter any portion of this comment or credits       //
// of supporting developers from this source code or any supporting         //
// source code which is considered copyrighted (c) material of the          //
// original comment or credit authors.                                      //
// This program is distributed in the hope that it will be useful,          //
// but WITHOUT ANY WARRANTY; without even the implied warranty of           //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
// GNU General Public License for more details.                             //

// You should have received a copy of the GNU General Public License        //
// along with this program; if not, write to the Free Software              //
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------ //
// URL: http://www.xoops.org/												//
// Project: The XOOPS Project                                               //
// -------------------------------------------------------------------------//

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobject.php";

define('SMARTCAREER_POSTING_STATUS_ONLINE', 1);
define('SMARTCAREER_POSTING_STATUS_OFFLINE', 2);

class SmartcareerPosting extends SmartObject {

    function SmartcareerPosting(&$handler) {
    	$this->SmartObject($handler);

        $this->quickInitVar('postingid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('departmentid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('areaid', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('title', XOBJ_DTYPE_TXTBOX, true);
		$this->quickInitVar('details', XOBJ_DTYPE_TXTAREA);
		$this->quickInitVar('status', XOBJ_DTYPE_INT, false, false, false, SMARTCAREER_POSTING_STATUS_OFFLINE);
		$this->quickInitVar('posting_date', XOBJ_DTYPE_STIME);
		$this->quickInitVar('closing_date', XOBJ_DTYPE_STIME);
		$this->initNonPersistableVar('requirements', XOBJ_DTYPE_TXTBOX, false, false, false, false, true);
		$this->initCommonVar('counter', false);
		$this->quickInitVar('published', XOBJ_DTYPE_INT);

		$this->setControl('status', array(
											'itemHandler' => 'posting',
                                          	'method' => 'getStatusArray',
                                          	'module' => 'smartcareer'
                                          ));

		$this->setControl('departmentid', array(
											'itemHandler' => 'posting',
                                          	'method' => 'getDepartmentArray',
                                          	'module' => 'smartcareer'
                                          ));
		$this->setControl('areaid', array(
											'itemHandler' => 'posting',
                                          	'method' => 'getAreaArray',
                                          	'module' => 'smartcareer'
                                          ));

		$this->setControl('requirements', 'requirements');
    }

    function getVar($key, $format = 's') {
        if ($format == 's' && in_array($key, array('status', 'departmentid', 'areaid', 'details', 'requirements'))) {
            return call_user_func(array($this,$key));
        }
        return parent::getVar($key, $format);
    }

	function  posting_date() {
		return formatTimeStamp($this->getVar('posting_date', 'n'), 'Y/j/m');
	}

	function  closing_date() {
		return formatTimeStamp($this->getVar('closing_date', 'n'), 'Y/j/m');
	}

    function details() {
		$myts = MyTextSanitizer::getInstance();
		$ret = $this->getVar('details', 'n');
		$ret = $myts->displayTarea($ret, true, true, true, true, false);
		return $ret;
    }

	function requirements() {
		$reqs = $this->getRequirements(true) ;
		foreach($reqs as $req){
			$ret .= $req."<br/>";
		}
		return $ret;
    }

    function getRequirements($asArray=false) {
		$smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');
		$requirementsObj = $smartcareer_requirement_handler->getRequirementsForPosting($this->id());
		if ($asArray) {
			$ret = array();
			foreach($requirementsObj as $requirementObj) {
				$ret[] = $requirementObj->getVar('name');
			}
		} else {
			$ret = $requirementsObj;
		}
		return $ret;
    }

    function areaid() {
    	$smartcareer_posting_handler = xoops_getModuleHandler('posting', 'smartcareer');
    	$ret = $this->getVar('areaid', 'e');
		$areaArray = $smartcareer_posting_handler->getAreaArray();
    	if (isset($areaArray[$ret])) {
    		return $areaArray[$ret];
    	} else {
    		return false;
    	}
    }

    function departmentid() {
    	$smartcareer_posting_handler = xoops_getModuleHandler('posting', 'smartcareer');
    	$ret = $this->getVar('departmentid', 'e');
		$departmentArray = $smartcareer_posting_handler->getDepartmentArray();

    	if (isset($departmentArray[$ret])) {
    		return $departmentArray[$ret];
    	} else {
    		return false;
    	}
    }

    function status() {
    	$smartcareer_posting_handler = xoops_getModuleHandler('posting', 'smartcareer');
    	$ret = $this->getVar('status', 'e');
		$statusArray = $smartcareer_posting_handler->getStatusArray();
    	if (isset($statusArray[$ret])) {
    		return $statusArray[$ret];
    	} else {
    		return false;
    	}
    }
    function sendNotification(){
		global $xoopsConfig;
		$smartcareer_user_handler = xoops_getModuleHandler('user', 'smartcareer');
    	$users = $smartcareer_user_handler->getObjects();
    	foreach($users as $user){
    		if((in_array($this->getVar('areaid', 'e'), $user->getVar('notif_area'))	|| in_array('all', $user->getVar('notif_area')))
    		&& (in_array($this->getVar('departmentid', 'e'), $user->getVar('notif_dept')) || in_array('all', $user->getVar('notif_dept')))){
    			$eArray[] = $user->getVar('email');
    		}
    	}
		$xoopsMailer =& getMailer();
		$xoopsMailer->setToEmails($eArray);
		$xoopsMailer->setTemplateDir(SMARTCAREER_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/mail_template/');
		$xoopsMailer->setTemplate('smartcareer_notify_new_posting.tpl');
		$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
		$xoopsMailer->setFromName($xoopsConfig['sitename']);
		$xoopsMailer->setSubject(_CO_SMARTCAREER_NEW_POSTING_SUBJECT);
		//$xoopsMailer->multimailer->IsHTML(true);
		$xoopsMailer->assign('SITENAME', $xoopsConfig['sitename']);
		$xoopsMailer->assign('TITLE', $this->getVar('title'));
		$xoopsMailer->assign('DEPT', $this->getVar('departmentid'));
		$xoopsMailer->assign('AREA', $this->getVar('areaid'));
		$xoopsMailer->assign('LINK', SMARTCAREER_URL.'posting.php?postingid='.$this->getVar('postingid'));
		$xoopsMailer->send();

		unset($xoopsMailer);

    }
}
class SmartcareerPostingHandler extends SmartPersistableObjectHandler {

    var $_statusArray=false;
    var $_departmentArray=false;
    var $_areaArray=false;

    function SmartcareerPostingHandler($db) {
        $this->SmartPersistableObjectHandler($db, 'posting', 'postingid', 'title', '', 'smartcareer');
    }

    function getPostingsList() {
		$postingsArray = $this->getList();
		$ret = array(0 => '---');
		foreach($postingsArray as $k => $v) {
			$ret[$k] = $v;
		}
		return $ret;
    }

    function getStatusArray() {
		if (!$this->_statusArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/posting_status.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			asort($ret);
			$this->_statusArray = $ret;
		}
		return $this->_statusArray;
    }

    function getDepartmentArray() {
		if (!$this->_departmentArray) {
			$ret = include(SMARTCAREER_ROOT_PATH . '/include/posting_department.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			asort($ret);
			$this->_departmentArray = $ret;
		}
		return $this->_departmentArray;
    }

    function getAreaArray() {
		if (!$this->_areaArray) {
			$ret = include(SMARTCAREER_ROOT_PATH . '/include/posting_area.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			asort($ret);
			$this->_areaArray = $ret;
		}
		return $this->_areaArray;
    }

    function afterInsert(&$obj) {
    	$smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');

    	$requirementsArray = $_POST['requirements'];
    	foreach($requirementsArray as $k=>$v) {
			$requirementObj = $smartcareer_requirement_handler->create();
			$requirementObj->setVar('postingid', $obj->id());
			$requirementObj->setVar('name', $v);
			$mandatory =  isset($_POST['requirement_mandatory_' . $k]) ? $_POST['requirement_mandatory_' . $k] : 0;
			$requirementObj->setVar('mandatory',$mandatory);
			if($mandatory){
				$requirementObj->setVar('type',SMARTCAREER_REQUIREMENT_TYPE_YN);
			}else{
				$requirementObj->setVar('type', isset($_POST['requirement_type_' . $k]) ? $_POST['requirement_type_' . $k] : SMARTCAREER_REQUIREMENT_TYPE_YN);
			}
			$smartcareer_requirement_handler->insert($requirementObj);
    	}
		return true;
    }

    function afterUpdate(&$obj) {
    	$smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');
    	$requirementsArray = $_POST['requirements'];
    	foreach($requirementsArray as $k=>$v) {
    		$requirementid = $k;

    		if (strpos($k, 'new_')) {
				// then this is a new requirement
				$requirementObj = $smartcareer_requirement_handler->create();
    		} else {
    			// requirement exists, let's find it
    			$requirementObj = $smartcareer_requirement_handler->get($requirementid);
    		}
    		if(isset($_POST['requirement_delete_' . $k]) && $_POST['requirement_delete_' . $k] == 'delete'){
				$smartcareer_requirement_handler->delete($requirementObj);
    		}else{
				$requirementObj->setVar('postingid', $obj->id());
				$requirementObj->setVar('name', $v);
				$mandatory =  isset($_POST['requirement_mandatory_' . $k]) ? $_POST['requirement_mandatory_' . $k] : 0;
				$requirementObj->setVar('mandatory',$mandatory);
				if($mandatory){
					$requirementObj->setVar('type',SMARTCAREER_REQUIREMENT_TYPE_YN);
				}else{
					$requirementObj->setVar('type', isset($_POST['requirement_type_' . $k]) ? $_POST['requirement_type_' . $k] : SMARTCAREER_REQUIREMENT_TYPE_YN);
				}$smartcareer_requirement_handler->insert($requirementObj);
    		}
    	}
		return true;

    }

	function afterSave(&$obj) {
	if($_POST['op'] == 'publish'){
	    	$this->_disabledEvents[] = 'afterSave';
			$obj->unsetNew();
			$obj->setVar('published', 1);
			$obj->setVar('status', SMARTCAREER_POSTING_STATUS_ONLINE);
			$this->insert($obj);
			$obj->sendNotification();
    	}
    	return true;
    }
}
?>