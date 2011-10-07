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
define('MODULE','tech');
define('LANG_FILE_MODULAR','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
$breakfile='tech.php'.URL_APPEND;
$returnfile=$_SESSION['sess_file_return'].URL_APPEND;
$_SESSION['sess_file_return']='tech.php';

if($repair=='ask'){
 	$target=$LDRequest;
	$returnfile='tech-repair-request.php?sid='.$sid.'&lang='.$lang;
}else{
  $target=$LDReport;
  $returnfile='tech-repair-advice.php?sid='.$sid.'&lang='.$lang;
}

# Load date formatter
require_once($root_path.'include/helpers/inc_date_format_functions.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDTechSupport);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/tech_ack.html"); 
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDTechSupport);

$smarty->assign('sButton','<img '.createComIcon($root_path,'varrow.gif','0').'>');

$smarty->assign('LDAck',$LDAck);
$smarty->assign('LDThanksSir',$LDThanksSir); 
$smarty->assign('reporter',$reporter); 
$smarty->assign('LDYour',$LDYour); 
$smarty->assign('target',$target);
$smarty->assign('LDReceived',$LDReceived); 
$smarty->assign('sDate',@formatDate2Local($tdate,$date_format)); 
$smarty->assign('LDAt',$LDAt);
$smarty->assign('sTime',@convertTimeToLocal($ttime));
$smarty->assign('LDAtTech',$LDAtTech); 

$smarty->assign('pbOK','<FORM action="'.$returnfile.'" >
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<INPUT type="submit"  value="  OK  "></font></FORM>');

$smarty->assign('sRepairLink','<a href="tech-repair-request.php'.URL_APPEND.'">'.$LDReRepairTxt.'</a>');
$smarty->assign('sReportLink','<a href="tech-repair-advice.php'.URL_APPEND.'">'.$LDRepairReportTxt.'</a>');
$smarty->assign('sQuestionLink','<a href="tech-questions.php'.URL_APPEND.'">'.$LDQuestionsTxt.'</a>');

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/acknowledge.tpl');

 /**
 * show Template
 */

 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>