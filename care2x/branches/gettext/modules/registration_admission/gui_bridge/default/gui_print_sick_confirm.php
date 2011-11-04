<?php

# Load std tags
require('./gui_bridge/default/gui_std_tags.php');


echo StdHeader();
 
?>
 <TITLE><?php echo $title ?></TITLE>

</HEAD>


<BODY bgcolor="<?php echo $cfg['body_bgcolor'];?>"  onLoad="window.print()" 
>


<?php 
# Prepare some values for the template
if($insurance){
	$TP_enc_insurance_name=$insurance['name']; 
	$TP_enc_insurance_nr=$insurance['insurance_nr']; 
	$TP_enc_insurance_subarea=$insurance['sub_area']; 
}

# Extract the  confirmation record for display
if($get_nr){
	$sickconfirm=$single_obj->FetchRow();
}elseif(is_object($sickconfirm_obj)){
	$sickconfirm=$sickconfirm_obj->FetchRow();
} 

# Take over the dept number
$dept_nr=$sickconfirm['dept_nr'];

$TP_insco_1='AOK';
$TP_insco_2='BKK';
$TP_insco_3='KKH';
$TP_insco_4='TKK';
$TP_insco_5='HKH';
$TP_insco_6='BGG';


$TP_date_birth=formatDate2Local($date_birth,$date_format);
$TP_care_logo=createLogo();
# Signature stamp of the department
$TP_dept_sigstamp=nl2br($sickconfirm['sig_stamp']); 
# Logo of the department
$TP_width='';
# Logo of the department
$logobuff=$root_path.'uploads/logos_dept/dept_'.$dept_nr.'.'.$sickconfirm['logo_mime_type'];
if(file_exists($logobuff)){
	$TP_dept_logo=$logobuff; 
	# Check the logo dimensions
	$logosize=GetImageSize($logobuff);
	# If height > $logo_ht_limit, use limit
	if($logosize[1]>$logo_ht_limit) $TP_height='height='.$logo_ht_limit;
		else $TP_height='height='.$logosize[1];
}else{
	$TP_dept_logo=$root_path.'gui/img/common/default/pixel.gif'; # Else output a transparent pixel
}

$TP_date_end=formatDate2Local($sickconfirm['date_end'],$date_format);
$TP_date_start=formatDate2Local($sickconfirm['date_start'],$date_format);
$TP_date_confirm=formatDate2Local($sickconfirm['date_confirm'],$date_format);

$TP_diagnosis=nl2br($sickconfirm['diagnosis']);

# Get the address of the hospital from the global config table
$glob_obj->getConfig('main_info_address');
$TP_main_address=nl2br($GLOBAL_CONFIG['main_info_address']);

# Load the template, default is "tp_show_sick_confirm.htm"
$smarty->assign('TP_insco_1',$TP_insco_1);
$smarty->assign('TP_insco_2',$TP_insco_2);
$smarty->assign('TP_insco_3',$TP_insco_3);
$smarty->assign('TP_insco_4',$TP_insco_4);
$smarty->assign('TP_insco_5',$TP_insco_5);
$smarty->assign('TP_insco_6',$TP_insco_6);
$smarty->assign('TP_enc_insurance_nr',$TP_enc_insurance_nr);
$smarty->assign('TP_enc_insurance_name',$TP_enc_insurance_name);
$smarty->assign('TP_enc_insurance_subarea',$TP_enc_insurance_subarea);
$smarty->assign('title',$title);
$smarty->assign('name_last',$name_last);
$smarty->assign('name_first',$name_first);
$smarty->assign('TP_date_birth',$TP_date_birth);
$smarty->assign('LDSickReport',$LDSickReport);
$smarty->assign('TP_care_logo',$TP_care_logo);
$smarty->assign('TP_main_address',$TP_main_address);
$smarty->assign('LDSickConfirm',$LDSickConfirm);
$smarty->assign('LDSickUntil',$LDSickUntil);
$smarty->assign('TP_date_end',$TP_date_end);
$smarty->assign('TP_href_des',$TP_href_des);
$smarty->assign('TP_img_calendar',$TP_img_calendar);
$smarty->assign('TP_href_end',$TP_href_end);
$smarty->assign('LDStartingFrom',$LDStartingFrom);
$smarty->assign('TP_date_start',$TP_date_start);
$smarty->assign('TP_href_dss',$TP_href_dss);
$smarty->assign('TP_img_calendar',$TP_img_calendar);
$smarty->assign('TP_href_end',$TP_href_end);
$smarty->assign('LDConfirmedOn',$LDConfirmedOn);
$smarty->assign('TP_date_confirm',$TP_date_confirm);
$smarty->assign('TP_href_dcs',$TP_href_dcs);
$smarty->assign('TP_img_calendar',$TP_img_calendar);
$smarty->assign('TP_href_end',$TP_href_end);
$smarty->assign('TP_dept_logo',$TP_dept_logo);
$smarty->assign('TP_width',$TP_width);
$smarty->assign('TP_height',$TP_height);
$smarty->assign('TP_dept_sigstamp',$TP_dept_sigstamp);
$smarty->assign('LDInsurersCopy',$LDInsurersCopy);
$smarty->assign('LDDiagnosis2',$LDDiagnosis2);
$smarty->assign('TP_diagnosis',$TP_diagnosis);
$smarty->display('/../../view/tp_show_sick_confirm.tpl');

?>
<?php
StdFooter();
?>