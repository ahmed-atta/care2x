<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");
require("../global_conf/areas_allow.php");

if ($pdaten=="ja") setcookie(pdatencookie,"ja");

$allowedarea=&$allow_area['lab_r'];

$fileforward="labor_data_patient_such.php?sid=$ck_sid&lang=$lang";
$thisfile="labor_datasearch_pass.php";

 if ($pdatencookie=="ja") 
 	$breakfile="javascript:window.history.go(-(window.history.length))";
	else
	  $breakfile="labor.php?sid=$ck_sid&lang=$lang";
	  
$title="$LDMedLab - $LDSeeData";

$lognote="$title ok";


//reset cookie;
//setcookie(currentuser,"");

$userck="ck_lab_user";

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

<BODY  onLoad="document.passwindow.userid.focus()">

<FONT    SIZE=-1  FACE="Arial">

<P>

<img src=../img/micros.gif align="absmiddle"><FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><? print $title; ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img src=../img/<?="$lang/$lang" ?>_such-b.gif border=0><a href="labor_datainput_pass.php?sid=<?="$ck_sid&lang=$lang" ?>&route=validroute"><img src=../img/<?="$lang/$lang" ?>_newdata-gray.gif border=0></a></td>
</tr>

<? require("../req/passcheck_mask.php") ?>  

<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</FONT>


</BODY>
</HTML>
