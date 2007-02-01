<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_arv_case.php');
require_once($root_path.'include/care_api_classes/class_arv_visit.php');
//-------------------------------------------------------------------------------------------------------------------------------------
$breakfile="modules/arv/arv_visit.php?pid=".$_GET['pid'];
$add_breakfile="&pid=".$_GET['pid'];
$o_arv_case=&new ARV_case($_GET['pid']);
$o_arv_visit=&new ARV_visit($o_arv_case->CurrentEncounter($_GET['pid']),$o_arv_case->getARVcaseID());
//-------------------------------------------------------------------------------------------------------------------------------------
$r_item_no=$_GET['r_item_no'];

$querystring=$o_arv_visit->querystring('arv_data').$o_arv_visit->querystring('a_item_no');

require ("gui/gui_arv_status_reason.php");
?>
