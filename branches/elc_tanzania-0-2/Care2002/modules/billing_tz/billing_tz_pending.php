<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
$enc_obj=new Encounter;
$bill_obj = new Bill;

$debug = FALSE;
($debug) ? $db->debug=TRUE : $db->debug=FALSE;

if ($debug) {
  echo $pn."<br>";
  echo $prescription_date."<br>";
  
}

 /* Get the pending test requests */


		$sql_bill="DELETE FROM care_tz_billing";
		$requests=$db->Execute($sql_bill);
		$sql_bill="DELETE FROM care_tz_billing_elem";
		$requests=$db->Execute($sql_bill);



// If this is the first call, get the first pn number out of the database... 
if (empty($batch_nr))
{
  echo "<h1>get first pid</h1>";
  $pid=$bill_obj->GetFirstPid();
  $batch_nr = $pid;
}
else
{
  echo "<h1>$batch_nr</h1>";
	$pid=$batch_nr;
}  
// Load all batch-numbers of this person into this array $array_encounters
$array_encounters = $bill_obj->GetAllEncounters();

// Now we have all encounters, but we are not sure that this person ($pid) made
// some tasks with interesting points for us as billing module.
 
	while(list($index,$encounter_nr)=each($array_encounters)) {

    
    if ($debug) echo "---------------------------------------------------------------------------------<br>";
    if ($debug) echo "<b>Encounter Number: $encounter_nr</b><br>";
    
    //----------------------------------------------------------------------------------------------  						

    /**
    * Going through the tables and looking for pending items that should be stored into
    * the billing tables
    */

    if ($bill_obj->PendingBillObjects($encounter_nr)) {
      if ($debug) echo "There are new pending bills for encounter nr. ".$encounter_nr;
      $bill_number = $bill_obj->CreateNewBill($encounter_nr);
      if ($debug) echo "<br>We created a new bill number <b>$bill_number</b><br>";
    }
      

      
    
    $requests = $bill_obj->GetPendingLaboratoryBills($encounter_nr);
		if($requests->RecordCount())	{
		  if ($debug) echo "=>There are ".$requests->RecordCount()." open laboratory issues for encounter $encounter_nr to store into the billing-table<br>";
		  $bill_obj->StoreToPendingBills($requests,$bill_number,"laboratory");
		} else {
		  if ($debug) echo "There are no pending laboratory bills for this encounter...<br>";
	  }
 		  
    
    $requests = $bill_obj->GetPendingPrescriptionBills($encounter_nr);
		if($requests->RecordCount())	{
		  if ($debug) echo "=>There are open prescription issues to store into the billing-table<br>";
		  $bill_obj->StoreToPendingBills($requests,$bill_number,"prescription");
		} else {
		  if ($debug) echo "There are no pending prescription bills for this encounter...<br>";
	  } 
		
		
		
		/* Okay everything is looking fine. All bills have been created and updated now lets
		   find out which ones have to be paid
		*/
		
    //----------------------------------------------------------------------------------------------

		
	}	

require ("gui/gui_billing_tz_pending.php");

?>