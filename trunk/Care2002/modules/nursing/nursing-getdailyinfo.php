<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile="nursing-getdailyinfo.php";

switch($winid)
{
	case "diag_ther_dailyreport": $title=$LDDailyDiagTher;
							$element=diag_ther_dailyreport;
							break;
	case "kg_atg_etc": $title=$LDPtAtgEtcTxt;
							$element="kg_atg_etc";
							break;
	case "diet": $title=$LDDiet;
							$element="diet";
							$sformat=1;
							break;
	case "anticoag_dailydose": $title=$LDAntiCoagTxt;
							$element="anticoag_dailydose";
							$sformat=1;
							break;
	case "iv_needle": $title=$LDIvPort;
							$element="iv_needle";
							$sformat=1;
							break;
	case "bp_temp": $title=$LDBpTemp;
							$element="bp_temp";
							break;
}

$dbtable='care_nursing_station_patients_curve';

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){	
	/* Load date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
	// get orig data

	if($mode=='save'){

				// check if entry is already existing
				$sql="SELECT $element FROM $dbtable WHERE patnum='$pn'";
				if($ergebnis=$db->Execute($sql))
       			{
					//echo $sql." checked <br>";
					$rows=$ergebnis->RecordCount();
					if($rows==1)
						{
							$content=$ergebnis->FetchRow();
							if(($actual)||($newdata))
								$dbuf=strtr("sd=$yr$mo$dy&rd=$dy.$mo.$yr&e=$actual$newdata\r\n"," <>","+()");
								else $dbuf="";
							if($content[$element]!="")
							{
								$cbuf="sd=$yr$mo$dy&rd=$dy.$mo.$yr";
								//echo $content[$element]."<br>".$cbuf;
								if(stristr($content[$element],$cbuf))
								{
									$ebuf=explode("_",$content[$element]);
									for($i=0;$i<sizeof($ebuf);$i++)
									{
										//echo $v." v <br>";
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
							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new update <br>";
									
									header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&yrstart=$yrstart&monstart=$monstart&dystart=$dystart&dyname=$dyname");
								}
								else {echo "<p>$sql$LDDbNoRead";}
						} // else create new entry
						else
						{
							$dbuf=strtr("sd=$yr$mo$dy&rd=$dy.$mo.$yr&e=$newdata"," <>","+()")."\r\n";
							$sql="INSERT INTO $dbtable 
										(
										patnum,
										$element,
										fe_date
										)
									 	VALUES
										(
										'$pn',
										'$dbuf',
										'".date("d.m.Y")."'
										)";

							if($ergebnis=$db->Execute($sql))
       							{
									//echo $sql." new insert <br>";
									
									header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&yrstart=$yrstart&monstart=$monstart&dystart=$dystart&dyname=$dyname");
								}
								else {echo "<p>$sql$LDDbNoSave";}
						}//end of else
					} // end of if ergebnis
		 }// end of if(mode==save)
		 else
		 {
		 	$sql="SELECT * FROM $dbtable WHERE patnum='$pn'";

			if($ergebnis=$db->Execute($sql))
       		{
				if($rows=$ergebnis->RecordCount())
				{
					$result=$ergebnis->FetchRow();
					//echo $sql."<br>";
				}
			}
				else {echo "<p>$sql$LDDbNoRead";}
	 	}
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }


?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo "$title $LDInputWin" ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

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
	window.opener.location.href="nursing-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&kmonat=$monstart&jahr=$yrstart&tagname=$dyname" ?>&nofocus=1";
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
//-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080"  topmargin="0" marginheight="0" 
onLoad="<?php if($saved) echo "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();document.infoform.newdata.focus();" >
<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<?php 
	echo $title.'<br><font size=4>';	
	echo $LDFullDayName[$dyidx].' ('.formatDate2Local("$yr-$mo-$dy",$date_format).')</font>';
?>
	</font></b>
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $element ?>','','','<?php echo $title ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
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
?>

<?php if($sformat) : ?>
	<?php echo $LDSFormatPrompt ?>
<p>
<input type="hidden" name="actual" value="">
<input type="text" name="newdata" value="<?php echo $abuf[e] ?>" size=16 maxlength=16>
<?php else : ?>
<?php 	
	echo "$LDCurrentEntry:<br>";
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


if ($abuf[e]) 
{
echo '
<textarea cols="35" rows="4" name="actual">'.stripcslashes($abuf[e]).'</textarea>
<br>
		 &nbsp;<a href="javascript:sethilite(document.infoform.actual)"><img '.createComIcon($root_path,'hilite-s.gif','0').'></a>
		<a href="javascript:endhilite(document.infoform.actual)"><img '.createComIcon($root_path,'hilite-e.gif','0').'></a>
';
	
}
  else
  echo '<input type="hidden" name="actual" value="">';
?>


<p>
<font face=verdana,arial size=2 ><b><?php echo $LDEntryPrompt ?>:</b><br></font>
<textarea cols="35" rows="4" name="newdata"><?php echo $newdata ?></textarea>


<br>
		 &nbsp;<a href="javascript:sethilite(document.infoform.newdata)"><img <?php echo createComIcon($root_path,'hilite-s.gif','0') ?>></a>
		<a href="javascript:endhilite(document.infoform.newdata)"><img <?php echo createComIcon($root_path,'hilite-e.gif','0') ?>></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="yr" value="<?php echo $yr ?>">
<input type="hidden" name="mo" value="<?php echo $mo ?>">
<input type="hidden" name="dy" value="<?php echo $dy ?>">
<input type="hidden" name="dystart" value="<?php echo $dystart ?>">
<input type="hidden" name="monstart" value="<?php echo $monstart ?>">
<input type="hidden" name="yrstart" value="<?php echo $yrstart ?>">
<input type="hidden" name="dyname" value="<?php echo $dyname ?>">
<input type="hidden" name="dyidx" value="<?php echo $dyidx ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="sformat" value="<?php echo $sformat ?>">
<input type="hidden" name="mode" value="save">

</form>
<p>
<a href="javascript:document.infoform.submit();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSave ?>"></a>
&nbsp;&nbsp;
<a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDReset ?>"></a>
&nbsp;&nbsp;
<?php if($saved)  : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
<?php else : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>" border="0" alt="<?php echo $LDClose ?>">
</a>
<?php endif ?>

</BODY>

</HTML>
