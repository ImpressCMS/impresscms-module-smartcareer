<?php
/**
 * Contains the controls to set answers
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
	    $lettersArray = smartquiz_lettersArray();

	    $var = $object->vars[$key];
     	$this->XoopsFormElementTray($var['form_caption'], '<div style="line-height: 3px;">&nbsp;</div>', $key);

		$answersArray = $object->getAnswers(true);

     	$answersCount = 5;

     	$answersTray = new XoopsFormElementTray('', '<div style="line-height: 3px;">&nbsp;</div>');

		if ($object->isNew()) {
			for($i=0;$i<$answersCount; $i++) {
				$radio_option = '<input name="correct_answer" value="' . $i .'" type="radio">';
				$text_control = new XoopsFormText('<div style="vertical-align: middle; width: 40px; float: left;">' . $radio_option . $lettersArray[$i] . ')</div>', 'smartquiz_answer[]', 50, 10000);
				$answersTray->addElement($text_control);
				unset($text_control);
			}
		} else {
			$i = 0;
			foreach($answersArray as $answerid=>$answerObj) {
				$answerid = $answerObj->id();
				$radio_option = '<input name="correct_answer" value="' . $answerid .'" ';
				if ($answerid == $object->getVar('correct_answerid')) {
					$radio_option .= 'checked="chedked" ';
				}
				$radio_option .= 'type="radio">';
				$text_control = new XoopsFormText('<div style="vertical-align: middle; width: 40px; float: left;">' . $radio_option . $lettersArray[$i] . ')</div>', 'smartquiz_answer[' . $answerid . ']', 50, 10000, $answerObj->getVar('answer', 'e'));
				$answersTray->addElement($text_control);
				unset($text_control);
				$i++;
			}
		}
		$this->addElement($answersTray);
	}
}
?>