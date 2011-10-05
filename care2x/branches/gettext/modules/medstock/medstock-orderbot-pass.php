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
define('MODULE','medstock');
define('LANG_FILE_MODULAR','medstock.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');
//gjergji
//$allowedarea=&$allow_area['depot'];
$userck="ck_medstock_user";
$breakfile="medstock.php ".URL_APPEND."&userck=$userck";
$fileforward="medstock.php ".URL_REDIRECT_APPEND."&userck=$userck&stb=1";
$title=$LDMediBotActivate; 
$thisfile="medstock-orderbot-pass.php";
$lognote="$title ok";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/helpers/inc_2level_reset.php'); 
setcookie('ck_2level_sid'.$sid,'',0,'/');

require($root_path.'include/helpers/inc_passcheck_internchk.php');
//gjergji
unset($allowedarea);
$allowedarea[] = '_a_2_meddepotreception';
if ($pass=='check') include($root_path.'include/helpers/inc_passcheck.php');
//end gjergji

$errbuf=$title;

$minimal=1;
require($root_path.'include/helpers/inc_passcheck_head.php');
?>
<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<P>
<img src="../../gui/img/common/default/box_arrow.gif" border=0 align="middle">
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b> <?php echo $title; ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>  
</BODY>
</HTML>
