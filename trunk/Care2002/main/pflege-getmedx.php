<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_pflege_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php"); // load color preferences

$thisfile="pflege-getmedx.php";

if(!$encoder) $encoder=$ck_pflege_user;

switch($winid)
{
	case "medication": $title="$LDMedication/$LDDosage";
							$element="medication";
							//$maxelement=10;
							break;
}

$dbtable="nursing_station_patients_curve";

require("../req/db-makelink.php");
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
				$sql="SELECT $element,encoding FROM $dbtable WHERE patnum='$pn'";
				if($ergebnis=mysql_query($sql,$link))
       			{
					//print $sql." checked <br>";
					//$bbuf="";
					//$tbuf="";
					$dbuf=$maxelement."~0|".$m0."|".$d0."|".$c0;
					for($i=1;$i<$maxelement;$i++)
					{
						$tdx="m".$i;$ddx="d".$i;$cdx="c".$i;
						$dbuf=$dbuf."~".$i."|".$$tdx."|".$$ddx."|".$$cdx;
					}
					//$dbuf=$dbuf."~".$enc."\r\n".$encoder." ".date("d.m.Y")." ".date("H.i");
					$dbuf=$dbuf."~".$encoder." ".date("d.m.Y")." ".date("H.i");
					//$dbuf=strtr($dbuf," ","+");
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows==1)
						{
							// $dbuf=htmlspecialchars($dbuf);
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);
							$content[encoding].=" ~e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element;
							$sql="UPDATE $dbtable SET $element='$dbuf',encoding='$content[encoding]'	WHERE patnum='$pn'";
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&dystart=$dystart&dyname=$dyname");
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
										fe_date,
										encoding
										)
									 	VALUES
										(
										'$pn',
										'$result[name]',
										'$result[vorname]',
										'$result[gebdatum]',
										'$dbuf',
										'".date("d.m.Y")."',
										'e=".$encoder."&d=".date("d.m.Y")."&t=".date("H.i")."&a=".$element."'
										)";

							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new insert <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$ck_sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&dystart=$dystart&dyname=$dyname");
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
<TITLE><?="$title &LDInputWin" ?></TITLE>
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
	window.opener.location.href="pflege-station-patientdaten-kurve.php?sid=<?="$ck_sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$mo&jahr=$yr&tagname=$dyname" ?>&nofocus=1";
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
.v10 { font-family:verdana,arial;font-size:10; }
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080"    topmargin="0" marginheight="0" 
onLoad="<? if($saved) print "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();" >
<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<? 
	print $title.'<br><font size=4>';	
?>
	</font></b>
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?=$element ?>','','','<?=$title ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>


<font face=verdana,arial size=3 >
<form name="infoform" action="<?=$thisfile ?>" method="post" onSubmit="return pruf(this)">
<font face=verdana,arial size=2 >
<?

$mdc=explode("~",$result[$element]);
array_unique($mdc);

// chechk if element number exists else set to 10
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
	$trash=array_pop($mdc);
}

//while(list($x,$v)=each($mdc)) print $v."<br>";
//print $enc;
//print $maxelement;
//print $b_t[0]." ".$b_t[1];
?>

<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
  <tr>
    <td  align=center bgcolor="#cfcfcf" class="v13"><?="$LDMedication - $LDDosage" ?></td>
  </tr>
  <tr>
    <td align=center bgcolor="#ffffff">
	
		<table border=0 border=0 cellspacing=0 cellpadding=0>
			<tr>
   			 <td  align=center class="v12"></td>
   			 <td  align=center class="v12"><?=$LDDosage ?></td>
   			 <td  align=center class="v12"><?=$LDColorMark ?>:</td>
		  </tr>
			<? 
			
			for($i=0;$i<$maxelement;$i++)
			{
				//if(!$mdc[$i]) continue;
				//print $mdc[$i];
				$v=explode("|",$mdc[$i]);
				print '
 						 <tr>
   						 <td ><input type="text" name="m'.$i.'" size=35 maxlength=40 value="'.$v[1].'">
        				</td>
   						 <td class="v12"><input type="text" name="d'.$i.'" size=15 maxlength=16 value="'.$v[2].'"></td>
   						 <td class="v10"><nobr>
						 	<input type="radio" name="c'.$i.'" value="n" ';
							if($v[3]=="n") print 'checked';
							print '>&nbsp;&nbsp;&nbsp;<input type="radio" name="c'.$i.'" value="a" ';
							if($v[3]=="a") print 'checked';
							print '><span style="background:#00ff00"><font color="#003300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						 	<input type="radio" name="c'.$i.'" value="w" ';
							if($v[3]=="w") print 'checked';
							print '><span style="background:#ffff00"><font color="#666600">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						 	<input type="radio" name="c'.$i.'" value="c" ';
							if($v[3]=="c") print 'checked';
							print '><span style="background:#00ccff"><font color="#000033">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="radio" name="c'.$i.'" value="i" ';
							if($v[3]=="i") print 'checked';
							print '><span style="background:#ff0000"><font color="#330000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></nobr>
						 </td>
  						</tr>
 						 ';
				}
 			?>
			<tr>
   			 <td  class="v12" colspan=2>
			 <?=$LDNurse ?>:<br>
			 <input type="text" name="encoder" size=25 maxlength=30 value="<?=$encoder ?>">
			 </td>
   			 <td   class="v12"><?=$LDLegend ?>:<br>
			 <span style="background:#ffffff"><font color="#003300"> <?=$LDNormal ?> </span><br>
			 <span style="background:#00ff00"><font color="#003300"> <?=$LDAntibiotic ?> </span><br>
			 <span style="background:#ffff00"><font color="#666600"> <?=$LDDialytic ?> </span><br>
			 <span style="background:#00ccff"><font color="#000033"> <?=$LDHemolytic ?> </span><br>
			 <span style="background:#ff0000"><font color="#330000"> <?=$LDIntravenous ?> </span><br></td>
		  </tr>

		</table>
	
	</td>
    
  </tr>
</table>
</td>
  </tr>
</table>


<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="winid" value="<?=$winid ?>">
<input type="hidden" name="station" value="<?=$station ?>">
<input type="hidden" name="yr" value="<?=$yr ?>">
<input type="hidden" name="mo" value="<?=$mo ?>">
<input type="hidden" name="dy" value="<?=$dy ?>">
<input type="hidden" name="dyidx" value="<?=$dyidx ?>">
<input type="hidden" name="dystart" value="<?=$dystart ?>">
<input type="hidden" name="dyname" value="<?=$dyname ?>">
<input type="hidden" name="pn" value="<?=$pn ?>">
<input type="hidden" name="edit" value="<?=$edit ?>">
<input type="hidden" name="maxelement" value="<?=$maxelement ?>">
<input type="hidden" name="enc" value="<?=strtr($enc," ","+") ?>">
<input type="hidden" name="mode" value="save">

</form>
<p>
<a href="javascript:document.infoform.submit();"><img src="../img/<?="$lang/$lang" ?>_savedisc.gif" border="0" alt="<?=$LDSave ?>"></a>
&nbsp;&nbsp;
<a href="javascript:resetinput()"><img src="../img/<?="$lang/$lang" ?>_reset.gif" border="0" alt="<?=$LDReset ?>"></a>
&nbsp;&nbsp;
<? if($saved)  : ?>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0" alt="<?=$LDClose ?>"></a>
<? else : ?>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0" alt="<?=$LDClose ?>">
</a>
<? endif ?>

</BODY>

</HTML>
