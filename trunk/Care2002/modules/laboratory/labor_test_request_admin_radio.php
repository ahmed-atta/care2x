<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

/* Start initializations */ 
define('LANG_FILE','konsil.php');

/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab'){
	$local_user='ck_lab_user';
	$breakfile=$root_path.'modules/radiology/radiolog.php'.URL_APPEND;
}elseif($user_origin=='amb'){
	$local_user='ck_lab_user';
	$breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND;
}else{
	$local_user='ck_pflege_user';
	$breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/inc_front_chain_lang.php'); ///* invoke the script lock*/
require_once($root_path.'include/inc_config_color.php'); ///* load color preferences*/
require_once($root_path.'global_conf/inc_global_address.php');

$thisfile='labor_test_request_admin_radio.php';

$bgc1='#ffffff'; /* The main background color of the form */
$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");
$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

$formtitle=$abtname[$subtarget];

$db_request_table=$subtarget;

/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	

  require_once($root_path.'include/inc_date_format_functions.php');
  

	 if(!isset($mode))   $mode='';
		
		  switch($mode)
		  {
		     case 'update':
							      $sql="UPDATE care_test_request_".$db_request_table." SET 
										  xray_nr='".$xray_nr."',
										  r_cm_2='".$r_cm_2."',
										  mtr='".$mtr."',
                                          xray_date='".formatDate2Std($xray_date,$date_format)."',
										  results='".addslashes(htmlspecialchars($results))."',
                                          results_date='".formatDate2Std($results_date,$date_format)."',
										  results_doctor='".htmlspecialchars($results_doctor)."',
										  status='received',
										  modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
									
									 header("location:".$thisfile."?sid=$sid&lang=$lang&edit=$edit&saved=update&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&batch_nr=$batch_nr&noresize=$noresize");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode='';
								   }
								break; // end of case 'save'
			 default: $mode='';
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get the pending test requests */
		  {
		                $sql="SELECT batch_nr,encounter_nr,send_date,dept_nr FROM care_test_request_".$subtarget." 
						         WHERE status='pending' OR status='received' ORDER BY  send_date DESC";
		                if($requests=$db->Execute($sql))
       		            {
				            $batchrows=$requests->RecordCount();
	                        if($batchrows && (!isset($batch_nr) || !$batch_nr)) 
					        {
						       $test_request=$requests->FetchRow();
                               /* Check for the patietn number = $pn. If available get the patients data */
		                       $pn=$test_request['encounter_nr'];
						       $batch_nr=$test_request['batch_nr'];
							}
			             }
			               else {echo "<p>$sql<p>$LDDbNoRead"; exit;}
						 $mode='update';   
		   }	
		       
	   
     /* Check for the patietn number = $pn. If available get the patients data */
     if($batchrows && $pn)
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

			if( $enc_obj->is_loaded){
				$result=&$enc_obj->encounter;

				$sql="SELECT * FROM care_test_request_".$subtarget." WHERE batch_nr='".$batch_nr."'";
		        if($ergebnis=$db->Execute($sql)){
					if($editable_rows=$ergebnis->RecordCount()){
						$stored_request=$ergebnis->FetchRow();
						 $edit_form=1;
					}
				}else{
					echo "<p>$sql<p>$LDDbNoRead"; 
				}					
			}
		}else{
		  $mode='';
		  $pn='';
	   }		
     }		   
		   
		   
}else{
	echo "$LDDbNoLink<br>$sql<br>";
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>

<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000000;}
</style>

<script language="javascript">
<!-- 

function chkForm(d)
{ 
	if(d.results.value=="" || d.results.value==" ") 
	{
	  return false;
	}
	else if(d.results_date.value=="" || d.results_date.value==" ")
	  {
	     alert('<?php echo $LDPlsEnterDate ?>');
		 d.results_date.focus();
		 return false;
	  }
	  else if(d.results_doctor.value=="" || d.results_doctor.value=="")
		{
	     alert('<?php echo $LDPlsEnterDoctorName ?>');
		 d.results_doctor.focus();
		   return false;
		}
		else return true; 
}

