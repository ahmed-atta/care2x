<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2002 Integrated Information System beta 1.0.06 - 2003-08-06 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
GNU GPL. 
For details read file "copy_notice.txt".
*/
$lang_tables[]='prompt.php';
$lang_tables[]='departments.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_person.php');
require_once($root_path.'include/care_api_classes/class_insurance.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');

if(!session_is_registered('sess_parent_mod')) session_register('sess_parent_mod');
# Create objects
$encounter_obj=new Encounter($encounter_nr);
$person_obj=new Person();
$insurance_obj=new Insurance;

$thisfile=basename(__FILE__);
$breakfile='aufnahme_pass.php'.URL_APPEND;

$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

/* Get the patient global configs */	
$glob_obj->getConfig('patient_%');
$glob_obj->getConfig('person_foto_path');

$updatefile='aufnahme_start.php';

/* Default path for fotos. Make sure that this directory exists! */
$default_photo_path=$root_path.'fotos/registration';
$photo_filename='nopic';

$dbtable='care_encounter';

/* Establish db connection */
if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok) {

/*		$sql='SELECT * FROM '.$dbtable.' AS enc LEFT JOIN care_person AS reg ON reg.pid = enc.pid
		         WHERE enc.encounter_nr="'.$encounter_nr.'"';
				 
       	if($ergebnis=$db->Execute($sql)) {
		    if($ergebnis->RecordCount()) {
                 $encounter=$ergebnis->FetchRow();
		 	     while(list($x,$v)=each($encounter)) $$x=$v;
		    }
		}*/
	if(!empty($GLOBAL_CONFIG['patient_financial_class_single_result'])) $encounter_obj->setSingleResult(true);
	
	if(!$GLOBAL_CONFIG['patient_service_care_hide']){
	/* Get the care service classes*/
		$care_service=$encounter_obj->AllCareServiceClassesObject();
		
		if($buff=&$encounter_obj->CareServiceClass()){
		    $care_class=$buff->FetchRow();
			//while(list($x,$v)=each($care_class))	$$x=$v;
			extract($care_class);      
			reset($care_class);
		}    			  
	}
	if(!$GLOBAL_CONFIG['patient_service_room_hide']){
	/* Get the room service classes */
		$room_service=$encounter_obj->AllRoomServiceClassesObject();
		
		if($buff=&$encounter_obj->RoomServiceClass()){
			$room_class=$buff->FetchRow();
			//while(list($x,$v)=each($room_class))	$$x=$v;
			extract($room_class);      
			reset($room_class);
		}    			  
	}
	if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
		/* Get the attending doctor service classes */
		$att_dr_service=$encounter_obj->AllAttDrServiceClassesObject();
		
		if($buff=&$encounter_obj->AttDrServiceClass()){
			$att_dr_class=$buff->FetchRow();
			//while(list($x,$v)=each($att_dr_class))	$$x=$v;
			extract($att_dr_class);      
			reset($att_dr_class);
		}    			  
	}		
		
	$encounter_obj->loadEncounterData();
	if($encounter_obj->is_loaded) {
		$row=&$encounter_obj->encounter;
		//load data
		//while(list($x,$v)=each($row)) $$x=$v;
		extract($row);
		# Set edit mode
		if(!$is_discharged) $edit=true;
			else $edit=false;
		# Fetch insurance and encounter classes
		$insurance_class=&$encounter_obj->getInsuranceClassInfo($insurance_class_nr);
		$encounter_class=&$encounter_obj->getEncounterClassInfo($encounter_class_nr);

		//if($data_obj=&$person_obj->getAllInfoObject($pid))
		$list='title,name_first,name_last,name_2,name_3,name_middle,name_maiden,name_others,date_birth,
		         sex,addr_str,addr_str_nr,addr_zip,addr_citytown_nr,photo_filename';
			
		$person_obj->setPID($pid);
		if($row=&$person_obj->getValueByList($list))
		{
			//while(list($x,$v)=each($row))	$$x=$v;
			extract($row);      
		}      

		$addr_citytown_name=$person_obj->CityTownName($addr_citytown_nr);
		$encoder=$encounter_obj->RecordModifierID();
		# Get current encounter to check if current encounter is this encounter nr
		$current_encounter=$person_obj->CurrentEncounter($pid);
		
		if($stat=&$encounter_obj->AllStatus($encounter_nr)){
			$enc_status=$stat->FetchRow();
		}

		# Get ward or department infos
		if($encounter_class_nr==1){
			# Get ward name
			include_once($root_path.'include/care_api_classes/class_ward.php');
			$ward_obj=new Ward;
			$current_ward_name=$ward_obj->WardName($current_ward_nr);
		}elseif($encounter_class_nr==2){
			# Get ward name
			include_once($root_path.'include/care_api_classes/class_department.php');
			$dept_obj=new Department;
			//$current_dept_name=$dept_obj->FormalName($current_dept_nr);
			$current_dept_LDvar=$dept_obj->LDvar($current_dept_nr);
		}

	}

	include_once($root_path.'include/inc_date_format_functions.php');
        
	/* Update History */
	if(!$newdata) $encounter_obj->setHistorySeen($HTTP_SESSION_VARS['sess_user_name'],$encounter_nr);
	/* Get insurance firm name*/
	$insurance_firm_name=$insurance_obj->getFirmName($insurance_firm_id);
	/* Check whether config path exists, else use default path */			
	$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
} else { 
	echo "$LDDbNoLink<br>"; 
} 

/* Prepare text and resolve the numbers */
require_once($root_path.'include/inc_patient_encounter_type.php');		 

/* Save encounter nrs to session */
$HTTP_SESSION_VARS['sess_pid']=$pid;
$HTTP_SESSION_VARS['sess_en']=$encounter_nr;
$HTTP_SESSION_VARS['sess_full_en']=$full_en;
$HTTP_SESSION_VARS['sess_parent_mod']='admission';
$HTTP_SESSION_VARS['sess_user_origin']='admission';
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

/* Prepare the photo filename */
require_once($root_path.'include/inc_photo_filename_resolve.php');

/* Load the GUI page */
require('./gui_bridge/default/gui_patient_encounter_showdata.php');
?>
