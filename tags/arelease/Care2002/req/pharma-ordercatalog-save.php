<?php
// <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	$saveok=false;
	//$dbtable="pharma_ordercatalog_".$dept;
if($cat=="pharma") $dbtable="pharma_ordercatalog_".$dept;
	else $dbtable="med_ordercatalog_".$dept;

	//init db parameters
	$dbname="maho";
	$dbhost="localhost";
	$dbusername="httpd";
	$dbpassword="";
	
	//save actual data to  catalog

 	$link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{

		
				$sql="INSERT INTO ".$dbtable." 
						(	hit,
							artikelname,
							proorder,
							bestellnum ) 
						VALUES (
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
		} else print "$db_table_noselect<br>";
	  	mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect<br>"; }
?>
