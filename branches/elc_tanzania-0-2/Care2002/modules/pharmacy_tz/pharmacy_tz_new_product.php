<?php

if ($GO_BACK_TO_SEARCH) {

  if ($mode!="delete" && $mode!="update") {
    header('Location: pharmacy_tz_search.php?keyword='.$keyword);
    exit();
  }
}

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

require($root_path.'include/inc_environment_global.php');
require($root_path.'include/care_api_classes/class_tz_pharmacy.php');


/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
* Updated by: Alexander Irro - alexander.irro@merotech.de
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='pharmacy.php';
define('NO_2LEVEL_CHK',1);
require($root_path.'include/inc_front_chain_lang.php');

$debug=false;

if ($debug) {
  echo "debugging mode is ON<br>";
  // output debug informations
  function print_debug_info($name, $value) {
    if (isset($value))
      echo $name." is set to value: ".$value."<br>";
  }

  print_debug_info ("mode",$mode);

  print_debug_info("Peadric check box", $is_peadric);
  print_debug_info("Adult check box", $is_adult);
  print_debug_info("Other check box", $is_other);
  print_debug_info("Consumable check box", $is_consumable);
  print_debug_info("Items full description", $items_full_description);
  print_debug_info("Item classification", $item_classification);
  print_debug_info("Selian Item number", $selian_item_number);
  print_debug_info("Pack size",$pack_size);
  print_debug_info("Selians Item Description",$selians_item_description);
  print_debug_info("Price",$selians_item_price);
  print_debug_info ("mode",$mode);
}

// Endable db-debugging if variable debug is true
($debug) ? $db->debug=TRUE : $db->debug=FALSE;

//------------------------------------------------------------------------------

/**
* This page can have several kinds of modes:
* case 1: mode is not set -> New item for the database (just for entering first time)
* case 2: mode is set to insert -> Item description is availabe, just checking the values before database entry
* case 3: mode is set to update -> update the items of this form, but check at first before database entry
* case 4: mode is set to erase -> delete a specific item out of the database
* case 5: mode is set to show -> just show the data, but no possibility to change it
* case 6: mode is set to edit -> likely the same like update but show at first the data just with update functionallity
* case 7: mode is set to erase -> same like delete, but from external call
*/
// Check form values if variable mode is set to "insert"


$product_obj = new Product();

//------------------------------------------------------------------------------

if (!empty($mode)) {

  if ( ($mode!="show") && ($mode!="edit") && ($mode!="erase") && (!$GO_BACK_TO_SEARCH)) { // show or edit are external calls of this site

    if ($product_obj->check_form_variable($selian_item_number)) {
      $ERROR=TRUE;
      $ERROR_SELIAN_ITEM_NUMBER = TRUE;
    }
    if ($mode=="insert") {
      if ($product_obj->check_form_variable($selians_item_description)) {
        $ERROR=TRUE;
        $ERROR_SELIANS_ITEM_DESCRIPTION = TRUE;

      }

    }
    if ($ERROR)
    $ERROR_MSG.="THERE ARE SOME IMPORTANT FIELDS MISSING! MISSING FIELDS ARE MARKED<br>";
  }

  // if show or edit then preload the missing informations for editing
  if ($mode=="show" || $mode=="edit" || $mode=="erase" || $mode=="update") {
    if (!empty($item_id) && empty($formular_sent)) {
      $is_peadric                 = $product_obj->get_item_peadric($item_id);
      $is_adult                   = $product_obj->get_item_adult($item_id);
      $is_other                   = $product_obj->get_item_other($item_id);
      $is_consumable              = $product_obj->get_item_consumable($item_id);
      $selian_item_number         = $product_obj->get_itemnumber($item_id);
      $selians_item_description   = $product_obj->get_selians_item_description($item_id);
      $items_full_description     = $product_obj->get_items_full_description($item_id);
      $item_classification        = $product_obj->get_item_classification($item_id);
      $selians_item_price         = $product_obj->get_selians_item_price($item_id);
    }
  }

}

//-----------------------------
if (empty($is_peadric))
  $is_peadric = 0;
else
  $is_peadric = 1;
//---
if (empty($is_adult))
  $is_adult = 0;
else
  $is_adult = 1;
//---
if (empty($is_other))
  $is_other = 0;
else
  $is_other = 1;
//---
if (empty($is_consumable))
  $is_consumable = 0;
else
  $is_consumable = 1;
//-----------------------------

//------------------------------------------------------------------------------


