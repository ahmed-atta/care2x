<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_pflege_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php"); // load color preferences

$thisfile="pflege-getdailymedx.php";

switch($winid)
{
	case "medication": $title="$LDMedication/$LDDosage";
							$maxelement=10;
							break;
}

$dbtable="nursing_station_patients_curve";

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get orig data

		if($mode=="save")
		{
		 	$element="medication_dailydose";
		// get the basic patient data
			$sql="SELECT * FROM mahopatient WHERE patnum='$pn'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);		
					
				// check if entry is already existing
				$sql="SELECT $element FROM $dbtable WHERE patnum='$pn'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					//print $sql." checked <br>";
					//$bbuf="";
					//$tbuf="";
					$bbuf=$r0;
					for($i=1;$i<$maxelement;$i++)
					{
						$dx="r".$i;
						$bbuf=$bbuf."|".$$dx;
					}
					$newdata=$bbuf;
					if($newdata) $dbuf=strtr("sd=$yr$mo$dy&rd=$dy.$mo.$yr&e=$newdata\r\n"," <>","+()");
							else $dbuf="";
					
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows==1)
						{
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);
							if($content[$element]!="")
							{
								$cbuf="sd=$yr$mo$dy&rd=$dy.$mo.$yr";
								//print $content[$element]."<br>".$cbuf;
								if(stristr($content[$element],$cbuf))
								{
									$ebuf=explode("_",$content[$element]);
									for($i=0;$i<sizeof($ebuf);$i++)
									{
										//print $v." v <br>";
										if(stristr($ebuf[$i],$cbuf))
										{ $ebuf[$i]=$dbuf; 
											$dbuf=implode("_",$ebuf);
											break;
										}
									}
								}
								 else $dbuf=$content[$element]."_".$dbuf;		
							}		
							// $dbuf=htmlspecialchars($dbuf);
							$sql="UPDATE $dbtable SET $element='$dbuf'	WHERE patnum='$pn'";
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&yrstart=$yrstart&monstart=$monstart&dystart=$dystart&dyname=$dyname");
								}
								else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
						} // else create new entry
						else
						{
							//$dbuf=strtr("sd=$yr$mo$dy&rd=$dy.$mo.$yr&e=$newdata"," <>","+()")."\r\n";
							$sql="INSERT INTO $dbtable 
										(
										patnum,
										lastname,
										firstname,
										bday,
										$element,
										fe_date
										)
									 	VALUES
										(
										'$pn',
										'$result[name]',
										'$result[vorname]',
										'$result[gebdatum]',
										'$dbuf',
										'".date("d.m.Y")."'
										)";

							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new insert <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&yrstart=$yrstart&monstart=$monstart&dystart=$dystart&dyname=$dyname");
								}
								else {print "<p>$sql$LDDbNoSave";}
						}//end of else
					} // end of if ergebnis
				}// end of if rows
				else {print "<p>$sql$LDDbNoRead";}
			}//end of   if ergebnis
			else $saved=0;
		 }// end of if(mode==save)
		 else
		 {
		 	// get medication info
			$element="medication";

		 	$sql="SELECT * FROM $dbtable WHERE patnum='$pn'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					$medbuf=$result[$element];
					//print $sql."<br>";
					// get daily dose info
					$element="medication_dailydose";
					$sql="SELECT * FROM $dbtable WHERE patnum='$pn'";

					if($ergebnis=mysql_query($sql,$link))
       				{
						$rows=0;
						if( $content=mysql_fetch_array($ergebnis)) $rows++;
						if($rows)
						{
							mysql_data_seek($ergebnis,0);
							$result=mysql_fetch_array($ergebnis);
							$dosebuf=$result[$element];
							//print $sql."<br>";
						}
					}
					else {print "<p>$sql$LDDbNoRead";} 
				}
			}
				else {print "<p>$sql$LDDbNoRead";}
	 	}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }


		
	$cbuf="sd=$yr$mo$dy&rd=$dy.$mo.$yr";
	$arr=explode("_",$dosebuf);
		while(list($x,$v)=each($arr))
		{
			if(stristr($v,$cbuf))
			{
				$sbuf=$v;
				break;
			}
		}


if ($sbuf) 	parse_str($sbuf,$abuf);
//print $abuf[e]."<br>";
$dose=trim($abuf[e]);
//print $b_t[0]." ".$b_t[1];


$mdc=explode("~",$medbuf);
array_unique($mdc);

