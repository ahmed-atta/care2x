<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_pflege_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php"); // load color preferences

require("../global_conf/remoteservers_conf.php");

if(!$encoder) $encoder=$ck_pflege_user;

$breakfile="javascript:window.history.back()";
$thisfile="pflege-station-patient-release.php";

require("../req/db-makelink.php");
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
														header("location:$thisfile?sid=$ck_sid&lang=$lang&pn=$pn&station=$station&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+"));
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

<?
require("../req/css-a-hilitebu.php");
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
			alert("<?=$LDAlertNoName ?>"); 
			d.encoder.focus();
			return false;
		}
		if (!d.x_date.value){ alert("<?=$LDAlertNoDate ?>"); d.x_date.focus();return false;}
		if (!d.x_time.value){ alert("<?=$LDAlertNoTime ?>"); d.x_time.focus();return false;}
		return true;
	}
	

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
<script language="javascript" src="../js/setdatetime.js">
</script>

</HEAD>

<BODY bgcolor=<? print $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2 FACE="Arial"><STRONG><?=$LDReleasePatient ?> </STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>"  align=right ><nobr>
<!-- <a href="javascript:window.history.back()"><img src="../img/<?="$lang/$lang" ?>_back2.gif" width=110 height=24 border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --><a href="javascript:gethelp('nursing_station.php','discharge','','<?=$station ?>','<?=$LDReleasePatient ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?=$breakfile ?>" ><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor="<? print $cfg['body_bgcolor']; ?>" colspan=2>
 <ul>
<?


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
		//$ftp_server="192.168.0.2";   // configured in the file ..req/remoteservers_conf.php
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

<? if(($mode=="release")&&($released)) : ?>
<font face="verdana,arial" size="3" ><b><?=$LDJustReleased ?></b></font>
<? endif ?>


<form action="<?=$thisfile ?>" method="post" onSubmit="return pruf(this)">
<table border=0>
  <tr>
    <td class=vn><?=$LDPatListElements[0] ?>:</td>
    <td class=vl>&nbsp;<?=$rm.$bd ?></td>
  </tr>
  <tr>
    <td class=vn><?=$LDDate ?>:</td>
    <td class=vl>&nbsp;
	<? if($released) print nl2br($x_date); 
			else print '<input type="text" name="x_date" size=12 maxlength=12 value="'.date("d.m.Y").'" onKeyUp=setDate(this)>';
	?>
                 </td>
  </tr>
  <tr>
    <td class=vn><?=$LDClockTime ?>:</td>
    <td class=vl>&nbsp;
	<? if($released) print nl2br($x_time); 
			else print '<input type="text" name="x_time" size=12 maxlength=12 value="'.date("H.i").'" onKeyUp=setTime(this)>';
	?>
	</td>
  </tr>
  <tr>
    <td class=vn><?=$LDReleaseType ?>:</td>
    <td class=vl>&nbsp;
	<? if($released) 
	{
		switch($relart)
		{
			case "reg":	print $LDRegularRelease;break;
			case "self": print $LDSelfRelease;break;
			case "emgcy": print $LDEmRelease;
			case "chg_ward": print $LDChangeWard;
			case "chg_bed": print $LDChangeBed;
		} 
	}else print '	
					<input type="radio" name="relart" value="reg" checked> '.$LDRegularRelease.'<br>
                 	<input type="radio" name="relart" value="self"> '.$LDSelfRelease.'<br>
                 	<input type="radio" name="relart" value="emgcy"> '.$LDEmRelease.'<br>
                 	<input type="radio" name="relart" value="chg_ward"> '.$LDChangeWard.'<br>
                 	<input type="radio" name="relart" value="chg_bed"> '.$LDChangeBed.'<br>';
	?>
                 </td>
  </tr>
  <tr>
    <td class=vn><?=$LDNotes ?>:</td>
    <td class=vl>&nbsp;
	<? if($released) print nl2br($info); else print '<textarea name="info" cols=40 rows=3></textarea>';
	?></td>
  </tr>
  <tr>
    <td class=vn><?=$LDNurse ?>:</td>
    <td class=vl>&nbsp;
	<? if($released) print $encoder; else print '<input type="text" name="encoder" size=25 maxlength=30 value="'.$encoder.'">';
	?>
                   </td>
  </tr>
<? if(!(($mode=="release")&&($released))) : ?>
  <tr>
    <td class=vn><input type="submit" value="<?=$LDRelease ?>"></td>
    <td class=vn>	<input type="checkbox" name="sure" value="1"> <?=$LDYesSure ?><br>
                 </td>
  </tr>
<? endif ?>
</table>

<input type="hidden" name="mode" value="release">
<? if(($released)||($lock)) : ?>
<input type="hidden" name="lock" value="1">
<? endif ?>
<input type="hidden" name="sid" value="<?=$ck_sid ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="station" value="<?=$station ?>">
<input type="hidden" name="dept" value="<?=$dept ?>">
<input type="hidden" name="pday" value="<?=$pday ?>">
<input type="hidden" name="pmonth" value="<?=$pmonth ?>">
<input type="hidden" name="pyear" value="<?=$pyear ?>">
<input type="hidden" name="rm" value="<?=$rm ?>">
<input type="hidden" name="bd" value="<?=$bd ?>">
<input type="hidden" name="pn" value="<?=$pn ?>">
<input type="hidden" name="t_date" value="<?=$pday.".".$pmonth.".".$pyear ?>">

</form>
<p>


<br><a href="pflege-station.php?sid=<?="$ck_sid&lang=$lang" ?>&edit=1&station=<?=$station ?>">
<? if(($mode=="release")&&($released)) : ?>
<img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0">
<? else : ?>
<img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0">
<? endif ?></a>

</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</BODY>
</HTML>
