<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.07 - 2003-08-29
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
if(!isset($lang))
  if(isset($HTTP_GET_VARS['lang'])) $lang=$HTTP_GET_VARS['lang'];
    elseif (isset($HTTP_POST_VARS['lang'])) $lang=$HTTP_POST_VARS['lang'];
	  elseif(isset($HTTP_COOKIE_VARS['ck_lang'])) $lang=$HTTP_COOKIE_VARS['ck_lang'];
	    else $lang="en";
		
require_once($root_path.'include/inc_charset_fx.php');	
require_once($root_path.'include/inc_img_fx.php');	
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
</HEAD>
<BODY bgcolor="#ffffff">
<P><br>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','left') ?>>
<font face=verdana,arial size=5 color=maroon>
<?php 
switch($lang)
{
	case "de": echo '... wird noch weiter ausgebaut.'; break;
	case "it": echo 'Ancora un po\' di pazienza, ci siamo lavorando.'; break;
	case "id": echo 'Kami sedan mengerjakan bagian ini. Harap bersabar'; break;
	default: echo 'We are working on it. Please be patient.';
}
?>
<form>
<input type="button" value=" OK " onClick="javascript:window.history.back()">
</form>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
