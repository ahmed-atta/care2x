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
$thisfile=basename(__FILE__);
if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {
	include_once($root_path.'include/care_api_classes/class_prescription.php');
	if(!isset($obj)) $obj=new Prescription;
	include_once($root_path.'include/inc_date_format_functions.php');
	$HTTP_POST_VARS['prescribe_date']=@formatDate2STD($HTTP_POST_VARS['prescribe_date'],$date_format);
	//echo 	$HTTP_POST_VARS['prescribe_date'];

	//include('./include/save_prescription.inc.php');
	include('./include/save_admission_data.inc.php');
}
require('./include/init_show.php');

$sql="SELECT e.insurance_nr,e.current_dept_nr,f.name AS insurers_name 
		FROM 	care_encounter AS e
		LEFT JOIN
					care_insurance_firm AS f ON e.insurance_firm_id=f.firm_id
		WHERE  e.encounter_nr=".$HTTP_SESSION_VARS['sess_en'];
		
if($result=$db->Execute($sql)){
	if($rows=$result->RecordCount()){
		$encounter=$result->FetchRow();
	}
}else{
echo $sql;
}
$subtitle=$LDSickReport;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

/* Load all  medical depts info */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_med=$dept_obj->getAllMedical();
if(isset($deptnr)&&!empty($deptnr)) $encounter['current_dept_nr']=$deptnr;
$dept_address=$dept_obj->Address($encounter['current_dept_nr']);
$dept_sigstamp=$dept_obj->SignatureStamp($encounter['current_dept_nr']);
/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
