<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
if($ck_language!="") $lang="../language/".$ck_language."-lang.php";
	else $lang="../language/english-lang.php"; // if no language cookie set to english

require($lang);

//init db parameters
$dbname="maho";
$dbtable="pharma_products_main";
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
//clean input data
$keyword=trim($keyword);

//this is the search module
if((($mode=="search")||$update)&&($keyword!="")) 
{
 $link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{

			if($update)
			{
				$sql='SELECT SQL_SMALL_RESULT * FROM '.$dbtable.' WHERE  bestellnum="'.$keyword.'"';
        		$ergebnis=mysql_query($sql,$link);
				//count rows=linecount
				$linecount=0;
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;					
				//reset result
				if($linecount>0) mysql_data_seek($ergebnis,0);
			}
			else
			{
				$sql='SELECT * FROM '.$dbtable.' WHERE  bestellnum="'.$keyword.'" 
						OR artikelnum LIKE "'.$keyword.'" 
						OR industrynum LIKE "'.$keyword.'" 
						OR artikelname LIKE "'.$keyword.'"
						OR generic LIKE "'.$keyword.'"
						OR description LIKE "'.$keyword.'"';
				
        		$ergebnis=mysql_query($sql,$link);
				//count rows=linecount
				$linecount=0;
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;					
				//reset result
				if($linecount>0) mysql_data_seek($ergebnis,0);
				else
				{
						$sql='SELECT * FROM '.$dbtable.' WHERE  bestellnum LIKE "'.$keyword.'%" 
						OR artikelnum LIKE "'.$keyword.'%" 
						OR industrynum LIKE "'.$keyword.'%" 
						OR artikelname LIKE "'.$keyword.'%"
						OR generic LIKE "'.$keyword.'%"
						OR description LIKE "'.$keyword.'%"';
				
        				$ergebnis=mysql_query($sql,$link);
						//count rows=linecount
						$linecount=0;
						while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
						if($linecount>0) mysql_data_seek($ergebnis,0);
				}
			} //end of if $update else				

			//print $sql;
		} else print "$db_table_noselect<br>";
	//if parent is order catalog
	if(($linecount==1)&&($bcat))
		{
			$ttl=mysql_fetch_array($ergebnis);
			mysql_data_seek($ergebnis,0);
			$title_art=$ttl[artikelname];
		}
	mysql_close($link);
	}
  	 else 
		{ print "$db_noconnect<br>"; }


// print "from table ".$linecount;
}

?>
