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

$local_user='ck_lab_user';

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences
require_once($root_path.'global_conf/inc_global_address.php'); 
require_once($root_path.'include/inc_test_findings_fx_baclabor.php');
require_once($root_path.'include/inc_test_request_vars_baclabor.php');
require_once($root_path.'include/inc_diagnostics_report_fx.php');

/* Load additional language table */
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php')) include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php');
  else include_once($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_konsil_baclabor.php');


$breakfile='labor.php?sid='.$sid.'&lang='.$lang; 
$returnfile='labor_test_request_admin_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&batch_nr='.$batch_nr.'&pn='.$pn.'&tracker='.$tracker; ;

$thisfile='labor_test_findings_'.$subtarget.'.php';

$bgc1='#fff3f3'; 
$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");
$edit=0; /* Assume to not edit first */
$read_form=1;
$edit_findings=1;

//$konsil="patho";
$formtitle=$abtname[$subtarget];
$db_request_table=$subtarget;

						
/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){	
	require_once($root_path.'include/inc_date_format_functions.php');
    /* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
    if(isset($pn)&&$pn){		
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
		}else{
			$edit=0;
			$mode='';
			$pn='';
		}		
     }

	 if(!isset($mode) && $batch_nr && $pn)   $mode='edit_findings';
	 
	 if($mode=='save' || $mode=='update')
	 {
	 	 /* Process the variables */
		$type_general = &processFindings($lab_TestType,0);
								 
		$resist_ana_1= &processFindings($lab_ResistANaerob_1,1);
		$resist_ana_2= &processFindings($lab_ResistANaerob_2,1);
		$resist_ana_3= &processFindings($lab_ResistANaerob_3,1);
							
		$resist_anaerob = $resist_ana_1.'&'.$resist_ana_2.'&'.$resist_ana_3;
								 
		$resist_a_1= &processFindings($lab_ResistAerob_1,1);
		$resist_a_2= &processFindings($lab_ResistAerob_2,1);
		$resist_a_3= &processFindings($lab_ResistAerob_3,1);
		$resist_a_x= &processFindings($lab_ResistAerobExtra_1,1);
		$resist_a_x2= &processFindings($lab_ResistAerobExtra_2,1);
		$resist_a_x3= &processFindings($lab_ResistAerobExtra_3,1);

		$resist_aerob = $resist_a_1.'&'.$resist_a_2.'&'.$resist_a_3.'&'.$resist_a_x.'&'.$resist_a_x2.'&'.$resist_a_x3;
								 
		$findings_1= &processFindings($lab_TestResult_1,1);
		$findings_2= &processFindings($lab_TestResult_2,1);
		$findings_3= &processFindings($lab_TestResult_3,1);
								 
		$findings = $findings_1.'&'.$findings_2.'&'.$findings_3;
	  }
		
		  switch($mode)
		  {
				     case 'save':

							
                                 $sql="INSERT INTO care_test_findings_".$db_request_table." 
                                         (
										  batch_nr, encounter_nr, room_nr, dept_nr, 
										  notes, findings_init, findings_current, 
										  findings_final, entry_nr, rec_date, 
										  type_general, resist_anaerob, 
										  resist_aerob, findings, doctor_id, findings_date, 
										  findings_time, status, history,
										  modify_id,create_id, create_time
										  )
										  VALUES 
										  (
										   '".$batch_nr."','".$pn."','".$room_nr."','".$dept_nr."',
										   '".htmlspecialchars($notes)."','".$findings_init."','".$findings_current."',
										   '".$findings_final."','".$entry_nr."','".formatDate2Std($rec_date,$date_format)."',
										   '".$type_general."','".$resist_anaerob."',
										   '".$resist_aerob."','".$findings."','".$doctor_id."','".date('Y-m-d')."',
										   '".date('H:i')."','initial','Create: ".date('Y-m.d H:i:s')." = ".$HTTP_COOKIE_VARS[$local_user.$sid]."\n',
										   '".$HTTP_SESSION_VARS['sess_user_name']."', '".$HTTP_SESSION_VARS['sess_user_name']."', NULL
										   )";						 


							      if($ergebnis=$db->Execute($sql))
       							  {
								     signalNewDiagnosticsReportEvent(formatDate2Local(date('Y-m-d'),$date_format));
									//echo $sql;
									 header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
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
                                           notes = '".htmlspecialchars($notes)."', findings_init = '".$findings_init."', findings_current = '".$findings_current."', 
										   findings_final = '".$findings_final."', entry_nr = '".$entry_nr."', rec_date = '".formatDate2Std($rec_date,$date_format)."', 
										   type_general = '".$type_general."', resist_anaerob ='".$resist_anaerob."', resist_aerob = '".$resist_aerob."', 
										   findings = '".$findings."', doctor_id = '', findings_date = '".date('Y-m-d')."', 
										   findings_time = '".date('H:i')."',  
										   history =CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
										   modify_id = '".$HTTP_SESSION_VARS['sess_user_name']."'
										   WHERE batch_nr = '$batch_nr'";	
										   							  							
							      if($ergebnis=$db->Execute($sql))
       							  {
								     signalNewDiagnosticsReportEvent(formatDate2Local(date('Y-m-d'),$date_format));
									//echo $sql;
									 header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
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
										   history =CONCAT(history,'Done: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
										   modify_id = '".$HTTP_SESSION_VARS['sess_user_name']."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
							          $sql="UPDATE care_test_request_".$db_request_table." SET 
										   status='done', 
										   history =CONCAT(history,'Done: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
										   modify_id = '".$HTTP_SESSION_VARS['sess_user_name']."'
										   WHERE batch_nr = '".$batch_nr."'";
							          if($ergebnis=$db->Execute($sql))
       							      {
									     header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									     exit;
								       }
								       else
								       {
								          echo "<p>$sql<p>$LDDbNoSave"; 
								          $mode='save';
								        }								 
									}
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode='save';
								   }
								
								break; // end of case 'save'
								
								
	        /* If mode is edit, get the stored test findings 
			*/
			case 'edit_findings':

			           $sql="SELECT * FROM care_test_findings_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_findings=$ergebnis->FetchRow();
							   
							   parse_str($stored_findings['type_general'],$parsed_type);
							   parse_str($stored_findings['resist_anaerob'],$parsed_resist_anaerob);
							   parse_str($stored_findings['resist_aerob'],$parsed_resist_aerob);
							   parse_str($stored_findings['findings'],$parsed_findings);
						   
							   if($stored_findings['status']=="done") $edit_findings=0; /* Inhibit editing of the findings */
							   
							   $mode='update';
							   $edit_form=1;
					         }
							 else
							 {
							    $mode='save';
						     }
			             }
						 else
						 {
						    $mode='save'; 
						  }
						 
						 break; ///* End of case 'edit': */
						 
			 default:	$mode='';
			 
		  }// end of switch($mode)


