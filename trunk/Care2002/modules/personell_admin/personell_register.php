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
$lang_tables=array('personell.php');
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
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_person.php');
require_once($root_path.'include/care_api_classes/class_insurance.php');
//require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
require_once($root_path.'include/care_api_classes/class_personell.php');


$thisfile=basename(__FILE__);
$returnfile=$breakfile;
   

$newdata=1;

/* Default path for fotos. Make sure that this directory exists! */
$default_photo_path=$root_path.'fotos/registration';
$photo_filename='nopic';
$error=0;

if(!isset($pid)) $pid=0;
if(!isset($mode)) $mode='';
if(!isset($forcesave)) $forcesave=0;
if(!isset($update)) $update=0;

if(!session_is_registered('sess_pid')) session_register('sess_pid');
if(!session_is_registered('sess_full_pid')) session_register('sess_full_pid');
if(!session_is_registered('sess_en')) session_register('sess_en');
if(!session_is_registered('sess_full_en')) session_register('sess_full_en');
if(!session_is_registered('sess_pnr')) session_register('sess_pnr');
if(!session_is_registered('sess_full_pnr')) session_register('sess_full_pnr');

$patregtable='care_person';  // The table of the patient registration data

//$dbtable='care_encounter'; // The table of admission data

/* Create new person's insurance object */
$pinsure_obj=new PersonInsurance($pid);	 
/* Get the insurance classes */
$insurance_classes=&$pinsure_obj->getInsuranceClassInfoObject('class_nr,name,LD_var');

/* Create new person object */
$person_obj=new Person($pid);
/* Create personell object */
$personell_obj=new Personell();

if($pid||$personell_nr){
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok){
	   	/* Get the patient global configs */
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('personell_%');
        $glob_obj->getConfig('person_foto_path'); 

        /* Check whether config path exists, else use default path */			
        $photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

        if ($pid){	
		  /* Check whether the person is currently admitted. If yes jump to display admission data */
			if(!$update&&$personell_nr=$personell_obj->Exists($pid)){
		     	 header('Location:personell_register_show.php'.URL_REDIRECT_APPEND.'&personell_nr='.$personell_nr.'&origin=admit&sem=isadmitted&target=personell_reg');
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

            if (($mode=='save')){

                 if(!$error) {	
				      if($update || $personell_nr){
							//echo formatDate2STD($geburtsdatum,$date_format);
					      $itemno=$itemname;		
									if($HTTP_POST_VARS['date_join']) $HTTP_POST_VARS['date_join']=@formatDate2STD($HTTP_POST_VARS['date_join'],$date_format);
									if($HTTP_POST_VARS['date_exit']) $HTTP_POST_VARS['date_exit']=@formatDate2STD($HTTP_POST_VARS['date_exit'],$date_format);
									if($HTTP_POST_VARS['contract_start']) $HTTP_POST_VARS['contract_start']=@formatDate2STD($HTTP_POST_VARS['contract_start'],$date_format);
									if($HTTP_POST_VARS['contract_end']) $HTTP_POST_VARS['contract_end']=@formatDate2STD($HTTP_POST_VARS['contract_end'],$date_format);
									$HTTP_POST_VARS['modify_id']=$encoder;
									$HTTP_POST_VARS['history']= "CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$encoder."\n')";
									if(isset($HTTP_POST_VARS['pid'])) unset($HTTP_POST_VARS['pid']);		
												
									$personell_obj->setDataArray($HTTP_POST_VARS);
									
									if($personell_obj->updateDataFromInternalArray($personell_nr)){
							            header("Location: personell_register_show.php".URL_REDIRECT_APPEND."&personell_nr=$personell_nr&origin=admit&target=personell_reg&newdata=$newdata"); 
								        exit;
								    }
					  }	else{
					  	    $newdata=1;

									 if(!$personell_obj->InitPersonellNrExists($GLOBAL_CONFIG['personell_nr_init'])) $HTTP_POST_VARS['nr']=$GLOBAL_CONFIG['personell_nr_init'];

									if($HTTP_POST_VARS['date_join']) $HTTP_POST_VARS['date_join']=@formatDate2STD($HTTP_POST_VARS['date_join'],$date_format);
									if($HTTP_POST_VARS['date_exit']) $HTTP_POST_VARS['date_exit']=@formatDate2STD($HTTP_POST_VARS['date_exit'],$date_format);
									if($HTTP_POST_VARS['contract_start']) $HTTP_POST_VARS['contract_start']=@formatDate2STD($HTTP_POST_VARS['contract_start'],$date_format);
									if($HTTP_POST_VARS['contract_end']) $HTTP_POST_VARS['contract_end']=@formatDate2STD($HTTP_POST_VARS['contract_end'],$date_format);
									$HTTP_POST_VARS['modify_id']=$encoder;
									$HTTP_POST_VARS['create_id']=$encoder;
									$HTTP_POST_VARS['create_time']=date('Y-m-d H:i:s');
									$HTTP_POST_VARS['history']="Create: ".date('Y-m-d H:i:s')." = ".$encoder."\n";
									
									$personell_obj->setDataArray($HTTP_POST_VARS);
									
									if($personell_obj->insertDataFromInternalArray()){
									    /* Get last insert id */
										$personell_nr=$db->Insert_ID();	
									    /* Save the service classes */									   
							            header("Location: personell_register_show.php".URL_REDIRECT_APPEND."&personell_nr=$personell_nr&origin=admit&target=personell_reg&newdata=$newdata"); 
								        exit;
								    }
					 }// end of if(update) else()                 
                  }	// end of if($error)
             } // end of if($mode)
			else{
				$person_obj->setPID($pid);
				if($data=&$person_obj->BasicDataArray($pid)){
					//while(list($x,$v)=each($data))	$$x=$v;
					extract($data);      
				}     
				/* Get the citytown name */
				$addr_citytown_name=$person_obj->CityTownName($addr_citytown_nr);
			}
        } elseif($personell_nr) {
			  /* Load personell data */
			  $personell_obj->loadPersonellData($personell_nr);
			  if($personell_obj->is_loaded) {
		          $zeile=&$personell_obj->personell_data;
					//load data
                  //while(list($x,$v)=each($zeile)) {$$x=$v; //echo $v; }
				  extract($zeile);
                  /* Get insurance firm name*/
			      $insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id);
				  $full_pnr=$personell_nr;
			  }
			  /* GEt the patient's services classes */
        } 	
	}else { 
         echo "$LDDbNoLink<br>"; 
    }
}
    
/* Load the wards info */
$ward_obj=new Ward;
$items='nr,name';
$ward_info=&$ward_obj->getAllWardsItemsObject($items);

if($update) $breakfile='personell_register_show.php'.URL_APPEND.'&personell_nr='.$personell_nr;
	elseif($HTTP_COOKIE_VARS['ck_login_logged'.$sid]) $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
		else $breakfile='personell_admin_pass.php'.URL_APPEND.'&target='.$target;


/* Prepare the photo filename */
require_once($root_path.'include/inc_photo_filename_resolve.php');
require('./gui_bridge/default/gui_'.$thisfile);
?>

