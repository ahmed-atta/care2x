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
define('LANG_FILE','konsil.php');

/* Globalize the variables */


/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  $breakfile=$root_path."modules/laboratory/labor.php".URL_APPEND;
}
else
{
  $local_user='ck_pflege_user';
  $breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile='nursing-station-patientdaten-doconsil-patho.php';

$bgc1='#cde1ec'; 
$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");

//$konsil="patho";
$formtitle=$abtname[$target];
$db_request_table=$target;
define('_BATCH_NR_INIT_',20000000); 
/*
*  The following are  batch nr inits for each type of test request
*   chemlabor = 10000000; patho = 20000000; baclabor = 30000000; blood = 40000000; generic = 50000000;
*/
						
/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	
   
   require_once($root_path.'include/inc_date_format_functions.php');
   

     /* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
     if(isset($pn)&&$pn)
	 {		
		include_once($root_path.'include/care_api_classes/class_encounter.php');
		$enc_obj=new Encounter;
	    if( $enc_obj->loadEncounterData($pn)) {
		
			include_once($root_path.'include/care_api_classes/class_globalconfig.php');
			$GLOBAL_CONFIG=array();
			$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
			$glob_obj->getConfig('patient_%');	
			switch ($enc_obj->EncounterClass())
			{
		    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		                   break;
				case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
				default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			}						
			if($enc_obj->is_loaded){
				$result=&$enc_obj->encounter;
			}
		}else{
	      	$edit=0;
		  	$mode='';
		  	$pn='';
	   	}		
	}

	   
	 if(!isset($mode))   $mode='';
		
		  switch($mode)
		  {
				     case 'save':
							
                                 $sql="INSERT INTO care_test_request_".$db_request_table." 
								          (
										   batch_nr, encounter_nr, dept_nr, quick_cut, 
										   qc_phone, quick_diagnosis, qd_phone, material_type, 
										   material_desc, localization, clinical_note, extra_note, 
										   repeat_note, gyn_last_period, gyn_period_type, 
										   gyn_gravida, gyn_menopause_since, 
										   gyn_hysterectomy, gyn_contraceptive, 
										   gyn_iud, gyn_hormone_therapy, 
										   doctor_sign, op_date, send_date,
										   status, history, modify_id,create_id, create_time) 
										   VALUES 
										   (
										   '".$batch_nr."','".$pn."','".$dept_nr."', '".$quick_cut."', 
										   '".$qc_phone."', '".$quick_diagnosis."', '".$qd_phone."', '".$material_type."', 
										   '".addslashes(htmlspecialchars($material_desc))."', '".addslashes(htmlspecialchars($localization))."', '".addslashes(htmlspecialchars($clinical_note))."', '".addslashes(htmlspecialchars($extra_note))."', 
										   '".addslashes(htmlspecialchars($repeat_note))."', '".addslashes($gyn_last_period)."', '".addslashes($gyn_period_type)."', 
										   '".addslashes($gyn_gravida)."', '".addslashes($gyn_menopause_since)."', 
										   '".addslashes($gyn_hysterectomy)."', '".addslashes($gyn_contraceptive)."', 
										   '".addslashes($gyn_iud)."', '".addslashes($gyn_hormone_therapy)."', 
										   '".addslashes($doctor_sign)."', '".formatDate2Std($op_date,$date_format)."', '".date('Y-m-d H:i:s')."',
										   '".$status."',
										   'Create: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n',
										   '".$HTTP_SESSION_VARS['sess_user_name']."', '".$HTTP_SESSION_VARS['sess_user_name']."', NULL
										   )";


							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
									
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php".URL_REDIRECT_APPEND."&edit=$edit&saved=insert&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&noresize=$noresize&batch_nr=$batch_nr");
									 exit;
								  }
								  else 
								  {
								     echo "<p>$sql<p>$LDDbNoSave"; 
									 $mode="";
								  }
								
								break; // end of case 'save'
								
		     case 'update':
			 
							      $sql="UPDATE care_test_request_".$db_request_table." SET 
								          dept_nr = '".$dept_nr."', 
										  quick_cut = '".$quick_cut."', qc_phone = '".$qc_phone."', quick_diagnosis = '".$quick_diagnosis."', 
										  qd_phone = '".$qd_phone."', material_type = '".$material_type."', 
										  material_desc = '".htmlspecialchars($material_desc)."', localization = '".htmlspecialchars($localization)."', 
										  clinical_note = '".htmlspecialchars($clinical_note)."', extra_note = '".htmlspecialchars($extra_note)."', repeat_note = '".htmlspecialchars($repeat_note)."', 
										  gyn_last_period = '".htmlspecialchars($gyn_last_period)."', gyn_period_type = '".htmlspecialchars($gyn_period_type)."', gyn_gravida = '".htmlspecialchars($gyn_gravida)."', 
										  gyn_menopause_since = '".htmlspecialchars($gyn_menopause_since)."', gyn_hysterectomy = '".htmlspecialchars($hysterectomy)."', 
										  gyn_contraceptive = '".htmlspecialchars($gyn_contraceptive)."', gyn_iud = '".htmlspecialchars($gyn_iud)."', gyn_hormone_therapy = '".htmlspecialchars($gyn_hormone_therapy)."', 
										  doctor_sign = '".htmlspecialchars($doctor_sign)."', op_date = '".formatDate2STD($op_date,$date_format)."', 
										  status = '".$status."', 
										  history = CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
										  modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
									
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php".URL_REDIRECT_APPEND."&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&batch_nr=$batch_nr&noresize=$noresize");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								
								break; // end of case 'save'
								
								
	        /* If mode is edit, get the stored test request when its status is either "pending" or "draft"
			*  otherwise it is not editable anymore which happens when the lab has already processed the request,
			*  or when it is discarded, hidden, locked, or otherwise. 
			*
			*  If the "parameter" element is not empty, parse it to the $stored_param variable
			*/
			case 'edit':
			
		                $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."' AND (status='pending' OR status='draft' OR status='')";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_request=$ergebnis->FetchRow();
							   
							   $edit_form=1;

					         }
			             }
						 
						 break; ///* End of case 'edit': */
			
			 default: $mode='';
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get a new batch number */
		  {
		                $sql="SELECT batch_nr FROM care_test_request_".$db_request_table." ORDER BY batch_nr DESC LIMIT 1";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($batchrows=$ergebnis->RecordCount())
					        {
						       $bnr=$ergebnis->FetchRow();
							   $batch_nr=$bnr['batch_nr'];
							   if(!$batch_nr) $batch_nr=_BATCH_NR_INIT_; else $batch_nr++;
					         }
					         else
					         {
					            $batch_nr=_BATCH_NR_INIT_;
					          }
			             }
			               else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						 $mode="save";   
		   }	    
}
else 
 { echo "$LDDbNoLink<br>$sql<br>"; }
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>

