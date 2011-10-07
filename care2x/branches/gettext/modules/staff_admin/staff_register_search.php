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

define('MODULE','staff_admin');
define('LANG_FILE_MODULAR','staff_admin.php');
$local_user='aufnahme_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');


if(empty($target)) $target='search';


if($_COOKIE['ck_login_logged'.$sid]) $breakfile=$root_path.'main/plugin.php'.URL_APPEND;
	else $breakfile='staff_admin_pass.php'.URL_APPEND.'&target='.$target;


# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDPatientRegister." - ".$LDSearch);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/person_how2search.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDPatientRegister." - ".$LDSearch);

  # Body onLoad Javascript code
 $smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()"');

# Colllect javascript code

ob_start();

?>
<table width=100% border=0 cellspacing="0" cellpadding=0>

<?php
/* Create the tabs */
$tab_bot_line='#66ee66'; // Set the horizontal bottom line color
require('./gui_bridge/default/gui_tabs_staff_reg.php');
?>
</table>

<ul>

<?php 
/* If the origin is admission link, show the search prompt */
if(isset($origin) && $origin=='pass')
{
?>
<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    
  </tr>
</table>

<?php 
}


require_once($root_path.'modules/registration_admission/model/class_gui_search_person.php');

$psearch = & new GuiSearchPerson;

$psearch->setTargetFile('person_register_show.php');

$psearch->setCancelFile($root_path.'main/plugin.php');

# Set to TRUE if you want to auto display a single result
//$psearch->auto_show_byalphanumeric =TRUE;
# Set to TRUE if you want to auto display a single result based on a numeric keyword
# usually in the case of barcode scanner data
$psearch->auto_show_bynumeric = TRUE;

$psearch->setPrompt($LDEnterPersonSearchKey);

//$psearch->pretext=$sTemp;

$psearch->display();

?>
</ul>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>