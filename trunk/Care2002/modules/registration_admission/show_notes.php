<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$thisfile=basename(__FILE__);

if(!isset($type_nr)||!$type_nr) $type_nr=1; //* 1 = history physical notes

require_once($root_path.'include/care_api_classes/class_notes.php');
$obj=new Notes;
$types=$obj->getAllTypesSort('name');
$this_type=$obj->getType($type_nr);

if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {
	include_once($root_path.'include/inc_date_format_functions.php');
	$HTTP_POST_VARS['date']=@formatDate2STD($HTTP_POST_VARS['date'],$date_format);
	$HTTP_POST_VARS['time']=date('H:i:s');
	include('./include/save_admission_data.inc.php');
}

$lang_tables=array('emr.php');
require('./include/init_show.php');

$page_title.=" :: $LDNotes $LDAndSym $LDReports";

if($parent_admit){
	$sql="SELECT n.nr,n.notes,n.short_notes, n.encounter_nr,n.date,n.personell_nr,n.personell_name,e.encounter_class_nr
		FROM care_encounter AS e, 
					care_person AS p, 
					care_encounter_notes AS n 
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." 
			AND p.pid=e.pid 
			AND e.encounter_nr=".$HTTP_SESSION_VARS['sess_en']." 
			AND e.encounter_nr=n.encounter_nr 
			AND n.type_nr=".$type_nr."
		ORDER BY n.date DESC";
}else{
	$sql="SELECT n.nr,n.notes,n.short_notes, n.encounter_nr,n.date,n.personell_nr,n.personell_name,e.encounter_class_nr
		FROM 	care_encounter AS e, 
					care_person AS p, 
					care_encounter_notes AS n
		WHERE	p.pid=".$HTTP_SESSION_VARS['sess_pid']." 
			AND	p.pid=e.pid 
			AND e.encounter_nr=n.encounter_nr 
			AND n.type_nr=".$type_nr."
		ORDER BY n.date DESC";
}

		
if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
}else{
	echo $sql;
}

if(isset($$this_type['LD_var'])&&!empty($$this_type['LD_var'])) {
	$subtitle=$$this_type['LD_var'];
}else{
	$subtitle=$this_type['name'];
}

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Hide tabs */
$notabs=true;
/* Load GUI page */
require('./gui_bridge/default/gui_show_notes.php');
?>
