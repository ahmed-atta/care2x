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

if ($debug) {
  echo $pn."<br>";
  echo $prescription_date."<br>";
  
}

if ($mode=="edit_elem") {
  //Maybe specific definitions...who knows...
}

if ($mode=="modfication") {
  if ($debug) {
    echo "modfication";
    echo "description:$description<br>";
    echo "price$price<br>";
    echo "amount:$amount<br>";
    echo "payment_status:$payment_status<br>";
    echo "bill_elem_number: $bill_elem_number<br>";
    echo "batch_nr:$batch_nr<br>";
    echo "specific_mode:$specific_mode<br>";
  }
  if ($payment_status=="paid")
    $is_paid=1;
  else
    $is_paid=0;
  
  if ($specific_mode=="update")
    $bill_obj->update_bill_element($bill_elem_number, $is_paid, $amount, $price, $description);
  if ($specific_mode=="delete")
    $bill_obj->delete_bill_element($bill_elem_number);  
}
if($mode=="allpaid")
{
	$bill_obj->update_bill_element_allpaid($bill_nr, 1);
}

require ("gui/gui_billing_tz_edit.php");

?>