<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

$dept_logos_path='gui/img/logos_dept/'; # Define the path to the department logos

$lang_tables=array('departments.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$breakfile='dept_list.php'.URL_APPEND;

if(!isset($mode)) $mode='';

$dept_obj=new Department;


if(!empty($mode)){

	$is_img=false;
	# If a pic file is uploaded move it to the right dir
	if(is_uploaded_file($HTTP_POST_FILES['img']['tmp_name']) && $HTTP_POST_FILES['img']['size']){
		$picext=substr($HTTP_POST_FILES['img']['name'],strrpos($HTTP_POST_FILES['img']['name'],'.')+1);
		if(stristr('jpg,gif,png',$picext)){
			$is_img=true;	
			# Forcibly convert file extension to lower case.
			$HTTP_POST_VARS['logo_mime_type']=strtolower($picext);
		}
	}
	
	switch($mode)
	{	
		case 'create': 
		{
			$HTTP_POST_VARS['history']='Create: '.date('Y-m-d H:i:s').' '.$HTTP_SESSION_VARS['sess_user_name'];
			$HTTP_POST_VARS['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
			$HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
			$HTTP_POST_VARS['create_time']='NULL';
			$dept_obj->setDataArray($HTTP_POST_VARS);
			if($dept_obj->insertDataFromInternalArray()){
				$dept_nr=$db->Insert_ID();
				if($is_img){
				    $picfilename='dept_'.$dept_nr.'.'.$picext;
			       copy($HTTP_POST_FILES['img']['tmp_name'],$root_path.$dept_logos_path.$picfilename);
				}
				header("location:dept_info.php".URL_REDIRECT_APPEND."&edit=1&mode=newdata&dept_nr=$dept_nr");
				exit;
			}else{
				echo $dept_obj->getLastQuery."<br>$LDDbNoSave";
			}
			break;
		}	
		case 'update':
		{ 
			$HTTP_POST_VARS['history']=" CONCAT(history,'Update: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n"."')";
			$HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
			$dept_obj->setTable('care_department');
			$dept_obj->setDataArray($HTTP_POST_VARS);
			$dept_obj->where=' nr='.$dept_nr;
			if($dept_obj->updateDataFromInternalArray($dept_nr)){
				if($is_img){
				    $picfilename='dept_'.$dept_nr.'.'.$picext;
			        copy($HTTP_POST_FILES['img']['tmp_name'],$root_path.$dept_logos_path.$picfilename);
				}
				header("location:dept_info.php".URL_REDIRECT_APPEND."&edit=1&mode=newdata&dept_nr=$dept_nr");
				exit;
			}else{
				echo $dept_obj->getLastQuery."<br>$LDDbNoSave";
			}
			break;
		}
		case 'select':
		{
			$dept=$dept_obj->getDeptAllInfo($dept_nr);
			//while(list($x,$v)=each($dept)) $$x=$v;
			extract($dept);
		}	
	}// end of switch
}

$deptarray=$dept_obj->getAllActiveSort('name_formal');
$depttypes=$dept_obj->getTypes();

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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDDepartment :: "; if($mode=='select') echo $LDUpdate; else echo $LDCreate; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>

<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<form action="dept_new.php" method="post" name="newstat" ENCTYPE="multipart/form-data" >
<table border=0>
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDFormalName ?>: </td>
    <td class=pblock><input type="text" name="name_formal" size=40 maxlength=40 value="<?php echo $name_formal ?>"><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>
	<?php echo $LDInternalID ?>: 
	</td>
    <td class=pblock>
	<?php
		if($mode=='select') { echo $id; } else {
	?>
	<input type="text" name="id" size=40 maxlength=40 value="<?php echo $id; ?>">
	<?php
	}
	?>
</td>
  </tr> 

<tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDTypeDept ?>: </td>
    <td class=pblock><select name="type">
	<?php
		
		while(list($x,$v)=each($depttypes)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$type) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name'];
			echo '</option>';
		}
	?>
                     </select>
		<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
</td>
  </tr>
  
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDDescription ?>: </td>
    <td class=pblock><textarea name="description" cols=40 rows=4 wrap="physical"><?php echo $description ?></textarea>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDIsSubDept ?>: </td>
    <td class=pblock>	<input type="radio" name="is_sub_dept" value="1" <?php if($is_sub_dept) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="is_sub_dept" value="0" <?php if(!$is_sub_dept) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 
<tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDParentDept; ?>: </td>
    <td class=pblock><select name="parent_dept_nr">
	<option value=""> </option>';
	<?php
		
		while(list($x,$v)=each($deptarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$parent_dept_nr) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name_formal'];
			echo '</option>';
		}
	?>
                     </select>
		<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">
	<?php if($mode!='select') echo '<font color=#ff0000><b>*</b></font>'; ?>
	<?php echo $LDLangVariable ?>: 
	</td>
    <td class=pblock>
	<?php
		if($mode=='select'){
			echo $LD_var;
		}else{
	?>
	<input type="text" name="LD_var" size=40 maxlength=40 value="<?php echo $LD_var ?>"><br>
	<?php
		}
	?>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDShortName ?>: </td>
    <td class=pblock><input type="text" name="name_short" size=40 maxlength=40 value="<?php echo $name_short ?>"><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDAlternateName ?>: </td>
    <td class=pblock><input type="text" name="name_alternate" size=40 maxlength=40 value="<?php echo $name_alternate ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDDoesSurgeryOp ?>: </td>
    <td class=pblock>	<input type="radio" name="does_surgery" value="1" <?php if($does_surgery) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="does_surgery" value="0" <?php if(!$does_surgery) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDAdmitsInpatients ?>: </td>
    <td class=pblock>	<input type="radio" name="admit_inpatient" value="1" <?php if($admit_inpatient) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="admit_inpatient" value="0" <?php if(!$admit_inpatient) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDAdmitsOutpatients ?>: </td>
    <td class=pblock>	<input type="radio" name="admit_outpatient" value="1" <?php if($admit_outpatient) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="admit_outpatient" value="0" <?php if(!$admit_outpatient) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 

    <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDBelongsToInst ?>: </td>
    <td class=pblock>	<input type="radio" name="this_institution" value="1" <?php if($this_institution) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="this_institution" value="0" <?php if(!$this_institution) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDWorkHrs ?>: </td>
    <td class=pblock><input type="text" name="work_hours" size=40 maxlength=40 value="<?php echo $work_hours ?>"><br>
</td>
  </tr> 

  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDConsultationHrs ?>: </td>
    <td class=pblock><input type="text" name="consult_hours" size=40 maxlength=40 value="<?php echo $consult_hours ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDSigLine ?>: </td>
    <td class=pblock><input type="text" name="sig_line" size=40 maxlength=40 value="<?php echo $sig_line ?>"><br>
</td>
  </tr> 
 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDSigStampTxt ?>: </td>
    <td class=pblock><textarea name="sig_stamp" cols=40 rows=4 wrap="physical"><?php echo $sig_stamp ?></textarea>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDDeptLogo ?>: </td>
    <td class=pblock><input type="file" name="img" ><br>
</td>
  </tr> 

 
</table>
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<?php
 if($mode=='select') {
?>
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept_nr" value="<?php echo $nr ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>
<?php
}
else
{
?>
<input type="hidden" name="mode" value="create">
<input type="submit" value="<?php echo $LDCreate ?>">
<?php
}
?>
</form>
<p>

<a href="javascript:history.back()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>
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
