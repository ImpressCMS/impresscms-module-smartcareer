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

define('SMARTCAREER_POSTING_STATUS_OFFLINE', 0);
define('SMARTCAREER_POSTING_STATUS_ONLINE', 1);

class SmartcareerPosting extends SmartObject {

    function SmartcareerPosting(&$handler) {
    	$this->SmartObject($handler);

        $this->quickInitVar('postingid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('departmentid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('areaid', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('title', XOBJ_DTYPE_TXTBOX, true);
		$this->quickInitVar('details', XOBJ_DTYPE_TXTAREA);
		$this->quickInitVar('status', XOBJ_DTYPE_INT);
		$this->quickInitVar('posting_date', XOBJ_DTYPE_LTIME);
		$this->quickInitVar('closing_date', XOBJ_DTYPE_LTIME);
		$this->initNonPersistableVar('requirements', XOBJ_DTYPE_TXTBOX);
		$this->initCommonVar('counter', false);

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
        if ($format == 's' && in_array($key, array())) {
            return call_user_func(array($this,$key));
        }
        return parent::getVar($key, $format);
    }
}
class SmartcareerPostingHandler extends SmartPersistableObjectHandler {

    var $_statusArray=false;
    var $_departmentArray=false;
    var $_areaArray=false;

    function SmartcareerPostingHandler($db) {
        $this->SmartPersistableObjectHandler($db, 'posting', 'postingid', 'title', '', 'smartcareer');
    }

    function getStatusArray() {
		if (!$this->_statusArray) {
			$this->_statusArray = array(
				SMARTCAREER_POSTING_STATUS_OFFLINE => _CO_SCAREER_POSTING_STATUS_OFFLINE,
				SMARTCAREER_POSTING_STATUS_ONLINE => _CO_SCAREER_POSTING_STATUS_ONLINE
				);
		}
		return $this->_statusArray;
    }

    function getDepartmentArray() {
		if (!$this->_departmentArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/posting_department.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			sort($ret);
			$this->_departmentArray = $ret;
		}
		return $this->_departmentArray;
    }
    function getAreaArray() {
		if (!$this->_areaArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/posting_area.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			sort($ret);
			$this->_areaArray = $ret;
		}
		return $this->_areaArray;
    }

}
?>