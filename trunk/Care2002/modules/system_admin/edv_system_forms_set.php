<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
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

if(!isset($GCONFIG)) $GCONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$gc=new GlobalConfig($GCONFIG);

if(isset($mode)&&($mode=='save')&&!empty($max_items)){
	
	for($i=1;$i<=$max_items;$i++){
		if(empty($HTTP_POST_VARS["value$i"])) $HTTP_POST_VARS["value$i"]='0';
		//echo $HTTP_POST_VARS["index$i"].'==>'.$HTTP_POST_VARS["value$i"].'<br>';
		$gc->saveConfigItem($HTTP_POST_VARS["index$i"],$HTTP_POST_VARS["value$i"]);
	}
	header('location:'.$thisfile.URL_REDIRECT_APPEND.'&mode=0');
	exit;
}else{
	$gc->getConfig('person_%_hide');
	$gc->getConfig('patient_%_hide');
	$gc->getConfig('patient_%_show');
}

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
<FONT  color="#000066" FACE="verdana,arial" size=4><?php echo $LDDataEntryForms; ?></font>
<form method="post">
<table border=0 cellspacing=1 cellpadding=2>  

  <tr background="../../gui/img/common/default/tableHeaderbg3.gif">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b></b></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDItem; ?></b></td>
   <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDStatus; ?></b></td>
  </tr>

<?php 
$i=1;
while(list($x,$v)=each($GCONFIG))
{
  echo '<tr>
	<td bgcolor="#e9e9e9"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>'.strtr($x,'_',' ').'</b> </FONT></td>
	<td bgcolor="#e9e9e9" align="center"><FONT   FACE="verdana,arial" size=2>	<input type="checkbox" name="value'.$i.'" value="1" ';
	if($v) echo 'checked';
	echo '><input type="hidden" name="index'.$i.'" value="'.$x.'">
       </td>  
	</tr>';
	
	$i++;
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
