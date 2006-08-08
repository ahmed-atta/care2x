<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//require('con_db.php');
//connect_db();
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_selianreporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();


require_once('include/inc_timeframe.php');
$month=array_search(1,$ARR_SELECT_MONTH);
$year=array_search(1,$ARR_SELECT_YEAR);

$start = mktime (0,0,0,$month, 1, $year);
$end = mktime (0,0,0,$month+1, 1, $year);

$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

		  $start_timeframe = mktime (0,0,0,$month, 1, $year);
		  $end_timeframe = mktime (0,0,0,$month+1, 0, $year); // Last day of requested month
		//echo $startdate = gmdate("Y-m-d H:i:s", $start_timeframe);
		//echo $enddate = gmdate("Y-m-d H:i:s", $end_timeframe);
		
			$startdate = gmdate("y.m.d ", $start_timeframe);
		    $enddate = gmdate("y.m.d", $end_timeframe);

$tmp_table = $rep_obj->SetReportingTable("care_encounter");
$tmp_table2 = $rep_obj->SetReportingLink($tmp_table,"pid","care_person","pid");

$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , count( DISTINCT (pid) ) as NEW , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE,count( encounter_nr ) - count( DISTINCT (pid) ) as RET FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
$db_ptr=$db->Execute($sql);
$res_array = $db_ptr->GetArray();

require_once('gui/gui_OPD_Admission.php');
?>