if ( !empty($mode) && !$ERROR ) {

  //------------------------------------------------------------------------------

  (empty($is_peadric))    ? $is_peadric = "0"    : $is_peadric = "1";
  (empty($is_adult))      ? $is_adult = "0"      : $is_adult = "1";
  (empty($is_other))      ? $is_other = "0"      : $is_other = "1";
  (empty($is_consumable)) ? $is_consumable = "0" : $is_consumable = "1";

  $db_buffer = array();
  $db_buffer['is_pediatric']            = $is_peadric;
  $db_buffer['is_adult']                = $is_adult;
  $db_buffer['is_other']                = $is_other;
  $db_buffer['is_consumable']           = $is_consumable;
  $db_buffer['item_number']             = $selian_item_number;
  $db_buffer['item_description']        = $selians_item_description;
  $db_buffer['item_full_description']   = $items_full_description;
  $db_buffer['purchasing_class']        = $item_classification;
  $db_buffer['unit_price']              = $selians_item_price;
  $product_obj->useProductTable();


  //------------------------------------------------------------------------------

  if ($mode=="insert") {
    // Check at first that this item is still not available in the database:
    if ($debug) echo "current mode is insert!<br>";
    if ($product_obj -> item_number_exists ($selian_item_number)) {
      // The item still exists in the database!
      $ERROR_MSG.="Sorry, this item with code \"".$selian_item_number."\" still exists in the database! <br>
                   Please check the field Selians item number, you can just update or delete it!<br>";
      $ERROR_SELIAN_ITEM_NUMBER = TRUE;
      $ERROR=TRUE;
    } else {
      // This is a new item, store it into the database
      $product_obj->setDataArray($db_buffer);
      $product_obj->insertDataFromInternalArray();
      $MSG.="Item with code \"".$selian_item_number."\" is now archived in the database<br>";
    }
  } // end of if ($mode=="insert")

  //------------------------------------------------------------------------------

  if ($mode=="update") {
    if ($debug) echo "current mode is update!<br>";
    if ($product_obj -> item_number_exists ($selian_item_number)) {
      // The item still exists in the database!
      $product_obj->setDataArray($db_buffer);
      $product_obj->updatePharmacyDataFromInternalArray($item_id,FALSE);
      $MSG.="Item with code \"".$selian_item_number."\" is now updated<br>";
    } else {
      // There is no item with such an item number in the database
      $ERROR_MSG.="Something is wrong, the item code \"".$selian_item_number."\" is not available in the database! <br>";
      $ERROR_SELIAN_ITEM_NUMBER = TRUE;
      $ERROR=TRUE;
    }
    if ($GO_BACK_TO_SEARCH && !$ERROR) {
      header('Location: pharmacy_tz_search.php?keyword='.$keyword);
    }
  } // end of if ($mode=="update")

  //------------------------------------------------------------------------------

  if ($mode=="delete") {
    if ($product_obj -> item_number_exists ($selian_item_number)) {
      // The item still exists in the database!
      $product_obj->delete_item();
      $MSG.="Item with code \"".$selian_item_number."\" is deleted now<br>";
    } else {
      // This is a new item
      // There is no item with such an item number in the database
      $ERROR_MSG.="Something is wrong, the item code \"".$selian_item_number."\" is not available in the database! <br>";
      $ERROR_SELIAN_ITEM_NUMBER = TRUE;
      $ERROR=TRUE;
    }
    if ($GO_BACK_TO_SEARCH && !$ERROR) {
      header('Location: pharmacy_tz_search.php?keyword='.$keyword);
    }
  } // end of if ($mode=="erase")

  //------------------------------------------------------------------------------

  if ($mode=="show") {
    $html_disabler="disabled";
    $GO_BACK_TO_SEARCH=TRUE;
    #d.r. from merotech
    $help_file="pharmacy_product_edit.php";
    $src="Pharmacy :: My Product Catalog :: Show";
  }

  //------------------------------------------------------------------------------

  if ($mode=="edit") {
    $mode="update";
    $UPDATE_FORM=TRUE;
    $GO_BACK_TO_SEARCH=TRUE;
    #d.r. from merotech
    $help_file="pharmacy_product_edit.php";
    $src="Pharmacy :: My Product Catalog :: Edit";
  }

  //------------------------------------------------------------------------------

  if ($mode=="erase") {
    $html_disabler="disabled";
    $DELETE_FORM=TRUE;
    $GO_BACK_TO_SEARCH=TRUE;
    #d.r. from merotech
    $help_file="pharmacy_product_edit.php";
    $src="Pharmacy :: My Product Catalog :: Delete";
  }


  //------------------------------------------------------------------------------

} // end of if (!empty($mode))
else {
	#d.r from merotech
	$help_file="pharmacy_product_insert.php";
    $src="Pharmacy :: My Product Catalog :: New Product";
}

//------------------------------------------------------------------------------

require ("gui/gui_pharmacy_tz_new_product.php");

?>