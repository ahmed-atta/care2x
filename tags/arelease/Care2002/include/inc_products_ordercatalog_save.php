<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_products_ordercatalog_save.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

$saveok=false;
	//$dbtable="pharma_ordercatalog_".$dept;
if($cat=="pharma") $dbtable="pharma_ordercatalog";
	else $dbtable="med_ordercatalog";

include("../include/inc_db_makelink.php");
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
