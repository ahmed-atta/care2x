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
	
	drgcomp_<?php echo $HTTP_SESSION_VARS['sess_full_en']."_".$op_nr."_".$dept_nr."_".$saal ?>=window.open("<?php echo $root_path ?>modules/drg/drg-composite-start.php<?php echo URL_REDIRECT_APPEND."&display=composite&pn=".$HTTP_SESSION_VARS['sess_full_en']."&ln=$name_last&fn=$name_first&bd=$date_birth&dept_nr=$dept_nr&oprm=$saal"; ?>","drgcomp_<?php echo $encounter_nr."_".$op_nr."_".$dept_nr."_".$saal ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
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
//-->
</script>
<?php

if(!is_object($TP_obj)){
	include_once($root_path.'include/care_api_classes/class_template.php');
	$TP_obj=new Template($root_path);
}


$TP_href_1="show_sick_confirm.php".URL_APPEND ."&pid=$pid&target=$target";
$TP_href_2="javascript:alert('Function not  available yet')";
$TP_href_3="javascript:alert('Function not  available yet');";
$TP_href_4="show_diagnostics_result.php".URL_APPEND."&pid=$pid&target=$target";
$TP_href_5="show_diagnosis.php".URL_APPEND."&pid=$pid&target=$target";
$TP_href_6="show_procedure.php".URL_APPEND."&pid=$pid&target=$target";
$TP_href_7="javascript:openDRGComposite()";
$TP_href_8="show_prescription.php".URL_APPEND."&pid=$pid&target=$target";
$TP_href_9="show_notes.php".URL_APPEND."&pid=$pid&target=$target&type_nr=21";
$TP_href_10="show_notes.php".URL_APPEND."&pid=$pid&target=$target";
$TP_href_11="show_immunization.php".URL_APPEND."&pid=$pid&target=$target";
$TP_href_12="show_weight_height.php".URL_APPEND."&pid=$pid&target=$target";


# If the sex is female, show the pregnancies option link
if($sex=='f') {
	$TP_preg_AS="<a href=\"show_pregnancy.php".URL_APPEND."&pid=$pid&target=$target \">";
	$TP_preg_AE='</a>';
}else{
	$TP_img_src_13='';
	$TP_href_13='';
}
				  
$TP_img_src_14=createComIcon($root_path,'new_address.gif','0');
$TP_href_14="show_birthdetail.php".URL_APPEND."&pid=$pid&target=$target";
$TP_img_src_15=createComIcon($root_path,'people_search_online.gif','0');
$TP_href_15="patient_register.php".URL_APPEND."&pid=$pid&update=1";
$TP_img_src_16=createComIcon($root_path,'new_address.gif','0');
$TP_href_16="javascript:popRecordHistory('care_encounter',".$HTTP_SESSION_VARS['sess_en'].")";

$TP_href_17='javascript:getinfo(\''.$HTTP_SESSION_VARS['sess_full_en'].'\')';

# Load the template
$TP_options=$TP_obj->load('registration_admission/tp_pat_admit_options.htm');
eval("echo $TP_options;");

?>
