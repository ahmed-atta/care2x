<?php
session_start();
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

require('./roots.php');

require($root_path.'include/inc_environment_global.php');

require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');

$icd10=$_POST['dhis_element'];
$explodedData = $_SESSION['dhis_dataelement'];
$elementData = explode('|',$explodedData);
$underAge = $_SESSION['underAge'];
$dhis_element = $elementData[1];
$dhis_elementid = $elementData[0];

global $db;

if ($icd10){
	 foreach ($icd10 as $element){
	 		
		 if ($underAge=="yes"){
			$sql="insert into care_tz_dhis_element(icd_code,dhis_under5,dhis_under5id) values('$element','$dhis_element','$dhis_elementid')";
		 }
		 else{
			$sql="insert into care_tz_dhis_element(icd_code,dhis_dataelement,dataelement_id) values('$element','$dhis_element','$dhis_elementid')";
		 }
		 $db->Execute($sql);
	 }
}
header ("Location: ./care_dhis_main.php");	
?>