if(strchr($mdc[0],"|")||(!$mdc[0])) $maxelement=10;
 else
 {
 	$maxelement=(int) trim($mdc[0]);
	array_splice($mdc,0,1);
}
// check if encoder protocol is attached at the end 
if(!strchr($mdc[(sizeof($mdc)-1)],"|")) 
{
 	$enc=$mdc[(sizeof($mdc)-1)];
	array_splice($mdc,(sizeof($mdc)-1),1);
}

$mdcsize=sizeof($mdc);
//print $b_t[0]." ".$b_t[1];
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?="$title $LDInputWin" ?></TITLE>
<?
require("../req/css-a-hilitebu.php");
?>

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

  function pruf(d){
	if(!d.newdata.value) return false;
	else return true
	}
 function parentrefresh(){
	window.opener.location.href="pflege-station-patientdaten-kurve.php?sid=<?="$ck_sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$monstart&jahr=$yrstart&tagname=$dyname" ?>&nofocus=1";
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

//-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v13 { font-family:verdana,arial;font-size:13; }
.v10 { font-family:verdana,arial;font-size:10; }
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080" 
onLoad="<? if($saved) print "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();" >
<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<? 
	print $title.'<br><font size=4>';	
	print $LDFullDayName[$dyidx]." ($dy".".".$mo.".".$yr.")</font>";
?>
	</font></b>
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','medication_dailydose','','<?=$mdcsize ?>','<?=$title ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>


<font face=verdana,arial size=3 >
<form name="infoform" action="<?=$thisfile ?>" method="post" onSubmit="return pruf(this)">
<font face=verdana,arial size=2 >


<table border=0  bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
			<tr>
   			 <td  align=center class="v12"  bgcolor="#cfcfcf" ><?=$LDMedication ?></td>
   			 <td  align=center class="v12"  bgcolor="#cfcfcf" ><?=$LDDosage ?></td>
   			 <td  align=center class="v12"  bgcolor="#cfcfcf" ><?=$LDTodaysReport ?>:</td>
		  </tr>
		<? 
		$ds=explode("|",$dose);
		if($mdcsize)
		{
			for($i=0;$i<$mdcsize;$i++)
			{
				//if(!$mdc[$i]) continue;
				$v=explode("|",$mdc[$i]);
				if(!$v[1]) continue;
				print '
 						 <tr>
   						 <td  class="v12" bgcolor="#ffffff">&nbsp;'.$v[1].'&nbsp;
        				</td>
   						 <td class="v12" bgcolor="#ffffff"> &nbsp;'.$v[2].'&nbsp;</td>
   						 <td class="v12" bgcolor="#ffffff">&nbsp;
						 <input type="text" name="r'.$i.'" value="'.$ds[$i].'" size=16 maxlength=18>&nbsp;</td>
  						</tr>
 						 ';
				}
		}
		else print '
		 				<tr>
   						 <td  colspan="3" bgcolor="#ffffff"><img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle">
        				<font face="Verdana, Arial" size=4 color="#800000">'.$LDNoMedicineYet.'&nbsp;</font></td>
  						</tr>
 						 ';
 		?>
</table>
</td>
  </tr>
</table>


<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="winid" value="<?=$winid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="station" value="<?=$station ?>">
<input type="hidden" name="yr" value="<?=$yr ?>">
<input type="hidden" name="mo" value="<?=$mo ?>">
<input type="hidden" name="dy" value="<?=$dy ?>">
<input type="hidden" name="dyidx" value="<?=$dyidx ?>">
<input type="hidden" name="dystart" value="<?=$dystart ?>">
<input type="hidden" name="monstart" value="<?=$monstart ?>">
<input type="hidden" name="yrstart" value="<?=$yrstart ?>">
<input type="hidden" name="dyname" value="<?=$dyname ?>">
<input type="hidden" name="pn" value="<?=$pn ?>">
<input type="hidden" name="edit" value="<?=$edit ?>">
<input type="hidden" name="mode" value="save">

</form>
<p>
<? if($mdcsize) : ?>
<a href="javascript:document.infoform.submit();"><img src="../img/<?="$lang/$lang" ?>_savedisc.gif" border="0" alt="<?=$LDSave ?>"></a>
&nbsp;&nbsp;
<a href="javascript:resetinput()"><img src="../img/<?="$lang/$lang" ?>_reset.gif" border="0" alt="<?=$LDReset ?>"></a>
&nbsp;&nbsp;
<? endif ?>
<? if($saved)  : ?>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0" alt="<?=$LDClose ?>"></a>
<? else : ?>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0" alt="<?=$LDClose ?>">
</a>
<? endif ?>

</BODY>

</HTML>
