<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='emr.php';
$lang_tables[]='person.php';
$lang_tables[]='date_time.php';
define('LANG_FILE','aufnahme.php');

$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_insurance.php');
require_once($root_path.'include/care_api_classes/class_person.php');

/* Create the new person object */
$person_obj=new Person($pid);
/* Create a new person insurance object */
$pinsure_obj=new PersonInsurance($pid);

$thisfile=basename(__FILE__);
$default_filebreak=$root_path.'main/startframe.php'.URL_APPEND;

if(empty($HTTP_SESSION_VARS['sess_path_referer']) || !file_exists($root_path.$HTTP_SESSION_VARS['sess_path_referer'])) {
    $breakfile=$default_filebreak;
} else {
    $breakfile=$root_path.$HTTP_SESSION_VARS['sess_path_referer'].URL_APPEND;
}

if(!session_is_registered('sess_pid')) session_register('sess_pid');
if(!isset($insurance_show)) $insurance_show=true;

$data_array=array();
$newdata=1;
$target='entry';
$error=0;
$dbtable='care_person';
$insure_private=1;
$insure_public=2;
	    
# Default path for fotos. Make sure that this directory exists!
$default_photo_path='fotos/registration';

if(!isset($photo_filename)||empty($photo_filename)) $photo_filename='nopic';
# Assume first that image is not uploaded
$valid_image=FALSE;

if(!isset($user_id) || !$user_id) {
    $user_id=$local_user.$sid;
    $user_id=$$user_id;
}

