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

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['tech'];

$breakfile='tech.php?sid='.$sid.'&lang='.$lang;

if($mode=='fragebot')
{ $fileforward="tech.php".URL_REDIRECT_APPEND."&mode=$mode&stb=2"; 
	$title=$LDQBotActivate; 
}
else 
{
	$fileforward="tech.php?sid=$sid&lang=$lang&mode=$mode&stb=1";
	$title=$LDRepabotActivate;
}

$thisfile='tech-bot-pass.php';
$lognote="$title ok";


$userck='ck_technik_repabot_user';

//reset cookie;
// reset all 2nd level lock cookies

setcookie($userck.$sid,'',0,'/');
require($root_path.'include/helpers/inc_2level_reset.php');
setcookie('ck_2level_sid'.$sid,'',0,'/');

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

<p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../../gui/img/common/default/tools.gif" border=0 width=48 height=48>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b> <?php echo $title; ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>  
<p>
</BODY>
</HTML>
