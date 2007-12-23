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

define('SMARTCAREER_APPLICATION_STATUS_OFFLINE', 0);
define('SMARTCAREER_APPLICATION_STATUS_ONLINE', 1);

class SmartcareerApplication extends SmartObject {

    function SmartcareerApplication(&$handler) {
    	$this->SmartObject($handler);

        $this->quickInitVar('applicationid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('postingid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('userid', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('related_experience', XOBJ_DTYPE_INT, true);
		$this->quickInitVar('status', XOBJ_DTYPE_INT);
    }

    function getVar($key, $format = 's') {
        if ($format == 's' && in_array($key, array())) {
            return call_user_func(array($this,$key));
        }
        return parent::getVar($key, $format);
    }
}
class SmartcareerApplicationHandler extends SmartPersistableObjectHandler {

    var $_statusArray=false;

    function SmartcareerApplicationHandler($db) {
        $this->SmartPersistableObjectHandler($db, 'application', 'applicationid', 'title', '', 'smartcareer');
    }

    function getStatus() {
		if (!$this->_statusArray) {
			$this->_statusArray = array(
				SMARTCAREER_APPLICATION_STATUS_OFFLINE => _CO_SCAREER_APPLICATION_STATUS_OFFLINE,
				SMARTCAREER_APPLICATION_STATUS_ONLINE => _CO_SCAREER_APPLICATION_STATUS_ONLINE
				);
		}
		return $this->_statusArray;
    }
}
?>