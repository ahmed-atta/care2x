<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_products_ordercatalog_getactual.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

if($cat=="pharma") $dbtable="pharma_ordercatalog";
	else $dbtable="med_ordercatalog";

require("../include/inc_db_makelink.php");
	if($link&&$DBLink_OK) 
		{

		
				$sql='SELECT SQL_SMALL_RESULT * FROM '.$dbtable.' 
						WHERE dept="'.$dept.'" ORDER BY hit DESC';
        		$ergebnis=mysql_query($sql,$link);
				//count rows=linecount
				$rows=0;
				while ($content=mysql_fetch_array($ergebnis)) $rows++;					
				//reset result
				if($rows>0) mysql_data_seek($ergebnis,0);
	
		}
  		 else { print "$LDDbNoLink<br>"; } 


?>
