<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_WARNING);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/



/* Globalize the variables */
require_once('../include/inc_vars_resolve.php');

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
  $breakfile='labor.php?sid='.$sid.'&lang='.$lang; 
  break;
  
  case 'amb':
  
  $local_user='ck_amb_user';
  $breakfile='dept.php?sid='.$sid.'&lang='.$lang; 
  break;

  default:
  
  $local_user='ck_pflege_user';
  $breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn";
}

/* Start initializations */
if($subtarget=='chemlabor') define('LANG_FILE','konsil_chemlabor.php');
 else define('LANG_FILE','konsil.php');

require_once('../include/inc_front_chain_lang.php'); ///* invoke the script lock*/
require_once('../include/inc_config_color.php'); ///* load color preferences*/

$thisfile='labor_test_request_printpop.php';

/* The main background color of the form */
if($target=='generic')
{
    $bgc1='#bbdbc4';
}
else
{
    switch($subtarget)
    {
         case 'generic':  $bgc1='#bbdbc4'; break;
         case 'patho': $bgc1='#cde1ec'; break;
         case 'radio':  $bgc1='#ffffff'; break;
         case 'blood':  $bgc1='#99ffcc'; break;
         case 'chemlabor':  $bgc1='#fff3f3'; break;
         case 'baclabor':  $bgc1='#fff3f3'; 
                                   /* Load additional language table */
                                  if(file_exists('../language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php')) include_once('../language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php');
                                      else include_once('../language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_konsil_baclabor.php');
		                           break;
         default:  $bgc1='#ffffff';
			           break;
    }
}
$abtname=get_meta_tags("../global_conf/$lang/konsil_tag_dept.pid");
$edit_form=0; /* Set form to non-editable*/
$read_form=1; /* Set form to read */
$edit=0; /* Set script mode to no edit*/
    
$formtitle=$abtname[$subtarget];


if ($target=='generic')
{
    $db_request_table=$target;
	$sql_2="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
	$formfile=$target;
}
else
{
    $db_request_table=$subtarget;
	$sql_2="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
	$formfile=$subtarget;
}

/* Here begins the real work */
/* Establish db connection */
require('../include/inc_db_makelink.php');
if($link&&$DBLink_OK)
{	
     /* Load date formatter */
     include_once('../include/inc_date_format_functions.php');
     
     /* Load editor functions */
     //include_once('../include/inc_editor_fx.php');
	   
	 if(!isset($mode))   $mode="";
  
	
	    $dbtable='care_admission_patient';
	    /* Get original data */
		
        $sql_1="SELECT * FROM $dbtable WHERE patnum='".$pn."'";
		
		if($ergebnis=mysql_query($sql_1,$link))
       	{
				if( $rows=mysql_num_rows($ergebnis)) 
					{
						$result=mysql_fetch_array($ergebnis);
                           
		                if($ergebnis=mysql_query($sql_2,$link))
       		            {
				            if($editable_rows=mysql_num_rows($ergebnis))
					        {
							
     					       $stored_request=mysql_fetch_array($ergebnis);
							   
							    if(isset($stored_request['parameters']))
							   {
							      //echo $stored_request['parameters'];
   						          parse_str($stored_request['parameters'],$stored_param);
                               }
							   
							   /* parse the material type */
							   if(isset($stored_request['material']))
							   {
   						          parse_str($stored_request['material'],$stored_material);
							   }
							   /* parse the test type */
							   if(isset($stored_request['test_type']))
							   {
   						          parse_str($stored_request['test_type'],$stored_test_type);
							   }
							   $read_form=1;
							   $printmode=1;
							}
			             }
						else
					     {
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

<?php if($target=='baclabor') 
{
?>
.lab {font-family: arial; font-size: 9; color:#ee6666;}
<?php 
}
else
{
?>
.lab {font-family: arial; font-size: 9; color:purple;}
<?php
}
?>

.lmargin {margin-left: 5;}
</style>

</HEAD> 

<BODY bgcolor="white">


<?php

require_once('../include/inc_test_request_printout_fx.php');

if($show_print_button) echo '<a href="javascript:window.print()"><img '.createLDImgSrc('../','printout.gif','0').'></a><p>';


/* Load the form for printing out */
if($subtarget=='chemlabor' || $subtarget=='baclabor')
{
    echo '<img src="../imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&pn='.$result['patnum'].'&batch_nr='.$batch_nr.'&child_img=1&subtarget='.$subtarget.'" >';
}
else
{
    include('../include/inc_test_request_printout_'.$formfile.'.php');
}
?>
     	

</BODY>
</HTML>
