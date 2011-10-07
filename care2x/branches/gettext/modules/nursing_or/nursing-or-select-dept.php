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
define('MODULE','nursing_or');
define('LANG_FILE_MODULAR','nursing_or.php');

switch($_SESSION['sess_user_origin'])
{
	case 'staff_admin':
		$local_user='aufnahme_user';
		$breakfile=$root_path.'modules/staff_admin/staff_register_show.php'.URL_APPEND.'&target=staff_reg&staff_nr='.$nr;
		break;
		
	case 'calendar_opt':
		define('NO_2LEVEL_CHK',1);
		$breakfile = $root_path."modules/calendar/calendar-options.php".URL_APPEND."&year=$year&month=$month&day=$day&forceback=1";
		break;
		
	default:
		$local_user='ck_op_dienstplan_user';
		if (!empty($_SESSION['sess_path_referer'])){
			$breakfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND;
		} else {
			/* default startpage */
			$breakfile = $root_path.'op-docu.php'.URL_APPEND;
		}
}

require_once($root_path.'include/helpers/inc_front_chain_lang.php');

/*
switch($retpath)
{
	case "docs": $breakfile='doctors.php'.URL_APPEND; break;
	case "op": $breakfile='op-docu.php'.URL_APPEND; break;
}
*/

if(empty($pday)) $pday=date('j');
if(empty($pmonth)) $pmonth=date('n');
if(empty($pyear)) $pyear=date('Y');
$abtarr=array();
$abtname=array();
$datum=date('d.m.Y');

/* Load the department list with oncall doctors */
require_once($root_path.'modules/dept_admin/model/class_department.php');
$dept_obj=new Department;
$dept_DOC=$dept_obj->getAllActiveWithDOC();

switch($target){
	case 'plist': $title=$LDCreateNursesList;
					  $fileforward='nursing-or-roster-staff-list.php'.URL_APPEND.'&retpath='.$retpath;
					  break;
	case 'calendar_opt': $title=$LDSelectDept;
					  $fileforward=$root_path."modules/calendar/calendar-options.php".URL_APPEND."&year=$year&month=$month&day=$day";
					  break;	
	default: $title=$LDMakeDutyPlan;
					  $fileforward='nursing-or-roster-plan.php'.URL_APPEND.'&retpath='.$retpath;
					  break;
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


$smarty->assign('LDPlsSelectDept',$LDPlsSelectDept);

 # Buffer department rows output
 ob_start();

$toggler=0;

while(list($x,$v)=each($dept_DOC)){

	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']) 	{ echo '<tr class="hilite">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; }
	else
		if ($toggler==0)
			{ echo '<tr class="wardlistrow1">'; $toggler=1;}
				else { echo '<tr class="wardlistrow2">'; $toggler=0;}
	echo '<td>&nbsp;'.$bold;
	if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
		else echo $v['name_formal'];
	echo $boldx.'&nbsp;</td>';
	echo '<td >&nbsp; <a href="'.$fileforward.'&dept_nr='.$v['nr'].'&nr='.$nr.'">
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