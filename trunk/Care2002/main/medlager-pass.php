<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");

require("../req/config-color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['depot'];

$append="?sid=$ck_sid&lang=$lang&cat=medlager&from=$src&fwck=";

switch($mode)
{
	case "archive":$title=$LDOrderArchive;
						$src="archivepass";
						$userck="ck_prod_arch_user";
						$fileforward="products-archive.php".$append.$userck;
						break;
	case "dbank":  $title="$LDPharmaDb";
						$src="dbankpass";
						$userck="ck_prod_db_user";
						$fileforward="medlager-datenbank-functions.php".$append.$userck;
						break;
	case "bot":	$title="$LDMediBotActivate";
						$src="medibotpass";
						$userck="ck_prod_bot_user";
						$fileforward="products-bestellbot.php".$append.$userck;
						break;
	default: 	$title=$LDPharmaOrder;
						$src="orderpass";
					   $mode="order";
						$userck="ck_prod_order_user";
					   $fileforward="products-bestellung.php".$append.$userck;
}

$thisfile="medlager-pass.php";
$breakfile="medlager.php?sid=$ck_sid&lang=$lang";

$lognote="$LDMedDepot $title ok";

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

<BODY  <? if (!$nofocus) print 'onLoad="document.passwindow.userid.select()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?="$LDMedDepot $title" ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<? require("../req/passcheck_mask.php") ?>  

<p>
<!-- <img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDIntro2 $LDMedDepot $title " ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDWhat2Do $LDMedDepot $title " ?>?</a><br>
 --><HR>
<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>


</FONT>


</BODY>
</HTML>
