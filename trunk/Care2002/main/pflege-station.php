<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_WARNING);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

function flagPatientAtStation($pn,$at=1,$stat='')
{
    global $link;
	
	if($stat=='' || !$stat)
	{
	   $sql='UPDATE care_admission_patient SET at_station=\''.$at.'\' WHERE patnum=\''.$pn.'\'';
	}
	else
	{
	   $sql='UPDATE care_admission_patient SET station=\''.$stat.'\', at_station=\''.$at.'\' WHERE patnum=\''.$pn.'\'';
    }
	
	if($ergebnis=mysql_query($sql,$link)) 
	{
	    return 1;
	}
	else
	{
	    return 0;
	}
}

define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require_once('../include/inc_front_chain_lang.php');
if(!$HTTP_COOKIE_VARS[$local_user.$sid]) 
{
    $edit=0;
	include("../language/".$lang."/lang_".$lang."_".LANG_FILE);
}
require_once('../include/inc_config_color.php');

/**
* Set default values if not available from url
*/
if (!isset($station)||$station=="") { $station="p3a";} // default station must be set here !!
if(!isset($pday)||$pday=="") $pday=date('d');
if(!isset($pmonth)||$pmonth=="") $pmonth=date('m');
if(!isset($pyear)||$pyear=="") $pyear=date('Y');
$s_date=$pyear."-".$pmonth."-".$pday;

/* Check whether the content is language dependent and set the lang appendix */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $lang_append=' AND lang=\''.$lang.'\'';
}
else 
{
    $lang_append='';
}

if(!isset($mode)) $mode="";

