<script language="javascript" >
<!-- 
function openDRGComposite(){
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;
			h=650;';
?>
	
	drgcomp_<?php echo $HTTP_SESSION_VARS['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>=window.open("<?php echo $root_path ?>modules/drg/drg-composite-start.php<?php echo URL_REDIRECT_APPEND."&display=composite&pn=".$HTTP_SESSION_VARS['sess_full_en']."&edit=$edit&is_discharged=$is_discharged&ln=$name_last&fn=$name_first&bd=$date_birth&dept_nr=$dept_nr&oprm=$saal"; ?>","drgcomp_<?php echo $encounter_nr."_".$op_nr."_".$dept_nr."_".$saal ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.drgcomp_<?php echo $HTTP_SESSION_VARS['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>.moveTo(0,0);
} 

function getinfo(pn){
<?php /* if($edit)*/
	{ echo '
	urlholder="'.$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_REDIRECT_APPEND;
	echo '&pn=" + pn + "';
	echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit&station=$station"; 
	echo '";';
	echo '
	patientwin=window.open(urlholder,pn,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	';
	}
	/*else echo '
	window.location.href=\'nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$station.'\'';*/
?>
}
function cancelEnc(){
	if(confirm("<?php echo $LDSureToCancel ?>")){
		usr=prompt("<?php echo $LDPlsEnterFullName ?>","");
		if(usr&&usr!=""){
			window.location.href="aufnahme_cancel.php<?php echo URL_REDIRECT_APPEND ?>&mode=cancel&encounter_nr=<?php echo $HTTP_SESSION_VARS['sess_en'] ?>&cby="+usr;
		}
	}
}
//-->
</script>
<?php
# Let us detect if data entry is allowed
if($edit){
	//echo $enc_status['is_disharged'].'<p>'. $enc_status['encounter_status'].'<p>d= '. $enc_status['in_dept'].'<p>w= '. $enc_status['in_ward'];
	if($enc_status['is_disharged']||stristr('cancelled',$enc_status['encounter_status'])||!($enc_status['in_dept']||$enc_status['in_ward'])){
		$data_entry=false;
	}else{
		$data_entry=true;
	}
}else{
	$data_entry=false;
}

# Create the template object
if(!is_object($TP_obj)){
	include_once($root_path.'include/care_api_classes/class_template.php');
	$TP_obj=new Template($root_path);
}

$TP_href_1="show_sick_confirm.php".URL_APPEND ."&pid=$pid&target=$target";
if($data_entry){
	$TP_SICKCONFIRM="<a href=\"show_sick_confirm.php".URL_APPEND ."&pid=$pid&target=$target\">$LDSickReport</a>";
}else{
	$TP_SICKCONFIRM="<font color='#333333'>$LDSickReport</font>";
}

if($data_entry){
	$TP_DIAGXRESULTS="<a href=\"show_diagnostics_result.php".URL_APPEND."&pid=$pid&target=$target\">$LDDiagXResults</a>";
}else{
	$TP_DIAGXRESULTS="<font color='#333333'>$LDDiagXResults</font>";
}

if($data_entry){
	$TP_DIAGNOSES="<a href=\"show_diagnosis.php".URL_APPEND."&pid=$pid&target=$target\">$LDDiagnoses</a>";
}else{
	$TP_DIAGNOSES="<font color='#333333'>$LDDiagnoses</font>";
}

if($data_entry){
	$TP_PROCEDURES="<a href=\"show_procedure.php".URL_APPEND."&pid=$pid&target=$target\">$LDProcedures</a>";
}else{
	$TP_PROCEDURES="<font color='#333333'>$LDProcedures</font>";
}

if($data_entry){
	$TP_DRG="<a href=\"javascript:openDRGComposite()\">$LDDRG</a>";
}else{
	$TP_DRG="<font color='#333333'>$LDDRG</font>";
}

if($data_entry){
	$TP_PRESCRIPTIONS="<a href=\"show_prescription.php".URL_APPEND."&pid=$pid&target=$target\">$LDPrescriptions</a>";
}else{
	$TP_PRESCRIPTIONS="<font color='#333333'>$LDPrescriptions</font>";
}

if($data_entry){
	$TP_NOTESREPORTS="<a href=\"show_notes.php".URL_APPEND."&pid=$pid&target=$target\">$LDNotes $LDAndSym $LDReports</a>";
}else{
	$TP_NOTESREPORTS="<font color='#333333'>$LDNotes $LDAndSym $LDReports</font>";
}
$TP_href_11="show_immunization.php".URL_APPEND."&pid=$pid&target=$target";
if($data_entry){
	$TP_IMMUNIZATION="<a href=\"show_immunization.php".URL_APPEND."&pid=$pid&target=$target\">$LDImmunization</a>";
}else{
	$TP_IMMUNIZATION="<font color='#333333'>$LDImmunization</font>";
}

if($data_entry){
	$TP_MSRMNTS="<a href=\"show_weight_height.php".URL_APPEND."&pid=$pid&target=$target\">$LDWtHt</a>";
}else{
	$TP_MSRMNTS="<font color='#333333'>$LDWtHt</font>";
}

# If the sex is female, show the pregnancies option link
if($data_entry&&$sex=='f') {
	$TP_preg_BLK="<a href=\"show_pregnancy.php".URL_APPEND."&pid=$pid&target=$target\">$LDPregnancies</a>";
}else{
	$TP_preg_BLK="<font color='#333333'>$LDPregnancies</font>";
}
				  
if($data_entry){
	$TP_BIRTHDX="<a href=\"show_birthdetail.php".URL_APPEND."&pid=$pid&target=$target\">$LDBirthDetails</a>";
}else{
	$TP_BIRTHDX="<font color='#333333'>$LDBirthDetails</font>";
}
$TP_HISTORY="<a href=\"javascript:popRecordHistory('care_encounter',".$HTTP_SESSION_VARS['sess_en'].")\">$LDRecordsHistory</a>";
# Links to chart folder
$TP_href_17='javascript:getinfo(\''.$HTTP_SESSION_VARS['sess_en'].'\')';
if($data_entry){
	$TP_CHARTSFOLDER="<a href=\"javascript:getinfo('".$HTTP_SESSION_VARS['sess_en']."')\">$LDChartsRecords</a>";
}else{
	$TP_CHARTSFOLDER="<font color='#333333'>$LDChartsRecords</font>";
}
# Links to patient registration data display
$TP_PATREGSHOW="<a href=\"patient_register_show.php".URL_APPEND."&pid=".$HTTP_SESSION_VARS['sess_pid']."&from=$from&newdata=1&target=$target\">$LDShow $LDPatientRegister</a>";
$TP_PATREGUPDATE="<a href=\"patient_register.php".URL_APPEND."&pid=$pid&update=1\">$LDUpdate $LDPatientRegister</a>";

# Links to medocs module
if($data_entry){
	$TP_MEDOCS="<a href=\"".$root_path."modules/medocs/show_medocs.php".URL_APPEND."&encounter_nr=".$HTTP_SESSION_VARS['sess_en']."&edit=$edit&from=$from&is_discharged=$is_discharged&target=$target\">$LDMedocs</a>";
}else{
	$TP_MEDOCS="<font color='#333333'>$LDMedocs</font>";
}

# If encounter_status empty or 'allow_cancel', show the cancel option link
//if(!$enc_status['is_discharged']&&!$enc_status['in_ward']&&!$enc_status['in_dept']&&(empty($enc_status['encounter_status'])||$enc_status['encounter_status']=='allow_cancel')){
if(!$data_entry&&($enc_status['encounter_status']!='cancelled')){
	$TP_xenc_BLK="<a href=\"javascript:cancelEnc('".$HTTP_SESSION_VARS['sess_en']."')\">$LDCancelThisAdmission</a>";
}else{
	$TP_xenc_BLK="<font color='#333333'>$LDCancelThisAdmission</font>";
}

# Load the template
$TP_options=$TP_obj->load('registration_admission/tp_pat_admit_options.htm');
eval("echo $TP_options;");
?>
