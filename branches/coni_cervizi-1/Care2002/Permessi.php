<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'global_conf/areas_allow.php');
//define('LANG_FILE','stdpass.php');
require ("include/inc_passcheck.php");
*/
//echo "sono qui";
?>
<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');
$allowedarea=&$allow_area['Amministrazione'];
$append=URL_REDIRECT_APPEND.'&from=pass&fwd_nr='.$fwd_nr; 
switch($target)
{
	case 'entry':$fileforward='modules/amministrazione/amministrazione.php'.$append; 
						$lognote='Admission ok';
						break;
	case 'search':$fileforward='modules/registration_admission/aufnahme_daten_such.php'.$append; 
						$lognote='Admision search ok';
						break;
						case 'archiv':$fileforward='aufnahme_list.php'.$append; 
						$lognote='Admission archive ok'; 
						 break; 
	default: $target='entry';
				$lognote='Admission ok';
				$fileforward='modules/amministrazione/amministrazione.php'.$append;
}


$thisfile=basename(__FILE__);

//$breakfile='patient.php'.URL_APPEND.'&pid='.$pid;

$userck='aufnahme_user';

setcookie($userck.$sid,'');
require($root_path.'include/inc_2level_reset.php'); 
setcookie(ck_2level_sid.$sid,'');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	;
	include($root_path.'include/inc_passcheck.php');

$errbuf="Permessi";

require($root_path.'include/inc_passcheck_head.php');
?>

<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php
switch($target){
	case 'entry':$buf="Amministrazione"; break;
	case 'search':$buf=$LDAdmTargetSearch; break;
	case 'archiv':$buf=$LDAdmTargetArchive; break; 
	default: $target="entry";$buf="Amministrazione";
}

echo '
<img '.createComIcon($root_path,'blocchetto1.JPG','0','top').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>';
 ?>

  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>

<td colspan=3><?php /*if($target=="entry") echo '<img '.createLDImgSrc($root_path,'admit-blue.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="aufnahme_pass.php?sid='.$sid.'&target=entry&lang='.$lang.'"><img '.createLDImgSrc($root_path,'admit-gray.gif','0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="search") echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="aufnahme_pass.php?sid='.$sid.'&target=search&lang='.$lang.'"><img '.createLDImgSrc($root_path,'such-gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}

 if($target=="archiv") echo '<img '.createLDImgSrc($root_path,'arch-blu.gif','0').'  alt="'.$LDArchive.'">';
								else{ echo '<a href="aufnahme_pass.php?sid='.$sid.'&target=archiv&lang='.$lang.'"><img '.createLDImgSrc($root_path,'arch-gray.gif','0').' alt="'.$LDArchive.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';} 

				*/?></td>
</tr>

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<?php

require($root_path.'include/inc_load_copyrite.php');

?>

</FONT>
</BODY>
</HTML>




