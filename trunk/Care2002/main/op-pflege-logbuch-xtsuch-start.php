<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if (!$internok&&!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");

//setcookie(op_pflegelogbuch_user,$user);
$thisfile="op-pflege-logbuch-xtsuch-start.php";
$breakfile="javascript:window.close()";
if(!$xdept) $xdept=$dept;
if(!$xsaal) $xsaal=$saal;
require("../req/config-color.php");

if($srcword!="")
{
	if(is_numeric($srcword)) $srcword=(int) $srcword;

	$dbtable="nursing_op_logbook";

	include("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
	{	
	  if($mode=="get")
	   {
		 		$sql="SELECT  * FROM $dbtable 
							WHERE lastname='$lastname'
							AND firstname='$firstname'
							AND bday='$bday'
							AND dept='$dept'
							AND op_nr='$op_nr'";

				if($ergebnis=mysql_query($sql,$link))
       			{
					$rows=0;
					//print "<p>$sql get";
					while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
					if($rows)
					{
						mysql_data_seek($ergebnis,0); //reset the variable
						$datafound=1;
					}
	           }else { print "$LDDbNoRead<br>$sql"; }
       }
	   elseif(!$rows||($mode!="get"))
	   {
			//********************************** start searching ***************************************
		$filtered=strtolower(trim($srcword));
		$dept_src="";
		$tag=array("@","#");
		$cond=array("=","<>");
		$filter_src=array("plop","hnop","allg_op","unfall_op","gyn_op","augen_op");

		for($n=0;$n<2;$n++)
		{
			for($i=0;$i<sizeof($filter_src);$i++)
				if(stristr($filtered,$tag[$n].$filter_src[$i]))
				 { 
					if($dept_src=="") $dept_src="dept$cond[$n]'$filter_src[$i]'";
			 			else $dept_src.=" AND dept$cond[$n]'$filter_src[$i]'";
		 			$filtered=str_replace($tag[$n].$filter_src[$i],"",$filtered);
				}
		
			$filter2_src=array("a","b","15","14","13","12","11","10","9","8","8","7","5","3","2","1");

			for($i=0;$i<sizeof($filter2_src);$i++)
				if(stristr($filtered,$tag[$n].$filter2_src[$i]))
				 { 
					if($dept_src=="") $dept_src="op_room$cond[$n]'$filter2_src[$i]'";
					 else $dept_src.=" AND op_room$cond[$n]'$filter2_src[$i]'";
		 			 $filtered=str_replace($tag[$n].$filter2_src[$i],"",$filtered);
				}
			$fbuf=explode(" ",$filtered);
		}
		
		for($i=0;$i<sizeof($fbuf);$i++)
		if(stristr($fbuf[$i],"@")) 
		{
			array_splice($fbuf,$i,1); 
			break;
		}

		for($i=0;$i<sizeof($fbuf);$i++)
		if(stristr($fbuf[$i],"#")) 
		{
			array_splice($fbuf,$i,1); 
			break;
		}
		array_unique($fbuf);
		//print "$dept_src $filtered";
		$filtered=implode(" ",$fbuf);
		$srcword=trim($filtered);

		$findname="0";
		$findvname="0";
		$findbday="0";
		$validpnum=false;
		$ndl_name="";
		$ndl_vname="";
		$ndl_bday="";
		$ndl_pnum="";
	
	
		//filter unwanted words
		$filter=file("ai/filters/person2-filter.txt");
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
													if($id_src=="") $id_src="lastname='$ndl_name'";
								 						else $id_src.=" AND lastname='$ndl_name'";
													break;
								case "110":
													if($id_src=="") $id_src="lastname='$ndl_name' AND firstname='$ndl_vname'";
								 						else $id_src.=" AND lastname='$ndl_name' AND firstname='$ndl_vname'";
													break;
								case "111":
													if($id_src=="") $id_src="lastname='$ndl_name' AND firstname='$ndl_vname' AND bday='$ndl_bday'";
								 						else $dept_src.=" AND lastname='$ndl_name' AND firstname='$ndl_vname' AND bday='$ndl_bday'";
													break;
								case "010":
													if($id_src=="") $id_src="firstname='$ndl_vname'";
								 						else $id_src.=" AND firstname='$ndl_vname'";
													break;
								case "011":
													if($id_src=="") $id_src="firstname='$ndl_vname' AND bday='$ndl_bday'";
								 						else $id_src.=" AND firstname='$ndl_vname' AND bday='$ndl_bday'";
													break;
								case "001":
													if($id_src=="") $id_src="bday='$ndl_bday'";
								 						else $id_src.=" AND bday='$ndl_bday'";
								case "101":
													if($id_src=="") $id_src="lastname='$ndl_name' AND bday='$ndl_bday'";
								 						else $id_src.=" AND lastname='$ndl_name' AND bday='$ndl_bday'";
													break;
								default: $id_src="lastname='$filtered'";
							}
			}
				//******************************** 				
			
				$sql="SELECT * FROM $dbtable WHERE ";
				if($dept_src) $sql.=$dept_src ."AND (".$id_src.")";
				  else $sql.=$id_src;
				 $sql.=" ORDER BY op_nr DESC";
				//print "<p>$sql AND rule";
				if($ergebnis=mysql_query($sql,$link)) // ergebnis 1
       			{
					$rows=0;
					while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
					if($rows)
					{
						mysql_data_seek($ergebnis,0); //reset the variable
						$datafound=1;
					}
					else // else 1
					{
						$id_src=str_replace("AND","OR",$id_src);
						$sql="SELECT * FROM $dbtable WHERE ";
						if($dept_src) $sql.=$dept_src ."AND (".$id_src.")";
				 			 else $sql.=$id_src;
						//print $rows;
						//print "<p>$sql OR Rule";
						$sql.=" ORDER BY op_nr DESC";
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
									$sql="SELECT * FROM $dbtable WHERE ";
									if($ndl_name) $id_src="lastname LIKE '$ndl_name%'";
										else $id_src="";
									if($ndl_vname) 
										if($id_src) $id_src.=" OR firstname LIKE '$ndl_vname%'";
											else $id_src="firstname LIKE '$ndl_vname%'";
									if($ndl_bday) 
										if($id_src) $id_src.=" OR bday LIKE '$ndl_bday%'";
											else $id_src="bday LIKE '$ndl_bday%'";
					/*				if($ndl_pnum) 
										if($id_src) $id_src.=" OR patnum LIKE '$ndl_pnum%'";
											else $id_src="patnum LIKE '$ndl_pnum%'";
						*/
									if(!$id_src) $id_src="lastname LIKE '$filtered%'";
									if($dept_src) $sql.=$dept_src." AND (".$id_src.")";
									 	else $sql.=$id_src;
									//print "<p>$sql  % Rule";
					 			$sql.=" ORDER BY op_nr DESC";
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
											$sql="SELECT * FROM $dbtable WHERE ";
											if($ndl_name!="") $id_src="lastname LIKE '_%'";
												else $id_src="";
											if($ndl_vname) 
												if($id_src!="") $id_src.=" OR firstname LIKE '_%'";
													else $id_src="firstname LIKE '_%'";
											if($ndl_bday) 
												if($id_src!="") $id_src.=" OR bday LIKE '_%'";
													else $id_src="bday LIKE '_%'";
											if(!$id_src) $id_src="lastname LIKE '_%' OR firstname LIKE '_%' OR bday LIKE '_%'";
											$sql.=$id_src;
					 					$sql.=" ORDER BY op_nr DESC";
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
															$sx2=soundex($bufdata['lastname']);
															$sx3=soundex($bufdata['firstname']);
															$st1=similar_text($sx1,$sx2,&$pc1);
															$st2=similar_text($sx1,$sx3,&$pc2);
															//	print "p1: ".$pc1." p2: ".$pc2."<p>";

															if(($pc1>=75)||($pc2>=75)) 
																if($id_src!="")
																{
																	if(!substr_count($id_src,"lastname LIKE '$bufdata[lastname]'"))
																		 $id_src.=" OR lastname LIKE '$bufdata[lastname]'";
																 }
																	else $id_src="lastname LIKE '$bufdata[lastname]'";
														}
														if($ndl_vname)
														{
															$sx1=soundex($ndl_vname);
															$sx2=soundex($bufdata['lastname']);
															$sx3=soundex($bufdata['firstname']);
															$st1=similar_text($sx1,$sx2,&$pc1);
															$st2=similar_text($sx1,$sx3,&$pc2);
																//print "p1: ".$pc1." p2: ".$pc2."<p>";

															if(($pc1>=75)||($pc2>=75)) 
																if($id_src!="")
																{
																	if(!substr_count($id_src,"firstname LIKE '$bufdata[firstname]'"))
																		 $id_src.=" OR firstname LIKE '$bufdata[firstname]'";
																 }
																	else $id_src="firstname LIKE '$bufdata[firstname]'";
														}
														if($ndl_bday)
														{
															$sx1=soundex($ndl_bday);
															$sx2=soundex($bufdata['bday']);
															$st1=similar_text($sx1,$sx2,&$pc1);
																//print "p1: ".$pc1." p2: ".$pc2."<p>";

															if($pc1>=75) 
																if($id_src) 
																{
																	if(!substr_count($id_src,"bday LIKE '$bufdata[bday]'"))
																		 $id_src.=" OR bday LIKE '$bufdata[bday]'";
																 }
																	else $id_src="bday LIKE '$bufdata[bday]'";
														}
													}// end of while
													$rows=0;
													$sql="SELECT * FROM $dbtable WHERE ";
													if($dept_src) $sql.=$dept_src." AND (".$id_src.")";
									 						else $sql.=$id_src;
													//print "<p>$sql wild guess";
						 							$sql.=" ORDER BY op_nr DESC";
											if($id_src)
													if($ergebnis=mysql_query($sql,$link))
       												{
														while( $pdata=mysql_fetch_array($ergebnis)) $rows++;
														if($rows)
															{
															mysql_data_seek($ergebnis,0); //reset the variable
															}
													}
													else{ print "$LDDbNoRead<br>$sql"; }
												}// end of if rows
											}// end of ergebnis 4
											else { print "$LDDbNoRead<br>$sql"; }
										} // end of else 3
									} // end of ergegnis 3
									else { print "$LDDbNoRead<br>$sql"; }
								}//end of else 2
							} // end of ergebnis 2
							else { print "$LDDbNoRead<br>$sql"; }
						}// end of else 1
							//else print "<p>".$sql."<p>Multiple entries found pls notify the edv."; 	
					} // end of ergebnis 1
					else { print "$LDDbNoRead<br>$sql"; }
			
		} // end of else if mode== get

	}
  	else { print "$LDDbNoLink<br>"; } 
} //end of if (srcword!="")
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?="$LDSearch - $LDOrLogBook" ?></TITLE>

