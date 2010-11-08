<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');


/**
 * getting summary of OPD...
*/

$lang_tables[]='search.php';
define('LANG_FILE','care_dhis.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');

include('./care_dhis.php');

if ($_SERVER['REQUEST_METHOD']=="POST"){

//var $under5_tbl = "care_dhis_view_under5";
//var $above5_tbl = "care_dhis_view_above5";
//var $from_date = '';
//var $to_date = '';

$monthFrom = $_POST['mnth'];
$yearFrom = $_POST['yrs'];
$dateFrom = $yearFrom."-".$monthFrom."-01";
$monthTo = $_POST['mnthTo'];
$yearTo = $_POST['yrsTo'];
$dateTo = $yearTo."-".$monthTo."-01";


$fp = @fopen('export.xml','w');
if(!$fp) {
    die('Error cannot create XML file');
}


	  global $db;

	  $sql="SELECT distinct(element), elementid FROM care_dhis_view_under5 where dstart >= '".$dateFrom."' and dstart <= '".$dateTo."'";
      $rs_ptr = $db->Execute($sql);
	
	  include("./header.php");
	  fwrite($fp,"<dataElements>");
      while ($row = $rs_ptr->FetchRow()) {
        fwrite($fp,"<dataElement>");
		fwrite($fp,"<id>".$row[1]."</id>");
		fwrite($fp,"<uuid></uuid>");
		fwrite($fp,"<name>".$row[0]."</name>");
		fwrite($fp,"<alternativeName>".$row[0]."</alternativeName>");
		fwrite($fp,"<shortName>".$row[0]."</shortName>");
		fwrite($fp,"<code></code>");
		fwrite($fp,"<description>".$row[0]."</description>");
		fwrite($fp,"<active>true</active>");
		fwrite($fp,"<type>int</type>");
		fwrite($fp,"<aggregationOperator>sum</aggregationOperator>");
		fwrite($fp,"<categoryCombo>3</categoryCombo>");
		fwrite($fp,"</dataElement>");
      }
	  
	  $sql="SELECT distinct(element), elementid FROM care_dhis_view_above5 where dstart >= '".$dateFrom."' and dstart <= '".$dateTo."'";
      $rs_ptr = $db->Execute($sql);

      while ($row = $rs_ptr->FetchRow()) {
        fwrite($fp,"<dataElement>");
		fwrite($fp,"<id>".$row[1]."</id>");
		fwrite($fp,"<uuid></uuid>");
		fwrite($fp,"<name>".$row[0]."</name>");
		fwrite($fp,"<alternativeName>".$row[0]."</alternativeName>");
		fwrite($fp,"<shortName>".$row[0]."</shortName>");
		fwrite($fp,"<code></code>");
		fwrite($fp,"<description>".$row[0]."</description>");
		fwrite($fp,"<active>true</active>");
		fwrite($fp,"<type>int</type>");
		fwrite($fp,"<aggregationOperator>sum</aggregationOperator>");
		fwrite($fp,"<categoryCombo>3</categoryCombo>");
		fwrite($fp,"</dataElement>");
      }
	  fwrite($fp,"</dataElements>");
	  
	  $sql="SELECT care_config_global.value FROM care_config_global where care_config_global.type = 'main_info_name' or care_config_global.type = 'main_info_hospid'";
      $rs_ptr = $db->Execute($sql);
	  $i = 0;
	  while($row = $rs_ptr->FetchRow()){
	  $data[$i] = $row[0];
	  $i++;
	  }
	  	fwrite($fp,"<organisationUnits>");
		fwrite($fp,"<organisationUnit>");
		fwrite($fp,"<id>".$data[0]."</id>");
		fwrite($fp,"<uuid></uuid>");
		fwrite($fp,"<name>".$data[1]."</name>");
		fwrite($fp,"<shortName>".$data[1]."</shortName>");
		fwrite($fp,"<code></code>");
		fwrite($fp,"<openingDate>2005-01-01</openingDate>");
		fwrite($fp,"<closedDate></closedDate>");
		fwrite($fp,"<active>true</active>");
		fwrite($fp,"<comment></comment>");
		fwrite($fp,"<geoCode></geoCode>");
		fwrite($fp,"</organisationUnit>");
		fwrite($fp,"</organisationUnits>");


	  $sql="SELECT distinct(periodid), dstart, edate FROM care_dhis_view where dstart >= '".$dateFrom."' and dstart <= '".$dateTo."'";
      $rs_ptr = $db->Execute($sql);
	  	  
	  fwrite($fp,"<periods>");
      while ($row = $rs_ptr->FetchRow()) {
	    fwrite($fp,"<period>");
		fwrite($fp,"<id>".$row[0]."</id>");
		fwrite($fp,"<periodType>Monthly</periodType>");
		fwrite($fp,"<startDate>".$row[1]."</startDate>");
		fwrite($fp,"<endDate>".$row[2]."</endDate>");
		fwrite($fp,"</period>");
      }
	  fwrite($fp,"</periods>");
	  
	  $sql="SELECT elementid, periodid, cases FROM care_dhis_view_under5 where dstart >='".$dateFrom."' and dstart <= '".$dateTo."'";
      $rs_ptr = $db->Execute($sql); 
	  
	  fwrite($fp,"<dataValues>");
      while ($row = $rs_ptr->FetchRow()) {
	    fwrite($fp,"<dataValue>");
		fwrite($fp,"<dataElement>".$row[0]."</dataElement>");
		fwrite($fp,"<period>".$row[1]."</period>");
		fwrite($fp,"<source>".$data[0]."</source>");
		fwrite($fp,"<value>".$row[2]."</value>");
		fwrite($fp,"<storedBy>19</storedBy>");
		fwrite($fp,"<timeStamp></timeStamp>");
		fwrite($fp,"<comment></comment>");
		fwrite($fp,"<categoryOptionCombo>4</categoryOptionCombo>");
		fwrite($fp,"</dataValue>");
      }
	  
	  $sql="SELECT elementid, periodid, cases FROM care_dhis_view_above5 where dstart >='".$dateFrom."' and dstart <= '".$dateTo."'";
      $rs_ptr = $db->Execute($sql); 
	  
      while ($row = $rs_ptr->FetchRow()) {
	    fwrite($fp,"<dataValue>");
		fwrite($fp,"<dataElement>".$row[0]."</dataElement>");
		fwrite($fp,"<period>".$row[1]."</period>");
		fwrite($fp,"<source>".$data[0]."</source>");
		fwrite($fp,"<value>".$row[2]."</value>");
		fwrite($fp,"<storedBy>19</storedBy>");
		fwrite($fp,"<timeStamp></timeStamp>");
		fwrite($fp,"<comment></comment>");
		fwrite($fp,"<categoryOptionCombo>4</categoryOptionCombo>");
		fwrite($fp,"</dataValue>");
      }
	  fwrite($fp,"</dataValues>");
	  fwrite($fp,"</dxf>");
	  
fclose($fp);


$zip = new ZipArchive;
$res = $zip->open('Export.zip', ZipArchive::CREATE);
if ($res === TRUE) {
    $zip->addFile('export.xml', 'export.xml');
    $zip->close();
} else {
    echo 'the zip file has failed to be created, contact your system admin';
}

}

?>
