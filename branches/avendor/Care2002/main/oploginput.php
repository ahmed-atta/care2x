<?php
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if (!$internok&&!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
require("../req/config-color.php"); // load color preferences

// initializations
$thisfile="oploginput.php";
$pdata=array();
//$monat=array("januar","februar","märz","april","mai","juni","juli","august","september","oktober","november","dezember");

if($pyear=="") $pyear=date(Y);
if($pmonth=="") $pmonth=date(m);
if($pday=="") $pday=date(d);

/********************************* Resolve the department and op room ***********************/
require("../req/resolve_opr_dept.php");

$datafound=0;

$md=$pday;
if(strlen($md)==1) $md="0".$md;


require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get orig data

	switch($mode)
	{
		case "save":
		 // get the basic patient data
			$dbtable="mahopatient";
			$sql="SELECT name,vorname,gebdatum,address FROM $dbtable WHERE patnum='$patnum'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);		
					
				$dbtable="nursing_op_logbook";
				// check if entry is already existing
				$sql="SELECT entry_out,cut_close,encoding,tid FROM $dbtable 
						WHERE patnum='$patnum' 
							AND op_nr='$op_nr'
							AND dept='$dept'
							AND op_room='$saal'";
							
				if($ergebnis=mysql_query($sql,$link))
       			{
					//print $sql." checked <br>";
					//$dbuf=$dbuf."~".$enc."\r\n".$encoder." ".date("d.m.Y")." ".date("H.i");
					//$dbuf=strtr($dbuf," ","+");
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows==1)
						{
							// $dbuf=htmlspecialchars($dbuf);
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);
							
							$content[encoding].=" ~e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i");
							if($entry_time||$content[entry_out])
							{
									$dbuf=explode("~",$content[entry_out]);
									sort($dbuf,SORT_REGULAR);
									if(trim($entry_time)) $dbuf[0]="s=$entry_time&e=$exit_time"; 
										else array_splice($dbuf,0,1);
									$content[entry_out]=implode("~",$dbuf); 
							}
							if($cut_time||$content[cut_close])
							{
									$dbuf=explode("~",$content[cut_close]);
									sort($dbuf,SORT_REGULAR);
									if(trim($cut_time)) $dbuf[0]="s=$cut_time&e=$close_time";
										else array_splice($dbuf,0,1);
									$content[cut_close]=implode("~",$dbuf);
							}

							$sql="UPDATE $dbtable 
									SET encoding='$content[encoding]',
									diagnosis='$diagnosis',
									anesthesia='$anesthesia',
									entry_out='$content[entry_out]',
									cut_close='$content[cut_close]',
									op_therapy='$op_therapy',
									result_info='$result_info',
									tid='$content[tid]'
									WHERE patnum='$patnum' 
											AND op_nr='$op_nr'
											AND dept='$dept'
											AND op_room='$saal'";
											
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&mode=saveok&patnum=$patnum&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday&op_nr=$op_nr");
								}
								else { print "$LDDbNoRead<br>"; }
						} // else create new entry
						else
						{
							// first get the last op number
	  						$dbtable="nursing_op_logbook";
		 					$sql="SELECT op_nr FROM $dbtable WHERE dept='$dept'	AND op_room='$saal' ORDER BY op_nr DESC";
							//print $sql;
							if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=0;
								if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$pdata=mysql_fetch_array($ergebnis);
									$op_nr=$pdata[op_nr]+1;
									//print $sql."<br>";
								}
									else
								{
									$op_nr=1;
								}
							}
							else { print "$LDDbNoRead<br>";exit; } 
							
							
							if($entry_time) $eobuf="s=$entry_time&e=$exit_time";
							if($cut_time) $ccbuf="s=$cut_time&e=$close_time";
							//$dbuf=strtr("sd=$yr$mo$dy&rd=$dy.$mo.$yr&e=$newdata"," <>","+()")."\r\n";
							$sql="INSERT INTO $dbtable 
										(
										year,
										dept,
										op_room,
										op_nr,
										op_date,
										op_src_date,
										patnum,
										lastname,
										firstname,
										bday,
										address,
										diagnosis,
										anesthesia,
										op_therapy,
										result_info,
										entry_out,
										cut_close,
										encoding,
										doc_date,
										doc_time
										)
									 	VALUES
										(
										'$pyear',
										'$dept',
										'$saal',
										'$op_nr',
										'$op_date',
										'".date(Ymd)."',
										'$patnum',
										'$result[name]',
										'$result[vorname]',
										'$result[gebdatum]',
										'".addslashes($address)."',
										'$diagnosis',
										'$anesthesia',
										'$op_therapy',
										'$result_info',
										'$eobuf',
										'$ccbuf',
										'e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."',
										'".date("d.m.Y")."',
										'".date("H.i")."'
										)";

							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new insert <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&mode=saveok&patnum=$patnum&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday&op_nr=$op_nr");
								}
								else { print "$LDDbNoSave<br>"; } 
						}//end of else
					} // end of if ergebnis
				}// end of if rows
				else { print "$LDDbNoRead<br>"; } 
			}//end of   if ergebnis
			else $saved=0;
			 break;
			 
	  case "search":
			$dbtable="mahopatient";

	//*************************************************************************************		
		$patnum=(int) $patnum;
		$filtered=strtolower(trim($patnum.$pname.$gebdatum));
		$dept_src="";
	

		$findname="0";
		$findvname="0";
		$findbday="0";
		$validpnum=false;
		$ndl_name="";
		$ndl_vname="";
		$ndl_bday="";
		$ndl_pnum="";
	
	
		//filter unwanted words
		$filter=file("ai/filters/$lang/person2-filter.txt");
		while(list($x,$v)=each($filter))
		{
			$v=trim($v);
			$filtered=str_replace($v,"",$filtered);
		}
		$filter=NULL; // kill $filter
		$filtered=trim($filtered);
		$buff=explode(" ",$filtered);

		while(list($x,$v)=each($buff))
		{
			//check if pat number available
			$v=trim($v);
			//print "$v<br>";
			$b=strtoupper($v);
			$b2=strtolower($v);
	
			if($b==$b2) 
			{
				if(!strstr($b,".")&&($b/1)&&($ndl_pnum==NULL))
				{
					//		print $b;
					$ndl_pnum=$v;
					if(strlen($v)==8) $validpnum=true; // a valid pat number is 8 digits long
					//$buff=NULL;
					continue;
				}
				else //check if it is a bday-date
				{
					if((substr_count($v,".")==2)&&(strlen($v)>5)&&(strlen($v)<11)) 
					{
						if(strlen($v)<10)
							{
								$bd=explode(".",$v);
								for($i=0;$i<3;$i++)	{ if(($bd[$i]<10)&&(strlen($bd[$i])==1)) $bd[$i]="0".$bd[$i]; } 						
 								if(strlen($bd[2])==2)
									{
										if ($bd[2]>(date(Y)-2000)) $bd[2]="19".$bd[2];
										else  $bd[2]="20".$bd[2];
									}
								$v=implode(".",$bd);
								$bd=NULL;
							}
						$ndl_bday=$v;
						$findbday=1;
						if(!$findname&&$findvname)
						{
							$findname=1;
							$ndl_name=$ndl_vname;
							$findvname=0;
							$ndl_vname="";
						}
						continue;
					}
				}
			}
			//  if pat number not available check for family name detect (,)

			$cpos=strpos($v,",");
			if(($cpos!=0)&&(strlen($v)==($cpos+1)))
			{
				$ndl_name=strtolower(str_replace(",","",$v));
				$findname=true;
				//$buff=NULL;
				continue;
			}
			else
			{
				if(sizeof($buff)==1) 
				{
					$findname=1;
					$ndl_name=trim(strtolower($v));
				}
				elseif	($ndl_vname==NULL)
					{
						$findvname=true;
						$ndl_vname=trim(strtolower($v));
					}
					else
						{
							$findname=1;
							$ndl_name=trim(strtolower($v));
						}
			}
		}// end of while
		//print $ndl_name."<br>";
		$buff=NULL;
		//start searching
		$dix=0;
		$six=0;
		//$past=1;
					
		if($validpnum)
			{
			 	$id_src="  patnum='$ndl_pnum'";
			}
			else
			{
							$scode=$findname.$findvname.$findbday;
							//print $scode;
							//print "scode ".$scode."<br>".$ndl_name."<br>";
							switch($scode)
							{
								case "100":
													if($id_src=="") $id_src="name='$ndl_name'";
								 						else $id_src.=" AND name='$ndl_name'";
													break;
								case "110":
													if($id_src=="") $id_src="name='$ndl_name' AND vorname='$ndl_vname'";
								 						else $id_src.=" AND name='$ndl_name' AND vorname='$ndl_vname'";
													break;
								case "111":
													if($id_src=="") $id_src="name='$ndl_name' AND vorname='$ndl_vname' AND gebdatum='$ndl_bday'";
								 						else $dept_src.=" AND name='$ndl_name' AND vorname='$ndl_vname' AND gebdatum='$ndl_bday'";
													break;
								case "010":
													if($id_src=="") $id_src="vorname='$ndl_vname'";
								 						else $id_src.=" AND vorname='$ndl_vname'";
													break;
								case "011":
													if($id_src=="") $id_src="vorname='$ndl_vname' AND gebdatum='$ndl_bday'";
								 						else $id_src.=" AND vorname='$ndl_vname' AND gebdatum='$ndl_bday'";
													break;
								case "001":
													if($id_src=="") $id_src="gebdatum='$ndl_bday'";
								 						else $id_src.=" AND gebdatum='$ndl_bday'";
								case "101":
													if($id_src=="") $id_src="name='$ndl_name' AND gebdatum='$ndl_bday'";
								 						else $id_src.=" AND name='$ndl_name' AND gebdatum='$ndl_bday'";
													break;
								default: $id_src="name='$filtered'";
							}
			}
				//******************************** 				
			
				$sql="SELECT patnum,name,vorname,gebdatum,address FROM $dbtable WHERE  $id_src";
				//print "<p>$sql AND rule";
				if($ergebnis=mysql_query($sql,$link)) // ergebnis 1
       			{
					$rows=0;
					while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
					if($rows==1)
					{
						mysql_data_seek($ergebnis,0); //reset the variable
						$pdata=mysql_fetch_array($ergebnis);
						$datafound=1;
						$lname=$pdata[name];
						$fname=$pdata[vorname];
						$bdate=$pdata[gebdatum];
					}
					else // else 1
					{
						$id_src=str_replace("AND","OR",$id_src);
						$sql="SELECT patnum,name,vorname,gebdatum,address FROM $dbtable WHERE  $id_src";
						//print $rows;
						//print "<p>$sql OR Rule";
						if($ergebnis=mysql_query($sql,$link)) //ergebnis 2
       						{
								$rows=0;
								while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
									//print $rows;
									mysql_data_seek($ergebnis,0); //reset the variable
									//$datafound=1;
									//print $sql."<br>";
									//print $rows;
								}
								else // else 2
								{
									if($ndl_name) $id_src="name LIKE '$ndl_name%'";
										else $id_src="";
									if($ndl_vname) 
										if($id_src) $id_src.=" OR vorname LIKE '$ndl_vname%'";
											else $id_src="vorname LIKE '$ndl_vname%'";
									if($ndl_bday) 
										if($id_src) $id_src.=" OR gebdatum LIKE '$ndl_bday%'";
											else $id_src="gebdatum LIKE '$ndl_bday%'";
					/*				if($ndl_pnum) 
										if($id_src) $id_src.=" OR patnum LIKE '$ndl_pnum%'";
											else $id_src="patnum LIKE '$ndl_pnum%'";
						*/
									if(!$id_src) $id_src="name LIKE '$filtered%'";
									$sql="SELECT patnum,name,vorname,gebdatum,address FROM $dbtable WHERE  $id_src";
									//print "<p>$sql  % Rule";
									if($ergebnis=mysql_query($sql,$link)) //ergebnis 3
       								{
										$rows=0;
										while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
										if($rows)
										{
											//print $rows;
											mysql_data_seek($ergebnis,0); //reset the variable
											//$datafound=1;
										}
										else // now find similar sounding words else 3
										{
											if($ndl_name!="") $id_src="name LIKE '_%'";
												else $id_src="";
											if($ndl_vname) 
												if($id_src!="") $id_src.=" OR vorname LIKE '_%'";
													else $id_src="vorname LIKE '_%'";
											if($ndl_bday) 
												if($id_src!="") $id_src.=" OR gebdatum LIKE '_%'";
													else $id_src="gebdatum LIKE '_%'";
											if(!$id_src) $id_src="name LIKE '_%' OR vorname LIKE '_%' OR gebdatum LIKE '_%'";
											
											$sql="SELECT patnum,name,vorname,gebdatum,address FROM $dbtable WHERE  $id_src";
											
											if($ergebnis=mysql_query($sql,$link)) //ergebnis 4
       										{
												$rows=0;
												while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
												if($rows)
												{
													$id_src=NULL;
													mysql_data_seek($ergebnis,0); //reset the variable
													while($bufdata=mysql_fetch_array($ergebnis))
													{
														if($ndl_name)
														{
															$sx1=soundex($ndl_name);
															$sx2=soundex($bufdata['name']);
															$sx3=soundex($bufdata['vorname']);
															$st1=similar_text($sx1,$sx2,&$pc1);
															$st2=similar_text($sx1,$sx3,&$pc2);
															//	print "p1: ".$pc1." p2: ".$pc2."<p>";

															if(($pc1>=75)||($pc2>=75)) 
																if($id_src!="")
																{
																	if(!substr_count($id_src,"name LIKE '$bufdata[name]'"))
																		 $id_src.=" OR name LIKE '$bufdata[name]'";
																 }
																	else $id_src="name LIKE '$bufdata[name]'";
														}
														if($ndl_vname)
														{
															$sx1=soundex($ndl_vname);
															$sx2=soundex($bufdata['name']);
															$sx3=soundex($bufdata['vorname']);
															$st1=similar_text($sx1,$sx2,&$pc1);
															$st2=similar_text($sx1,$sx3,&$pc2);
																//print "p1: ".$pc1." p2: ".$pc2."<p>";

															if(($pc1>=75)||($pc2>=75)) 
																if($id_src!="")
																{
																	if(!substr_count($id_src,"vorname LIKE '$bufdata[vorname]'"))
																		 $id_src.=" OR vorname LIKE '$bufdata[vorname]'";
																 }
																	else $id_src="vorname LIKE '$bufdata[vorname]'";
														}
														if($ndl_bday)
														{
															$sx1=soundex($ndl_bday);
															$sx2=soundex($bufdata['gebdatum']);
															$st1=similar_text($sx1,$sx2,&$pc1);
																//print "p1: ".$pc1." p2: ".$pc2."<p>";

															if($pc1>=75) 
																if($id_src) 
																{
																	if(!substr_count($id_src,"gebdatum LIKE '$bufdata[gebdatum]'"))
																		 $id_src.=" OR gebdatum LIKE '$bufdata[gebdatum]'";
																 }
																	else $id_src="gebdatum LIKE '$bufdata[gebdatum]'";
														}
													}// end of while
													$rows=0;
													$sql="SELECT patnum,name,vorname,gebdatum,address FROM $dbtable WHERE  $id_src";
													//print "<p>$sql wild guess";
													if($id_src)
													if($ergebnis=mysql_query($sql,$link))
       												{
														while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
														if($rows)
															{
																mysql_data_seek($ergebnis,0); //reset the variable
															}
															else
															{
																$datafound=1; // simulate datafound w7o
															}
													}
													else { print "$LDDbNoRead<br>"; } 
												}// end of if rows
											}// end of ergebnis 4
											else { print "$LDDbNoRead<br>"; } 
										} // end of else 3
									} // end of ergegnis 3
									else { print "$LDDbNoRead<br>"; } 
								}//end of else 2
							} // end of ergebnis 2
							else { print "$LDDbNoRead<br>"; }  
						}// end of else 1
							//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 	
					} // end of ergebnis 1
					else { print "$LDDbNoRead<br>"; } 
		
			
	//*************************************************************************************		

			break;// end of case search

	  case "get":
			$dbtable="mahopatient";
		 	$sql="SELECT patnum,name,vorname,gebdatum,address FROM $dbtable 
						WHERE  patnum='$patnum'
						AND name='$name'
						AND vorname='$vorname'
						AND gebdatum='$gebdatum'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$pdata=mysql_fetch_array($ergebnis);
					$datafound=1;
					$lname=$pdata[name];
					$fname=$pdata[vorname];
					$bdate=$pdata[gebdatum];
					//print $sql."<br>";
				}
			}
				else { print "$LDDbNoRead<br>"; }  
			break;// end of case search

	  default:
	 	 if(($mode=="saveok")||($mode=="edit")||($mode=="notimereset"))
	      {
	  		$dbtable="nursing_op_logbook";
		 	$sql="SELECT * FROM $dbtable 
					WHERE dept='$dept' 
						AND op_room='$saal' 
						AND patnum='$patnum'
						AND op_nr='$op_nr'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows==1)
				{
					mysql_data_seek($ergebnis,0);
					$pdata=mysql_fetch_array($ergebnis);
					$datafound=1;
					$lname=$pdata[lastname];
					$fname=$pdata[firstname];
					$bdate=$pdata[bday];
					//print $sql."<br>";
				}
				else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else { print "$LDDbNoRead<br>"; } 
		}/*
		else
		{		  
	   // default is to get the last entry number in the set dept and op room
	  		$dbtable="nursing_op_logbook";
		 	$sql="SELECT op_nr FROM $dbtable 
					WHERE dept='$dept' 
					AND op_room='$saal' 
					ORDER BY op_nr DESC";
//print $sql;
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $pdata=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$pdata=mysql_fetch_array($ergebnis);
					$op_nr=$pdata[op_nr]+1;
					//print $sql."<br>";
				}
				else
				{
					$op_nr=1;
				}
			}
				else { print "$LDDbNoRead<br>"; } 
	 	}*/
	 		break;
	  } // end of switch mode
}
  else { print "$LDDbNoLink<br>"; } 


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>OP Pflege Logbuch (Eingabefenster)</TITLE>

