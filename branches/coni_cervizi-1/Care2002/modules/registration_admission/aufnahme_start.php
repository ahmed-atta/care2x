<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require ('Mappa.php');

/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$num_referto=$HTTP_GET_VARS['referto'];

if ($HTTP_GET_VARS['appt_nr'] && !$HTTP_GET_VARS['referto'])
{
$domanda="SELECT * from care_encounter WHERE pid=".$HTTP_GET_VARS['pid'];
	$risposta=$db->Execute($domanda);
	$risposta=$risposta->FetchRow();
	$assicurazione=$risposta['insurance_firm_id'];
	$encounter_nr=$risposta['encounter_nr'];
	$appt_nr=$HTTP_GET_VARS['appt_nr'];
	$richiesta="SELECT purpose FROM care_appointment WHERE nr=".$appt_nr;
	$risposte=$db->Execute($richiesta);
	$risposta=$risposte->FetchRow();
	
	$codice=split('#',$risposta['purpose']);
	if ($codice[1]!='COXXX')
	{
	$query="UPDATE care_appointment  SET  appt_status='In attesa di referto',
							history=CONCAT(history,'Done ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."'),
							modify_id='".$HTTP_SESSION_VARS['sess_user_name']."',
							encounter_nr=".$encounter_nr.",
							modify_time='".date('YmdHis')."'
							WHERE nr=".$HTTP_GET_VARS['appt_nr'];
		
							$result=$db->Execute($query);	
	}
	else
	{
	$query="UPDATE care_appointment  SET  appt_status='Richiesta inoltrata al Laboratorio',
							history=CONCAT(history,'Done ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."'),
							modify_id='".$HTTP_SESSION_VARS['sess_user_name']."',
							encounter_nr=".$encounter_nr.",
							modify_time='".date('YmdHis')."'
							WHERE nr=".$HTTP_GET_VARS['appt_nr'];
		
							$result=$db->Execute($query);	
	}
//Header ("Location:../appointment_scheduler/appt_main_pass.php?lang=it");
//echo "dpt vale". $_GET['dept_nr'];
/*
$ricdescrizione="SELECT * FROM care_appointment WHERE nr=".$appt_nr;
$descrizione=$db->Execute($ricdescrizione);
$descrizione=$descrizione->FetchRow();
$codice=split("#",$descrizione['purpose']);
*/
if($codice[1]!='COXXX')
{
$ricprezzo="SELECT * FROM prezzi_".$assicurazione." WHERE item_code='".$codice[1]."'";
$prezzo=$db->Execute($ricprezzo);
$prezzo=$prezzo->FetchRow();
$fatturazione="INSERT INTO care_billing_bill_item ( bill_item_encounter_nr, bill_item_code, bill_item_unit_cost, bill_item_units, bill_item_amount, bill_item_date, bill_item_status, bill_item_bill_no) VALUES (".$encounter_nr.",'".$prezzo['item_code']."',".$prezzo['item_unit_cost'].",1,".$prezzo['item_unit_cost'].",'".date('Y-m-d H:i:s')."','0',0)";
//echo $fatturazione;
//echo "   ".$prezzo['item_code'];

$risposta=$db->Execute($fatturazione);
//exit;
}
Header ("Location:../appointment_scheduler/appt_show.php?lang=it&dept_nr=".$_GET['dept_nr']);

}	
else if ($HTTP_GET_VARS['appt_nr'] && $HTTP_GET_VARS['referto'])
{
	$verifica="select * from care_encounter_notes where ref_notes_nr=".(2*$HTTP_GET_VARS['appt_nr']);

	$ver_dati=$db->Execute($verifica);
	$carica= $ver_dati->RecordCount();


$domanda="SELECT * from care_encounter WHERE pid=".$HTTP_GET_VARS['pid'];

	//debugger_on;
	$risposta=$db->Execute($domanda);
	$risposta=$risposta->FetchRow();
#La commentiamo questa query poich? in realt? la svolgiamo su salva_su_db.php, quando cio? stampano il referto!!!
/*
$query="UPDATE care_appointment  SET  appt_status='Fatto',
							history=CONCAT(history,'Fatto ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."'),
							modify_id='".$HTTP_SESSION_VARS['sess_user_name']."',
							modify_time='".date('YmdHis')."'
							WHERE nr=".$HTTP_GET_VARS['appt_nr'];
*/
 //$result=$db->Execute($query);	
 

 if($mappa[$referto][1]=='true')

 Header ("Location:radiografico.php?lang=it&pid=".$HTTP_GET_VARS['pid']."&encounter_nr=".$risposta['encounter_nr']."&appt_nr=".$HTTP_GET_VARS['appt_nr']."&carica=".$carica."&codice=".$num_referto."&sess_user_name=".$HTTP_SESSION_VARS['sess_user_name']);
else
Header ("Location:".$mappa[$referto][2]."?lang=it&pid=".$HTTP_GET_VARS['pid']."&encounter_nr=".$risposta['encounter_nr']."&carica=".$carica."&appt_nr=".$HTTP_GET_VARS['appt_nr']."&carica=".$carica."&codice=".$num_referto."&sess_user_name=".$HTTP_SESSION_VARS['sess_user_name']);
//Header ("Location:../medocs/show_medocs.php?lang=it&pid=".$HTTP_GET_VARS['pid']."&encounter_nr=".$risposta['encounter_nr']."&target=entry&mode=new&type_nr=1");

}
else
{					
$lang_tables[]='departments.php';
$lang_tables[]='prompt.php';
$lang_tables[]='person.php';
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
//require_once($root_path.'include/inc_config_color.php');
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
        $glob_obj->getConfig('encounter_%'); 
		
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
		  if(!$update&&$encounter_nr=$encounter_obj->isPIDCurrentlyAdmitted($pid)){
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
					//while(list($x,$v)=each($buffer)) {$$x=$v; }
					extract($buffer);
				    $insurance_show=true;
				    $insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id); 
				} else { $insurance_show=false;}
			 } 

			
            if (($mode=='save') || ($forcesave!=''))
            {
				// Questo controllo ? necessario per verificare che la persona non sia gi? stata registrata
				if(!$update)
				{
					 $sql="select * from care_encounter where insurance_nr='".$insurance_nr."'";
					 $esiste=$db->Execute($sql);
					// echo $sql;
					 if($esiste->RecordCount()) 
					 {
					 ?>
				<html>

				<head>
				<title> Errore!!! </title>

				</head>
				<table border="0" width="101%" bgcolor=#99ccff>
					<tr>
						<td width="101%"><font color="#330066" size="+2" face="Arial"><strong>Il codice fiscale inserito esiste gi&agrave nel database!!!</strong></font></td>
					</tr>
					</table>
					<?
					$query_errore="SELECT * FROM care_person WHERE pid='".$_POST['pid']."'";
					$esecuzione_query_errore=$db->Execute($query_errore);
					$risposta_query_errore=$esecuzione_query_errore->FetchRow();
					?>
					<center>
					<?
					 echo "<b>Attenzione, la persona registrata esiste gia'!</b><br />";
					 echo "<b>Verifica i dati per questa persona appena inserita</b><br />";
					 echo "<b>PID :</b>".$_POST['pid']."<br />";
					 echo "<b>Nome :</b>".$risposta_query_errore['name_first']."<br />";
					 echo "<b>Cognome :</b>".$risposta_query_errore['name_last']."<br />";
					 reset($esiste);
					 $stesso_codice_fiscale=$esiste->FetchRow();
					 $query_dati_stesso_codice_fiscale="SELECT * FROM care_person WHERE pid='".$stesso_codice_fiscale['pid']."'";
					 $esecuzione_query_dati_stesso_codice_fiscale=$db->Execute($query_dati_stesso_codice_fiscale);
					 $risposta_query_dati_stesso_codice_fiscale=$esecuzione_query_dati_stesso_codice_fiscale->FetchRow();
					 echo "<br /><br /><i>Il suo codice fiscale coincide con quello del paziente</i><br />";
					 echo "<b>PID :</b>".$risposta_query_dati_stesso_codice_fiscale['pid']."<br />";
					 echo "<b>Nome :</b>".$risposta_query_dati_stesso_codice_fiscale['name_first']."<br />";
					 echo "<b>Cognome :</b>".$risposta_query_dati_stesso_codice_fiscale['name_last']."<br />";
					?>
					</center>
					<?
					exit;
					 }
				}
				
			
			
	             if(!$forcesave)
	             {
	                  //clean and check input data variables
					  /**
					  *  $error = 1 will cause to show the "save anyway" override button to save the incomplete data
					  *  $error = 2 will cause to force the user to enter a data in an input element (no override allowed)
					  */
	                  $encoder=trim($encoder); 
					  if($encoder=='') $encoder=$HTTP_SESSION_VARS['sess_user_name'];
		
					  //Abbiamo modificato i $error settandoli a 0. In questo modo il programma forza l'immissione del paziente			  
	                  $referrer_diagnosis=trim($referrer_diagnosis);
					  if ($referrer_diagnosis=='') { $errordiagnose=1; $error=0; $errornum++;};
					  
	                  $referrer_dr=trim($referrer_dr);
					  if ($referrer_dr=='') { $errorreferrer=1; $error=0; $errornum++;};
					  
	                  $referrer_recom_therapy=trim($referrer_recom_therapy);
					  if ($referrer_recom_therapy=='') { $errortherapie=1; $error=0; $errornum++;};
					  
	                  $referrer_notes=trim($referrer_notes);
					  if ($referrer_notes=='') { $errorbesonder=1; $error=0; $errornum++;};
					  
	                  $encounter_class_nr=trim($encounter_class_nr);
		
					  if ($encounter_class_nr=='') { $errorstatus=1; $error=0; $errornum++;};
					  if(!trim($insurance_nr)|| !trim($insurance_firm_name)) { $errorinsnr=1; $error=2; $errornum=1;}
					  //Modifiche fino a qui
					  // ERA IL CONTROLLO SU POLIZZA E ASSICURAZIONE; MA PARE CHE IL NUMERO DI POLIZZA NON SIA COSI' IMPORTANTE.....
					  /*  if($insurance_show) {
                          if(trim($insurance_nr) && (trim($insurance_firm_name)=='') OR (!trim($insurance_nr) && (trim($insurance_firm_name)))) { $errorinsnr=1; $error=2; $errornum=1;}
					  
		              }*/

	              }
		
 		
		     //  $_POST['insurance_nr']
			if(!trim($_POST['insurance_nr'])|| !trim($insurance_firm_name)) 
			  { 
			    //	    echo "son qui";
	    $errorinsnr=1; $error=2; $errornum=1;}	
	    
			//	echo "er vale".$error;
                 if(!$error) 
	             {	
					$HTTP_POST_VARS['insurance_nr']=strtoupper($HTTP_POST_VARS['insurance_nr']);
					//echo $HTTP_POST_VARS['insurance_nr'];
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

					  }else{
					  
					  	    $newdata=1;
							/* Determine the format of the encounter number */
							if($GLOBAL_CONFIG['encounter_nr_fullyear_prepend']) $ref_nr=(int)date('Y').$GLOBAL_CONFIG['encounter_nr_init'];
								else $ref_nr=$GLOBAL_CONFIG['encounter_nr_init'];
							$HTTP_POST_VARS['encounter_class_nr']=1;
							switch($HTTP_POST_VARS['encounter_class_nr'])
							{
								case '1': $HTTP_POST_VARS['encounter_nr']=$encounter_obj->getNewEncounterNr($ref_nr+$GLOBAL_CONFIG['patient_inpatient_nr_adder'],1);
											break;
								case '2': $HTTP_POST_VARS['encounter_nr']=$encounter_obj->getNewEncounterNr($ref_nr+$GLOBAL_CONFIG['patient_outpatient_nr_adder'],2);
							}
							
									$HTTP_POST_VARS['encounter_date']=date('Y-m-d H:i:s');
									$HTTP_POST_VARS['modify_id']=$encoder;
									$HTTP_POST_VARS['modify_time']='NULL';
									$HTTP_POST_VARS['create_id']=$encoder;
									$HTTP_POST_VARS['create_time']=date('Y-m-d H:i:s');
									$HTTP_POST_VARS['history']='Create: '.date('Y-m-d H:i:s').' = '.$encoder;
									//if(isset($HTTP_POST_VARS['encounter_nr'])) unset($HTTP_POST_VARS['encounter_nr']);					
									$HTTP_POST_VARS['in_ward']=1;
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
										
										//echo $encounter_obj->getLastQuery();
										
										# If appointment number available, mark appointment as "done"
										if(isset($appt_nr)&&$appt_nr) $encounter_obj->markAppointmentDone($appt_nr,$HTTP_POST_VARS['encounter_class_nr'],$encounter_nr);
										//echo $encounter_obj->getLastQuery();
							            header("Location: aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&encounter_nr=$encounter_nr&origin=admit&target=entry&newdata=$newdata"); 
								        exit;
								    }else{
										echo $LDDbNoSave.'<p>'.$encounter_obj->getLastQuery();
									}
									
					 }// end of if(update) else()                 
                  }	// end of if($error)
             } // end of if($mode)

        }elseif($encounter_nr!='') {
			  /* Load encounter data */
			  $encounter_obj->loadEncounterData();
			  if($encounter_obj->is_loaded) {
		          $zeile=&$encounter_obj->encounter;
					//load data
                  //while(list($x,$v)=each($zeile)) $$x=$v;
				  extract($zeile);
				  
                  /* Get insurance firm name*/
			      $insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id);
				  
			  
			  /* GEt the patient's services classes */
			  
			  if(!empty($GLOBAL_CONFIG['patient_financial_class_single_result'])) $encounter_obj->setSingleResult(true);

				if(!$GLOBAL_CONFIG['patient_service_care_hide']){
                	if($buff=&$encounter_obj->CareServiceClass()){
					    while($care_class=$buff->FetchRow()){
							//while(list($x,$v)=each($care_class))	$$x=$v;
							extract($care_class);
						}   
						reset($care_class);
					}    			  
				}
				if(!$GLOBAL_CONFIG['patient_service_room_hide']){
                	if($buff=&$encounter_obj->RoomServiceClass()){
					    while($room_class=$buff->FetchRow()){
							//while(list($x,$v)=each($room_class))	$$x=$v;
							extract($room_class);
						}   
						reset($room_class);
					}    			  
				}
				if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
                	if($buff=&$encounter_obj->AttDrServiceClass()){
					    while($att_dr_class=$buff->FetchRow()){
							//while(list($x,$v)=each($att_dr_class))	$$x=$v;
							extract($att_dr_class);
						}   
						reset($att_dr_class);
					}    			  
				}
        	} 	

		}

	}
    else 
    { 
         echo "$LDDbNoLink<br>"; 
    }
    if(!$encounter_nr||$encounter_class_nr==1){
		# Load all  wards info 
		$ward_obj=new Ward;
		$items='nr,name';
		$ward_info=&$ward_obj->getAllWardsItemsObject($items);
	}
	if(!$encounter_nr||$encounter_class_nr==2){
		# Load all medical departments
		include_once($root_path.'include/care_api_classes/class_department.php');
		$dept_obj=new Department;
		$all_meds=&$dept_obj->getAllMedicalObject();
	}
       
	$person_obj->setPID($pid);
	if($data=&$person_obj->BasicDataArray($pid)){
		//while(list($x,$v)=each($data))	$$x=$v;    
		extract($data);  
	}     
	
	# Prepare the photo filename
	include_once($root_path.'include/inc_photo_filename_resolve.php');
	/* Get the citytown name */
	$addr_citytown_name=$person_obj->CityTownName($addr_citytown_nr);

	 
}
# Prepare text and resolve the numbers
include_once($root_path.'include/inc_patient_encounter_type.php');		 

require('./gui_bridge/default/gui_aufnahme_start.php');
}
?>
