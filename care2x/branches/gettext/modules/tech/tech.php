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
// reset all 2nd level lock cookies
require($root_path.'include/helpers/inc_2level_reset.php');

if(!isset($_SESSION['sess_path_referer'])) $_SESSION['sess_path_referer'] = "";
if(!isset($_SESSION['sess_file_return'])) $_SESSION['sess_file_return'] = "";
if(!isset($_SESSION['sess_file_forward'])) $_SESSION['sess_file_forward'] = "";

$breakfile=$root_path.$_SESSION['sess_path_referer'];

if(!file_exists($breakfile)) {
    $breakfile=$root_path.'main/startframe.php';
}

$breakfile=$breakfile.URL_APPEND;
$returnfile=$breakfile;

$_SESSION['sess_file_return']=basename(__FILE__);
$_SESSION['sess_path_referer']=str_replace($doc_root.'/','',__FILE__);

if(!isset($stb)) $stb=0;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Create a helper smarty object without reinitializing the GUI
 $smarty2 = new smarty_care('common', FALSE);

# Added for the common header top block

 $smarty->assign('sToolbarTitle',$LDTechSupport);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # Added for the common header top block
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/submenu1.html"); 
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDTechSupport);

  # Add the bot onLoad code
 if(isset($stb)){
 	if($stb==1) $smarty->assign('sOnLoadJs','onLoad="startbot(\'r\')"');
 	else if($stb==2) $smarty->assign('sOnLoadJs','onLoad="startbot(\'f\')"');
 }
 
 # Collect extra javascript code

 ob_start();

?>
<script language="javascript" >
<!--
<?php  

if($stb)
echo '
function startbot(d)
{
	if(d=="r") repabotwin=window.open("tech-repabot.php'.URL_REDIRECT_APPEND.'","repabotwin","width=300,height=150,menubar=no,resizable=yes,scrollbars=yes");
	else if(d=="f") fragebotwin=window.open("tech-question-bot.php'.URL_REDIRECT_APPEND.'","fragebotwin","width=300,height=150,menubar=no,resizable=yes,scrollbars=yes");
}
';
?>
// -->
</script>

<?php

	$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

 # Prepare the submenu icons

 $aSubMenuIcon=array(createComIcon($root_path,'settings_tree.gif','0'),
										createComIcon($root_path,'sitemap_animator.gif','0'),
										createComIcon($root_path,'icn_rad.gif','0'),
										createComIcon($root_path,'eyeglass.gif','0'),
										createComIcon($root_path,'discussions.gif','0'),
										createComIcon($root_path,'sitemap_animator.gif','0')
										);

# Prepare the submenu item descriptions

$aSubMenuText=array($LDReRepairTxt,
										$LDRepairbotActivateTxt,
										$LDRepairReportTxt,
										$LDReportsArchiveTxt,
										$LDQuestionsTxt,
										$LDQBotActivateTxt
										);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDPharmaOrder' => "<a href=\"tech-repair-request.php".URL_APPEND."\">$LDReRepair</a>",
										'LDHow2Order' => "<a href=\"tech-bot-pass.php".URL_APPEND."&mode=repabot\">$LDRepairbotActivate</a>",
										'LDOrderCat' => "<a href=\"tech-repair-advice.php".URL_APPEND."\">$LDRepairReport</a>",
										'LDOrderArchive' => "<a href=\"tech-report-archive.php".URL_APPEND."\">$LDReportsArchive</a>",
										'LDPharmaDb' => "<a href=\"tech-questions.php".URL_APPEND."\">$LDQuestions</a>",
										'LDOrderBotActivate' => "<a href=\"tech-bot-pass.php".URL_APPEND."&mode=fragebot\">$LDQBotActivate</a>",
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

# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/submenu_technik.tpl');

  /**
 * show Template
 */

 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
?>