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
$lang_tables=array('personell.php');
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/care_api_classes/class_person.php');
require($root_path.'include/care_api_classes/class_insurance.php');

//* Get the global config for person's registration form*/
require_once($root_path.'include/care_api_classes/class_globalconfig.php');

$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person_%');
		
$thisfile=basename(__FILE__);
$breakfile='patient.php';
$admissionfile='aufnahme_start.php'.URL_APPEND;

if((!isset($pid)||!$pid)&&$HTPP_SESSION_VARS['sess_pid']) $pid=$HTPP_SESSION_VARS['sess_pid'];

$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.$thisfile;
$HTTP_SESSION_VARS['sess_pid']=$pid;
$HTTP_SESSION_VARS['sess_full_pid']=$pid+$GLOBAL_CONFIG['person_id_nr_adder'];
$HTTP_SESSION_VARS['sess_parent_mod']='registration';

$dbtable='care_person';

/* Default path for fotos. Make sure that this directory exists! */
$default_photo_path=$root_path.'fotos/registration';
$photo_filename='nopic';


if(!isset($user_id) || !$user_id)
{
    $user_id=$local_user.$sid;
    $user_id=$$user_id;
}

if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok) {
 
    if(isset($pid) && ($pid!='')) {


		$person_obj=new Person($pid);
		$pinsure_obj=new PersonInsurance($pid);
		
		
         if($data_obj=&$person_obj->getAllInfoObject())
         {
	        $zeile=$data_obj->FetchRow();
	 
            while(list($x,$v)=each($zeile))	$$x=$v;       
			/* Get related insurance data*/
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
			        /*Get insurace firm name */
					$insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id); 
				} else { $insurance_show=false;}
			} 
			
			$insurance_class_info=$pinsure_obj->getInsuranceClassInfo($insurance_class_nr);
			
			/* update the record's history */
			if(empty($newdata)) @$person_obj->setHistorySeen($HTTP_SESSION_VARS['sess_user_name']);
        }

        /* Check whether config foto path exists, else use default path */			
        $photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
     }
}
else 
{ echo "$LDDbNoLink<br>"; }

require_once($root_path.'include/inc_photo_filename_resolve.php');

/* Load GUI page */
require('./gui_bridge/default/gui_'.$thisfile);
?>
