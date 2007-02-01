<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_reporting.php');
//------------------------------------------------------------------------------------------------------
$arv_report=&new ARV_report();
#$test=$arv_report->prepareStatistics(2006,2006);
#print_r($test);
#echo $arv_report->prepareTable($test);

$curr_year = date("Y", time());

if (!isset($_GET['month'])) {$_GET['month'] = date("m", time());}
if(!isset($_GET['year'])) {$_GET['year']=$curr_year;}

echo $curr_year-1;
require ("gui/gui_arv_report_page1.php");
?>
