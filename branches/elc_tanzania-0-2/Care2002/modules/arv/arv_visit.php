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
$o_arv_visit=&new ARV_visit($o_arv_case->CurrentEncounter($_GET['pid']),$o_arv_case->getARVcaseID(),$_GET['arv_visit_id']);

$defaults = array (
    'weight' => '',
    'test_TB' => -1,
    'test_Cotrimoxazole' => -1,
    'test_INH' => -1,
    'test_Difflucan' => -1,
    'other_problems' => '',
    'care_tz_arv_status_id' => -1,
    'create_id' => $_SESSION['sess_login_username'],
    'create_time' => formatDate2Local(date('Y-m-d'),$date_format,null,null),
);

$o_arv_case->set_rule('create_id','rule_required');
$o_arv_case->set_rule('weight','rule_decimal');

//---------------------------------------------------------------------------------------------------------

if(!isset($_GET['arv_data'])) {
	if (($_GET['mode']=='edit')) {
		$visit_data=$o_arv_visit->get_visit_data();
		$a_item_no_data=$o_arv_visit->get_aidsdef_events();
		$r_item_no_data=$o_arv_visit->get_arv_status_reasons();
	
		while (list($x,$v) = each($a_item_no_data)) {
			$_GET['a_item_no'][$x]=$v;
		}
		
		while (list($x,$v) = each($r_item_no_data)) {
			$_GET['r_item_no'][$x]=$v;
		}
		$_GET['arv_data']=$visit_data;
		$_GET['arv_data']['create_time']=formatDate2Local(date('Y-m-d',$_GET['arv_data']['create_time']),$date_format,null,null);
	}
	else {
		$_GET['arv_data']=$defaults;
	}
}

if(isset($_GET['submit'])){
	$result=$o_arv_case->apply_rules($defaults, $_GET['arv_data']);
	$messages = $result['messages'];
	$values   = $result['values'];
	$errors   = $result['errors'];
	
	if ($errors==0) {
		$filename = 'arv_menu.php';
		if ($_GET['mode']=='new') {
			if($o_arv_visit->insertNewVisit($_GET['arv_data'],$_GET['a_item_no'],$_GET['r_item_no'])){
				$o_arv_case->addARV_visit($o_arv_visit);
				header("Location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$add_breakfile");
				exit;
			}
		}
		elseif ($_GET['mode']=='edit') {	
			if($o_arv_visit->updateVisit($_GET['arv_data'],$_GET['a_item_no'],$_GET['r_item_no'])) {
				header("Location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$add_breakfile");
				exit;
			}
		}
	}
}
elseif (isset($_GET['select_aidsdef_events'])) {
	$filename = 'arv_events.php';
	$querystring=$o_arv_visit->querystring('arv_data').$o_arv_visit->querystring('a_item_no').$o_arv_visit->querystring('r_item_no');
	header("Location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$querystring");
	exit;
}
elseif (isset($_GET['select_status_reason'])) {
	$filename = 'arv_status_reason.php';
	$querystring=$o_arv_visit->querystring('arv_data').$o_arv_visit->querystring('a_item_no').$o_arv_visit->querystring('r_item_no');
	header("Location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$querystring");
	exit;
}

require ("gui/gui_arv_visit.php");
?>