<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],'inc_products_ordercatalog_delete.php')) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

$deleteok=false;
	
if($cat=='pharma') $dbtable='care_pharma_ordercatalog';
	else $dbtable='care_med_ordercatalog';

if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
		if($dblink_ok) 
		{

    				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' 
							WHERE item_no="'.$keyword.'"';
    		if($ergebnis=$db->Execute($sql))
				{
					//header ("location:apotheke-datenbank-functions-manage.php?sid=$ck_sid&from=deleteok");
					$deleteok=true;
				}
			//print $sql;
	}
  	 else 
		{ print "$LDDbNoLink<br>"; }
?>
