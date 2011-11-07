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
define('MODULE','dept_admin');
define('LANG_FILE_MODULAR','dept_admin.php');
$local_user='ck_admin_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'modules/dept_admin/model/class_department.php');
require_once($root_path.'modules/news/includes/inc_editor_fx.php');

$breakfile=$root_path.'modules/system_admin/admin_system-admi-welcome.php'.URL_APPEND	;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$t_date=$pday.'.'.$pmonth.'.'.$pyear;

$dept_obj=new Department;

$deptarray=$dept_obj->getAllActiveSort('name_formal');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDDepartment :: $LDList");
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/dept_list.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDDepartment :: $LDList");

 # Buffer page output
 ob_start();
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output
ob_start();

?>
<table border=0 cellpadding=3>
  <tr class="wardlisttitlerow">
<!-- 	<td bgcolor="#e9e9e9"></td>
 -->    <td class=pblock align=center><?php echo $LDDept ?></td>
    <td class=pblock align=center><?php echo $LDDescription ?></td>
 </tr> 
  
<?php
while(list($x,$dept)=each($deptarray)){
?>
  <tr>
<!-- 	<td bgcolor="#e9e9e9"><img <?php echo createComIcon($root_path,'arrow_blueW.gif','0'); ?>></td>
 -->    <td class=pblock  bgColor="#eeeeee"><a href="dept_info.php<?php echo URL_APPEND."&dept_nr=".$dept['nr']; ?>">
 <?php 
		if(isset($$dept['LD_var'])&&!empty($$dept['LD_var'])) echo $$dept['LD_var'];
				else echo $dept['name_formal'];
 ?>
 </a> </td>
    <td class=pblock  bgColor="#eeeeee"><?php echo deactivateHotHtml(nl2br($dept['description'])); ?> </td>
 </tr> 
<?php
}
 ?>
 
</table>

<p>

<a href="javascript:history.back()" class="button icon remove danger">Cancel</a>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the data  to the main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>