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

/* Globalize the variables */
require_once('../include/inc_vars_resolve.php');

/* We need to differentiate from where the user is coming: 
*  $user_origin != lab ;  from patient charts folder
*  $user_origin == lab ;  from the laboratory
*  and set the user cookie name and break or return filename
*/
if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  $breakfile="labor.php?sid=".$sid."&lang=".$lang; 
}
else
{
  $local_user='ck_pflege_user';
  $breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn";
}

//$local_user='ck_lab_user';

require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php'); // load color preferences

$thisfile="labor_test_findings_".$subtarget.".php";

switch ($subtarget)
{
    case "patho": $bgc1="#cde1ec"; break;
	
	case 'radio':  $bgc1="#ffffff"; break;
	
	case "baclabor":  $bgc1='#fff3f3'; break;
}
 
$abtname=get_meta_tags("../global_conf/$lang/konsil_tag_dept.pid");
$edit=0; /* Set to no edit */

//$konsil="patho";
$formtitle=$abtname[$subtarget];
$db_request_table=$subtarget;

						
/* Here begins the real work */
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
{	
   
   require_once('../include/inc_date_format_functions.php');
   

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
	        /* If mode is edit, get the stored test findings 
			*/
			case 'edit':
			
                      if($subtarget=='baclabor')
					  {
				   
			             $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
					   
		                 if($ergebnis=mysql_query($sql,$link))
       		             {
				            if($editable_rows=mysql_num_rows($ergebnis))
					        {
							
     					       $stored_request=mysql_fetch_array($ergebnis);
							   
							   parse_str($stored_request['material'],$stored_material);
							   parse_str($stored_request['test_type'],$stored_test_type);
							   
							   $edit_form=1;
							   $read_form=1;

					         }
			             }
					  }
						 
			           $sql="SELECT * FROM care_test_findings_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
					   
		               if($ergebnis=mysql_query($sql,$link))
       		            {
				            if($editable_rows=mysql_num_rows($ergebnis))
					        {
							
     					       $stored_findings=mysql_fetch_array($ergebnis);
							   
							   if($subtarget=='baclabor')
							   {
							       parse_str($stored_findings['type_general'],$parsed_type);
							       parse_str($stored_findings['resist_anaerob'],$parsed_resist_anaerob);
							       parse_str($stored_findings['resist_aerob'],$parsed_resist_aerob);
							       parse_str($stored_findings['findings'],$parsed_findings);
						       }
							   
							   if($stored_findings['status']=="done") $edit_findings=0; /* Inhibit editing of the findings */
							   
							   $mode='update';
							   $edit_form=1;
							   $read_form=1;
					         }
			             }

						 break; ///* End of case 'edit': */
						 
			 default:	$mode="";
			 		 
		  }// end of switch($mode)
  
    
}
else 
 { echo "$LDDbNoLink<br>$sql<br>"; }
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDTestFindings #$batch_nr" ?></TITLE>
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
.lab {font-family:ms ui gothic; font-size: 9; color:#ee6666;}
.lmargin {margin-left: 5;}
</style>


</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus(); "  >



<?php

require_once('../include/inc_test_request_printout_fx.php');


if($show_print_button) echo '<a href="javascript:window.print()"><img '.createLDImgSrc('../','printout.gif','0').'></a><p>';

/**
*  Load the form 
*/
// include('../include/inc_test_request_printout_baclabor.php');
if($subtarget=="baclabor")
{
    echo '<img src="../imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&pn='.$result['patnum'].'&batch_nr='.$batch_nr.'&child_img=1&subtarget='.$subtarget.'" >';
}
else
{
    include_once('../include/inc_test_findings_form_'.$subtarget.'.php');
}
?>

</BODY>
</HTML>
