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
$lang_tables[]='departments.php';
define('LANG_FILE','konsil.php');

/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  $user_origin == amb ;  from the ambulatory clinics
*  and set the user cookie name and break or return filename
*/

switch($user_origin)
{
  case 'lab':

                  $local_user='ck_lab_user';
                  $breakfile="labor.php".URL_APPEND; 
                  break;
  
  case 'amb':
  
                  $local_user='ck_amb_user';
                  $breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND; 
                  break;

  default:
  
                  $local_user='ck_pflege_user';
                  $breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND."&edit=$edit&station=$station&pn=$pn";
}

require_once($root_path.'include/inc_front_chain_lang.php'); ///* invoke the script lock*/
require_once($root_path.'include/inc_diagnostics_report_fx.php');

$thisfile='labor_test_request_admin_generic.php';

$bgc1='#bbdbc4'; /* The main background color of the form */
$abtname=get_meta_tags($root_path.'global_conf/'.$lang.'/konsil_tag_dept.pid');
$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

$db_request_table=$target;
$dept_nr=$subtarget;

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
                                          result='".htmlentities(addslashes($result))."',
										  result_date='".formatDate2Std($result_date,$date_format)."',
										  result_doctor='".$result_doctor."',
										   history=CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),									   								   
										   modify_id = '".$HTTP_SESSION_VARS['sess_user_name']."'
										   WHERE batch_nr = '".$batch_nr."'";
										   
							      if($ergebnis=$db->Execute($sql))
       							  {
									/* If the findings are succesfully saved, make an entry into the care_nursing_station_patients_diagnostics_report table
									*  for signalling purposes
									*/
								     signalNewDiagnosticsReportEvent($result_date, 'labor_test_request_printpop.php');
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
								
								
		     case 'done':
							      $sql="UPDATE care_test_request_".$db_request_table." SET 
                                          status='done',
										   history=CONCAT(history,'Done: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),									   								   
										   modify_id = '".$HTTP_SESSION_VARS['sess_user_name']."'
										   WHERE batch_nr = '".$batch_nr."'";
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									// Set the visual signal 
									setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REPORT);									
									 header("location:".$thisfile."?sid=$sid&lang=$lang&edit=$edit&saved=update&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode='';
								   }
								break; // end of case 'save'
			
			 default: $mode="";
						   
		  }// end of switch($mode)
  
          if(!$mode) /* Get the pending test requests */
		  {
		                $sql="SELECT batch_nr,encounter_nr,send_date FROM care_test_request_".$db_request_table." 
						         WHERE status='pending' AND testing_dept='".$subtarget."' ORDER BY  send_date DESC";
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

			if( $enc_obj->is_loaded) {
				$result=&$enc_obj->encounter;

		        $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		        if($ergebnis=$db->Execute($sql)){
					if($editable_rows=$ergebnis->RecordCount()){
						$stored_request=$ergebnis->FetchRow();
					}
				}else{
					echo "<p>$sql<p>$LDDbNoRead"; 
				}					
			}
		}
	   else 
	   {
		  $mode='';
		  $pn='';
	   }		
     }		   
		   
		   
}else{
	echo "$LDDbNoLink<br>$sql<br>";
}
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
if($dept_obj->preloadDept($stored_request['testing_dept'])){
	$buffer=$dept_obj->LDvar();
	if(isset($$buffer)&&!empty($$buffer)) $formtitle=$$buffer;
		else $formtitle=$dept_obj->FormalName();
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>
<style type="text/css">
div.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-family: arial; font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-family: verdana; font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-family: arial; font-size: 12; margin-left: 3; }
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 

function chkForm(d)
{ 

  if(d.result.value=="" || d.result.value==" " ) return false;
	else if(d.result_date.value=="" || d.result_date.value==" ")
	  {
	     alert('<?php echo $LDPlsEnterDate ?>');
		 d.result_date.focus();
		 return false;
	  }
	  else if(d.result_doctor.value=="" || d.result_doctor.value=="")
		{
	     alert('<?php echo $LDPlsEnterDoctorName ?>');
		 d.result_doctor.focus();
		   return false;
		}
		else return true; 
}


function printOut()
{
	urlholder="labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&target=<?php echo $target ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); " 
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDPendingTestRequest." (#".$stored_request['batch_nr']." ".$stored_request['room_nr']." ".$stored_request['dept'].")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('pending_generic.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>

<?php
if($batchrows)
{
?>

<table border=0>
  <tr valign="top">
<!-- left frame for the requests list -->
    <td>
	<FONT  SIZE=1  FACE="verdana">  
<?php
/* The following routine creates the list of pending requests */
include_once($root_path.'include/inc_test_request_lister_fx.php');
?>
</td>

<!--  right frame for the request form -->
    <td >
        <form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
		<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?>  title="<?php echo $LDSaveEntry ?>"> 
        <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?> alt="<?php echo $LDPrintOut ?>"></a>
<?php
if (($stored_request['result']!='') && $stored_request['status']!='done')
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc($root_path,'done.gif','0','absmiddle').' alt="'.$LDDone.'"></a>';
}
	
	#  Start of the form  	
	# Prepare the values
	$TP_checkbox_1=printCheckBox('visit',false);
	$TP_checkbox_2=printCheckBox('order_patient',false); 
	$TP_img_barcode= "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
	$TP_img_patient_label='<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';

	if($stored_request['diagnosis_quiry']) $TP_diagnosis_quiry=nl2br(stripslashes($stored_request['diagnosis_quiry']));
		else $TP_diagnosis_quiry='';
	
	if($edit_form || $read_form) $TP_send_date=formatDate2Local($stored_request['send_date'],$date_format);
		else $TP_send_date='';
	$TP_calendar_1='';
	$TP_input_1='/'; # Disables the input
	$TP_block_1='blockquote';
	$TP_send_doctor='';
	if($edit_form || $read_form) $TP_send_doctor_x=stripslashes($stored_request['send_doctor']);
		else $TP_send_doctor_x='';
	
	$TP_vspacer_2='';
	$TP_block_2='textarea';
	
	if($stored_request['result']) $TP_result=stripslashes($stored_request['result']);
		else $TP_result='';
	$TP_report_date='<input type="text" name="result_date" value="';
	if($stored_request['result_date'] != '0000-00-00') $TP_report_date.=formatDate2Local($stored_request['result_date'],$date_format).'"';
		else $TP_report_date.=formatDate2Local(date('Y-m-d'),$date_format).'"'; 
	$TP_report_date.=' size=10 maxlength=10 onFocus="this.select()" onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')">';
	
	$TP_calendar_2='<a href="javascript:show_calendar(\'form_test_request.result_date\',\''.$date_format.'\')"><img '.createComIcon($root_path,'show-calendar.gif','0','absmiddle').'></a>';
  	
	$TP_result_doctor_x='';
	if($stored_request['result_doctor']) $TP_result_doctor=stripslashes($stored_request['result_doctor']);
		else $TP_result_doctor='';
	
	$TP_input_2='input';
	
	# Load template
	$TP_generic=$TP_obj->load('laboratory/tp_form_generic.htm');
	eval("echo $TP_generic;");
	#  End of form 

require($root_path.'include/inc_test_request_hiddenvars.php');

?>	<br>
		<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?>  title="<?php echo $LDSaveEntry ?>"> 
        <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?> alt="<?php echo $LDPrintOut ?>"></a>
<?php
if (($stored_request['result']!='') && $stored_request['status']!="done" )
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc($root_path,'done.gif','0','absmiddle').' alt="'.$LDDone.'"></a>';
}
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
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?>></a>
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
