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
if(!isset($lang))
  if(isset($HTTP_GET_VARS['lang'])) $lang=$HTTP_GET_VARS['lang'];
    elseif (isset($HTTP_POST_VARS['lang'])) $lang=$HTTP_POST_VARS['lang'];
	  elseif(isset($HTTP_COOKIE_VARS['ck_lang'])) $lang=$HTTP_COOKIE_VARS['ck_lang'];
	    else $lang="en";
		
require_once('../include/inc_charset_fx.php');	
require_once('../include/inc_img_fx.php');	
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
</HEAD>
<BODY bgcolor="#ffffff">
<P><br>
<img <?php echo createMascot('../','mascot1_r.gif','0','left') ?>>
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
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</FONT>
</BODY>
</HTML>
