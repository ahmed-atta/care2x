<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");

$title=$LDOpPersonElements[$winid];
switch($winid)
{
	case "operator": 
							$element="operator";
							//$maxelement=10;
							$quickid="doctor";
							break;
	case "assist": 
							$element="assistant";
							//$maxelement=10;
							$quickid="doctor";
							break;
	case "scrub": 
							$element="scrub_nurse";
							//$maxelement=10;
							$quickid="nurse";
							break;
	case "rotating":
							$element="rotating_nurse";
							//$maxelement=10;
							$quickid="nurse";
							break;
	case "ana":
							$element="an_doctor";
							//$maxelement=10;
							$quickid="doctor";
							break;
	default:{header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

require("../req/config-color.php"); // load color preferences

$thisfile="op-pflege-log-getinfo.php";

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get data if exists
		$dbtable="nursing_op_logbook";
		$sql="SELECT $element,encoding,tid FROM $dbtable
					 WHERE patnum='$patnum'
					 AND dept='$dept'
					 AND op_nr='$op_nr'
					 AND op_room='$saal'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					$fileexist=1;
					//print $sql."<br>";
				}
			}
				else { print "$LDDbNoRead<br>"; } 
				
		$dbtable="personell_data_quicklist";
		
		$sql="SELECT lastname,firstname,profession FROM $dbtable
					 WHERE dept='$dept'
					 AND profession LIKE '$quickid'  ORDER BY frequency DESC";

			if($quickresult=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $quicklist=mysql_fetch_array($quickresult)) $rows++;
				if($rows)
				{
					mysql_data_seek($quickresult,0);
					//$quicklist=mysql_fetch_array($ergebnis);
					$quickexist=1;
					//print $sql."<br>";
				}
			}
				else { print "$LDDbNoRead<br>$sql"; } 

		if($mode=="save")
		{
					$dbtable="nursing_op_logbook";

					//$encoder=$ck_op_pflegelogbuch_user; 
		
					if($fileexist)
						{
										
							// $dbuf=htmlspecialchars($dbuf);
							$result[encoding].=" ~e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element;
							if($delitem!="")
							{
								$elem=explode("~",trim($result[$element]));
								//if(!$elem[0]) array_splice($elem,0,1);
								array_splice($elem,$delitem,1);
								sort($elem,SORT_REGULAR);
								$result[$element]=implode("~",$elem);
							}
							else
							{
								//$sbuf=$result[$element]." ~n=".$ln.",+".$fn."&x=".$nx;
								$dbuf=explode("~",$result[$element]);
								$dbuf[]="n=".$ln.",+".$fn."&x=".$nx;
								sort($dbuf,SORT_REGULAR);
								$result[$element]=implode("~",$dbuf);
								//$result[$element]=$result[$element]." ~n=".$ln.",+".$fn."&x=".$nx;
							}
							//print $result[$element];
							$sql="UPDATE $dbtable SET $element='".$result[$element]."',encoding='$result[encoding]',tid='$result[tid]'
					 				WHERE patnum='$patnum'
					 						AND dept='$dept'
					 						AND op_nr='$op_nr'
					 						AND op_room='$saal'";
											
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									$saveok=1;
								}
								else { print "$LDDbNoSave<br>"; } 
						} // else create new entry
						else
						{
							// get the orig patient data
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
									$sql="INSERT INTO $dbtable 
										(
										year,
										dept,
										op_room,
										op_nr,
										op_date,
										patnum,
										lastname,
										firstname,
										bday,
										address,
										$element,
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
										'".$pday.".".$pmonth.".".$pyear."',
										'$patnum',
										'$result[name]',
										'$result[vorname]',
										'$result[gebdatum]',
										'".addslashes($result[address])."',
										'n=".$ln.",+".$fn."&x=".$nx."',
										'e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element."',
										'".date("d.m.Y")."',
										'".date("H.i")."'
										)";

									if($ergebnis=mysql_query($sql,$link))
       								{
										//print $sql." new insert <br>";
										$saveok=1;
									}
									else { print "$LDDbNoSave<br>"; } 
								 } // end of if rows
							} // end of if ergebnis
								else { print "$LDDbNoRead<br>"; } 
						}//end of else
					if($saveok)
						{
							if(!$delitem)
							{
								$dbtable="personell_data_quicklist";
								$sql="SELECT frequency FROM $dbtable
					 						WHERE lastname='$ln'
					 								AND firstname='$fn'
													AND dept='$dept'";

								if($ergebnis=mysql_query($sql,$link))
       							{
									$rows=0;
									if( $result=mysql_fetch_array($ergebnis)) $rows++;
									if($rows)
									{
										$sql="UPDATE $dbtable SET frequency='".($result[frequency]+1)."' 
					 							WHERE lastname='$ln'
					 								AND firstname='$fn'
													AND dept='$dept'
													AND profession='$pr'";
										mysql_query($sql,$link);
									}
									else
									{
										$sql="INSERT INTO $dbtable (dept,lastname,firstname,profession,frequency) VALUES ('$dept','$ln','$fn','$pr','1')";
										mysql_query($sql,$link);
									}
								}
								else { print "$LDDbNoRead<br>"; } 
							}
							mysql_close($link);
							header("location:$thisfile?sid=$ck_sid&lang=$lang&mode=saveok&winid=$winid&patnum=$patnum&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday&op_nr=$op_nr");
						}
				}// end of if(mode==save)
			else $saved=0;
}
  else { print "$LDDbNoLink<br>"; } 


