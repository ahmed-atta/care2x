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
define('MODULE','supplier');
define('LANG_FILE_MODULAR','supplier.php');
$local_user='ck_supply_db_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
$breakfile=$root_path.'modules/medstock/medstock.php '.URL_APPEND;


/**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common',TRUE,FALSE);
 
 # Hide title bar
 $smarty->assign('bHideTitleBar',TRUE);

 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/products.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle','');

 $smarty->assign('LDCatalog',$LDCatalogSupplier);
 $smarty->assign('LDBasket',$LDBasket);
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/ordering_header.tpl');

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
?>