<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}
</style>

<script language="javascript">
<!-- 

function chkForm(d){

    if((d.quick_cut.checked)&&(d.qc_phone.value==''))
	{
		alert("<?php echo $LDAlertQuickCut."\\n".$LDPlsEnterPhone ?>");
		d.qc_phone.focus();
		return false;
	}
	else if((!d.quick_cut.checked)&&(d.qc_phone.value!=''))
	        {
	            d.qc_phone.value='';
	        }
	 
    if((d.quick_diagnosis.checked)&&(d.qd_phone.value==''))
	{
		alert("<?php echo $LDAlertQuickDiagnosis."\\n".$LDPlsEnterPhone ?>");
		d.qd_phone.focus();
		return false;
	}
	else if((!d.quick_diagnosis.checked)&&(d.qd_phone.value!=''))
	        {
	            d.qd_phone.value='';
	        }
	
   if((d.op_date.value=='')||(d.op_date.value==' '))
	{
		alert("<?php echo $LDPlsEnterOpDate ?>");
		d.op_date.focus();
		return false;
	}
	
    if((d.doctor_sign.value=='')||(d.doctor_sign.value==' '))
	{
		alert("<?php echo $LDPlsEnterDoctorName ?>");
		d.doctor_sign.focus();
		return false;
	}
}

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

