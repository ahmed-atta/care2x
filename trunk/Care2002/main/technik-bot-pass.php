<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");

require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['tech'];

$breakfile="technik.php?sid=$ck_sid&lang=$lang";

if($mode=="fragebot")
{ $fileforward="technik.php?sid=$ck_sid&lang=$lang&mode=$mode&stb=2"; 
	$title=$LDQBotActivate; 
}
else 
{
	$fileforward="technik.php?sid=$ck_sid&lang=$lang&mode=$mode&stb=1";
	$title=$LDRepabotActivate;
}

$thisfile="technik-bot-pass.php";
$lognote="$title ok";

$userck="ck_technik_repabot_user";

//reset cookie;
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

$errbuf=$title;

$minimal=1;
require("../req/passcheck_head.php");
?>

<BODY  <? if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b> <? print $title; ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<? require("../req/passcheck_mask.php") ?>  

<p>
<img src="../img/small_help.gif" border=0 width=20 height=20> <a href="ucons.php"><? print "$LDIntro2 $title"; ?></a><br>
<img src="../img/small_help.gif" border=0 width=20 height=20> <a href="ucons.php"><? print "$LDWhat2Do $title"; ?>?</a><br>
<HR>
<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>


</FONT>


</BODY>
</HTML>
