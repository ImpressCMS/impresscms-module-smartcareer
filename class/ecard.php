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
// Ecard: The XOOPS Ecard                                               //
// -------------------------------------------------------------------------//

if (!defined("XOOPS_ROOT_PATH")) {
    die("XOOPS root path not defined");
}

include_once XOOPS_ROOT_PATH."/modules/smartobject/class/smartobject.php";

define('SMARTCAREER_ECARD_STATUS_NEW', 0);
define('SMARTCAREER_ECARD_STATUS_READY', 2);
define('SMARTCAREER_ECARD_STATUS_SENT', 1);

class SmartcareerEcard extends SmartObject {

    function SmartcareerEcard() {
        $this->quickInitVar('ecardid', XOBJ_DTYPE_INT, true);
        $this->quickInitVar('templateid', XOBJ_DTYPE_INT, true, _CO_SCAREER_ECARD_TEMPLATEID, _CO_SCAREER_ECARD_TEMPLATEID_DSC);
        $this->quickInitVar('subject', XOBJ_DTYPE_TXTBOX, true, _CO_SCAREER_ECARD_SUBJECT, _CO_SCAREER_ECARD_SUBJECT_DSC);
		$this->quickInitVar('message', XOBJ_DTYPE_TXTAREA, true, _CO_SCAREER_ECARD_MESSAGE, _CO_SCAREER_ECARD_MESSAGE_DSC);
		$this->quickInitVar('from_name', XOBJ_DTYPE_TXTBOX, true, _CO_SCAREER_ECARD_FROM_NAME, _CO_SCAREER_ECARD_FROM_NAME_DSC);
		$this->quickInitVar('from_email', XOBJ_DTYPE_TXTBOX, true, _CO_SCAREER_ECARD_FROM_EMAIL, _CO_SCAREER_ECARD_FROM_EMAIL_DSC);
		$this->quickInitVar('date', XOBJ_DTYPE_LTIME, true, _CO_SCAREER_ECARD_DATE, _CO_SCAREER_ECARD_DATE_DSC);
		$this->quickInitVar('emails', XOBJ_DTYPE_TXTAREA, true, _CO_SCAREER_ECARD_EMAILS, _CO_SCAREER_ECARD_EMAILS_DSC);
		$this->quickInitVar('status', XOBJ_DTYPE_INT, false, _CO_SCAREER_ECARD_STATUS, _CO_SCAREER_ECARD_STATUS_DSC);

		$this->setControl('templateid', array('itemHandler' => 'template',
                                  'method' => 'getList',
                                  'module' => 'smartcareer'));

		$this->setControl('status', array('itemHandler' => 'ecard',
                                  'method' => 'getStatus',
                                  'module' => 'smartcareer'));

		$this->setControl('message', array(
										'name' => 'textarea',
                                  		'form_editor'=>'textarea',
                                  		'rows'=>15,
                                  		'cols'=>60
                                  		));

		$this->setControl('emails', array(
										'name' => 'textarea',
                                  		'form_editor'=>'textarea',
                                  		'rows'=>15,
                                  		'cols'=>60
                                  		));
    }

    function getVar($key, $format = 's') {
        if ($format == 's' && in_array($key, array('templateid', 'status'))) {
            return call_user_func(array($this,$key));
        }
        return parent::getVar($key, $format);
    }

    function getVarsToPassAsHidden() {
    	$ret = array();
    	foreach($this->vars as $key=>$var) {
    		$ret[$key] = $this->getVar($key, 'n');
    	}
    	return $ret;
    }

    function getEcardContent() {
    	$ret = 'content';

		$smartcareer_template_handler = xoops_getModuleHandler('template', 'smartcareer');
		$templateObj = $smartcareer_template_handler->get( $this->getVar('templateid', 'e'));
		$template = $templateObj->getVar('ecard_template');
		$ret = str_replace('{MESSAGE}', $this->getVar('message'), $template);
		$ret = str_replace('{SUBJECT}', $this->getVar('subject'), $ret);
		$ret = str_replace('{FROM_NAME}', $this->getVar('from_name'), $ret);
		$ret = str_replace('{FROM_EMAIL}', $this->getVar('from_email'), $ret);

    	return $ret;
    }

    function getEcardMessage() {
		$smartcareer_template_handler = xoops_getModuleHandler('template', 'smartcareer');
		$templateObj = $smartcareer_template_handler->get( $this->getVar('templateid', 'e'));
		$template = $templateObj->getVar('content');
		$ret = str_replace('{MESSAGE}', $this->getVar('body'), $template);
		$ret = str_replace('{SUBJECT}', $this->getVar('subject'), $ret);
		$ret = str_replace('{FROM_NAME}', $this->getVar('from_name'), $ret);
		$ret = str_replace('{FROM_EMAIL}', $this->getVar('from_email'), $ret);

		include_once(XOOPS_ROOT_PATH . '/class/template.php');
		$xoopsTpl = new XoopsTpl();
		$xoopsTpl->assign('email_body', $ret);
		$xoopsTpl->assign('email_title', $this->getVar('subject'));

    	return $xoopsTpl->fetch('db:smartcareer_email_template.html');
    }

