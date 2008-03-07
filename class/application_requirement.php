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

class SmartcareerApplication_requirement extends SmartObject {

    function SmartcareerApplication_requirement() {
        $this->quickInitVar('application_requirementid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('applicationid', XOBJ_DTYPE_INT, true, _CO_SCAREER_APPLICATION_REQUIREMENT_APPLICATIONIDID);
        $this->quickInitVar('requirementid', XOBJ_DTYPE_INT, true, _CO_SCAREER_APPLICATION_REQUIREMENT_REQUIREMENTID);
		$this->quickInitVar('value', XOBJ_DTYPE_TXTBOX, true, _CO_SCAREER_APPLICATION_REQUIREMENT_VALUE);
    	$this->initNonPersistableVar('postingid', XOBJ_DTYPE_INT, true, _CO_SMARTCAREER_POSTING_TITLE);
        $this->initNonPersistableVar('userid', XOBJ_DTYPE_INT, true, _CO_SMARTCAREER_APPLICATION_USERID);
		$this->initNonPersistableVar('application_date', XOBJ_DTYPE_STIME, true, _CO_SMARTCAREER_APPLICATION_APPLICATION_DATE);

    }

    function getVar($key, $format = 's') {
        if ($format == 's' && in_array($key, array('userid', 'postingid', 'applicationid' , 'value', 'requirementid'))) {
            return call_user_func(array($this,$key));
        }
        return parent::getVar($key, $format);
    }

    function userid(){
    	$smartcareer_user_handler = xoops_getModuleHandler('user', 'smartcareer');
    	$user = $smartcareer_user_handler->get($this->getVar('userid', 'e'));
    	return $user->getUserLink();
    }

	function value(){
    	$smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');
    	$requirement = $smartcareer_requirement_handler->get($this->getVar('requirementid', 'e'));
    	if($requirement->getVar('type', 'e') == 2){
    		return $this->getVar('value', 'e') == 0 ? _NO : _YES;
    	}else{
    		return $this->getVar('value', 'e');
    	}
   }

   function requirementid(){
    	$smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');
    	$requirement = $smartcareer_requirement_handler->get($this->getVar('requirementid', 'e'));
    	return $requirement->getVar('name');
   }

     function postingid(){
    	$smartcareer_posting_handler = xoops_getModuleHandler('posting', 'smartcareer');
    	$posting = $smartcareer_posting_handler->get($this->getVar('postingid', 'e'));
    	return '<a href="'.SMARTCAREER_URL.'admin/posting.php?op=view&postingid='.$posting->id().'">'.$posting->getVar('title').'</a>';
    }

     function applicationid(){
    	$smartcareer_application_handler = xoops_getModuleHandler('application', 'smartcareer');
    	$application = $smartcareer_application_handler->get($this->getVar('applicationid', 'e'));
    	return '<a href="'.SMARTCAREER_URL.'admin/application.php?op=view&applicationid='.$application->id().'">'._AM_SCAREER_APPLICATION.'</a>';
    }

}
class SmartcareerApplication_requirementHandler extends SmartPersistableObjectHandler {

    var $_statusArray=false;

    function SmartcareerApplication_requirementHandler($db) {
        $this->SmartPersistableObjectHandler($db, 'application_requirement', 'application_requirementid', 'application_requirementid', '', 'smartcareer');
    }

	function getRequirementsForApplication($applicationid) {
		$criteria = new CriteriaCompo();
		$criteria = new Criteria('applicationid', $applicationid);
		$application_requirementsObj = $this->getObjects($criteria, true);

		// reorganising the application_requirements by requirementid
    	foreach ($application_requirementsObj as $application_requirementObj) {
			$ret[$application_requirementObj->getVar('requirementid', 'e')] = $application_requirementObj;
		}
		return $ret;
	}

    function getStatus() {
		if (!$this->_statusArray) {
			$this->_statusArray = array(
				SMARTCAREER_APPLICATION_REQUIREMENT_STATUS_OFFLINE => _CO_SCAREER_APPLICATION_REQUIREMENT_STATUS_OFFLINE,
				SMARTCAREER_APPLICATION_REQUIREMENT_STATUS_ONLINE => _CO_SCAREER_APPLICATION_REQUIREMENT_STATUS_ONLINE
				);
		}
		return $this->_statusArray;
    }

    function setGeneralSQLForSearch(){
    	$this->generalSQL = 'SELECT * FROM '.$this->db->prefix('smartcareer_requirement') . ' AS requirement JOIN '
				. $this->table . ' AS application_requirement
				ON application_requirement.requirementid=requirement.requirementid JOIN '
				. $this->db->prefix('smartcareer_application') . ' AS application
				ON application.applicationid=application_requirement.applicationid';

    }
}
?>