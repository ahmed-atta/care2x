<?
//print $g;
//if (($opfclic_rt!="timebar")||($op_pflegelogbuch_user=="")||($ck_comdat=="")) {header("Location: invalid-access-warning.php"); exit;}; 

parse_str($ck_comdat,$varia);
$fileforward="oplogtimebar.php?patnum=$varia[patnum]&op_nr=$varia[op_nr]&dept=$varia[dept]&saal=$varia[saal]&pyear=$varia[pyear]&pmonth=$varia[pmonth]&pday=$varia[pday]";
//print $g;
//print $fileforward;
switch($g)
{
	case "entry_out": $title="Einschleusse- Ausschleusezeiten";
							$element="entry_out";
							$startid="Ein";
							$endid="Aus";
							//$maxelement=10;
							break;
	case "cut_close": $title="Schnitt- Nahtzeiten";
							$element="cut_close";
							$startid="Schnitt";
							$endid="Naht";
							//$maxelement=10;
							break;

	case "wait_time": $title="Wartezeiten";
							$element="wait_time";
							//$maxelement=10;
							break;

	case "bandage_time": $title="Gipszeiten";
							$element="bandage_time";
							$startid="Anfang";
							$endid="Ende";
							//$maxelement=10;
							break;
	case "repos_time": $title="Repositionszeiten";
							$element="repos_time";
							$startid="Anfang";
							$endid="Ende";
							//$maxelement=10;
							break;
	default:{$element="encoding";}; 
}
//print $g;
require("../req/db_dbp.php");

$dbtable="nursing_op_logbook";

$link=mysql_connect($dbhost,$dbusername,$dbpassword);
 if ($link)
 {
	if(mysql_select_db($dbname,$link)) 
	{	
			// check if entry is already existing
				$sql="SELECT dept,op_date,op_nr,tid FROM $dbtable 
						WHERE 1";
				if($ergebnis=mysql_query($sql,$link))
       			{
					//print $sql." checked <br>";
					
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows)
						{
							mysql_data_seek($ergebnis,0);
							
							while($content=mysql_fetch_array($ergebnis))
							{
							// $dbuf=htmlspecialchars($dbuf);
							print $content[op_nr]."<p>";
							$sql="UPDATE $dbtable SET tid='$content[tid]',op_src_date='".substr($content[op_date],6,4).substr($content[op_date],3,2).substr($content[op_date],0,2)."'
										WHERE  op_nr='$content[op_nr]' AND dept='$content[dept]'";
											
							if(mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									//header("location:$thisfile?sid=$ck_sid&saved=1&patnum=$patnum&winid=$winid&dept=$dept&saal=$saal&op_nr=$op_nr&year=$pyear&pmonth=$pmonth&pday=$pday");
								}
								else
								{
									print "Patient ist noch nicht im Log Buch eingetragen. Bitte Schliessen Sie dieses Fenster
										und öffnen Sie das Log Buch wieder. Falls dieses weiterhin besteht, benachrichtigen
										Sie bitte die EDV Abteilung.";
									exit;
								}//end of else
							}
						
		 				}// end of if rows
		 				else
		 				{
							print $sql;
		 						print "Patient ist noch nicht im Log Buch eingetragen. Bitte Schliessen Sie dieses Fenster
										und öffnen Sie das Log Buch wieder. Falls dieses weiterhin besteht, benachrichtigen
										Sie bitte die EDV Abteilung.";
									exit;
							}
				
	 			}else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
	}else print "$db_table_noselect $sql<br>";
	mysql_close($link);
  } else { print "$db_noconnect $sql<br>"; }

?>
