<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
//-------------------------------------------------------------------------------------------------------
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/care_api_classes/class_arv_case.php');
require_once($root_path.'include/care_api_classes/class_arv_visit.php');
//-------------------------------------------------------------------------------------------------------
$breakfile="modules/arv/arv_menu.php";
$add_breakfile="&pid=".$_GET['pid'];
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');	
//-------------------------------------------------------------------------------------------------------
$o_arv_case=&new ARV_case($_GET['pid']);
$o_arv_case->getPatientARVData();
$o_arv_visit=&new ARV_visit($o_arv_case->CurrentEncounter($_GET['pid']),$o_arv_case->getARVcaseID());

if (($_GET['mode']=='edit')) {
	$o_arv_visit->session_new(microtime());
	$o_arv_visit->load_to_SESSION();
}
elseif (($_GET['mode']=='new')) {
	$o_arv_visit->set_default_values();
}

if (isset($_GET['submit'])){
	if($o_arv_visit->form_validate()) {
		if($o_arv_visit->saveChanges()){
			$querystring="&pid=".$_GET['pid'];
			$filename = 'arv_menu.php';
			header("Location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$querystring");
		}
	}
}
elseif (isset($_GET['select_aidsdef_events'])) {
	$filename = 'arv_events.php';
	$querystring="&pid=".$_GET['pid'];
	$o_arv_visit->save_GET_to_SESSION('arv_data');
	header("Location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$querystring");
}
elseif (isset($_GET['select_status_reason'])) {
	$filename = 'arv_status_reason.php';
	$querystring="&pid=".$_GET['pid'];
	$o_arv_visit->save_GET_to_SESSION('arv_data');
	header("Location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$querystring");
}
elseif(isset($_GET['arv_drugs'])) {
	$filename = 'modules/registration_admission/show_prescription.php';
	$querystring="&pid=".$_GET['pid'];
	$o_arv_visit->save_GET_to_SESSION('arv_data');
	header("Location: $root_path/$filename".URL_REDIRECT_APPEND."$querystring");
}
elseif(isset($_GET['a_item_no'])) {
	$o_arv_visit->save_GET_to_SESSION('a_item_no');
}

require ("gui/gui_arv_visit.php");



?>
