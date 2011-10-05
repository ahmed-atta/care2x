<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
define('NO_CHAIN',1);
define('MODULE','ecombill');
define('LANG_FILE_MODULAR','ecombill.php');
$local_user='aufnahme_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'include/helpers/inc_date_format_functions.php');
require($root_path.'modules/ecombill/model/class_ecombill.php');
require($root_path.'include/core/class_encounter.php');
$eComBill = new eComBill;
$Encounter = new Encounter;

$Encounter->loadEncounterData($patientno);

$presdatetime=date("Y-m-d H:i:s");

$breakfile='patient_payment.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
$returnfile='patient_payment.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
	
# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling . ' - ' . $LDPaymentPreview);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/billing.html"); 
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling . ' - ' . $LDPaymentPreview);

 # Collect extra javascrit code

 ob_start();
?>
<SCRIPT language="JavaScript">
<!--
	function submitform() {		
		document.confirmpayment.action = "postpayment.php";
		document.confirmpayment.submit();
	}
//-->
</SCRIPT>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDPaymentPreview . ' - ' . $full_en);

$smarty->assign('sFormTag','<form name="confirmpayment" method="POST">');

$smarty->assign('LDGeneralInfo',$LDGeneralInfo);
$smarty->assign('LDPatientName',$LDPatientName);
$smarty->assign('LDPatientNameData',$Encounter->encounter['title'] . ' - ' . $Encounter->encounter['name_first'].' '.$Encounter->encounter['name_last']);
$smarty->assign('LDReceiptNumber',$LDReceiptNumber);
$smarty->assign('LDReceiptNumberData',$receipt_no);
$smarty->assign('LDPatientAddress',$LDPatientAddress);
$smarty->assign('LDPatientAddressData',$Encounter->encounter['addr_str'].' '.$Encounter->encounter['addr_str_nr'].'<br>'.$Encounter->encounter['addr_zip'].' '.$Encounter->encounter['addr_citytown_nr']);

$smarty->assign('LDPaymentDate', $LDBillDate);

if($receiptid=="") {
	$billDate = formatDate2Local($presdatetime,$date_format,1);
} else {
	$oldbillqueryresult = $eComBill->listCurrentPaymentsByRecipeNr($receipt_no);
	if(is_object($oldbillqueryresult)){
		if($oldbillqueryresult->RecordCount()){
			$ob=$oldbillqueryresult->FetchRow();
			$billDate = formatDate2Local($ob['payment_date'],$date_format,1);
		}
	}
}

$smarty->assign('LDPaymentDateData', $billDate);
$smarty->assign('LDPatientType', $LDPatientType );
$smarty->assign('LDPatientTypeData', $Encounter->encounter['encounter_class_nr'] );
$smarty->assign('LDDateofBirth', $LDDateofBirth );
$smarty->assign('LDDateofBirthData', formatDate2Local($Encounter->encounter['date_birth'],$date_format) );
$smarty->assign('LDSex', $LDSex );
$smarty->assign('LDSexData', $Encounter->encounter['sex'] );
$smarty->assign('LDPatientNumber', $LDPatientNumber);
$smarty->assign('LDPatientNumberData', $full_en);
$smarty->assign('LDDateofAdmission', $LDDateofAdmission);
$smarty->assign('LDDateofAdmissionData', formatDate2Local($Encounter->encounter['encounter_date'],$date_format));
$smarty->assign('LDPaymentInformation', $LDPaymentInformation);

$smarty->assign('LDShowPayment', TRUE);

$smarty->assign('pbSubmit','<a href="javascript:submitform();"><input type="image"  '.createLDImgSrc($root_path,'continue.gif','0','middle').'></a>');

$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'close2.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

if(strstr(getenv('QUERY_STRING'),"mode1")!="") {
	$smarty->assign('LDSelecttheModeofCurrentPayment', $LDModeofPayment);	
	$smarty->assign('PaymentCash', TRUE);
	$smarty->assign('LDCash', $LDCash);
	$smarty->assign('cashAmount', $amtcash);	
} else if(strstr(getenv('QUERY_STRING'),"mode2")!="") {
	
	$smarty->assign('PaymentCreditCard', TRUE);
	$smarty->assign('LDSelecttheModeofCurrentPayment', $LDModeofPayment);	
	$smarty->assign('LDCreditCard', $LDCreditCard);
	$smarty->assign('LDCardNumber', $LDCardNumber);
	$smarty->assign('LDCardNumberData', $cdno);
	$smarty->assign('LDAmount', $LDAmount);
	$smarty->assign('LDAmountData', $amtcc);
	$smarty->assign('cdno', $cdno);
	$smarty->assign('amtcc', $amtcc);
} else if(strstr(getenv('QUERY_STRING'),"mode3")!="") {
	$smarty->assign('PaymentCheck', TRUE);
	$smarty->assign('LDSelecttheModeofCurrentPayment', $LDModeofPayment);	
	$smarty->assign('LDCheck', $LDCheck);
	$smarty->assign('LDCheckNumber', $LDCheckNumber);
	$smarty->assign('LDCheckNumberData', $chkno);
	$smarty->assign('checkAmount', $LDAmount);
	$smarty->assign('checkAmountData', $amtcheque);
	$smarty->assign('chkno', $chkno);
	$smarty->assign('amtcheque', $amtcheque);
}


$smarty->assign('sHiddenInputs','<input type="hidden" name="patientno" value="'. $patientno .'">
								<input type="hidden" name="hidden" value="C6#C7#C8#"> 
								<input type="hidden" name="receipt_no" value="'. $receipt_no .'">
								<input type="hidden" name="lang" value="'. $lang .'">
								<input type="hidden" name="sid" value="'. $sid .'">
								<input type="hidden" name="full_en" value="'. $full_en .'">');

/**
* show Template
*/
$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/bill_payment_header.tpl');

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
?>