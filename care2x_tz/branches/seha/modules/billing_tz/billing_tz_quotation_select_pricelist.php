<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');

$enc_obj=new Encounter;
$bill_obj = new Bill;
 include ('gui/gui_billing_tz_select_pricelist.php');
?>