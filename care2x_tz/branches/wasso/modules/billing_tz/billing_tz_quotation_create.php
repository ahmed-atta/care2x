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
//define('LANG_FILE','billing.php');
$lang_tables[]='billing.php';
$lang_tables[]='aufnahme.php';
//include($root_path.'include/inc_load_lang_tables.php');
require($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$enc_obj=new Encounter;
$bill_obj = new Bill;
$insurance_obj = new Insurance_tz;
$which_price=$_REQUEST['unit_price'];

$debug = false;
($debug) ? $db->debug=TRUE : $db->debug=FALSE;

$IS_PATIENT_INSURED=$insurance_obj->is_patient_insured($bill_obj->GetPIDfromEncounter($encounter_nr));


if ($debug) echo "<b>billing_tz_quotation_create.php</b>";


if($task=="insert")
{
    if ($debug) echo "TASK:INSERT";
	$billcounter=0;
	$deletecounter=0;

	while(list($x,$v) = each($_REQUEST))
	{

		if ($debug) echo "looking for:".$x."<br>";

		if(strstr($x,"modepres_"))
		{

			$prescriptions_nr = substr(strrchr($x,"_"),1);
			if($_REQUEST['modepres_'.$prescriptions_nr]=='bill')
			{
				$billcounter++;
				//Okay, this one has to be billed!
				if(!$new_bill_number)
				{
					$new_bill_number = $bill_obj->CreateNewBill($encounter_nr);
				}
				if ($debug) echo "insurance_$prescriptions_nr".$_REQUEST['insurance_'.$prescriptions_nr]."<br>";
				if ($debug) echo "insurance:".$_REQUEST['insurance']."<br>";
				if ($debug) echo "showprice_$prescriptions_nr :".$_REQUEST['showprice_'.$prescriptions_nr];
				$price=$_REQUEST['showprice_'.$prescriptions_nr];
				echo $_REQUEST['price_'.$prescriptions_nr];
				$bill_obj->StorePrescriptionItemToBill($pid,$prescriptions_nr,$new_bill_number, $_REQUEST['showprice_'.$prescriptions_nr], $_REQUEST['dosage_'.$prescriptions_nr], $_REQUEST['notes_'.$prescriptions_nr], $_REQUEST['insurance_'.$prescriptions_nr]);
				$bill_obj->UpdateBillNumberNewPrescription($prescriptions_nr,$new_bill_number);
				if ($debug) echo "Prescription: allocate2insurance(".$new_bill_number.", ".$_REQUEST['showprice_'.$prescriptions_nr].",".$_REQUEST['insurance'].");";
				if ($_REQUEST['insurance']!=-1)
					$insurance_obj->allocatePrescriptionsToinsurance($new_bill_number, $prescriptions_nr, $_REQUEST['showprice_'.$prescriptions_nr],$_REQUEST['insurance']);
			}
			elseif($_REQUEST['modepres_'.$prescriptions_nr]=='delete')
			{
				$deletecounter++;
				//Hmm, lets kick this one out!
				$bill_obj->DeleteNewPrescription($prescriptions_nr,'Disabled by billing officer');
			}
		}
		elseif(strstr($x,"modelab_"))
		{
			if ($debug) echo "looking for lab ...<br>";
			$labtest_nr = substr(strrchr($x,"_"),1);
			if($_REQUEST['modelab_'.$labtest_nr]=='bill')
			{
				$billcounter++;
				//Okay, this one has to be billed!
				if(!$new_bill_number)
				{
					$new_bill_number = $bill_obj->CreateNewBill($encounter_nr);
				}
				$bill_obj->StoreLaboratoryItemToBill($pid,$labtest_nr,$new_bill_number, $_REQUEST['insurance_'.$labtest_nr]);

				if ($debug) echo "Laboratory: allocate2insurance(".$new_bill_number.", $labtest_nr,".$_REQUEST['insurance'].");";
				if ($debug) echo "labtest nr.".$labtest_nr."<br>";
				if ($debug) echo "billnumber: $new_bill_number<br>";
				if ($debug) echo "labtest nr.: ".$_REQUEST['insurance_'.$labtest_nr]."<br>";
				if ($debug) echo "insurance: ".$_REQUEST['insurance']."<br>";

				if ($_REQUEST['insurance']!=-1)
					$insurance_obj->allocateLaboratoryItemsToinsurance($new_bill_number, $labtest_nr,$_REQUEST['insurance']);
			}
			elseif($_REQUEST['modelab_'.$labtest_nr]=='delete')
			{
				$deletecounter++;
				//Hmm, lets kick this one out!
				$bill_obj->DeleteNewLaboratory($labtest_nr,'Disabled by billing officer');
			}
		}

	}

	if($billcounter>0)
		header("Location: billing_tz_edit.php".URL_APPEND."&batch_nr=".$pid."&billnr=".$new_bill_number."&user_origin=quotation&patient=".$_REQUEST['patient']);
	else
	{
		if($deletecounter>0)
				$message = '<font color=red>'.$deletecounter.' items deleted for '.$enc_obj->ShowPID($pid).'.</font>';
		else
				$message = '<font color=red>'.$LDNothingToDo.' '.$enc_obj->ShowPID($pid).'.</font>';
		header("Location: billing_tz_quotation.php".URL_APPEND."&message=".urlencode($message)."&patient=".$_REQUEST['patient']);
	}
} // end of if($task=="insert")

if ($debug) "nothing to do - just show what we have...<br>";

require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$insurance_tz = New Insurance_tz();

// Get actual insurance budget of PID
$matchingContract = $insurance_tz->GetContractMemberFromTimestamp($pid,time());
$matchingBills = $bill_obj->GetBillCostSummaryInTimeframe($pid, $matchingContract['start_date'], time());
$ceiling = $matchingContract['Member']['ceiling']-$matchingContract['Member']['ceiling_startup_subtraction'];
$used_budget = array_sum($matchingBills);
$insurancebudget = $ceiling-$used_budget;

$result = $bill_obj->GetNewQuotation_Prescriptions($encounter_nr);

//if($result->FetchRow())
{
	require ("gui/gui_billing_tz_quotation_create.php");
}
//else
/*{
	header("Location: billing_tz_quotation.php".URL_APPEND."&message=".urlencode($message)."&patient=".$_REQUEST['patient']);
}*/

?>