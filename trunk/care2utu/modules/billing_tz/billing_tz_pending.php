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

$lang_tables[]='billing.php';
$lang_tables[]='aufnahme.php';

require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');

$enc_obj=new Encounter;
$bill_obj = new Bill;
$insurance_tz = new Insurance_tz;

$debug = false;
($debug) ? $db->debug=TRUE : $db->debug=FALSE;

if ($debug) {
  echo $pn."<br>";
  echo $prescription_date."<br>";
  echo 'Mode:'.$mode;
}

$DISPLAY_MSG="";
if ($mode=="archived")
  $DISPLAY_MSG="<br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;<h2>Bill (Bill-Number:$bill_number) status: <i>ARCHIVED</i><h2>";


if ($mode=="done" && !empty($bill_number)) {
  // Store the 'pending' bill to the 'archive'
  $bill_obj->ArchiveBill($bill_number);

  if(!$discharge)
  {
  	if($user_origin=='quotation')
  		header ( 'Location: billing_tz_quotation.php?patient='.$_REQUEST['patient'].'');
  	else
  		header ( 'Location: billing_tz_pending.php?mode=archived&bill_number='.$bill_number );
  }
  else
  	if($user_origin=='quotation')
  		header ( 'Location: ../ambulatory/amb_clinic_discharge.php'.URL_REDIRECT_APPEND.'&user_origin='.$user_origin.'&pn='.$encounter.'&pyear='.date("Y").'&pmonth='.date("n").'&pday='.date(j).'&tb='.str_replace("#","",$cfg['top_bgcolor']).'&tt='.str_replace("#","",$cfg['top_txtcolor']).'&bb='.str_replace("#","",$cfg['body_bgcolor']).'&d='.$cfg['dhtml'].'&station='.$station.'&backpath='.urlencode('../billing_tz/billing_tz_quotation.php').'&dept_nr='.$dept_nr);
  	else
  		header ( 'Location: ../ambulatory/amb_clinic_discharge.php'.URL_REDIRECT_APPEND.'&user_origin='.$user_origin.'&pn='.$encounter.'&pyear='.date("Y").'&pmonth='.date("n").'&pday='.date(j).'&tb='.str_replace("#","",$cfg['top_bgcolor']).'&tt='.str_replace("#","",$cfg['top_txtcolor']).'&bb='.str_replace("#","",$cfg['body_bgcolor']).'&d='.$cfg['dhtml'].'&station='.$station.'&backpath='.urlencode('../billing_tz/billing_tz_pending.php').'&dept_nr='.$dept_nr);


}
elseif (false)		//Modified for debugging reasons: original was else { }
{
  echo 'TEST';die();
   /* Get the pending test requests */

  // If this is the first call, get the first pn number out of the database...
  if (empty($batch_nr))
  {
    if ($debug) echo "<h1>get first pid</h1>";
    $pid=$bill_obj->GetFirstPid();
    $batch_nr = $pid;
  }
  else
  {
    if ($debug) echo "<h1>$batch_nr</h1>";
  	$pid=$batch_nr;
  }
  // Load all batch-numbers of this person into this array $array_encounters
  $array_encounters = $bill_obj->GetAllEncounters();

  // Now we have all encounters, but we are not sure that this person ($pid) made
  // some tasks with interesting points for us as billing module.

  	while(list($index,$encounter_nr)=each($array_encounters)) {


      if ($debug) echo "---------------------------------------------------------------------------------<br>";
      if ($debug) echo "<b>'.$LDEncounterNumber.' $encounter_nr</b><br>";

      //----------------------------------------------------------------------------------------------

      /**
      * Going through the tables and looking for pending items that should be stored into
      * the billing tables
      */

      if ($bill_obj->PendingBillObjects($encounter_nr)) {

        if ($debug) echo $LDPendingBillsforEncounterNr." ".$encounter_nr."<br>";

        // There are pending objects => There are entries in the module-tables
        // that are not listened in the billing list



        // Do we have a bill for this encounter, that we can append it?

        if ($bill_obj->CheckForPendingBill($encounter_nr)) {

          // There is a pending bill for this encounter and we can append all items to it
          if ($debug) echo "'.$LDPendingBillAdd.'<br>";

          $bill_number = $bill_obj->GetBill($encounter_nr);

          if ($debug) echo "'.$LDOurBillNumberIs.'".$bill_number."<br>";

        } else {

          // There is no pending bill availabe for this encounter, we have to create it
          if ($debug) echo $LDNoPendingBillCreate;

          $bill_number = $bill_obj->CreateNewBill($encounter_nr);
        }

        // Store to the pending bill table whatever we've found:
        $bill_obj->StoreToBill($encounter_nr, $bill_number);

      }

  		/* Okay everything is looking fine. All bills have been created and updated now lets
  		   find out which ones have to be paid
  		*/

      //----------------------------------------------------------------------------------------------


  	}
}
else
{
  if(empty($pid) && empty($batch_nr))
  {
  	$pid=$bill_obj->GetFirstPid();
  	$batch_nr = $pid;
  }
  elseif(empty($pid) && !empty($batch_nr))
  	$pid = $batch_nr;

  require ("gui/gui_billing_tz_pending.php");
}
?>