<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if(!$ck_pflege_user) $edit=0;
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php");

if ($station=="") { $station="p3a";  }
if($pday=="") $pday=date(d);
if($pmonth=="") $pmonth=date(m);
if($pyear=="") $pyear=date(Y);
$t_date=$pday.".".$pmonth.".".$pyear;

if($retpath=="quick") $breakfile="pflege-schnellsicht.php?sid=$ck_sid&lang=$lang";
 else $breakfile="pflege.php?sid=$ck_sid&lang=$lang";
			
require("../req/db-makelink.php");
if($link&&$DBLink_OK)
		{
		
			if(($mode=="")||($mode=="fresh"))
			{
						$dbtable="nursing_station_patients";
						$sql="SELECT *	FROM $dbtable WHERE  t_date=\"$t_date\"
																		AND	station=\"$station\"";
							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=0;
								while( $result=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
					 				mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
									$occup="ja";
									$dept=$result[dept];
					 			}
								else
								{
									$dbtable="nursing_station_".$lang;
									$sql="SELECT start_no, end_no, maxbed, bed_id1, bed_id2
											 FROM $dbtable WHERE station=\"$station\"";
									$ergebnis=mysql_query($sql,$link);
									if($ergebnis)
       								{
										$rows=0;
										while( $result=mysql_fetch_array($ergebnis)) $rows++;
										if($rows)
										{
					 						mysql_data_seek($ergebnis,0);
											$result=mysql_fetch_array($ergebnis);
											$occup="template";
											if(!$result[maxbed]) $result[maxbed]=($result[end_no]-$result[start_no])*$result[bedtype];
											$dept=$result[dept];
					 					}
										else
										{
											$occup="?";
										}
									}
								}
							}
				 			else {print "<p>".$sql."<p>$LDDbNoRead"; exit;}
			}
			else
			switch($mode)
			{	
				
        		case "getlast": 
							$dbtable="nursing_station_patients";
							$ed=gregoriantojd(date(m),date(d),date(Y))-31; 
							$ed=jdtogregorian($ed);
							$buff=explode("/",$ed);
							if($buff[0]<10) $buff[0]="0".$buff[0];
							if($buff[1]<10) $buff[1]="0".$buff[1];
							$ed=$buff[2].".".$buff[0].".".$buff[1];
							$s_date=$pyear.'.'.$pmonth.'.'.$pday;	 
							$sql="SELECT *	FROM $dbtable WHERE s_date<='$s_date'
																		AND s_date >='$ed' 
																		AND	station='$station'
																		ORDER BY s_date DESC";
							$ergebnis=mysql_query($sql,$link);
							//print $sql;
							if($ergebnis)
       						{
								$rows=0;
								while( $dbdata=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
					 				mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
									$occup="last";
									// get the day difference
									$today=gregoriantojd(date(m),date(d),date(Y));
									$buf=explode(".",$result[t_date]);
									$ld=gregoriantojd($buf[1],$buf[0],$buf[2]);
									$c=$today-$ld;
									// change the date 
									$pday=$buf[0];
									$pmonth=$buf[1];
									$pyear=$buf[2];
									$t_date=$pday.".".$pmonth.".".$pyear;
									//print $c;
									$dept=$result[dept];
					 			}
								else
								{  
									mysql_close($link);
									header ("location:pflege-station-nobelegungsliste.php?sid=$ck_sid&lang=$lang&station=$station&c=32&edit=$edit"); exit; 
								}
							}
				 			else {print "<p>$sql<p>$LDDbNoRead"; exit;}
						break;
				case "copylast":
							$dbtable="nursing_station_patients";
							$sql="SELECT *	FROM $dbtable WHERE t_date=\"$t_date\" 
																		AND	station=\"$station\"";
							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=0;
								while( $result=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);
									//print $b_p;
									// create new occupancy table
									$sql="INSERT INTO $dbtable 
											(
												station,
												dept,
												t_date,
												s_date,
												info,
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
												encoder,
												edit_date,
												editor
											)
											VALUES
											(
												'$station',
												'$result[dept]',
												'".date("d.m.Y")."',
												'".date("Y.m.d")."',
												'$result[info]',
												'$result[start_no]',
												'$result[end_no]',
												'$result[bedtype]',
												'$result[roomprefix]',
												'$result[bed_id1]',
												'$result[bed_id2]',
												'$result[maxbed]',
												'$result[freebed]',
												'$result[closedbeds]',
												'$result[usedbed]',
												'$result[usebed_percent]',
												'".addslashes($result[bed_patient])."',
												'$nursing_station_user',
												'$result[edit_date]',
												'$result[editor]'
											)";
									if($ergebnis=mysql_query($sql,$link)) 
										{
											mysql_close($link);
											$pday=date(d);
											$pmonth=date(m);
											$pyear=date(Y);
											header("location:pflege-station.php?sid=$ck_sid&lang=$lang&station=$station&mode=&edit=1&pday=$pday&pmonth=$pmonth&pyear=$pyear");
											exit;
										}
										else print "$LDDbNoSave<br>$sql";
					 			} else print"$LDDbNoLastData<br>$sql";
						} else {print "<p>$sql<p>$LDDbNoRead"; exit;}
						break;
				case "newdata": 
						if(($patnum=="lock")||($patnum=="unlock"))
							{
														$dbtable="nursing_station_patients";
														// check if station occupancy exists
                                                    	$sql="SELECT bed_patient, maxbed, freebed, closedbeds, usedbed,edit_date,editor FROM $dbtable WHERE t_date='$t_date' AND station='$station'";																	
														if($ergebnis=mysql_query($sql,$link))
       													{
															$rows=0;
															while( $result=mysql_fetch_array($ergebnis)) $rows++;
															if($rows)
															{
																mysql_data_seek($ergebnis,0);
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
																									 edit_date='".$result[edit_date]." ".date("d.m.Y")."',
																									 editor='$result[editor] $ck_pflege_user' 
																									  WHERE t_date='$t_date' AND station='$station'";
																}
																else
																{
																	$b_p=str_replace("_r=$rm&b=".strtolower($bd)."&n=!&s=l","",$result[bed_patient]);
																	$sql="UPDATE $dbtable SET bed_patient='".addslashes($b_p)."', 
																									 freebed='".($result[freebed]+1)."',
																									 closedbeds='".($result[closedbeds]-1)."',
																									 usebed_percent='".ceil((($result[usedbed]+$result[closedbeds]-1)/$result[maxbed])*100)."',
																									 edit_date='".$result[edit_date]." ".date("d.m.Y")."',
																									 editor='$result[editor] $ck_pflege_user' 
																									  WHERE t_date='$t_date' AND station='$station'";
																}
																if($ergebnis=mysql_query($sql,$link)) 
																		{
																			mysql_close($link);
																			header("location:pflege-station.php?sid=$ck_sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
																			exit;
																		}
																		else print "$LDDbNoUpdate $sql";
															}
															else
															{  
																$dbtable="nursing_station_".$lang;
																$sql="SELECT * FROM $dbtable WHERE station='$station'";
																if($ergebnis=mysql_query($sql,$link))
       															{
																	$rows=0;
																	while( $template=mysql_fetch_array($ergebnis)) $rows++;
																	if($rows)
																	{
																		mysql_data_seek($ergebnis,0);
																		$template=mysql_fetch_array($ergebnis);
																		$s_date=$pyear.".".$pmonth.".".$pday;
																		$b_p="_r=$rm&b=$bd&n=!&s=l\r\n";
																		//print $b_p;
																		// create new occupancy table
																		$dbtable="nursing_station_patients";
																		if(!$template[maxbed]) $template[maxbed]=($template[end_no]-$template[start_no])*$template[bedtype];
																		$sql="INSERT INTO $dbtable 
																					(
																						station,
																						dept,
																						t_date,
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
																						encoder,
																						edit_date
																					)
																					VALUES
																					(
																						'$station',
																						'$template[dept]',
																						'$t_date',
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
																						'$ck_pflege_user',
																						'".$template[edit_date]." ".date("d.m.Y")."'
																					)";
																		if($ergebnis=mysql_query($sql,$link)) 
																		{
																			mysql_close($link);
																			header("location:pflege-station.php?sid=$ck_sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
																			exit;
																		}
																		else print "$LDDbNoSave<br>$sql";
					 												}
																	else
																	{  
																		print str_replace("~station~",$station,$LDTemplateMissing);
																	}
																}
				 												else {print "<p>".$sql."<p>$LDDbNoRead"; exit;}
																// update the existing occupancy table
					 										}

														}
				 										else {print "<p>".$sql."<p>$LDDbNoRead"; exit;}
							}
							else
							{
												// fetch the orig data
												$dbtable="mahopatient";
												$sql="SELECT patnum, title, name, vorname, gebdatum, sex, kasse FROM $dbtable
															WHERE patnum='$patnum'";
												if($ergebnis=mysql_query($sql,$link))
       											{
												$rows=0;
												while( $dbdata=mysql_fetch_array($ergebnis)) $rows++;
												if($rows)
													{
														mysql_data_seek($ergebnis,0);
														$dbdata=mysql_fetch_array($ergebnis);
														//foreach($dbdata as $v) print $v;
														$dbtable="nursing_station_patients";
														// check if station occupancy exists
                                                    	$sql="SELECT bed_patient, maxbed, freebed, usedbed, closedbeds FROM $dbtable WHERE t_date='$t_date' AND station='$station'";																	
														if($ergebnis=mysql_query($sql,$link))
       													{
															$rows=0;
															while( $result=mysql_fetch_array($ergebnis)) $rows++;
															if($rows)
															{
																mysql_data_seek($ergebnis,0);
																$result=mysql_fetch_array($ergebnis);
																// update the existing occupancy table
																if(trim($result[bed_patient])=="") 
																	$b_p="r=$rm&b=$bd&n=$dbdata[patnum]&t=$dbdata[title]&ln=".strtr($dbdata[name]," ","+")."&fn=".strtr($dbdata[vorname]," ","+")."&g=$dbdata[gebdatum]&s=$dbdata[sex]&k=$dbdata[kasse]&rem=\r\n";
																else
																	$b_p=$result[bed_patient]."_r=$rm&b=$bd&n=$dbdata[patnum]&t=$dbdata[title]&ln=".strtr($dbdata[name]," ","+")."&fn=".strtr($dbdata[vorname]," ","+")."&g=$dbdata[gebdatum]&s=$dbdata[sex]&k=$dbdata[kasse]&rem=\r\n";
																$used=$result[usedbed]+1;
																$sql="UPDATE $dbtable SET bed_patient='".addslashes($b_p)."', 
																									 freebed='".($result[freebed]-1)."',
																									 usedbed='$used',
																									 usebed_percent='".ceil((($used+$result[closedbeds])/$result[maxbed])*100)."',
																									 edit_date='".$result[edit_date]." ".date("d.m.Y")."',
																									 editor='$result[editor] $ck_pflege_user' 
																									  WHERE t_date='$t_date' AND station='$station'";
																if($ergebnis=mysql_query($sql,$link)) 
																		{
																			mysql_close($link);
																			header("location:pflege-station.php?sid=$ck_sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
																			exit;
																		}
																		else print "$LDDbNoUpdate<br>$sql";
					 										}
															else
															{  
																$dbtable="nursing_station_".$lang;
																$sql="SELECT * FROM $dbtable WHERE station='$station'";
																if($ergebnis=mysql_query($sql,$link))
       															{
																	$rows=0;
																	while( $template=mysql_fetch_array($ergebnis)) $rows++;
																	if($rows)
																	{
																		mysql_data_seek($ergebnis,0);
																		$template=mysql_fetch_array($ergebnis);
																		$s_date=$pyear.".".$pmonth.".".$pday;
																		$b_p="r=$rm&b=$bd&n=$dbdata[patnum]&t=$dbdata[title]&ln=".strtr($dbdata[name]," ","+")."&fn=".strtr($dbdata[vorname]," ","+")."&g=$dbdata[gebdatum]&s=$dbdata[sex]&k=$dbdata[kasse]&rem=\r\n";
																		//print $b_p;
																		// create new occupancy table
																		$dbtable="nursing_station_patients";
																		if(!$template[maxbed]) $template[maxbed]=($template[end_no]-$template[start_no])*$template[bedtype];
																		$sql="INSERT INTO $dbtable 
																					(
																						station,
																						dept,
																						t_date,
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
																						encoder,
																						edit_date
																					)
																					VALUES
																					(
																						'$station',
																						'$template[dept]',
																						'$t_date',
																						'$s_date',
																						'$template[start_no]',
																						'$template[end_no]',
																						'$template[bedtype]',
																						'$template[roomprefix]',
																						'$template[bed_id1]',
																						'$template[bed_id2]',
																						'$template[maxbed]',
																						'".($template[maxbed]-1)."',
																						'$template[closedbeds]',
																						'1',
																						'".ceil((1/$template[maxbed])*100)."',
																						'$b_p',
																						'$ck_pflege_user',
																						'".$template[edit_date]." ".date("d.m.Y")."'
																					)";
																		if($ergebnis=mysql_query($sql,$link)) 
																		{
																			mysql_close($link);
																			header("location:pflege-station.php?sid=$ck_sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
																			exit;
																		}
																		else print "$LDDbNoSave<br>$sql";
					 												}
																	else
																	{  
																		print str_replace("~station~",$station,$LDTemplateMissing);
																	}
																}
				 												else {print "<p>".$sql."<p>$LDDbNoRead"; exit;}
																// update the existing occupancy table
					 										}
														}
				 										else {print "<p>".$sql."<p>$LDDbNoRead"; exit;}
					 								}
													else
													{  
														print"$LDNoOrigData<br>$sql";
													}
												}
				 								else {print "<p>".$sql."<p>$LDDbNoRead"; exit;}
							}
							break;
				case "delete":
						$dbtable="nursing_station_patients";
						// check if station occupancy exists
                       $sql="SELECT bed_patient, maxbed, freebed, usedbed FROM $dbtable WHERE t_date='$t_date' AND station='$station'";																	
						if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=0;
								while( $result=mysql_fetch_array($ergebnis)) $rows++;
								if($rows==1)
									{
										$rm="r=$rm&b=$bd";//print "$rm<br>";
										mysql_data_seek($ergebnis,0);
										$result=mysql_fetch_array($ergebnis);
										$buf=explode("_",$result[bed_patient]);
										for($i=0;$i<sizeof($buf);$i++)
											{
												//print $buf[$i];
												if(substr_count(trim($buf[$i]),$rm))
													{ array_splice($buf,$i,1); break; }
											}
										$result[bed_patient]=implode("_",$buf);
										$used=$result[usedbed]-1;
										$sql="UPDATE $dbtable SET bed_patient='$result[bed_patient]',
														freebed='".($result[freebed]+1)."',
														usedbed='$used',
														usebed_percent='".ceil((($used+$result[closedbeds])/$result[maxbed])*100)."' 
														WHERE t_date='$t_date' AND station='$station'";
										if($ergebnis=mysql_query($sql,$link)) 
											{
												mysql_close($link);
												header("location:pflege-station.php?sid=$ck_sid&lang=$lang&station=$station&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear");
												exit;
											}
											else print "$LDDbNoDelete<br>$sql";
									}
							} else {print "<p>$sql<p>$LDDbNoRead"; exit;}
						break;
				}// end of switch ($mode)
				
				// translate station to dept
			if(!$dept)
			{
				$dbtable="station2dept_table";
				$sql="SELECT dept 	FROM $dbtable WHERE station LIKE \"%$station%\" AND op=0";
				//print $sql."<br>";
				$s2dresult=mysql_query($sql,$link);
				$stat2dept=mysql_fetch_array($s2dresult);
				$dept=$stat2dept[dept];
			}
			// now get the doctor on duty 
			$dbtable="doctors_dutyplan";
			$sql="SELECT a_dutyplan,r_dutyplan 	FROM $dbtable WHERE dept=\"$dept\" AND year=\"".(int)$pyear."\" AND month=\"".(int)$pmonth."\"";
			//print $sql;
			$docslist=mysql_query($sql,$link);
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!-- 
  var urlholder;

function getinfo(pid,pdata){
<?/* if($edit)*/
	{ print '
	urlholder="pflege-station-patientdaten.php?sid=';
	print "$ck_sid&lang=$lang";
	print '&pn="+pid+"&patient=" + pdata + "&station=';
	print "$station&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit"; 
	print '";';
	print '
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	';
	}
	/*else print '
	window.location.href=\'pflege-station-pass.php?sid='.$ck_sid.'&lang='.$lang.'&rt=pflege&edit=1&station='.$station.'\'';*/
?>
	}
function getrem(pid,pdata){
	urlholder="pflege-station-remarks.php?sid=<? print "$ck_sid&lang=$lang"; ?>&pn="+pid+"&patient=" + pdata + "&station=<? print "$station&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}
	
function indata(room,bed)
{
	urlholder="pflege-station-bettbelegen.php?sid=<? print "$ck_sid&lang=$lang"; ?>&s=<? print $station; ?>&rm="+room+"&bd="+bed+"<? print "&py=".$pyear."&pm=".$pmonth."&pd=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>";
	indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
}
function release(room,bed,pid)
{
	urlholder="pflege-station-patient-release.php?sid=<? print "$ck_sid&lang=$lang"; ?>&station=<? print $station; ?>&rm="+room+"&bd="+bed+"&pn="+pid+"<? print "&pyear=".$pyear."&pmonth=".$pmonth."&pday=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>";
	//indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes"
	window.location.href=urlholder;
}

function unlock(b,r)
{
<?php
	print '
	urlholder="pflege-station.php?mode=newdata&patnum=unlock&sid='.$ck_sid.'&lang='.$lang.'&station='.$station.'&rm="+r+"&bd="+b+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'";
	';
?>
	if(confirm("<?=$LDConfirmUnlock ?>"))
	{
		window.location.replace(urlholder);
	}
}
function deletePatient(r,b,t,n)
{
	if(confirm("<?=$LDConfirmDelete ?>"))
	{
		url="pflege-station.php?sid=<? print "$ck_sid&lang=$lang&station=$station&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&mode=delete&rm="+r+"&bd="+b;
		window.location.replace(url);
	}
}

function popinfo(l,f,b)
{
	w=window.screen.width;
	h=window.screen.height;
	ww=400;
	wh=400;
	urlholder="doctors-dienstplan-popinfo.php?<?="sid=$ck_sid&dept=$dept&lang=$lang" ?>&ln="+l+"&fn="+f+"&bd="+b;
	
	infowin=window.open(urlholder,"infowin","width=" + ww + ",height=" + wh +",menubar=no,resizable=yes,scrollbars=yes");
	window.infowin.moveTo((w/2)-(ww/2),(h/2)-(wh/2));

}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

// -->
</script>

<?
require("../req/css-a-hilitebu.php");
?>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}

