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

$thisfile=basename(__FILE__);

switch($winid)
{
	case 'medication': $title="$LDMedication/$LDDosage";
							$maxelement=10;
							break;
}

$dbtable='care_nursing_station_patients_curve';

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
	{	
	  /* Load date formatter */
      include_once($root_path.'include/inc_date_format_functions.php');
      				

    	// get orig data

		if($mode=='save')
		{
		 	$element="medication_dailydose";
					
				// check if entry is already existing
				$sql="SELECT $element FROM $dbtable WHERE patnum='$pn'";
				if($ergebnis=$db->Execute($sql))
       			{
					//echo $sql." checked <br>";
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
					
					$rows=$ergebnis->RecordCount();
					if($rows==1)
						{
							$content=$ergebnis->FetchRow();
							if($content[$element]!='')
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
								else echo "<p>".$sql."<p>Das Lesen  aus der Datenbank $dbtable ist gescheitert."; 
						} // else create new entry
						else
						{
							//$dbuf=strtr("sd=$yr$mo$dy&rd=$dy.$mo.$yr&e=$newdata"," <>","+()")."\r\n";
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
		 	// get medication info
			$element='medication';

		 	$sql="SELECT * FROM $dbtable WHERE patnum='$pn'";

			if($ergebnis=$db->Execute($sql))
       		{
				if($rows=$ergebnis->RecordCount())
				{
					$result=$ergebnis->FetchRow();
					$medbuf=$result[$element];
					//echo $sql."<br>";
					// get daily dose info
					$element="medication_dailydose";
					$sql="SELECT * FROM $dbtable WHERE patnum='$pn'";

					if($ergebnis=$db->Execute($sql))
       				{
						if($rows=$ergebnis->RecordCount())
						{
							$result=$ergebnis->FetchRow();
							$dosebuf=$result[$element];
							//echo $sql."<br>";
						}
					}
					else {echo "<p>$sql$LDDbNoRead";} 
				}
			}
				else {echo "<p>$sql$LDDbNoRead";}
	 	}
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }


		
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
//echo $abuf[e]."<br>";
$dose=trim($abuf[e]);
//echo $b_t[0]." ".$b_t[1];


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
//echo $b_t[0]." ".$b_t[1];
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
	window.opener.location.href="nursing-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$monstart&jahr=$yrstart&tagname=$dyname" ?>&nofocus=1";
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
onLoad="<?php if($saved) echo "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();" >
<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<?php 
	echo $title.'<br><font size=4>';	
	echo $LDFullDayName[$dyidx].' ('.formatDate2Local("$yr-$mo-$dy",$date_format).')</font>';
?>
	</font></b>
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','medication_dailydose','','<?php echo $mdcsize ?>','<?php echo $title ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>


<font face=verdana,arial size=3 >
<form name="infoform" action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">
<font face=verdana,arial size=2 >


<table border=0  bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
			<tr>
   			 <td  align=center class="v12"  bgcolor="#cfcfcf" ><?php echo $LDMedication ?></td>
   			 <td  align=center class="v12"  bgcolor="#cfcfcf" ><?php echo $LDDosage ?></td>
   			 <td  align=center class="v12"  bgcolor="#cfcfcf" ><?php echo $LDTodaysReport ?>:</td>
		  </tr>
		<?php 
		$ds=explode("|",$dose);
		if($mdcsize)
		{
			for($i=0;$i<$mdcsize;$i++)
			{
				//if(!$mdc[$i]) continue;
				$v=explode("|",$mdc[$i]);
				if(!$v[1]) continue;
				echo '
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
		else echo '
		 				<tr>
   						 <td  colspan="3" bgcolor="#ffffff"><img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>
        				<font face="Verdana, Arial" size=4 color="#800000">'.$LDNoMedicineYet.'&nbsp;</font></td>
  						</tr>
 						 ';
 		?>
</table>
</td>
  </tr>
</table>


<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
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
<input type="hidden" name="mode" value="save">

</form>
<p>
<?php if($mdcsize) : ?>
<a href="javascript:document.infoform.submit();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSave ?>"></a>
&nbsp;&nbsp;
<a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDReset ?>"></a>
&nbsp;&nbsp;
<?php endif ?>
<?php if($saved)  : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
<?php else : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>" border="0" alt="<?php echo $LDClose ?>">
</a>
<?php endif ?>

</BODY>

</HTML>
