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

$allowedarea=&$allow_area['edp'];

$userck='ck_edv_user';
$append="?sid=$sid&lang=$lang&fwck=$userck";
switch($target)
{
/*	case 'entry':$fileforward='edv_user_access_edit.php'.$append; 
						$title="$LDManageAccess - $LDNewData";
						break;
*/
	case 'entry':$fileforward='edv_user_access_edit.php'.$append; 
						$title="$LDManageAccess - $LDNewData";
						break;

	case 'search':$fileforward='edv-accessplan-such.php'.$append; 
						$title="$LDManageAccess - $LDSearch";
						break;
	case 'archiv':$fileforward='edv_user_access_list.php'.$append; 
						$title="$LDManageAccess - $LDListAll";
						break;
	default: $target='entry';
				$fileforward='edv_user_access_edit.php'.$append; 
				$title="$LDManageAccess $LDNewData";
}

$thisfile='edv_user_access_pass.php';
$breakfile='edv.php?sid='.$sid.'&lang='.$lang;


$lognote="$title ok";

// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'');

require('../include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include('../include/inc_passcheck.php');

$errbuf=$title;
$minimal=1;
require('../include/inc_passcheck_head.php');

?>

<?php echo setCharSet(); ?>
<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo $title ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<tr>
<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc('../','newdata-b.gif','0').' alt="'.$LDNewData.'">';
								else{ echo'<a href="'.$thisfile.$append.'&target=entry"><img '.createLDImgSrc('../','newdata-gray.gif','0').'  alt="'.$LDNewData.'" width=130 height=25 border=0 ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc('../','such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.$append.'&target=search"><img '.createLDImgSrc('../','such-gray.gif','0').' alt="'.$LDSearch.'"  ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="archiv") echo '<img '.createLDImgSrc('../','arch-blu.gif','0').' alt="'.$LDArchive.'">';
								else{ echo '<a href="'.$thisfile.$append.'&target=archiv"><img '.createLDImgSrc('../','arch-gray.gif','0').' alt="'.$LDArchive.'"  ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
						?></td>

</tr>

<?php require('../include/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $title " ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $title " ?>?</a><br>
 --><HR>
<p>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>
</BODY>
</HTML>
