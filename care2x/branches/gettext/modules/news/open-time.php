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
define('MODULE','news');
define('LANG_FILE_MODULAR','news.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
$breakfile=$root_path.'modules/news/start_page.php'.URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDOpenHrsTxt);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp()");
 # href for close file
 $smarty->assign('breakfile',$breakfile);
 # href for return file
 //$smarty->assign('pbBack',$returnfile);

 # Window title
 $smarty->assign('title',$LDOpenHrsTxt);

 # Buffer the page output

 $smarty->assign('LDDayTxt', $LDDayTxt); 
 $smarty->assign('LDOpenHrsTxt',$LDOpenHrsTxt);
 $smarty->assign('LDChkHrsTxt',$LDChkHrsTxt);

 $sTemp = '';

 for ($i=0;$i<sizeof($LDOpenDays);$i++){
 
 	$smarty->assign('sOpenDay',$LDOpenDays[$i]);
 	$smarty->assign('sOpenTimes',$LDOpenTimes[$i]);
 	$smarty->assign('sVisitTimes',$LDVisitTimes[$i]);

 	ob_start();
		$smarty->display(CARE_BASE . 'view/opentimes_row.tpl');
 		$sTemp = $sTemp.ob_get_contents();
 	ob_end_clean();

}

$smarty->assign('sOpenTimesRows',$sTemp);

$smarty->assign('sBreakFile','<a href="'.$breakfile.'" class="button icon arrowleft">Back</a>');

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/opentimes_table.tpl');

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>