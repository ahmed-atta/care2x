<!-- <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 -->
<?php
$deleteok=false;
	
if($cat=="pharma") $dbtable="pharma_ordercatalog";
	else $dbtable="med_ordercatalog";

	include("../req/db-makelink.php");
		if($link&&$DBLink_OK) 
		{

    				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' 
							WHERE bestellnum="'.$keyword.'"
							AND dept="'.$dept.'"';
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
