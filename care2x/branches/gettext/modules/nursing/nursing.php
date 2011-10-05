<?php
 error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
 require('./roots.php');
 require('../../include/helpers/inc_environment_global.php');

define('MODULE','nursing');
define('LANG_FILE_MODULAR','nursing.php');
 define('NO_2LEVEL_CHK',1);
 require_once($root_path.'include/helpers/inc_front_chain_lang.php');

// reset all 2nd level lock cookies
 require($root_path.'include/helpers/inc_2level_reset.php');

 $toggler=0;
 $breakfile=$root_path.'modules/news/start_page.php'.URL_APPEND;
///$db->debug=true;
 require_once($root_path.'include/core/class_ward.php');
 // Load the wards info 
 $ward_obj=new Ward;
 $items='nr,ward_id,name, dept_nr';
 $ward_info=&$ward_obj->getAllWardsItemsObject($items, $_SESSION['department_nr']);

 $_SESSION['sess_file_return']=$top_dir.basename(__FILE__);
 /* Set this file as the referer */
 $_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);
 $_SESSION['sess_user_origin']='dept';
 $_SESSION['sess_parent_mod']='';

 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme
 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

 # Create a helper smarty object without reinitializing the GUI
 $smarty2 = new smarty_care('common', FALSE);

 /**
 * available wards, create the data
 */

 if(is_object($ward_info))
 {
  while($stations=$ward_info->FetchRow()) {
   $sWardInfo = $sWardInfo.'<tr><td><a href="'.strtr('nursing-ward-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$stations['ward_id'].'&location_id='.$stations['ward_id'].'&ward_nr='.$stations['nr'].'&dept_nr='.$stations['dept_nr'],' ',' ').'"><div class="wardname"><li>'.strtoupper($stations['ward_id']).'&nbsp;</div></a> ';
   $sWardInfo = $sWardInfo."\n";
   $sWardInfo = $sWardInfo.'</td><td>'.$stations['name'].'</td></tr>';
  }

 } else {
  $sWardInfo = $LDNoWardsYet;
 }


 # Toolbar title
 $smarty->assign('sToolbarTitle',$LDNursing );
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for help button
 $smarty->assign('pbHelp','javascript:gethelp(\'nursing.php\',\''.$LDNursing.'\')');

 # Prepare the icons
 $aSubMenuIcon = array(createComIcon($root_path,'team_wksp.gif','0') ,
										createComIcon($root_path,'eye_s.gif','0') ,
										createComIcon($root_path,'findnew.gif','0'),
										createComIcon($root_path,'storage.gif','0'),
										createComIcon($root_path,'forums.gif','0'),
										createComIcon($root_path,'bubble.gif','0')
										);

# Prepare the submenu links indexed with their template tags

$aSubMenuItem = array('LDNursingStations' => $LDNursingStations." <img ".createComIcon($root_path,'dwn-arrow-grn.gif','0','absmiddle').">",
										'LDQuickView'  => "<a href=\"".$root_path."modules/nursing/nursing-quickview.php".URL_APPEND."\">$LDQuickView</a>",
										'LDSearchPatient'  => "<a href=\"".$root_path."modules/nursing/nursing-patient-search-start.php".URL_APPEND."\">$LDSearchPatient</a>",
										'LDArchive'  => "<a href=\"".$root_path."modules/nursing/nursing-ward-archive.php".URL_APPEND."\">$LDArchive</a>",
										'LDNursesList'  => "<a href=\"".$root_path."modules/nursing_or/nursing-or-main-pass.php".URL_APPEND."&target=setpersonal&retpath=menu\">$LDNursesList</a>",
										'LDNews'  => "<a href=\"".$root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=36\">$LDNews</a>"
										);

										
$aSubMenuText = array('',
										$LDQuickViewTxt,
										$LDSearchPatientTxt,
										$LDArchiveTxt,
										$LDNursesListTxt,
										$LDNewsTxt
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

 /**
 * Ward Info table
 */
 $smarty->assign('tblWardInfo',$sWardInfo);

# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/nursing.tpl');

 /**
 * show Template
 */

 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>