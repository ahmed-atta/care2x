<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","nursing.php");
$local_user="ck_pflege_user";
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php"); // load color preferences

$thisfile="pflege-getdailybp_t.php";

switch($winid)
{
	case "bp_temp": $title=$LDBpTemp;
							$element="bp_temp";
							$maxelement=15;
							break;
}

$dbtable="nursing_station_patients_curve";
require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK) 
	{	
	// get orig data

		if($mode=="save")
		{
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
					for($i=0;$i<$maxelement;$i++)
					{
						$tdx="btime".$i;$ddx="bdata".$i;
						if(!$$tdx || !$$ddx) continue;
						$bbuf=$bbuf."B".$$tdx."b".$$ddx;
					}
					for($i=0;$i<$maxelement;$i++)
					{
						$tdx="ttime".$i;$ddx="tdata".$i;
						if(!$$tdx || !$$ddx) continue;
						$tbuf=$tbuf."T".$$tdx."t".$$ddx;
					}
					$newdata=strtr(($bbuf."~".$tbuf),",",".");
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
									header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&yrstart=$yrstart&monstart=$monstart&dystart=$dystart&dyname=$dyname");
								}
								else {print "<p>$sql$LDDbNoRead";}
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
									header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&yrstart=$yrstart&monstart=$monstart&dystart=$dystart&dyname=$dyname");
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
		 	$sql="SELECT * FROM $dbtable WHERE patnum='$pn'";

			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					//print $sql."<br>";
				}
			}
				else {print "<p>$sql$LDDbNoRead";}
	 	}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?php echo "$title $LDInputWin" ?></TITLE>
<?php
require("../include/inc_css_a_hilitebu.php");
?>
<script language="javascript" src="../js/setdatetime.js">
</script>
<script language="javascript" src="../js/chkValidTime.js">
</script>

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
	window.opener.location.href="pflege-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$monstart&jahr=$yrstart&tagname=$dyname" ?>&nofocus=1";
	}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

//-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v12 { font-family:verdana,arial;font-size:13; }
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080"   topmargin="0" marginheight="0" 
onLoad="<?php if($saved) print "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();" >
<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<?php 
	print $title.'<br><font size=4>';	
	print $LDFullDayName[$dyidx]." ($dy".".".$mo.".".$yr.")</font>";
?>
	</font></b>
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $element ?>','','','<?php echo $title ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>

<font face=verdana,arial size=3 >
<form name="infoform" action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">
<font face=verdana,arial size=2 >
<?php
$cbuf="sd=$yr$mo$dy&rd=$dy.$mo.$yr";
	$arr=explode("_",$result[$element]);
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
$b_t=explode("~",trim($abuf[e]));
//print $b_t[0]." ".$b_t[1];
?>

<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0>
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
  <tr>
    <td  align=center bgcolor="#cfcfcf" class="v13"><font color="#ff0000"><?php echo $LDBp ?></td>
    <td  align=center bgcolor="#cfcfcf" class="v13"><font color="#0000ff"><?php echo $LDTemp ?></td>
  </tr>
  <tr>
    <td align=center bgcolor="#ffffff">
	
		<table border=0 border=0 cellspacing=0 cellpadding=0>
			<tr>
   			 <td  align=center class="v12"><?php echo $LDClockTime ?>:</td>
   			 <td  align=center class="v12"><?php echo $LDBp ?>:</td>
		  </tr>
			<?php 
			$b=explode("B",trim($b_t[0]));
			sort($b,SORT_NUMERIC);
			if(!$b[0]) array_splice($b,0,1);
			
			for($i=0;$i<$maxelement;$i++)
			{
				$bb=explode("b",$b[$i]);
				print '
 						 <tr>
   						 <td ><input type="text" name="btime'.$i.'" size=6 maxlength=5 value="'.$bb[0].'" onKeyUp="isvalidtime(this)">
        				</td>
   						 <td class="v12"><input type="text" name="bdata'.$i.'" size=8 maxlength=7 value="'.$bb[1].'">mm/Hg</td>
  						</tr>
 						 ';
				}
 			?>
		</table>
	
	</td>
    <td align=center bgcolor="#ffffff">
	
		<table border=0 border=0 cellspacing=0 cellpadding=0>
			<tr>
   			 <td  align=center class="v12"><?php echo $LDClockTime ?>:</td>
   			 <td  align=center class="v12"><?php echo $LDTemp ?>:</td>
		  </tr>
			<?php 
			$b=explode("T",trim($b_t[1]));
			sort($b,SORT_NUMERIC);
			if(!$b[0]) array_splice($b,0,1);

			for($i=0;$i<$maxelement;$i++)
			{
				$bb=explode("t",$b[$i]);
				print '
 						 <tr>
   						 <td><input type="text" name="ttime'.$i.'" size=6 maxlength=5 value="'.$bb[0].'" onKeyUp="isvalidtime(this)">
        				</td>
   						 <td class="v12"><input type="text" name="tdata'.$i.'" size=8 maxlength=7 value="'.$bb[1].'">°C</td>
  						</tr>
  						';
			}
 			?>
		</table>
	
	</td>
  </tr>
</table>
</td>
  </tr>
</table>






<?php 	
	$cbuf="sd=$yr$mo$dy&rd=$dy.$mo.$yr";
	$arr=explode("_",$result[$element]);
		while(list($x,$v)=each($arr))
		{
			if(stristr($v,$cbuf))
			{
				$sbuf=$v;
				break;
			}
		}
?>



<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="yr" value="<?php echo $yr ?>">
<input type="hidden" name="mo" value="<?php echo $mo ?>">
<input type="hidden" name="dy" value="<?php echo $dy ?>">
<input type="hidden" name="dyidx" value="<?php echo $dyidx ?>">
<input type="hidden" name="dystart" value="<?php echo $dystart ?>">
<input type="hidden" name="monstart" value="<?php echo $monstart ?>">
<input type="hidden" name="yrstart" value="<?php echo $yrstart ?>">
<input type="hidden" name="dyname" value="<?php echo $dyname ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<!-- <input type="hidden" name="sformat" value="<?php echo $sformat ?>"> -->
<input type="hidden" name="mode" value="save">

</form>
<p>
<a href="javascript:document.infoform.submit();"><img src="../img/<?php echo "$lang/$lang" ?>_savedisc.gif" border="0" alt="<?php echo $LDSave ?>"></a>
&nbsp;&nbsp;
<a href="javascript:resetinput()"><img src="../img/<?php echo "$lang/$lang" ?>_reset.gif" border="0" alt="<?php echo $LDReset ?>"></a>
&nbsp;&nbsp;
<?php if($saved)  : ?>
<a href="javascript:window.close()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0" alt="<?php echo $LDClose ?>"></a>
<?php else : ?>
<a href="javascript:window.close()"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border="0" alt="<?php echo $LDClose ?>">
</a>
<?php endif ?>

</BODY>

</HTML>
