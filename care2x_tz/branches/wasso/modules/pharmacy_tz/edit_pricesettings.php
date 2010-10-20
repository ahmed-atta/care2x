<?php
/*
 * Created on 25.06.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
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



$debug=FALSE;
// Endable db-debugging if variable debug is true
($debug) ? $db->debug=TRUE : $db->debug=FALSE;

$product_obj = new Product();
$product_obj->usePriceDescriptionTable();


if ($_POST['submit']=='submit') {
	// post button is pressed, store the data
	if ($debug) echo "current mode is submit!<br>";

	  $timestamp = time();
	  $user = $HTTP_SESSION_VARS['sess_user_name'];

	  $db_buffer = array();

	  $db_buffer['last_change'] = $timestamp;
	  $db_buffer['UID'] = $user;



	  // Insert Values for first row:
	  $db_buffer['ShowDescription'] = $_POST['short_1'];
	  $db_buffer['FullDescription'] = $_POST['long_1'];
	  if ($_POST['is_insurance']==1) {
	  	$is_insured_1 = 1;
	  	$db_buffer['is_insurance_price'] = 1;
	  } else {
	  	$db_buffer['is_insurance_price'] = 0;
	  }

	  $sql= "Update care_tz_drugsandservices_description set " .
	  		"ShowDescription='$db_buffer[ShowDescription]'," .
	 		"FullDescription='$db_buffer[FullDescription]'," .
	 		"is_insurance_price='$db_buffer[is_insurance_price]' ".
	 		"where ID=1";
	 $db->Execute($sql);

      // Insert Values for 2nd row:
	  $db_buffer['ShowDescription'] = $_POST['short_2'];
	  $db_buffer['FullDescription'] = $_POST['long_2'];
	  if ($_POST['is_insurance']==2) {
	  	$is_insured_2=2;
	  	$db_buffer['is_insurance_price'] = 1;
	  } else {
	  	$db_buffer['is_insurance_price'] = 0;
	  }

	  $sql= "Update care_tz_drugsandservices_description set " .
	  		"ShowDescription='$db_buffer[ShowDescription]'," .
	 		"FullDescription='$db_buffer[FullDescription]'," .
	 		"is_insurance_price='$db_buffer[is_insurance_price]' ".
	 		"where ID=2";
	  $db->Execute($sql);

      // Insert Values for 3rd row:
	  $db_buffer['ShowDescription'] = $_POST['short_3'];
	  $db_buffer['FullDescription'] = $_POST['long_3'];
	  if ($_POST['is_insurance']==3) {
	  	$is_insured_3=1;
	  	$db_buffer['is_insurance_price'] = 1;
	  } else {
	  	$db_buffer['is_insurance_price'] = 0;
	  }

	  $sql= "Update care_tz_drugsandservices_description set " .
	  		"ShowDescription='$db_buffer[ShowDescription]'," .
	 		"FullDescription='$db_buffer[FullDescription]'," .
	 		"is_insurance_price='$db_buffer[is_insurance_price]' ".
	 		"where ID=3";
	  $db->Execute($sql);

      // Insert Values for 4th row:
	  $db_buffer['ShowDescription'] = $_POST['short_4'];
	  $db_buffer['FullDescription'] = $_POST['long_4'];
	  if ($_POST['is_insurance']==4) {
	  	$is_insured_4=1;
	  	$db_buffer['is_insurance_price'] = 1;
	  } else {
	  	$db_buffer['is_insurance_price'] = 0;
	  }

	  $sql= "Update care_tz_drugsandservices_description set " .
	  		"ShowDescription='$db_buffer[ShowDescription]'," .
	 		"FullDescription='$db_buffer[FullDescription]'," .
	 		"is_insurance_price='$db_buffer[is_insurance_price]' ".
	 		"where ID=4";
	  $db->Execute($sql);


} else {
	// first call of this page, just show what we have stored at the database
	if ($debug) echo "current mode is default/first call of this page!<br>";

	$allItems=$product_obj->getAllDataObject();

	$index=0;
	while($row=$allItems->FetchRow()){
		$short[$index] = $row['ShowDescription'];
		$long[$index] = $row['FullDescription'];
		$is_insurance[$index] = $row['is_insurance_price'];
		$timestamp=$row['last_change'];
		$user=$row['UID'];
		$index ++;

	}
	// quite navie, but's working:
	$short_1=$short[0]; $long_1=$long[0]; $is_insured_1 = $is_insurance[0];
	$short_2=$short[1]; $long_2=$long[1]; $is_insured_2 = $is_insurance[1];
	$short_3=$short[2]; $long_3=$long[2]; $is_insured_3 = $is_insurance[2];
	$short_4=$short[3]; $long_4=$long[3]; $is_insured_4 = $is_insurance[3];


} // end of if ($_POST['submit']=='submit')


 require ('gui/gui_edit_pricesettings.php');
?>
