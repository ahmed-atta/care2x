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
define('MODULE','or_logbook');
define('LANG_FILE_MODULAR','or_logbook.php');
define('NO_2LEVEL_CHK',1);
require_once(CARE_BASE .'include/helpers/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

setcookie(firstentry,''); // The cookie "firsentry" is used for switching the cat image

/* Check the start script as break destination*/
if (!empty($_SESSION['sess_path_referer'])&&($_SESSION['sess_path_referer']!=$top_dir.$thisfile)){
	if(file_exists(CARE_BASE .$_SESSION['sess_path_referer'])){
		$breakfile=$_SESSION['sess_path_referer'];
	}else {
		/* default startpage */
		$breakfile = 'main/startframe.php';
	}
} else {
	/* default startpage */
	$breakfile = 'main/startframe.php';
}
$breakfile=CARE_GUI .$breakfile.URL_APPEND;

// reset all 2nd level lock cookies
require(CARE_BASE .'include/helpers/inc_2level_reset.php');

$_SESSION['sess_path_referer']=$top_dir.$thisfile;

# Start Smarty templating here
/**
 * LOAD Smarty
 */

# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme

require_once(CARE_BASE .'include/helpers/smarty_care.class.php');
$smarty = new smarty_care('common');

# Module title in the toolbar

$smarty->assign('sToolbarTitle',$LDOr);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
# Help button href
$smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDOr')");

$smarty->assign('breakfile',$breakfile);

# Window bar title
$smarty->assign('title',$LDOr);

# Append javascript code to javascript block

$smarty->append('JavaScript',$sTemp);

# Create the submenu blocks

# OR Surgeons submenu block

$smarty->assign('LDOrDocs',"<h2>Physician/Surgeon</h2>");
//ALog
$smarty->assign('LDOrDocument',"<a href=\"".CARE_GUI ."modules/op_document/op-docu-pass.php".URL_APPEND."\">$LDOrDocument</a>");
$smarty->assign('LDOrDocumentTxt',$LDOrDocumentTxt);
$smarty->assign('LDOrDocumentMenu',
  '<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd border=0>
			<TR>
				<TD bgColor=#ffffff>
				<font face=arial,verdana size=2>
				- <A href="' . CARE_GUI  . 'modules/op_document/op-docu-pass.php' . URL_REDIRECT_APPEND . '&target=entry">' . $LDNewDocu . '</A>
				- <A href="' . CARE_GUI  . 'modules/op_document/op-docu-pass.php' . URL_REDIRECT_APPEND . '&target=search">' . $LDSearch . '</A>
				- <A href="' . CARE_GUI  . 'modules/op_document/op-docu-pass.php' . URL_REDIRECT_APPEND . '&target=archiv">' . $LDArchive . '</A>
				</font>
				</TD>
			</TR>
	</TABLE>');

$smarty->assign('LDQviewDocs',"<a href=\"".CARE_GUI ."modules/doctors/doctors-roster-quickview.php".URL_APPEND."&retpath=op\">$LDDOC $LDQuickView</a>");
$smarty->assign('LDQviewTxtDocs',$LDQviewTxtDocs);

# OR Nursing submenu block

$smarty->assign('LDOrNursing',"<h2>Nursing</h2>");
//PLog
$smarty->assign('LDOrLogBook',"<a href=\"".CARE_GUI ."modules/or_logbook/op-care-log-pass.php".URL_APPEND."\">$LDOrLogBook</a>");
$smarty->assign('LDOrLogBookTxt',$LDOrLogBookTxt);
$smarty->assign('LDOrLogBookMenu',
  		'<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd border=0>
			<TR>
				<TD bgColor=#ffffff><font face=arial,verdana size=2><nobr> 
				- <A href="' . CARE_GUI  . 'modules/or_logbook/op-care-log-pass.php' . URL_REDIRECT_APPEND.'&target=entry";>'.  $LDNewDocu .'</A>
				- <A href="'. CARE_GUI  .'modules/or_logbook/op-care-log-pass.php' .  URL_REDIRECT_APPEND . '&target=search";">' .  $LDSearch . '</A> 
				- <A href="'.  CARE_GUI  . 'modules/or_logbook/op-care-log-pass.php' .  URL_REDIRECT_APPEND . '&target=archiv";">' .  $LDArchive . '</A>
				</font></TD>
			</TR>
		</TABLE>');
$smarty->assign('LDORNOCQuickView',"<a href=\"".CARE_GUI ."modules/nursing_or/nursing-or-roster-quickview.php".URL_APPEND."\">$LDORNOC $LDQuickView</a>");
$smarty->assign('LDQviewTxtNurse',$LDQviewTxtNurse);
//PDienstplan
$smarty->assign('LDORNOCScheduler',"<a href=\"".CARE_GUI ."modules/nursing_or/nursing-or-main-pass.php".URL_APPEND."&retpath=menu&target=dutyplan\">$LDORNOC $LDScheduler </a>");
$smarty->assign('LDDutyPlanTxt',$LDDutyPlanTxt);
$smarty->assign('LDDutyPlanMenu',
  		  		'<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd border=0>
				<TR>
					<TD bgColor=#ffffff><font face=arial,verdana size=2> 
					- <A href="'.CARE_GUI .'modules/nursing_or/nursing-or-roster.php'. URL_REDIRECT_APPEND.'&retpath=menu">'. $LDSee .'</A> 
					- <A href="'.CARE_GUI .'modules/nursing_or/nursing-or-main-pass.php'.URL_REDIRECT_APPEND.'&retpath=menu&target=dutyplan">'.$LDCreate . '/' . $LDUpdate .'</A> 
					- <A href="'.CARE_GUI .'modules/nursing_or/nursing-or-main-pass.php'. URL_REDIRECT_APPEND.'&target=setpersonal&retpath=menu">' . $LDCreatePersonList .'</A>
					</font></TD>
				</TR>
		</TABLE>');

$smarty->assign('LDOnCallDuty',"<a href=\"standby-duty.php".URL_APPEND."&retpath=op&encoder=".$_COOKIE['ck_login_username'.$sid]."\">$LDOnCallDuty</a>");
$smarty->assign('LDOnCallDutyTxt',$LDOnCallDutyTxt);

# OR Anesthesia submenu block

$smarty->assign('LDORAnesthesia',"<h2>Anaesthesia</h2>");

$smarty->assign('LDORAnaQuickView',"<a href=\"".CARE_GUI ."modules/nursing_or/nursing-or-roster-quickview.php".URL_APPEND."&retpath=menu&hilitedept=39\">$LDQuickView</a>");
$smarty->assign('LDQviewTxtAna',$LDQviewTxtAna);
//AnaDienstplan
$smarty->assign('LDORAnaNOCScheduler',"<a href=\"".CARE_GUI ."modules/nursing_or/nursing-or-roster.php".URL_APPEND."&dept_nr=39&retpath=menu\" >$LDORNOC $LDScheduler</a>");
$smarty->assign('LDORAnaNOCSchedulerMenu',
  		  		'<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd border=0>
			<TR>
				<TD bgColor=#ffffff><font face=arial,verdana size=2>
				- <A href="' . CARE_GUI  . 'modules/nursing_or/nursing-or-roster.php'.URL_REDIRECT_APPEND.'">'. $LDSee .'</A>
				- <A href="' . CARE_GUI  . 'modules/nursing_or/nursing-or-main-pass.php'.URL_REDIRECT_APPEND.'">'. $LDCreate . '/' . $LDUpdate  .'</A>
				</font></TD>
			</TR>
		</TABLE>');

# Collect div codes for  on-mouse-hover pop-up menu windows

$sTemp='';
ob_start();

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->assign('sOnHoverMenu',$sTemp);

# Assign the submenu to the mainframe center block

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/submenu_or.tpl');

/**
 * show  Mainframe Template
 */

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
?>