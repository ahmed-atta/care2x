<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_products_ordercatalog_save.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

$saveok=false;
if($cat=='pharma') $dbtable='care_pharma_ordercatalog';
	else $dbtable='care_med_ordercatalog';

include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
		{
				$sql="INSERT INTO ".$dbtable." 
						(	
							dept,
							hit,
							artikelname,
							minorder,
							maxorder,
							proorder,
							bestellnum ) 
						VALUES (
							'$dept',
							'$hit',
							'$artname',
							'$minorder',
							'$maxorder',
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
		{ print "$LDDbNoLink<br>"; }
?>
