<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
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
} elseif(($mode=='create'||$mode=='update')
				&&!empty($HTTP_POST_VARS['text_diagnosis'])
				&&!empty($HTTP_POST_VARS['text_therapy'])) {
	# Prepare the posted data for saving in databank
	include_once($root_path.'include/inc_date_format_functions.php');
	# If date is empty,default to today
	if(empty($HTTP_POST_VARS['date'])){
		$HTTP_POST_VARS['date']=date('Y-m-d');
	}else{
		$HTTP_POST_VARS['date']=@formatDate2STD($HTTP_POST_VARS['date'],$date_format);
	}
	# Prepare history
	$HTTP_POST_VARS['history']='Entry: '.date('Y-m-d H:i:s').' '.$HTTP_SESSION_VARS['sess_user_name'];
	$HTTP_POST_VARS['time']=date('H:i:s');
	$HTTP_POST_VARS['type_nr']=12; // 12 = text_diagnosis
	$HTTP_POST_VARS['notes']=$HTTP_POST_VARS['text_diagnosis'];
	# Prevent redirection
	$redirect=false;
	include('./include/save_admission_data.inc.php');
	$HTTP_POST_VARS['ref_notes_nr']=$db->Insert_ID();
	$HTTP_POST_VARS['notes']=$HTTP_POST_VARS['text_therapy'];
	$HTTP_POST_VARS['type_nr']=13; // 13 = text_therapy
	$HTTP_POST_VARS['short_notes']='';
	$HTTP_POST_VARS['aux_notes']='';
	$redirect=true;
	include('./include/save_admission_data.inc.php');
}

require('./include/init_show.php');

$page_title=$LDMedocs;

# Load the entire encounter data
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter($encounter_nr);
$enc_obj->loadEncounterData();
# Get encounter class
$enc_class=$enc_obj->EncounterClass();
/*if($enc_class==2)  $HTTP_SESSION_VARS['sess_full_en']=$GLOBAL_CONFIG['patient_outpatient_nr_adder']+$encounter_nr;
	else $HTTP_SESSION_VARS['sess_full_en']=$GLOBAL_CONFIG['patient_inpatient_nr_adder']+$encounter_nr;
*/
$HTTP_SESSION_VARS['sess_full_en']=$encounter_nr;
	
if(empty($encounter_nr)&&!empty($HTTP_SESSION_VARS['sess_en'])){
	$encounter_nr=$HTTP_SESSION_VARS['sess_en'];
}elseif($encounter_nr) {
	$HTTP_SESSION_VARS['sess_en']=$encounter_nr;
}
	
if($mode=='show') 
{
	$sql="SELECT e.encounter_nr,e.is_discharged,nd.nr, nd.notes AS diagnosis,nd.short_notes, nd.date,nd.personell_nr,nd.personell_name, nt.notes AS therapy
		FROM 	(care_encounter AS e, 
					care_encounter_notes AS nd)
					LEFT JOIN care_encounter_notes AS nt ON nt.ref_notes_nr=nd.nr
		WHERE  e.encounter_nr=".$encounter_nr."
			AND e.encounter_nr=nd.encounter_nr 
			AND nd.type_nr=12
			ORDER BY nd.create_time DESC";

		/* 12 = text_diagnosis type of notes 
		*  13 = text_therapy type of notes
		*/
	if($result=$db->Execute($sql)){
		if($rows=$result->RecordCount()){
			# Resync the encounter_nr
			if($HTTP_SESSION_VARS['sess_en']!=$encounter_nr) $HTTP_SESSION_VARS['sess_en']=$encounter_nr;
			if($rows==1){
				$row=$result->FetchRow();
				if($row['is_discharged']) $edit=0;

				header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&mode=details&nolist=1&pid=$pid&encounter_nr=&encounter_nr&nr=".$row['nr']."&edit=$edit&is_discharged=".$row['is_discharged']);
				exit;
			}
		}
	}else{
		echo $sql;
	}
}elseif(($mode=='details')&&!empty($nr)){
	$sql="SELECT nd.notes AS diagnosis,
						nd.short_notes, 
						nd.aux_notes, 
						nd.date,
						nd.personell_nr,
						nd.personell_name,
						nt.notes AS therapy
		FROM 	care_encounter_notes AS nd LEFT JOIN care_encounter_notes AS nt ON nd.nr=nt.ref_notes_nr
		WHERE   nd.nr=$nr";

	if($result=$db->Execute($sql)){
		if($rows=$result->RecordCount()) $row=$result->FetchRow();
	}else{
		echo $sql;
	}
}

$subtitle=$LDMedocs;
	
$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

# Set break file
require('include/inc_breakfile.php');

if($mode=='show') $glob_obj->getConfig('medocs_%');
/* Load GUI page */
require('./gui_bridge/default/gui_show_medocs.php');
?>
