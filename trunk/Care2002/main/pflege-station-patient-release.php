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

require("../global_conf/inc_remoteservers_conf.php");

if(!$encoder) $encoder=$HTTP_COOKIE_VARS["ck_pflege_user".$sid];

$breakfile="javascript:window.history.back()";
$thisfile="pflege-station-patient-release.php";

require("../include/inc_db_makelink.php");
if($link&&$DBLink_OK)
	{	
		// get orig data
		$dbtable="mahopatient";
		$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
		if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
					{
						mysql_data_seek($ergebnis,0);
						$result=mysql_fetch_array($ergebnis);
					}
			}
			else {print "<p>$sql<p>$LDDbNoRead"; exit;}
		
		if(($mode=="release")&&(!$lock))
		{
							$dbtable="nursing_station_patients";
							$sql="SELECT *	FROM $dbtable WHERE  t_date=\"$t_date\"
																		AND	station=\"$station\"";
														
							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=0;
								while( $content=mysql_fetch_array($ergebnis)) $rows++;
								if($rows==1)
								{
									$rbuf="";
					 				mysql_data_seek($ergebnis,0);
									$content=mysql_fetch_array($ergebnis);
									$buf=explode("_",$content[bed_patient]);
									$sbuf="r=$rm&b=$bd&n=$pn";
									for($i=0;$i<sizeof($buf);$i++)
									{
										if($rbuf=strstr($buf[$i],$sbuf)) 
										{
											$dbuf=explode(".",$x_date);
											$dbuf=array_reverse($dbuf);
											$s_date=implode(".",$dbuf);
											
											parse_str($rbuf,$pstr);
											
											$dbtable="nursing_station_patients_release";
											$sql="INSERT INTO $dbtable 
											(
												station,
												dept,
												name,
												patnum,
												lastname,
												firstname,
												bday,
												x_date,
												x_time,
												relart,
												s_date,
												discharge_rem,
												ward_rem,
												encoder
											)
											VALUES
											(
												'$station',
												'$content[dept]',
												'$content[name]',
												'$pstr[n]',
												'$pstr[ln]',
												'$pstr[fn]',
												'$pstr[g]',
												'$x_date',
												'$x_time',
												'$relart',
												'$s_date',
												'$info',
												'$pstr[rem]',
												'$encoder'
											)";
										if($ergebnis=mysql_query($sql,$link)) 
											{
												array_splice($buf,$i,1);
												$content[bed_patient]=implode("_",$buf);
												$used=$content[usedbed]-1;
												
												$dbtable="nursing_station_patients";
												
												$sql="UPDATE $dbtable SET bed_patient='$content[bed_patient]',
														freebed='".($content[freebed]+1)."',
														usedbed='$used',
														usebed_percent='".ceil((($used+$content[closedbeds])/$content[maxbed])*100)."' 
														WHERE t_date='$t_date' AND station='$station'";
												if($ergebnis=mysql_query($sql,$link)) 
												{
													if(($relart!="chg_ward")&&($relart!="chg_bed"))
													{
														$dbtable="mahopatient";
														$sql="UPDATE $dbtable SET discharge_date='$x_date',
																discharge_time='$x_time',
																discharge_sdate='$s_date',
																discharge_art='$relart'
																WHERE patnum='$pn'";
														if($ergebnis=mysql_query($sql,$link)) 
														{
															$released=1;
														}
													}
													else $released=1;
													if($released) 
													{
														header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&station=$station&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+"));
														exit;
													}
												}
												
												if(!$released)
												{
													$dbtable="nursing_station_patients_release";
												
													$sql="DELETE FROM $dbtable 
															WHERE x_date='$x_date' AND station='$station'";
													mysql_query($sql,$link);
												 	print "$LDDbNoDelete<br>$sql";
												 }
											}
											else print "$LDDbNoSave<br>$sql";
										break;
										}// end of if(rbuf=
									}// end of while
								
					 			}// end if(rows)
							}
				 			else {print "<p>$sql<p>$LDDbNoRead"; exit;}
			}	// end of if (mode=release)		
			
			if(!$dept)
			{
				// translate station to dept
				$dbtable="station2dept_table";
				$sql="SELECT dept FROM $dbtable WHERE station LIKE \"%$station%\" AND op=0";
				//print $sql."<br>";
				$s2dresult=mysql_query($sql,$link);
				$stat2dept=mysql_fetch_array($s2dresult);
				$dept=$stat2dept[dept];
			}
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php
require("../include/inc_css_a_hilitebu.php");
?>
<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:12}
td.vl { font-family:verdana,arial; background-color:#ffffff;color:#0; font-size:12}

</style>

<script language="javascript">
<!-- 

function pruf(d)
{ 
		if(!d.sure.checked){ return false;}
		else
		{
		if(!d.encoder.value)
		{ 
			alert("<?php echo $LDAlertNoName ?>"); 
			d.encoder.focus();
			return false;
		}
		if (!d.x_date.value){ alert("<?php echo $LDAlertNoDate ?>"); d.x_date.focus();return false;}
		if (!d.x_time.value){ alert("<?php echo $LDAlertNoTime ?>"); d.x_time.focus();return false;}
		return true;
	}
	

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
<script language="javascript" src="../js/setdatetime.js">
</script>

</HEAD>

<BODY bgcolor=<?php print $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php print $cfg['top_txtcolor']; ?>"  SIZE=+2 FACE="Arial"><STRONG><?php echo $LDReleasePatient ?> </STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>"  align=right ><nobr>
<!-- <a href="javascript:window.history.back()"><img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" width=110 height=24 border=0  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --><a href="javascript:gethelp('nursing_station.php','discharge','','<?php echo $station ?>','<?php echo $LDReleasePatient ?>')"><img src="../img/<?php echo "$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor="<?php print $cfg['body_bgcolor']; ?>" colspan=2>
 <ul>
<?php
print '<table   cellpadding="2" cellspacing=0 border="0" >
		<tr bgcolor="aqua" ><td><font face="verdana,arial" size="2" ><b>&nbsp;&nbsp;</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" ><b>'.$result[patnum].'</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" ><b>&nbsp;</b></td>
		</tr>';


print '
<tr bgcolor="#ffffcc"><td><font face="verdana,arial" size="2" ><b> &nbsp;&nbsp;</b></td>
		<td valign="top" width="250"><font face="verdana,arial" size="2" >&nbsp;<br>
		'.$result[title].'<br>
		<b>'.$result[name].', '.$result[vorname].'</b> <br>
		<font color=maroon>'.$result[gebdatum].'</font> <p>
		'.nl2br($result[address]);



print '<p><font face="verdana,arial" size="1" >'.strtoupper($station).' &nbsp; &nbsp; '.$result[kasse].' '.$result[kassename].'<p>
		'.$pday.'.'.$pmonth.'.'.$pyear.'</font></td>';
print '<td bgcolor="#ffffcc" valign="top"><font face="verdana,arial" size="2" >';

//******************* check cache if pix exists *************
$fr=strtolower("$result[patnum]_$result[name]_$result[vorname]_".(str_replace(".","-",$result[gebdatum])));

$fname=strtolower($fr."_main.jpg");
$frmain='/'.$fr.'/'.$fname;

$cpix="../cache/$fname";

if(file_exists($cpix))
{
	print '<img src="'.$cpix.'" width="150">';
}
else
{
	// if fotos must be fetched directly from local dir
	if($disc_pix_mode) 
	{
		$cpix=$fotoserver_localpath.$fname;
		if(file_exists($cpix))
		{
			print '<img src="'.$cpix.'" width="150">';
		}
		else print '<img src="'.$fotoserver_localpath.'foto-na.jpg">';
	}
	else
	{
		//**************** ftp check of main pix ************************

		// set up basic connection
		//$ftp_server="192.168.0.2";   // configured in the file ..include/inc_remoteservers_conf.php
		//$ftp_user="maryhospital_fotodepot";
		//$ftp_pw="seeonly";
		$conn_id = ftp_connect("$ftp_server"); 
		if ($conn_id)
		{
			// login with username and password
			$login_result = ftp_login($conn_id, "$ftp_user", "$ftp_pw"); 

  	 		 // check connection
  			if($login_result)
		 	{ 
  				$fn=ftp_pwd($conn_id);       
				$f_e=ftp_size($conn_id,"$fn$frmain");
  		  		//if(strpos(file("$frmain"),"warning")) print '<img src="'.$frmain.'">';
				if($f_e>0)
				{
			 		print '<img src="'.$fotoserver_http.$frmain.'" width="150">';
					// now save the pix in cache
					ftp_get($conn_id,$cpix,"$fn$frmain",FTP_BINARY);	
				}
				else print '<img src="'.$fotoserver_localpath.'foto-na.jpg">';
  			}
		 	else	echo "$LDFtpNoLink<p>";
			// close the FTP stream 
			ftp_quit($conn_id); 
		}	
		else 
		{
			print '<img src="'.$fotoserver_localpath.'foto-na.jpg"><br>';
			echo $LDFtpAttempted; 
		}
	}
 }

print '
		</td>
		</tr></table>';

?>

<?php if(($mode=="release")&&($released)) : ?>
<font face="verdana,arial" size="3" ><b><?php echo $LDJustReleased ?></b></font>
<?php endif ?>


<form action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">
<table border=0>
  <tr>
    <td class=vn><?php echo $LDPatListElements[0] ?>:</td>
    <td class=vl>&nbsp;<?php echo $rm.$bd ?></td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDDate ?>:</td>
    <td class=vl>&nbsp;
	<?php if($released) print nl2br($x_date); 
			else print '<input type="text" name="x_date" size=12 maxlength=12 value="'.date("d.m.Y").'" onKeyUp=setDate(this)>';
	?>
                 </td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDClockTime ?>:</td>
    <td class=vl>&nbsp;
	<?php if($released) print nl2br($x_time); 
			else print '<input type="text" name="x_time" size=12 maxlength=12 value="'.date("H.i").'" onKeyUp=setTime(this)>';
	?>
	</td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDReleaseType ?>:</td>
    <td class=vl>
	<?php if($released) 
	{
		switch($relart)
		{
			case "reg":	print $LDRegularRelease;break;
			case "self": print $LDSelfRelease;break;
			case "emgcy": print $LDEmRelease;
			case "chg_ward": print $LDChangeWard;
			case "chg_bed": print $LDChangeBed;
			case "pat_death": print $LDPatientDied;
		} 
	}else print '	
					<input type="radio" name="relart" value="reg" checked> '.$LDRegularRelease.'<br>
                 	<input type="radio" name="relart" value="self"> '.$LDSelfRelease.'<br>
                 	<input type="radio" name="relart" value="emgcy"> '.$LDEmRelease.'<br>
                 	<input type="radio" name="relart" value="chg_ward"> '.$LDChangeWard.'<br>
                 	<input type="radio" name="relart" value="chg_bed"> '.$LDChangeBed.'<br>
                 	<input type="radio" name="relart" value="pat_death"> '.$LDPatientDied.'<br>';
	?>
                 </td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDNotes ?>:</td>
    <td class=vl>&nbsp;
	<?php if($released) print nl2br($info); else print '<textarea name="info" cols=40 rows=3></textarea>';
	?></td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDNurse ?>:</td>
    <td class=vl>&nbsp;
	<?php if($released) print $encoder; else print '<input type="text" name="encoder" size=25 maxlength=30 value="'.$encoder.'">';
	?>
                   </td>
  </tr>
<?php if(!(($mode=="release")&&($released))) : ?>
  <tr>
    <td class=vn><input type="submit" value="<?php echo $LDRelease ?>"></td>
    <td class=vn>	<input type="checkbox" name="sure" value="1"> <?php echo $LDYesSure ?><br>
                 </td>
  </tr>
<?php endif ?>
</table>

<input type="hidden" name="mode" value="release">
<?php if(($released)||($lock)) : ?>
<input type="hidden" name="lock" value="1">
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="pday" value="<?php echo $pday ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="rm" value="<?php echo $rm ?>">
<input type="hidden" name="bd" value="<?php echo $bd ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="t_date" value="<?php echo $pday.".".$pmonth.".".$pyear ?>">

</form>
<p>


<br><a href="pflege-station.php?sid=<?php echo "$sid&lang=$lang" ?>&edit=1&station=<?php echo $station ?>">
<?php if(($mode=="release")&&($released)) : ?>
<img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border="0">
<?php else : ?>
<img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border="0">
<?php endif ?></a>

</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</BODY>
</HTML>
