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

$thisfile="pflege-popgetinfo.php";

switch($winid)
{
	case "diag_ther": $title=$LDDiagnosisTherapy;
							$element=diag_ther;
							break;
	case "lot_mat_etc": $title=$LDExtraNotes;
							$element="lot_mat_etc";
							break;
	case "anticoag": $title=$LDAntiCoag;
							$element="anticoag";
							break;
	case "xdiag_specials": $title=$LDExtraNotes;
							$element="xdiag_specials";
							break;
	case "allergy": $title=$LDAllergy;
							$element="allergy";
							break;
	case "kg_atg_etc": $title=$LDPtAtgEtcTxt;
							$element="kg_atg_etc";
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
					$rows=0;
					if( $content=mysql_fetch_array($ergebnis)) $rows++;
					if($rows==1)
						{
							mysql_data_seek($ergebnis,0);
							$content=mysql_fetch_array($ergebnis);

							if($newdata) $dbuf=$actual.$newdata."\r\n";
								else $dbuf=$actual;							
							$sql="UPDATE $dbtable SET $element='$dbuf'	WHERE patnum='$pn'";
							if($ergebnis=mysql_query($sql,$link))
       							{
									//print $sql." new update <br>";
									mysql_close($link);
									header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dystart=$dystart&dyname=$dyname");
								}
								else {print "<p>$sql<p>$LDDbNoRead"; exit;}
						} // else create new entry
						else
						{
							$dbuf=$newdata."\r\n";
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
									header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dystart=$dystart&dyname=$dyname");
								}
								else print "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
						}//end of else
					} // end of if ergebnis
				}// end of if rows
				else {print "<p>$sql<p>$LDDbNoRead"; exit;}
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
				else {print "<p>$sql<p>$LDDbNoRead"; exit;} 
	 	}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }


?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?php echo "$title - $LDInputWin" ?></TITLE>
<?php
require("../include/inc_css_a_hilitebu.php");
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
	window.opener.location.href="pflege-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$mo&jahr=$yr&tagname=$dyname" ?>&nofocus=1";
	}
	
function sethilite(d){
	d.focus();
	d.value=d.value+"*";
	d.focus();
	}
function endhilite(d){
	d.focus();
	d.value=d.value+"**";
	d.focus();
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
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080" topmargin="0" marginheight="0" 
onLoad="<?php if($saved) print "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();document.infoform.newdata.focus();" >

<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<?php 
	print $title; 
?>
	</font></b>
	</td>
    <td align="right"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $element ?>','','','<?php echo $title ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>

<font face=verdana,arial size=3 >
<form name="infoform" action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">

<font face=verdana,arial size=2 ><?php echo $LDCurrentEntry ?>:<br></font>
<?php if ($result[$element]) 
{
	print '
<textarea cols="35" rows="4" name="actual">'.stripcslashes($result[$element]).'</textarea>
<br>
		 &nbsp;<a href="javascript:sethilite(document.infoform.actual)"><img src="../img/hilite-s.gif" border=0 width=48 height=14 ></a>
		<a href="javascript:endhilite(document.infoform.actual)"><img src="../img/hilite-e.gif" border=0 width=48 height=14 ></a>
';
	
}
  else
  print '<input type="hidden" name="actual" value="">';
?>


<p>
<font face=verdana,arial size=2 ><b><?php echo $LDEntryPrompt ?>:</b><br></font>
<textarea cols="35" rows="4" name="newdata"><?php echo $newdata ?></textarea>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="yr" value="<?php echo $yr ?>">
<input type="hidden" name="mo" value="<?php echo $mo ?>">
<input type="hidden" name="dy" value="<?php echo $dy ?>">
<input type="hidden" name="dystart" value="<?php echo $dystart ?>">
<input type="hidden" name="dyname" value="<?php echo $dyname ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="mode" value="save">
<br>
		 &nbsp;<a href="javascript:sethilite(document.infoform.newdata)"><img src="../img/hilite-s.gif" border=0 width=48 height=14 ></a>
		<a href="javascript:endhilite(document.infoform.newdata)"><img src="../img/hilite-e.gif" border=0 width=48 height=14 ></a>

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
