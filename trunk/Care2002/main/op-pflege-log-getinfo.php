<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once('../include/inc_front_chain_lang.php');

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

require_once('../include/inc_config_color.php'); // load color preferences

$thisfile="op-pflege-log-getinfo.php";

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
	{	
	// get data if exists
		$dbtable='care_nursing_op_logbook';
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
					//echo $sql."<br>";
				}
			}
				else { echo "$LDDbNoRead<br>"; } 
				
		$dbtable="care_personell_data_quicklist";
		
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
					//echo $sql."<br>";
				}
			}
				else { echo "$LDDbNoRead<br>$sql"; } 

		if($mode=='save')
		{
					$dbtable='care_nursing_op_logbook';

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
							//echo $result[$element];
							$sql="UPDATE $dbtable SET $element='".$result[$element]."',encoding='$result[encoding]',tid='$result[tid]'
					 				WHERE patnum='$patnum'
					 						AND dept='$dept'
					 						AND op_nr='$op_nr'
					 						AND op_room='$saal'";
											
							if($ergebnis=mysql_query($sql,$link))
       							{
									//echo $sql." new update <br>";
									$saveok=1;
								}
								else { echo "$LDDbNoSave<br>"; } 
						} // else create new entry
						else
						{
							// get the orig patient data
							$dbtable='care_admission_patient';
							$sql="SELECT name,vorname,gebdatum,address FROM $dbtable WHERE patnum='$patnum'";

							if($ergebnis=mysql_query($sql,$link))
       						{
								$rows=0;
								if( $result=mysql_fetch_array($ergebnis)) $rows++;
								if($rows)
								{
									mysql_data_seek($ergebnis,0);
									$result=mysql_fetch_array($ergebnis);		
									$dbtable='care_nursing_op_logbook';
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
										//echo $sql." new insert <br>";
										$saveok=1;
									}
									else { echo "$LDDbNoSave<br>"; } 
								 } // end of if rows
							} // end of if ergebnis
								else { echo "$LDDbNoRead<br>"; } 
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
								else { echo "$LDDbNoRead<br>"; } 
							}
							mysql_close($link);
							header("location:$thisfile?sid=$sid&lang=$lang&mode=saveok&winid=$winid&patnum=$patnum&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday&op_nr=$op_nr");
						}
				}// end of if(mode==save)
			else $saved=0;
}
  else { echo "$LDDbNoLink<br>"; } 


?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $title ?></TITLE>

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
	<?php $comdat='&dept='.$dept.'&saal='.$saal.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&op_nr='.$op_nr; ?>
	//resetlogdisplays();resettimebars();resettimeframe();
	window.opener.parent.LOGINPUT.location.replace('<?php echo "oploginput.php?sid=$sid&lang=$lang&patnum=$patnum&mode=notimereset$comdat"; ?>');
	window.opener.parent.OPLOGMAIN.location.replace('<?php echo "oplogmain.php?sid=$sid&lang=$lang&gotoid=$patnum$comdat"; ?>');
}