</style>
</HEAD>

<BODY bgcolor=<? print $cfg['body_bgcolor']; ?> topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=3  FACE="Arial"><STRONG> &nbsp;&nbsp; <?="$LDStation  ".strtoupper($station)." $LDOccupancy ($t_date)" ?> </STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="javascript:gethelp('nursing_station.php','<?=$mode ?>','<?=$occup ?>','<?=$station ?>','<?="$LDStation" ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?=$breakfile ?>" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
<?
	 if(($occup=="template")&&(!$mode)&&(!$list))
		 	{
			 print'<font face="verdana,arial" size="2" >'.$LDNoListYet.'<br>
			 <form action="pflege-station.php" method=post>
			<input type="hidden" name="sid" value="'.$ck_sid.'">
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
			print'
			<font face="verdana,arial" size="2" >'.$LDLastList;
			if($c>2) print '<font color=red><b>'.$LDNotToday.'</b></font><br>'.str_replace("~nr~",$c,$LDListFrom);
				else print '<font color=red><b>'.$LDFromYesterday.'</b></font><br>
				';
			print '
			</font>
			<form action="pflege-station.php" method=post>
			<input type="hidden" name="sid" value="'.$ck_sid.'">
    		<input type="hidden" name="lang" value="'.$lang.'">
  			<input type="hidden" name="pyear" value="'.$pyear.'">
 			<input type="hidden" name="pmonth" value="'.$pmonth.'">
  			<input type="hidden" name="pday" value="'.$pday.'">
			<input type="hidden" name="station" value="'.$station.'">
			<input type="hidden" name="mode" value="copylast">&nbsp;&nbsp;&nbsp;';
			if($c>2) print '<input type="submit" value="'.$LDCopyAnyway.'">';
			else print '
   			<input type="submit" value="'.$LDTakeoverList.'" >
				';
			print '
			&nbsp;&nbsp;&nbsp;<input type="button" value="'.$LDDoNotCopy.'" onClick="javascript:window.location.href=\'pflege-station.php?sid='.$ck_sid.'&edit=1&list=1&station='.$station.'&mode=fresh\'">
 			</form>
				';		
			}