function printOut()
{
	urlholder="<?php echo $root_path; ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $target ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); 
<?php if($pn=="") echo "document.searchform.searchkey.focus();" ?>" 
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<?php if(!$noresize)
{
?>

<script>	
      window.moveTo(0,0);
	 window.resizeTo(1000,740);
</script>

<?php 
}
?>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDDiagnosticTest; // if($user_origin!="lab") echo "(".$station.")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<?php 
if($user_origin=='lab')
{
?>
<a href="<?php echo $thisfile."?sid=$sid&lang=$lang&station=$station&user_origin=$user_origin&status=$status&target=patho&noresize=$noresize"; ?>"><img <?php echo createLDImgSrc($root_path,'newpat2.gif','0') ?>></a>
&nbsp;
<?php
}
?><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>
 <ul>

<?php
if($edit)
{
?>
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<?php

/* If in edit mode display the control buttons */

$controls_table_width=700;

require($root_path.'include/inc_test_request_controls.php');

}
elseif(!$read_form && !$no_proc_assist)
{
?>

<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
  </tr>
</table>
<?php
}
?>

		<table   cellpadding="0" cellspacing=1 border="0" width=700>

		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>">
		<td>
		<?php
		
        if($edit)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php'.URL_REDIRECT_APPEND.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}
        elseif($pn=="")
		{
		    $searchmask_bgcolor="#f3f3f3";
            include("inc_test_request_searchmask.php");
        }
        ?>
     </td> 
		<td class=fva2_ml10><div class="fva2_ml10">
		
		<table border=0  cellpadding=0 cellspacing=0 width=100%>
    <tr>
      <td rowspan=8 align="left" valign="top"><font size=5 color="#0000ff"><b><?php echo $formtitle ?></b></font><br>
	  <font size=1 color="#000099"><?php echo $LDTel ?>
	  </td>
      <td class="fvag_ml10" align="right"><?php echo $LDEntryDate ?> &nbsp;</td>
      <td><img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=20></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDJournalNumber ?> &nbsp;</td>
      <td><img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=20></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDBlockNumber ?> &nbsp;</td>
      <td><img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=20></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDDeepCuts ?> &nbsp;</td>
      <td><img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=20></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDSpecialDye ?> &nbsp;</td>
      <td><img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=20></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDImmuneHistoChem ?> &nbsp;</td>
      <td><img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=20></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDHormoneReceptors ?> &nbsp;</td>
      <td><img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=20></td>
    </tr>
    <tr>
      <td class="fvag_ml10" align="right"><?php echo $LDSpecials ?> &nbsp;</td>
      <td><img src="../../gui/img/common/default/pixel.gif" border=0 width=50 height=20></td>
    </tr>
  </table>
  		</div>
		</td></tr>


<!-- Second row  -->
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2><font color="#000099">	   
		
		<table border=0 cellspacing=0 cellpadding=0 width=100%>
    <tr>
      <td><div class=fva0_ml10><input type="checkbox" name="quick_cut" value="1" <?php if($mode=="edit" && $stored_request['quick_cut']) echo "checked" ?>> <?php echo "<b>$LDSpeedCut</b>" ?></td>
      <td><div class=fva0_ml10><?php echo $LDRelayResult ?>&nbsp;<input type="text" name="qc_phone" size=20 maxlength=25  value="<?php if($mode=="edit") echo $stored_request['qc_phone'] ?>"></td>
      <td rowspan=2 align="right" >
	  <?php 
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;&nbsp;<br>';
          echo "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
     ?>&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td><div class=fva0_ml10><input type="checkbox" name="quick_diagnosis" value="1" <?php if($mode=="edit" && $stored_request['quick_diagnosis']) echo "checked" ?>> <?php echo "<b>$LDSpeedTest</b>" ?> </td>
      <td><div class=fva0_ml10><?php echo $LDRelayResult ?>&nbsp;<input type="text" name="qd_phone" size=20 maxlength=25  value="<?php if($mode=="edit") echo $stored_request['qd_phone'] ?>"></td>
    </tr>
  </table>
  </div></td>
<!-- 			<td  valign=top><div class=fva0_ml10><font color="#000099">
		 <?php echo $LDSpecialNotice ?>:<br>
		<input type="text" name="specials" size=55 maxlength=60>
		
  </div></td> -->
</tr>
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td valign=top>
		<div class=fva2_ml10><p><br>
		<b><?php echo $LDMatType ?>:</b><br>
			<input type="radio" name="material_type" value="pe" <?php if($mode=="edit" && $stored_request['material_type']=="pe") echo "checked" ?>> <?php echo $LDPE ?><br>
  	<input type="radio" name="material_type" value="op_specimen" <?php if($mode=="edit" && $stored_request['material_type']=="op_specimen") echo "checked" ?>> <?php echo $LDSpecimen ?><br>
  	<input type="radio" name="material_type" value="shave" <?php if($mode=="edit" && $stored_request['material_type']=="shave") echo "checked" ?>> <?php echo $LDShave ?><br>
  	<input type="radio" name="material_type" value="cytology" <?php if($mode=="edit" && $stored_request['material_type']=="cytology") echo "checked" ?>> <?php echo $LDCytology ?><br>
		</td>
		<td><textarea name="material_desc" cols=46 rows=8 wrap="physical"><?php if($mode=="edit") echo stripslashes($stored_request['material_desc']) ?></textarea>
				</td>
		</tr>	
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2><div class="fva0_ml10"><font color="#000099">	 
		<b><?php echo $LDLocalization ?><b><br> 
		<textarea name="localization" cols=82 rows=2 wrap="physical"><?php if($mode=="edit") echo stripslashes($stored_request['localization']) ?></textarea>
  </div></td>
</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">	 
		<b><?php echo $LDClinicalQuestions ?></b><br>
		<textarea name="clinical_note" cols=82 rows=2 wrap="physical"><?php if($mode=="edit") echo stripslashes($stored_request['clinical_note']) ?></textarea>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">	 
		<b><?php echo $LDExtraInfo ?></b><font size=1 face="arial"> <?php echo $LDExtraInfoSample ?><br>
		<textarea name="extra_note" cols=82 rows=2 wrap="physical"><?php if($mode=="edit") echo stripslashes($stored_request['extra_note']) ?></textarea>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">	 
		<b><?php echo $LDRepeatedTest ?></b><font size=1 face="arial"> <?php echo $LDRepeatedTestPls ?><br>
		<input type="text" name="repeat_note" size=110 maxlength=100 value="<?php if($mode=="edit") echo stripslashes($stored_request['repeat_note']) ?>">
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 ><div class=fva0_ml10><font color="#000099">	 
		<b><?php echo $LDForGynTests ?></b>
		
		<table border=0 cellpadding=1 cellspacing=1 width=100%>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDLastPeriod ?></td>
      <td><input type="text" name="gyn_last_period" size=15 maxlength=25 value="<?php if($mode=="edit") echo stripslashes($stored_request['gyn_last_period']) ?>"></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDMenopauseSince ?></td>
      <td><input type="text" name="gyn_menopause_since" size=15 maxlength=25 value="<?php if($mode=="edit") echo stripslashes($stored_request['gyn_menopause_since']) ?>"></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDHormoneTherapy ?></td>
      <td><input type="text" name="gyn_hormone_therapy" size=15 maxlength=25 value="<?php if($mode=="edit") echo stripslashes($stored_request['gyn_hormone_therapy']) ?>">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDPeriodType ?></td>
      <td><input type="text" name="gyn_period_type" size=15 maxlength=25 value="<?php if($mode=="edit") echo stripslashes($stored_request['gyn_period_type']) ?>"></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDHysterectomy ?></td>
      <td><input type="text" name="gyn_hysterectomy" size=15 maxlength=25 value="<?php if($mode=="edit") echo stripslashes($stored_request['gyn_hysterectomy']) ?>"></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDIUD ?></td>
      <td><input type="text" name="gyn_iud" size=15 maxlength=25 value="<?php if($mode=="edit") echo stripslashes($stored_request['gyn_iud']) ?>">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><div class=fva0_ml10><?php echo $LDGravidity ?></td>
      <td><input type="text" name="gyn_gravida" size=15 maxlength=25 value="<?php if($mode=="edit") echo stripslashes($stored_request['gyn_gravida']) ?>"></td>
      <td align="right"><div class=fva0_ml10><?php echo $LDContraceptive ?></td>
      <td><input type="text" name="gyn_contraceptive" size=15 maxlength=25 value="<?php if($mode=="edit") echo stripslashes($stored_request['gyn_contraceptive']) ?>"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDOpDate ?>:
		<input type="text" name="op_date"  value="<?php  if($mode=="edit") echo formatDate2Local($stored_request['op_date'],$date_format); else echo formatDate2Local(date('Y-m-d'),$date_format) ?>" size=10 maxlength=10 onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
  </div></td>
			<td align="right"><div class=fva2_ml10><font color="#000099">
		<?php echo "$LDDoctor/$LDDept" ?>:
		<input type="text" name="doctor_sign" size=40 maxlength=60 value="<?php if($mode=="edit") echo stripslashes($stored_request['doctor_sign']) ?>">
		
  </div></td>
</tr>

		</table>
<p>

<?php
if($edit)
{

/* If in edit mode display the control buttons */
require($root_path.'include/inc_test_request_controls.php');

require($root_path.'include/inc_test_request_hiddenvars.php');

?>

</form>

<?php
}
?>

</FONT>

</ul>
<p>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');?>
</BODY>
</HTML>
