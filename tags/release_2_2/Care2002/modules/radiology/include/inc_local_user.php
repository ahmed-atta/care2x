<?php
#------begin------ This protection code was suggested by Luki R. luki@karet.org
if (eregi('inc_drg_entry_save.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../../">');
#------end

if($HTTP_SESSION_VARS['sess_user_origin']=='admission') {
	$breakfile=$root_path.'modules/registration_admission/aufnahme_daten_zeigen.php'.URL_APPEND.'&encounter_nr='.$HTTP_SESSION_VARS['sess_en'];
	$local_user='aufnahme_user';
}elseif($HTTP_SESSION_VARS['sess_user_origin']=='registration'){
	$breakfile=$root_path.'modules/registration_admission/patient_register_show.php'.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'];
	$local_user='aufnahme_user';
}else{
	$breakfile='medocs_pass.php';
	$local_user='medocs_user';
}
?>
