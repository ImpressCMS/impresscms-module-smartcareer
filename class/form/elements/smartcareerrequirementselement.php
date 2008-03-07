<?php
/**
 * Contains the controls to set requirements
 *
 * @license GNU
 * @author marcan <marcan@smartfactory.ca>
 * @version $Id$
 * @link http://smartfactory.ca The SmartFactory
 */
if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}

class SmartcareerRequirementsElement extends XoopsFormElementTray {

	function SmartcareerRequirementsElement($object, $key){
	    $smartcareer_requirement_handler = xoops_getModuleHandler('requirement', 'smartcareer');

	    $var = $object->vars[$key];
     	$this->XoopsFormElementTray($var['form_caption'], '<div style="line-height: 3px;">&nbsp;</div>', $key);

		$requirementsArray = $object->getRequirements();

     	$requirementsCount = isset($_POST['requirements_count']) ? $_POST['requirements_count'] : 10;

     	if ($object->isNew()) {
			for($i=0;$i<$requirementsCount; $i++) {
				$singleRequirementTray = new XoopsFormElementTray('', '', $key . '_' . $i);

				$type_select = new XoopsFormSelect('', 'requirement_type_' . $i);
				$type_select->addOptionArray($smartcareer_requirement_handler->getTypeArray());
				$text_control = new XoopsFormText('', 'requirements[]', 50, 10000);
				$mandatoryYN = new XoopsFormRadioYN('', 'requirement_mandatory_' . $i);
				$singleRequirementTray->addElement($text_control);
				$singleRequirementTray->addElement($type_select);
				$singleRequirementTray->addElement(new XoopsFormLabel('', _AM_SCAREER_MANDATORY));
				$singleRequirementTray->addElement($mandatoryYN);

				$this->addElement($singleRequirementTray);

				unset($text_control);
				unset($type_select);
				unset($mandatoryYN);
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
					$mandatoryValue = $requirementsObj[$i]->getVar('mandatory', 'e');
				} else {
					$new_requirementid++;
					$requirementid = 'new_' . $new_requirementid;
					$requirementType = '';
					$requirementValue = '';
					$mandatoryValue = 0;
				}
				$singleRequirementTray = new XoopsFormElementTray('', '', $key . '_' . $requirementid);

				$type_select = new XoopsFormSelect('', 'requirement_type_' . $requirementid, $requirementType);
				$type_select->addOptionArray($smartcareer_requirement_handler->getTypeArray());
				$text_control = new XoopsFormText('', 'requirements[' . $requirementid . ']', 50, 10000, $requirementValue);
				$mandatoryYN = new XoopsFormRadioYN('', 'requirement_mandatory_' . $requirementid, $mandatoryValue);
				$singleRequirementTray->addElement($text_control);
				$singleRequirementTray->addElement($type_select);
				$singleRequirementTray->addElement(new XoopsFormLabel('', _AM_SCAREER_MANDATORY));
				$singleRequirementTray->addElement($mandatoryYN);
				if($requirementValue != ''){
					$del_check = new XoopsFormCheckBox('', 'requirement_delete_' . $requirementid);
					$del_check->addOption('delete',_AM_SCAREER_DELETE);
					$singleRequirementTray->addElement($del_check );
				}
				$this->addElement($singleRequirementTray);

				unset($text_control);
				unset($type_select);
				unset($mandatoryYN);
				unset($del_check);
				unset($singleRequirementTray);
			}
			$isnew_hidden = new XoopsFormHidden('new_requirements', $new_requirementid);
			$this->addElement($isnew_hidden);
		}
	}
}
?>