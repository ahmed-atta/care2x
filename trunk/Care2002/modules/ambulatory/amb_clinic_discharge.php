<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='prompt.php';
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(!$encoder) $encoder=$HTTP_SESSION_VARS['sess_user_name'];

$breakfile="amb_clinic_patients.php".URL_APPEND."&edit=$edit&dept_nr=$dept_nr";
$thisfile=basename(__FILE__);

# Load date formatter 
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;
	
if($enc_obj->loadEncounterData($pn)){		

	if(($mode=='release')&&!(isset($lock)||$lock)){
		$date=(empty($x_date))?date('Y-m-d'):formatDate2STD($x_date,$date_format);
		$time=(empty($x_time))?date('H:i:s'):convertTimeToStandard($x_time);
		# Check the discharge type
		switch($relart){
			case 8: if( $released=$enc_obj->DischargeFromDept($pn,$relart,$date,$time)){
							# Reset current department
							//$enc_obj->ResetAllCurrentPlaces($pn,0);
						}
						 break;
			default: $released=$enc_obj->Discharge($pn,$relart,$date,$time); 
		}	
		if($released){
			# If discharge note present
			if(!empty($info)){
				$data_array['notes']=$info;
				$data_array['encounter_nr']=$pn;
				$data_array['date']=$date;
				$data_array['time']=$time;
				$data_array['personell_name']=$encoder;
				$enc_obj->saveDischargeNotesFromArray($data_array);
			}
			
			# If patient died
			if($relart==7){
				include_once($root_path.'include/care_api_classes/class_person.php');
				$person=new Person;
				$death['death_date']=$date;
				$death['death_encounter_nr']=$pn;
				$death['history']="CONCAT(history,'Discharged ".date('Y-m-d H:i:s')." $encoder\n')";
				$death['modify_id']=$encoder;
				$death['modify_time']=date('YmdHis');
				@$person->setDeathInfo($enc_obj->PID(),$death);
				//echo $person->getLastQuery();
			}

			header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+")."&station=$station&dept_nr=$dept_nr");
			exit;
		}
	}
			
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('patient_%');	
		$glob_obj->getConfig('person_%');	
		
		$result=&$enc_obj->encounter;
		
		/* Check whether config foto path exists, else use default path */			
		$default_photo_path='fotos/registration';
		$photo_filename=$result['photo_filename'];
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
		require_once($root_path.'include/inc_photo_filename_resolve.php');
		/* Load the discharge types */
		$discharge_types=&$enc_obj->getDischargeTypesData();

		if(!isset($dept)||empty($dept)){
			# Create nursing notes object 
			include_once($root_path.'include/care_api_classes/class_department.php');
			$dept_obj= new Department;
			$dept=$dept_obj->FormalName($dept_nr);
		}
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
	if(!d.sure.checked){
		return false;
	}else{
		if(!d.encoder.value){ 
			alert("<?php echo $LDAlertNoName ?>"); 
			d.encoder.focus();
			return false;
		}
		if (!d.x_date.value){ alert("<?php echo $LDAlertNoDate ?>"); d.x_date.focus();return false;}
		if (!d.x_time.value){ alert("<?php echo $LDAlertNoTime ?>"); d.x_time.focus();return false;}
		// Check if death
		if(d.relart[3].checked==true&&d.x_date.value!=""){
			if(!confirm("<?php echo $LDDeathDateIs ?> "+d.x_date.value+". <?php echo "$LDIsCorrect $LDProceedSave" ?>")) return false;
		}
		return true;
	}
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

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

<?php if(($mode=='release')&&($released)) { ?>
<font face="verdana,arial" size="3" ><b><?php echo $LDJustReleased ?></b></font>
<?php } ?>


<form action="<?php echo $thisfile ?>" name="discform" method="post" onSubmit="return pruf(this)">
<table border=0 bgcolor="#efefef">
  <tr>
    <td colspan=2>
		
		<table border=0 cellpadding=0 cellspacing=0 width=100%>
    <tr>
      <td>
	  <?php
		echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&fen='.$pn.'&en='.$pn.'" width=282 height=178 >';
		?><br>
	</td>
      <td valign=top align=center><img <?php echo $img_source; ?> align="top"></td>
    </tr>
  </table>
	
	</td>
  </tr>
  <tr>
  <tr>
    <td class=vn><?php echo "$LDClinic/$LDDept" ?>:</td>
    <td class=vl>&nbsp;<?php echo $dept;//$rm.$bd ?></td>
  </tr>
    <td class=vn><?php echo $LDDate ?>:</td>
    <td class=vl>&nbsp;
	<?php 
	if($released){
		 echo nl2br($x_date);
	}else{
		echo '<input type="text" name="x_date" size=12 maxlength=10 value="'.formatdate2Local(date('Y-m-d'),$date_format).'"  onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">';
	?>
	<a href="javascript:show_calendar('discform.x_date','<?php echo $date_format ?>')">
 	<img <?php echo createComIcon($root_path,'show-calendar.gif','0','top'); ?>></a>
	<?php
	}
	?>
                 </td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDClockTime ?>:</td>
    <td class=vl>&nbsp;
	<?php if($released) echo nl2br($x_time); 
			else echo '<input type="text" name="x_time" size=12 maxlength=12 value="'.convertTimeToLocal(date('H:i:s')).'" onKeyUp=setTime(this,\''.$lang.'\')>';
	?>
	</td>
  </tr>
  <tr>
    <td class=vn><?php echo $LDReleaseType ?>:</td>
    <td class=vl><?php if($released) 
	{
		while($dis_type=$discharge_types->FetchRow()){
			if($dis_type['nr']==$relart){
				echo '&nbsp;';
				if(isset($$dis_type['LD_var'])&&!empty($$dis_type['LD_var'])) echo $$dis_type['LD_var'];
					else echo $dis_type['name'];
				break;
			}
		}
	}else{ 
		$init=1;
		while($dis_type=$discharge_types->FetchRow()){
			if(stristr('4,5,6',$dis_type['nr'])) continue;
			echo '&nbsp;<input type="radio" name="relart" value="'.$dis_type['nr'].'"';
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
	}
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
