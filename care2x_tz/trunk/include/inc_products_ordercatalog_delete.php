<?php

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
