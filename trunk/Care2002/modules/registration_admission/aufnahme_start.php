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
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');

/* If patient nr is invallid jump to registration search module*/
/*if(!isset($pid) || !$pid)
{
	header('Location:patient_register_search.php'.URL_APPEND.'&origin=admit');
	exit;
}
*/
require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_person.php');
require_once($root_path.'include/care_api_classes/class_insurance.php');
//require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');

$thisfile=basename(__FILE__);
if($origin=='patreg_reg') $returnfile='patient_register_show.php'.URL_APPEND.'&pid='.$pid;
   
$breakfile=$root_path.$HTTP_SESSION_VARS['sess_path_referer'].URL_APPEND.'&pid='.$pid;

$newdata=1;

/* Default path for fotos. Make sure that this directory exists! */
$default_photo_path=$root_path.'fotos/registration';
$photo_filename='nopic';
$error=0;

if(!isset($pid)) $pid=0;
if(!isset($encounter_nr)) $encounter_nr=0;
if(!isset($mode)) $mode='';
if(!isset($forcesave)) $forcesave=0;
if(!isset($update)) $update=0;

if(!session_is_registered('sess_pid')) session_register('sess_pid');
if(!session_is_registered('sess_full_pid')) session_register('sess_full_pid');
if(!session_is_registered('sess_en')) session_register('sess_en');
if(!session_is_registered('sess_full_en')) session_register('sess_full_en');

$patregtable='care_person';  // The table of the patient registration data

$dbtable='care_encounter'; // The table of admission data

/* Create new person's insurance object */
$pinsure_obj=new PersonInsurance($pid);	 
/* Get the insurance classes */
$insurance_classes=&$pinsure_obj->getInsuranceClassInfoObject('class_nr,name,LD_var');

/* Create new person object */
$person_obj=new Person($pid);
/* Create encounter object */
$encounter_obj=new Encounter($encounter_nr);
/* Get all encounter classes */
$encounter_classes=$encounter_obj->AllEncounterClassesObject();

