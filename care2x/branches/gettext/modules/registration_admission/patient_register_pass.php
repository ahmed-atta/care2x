<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','registration_admission');
define('LANG_FILE_MODULAR','registration_admission.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['admit'];
$append=URL_REDIRECT_APPEND; 
switch($target)
{
	case 'entry':$fileforward='patient_register_search.php'.$append.'&origin=pass&target=entry'; 
						$lognote='Patient register ok';
						break;
	case 'search':$fileforward='patient_register_search.php'.$append.'&origin=pass&target=search'; 
						$lognote='Patient register search ok';
						break;
	case 'archiv':$fileforward='patient_register_archive.php'.$append.'&origin=pass';
						$lognote='Patient register archive ok';
						 break;
	default: 
				$target='entry';
				$lognote='Patient register ok';
				$fileforward='patient_register.php'.$append;
}


$thisfile=basename(__FILE__);
$breakfile='patient.php'.URL_APPEND;

$userck='aufnahme_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'',0,'/');
require($root_path.'include/helpers/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'',0,'/');

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/helpers/inc_passcheck.php');

$errbuf=$LDAdmission;

require($root_path.'include/helpers/inc_passcheck_head.php');
?>
<BODY  onLoad="document.passwindow.userid.focus();" 
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php
if($cfg['dhtml'])
 {
 switch($target)
{
	case 'entry':$buf=$LDPatient.' :: '.$LDRegistration; break;
	case 'search':$buf=$LDPatient.' :: '.$LDSearch; break;
	case 'archiv':$buf=$LDPatient.' :: '.$LDAdvancedSearch; break;
	default: $target='entry';$buf=$LDPatient.' :: '.$LDRegistration;
}

echo '
<script language=javascript>
<!--
 if (window.screen.width) 
 { if((window.screen.width)>1000) document.write(\'<img '.createComIcon($root_path,'smiley.gif','0','top').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>\');}
 //-->
 </script>';
 }
 ?>
  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
	<td colspan=3>
<?php


	#
	# User "register new person" button
	#
	$sNewPatientButton ='register_green.gif';
	$sNewPatientButtonGray ='register_gray.gif';

	//if($target=="entry") echo '<img '.createLDImgSrc($root_path,'register_green.gif','0').' alt="'.$LDNewPerson.'" title="'.$LDNewPerson.'">';
	//	else{ echo'<a href="patient_register_pass.php?sid='.$sid.'&target=entry&lang='.$lang.'"><img '.createLDImgSrc($root_path,'register_gray.gif','0').' alt="'.$LDNewPerson.'" title="'.$LDNewPerson.'" '; if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
	if($target=="entry") echo '<img '.createLDImgSrc($root_path,$sNewPatientButton,'0').' alt="'.$LDNewPerson.'" title="'.$LDNewPerson.'">';
		else{ echo'<a href="patient_register_pass.php?sid='.$sid.'&target=entry&lang='.$lang.'"><img '.createLDImgSrc($root_path,$sNewPatientButtonGray,'0').' alt="'.$LDNewPerson.'" title="'.$LDNewPerson.'" '; if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
	if($target=="search") echo '<img '.createLDImgSrc($root_path,'search_green.gif','0').' alt="'.$LDSearch.'" title="'.$LDSearch.'">';
		else{ echo '<a href="patient_register_pass.php?sid='.$sid.'&target=search&lang='.$lang.'"><img '.createLDImgSrc($root_path,'such-gray.gif','0').' alt="'.$LDSearch.'"  title="'.$LDSearch.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
	if($target=="archiv") echo '<img '.createLDImgSrc($root_path,'advsearch_green.gif','0').'  alt="'.$LDAdvancedSearch.'" title="'.$LDAdvancedSearch.'">';
		else{ echo '<a href="patient_register_pass.php?sid='.$sid.'&target=archiv&lang='.$lang.'"><img '.createLDImgSrc($root_path,'advsearch_gray.gif','0').' alt="'.$LDAdvancedSearch.'"  title="'.$LDAdvancedSearch.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
?>
	</td>
</tr>

<?php 
$maskBorderColor='#66ee66';
require($root_path.'include/helpers/inc_passcheck_mask.php') 
?>  
</FONT>
</BODY>
</HTML>
