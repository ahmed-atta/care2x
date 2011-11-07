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
define('MODULE','system_admin');
define('LANG_FILE_MODULAR','system_admin.php');
$local_user='ck_admin_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile='admin_system-admi-welcome.php'.URL_APPEND;
$thisfile=basename(__FILE__);

$GLOBAL_CONFIG=array();
require_once($root_path.'include/core/class_globalconfig.php');
# Create object linking our global config array to the object
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Save data if save mode
if(isset($mode)&&$mode=='save'){

	$filter='main_info_'; # The index filter
	$numeric=FALSE; # Values are not strictly numeric
	$addslash=TRUE; # Slashes should be added to the stored values

	# Save the configuration
	$glob_obj->saveConfigArray($_POST,$filter,$numeric,'',$addslash);

	# Loop back to self to get the newly stored values
	header("location:$thisfile".URL_REDIRECT_APPEND."&save_ok=1");
	exit;

# Else get current global data
}else{ 
	$glob_obj->getConfig('main_info%');
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDQuickInformer);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/quickinfo.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDQuickInformer);

 # Assign prompt if saved
 if(isset($save_ok)&&$save_ok){
	$smarty->assign('LDDataSaved',$LDDataSaved);
  }

 # Assign prompt
$smarty->assign('LDEnterInfo',$LDEnterInfo);

 # Assign form elements
$smarty->assign('LDPhonePolice',$LDPhonePolice);
$smarty->assign('LDPhoneFire',$LDPhoneFire);
$smarty->assign('LDAmbulance',$LDAmbulance);
$smarty->assign('LDPhone',$LDPhone);
$smarty->assign('LDFax',$LDFax);
$smarty->assign('LDAddress',$LDAddress);
$smarty->assign('LDEmail',$LDEmail);

# Assign input values
$smarty->assign('main_info_police_nr',$GLOBAL_CONFIG['main_info_police_nr']);
$smarty->assign('main_info_fire_dept_nr',$GLOBAL_CONFIG['main_info_fire_dept_nr']);
$smarty->assign('main_info_emgcy_nr',$GLOBAL_CONFIG['main_info_emgcy_nr']);
$smarty->assign('main_info_phone',$GLOBAL_CONFIG['main_info_phone']);
$smarty->assign('main_info_fax',$GLOBAL_CONFIG['main_info_fax']);
$smarty->assign('main_info_address',$GLOBAL_CONFIG['main_info_address']);
$smarty->assign('main_info_email',$GLOBAL_CONFIG['main_info_email']);

# Create and assign save button
$smarty->assign('sSave','<input type="image" '.createLDImgSrc($root_path,'savedisc.gif','0').'>
	<input type="hidden" name="sid" value="'.$sid.'">
	<input type="hidden" name="lang" value="'.$lang.'">
	<input type="hidden" name="mode" value="save">');

# Cancel button
$smarty->assign('sCancel','<a href="'.$breakfile.'" class="button icon remove danger">Cancel</a>');

# Assign template as include file to the mainframe template

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/quick_informer.tpl');
 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>