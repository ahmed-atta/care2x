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

if(isset($mode)&&($mode=='save')){
	for($i=1;$i<=$max_items;$i++){
		$sort_nr='sort_nr_'.$i;
		$is_visible='hide_it_'.$i;
		$sql="UPDATE care_menu_main SET sort_nr=".$$sort_nr.",is_visible='".$$is_visible."',hide_by='' WHERE nr=$i";
		$db->Execute($sql);
	}
	
	header('location:'.$thisfile.URL_REDIRECT_APPEND.'&mode=0');
	exit;
}

if($result=$db->Execute("SELECT nr,sort_nr,name,LD_var,status,url,hide_by,is_visible FROM care_menu_main WHERE 1 ORDER BY sort_nr")){
	$row=$result->RecordCount();
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
<br>

<form>
<table border=0 cellspacing=1 cellpadding=2>  

  <tr background="../../gui/img/common/default/tableHeaderbg3.gif">
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDMenuItem; ?></b></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDOrderNr; ?></b></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDVisible; ?></b></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDPath; ?></b></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDStatus; ?></b></td>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDHideBy; ?></b></td>
  </tr>

<?php 
$i=1;
while($menu_item=$result->FetchRow())
{

  echo '<tr>
	<td bgcolor="#e9e9e9"><img '.createComIcon($root_path,'arrow_blueW.gif','0').'></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>';
	if(isset($$menu_item['LD_var'])&&!empty($$menu_item['LD_var'])) echo $$menu_item['LD_var'];
		else echo $menu_item['name'];
	echo '</b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><input type="text" name="sort_nr_'.$menu_item['nr'].'" size=2 maxlength=2 value="'.$menu_item['sort_nr'].'"></FONT></td>
	<td bgcolor="#e9e9e9" align="center"><FONT  color="#0000cc" FACE="verdana,arial" size=2>	<input type="checkbox" name="hide_it_'.$menu_item['nr'].'" value="1" ';
	if($menu_item['is_visible']) echo 'checked';
	echo '><br></FONT></td>
	<td bgcolor="#e9e9e9"><FONT   FACE="verdana,arial" size=2>'.$menu_item['url'].'<br></td>  
	<td bgcolor="#f9f9f9"><FONT   FACE="verdana,arial" size=2>'.$menu_item['status'].'<br></td>  
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>'.$menu_item['hide_by'].'</b> </FONT></td>
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
