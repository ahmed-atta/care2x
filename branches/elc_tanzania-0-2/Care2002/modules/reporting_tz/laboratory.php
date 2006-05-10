<?php
/*
 * Created on 05.04.2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');


#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_lab.php');
require_once($root_path.'include/care_api_classes/class_tz_selianreporting.php');

/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();
$lab_obj=new Lab();
$db->debug=FALSE;
$sql="CREATE TEMPORARY TABLE tmp_laboratory TYPE=HEAP (SELECT
  care_tz_laboratory_tests.id as GroupID,
  care_tz_laboratory_tests.name as GroupName,
  care_tz_laboratory_param.nr as TestID,
  care_tz_laboratory_param.name as TestName
FROM care_tz_laboratory_tests
INNER JOIN care_tz_laboratory_param ON care_tz_laboratory_param.group_id=care_tz_laboratory_tests.id WHERE is_enabled=1)"; 
$db->Execute($sql);

$sql="CREATE TEMPORARY TABLE tmp_laboratory_tests (TestID INT NOT NULL, is_positive INT NOT NULL, date INT NOT NULL) TYPE=HEAP ";
$db->Execute($sql);

//$sql="Select * from care_test_findings_chemlab where encounter_nr=2006500443";
$sql="Select serial_value, add_value,UNIX_TIMESTAMP(create_time) as date from care_test_findings_chemlab";
$db_obj=$db->Execute($sql);
$row=$db_obj->GetArray();
while (list($u,$v)=each($row)){
	$a =  unserialize($v['serial_value']);
	// later also: $b =  unserialize($v['add_value']);
	while (list($au,$av)=each($a)) {
		$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$au.",0,".$v['date'].")";
		$db->Execute($sql);
		//echo $sql.";<br>";
	}
}



$sql_number_of_columns = "SELECT count(TestID) FROM tmp_laboratory"; 
$db_prt = $db->Execute($sql_number_of_columns);
$db_row = $db_prt->FetchRow();
$number_of_columns = $db_row[0];
echo "Amount of available tests: ".$db_row[0];

  
function DisplayLaboratoryTableHead($group_id) {
	global $db;

	// Table definition will be organized by the variable $table_head from here:
	$table_head = "<tr>\n";
	$table_head .= "<td bgcolor=\"#ffffaa\">&nbsp;</td>\n";

	// Line of all groups
	$sql_groups = "SELECT Count(GroupID) as colspan, GroupName, GroupID FROM tmp_laboratory WHERE GroupID=".$group_id." GROUP BY GroupID";
	$db_prt = $db->Execute($sql_groups);
	$db_array = $db_prt->GetArray();
	
	while (list($u,$v)=each($db_array)) {
		$table_head .= "<td colspan=\"".$v['colspan']."\" bgcolor=\"#ffffaa\" id=\"".$v['GroupID']."\"> <div align=\"center\"><h1>".$v['GroupName']."</h1></div></td>\n" ;
	}
	$table_head.="</tr>\n<tr>";
	$table_head .= "<td bgcolor=\"#ffffaa\">day</td>\n";
	$sql_tests = "SELECT TestID, TestName FROM tmp_laboratory WHERE GroupID=$group_id ORDER BY TestID";
	$db_prt=$db->Execute($sql_tests);
	$db_row=$db_prt->GetArray();
	while (list($u,$v)=each($db_row)) {
		$table_head .= "<td bgcolor=\"#ffffaa\" id=\"".$v['TestID']."\">".$v['TestName']."</td>\n" ;
	}
	
	echo $table_head;
}

function NumberOfTests($TestID,$month, $day, $year) {
	global $db;

	$month=04;
	$day=01;
	$year=2006;

	$start_timeframe = mktime (0,0,0,$month, $day, $year);// 00:00 at this day of this month
	$end_timeframe =  mktime (24,0,0,$month, $day, $year);// 24:00 at this day of this month
	

	$sql = "Select Count(TestID) as number_of_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_timeframe." <= date AND date <= ".$end_timeframe." )";
	$db_ptr = $db->Execute($sql);
	//echo $sql."<br>";
	$row = $db_ptr->FetchRow();
	
		
	return (empty($row[0])) ? 0 : $row[0];		
}

function DisplayLaboratoryTestSummary($group_id, $date) {
	global $db;
	$table ="<tr>\n";
	
	if (empty($date))
		$date=time();
	
	$table="";
	for ($day=1; $day<=date("t",$date); $day++) {
		
		$table.="<tr>\n";
		$table .= "<td bgcolor=\"#ffffaa\">".$day."</td>\n";
		$sql = "SELECT TestID FROM tmp_laboratory WHERE GroupID=".$group_id;
		$db_ptr=$db->Execute($sql);
		$arr_ret = $db_ptr -> GetArray();
		while (list($u,$v)=each($arr_ret)) {
			$table .= "<td bgcolor=\"#ffffaa\" id=\"".$v['TestID']."\">".NumberOfTests($v['TestID'], $date)."</td>\n";	
		}
		$table .="</tr>\n";
	}
		
	echo $table;
	
}



/*
$all_groups = $lab_obj -> TestGroups();
$row=$all_groups->GetArray();
while (list($u,$v) = each ($row)) {
	//echo $v['name']."<br>";
	$all_tests = $lab_obj -> TestParams($v['id']);
	$test_rows=$all_tests->GetArray();
	//echo "number of tests in that group:".count($test_rows)."<br>";
	while (list($u1,$v1)=each($test_rows)) {
		echo "----id: ".$v1['id']."-".$v1['name']."<br>";
	}
}
 
echo "<br>";

*/





require_once('include/inc_timeframe.php');

require_once('gui/gui_laboratory.php');
?>
