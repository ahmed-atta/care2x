<?
//print $g;
//if (($opfclic_rt!="timebar")||($op_pflegelogbuch_user=="")||($ck_comdat=="")) {header("Location: invalid-access-warning.php"); exit;}; 

parse_str($ck_comdat,$varia);
$fileforward="oplogtimebar.php?patnum=$varia[patnum]&op_nr=$varia[op_nr]&dept=$varia[dept]&saal=$varia[saal]&pyear=$varia[pyear]&pmonth=$varia[pmonth]&pday=$varia[pday]&scrolltab=$v";
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
	default:{header("Location: invalid-access-warning.php?mode=close"); exit;}; 
}
//print $g;
require("../req/db_dbp.php");

$dbtable="nursing_op_logbook";

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
{	

			// check if entry is already existing
				$sql="SELECT tid,$element FROM $dbtable 
						WHERE patnum='$varia[patnum]' 
						AND dept='$varia[dept]' 
						AND op_room='$varia[saal]' 
						AND op_nr='$varia[op_nr]'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					//print $sql." checked <br>";
					
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows==1)
						{
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);
    						if((trim($content[$element])!="")&&($content[$element]!=NULL))
							{							
								//print "im here";
								$ebuf=explode("~",trim($content[$element]));

								sort($ebuf,SORT_REGULAR);
								$laste=(float) 0;
								$append=0;
								$vf=(float) $v;
								$esize=sizeof($ebuf);
								//print $v."<br>";
								for($i=0;$i<$esize;$i++)
								{
									parse_str(trim($ebuf[$i]),$elem);
									//if(!$elem[s]) continue;
									$sf=(float) $elem[s];
									$ef=(float) $elem[e];
									if($g=="wait_time")
									{
										if($sf==$vf)
										{ if($elem[e]==""){ array_splice($ebuf,$i,1);$append=0;break;}
										}
										if($ef==$vf)
										{
											if($elem[s]!="") {$ebuf[$i]="s=".$elem[s]."&e=&r=".$elem[r]; $append=0;break;}
										}
										if($elem[s]!="")
										{
									 		//if($vf>$sf)
											{ if (($elem[e]=="")||(($vf<$ef)&&($vf>$sf))) {$ebuf[$i]="s=".$elem[s]."&e=".$v."&r=".$elem[r];$append=0; break;}
											}
											//else{ $append=0; break;}
										}
										else{$ebuf[$i]="s=".$v."&e=&r=".$elem[r]; $append=0;break;}
										//if($ef>$laste)  $laste=$ef; $append=1;
									}
									else
									{
										//if(($v>$elem[s])&&($v<$elem[e])) break;
										if($sf==$vf)
										{ if($elem[e]==""){ array_splice($ebuf,$i,1);$append=0; if(!$i) $resetmainput=1;break;}
										}
										if($ef==$vf)
										{
											if($elem[s]!="") {$ebuf[$i]="s=".$elem[s]."&e="; $append=0; if(!$i) $resetmainput=1;break;}
										}
										if($elem[s]!="")
										{
									// 			if($vf>$sf)
											//print "its here in the elem";
											{ if (($elem[e]=="")||(($vf<$ef)&&($vf>$sf))) {$ebuf[$i]="s=".$elem[s]."&e=".$v;$append=0;  if(!$i) $resetmainput=1;break;}
											}
											//else{ $append=0; break;} 
											
										}
										else {$ebuf[$i]="s=".$v."&e="; $append=0; if(!$i) $resetmainput=1;break;}
									}
									if($ef>$laste) $laste=$ef; $append=1;
									//$laste=$ef; $append=1;
								}	//end of for $i
							
								if($append&&($vf>$laste)) 
								{
									if($g=="wait_time") $ebuf[]="s=$v&e=&r=-";
										else $ebuf[]="s=$v&e=";
								}
								sort($ebuf,SORT_REGULAR);
								$dbuf=implode("~",$ebuf);
								if($i==0) $resetmainput=1;
								//print $dbuf;
				 			}// end of if (sizeof (ebuf)
							else
							{
								if($g=="wait_time") $dbuf="s=$v&=&r=";
								 else $dbuf="s=$v&=";
								if(($g=="entry_out")||($g=="cut_close")) $resetmainput=1;
							}	
					 		// $dbuf=htmlspecialchars($dbuf);
							//print $dbuf;
							$sql="UPDATE $dbtable SET $element='$dbuf',tid='$content[tid]'
										WHERE patnum='$varia[patnum]'
											AND dept='$varia[dept]'
											AND op_room='$varia[saal]'
											AND op_nr='$varia[op_nr]'";
											
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									mysql_close($link);
									if((($g=="entry_out")||($g=="cut_close"))&&$resetmainput) header("Location: $fileforward&resetmainput=1");
 											else header("Location: $fileforward");									
									//header("location:$thisfile?sid=$ck_sid&saved=1&patnum=$patnum&winid=$winid&dept=$dept&saal=$saal&op_nr=$op_nr&year=$pyear&pmonth=$pmonth&pday=$pday");
								}
								else
								{
									print "Patient ist noch nicht im Log Buch eingetragen. Bitte Schliessen Sie dieses Fenster
										und öffnen Sie das Log Buch wieder. Falls dieses weiterhin besteht, benachrichtigen
										Sie bitte die EDV Abteilung.";
									exit;
								}//end of else
						
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

  } else { print "$db_noconnect $sql<br>"; }

header("Location: $fileforward");
?>
