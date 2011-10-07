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
define('MODULE','doctors');
define('LANG_FILE_MODULAR','doctors.php');
if($_SESSION['sess_user_origin']=='staff_admin'){
	$local_user='aufnahme_user';
	$breakfile=$root_path.'modules/staff_admin/staff_register_show.php'.URL_APPEND.'&target=staff_reg&staff_nr='.$nr;
}else{
	$local_user='ck_doctors_roster_user';
	if (!empty($_SESSION['sess_path_referer'])){
		$breakfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND;
	} else {
		/* default startpage */
		$breakfile = $root_path.'doctors.php'.URL_APPEND;
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

$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$abtarr=array();
$abtname=array();
$datum=date("d.m.Y");

if(!$hilitedept&&$dept_nr) $hilitedept=$dept_nr;

# Load the department list with oncall doctors
require_once($root_path.'modules/dept_admin/model/class_department.php');
$dept_obj=new Department;
$dept_DOC=$dept_obj->getAllActiveWithDOC();

switch($target){
	case 'plist': $title=$LDCreateDoctorsList;
					  $fileforward='doctors-roster-personal-list.php'.URL_APPEND.'&retpath='.$retpath;
					  break;
	default: $title=$LDMakeDutyPlan;
					  $fileforward='doctors-roster-plan.php'.URL_APPEND.'&retpath='.$retpath;
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

 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/dept_select.html"); $smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for return  button
 $smarty->assign('pbBack',$breakfile);

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
	if($hilitedept==$v['nr']) 	{ echo '<tr bgcolor="yellow">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; } 
	else
		if ($toggler==0) 
			{ echo '<tr class="wardlistrow1">'; $toggler=1;}
				else { echo '<tr class="wardlistrow2">'; $toggler=0;}
	echo '<td ><font face="verdana,arial" size="2" >&nbsp;'.$bold;
	$buff=$v['LD_var'];
	if(isset($$buff)&&!empty($$buff)) echo $$buff;
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