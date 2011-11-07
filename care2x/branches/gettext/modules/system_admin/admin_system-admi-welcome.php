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
if(isset($ck_admin_admin_user)) setcookie('ck_edvzugang_user',$ck_admin_admin_user);
$breakfile='admin.php'.URL_APPEND;
$_SESSION['sess_file_return']=basename(__FILE__);

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDEDP $LDSystemAdmin");
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/system_admin.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDEDP $LDSystemAdmin");

 # Buffer page output
 ob_start();

?>
<br><ul>
<FONT    SIZE=2  FACE="verdana,Arial">
<?php echo $LDWelcome ?> <FONT    SIZE=3 color=#800000 FACE="Arial"><b><?php echo $_COOKIE[$local_user.$sid];?></b></font>. <p>
<?php echo $LDForeWord ?></font><p>

<p>
<a href="<?php echo $breakfile ?>" target="_parent" class="button icon remove danger">Cancel</a>
</ul>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the data  to the main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>