<script  language="javascript">
<!-- 

var wwin;
var lock=true;
var nodept=false;

function pruf(f)
{
 d=f.srcword.value;
 if((d=="")||(d.length<3)) return false;
 else return true;
}

function open_such_editwin(filename,y,m,d,dp,sl)
{
	url="op-pflege-logbuch-arch-edit.php?mode=edit&fileid="+filename+"&sid=<? print $ck_sid; ?>&user=<?print str_replace(" ","+",$user); ?>&pyear="+y+"&pmonth="+m+"&pday="+d+"&dept="+dp+"&saal="+sl;
<? if($cfg['dhtml'])
	print '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	print '
			w=800;';
?>
	sucheditwin=window.open(url,"sucheditwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=400");
	window.sucheditwin.moveTo(0,0);
}

function waitwin()
{
	wwin=window.open("waitwin.htm","wait","menubar=no,resizable=no,scrollbars=no,width=400,height=200");
}
function getinfo(pid,dept,pdata){
	urlholder="pflege-station-patientdaten.php?sid=<? print "$ck_sid&lang=$lang"; ?>&pn="+pid+"&patient=" + pdata + "&station="+dept+"&op_shortcut=<?=strtr($ck_op_pflegelogbuch_user," ","+") ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
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


 <? if($cfg['dhtml'])
{ print' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>
	
	<STYLE TYPE="text/css">
	A:link  {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	A:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited {text-decoration: none; color: '.$cfg['body_txtcolor'].';}
	A:visited:active {text-decoration: none; color: '.$cfg['body_alink'].';}
	A:visited:hover {text-decoration: underline; color: '.$cfg['body_hover'].';}
	</style>';
}

?>


</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();document.suchform.srcword.select();"
<? 
 print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
  ?> onUnload="if (wwin) wwin.close();">
 
 

<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor=<? print $cfg['top_bgcolor']; ?>>
<FONT  COLOR="<?print $cfg['top_txtcolor'];?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp;<?="$LDOrLogBook - $LDSearch" ?></STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<!-- <a href="javascript:window.history.back()"><img src="../img/<?="$lang/$lang" ?>_back2.gif" width=110 height=24 border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --><a href="javascript:gethelp('oplog.php','search','<?=$mode ?>','<?=$rows ?>','<?=$datafound ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?=$breakfile ?>" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</nobr>
</td>
</tr>
<tr>
<td colspan=3  bgcolor=<? print $cfg['body_bgcolor']; ?>><p><br>


<FONT    SIZE=-1  FACE="Arial">
<?
if((($mode=="get")||($datafound))&&$rows)
{

	if($rows>1) print $LDPatLogbookMany;
		else print $LDPatLogbook;

print '
		<table cellpadding="0" cellspacing="0" border="0" bgcolor="#999999" width="100%">
		<tr><td>
		<table  cellpadding="3" cellspacing="1" border="0" width="100%">
		';	
print '
		<tr bgcolor="#bbbbbb" >';
	while(list($x,$v)=each($LDOpMainElements))
	{
		print '		
		<td><font face="verdana,arial" size="1" ><b>'.$v.'</b></td>';	
	}
print '
		</tr>';
		
while($pdata=mysql_fetch_array($ergebnis))
	{
		print '
				<tr>
				<td colspan=9><font size=2>'.$LDDepartment.'<font color="#eeeeee">'.strtoupper($pdata[dept]).'</font> '.$LDOrRoom.' <font color="#eeeeee">'.strtoupper($pdata[op_room]).'</font></font>
				</td></tr>';

	if ($toggler==0) 
		{ print '<tr bgcolor="#fdfdfd">'; $toggler=1;} 
		else { print '<tr bgcolor="#eeeeee">'; $toggler=0;}
	print '
			<a name="'.$pdata['patnum'].'"></a>';
	list($iday,$imonth,$iyear)=explode(".",$pdata[op_date]);
	print '
			<td valign=top><font face="verdana,arial" size="1" ><font size=2 color=red><b>'.$pdata['op_nr'].'</b></font><hr>'.$pdata['op_date'].'<br>
			'.$tage[date("w",mktime(0,0,0,$imonth,$iday,$iyear))].'<br>
			<a href="op-pflege-logbuch-start.php?sid='.$ck_sid.'&lang='.$lang.'&mode=saveok&patnum='.$pdata[patnum].'&op_nr='.$pdata[op_nr].'&dept='.$pdata[dept].'&saal='.$pdata[op_room].'&pyear='.$iyear.'&pmonth='.$imonth.'&pday='.$iday.'">
			<img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0 alt="'.str_replace("~tagword~",$pdata['lastname'],$LDEditPatientData).'"></a>
			</td>';
	
	print '
			<td valign=top><nobr>&nbsp;<font face="verdana,arial" size="1" color=blue>
			<a href="javascript:getinfo(\''.$pdata[patnum].'\',\''.$pdata[dept].'\')">
			<img src="../img/info2.gif" width=16 height=16 border=0 alt="'.str_replace("~tagword~",$pdata['lastname'],$LDOpenPatientFolder).'"></a> '.$pdata['patnum'].'<br>';
	print '
			<font color=black><b>'.$pdata['lastname'].', '.$pdata['firstname'].'</b><br>'.$pdata['bday'].'<br>'.nl2br(stripcslashes($pdata['address'])).'</td>';
	print '
			<td valign=top><font face="verdana,arial" size="1" >';
	print '
	<font color="#cc0000">'.$LDOpMainElements[diagnosis].':</font><br>';
	print nl2br($pdata['diagnosis']);
	print '
			</td><td valign=top><font face="verdana,arial" size="1" ><nobr>';
			
	$ebuf=array("operator","assistant","scrub_nurse","rotating_nurse");
	//$tbuf=array("O","A","I","S");
	//$cbuf=array("Operateur","Assistent","Instrumenteur","Springer");
	for($n=0;$n<sizeof($ebuf);$n++)
	{
		if(!$pdata[$ebuf[$n]]) continue;
		print '<font color="#cc0000">'.$cbuf[$n].'</font><br>';
		$dbuf=explode("~",$pdata[$ebuf[$n]]);
		for($i=0;$i<sizeof($dbuf);$i++)
		{
			parse_str(trim($dbuf[$i]),$elems);
			if($elems[n]=="") continue;
			else print '&nbsp;'.$elems[n]." ".$tbuf[$n].$elems[x]."<br>";
		}
	}	
	print '
	</td>
	<td valign=top><font face="verdana,arial" size="1" >'.$LDAnaTypes[$pdata['anesthesia']].'<p>';
	if($pdata[an_doctor])
		{ 
			print '<font color="#cc0000">'.$LDAnaDoc.'</font><br><font color="#000000">';
			$dbuf=explode("~",$pdata[an_doctor]);
			for($i=0;$i<sizeof($dbuf);$i++)
			{
				parse_str(trim($dbuf[$i]),$elems);
				if($elems[n]=="") continue;
				else print '&nbsp;'.$elems[n].' '.$LDAnaPrefix.$elems[x].'<br>';
			}
			print '</font>';
		}
			
	 $eo=explode("~",$pdata[entry_out]);
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

			
	print '
	</td>
	<td valign=top><font face="verdana,arial" size="1" >';
	print '<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpCut.':</font><br>'.$ccbuf[s].'<p>
	<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpClose.':</font><br>'.$ccbuf[e].'</td>';
	print '
	<td valign=top><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements[therapy].':<font color=black><br>'.nl2br($pdata['op_therapy']).'</td>';
	print '
	<td valign=top><nobr><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements[result].':<br>';
	print '<font color=black>'.nl2br($pdata['result_info']).'</td>';
	print '
	<td valign=top><font face="verdana,arial" size="1" >';
	print '<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpIn.':</font><br>'.$eobuf[s].'<p>
	<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpOut.':</font><br>'.$eobuf[e].'</td>';
	print '
	</tr>';

	}

print '
		</table>
		</td>
		</tr>
		</table>
		';
}
else
if($mode=="search")
{
	
	print '
			<center>
			
				<table cellpadding=0 cellspacing=0 border=0 >
				<tr>
				<td valign=top>
				<table cellpadding=1 cellspacing=0 border=0 >
				<tr>
				<td bgcolor=#999999>
				<table cellpadding=10 cellspacing=0 border=0 bgcolor=#eeeeee>
				<tr ><td >';
	print '
			<font color="#800000" size=4>'.$LDInfoNotFound.'</font>';
				
	if($rows)
	{
		print '<p><font size=2>'.$LDButFf;
		if($rows==1) print " $LDSimilar";
		else print " $LDSimilarMany ";
		print $LDNeededInfo.'<p>';
		
		while($pdata=mysql_fetch_array($ergebnis))
		{
				print "
						<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$ck_sid&lang=$lang&mode=get&xdept=$xdept&xsaal=$xsaal&lastname=$pdata[lastname]&firstname=$pdata[firstname]&bday=$pdata[bday]&dept=$pdata[dept]&op_nr=$pdata[op_nr]&srcword=".strtr($srcword," ","+")."\">";
				print '<img src="../img/arrow.gif" border=0 width=15 height=15 align=middle>';
				if($ndl_name&&stristr($pdata[lastname],$ndl_name)) print '<u><b><span style="background:yellow"> '.$pdata['lastname'].'</span></b></u>';
 					else print $pdata['lastname'];				
 				print ', ';
				if($ndl_vname&&stristr($pdata[firstname],$ndl_vname)) print '<u><b><span style="background:yellow"> '.$pdata['firstname'].'</span></b></u>';
 					else print $pdata['firstname'];				
 				print ' (';
				if($ndl_bday&&stristr($pdata[bday],$ndl_bday)) print '<u><b><span style="background:yellow"> '.$pdata['bday'].'</span></b></u>';
 					else print $pdata['bday'];				
 				print ') ';
				print strtoupper($altdept[$i]).'  '.$LDOpRoom.': <b>'.$pdata[op_room].'</b>, '.$LDSrcListElements[5].': <b>'.$pdata['op_date'].'</b> '.$LDOpNr.': <b>'.$pdata['op_nr'].'</b><br>';
		}	
		
	}
	print '		</td>
				</tr>
				</table>
				</td>
				</tr>
				</table>
			</td>
			<td>	
			<img src="../img/ned2.gif" border=0 width=100 height=138 align=middle>
				
			</td>
			</tr>
			</table>
			</center>
			';
			
			
}
?>

<ul>
<?=$LDPromptSearch ?>

<form action="<? print $thisfile; ?>" method=post name=suchform onSubmit="return pruf(this)">
<table border=0 cellspacing=0 cellpadding=1 bgcolor=#999999>
  <tr>
    <td>
		<table border=0 cellspacing=0 cellpadding=5 bgcolor=#eeeeee>
    <tr>
      <td >	<font color=maroon size=2><b><?=$LDKeyword ?>:</b></font><br>
          		<input type="text" name="srcword" size=40 maxlength=100 value="<? print $srcword; ?>">
				<input type="hidden" name="sid" value="<? print $ck_sid; ?>"> 
				<input type="hidden" name="lang" value="<? print $lang; ?>"> 
				<input type="hidden" name="xdept" value="<? print $xdept; ?>"> 
				<input type="hidden" name="xsaal" value="<? print $xsaal; ?>"> 
				<input type="hidden" name="child" value="<? print $child; ?>"> 
				<input type="hidden" name="user" value="<? print str_replace(" ","+",$ck_op_pflegelogbuch_user); ?>">
    			<input type="hidden" name="mode" value="search">
       
           	</td>
	   </tr>
  			   <tr>
      <td>	
		<input type="submit" value="<?=$LDSearch ?>" align="right">
              	</td>
	   </tr>

  </table>

	</td>
  </tr>
</table>
  	</form>


</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<b><?=$LDOtherFunctions ?>:</b><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-pflege-logbuch-arch-start.php?sid=<?="$ck_sid&lang=$lang&dept=$xdept&saal=$xsaal&child=$child" ?>"><?="$LDResearchArchive [$LDOrLogBook]" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="op-pflege-logbuch-start.php?sid=<?="$ck_sid&lang=$lang&mode=fresh&dept=$xdept&saal=$xsaal" ?>" <? if ($child) print "target=\"_parent\""; ?>><?="$LDStartNewDocu [$LDOrLogBook]" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="javascript:gethelp('oplog.php','search','<?=$mode ?>','<?=$rows ?>','<?=$datafound ?>')"><?="$LDHelp" ?></a><br>

<p>
<a href="javascript:window.opener.focus();window.close();"><img border=0 align="right" src="../img/<?="$lang/$lang" ?>_cancel.gif"  alt="<?=$LDCancel ?>"></a>
</ul>
<p>
<hr>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</FONT>


</BODY>
</HTML>
