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

define('SMARTCAREER_APPLICATION_STATUS_SUBMITED', 2);

class SmartcareerApplication extends SmartObject {

    function SmartcareerApplication(&$handler) {
    	$this->SmartObject($handler);

        $this->quickInitVar('applicationid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('application_date', XOBJ_DTYPE_LTIME, true);
        $this->quickInitVar('postingid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('userid', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('related_experience', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('source', XOBJ_DTYPE_INT, true);

		$this->initNonPersistableVar('relevance', XOBJ_DTYPE_INT);
		$this->quickInitVar('status', XOBJ_DTYPE_INT, false, '', '', SMARTCAREER_APPLICATION_STATUS_SUBMITED);

		$this->initNonPersistableVar('application_requirement', XOBJ_DTYPE_TXTBOX, false, false, false, false, true);
		$this->quickInitVar('comment', XOBJ_DTYPE_TXTAREA);
		$this->setControl('status', array(
											'itemHandler' => 'application',
                                          	'method' => 'getStatusArray',
                                          	'module' => 'smartcareer'
                                          ));

		$this->setControl('postingid', array(
											'itemHandler' => 'posting',
                                          	'method' => 'getPostingsList',
                                          	'module' => 'smartcareer',
                                          	'onSelect' => 'submit'
                                          ));
		$this->setControl('userid', 'user');
		$this->setControl('application_requirement', 'application_requirement');
		$this->setControl('related_experience', array(
											'itemHandler' => 'application',
                                          	'method' => 'getRelated_experienceArray',
                                          	'module' => 'smartcareer'
                                          ));
        $this->setControl('source', array(
											'itemHandler' => 'application',
                                          	'method' => 'getSourceArray',
                                          	'module' => 'smartcareer'
                                          ));

    }

    function getApplication_requirements() {
    	$smartcareer_application_requirement_handler = xoops_getModuleHandler('application_requirement', 'smartcareer');
    	$ret = $smartcareer_application_requirement_handler->getRequirementsForApplication($this->id());

    	return $ret;
    }

    function getVar($key, $format = 's') {
        if ($format == 's' && in_array($key, array('postingid', 'userid', 'status', 'relevance', 'related_experience', 'source'))) {
            return call_user_func(array($this,$key));
        }
        return parent::getVar($key, $format);
    }

	 function getUserLink() {
		$smartcareer_user_handler = xoops_getModuleHandler('user', 'smartcareer');
    	$smartUser = $smartcareer_user_handler->get($this->getVar('userid', 'e'));
		$member_handler =& xoops_gethandler('member');
		$theUser =& $member_handler->getUser($smartUser->getVar('uid', 'e'));
		if (is_object($theUser)) {
			$uname = $theUser->getVar('uname');
        	return '<a href="'.SMARTCAREER_URL.'admin/user.php?op=view&userid='.$this->getVar('userid', 'e').'">'.$uname.'</a>';
		} else {
			return '';
		}

    }

    function postingid() {
		$smart_registry = SmartObjectsRegistry::getInstance();
    	$ret = $this->getVar('postingid', 'e');
		$obj = $smart_registry->getSingleObject('posting', $ret, 'smartcareer');

    	if (!$obj->isNew()) {
    		$ret = $obj->getAdminViewItemLink();
    	}
    	return $ret;
    }

    function status() {
    	$smartcareer_application_handler = xoops_getModuleHandler('application', 'smartcareer');
    	$ret = $this->getVar('status', 'e');
		$statusArray = $smartcareer_application_handler->getStatusArray();
    	if (isset($statusArray[$ret])) {
    		return $statusArray[$ret];
    	} else {
    		return false;
    	}
    }

    function related_experience() {
    	$smartcareer_application_handler = xoops_getModuleHandler('application', 'smartcareer');
    	$ret = $this->getVar('related_experience', 'e');
		$related_experienceArray = $smartcareer_application_handler->getRelated_experienceArray();
    	if (isset($related_experienceArray[$ret])) {
    		return $related_experienceArray[$ret];
    	} else {
    		return false;
    	}
    }

	function source() {
    	$smartcareer_application_handler = xoops_getModuleHandler('application', 'smartcareer');
    	$ret = $this->getVar('source', 'e');
		$sourceArray = $smartcareer_application_handler->getSourceArray();
    	if (isset($sourceArray[$ret])) {
    		return $sourceArray[$ret];
    	} else {
    		return false;
    	}
    }

    function userid() {
		$smartcareer_user_handler = xoops_getModuleHandler('user', 'smartcareer');
    	$smartUser = $smartcareer_user_handler->get($this->getVar('userid', 'e'));
		$member_handler =& xoops_gethandler('member');
		$theUser =& $member_handler->getUser($smartUser->getVar('uid', 'e'));

		$uname = $theUser->getVar('uname');
        return '<a href="'.SMARTCAREER_URL.'admin/user.php?op=view&userid='.$this->getVar('userid', 'e').'">'.$uname.'</a>';
    }

    function relevance() {
		$smartcareer_requirement_handler =& xoops_getmodulehandler('requirement', SMARTCAREER_DIRNAME);
		$smartcareer_application_requirement_handler =& xoops_getmodulehandler('application_requirement', SMARTCAREER_DIRNAME);

		$criteria = new CriteriaCompo();
        $criteria->add(new Criteria('applicationid', $this->id()));
		$appReqsTmp = $smartcareer_application_requirement_handler->getObjects($criteria);
		foreach ($appReqsTmp as $application_requirementObj) {
			$appReqs[$application_requirementObj->getVar('requirementid', 'e')] = $application_requirementObj;
		}
		unset($criteria);
		$criteria = new CriteriaCompo();
        $criteria->add(new Criteria('postingid', $this->getVar('postingid', 'e')));
		$postingReqs = $smartcareer_requirement_handler->getObjects($criteria);

		$cumul = $count = 0;
		$coefficient = 1;
		foreach($postingReqs as $postingReq){
			$count ++;
			if(is_object($appReqs[$postingReq->id()])){
				if($postingReq->getVar('type') == SMARTCAREER_REQUIREMENT_TYPE_YN){
					$cumul += ($appReqs[$postingReq->id()]->getVar('value', 'e') == 1 ? 4 : 0);

					$coefficient *= ($postingReq->getVar('mandatory', 'e') && $appReqs[$postingReq->id()]->getVar('value', 'e') == 0 ? 0 :1);

				}else{

					$cumul += intval($appReqs[$postingReq->id()]->getVar('value', 'e') - 1);
				}
			}
		}

		return smart_float((($cumul*$coefficient)/$count*25))." %";
    }


}
class SmartcareerApplicationHandler extends SmartPersistableObjectHandler {

    var $_statusArray=false;
    var $_related_experienceArray=false;
	var $_sourceArray=false;

    function SmartcareerApplicationHandler($db) {
        $this->SmartPersistableObjectHandler($db, 'application', 'applicationid', 'application_date', '', 'smartcareer');
    }

    function getStatusArray() {
		if (!$this->_statusArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/application_status.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			asort($ret);
			$this->_statusArray = $ret;
		}
		return $this->_statusArray;
    }

    function getRelated_experienceArray() {
		if (!$this->_related_experienceArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/application_related_experience.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			$this->_related_experienceArray = $ret;
		}
		return $this->_related_experienceArray;
    }

    function getSourceArray() {
		if (!$this->_sourceArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/application_source.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			$this->_sourceArray = $ret;
		}
		return $this->_sourceArray;
    }

    function afterInsert(&$obj) {
    	$smartcareer_application_requirement_handler = xoops_getModuleHandler('application_requirement', 'smartcareer');
    	$smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');
		$requirementsObj = $smartcareer_requirement_handler->getRequirementsForPosting($obj->getVar('postingid', 'e'));

		foreach($_POST as $key => $post_var){
			if(substr($key, 0, 13) == 'requirements_'){
				$requirementsArray[substr($key, 13)] = $post_var;
			}
		}

    	foreach($requirementsObj as $requirementObj) {
    		$requirementid = $requirementObj->id();
    		$value = $requirementsArray[$requirementid];
    		if ($requirementObj->getVar('type') == SMARTCAREER_REQUIREMENT_TYPE_1_TO_5) {
				$relevance_points = $relevance_points + $value;
    		} else {
    			if ($value) {
    				$relevance_points = $relevance_points + 5;
    			}
    		}

			$application_requirementObj = $smartcareer_application_requirement_handler->create();
			$application_requirementObj->setVar('applicationid', $obj->id());
			$application_requirementObj->setVar('requirementid', $requirementid);
			$application_requirementObj->setVar('value', $value);
			$smartcareer_application_requirement_handler->insert($application_requirementObj);
    	}
		return true;
    }

    function afterUpdate(&$obj) {
    	$smartcareer_application_requirement_handler = xoops_getModuleHandler('application_requirement', 'smartcareer');

    	$requirementsArray = $_POST['requirements'];

    	$criteria = new CriteriaCompo();
        $criteria->add(new Criteria('applicationid', $obj->id()));
		$appReqsTmp = $smartcareer_application_requirement_handler->getObjects($criteria);
		foreach ($appReqsTmp as $application_requirementObj) {
			$appReqs[$application_requirementObj->getVar('requirementid', 'e')] = $application_requirementObj;
		}
    	foreach($requirementsArray as $k=>$v) {
			if(!is_object($appReqs[$k])){
				$appReqs[$k] = $smartcareer_application_requirement_handler->create($appReqs[$k]);
				$appReqs[$k]->setVar('applicationid', $obj->id());
				$appReqs[$k]->setVar('requirementid', $k);
				$appReqs[$k]->setNew();
			}
			$appReqs[$k]->setVar('value', $v);
			$smartcareer_application_requirement_handler->insert($appReqs[$k]);
    	}
		return true;

    }

	function customBeforeInsert(&$obj) {
		$obj->setVar('application_date', time());
		return true;
	}

	function getPostingList() {
		$smartcareer_posting_handler = xoops_getModuleHandler('posting', 'smartcareer');
		return $smartcareer_posting_handler->getList();
	}

	function getApplicationByPosting($start = 0, $end = 0){
		$sql = "SELECT title, count(*) as count FROM ".$this->db->prefix('smartcareer_application')." as app, ".$this->db->prefix('smartcareer_posting')." as post
				WHERE app.postingid = post.postingid ";
		if($start != 0)	{
			$sql .= " AND application_date > ".$start;
		}
		if($end != 0)	{
			$sql .= " AND application_date < ".($end + 3600*24);
		}
		$sql .= " group by title";
		$result = $this->db->query($sql);

        while ($myrow = $this->db->fetchArray($result)) {
            //identifiers should be textboxes, so sanitize them like that
            $ret[$myrow['title']] =$myrow['count'];
        }
        return $ret;
	}

	function getApplicationByDept($start = 0, $end = 0){
		global $xoopsConfig;
		$sql = "SELECT departmentid, count(*) as count FROM ".$this->db->prefix('smartcareer_application')." as app, ".$this->db->prefix('smartcareer_posting')." as post
				WHERE app.postingid = post.postingid ";
		if($start != 0)	{
			$sql .= " AND application_date > ".$start;
		}
		if($end != 0)	{
			$sql .= " AND application_date < ".($end + 3600*24);
		}
		$sql .= " group by departmentid";
		$result = $this->db->query($sql);

		$deptArray = include_once(SMARTCAREER_ROOT_PATH . '/include/posting_department.inc.php');

        while ($myrow = $this->db->fetchArray($result)) {
            $res[$deptArray[$xoopsConfig['language']][$myrow['departmentid']]] = $myrow['count'];
        }
        return $res;
	}

	function getApplicationByArea($start = 0, $end = 0){
		global $xoopsConfig;
		$sql = "SELECT areaid, count(*) as count FROM ".$this->db->prefix('smartcareer_application')." as app, ".$this->db->prefix('smartcareer_posting')." as post
				WHERE app.postingid = post.postingid ";
		if($start != 0)	{
			$sql .= " AND application_date > ".$start;
		}
		if($end != 0)	{
			$sql .= " AND application_date < ".($end + 3600*24);
		}
		$sql .= " group by areaid";
		$result = $this->db->query($sql);

		$areaArray = include_once(SMARTCAREER_ROOT_PATH . '/include/posting_area.inc.php');

        while ($myrow = $this->db->fetchArray($result)) {
             $res[$areaArray[$xoopsConfig['language']][$myrow['areaid']]] =$myrow['count'];
        }
        return $res;
	}

	function getApplicationBySource($start = 0, $end = 0){
		global $xoopsConfig;
		$sql = "SELECT source, count(*) as count FROM ".$this->db->prefix('smartcareer_application')." as app, ".$this->db->prefix('smartcareer_posting')." as post
				WHERE app.postingid = post.postingid ";
		if($start != 0)	{
			$sql .= " AND application_date > ".$start;
		}
		if($end != 0)	{
			$sql .= " AND application_date < ".($end + 3600*24);
		}
		$sql .= " group by source";
		$result = $this->db->query($sql);

		$sourceArray = include_once(SMARTCAREER_ROOT_PATH . '/include/application_source.inc.php');

        while ($myrow = $this->db->fetchArray($result)) {
              if($myrow['source'] != 0){
            	 $res[$sourceArray[$xoopsConfig['language']][$myrow['source']]] =$myrow['count'];
              }
        }
        return $res;
	}

}
?>