<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?

//init db parameters
$dbname="maho";
$dbtable="pharma_ordercatalog_".$dept;
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";

//get actual catalog

 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{

		
				$sql='SELECT SQL_SMALL_RESULT * FROM '.$dbtable.' ORDER BY hit DESC';
        		$ergebnis=mysql_query($sql,$link);
				//count rows=linecount
				$rows=0;
				while ($content=mysql_fetch_array($ergebnis)) $rows++;					
				//reset result
				if($rows>0) mysql_data_seek($ergebnis,0);
	
			//print $sql;
		} else print "$db_table_noselect<br>";
	  mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect<br>"; }

?>
