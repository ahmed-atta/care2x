<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['admit'];
$append=URL_REDIRECT_APPEND.'&from=pass'; 
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


$thisfile=basename(__FILE__);
//$breakfile='startframe.php'.URL_APPEND;
$breakfile=$root_path.$HTTP_SESSION_VARS['sess_path_referer'].URL_APPEND.'&pid='.$pid;

$userck='aufnahme_user';

setcookie($userck.$sid,'');
require($root_path.'include/inc_2level_reset.php'); 
setcookie(ck_2level_sid.$sid,'');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf=$LDAdmission;

require_once($root_path.'include/inc_config_color.php');
require($root_path.'include/inc_passcheck_head.php');
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
 { if((window.screen.width)>1000) document.write(\'<img '.createComIcon($root_path,'monitor2.gif','0','absmiddle').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>\');}
 //-->
 </script>';
 }
 ?>

  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="entry") echo '<img '.createLDImgSrc($root_path,'einga-b.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="aufnahme_pass.php?sid='.$sid.'&target=entry&lang='.$lang.'"><img '.createLDImgSrc($root_path,'ein-gray.gif','0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="aufnahme_pass.php?sid='.$sid.'&target=search&lang='.$lang.'"><img '.createLDImgSrc($root_path,'such-gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="archiv") echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{ echo '<a href="aufnahme_pass.php?sid='.$sid.'&target=archiv&lang='.$lang.'"><img '.createLDImgSrc($root_path,'arch-gray.gif','0').' alt="'.$LDArchive.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
						?></td>
</tr>

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p>
<?php if($target!="entry") : ?>
<img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>> <a href="aufnahme_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=entry"><?php echo $LDAdmWantEntry ?></a><br>
<?php endif ?>
<?php if($target!="search") : ?>
<img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>> <a href="aufnahme_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=search"><?php echo $LDAdmWantSearch ?></a><br>
<?php endif ?>
<?php if($target!="archiv") : ?>
<img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>> <a href="aufnahme_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&target=archiv"><?php echo $LDAdmWantArchive ?></a><br>
<?php endif ?>
<img <?php echo createComIcon($root_path,'frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('admission_how2start.php','<?php echo $target ?>','entry')"><?php echo $LDAdmHow2Enter ?></a><br>
<img <?php echo createComIcon($root_path,'frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('admission_how2start.php','<?php echo $target ?>','search')"><?php echo $LDAdmHow2Search ?></a><br>
<img <?php echo createComIcon($root_path,'frage.gif','0','absmiddle') ?>> <a href="javascript:gethelp('admission_how2start.php','<?php echo $target ?>','archiv')"><?php echo $LDAdmHow2Archive ?></a><br>
<HR>
<p>
<?php
if(file_exists($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');
  ?>

</FONT>
</BODY>
</HTML>
