<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('person.php','actions.php','specials.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['admit'];
$append=URL_REDIRECT_APPEND; 
switch($target)
{
	case 'person_reg':$fileforward='personell_register.php'.$append.'&origin=pass&target=personell_reg'; 
						$lognote='Person register ok';
						break;
	case 'personell_reg':$fileforward='personell_register.php'.$append.'&origin=pass&target=person_reg'; 
						$lognote='personell data entry ok';
						break;
	case 'personell_search':$fileforward='personell_search.php'.$append.'&origin=pass&target=personell_search'; 
						$lognote='Personell search  ok';
						 break;
	default: $target='person_reg';
				$lognote='Person register ok';
				$fileforward='personell_register.php'.$append.'&origin=pass&target=personell_reg'; 
}


$thisfile=basename(__FILE__);
$breakfile=$root_path.'main/spediens.php'.URL_APPEND;

$userck='aufnahme_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'',0,'/');
require($root_path.'include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'',0,'/');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf=$LDAdmission;

require_once($root_path.'include/inc_config_color.php');
require($root_path.'include/inc_passcheck_head.php');

/* erase the user_origin */
if(isset($HTTP_SESSION_VARS['sess_user_origin'])) $HTTP_SESSION_VARS['sess_user_origin']='';
?>

<?php echo setCharSet(); ?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<FONT    SIZE=-1  FACE="Arial">

<P>
<?php
if($cfg['dhtml'])
{
$buf=$LDPersonellMngmnt;
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
<td colspan=3><?php if($target=="personell_reg") echo '<img '.createLDImgSrc($root_path,'employment_blue.gif','0').' alt="'.$LDAdmit.'">';
								else{ echo'<a href="'.$thisfile.URL_APPEND.'&target=personell_reg"><img '.createLDImgSrc($root_path,'employment_gray.gif','0').' alt="'.$LDAdmit.'"'; if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="personell_search") echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.URL_APPEND.'&target=personell_search"><img '.createLDImgSrc($root_path,'such-gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
							if($target=="person_reg") echo '<img '.createLDImgSrc($root_path,'register_blue.gif','0').' alt="'.$LDSearch.'">';
								else{ echo '<a href="'.$thisfile.URL_APPEND.'&target=person_reg"><img '.createLDImgSrc($root_path,'register_gray.gif','0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';}
						?></td>
</tr>

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
