<?php
// $Id: requirement.php,v 1.12 2007/10/22 17:08:48 marcan Exp $
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

define('SMARTCAREER_REQUIREMENT_TYPE_1_TO_5', 1);
define('SMARTCAREER_REQUIREMENT_TYPE_YN', 2);

class SmartcareerRequirement extends SmartObject {

    function SmartcareerRequirement(&$handler) {
    	$this->SmartObject($handler);

        $this->quickInitVar('requirementid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('postingid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('name', XOBJ_DTYPE_TXTAREA, true);
		$this->quickInitVar('type', XOBJ_DTYPE_TXTBOX, true);
		$this->quickInitVar('mandatory', XOBJ_DTYPE_INT, true);

		$this->setControl('postingid', array(
											'itemHandler' => 'posting',
                                          	'method' => 'getList',
                                          	'module' => 'smartcareer'
                                          ));
        $this->setControl('mandatory', 'yesno');
    }

    function getVar($key, $format = 's') {
        if ($format == 's' && in_array($key, array())) {
            return call_user_func(array($this,$key));
        }
        return parent::getVar($key, $format);
    }
}
class SmartcareerRequirementHandler extends SmartPersistableObjectHandler {

    var $_typeArray=false;

    function SmartcareerRequirementHandler($db) {
        $this->SmartPersistableObjectHandler($db, 'requirement', 'requirementid', 'name', '', 'smartcareer');
    }

    function getRequirementsForPosting($postingid) {
    	$criteria = new CriteriaCompo();
    	$criteria->add(new Criteria('postingid', $postingid));
    	$ret = $this->getObjects($criteria);
    	return $ret;
    }

    function getTypeArray() {
		if (!$this->_typeArray) {
			$ret = include_once(SMARTCAREER_ROOT_PATH . '/include/requirement_type.inc.php');
			global $xoopsConfig;
			$ret = isset($ret[$xoopsConfig['language']]) ? $ret[$xoopsConfig['language']] : $ret['english'];
			asort($ret);
			$this->_typeArray = $ret;
		}
		return $this->_typeArray;
    }
}
?>