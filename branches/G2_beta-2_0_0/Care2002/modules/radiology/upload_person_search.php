<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/

$lang_tables[]='actions.php';
$lang_tables[]='prompt.php';
$lang_tables[]='aufnahme.php';
define('LANG_FILE','radio.php');
# Resolve the local user based on the origin of the script
require_once('include/inc_local_user.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_radio_user';
require_once($root_path.'include/inc_front_chain_lang.php');

# Set break file
require('include/inc_breakfile.php');

$thisfile=basename(__FILE__);

$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

if(empty($target)) $target='search';

# Start buffering the text above  the search block
ob_start();

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()" bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDUploadDicom :: $LDSearch " ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('patient_search.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

</table>
<ul>

<?php

 $sTemp = ob_get_contents();
 ob_end_clean();

require_once($root_path.'include/care_api_classes/class_gui_search_person.php');

$psearch = & new GuiSearchPerson;

$psearch->setTargetFile('upload.php');

$psearch->setCancelFile($breakfile);

$psearch->setPrompt($LDPlsFindPersonFirst);

# Set to TRUE if you want to auto display a single result
//$psearch->auto_show_byalphanumeric =TRUE;
# Set to TRUE if you want to auto display a single result based on a numeric keyword
# usually in the case of barcode scanner data
$psearch->auto_show_bynumeric = TRUE;

$psearch->pretext=$sTemp;

$psearch->display();

?>

</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</BODY>
</HTML>
