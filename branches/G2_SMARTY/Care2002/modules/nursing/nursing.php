<?php

 error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

 require('./roots.php');

 require($root_path.'include/inc_environment_global.php');

 

 /**

 * CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25

 * GNU General Public License

 * Copyright 2002,2003,2004 Elpidio Latorilla

 * elpidio@latorilla.com

 *

 * See the file "copy_notice.txt" for the licence notice

 */

 

 

 define('LANG_FILE','nursing.php');

 define('NO_2LEVEL_CHK',1);

 require_once($root_path.'include/inc_front_chain_lang.php');

 

 /**

 * LOAD Smarty

 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so 

 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');

 $smarty = new smarty_care('nursing');



 // reset all 2nd level lock cookies

 require($root_path.'include/inc_2level_reset.php');

 

 $toggler=0;

 $breakfile=$root_path.'main/startframe.php'.URL_APPEND;

 

 require_once($root_path.'include/care_api_classes/class_ward.php');

 // Load the wards info 

 $ward_obj=new Ward;

 $items='nr,ward_id,name';

 $ward_info=&$ward_obj->getAllWardsItemsObject($items);

 

 $HTTP_SESSION_VARS['sess_file_return']=$top_dir.basename(__FILE__);

 /* Set this file as the referer */

 $HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);

 $HTTP_SESSION_VARS['sess_user_origin']='dept';

 $HTTP_SESSION_VARS['sess_parent_mod']='';

 

 /**

 * HEAD META definition

 */

 $smarty->assign('setCharSet',setCharSet()); 

 

 /**

 * collect JavaScript for Smarty

 */

 ob_start();

 require($root_path.'include/inc_js_gethelp.php');

 require($root_path.'include/inc_css_a_hilitebu.php');

 $sTemp = ob_get_contents();

 ob_end_clean();

 $smarty->assign('JavaScript',$sTemp); 

 



 /**

 * available wards, create the data

 */


 if(is_object($ward_info))

 {

  while($stations=$ward_info->FetchRow()) {

   $sWardInfo = $sWardInfo.'<tr><td><FONT face="Verdana,Helvetica,Arial" size=2><li> <a href="'.strtr('nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$stations['ward_id'].'&location_id='.$stations['ward_id'].'&ward_nr='.$stations['nr'],' ',' ').'"><font color="green"><b>'.strtoupper($stations['ward_id']).'</b></font></a> &nbsp;';

   $sWardInfo = $sWardInfo."\n";

   $sWardInfo = $sWardInfo.'</td><td><FONT face="Verdana,Helvetica,Arial" size=2>'.$stations['name'].'</td></tr>';

  }

  

 } else {

  $sWardInfo = $LDNoWardsYet.'<br><img '.createComIcon($root_path,'redpfeil.gif','0','absmiddle').'> <a href="nursing-station-manage-pass.php'.URL_APPEND.'">'.$LDClk2CreateWard.'</a>';


 }



 /**

 * ========= start with GUI - Block =======================

 */



 /**

 * Toolbar

 */

# Added for the html tag direction 

 $smarty->assign('HTMLtag',html_ret_rtl($lang));

 

 $smarty->assign('top_txtcolor',$cfg['top_txtcolor']);

 $smarty->assign('top_bgcolor',$cfg['top_bgcolor']);

 $smarty->assign('gifBack2',createLDImgSrc($root_path,'back2.gif','0') );



 # Added for the common header top block

 $smarty->assign('pb_href_back','javascript:window.history.back()');

 

 $smarty->assign('LDNursing',$LDNursing );

 

 # Added for the common header top block

 $smarty->assign('pb_href_help','javascript:gethelp(\'nursing.php\',\''.$LDNursing.'\')');

 

 $smarty->assign('gifHilfeR',createLDImgSrc($root_path,'hilfe-r.gif','0') );

 

 $smarty->assign('LDCloseAlt',$LDCloseAlt );

 $smarty->assign('gifClose2',createLDImgSrc($root_path,'close2.gif','0') );

 if($cfg['dhtml']) {

  $smarty->assign('dhtml','style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"');

 } else {

  $smarty->assign('dhtml','');

 }

 $smarty->assign('body_bgcolor',$cfg['body_bgcolor']);

 $smarty->assign('gifTeamWksp',createComIcon($root_path,'team_wksp.gif','0')) ;

 $smarty->assign('body_txtcolor',$cfg['body_txtcolor']);



 $smarty->assign('gifDwnArrowGrn',createComIcon($root_path,'dwn-arrow-grn.gif','0','absmiddle')) ;

 $smarty->assign('LDNursingStations',$LDNursingStations );

 $smarty->assign('LDNursingStationsTxt',$LDNursingStationsTxt );

 

 /**

 * Ward Info table

 */

 $smarty->assign('tblWardInfo',$sWardInfo);

 

 /**

 * menu

 */

 $smarty->assign('gifEye_s',createComIcon($root_path,'eye_s.gif','0') );

 $smarty->assign('LDQuickView',$LDQuickView );

 $sTemp = $root_path."modules/nursing/nursing-schnellsicht.php".URL_APPEND;

 $smarty->assign('LINKQuickView',$sTemp );

 $smarty->assign('LDQuickViewTxt',$LDQuickViewTxt );

 

 $smarty->assign('gifFindnew',createComIcon($root_path,'findnew.gif','0') );

 $smarty->assign('LDSearchPatient',$LDSearchPatient );

 $sTemp = $root_path."modules/nursing/nursing-patient-such-start.php".URL_APPEND;

 $smarty->assign('LINKSearch',$sTemp );

 $smarty->assign('LDSearchPatientTxt',$LDSearchPatientTxt );

 

 $smarty->assign('gifStorage',createComIcon($root_path,'storage.gif','0') );

 $smarty->assign('LDArchive',$LDArchive );

 $sTemp = $root_path."modules/nursing/nursing-station-archiv.php".URL_APPEND;

 $smarty->assign('LINKArchiv',$sTemp );

 $smarty->assign('LDArchiveTxt',$LDArchiveTxt );

 

 $smarty->assign('gifTimeplan',createComIcon($root_path,'timeplan.gif','0') );

 $smarty->assign('LDStationMan',$LDStationMan );

 $sTemp = $root_path."modules/nursing_or/nursing-or-main-pass.php?sid=$sid&lang=$lang&target=setpersonal&retpath=menu";

 $smarty->assign('LINKStationMan',$sTemp );

 $smarty->assign('LDStationManTxt',$LDStationManTxt );

 

 $smarty->assign('gifForums',createComIcon($root_path,'forums.gif','0') );

 $smarty->assign('LDNursesList',$LDNursesList );

 $sTemp = $root_path."modules/nursing_or/nursing-or-main-pass.php".URL_APPEND."&target=setpersonal&retpath=menu";

 $smarty->assign('LINKNursesList',$sTemp );

 $smarty->assign('LDNursesListTxt',$LDNursesListTxt );

 

 $smarty->assign('gifBubble',createComIcon($root_path,'bubble.gif','0') );

 $sTemp = $root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=36";

 $smarty->assign('LINKNews',$sTemp );

 $smarty->assign('LDNews',$LDNews );

 $smarty->assign('LDNewsTxt',$LDNewsTxt );

 $smarty->assign('LDCloseBack2Main',$LDCloseBack2Main );

 

 $smarty->assign('pbClose2',createLDImgSrc($root_path,'close2.gif','0') );

 $smarty->assign('breakfile',$breakfile);

 $smarty->assign('bot_bgcolor',$cfg['bot_bgcolor']);

 

 /**

 * show Copyright

 */

/* ob_start();

 require($root_path.'include/inc_load_copyrite.php');

 $sTemp = ob_get_contents();

 ob_end_clean();

*/ 

	

 $smarty->assign('sCopyright',$smarty->Copyright());

 $smarty->assign('sPageTime',$smarty->Pagetime());



 /**

 * show Template

 */

 $smarty->display('nursing/nursing.tpl');

 // $smarty->display('debug.tpl');

?>



