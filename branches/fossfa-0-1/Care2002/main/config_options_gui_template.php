<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('stdpass.php');
define('LANG_FILE','specials.php');
//$local_user='ck_edv_user';
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='config_options.php'.URL_APPEND;

$thisfile=basename(__FILE__);

if(isset($mode)&&$mode=='save'){
	// Save to user config table

	$config_new['template_theme']=$gui_theme;
	
	include_once($root_path.'include/care_api_classes/class_userconfig.php');
	
	$user=new UserConfig;

	if($user->getConfig($HTTP_COOKIE_VARS['ck_config'])){

		$config=&$user->getConfigData();
	
		$config=array_merge($config,$config_new);

		if($user->saveConfig($HTTP_COOKIE_VARS['ck_config'],$config)){
			header('location:'.basename(__FILE__).URL_REDIRECT_APPEND.'&saved=1');
			exit;
		}
	}

}
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
<script language="javascript" src="<?php echo $root_path; ?>js/check_menu_item_same_item.js">
</script>
<?php endif ?>
<script language="javascript">
<!-- Script Begin
function reloadParent() {
	if(confirm("The browser needs to be refreshed to see the changes.\n Do you like to refresh it now?")) window.parent.location.reload();

}
//  Script End -->
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor']; ?> 
<?php if(isset($saved)&&$saved) echo 'onLoad="reloadParent();"'; ?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial">
<STRONG> <?php echo $LDUserConfigOpt ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('config_guitheme.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<FONT  color="#000066" FACE="verdana,arial" size=4><?php echo $LDGUITheme; ?></font>
<br>

<form method="post">
<?php if (isset($saved)&&$saved) { 
	echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>';	
?>
<FONT  face="Verdana,Helvetica,Arial" size=3 color="#990000"><?php echo $LDChangeSaved ?></font><br>
<?php } ?>

<table border=0 cellspacing=1 cellpadding=2>  

  <tr >
    <td colspan=3>&nbsp;</td>
  </tr>
  
  <tr bgcolor="#e9e9e9">
    <td background="../../gui/img/common/default/tableHeaderbg3.gif"><FONT  color="#000099" FACE="verdana,arial" size=2><b></b></td>
    <td background="../../gui/img/common/default/tableHeaderbg3.gif"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDTheme; ?></b></td>
  </tr>
  
<?php

$dirs=&$TP_obj->getTemplateList();

while(list($x,$v)=each($dirs)){
?>
  <tr  bgcolor="#e9e9e9" >
    <td> <input type="radio" name="gui_theme" value="<?php echo $x; ?>" <?php	if($template_theme==$x) echo 'checked';	?>>
		</td>
    <td><FONT FACE="verdana,arial" size=2><b><?php echo $v; ?></b></td>
  </tr>

  
  <?php
}
?>
  <tr >
    <td colspan=3><br><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0></td>
  </tr>
  </table>
<?php
if($not_trans_id){
?>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<?php
}
?>
<input type="hidden" name="max_items" value="<?php echo ($i-1); ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
</form>

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
