<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['medocs'];
$append="?sid=$ck_sid&lang=$lang&userck=$userck&mode=?"; 

switch($target)
{
	case "entry":$fileforward="medostart.php".$append; 
						$title=$LDNewData;break;
	case "search":$fileforward="medocs-search.php".$append; 
						$title=$LDSearch; break;
	case "archiv":$fileforward="medocs-archiv.php".$append; 
						$title=$LDArchive; break;
	default: $target="entry";$fileforward="medostart.php".$append; $title=$LDNewData;
}

$thisfile="medopass.php";
$breakfile="startframe.php?sid=$ck_sid&lang=$lang";
$lognote="Medocs $title ok";

$userck="medocs_user";

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

$errbuf="$LDMedocs $title";

require("../req/passcheck_head.php");

?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<? print $cfg['body_bgcolor']; ?>
<? if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/monitor2.gif" width=85 height=91 border=0 align="absmiddle">
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?="$LDMedocs $title" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?if($target=="entry") print '<img src=../img/'.$lang.'/'.$lang.'_newdata-b.gif border=0 width=130 height=25 alt="'.$LDAdmit.'">';
								else{ print'<a href="medopass.php?sid='.$ck_sid.'&target=entry&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_newdata-gray.gif"  alt="'.$LDAdmit.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="search") print '<img src="../img/'.$lang.'/'.$lang.'_such-b.gif" width=130 height=25 border=0 alt="'.$LDSearch.'">';
								else{ print '<a href="medopass.php?sid='.$ck_sid.'&target=search&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_such-gray.gif" alt="'.$LDSearch.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="archiv") print '<img src="../img/'.$lang.'/'.$lang.'_arch-blu.gif" width=130 height=25 border=0 alt="'.$LDArchive.'">';
								else{ print '<a href="medopass.php?sid='.$ck_sid.'&target=archiv&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_arch-gray.gif" alt="'.$LDArchive.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
						?></td>

</tr>

<? require("../req/passcheck_mask.php") ?>   

<p>
<!-- <img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDIntro2 $LDMedocs $title " ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDWhat2Do $LDMedocs $title " ?>?</a><br>
 --><img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('medocs_how2start.php','<?=$target ?>','entry')"><?=$LDMedocsHow2Enter ?></a><br>
<img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('medocs_how2start.php','<?=$target ?>','search')"><?=$LDMedocsHow2Search ?></a><br>
<img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('medocs_how2start.php','<?=$target ?>','archiv')"><?=$LDMedocsHow2Archive ?></a><br>
<HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