if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok) {
	  //* Get the global config for person's registration form*/
    $config_type='person_%';
    include($root_path.'include/inc_get_global_config.php');
	
    include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('person_%');
	
    # Check whether config foto path exists, else use default path			
    $photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

    if (($mode=='save') || ($mode=='forcesave')) {

        /* If saving is not forced, validate important elements */
        if($mode!='forcesave') {
            //clean and check input data variables
            if(trim($encoder)=='') $encoder=$aufnahme_user;
            if (trim($name_last)=='') { $errornamelast=1; $error++;}
            if(trim($name_first)=='') { $errornamefirst=1; $error++; }
            if (trim($date_birth)=='') { $errordatebirth=1; $error++;}
            if (trim($addr_str)=='') { $errorstreet=1; $error++;}
            if (trim($addr_str_nr)=='') { $errorstreetnr=1; $error++;}
            if ($addr_citytown_nr&&(trim($addr_citytown_name)=='')) { $errortown=1; $error++;}
            if ($sex=='') { $errorsex=1; $error++;}
			
			if($insurance_show) {
                if(trim($insurance_nr) && (trim($insurance_firm_name)=='')) { $errorinsurancecoid=1; $error++;}
		    }
			
        }
	
        /* If the validation produces no error, save the data */
        if(!$error) {	
            /* Save the old filename for testing */
            $old_fn=$photo_filename;
         
		 	# Create image object
			include_once($root_path.'include/care_api_classes/class_image.php');
			$img_obj=& new Image;
			
			# Check the uploaded image file if exists and valid
			if($img_obj->isValidUploadedImage($HTTP_POST_FILES['photo_filename'])){
				$valid_image=TRUE;
				# Get the file extension
				$picext=$img_obj->UploadedImageMimeType();
			}
					
            if(($update)) {
				
                //echo formatDate2STD($geburtsdatum,$date_format);
                $sql='UPDATE '.$dbtable.' SET
						 title="'.$title.'",
						 name_last="'.$name_last.'",
						 name_first="'.$name_first.'",
						 name_2="'.$name_2.'",
						 name_3="'.$name_3.'",
						 name_middle="'.$name_middle.'",
						 name_maiden="'.$name_maiden.'",
						 name_others="'.$name_others.'",
						 date_birth="'.formatDate2STD($date_birth,$date_format).'",
						 blood_group="'.$blood_group.'",
						 sex="'.$sex.'",
						 addr_str="'.$addr_str.'",
						 addr_str_nr="'.$addr_str_nr.'",
						 addr_zip="'.$addr_zip.'",
						 addr_citytown_nr='.$addr_citytown_nr.',
						 phone_1_nr="'.$phone_1_nr.'",
						 phone_2_nr="'.$phone_2_nr.'",
						 cellphone_1_nr="'.$cellphone_1_nr.'",
						 cellphone_2_nr="'.$cellphone_2_nr.'",
						 fax="'.$fax.'",
						 email="'.$email.'",
						 citizenship="'.$citizenship.'",
						 civil_status="'.$civil_status.'",
						 sss_nr="'.$sss_nr.'",
						 nat_id_nr="'.$nat_id_nr.'",
						 religion="'.$religion.'",
						 ethnic_orig="'.$ethnic_orig.'",
						 date_update="'.date('Y-m-d H:i:s').'",';
						 
			   //if ($old_fn!=$photo_filename){
			   if ($valid_image){
					# Compose the new filename
					$photo_filename=$pid.'.'.$picext;
					# Save the file
					$img_obj->saveUploadedImage($HTTP_POST_FILES['photo_filename'],$root_path.$photo_path.'/',$photo_filename);
			   		# add to the sql query
					$sql.=' photo_filename="'.$photo_filename.'",';
				}
			  # complete the sql query
			   $sql.=' history=CONCAT(history," Update '.date('Y-m-d H:i:s').' '.$user_id."\n".'"), modify_id="'.$user_id.'" WHERE pid='.$pid;
			
			  $db->BeginTrans();
			  $ok=$db->Execute($sql);
			  if($ok) {
			      $db->CommitTrans();
				  /* Update the insurance data */
				  /* Lets detect if the data is already existing */
				  if($insurance_show) {
				      if($insurance_item_nr) {
				          if(!empty($insurance_nr) && !empty($insurance_firm_name) && $insurance_firm_id) {  
						  
						      $insure_data=array('insurance_nr'=>$insurance_nr,
						                                'firm_id'=>$insurance_firm_id,
														'class_nr'=>$insurance_class_nr);
														
						      $pinsure_obj->updateDataFromArray($insure_data,$insurance_item_nr);
						  
						  }
				      } elseif ($insurance_nr && $insurance_firm_name  && $insurance_class_nr) {
	
						   $insure_data=array('insurance_nr'=>$insurance_nr,
						                                'firm_id'=>$insurance_firm_id,
														'pid'=>$pid,
														'class_nr'=>$insurance_class_nr);
														
							$pinsure_obj->insertDataFromArray($insure_data);
					  }
                 }				
			      $newdata=1;
				  //echo $sql;
			
			      header("Location: patient_register_show.php".URL_REDIRECT_APPEND."&pid=$pid&from=$from&newdata=1&target=entry");
			      exit;     
																					 
			  } else {
			      $db->RollbackTrans();
			  }
            } else {
                 $from='entry';
				 # Prepare internal data to be stored together with the user input data
				 if(!$person_obj->InitPIDExists($GLOBAL_CONFIG['person_id_nr_init'])) $HTTP_POST_VARS['pid']=$GLOBAL_CONFIG['person_id_nr_init'];
				 $HTTP_POST_VARS['date_birth']=@formatDate2Std($date_birth,$date_format);
				 $HTTP_POST_VARS['date_reg']=date('Y-m-d H:i:s');
				 $HTTP_POST_VARS['status']='normal';
				 $HTTP_POST_VARS['history']="Init.reg. ".date('Y-m-d H:i:s')." ".$user_id."\n";
				 $HTTP_POST_VARS['modify_id']=$user_id;
				 $HTTP_POST_VARS['create_id']=$user_id;
				 $HTTP_POST_VARS['create_time']='NULL';
					
				//$person_obj->insertDataFromArray($data_array);
	            
				 if($person_obj->insertDataFromInternalArray())
	             { 
		              # If data was newly inserted, get the insert id = PID
		               if(!$update) $pid=$db->Insert_ID();
					   
					   # Save the a valid uploaded photo
					   if($valid_image){
							# Compose the new filename
							$photo_filename=$pid.'.'.$picext;
							# Save the file
							$img_obj->saveUploadedImage($HTTP_POST_FILES['photo_filename'],$root_path.$photo_path.'/',$photo_filename);
					   }
					   
				  # Update the insurance data
				  # Lets detect if the data is already existing
				  if($insurance_show) {
				      if($insurance_item_nr) {
				          if(!empty($insurance_nr) && !empty($insurance_firm_name) && $insurance_firm_id) {  
						  
						      $insure_data=array('insurance_nr'=>$insurance_nr,
						                                'firm_id'=>$insurance_firm_id,
														'class_nr'=>$insurance_class_nr);
														
						      $pinsure_obj->updateDataFromArray($insure_data,$insurance_item_nr);
						  
						  }
				      } elseif ($insurance_nr && $insurance_firm_name  && $insurance_class_nr) {
	
						      $insure_data=array('insurance_nr'=>$insurance_nr,
						                                'firm_id'=>$insurance_firm_id,
														'pid'=>$pid,
														'class_nr'=>$insurance_class_nr);
														
						      $pinsure_obj->insertDataFromArray($insure_data);
					  }
                 }				
			
			          $newdata=1;
						
			          header("Location: patient_register_show.php".URL_REDIRECT_APPEND."&pid=$pid&from=$from&newdata=1&target=entry");
			          exit;     
		         }
	              else {echo "<p>$sql<p>$LDDbNoSave";};				
             }
        } // end of if(!$error)

     }elseif(isset($pid) && ($pid!='')){
		 # Get the person's data
         if($data_obj=&$person_obj->getAllInfoObject())
         {
	         $zeile=$data_obj->FetchRow();
	 
             //while(list($x,$v)=each($zeile))	$$x=$v;            
			  extract($zeile);
			      
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
	      }
    } else {
	     $date_reg=date('Y-m-d H:i:s');
     }			
	 /* Get the insurance classes */
	 $insurance_classes=&$pinsure_obj->getInsuranceClassInfoObject('class_nr,name,LD_var');
} else { 
    echo "$LDDbNoLink<br>"; 
}

require_once($root_path.'include/inc_photo_filename_resolve.php');

require('./gui_bridge/default/gui_person_reg.php');
?>
