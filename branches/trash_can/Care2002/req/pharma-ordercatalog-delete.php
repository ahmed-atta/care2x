<?php
// <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
$deleteok=false;
	
if($cat=="pharma") $dbtable="pharma_ordercatalog_".$dept;
	else $dbtable="med_ordercatalog_".$dept;

//init db parameters
require("../db_conf/db_init.php");

	
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{

    				$sql='DELETE LOW_PRIORITY FROM '.$dbtable.' WHERE bestellnum="'.$keyword.'"';
        		if($ergebnis=mysql_query($sql,$link))
				{
					//header ("location:apotheke-datenbank-functions-manage.php?sid=$ck_sid&from=deleteok");
					$deleteok=true;
				}
			//print $sql;
		} else print " Tabelle konnte nicht ausgewählt werden.";
	  mysql_close($link);
	}
  	 else 
		{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }
?>
