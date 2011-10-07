<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');

define('MODULE','supplier');
define('LANG_FILE_MODULAR','supplier.php');
$local_user='ck_supply_db_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');


if(empty($pday)) $pday=date('j');
if(empty($pmonth)) $pmonth=date('n');
if(empty($pyear)) $pyear=date('Y');
$abtarr=array();
$abtname=array();
$datum=date('d.m.Y');

# Load the supplier list
require_once($root_path.'modules/supplier/model/class_supplier.php');
$supplier_obj=new Supplier;

$dept=$supplier_obj->getAllSupplier();
$title=$LDSelectSupplier;

$fileforward=$root_path."modules/supplier/supply.php".URL_APPEND."&cat=$cat";


# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$title);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/dept_select.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$title);


$smarty->assign('LDPlsSelectDept',$LDPlsSelectSupplier);

 # Buffer department rows output
 ob_start();

$toggler=0;

while(list($x,$v)=each($dept)){
		
	$bold='';
	$boldx='';
	if ($toggler==0) { 
			echo '<tr class="wardlistrow1">'; 
			$toggler=1;}
	else { 
			echo '<tr class="wardlistrow2">'; 
			$toggler=0;
	}
	echo '<td>&nbsp;'.$bold;
	echo $v['supplier'];
	echo $boldx.'&nbsp;</td>';
	echo '<td >&nbsp; <a href="'.$fileforward.'&supplier_nr='.$v['idcare_supplier'].'">
	<img '.createLDImgSrc($root_path,'ok_small.gif','0','absmiddle').' alt="'.$LDShowActualPlan.'" ></a> </td></tr>';
	echo "\n";

	}

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the dept rows  to the frame template

 $smarty->assign('sDeptRows',$sTemp);

$smarty->assign('sBackLink','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0').' alt="'.$LDCloseAlt.'">');

$smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/select_dept.tpl');

 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>