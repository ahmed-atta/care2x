<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','products');
define('LANG_FILE_MODULAR','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');


switch($_SESSION['sess_user_origin'])
{
	case 'pharma':
		$breakfile=$root_path.'modules/pharmacy/pharmacy.php'.URL_APPEND;
		break;
		
	case 'meddepot':
		$breakfile=$root_path.'modules/medstock/medstock.php '.URL_APPEND;
		break;
}


if(empty($pday)) $pday=date('j');
if(empty($pmonth)) $pmonth=date('n');
if(empty($pyear)) $pyear=date('Y');
$abtarr=array();
$abtname=array();
$datum=date('d.m.Y');

# Load the medical department list
require_once($root_path.'modules/dept_admin/model/class_department.php');
$dept_obj=new Department;

//begin:gjergji 
//if i'm the depot then i only take the pharmacy
//else, all the departments
if($cat=='medstock') 
		$dept=$dept_obj->getAllPharmacy();
elseif($cat=='pharma') 
		$dept=$dept_obj->getAllMedical();
//end:gjergji

if($cat=='medstock')
	$title=$LDSelectPharma;
elseif($cat=='pharma') 
	$title=$LDSelectDept;
# Set forward file
switch($target){
	case 'catalog': $fileforward=$root_path."modules/products/products-ordercatalog-edit.php".URL_APPEND."&cat=$cat";
							break;
	default : $fileforward=$root_path."modules/products/products-order.php".URL_APPEND."&cat=$cat";
}

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


if($cat=='medstock')
	$smarty->assign('LDPlsSelectDept',$LDPlsSelectFarma);
elseif($cat=='pharma') 
	$smarty->assign('LDPlsSelectDept',$LDPlsSelectDept);

 # Buffer department rows output
 ob_start();

$toggler=0;

while(list($x,$v)=each($dept)){
		
	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ echo '<tr class="wardlistrow1">'; $toggler=1;}
				else { echo '<tr class="wardlistrow2">'; $toggler=0;}
	echo '<td>&nbsp;'.$bold;
	if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
		else echo $v['name_formal'];
	echo $boldx.'&nbsp;</td>';
	echo '<td >&nbsp; <a href="'.$fileforward.'&dept_nr='.$v['nr'].'">
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