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
$lang_tables=array('date_time.php','departments.php','actions.php','prompt.php');
define('LANG_FILE','aufnahme.php');
//define('NO_2LEVEL_CHK',1);
//define('NO_CHAIN',1);
$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

if(!isset($currDay)||!$currDay) $currDay=date('d');
if(!isset($currMonth)||!$currMonth) $currMonth=date('m');
if(!isset($currYear)||!$currYear) $currYear=date('Y');
if(isset($HTTP_SESSION_VARS['sess_parent_mod'])) $HTTP_SESSION_VARS['sess_parent_mod']='';

$thisfile=basename(__FILE__);
$editorfile=$root_path.'modules/registration_admission/show_appointment.php';
require_once($root_path.'include/care_api_classes/class_appointment.php');
$appt_obj=new Appointment();

if(!isset($mode)){
	$mode='show';
}elseif($mode=='appt_cancel'&&!empty($nr)){
	if($appt_obj->cancelAppointment($nr,$reason,$HTTP_SESSION_VARS['sess_user_name'])){
		header("location:$thisfile".URL_REDIRECT_APPEND."&currYear=$currYear&currMonth=$currMonth&currDay=$currDay");
		exit;
	}else{
		echo "$appt_obj->sql<br>$LDDbNoUpdate";
	}	
}

if($mode=='show'){
	# Clean doc
	if(isset($aux)) $aux=trim($aux);
	# Get the appointments basing on some conditions
	if((isset($dept_nr)&&$dept_nr)){
		# Get by department
		$result=&$appt_obj->getAllByDeptObj($currYear,$currMonth,$currDay,$dept_nr);
	}elseif(isset($aux)&&!empty($aux)){
		# Get by doctor
		$result=&$appt_obj->getAllByDocObj($currYear,$currMonth,$currDay,$aux);
	}else{
		# Get all appointments
		$result=&$appt_obj->getAllByDateObj($currYear,$currMonth,$currDay);
	}
}

$HTTP_SESSION_VARS['sess_parent_mod']='';
$HTTP_SESSION_VARS['sess_appt_dept_nr']='';
$HTTP_SESSION_VARS['sess_appt_doc']='';
# Create encounter object
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;
# load all encounter classes
if($ec_obj=&$enc_obj->AllEncounterClassesObject()){
	# Prepare to an array, technique is used in listing routines
	while($ec_row=$ec_obj->FetchRow()) $enc_class[$ec_row['class_nr']]=$ec_row;
}
# Load departments
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$deptarray=$dept_obj->getAllMedical('name_formal');
# Set the break (return) file
switch($HTTP_SESSION_VARS['sess_user_origin']){
	case 'amb': $breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND; break;
	default: $breakfile=$root_path.'main/startframe.php'.URL_APPEND;
}
# Create department object
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
# Load all medical departments 
$med_arr=&$dept_obj->getAllMedical();

# Prepare the html select options
$options='';
while(list($x,$v)=each($med_arr)){
	if($x==42) continue;
	$buffer=$v['LD_var'];
	if(isset($$buffer)&&!empty($$buffer)) $buf2=$$buffer;
		else $buf2=$v['name_formal'];	
	$options.='
	<option value="'.$v['nr'].'"';
	if ($dept_nr==$v['nr']){
		$options.=' selected';
		$curr_dept=$buf2;
	}
	$options.='>'.$buf2.'</option>';
}

# Load the common icons 
$img_male=createComIcon($root_path,'spm.gif','0');
$img_female=createComIcon($root_path,'spf.gif','0');

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: none; }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<script language="javascript">
<!-- 
  var urlholder;
function popinfo(l,d)
{
	urlholder="nursing-or-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");

}

-->
</script>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>
<BODY  bgcolor="<?php echo $cfg['body_bgcolor']; ?>" alink="navy" vlink="navy" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo $LDAppointments; //if(!empty($curr_dept)) echo " :: $curr_dept"; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('appointment_show.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<?php 
/*generate the calendar */
include($root_path.'classes/calendar_jl/class.calendar.php'); 
/** CREATE CALENDAR OBJECT **/
$Calendar = new Calendar;
/** WRITE CALENDAR **/
$Calendar -> mkCalendar ($currYear, $currMonth, $currDay,$dept_nr,$aux);
?>

</td>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" valign="top">
<font  SIZE=2  FACE="Arial,verdana">
<form name="bydept">
<?php echo $LDListApptByDept; ?>:<br>
<select name="dept_nr">
	<option value=""><?php echo $LD_AllMedicalDept; ?></option>
<?php
# Display options
echo $options;
?>
</select>
<input type="submit" value="<?php echo $LDShow; ?>">
<input type="hidden"  name="currYear" value="<?php echo $currYear; ?>">
<input type="hidden"  name="currMonth" value="<?php echo $currMonth; ?>">
<input type="hidden"  name="currDay" value="<?php echo $currDay; ?>">
<input type="hidden"  name="sid" value="<?php echo $sid; ?>">
<input type="hidden"  name="lang" value="<?php echo $lang; ?>">
</form>
<form name="bydoc">
<?php echo $LDListApptByDoc; ?>:<br>
<input type="text" name="aux" size=35 maxlength=40 value="<?php echo $aux; ?>">
<input type="submit" value="<?php echo $LDShow; ?>">
<input type="hidden"  name="name_last" value="">
<input type="hidden"  name="name_first" value="">
<input type="hidden"  name="date_birth" value="">
<input type="hidden"  name="personnel_nr" value="">
<input type="hidden"  name="currYear" value="<?php echo $currYear; ?>">
<input type="hidden"  name="currMonth" value="<?php echo $currMonth; ?>">
<input type="hidden"  name="currDay" value="<?php echo $currDay; ?>">
<input type="hidden"  name="sid" value="<?php echo $sid; ?>">
<input type="hidden"  name="lang" value="<?php echo $lang; ?>">
</form>
</td>
</tr>

<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>
<?php
/* show the appointments */
if($appt_obj->count){
	include('./gui_bridge/default/gui_show_appointment.php');
}else{
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo ((date('Y-m-d'))==$currYear.'-'.$currMonth.'-'.$currDay) ? $LDNoPendingApptToday : $LDNoPendingApptThisDay; ?></b></font></td>
  </tr>
</table>
<?php
}
?>
	
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>">
</a></FONT>
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
