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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
if($from=='add') $returnfile='edv_system_format_currency_add.php'.URL_APPEND.'&from=set';
  else $returnfile=$breakfile;
$thisfile='edv_system_format_currency_set.php';
$editfile='edv_system_format_currency_add.php'.URL_REDIRECT_APPEND.'&mode=edit&from=set&item_no=';
# Load the db routine

require($root_path.'include/inc_currency_set.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?> 

 <?php if($rows) : ?>
<script language="javascript" src="<?php echo $root_path; ?>js/check_currency_same_item.js">
</script>
<?php endif ?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['body_bgcolor'];?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDCurrencyAdmin" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('currency_set.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<br>
<?php 
#  Define to create the edit links on the table and create the GUI body
define('SET_EDIT',1); 
$bottomlink='edv_system_format_currency_add.php'.URL_APPEND.'&from=set'; 
$bottomlink_txt=$LDClk2AddCurrency;
require($root_path.'include/inc_currency_set_gui.php');
?>
</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
