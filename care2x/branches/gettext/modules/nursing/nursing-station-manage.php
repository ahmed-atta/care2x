<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile="nursing.php".URL_APPEND;

# Start the smarty templating
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Added for the common header top block

 $smarty->assign('sToolbarTitle',$LDNursingManage);

 $smarty->assign('pbHelp',"javascript:gethelp('nursing_ward_mng.php','main')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDNursingManage);
 
 # Assign submenu items
 $smarty->assign('LDProfile',$LDProfile);
 $smarty->assign('sCreate',"<a href=\"nursing-ward-new.php".URL_APPEND."&mw=1&station=$ck_thispc_station&name=$ck_thispc_dept\"><b>$LDCreate</b></a>");
 $smarty->assign('LDNewStation',$LDNewStation);
 
 if ($ck_thispc_station) $mode="show";
 $smarty->assign('sShowStationData',"<a href=\"nursing-ward-info.php".URL_APPEND."&mode=$mode&station=$ck_thispc_station\"><b>$LDShowStationData</b></a>");

 $smarty->assign('LDShowStationDataTxt',$LDShowStationDataTxt);
 
 $smarty->assign('sCancel','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'cancel.gif','0').' border="0"></a>');

# Assign the include file to main frame template

 $smarty->assign('sMainBlockIncludeFile','nursing/ward_manage_submenu.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
