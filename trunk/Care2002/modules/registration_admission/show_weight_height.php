<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$thisfile=basename(__FILE__);
if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {
	include_once($root_path.'include/care_api_classes/class_measurement.php');
	if(!isset($obj)) $obj=new Measurement;
	include_once($root_path.'include/inc_date_format_functions.php');
	$HTTP_POST_VARS['msr_date']=@formatDate2STD($HTTP_POST_VARS['msr_date'],$date_format);
	//include('./include/save_prescription.inc.php');
	include('./include/save_admission_data.inc.php');
}

require('./include/init_show.php');

if($mode=='show'){
	$sql="SELECT m.*, t.LD_var AS type_LD_var, t.name AS type_name, u.LD_var AS unit_LD_var, u.id AS unit_id 
		FROM 	care_encounter AS e, 
					care_person AS p, 
					care_encounter_measurement AS m, 
					care_type_measurement AS t,
					care_unit_measurement AS u
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." 
			AND p.pid=e.pid 
			AND e.encounter_nr=m.encounter_nr  
			AND (m.msr_type_nr=6 OR m.msr_type_nr=7)
			AND m.msr_type_nr=t.nr
			AND m.unit_nr=u.nr
		ORDER BY m.modify_time DESC";
		
	if($result=$db->Execute($sql)){
		$rows=$result->RecordCount();
	}
}

$subtitle=$LDWtHt;
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
