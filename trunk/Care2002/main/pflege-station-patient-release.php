<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences
require_once('../global_conf/inc_remoteservers_conf.php');

/* Check whether the content is language dependent and set the lang appendix */
if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
    $lang_append=' AND lang=\''.$lang.'\'';
}
else 
{
    $lang_append='';
}

if(!$encoder) $encoder=$HTTP_COOKIE_VARS[$local_user.$sid];

$breakfile='javascript:window.history.back()';
$thisfile='pflege-station-patient-release.php';

/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
	{	
	
	  /* Load date formatter */
      include_once('../include/inc_date_format_functions.php');
      				
      
	  /* Load editor functions */
      //include_once('../include/inc_editor_fx.php');
	  
	  /*// get orig data */
		$dbtable='care_admission_patient';
		
		$sql='SELECT * FROM '.$dbtable.' WHERE patnum=\''.$pn.'\'';
		
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
			else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
		
		if(($mode=='release')&&(!$lock))
		{
							$dbtable='care_nursing_station_patients';
							
							$sql='SELECT *	FROM '.$dbtable.' WHERE  s_date=\''.$s_date.'\' AND	station=\''.$station.'\''.$lang_append;
														
							$ergebnis=mysql_query($sql,$link);
							if($ergebnis)
       						{
								$rows=mysql_num_rows($ergebnis);
								if($rows==1)
								{
									$rbuf='';
									$content=mysql_fetch_array($ergebnis);
									$buf=explode('_',$content[bed_patient]);
									$sbuf="r=$rm&b=$bd&n=$pn";
									for($i=0;$i<sizeof($buf);$i++)
									{
										if($rbuf=strstr($buf[$i],$sbuf)) 
										{
/*											$dbuf=explode(".",$x_date);
											$dbuf=array_reverse($dbuf);
											$s_date=implode(".",$dbuf);
*/											
                                            
											parse_str($rbuf,$pstr);
											
											$dbtable='care_nursing_station_patients_release';
											
											
											$sql="INSERT INTO $dbtable 
											(
											    lang,
												station,
												dept,
												name,
												patnum,
												lastname,
												firstname,
												bday,
												x_time,
												relart,
												s_date,
												discharge_rem,
												ward_rem,
												create_id,
												create_time
											)
											VALUES
											(
											    '$lang',
												'$station',
												'".$content['dept']."',
												'".$content['name']."',
												'$pstr[n]',
												'$pstr[ln]',
												'$pstr[fn]',
												'$pstr[g]',
												'$x_time',
												'$relart',
												'".formatDate2Std($x_date,$date_format)."',
												'$info',
												'$pstr[rem]',
												'$encoder',
												NULL
											)";
											
										if($ergebnis=mysql_query($sql,$link)) 
										{
										   $new_row=mysql_insert_id($link);
										   
										   if($new_row)
										   {
												array_splice($buf,$i,1);
												$content[bed_patient]=implode("_",$buf);
												$used=$content[usedbed]-1;
												
												$dbtable='care_nursing_station_patients';
												
												$sql="UPDATE $dbtable SET bed_patient='$content[bed_patient]',
														freebed='".($content[freebed]+1)."',
														usedbed='$used',
														usebed_percent='".ceil((($used+$content[closedbeds])/$content[maxbed])*100)."' 
														WHERE s_date='".formatDate2Std($x_date,$date_format)."' AND station='$station'".$lang_append;
														
												if($ergebnis=mysql_query($sql,$link)) 
												{

														$dbtable='care_admission_patient';
														
												        if(($relart!='chg_ward')&&($relart!='chg_bed'))
													    {														
														   $sql="UPDATE $dbtable SET 
																discharge_time='".$x_time.":00',
																discharge_sdate='".formatDate2Std($x_date,$date_format)." ".$x_time.":00',
																discharge_art='$relart',
																at_station='0'
																WHERE patnum='".$pn."'";
												         }		
														 else
														 {														
														   $sql="UPDATE $dbtable SET at_station='0' WHERE patnum='$pn'";
														  }
														  
														if($ergebnis=mysql_query($sql,$link)) 
														{
															$released=1;
														}
														else
														{
														   echo "$sql<br>$LDDbNoSave";
														}

													
													
													if($released) 
													{
														header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&station=$station&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+"));
														exit;
													}
												}
												
												if(!$released)
												{
													$dbtable='care_nursing_station_patients_release';
												
													$sql='DELETE FROM '.$dbtable.' WHERE item=\''.$new_row.'\'';
													mysql_query($sql,$link);
												 	echo "$LDDbNoDelete<br>$sql";
												 }
											  } // end of if($new_row)
											}
											else echo "$LDDbNoSave<br>$sql";
										break;
										}// end of if(rbuf=
									}// end of while
								
					 			}// end if(rows)
							}
				 			else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
			}	// end of if (mode=release)		
			
			if(!$dept)
			{
				// translate station to dept
				$dbtable='care_station2dept';
				
				$sql='SELECT dept FROM '.$dbtable.' WHERE station LIKE \'%'.$station.'%\' AND op=0';
				
				//echo $sql."<br>";
				$s2dresult=mysql_query($sql,$link);
				$stat2dept=mysql_fetch_array($s2dresult);
				$dept=$stat2dept['dept'];
			}
			
	
			
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require('../include/inc_css_a_hilitebu.php');
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

<?php require('../include/inc_checkdate_lang.php'); ?>

//-->
</script>

<script language="javascript" src="../js/checkdate.js"></script>
<script language="javascript" src="../js/setdatetime.js"></script>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2 FACE="Arial"><STRONG><?php echo $LDReleasePatient ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"  align=right ><nobr>
<!-- <a href="javascript:window.history.back()"><img <?php echo createLDImgSrc('../','back2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --><a href="javascript:gethelp('nursing_station.php','discharge','','<?php echo $station ?>','<?php echo $LDReleasePatient ?>')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>
 <ul>
<?php
echo '<table   cellpadding="2" cellspacing=0 border="0" >
		<tr bgcolor="aqua" ><td><font face="verdana,arial" size="2" ><b>&nbsp;&nbsp;</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" ><b>'.$result[patnum].'</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" ><b>&nbsp;</b></td>
		</tr>';


echo '
<tr bgcolor="#ffffcc"><td><font face="verdana,arial" size="2" ><b> &nbsp;&nbsp;</b></td>
		<td valign="top" width="250"><font face="verdana,arial" size="2" >&nbsp;<br>
		'.$result[title].'<br>
		<b>'.$result[name].', '.$result[vorname].'</b> <br>
		<font color=maroon>'.formatDate2Local($result[gebdatum],$date_format).'</font> <p>
		'.nl2br($result[address]);



echo '<p><font face="verdana,arial" size="1" >'.strtoupper($station).' &nbsp; &nbsp; '.$result['kasse'].' '.$result['kassename'].'<p>
		'.formatDate2Local("$pyear-$pmonth-$pday",$date_format).'</font></td>';
echo '<td bgcolor="#ffffcc" valign="top"><font face="verdana,arial" size="2" >';

//******************* check cache if pix exists *************
$fr=strtolower("$result[patnum]_$result[name]_$result[vorname]_".(str_replace('.','-',$result['gebdatum'])));

$fname=strtolower($fr."_main.jpg");
$frmain='/'.$fr.'/'.$fname;

$cpix="../cache/$fname";

if(file_exists($cpix))
{
	echo '<img src="'.$cpix.'" width="150">';
}
else
{
	// if fotos must be fetched directly from local dir
	if($disc_pix_mode) 
	{
		$cpix=$fotoserver_localpath.$fname;
		if(file_exists($cpix))
		{
			echo '<img src="'.$cpix.'" width="150">';
		}
		else echo '<img src="'.$fotoserver_localpath.'foto-na.jpg">';
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
  		  		//if(strpos(file("$frmain"),"warning")) echo '<img src="'.$frmain.'">';
				if($f_e>0)
				{
			 		echo '<img src="'.$fotoserver_http.$frmain.'" width="150">';
					// now save the pix in cache
					ftp_get($conn_id,$cpix,"$fn$frmain",FTP_BINARY);	
				}
				else echo '<img src="'.$fotoserver_localpath.'foto-na.jpg">';
  			}
		 	else	echo "$LDFtpNoLink<p>";
			// close the FTP stream 
			ftp_quit($conn_id); 
		}	
		else 
		{
			echo '<img src="'.$fotoserver_localpath.'foto-na.jpg"><br>';
			echo $LDFtpAttempted; 
		}
	}
 }

