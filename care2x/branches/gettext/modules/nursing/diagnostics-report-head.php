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
define('MODULE','nursing');
define('LANG_FILE_MODULAR','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
$breakfile=$root_path."modules/nursing/nursing-ward-patientdata.php".URL_APPEND."&station=$station&pn=$pn&edit=$edit";

$bgc1='#fefefe'; 

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme
 
 # We set the 3rd parameter to FALSE to prevent initiliazing the copyright footer

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('nursing',TRUE,FALSE);

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDReports [ ".ucwords($header)." ]");
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/diagnostic_report.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # target for close button
 $smarty->assign('sCloseTarget','target="_top"');

 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>