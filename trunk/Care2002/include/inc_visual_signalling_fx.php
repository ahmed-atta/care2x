<?php

define('SIGNAL_COLOR_LEVEL_FULL',2);   // integer for full signal

define('SIGNAL_COLOR_LEVEL_HALF',1);  // integer for half signal
                                                            //  As of beta 1.0.03, the half level signalling
                                                            //  is not yet implemented
																				 
define('SIGNAL_COLOR_LEVEL_ZERO',0);  // integer for no event

/**
*  Valid colors for signalling are:
*
*  yellow
*  black
*  blue_pale
*  brown
*  pink
*  yellow_pale
*  red
*  green_pale
*  violet
*  blue
*  biege
*  orange
*  green
*  rose
*/

define('SIGNAL_COLOR_DIAGNOSTICS_REPORT','brown');   // color to be set for signalling a diagnostic report 
define('SIGNAL_COLOR_DIAGNOSTICS_REQUEST','blue_pale');   // color to be set for signalling a diagnostic/consult request 

define('SIGNAL_COLOR_QUERY_DOCTOR','yellow');    // color to be set for signalling a query to the doctor
define('SIGNAL_COLOR_DOCTOR_INFO','black');             // color to be set for signalling a doctor's instruction or answer
define('SIGNAL_COLOR_NURSE_REPORT','blue');             // color to be set for signalling a doctor's instruction or answer


/* ****************** Do not edit the following functions **************************/

function setEventSignalColor($pn, $color, $status = SIGNAL_COLOR_LEVEL_FULL )
{

   global $link,  $LDDbNoSave;

   $event_table='care_nursing_station_patients_event_signaller'; 

   $sql="UPDATE ".$event_table." SET ".$color."='".$status."' WHERE patnum='".$pn."'"; 
	//echo $sql;
   if(!$ergebnis=mysql_query($sql,$link))
   {
       
	       $sql="INSERT INTO ".$event_table." ( patnum, ".$color.") VALUES ( ".$pn.", ".$status.")";
	       //echo $sql;
           if(!$ergebnis=mysql_query($sql,$link)) echo "$sql $LDDbNoSave";

   }	   

}

?>
