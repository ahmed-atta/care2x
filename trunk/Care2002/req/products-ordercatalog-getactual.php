<?
// <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

if($cat=="pharma") $dbtable="pharma_ordercatalog";
	else $dbtable="med_ordercatalog";

require("../req/db-makelink.php");
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
