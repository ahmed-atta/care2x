<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

//$db->debug=1;

$thisfile=basename(__FILE__);
if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {
	include_once($root_path.'include/care_api_classes/class_prescription.php');
	if(!isset($obj)) $obj=new Prescription;
	include_once($root_path.'include/inc_date_format_functions.php');
	
	if($HTTP_POST_VARS['prescribe_date']) $HTTP_POST_VARS['prescribe_date']=@formatDate2STD($HTTP_POST_VARS['prescribe_date'],$date_format);
	else $HTTP_POST_VARS['prescribe_date']=date('Y-m-d');

	$HTTP_POST_VARS['create_id']=$HTTP_SESSION_VARS['sess_user_name'];

	//$db->debug=true;
	# Check the important items
	if($article&&$dosage&&$application_type_nr&&$prescriber){
		//include('./include/save_prescription.inc.php');
		include('./include/save_admission_data.inc.php');
	}
}

require('./include/init_show.php');

if($parent_admit){
	$sql="SELECT pr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_prescription AS pr
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." 
			AND p.pid=e.pid 
			AND e.encounter_nr=".$HTTP_SESSION_VARS['sess_en']." 
			AND e.encounter_nr=pr.encounter_nr 
		ORDER BY pr.modify_time DESC";
}else{
	$sql="SELECT pr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_prescription AS pr
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." AND p.pid=e.pid AND e.encounter_nr=pr.encounter_nr 
		ORDER BY pr.modify_time DESC";
}

		
if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
}else{
echo $sql;
}

$subtitle=$LDPrescriptions;
$notestype='prescription';

$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 


/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
