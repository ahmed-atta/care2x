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

$allowedarea=&$allow_area['admit'];
$append="?sid=$sid&lang=$lang&from=pass"; 
switch($target)
{
	case 'entry':$fileforward='aufnahme_start.php'.$append; 
						$lognote='Admission ok';
						break;
	case 'search':$fileforward='aufnahme_daten_such.php'.$append; 
						$lognote='Admision search ok';
						break;
	case 'archiv':$fileforward='aufnahme_list.php'.$append;
						$lognote='Admission archive ok';
						 break;
	default: $target='entry';
				$lognote='Admission ok';
				$fileforward='aufnahme_start.php'.$append;
}


$thisfile='aufnahme_pass.php';
$breakfile='startframe.php?sid='.$sid.'&lang='.$lang;

$userck='aufnahme_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'');

require('../include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include('../include/inc_passcheck.php');

$errbuf=$LDAdmission;

require('../include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php
if($cfg['dhtml'])
 {
 switch($target)
{
	case 'entry':$buf=$LDAdmission; break;
	case 'search':$buf=$LDAdmTargetSearch; break;
	case 'archiv':$buf=$LDAdmTargetArchive; break;
	default: $target="entry";$buf=$LDAdmission;
}

echo '
<script language=javascript>
<!--
 if (window.screen.width) 
 { if((window.screen.width)>1000) document.write(\'<img '.createComIcon('../','monitor2.gif','0','absmiddle').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>\');}
 //-->
 </script>';
 }
 ?>

  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc('../','einga-b.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="aufnahme_pass.php?sid='.$sid.'&target=entry&lang='.$lang.'"><img '.createLDImgSrc('../','ein-gray.gif','0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc('../','such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="aufnahme_pass.php?sid='.$sid.'&target=search&lang='.$lang.'"><img '.createLDImgSrc('../','such-gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="archiv") echo '<img '.createLDImgSrc('../','arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{ echo '<a href="aufnahme_pass.php?sid='.$sid.'&target=archiv&lang='.$lang.'"><img '.createLDImgSrc('../','arch-gray.gif','0').' alt="'.$LDArchive.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
						?></td>
</tr>

<?php require('../include/inc_passcheck_mask.php') ?>  

<p>
<?php if($target!="entry") : ?>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>> <a href="aufnahme_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=entry"><?php echo $LDAdmWantEntry ?></a><br>
<?php endif ?>
<?php if($target!="search") : ?>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>> <a href="aufnahme_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=search"><?php echo $LDAdmWantSearch ?></a><br>
<?php endif ?>
<?php if($target!="archiv") : ?>
<img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>> <a href="aufnahme_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=archiv"><?php echo $LDAdmWantArchive ?></a><br>
<?php endif ?>
<img <?php echo createComIcon('../','frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('admission_how2start.php','<?php echo $target ?>','entry')"><?php echo $LDAdmHow2Enter ?></a><br>
<img <?php echo createComIcon('../','frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('admission_how2start.php','<?php echo $target ?>','search')"><?php echo $LDAdmHow2Search ?></a><br>
<img <?php echo createComIcon('../','frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('admission_how2start.php','<?php echo $target ?>','archiv')"><?php echo $LDAdmHow2Archive ?></a><br>
<HR>
<p>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');
  ?>

</FONT>
</BODY>
</HTML>
