<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//error_reporting(E_ALL);
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
require_once($root_path.'include/inc_front_chain_lang.php'); ///* invoke the script lock*/
require_once($root_path.'include/inc_config_color.php'); ///* load color preferences*/
require_once($root_path.'include/inc_test_request_vars_baclabor.php'); ///* load variable elements */

/* Load additional languge table */
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php')) include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php');
  else include_once($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_konsil_baclabor.php');


$thisfile="labor_test_request_admin_baclabor.php";

$bgc1='#fff3f3'; /* The main background color of the form */
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
	if(!isset($mode))   $mode="";
	/* Get the pending test requests */	  
    if(!$mode) {
		$sql="SELECT batch_nr,encounter_nr,send_date,dept_nr FROM care_test_request_".$db_request_table." 
				WHERE status='pending' ORDER BY  send_date DESC";
		if($requests=$db->Execute($sql)){
			/* If request is available, load the date format functions */
			require_once($root_path.'include/inc_date_format_functions.php');
			$batchrows=$requests->RecordCount();
			if($batchrows && (!isset($batch_nr) || !$batch_nr)) {
				$test_request=$requests->FetchRow();
				/* Check for the patietn number = $pn. If available get the patients data */
				$pn=$test_request['encounter_nr'];
				$batch_nr=$test_request['batch_nr'];
			}
		}else{
			echo "<p>$sql<p>$LDDbNoRead"; 
			exit;
		}
		$mode="show";   
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

			$result=&$enc_obj->encounter;

			$sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		    if($ergebnis=$db->Execute($sql)){
				if($editable_rows=$ergebnis->RecordCount()){
					$stored_request=$ergebnis->FetchRow();
					 /* parse the material type */
					if($stored_request['material']!=''){
						parse_str($stored_request['material'],$stored_material);
					}
					 /* parse the test type */
					if($stored_request['test_type']!=''){
						parse_str($stored_request['test_type'],$stored_test_type);
					}
					$edit_form=1;
				}
			}else{
				echo "<p>$sql<p>$LDDbNoRead"; 
		  }					
		}
				
		$sql="SELECT * FROM care_test_findings_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		if($ergebnis=$db->Execute($sql)){
			if($editable_rows=$ergebnis->RecordCount()){
				$stored_findings=$ergebnis->FetchRow();
				parse_str($stored_findings['type_general'],$parsed_type);
				parse_str($stored_findings['resist_anaerob'],$parsed_resist_anaerob);
				parse_str($stored_findings['resist_aerob'],$parsed_resist_aerob);
				parse_str($stored_findings['findings'],$parsed_findings);
						   
				if($stored_findings['status']=='done') $edit_findings=0; /* Inhibit editing of the findings */
							   
				$mode='update';
				$edit_form=1;
			}
		}
				
	}else{
		$mode='';
		$pn='';
	}		
}else{
	echo "$LDDbNoLink<br>$sql<br>";
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
.lab {font-family:ms ui gothic; font-size: 9; color:#ee6666;}
.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 

<?php
if($edit)
{
?>

function chkForm(d)
{ 
   return true 
}

function loadM(fn)
{
	mBlank=new Image();
	mBlank.src="../img/pink_border.gif";
	mFilled=new Image();
	mFilled.src="../img/filled_pink_block.gif";
	
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

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

<?php
}
?>

function printOut()
{
	urlholder="labor_test_findings_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=baclabor&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>";
	testprintout<?php echo $sid ?>=window.open(urlholder,"testprintout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    testprintout<?php echo $sid ?>.print();
}


<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js">
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js">
</script>
</HEAD>
<?php require($root_path.'include/inc_js_gethelp.php'); ?>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> 
onLoad="if (window.focus) window.focus(); " 
topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="5" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDPendingTestRequest." (".$batch_nr.")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> colspan=2>

<!-- Table for the list index and the form -->
<table border=0>
  <tr valign="top">
  <!--  Left frame containing the list of requests -->
    <td><FONT  SIZE=1  FACE="verdana">  
<?php 
/* The following routine creates the list of pending requests */
require($root_path.'include/inc_test_request_lister_fx.php');

?></td>

   <!--  Right frame containing the form -->
    <td>
        
		<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">

		<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?> title="<?php echo $LDSaveEntry ?>"> 
        <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0','absmiddle') ?> alt="<?php echo $LDPrintOut ?>"></a>
        <a href="<?php echo 'labor_test_findings_'.$subtarget.'.php?sid='.$sid.'&lang='.$lang.'&batch_nr='.$batch_nr.'&pn='.$pn.'&entry_date='.$stored_request['entry_date'].'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&tracker='.$tracker; ?>"><img <?php echo createLDImgSrc($root_path,'enter_result.gif','0','absmiddle') ?> alt="<?php echo $LDEnterResult ?>"></a>

<?php

require($root_path.'include/inc_test_findings_form_baclabor.php');

require($root_path.'include/inc_test_request_hiddenvars.php');

?>	
     </form>
</td>

</tr>
</table>        	
	
	</td>
  </tr>
</table>

<p>

<?php
require($root_path.'include/inc_load_copyrite.php');?>
<a name="bottom"></a>
</BODY>
</HTML>
