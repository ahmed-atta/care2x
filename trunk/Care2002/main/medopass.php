<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
require_once('../global_conf/areas_allow.php');

$allowedarea=&$allow_area['medocs'];

$userck="medocs_user";

$append="?sid=$sid&lang=$lang&userck=$userck&mode=@"; 

switch($target)
{
	case 'entry':$fileforward="medostart.php".$append; 
						$title=$LDNewData;break;
	case 'search':$fileforward="medocs-search.php".$append; 
						$title=$LDSearch; break;
	case 'archiv':$fileforward="medocs-archiv.php".$append; 
						$title=$LDArchive; break;
	default: $target="entry";$fileforward="medostart.php".$append; $title=$LDNewData;
}

$thisfile="medopass.php";
$breakfile="startframe.php?sid=".$sid."&lang=".$lang;
$lognote="Medocs $title ok";


//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); 
setcookie(ck_2level_sid.$sid,"");

require('../include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include('../include/inc_passcheck.php');

$errbuf="$LDMedocs $title";

require('../include/inc_passcheck_head.php');

?>
<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon('../','monitor2.gif','0','absmiddle') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo "$LDMedocs $title" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc('../','newdata-b.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="medopass.php?sid='.$sid.'&target=entry&lang='.$lang.'"><img '.createLDImgSrc('../','newdata-gray.gif','0').'  alt="'.$LDAdmit.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc('../','such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="medopass.php?sid='.$sid.'&target=search&lang='.$lang.'"><img '.createLDImgSrc('../','such-gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="archiv") echo '<img '.createLDImgSrc('../','arch-blu.gif','0').' alt="'.$LDArchive.'">';
								else{ echo '<a href="medopass.php?sid='.$sid.'&target=archiv&lang='.$lang.'"><img '.createLDImgSrc('../','arch-gray.gif','0').' alt="'.$LDArchive.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
						?></td>

</tr>

<?php require('../include/inc_passcheck_mask.php') ?>   

<p>
<!-- <img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $LDMedocs $title " ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $LDMedocs $title " ?>?</a><br>
 --><img <?php echo createComIcon('../','frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('medocs_how2start.php','<?php echo $target ?>','entry')"><?php echo $LDMedocsHow2Enter ?></a><br>
<img <?php echo createComIcon('../','frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('medocs_how2start.php','<?php echo $target ?>','search')"><?php echo $LDMedocsHow2Search ?></a><br>
<img <?php echo createComIcon('../','frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('medocs_how2start.php','<?php echo $target ?>','archiv')"><?php echo $LDMedocsHow2Archive ?></a><br>
<HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
