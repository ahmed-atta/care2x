<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");

require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['wards'];

$fileforward="pflege-station-manage.php?sid=$ck_sid&lang=$lang";
$thisfile="pflege-station-manage-pass.php";
$breakfile="pflege.php?sid=$ck_sid&lang=$lang";

$lognote="$LDNursingManage ok";

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

$errbuf=$LDNursingManage;

require("../req/passcheck_head.php");
?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/monitor2.gif" width=85 height=91 border=0 align="absmiddle">
<FONT  COLOR=<?=$cfg[top_txtcolor] ?>  SIZE=6  FACE="verdana"> <b><?=$LDNursingManage ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<? require("../req/passcheck_mask.php") ?>  

<p><!-- 
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDIntro2 $LDNursingManage" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDWhat2Do $LDNursingManage" ?></a><br>
 --><HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
