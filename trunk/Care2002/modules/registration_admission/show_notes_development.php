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
	include_once($root_path.'include/care_api_classes/class_notes.php');
	if(!isset($obj)) $obj=new Notes;
	include_once($root_path.'include/inc_date_format_functions.php');
	$HTTP_POST_VARS['date']=@formatDate2STD($HTTP_POST_VARS['date'],$date_format);
	$HTTP_POST_VARS['time']=date('H:i:s');
	include('./include/save_admission_data.inc.php');
}

require('./include/init_show.php');

if($parent_admit){
$sql="SELECT n.notes, n.encounter_nr,n.date,n.personell_nr
		FROM care_encounter AS e, 
					care_person AS p, 
					care_encounter_notes AS n 
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." 
			AND p.pid=e.pid 
			AND e.encounter_nr=".$HTTP_SESSION_VARS['sess_en']." 
			AND e.encounter_nr=n.encounter_nr 
			AND n.type_nr=21
		ORDER BY n.create_time DESC";
}else{
$sql="SELECT n.notes, n.encounter_nr,n.date,n.personell_nr
		FROM 	care_encounter AS e, 
					care_person AS p, 
					care_encounter_notes AS n
		WHERE	p.pid=".$HTTP_SESSION_VARS['sess_pid']." 
			AND	p.pid=e.pid 
			AND e.encounter_nr=n.encounter_nr 
			AND n.type_nr=21
		ORDER BY n.create_time DESC";
}

		
if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
}else{
echo $sql;
}

$subtitle=$LDPatientDev.' '.$LDNotes;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
