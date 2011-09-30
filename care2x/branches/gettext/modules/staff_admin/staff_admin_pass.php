<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','staff_admin');
define('LANG_FILE_MODULAR','staff_admin.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['admit'];
$append=URL_REDIRECT_APPEND; 
switch($target)
{
	case 'person_reg':$fileforward='staff_register.php'.$append.'&origin=pass&target=staff_reg'; 
						$lognote='Person register ok';
						break;
	case 'staff_reg':$fileforward='staff_register.php'.$append.'&origin=pass&target=person_reg'; 
						$lognote='staff data entry ok';
						break;
	case 'staff_search':$fileforward='staff_search.php'.$append.'&fwd_nr='.$fwd_nr.'&origin=pass&target=staff_search'; 
						$lognote='staff search  ok';
						 break;
	case 'staff_listall':$fileforward='staff_listall.php'.$append.'&origin=pass&target=staff_listall'; 
						$lognote='staff list all  ok';
						 break;
	default: $target='person_reg';
				$lognote='Person register ok';
				$fileforward='staff_register.php'.$append.'&fwd_nr='.$fwd_nr.'&origin=pass&target=staff_reg'; 
}


$thisfile=basename(__FILE__);
$breakfile=$root_path.'main/plugin.php'.URL_APPEND;

$userck='aufnahme_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'',0,'/');
require($root_path.'include/helpers/inc_2level_reset.php');
setcookie(ck_2level_sid.$sid,'',0,'/');

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/helpers/inc_passcheck.php');

$errbuf=$LDAdmission;

/* erase the user_origin */
if(isset($_SESSION['sess_user_origin'])) $_SESSION['sess_user_origin']='';

require($root_path.'include/helpers/inc_passcheck_head.php');
?>
<BODY  onLoad="document.passwindow.userid.focus();" 
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php

$buf=$LDstaffMngmnt;
echo '
<img '.createComIcon($root_path,'persons.gif','0','top').'><FONT  COLOR="'.$cfg['top_txtcolor'].'"  SIZE=6  FACE="verdana"> <b>'.$buf.'</b></font>';

 ?>
  
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><?php if($target=="staff_reg") echo '<img '.createLDImgSrc($root_path,'add_employee_blue.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="'.$thisfile.URL_APPEND.'&target=staff_reg"><img '.createLDImgSrc($root_path,'add_employee_gray.gif','0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
							if($target=="staff_search") echo '<img '.createLDImgSrc($root_path,'src_emp_blu.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.URL_APPEND.'&target=staff_search"><img '.createLDImgSrc($root_path,'src_emp_gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
							if($target=="staff_listall") echo '<img '.createLDImgSrc($root_path,'lista-blu.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.URL_APPEND.'&target=staff_listall"><img '.createLDImgSrc($root_path,'lista-gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
							echo '<img src="'.$root_path.'gui/img/common/default/pixel.gif" width=20>';
							if($target=="person_reg") echo '<img '.createLDImgSrc($root_path,'register_blue.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.URL_APPEND.'&target=person_reg"><img '.createLDImgSrc($root_path,'register_gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';}
						?></td>
</tr>

<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>  

<p>
<p>
<?php
require($root_path.'include/helpers/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
