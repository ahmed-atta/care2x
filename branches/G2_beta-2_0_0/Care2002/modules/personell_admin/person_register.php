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
$lang_tables[]='personell.php';
$lang_tables[]='person.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
if($update) $breakfile='person_register_show.php'.URL_APPEND.'&pid='.$pid;
	elseif($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
		else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;

if(!session_is_registered('sess_pid')) session_register('sess_pid');

# Start buffering the text above  the search block
 ob_start();

require('./gui_bridge/default/gui_std_tags.php');

echo StdHeader();
echo setCharSet();
?>
<TITLE><?php echo $LDPatientRegister ?></TITLE>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();loadcat();"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDPersonnelManagement :: $LDPersonRegister" ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('person_reg_newform.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<?php
/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_personell_reg.php');
?>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<ul>

<?php

 $sTemp = ob_get_contents();
 ob_end_clean();

require_once($root_path.'include/care_api_classes/class_gui_input_person.php');

$inperson = & new GuiInputPerson;

$inperson->setPID($pid);
$inperson->pretext = $sTemp;
$inperson->setDisplayFile('person_register_show.php');

$inperson->display();

?>

</ul>

</FONT>
<p>
</td>
</tr>
</table>
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_archive.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>

<p>
 --><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
echo StdFooter();
?>