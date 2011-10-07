<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','../main');
define('LANG_FILE_MODULAR','special.php');
define('NO_2LEVEL_CHK',1);
require_once(CARE_BASE .'include/helpers/inc_front_chain_lang.php');
$breakfile='startframe.php'.URL_APPEND;
$thisfile=basename(__FILE__);

// reset all 2nd level lock cookies
require(CARE_BASE .'include/helpers/inc_2level_reset.php');

$_SESSION['sess_file_break']=$top_dir.$thisfile;
$_SESSION['sess_file_return']=$top_dir.$thisfile;
$_SESSION['sess_file_editor']='headline-edit-select-art.php';
$_SESSION['sess_file_reader']='headline-read.php';
$_SESSION['sess_title']=$LDEditTitle.'::'.$LDSubmitNews;
//$_SESSION['sess_user_origin']='main_start';
$_SESSION['sess_path_referer']=$top_dir.$thisfile;
$_SESSION['sess_dept_nr']=0; // reset the department number used in the session

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE .'include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Create a helper smarty object without reinitializing the GUI
 $smarty2 = new smarty_care('common', FALSE);

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDSpexFunctions);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDSpexFunctions')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDSpexFunctions);

 # Prepare the submenu icons

 $aSubMenuIcon=array(createComIcon(CARE_BASE ,'notepad.gif','0'),
					createComIcon(CARE_BASE ,'dollarsign.gif','0'),
					createComIcon(CARE_BASE ,'man-gr.gif','0'),
					createComIcon(CARE_BASE ,'lockfolder.gif','0'),
					createComIcon(CARE_BASE ,'home2.gif','0'),
					createComIcon(CARE_BASE ,'show.gif','0'),
					createComIcon(CARE_BASE ,'camera_s.gif','0'),
					createComIcon(CARE_BASE ,'video.gif','0'),
					createComIcon(CARE_BASE ,'post_discussion.gif','0'),
					createComIcon(CARE_BASE ,'calmonth.gif','0'),
					createComIcon(CARE_BASE ,'bubble.gif','0'),
					createComIcon(CARE_BASE ,'calendar.gif','0'),
					createComIcon(CARE_BASE ,'settings_tree.gif','0'),
					createComIcon(CARE_BASE ,'padlock.gif','0'),
					createComIcon(CARE_BASE ,'discussions.gif','0')
					);

# Prepare the submenu item descriptions

$aSubMenuText=array($LDPluginsTxt,
					$LDBillingTxt,
					$LDstaffMngmntTxt,
					$LDInsuranceCoMngrTxt,
					$LDAddressMngrTxt,
					$LDImmunizationMngrTxt,
					$LDPhotoLabTxt,
					$LDWebCamTxt,
					$LDStandbyDutyTxt,
					$LDCalendarTxt,
					$LDNewsTxt,
					$LDCalcTxt,
					$LDUserConfigOptTxt,
					$LDAccessPwTxt,
					$LDNewsgroupTxt
					);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDPlugins' => '<a href="'.'../plugins/plugins.php'.URL_APPEND.'">'.$LDPlugins.'</a>',
					'LDBilling' => '<a href="../modules/ecombill/ecombill_pass.php'.URL_APPEND.'">'. $LDBilling.'</a>',
					'LDstaffMngmnt' => '<a href="../modules/staff_admin/staff_admin_pass.php'.URL_APPEND.'&retpath=spec&target=staff_reg">'.$LDstaffMngmnt.'</a>',
					'LDInsuranceCoMngr' => '<a href="../modules/insurance_co/insurance_co_manage_pass.php'.URL_APPEND.'">'. $LDInsuranceCoMngr.'</a>',
					'LDAddressMngr' => '<a href="../modules/address/address_manage_pass.php'.URL_APPEND.'">'. $LDAddressMngr.'</a>',
					'LDImmunizationMngr' => '<a href="../modules/immunization/immunization_manage_pass.php'.URL_APPEND.'">'. $LDImmunizationMngr.'</a>',
					'LDPhotoLab' => '<a href="../modules/photolab/photolab_pass.php'.URL_APPEND.'&ck_config='.$ck_config.'">'.$LDPhotoLab.'</a>',
					'LDWebCam' => '<a href="../modules/video_monitor/video_monitoring.php'.URL_APPEND.'">'.$LDWebCam.'</a>',
					'LDStandbyDuty' => '<a href="../modules/nursing_or/standby-duty.php'.URL_APPEND.'&retpath=spec">'.$LDStandbyDuty.'</a>',
					'LDCalendar' => '<a href="../modules/calendar/calendar.php'.URL_APPEND.'">'. $LDCalendar.'</a>',
					'LDNews' => '<a href="../modules/news/editor-pass.php'.URL_APPEND.'&dept_nr=1&title='.$LDEditTitle.'">'.$LDNews.'</a>',
					'LDCalc' => '<a href="../modules/tools/calculator.php'.URL_APPEND.'">'. $LDCalc.'</a>',
					'LDUserConfigOpt' => '<a href="../modules/tools/config_options.php'.URL_APPEND.'">'. $LDUserConfigOpt.'</a>',
					'LDAccessPw' => '<a href="../modules/myintranet/my-passw-change.php'.URL_APPEND.'">'. $LDAccessPw.'</a>',
					'LDNewsgroup' => '<a href="http://www.mail-archive.com/care2002-developers@lists.sourceforge.net/">'.$LDNewsgroup.'</a>'
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

# Create conditional submenu items

if(($cfg['bname']=="msie")&&($cfg['bversion']>4)){
	$sTemp='';
	ob_start();
		if($cfg['icons'] != 'no_icon') $smarty2->assign('sIconImg','<img '.createComIcon(CARE_BASE ,'uhr.gif','0').'>');
		$smarty2->assign('sSubMenuItem','<a href="'.CARE_BASE .'modules/tools/clock.php?sid='.$sid.'&lang='.$lang.'">'.$LDClock.'</a>');
		$smarty2->assign('sSubMenuText',$LDDigitalClock);
		$smarty2->display(__DIR__ . '/view/submenu_row.tpl');
 		$sTemp = ob_get_contents();
 	ob_end_clean();

	$smarty->assign('LDClock',$sTemp);
	$smarty->assign('bShowClock',TRUE);
}

# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/submenu_specialtools.tpl');

 /**
 * show Template
 */

 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>