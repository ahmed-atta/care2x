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

$allowedarea=&$allow_area['edp'];

$userck="ck_edv_user";
$append="?sid=$sid&lang=$lang&fwck=$userck";
switch($target)
{
	case "entry":$fileforward="edv-accessplan-edit.php".$append; 
						$title="$LDManageAccess - $LDNewData";
						break;
	case "search":$fileforward="edv-accessplan-such.php".$append; 
						$title="$LDManageAccess - $LDSearch";
						break;
	case "archiv":$fileforward="edv-accessplan-list.php".$append; 
						$title="$LDManageAccess - $LDListAll";
						break;
	default: $target="entry";
				$fileforward="edv-accessplan-edit.php".$append; 
				$title="$LDManageAccess $LDNewData";
}

$thisfile="edv-accessplan-pass.php";
$breakfile="edv.php?sid=$sid&lang=$lang";


$lognote="$title ok";

// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf=$title;
$minimal=1;
require("../include/inc_passcheck_head.php");

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  <?php if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo $title ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<tr>
<td colspan=3><?php if($target=="entry") print '<img src=../img/'.$lang.'/'.$lang.'_newdata-b.gif border=0 width=130 height=25 alt="'.$LDNewData.'">';
								else{ print'<a href="'.$thisfile.$append.'&target=entry"><img src="../img/'.$lang.'/'.$lang.'_newdata-gray.gif"  alt="'.$LDNewData.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="search") print '<img src="../img/'.$lang.'/'.$lang.'_such-b.gif" width=130 height=25 border=0 alt="'.$LDSearch.'">';
								else{ print '<a href="'.$thisfile.$append.'&target=search"><img src="../img/'.$lang.'/'.$lang.'_such-gray.gif" alt="'.$LDSearch.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
							if($target=="archiv") print '<img src="../img/'.$lang.'/'.$lang.'_arch-blu.gif" width=130 height=25 border=0 alt="'.$LDArchive.'">';
								else{ print '<a href="'.$thisfile.$append.'&target=archiv"><img src="../img/'.$lang.'/'.$lang.'_arch-gray.gif" alt="'.$LDArchive.'" width=130 height=25 border=0 ';if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; print '></a>';}
						?></td>

</tr>

<?php require("../include/inc_passcheck_mask.php") ?>  

<p>
<!-- <img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $title " ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $title " ?>?</a><br>
 --><HR>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</FONT>
</BODY>
</HTML>