<script language="javascript">
<!-- 
function resettimebars()
{
	//window.parent.OPLOGIMGBAR.location.replace('oplogtimebar.php?filename=<? print $filename; ?>&rnd=<? print $r; ?>');
	window.parent.OPLOGIMGBAR.location.replace('<? print "oplogtimebar.php?sid=$ck_sid&lang=$lang&internok=$internok&patnum=".$pdata[patnum]."&op_nr=".$pdata[op_nr]."&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>');
}

function resettimeframe()
{
	//window.parent.OPLOGINPUT.location.replace('oplogtime.php?filename=<? print $filename; ?>&rnd=<? print $r; ?>');
	window.parent.OPLOGINPUT.location.replace('<? print "oplogtime.php?sid=$ck_sid&lang=$lang&internok=$internok&patnum=".$pdata[patnum]."&op_nr=".$pdata[op_nr]."&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";?>');
}

function resetlogdisplays()
{
	window.parent.OPLOGMAIN.location.replace('<? print "oplogmain.php?sid=$ck_sid&lang=$lang&internok=$internok&gotoid=".$pdata[op_nr]."&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday"; ?>');
}

function cleartimeframes()
{
	window.parent.OPLOGIMGBAR.location.replace('blank.htm');
	window.parent.OPLOGINPUT.location.replace('blank.htm');
}

