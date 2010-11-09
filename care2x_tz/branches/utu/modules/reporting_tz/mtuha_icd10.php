<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//require('con_db.php');
//connect_db();
#Load and create paginator object

$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_selianreporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();


require_once('include/inc_timeframe.php');
$month=array_search(1,$ARR_SELECT_MONTH);
$year=array_search(1,$ARR_SELECT_YEAR);

if ($printout) {
	$start = $_GET['start'];
	$end = $_GET['end'];
	$start_timeframe = $start;
	$end_timeframe = $end;
	$startdate = date("y.m.d ", $start_timeframe);
	 $enddate = date("y.m.d", $end_timeframe);
} else {
	$start = mktime (0,0,0,$month, 1, $year);
	$end = mktime (0,0,0,$month+1, 1, $year);
	//$start_timeframe = mktime (0,0,0,$month, 1, $year);
	//$end_timeframe = mktime (0,0,0,$month+1, 0, $year);
	$startdate = date("y.m.d ", $start);
	$enddate = date("y.m.d", $end);
}
$debug=false;
($debug)?$db->debug=TRUE:$db->debug=FALSE;


$tmp_table = $rep_obj->SetReportingTable("care_icd10_en");
$tmp_table1 = $rep_obj->SetReportingTable("care_tz_mtuha_cat_key");
$tmp_table2 = $rep_obj->SetReportingTable("care_tz_mtuha_cat");
$tmp_table3 = $rep_obj->SetReportingTable("care_tz_diagnosis");


$sql="SELECT care_tz_mtuha_cat.cat_id AS category, care_tz_mtuha_cat.description AS description FROM care_tz_diagnosis, care_tz_mtuha_cat_key, care_tz_mtuha_cat WHERE care_tz_diagnosis.icd_10_code = care_tz_mtuha_cat_key.icd10_key AND care_tz_mtuha_cat.cat_id = care_tz_mtuha_cat_key.cat_id AND timestamp>='$start' and timestamp<='$end' GROUP BY care_tz_mtuha_cat_key.cat_id";
$db_ptr=$db->Execute($sql);
$res_array = $db_ptr->GetArray();


require_once('gui/gui_mtuha_icd10.php');
?>