if(isset($retpath)&&$retpath=="quick") $breakfile="pflege-schnellsicht.php?sid=".$sid."&lang=".$lang;
 else $breakfile="pflege.php?sid=".$sid."&lang=".$lang;
			
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
{
    /* Load date formatter */
    include_once('../include/inc_date_format_functions.php');
    
    
	/* Load editor functions */
    //include_once('../include/inc_editor_fx.php');
  
			if(($mode=='')||($mode=='fresh'))
			{
						    $dbtable='care_nursing_station_patients';

					        $sql='SELECT *	FROM '.$dbtable.' WHERE  s_date=\''.$s_date.'\'	AND	station=\''.$station.'\''.$lang_append;

							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=mysql_num_rows($ergebnis);
								if($rows)
								{
									$result=mysql_fetch_array($ergebnis);
									$occup='ja';
									$dept=$result['dept'];
					 			}
								else
								{
									$dbtable='care_nursing_station';
									
									$sql='SELECT * FROM '.$dbtable.' WHERE station=\''.$station.'\''.$lang_append;

									$ergebnis=mysql_query($sql,$link);
									if($ergebnis)
       								{
										$rows=mysql_num_rows($ergebnis);
										if($rows)
										{
											$result=mysql_fetch_array($ergebnis);
											$occup='template';
											if(!$result['maxbed']) $result['maxbed']=($result['end_no']-$result['start_no'])*$result['bedtype'];
											$dept=$result['dept'];
					 					}
										else
										{
											$occup="?";
										}
									}
								}
							}
				 			else {echo "<p>".$sql."<p>$LDDbNoRead"; }
			}
			else
			switch($mode)
			{	
				
        		case "getlast": 
							
							$dbtable='care_nursing_station_patients';
							
							$ed=gregoriantojd(date('m'),date('d'),date('Y'))-31; 
							$ed=jdtogregorian($ed);
							$buff=explode("/",$ed);
							if($buff[0]<10) $buff[0]="0".$buff[0];
							if($buff[1]<10) $buff[1]="0".$buff[1];
							$ed=$buff[2]."-".$buff[0]."-".$buff[1];
							$s_date=$pyear.'-'.$pmonth.'-'.$pday;	 
							
							$sql='SELECT *	FROM '.$dbtable.' WHERE s_date<=\''.$s_date.'\'
																		AND s_date >=\''.$ed.'\' 
																		AND	station=\''.$station.'\'
																		'.$lang_append.'
																		ORDER BY s_date DESC';
																		
							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=mysql_num_rows($ergebnis);
								if($rows)
								{
									$result=mysql_fetch_array($ergebnis);
									$occup="last";
									// get the day difference
									$today=gregoriantojd(date('m'),date('d'),date('Y'));
									$buf=explode("-",$result['s_date']);
									$ld=gregoriantojd($buf[1],$buf[2],$buf[0]);
									$c=$today-$ld;
									// change the date 
									$pday=$buf[2];
									$pmonth=$buf[1];
									$pyear=$buf[0];
									$s_date=$pyear."-".$pmonth."-".$pday;
									//echo $c;
									$dept=$result['dept'];
					 			}
								else
								{  
							//echo "it is checked but no rows ".$sql;
									mysql_close($link);
									//echo "location:pflege-station-nobelegungsliste.php?sid=$sid&lang=$lang&station=$station&c=32&edit=$edit";
									header ("location:pflege-station-nobelegungsliste.php?sid=$sid&lang=$lang&station=$station&c=32&edit=$edit"); 
									exit; 
								}
							}
				 			else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						break;
				case "copylast":
							$dbtable='care_nursing_station_patients';
							$sql='SELECT *	FROM '.$dbtable.' WHERE s_date=\''.$s_date.'\'  AND	station=\''.$station.'\''.$lang_append;
							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=mysql_num_rows($ergebnis);
								if($rows)
								{
									$result=mysql_fetch_array($ergebnis);
									//echo $b_p;
									// create new occupancy table
									$sql="INSERT INTO ".$dbtable." 
											(
											    lang,		    		 station,		  dept,
												s_date,				   info,			  start_no,
												end_no,				  bedtype,		  roomprefix,
												bed_id1,			  bed_id2,		  maxbed,
												freebed,			  closedbeds,	 usedbed,
												usebed_percent,	 bed_patient,   create_id,
												create_time
											)
											VALUES
											(
											    '".$lang."',				'".$station."',      	'".$result['dept']."',
												'".date('Y-m-d')."',	'".$result['info']."',   '".$result['start_no']."',
												'".$result['end_no']."','".$result['bedtype']."','".$result['roomprefix']."',
												'".$result['bed_id1']."','".$result['bed_id2']."','".$result['maxbed']."',
												'".$result['freebed']."','".$result['closedbeds']."','".$result['usedbed']."',
												'".$result['usebed_percent']."','".addslashes($result['bed_patient'])."','".$HTTP_COOKIE_VARS[$local_user.$sid]."',
												NULL
											)";
									if($ergebnis=mysql_query($sql,$link)) 
										{
											mysql_close($link);
											$pday=date('d');
											$pmonth=date('m');
											$pyear=date('Y');
											header("location:pflege-station.php?sid=".$sid."&lang=".$lang."&station=".$station."&mode=&edit=1&pday=".$pday."&pmonth=".$pmonth."&pyear=".$pyear);
											exit;
										}
										else echo $LDDbNoSave."<br>".$sql;
					 			} else echo $LDDbNoLastData."<br>".$sql;
						} else {echo $sql."<br>".$LDDbNoRead; exit;}
						break;
				case "newdata": 
						if(($patnum=='lock')||($patnum=='unlock'))
							{
														$dbtable='care_nursing_station_patients';
														
														// check if station occupancy exists
                                                    	$sql='SELECT bed_patient, maxbed, freebed, closedbeds, usedbed
														          FROM '.$dbtable.' WHERE s_date=\''.$s_date.'\' AND station=\''.$station.'\''.$lang_append;	
																  																
														if($ergebnis=mysql_query($sql,$link))
       													{
															$rows=mysql_num_rows($ergebnis);
															if($rows)
															{
																$result=mysql_fetch_array($ergebnis);
																// update the existing occupancy table
																// s = l means locked
																if($patnum=="lock")
																{
																	$b_p=$result[bed_patient]."_r=$rm&b=$bd&n=!&s=l\r\n";
																	$sql="UPDATE $dbtable SET bed_patient='".addslashes($b_p)."', 
																									 freebed='".($result[freebed]-1)."',
																									 closedbeds='".($result[closedbeds]+1)."',
																									 usebed_percent='".ceil((($result[usedbed]+$result[closedbeds]+1)/$result[maxbed])*100)."',
																									 modify_id='".$HTTP_COOKIE_VARS[$local_user.$sid]."' 
																									  WHERE s_date='$s_date' AND station='$station'".$lang_append;
																}
																else
																{
																	$b_p=str_replace("_r=$rm&b=".strtolower($bd)."&n=!&s=l","",$result[bed_patient]);
																	$sql="UPDATE $dbtable SET bed_patient='".addslashes($b_p)."', 
																									 freebed='".($result[freebed]+1)."',
																									 closedbeds='".($result[closedbeds]-1)."',
																									 usebed_percent='".ceil((($result[usedbed]+$result[closedbeds]-1)/$result[maxbed])*100)."',
																									 modify_id='".$HTTP_COOKIE_VARS[$local_user.$sid]."' 
																									  WHERE s_date='$s_date' AND station='$station'".$lang_append;
																}
																if($ergebnis=mysql_query($sql,$link)) 
																		{
																			mysql_close($link);
																			header("location:pflege-station.php?sid=$sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
																			exit;
																		}
																		else echo "$LDDbNoUpdate $sql";
															}
															else
															{  
																$dbtable='care_nursing_station';
																
																$sql='SELECT * FROM '.$dbtable.' WHERE station=\''.$station.'\''.$lang_append;
																if($ergebnis=mysql_query($sql,$link))
       															{
																	$rows=mysql_num_rows($ergebnis);
																	if($rows)
																	{
																		$template=mysql_fetch_array($ergebnis);
																		$s_date=$pyear."-".$pmonth."-".$pday;
																		$b_p="_r=$rm&b=$bd&n=!&s=l\r\n";
																		//echo $b_p;
																		
																		/* create new occupancy table*/
																		
																		$dbtable='care_nursing_station_patients';
																		
																		if(!$template[maxbed]) $template[maxbed]=($template[end_no]-$template[start_no])*$template[bedtype];
																		$sql="INSERT INTO $dbtable 
																					(
																					    lang,
																						station,
																						dept,
																						s_date,
																						start_no,
																						end_no,
																						bedtype,
																						roomprefix,
																						bed_id1,
																						bed_id2,
																						maxbed,
																						freebed,
																						closedbeds,
																						usedbed,
																						usebed_percent,
																						bed_patient,
																						create_id,
																						create_time
																					)
																					VALUES
																					(
																					    '$lang',
																						'$station',
																						'$template[dept]',
																						'$s_date',
																						'$template[start_no]',
																						'$template[end_no]',
																						'$template[bedtype]',
																						'$template[roomprefix]',
																						'$template[bed_id1]',
																						'$template[bed_id2]',
																						'$template[maxbed]',
																						'".($template[maxbed]-1)."',
																						'1',
																						'0',
																						'".ceil((1/$template[maxbed])*100)."',
																						'$b_p',
																						'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
																						NULL
																					)";
																		if($ergebnis=mysql_query($sql,$link)) 
																		{
																		
																			mysql_close($link);
																			header("location:pflege-station.php?sid=$sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
																			exit;
																		}
																		else echo "$LDDbNoSave<br>$sql";
					 												}
																	else
																	{  
																		echo str_replace("~station~",$station,$LDTemplateMissing);
																	}
																}
				 												else {echo "<p>".$sql."<p>$LDDbNoRead"; exit;}
																// update the existing occupancy table
					 										}

														}
				 										else {echo "<p>".$sql."<p>$LDDbNoRead"; exit;}
							}
							else
							{
												/* fetch the orig data*/
												$dbtable='care_admission_patient';
												
												$sql='SELECT patnum, title, name, vorname, gebdatum, sex, kasse FROM '.$dbtable.'
															WHERE patnum=\''.$patnum.'\'';
															
												if($ergebnis=mysql_query($sql,$link))
       											{
												$rows=0;
												while( $dbdata=mysql_fetch_array($ergebnis)) $rows++;
												if($rows)
													{
														mysql_data_seek($ergebnis,0);
														$dbdata=mysql_fetch_array($ergebnis);
														//foreach($dbdata as $v) echo $v;
														
														$dbtable='care_nursing_station_patients';
														
														/* check if station occupancy exists*/
                                                    	$sql='SELECT bed_patient, maxbed, freebed, usedbed, closedbeds,roomprefix FROM '.$dbtable.' WHERE s_date=\''.$s_date.'\' AND station=\''.$station.'\''.$lang_append;																	
														if($ergebnis=mysql_query($sql,$link))
       													{
															$rows=mysql_num_rows($ergebnis);
															if($rows)
															{
																$result=mysql_fetch_array($ergebnis);
																// update the existing occupancy table
																if(trim($result['bed_patient'])=="") 
																	$b_p="r=".$rm."&b=".$bd."&n=".$dbdata['patnum']."&t=".$dbdata['title']."&ln=".strtr($dbdata['name']," ","+")."&fn=".strtr($dbdata['vorname']," ","+")."&g=".$dbdata['gebdatum']."&s=".$dbdata['sex']."&k=".$dbdata['kasse']."&rem=\r\n";
																else
																	$b_p=$result['bed_patient']."_r=".$rm."&b=".$bd."&n=".$dbdata['patnum']."&t=".$dbdata['title']."&ln=".strtr($dbdata['name']," ","+")."&fn=".strtr($dbdata['vorname']," ","+")."&g=".$dbdata['gebdatum']."&s=".$dbdata['sex']."&k=".$dbdata['kasse']."&rem=\r\n";
																
																$used=$result['usedbed']+1;
																
																$sql="UPDATE $dbtable SET bed_patient='".addslashes($b_p)."', 
																									 freebed='".($result['freebed']-1)."',
																									 usedbed='$used',
																									 usebed_percent='".ceil((($used+$result['closedbeds'])/$result['maxbed'])*100)."',
																									 modify_id='".$HTTP_COOKIE_VARS[$local_user.$sid]."' 
																									  WHERE s_date='$s_date' AND station='$station'".$lang_append;
																									  
																if($ergebnis=mysql_query($sql,$link)) 
																		{
/*																			$sql="UPDATE care_admission_patient SET station='".$station."', at_station=1 WHERE patnum='".$patnum."'";
																			
																			mysql_query($sql,$link);
*/																			
                                                                            flagPatientAtStation($patnum,1,$station);
																			
																			header("location:pflege-station.php?sid=".$sid."&lang=".$lang."&station=".$station."&edit=1&mode=&pday=".$pday."&pmonth=".$pmonth."&pyear=".$pyear);
																			//mysql_close($link);
																			exit;
																		}
																		else echo "$LDDbNoUpdate<br>$sql";
					 										}
															else
															{  
																$dbtable='care_nursing_station';
																
																$sql='SELECT * FROM '.$dbtable.' WHERE station=\''.$station.'\''.$lang_append;
																
																if($ergebnis=mysql_query($sql,$link))
       															{
																	$rows=mysql_num_rows($ergebnis);
																	if($rows)
																	{
																		$template=mysql_fetch_array($ergebnis);
																		
																		$s_date=$pyear."-".$pmonth."-".$pday;
																		$b_p="r=".$rm."&b=".$bd."&n=".$dbdata['patnum']."&t=".$dbdata['title']."&ln=".strtr($dbdata['name']," ","+")."&fn=".strtr($dbdata['vorname']," ","+")."&g=".$dbdata['gebdatum']."&s=".$dbdata['sex']."&k=".$dbdata['kasse']."&rem=\r\n";
																		//echo $b_p;
																		
																		/* create new occupancy table*/
																		$dbtable='care_nursing_station_patients';
																		
																		if(!$template['maxbed']) $template['maxbed']=($template['end_no']-($template['start_no']-1))*$template['bedtype'];
																		
																		$sql="INSERT INTO $dbtable 
																					(
																					    lang,
																						station,
																						dept,
																						s_date,
																						start_no,
																						end_no,
																						bedtype,
																						roomprefix,
																						bed_id1,
																						bed_id2,
																						maxbed,
																						freebed,
																						closedbeds,
																						usedbed,
																						usebed_percent,
																						bed_patient,
																						create_id,
																					    create_time
																					)
																					VALUES
																					(
																					    '".$lang."',
																						'".$station."',
																						'".$template['dept']."',
																						'".$s_date."',
																						'".$template['start_no']."',
																						'".$template['end_no']."',
																						'".$template['bedtype']."',
																						'".$template['roomprefix']."',
																						'".$template['bed_id1']."',
																						'".$template['bed_id2']."',
																						'".$template['maxbed']."',
																						'".($template['maxbed']-1)."',
																						'".$template['closedbeds']."',
																						'1',
																						'".ceil((1/$template['maxbed'])*100)."',
																						'".$b_p."',
																						'".$HTTP_COOKIE_VARS[$local_user.$sid]."',
																						NULL
																					)";
																		if($ergebnis=mysql_query($sql,$link)) 
																		{
																		    
																			flagPatientAtStation($dbdata['patnum'],1,$station);
																		    
																			header("location:pflege-station.php?sid=$sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
																			mysql_close($link);
																			exit;
																		}
																		else echo "$LDDbNoSave<br>$sql";
					 												}
																	else
																	{  
																		echo str_replace("~station~",$station,$LDTemplateMissing);
																	}
																}
				 												else {echo "<p>".$sql."<p>$LDDbNoRead"; exit;}
																// update the existing occupancy table
					 										}
														}
				 										else {echo "<p>".$sql."<p>$LDDbNoRead"; exit;}
					 								}
													else
													{  
														echo"$LDNoOrigData<br>$sql";
													}
												}
				 								else {echo "<p>".$sql."<p>$LDDbNoRead"; exit;}
							}
							break;
							
				case "delete":
				
						$dbtable='care_nursing_station_patients';
						
						/* check if station occupancy exists */
                       $sql='SELECT bed_patient, maxbed, freebed, usedbed FROM '.$dbtable.' WHERE s_date=\''.$s_date.'\' AND station=\''.$station.'\''.$lang_append;																	
						
						if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=mysql_num_rows($ergebnis);
								if($rows==1)
									{
										$rm="r=$rm&b=$bd";//echo "$rm<br>";
										$result=mysql_fetch_array($ergebnis);
										$buf=explode("_",$result['bed_patient']);
										for($i=0;$i<sizeof($buf);$i++)
											{
												//echo $buf[$i];
												if(substr_count(trim($buf[$i]),$rm))
													{ array_splice($buf,$i,1); break; }
											}
										$result[bed_patient]=implode("_",$buf);
										$used=$result[usedbed]-1;
										
										$sql="UPDATE $dbtable SET bed_patient='$result[bed_patient]',
														freebed='".($result['freebed']+1)."',
														usedbed='$used',
														usebed_percent='".ceil((($used+$result['closedbeds'])/$result['maxbed'])*100)."' 
														WHERE s_date='$s_date' AND station='$station'".$lang_append;
														
										if($ergebnis=mysql_query($sql,$link)) 
											{
												mysql_close($link);
												header("location:pflege-station.php?sid=$sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
												exit;
											}
											else echo "$LDDbNoDelete<br>$sql";
									}
							} else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						break;
				}// end of switch ($mode)
				
				/* translate station to dept*/
			if(!$dept)
			{
				$dbtable='care_station2dept';
				
				$sql='SELECT dept 	FROM '.$dbtable.' WHERE station LIKE \'%'.$station.'%\' AND op=0';
				//echo $sql."<br>";
				$s2dresult=mysql_query($sql,$link);
				$stat2dept=mysql_fetch_array($s2dresult);
				$dept=$stat2dept['dept'];
			}
			
			/* now get the doctor on duty */
			$dbtable='care_doctors_dutyplan';
			
			$sql='SELECT a_dutyplan,r_dutyplan 	FROM '.$dbtable.' WHERE dept=\''.$dept.'\' AND year=\''.(int)$pyear.'\' AND month=\''.(int)$pmonth.'\'';
			//echo $sql;
			$docslist=mysql_query($sql,$link);
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
  var urlholder;

function getinfo(pid,pdata){
<?php /* if($edit)*/
	{ echo '
	urlholder="pflege-station-patientdaten.php?sid=';
	echo "$sid&lang=$lang";
	echo '&pn="+pid+"&patient=" + pdata + "&station=';
	echo "$station&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit"; 
	echo '";';
	echo '
	patientwin=window.open(urlholder,pid,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	';
	}
	/*else echo '
	window.location.href=\'pflege-station-pass.php?sid='.$sid.'&lang='.$lang.'&rt=pflege&edit=1&station='.$station.'\'';*/
?>
	}
function getrem(pid,pdata){
	urlholder="pflege-station-remarks.php?sid=<?php echo "$sid&lang=$lang"; ?>&pn="+pid+"&patient=" + pdata + "&station=<?php echo "$station&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}
	
function indata(room,bed)
{
	urlholder="pflege-station-bettbelegen.php?sid=<?php echo "$sid&lang=$lang"; ?>&s=<?php echo $station; ?>&rm="+room+"&bd="+bed+"<?php echo "&py=".$pyear."&pm=".$pmonth."&pd=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>";
	indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
}
function release(room,bed,pid)
{
	urlholder="pflege-station-patient-release.php?sid=<?php echo "$sid&lang=$lang"; ?>&station=<?php echo $station; ?>&rm="+room+"&bd="+bed+"&pn="+pid+"<?php echo "&pyear=".$pyear."&pmonth=".$pmonth."&pday=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>";
	//indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes"
	window.location.href=urlholder;
}

function unlock(b,r)
{
<?php
	echo '
	urlholder="pflege-station.php?mode=newdata&patnum=unlock&sid='.$sid.'&lang='.$lang.'&station='.$station.'&rm="+r+"&bd="+b+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'";
	';
?>
	if(confirm('<?php echo $LDConfirmUnlock ?>'))
	{
		window.location.replace(urlholder);
	}
}
function deletePatient(r,b,t,n)
{
	if(confirm("<?php echo $LDConfirmDelete ?>"))
	{
		url="pflege-station.php?sid=<?php echo "$sid&lang=$lang&station=$station&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&mode=delete&rm="+r+"&bd="+b;
		window.location.replace(url);
	}
}

function popinfo(l,f,b)
{
	w=window.screen.width;
	h=window.screen.height;
	ww=400;
	wh=400;
	urlholder="doctors-dienstplan-popinfo.php?<?php echo "sid=$sid&dept=$dept&lang=$lang" ?>&ln="+l+"&fn="+f+"&bd="+b;
	
	infowin=window.open(urlholder,"infowin","width=" + ww + ",height=" + wh +",menubar=no,resizable=yes,scrollbars=yes");
	window.infowin.moveTo((w/2)-(ww/2),(h/2)-(wh/2));

}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require('../include/inc_checkdate_lang.php'); ?>

// -->
</script>

<script language="javascript" src="../js/setdatetime.js"></script>

<script language="javascript" src="../js/checkdate.js"></script>

<?php
require('../include/inc_css_a_hilitebu.php');
?>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=3  FACE="Arial"><STRONG> &nbsp;&nbsp; <?php echo "$LDStation  ".strtoupper($station)." $LDOccupancy (".formatDate2Local($s_date,$date_format,'','',$null='').")" ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('nursing_station.php','<?php echo $mode ?>','<?php echo $occup ?>','<?php echo $station ?>','<?php echo "$LDStation" ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<?php
if(($occup=="template")&&(!$mode)&&(!isset($list)||!$list))
		 	{
			 echo'<font face="verdana,arial" size="2" >'.$LDNoListYet.'<br>
			 <form action="pflege-station.php" method=post>
			<input type="hidden" name="sid" value="'.$sid.'">
   			<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="pyear" value="'.$pyear.'">
 			<input type="hidden" name="pmonth" value="'.$pmonth.'">
  			<input type="hidden" name="pday" value="'.$pday.'">
			<input type="hidden" name="station" value="'.$station.'">
			<input type="hidden" name="mode" value="getlast">
			<input type="hidden" name="c" value="1">       
			<input type="hidden" name="edit" value="'.$edit.'">
   			<input type="submit" value="'.$LDShowLastList.'" >
 			</form>';
			}
		else if($mode=="getlast")
			{
			echo'
			<font face="verdana,arial" size="2" >'.$LDLastList;
			if($c>2) echo '<font color=red><b>'.$LDNotToday.'</b></font><br>'.str_replace("~nr~",$c,$LDListFrom);
				else echo '<font color=red><b>'.$LDFromYesterday.'</b></font><br>
				';
			echo '
			</font>
			<form action="pflege-station.php" method=post>
			<input type="hidden" name="sid" value="'.$sid.'">
    		<input type="hidden" name="lang" value="'.$lang.'">
  			<input type="hidden" name="pyear" value="'.$pyear.'">
 			<input type="hidden" name="pmonth" value="'.$pmonth.'">
  			<input type="hidden" name="pday" value="'.$pday.'">
			<input type="hidden" name="station" value="'.$station.'">
			<input type="hidden" name="mode" value="copylast">&nbsp;&nbsp;&nbsp;';
			if($c>2) echo '<input type="submit" value="'.$LDCopyAnyway.'">';
			else echo '
   			<input type="submit" value="'.$LDTakeoverList.'" >
				';
			echo '
			&nbsp;&nbsp;&nbsp;<input type="button" value="'.$LDDoNotCopy.'" onClick="javascript:window.location.href=\'pflege-station.php?sid='.$sid.'&edit=1&list=1&station='.$station.'&mode=fresh\'">
 			</form>
				';		
			}
//echo $statdata[$bd.$rm];

if($occup!="?")
{

if($pday.$pmonth.$pyear<date('dmY'))
	{
	 echo '
	<font face="verdana,arial" size="2"><img '.createComIcon('../','warn.gif','0','absmiddle').'> <font color="#ff0000"><b>'.$LDAttention.'</font> '.$LDOldList.'</b></font> ';
	$edit=0;
	}

//echo $result[bed_patient];
if(isset($result['bed_patient']))
{
  $buf=explode("_",trim($result['bed_patient']));
  $m=substr_count($result['bed_patient'],"s=m");
  $f=substr_count($result['bed_patient'],"s=f");
 
}
else
{
  $buf="";
  $m="";
  $f="";
  $result['usedbed']="";
  $result['freebed']="";
  $result['usebed_percent']="";
  $result['closedbeds']="";
}

echo '
<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" align=right>
<tr>
<td>

<table  cellspacing=0 cellpadding=2 align=right>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b>'.$LDQuickInformer.'</b>
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDOccupied.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$result['usedbed'].'</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;
</td>
<td bgcolor="#ffffcc" class="vn">'.$result['usebed_percent'].'%</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDFree.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$result['freebed'].'</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDLocked.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$result['closedbeds'].'</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDShortMale.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$m.'</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDShortFemale.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$f.'</td> 
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align="right" valign="top">
&nbsp;<nobr>'.$LDDutyDoctor.':</nobr>
</td>
<td bgcolor="#ffffcc" class="vn">';
//echo $dept;
// display the doctors on duty if available
$doctors=mysql_fetch_array($docslist);
if($doctors)
{
	$a_doctors=explode("~",$doctors['a_dutyplan']);
	$r_doctors=explode("~",$doctors['r_dutyplan']);
	parse_str($a_doctors[($pday-1)],$parsed_a);
	parse_str($r_doctors[($pday-1)],$parsed_r);
	if(sizeof($parsed_a))	echo '<a href="javascript:popinfo(\''.$parsed_a['l'].'\',\''.$parsed_a['f'].'\',\''.$parsed_a['b'].'\')" title="'.$LDClk4Phone.'">'.$parsed_a['l'].'</a><br>';
	if(sizeof($parsed_r))	echo '<a href="javascript:popinfo(\''.$parsed_r['l'].'\',\''.$parsed_r['f'].'\',\''.$parsed_r['b'].'\')" title="'.$LDClk4Phone.'">'.$parsed_r['l'].'</a><br>';
}

echo '
</td> 
</tr>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b>'.$LDLegend.'</b>
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" colspan=2 >';
if($edit) echo '
&nbsp;<img '.createComIcon('../','open.gif','0','absmiddle').'> <b>'.$LDOpenFile.'</b><br>
&nbsp;<img '.createComIcon('../','bubble2.gif','0','absmiddle').'> <b>'.$LDNotesEmpty.'</b><br>
&nbsp;<img '.createComIcon('../','bubble3.gif','0','absmiddle').'> <b>'.$LDNotes.'</b><br>
&nbsp;<img '.createComIcon('../','bestell.gif','0','absmiddle').'> <b>'.$LDRelease.'</b><br>
&nbsp;<img '.createComIcon('../','plus2.gif','0','absmiddle').'> <b>'.$LDFreeOccupy.'</b><br>
';
echo '
&nbsp;<img '.createComIcon('../','delete2.gif','0','absmiddle').'> <b>'.$LDLocked.'</b><br>
&nbsp;<img '.createComIcon('../','mans-red.gif','0','absmiddle').'> <b>'.$LDFemale.'</b><br>
&nbsp;<img '.createComIcon('../','mans-gr.gif','0','absmiddle').'> <b>'.$LDMale.'</b><br>
</td>

</tr>
</table>

</td>
</tr>
</table>
';
	
echo '<table  cellpadding="0" cellspacing=0 border="0" >';

echo '<tr bgcolor="#0000dd" align=center>
		<td>&nbsp;</td>';

for($n=0;$n<sizeof($LDPatListElements);$n++)
echo'
<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDPatListElements[$n].' &nbsp;&nbsp;</b></td>';
echo '</tr>';


//foreach($buf as $v) echo $v;
for ($i=$result['start_no'];$i<=$result['end_no'];$i++)
 {
   for($j=$result['bed_id1'];$j<=$result['bed_id2'];$j++)
	{
	
		for($k=0;$k<sizeof($buf);$k++)
		{
			parse_str(trim($buf[$k]),$helper);
			//foreach($helper as $v) echo $v;
			if  (isset($helper['r'])&&($helper['r']==$i)&&($helper['b']==$j))  break; 
			$helper="";
		}	
		
	echo '
			<tr bgcolor=';
	if ($j=="a") echo '"#fefefe">'; else echo '"#dfdfdf">';
	
	echo '
			<td>';
	if($helper&&($helper['s']!="l")&&$edit)
	{  
	     
		 echo '<a href="javascript:getinfo(\''.$helper['n'].'\',\''.strtr($helper['fn']," ","+").'\')">
		 <img src="../imgcreator/imgcreate_colorbar_small.php?sid='.$sid.'&lang='.$lang.'&pn='.$helper['n'].'" alt="'.$LDSetColorRider.'" align="absmiddle" border=0 width=80 height=18>
		 </a>';
    }
	echo '
			</td>
			<td align=center><font face="verdana,arial" size="2" >';
			
	if(stristr($j,"a")) echo strtoupper($result['roomprefix']).$i; else echo "&nbsp;";
	
	echo '
			</td><td align=left><font face="verdana,arial" size="2" > '.strtoupper($j).' ';
	
	if($helper)
	{
		switch(strtolower($helper['s']))
		{
			case "f": echo '<img '.createComIcon('../','mans-red.gif','0').'>';break;
			case "m": echo '<img '.createComIcon('../','mans-gr.gif','0').'>';break;
			case "l": echo '<img '.createComIcon('../','delete2.gif','0').'>';break;
			default:echo '<img '.createComIcon('../','man-whi.gif','0').'>';break;
		}
	}
	elseif($edit)
	{
	   echo '<a href="javascript:indata(\''.$i.'\',\''.$j.'\')"><img '.createComIcon('../','plus2.gif','0').' alt="'.$LDClk2Occupy.'"></a>';
	}
	
	echo "
	</td>";
	echo '
			<td><font face="verdana,arial" size="2" >';
			
	if($edit&&($helper['n']!=""))
	{
	  echo '<a href="javascript:';
	    if($helper['n']!="!") echo 'getinfo(\''.$helper['n'].'\',\''.strtr($helper['fn']," ","+").'\')" title="'.$LDShowPatData.'">'; // ln=last name fn=first name
	      else echo 'unlock(\''.strtoupper($j).'\',\''.$i.'\')" title="'.$LDInfoUnlock.'">'.$LDLocked; //$j=bed   $i=room number
	   
	}
	else 
	{
	    if($helper['n']!="!") echo $helper['fn']; // ln=last name fn=first name
	      else echo $LDLocked; //$j=bed   $i=room number
	}
	
	if($helper&&($helper['n']!=""))
	{
		echo $helper['t']." ";
		
	  	if(isset($sln)&&$sln) echo eregi_replace($sln,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($helper['ln']));
	 		else echo ucfirst($helper['ln']); 
			
		if($helper['ln']) echo ",";
		
		if(isset($sfn)&&$sfn) echo eregi_replace($sfn,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($helper['fn']));
			else echo ucfirst($helper['fn']);
	}
	else
	{
	   echo "&nbsp;";
	}
	
	if($edit) echo '</a>';
	
	echo '
			</td><td align=right><font face="verdana,arial" size="2" >&nbsp;';
    if($helper['g'])
	{
	   if(isset($sg)&&$sg) echo eregi_replace($sg,"<font color=#ff0000><b>".ucfirst($sg)."</b></font>",formatDate2Local($helper['g'],$date_format));
		 else echo formatDate2Local($helper['g'],$date_format);
    }
	echo '
			</td><td align=center><font face="verdana,arial" size="2" >&nbsp;';
	if ($helper['n']!="!") echo $helper['n'];
	echo "\r\n";
	echo '
			</td><td ><font face="verdana,arial" size="2" >&nbsp;';
	if(strchr($helper['k'],"privat")) echo '<font color="#0000ff">';
	if($helper['k']) echo $LDInsurance[$helper['k']];
	echo '</td>';
	
	if($edit)
	{
		echo '
			<td>';
		if(($helper)&&($helper['n']!="!")&&($helper['n']!="")){	echo '&nbsp;
		<a href="javascript:getinfo(\''.$helper['n'].'\',\''.strtr($helper['fn']," ","+").'\')"><img '.createComIcon('../','open.gif','0').' alt="'.$LDShowPatData.'"></a>
	 	<a href="javascript:getrem(\''.$helper['n'].'\',\''.strtr($helper['fn']," ","+").'\')"><img ';
		if($helper['rem']) echo createComIcon('../','bubble3.gif','0'); else echo createComIcon('../','bubble2.gif','0');
		echo ' alt="'.$LDNoticeRW.'"></a>
		 <a href="javascript:release(\''.$helper['r'].'\',\''.$helper['b'].'\',\''.$helper['n'].'\')"><img '.createComIcon('../','bestell.gif','0').' alt="'.$LDReleasePatient.'"></a>';
		 //<a href="javascript:deletePatient(\''.$helper[r].'\',\''.$helper[b].'\',\''.$helper[t].'\',\''.$helper[ln].'\')"><img src="../img/delete.gif" border=0 width=19 height=19 alt="Löschen (Passwort erforderlich)"></a>';
		 }
		 else echo "&nbsp;";
		 echo '
	 	</td></tr>
		 <tr><td bgcolor="#0000ee" colspan="8"><img '.createComIcon('../','pixel.gif').'></td></tr> 
	 	';
		}
	}
}	
echo '</table>';
}
else
{
	echo '
			<ul><img '.createMascot('../','mascot1_r.gif','0','absmiddle').'><font face="Verdana, Arial" size=3>
			<font color="#880000"><b>'.str_replace("~station~",strtoupper($station),$LDNoInit).'</b></font><br>
			<a href="pflege-station-new.php?sid='.$sid.'&lang='.$lang.'&station='.$station.'&edit='.$edit.'">'.$LDIfInit.' <img '.createComIcon('../','bul_arrowgrnlrg.gif','0').'></a><p></font>
			</ul>';
}

if($pday.$pmonth.$pyear<>date('dmY'))
			echo '<p>
			<font face="Verdana, Arial" size=2 >
			<a href="pflege-station-archiv.php?sid='.$sid.'&lang='.$lang.'">'.$LDClk2Archive.' <img '.createComIcon('../','bul_arrowgrnlrg.gif','0').'></a>
			</font><p>';

?>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>></a>
</FONT>


<p>
</td>
</tr>
</table>        
<p>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</BODY>
</HTML>
