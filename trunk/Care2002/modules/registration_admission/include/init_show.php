<?php
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
//require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/inc_editor_fx.php');
require_once($root_path.'include/care_api_classes/class_person.php');
# Load the template class
require_once($root_path.'include/care_api_classes/class_template.php');
# Create the template object
$TP_obj=new Template($root_path);

$breakfile='patient.php';
$admissionfile='aufnahme_start.php'.URL_APPEND;

if((!isset($pid)||!$pid)&&$HTTP_SESSION_VARS['sess_pid']) $pid=$HTTP_SESSION_VARS['sess_pid'];
	elseif((isset($pid)&&$pid)&&!$HTTP_SESSION_VARS['sess_pid']) $HTTP_SESSION_VARS['sess_pid']=$pid;

//echo getcwd();
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
 
if(isset($pid) && ($pid!='')) {
	$person_obj=new Person($pid);
	if($data_obj=&$person_obj->getAllInfoObject()){
		$zeile=$data_obj->FetchRow();
		//while(list($x,$v)=each($zeile))	$$x=$v;
		extract($zeile);       
	}
}

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person_%');
//$glob_obj->getConfig('patient_%');
$glob_obj->getConfig('notes_%');
if(!$GLOBAL_CONFIG['notes_preview_maxlen']) $GLOBAL_CONFIG['notes_preview_maxlen']=60; // hardcoded default value;

//$HTTP_SESSION_VARS['sess_full_pid']=$pid+$GLOBAL_CONFIG['person_id_nr_adder'];
$HTTP_SESSION_VARS['sess_full_pid']=$pid;
		
/* Check whether config foto path exists, else use default path */			
$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
require_once($root_path.'include/inc_photo_filename_resolve.php');

if($HTTP_SESSION_VARS['sess_parent_mod']=='admission') {
	$parent_admit=true;
	$page_title=$LDAdmission;
}else{
	$parent_admit=false;
	$page_title=$LDPatientRegister;
}
?>
