<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','ambulatory.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);
$HTTP_SESSION_VARS['sess_user_origin']='amb';
$HTTP_SESSION_VARS['sess_parent_mod']='';
/* Create department object and load all medical depts */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj= new Department;
$medical_depts=&$dept_obj->getAllMedical();

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<script language="javascript">
<!-- Script Begin
function goDept(t) {
	d=document.dept_select;
	if(d.dept_nr.value!=""){
		d.subtarget.value=d.dept_nr.value;
		d.action=t;
		eval("d.dept.value=d.dname"+d.dept_nr.value+".value;");
		d.submit();
	}
}
//  Script End -->
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDAmbulatory ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('ambulatory.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>

<?php
# Prepare select options
$TP_SELECT_BLOCK='<select name="dept_nr" size="1"><option value=""></option>';
while(list($x,$v)=each($medical_depts)){
	$TP_SELECT_BLOCK.='
	<option value="'.$v['nr'].'">';
	$buffer=$v['LD_var'];
	if(isset($$buffer)&&!empty($$buffer)) $TP_SELECT_BLOCK.=$$buffer;
		else $TP_SELECT_BLOCK.=$v['name_formal'];
	$TP_SELECT_BLOCK.='</option>';
}
$TP_SELECT_BLOCK.='</select>';
#Prepare hidden inputs
$TP_HIDDENS='';
reset($medical_depts);
while(list($x,$v)=each($medical_depts)){
	$buffer=$v['LD_var'];
	if(isset($$buffer)&&!empty($$buffer)) $dname=$$buffer;
		else $dname= $v['name_formal'];
	$TP_HIDDENS.='
	<input type="hidden" name="dname'.$v['nr'].'" value="'.$dname.'">';
}

# hidden
$TP_HINPUTS='<input type="hidden" name="sid" value="'.$sid.'">
   			<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="target" value="generic">
   			<input type="hidden" name="user_origin" value="amb">
   			<input type="hidden" name="subtarget" value="">
   			<input type="hidden" name="dept" value="">';


$TP_HREF_APPT1='<a href="javascript:goDept(\''.$root_path.'modules/appointment_scheduler/appt_main_pass.php\')">'.$LDAppointments.'</a>';
$TP_HREF_PWL1='<a href="javascript:goDept(\'amb_clinic_patients_pass.php\')">'.$LDOutpatientClinic.'</a>';
$TP_HREF_PREQ1='<a href="javascript:goDept(\''.$root_path.'modules/laboratory/labor_test_request_pass.php\')">'.$LDPendingRequest.'</a>';
$TP_HREF_NEWS1='<a href="javascript:goDept(\''.$root_path.'modules/news/newscolumns.php\')">'.$LDNews.'</a>';

$TP_HREF_APPT2="<a href=\"".$root_path."modules/appointment_scheduler/appt_main_pass.php".URL_APPEND."&target=14&dept_nr=14&user_origin=amb&dept=".strtr($LDEmergency,' ','+')."\">$LDAppointments</a>";
$TP_HREF_PWL2="<a href=\"amb_clinic_patients_pass.php".URL_APPEND."&dept_nr=14&dept=".strtr($LDEmergency,' ','+')."\">$LDOutpatientClinic</a>";
$TP_HREF_PREQ2="<a href=\"".$root_path."modules/laboratory/labor_test_request_pass.php".URL_APPEND."&target=generic&subtarget=14&user_origin=amb\">$LDPendingRequest</a>";
$TP_HREF_NEWS2="<a href=\"".$root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=14&user_origin=amb\">$LDNews</a>";

$TP_HREF_APPT3="<a href=\"".$root_path."modules/appointment_scheduler/appt_main_pass.php".URL_APPEND."&target=15&dept_nr=15&user_origin=amb&dept=".strtr($LDGeneralAmbulatory,' ','+')."\">$LDAppointments</a>";
$TP_HREF_PWL3="<a href=\"amb_clinic_patients_pass.php".URL_APPEND."&dept_nr=15&dept=".strtr($LDGeneralAmbulatory,' ','+')."\">$LDOutpatientClinic</a>";
$TP_HREF_PREQ3="<a href=\"".$root_path."modules/laboratory/labor_test_request_pass.php".URL_APPEND."&target=generic&subtarget=15&user_origin=amb\">$LDPendingRequest</a>";
$TP_HREF_NEWS3="<a href=\"".$root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=15&user_origin=amb\">$LDNews</a>";

$TP_HREF_APPT4="<a href=\"".$root_path."modules/appointment_scheduler/appt_main_pass.php".URL_APPEND."&target=17&dept_nr=17&user_origin=amb&dept=".strtr($LDSonography,' ','+')."\">$LDAppointments</a>";
$TP_HREF_PWL4="<a href=\"amb_clinic_patients_pass.php".URL_APPEND."&dept_nr=17&dept=".strtr($LDSonography,' ','+')."\">$LDOutpatientClinic</a>";
$TP_HREF_PREQ4="<a href=\"".$root_path."modules/laboratory/labor_test_request_pass.php".URL_APPEND."&target=generic&subtarget=17&user_origin=amb\">$LDPendingRequest</a>";
$TP_HREF_NEWS4="<a href=\"".$root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=17&user_origin=amb\">$LDNews</a>";

$TP_HREF_APPT5="<a href=\"".$root_path."modules/appointment_scheduler/appt_main_pass.php".URL_APPEND."&target=16&dept_nr=16&user_origin=amb&dept=".strtr($LDInternalMed,' ','+')."\">$LDAppointments</a>";
$TP_HREF_PWL5="<a href=\"amb_clinic_patients_pass.php".URL_APPEND."&dept_nr=16&dept=".strtr($LDInternalMed,' ','+')."\">$LDOutpatientClinic</a>";
$TP_HREF_PREQ5="<a href=\"".$root_path."modules/laboratory/labor_test_request_pass.php".URL_APPEND."&target=generic&subtarget=16&user_origin=amb\">$LDPendingRequest</a>";
$TP_HREF_NEWS5="<a href=\"".$root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=16&user_origin=amb\">$LDNews</a>";

$TP_HREF_APPT6="<a href=\"".$root_path."modules/appointment_scheduler/appt_main_pass.php".URL_APPEND."&target=18&dept_nr=18&user_origin=amb&dept=".strtr($LDNuclearMed,' ','+')."\">$LDAppointments</a>";
$TP_HREF_PWL6="<a href=\"amb_clinic_patients_pass.php".URL_APPEND."&dept_nr=18&dept=".strtr($LDNuclearMed,' ','+')."\">$LDOutpatientClinic</a>";
$TP_HREF_PREQ6="<a href=\"".$root_path."modules/laboratory/labor_test_request_pass.php".URL_APPEND."&target=generic&subtarget=18&user_origin=amb\">$LDPendingRequest</a>";
$TP_HREF_NEWS6="<a href=\"".$root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=18&user_origin=amb\">$LDNews</a>";

$TP_HREF_APPT7="<a href=\"".$root_path."modules/appointment_scheduler/appt_main_pass.php".URL_APPEND."&target=6&dept_nr=6&user_origin=amb&dept=".strtr($LDEarNoseThroath,' ','+')."\">$LDAppointments</a>";
$TP_HREF_PWL7="<a href=\"amb_clinic_patients_pass.php".URL_APPEND."&dept_nr=6&dept=".strtr($LDEarNoseThroath,' ','+')."\">$LDOutpatientClinic</a>";
$TP_HREF_PREQ7="<a href=\"".$root_path."modules/laboratory/labor_test_request_pass.php".URL_APPEND."&target=generic&subtarget=6&user_origin=amb\">$LDPendingRequest</a>";
$TP_HREF_NEWS7="<a href=\"".$root_path."modules/news/newscolumns.php".URL_APPEND."&dept_nr=6&user_origin=amb\">$LDNews</a>";

$TP_CANCEL_BUT='<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0').'  alt="'.$LDCloseAlt.'" align="middle"></a>';

# Load the template
$tp_amb=&$TP_obj->load('ambulatory/tp_menus.htm');
eval("echo $tp_amb;");
?>

</ul>
</FONT>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
