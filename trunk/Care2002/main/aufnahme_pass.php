<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['admit'];
$append="?sid=$ck_sid&lang=$lang&from=pass"; 
switch($target)
{
	case "entry":$fileforward="aufnahme_start.php".$append; 
						$lognote="Admission ok";
						break;
	case "search":$fileforward="aufnahme_daten_such.php".$append; 
						$lognote="Admision search ok";
						break;
	case "archiv":$fileforward="aufnahme_list.php".$append;
						$lognote="Admission archive ok";
						 break;
	default: $target="entry";
				$lognote="Admission ok";
				$fileforward="aufnahme_start.php".$append;
}


$thisfile="aufnahme_pass.php";
$breakfile="startframe.php?sid=$ck_sid&lang=$lang";

$userck="aufnahme_user";
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

$errbuf=$LDAdmission;

require("../req/passcheck_head.php");
?>

<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?
 if($cfg['dhtml'])
 {
 switch($target)
{
	case "entry":$buf=$LDAdmission; break;
	case "search":$buf=$LDAdmTargetSearch; break;
	case "archiv":$buf=$LDAdmTargetArchive; break;
	default: $target="entry";$buf=$LDAdmission;
}

print '
<script language=javascript>
<!--
 if (window.screen.width) 
 { if((window.screen.width)>1000) document.write(\'<img src="../img/monitor2.gif" width=85 height=91 align=absmiddle><FONT  COLOR="'.$cfg[top_txtcolor].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>\');}
 //-->
 </script>';
 }
 ?>

  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?if($target=="entry") print '<img src=../img/'.$lang.'/'.$lang.'_einga-b.gif border=0 width=130 height=25 alt="'.$LDAdmit.'">';
								else{ print'<a href="aufnahme_pass.php?sid='.$ck_sid.'&target=entry&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_ein-gray.gif"  alt="'.$LDAdmit.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="search") print '<img src="../img/'.$lang.'/'.$lang.'_such-b.gif" width=130 height=25 border=0 alt="'.$LDSearch.'">';
								else{ print '<a href="aufnahme_pass.php?sid='.$ck_sid.'&target=search&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_such-gray.gif" alt="'.$LDSearch.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="archiv") print '<img src="../img/'.$lang.'/'.$lang.'_arch-blu.gif" width=130 height=25 border=0 alt="'.$LDArchive.'">';
								else{ print '<a href="aufnahme_pass.php?sid='.$ck_sid.'&target=archiv&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_arch-gray.gif" alt="'.$LDArchive.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
						?></td>
</tr>

<? require("../req/passcheck_mask.php") ?>  

<p>
<? if($target!="entry") : ?>
<img src="../img/update.gif" width=19 height=19 align="absmiddle"> <a href="aufnahme_pass.php?sid=<?="$ck_sid&lang=$lang" ?>&target=entry"><?=$LDAdmWantEntry ?></a><br>
<? endif ?>
<? if($target!="search") : ?>
<img src="../img/update.gif" width=19 height=19 align="absmiddle"> <a href="aufnahme_pass.php?sid=<?="$ck_sid&lang=$lang" ?>&target=search"><?=$LDAdmWantSearch ?></a><br>
<? endif ?>
<? if($target!="archiv") : ?>
<img src="../img/update.gif" width=19 height=19 align="absmiddle"> <a href="aufnahme_pass.php?sid=<?="$ck_sid&lang=$lang" ?>&target=archiv"><?=$LDAdmWantArchive ?></a><br>
<? endif ?>
<img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('admission_how2start.php','<?=$target ?>','entry')"><?=$LDAdmHow2Enter ?></a><br>
<img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('admission_how2start.php','<?=$target ?>','search')"><?=$LDAdmHow2Search ?></a><br>
<img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('admission_how2start.php','<?=$target ?>','archiv')"><?=$LDAdmHow2Archive ?></a><br>
<HR>
<p>

<?php
include("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>
</BODY>
</HTML>