function resetall()
{
	resetlogdisplays();resettimebars();resettimeframe();
}

function isnum(val,idx)
{
	xdoc=document.oppflegepatinfo;
	if (isNaN(val))
	{
		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		//if (!isNaN(xval3 + xval2)) {xval3=xval3 + xval2;}
		if (isNaN(xval2))
		 {
			xdoc.elements[idx].value=xval2;
			setTime(xdoc.elements[idx]);
			return;
			}
		}
		xdoc.elements[idx].value=xval3;

	}
	else
	{
		v3=val;
		if((v3==24)&&(v3.length==2)) v3="00";
		if (v3>24) 
		{

		
			switch(v3.length)
			{
			
				case 2: v1=v3.slice(0,1); v2=v3.slice(1,2);
						if(v2<6) v3="0"+v1+"."+v2; else v3=v3.slice(0,1); break;
				case 3: v1=val.slice(0,2); v2=val.slice(2,3);

						if(v2<6) v3=v1+"."+v2; 
							else v3=v3.slice(0,2);
						break;
				case 4: v3=val.slice(0,3); break;
			}
			
			
//			alert("Zeitangabe ist ungültig! (ausserhalb des 24H Zeitrahmens)");
	
		}
		switch(v3.length)
			{
				
				case 2: v1=v3.slice(0,1);v2=v3.slice(1,2);
						if(v2==".") v3="0"+v3;break;
		
				case 3: v1=v3.slice(0,2);v2=v3.slice(2,3);
						if(v2!=".") if(v2<6) v3=v1+"."+v2; else v3=v1; break;
				case 4: if(v3.slice(3,4)>5) v3=v3.slice(0,3); break;
			}
		if(v3.length>5) v3=v3.slice(0,v3.length-1);
		xdoc.elements[idx].value=v3;
	}
	
}
	
