<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE2X Integrated Information System beta 2.0.0 - 2004-05-16 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
$lang_tables=array('personell.php');
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_personell.php');
//require_once($root_path.'include/care_api_classes/class_person.php');
//require_once($root_path.'include/care_api_classes/class_insurance.php');
//require_once($root_path.'include/care_api_classes/class_ward.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');

$GLOBAL_CONFIG=array();

$thisfile=basename(__FILE__);
if($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
	else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;

$personell_obj=new Personell();
//$person_obj=new Person();
//$insurance_obj=new Insurance;
//$ward_obj=new Ward;
/* Get the personell  global configs */	
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('personell_%');
$glob_obj->getConfig('person_foto_path');

$updatefile='personell_register.php';

/* Default path for fotos. Make sure that this directory exists! */
$default_photo_path=$root_path.'fotos/registration';
$photo_filename='nopic';

#Check whether the origin is phone directory and if session personnel nr. is ok
if($HTTP_SESSION_VARS['sess_user_origin']=='phonedir'&&$HTTP_SESSION_VARS['sess_personell_nr']){
	$personell_nr=$HTTP_SESSION_VARS['sess_personell_nr'];
}else{
	$HTTP_SESSION_VARS['sess_personell_nr']=$personell_nr;
}

	//if(!empty($GLOBAL_CONFIG['patient_financial_class_single_result'])) $encounter_obj->setSingleResult(true);	
	$personell_obj->loadPersonellData($personell_nr);
	if($personell_obj->is_loaded) {
		$row=&$personell_obj->personell_data;
		
		//load data
		//while(list($x,$v)=each($row)) {$$x=$v;}
		extract($row);
	
		//$insurance_class=&$encounter_obj->getInsuranceClassInfo($insurance_class_nr);
		//$encounter_class=&$encounter_obj->getEncounterClassInfo($encounter_class_nr);

		//if($data_obj=&$person_obj->getAllInfoObject($pid))
/*		$list='title,name_first,name_last,name_2,name_3,name_middle,name_maiden,name_others,date_birth,
		         sex,addr_str,addr_str_nr,addr_zip,addr_citytown_nr,photo_filename';

		$person_obj->setPID($pid);
		if($row=&$person_obj->getValueByList($list))
		{
			while(list($x,$v)=each($row))	$$x=$v;      
		}      

		$addr_citytown_name=$person_obj->CityTownName($addr_citytown_nr);
		$encoder=$encounter_obj->RecordModifierID();
*/	}

	include_once($root_path.'include/inc_date_format_functions.php');
        
	/* Update History */
	//if(!$newdata) $encounter_obj->setHistorySeen($HTTP_SESSION_VARS['sess_user_name'],$encounter_nr);
	/* Get insurance firm name*/
	//$insurance_firm_name=$insurance_obj->getFirmName($insurance_firm_id);
	/* Get ward name */
	//$current_ward_name=$ward_obj->WardName($current_ward_nr);
	/* Check whether config path exists, else use default path */			
	$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;


/* Prepare text and resolve the numbers */
require_once($root_path.'include/inc_patient_encounter_type.php');		 

if(!session_is_registered('sess_parent_mod')) session_register('sess_parent_mod');
if(!session_is_registered('sess_user_origin')) session_register('sess_user_origin');

/* Save encounter nrs to session */
$HTTP_SESSION_VARS['sess_pid']=$pid;
//$HTTP_SESSION_VARS['sess_en']=$encounter_nr;
//$HTTP_SESSION_VARS['sess_full_en']=$full_en;
$HTTP_SESSION_VARS['sess_parent_mod']='admission';
$HTTP_SESSION_VARS['sess_pnr']=$personell_nr;
//$full_pnr=$personell_nr+$GLOBAL_CONFIG['personell_nr_adder'];
$full_pnr=$personell_nr;
$HTTP_SESSION_VARS['sess_full_pnr']=$full_pnr;
$HTTP_SESSION_VARS['sess_user_origin']='personell_admin';

/* Prepare the photo filename */
require_once($root_path.'include/inc_photo_filename_resolve.php');

/* Load the GUI page */
require('./gui_bridge/default/gui_'.$thisfile);
?>