    function getRecipients() {
		$ret = array();
		$recipients = $this->getVar('emails', 'n');
		$recipientsArray = explode("\n", $recipients);
		foreach($recipientsArray as $v) {
    		$v = trim($v);
    		$ret[] = $v;
		}
		return $ret;
    }

	function templateid() {
		$smart_registry = SmartObjectsRegistry::getInstance();
    	$ret = $this->getVar('templateid', 'e');
		$obj = $smart_registry->getSingleObject('template', $ret, 'smartcareer');

    	if ($obj && !$obj->isNew()) {
    		$ret = $obj->getVar('name');
    	}
    	return $ret;
	}

    function status() {
    	$smartcareer_ecard_handler = xoops_getModuleHandler('ecard', 'smartcareer');
    	$ret = $this->getVar('status', 'e');
		$statusArray = $smartcareer_ecard_handler->getStatus();
    	if (isset($statusArray[$ret])) {
    		return $statusArray[$ret];
    	} else {
    		return false;
    	}
    }
}
class SmartcareerEcardHandler extends SmartPersistableObjectHandler {

    var $_statusArray=false;

    function SmartcareerEcardHandler($db) {
        $this->SmartPersistableObjectHandler($db, 'ecard', 'ecardid', 'subject', '', 'smartcareer');
//		$this->generalSQL = 'SELECT * FROM '.$this->table . " AS " . $this->_itemname . ' JOIN ' . $this->db->prefix('smartcareer_list') . ' AS list ON ecard.listid=list.listid JOIN ' . $this->db->prefix('smartcareer_template') . ' AS template ON list.templateid=template.templateid';
    }

	function addRecipients(&$ecardObj) {
		$smartcareer_recipient_handler = xoops_getModuleHandler('recipient', 'smartcareer');
		$recipientsArray = $ecardObj->getRecipients();

		$noErrors = true;
		foreach ($recipientsArray as $recipient) {
			$recipientObj = $smartcareer_recipient_handler->create();
			$recipientObj->setVar('userid', 0);
			$recipientObj->setVar('email_address', $recipient);
			$recipientObj->setVar('ecardid', $ecardObj->id());
			if (!$smartcareer_recipient_handler->insert($recipientObj, true)) {
				$noErrors = false;
			}
		}
		$ecardObj->setVar('status', SMARTCAREER_ECARD_STATUS_READY);
		if (!$this->insert($ecardObj, true)) {
			$noErrors = false;
		}

		return $noErrors;
	}

    function getNewEcards() {
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('status', SMARTCAREER_ECARD_STATUS_NEW));
		$criteria->add(new Criteria('date', time(), '<'));
		$ret = $this->getObjects($criteria);
		return $ret;
    }

    function getReadyEcards() {
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('status', SMARTCAREER_ECARD_STATUS_READY));
		$ret = $this->getObjects($criteria);
		return $ret;
    }

    function purgeSentEcards() {
		$sql =	'SELECT ecardid FROM ' .$this->db->prefix('smartcareer_ecard') .
				' WHERE ecardid NOT IN ( ' .
				' SELECT DISTINCT recipient.ecardid FROM ' .$this->db->prefix('smartcareer_ecard') .
				' AS ecard LEFT JOIN ' .$this->db->prefix('smartcareer_recipient') .
				' AS recipient  ON ecard.ecardid=recipient.ecardid WHERE ecard.status=2 ' .
				' AND recipient.status=0' .
				')';
		xoops_debug($sql);
		exit;
		$ret = $this->query($sql);
		if ($ret) {
			$ecardArray = array();
			foreach($ret as $ecard) {
				$ecardArray[] = $ecard['ecardid'];
			}

			if (count($ecardArray) > 0) {
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('ecardid', '(' . implode(', ', $ecardArray) . ')', 'IN'));
				$this->updateAll('status', SMARTCAREER_ECARD_STATUS_SENT, $criteria, true);
			}
		}
    }

    function getStatus() {
		if (!$this->_statusArray) {
			$this->_statusArray = array(
				SMARTCAREER_ECARD_STATUS_NEW => _CO_SCAREER_ECARD_STATUS_NEW,
				SMARTCAREER_ECARD_STATUS_READY => _CO_SCAREER_ECARD_STATUS_READY,
				SMARTCAREER_ECARD_STATUS_SENT => _CO_SCAREER_ECARD_STATUS_SENT
				);
		}
		return $this->_statusArray;
    }

    function getTheseEcards($ecardidArray) {
    	$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('ecardid', '(' . implode(', ', $ecardidArray) . ')', 'IN'));
		$ret = $this->getObjects($criteria, true);
		return $ret;
    }
}
?>