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
$lang_tables=array('departments.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$breakfile='dept_list_config.php'.URL_APPEND;

if(!isset($mode)) $mode='';

$dept_obj=new Department;


if($mode)
{
	
	if(!isset($db)||!$db) include_once($root_path.'include/inc_db_makelink.php');
	if($dblink_ok)
		{
			switch($mode)
			{	
				case 'update': 
									$HTTP_POST_VARS['history']=" CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n"."')";
									$HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
									$dept_obj->setTable('care_department');
									$dept_obj->setDataArray($HTTP_POST_VARS);
									$dept_obj->where=' nr='.$dept_nr;
									if($dept_obj->updateDataFromInternalArray($dept_nr)) 
										{
											header("location:dept_status_config.php".URL_REDIRECT_APPEND."&edit=1&updateok=1&dept_nr=$dept_nr");
											exit;
										}
										else echo "$sql<br>$LDDbNoSave";
									break;
									
			}// end of switch
		}
  		 else { echo "$LDDbNoLink<br>"; } 
}

$depttypes=$dept_obj->getTypes();
$dept=$dept_obj->getDeptAllInfo($dept_nr);
extract($dept);					
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

function check(d)
{
	if((d.station.value=="")||(d.name.value=="")||(d.station.start_no=="")||(d.end_no.value==""))
	{
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
	if(parseInt(d.start_no.value)>=parseInt(d.end_no.value)) 
	{
		alert("<?php echo $LDAlertRoomNr ?>");
		return false;
	}
}

// -->
</script>

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
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDDept :: $LDStatus" ?> </STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','new')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if(isset($updateok)&&$updateok) { 
	$backimg='close2.gif';
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="middle"><font face="Verdana, Arial" size=3 color="#880000">
<b><?php echo $LDUpdateOk; ?></b></font>

<?php 
}else{
	$backimg='cancel.gif';
} ?>
&nbsp;
<br>
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<?php 
if(isset($$LD_var)&&$$LD_var) echo $$LD_var;
			else echo $name_formal; 
?></font>

<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>

<form action="dept_status_config.php" method="post" name="newstat">
<table border=0>

  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDDeptStatus ?>: </td>
    <td class=pblock>	<input type="radio" name="is_inactive" value="0" <?php if(!$is_inactive) echo 'checked'; ?>> <?php echo $LDActive ?>
    <td class=pblock>	<input type="radio" name="is_inactive" value="1" <?php if($is_inactive) echo 'checked'; ?>> <?php echo $LDInactive ?>
	</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDRecordStatus ?>: </td>
    <td class=pblock>	<input type="radio" name="status" value="" <?php if($status!='hidden') echo 'checked'; ?>> <?php echo $LDVisible ?> 
    <td class=pblock>	<input type="radio" name="status" value="hidden" <?php if($status) echo 'checked'; ?>> <?php echo $LDHidden ?>
	</td>
  </tr> 

</table>
<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept_nr" value="<?php echo $nr ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
<p>

<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,$backimg,'0') ?> border="0"></a>
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
