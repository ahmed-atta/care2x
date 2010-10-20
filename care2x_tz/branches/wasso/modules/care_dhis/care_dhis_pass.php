<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

$lang_tables=array('care_dhis.php','actions.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['care_dhis'];
$append=URL_REDIRECT_APPEND;

$fileforward='./care_dhis_menu.php?sid='.$sid.'=false&lang=en';

$lognow='Care2x DHIS Login Ok..';

$thisfile=basename(__FILE__);

$userck='aufnahme_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'',0,'/');
require($root_path.'include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'',0,'/');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check')
	include($root_path.'include/inc_passcheck.php');

$errbuf=$LDAdmission;

require($root_path.'include/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php
$buf='Import / Export'.' :: '.$LDLogin;
echo '
<script language=javascript>
<!--
 if (window.screen.width)
 { if((window.screen.width)>1000) document.write(\'<img '.createComIcon($root_path,'smiley.gif','0','top').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>\');}
 //-->
 </script>';

 ?>


<table width=100% border=0 cellpadding="0" cellspacing="0">
<?php
$maskBorderColor='#66ee66';
require($root_path.'include/inc_passcheck_mask.php')
?>

<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