if($pid!='' || $encounter_nr!='')
{
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {

	   	/* Get the patient global configs */
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');
        $glob_obj->getConfig('person_foto_path'); 
		
		if(!$GLOBAL_CONFIG['patient_service_care_hide']){
			/* Get the care service classes*/
			$care_service=$encounter_obj->AllCareServiceClassesObject();
		}
		if(!$GLOBAL_CONFIG['patient_service_room_hide']){
			/* Get the room service classes */
			$room_service=$encounter_obj->AllRoomServiceClassesObject();
		}
		if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
			/* Get the attending doctor service classes */
			$att_dr_service=$encounter_obj->AllAttDrServiceClassesObject();
		}		
		
        /* Check whether config path exists, else use default path */			
        $photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

        if ($pid)
        {	
		  /* Check whether the person is currently admitted. If yes jump to display admission data */
		  if(!$update&&$encounter_nr=$encounter_obj->isCurrentlyAdmitted($pid)){
		      header('Location:aufnahme_daten_zeigen.php'.URL_REDIRECT_APPEND.'&encounter_nr='.$encounter_nr.'&origin=admit&sem=isadmitted&target=entry');
			  exit;
		  }
 			 	       
			 /* Get the related insurance data */
			 $p_insurance=&$pinsure_obj->getPersonInsuranceObject($pid);
			 if($p_insurance==false) {
				$insurance_show=true;
			 } else {
				if(!$p_insurance->RecordCount()) {
				    $insurance_show=true;
				} elseif ($p_insurance->RecordCount()==1){
				    $buffer= $p_insurance->FetchRow();
					while(list($x,$v)=each($buffer)) {$$x=$v; }
				    $insurance_show=true;
				    $insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id); 
				} else { $insurance_show=false;}
			 } 

			
            if (($mode=='save') || ($forcesave!=''))
            {
	             if(!$forcesave)
	             {
	                  //clean and check input data variables
					  /**
					  *  $error = 1 will cause to show the "save anyway" override button to save the incomplete data
					  *  $error = 2 will cause to force the user to enter a data in an input element (no override allowed)
					  */
	                  $encoder=trim($encoder); 
					  if($encoder=='') $encoder=$HTTP_SESSION_VARS['sess_user_name'];
					  
	                  $referrer_diagnosis=trim($referrer_diagnosis);
					  if ($referrer_diagnosis=='') { $errordiagnose=1; $error=1; $errornum++;};
					  
	                  $referrer_dr=trim($referrer_dr);
					  if ($referrer_dr=='') { $errorreferrer=1; $error=1; $errornum++;};
					  
	                  $referrer_recom_therapy=trim($referrer_recom_therapy);
					  if ($referrer_recom_therapy=='') { $errortherapie=1; $error=1; $errornum++;};
					  
	                  $referrer_notes=trim($referrer_notes);
					  if ($referrer_notes=='') { $errorbesonder=1; $error=1; $errornum++;};
					  
	                  $encounter_class_nr=trim($encounter_class_nr);
					  if ($encounter_class_nr=='') { $errorstatus=1; $error=1; $errornum++;};
	
			          if($insurance_show) {
                          if(trim($insurance_nr) && (trim($insurance_firm_name)=='')) { $errorinsnr=1; $error=1; $errornum++;}
		              }
	              }
 

                 if(!$error) 
	             {	
						if(!$GLOBAL_CONFIG['patient_service_care_hide']){
						    if(!empty($sc_care_start)) $sc_care_start=formatDate2Std($sc_care_start,$date_format);
						    if(!empty($sc_care_end)) $sc_care_end=formatDate2Std($sc_care_end,$date_format);
						    $care_class=compact('sc_care_nr','sc_care_class_nr', 'sc_care_start', 'sc_care_end','encoder');
						}
						if(!$GLOBAL_CONFIG['patient_service_room_hide']){
						    if(!empty($sc_room_start)) $sc_room_start=formatDate2Std($sc_room_start,$date_format);
						    if(!empty($sc_room_end)) $sc_room_end=formatDate2Std($sc_room_end,$date_format);
						    $room_class=compact('sc_room_nr','sc_room_class_nr', 'sc_room_start', 'sc_room_end','encoder');
						}
						if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
						    if(!empty($sc_att_dr_start)) $sc_att_dr_start=formatDate2Std($sc_att_dr_start,$date_format);
						    if(!empty($sc_att_dr_end)) $sc_att_dr_end=formatDate2Std($sc_att_dr_end,$date_format);
						    $att_dr_class=compact('sc_att_dr_nr','sc_att_dr_class_nr','sc_att_dr_start', 'sc_att_dr_end','encoder');
						}

				      if($update || $encounter_nr)
					  {
							//echo formatDate2STD($geburtsdatum,$date_format);
					      $itemno=$itemname;		
									$HTTP_POST_VARS['modify_id']=$encoder;
									$HTTP_POST_VARS['history']= "CONCAT(history,\"\n Update: ".date('Y-m-d H:i:s')." = $encoder\")";
									if(isset($HTTP_POST_VARS['encounter_nr'])) unset($HTTP_POST_VARS['encounter_nr']);		
									if(isset($HTTP_POST_VARS['pid'])) unset($HTTP_POST_VARS['pid']);		
												
									$encounter_obj->setDataArray($HTTP_POST_VARS);
									
									if($encounter_obj->updateEncounterFromInternalArray($encounter_nr))
									{
									    /* Save the service classes */									   
									    if(!$GLOBAL_CONFIG['patient_service_care_hide']){
										    $encounter_obj->updateCareServiceClass($care_class);
										}
									    if(!$GLOBAL_CONFIG['patient_service_room_hide']){
										    $encounter_obj->updateRoomServiceClass($room_class);
										}
									    if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
										    $encounter_obj->updateAttDrServiceClass($att_dr_class);
										}
							            header("Location: aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&encounter_nr=$encounter_nr&origin=admit&target=entry&newdata=$newdata"); 
								        exit;
								    }

					  }	
					  else
					  {
					  	    $newdata=1;
									$HTTP_POST_VARS['encounter_date']=date('Y-m-d H:i:s');
									$HTTP_POST_VARS['modify_id']=$encoder;
									$HTTP_POST_VARS['modify_time']='NULL';
									$HTTP_POST_VARS['create_id']=$encoder;
									$HTTP_POST_VARS['create_time']=date('Y-m-d H:i:s');
									$HTTP_POST_VARS['history']='Create: '.date('Y-m-d H:i:s').' = '.$encoder;
									if(isset($HTTP_POST_VARS['encounter_nr'])) unset($HTTP_POST_VARS['encounter_nr']);					
									
									$encounter_obj->setDataArray($HTTP_POST_VARS);
									
									if($encounter_obj->insertDataFromInternalArray())
									{
									    /* Get last insert id */
										$encounter_nr=$db->Insert_ID();	
									    /* Save the service classes */									   
								/*	    if(!$GLOBAL_CONFIG['patient_service_care_hide']){
										    $encounter_obj->saveCareServiceClass($care_class);
										}
									    if(!$GLOBAL_CONFIG['patient_service_room_hide']){
										    $encounter_obj->saveRoomServiceClass($room_class);
										}
									    if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
										    $encounter_obj->saveAttDrServiceClass($att_dr_class);
										}*/
							            header("Location: aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&encounter_nr=$encounter_nr&origin=admit&target=entry&newdata=$newdata"); 
								        exit;
								    }
									
					 }// end of if(update) else()                 
                  }	// end of if($error)
             } // end of if($mode)

        } elseif($encounter_nr!='') {
			  /* Load encounter data */
			  $encounter_obj->loadEncounterData();
			  if($encounter_obj->is_loaded) {
		          $zeile=&$encounter_obj->encounter;
					//load data
                  while(list($x,$v)=each($zeile)) $$x=$v;
				  
				  
                  /* Get insurance firm name*/
			      $insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id);
				  
			  }
			  
			  /* GEt the patient's services classes */
			  
			  if(!empty($GLOBAL_CONFIG['patient_financial_class_single_result'])) $encounter_obj->setSingleResult(true);

				if(!$GLOBAL_CONFIG['patient_service_care_hide']){
                	if($buff=&$encounter_obj->CareServiceClass()){
					    while($care_class=$buff->FetchRow()){
							while(list($x,$v)=each($care_class))	$$x=$v;
						}   
						reset($care_class);
					}    			  
				}
				if(!$GLOBAL_CONFIG['patient_service_room_hide']){
                	if($buff=&$encounter_obj->RoomServiceClass()){
					    while($room_class=$buff->FetchRow()){
							while(list($x,$v)=each($room_class))	$$x=$v;
						}   
						reset($room_class);
					}    			  
				}
				if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
                	if($buff=&$encounter_obj->AttDrServiceClass()){
					    while($att_dr_class=$buff->FetchRow()){
							while(list($x,$v)=each($att_dr_class))	$$x=$v;
						}   
						reset($att_dr_class);
					}    			  
				}
        } 	
	}
    else 
    { 
         echo "$LDDbNoLink<br>"; 
    }
              
	$person_obj->setPID($pid);
	if($data=&$person_obj->BasicDataArray($pid)){
		while(list($x,$v)=each($data))	$$x=$v;      
	}     
	/* Get the citytown name */
	$addr_citytown_name=$person_obj->CityTownName($addr_citytown_nr);
	 
}
    
/* Load the wards info */
$ward_obj=new Ward;
$items='nr,name';
$ward_info=&$ward_obj->getAllWardsItemsObject($items);

/* Prepare text and resolve the numbers */
require_once($root_path.'include/inc_patient_encounter_type.php');		 

/* Prepare the photo filename */
require_once($root_path.'include/inc_photo_filename_resolve.php');

require('./gui_bridge/default/gui_aufnahme_start.php');
?>