function printOut()
{
	urlholder="<?php echo $root_path; ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn; ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}


<?php 
require($root_path.'include/inc_checkdate_lang.php'); 
?>
//-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); " 
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDPendingTestRequest." (".$batch_nr.")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('pending_radio.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>

<?php
if($batchrows)
{
?>

<!-- Table for the list index and the form -->
<table border=0>
  <tr valign="top">
    <td><FONT  SIZE=1  FACE="verdana">  
<?php 

/* The following routine creates the list of pending requests */
require($root_path.'include/inc_test_request_lister_fx.php');

?></td>

    <td>

<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
		<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>  title="<?php echo $LDSaveEntry ?>"> 
		<a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?> alt="<?php echo $LDPrintOut ?>"></a>
        <a href="<?php echo 'labor_test_findings_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&batch_nr='.$batch_nr.'&pn='.$pn.'&entry_date='.$stored_request['xray_date'].'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&tracker='.$tracker; ?>"><img <?php echo createLDImgSrc($root_path,'enter_result.gif','0') ?> alt="<?php echo $LDEnterResult ?>"></a>

	   <!--  outermost table creating form border -->
<table border=0 bgcolor="#000000" cellpadding=1 cellspacing=0>
  <tr>
    <td>
	
	<table border=0 bgcolor="#ffffff" cellpadding=0 cellspacing=0>
   <tr>
     <td>
	
	   <table   cellpadding=0 cellspacing=1 border=0 width=700>
   <tr  valign="top">
   <td  bgcolor="<?php echo $bgc1 ?>" rowspan=2>
 <?php
        if($edit || $read_form)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}
		?></td>
      <td bgcolor="<?php echo $bgc1 ?>"  class=fva2_ml10><div   class=fva2_ml10><font size=5 color="#0000ff"><b><?php echo $formtitle ?></b></font>
		 <br><?php echo $global_address[$subtarget].'<br>'.$LDTel.'&nbsp;'.$global_phone[$subtarget]; ?>
		 </td>
		 </tr>
	 <tr>
      <td bgcolor="<?php echo $bgc1 ?>" align="right" valign="bottom">	 
	  <?php
		    echo '<font size=1 color="#990000" face="verdana,arial">'.$batch_nr.'</font>&nbsp;&nbsp;<br>';
			  echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
     ?>
	     </td>
		 </tr>
		 	
		<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 >
		
		<table border=0 cellpadding=1 cellspacing=1 width=100%>
    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDXrayTest ?></td><br>
      <td>&nbsp;<?php printCheckBox('xray'); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDSonograph ?></td>
      <td>&nbsp;<?php printCheckBox('sono'); ?></td>
    </tr>
    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDCT ?></td>
      <td>&nbsp;<?php printCheckBox('ct'); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDMammograph ?></td>
      <td>&nbsp;<?php printCheckBox('mammograph'); ?></td>
    </tr>
    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDMRT ?></td>
      <td>&nbsp;<?php printCheckBox('mrt'); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDNuclear ?></td>
      <td>&nbsp;<?php printCheckBox('nuclear'); ?></td>
    </tr>
	
    <tr>
      <td colspan=4><hr></td>
    </tr>

    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDPatMobile ?> &nbsp;<?php echo $LDYes ?></td>
      <td><font size=2 face="verdana,arial">&nbsp;<?php printRadioButton('if_patmobile',1); ?>&nbsp;<?php echo $LDNo ?>
	  &nbsp;<?php printRadioButton('if_patmobile',0); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDAllergyKnown ?> &nbsp;<?php echo $LDYes ?></td>
      <td><font size=2 face="verdana,arial">&nbsp;<?php printRadioButton('if_allergy',1); ?>&nbsp;<?php echo $LDNo ?>
	  &nbsp;<?php printRadioButton('if_allergy',0); ?></td>
    </tr>
    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDHyperthyreosisKnown ?> &nbsp;<?php echo $LDYes ?></td>
      <td><font size=2 face="verdana,arial">&nbsp;<?php printRadioButton('if_hyperten',1); ?>&nbsp;<?php echo $LDNo ?>
	  &nbsp;<?php printRadioButton('if_hyperten',0); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDPregnantPossible ?> &nbsp;<?php echo $LDYes ?></td>
      <td><font size=2 face="verdana,arial">&nbsp;<?php printRadioButton('if_pregnant',1); ?>&nbsp;<?php echo $LDNo ?>
	  &nbsp;<?php printRadioButton('if_pregnant',0); ?>
	  </td>
    </tr>
  </table>
  &nbsp;<br>
		
  </td>
</tr>
		 
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10><?php echo $LDClinicalInfo ?>:<p><img src="../../gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">
		<font face="courier" size=2 color="#000000">&nbsp;&nbsp;<?php echo stripslashes($stored_request['clinical_info']) ?></font>
				</td>
		</tr>	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10><?php echo $LDReqTest ?>:<p><img src="../../gui/img/common/default/pixel.gif" border=0 width=20 height=45 align="left">
		<font face="courier" size=2 color="#000000">&nbsp;&nbsp;<?php echo stripslashes($stored_request['test_request']) ?></font>
				</td>
		</tr>	


	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2 align="right"><div class=fva2_ml10>
		 <?php echo $LDDate ?>:
		<font face="courier" size=2 color="#000000">&nbsp;<?php 
		
		            
					  echo formatDate2Local($stored_request['send_date'],$date_format); 
					
				  ?></font>&nbsp;
  <?php echo $LDRequestingDoc ?>:
		<font face="courier" size=2 color="#000000">&nbsp;<?php echo $stored_request['send_doctor'] ?></font></div><br>
		</td>
    </tr>
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  colspan=2 bgcolor="#cccccc"><div class=fva2_ml10>
        <nobr>
		<font color="#000099">
		<?php echo $LDXrayNumber ?>
        <input type="text" name="xray_nr" value="<?php if($read_form && $stored_request['xray_nr']) echo $stored_request['xray_nr']; ?>" size=9 maxlength=9> 
		<?php echo $LD_r_cm2 ?>
        <input type="text" name="r_cm_2" value="<?php if($read_form && $stored_request['r_cm_2']) echo $stored_request['r_cm_2']; ?>" size=7 maxlength=15> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <?php echo $LDXrayTechnician ?>&nbsp;
        <input type="text" name="mtr" value="<?php if($read_form && $stored_request['mtr']) echo $stored_request['mtr']; ?>" size=25 maxlength=35> 
		<?php echo $LDDate ?>&nbsp;

		<input type="text" name="xray_date" 
		value="<?php 
		
		            if($read_form && $stored_request['xray_date']!='0000-00-00')
					{
					  echo formatDate2Local($stored_request['xray_date'],$date_format); 
					}
					else
					{
					  echo formatDate2Local(date('Y-m-d'),$date_format);
					}
				  ?>" size=10 maxlength=10 onBlur="IsValidDate(this,'<?php echo $date_format ?>')"  onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"> 
		  	<a href="javascript:show_calendar('form_test_request.xray_date','<?php echo $date_format ?>')">
			<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a>
		</nobr>
	  </div>
    </tr>	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2> 
		 <div class=fva2_ml10>&nbsp;<br><font color="#000099"><?php echo $LDNotesTempReport ?></font><br>
         <textarea name="results" cols=80 rows=5 wrap="physical"><?php if($read_form && $stored_request['results']) echo stripslashes($stored_request['results']) ?></textarea>				
		 </td>
		</tr>	
		
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2 align="right"><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate ?>
        <input type="text" name="results_date" 
		value="<?php 
		
		            if($read_form && $stored_request['results_date']!='0000-00-00')
					{
					  echo formatDate2Local($stored_request['results_date'],$date_format); 
					}
					else
					{
					  echo formatDate2Local(date('Y-m-d'),$date_format);
					}
				  ?>" size=10 maxlength=10 onBlur="IsValidDate(this,'<?php echo $date_format ?>')"  onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">

		  	<a href="javascript:show_calendar('form_test_request.results_date','<?php echo $date_format ?>')">
			<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a><font size=1 face="arial">

				  
  <?php echo $LDReportingDoc ?>
        <input type="text" name="results_doctor" value="<?php if($read_form && $stored_request['results_doctor']) echo $stored_request['results_doctor']; ?>" size=35 maxlength=35> 
		</td>
    </tr>
		</table> 
		

	 </td>
   </tr>
 </table>
	
	</td>
  </tr>
</table> 
<p>
		<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>  title="<?php echo $LDSaveEntry ?>"> 
		<a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?> alt="<?php echo $LDPrintOut ?>"></a>
        <a href="<?php echo 'labor_test_findings_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&batch_nr='.$batch_nr.'&pn='.$pn.'&entry_date='.$stored_request['xray_date'].'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&tracker='.$tracker; ?>"><img <?php echo createLDImgSrc($root_path,'enter_result.gif','0') ?> alt="<?php echo $LDEnterResult ?>"></a>

<?php

require($root_path.'include/inc_test_request_hiddenvars.php');

?>	
</form>		
</td>

</tr>
</table>        	

<?php
}
else
{
?>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><font size=3 face="verdana,arial" color="#990000"><b><?php echo $LDNoPendingRequest ?></b></font>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<?php
}
?>
	
	</td>
  </tr>
</table>

<p>

<?php
require($root_path.'include/inc_load_copyrite.php');?>
</BODY>
</HTML>
