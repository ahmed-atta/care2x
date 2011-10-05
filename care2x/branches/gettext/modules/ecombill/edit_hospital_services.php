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
//$db->debug=true;
$local_user='aufnahme_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require($root_path.'modules/ecombill/model/class_ecombill.php');
$eComBill = new eComBill;
$resultqryLT = $eComBill->listServiceItemsByType($service);
if(is_object($resultqryLT)) $cntLT=$resultqryLT->RecordCount();

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

<SCRIPT language="JavaScript">
<!--
function check() {
	document.editservice.action ="posteditservice.php";
	document.editservice.submit();
}

//-->
</SCRIPT>
<?php 
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);
if($service=='LT') $Title = $LDEditLaboratoryTestItems;
if($service=='HS') $Title = $LDEditHospitalServiceItems;
$smarty->assign('FormTitle',$LDBilling . ' - ' . $Title);

$smarty->assign('sFormTag','<form name="editservice" id="editservice" method="POST" action="" onSubmit="return check(this)">');
$smarty->assign('LDName',$LDNameHS);
$smarty->assign('LDCode',$LDCode);
$smarty->assign('LDCostPerUnit',$LDCostPerUnit);
$smarty->assign('LDDiscount',$LDDiscount);

$smarty->assign('pbSubmit','<input type="image"  '.createLDImgSrc($root_path,'savedisc.gif','0','middle').'>');
$smarty->assign('pbCancel','<a href="'.$breakfile.'" ><img '.createLDImgSrc($root_path,'close2.gif','0','middle').' title="'.$LDCancel.'" align="middle"></a>');


/**
* show Template
*/
$sListRows='';
for($cnt=0;$cnt<$cntLT;$cnt++) {
	$itemdetails="";
	$result=$resultqryLT->FetchRow();

	$smarty->assign('TP_code',$result['item_code']);
	$smarty->assign('TP_description',$result['item_description']);
	$smarty->assign('itemnmcnt','itemnm' . '#' . $cnt);
	$smarty->assign('TP_unit_cost',$result['item_unit_cost']);
	$smarty->assign('itemcscnt','itemcs' . '#' . $cnt);
	$smarty->assign('TP_discount_max',$result['item_discount_max_allowed']);
	$smarty->assign('itemdccnt','itemdc' . '#' . $cnt);

	$itemcd=$result['item_code'];
	$itemcd1=$itemcd1.$itemcd;
	$itemcd1=$itemcd1."#";		
		
	ob_start();
		$smarty->display('ecombill/edit_item_line.tpl');
		$sListRows = $sListRows.ob_get_contents();
	ob_end_clean();

}

$smarty->assign('ItemLine',$sListRows);
$itemcd=$itemcd1;

$smarty->assign('sHiddenInputs','<input type="hidden" name="itemcd" value="'. $itemcd .'">
					<input type="hidden" name="lang" value="'. $lang .'">
					<input type="hidden" name="sid" value="'. $sid .'">
					<input type="hidden" name="full_en" value="'. $full_en .'">');

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/edit_item.tpl');

$smarty->display(CARE_BASE . 'main/view/mainframe.tpl');
?>