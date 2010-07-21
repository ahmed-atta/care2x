<?php

if($_SESSION['sess_user_origin']=='admission') {
	$breakfile=$root_path.'modules/registration_admission/admission_data_search.php'.URL_APPEND.'&encounter_nr='.$_SESSION['sess_en'];
}elseif($_SESSION['sess_user_origin']=='registration'){
	$breakfile=$root_path.'modules/registration_admission/show_medocs.php'.URL_APPEND.'&pid='.$_SESSION['sess_pid'];
}else{
	$breakfile='radiolog.php'.URL_APPEND;
}
?>