//print $statdata[$bd.$rm];

if($occup!="?")
{

if($pday.$pmonth.$pyear<date(dmY))
	{
	 print '
	<font face="verdana,arial" size="2"><img src="../img/warn.gif" border=0 width=16 height=16 align="absmiddle"> <font color="#ff0000"><b>'.$LDAttention.'</font> '.$LDOldList.'</b></font> ';
	$edit=0;
	}

//print $result[bed_patient];
$buf=explode("_",trim($result[bed_patient]));
$m=substr_count($result[bed_patient],"s=m");
$f=substr_count($result[bed_patient],"s=f");
print '
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
<td bgcolor="#ffffcc" class="vn">'.$result[usedbed].'</td> 
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;
</td>
<td bgcolor="#ffffcc" class="vn">'.$result[usebed_percent].'%</td> 
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDFree.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$result[freebed].'</td> 
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDLocked.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$result[closedbeds].'</td>
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDShortMale.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$m.'</td> 
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align=right>
&nbsp;<b>'.$LDShortFemale.':</b>
</td>
<td bgcolor="#ffffcc" class="vn">'.$f.'</td> 
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" align="right" valign="top">
&nbsp;<nobr>'.$LDDutyDoctor.':</nobr>
</td>
<td bgcolor="#ffffcc" class="vn">';
//print $dept;
// display the doctors on duty if available
$doctors=mysql_fetch_array($docslist);
if($doctors)
{
	$a_doctors=explode("~",$doctors[a_dutyplan]);
	$r_doctors=explode("~",$doctors[r_dutyplan]);
	parse_str($a_doctors[($pday-1)],$parsed_a);
	parse_str($r_doctors[($pday-1)],$parsed_r);
	print '<a href="javascript:popinfo(\''.$parsed_a[l].'\',\''.$parsed_a[f].'\',\''.$parsed_a[b].'\')" title="'.$LDClk4Phone.'">'.$parsed_a[l].'</a><br>
			<a href="javascript:popinfo(\''.$parsed_r[l].'\',\''.$parsed_r[f].'\',\''.$parsed_r[b].'\')" title="'.$LDClk4Phone.'">'.$parsed_r[l].'</a><br>';
}

print '
</td> 
</td>
</tr>
<tr><td bgcolor=maroon align=center colspan=2>	<FONT  SIZE=2 FACE="verdana,Arial" color=white>
<b>'.$LDLegend.'</b>
</td>
</tr>
<tr><td bgcolor="#ffffcc" class="vn" colspan=2>';
if($edit) print '
&nbsp;<img src="../img/patdata.gif" width=20 height=20 align="absmiddle"> <b>'.$LDOpenFile.'</b><br>
&nbsp;<img src="../img/bubble2.gif" width=15 height=14 align="absmiddle"> <b>'.$LDNotesEmpty.'</b><br>
&nbsp;<img src="../img/bubble3.gif" width=15 height=14 align="absmiddle"> <b>'.$LDNotes.'</b><br>
&nbsp;<img src="../img/bestell.gif" width=16 height=16 align="absmiddle"> <b>'.$LDRelease.'</b><br>
&nbsp;<img src="../img/plus2.gif" width=16 height=16 align="absmiddle"> <b>'.$LDFreeOccupy.'</b><br>
';
print '
&nbsp;<img src="../img/delete2.gif" width=20 height=20 align="absmiddle"> <b>'.$LDLocked.'</b><br>
&nbsp;<img src="../img/mans-red.gif" width=12 height=15 align="absmiddle"> <b>'.$LDFemale.'</b><br>
&nbsp;<img src="../img/mans-gr.gif" width=12 height=15 align="absmiddle"> <b>'.$LDMale.'</b><br>
</td>

</tr>
</table>

</td>
</tr>
</table>
';
	
print '<table  cellpadding="0" cellspacing=0 border="0" >';

print '<tr bgcolor="#0000dd" align=center>
		<td>&nbsp;</td>';

for($n=0;$n<sizeof($LDPatListElements);$n++)
print'
<td><font face="verdana,arial" size="2" color="#ffffff"><b>'.$LDPatListElements[$n].' &nbsp;&nbsp;</b></td>';
print '</tr>';


//foreach($buf as $v) print $v;
for ($i=$result['start_no'];$i<=$result['end_no'];$i++)
 {
   for($j=$result[bed_id1];$j<=$result[bed_id2];$j++)
	{
	
		for($k=0;$k<sizeof($buf);$k++)
		{
			parse_str(trim($buf[$k]),$helper);
			//foreach($helper as $v) print $v;
			if  (($helper[r]==$i)&&($helper[b]==$j))  break; 
			$helper="";
		}	
		
	print '
			<tr bgcolor=';
	if ($j=="a") print '"#fefefe">'; else print '"#dfdfdf">';
	
	print '
			<td>';
	if($helper&&($helper[s]!="l")&&$edit) print '<img src="../img/s_colorbar.gif" border=0 width=56 height=18 alt="'.$LDSetColorRider.'">';
	print '
			</td>
			<td align=center><font face="verdana,arial" size="2" >';
	if($j=="a") print $result[roomprefix]." ".$i; else print "&nbsp;";
	print '
			</td><td align=left><font face="verdana,arial" size="2" > '.strtoupper($j).' ';
	

	if($helper)
		switch(strtolower($helper[s]))
		{
			case "f": print '<img src="../img/mans-red.gif" border=0 width=12 height=15>';break;
			case "m": print '<img src="../img/mans-gr.gif" border=0 width=12 height=15>';break;
			case "l": print '<img src="../img/delete2.gif" width=20 height=20 border=0 align=absmiddle>';break;
			default:print '<img src="../img/man-whi.gif" border=0 width=12 height=15>';break;
		}
	elseif($edit) print '<a href="javascript:indata(\''.$i.'\',\''.$j.'\')"><img src="../img/plus2.gif"  border=0 width=16 height=16 alt="'.$LDClk2Occupy.'"></a>';
	print "
	</td>";
	print '
			<td><font face="verdana,arial" size="2" ><a href="javascript:';
	if($helper[n]!="!") print 'getinfo(\''.$helper[n].'\',\''.strtr($helper[fn]," ","+").'\')" title="'.$LDShowPatData.'">'; // ln=last name fn=first name
	else print 'unlock(\''.strtoupper($j).'\',\''.$i.'\')" title="'.$LDInfoUnlock.'">'.$LDLocked; //$j=bed   $i=room number
	if($helper)
	{
		print "$helper[t] ";
	  	if($sln) print eregi_replace($sln,'<span style="background:yellow">'.$sln.'</span>',$helper[ln]);
	 		else print $helper[ln]; 
		if($helper[ln]) print ",";
		if($sfn) print eregi_replace($sfn,'<span style="background:yellow">'.$sln.'</span>',$helper[fn]);
			else print $helper[fn];
	}
	else print "&nbsp;";
	print '
			</a></td><td align=right><font face="verdana,arial" size="2" >&nbsp;';
	if($sg) print eregi_replace($sg,"<font color=#ff0000><b>".ucfirst($sg)."</b></font>",$helper[g]);
		else print $helper[g];
	print '
			</td><td align=center><font face="verdana,arial" size="2" >&nbsp;';
	if ($helper[n]!="!") print $helper[n];
	print "\r\n";
	print '
			</td><td ><font face="verdana,arial" size="2" >&nbsp;';
	if(strchr($helper[k],"privat")) print '<font color="#0000ff">';
	print $LDInsurance[$helper[k]].'</td>';
	if($edit)
		{
		print '
			<td>';
		if(($helper)&&($helper[n]!="!")){	print '
		<a href="javascript:getinfo(\''.$helper[n].'\',\''.strtr($helper[fn]," ","+").'\')"><img src="../img/open.gif" border=0 width=20 height=20 alt="'.$LDShowPatData.'"></a>
	 	<a href="javascript:getrem(\''.$helper[n].'\',\''.strtr($helper[fn]," ","+").'\')"><img src="../img/';
		if($helper[rem]) print 'bubble3.gif'; else print 'bubble2.gif';
		print '" border=0 width=15 height=14 alt="'.$LDNoticeRW.'"></a>
		 <a href="javascript:release(\''.$helper[r].'\',\''.$helper[b].'\',\''.$helper[n].'\')"><img src="../img/bestell.gif" width=16 height=16 border=0 alt="'.$LDReleasePatient.'"></a>';
		 //<a href="javascript:deletePatient(\''.$helper[r].'\',\''.$helper[b].'\',\''.$helper[t].'\',\''.$helper[ln].'\')"><img src="../img/delete.gif" border=0 width=19 height=19 alt="Löschen (Passwort erforderlich)"></a>';
		 }
		 else print "&nbsp;";
		 print '
	 	</td></tr>
		 <tr><td bgcolor="#0000ee" colspan="8"><img src="../img/pixel.gif" border=0 width=1 height=1></td></tr> 
	 	';
		}
		
	}
}	
print '</table>';
}
else
{
	print '
			<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"><font face="Verdana, Arial" size=3>
			<font color="#880000"><b>'.str_replace("~station~",strtoupper($station),$LDNoInit).'</b></font><br>
			<a href="pflege-station-new.php?sid='.$ck_sid.'&station='.$station.'&edit='.$edit.'">'.$LDIfInit.' <img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0 align=absmiddle></a><p></font>';
}

if($pday.$pmonth.$pyear<>date(dmY))
			print '<p>
			<font face="Verdana, Arial" size=2 >
			<a href="pflege-station-archiv.php?sid='.$ck_sid.'">'.$LDClk2Archive.' <img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0 align="absmiddle"></a>
			</font><p>';

?>
<p>
<a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0"></a>
</FONT>


<p>
</td>
</tr>
</table>        
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</BODY>
</HTML>
