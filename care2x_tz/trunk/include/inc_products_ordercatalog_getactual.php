<?php

if($cat=='pharma') $dbtable='care_pharma_ordercatalog';
	else $dbtable='care_med_ordercatalog';

if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok) 
		{
				$sql='SELECT SQL_SMALL_RESULT * FROM '.$dbtable.' 
						WHERE dept_nr="'.$dept_nr.'" ORDER BY hit DESC';
        		if($ergebnis=$db->Execute($sql)) $rows=$ergebnis->RecordCount();
				 else $rows=0;
		}
  		 else { print "$LDDbNoLink<br>"; } 
?>
