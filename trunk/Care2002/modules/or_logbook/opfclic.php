<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
parse_str($ck_comdat,$varia);
$fileforward="oplogtimebar.php?sid=$sid&lang=$lang&enc_nr=".$varia['enc_nr']."&op_nr=".$varia['op_nr']."&dept_nr=".$varia['dept_nr']."&saal=".$varia['saal']."&pyear=".$varia['pyear']."&pmonth=".$varia['pmonth']."&pday=".$varia['pday']."&scrolltab=$time";
//echo $g;
//echo $fileforward;
$g=$group;
$v=$time;
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
//echo $g;
$dbtable='care_nursing_op_logbook';

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	
			// check if entry is already existing
				$sql="SELECT $element FROM $dbtable 
						WHERE encounter_nr='".$varia['enc_nr']."' 
						AND dept_nr='".$varia['dept_nr']."' 
						AND op_room='".$varia['saal']."' 
						AND op_nr='".$varia['op_nr']."'";
				if($ergebnis=$db->Execute($sql))
       			{
					//echo $sql." checked <br>";
					
					$rows=$ergebnis->RecordCount();
					if($rows==1)
						{
							$content=$ergebnis->FetchRow();
    						if((trim($content[$element])!="")&&($content[$element]!=NULL))
							{							
								//echo "im here";
								//echo $content[$element];
								$ebuf=explode("~",trim($content[$element]));

								sort($ebuf,SORT_REGULAR);
								$laste=(float) 0;
								$append=0;
								//echo $v."<br>";
								$vf=(float) $v;
								$esize=sizeof($ebuf);
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
											//echo "its here in the elem";
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
								//echo $dbuf;
				 			}// end of if (sizeof (ebuf)
							else
							{
								if($g=="wait_time") $dbuf="s=$v&=&r=";
								 else $dbuf="s=$v&=";
								if(($g=="entry_out")||($g=="cut_close")) $resetmainput=1;
							}	
					 		// $dbuf=htmlspecialchars($dbuf);
							//echo $dbuf;
							$sql="UPDATE $dbtable SET $element='$dbuf'
										WHERE encounter_nr='".$varia['enc_nr']."'
										AND dept_nr='".$varia['dept_nr']."' 
										AND op_room='".$varia['saal']."' 
										AND op_nr='".$varia['op_nr']."'";
											
							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new update <br> resetmain= $resetmainput";
									
									//if((($g=="entry_out")||($g=="cut_close"))&&$resetmainput) header("Location: $fileforward&resetmainput=1");
 											//else header("Location: $fileforward");									
									header("Location: $fileforward&resetmainput=$resetmainput");
									exit;
								}
								else
								{
									echo "Patient ist noch nicht im Log Buch eingetragen. Bitte Schliessen Sie dieses Fenster
										und öffnen Sie das Log Buch wieder. Falls dieses weiterhin besteht, benachrichtigen
										Sie bitte die EDV Abteilung.";
									exit;
								}//end of else
						
		 				}// end of if rows
		 				else
		 				{
							echo $sql;
		 						echo "Patient ist noch nicht im Log Buch eingetragen. Bitte Schliessen Sie dieses Fenster
										und öffnen Sie das Log Buch wieder. Falls dieses weiterhin besteht, benachrichtigen
										Sie bitte die EDV Abteilung.";
									exit;
							}
				
	 			}else echo "<p>".$sql."<p>$LDDbNoRead"; 

  } else { echo "$LDDbNoLink $sql<br>"; }
header("Location: $fileforward");
?>
