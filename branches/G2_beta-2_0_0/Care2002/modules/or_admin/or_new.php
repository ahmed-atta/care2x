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

$dept_logos_path='gui/img/logos_dept/'; # Define the path to the department logos

$lang_tables[]='departments.php';
$lang_tables[]='date_time.php';
$lang_tables[]='prompt.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
require_once($root_path.'include/care_api_classes/class_oproom.php');

require_once($root_path.'include/inc_date_format_functions.php');

$breakfile=$root_path.'modules/system_admin/edv-system-admi-welcome.php'.URL_APPEND	;

if(!isset($mode)) $mode='';
# Create department object
$dept_obj=& new Department;
# Create the OR object
$OR_obj= & new OPRoom;
# Create the ward object
$ward_obj=& new Ward;

//$db->debug=1;

# Validate 3 most important inputs
if(isset($mode)&&!empty($mode)&&$mode!='select'){
	# format date to standard
	$datebuffer=formatDate2STD($HTTP_POST_VARS['date_create'],$date_format);
	if(empty($HTTP_POST_VARS['room_nr'])||empty($datebuffer)||($mode=='update'&&empty($HTTP_POST_VARS['nr']))){
		$inputerror=TRUE; # Set error flag
		$error_msg=$LDInputError;
	}
	
}

