<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

require("../req/config-color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['wards'];

$fileforward="pflege-station.php?sid=$ck_sid&lang=$lang&edit=$edit&station=$station&retpath=$retpath";
$thisfile="pflege-station-pass.php";
if($retpath=="quick") $breakfile="pflege-schnellsicht.php?sid=$ck_sid&lang=$lang";
 else $breakfile="pflege.php?sid=$ck_sid&lang=$lang";

$lognote="$LDNursingStation $station ok";
 
$userck="ck_pflege_user";

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

$errbuf="$LDNursingStation $station";

require("../req/passcheck_head.php");
?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/monitor2.gif" width=85 height=91 border=0 align="absmiddle">
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?="$LDNursingStation $station" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<? require("../req/passcheck_mask.php") ?>  

<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
