<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('indexframe.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');


$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
if($from=='add') $returnfile='edv_system_format_menu_item_add.php'.URL_APPEND.'&from=set';
  else $returnfile=$breakfile;
$thisfile=basename(__FILE__);
$editfile='edv_system_format_menu_item_add.php'.URL_REDIRECT_APPEND.'&mode=edit&from=set&item_no=';

if(!isset($GCONFIG)) $GCONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$gc=new GlobalConfig($GCONFIG);

if(isset($mode)&&($mode=='save')&&!empty($max_items)){
	
	$gc->saveConfigItem('theme_control_buttons',$HTTP_POST_VARS['theme_control_buttons']);
	header('location:'.$thisfile.URL_REDIRECT_APPEND.'&mode=0');
	exit;
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

 <?php if($rows) { ?>
<script language="javascript" src="<?php echo $root_path; ?>js/check_menu_item_same_item.js">
</script>
<?php } ?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['body_bgcolor'];?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo $LDTheme ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="'.$returnfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('system_theme.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<FONT  color="#000066" FACE="verdana,arial" size=4><?php echo $LDControlButImg; ?></font>
<form method="post">
<table border=0 cellspacing=1 cellpadding=2>  

  <tr background="../../gui/img/common/default/tableHeaderbg3.gif">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b></b></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b></b></td>
   <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDStatus; ?></b></td>
  </tr>

<?php 
	$gc->getConfig('theme_control_%');

  echo '<tr>
	<td bgcolor="#e9e9e9"><img '.createComIcon($root_path,'arrow_blueW.gif','0').'></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>'.$LDControlButImg.'</b> </FONT></td>';
	echo '
	<td bgcolor="#e9e9e9" ><FONT   FACE="verdana,arial" size=2>	
	<select name="theme_control_buttons">';
	
	$tlist=explode(',',$GCONFIG['theme_control_theme_list']);
	while(list($x,$v)=each($tlist)){
		echo '<option value="'.$v.'"';
		if($GCONFIG['theme_control_buttons']==$v) echo ' selected';
		echo '>
		'.$v.'
		</option>';
	}
	echo '</select><input type="hidden" name="index'.$i.'" value="'.$x.'">
       </td>  
	</tr>';

?>
  <tr >
    <td colspan=3><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0></td>
  </tr>
  <tr >
    <td colspan=3>&nbsp;</td>
  </tr>
  
  <tr bgcolor="#e9e9e9" background="../../gui/img/common/default/tableHeaderbg3.gif">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b></b></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDTheme; ?></b></td>
   <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDSampleButtons; ?></b></td>
  </tr>
<?php
reset($tlist);
while(list($x,$v)=each($tlist)){
?>
  <tr  bgcolor="#e9e9e9" >
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b></b></td>
    <td><FONT FACE="verdana,arial" size=2><b><?php echo $v; ?></b></td>
   <td><img src="<?php echo $root_path; ?>gui/img/control/<?php echo $v; ?>/<?php echo $lang; ?>/<?php echo $lang; ?>_back2.gif" border=0>
   			<img src="<?php echo $root_path; ?>gui/img/control/<?php echo $v; ?>/<?php echo $lang; ?>/<?php echo $lang; ?>_hilfe-r.gif" border=0>
   			<img src="<?php echo $root_path; ?>gui/img/control/<?php echo $v; ?>/<?php echo $lang; ?>/<?php echo $lang; ?>_cancel.gif" border=0></td>
  </tr>
<?php
}
?>
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