function isvalnum(val,idx)
{
	xdoc=document.oppflegepatinfo;

		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if (!isNaN(xval2)) 
			{
				xval3=xval3 + xval2;
				/*
				if (xval3.length>8) 
				{ 
				alert("Die Aufnahmenummer hat maximal 8 Ziffern!"); 
				xdoc.elements[idx].value=xval3.slice(0,8);
				return; }
				*/
			}
		}
		xdoc.elements[idx].value=xval3;
}

function isgdatum(val,idx)
{
	xdoc=document.oppflegepatinfo;

		xval3="";
		for(i=0;i<val.length;i++)
		{
		xval2=val.slice(i,i+1);
		if ((!isNaN(xval2))||(xval2=="."))
			{
				if(xval2==".")
				{
				 if(val.length>1) xval3=xval3+xval2;
				}
				else 
				{
					 xval3=xval3+xval2;					
				}
			}
		}
		switch (xval3.length)
		{
			case 2: v1=xval3.slice(0,1);
					v2=xval3.slice(1,2);
					if(v2==".")
					{
						if (v1==0) xval3=""; else xval3="0"+xval3;
					}
					else {
					if ((v1+v2)<1) xval3=""; 
						else if ((v1+v2)>31) xval3="0"+v1+"."+v2; 
							
					}
					 break;
			case 3: v1=xval3.slice(0,2);
					v2=xval3.slice(2,3);
					if (v2!=".") xval3=v1+"."+v2; 
					break;
			case 4: v1=xval3.slice(0,3);
					v2=xval3.slice(3,4);
					if (v2!=".") xval3=v1+v2; else xval3=v1;
					break;
			case 5: v1=xval3.slice(0,3);
					v2=xval3.slice(3,4);
					v3=xval3.slice(4,5);
					if (v3==".")
					{
						if (v2==0) xval3=v1+v2; 
							else xval3=v1+"0"+v2+v3;
					}
					else if((v2+v3)<1) xval3=v1+v2;
						else if((v2+v3)>12) xval3=v1+"0"+v2+"."+v3;
					break;
			case 6: v1=xval3.slice(0,5);
					v2=xval3.slice(5,6);
					if (v3!=".")
					{
						if (v2==0) xval3=v1 
							else xval3=v1+"."+v2;
					}
					break;
		}
 	if ((xval3.length>6)&&(xval3.slice(xval3.length-1,xval3.length)=="."))xval3=xval3.slice(0,xval3.length-1);
	if (xval3.length>10) xval3=xval3.slice(0,10);
	xdoc.elements[idx].value=xval3;

}

