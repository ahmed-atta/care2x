<?php
require_once($root_path.'include/inc_environment_global.php');
include_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($pres_obj)) $pres_obj=new Prescription;
$app_types=$pres_obj->getAppTypes();
$pres_types=$pres_obj->getPrescriptionTypes();

$debug = FALSE;

if ($debug) echo "External_call:".$externalcall;

if (!empty($show)) {
  // The $show-Value comes from the input-type button and will be send by javascript (check_prescriptions.js)
  if ($show=='Drug List') {
      $activated_tab='druglist';
      $db_drug_filter='drug_list';
    }
  if ($show=='Supplies') {
      $activated_tab='Supplies';
      $db_drug_filter='supplies'; 
    }
  if ($show=='Supplies-Lab') {
      $activated_tab='supplies-lab';
      $db_drug_filter='supplies_laboratory';
    }
  if ($show=='Special Others') {
      $activated_tab='special-others';
      $db_drug_filter='special_others_list';
    }
  if ($show=='xray') {
      $activated_tab='xray';
      $db_drug_filter='xray';
    }
  if ($show=='service') {
      $activated_tab='service';
      $db_drug_filter='service';
    }
  if ($show=='dental') {
      $activated_tab='dental';
      $db_drug_filter='dental';
    }
  if ($show=='smallop') {
      $activated_tab='smallop';
      $db_drug_filter='smallop';
    }
  if ($show=='bigop') {
      $activated_tab='bigop';
      $db_drug_filter='bigop';
    }
  

  if ($show=='insert') {
    if (empty($_SESSION['item_array'])) {
      //echo "Taking items from get values...<br>";
      $_SESSION[item_array]=$item_no; // this is comming from gui_inpuit_prescription_preselection.php as GET variables!    
    }
    
    // The prescription list is complete, so we can go to ask about the details
    // of each item
    
    include('./gui_bridge/default/gui_input_prescription_details.php');
  } else {

    include('./gui_bridge/default/gui_input_prescription_preselection.php');
  }
} else {
  // first call of descriptions. The value $show is not set in this case. 
  include('./gui_bridge/default/gui_input_prescription_preselection.php');
} 