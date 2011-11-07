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
//define('NO_CHAIN',1);
define('MODULE','ecombill');
define('LANG_FILE_MODULAR','ecombill.php');
$local_user='aufnahme_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile='billingmenu.php'.URL_APPEND;
$returnfile='billingmenu.php'.URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDBilling);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/billing.html"); 
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDBilling);

 # Collect extra javascrit code

 ob_start();
?>

<Script language=JavaScript>

function check() {
	var LTN,TC,LP;
	LTN=document.lab.LabTestName.value;
	TC=document.lab.TestCode.value;
	LP=document.lab.LabPrice.value;
	DC=document.lab.Discount.value;
	if(LTN=="") {
		alert("<?php echo $LDalertNameLabService; ?>");
		return false;
	} else if(TC=="") {
		alert("<?php echo $LDalertEnterTestCodeNo; ?>");
		return false;
	} else if(LP=="") {
		alert("<?php echo $LDalertEnterPriceperUnit; ?>");
		return false;
	} else if(DC=="") {
		alert("<?php echo $LDalertEnterDiscountallowed; ?>");
		return false;
	} else if(isNaN(LP)) {
		alert("<?php echo $LDalertEnterNumericValueforPrice; ?>");
		return false;
	} else if(isNaN(DC)) {
		alert("<?php echo $LDalertEnterNumericValueforDiscount; ?>");
		return false;
	} else {
		document.lab.action="post_service_entry.php?type=LT";
		document.lab.submit();
	}

}

</Script>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$smarty->assign('FormTitle',$LDBilling . ' - ' . $LDCreateLabTestItem);

$smarty->assign('sFormTag','<form  action="" method="post" name="lab" onSubmit="return check(this)">');
$smarty->assign('LDName',$LDLabTestItem);
$smarty->assign('LDCode',$LDCode);
$smarty->assign('LDPriceUnit',$LDPriceUnit);
$smarty->assign('LDEnterValueDiscount',$LDEnterValueDiscount);

$smarty->assign('sHiddenInputs','<input type="hidden" name="lang" value="'. $lang .'">
		<input type="hidden" name="sid" value="'. $sid .'">');

$smarty->assign('pbSubmit','<input type="image"  '.createLDImgSrc($root_path,'savedisc.gif','0','middle').'>');
$smarty->assign('pbCancel','<a href="'.$breakfile.'" class="button icon remove danger">Cancel</a>');

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/create_item.tpl');
 /**
 * show Template
 */

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
// $smarty->display('debug.tpl');
?>