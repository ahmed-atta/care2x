<?php
// <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	$saveok=false;
	//$dbtable="pharma_ordercatalog_".$dept;
if($cat=="pharma") $dbtable="pharma_ordercatalog";
	else $dbtable="med_ordercatalog";

include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
		{
				$sql="INSERT INTO ".$dbtable." 
						(	
							dept,
							hit,
							artikelname,
							proorder,
							bestellnum ) 
						VALUES (
							'$dept',
							'$hit',
							'$artname',
							'$proorder',
							'$bestellnum')";
        		if($ergebnis=mysql_query($sql,$link))
				{
				//print $sql;
					$saveok=true;
				}
			//print $sql;
	}
  	 else 
		{ print "$db_noconnect<br>"; }
?>
