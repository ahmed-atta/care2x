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
$thisfile=basename(__FILE__);
require_once($root_path.'include/care_api_classes/class_appointment.php');
$obj=new Appointment();

if(!isset($mode)){
	$mode='show';
} else{
	if($mode=='create'||$mode=='update') {
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
		$appt_row=$obj->getAppointment($nr);
		if(is_array($appt_row)){
			while(list($x,$v)=each($appt_row)) $$x=$v;
		}
	}elseif($mode=='appt_cancel'&&!empty($nr)){
			$HTTP_POST_VARS['history']="CONCAT(history,'Cancel: ".date('Y-m-d H:i:s')." : ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
			$HTTP_POST_VARS['appt_status']='cancelled';
			$HTTP_POST_VARS['cancel_reason']=$reason;
			$mode='update';
		include('./include/save_admission_data.inc.php');
	}
	
}
$lang_tables=array('prompt.php','departments.php');
require('./include/init_show.php');

if($result=&$obj->getPersonsAppointmentsObj($pid)){
	$rows=$result->RecordCount();
}

# Load the encounter classes
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

/* Get all encounter classes */
$encounter_classes=&$enc_obj->AllEncounterClassesObject();

$subtitle=$LDAppointments;
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

/* Load departments */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$deptarray=$dept_obj->getAllMedical('name_formal');

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordYet);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
