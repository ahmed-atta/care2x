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
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/care_api_classes/class_person.php');

$thisfile=basename(__FILE__);
$breakfile='patient.php';
$admissionfile='aufnahme_start.php'.URL_APPEND;

if((!isset($pid)||!$pid)&&$HTPP_SESSION_VARS['sess_pid']) $pid=$HTPP_SESSION_VARS['sess_pid'];

$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.$thisfile;
//$HTPP_SESSION_VARS['sess_pid']=$pid;

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
		
		
         if($data_obj=&$person_obj->getAllInfoObject())
         {
	        $zeile=$data_obj->FetchRow();
	 
            while(list($x,$v)=each($zeile))	$$x=$v;       
			
        }
		
		$sql='SELECT * FROM care_encounter_development WHERE pid='.$pid;
		
		if($result=$db->Execute($sql)){
			$row=$result->RecordCount();
		}
		
        require_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('person_%');
		
        /* Check whether config foto path exists, else use default path */			
        $photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
     }
}
else 
{ echo "$LDDbNoLink<br>"; }

require_once($root_path.'include/inc_photo_filename_resolve.php');

$subtitle=$LDPatientDev;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