if(!empty($mode)&&!$inputerror){
		
	# Compose the data for storing into history field
	$udata='name='.$HTTP_POST_VARS['info'].': bed='. $HTTP_POST_VARS['nr_of_beds'].': ward='.$HTTP_POST_VARS['ward_nr'].': dept='.$HTTP_POST_VARS['dept_nr'].': closed='.$HTTP_POST_VARS['is_temp_closed'];
	
	switch($mode)
	{	
		case 'create': 
		{
			if($OR_obj->ORNrExists($HTTP_POST_VARS['room_nr'])){
				$error_msg=$LDORNrExists;
				$inputerror=TRUE;
			}else{
					
				# Validate the date creation, if invalid, use today date
				if(empty($datebuffer)) $HTTP_POST_VARS['date_create']=date('Y-m-d');
					else $HTTP_POST_VARS['date_create']=$datebuffer;
				
				# Validate number of beds..if invalid use 1
				if(!$HTTP_POST_VARS['nr_of_beds']) $HTTP_POST_VARS['nr_of_beds']=1;
				
				$HTTP_POST_VARS['type_nr']=$OR_obj->ORTypeNr(); # 2 = operating room
				$HTTP_POST_VARS['history']="Create: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']." ".$udata."\n";
				$HTTP_POST_VARS['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
				//$HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
				$HTTP_POST_VARS['create_time']=date('YmdHis');
				$HTTP_POST_VARS['modify_time']=date('YmdHis');
				
				$OR_obj->setDataArray($HTTP_POST_VARS);
				
				if($OR_obj->insertDataFromInternalArray()){
					
					# Get the last insert primary key as op room nr.
				
					$nr=$OR_obj->LastInsertPK('nr',$db->Insert_ID());
							
					header("location:or_info.php".URL_REDIRECT_APPEND."&edit=1&mode=newdata&nr=$nr");
					exit;
				}else{
					echo $OR_obj->getLastQuery."<br>$LDDbNoSave";
					$inputerror=TRUE;
				}
			}	
			break;
		}
		case 'update':
		{ 
			
			$HTTP_POST_VARS['history']=$OR_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']." $udata\n");
			$HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
			$HTTP_POST_VARS['modify_time']=date('YmdHis');
			
			$OR_obj->setDataArray($HTTP_POST_VARS);
			$OR_obj->where='nr='.$HTTP_POST_VARS['nr'];
			
			if($OR_obj->updateDataFromInternalArray($nr)){
				header("location:or_info.php".URL_REDIRECT_APPEND."&edit=1&mode=newdata&nr=".$HTTP_POST_VARS['nr']."&OR_nr=".$HTTP_POST_VARS['room_nr']);
				exit;
			}else{
				echo $OR_obj->getLastQuery."<br>$LDDbNoSave";
			}
			break;
		}
		case 'select':
		{
			# Get departmentīs information
			if(isset($nr)&&$nr){
				$OR_Info=$OR_obj->ORRecordInfo($nr);
			}elseif(isset($OR_nr)&&$OR_nr){
				$OR_Info=$OR_obj->ORInfo($OR_nr);
			}else{
				$mode='';
			}
				
			if(is_object($OR_Info)&&$mode!=''){
				$ORoom=$OR_Info->FetchRow();
				extract($ORoom);
			}
		}
	}// end of switch
}

# Load all active medical departments available
$deptarray=$dept_obj->getAllMedical('name_formal');

# Set ward items for loading
$witem='nr, ward_id, name';

# Load the active wards available
$wardsarray=$ward_obj->getAllWardsItemsArray($witem);

$newORnr=$OR_obj->NewORNr();

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

function chkForm(d){
	
	av="<?php echo $OR_obj->CombinedORNrs(); ?>";
	mode="";
	if(d.room_nr.value==""){
		alert("<?php echo $LDPlsORNr ?>");
		d.room_nr.value="<?php echo $newORnr ?>";
		d.room_nr.focus();
		return false;
	}else if((av.indexOf(d.room_nr.value)!=-1)&& (mode=="<?php echo $mode ?>")){
		alert("<?php echo $LDORNrExists ?>");
		d.room_nr.focus();
		return false;
	}else if((d.date_create.value=="") && (mode=="<?php echo $mode ?>")){
		alert("<?php echo $LDPlsEnterDate ?>");
		d.date_create.focus();
		return false;
	}else{
		return true;
	}
}
function newORnr(){
	document.newstat.room_nr.value="<?php echo $newORnr ?>";
}
<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

// -->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDOR :: "; if($mode=='select') echo $LDUpdate; else echo $LDCreate; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('or_create.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
 
<FONT    SIZE=3 color=#800000 FACE="Arial"><p>
 <?php
 if(isset($inputerror)&&$inputerror){
 	echo "<font color=#ff0000 face='verdana,arial' size=3>$error_msg</font><p>";
 }elseif(isset($save_ok)&&$save_ok){
 	 echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>'.$LDDataSaved.'<p>';
}

echo $LDEnterInfo;
?>
</font>
<p> 
 
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>

<form action="or_new.php" method="post" name="newstat"  onSubmit="return chkForm(this)">

<table border=0>


  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b>
	<?php echo $LDORNr ?></font>: 
	</td>
    <td class=pblock bgColor="#f9f9f9">
	<?php
		if($mode=='select'||$mode=='update') { echo '<input type="hidden" name="room_nr"  value="'.$room_nr.'">'.$room_nr; } else {
	?>
	<input type="text" name="room_nr" size=4 maxlength=4 value=<?php echo  $newORnr; ?>> <a href="javascript:newORnr()"><img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDClkNextNr ?></a>
 
	<?php
	}
	?>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b><?php echo $LDOPTableNr ?></font>: </td>
    <td class=pblock bgColor="#f9f9f9">
	<select name="nr_of_beds">
 	<option value="1">1</option>
 	<option value="2">2</option>
 	<option value="3">3</option>
 	<option value="4">4</option>
 	<option value="5">5</option>
 	<option value="6">6</option>
 	<option value="0">??</option>
 </select>
 
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b><?php echo $LDDateCreation; ?>: </td>
    <td class=pblock bgColor="#f9f9f9">
	<?php
		if($mode=='select'||$mode=='update'){
			echo '<input type="hidden" name="date_create" value="'.$date_create.'">';
			echo formatDate2Local($date_create,$date_format);
		}else{
	?>
	<input type="text" name="date_create" size=10 maxlength=10  
	 	 value="<?php
		 	if(isset($inputerror) && $inputerror){
				echo $date_create;
			}else{
		  		if(!isset($date_create)||empty($date_create)) $date_create=date('Y-m-d');
				echo formatDate2Local($date_create,$date_format);
			}
		?>" 
	 	onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
		<a href="javascript:show_calendar('newstat.date_create','<?php echo $date_format ?>')">
 		<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a> 
 		<font size=1>[ <?php   
 		$dfbuffer="LD_".strtr($date_format,".-/","phs");
  		echo $$dfbuffer;
 		?> ] </font>
	<?php
	}
	?>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDORName ?>: </td>
    <td class=pblock bgColor="#f9f9f9"><input type="text" name="info" size=50 maxlength=60 value="<?php echo $info ?>"><br>
</td>
  </tr> 
<tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDOwnerWard; ?>: </td>
    <td class=pblock bgColor="#f9f9f9">
		<select name="ward_nr">
		<option value=""> </option>';
	<?php
		
		while(list($x,$v)=each($wardsarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$ward_nr) echo 'selected';
			if(defined('SHOW_COMBINE_WARDIDNAME')&&SHOW_COMBINE_WARDIDNAME){
				$buffer= '>['.$v['ward_id'].'] '.$v['name'];
			}else{
				if(defined('SHOW_FULL_WARDNAME')&&SHOW_FULL_WARDNAME) $buffer= ' >'.$v['name'];
					else $buffer= ' >'.$v['ward_id'];
			}
			echo $buffer.'</option>
			';
		}
	?>
        </select>
</td>
  </tr>

<tr>
    <td class=pblock align=right bgColor="#eeeeee"></font><?php echo $LDOwnerDept; ?>: </td>
    <td class=pblock bgColor="#f9f9f9"><select name="dept_nr">
	<option value=""> </option>';
	<?php
		while(list($x,$v)=each($deptarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$dept_nr) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name_formal'];
			echo '</option>';
		}
	?>
                     </select>
</td>
  </tr>

  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDTempClosed ?>: </td>
    <td class=pblock bgColor="#f9f9f9"><input type="radio" name="is_temp_closed" value="0" <?php if(!$is_temp_closed) echo 'checked'; ?>> <?php echo $LDNo ?> <input type="radio" name="is_temp_closed" value="1" <?php if($is_temp_closed) echo 'checked'; ?>> <?php echo $LDYes ?> 
</td>
  </tr> 
 
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<?php
 if($mode=='select') {
?>
<input type="hidden" name="mode" value="update">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>
<?php
}else{
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
