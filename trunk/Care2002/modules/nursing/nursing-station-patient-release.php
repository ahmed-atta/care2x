<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
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
require_once($root_path.'global_conf/inc_remoteservers_conf.php');

if(!$encoder) $encoder=$HTTP_COOKIE_VARS[$local_user.$sid];

$breakfile="nursing-station.php".URL_APPEND."&edit=1&station=$station&ward_nr=$ward_nr";
$thisfile=basename(__FILE__);

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){	
	
	  /* Load date formatter */
	include_once($root_path.'include/inc_date_format_functions.php');
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;
	
	if( $enc_obj->loadEncounterData($pn)) {
		
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('patient_%');	
		$glob_obj->getConfig('person_%');	
		switch ($enc_obj->EncounterClass())
		{
	    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
	                   break;
			case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
						break;
			default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		}						
		$result=&$enc_obj->encounter;
		/* Check whether config foto path exists, else use default path */			
		$default_photo_path='fotos/registration';
		$photo_filename=$result['photo_filename'];
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
		require_once($root_path.'include/inc_photo_filename_resolve.php');
		/* Load the discharge types */
		$discharge_types=&$enc_obj->getDischargeTypesData();
	}
		
	if(($mode=='release')&&!(isset($lock)||$lock)){
		$date=(empty($x_date))?date('Y-m-d'):formatDate2STD($x_date,$date_format);
		$time=(empty($x_time))?date('H:i:s'):convertTimeToStandard($x_time);
		switch($relart)
		{
			case 1: {}
			case 2: {}
			case 7: {}
			case 3: $released=$enc_obj->Discharge($pn,$relart,$date,$time);
						break;
			case 4: $released=$enc_obj->DischargeFromWard($pn,$relart,$date,$time);
						break;
			case 5: $released=$enc_obj->DischargeFromRoom($pn,$relart,$date,$time);
						break;
			case 6: $released=$enc_obj->DischargeFromBed($pn,$relart,$date,$time);
						break;
			default: $released=false;
		}
												
		if($released){
			if(!empty($info)){
				$data_array['notes']=$info;
				$data_array['encounter_nr']=$pn;
				$data_array['date']=$date;
				$data_array['time']=$time;
				$data_array['personell_name']=$encoder;
				$enc_obj->saveDischargeNotesFromArray($data_array);
			}
			header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+")."&station=$station&ward_nr=$ward_nr");
			exit;
		}

	}	// end of if (mode=release)		
/*			
		if(!$dept)
			{
				// translate station to dept
				$dbtable='care_station2dept';
				
				$sql='SELECT dept FROM '.$dbtable.' WHERE station LIKE \'%'.$station.'%\' AND op=0';
				
				//echo $sql."<br>";
				$s2dresult=$db->Execute($sql);
				$stat2dept=$s2dresult->FetchRow();
				$dept=$stat2dept['dept'];
			}
			
	
			
*/
}else{
	echo "$LDDbNoLink<br>";
}


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

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

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2 FACE="Arial"><STRONG><?php echo $LDReleasePatient ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"  align=right ><nobr>
<!-- <a href="javascript:window.history.back()"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a> --><a href="javascript:gethelp('nursing_station.php','discharge','','<?php echo $station ?>','<?php echo $LDReleasePatient ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>
 <ul>