function delete_item(i)
{
	d=document.infoform;
	d.action="<?php echo $thisfile ?>";
	d.delitem.value=i;
	d.inputdata.value="?";
	d.submit();
}
function savedata(iln,ifn,inx,ipr)
{
	x=inx.selectedIndex;
	//urlholder="<?php echo $forwardfile ?>&ln="+ln+"&fn="+fn+"&nx="+d[x].value;
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
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
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
onLoad="<?php if($mode=="saveok") echo "refreshparent();window.focus();"; ?>if (window.focus) window.focus();
				window.focus();document.infoform.inputdata.focus();" >
<a href="javascript:gethelp('oplog.php','person','<?php echo $winid ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?> alt="<?php echo $LDHelp ?>" align="right"></a>
<form name="infoform" action="op-pflege-log-getpersonell.php" method="post" onSubmit="return pruf(this)">
				
<font face=verdana,arial size=5 color=maroon>
<b>
<?php 
	echo $title.'<br><font size=4>';	
	//echo $tage[$dyidx]." ($dy".".".$mo.".".$yr.")</font>";
?>
</b>
</font>
<p>
<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1 cellpadding=0>
  <tr>
    <td  bgcolor="#cfcfcf" class="v13" colspan=6>&nbsp;<b><?php echo $LDCurrentEntries ?>:</b></td>
  </tr>
  <tr  class="v13_n">
    <td align=center bgcolor="#ffffff">
	</td>     <td align=center bgcolor="#ffffff" width="20%">
<!-- <?php echo "$LDLastName, $LDName" ?>
 -->	</td> 
    <td align=center bgcolor="#ffffff">
<?php echo $LDFunction ?>
	</td> 

    <td align=center bgcolor="#ffffff">
<?php echo $LDFrom ?>:
	</td> 

    <td align=center bgcolor="#ffffff" >
<?php echo $LDTo ?>:
	</td> 
    <td bgcolor="#ffffff">
&nbsp;<?php echo $LDExtraInfo ?>:
	</td> 
  </tr>	

<?php if($result[$element]!="") 
{
	//echo $result[$element];
	$dbuf=explode("~",trim($result[$element]));
	//if(!$dbuf[0]) array_splice($dbuf,0,1);
		$entrycount=sizeof($dbuf);
		$elems=array();
		for($i=0;$i<$entrycount;$i++)
		{
			if(trim($dbuf[$i])=="") continue;
			parse_str(trim($dbuf[$i]),$elems);
			echo '
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
 echo '
  <tr>'; 
for($i=0;$i<6;$i++)
echo '
    <td align=center bgcolor="#ffffff" align=center  class="v13" >
&nbsp;
	</td> ';
echo'
  </tr>	';
  }
 ?>

  		<tr>
   			 <td  class="v12"  bgcolor="#cfcfcf" colspan=6>&nbsp;
		 </td>

		  </tr>
  		<tr>
   			 <td  class="v12"  bgcolor="#ffffff" colspan=6 align=center>
			<font size=3><b><?php echo str_replace("~tagword~",$title,$LDSearchNewPerson) ?>:</b>	<br>
			 <input type="text" name="inputdata" size=25 maxlength=30><br> <input type="submit" value="OK">
			 </td>

		  </tr>
	 
		  </table>
</td>
  </tr>
</table>

<input type="hidden" name="encoder" value="<?php echo $HTTP_COOKIE_VARS[$local_user.$sid]; ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pday" value="<?php echo $pday ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="saal" value="<?php echo $saal ?>">
<input type="hidden" name="op_nr" value="<?php echo $op_nr ?>">
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="entrycount" value="<?php if(!$entrycount) echo "1"; else echo $entrycount; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="delitem" value="">
</form>
<p>
<?php if($quickexist) : ?>
<form name="quickselect" action="<?php echo $thisfile ?>" method="post">
<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
  <tr>
	<td bgcolor="#cfcfcf" class="v13_n" colspan=4>&nbsp;<font color="#ff0000"><b><?php echo $LDQuickSelectList ?>:</b></td>
  </tr>
 <tr>
    <td align=center bgcolor="#ffffff" class="v13_n" >
<!-- <?php echo $LDLastName ?>
	</td> 
    <td align=center bgcolor="#ffffff" class="v13_n" >
<?php echo $LDName ?> -->

	</td> 
    <td align=center bgcolor="#ffffff"  class="v13_n" >
<?php echo $LDJobId ?>

	</td> 
    <td align=center bgcolor="#ffffff"   class="v13_n" >
<?php echo "$LDOr $LDFunction" ?>
	</td> 
    <td align=center bgcolor="#ffffff"   class="v13_n" >

	</td> 
  </tr>	


<?php 	$counter=0;
		while($quicklist=mysql_fetch_array($quickresult))
		{
			echo '
	  		<tr bgcolor="#ffffff">
    			<td class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$quicklist[lastname].'\',\''.$quicklist[firstname].'\',document.quickselect.f'.$counter.',\''.$quicklist[profession].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$quicklist[lastname].', '.$quicklist[firstname].'</a>
				</td> ';
    			/*<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$quicklist[lastname].'\',\''.$quicklist[firstname].'\',document.quickselect.f'.$counter.',\''.$quicklist[profession].'\')" title="'.str_replace("~tagword~",$title,$LDUseData).'">'.$quicklist[firstname].'</a>
				</td> */
			echo '
    			<td class="v13" >
				&nbsp;'.$LDJobIdTag[$quicklist[profession]].'
				</td> 
    			<td   class="v13" >
				<select name="f'.$counter.'">';
				if(!$entrycount) $entrycount=1;
				for($i=1;$i<=($entrycount);$i++)
				{
					echo '
    				<option value="'.$i.'" ';
					if($i==$entrycount) echo "selected";
					echo '>'.$title.' '.$i.'</option>';
				}
    			echo '
				</select>
    
				</td> 
    			<td   class="v13" >
				&nbsp;<a href="javascript:savedata(\''.$quicklist[lastname].'\',\''.$quicklist[firstname].'\',document.quickselect.f'.$counter.',\''.$quicklist[profession].'\')"><img '.createComIcon('../','uparrowgrnlrg.gif','0').' align=absmiddle>
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
<input type="hidden" name="encoder" value="<?php echo $HTTP_COOKIE_VARS[$local_user.$sid]; ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pday" value="<?php echo $pday ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="saal" value="<?php echo $saal ?>">
<input type="hidden" name="op_nr" value="<?php echo $op_nr ?>">
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="ln" value="">
<input type="hidden" name="fn" value="">
<input type="hidden" name="pr" value="">
<input type="hidden" name="nx" value="">

</form>
<?php endif ?>

<div align=right>
&nbsp;&nbsp;
<a href="javascript:window.close()">
<?php if($mode=="saveok")  : ?>
<img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>">
<?php else : ?>
<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>" border="0" alt="<?php echo $LDClose ?>">
<?php endif ?>
</a></div>
</BODY>

</HTML>
