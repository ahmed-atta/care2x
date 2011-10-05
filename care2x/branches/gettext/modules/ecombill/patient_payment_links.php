<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
define('NO_CHAIN',1);
define('MODULE','ecombill');
define('LANG_FILE_MODULAR','ecombill.php');

$local_user='aufnahme_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'include/helpers/inc_date_format_functions.php');
require($root_path.'modules/ecombill/model/class_ecombill.php');
$eComBill = new eComBill;

$breakfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
$returnfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

# Check if final bill is available, if yes hide new  payment menu item
$chkfinalresult = $eComBill->checkFinalBillExist($full_en);
if(is_object($chkfinalresult)) $chkexists=$chkfinalresult->RecordCount();

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling . ' - ' . $LDPayments);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/billing.html"); 
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling . ' - ' . $LDPayments);

 # Collect extra javascrit code

 ob_start();
?>

<Script language=Javascript>
function show() {	
	document.receiptlinks.action="patient_payment.php";
	document.receiptlinks.submit();
}

function showreceipt(receiptid) {	
	document.receiptlinks.action="showpayment.php?receiptid="+receiptid;
	document.receiptlinks.submit();
}

</script>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDPatientNumber . ' - ' . $full_en);

$smarty->assign('LDReceiptNumber',$LDReceiptNumber);
$smarty->assign('LDReceiptDateTime',$LDReceiptDateTime);

$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'close2.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');

/**
* show Template
*/
$sListRows='';
if($resultreceiptquery=$eComBill->listCurrentPayments($full_en)){
    if($resultreceiptquery->RecordCount()){
    	while ($payment=$resultreceiptquery->FetchRow()){   
    		$smarty->assign('itemNr',"<a href=javascript:showreceipt('".$payment['payment_receipt_no']."')>".$payment['payment_receipt_no']."</a>" ); 	
    		$smarty->assign('date', formatDate2Local($payment['payment_date'],$date_format));
	
		    ob_start();
			$smarty->display('ecombill/bill_payment_line.tpl');
			$sListRows = $sListRows.ob_get_contents();
			ob_end_clean(); 

    	}
	}
}

if(!$chkexists) {
	$smarty->assign('itemNr', '<a href="javascript:show()">'. $LDMakeaNewPayment .'</a>');
	$smarty->assign('date', '');
	
	ob_start();
	$smarty->display('ecombill/bill_payment_line.tpl');
	$sListRows = $sListRows.ob_get_contents();
	ob_end_clean(); 
}

$smarty->assign('ItemLine',$sListRows);

$smarty->assign('sFormTag','<form name="receiptlinks" method="POST" action="patient_payment.php">');
$smarty->assign('sHiddenInputs','<input type="hidden" name="patientno" value="'. $patientno .'">
				<input type="hidden" name="lang" value="'. $lang .'">
				<input type="hidden" name="sid" value="'. $sid .'">
				<input type="hidden" name="full_en" value="'. $full_en .'">');

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/bill_payment.tpl');

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
?>