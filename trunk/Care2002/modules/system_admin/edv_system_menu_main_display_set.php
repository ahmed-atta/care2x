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
$lang_tables=array('indexframe.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');


$breakfile='edv-system-admi-menu.php'.URL_APPEND;
if($from=='add') $returnfile='edv_system_format_menu_item_add.php'.URL_APPEND.'&from=set';
  else $returnfile=$breakfile;
$thisfile=basename(__FILE__);
$editfile='edv_system_format_menu_item_add.php'.URL_REDIRECT_APPEND.'&mode=edit&from=set&item_no=';
/**
* Load the db routine
*/
$GLOBALCONFIG=array();

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$gc=new GlobalConfig($GLOBALCONFIG);

if(isset($mode)&&($mode=='save')){
	

/*	$db->Execute("REPLACE INTO care_config_global (type,value) VALUES ('gui_frame_left_nav_resize','$bg_resize')";

	if(!empty($bg_width)){
		$db->Execute("REPLACE INTO care_config_global (type,value) VALUES ('gui_frame_left_nav_width','$bg_width')";
	}
	if(!empty($bg_color)){
		$db->Execute("REPLACE INTO care_config_global (type,value) VALUES ('gui_frame_left_nav_border','$bg_border')";
	}
*/	
	//echo $bg_resize; exit;
	$gc->saveConfigItem('gui_frame_left_nav_border',$bg_border);
	$gc->saveConfigItem('gui_frame_left_nav_width',$bg_width);
	$gc->saveConfigItem('gui_frame_left_nav_bdcolor',$bg_bdcolor);
	$gc->saveConfigItem('language_single',$multilang);
	$gc->saveConfigItem('language_default',$deflang);
		
header('location:'.$thisfile.URL_REDIRECT_APPEND.'&mode=0');
	exit;
}

$gc->getConfig('gui_frame_left_nav_%');
$gc->getConfig('language_%');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
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
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP::$LDSystemAdmin" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<br>

<form>
<table border=0 cellspacing=1 cellpadding=2>  

  <tr bgcolor="#e9e9e9">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td background="../../gui/img/common/default/tableHeaderbg3.gif"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDFrameResizable; ?></b></td>
    <td>	<input type="radio" name="bg_border" value="1" <?php if($GLOBALCONFIG['gui_frame_left_nav_border']) echo 'checked'; ?>> <?php echo $LDYes; ?> 	<input type="radio" name="bg_border" value="0" 
	<?php if(!$GLOBALCONFIG['gui_frame_left_nav_border']) echo 'checked'; ?>> <?php echo $LDNo; ?>
        </td>
  </tr>
  <tr bgcolor="#e9e9e9">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td background="../../gui/img/common/default/tableHeaderbg3.gif"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDFrameWidth; ?></b></td>
    <td><input type="text" name="bg_width" size=20 maxlength=20 value="<?php echo $GLOBALCONFIG['gui_frame_left_nav_width']; ?>"></td>
  </tr>
  <tr bgcolor="#e9e9e9">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td background="../../gui/img/common/default/tableHeaderbg3.gif"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDBorderColor; ?></b></td>
    <td><input type="text" name="bg_bdcolor" size=20 maxlength=20 value="<?php echo $GLOBALCONFIG['gui_frame_left_nav_bdcolor']; ?>"></td>
  </tr>
  <tr bgcolor="#e9e9e9">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td background="../../gui/img/common/default/tableHeaderbg3.gif"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDAllowMultiLang; ?></b></td>
    <td>	<input type="radio" name="multilang" value="0" <?php if(!$GLOBALCONFIG['language_single']) echo 'checked'; ?>> <?php echo $LDYes; ?> 	<input type="radio" name="multilang" value="1" 
	<?php if($GLOBALCONFIG['language_single']) echo 'checked'; ?>> <?php echo $LDNo; ?>
        </td>
  </tr>
  <tr bgcolor="#e9e9e9">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td background="../../gui/img/common/default/tableHeaderbg3.gif"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDDefaultLang; ?></b></td>
    <td><select name="deflang">

<?php
require($root_path.'include/care_api_classes/class_language.php');
$lang_obj=new Language;
$langselect= &$lang_obj->createSelectForm($GLOBALCONFIG['language_default']);
echo $langselect;
?>
			
        </select>
        </td>
  </tr>


</table>
<?php
if($not_trans_id){
?>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<?php
}
?>
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0>

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
