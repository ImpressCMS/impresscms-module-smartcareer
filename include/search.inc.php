<?php

/**
* $Id$
* Module: SmartSection
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/
if (!defined("XOOPS_ROOT_PATH")) {
 	die("XOOPS root path not defined");
}

function smartcareer_search($queryarray, $andor, $limit, $offset, $userid)
{
	include_once XOOPS_ROOT_PATH.'/modules/smartcareer/include/common.php';

	$ret = array();

	if (!isset($smartcareer_item_handler)) {
		$smartcareer_item_handler = xoops_getmodulehandler('item', 'smartcareer');
	}

	if ($queryarray == ''){
		$keywords= '';
		$hightlight_key = '';
	} else {
		$keywords=implode('+', $queryarray);
		$hightlight_key = "&amp;keywords=" . $keywords;
	}

	$itemsObj =& $smartcareer_item_handler->getItemsFromSearch($queryarray, $andor, $limit, $offset, $userid);

	foreach ($itemsObj as $result) {
		
		$item['image'] = "images/item_icon.gif";
		$item['link'] = "item.php?itemid=" . $result['id'] . $hightlight_key;
		$item['title'] = "" . $result['title'];
		$item['time'] = $result['date_sub'];
		$item['uid'] = $result['uid'];
		$ret[] = $item;
		unset($item);
	}

	return $ret;
}

?>