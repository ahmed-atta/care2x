<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['op_docs'];

$fileforward="op-doku-javastart.php?sid=$ck_sid&lang=$lang&target=";
$thisfile="op-doku-pass.php";

switch($target)
{
	case "search":$fileforward.="search";
						$lognote="search";
						break;
	case "archiv":$fileforward.="archiv";
						$lognote="archive";
						break;
	default:$fileforward.="entry"; 
				$target="entry";
}

$lognote="OP docs $lognote ok";

$breakfile="op-doku.php?sid=$ck_sid&lang=$lang";

$userck="ck_opdoku_user";

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

$errbuf="OP docs $target";

require("../req/passcheck_head.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/monitor2.gif" width=85 height=91 border=0 align="absmiddle">
<FONT  COLOR=#cc6600  SIZE=6  FACE="verdana"> <b><?=$LDOrDocu ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>

<td colspan=3><?if($target=="entry") print '<img src=../img/'.$lang.'/'.$lang.'_newdata-b.gif border=0>';
								else print'<a href="op-doku-pass.php?sid='.$ck_sid.'&lang='.$lang.'&target=entry"><img src="../img/'.$lang.'/'.$lang.'_newdata-gray.gif" width=130 height=25 border=0></a>';
							if($target=="search") print '<img src="../img/'.$lang.'/'.$lang.'_such-b.gif" width=130 height=25 border=0>';
								else print '<a href="op-doku-pass.php?sid='.$ck_sid.'&lang='.$lang.'&target=search"><img src="../img/'.$lang.'/'.$lang.'_such-gray.gif" width=130 height=25 border=0></a>';
							if($target=="archiv") print '<img src="../img/'.$lang.'/'.$lang.'_arch-blu.gif" width=130 height=25 border=0>';
								else print '<a href="op-doku-pass.php?sid='.$ck_sid.'&lang='.$lang.'&target=archiv"><img src="../img/'.$lang.'/'.$lang.'_arch-gray.gif" width=130 height=25 border=0></a>';
						?></td>
</tr>

<? require("../req/passcheck_mask.php") ?>  

<p>
<!-- 
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDIntro2 $LDOrDocu" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDWhat2Do $LDOrDocu" ?></a><br> -->
<HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
