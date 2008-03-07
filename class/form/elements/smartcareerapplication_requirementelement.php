<?php
/**
 * Contains the controls to set requirements
 *
 * @license GNU
 * @author marcan <marcan@smartfactory.ca>
 * @version $Id: smartquizrequirementselement.php,v 1.1.2.4 2007/10/02 19:15:47 marcan Exp $
 * @link http://smartfactory.ca The SmartFactory
 */
if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}

class SmartcareerApplication_requirementElement extends XoopsFormElementTray {

	function SmartcareerApplication_requirementElement($object, $key){
	    $smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');
	    $smartcareer_application_requirement_handler = xoops_getModuleHandler('application_requirement', 'smartcareer');

	    $var = $object->vars[$key];
     	$this->XoopsFormElementTray($var['form_caption'], '<div style="line-height: 3px;">&nbsp;</div>', $key);

     	if (!$object->isNew()) {
			$application_requirementsObj = $object->getApplication_requirements();
     	}

		$requirementsObj = $smartcareer_requirement_handler->getRequirementsForPosting($object->getVar('postingid', 'e'));

		foreach($requirementsObj as $requirementObj) {
			$requirementid = $requirementObj->id();

			if (isset($application_requirementsObj[$requirementid])) {
				$value = $application_requirementsObj[$requirementid]->getVar('value', 'e');
			} else {
				$value = '';
			}
			switch($requirementObj->getVar('type', 'e')) {
				case SMARTCAREER_REQUIREMENT_TYPE_1_TO_5 :
					$control = new XoopsFormRadio($requirementObj->getVar('name'), 'requirements[' . $requirementid . ']', $value);
					$control->addOptionArray(array(
								1 => '1',
								2 => '2',
								3 => '3',
								4 => '4',
								5 => '5'
					));
				break;

				default:
					$control = new XoopsFormRadioYN($requirementObj->getVar('name'), 'requirements[' . $requirementid . ']', $value);
				break;
			}
			$this->addElement($control);
			unset($control);
		}

/*
		$requirementsArray = $object->getRequirements();

     	$requirementsCount = isset($_POST['requirements_count']) ? $_POST['requirements_count'] : 10;

     	if ($object->isNew()) {
			for($i=0;$i<$requirementsCount; $i++) {
				$singleRequirementTray = new XoopsFormElementTray('', '', $key . '_' . $i);

				$type_select = new XoopsFormSelect('', 'requirement_type_' . $i);
				$type_select->addOptionArray($smartcareer_requirement_handler->getTypeArray());
				$text_control = new XoopsFormText('', 'requirements[]', 50, 10000);
				$singleRequirementTray->addElement($text_control);
				$singleRequirementTray->addElement($type_select);

				$this->addElement($singleRequirementTray);

				unset($text_control);
				unset($type_select);
				unset($singleRequirementTray);
			}
			$isnew_hidden = new XoopsFormHidden('posting_isnew', true);
			$this->addElement($isnew_hidden);
		} else {
			$requirementsObj = $object->getRequirements();
			if ($requirementsCount < count($requirementsObj)) {
				$requirementsCount =  count($requirementsObj);
			}
			$new_requirementid = 0;
			for($i=0;$i<$requirementsCount; $i++) {
				if (isset($requirementsObj[$i])) {
					$requirementid = $requirementsObj[$i]->id();
					$requirementType = $requirementsObj[$i]->getVar('type', 'e');
					$requirementValue = $requirementsObj[$i]->getVar('name', 'e');
				} else {
					$new_requirementid++;
					$requirementid = 'new_' . $new_requirementid;
					$requirementType = '';
					$requirementValue = '';
				}
				$singleRequirementTray = new XoopsFormElementTray('', '', $key . '_' . $requirementid);

				$type_select = new XoopsFormSelect('', 'requirement_type_' . $requirementid, $requirementType);
				$type_select->addOptionArray($smartcareer_requirement_handler->getTypeArray());
				$text_control = new XoopsFormText('', 'requirements[' . $requirementid . ']', 50, 10000, $requirementValue);
				$singleRequirementTray->addElement($text_control);
				$singleRequirementTray->addElement($type_select);

				$this->addElement($singleRequirementTray);

				unset($text_control);
				unset($type_select);
				unset($singleRequirementTray);
			}
			$isnew_hidden = new XoopsFormHidden('new_requirements', $new_requirementid);
			$this->addElement($isnew_hidden);
		}*/
	}
}
?>