echo '
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
	<?php if($released) echo nl2br($x_date); 
			else echo '<input type="text" name="x_date" size=12 maxlength=10 value="'.formatdate2Local(date('Y-m-d'),$date_format).'"  onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">';
	?>
                 </td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDClockTime ?>:</td>
    <td class=vl>&nbsp;
	<?php if($released) echo nl2br($x_time); 
			else echo '<input type="text" name="x_time" size=12 maxlength=12 value="'.convertTimeToLocal(date('H:i')).'" onKeyUp=setTime(this,\''.$lang.'\')>';
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
			case 'reg':	echo $LDRegularRelease; break;
			case 'self': echo $LDSelfRelease; break;
			case 'emgcy': echo $LDEmRelease; break;
			case 'chg_ward': echo $LDChangeWard; break;
			case 'chg_bed': echo $LDChangeBed; break;
			case 'pat_death': echo $LDPatientDied; break;
		} 
	}else echo '	
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
	<?php if($released) echo nl2br($info); else echo '<textarea name="info" cols=40 rows=3></textarea>';
	?></td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDNurse ?>:</td>
    <td class=vl>&nbsp;
	<?php if($released) echo $encoder; else echo '<input type="text" name="encoder" size=25 maxlength=30 value="'.$encoder.'">';
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
<input type="hidden" name="s_date" value="<?php echo "$pyear-$pmonth-$pday" ?>">

</form>
<p>


<br><a href="pflege-station.php?sid=<?php echo "$sid&lang=$lang" ?>&edit=1&station=<?php echo $station ?>">
<?php if(($mode=="release")&&($released)) : ?>
<img <?php echo createLDImgSrc('../','close2.gif','0') ?>>
<?php else : ?>
<img <?php echo createLDImgSrc('../','cancel.gif','0') ?>" border="0">
<?php endif ?></a>

</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</BODY>
</HTML>
