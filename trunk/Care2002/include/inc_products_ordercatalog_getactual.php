<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_products_ordercatalog_getactual.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if($cat=='pharma') $dbtable='care_pharma_ordercatalog';
	else $dbtable='care_med_ordercatalog';

require('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
		{
				$sql='SELECT SQL_SMALL_RESULT * FROM '.$dbtable.' 
						WHERE dept="'.$dept.'" ORDER BY hit DESC';
        		if($ergebnis=mysql_query($sql,$link)) $rows=mysql_num_rows($ergebnis);
				 else $rows=0;
		}
  		 else { print "$LDDbNoLink<br>"; } 
?>
