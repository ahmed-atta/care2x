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
/* Start initializations */
define('LANG_FILE','konsil.php');

/* Globalize the variables */


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
require_once($root_path.'include/inc_config_color.php'); ///* load color preferences*/
require_once($root_path.'include/inc_diagnostics_report_fx.php');

$thisfile='labor_test_request_admin_generic.php';

$bgc1='#bbdbc4'; /* The main background color of the form */
$abtname=get_meta_tags($root_path.'global_conf/'.$lang.'/konsil_tag_dept.pid');
$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/

$formtitle=$abtname[$subtarget];

$db_request_table=$target;

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
<HTML>
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
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
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
include_once("inc_test_request_lister_fx.php");
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
?>		
	<!-- Start of the form  -->	
		<table   cellpadding=0 cellspacing=0 border="0" width=700>
		<tr  valign="top">
		<td bgcolor="<?php echo $bgc1 ?>"  class=fva2_ml10><div   class=fva2_ml10>
       <?php echo $LDRequestTo ?><br>
       <font size=3>
<?php echo $formtitle.'&nbsp;'.$LDDepartment ?>
       </font>
   <p>
	<?php printCheckBox('visit'); echo '&nbsp;'.$LDVisitRequested; ?><p>
<?php printCheckBox('order_patient'); echo '&nbsp;'.$LDPatCanBeOrdered; ?><p>
<?php
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;<br>';
          echo "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
?>		

</td>
         <td  bgcolor="<?php echo $bgc1 ?>"  align="right"><div class=fva2b_ml10>
<?php

  echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';

?>
		</div></td>
	</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10><?php echo $LDDiagnosesInquiries ?><br>
		  <font face="courier" size=2 color="#000000">
		  <blockquote><?php if($stored_request['diagnosis_quiry']) echo nl2br(stripslashes($stored_request['diagnosis_quiry'])) ?></blockquote><p>
		  </font>
		</td>
	</tr>	

	<tr bgcolor="<?php echo $bgc1 ?>" valign="top">
		<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate ?>:
		 <font face="courier" size=2 color="#000000">
		<?php if($edit_form || $read_form) echo formatDate2Local($stored_request['send_date'],$date_format); ?>
		</font>
  </div></td>
		<td align="right"><div class=fva2_ml10><font color="#000099">
		<?php echo $LDDoctor ?>
		<font face="courier" size=2 color="#000000">
		<?php if($edit_form || $read_form) echo stripslashes($stored_request['send_doctor']) ?>&nbsp;&nbsp;&nbsp;&nbsp;
		</font>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10>&nbsp;<br><font color="#000099"><?php echo $LDDeptReport ?><br>
		<textarea name="result" cols=80 rows=10 wrap="physical"><?php if($stored_request['result']) echo stripslashes($stored_request['result']) ?></textarea>
		</div><br>
				</td>
		</tr>	

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate ?>:
		<input type="text" name="result_date" 
		  value="<?php if($stored_request['result_date'] != '0000-00-00') echo formatDate2Local($stored_request['result_date'],$date_format); 
		                         else echo formatDate2Local(date('Y-m-d'),$date_format); 
					?>"   size=10 maxlength=10 onFocus="this.select()" onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
  </div></td>
			<td align="right"><div class=fva2_ml10><font color="#000099">
		<?php echo $LDDoctor ?>
		<input type="text" name="result_doctor" size=40 maxlength=40 value="<?php if($stored_request['result_doctor']) echo stripslashes($stored_request['result_doctor']) ?>">&nbsp;&nbsp;&nbsp;&nbsp;
  </div></td>
</tr>
		

		</table>
	<!-- End of form  -->
<?php

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
