<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_products_ordercatalog_delete.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

$deleteok=false;
	
if($cat=='pharma') $dbtable='care_pharma_ordercatalog';
	else $dbtable='care_med_ordercatalog';

	include('../include/inc_db_makelink.php');
		if($link&&$DBLink_OK) 
		{

    				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' 
							WHERE item_no="'.$keyword.'"';
    		if($ergebnis=mysql_query($sql,$link))
				{
					//header ("location:apotheke-datenbank-functions-manage.php?sid=$ck_sid&from=deleteok");
					$deleteok=true;
				}
			//print $sql;
	}
  	 else 
		{ print "$LDDbNoLink<br>"; }
?>
