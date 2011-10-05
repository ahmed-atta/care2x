<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
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
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['edp'];
$breakfile='admin.php?sid='.$sid.'&lang='.$lang;

switch($target)
{
	case 'adminlogin':	$title=$LDSystemLogin;
								//$userck='ck_admin_admin_user';
								$fileforward='admin_system_admin_mframe.php?lang='.$lang.'&sid='.$sid;
								break;
	case 'currency_admin':	$title=$LDSystemLogin;
								//$userck='ck_admin_admin_user';
								$fileforward="admin_system_format_currency_add.php?sid=$sid&lang=$lang&from=$from";
								break;
	case 'modulgenerator':	$title=$LDSystemLogin;
								//$userck='ck_admin_admin_user';
								$fileforward=$root_path."modules/system_admin/sub_modul_neu.php?sid=$sid&lang=$lang&from=$from";
								break;
	default:{header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}

$userck='ck_admin_user';
$thisfile='admin_main-pass.php';
$lognote="$title ok";

// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/helpers/inc_2level_reset.php'); setcookie('ck_2level_sid'.$sid,'');

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/helpers/inc_passcheck.php');

$errbuf=$title;
$minimal=1;
require($root_path.'include/helpers/inc_passcheck_head.php');
?>
<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<P>
<img src="../../gui/img/common/default/kwheel.gif" border=0 align="middle">
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo $title ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>  
</BODY>
</HTML>
