<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_products_search_mod.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/**
* CARE 2002 Integrated Hospital Information System
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
if($cat=='pharma') $dbtable='care_pharma_products_main';
	else $dbtable='care_med_products_main';
//clean input data
$keyword=addslashes(trim($keyword));

//this is the search module
if((($mode=='search')||$update)&&($keyword!='')) 
{
//init db parameters
	include('../include/inc_db_makelink.php');
 	if($link&&$DBLink_OK)
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
				//print $sql;
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
	//if parent is order catalog
		if(($linecount==1)&&($bcat))
		{
			$ttl=mysql_fetch_array($ergebnis);
			mysql_data_seek($ergebnis,0);
			$title_art=$ttl[artikelname];
		}
	}
// print "from table ".$linecount;
}

?>