<?php
if(0){
echo '<table   cellpadding="2" cellspacing=0 border="0" >
		<tr bgcolor="aqua" ><td><font face="verdana,arial" size="2" ><b>&nbsp;&nbsp;</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" ><b>'.$full_en.'</b></td>
		<td bgcolor="aqua"><font face="verdana,arial" size="2" ><b>&nbsp;</b></td>
		</tr>';


echo '
<tr bgcolor="#ffffcc"><td><font face="verdana,arial" size="2" ><b> &nbsp;&nbsp;</b></td>
		<td valign="top" width="250"><font face="verdana,arial" size="2" >&nbsp;<br>
		'.$result[title].'<br>
		<b>'.$result['name_last'].', '.$result['name_first'].'</b> <br>
		<font color=maroon>'.formatDate2Local($result['date_birth'],$date_format).'</font> <p>
		'.nl2br($result[address]);



echo '<p><font face="verdana,arial" size="1" >'.strtoupper($station).' &nbsp; &nbsp; '.$result['insurance_class_nr'].' '.$result['insurance_firm_id'].'<p>
		'.formatDate2Local("$pyear-$pmonth-$pday",$date_format).'</font></td>';
echo '<td bgcolor="#ffffcc" valign="top"><font face="verdana,arial" size="2" >';

//******************* check cache if pix exists *************
$fr=strtolower($full_en.'_'.$result['name_last'].'_'.$result['vorname'].'_'.(str_replace('.','-',$result['date_birth'])));

$fname=strtolower($fr."_main.jpg");
$frmain='/'.$fr.'/'.$fname;

$cpix=$root_path."cache/$fname";

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
		else echo '<img src="../'.$fotoserver_localpath.'foto-na.jpg">';
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
}

?>

<?php if(($mode=="release")&&($released)) : ?>
<font face="verdana,arial" size="3" ><b><?php echo $LDJustReleased ?></b></font>
<?php endif ?>


<form action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">
<table border=0 bgcolor="#efefef">
  <tr>
    <td colspan=2>
	<?php
		echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
	?>
	<img <?php echo $img_source; ?> width=137 align="top">
	</td>
  </tr>
  <tr>
  <tr>
    <td class=vn><?php echo $LDPatListElements[0] ?>:</td>
    <td class=vl>&nbsp;<?php echo $rm.strtoupper(chr($bd+96));//$rm.$bd ?></td>
  </tr>
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
    <td class=vl>&nbsp;
	<?php if($released) 
	{
		while($dis_type=$discharge_types->FetchRow()){
			if($dis_type['nr']==$relart){
				if(isset($$dis_type['LD_var'])&&!empty($$dis_type['LD_var'])) echo $$dis_type['LD_var'];
					else echo $dis_type['name'];
				break;
			}
		}
	}else{ 
		$init=1;
		while($dis_type=$discharge_types->FetchRow()){
			echo '<input type="radio" name="relart" value="'.$dis_type['nr'].'"';
			if($init){
				echo ' checked';
				$init=0;
			}
			echo '>';
			if(isset($$dis_type['LD_var'])&&!empty($$dis_type['LD_var'])) echo $$dis_type['LD_var'];
				else echo $dis_type['name'];
			echo '<br>
			';
		}
			
/*	echo '	
					<input type="radio" name="relart" value="reg" checked> '.$LDRegularRelease.'<br>
                 	<input type="radio" name="relart" value="self"> '.$LDSelfRelease.'<br>
                 	<input type="radio" name="relart" value="emgcy"> '.$LDEmRelease.'<br>
                 	<input type="radio" name="relart" value="chg_ward"> '.$LDChangeWard.'<br>
                 	<input type="radio" name="relart" value="chg_bed"> '.$LDChangeBed.'<br>
                 	<input type="radio" name="relart" value="pat_death"> '.$LDPatientDied.'<br>';
*/	}
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
<?php if(!(($mode=='release')&&($released))) { ?>
  <tr>
    <td class=vn><input type="submit" value="<?php echo $LDRelease ?>"></td>
    <td class=vn>	<input type="checkbox" name="sure" value="1"> <?php echo $LDYesSure ?><br>
                 </td>
  </tr>
<?php } ?>
</table>

<input type="hidden" name="mode" value="release">
<?php if(($released)||($lock)) : ?>
<input type="hidden" name="lock" value="1">
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="ward_nr" value="<?php echo $ward_nr ?>">
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="pday" value="<?php echo $pday ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="rm" value="<?php echo $rm ?>">
<input type="hidden" name="bd" value="<?php echo $bd ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="s_date" value="<?php echo "$pyear-$pmonth-$pday" ?>">
</form>
<p>

<br><a href="<?php echo $breakfile; ?>">
<?php if(($mode=='release')&&($released)) : ?>
<img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>>
<?php else : ?>
<img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0">
<?php endif ?></a>

</FONT>
</ul>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
