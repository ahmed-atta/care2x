<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['medocs'];
$append="?sid=$sid&lang=$lang&userck=$userck&mode=?"; 

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
$breakfile="startframe.php?sid=$sid&lang=$lang";
$lognote="Medocs $title ok";

$userck="medocs_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); 
setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf="$LDMedocs $title";

require("../include/inc_passcheck_head.php");

?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/monitor2.gif" width=85 height=91 border=0 align="absmiddle">
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo "$LDMedocs $title" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="entry") print '<img src=../img/'.$lang.'/'.$lang.'_newdata-b.gif border=0 width=130 height=25 alt="'.$LDAdmit.'">';
								else{ print'<a href="medopass.php?sid='.$sid.'&target=entry&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_newdata-gray.gif"  alt="'.$LDAdmit.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="search") print '<img src="../img/'.$lang.'/'.$lang.'_such-b.gif" width=130 height=25 border=0 alt="'.$LDSearch.'">';
								else{ print '<a href="medopass.php?sid='.$sid.'&target=search&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_such-gray.gif" alt="'.$LDSearch.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="archiv") print '<img src="../img/'.$lang.'/'.$lang.'_arch-blu.gif" width=130 height=25 border=0 alt="'.$LDArchive.'">';
								else{ print '<a href="medopass.php?sid='.$sid.'&target=archiv&lang='.$lang.'"><img src="../img/'.$lang.'/'.$lang.'_arch-gray.gif" alt="'.$LDArchive.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
						?></td>

</tr>

<?php require("../include/inc_passcheck_mask.php") ?>   

<p>
<!-- <img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $LDMedocs $title " ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $LDMedocs $title " ?>?</a><br>
 --><img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('medocs_how2start.php','<?php echo $target ?>','entry')"><?php echo $LDMedocsHow2Enter ?></a><br>
<img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('medocs_how2start.php','<?php echo $target ?>','search')"><?php echo $LDMedocsHow2Search ?></a><br>
<img src="../img/frage.gif" width=15 height=15 align="absmiddle"> <a href="javascript:gethelp('medocs_how2start.php','<?php echo $target ?>','archiv')"><?php echo $LDMedocsHow2Archive ?></a><br>
<HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
