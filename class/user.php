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
// User: The XOOPS User                                               //
// -------------------------------------------------------------------------//

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}
include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobject.php";
include_once(XOOPS_ROOT_PATH . "/modules/smartobject/class/smartjax.php");
class SmartcareerUser extends SmartObject {

    function SmartcareerUser(&$handler) {
    	$this->SmartObject($handler);

        $this->quickInitVar('userid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('uid', XOBJ_DTYPE_INT);

        $this->addFormSection('section_personnal_info');
        $this->initNonPersistableVar('uname', XOBJ_DTYPE_TXTBOX, 'xusers');
        $this->initNonPersistableVar('email', XOBJ_DTYPE_TXTBOX, 'xusers');
        $this->initNonPersistableVar('password', XOBJ_DTYPE_TXTBOX, 'xusers');
        $this->initNonPersistableVar('password_confirm', XOBJ_DTYPE_TXTBOX, 'xusers');
        $this->quickInitVar('lastname', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('firstname', XOBJ_DTYPE_TXTBOX);
        $this->closeSection('section_personnal_info');

        $this->addFormSection('section_address', _CO_SMARTCAREER_USER_ADDRESS);
        $this->quickInitVar('address_no', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('address_street', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('address_unit', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('address_city', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('address_prov', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('address_postalcode', XOBJ_DTYPE_TXTBOX);
		$this->closeSection('section_address');

        $this->addFormSection('section_phone', _CO_SMARTCAREER_USER_PHONE);
        $this->quickInitVar('phone_home', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('phone_cell', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('phone_other', XOBJ_DTYPE_TXTBOX);
        $this->closeSection('section_phone');

        $this->addFormSection('section_language', _CO_SMARTCAREER_USER_LANGUAGE);
        $this->quickInitVar('french_spoken', XOBJ_DTYPE_INT);
        $this->quickInitVar('french_written', XOBJ_DTYPE_INT);
        $this->quickInitVar('english_spoken', XOBJ_DTYPE_INT);
        $this->quickInitVar('english_written', XOBJ_DTYPE_INT);
        $this->quickInitVar('language_other', XOBJ_DTYPE_TXTBOX);
        $this->closeSection('section_language');

        $this->addFormSection('section_diploma', _CO_SMARTCAREER_USER_DIPLOMA);
        $this->quickInitVar('highschool', XOBJ_DTYPE_INT);
        $this->quickInitVar('highschool_diploma', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('college', XOBJ_DTYPE_INT);
        $this->quickInitVar('college_diploma', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('university', XOBJ_DTYPE_INT);
        $this->quickInitVar('university_diploma', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('other_diploma', XOBJ_DTYPE_TXTBOX);
        $this->closeSection('section_diploma');

        $this->addFormSection('section_experience', _CO_SMARTCAREER_USER_EXPERIENCE);
        $this->quickInitVar('resume', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('reference', XOBJ_DTYPE_TXTBOX);
        $this->quickInitVar('already_worked', XOBJ_DTYPE_INT);
        $this->quickInitVar('already_worked_similar', XOBJ_DTYPE_INT);
        $this->quickInitVar('availability', XOBJ_DTYPE_INT);
        $this->quickInitVar('status', XOBJ_DTYPE_INT);
		$this->closeSection('section_experience');

		$this->addFormSection('section_notif', _CO_SMARTCAREER_USER_NOTIF);
        $this->quickInitVar('notif_dept', XOBJ_DTYPE_ARRAY);
        $this->quickInitVar('notif_area', XOBJ_DTYPE_ARRAY);
  		$this->closeSection('section_notif');

		$this->quickInitVar('comment', XOBJ_DTYPE_TXTAREA);
		/*
		$this->addFormSection('prev_job1', _CO_SMARTCAREER_PREV_JOB1);
        $this->quickInitVar('pr_job1_title', XOBJ_DTYPE_TXTBOX, false, _CO_SMARTCAREER_PREV_JOB_TITLE);
        $this->quickInitVar('pr_job1_cie', XOBJ_DTYPE_TXTBOX, false, _CO_SMARTCAREER_PREV_JOB_CIE);
        $this->quickInitVar('pr_job1_from', XOBJ_DTYPE_STIME, false, _CO_SMARTCAREER_PREV_JOB_FROM);
        $this->quickInitVar('pr_job1_to', XOBJ_DTYPE_STIME, false, _CO_SMARTCAREER_PREV_JOB_TO);
		$this->closeSection('prev_job1');

		$smartjax = new Smartjax();
		$smartjax->initiateFromUserside();

		$this->addFormSection('button_prev_job2', '<input class="formButton" name="show_job2" id="show_job2" value="'._CO_SMARTCAREER_PREV_JOB2.'" onclick="'.
		$smartjax->visual_effect('toggle_appear','prev_job2').'; '.$smartjax->visual_effect('toggle_appear','button_prev_job3').
		'; '.$smartjax->visual_effect('toggle_appear','button_prev_job2').';" type="button">');
        $this->closeSection('button_prev_job2');

		$this->addFormSection('prev_job2', _CO_SMARTCAREER_PREV_JOB2, true);
        $this->quickInitVar('pr_job2_title', XOBJ_DTYPE_TXTBOX, false, _CO_SMARTCAREER_PREV_JOB_TITLE);
        $this->quickInitVar('pr_job2_cie', XOBJ_DTYPE_TXTBOX, false, _CO_SMARTCAREER_PREV_JOB_CIE);
        $this->quickInitVar('pr_job2_from', XOBJ_DTYPE_STIME, false, _CO_SMARTCAREER_PREV_JOB_FROM);
        $this->quickInitVar('pr_job2_to', XOBJ_DTYPE_STIME, false, _CO_SMARTCAREER_PREV_JOB_TO);
		$this->closeSection('prev_job2');

		$this->addFormSection('button_prev_job3', '<input class="formButton" name="show_job3" id="show_job3" value="'._CO_SMARTCAREER_PREV_JOB3.'" onclick="'.
		$smartjax->visual_effect('toggle_appear','prev_job3').'; '.$smartjax->visual_effect('toggle_appear','button_prev_job3').'" type="button">', true);
        $this->closeSection('button_prev_job3');

        $this->addFormSection('prev_job3', _CO_SMARTCAREER_PREV_JOB3, true);
        $this->quickInitVar('pr_job3_title', XOBJ_DTYPE_TXTBOX, false, _CO_SMARTCAREER_PREV_JOB_TITLE);
        $this->quickInitVar('pr_job3_cie', XOBJ_DTYPE_TXTBOX, false, _CO_SMARTCAREER_PREV_JOB_CIE);
        $this->quickInitVar('pr_job3_from', XOBJ_DTYPE_STIME, false, _CO_SMARTCAREER_PREV_JOB_FROM);
        $this->quickInitVar('pr_job3_to', XOBJ_DTYPE_STIME, false, _CO_SMARTCAREER_PREV_JOB_TO);
		$this->closeSection('prev_job3');
		*/

		$this->setControl('uid', 'user');
		$this->setControl('password', 'password');
		$this->setControl('password_confirm', 'password');
		$this->setControl('french_spoken', 'yesno');
		$this->setControl('french_written', 'yesno');
		$this->setControl('english_spoken', 'yesno');
		$this->setControl('english_written', 'yesno');
		$this->setControl('highschool', 'yesno');
		$this->setControl('college', 'yesno');
		$this->setControl('university', 'yesno');
		$this->setControl('resume', 'file');
		$this->setControl('reference', 'file');
		$this->setControl('already_worked', 'yesno');
		$this->setControl('already_worked_similar', 'yesno');

		//$this->setControl('comment', array('name'=>'textarea', 'editor'=>'textarea'));


		$this->setControl('status', array('itemHandler' => 'user',
                                  'method' => 'getStatusArray',
                                  'module' => 'smartcareer'));
         $this->setControl('availability', array(
											'itemHandler' => 'user',
                                          	'method' => 'getAvailabilityArray',
                                          	'module' => 'smartcareer'
                                          ));
		$this->setControl('notif_area', array('name' => 'check',
								  'options' => $handler->getAreaArray()));

        $this->setControl('notif_dept', array('name' => 'check',
								  'options' => $handler->getDepartmentArray()));
    }

    function getVar($key, $format = 's') {
        if ($format == 's' && in_array($key, array('listid', 'uid', 'french_spoken', 'french_written', 'english_spoken', 'status', 'availability',
         'english_written', 'highschool', 'college', 'university', 'already_worked','already_worked_similar', 'resume', 'reference', 'comment'))) {
            return call_user_func(array($this,$key));
        }
        return parent::getVar($key, $format);
    }

    function getUserLink() {
    	return '<a href="user.php?op=view&userid=' . $this->id() . '">' . $this->getVar('uname') . '</a>';
    }

	function status(){
    	$statusArray = $this->handler->getStatusArray();
    	return $statusArray[$this->getVar('status', 'e')];
    }

	function availability(){
    	$availabilityArray = $this->handler->getAvailabilityArray();
    	return $availabilityArray[$this->getVar('availability', 'e')];
    }

    function french_spoken(){
    	return $this->getVar('french_spoken', 'e') == 0 ? _NO :_YES;
    }

	function french_written(){
		return $this->getVar('french_written', 'e') == 0 ? _NO :_YES;
    }

	function english_spoken(){
		return $this->getVar('english_spoken', 'e') == 0 ? _NO :_YES;
    }

	function english_written(){
		return $this->getVar('english_written', 'e') == 0 ? _NO :_YES;
    }

	function highschool(){
		return $this->getVar('highschool', 'e') == 0 ? _NO :_YES;
    }

	function college(){
		return $this->getVar('college', 'e') == 0 ? _NO :_YES;
    }

	function university(){
		return $this->getVar('university', 'e') == 0 ? _NO :_YES;
    }

	function already_worked(){
		return $this->getVar('already_worked', 'e') == 0 ? _NO :_YES;
    }

	function already_worked_similar(){
		return $this->getVar('already_worked_similar', 'e') == 0 ? _NO :_YES;
    }

    function resume(){
		return "<a href='" . $this->getUploadDir().$this->getVar('resume', 'e') . "' target='_blank' >". $this->getVar('resume', 'e')."</a>";
    }

     function reference(){
		return "<a href='" . $this->getUploadDir().$this->getVar('reference', 'e') . "' target='_blank' >". $this->getVar('reference', 'e')."</a>";
    }

    function comment() {
    	$myts = MyTextSanitizer::getInstance();
    	$ret = $this->getVar('comment', 'n');
		$ret = $myts->displayTarea($ret, true);
		return $ret;
    }

	function hasApplied($postingid){
		$smartcareer_application_handler = xoops_getModuleHandler('application');
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('userid', $this->getVar('userid', 'e')));
		$criteria->add(new Criteria('postingid', $postingid));
		return ($smartcareer_application_handler->getCount($criteria) > 0);

	}

}
class SmartcareerUserHandler extends SmartPersistableObjectHandler {

	var $_statusArray=false;
	var $_availabilityArray=false;

    function SmartcareerUserHandler($db) {
        $this->SmartPersistableObjectHandler($db, 'user', 'userid', 'uid', 'listid', 'smartcareer');
        $this->generalSQL = 'SELECT * FROM '.$this->table . " AS " . $this->_itemname . ' JOIN ' . $this->db->prefix('users') . ' AS xusers ON user.uid=xusers.uid ';
    }

	function getByUid($uid) {
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('user.uid', $uid));
		$ret = $this->getObjects($criteria);
		if ($ret && count($ret > 0)) {
			return $ret[0];
		} else {
			return $this->create();
		}
	}

    function getStatusArray() {
		if (!$this->_statusArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/user_status.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			asort($ret);
			$this->_statusArray = $ret;
		}
		return $this->_statusArray;
    }

    function getAvailabilityArray() {
		if (!$this->_availabilityArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/user_availability.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			//asort($ret);
			$this->_availabilityArray = $ret;
		}
		return $this->_availabilityArray;
    }

	function getDepartmentArray() {
		if (!$this->_departmentArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/posting_department.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			asort($ret);
			$ret['all'] = _CO_SMARTCAREER_ALL;
			$this->_departmentArray = $ret;
		}
		return $this->_departmentArray;
    }

    function getAreaArray() {
		if (!$this->_areaArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/posting_area.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			asort($ret);
			$ret['all'] = _CO_SMARTCAREER_ALL;
			$this->_areaArray = $ret;
		}
		return $this->_areaArray;
    }

    function afterUpdate(&$obj) {
		if (isset($_POST['password']) && $_POST['password'] != '') {
			global $xoopsConfigUser, $myts;

	        $password = $myts->stripSlashesGPC(trim($_POST['password']));
	        if (strlen($password) < $xoopsConfigUser['minpass']) {
	            $obj->setErrors(sprintf(_MD_SMARTCAREER_USER_PROFILE_PASS_TOO_SHORT,$xoopsConfigUser['minpass']));
	            return false;
	        }
	        $vpass = '';
	        if (!empty($_POST['password_confirm'])) {
	            $vpass = $myts->stripSlashesGPC(trim($_POST['password_confirm']));
	        }
	        if ($password != $vpass) {
	            $obj->setErrors(_MD_SMARTCAREER_USER_PROFILE_PASS_NOT_SAME);
	            return false;
	        }
			// retreiving the user
			$member_handler = xoops_gethandler('member');
			$userObj = $member_handler->getUser($obj->getVar('uid', 'e'));
			if (!$userObj) {
				$obj->setErrors('Linked uid not found');
				return false;
			}
			$userObj->setVar('pass', md5($password), true);
			$ret = $member_handler->insertUser($userObj);
			return $ret;
		} else {
			return true;
		}
    }

    function beforeInsert(&$obj) {
		$smartobject_member_handler = xoops_getModuleHandler('member', 'smartobject');
		$userObj = $smartobject_member_handler->createUser();
		$userObj->setVar('email', $obj->getVar('email', 'e'));

		// retreive the groups to add the user to
		global $xoopsModuleConfig, $xoopsConfig;
		$groups = array(2);

		$password = '';
		$ret = $smartobject_member_handler->addAndActivateUser($userObj, $groups, false, $password);

		// send some notifications
		$xoopsMailer = & getMailer();
		$xoopsMailer->useMail();

		$xoopsMailer->setTemplateDir(SMARTCAREER_ROOT_PATH . 'language/' . $xoopsConfig['language'] . '/mail_template');
		$xoopsMailer->setTemplate('smartcareer_notify_user_profile_created.tpl');
		$xoopsMailer->assign('XOOPS_USER_PASSWORD', $password);
		$xoopsMailer->assign('SITENAME', $xoopsConfig['sitename']);
		$xoopsMailer->assign('ADMINMAIL', $xoopsConfig['adminmail']);
		$xoopsMailer->assign('SITEURL', XOOPS_URL . "/");
		$xoopsMailer->assign('NAME', $obj->getVar('firstname').' '.$obj->getVar('lastname'));
		$xoopsMailer->assign('UNAME', $userObj->getVar('uname'));
		$xoopsMailer->assign('LINK', XOOPS_URL . '/user.php?xoops_redirect=/modules/smartcareer/posting.php');
		$xoopsMailer->setToUsers($userObj);
		$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
		$xoopsMailer->setFromName($xoopsConfig['sitename']);
		$xoopsMailer->setSubject(sprintf(_CO_SMARTCAREER_USER_CREATED_MAIL_SUBJECT, $xoopsConfig['sitename']));
		if (!$xoopsMailer->send(true)) {
			/**
			 * @todo trap error if email was not sent
			 */

		}

		unset($xoopsMailer);

		$xoopsMailer = & getMailer();
		$xoopsMailer->useMail();
		$xoopsMailer->setTemplateDir(SMARTCAREER_ROOT_PATH . 'language/' . $xoopsConfig['language'] . '/mail_template');
		$xoopsMailer->setTemplate('smartcareer_notify_admin_profile_created.tpl');
		$xoopsMailer->assign('SITENAME', $xoopsConfig['sitename']);
		$xoopsMailer->assign('NAME', $obj->getVar('firstname').' '.$obj->getVar('lastname'));
		$xoopsMailer->assign('EMAIL', $userObj->getVar('email'));
		$xoopsMailer->setToEmails($xoopsConfig['adminmail']);
		$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
		$xoopsMailer->setFromName($xoopsConfig['sitename']);
		$xoopsMailer->setSubject(sprintf(_CO_SMARTCAREER_USER_CREATED_ADM_MAIL_SUBJECT, $xoopsConfig['sitename']));


		if (!$xoopsMailer->send(true)) {
			/**
			 * @todo trap error if email was not sent
			 */

		}

		if (!$ret) {
			$obj->setErrors(_CO_SMARTCAREER_USER_CREATED_ERROR);
			return false;
		}
		$obj->setVar('uid', $userObj->uid());

		return true;
    }


}
?>