<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.1 - 2004-10-02 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('MODULE','staff_admin');
define('LANG_FILE_MODULAR','staff_admin.php');
$local_user='aufnahme_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'modules/staff_admin/model/class_staff.php');
//require_once($root_path.'include/core/class_person.php');
//require_once($root_path.'modules/insurance_co/model/class_insurance.php');
//require_once($root_path.'include/core/class_ward.php');
require_once($root_path.'include/core/class_globalconfig.php');

$GLOBAL_CONFIG=array();

$thisfile=basename(__FILE__);
if($_COOKIE['ck_login_logged'.$sid]) $breakfile=$root_path.'main/plugin.php'.URL_APPEND;
	else $breakfile='staff_admin_pass.php'.URL_APPEND.'&target='.$target;

$staff_obj=new staff();
//$person_obj=new Person();
//$insurance_obj=new Insurance;
//$ward_obj=new Ward;
/* Get the staff  global configs */	
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('staff_%');
$glob_obj->getConfig('person_photo_path');

$updatefile='staff_register.php';

/* Default path for photos. Make sure that this directory exists! */
$default_photo_path=$root_path.'uploads/photos/registration';
$photo_filename='nopic';

#Check whether the origin is phone directory and if session staff nr. is ok
if($_SESSION['sess_user_origin']=='phonedir'&&$_SESSION['sess_staff_nr']){
	$staff_nr=$_SESSION['sess_staff_nr'];
}else{
	$_SESSION['sess_staff_nr']=$staff_nr;
}

	//if(!empty($GLOBAL_CONFIG['patient_financial_class_single_result'])) $encounter_obj->setSingleResult(true);	
	$staff_obj->loadstaffData($staff_nr);
	if($staff_obj->is_loaded) {
		$row=&$staff_obj->staff_data;
		
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

	include_once($root_path.'include/helpers/inc_date_format_functions.php');
        
	/* Update History */
	//if(!$newdata) $encounter_obj->setHistorySeen($_SESSION['sess_user_name'],$encounter_nr);
	/* Get insurance firm name*/
	//$insurance_firm_name=$insurance_obj->getFirmName($insurance_firm_id);
	/* Get ward name */
	//$current_ward_name=$ward_obj->WardName($current_ward_nr);
	/* Check whether config path exists, else use default path */			
	$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_photo_path'])) ? $GLOBAL_CONFIG['person_photo_path'] : $default_photo_path;


/* Prepare text and resolve the numbers */
require_once($root_path.'include/helpers/inc_patient_encounter_type.php');		 

if(!isset($_SESSION['sess_parent_mod'])) $_SESSION['sess_parent_mod'] = "";
if(!isset($_SESSION['sess_user_origin'])) $_SESSION['sess_user_origin'] = "";

/* Save encounter nrs to session */
$_SESSION['sess_pid']=$pid;
//$_SESSION['sess_en']=$encounter_nr;
//$_SESSION['sess_full_en']=$full_en;
$_SESSION['sess_parent_mod']='admission';
$_SESSION['sess_pnr']=$staff_nr;
//$full_pnr=$staff_nr+$GLOBAL_CONFIG['staff_nr_adder'];
$full_pnr=$staff_nr;
$_SESSION['sess_full_pnr']=$full_pnr;
$_SESSION['sess_user_origin']='staff_admin';

/* Prepare the photo filename */
require_once($root_path.'include/helpers/inc_photo_filename_resolve.php');

/* Load the GUI page */
require('./gui_bridge/default/gui_'.$thisfile);
?>