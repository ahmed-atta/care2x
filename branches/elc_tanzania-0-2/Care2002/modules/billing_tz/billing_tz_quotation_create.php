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
  		
  		
if($task=="insert")
{
	$billcounter=0;
	$deletecounter=0;
	while(list($x,$v) = each($HTTP_POST_VARS))
	{
		if(strstr($x,"modepres_"))
		{
			
			$prescriptions_nr = substr(strrchr($x,"_"),1);
			if($HTTP_POST_VARS['modepres_'.$prescriptions_nr]=='bill')
			{
				$billcounter++;
				//Okay, this one has to be billed!
				if(!$new_bill_number)
				{
					$new_bill_number = $bill_obj->CreateNewBill($encounter_nr);
				}
				$bill_obj->StorePrescriptionItemToBill($prescriptions_nr,$new_bill_number, $HTTP_POST_VARS['price_'.$prescriptions_nr], $HTTP_POST_VARS['dosage_'.$prescriptions_nr], $HTTP_POST_VARS['notes_'.$prescriptions_nr]);
				$bill_obj->UpdateBillNumberNewPrescription($prescriptions_nr,$new_bill_number);
			}
			elseif($HTTP_POST_VARS['modepres_'.$prescriptions_nr]=='delete')
			{
				$deletecounter++;
				//Hmm, lets kick this one out!
				$bill_obj->DeleteNewPrescription($prescriptions_nr,'Disabled by billing officer');
			}
		}
		elseif(strstr($x,"modelab_"))
		{
			
			$labtest_nr = substr(strrchr($x,"_"),1);
			if($HTTP_POST_VARS['modelab_'.$labtest_nr]=='bill')
			{
				$billcounter++;
				//Okay, this one has to be billed!
				if(!$new_bill_number)
				{
					$new_bill_number = $bill_obj->CreateNewBill($encounter_nr);
				}
				$bill_obj->StoreLaboratoryItemToBill($labtest_nr,$new_bill_number);
			}
			elseif($HTTP_POST_VARS['modelab_'.$labtest_nr]=='delete')
			{
				$deletecounter++;
				//Hmm, lets kick this one out!
				$bill_obj->DeleteNewLaboratory($labtest_nr,'Disabled by billing officer');
			}
		}

	}
	if($deletecounter>0 || $billcounter>0)
		header("Location: billing_tz_edit.php".URL_APPEND."&batch_nr=".$pid."&billnr=".$new_bill_number."&user_origin=quotation");
	else
	{
		$message = '<font color=red>Nothing todo for '.$enc_obj->ShowPID($pid).'.</font>';
		header("Location: billing_tz_quotation.php".URL_APPEND."&message=".urlencode($message));
	}
}
require ("gui/gui_billing_tz_quotation_create.php");

?>