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
$lang_tables=array('date_time.php');
define('LANG_FILE','aufnahme.php');
//define('NO_2LEVEL_CHK',1);
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/inc_date_format_functions.php');

if(!isset($currDay)||!$currDay) $currDay=date('d');
if(!isset($currMonth)||!$currMonth) $currMonth=date('m');
if(!isset($currYear)||!$currYear) $currYear=date('Y');

$thisfile=basename(__FILE__);
require_once($root_path.'include/care_api_classes/class_appointment.php');
$appt_obj=new Appointment();

if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {
		include_once($root_path.'include/inc_date_format_functions.php');
		$HTTP_POST_VARS['date']=@formatDate2STD($HTTP_POST_VARS['date'],$date_format);
		$HTTP_POST_VARS['time']=@convertTimeToStandard($HTTP_POST_VARS['time']);
		if($mode=='update'){
			if(!isset($HTTP_POST_VARS['remind_mail'])) $HTTP_POST_VARS['remind_mail']='0';
			if(!isset($HTTP_POST_VARS['remind_email'])) $HTTP_POST_VARS['remind_email']='0';
			if(!isset($HTTP_POST_VARS['remind_phone'])) $HTTP_POST_VARS['remind_phone']='0';
			$HTTP_POST_VARS['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." : ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		}else{
			$HTTP_POST_VARS['appt_status']='pending';
		}
		include('./include/save_admission_data.inc.php');
	}elseif(($mode=='select')&&!empty($nr)){
		$appt_row=$appt_obj->getAppointment($nr);
		if(is_array($appt_row)){
			while(list($x,$v)=each($appt_row)) $$x=$v;
		}
	}elseif($mode=='appt_cancel'&&!empty($nr)){
		if($appt_obj->cancelAppointment($nr,$reason,$HTTP_SESSION_VARS['sess_user_name'])){
			header("location:$thisfile".URL_REDIRECT_APPEND."&currYear=$currYear&currMonth=$currMonth&currDay=$currDay");
			exit;
		}else{
			echo "$appt_obj->sql<br>$LDDbNoUpdate";
		}	
	}
if($mode=='show'){
	$result=&$appt_obj->getAllByDateObj($currYear,$currMonth,$currDay);
}
/* Load departments */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$deptarray=$dept_obj->getAllMedical('name_formal');
$breakfile=$root_path.'main/startframe.php';
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
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
<BODY  bgcolor="silver" alink="navy" vlink="navy" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDAppointments"; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>

<?php 
/*generate the calendar */
include($root_path.'classes/calendar_jl/class.calendar.php'); 
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
