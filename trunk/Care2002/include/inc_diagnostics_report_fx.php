<?php

/* Load the visual signalling defined constants */
require_once('../include/inc_visual_signalling_fx.php');


/* signalNewDiagnosticsReportEvent will set an event instance in the 
* care_nursing_station_patients_diagnostics_report table
*  signalling the availability of a report.
*  param $report_date = the date (in local format) of the creation of the report
*  param $script_name = the script string that will be used to run the display of the report
*  return 
*/
function signalNewDiagnosticsReportEvent($report_date, $script_name='labor_test_findings_printpop.php')
{

   global $link, $local_user, $sid, $batch_nr, $pn, $HTTP_COOKIE_VARS, $target, $subtarget, $LDDbNoRead, $LDDbNoSave, $date_format, $entry_date;
   
/* Check if the formatDate2Local function is loaded */

if(!function_exists('formatDate2Local'))   include_once('../include/inc_date_format_functions.php');
   
    /* If the findings are succesfully saved, make an entry into the care_nursing_station_patients_diagnostics_report table
    *  for signalling purposes
    */
									
    $entry_table='care_nursing_station_patients_diagnostics_report';
									
    $report_exits=0; // assume that report does not exist yet
									
    /* Check first if a copy is already existing. If yes = update entry, no = insert new entry*/
									
    $sql="SELECT item_nr, history FROM $entry_table WHERE report_nr='$batch_nr'";
									
    if($ergebnis=mysql_query($sql,$link))
    {
        $rows=mysql_num_rows($ergebnis);
										
        if($rows)  
		{
										
			 $report=mysql_fetch_array($ergebnis);
											 
			$sql="UPDATE $entry_table SET
						report_date='".formatDate2Std($report_date,$date_format)."',
						report_time='".date('H:i:s')."',
						status='pending',
						history='".$report['history']."Update: ".date('Y-m-d H:i:s')." ".$HTTP_COOKIE_VARS[$local_user.$sid]."\n\r',
						modify_id='".$HTTP_COOKIE_VARS[$local_user.$sid]."'
						WHERE item_nr='".$report['item_nr']."'";
		}
		else
		{
			$sql="INSERT INTO  $entry_table
					(
						report_nr,
						report_date,
						report_time,
						reporting_dept,
						patnum,
						script_call,
						status,
						history,
						modify_id,
						create_id,
						create_time
					)
					VALUES
					(
						'$batch_nr',
						'".formatDate2Std($report_date,$date_format)."',
						'".date('H:i:s')."',
						'$subtarget',
						'$pn',
						'".$script_name."?entry_date=".$entry_date."&target=".$target."&subtarget=".$subtarget."&batch_nr=".$batch_nr."&pn=".$pn."',
						'pending',
						'Initial report: ".date('Y-m-d H:i:s')." ".$HTTP_COOKIE_VARS[$local_user.$sid]."\n\r',
						'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
						'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
						NULL
					)";
																						
		}
									    
		if($ergebnis=mysql_query($sql,$link))
		{
		
		   setEventSignalColor($pn, SIGNAL_COLOR_DIAGNOSTICS_REPORT, SIGNAL_COLOR_LEVEL_FULL);
		
		   return true;
		
		 }
		 else
		 {
		    echo "$sql $LDDbNoSave"; // for debugging. comment out for normal runs
			return false;
	     }
 
 }
	else
	{
		echo "$sql $LDDbNoRead"; // for debugging. comment out for normal runs
		return false;
	}

}
