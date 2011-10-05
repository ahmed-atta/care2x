<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');

define('MODULE','address');
define('LANG_FILE_MODULAR','place.php');
$local_user = 'aufnahme_user';
require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');

$breakfile = CARE_GUI."/main/plugin.php".URL_APPEND;

require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
$smarty = new smarty_care('system_admin');

// Title in toolbar
$smarty->assign('sToolbarTitle',"$LDAddress :: $LDManager");
$smarty->assign('LDBack', $LDBack);
$smarty->assign('LDHelp', $LDHelp);
$smarty->assign('LDClose', $LDClose);

// href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/address_manage.html");

// href for close button
$smarty->assign('breakfile',$breakfile);

// Window bar title
$smarty->assign('sWindowTitle',"$LDAddress :: $LDManager");


$menu = array(
	array(
			'link' => 'citytown_new.php' . URL_APPEND,
			'icon' => createComIcon(CARE_BASE,'form_pen.gif','0'),
			'linkname' => $LDNewData,
			'description' => $LDNewDataTxt
	),
	array(
			'link' => 'citytown_list.php' . URL_APPEND,
			'icon' => createComIcon(CARE_BASE,'form_pen.gif','0'),
			'linkname' => $LDListAll,
			'description' => $LDListAllTxt
	),
	array(
			'link' => 'citytown_search.php' . URL_APPEND,
			'icon' => createComIcon(CARE_BASE,'search_glass.gif','0'),
			'linkname' => $LDSearch,
			'description' => $LDSearchTxt
	),
);

$smarty->assign('menu',$menu);


// Assign page output to the mainframe template

/**
 * Show Template
 */

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/address_manage.tpl');

/*
$smarty->compile_check = true;
$smarty->debugging = true;
$smarty->display('debug.tpl');
*/

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');