function checksubmit()
{
	
	xdoc=document.oppflegepatinfo;
	if ((xdoc.pname.value=="")&&(xdoc.gebdatum.value=="")&&(xdoc.patnum.value==""))
	{
		xdoc.patnum.focus();
	}
	else
	{	
	xdoc.submit();
	}
	return false;
}

function searchpat()
{
	d=document.oppflegepatinfo;
	window.location.href="<?="$thisfile?sid=$ck_sid&mode=search&patnum=" ?>"+d.patnum.value+"&pname="+d.pname.value+"&gebdatum="+d.gebdatum.value;

}

function getinfo(m)
{
	urlholder="<?="op-pflege-log-getinfo.php?sid=$ck_sid&lang=$lang&dept=$dept&saal=$saal&op_nr=$op_nr&patnum=$patnum&pday=$pday&pmonth=$pmonth&pyear=$pyear&winid=";?>"+m;
	getinfowin=window.open(urlholder,"getinfo","width=800,height=500,menubar=no,resizable=yes,scrollbars=yes");
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	x2=document.oppflegepatinfo.xx2.value;
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
function openfolder(pid,pdata){
	urlholder="pflege-station-patientdaten.php?sid=<? print "$ck_sid&lang=$lang"; ?>&pn="+pid+"&patient=" + pdata + "&station=<? print "$dept&pday=$pday&pmonth=$pmonth&pyear=$pyear&op_shortcut=$ck_op_pflegelogbuch_user"; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}

function openDRGComposite()
{
<? if($cfg['dhtml'])
	print '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	print '
			w=800;
			h=650;';
?>
	
	drgcomp_<?=$pdata[patnum]."_".$op_nr."_".$dept."_".$saal ?>=window.open("drg-composite-start.php?sid=<? print "$ck_sid&lang=$lang&display=composite&pn=$pdata[patnum]&ln=$lname&fn=$fname&bd=$bdate&opnr=$op_nr&dept=$dept&oprm=$saal"; ?>","drgcomp_<?=$pdata[patnum]."_".$op_nr."_".$dept."_".$saal ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.drgcomp_<?=$pdata[patnum]."_".$op_nr."_".$dept."_".$saal ?>.moveTo(0,0);
}
//-->
</script>

<script language="javascript" src="../js/showhide-div.js">
</script>
<script language="javascript" src="../js/setdatetime.js">
</script>

<style type="text/css">

.v10_n{font-family:verdana;font-size:10;color=#0000cc;}
</style>

</HEAD>

<BODY bgcolor="#cde1ec" topmargin=0 leftmargin=0 marginwidth=0 onLoad="
<? 
switch($mode)
{
	case "saveok": print 'resetall();';
						//print 'resettimebars();resettimeframe();reseteditmain();';			
						break;
	//case "save": print 'resetall();';break;
	case "fresh": print 'resetlogdisplays();cleartimeframes();';break;
	case "chgdept": break;
	case "notimereset": break;
	case "search": break;
	case "edit": print 'resettimebars();resettimeframe();'; break;
	default: print 'resetlogdisplays();';
}
if(!$datafound) print 'document.oppflegepatinfo.patnum.focus();';
?>
"  marginheight="0" bgcolor="silver" alink="#0000ff" vlink="#0000ff" link="#0000ff" >

<FORM METHOD="post" ACTION="oploginput.php?mode=save" name="oppflegepatinfo" onSubmit="return checksubmit()">

<TABLE  CELLPADDING=0 CELLSPACING=0 border=0 width=100%>
<TR><TD bgcolor=navy>

<font face=verdana,arial size=1 color="#ffffff">
<? if($op_nr) : ?>
	<?=$LDOpNr ?> <FONT face=arial COLOR="yellow"  SIZE="3" ><b> <? print $op_nr; ?> </b></FONT>
<? endif ?>

<?=$LDDate ?>: 

<?
	print '
			<font size="2" face="arial">'.$pday.'.'.$pmonth.'.'.$pyear.'</font>'; 
?>

&nbsp;
<? if($datafound) : ?>
<!--  <input type="submit" value="save" name="versand"> -->
<a href="javascript:document.oppflegepatinfo.submit()"><img src="../img/<?="$lang/$lang" ?>_savedisc.gif" border=0 width=99 height=24 align=absmiddle alt="<?=$LDSaveLatest ?>"></a>
<? endif ?>
</TD>

<td align=right bgcolor="navy" >
<? if($datafound) : ?>
<a href="oploginput.php?sid=<?="$ck_sid&lang=$lang&dept=$dept&saal=$saal" ?>&mode=fresh">
<img src="../img/<?="$lang/$lang" ?>_newpat2.gif" width=130 height=24 border=0 align=absmiddle alt="<?=$LDStartNewDocu ?>"></a>
<? endif ?>
<? if($op_nr) : ?>
<DIV id=dFunctions 
style=" VISIBILITY: hidden; POSITION: absolute; top:20px">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0>
  <TR>
    <TD>
      <TABLE cellSpacing=1 cellPadding=7 width="100%" bgColor=#ffccee 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffccee><font face=arial size=2><nobr>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)"  onClick="document.oppflegepatinfo.xx2.value='drg'"
            href="javascript:openDRGComposite()">
			<img src="../img/redpfeil.gif" width=4 height=7 border=0 align=absmiddle> <?=$LDPerformance ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)"  onClick="document.oppflegepatinfo.xx2.value='material'"
            href="op-logbuch-material-parentframe.php?sid=<?print "$ck_sid&op_nr=$op_nr&patnum=$pdata[patnum]&dept=$dept&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>" target="OPLOGMAIN">
			<img src="../img/redpfeil.gif" width=4 height=7 border=0 align=absmiddle> <?=$LDUsedMaterial ?>
            </A><BR>
		  <A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)"    onClick="document.oppflegepatinfo.xx2.value='container'"
            href="op-logbuch-material-parentframe.php?sid=<?print "$ck_sid&mode=cont&op_nr=$op_nr&patnum=$pdata[patnum]&dept=$dept&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>" target="OPLOGMAIN">
			<img src="../img/redpfeil.gif" width=4 height=7 border=0 align=absmiddle> <?=$LDContainer ?>
            </A><BR>
			<A onmouseover=clearTimeout(timer) 
            onmouseout="timer=setTimeout('hsm()',500)" 
            href="oplogmain.php?sid=<? print "$ck_sid&op_nr=$op_nr&patnum=$pdata[patnum]&dept=$dept&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>" target="OPLOGMAIN">
			<img src="../img/redpfeil.gif" width=4 height=7 border=0 align=absmiddle> <?=$LDShowLogbook ?>
            </A><BR></nobr></TD></TR></TABLE></TD></TR></TBODY></TABLE></DIV>
<a href="javascript:ssm('dFunctions'); clearTimeout(timer)" 
      onmouseout="timer=setTimeout('hsm()',1000)" ><FONT  COLOR="white"  SIZE=3 face=verdana,arial >
	  <img src="../img/<?="$lang/$lang" ?>_funktion.gif" border=0 width=103 height=24  align="absmiddle" alt="<?=$LDClk2DropMenu ?>"></a>

<? endif ?>

<DIV id=dLogoTable 
style=" VISIBILITY: hidden; POSITION: absolute; top:20px">
<TABLE cellSpacing=1 cellPadding=0 bgColor=#000000 border=0>
  <TR>
    <TD>
      <TABLE cellSpacing=1 cellPadding=7 width="100%" bgColor=#ffccee 
        border=0><TBODY>
        <TR>
          <TD bgColor=#ffccee><font face=arial size=2><nobr>
		  <img src="../img/redpfeil.gif" width=4 height=7 border=0 align=absmiddle> 
			<A onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-xtsuch-start.php?sid=<?print "$ck_sid&lang=$lang&internok=$internok&dept=$dept&saal=$saal"; ?>&user=<?print str_replace(' ','+',$op_pflegelogbuch_user); ?>" target="_parent"><?=$LDSearchPatient ?>
            </A><BR>
			<img src="../img/redpfeil.gif" width=4 height=7 border=0 align=absmiddle>  
			 <A onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" 
            href="op-pflege-logbuch-arch-start.php?sid=<?print "$ck_sid&lang=$lang&internok=$internok&dept=$dept&saal=$saal"; ?>&user=<?print str_replace(' ','+',$op_pflegelogbuch_user); ?>"  target="_parent"><?=$LDArchive ?>
			</A>
	</nobr><BR></TD></TR></TABLE></TD></TR></TBODY></TABLE></DIV>

<a href="javascript:ssm('dLogoTable'); clearTimeout(timer)" 
      onmouseout="timer=setTimeout('hsm()',1000)" ><FONT  COLOR="white"  SIZE=3 face=verdana,arial >
	  <img src="../img/<?="$lang/$lang" ?>_archive.gif" width=103 height=24 border=0 align=absmiddle alt="<?=$LDClk2DropMenu ?>"></a>

<a href="javascript:gethelp('oplog.php','create','<?=$mode ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" alt="<?=$LDHelp ?>"></a>
<a href="javascript:if(!window.parent.opener.closed)window.parent.opener.focus();window.parent.close();">
<img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" alt="<?=$LDClose ?>"></a><br>
</td>
</TR>
</TABLE>

<?
if(($mode=="search")&&!$datafound)
{
	print '
			<center>
			
				<table cellpadding=0 cellspacing=0 border=0 >
				<tr>
				<td>	
			<img src="../img/catr.gif" border=0 width=88 height=80 align=middle>
			</td>
				<td valign=top>
				<table cellpadding=1 cellspacing=0 border=0 >
				<tr>
				<td bgcolor="#999999">
				<table cellpadding=10 cellspacing=0 border=0 bgcolor="#eeeeee">
				<tr ><td >';
				
	if($rows)
	{
	print '<font  face=verdana,arial>
			<font color="#800000" size=4>'.$LDPlsClk1.'</font>
			<font size=2 ><br>';
		/*
		print '<br>Aber, folgende ';
		if($rows==1) print 'Eintragung entspricht';
		else print 'Eintragungen entsprechen';
		print ' dem gesuchten am nähesten.<p>';
		*/
		while($pdata=mysql_fetch_array($ergebnis))
		{
				print "
						<a href=\"oploginput.php?sid=$ck_sid&lang=$lang&mode=get&patnum=$pdata[patnum]&name=$pdata[name]&vorname=$pdata[vorname]&gebdatum=$pdata[gebdatum]&dept=$dept&saal=$saal&op_nr=$op_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear\">";
				print '<img src="../img/arrow.gif" border=0 width=15 height=15 align=middle>';
				if($ndl_name&&stristr($pdata[name],$ndl_name)) print '<u><b><span style="background:yellow"> '.$pdata['name'].'</span></b></u>';
 					else print $pdata['name'];				
 				print ', ';
				if($ndl_vname&&stristr($pdata[vorname],$ndl_vname)) print '<u><b><span style="background:yellow"> '.$pdata['vorname'].'</span></b></u>';
 					else print $pdata['vorname'];				
 				print ' (';
				if($ndl_bday&&stristr($pdata[gebdatum],$ndl_bday)) print '<u><b><span style="background:yellow"> '.$pdata['gebdatum'].'</span></b></u>';
 					else print $pdata['gebdatum'];				
 				print ')<br> ';
		}	
		
	}
	else
	{
	print '<font  face=verdana,arial>
			<font color="#800000" size=4>'.$LDPatientNotFound.'</font>
			<font size=2 ><br>'.$LDPlsEnoughData;
	}
	print '		</td>
				</tr>
				</table>
				</td>
				</tr>
				</table>
				</td>
			
			</tr>
			</table>
			</center>
			';
}
?>

<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="internok" value="<? print $internok; ?>">
<input type="hidden" name="encoder" value="<? print $ck_op_pflegelogbuch_user; ?>">
<input type="hidden" name="op_nr" value="<? print $op_nr; ?>">
<input type="hidden" name="pmonth" value="<? print $pmonth; ?>">
<input type="hidden" name="pyear"  value="<? print $pyear; ?>">
<input type="hidden" name="op_date"  value="<? print $pday.".".$pmonth.".".$pyear; ?>">
<input type="hidden" name="pday" value="<? print $pday; ?>">
<input type="hidden" name="dept" value="<? print $dept; ?>">
<input type="hidden" name="saal" value="<? print $saal; ?>">
<input type="hidden" name="xx2" value="">

<table border=0 bgcolor="#9c9c9c" cellpadding=0 cellspacing=0>
  <tr>
    <td>

<TABLE  CELLPADDING=1 CELLSPACING=1 border=0 class="v10_n">
<tr bgcolor="#fefefe" height=180>
	<TD valign="top" width=150><font face=verdana,arial size=1>

<?
 if($pdata[patnum]=="")
 	{
	 print $LDPatientNr.': <br>
		<INPUT NAME="patnum" TYPE="text" VALUE="" onKeyUp="isvalnum(this.value,this.name)" SIZE="9" ><br>
		'.$LDLastName.', '.$LDName.'<br>
		<INPUT NAME="pname" TYPE="text" VALUE="" SIZE="20"><BR>
		'.$LDBday.'<br>
		<INPUT NAME="gebdatum" TYPE="text" VALUE="" SIZE="20" onKeyUp="isgdatum(this.value,this.name)"><p>
		<center><input type="submit" value="'.$LDSearchPatient.'"></center>
		<input type="hidden" name="mode" value="search">
		';
	}
	else
	{ print '
		<a href="javascript:openfolder(\''.$pdata[patnum].'\')">
		<img src="../img/info2.gif" width=16 height=16 border=0 alt="'.str_replace("~tagword~",$lname,$LDOpenPatientFolder).'"></a>
		<font color="#000000" size=2>'.$pdata[patnum].'</font><br>
		<font  size=2>'.strtr($lname,"+"," ").', '.strtr($fname,"+"," ").'</font><br>
		<font color="#000000" >'.$bdate.'</font><p>
		<font color="#000000">'.nl2br(strtr($pdata[address],"+"," ")).'</font>
		<input type="hidden" name="patnum" value="'.$pdata[patnum].'">
  		<input type="hidden" name="name" value="'.$lname.'">
    	<input type="hidden" name="vorname" value="'.$fname.'">
    	<input type="hidden" name="gebdatum" value="'.$bdate.'">
    	<input type="hidden" name="address" value="'.stripslashes($pdata[address]).'">
		<input type="hidden" name="mode" value="save">';
	}
?> 
	</TD>

<TD valign="top" width=130><font face=verdana,arial size=1  color="<? if($datafound) print "#0000cc"; else print "#3f3f3f"; ?>">

<? if($datafound)
	{
	 print '<a href="drg-icd10.php?sid='.$ck_sid.'&lang='.$lang;
	 print "&pn=$pdata[patnum]&ln=$lname&fn=$fname&bd=$bdate&opnr=$op_nr&dept=$dept&oprm=$saal";
	 print '" target="OPLOGMAIN">'.$LDDiagnosis.':</a><br>
<textarea name="diagnosis" cols=16 rows=10 wrap="physical" >'.stripcslashes($pdata[diagnosis]).'</textarea>';
	}
	else print $LDDiagnosis;
?>
</TD>

<TD valign=top width=140 >
<? 
if($datafound) 
{
	print'
	<font face=verdana,arial size=1 color="#000000">';

	$ebuf=array("operator","assistant","scrub_nurse","rotating_nurse");
	$jbuf=array("operator","assist","scrub","rotating");
	$tbuf=array("O","A","I","S");
	//$cbuf=array("Operateur","Assistent","Instrumenteur","Springer");
	for($n=0;$n<sizeof($ebuf);$n++)
	{
		print '<a href="javascript:getinfo(\''.$jbuf[$n].'\')">'.$cbuf[$n].'</a><br>';
		if(!$pdata[$ebuf[$n]])
		{ print "<br>"; continue;}
		$dbuf=explode("~",$pdata[$ebuf[$n]]);
		for($i=0;$i<sizeof($dbuf);$i++)
		{
			parse_str(trim($dbuf[$i]),$elems);
			if($elems[n]=="") continue;
			else print '&nbsp;'.$elems[n]." ".$tbuf[$n].$elems[x]."<br>";
		}
	}	
}
 else
 {
	print '
	<font face=verdana,arial size=1 color="#3f3f3f">';
		while(list($x,$v)=each($cbuf)) print "$v<p>";
}
?>

</TD>

<TD valign=top width=150>
<font face=verdana,arial size=1  color="<? if($datafound) print "#0000cc"; else print "#3f3f3f"; ?>">
<? if($datafound) : ?>
<?=$LDAna ?><br>
	<select NAME="anesthesia"   SIZE="1">
	<?
		while(list($x,$v)=each($LDAnaTypes))
		{
		 print '
		<option value="'.$x.'"';
		if($pdata[anesthesia]==$x) print " selected";
		print '>'.$v.'</option>';
		}
	?>
	</select>
	

<BR>
	<a href="javascript:getinfo('ana')"><?=$LDAnaDoc ?></a><br>
	<?
		if($pdata[an_doctor])
		{ 
			print '<font color="#000000">';
			$dbuf=explode("~",$pdata[an_doctor]);
			for($i=0;$i<sizeof($dbuf);$i++)
			{
				parse_str(trim($dbuf[$i]),$elems);
				if($elems[n]=="") continue;
				else print '&nbsp;'.$elems[n]." N".$elems[x]."<br>";
			}
			print '</font>';
		}
	?>
<? else : ?>
	<?="$LDAna<p>$LDAnaDoc" ?>
<? endif ?>

	<p>

<table cellpadding="0" cellspacing="0" border=0 width=100% class="v10_n"> 
<tr>
<td>
<? $eo=explode("~",$pdata[entry_out]);
	for($i=0;$i<sizeof($eo);$i++)
	{
	parse_str($eo[$i],$eobuf);
	if(trim($eobuf[s])) break;
	}
	 $cc=explode("~",$pdata[cut_close]);
	for($i=0;$i<sizeof($cc);$i++)
	{
	parse_str($cc[$i],$ccbuf);
	if(trim($ccbuf[s])) break;
	}
?>

<font face=verdana,arial size=1 color="<? if($datafound) print "#0000cc"; else print "#3f3f3f"; ?>">
	<?=$LDOpCut ?>:
	<? if($datafound) : ?>
	<br><INPUT NAME="cut_time" TYPE="text" VALUE="<? print $ccbuf[s]; ?>" SIZE="6" onKeyUp="isnum(this.value,this.name)"> 
	<? else : ?>
	<p>
	<? endif ?>
	<BR>
	<?=$LDOpClose ?>:
	<? if($datafound) : ?>
	<br><INPUT NAME="close_time" TYPE="text" VALUE="<? print $ccbuf[e]; ?>" SIZE="6" onKeyUp="isnum(this.value,this.name)">
	<? endif ?>
</td>
<td><font face=verdana,arial size=1 color="<? if($datafound) print "#0000cc"; else print "#3f3f3f"; ?>">
	<?=$LDOpInFull ?>:
	<? if($datafound) : ?>
	<br><INPUT NAME="entry_time" TYPE="text" VALUE="<? print $eobuf[s]; ?>" SIZE="6" onKeyUp="isnum(this.value,this.name)"> 
	<? else : ?>
	<p>
	<? endif ?>
	<BR>
	<?=$LDOpOutFull ?>:
	<? if($datafound) : ?>
	<br><INPUT NAME="exit_time" TYPE="text" VALUE="<? print $eobuf[e]; ?>" SIZE="6" onKeyUp="isnum(this.value,this.name)">
	<? endif ?>
</td>
</tr>
</table>



</TD>


<TD valign="top" width=160><font face=verdana,arial size=1 
color="<? if($datafound) print "#0000cc"; else print "#3f3f3f"; ?>">
<? if($datafound) 
	{
	 print '<a href="drg-ops301.php?sid='.$ck_sid.'&lang='.$lang;
	 print "&pn=$pdata[patnum]&ln=$lname&fn=$fname&bd=$bdate&opnr=$op_nr&dept=$dept&oprm=$saal";
	print '" target="OPLOGMAIN">'.$LDTherapy.'/'.$LDOperation.'</a><br>
	<TEXTAREA NAME="op_therapy" COLS="18" ROWS="10">'.stripcslashes($pdata['op_therapy']).'</TEXTAREA>';
	}
	else print $LDTherapy.'/'.$LDOperation;
?>
</TD>


<TD valign="top" width=140><font face=verdana,arial size=1 color="<? if($datafound) print "#0000cc"; else print "#3f3f3f"; ?>"><?=$LDOpMainElements[result] ?><br>
<? if($datafound) print '
<TEXTAREA NAME="result_info" Content-Type="text/html"
	COLS="18" ROWS="10">'.stripcslashes($pdata['result_info']).'</TEXTAREA>';
?>
</TD>




</TR>
	


</TABLE>
</td>
  </tr>
</table>



</FORM>


</BODY>
</HTML>
