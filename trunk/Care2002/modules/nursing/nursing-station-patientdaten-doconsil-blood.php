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

$thisfile='nursing-station-patientdaten-doconsil-blood.php';

$bgc1='#99ffcc'; 
$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");
$db_request_table='blood';

$formtitle=$abtname['blood'];
define('_BATCH_NR_INIT_',40000000); 
/*
*  The following are  batch nr inits for each type of test request
*   chemlabor = 10000000; patho = 20000000; baclabor = 30000000; blood = 40000000; generic = 50000000;
*/

/* Here begins the real work */
/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){	
	/* Load the date format functions and get the local format */
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
	   
	 if(!isset($mode))   $mode='';
		
		  switch($mode)
		  {
				     case 'save':
							
                                 $sql="INSERT INTO care_test_request_".$db_request_table." 
                                           (batch_nr, encounter_nr,  dept_nr, 
										   blood_group, rh_factor, kell, date_protoc_nr, 
										   pure_blood, red_blood, leukoless_blood, 
										   washed_blood, prp_blood, thrombo_con, 
										   ffp_plasma, transfusion_dev, match_sample, 
										   transfusion_date, diagnosis, notes, send_date, 
										   doctor, phone_nr, status, 
										   history,
										   modify_id, create_id, create_time) 
										   VALUES 
										   (
										   '".$batch_nr."','".$pn."','".$dept_nr."', 
										   '".$blood_group."','".$rh_factor."','".$kell."','".htmlspecialchars($date_protoc_nr)."',
										   '".$pure_blood."','".$red_blood."','".$leukoless_blood."',
										   '".$washed_blood."','".$prp_blood."','".$thrombo_con."',
										   '".$ffp_plasma."','".$transfusion_dev."','".$match_sample."',
										   '".formatDate2Std($transfusion_date,$date_format)."','".htmlspecialchars($diagnosis)."','".htmlspecialchars($notes)."','".formatDate2Std($send_date,$date_format)."',
										   '".$doctor."','".$phone_nr."','pending',
										   'Create: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n',
										   '".$HTTP_SESSION_VARS['sess_user_name']."','".$HTTP_SESSION_VARS['sess_user_name']."',NULL)";
										   
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php?sid=".$sid."&lang=".$lang."&edit=".$edit."&saved=insert&pn=".$pn."&station=".$station."&user_origin=".$user_origin."&status=".$status."&target=".$target."&noresize=".$noresize."&batch_nr=".$batch_nr);
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
										   batch_nr='".$batch_nr."', 
										   encounter_nr='".$pn."', 
										   dept_nr='".$dept_nr."', 
										   blood_group='".$blood_group."', 
										   rh_factor='".$rh_factor."', 
										   kell='".$kell."', 
										   date_protoc_nr='".htmlspecialchars($date_protoc_nr)."', 
										   pure_blood='".$pure_blood."', 
										   red_blood='".$red_blood."', 
										   leukoless_blood='".$leukoless_blood."', 
										   washed_blood='".$washed_blood."', 
										   prp_blood='".$prp_blood."', 
										   thrombo_con='".$thrombo_con."', 
										   ffp_plasma='".$ffp_plasma."', 
										   transfusion_dev='".$transfusion_dev."', 
										   match_sample='".$match_sample."', 
										   transfusion_date='".formatDate2Std($transfusion_date,$date_format)."', 
										   diagnosis='".htmlspecialchars($diagnosis)."', 
										   notes='".htmlspecialchars($notes)."', 
										   send_date='".formatDate2Std($send_date,$date_format)."', 
										   doctor='".$doctor."', 
										   phone_nr='".$phone_nr."', 
										   status='".$status."', 
										   history=CONCAT(history,'Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
										   modify_id='".$HTTP_COOKIE_VARS[$local_user.$sid]."'
                                           WHERE batch_nr = '".$batch_nr."'";
									  							
							      if($ergebnis=$db->Execute($sql))
       							  {
									//echo $sql;
									 header("location:".$root_path."modules/laboratory/labor_test_request_aftersave.php?sid=".$sid."&lang=".$lang."&edit=".$edit."&saved=update&pn=".$pn."&station=".$station."&user_origin=".$user_origin."&status=".$status."&target=".$target."&batch_nr=".$batch_nr."&noresize=".$noresize);
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
			*/
			case 'edit':
			
		                $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."' AND (status='pending' OR status='draft')";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
     					       $stored_request=$ergebnis->FetchRow();
							   $edit_form=1;
					         }
			             }
						 
						 break; ///* End of case 'edit': */
			
			 default: $mode="";
						   
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
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>
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
function chkForm(d){

   if((d.blood_group.value=='')||(d.blood_group.value==' '))
	{
		alert("<?php echo $LDPlsEnterBloodGroup ?>");
		d.blood_group.focus();
		return false;
	}
	
   if((d.rh_factor.value=='')||(d.rh_factor.value==' '))
	{
		alert("<?php echo $LDPlsEnterRhFactor ?>");
		d.rh_factor.focus();
		return false;
	}
	else if((d.kell.value=='')||(d.kell.value==' '))
	{
		alert("<?php echo $LDPlsEnterKell ?>");
		d.kell.focus();
		return false;
	}
   else if((d.pure_blood.value=='')&&(d.red_blood.value=='')&&(d.leukoless_blood.value=='')&&(d.washed_blood.value=='')&&(d.prp_blood.value=='')&&(d.thrombo_con.value=='')&&(d.ffp_plasma.value==''))
	{
		alert("<?php echo $LDPlsEnterBloodPcs ?>");
		return false;
	}
	else if((d.transfusion_date.value=='')||(d.transfusion_date.value==' '))
	{
		alert("<?php echo $LDPlsEnterTransfusionDate ?>");
		d.transfusion_date.focus();
		return false;
	}   
	else if((d.send_date.value=='')||(d.send_date.value==' '))
	{
		alert("<?php echo $LDPlsEnterDate ?>");
		d.send_date.focus();
		return false;
	}   
	else if((d.doctor.value=='')||(d.doctor.value==' '))
	{
		alert("<?php echo $LDPlsEnterDoctorName ?>");
		d.doctor.focus();
		return false;
	}

	else return true;
}

function sendLater()
{
   document.form_test_request.status.value="draft";
   if(chkForm(document.form_test_request)) document.form_test_request.submit(); 
}

function printOut()
{
	urlholder="<?php echo $root_path; ?>modules/laboratory/labor_test_request_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $target ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn; ?>";
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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDDiagnosticTest; //if($user_origin!='lab') echo " (".$station.")"; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr>
<?php 
if($user_origin=='lab')
{
?>
<a href="<?php echo $thisfile."?sid=".$sid."&lang=".$lang."&station=".$station."&user_origin=".$user_origin."&status=".$status."&target=".$target."&noresize=".$noresize; ?>"><img <?php echo createLDImgSrc($root_path,'newpat2.gif','0') ?>></a>
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

/* Else if not in edit mode and no patient nr. available, show the search prompt */

?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_r.gif','0') ?>></td>
  </tr>
</table>
<?php
}
?>
		<table   cellpadding=0 cellspacing=0 border=0 width=745>
		
	<!-- First row -->	
        <tr bgcolor="<?php echo $bgc1 ?>">
		<!-- <td rowspan=3><img src="../img/de/de_blood_wardfill.gif" border=0 width=27 height=492 align="absmiddle"></td> -->
        <td rowspan=3><img src="<?php echo $root_path; ?>main/imgcreator/blood_lab_leftbar.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>" border=0 width=27 height=492 align="absmiddle"></td>
		<td width=50% bgcolor="<?php echo $bgc1 ?>"  class=fva2_ml10><div   class=fva2_ml10><?php echo $LDToBloodBank."</b></font><br>".$LDTelephone ?><br>
<?php
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;<br>';
          echo "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
?>
      </td>
		<td class=fva2_ml10><div   class=fva2_ml10><font size=3 color="#0000ff"><b><?php echo $LDRequestOf.$formtitle ?></b></font>
		<br>
		<?php 
		 
		 echo $LDWithMatchTest.' '.$LDByBloodBank;
		 echo '<br>'.$LDYes.'<input type="radio" name="match_sample" value=1 ';
		 if(($edit_form || $read_form) && $stored_request['match_sample']) echo "checked";
		 echo '>'.$LDNo.'
		        	<input type="radio" name="match_sample" value=0 ';
		 if(($edit_form || $read_form) && !$stored_request['match_sample']) echo "checked";
		 echo '>';
        ?>
	  </td>
    </tr>
  
		
		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>" >
        <td valign="bottom" align="right">
		
		<!-- Block for bloodgroup, Rh-factor, Kell  -->
		<table border=0 cellspacing=0 cellpadding=2 bgcolor="#000000" width=100%>
        <tr>
          <td>
		     <table border=0 bgcolor="<?php echo $bgc1 ?>" cellpadding=4 width=100%>
             <tr  class=fva2_ml10>
              <td><?php echo $LDBloodGroup ?><br><input type="text" name="blood_group" size=7 maxlength=10 value="<?php  if($edit_form || $read_form) echo $stored_request['blood_group']; ?>"></td>
			   <td><?php echo $LDRhFactor ?><br><input type="text" name="rh_factor" size=7 maxlength=10 value="<?php  if($edit_form || $read_form) echo $stored_request['rh_factor']; ?>"></td>
			   <td><?php echo $LDKell ?><br><input type="text" name="kell" size=7 maxlength=10 value="<?php  if($edit_form || $read_form) echo $stored_request['kell']; ?>"></td>
              </tr>
              <tr class=fva0_ml10>
              <td colspan=3><?php echo $LDDateProtNumber ?><br><input type="text" name="date_protoc_nr" size=45 maxlength=45 value="<?php  if($edit_form || $read_form) echo $stored_request['date_protoc_nr']; ?>"></td>
            </tr>
            </table>
	      </td>
        </tr>
        </table>
  
		
		</td>
         <td  bgcolor="<?php echo $bgc1 ?>" valign="top"><div class=fva2b_ml10>
<?php

if($edit){
	echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
}elseif($pn==''){
	$searchmask_bgcolor='#ffffff';
	include($root_path.'include/inc_test_request_searchmask.php');
}
?>
    </div></td>
	</tr>
	
	<!-- Second row -->
		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>" >
        <td>
		
		<!-- Block Specimen  -->
		<table border=0 cellspacing=0 cellpadding=1 bgcolor="#000000" width=100% height=100%>
        <tr>
          <td>
		     <table border=0 cellpadding=1 cellspacing=1 width=100% height=100%>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td><b>&nbsp;<?php echo $LDBloodSpecimen ?></b></td>
			   <td align="center"><?php echo $LDCount ?></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDPureBlood ?></td>
			   <td align="center"><input type="text" name="pure_blood" size=6 maxlength=6 value="<?php  if($edit_form || $read_form) echo $stored_request['pure_blood']; ?>"></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDRedBloodCon ?></td>
			   <td align="center"><input type="text" name="red_blood" size=6 maxlength=6 value="<?php  if($edit_form || $read_form) echo $stored_request['red_blood']; ?>"></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDLeukoLessRedBlood ?></td>
			   <td align="center"><input type="text" name="leukoless_blood" size=6 maxlength=6 value="<?php  if($edit_form || $read_form) echo $stored_request['leukoless_blood']; ?>"></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDWashedRedBlood ?></td>
			   <td align="center"><input type="text" name="washed_blood" size=6 maxlength=6 value="<?php  if($edit_form || $read_form) echo $stored_request['washed_blood']; ?>"></td>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDPRP ?></td>
			   <td align="center"><input type="text" name="prp_blood" size=6 maxlength=6 value="<?php  if($edit_form || $read_form) echo $stored_request['prp_blood']; ?>"></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDThromboCon ?></td>
			   <td align="center"><input type="text" name="thrombo_con" size=6 maxlength=6 value="<?php  if($edit_form || $read_form) echo $stored_request['thrombo_con']; ?>"></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDFFP ?></td>
			   <td align="center"><input type="text" name="ffp_plasma" size=6 maxlength=6 value="<?php  if($edit_form || $read_form) echo $stored_request['ffp_plasma']; ?>"></td>
              </tr>
             <tr bgcolor="<?php echo $bgc1 ?>" >
              <td colspan=2  class=fva2_ml10 >&nbsp;</td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDTransfusionDevice ?></td>
			   <td align="center"><input type="text" name="transfusion_dev" size=6 maxlength=6 value="<?php  if($edit_form || $read_form) echo $stored_request['transfusion_dev']; ?>"></td>
              </tr>
            </table>
	      </td>
        </tr>
        </table>
  
		
		</td>
         <td  bgcolor="<?php echo $bgc1 ?>" >
		 
		 <!--  Block for diagnosis, doctors, -->
		 <table border=0 cellspacing cellpadding=0>
     <tr>
       <td colspan=2 bgcolor="#000000"><img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border=0 width=1 height=2 align="absmiddle"></td>
     </tr>
     <tr>
       <td><div class=fva2b_ml10><font size=1><?php echo $LDTransfusionDate ?></font></div></td>
       <td><input type="text" name="transfusion_date" size=20 maxlength=10  value="<?php  if($mode=='edit') echo formatDate2Local($stored_request['transfusion_date'],$date_format); ?>"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"></td>
     </tr>
     <tr>
       <td colspan=2><div class=fva2b_ml10><b><?php echo $LDDiagnosis ?></b><br>
	   <textarea name="diagnosis" cols=35 rows=2 wrap="physical"><?php  if($edit_form || $read_form) echo stripslashes($stored_request['diagnosis']); ?></textarea></div></td>
     </tr>
     <tr>
       <td colspan=2> <div class=fva2b_ml10><font size=1><?php echo $LDNotesRequests ?></font><br>
	   <textarea name="notes" cols=35 rows=2 wrap="physical"><?php  if($edit_form || $read_form) echo stripslashes($stored_request['notes']); ?></textarea></div></td>
       <td></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDDate ?>:&nbsp;</font></div></td>
       <td><input type="text" name="send_date" size=20 maxlength=10  value="<?php  if($mode=="edit") echo formatDate2Local($stored_request['send_date'],$date_format); else echo formatDate2Local(date("Y-m-d"),$date_format) ?>" onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')"></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDDoctor ?>:&nbsp;</font></div></td>
       <td><input type="text" name="doctor" size=20 maxlength=20 value="<?php  if($edit_form || $read_form) echo $stored_request['doctor']; ?>"></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDTelephone ?>:&nbsp;</font></div></td>
       <td><input type="text" name="phone_nr" size=20 maxlength=20 value="<?php  if($edit_form || $read_form) echo $stored_request['phone_nr']; ?>"></td>
     </tr>
     <tr>
       <td colspan=2><div class=fva2b_ml10><font size=1 face="arial"><?php echo $LDDoctorNotice ?></font></div></td>
     </tr>
   </table>
    </td>
	</tr>
	
<!--  Black divider line  -->
	<tr bgcolor="<?php echo $bgc1 ?>">
        <td  colspan=3 bgcolor="#000000"><img src="<?php echo $root_path ?>gui/img/common/default/pixel_blk.gif" border=0 width=745 height=4 align="absmiddle"></td>
	</tr>	
	
<!--  Block for bottom part of the form -->
	<tr bgcolor="#000000">
        <td colspan=3>

	<!--  Table container for the lower part of the form  -->
	
	      <table border=0 cellspacing=1 width=100% height=100% align="left" cellpadding=0>
         <tr bgcolor="<?php echo $bgc1 ?>">
        <td  bgcolor="<?php echo $bgc1 ?>" rowspan=20 width=27>
		<img src="<?php echo $root_path; ?>main/imgcreator/blood_lab_leftbar.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&form_bottom=1" border=0 width=27 height=492><br></td>
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDPB ?><br><?php echo $LD350 ?></font></td>
           <td colspan=7>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDRB ?></font></td>
           <td colspan=7>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDLLRB ?></font></td>
           <td colspan=7>&nbsp;</td>
        </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDWRB ?></font></td>
           <td colspan=7>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDPRP_Initial ?></font></td>
           <td colspan=7>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDTC ?></font></td>
           <td colspan=7>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDFFP_Initial ?></font></td>
           <td colspan=7>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>" valign="top">
           <td colspan=4>&nbsp;<font size=2 face="verdana,arial"><b><?php echo $LDLabServices ?></b></font></td>
           <td colspan=4 rowspan=4 width=50%>&nbsp;<font size=1 face="arial"><?php echo $LDLabTimeStamp ?></font><br>
		   &nbsp;
		   </td>

         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><nobr><?php echo $LDServiceCode ?></nobr></font></td>
           <td width=30%>&nbsp;</td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCount ?>&nbsp;</font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDPrice ?>&nbsp;</font></td>

         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBloodGroupCode ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBloodGroup ?></font></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDA_SubgroupCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDA_Subgroup ?></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>" valign="top">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDExtraBGFactorsCode ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDExtraBGFactors ?></font></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td colspan=2 rowspan=4>&nbsp;<font size=1 face="arial"><?php echo $LDReleaseVia ?></font></td>
           <td colspan=2 rowspan=4>&nbsp;<font size=1 face="arial"><?php echo $LDReceiptAck ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCoombsTestCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCoombsTest ?></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyTestCode ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyTest ?></font></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCrossTestCode ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCrossTest ?></font></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyDiffCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyDiff ?></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></font></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDLabLogBook ?></font></td>
           <td>&nbsp;</td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDLabNumber ?></font></td>
           <td>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBookedOn ?></font></td>
           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDDate ?></font></td>
           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td colspan=2>&nbsp;</td>
           <td colspan=2>&nbsp;</td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
             <td colspan=3>&nbsp;<font size=1 face="arial"><?php echo $LDTotalAmount ?></td>
           <td>&nbsp;</td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></td>
         </tr>

       </table>
		
		
		</td>
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
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