/* Get the stored request for displayint only*/			           
                       $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_request=$ergebnis->FetchRow();
							   
							   parse_str($stored_request['material'],$stored_material);
							   parse_str($stored_request['test_type'],$stored_test_type);
							   
							   if($stored_request['status']=='done') $edit=0; /* Inhibit editing of the findings */
							   
							   $edit_form=1;
					         }
							 else
							 {
							    $mode='save';echo $sql;
						     }
			             }
						 else
						 {
						    $mode='save'; echo $sql;
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
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>
<style type="text/css">
.lab {font-family:ms ui gothic; font-size: 9; color:#ee6666;}
.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 
function chkForm(d){

   if((d.entry_nr.value=='')||(d.entry_nr.value==' '))
	{
		alert("<?php echo $LDPlsEnterLEN ?>");
		d.entry_nr.focus();
		return false;
	}
	else  if((d.rec_date.value=='')||(d.rec_date.value==' '))
	{
		alert("<?php echo $LDPlsEnterDate ?>");
		d.rec_date.focus();
		return false;
	}
}

function loadM(fn)
{
	mBlank=new Image();
	mBlank.src="b.gif";
	mFilled=new Image();
	mFilled.src="f.gif";
	
	form_name=fn;
}

function setM(m)
{
    eval("marker=document.images."+m);
	eval("element=document."+form_name+"."+m);
	
    if(marker.src!=mFilled.src)
	{
	   marker.src=mFilled.src;
	   element.value='1';
	  // alert(element.name+element.value);
	}
	 else 
	 {
	    marker.src=mBlank.src;
		element.value='0';
	  // alert(element.name+element.value);
	 }
}


function setThis(prep,elem,begin,end,step)
{
  for(i=begin;i<end;i=i+step)
  {
     x=prep + i;
     if(elem!=i)
     {
       eval("marker=document.images."+x);
	   if(marker.src==mFilled.src)  setM(x);
     }
  }
  setM(prep+elem);
}


function printOut()
{
	urlholder="labor_test_findings_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>&entry_date=<?php echo $entry_date ?>";
	findings_printout<?php echo $sid ?>=window.open(urlholder,"findings_printout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    findings_printout<?php echo $sid ?>.print();
}
   
   
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); loadM('form_test_request');  " 
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<?php
if ($edit_findings)
{
?>
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<?php
}
?> 

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDDiagnosticTest; echo " (#".$batch_nr.")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<a href="<?php echo $returnfile; ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>
 <ul>


<?php
if ($edit_findings)
{
?>
 <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
<?php
}
?>  
 <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?>></a>
<?php
if (isset($stored_findings['status']) && $stored_findings['status']!='done' && $stored_findings['status']!='final')
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc($root_path,'done.gif','0').'></a>';
}
?>



<?php

/* Load the image functions */
require_once($root_path.'include/inc_test_request_printout_fx.php');
/* Load the findings part of the form */
require($root_path.'include/inc_test_findings_form_baclabor.php');

?>


<?php
if ($edit_findings)
{
/* Load the common hidden post vars */
require($root_path."include/inc_test_request_hiddenvars.php");

?>
<input type="hidden" name="entry_date" value="<?php echo $entry_date ?>">
<?php
}
?>

</ul>
</td>
</tr>

  <tr>
    <td>
<ul>
<?php
if ($edit_findings)
{
?>
 <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
<?php
}
?>    
         <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?>></a>
<?php
if (isset($stored_findings['status']) && $stored_findings['status']!="done" && $stored_findings['status']!="final")
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc($root_path,'done.gif','0').'></a>';
}
?>
</ul>
</td>
  </tr>
  
</table>        
<?php
if ($edit_findings)
{
?>
</form>
<?php
}
?> 
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');?>
</BODY>
</HTML>
