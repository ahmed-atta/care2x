<?php
/*
 * Created on 15.08.2008
 *
 * CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
 * GNU General Public License
 * Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
 * elpidio@care2x.org, meggle@merotech.de
 *
 * See the file "copy_notice.txt" for the licence notice
*/

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/care_api_classes/class_core.php');

$lang_tables[]='pharmacy.php';
//define('NO_2LEVEL_CHK',1);
require($root_path.'include/inc_front_chain_lang.php');

    $debug=false;
    $debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;

if ($_FILES['thefile']['tmp_name'] ) {

	// Create a temporary file with the same structure like
	// the pricelist
	$sql = "CREATE TEMPORARY TABLE tabelle1 " .
			"SELECT  c.`item_number`, " .
					"c.`partcode`, " .
					"c.`is_pediatric`, " .
					"c.`is_adult`, " .
					"c.`is_other`, " .
					"c.`is_consumable`, " .
					"c.`is_labtest`, " .
					"c.`item_description`, " .
					"c.`item_full_description`, " .
					"c.`unit_price`, " .
					"c.`unit_price_1`, " .
					"c.`unit_price_2`, " .
					"c.`unit_price_3`, " .
					"c.`purchasing_class` " .
					"FROM care_tz_drugsandservices c;";

	// enlarge the max_tmp_table_size to the maximum what we can use:
	$Transact("SET @@max_heap_table_size=4294967296");
	// create an empty druglist:
	$setTable('tmp_care_tz_drugsandservices');
	$Transact($this->sql);

	$filename = $_FILES['filename']['tmp_name'];

	// load the file
	$row = 1;
	$handle = fopen ($filename,"r");
	while ( ($data = fgetcsv ($handle, 1000, ";")) !== FALSE ) {
	    $num = count ($data);
	    // first row is headline, so we start at line 2
		if ($row>2) {
		    print "<p> $num fields in line $row: <br>\n";
		    for ($c=0; $c < $num; $c++) {
		        print $data[$c] . "<br>\n";
		    }
		}
		$row++;
	}
	fclose ($handle);
	$sql="drop table care_tz_drugsandservices";
}




require ("gui/gui_manage_pricelist.php");
?>
