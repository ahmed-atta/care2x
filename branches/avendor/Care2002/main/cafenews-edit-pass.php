<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;

require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");

require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['cafenews'];

$fileforward="cafenews-edit-select.php?sid=$ck_sid&lang";
						
$thisfile="cafenews-edit-pass.php";
$breakfile="cafenews.php?sid=$ck_sid&lang=$lang";
$lognote="$title $LDEdit ok";

$userck="ck_cafenews_user";

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

$errbuf="$title $LDEdit";

require("../req/passcheck_head.php");
?>
<BODY bgcolor="#ffffff" onLoad="document.passwindow.userid.focus()">


<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/basket.gif" width=74 height=70 border=0>
<FONT  COLOR=#cc6600  SIZE=6  FACE="verdana"> <b><?="$title $LDEdit" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<? require("../req/passcheck_mask.php") ?>  

<p>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDIntroTo $title $LDEdit" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDWhatTo $title $LDEdit" ?>?</a><br>
<HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
