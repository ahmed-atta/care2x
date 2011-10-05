<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','pharmacy');
define('LANG_FILE_MODULAR','pharmacy.php');
$local_user='ck_prod_db_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile='pharmacy.php'.URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Create a helper smarty object without reinitializing the GUI
 $smarty2 = new smarty_care('common', FALSE);

 # Title in the title bar
 $smarty->assign('sToolbarTitle',"$LDPharmacy::$LDPharmaDb");
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
 # href for the back button
// $smarty->assign('pbBack',$returnfile);

 # href for the help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/submenu1.html"); 
 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',"$LDPharmacy::$LDPharmaDb");

 # Prepare the submenu icons

 $aSubMenuIcon=array(					createComIcon($root_path,'settings_tree.gif','0'),
										createComIcon($root_path,'eyeglass.gif','0'),
										createComIcon($root_path,'discussions.gif','0')
										);

# Prepare the submenu item descriptions

$aSubMenuText=array(					$LDNewProductTxt,
										$LDSearchDb,
										$LDPharmaDbTxt
										);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array(					'LDNewProductTxt' => '<a href="'.$root_path.'modules/products/products-database-functions-insert.php'. URL_APPEND."&userck=$userck".'&cat=pharma">'.$LDNewProduct.'</a>',
										'LDSearchDb' => '<a href="'.$root_path.'modules/products/products-database-functions-such.php'. URL_APPEND."&userck=$userck".'&cat=pharma">'.$LDSearch.'</a>',
										'LDPharmaDbTxt' => '<a href="'.$root_path.'modules/products/products-database-functions-manage.php'. URL_APPEND."&userck=$userck".'&cat=pharma"><nobr>'.$LDManage.'</nobr></a>'
										);

# Create the submenu rows

$iRunner = 0;

while(list($x,$v)=each($aSubMenuItem)){
	$sTemp='';
	ob_start();
		if($cfg['icons'] != 'no_icon') $smarty2->assign('sIconImg','<img '.$aSubMenuIcon[$iRunner].'>');
		$smarty2->assign('sSubMenuItem',$v);
		$smarty2->assign('sSubMenuText',$aSubMenuText[$iRunner]);
		$smarty2->display(__DIR__ . '/view/submenu_row.tpl');
 		$sTemp = ob_get_contents();
 	ob_end_clean();
	$iRunner++;
	$smarty->assign($x,$sTemp);
}

# Assign the submenu items table to the subframe
$smarty->assign('sSubMenuRowsIncludeFile','products/menu_manage.tpl');

# Assign the subframe to the mainframe center block
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/submenu_tableframe.tpl');

  /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>