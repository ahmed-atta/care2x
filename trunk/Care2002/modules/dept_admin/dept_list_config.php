<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');

//$breakfile='dept_manage.php'.URL_APPEND;
$breakfile=$root_path.'modules/system_admin/edv-system-admi-welcome.php'.URL_APPEND	;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$t_date=$pday.'.'.$pmonth.'.'.$pyear;

$dept_obj=new Department;

$deptarray=$dept_obj->getAllNoCondition('name_formal');

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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDDepartment :: $LDList" ?>
</STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('dept_config.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
 	<td class=pblock align=center bgColor="#eeeeee"><?php echo $LDDept ?></td>
    <td class=pblock align=center bgColor="#eeeeee"><?php echo $LDDeptStatus ?></td>
    <td class=pblock align=center bgColor="#eeeeee"><?php echo $LDRecordStatus ?></td>
    <td class=pblock align=center bgColor="#eeeeee"></td>
 </tr> 
  
<?php
while(list($x,$v)=each($deptarray)){
?>
  <tr>
<!-- 	<td bgcolor="#e9e9e9"><img <?php echo createComIcon($root_path,'arrow_blueW.gif','0'); ?>></td>
 -->    
 	<td class=pblock  bgColor="#eeeeee"><a href="dept_info.php<?php echo URL_APPEND."&dept_nr=".$v['nr']; ?>">
	<?php 
		if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
			else echo $v['name_formal']; 
	?></a> </td>
    <td class=pblock  bgColor="#eeeeee"><?php if($v['is_inactive']) echo '<font color="red">'.$LDInactive.'</font>'; else echo $LDActive ?> 
[<a href="dept_status.php<?php echo URL_APPEND; ?>&nr=<?PHP echo $v['nr']."&active=".$v['is_inactive']; ?>">x</a>]
</td>
    <td class=pblock  bgColor="#eeeeee"><?php if($v['status']=='hidden') echo '<font color="red">'.$LDHidden.'</font>'; else echo $LDVisible ?> 
[<a href="dept_status.php<?php echo URL_APPEND; ?>&nr=<?PHP echo $v['nr']; ?>&status=<?PHP if($v['status']=='hidden') echo 'visible'; else echo "hidden"; ?>">x</a>]
</td>
 	<td class=pblock  bgColor="#eeeeee"><a href="dept_status_config.php<?php echo URL_APPEND."&dept_nr=".$v['nr']; ?>"><?php echo $LDChange; ?></a> </td>
 </tr> 
<?php
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
