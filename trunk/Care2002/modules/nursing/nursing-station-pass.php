<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//error_reporting(E_WARNING);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'global_conf/areas_allow.php');

//if(!session_is_registered('sess_nursing_station')) session_register('sess_nursing_station');
//if(isset($station)&&!empty($station)) $HTTP_SESSION_VARS['sess_nursing_station']=$station;

$allowedarea=&$allow_area['wards'];

//$fileforward="nursing-station.php".URL_REDIRECT_APPEND."&edit=$edit&retpath=$retpath&station=".$HTTP_SESSION_VARS['sess_nursing_station'];
$fileforward="nursing-station.php".URL_REDIRECT_APPEND."&edit=$edit&retpath=$retpath&station=$station&ward_nr=$ward_nr";
//$fileforward="nursing-station.php?sid=$sid&edit=$edit&retpath=$retpath&station=$station";
$thisfile="nursing-station-pass.php";
if($retpath=="quick") $breakfile="nursing-schnellsicht.php".URL_APPEND;
 else $breakfile="nursing.php".URL_APPEND;

$lognote="$LDNursingStation $station ok";
 
$userck="ck_pflege_user";
//echo $fileforward;
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/inc_2level_reset.php'); 
setcookie('ck_2level_sid'.$sid,'',0,'/');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf="$LDNursingStation $station";

//$minimal=0;

require($root_path.'include/inc_passcheck_head.php');
?>
<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,'monitor2.gif','0','absmiddle') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo "$LDNursingStation $station" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
