<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

require("../req/config-color.php");

require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['edp'];

switch($target)
{
	case "sqldb":		 $title=$LDSqlDb;
								$userck="ck_edv_mysql_user";
								$fileforward="../phpmyadmin/index.php3?sid=$ck_sid&lang=$lang&fwck=$userck";
								//$fileforward="../start.php";
								break;
								
	case "adminlogin":	$title=$LDSystemLogin;
								$userck="ck_edv_admin_user";
								$fileforward="edv-system-admi-menu.php?sid=$ck_sid&lang=$lang&fwck=$userck";
								break;
	default:{header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

$thisfile="edv-main-pass.php";
$breakfile="edv.php?sid=$ck_sid&lang=$lang";
$lognote="$title ok";

setcookie($userck,"");

if($ck_login_logged&&$ck_login_userid&&!$nointern)
{
$userid=$ck_login_userid;
$checkintern=1;
$lognote="Direct access ".$lognote;
$pass="check";
}

if ($pass=="check") 	
	include("../req/passcheck.php");

$errbuf="$LDMedDepot $title";
$minimal=1;
require("../req/passcheck_head.php");
?>

<BODY  <? if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?=$title ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<? require("../req/passcheck_mask.php") ?>  

<p>
<!-- <img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDIntro2 $title " ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDWhat2Do $title " ?>?</a><br>
 --><HR>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>


</FONT>


</BODY>
</HTML>
