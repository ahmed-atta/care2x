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
$lang_tables=array('departments.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_oproom.php');

//$breakfile='dept_manage.php'.URL_APPEND;
$breakfile=$root_path.'modules/system_admin/edv-system-admi-welcome.php'.URL_APPEND	;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$t_date=$pday.'.'.$pmonth.'.'.$pyear;

# Create the OR object
$OR_obj=& new OPRoom;
# Get all OR
$OR_rooms=$OR_obj->AllORInfo();
# Get the number or returned ORs
$rows=$OR_obj->LastRecordCount();

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDOR :: $LDListConfig" ?>
</STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('or_config.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if($rows) { ?>

<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><font face="Verdana, Arial" size=3 color="#880000">
<b><?php echo str_replace("~station~",strtoupper($station),$LDStationExists) ?></b></font><p>
<?php } ?>
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>

<table border=0>
  <tr>
<!-- 	<td bgcolor="#e9e9e9"></td>
 -->    
 	<td class=pblock align=center bgColor="#eeeeee"><?php echo $LDORNr ?></td>
 	<td class=pblock align=center bgColor="#eeeeee"><?php echo $LDORName ?></td>
 	<td class=pblock align=center bgColor="#eeeeee"><?php echo $LDOPTable ?></td>
    <td class=pblock align=center bgColor="#eeeeee"><?php echo $LDTempClosed ?></td>
<!--     <td class=pblock align=center bgColor="#eeeeee"><?php echo $LDStatus ?></td>
 --> 	<td class=pblock align=center bgColor="#eeeeee"><?php echo $LDDateCreation ?></td>
    <td class=pblock align=center bgColor="#eeeeee"><?php echo $LDOwnerWard ?></td>
    <td class=pblock align=center bgColor="#eeeeee"><?php echo $LDOwnerDept ?></td>
    <td class=pblock align=center bgColor="#eeeeee"></td>
 </tr> 
  
<?php
if(is_object($OR_rooms)){

	while($ORoom=$OR_rooms->FetchRow()){
?>
  <tr>
 	<td class=pblock  bgColor="#eeeeee" align=center><a href="or_info.php<?php echo URL_APPEND."&nr=".$ORoom['nr']."&OR_nr=".$ORoom['room_nr']; ?>">
	<?php 
		 echo $ORoom['room_nr']; 
	?></a> </td>
    <td class=pblock  bgColor="#eeeeee">	
<?php
	if(!empty($ORoom['info'])){
	?>
	<a href="or_info.php<?php echo URL_APPEND."&nr=".$ORoom['nr']."&OR_nr=".$ORoom['room_nr']; ?>">
	<?php
	}
	 echo $ORoom['info'];
	if(!empty($ORoom['info'])) echo '</a>';
	 ?></td>
    <td class=pblock  bgColor="#eeeeee" align=center><?php echo $ORoom['nr_of_beds'] ?> </td>
    <td class=pblock  bgColor="#eeeeee"><?php
	 if($ORoom['is_temp_closed']=='1'){
	 	echo '<font color="red">'.$LDYes.'</font>'; 
	 }else{
		echo $LDNo;
	}
	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<a href="or_new.php'.URL_APPEND.'&mode=select&nr='.$ORoom['nr'].'&OR_nr='.$ORoom['room_nr'].'">';
	echo $LDChange;
	 ?></a> </td>
<!--     <td class=pblock  bgColor="#eeeeee"><?php if($ORoom['status']=='inactive') echo '<font color="red">'.$LDInactive.'</font>'; else echo $LDNormal ?> </td>
 -->    <td class=pblock  bgColor="#eeeeee"><?php  echo formatDate2Local($ORoom['date_create'],$date_format) ?> </td>
    <td class=pblock  bgColor="#eeeeee"><?php echo  $ORoom['ward_id'] ?> </td>
    <td class=pblock  bgColor="#eeeeee">
	<?php 
	
		$buf=$ORoom['LD_var'];
		if(!empty($buf)&&isset($$buf)&&!empty($$buf)) echo $$buf;
			else echo $ORoom['deptshort'];
	?> </td>
 </tr> 
<?php
	}
}
 ?>
 
</table>

<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>
</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</BODY>
</HTML>
