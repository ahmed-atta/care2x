<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','konsil.php');

$local_user='ck_lab_user';

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_global_address.php'); 
require_once($root_path.'include/inc_diagnostics_report_fx.php');

$breakfile='labor.php'.URL_APPEND;
$returnfile='labor_test_request_admin_'.$subtarget.'.php'.URL_APPEND.'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin;

$thisfile='labor_test_findings_'.$subtarget.'.php';

$bgc1='#cde1ec'; 
$edit=1; /* Assume to edit first */

$formtitle=$LDPathology;
$dept_nr=8; // 8 = department nr. of pathology

$db_request_table=$subtarget;

						
/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	
   
   include_once($root_path.'include/inc_date_format_functions.php');
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
     }
	   
	 if(!isset($mode) && $batch_nr && $pn)   $mode="edit";
		
		  switch($mode)
		  {
				     case 'save':
							
                                 $sql="INSERT INTO care_test_findings_".$db_request_table." 
								          (
										   batch_nr, encounter_nr, dept_nr, 
										   material, macro, 
										   micro, findings, diagnosis,
										   doctor_id, findings_date, findings_time, 
										   status, history, modify_id,create_id, create_time) 
										   VALUES 
										   (
										   '".$batch_nr."','".$pn."','".$dept_nr."', 
										   '".addslashes(htmlspecialchars($material))."','".addslashes(htmlspecialchars($macro))."',
										   '".addslashes(htmlspecialchars($micro))."','".addslashes(htmlspecialchars($findings))."','".addslashes(htmlspecialchars($diagnosis))."',
										   '".addslashes($doctor_id)."', '".formatDate2Std($findings_date,$date_format)."', '".date('H:i:s')."',
										   'initial', 'Create: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n',
										   '".$HTTP_SESSION_VARS['sess_user_name']."', '".$HTTP_SESSION_VARS['sess_user_name']."', NULL
										   )";


							      if($ergebnis=$db->Execute($sql))
       							  {
								     signalNewDiagnosticsReportEvent($findings_date);
									//echo $sql;
									 header("location:$thisfile".URL_REDIRECT_APPEND."&edit=$edit&saved=insert&mode=edit&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									 exit;
								  }
								  else 
								  {
								     echo "<p>$sql<p>$LDDbNoSave"; 
									 $mode="";
								  }
								
								break; // end of case 'save'
								
		     case 'update':
			 
							      $sql="UPDATE care_test_findings_".$db_request_table." SET 
										   material='".addslashes(htmlspecialchars($material))."', macro='".addslashes(htmlspecialchars($macro))."', 
										   micro='".addslashes(htmlspecialchars($micro))."', findings='".addslashes(htmlspecialchars($findings))."', 
										   diagnosis='".addslashes(htmlspecialchars($diagnosis))."',
										   doctor_id='".addslashes($doctor_id)."', findings_date='".formatDate2Std($findings_date,$date_format)."', 
										   findings_time='".date('H:i:s')."', 
										   history=CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
										   modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=$db->Execute($sql))
       							  {
								     signalNewDiagnosticsReportEvent($findings_date);
									//echo $sql;
									
									 header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								
								break; // end of case 'save'
								
		     case 'done':
			 
							      $sql="UPDATE care_test_findings_".$db_request_table." SET 
										   status='done', 
										   history=CONCAT(history,'Done: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
										   modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
							          $sql="UPDATE care_test_request_".$db_request_table." SET 
										   status='done', 
										   history=CONCAT(history,'Done: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
										   modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
							          if($ergebnis=$db->Execute($sql))
       							      {
								  		// Load the visual signalling functions
										include_once($root_path.'include/inc_visual_signalling_fx.php');
										// Set the visual signal 
										setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REPORT);									
									     
									     header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									     exit;
								       }
								       else
								       {
								          echo "<p>$sql<p>$LDDbNoSave"; 
								          $mode="save";
								        }								 
									}
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="save";
								   }
								
								break; // end of case 'save'
								
								
	        /* If mode is edit, get the stored test findings 
			*/
			case 'edit':

			           $sql="SELECT * FROM care_test_findings_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_findings=$ergebnis->FetchRow();
							   
							   if($stored_findings['status']=="done") $edit=0; /* Inhibit editing of the findings */
							   
							   $edit_form=1;

					         }
							 else
							 {
							    $mode="save";
						     }
			             }
						 else
						 {
						    $mode="save";
						  }
						 
						 break; ///* End of case 'edit': */
						 
			 default:	$mode="";
			 
		  }// end of switch($mode)

		  		  
if($edit) $returnfile.='&batch_nr='.$batch_nr.'&pn='.$pn.'&tracker='.$tracker; 
  
}
else 
 { echo "$LDDbNoLink<br>$sql<br>"; }
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
.fva2_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000099;}
.fva2b_ml10 {font-family: verdana,arial; font-size: 12; margin-left: 10; color:#000000;}
.fva0_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#000099;}
.fvag_ml10 {font-family: verdana,arial; font-size: 10; margin-left: 10; color:#969696;}
</style>

<script language="javascript">
<!-- 

<?php
/**
*  Output the following function only when in edit mode 
*/
if ($edit)
{
?>

function chkForm(d){

  if(d.material.value=="" && d.macro.value=="" && d.micro.value=="" && d.findings.value=="" && d.diagnosis.value=="") return false;
   else if(d.findings_date.value=="" || d.findings_date.value==" ")
	{
		alert("<?php echo $LDPlsEnterDate ?>");
		d.findings_date.focus();
		return false;
	}
	else if(d.doctor_id.value=="" || d.doctor_id.value==" ")
	{
		alert("<?php echo $LDPlsEnterDoctorName ?>");
		d.doctor_id.focus();
		return false;
	}
	else 
	{
	   return true;
	}
}

<?php
}
?>

function printOut()
{
	urlholder="labor_test_findings_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>&entry_date=<?php echo $entry_date ?>";
	findings_printout<?php echo $sid ?>=window.open(urlholder,"findings_printout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    findings_printout<?php echo $sid ?>.print();
}
  
<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>
<script language="javascript" src="../js/setdatetime.js"></script>
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDDiagnosticTest; echo " (#".$batch_nr.")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="<?php echo $returnfile; ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('pending_patho_findings.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>
 <ul>

<?php if ($edit)
{
?>
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<?php
}

require_once($root_path.'include/inc_test_findings_form_patho.php');

echo '&nbsp;<br>';
if ($edit){
   echo'
         <input type="image" '.createLDImgSrc($root_path,'savedisc.gif').'>';
}
?>
  
         <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?>></a>
<?php
if (isset($stored_findings['status']) && $stored_findings['status']!='done')
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc($root_path,'done.gif','0').' alt="'.$LDDone.'"></a>';
}
?>

<?php
if ($edit)
{
require($root_path.'include/inc_test_request_hiddenvars.php');

?>
<input type="hidden" name="entry_date" value="<?php echo $entry_date ?>">

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