?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?=$title ?></TITLE>

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

  function pruf(d){
	if(!d.inputdata.value) return false;
	else return true
	}

function refreshparent()
{
	<? $comdat='&dept='.$dept.'&saal='.$saal.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&op_nr='.$op_nr; ?>
	//resetlogdisplays();resettimebars();resettimeframe();
	window.opener.parent.LOGINPUT.location.replace('<? print "oploginput.php?sid=$ck_sid&lang=$lang&patnum=$patnum&mode=notimereset$comdat"; ?>');
	window.opener.parent.OPLOGMAIN.location.replace('<? print "oplogmain.php?sid=$ck_sid&lang=$lang&gotoid=$patnum$comdat"; ?>');
}

function delete_item(i)
{
	d=document.infoform;
	d.action="<?=$thisfile ?>";
	d.delitem.value=i;
	d.inputdata.value="?";
	d.submit();
}
function savedata(iln,ifn,inx,ipr)
{
	x=inx.selectedIndex;
	//urlholder="<?=$forwardfile ?>&ln="+ln+"&fn="+fn+"&nx="+d[x].value;
	//window.location.replace(urlholder);
	d=document.quickselect;
	d.ln.value=iln;
	d.fn.value=ifn;
	d.pr.value=ipr;
	d.nx.value=inx[x].value;
	//d.inputdata.value="?";
	d.submit();
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v13 { font-family:verdana,arial;font-size:13; }
.v13_n { font-family:verdana,arial;font-size:13; color:#0000cc}
.v10 { font-family:verdana,arial;font-size:10; }
</style>

</HEAD>
<BODY   bgcolor="#cde1ec" TEXT="#000000" LINK="#0000FF" VLINK="#800080"  topmargin=2 marginheight=2 
onLoad="<? if($mode=="saveok") print "refreshparent();window.focus();"; ?>if (window.focus) window.focus();
				window.focus();document.infoform.inputdata.focus();" >
<a href="javascript:gethelp('oplog.php','person','<?=$winid ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 alt="<?=$LDHelp ?>" align="right"></a>
<form name="infoform" action="op-pflege-log-getpersonell.php" method="post" onSubmit="return pruf(this)">
				
<font face=verdana,arial size=5 color=maroon>
<b>
<? 
	print $title.'<br><font size=4>';	
	//print $tage[$dyidx]." ($dy".".".$mo.".".$yr.")</font>";
?>
</b>
</font>
<p>
<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1 cellpadding=0>
  <tr>
    <td  bgcolor="#cfcfcf" class="v13" colspan=6>&nbsp;<b><?=$LDCurrentEntries ?>:</b></td>
  </tr>
  <tr  class="v13_n">
    <td align=center bgcolor="#ffffff">
	</td>     <td align=center bgcolor="#ffffff" width="20%">
<!-- <?="$LDLastName, $LDName" ?>
 -->	</td> 
    <td align=center bgcolor="#ffffff">
<?=$LDFunction ?>
	</td> 

    <td align=center bgcolor="#ffffff">
<?=$LDFrom ?>:
	</td> 

    <td align=center bgcolor="#ffffff" >
<?=$LDTo ?>:
	</td> 
    <td bgcolor="#ffffff">
&nbsp;<?=$LDExtraInfo ?>:
	</td> 
  </tr>	

<? if($result[$element]!="") 
{
	//print $result[$element];
	$dbuf=explode("~",trim($result[$element]));
	//if(!$dbuf[0]) array_splice($dbuf,0,1);
		$entrycount=sizeof($dbuf);
		$elems=array();
		for($i=0;$i<$entrycount;$i++)
		{
			if(trim($dbuf[$i])=="") continue;
			parse_str(trim($dbuf[$i]),$elems);
			print '
	  		<tr bgcolor="#ffffff">
    			<td   class="v13" >
				&nbsp;<a href="javascript:delete_item(\''.$i.'\')"><img src="../img/delete2.gif" width=20 height=20 border=0 alt="'.$LDDeleteEntry.'"></a>
				</td> 
    			<td   class="v13" >
				&nbsp;'.$elems[n].'
				</td> 
    			<td class="v13" >
				&nbsp;'.$title.' '.$elems[x].'
				</td> 
    			<td class="v13" >
				&nbsp;'.$elems[s].'<input type="text" name="ab" size=5 maxlength=5 value="">
				</td> 
    			<td class="v13" >
				&nbsp;'.$elems[e].'<input type="text" name="bis" size=5 maxlength=5 value="">
				</td> 
    			<td class="v13" >
				&nbsp;'.$elem[x].'<input type="text" name="x_info" size=30 maxlength=5 value="">
				</td> 
  				</tr>';
		}
}
 else
 
 {
 print '
  <tr>'; 
for($i=0;$i<6;$i++)
print '
    <td align=center bgcolor="#ffffff" align=center  class="v13" >
&nbsp;
	</td> ';
print'
  </tr>	';
  }
 ?>

  		<tr>
   			 <td  class="v12"  bgcolor="#cfcfcf" colspan=6>&nbsp;
		 </td>

		  </tr>
  		<tr>
   			 <td  class="v12"  bgcolor="#ffffff" colspan=6 align=center>
			<font size=3><b><?=str_replace("~tagword~",$title,$LDSearchNewPerson) ?>:</b>	<br>
			 <input type="text" name="inputdata" size=25 maxlength=30><br> <input type="submit" value="OK">
			 </td>

		  </tr>
	 
		  </table>
</td>
  </tr>
</table>

<input type="hidden" name="encoder" value="<? print $ck_op_pflegelogbuch_user; ?>">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="winid" value="<?=$winid ?>">
<input type="hidden" name="pyear" value="<?=$pyear ?>">
<input type="hidden" name="pmonth" value="<?=$pmonth ?>">
<input type="hidden" name="pday" value="<?=$pday ?>">
<input type="hidden" name="dept" value="<?=$dept ?>">
<input type="hidden" name="saal" value="<?=$saal ?>">
<input type="hidden" name="op_nr" value="<?=$op_nr ?>">
<input type="hidden" name="patnum" value="<?=$patnum ?>">
<input type="hidden" name="entrycount" value="<? if(!$entrycount) print "1"; else print $entrycount; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="delitem" value="">
</form>
<p>
<? if($quickexist) : ?>
<form name="quickselect" action="<?=$thisfile ?>" method="post">
<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
  <tr>
	<td bgcolor="#cfcfcf" class="v13_n" colspan=4>&nbsp;<font color="#ff0000"><b><?=$LDQuickSelectList ?>:</b></td>
  </tr>
 <tr>
    <td align=center bgcolor="#ffffff" class="v13_n" >
<!-- <?=$LDLastName ?>
	</td> 
    <td align=center bgcolor="#ffffff" class="v13_n" >
<?=$LDName ?> -->

	</td> 
    <td align=center bgcolor="#ffffff"  class="v13_n" >
<?=$LDJobId ?>

	</td> 
    <td align=center bgcolor="#ffffff"   class="v13_n" >
<?="$LDOr $LDFunction" ?>
	</td> 
    <td align=center bgcolor="#ffffff"   class="v13_n" >

	</td> 
  </tr>	


<? 	$counter=0;
		while($quicklist=mysql_fetch_array($quickresult))
		{
			print '
	  		<tr bgcolor="#ffffff">
    			<td class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$quicklist[lastname].'\',\''.$quicklist[firstname].'\',document.quickselect.f'.$counter.',\''.$quicklist[profession].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$quicklist[lastname].', '.$quicklist[firstname].'</a>
				</td> ';
    			/*<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$quicklist[lastname].'\',\''.$quicklist[firstname].'\',document.quickselect.f'.$counter.',\''.$quicklist[profession].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$quicklist[firstname].'</a>
				</td> */
			print '
    			<td class="v13" >
				&nbsp;'.$LDJobIdTag[$quicklist[profession]].'
				</td> 
    			<td   class="v13" >
				<select name="f'.$counter.'">';
				if(!$entrycount) $entrycount=1;
				for($i=1;$i<=($entrycount);$i++)
				{
					print '
    				<option value="'.$i.'" ';
					if($i==$entrycount) print "selected";
					print '>'.$title.' '.$i.'</option>';
				}
    			print '
				</select>
    
				</td> 
    			<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$quicklist[lastname].'\',\''.$quicklist[firstname].'\',document.quickselect.f'.$counter.',\''.$quicklist[profession].'\')"><img src="../img/upArrowGrnLrg.gif" width=16 height=16 border=0 align=absmiddle>
				'.str_replace("~tagword~",$title,$LDUseData).'..</a>
				</td> 
    			
  				</tr>';
				$counter++;
		}
?>
		  </table>
</td>
  </tr>
</table>
<input type="hidden" name="encoder" value="<? print $ck_op_pflegelogbuch_user; ?>">
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="winid" value="<?=$winid ?>">
<input type="hidden" name="pyear" value="<?=$pyear ?>">
<input type="hidden" name="pmonth" value="<?=$pmonth ?>">
<input type="hidden" name="pday" value="<?=$pday ?>">
<input type="hidden" name="dept" value="<?=$dept ?>">
<input type="hidden" name="saal" value="<?=$saal ?>">
<input type="hidden" name="op_nr" value="<?=$op_nr ?>">
<input type="hidden" name="patnum" value="<?=$patnum ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="ln" value="">
<input type="hidden" name="fn" value="">
<input type="hidden" name="pr" value="">
<input type="hidden" name="nx" value="">

</form>
<? endif ?>

<div align=right>
&nbsp;&nbsp;
<a href="javascript:window.close()">
<? if($mode=="saveok")  : ?>
<img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0" alt="<?=$LDClose ?>">
<? else : ?>
<img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0" alt="<?=$LDClose ?>">
<? endif ?>
</a></div>
</BODY>

</HTML>
