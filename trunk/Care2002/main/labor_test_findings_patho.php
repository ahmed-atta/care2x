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

define('LANG_FILE','konsil.php');

$local_user='ck_lab_user';

require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences
require_once('../global_conf/inc_global_address.php'); 
require_once('../include/inc_diagnostics_report_fx.php');

$breakfile='labor.php?sid='.$sid.'&lang='.$lang; 
$returnfile='labor_test_request_admin_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin;

$thisfile='labor_test_findings_'.$subtarget.'.php';

$bgc1='#cde1ec'; 
$abtname=get_meta_tags("../global_conf/$lang/konsil_tag_dept.pid");
$edit=1; /* Assume to edit first */

//$konsil="patho";
$formtitle=$abtname[$subtarget];
$db_request_table=$subtarget;

						
/* Here begins the real work */
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
{	
   
   include_once('../include/inc_date_format_functions.php');
   

     /* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
     if(isset($pn)&&$pn)
	 {		
	    $dbtable='care_admission_patient';
	    /* Get original data */
		$sql="SELECT * FROM $dbtable WHERE patnum='".$pn."'";
		if($ergebnis=mysql_query($sql,$link))
       	{
				if( $rows=mysql_num_rows($ergebnis)) 
					{
						$result=mysql_fetch_array($ergebnis);
					}
		}
	   else 
	   {
	      $edit=0;
		  $mode="";
		  $pn="";
	   }		
     }
	 

	   
	 if(!isset($mode) && $batch_nr && $pn)   $mode="edit";
		
		  switch($mode)
		  {
				     case 'save':
							
                                 $sql="INSERT INTO care_test_findings_".$db_request_table." 
								          (
										   lang, batch_nr, patnum, dept, 
										   material, macro, 
										   micro, findings, diagnosis,
										   doctor_id, findings_date, findings_time, 
										   status, create_id, create_time) 
										   VALUES 
										   (
										   '".$lang."','".$batch_nr."','".$pn."','".$dept."', 
										   '".addslashes(htmlspecialchars($material))."','".addslashes(htmlspecialchars($macro))."',
										   '".addslashes(htmlspecialchars($micro))."','".addslashes(htmlspecialchars($findings))."','".addslashes(htmlspecialchars($diagnosis))."',
										   '".addslashes($doctor_id)."', '".formatDate2Std($findings_date,$date_format)."', '".date('H:i:s')."',
										   'initial', '".$HTTP_COOKIE_VARS[$local_user.$sid]."', NULL
										   )";


							      if($ergebnis=mysql_query($sql,$link))
       							  {

								     signalNewDiagnosticsReportEvent($findings_date);
									//echo $sql;
									mysql_close($link);
									 header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
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
										   lang='".$lang."', 
										   material='".addslashes(htmlspecialchars($material))."', macro='".addslashes(htmlspecialchars($macro))."', 
										   micro='".addslashes(htmlspecialchars($micro))."', findings='".addslashes(htmlspecialchars($findings))."', 
										   diagnosis='".addslashes(htmlspecialchars($diagnosis))."',
										   doctor_id='".addslashes($doctor_id)."', findings_date='".formatDate2Std($findings_date,$date_format)."', 
										   findings_time='".date('H:i:s')."', 
										   modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=mysql_query($sql,$link))
       							  {
								      								  
								     signalNewDiagnosticsReportEvent($findings_date);
									//echo $sql;
									mysql_close($link);
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
										   modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=mysql_query($sql,$link))
       							  {
									//echo $sql;
							          $sql="UPDATE care_test_request_".$db_request_table." SET 
										   status='done', 
										   modify_id = '".$HTTP_COOKIE_VARS[$local_user.$sid]."'
										   WHERE batch_nr = '".$batch_nr."'";
							          if($ergebnis=mysql_query($sql,$link))
       							      {
									     mysql_close($link);
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
		                if($ergebnis=mysql_query($sql,$link))
       		            {
				            if($editable_rows=mysql_num_rows($ergebnis))
					        {
							
     					       $stored_findings=mysql_fetch_array($ergebnis);
							   
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
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDDiagnosticTest $station" ?></TITLE>
<?php
require('../include/inc_css_a_hilitebu.php');
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
<script language="javascript" src="../js/setdatetime.js">
</script>

<script language="javascript" src="../js/checkdate.js">
</script>

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
<a href="<?php echo $returnfile; ?>"><img <?php echo createLDImgSrc('../','back2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp()"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
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

require_once('../include/inc_test_findings_form_patho.php');

echo '&nbsp;<br>';
if ($edit)
{
   echo'
         <input type="image" '.createLDImgSrc('../','savedisc.gif').'>';

}


?>
  
         <a href="javascript:printOut()"><img <?php echo createLDImgSrc('../','printout.gif','0') ?>></a>
<?php
if (isset($stored_findings['status']) && $stored_findings['status']!='done')
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc('../','done.gif','0').' alt="'.$LDDone.'"></a>';
}
?>

<?php
if ($edit)
{
require('../include/inc_test_request_hiddenvars.php');

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
if(file_exists("../language/$lang/".$lang."_copyrite.php")) include("../language/$lang/".$lang."_copyrite.php");
  else include("../language/en/en_copyrite.php");?>
</BODY>
</HTML>
