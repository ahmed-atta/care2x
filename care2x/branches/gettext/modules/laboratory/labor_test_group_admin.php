<?php

define('ROW_MAX',15); # define here the maximum number of rows for displaying the groups

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','laboratory');
define('LANG_FILE_MODULAR','laboratory.php');
$local_user='ck_lab_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

///$db->debug=true;

# Create lab object
require_once($root_path.'modules/laboratory/model/class_lab.php');
$lab_obj=new Lab();

# Load the date formatter */
include_once($root_path.'include/helpers/inc_date_format_functions.php');
if(isset($mode) && !empty($mode)) {
	$lab_obj->moveUp($_GET['nrFirst'],$_GET['sortnrFirst']);
	$lab_obj->moveDown($_GET['nrSecond'],$_GET['sortnrSecond']);
}

# Get the test test groups
$tgroups=&$lab_obj->TestGroups();

$breakfile="labor.php".URL_APPEND;

// echo "from table ".$linecount;
# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDTestGroups);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/lab_group_config.html"); 
 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTestGroups);

 # collect extra javascript code
 ob_start();
?>

<script language="javascript" name="j1">
<!--        

function editGroup(nr){
	urlholder="<?php echo $root_path ?>modules/laboratory/labor_test_group_edit.php?sid=<?php echo "$sid&lang=$lang" ?>&nr="+nr;
	editgroup_<?php echo $sid ?>=window.open(urlholder,"editgroup_<?php echo $sid ?>","width=510,height=390,menubar=no,resizable=yes,scrollbars=yes");
}

function newGroup() {
	urlholder="<?php echo $root_path ?>modules/laboratory/labor_test_group_edit.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=new";
	editgroup_<?php echo $sid ?>=window.open(urlholder,"editgroup_<?php echo $sid ?>","width=510,height=390,menubar=no,resizable=yes,scrollbars=yes");
}

function moveUp(nrFirst ,  sortnrFirst , nrSecond , sortnrSecond) {
	urlholder="<?php echo $root_path ?>modules/laboratory/labor_test_group_admin.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=sort&nrFirst="+nrFirst+"&nrSecond="+nrSecond+"&sortnrFirst="+sortnrFirst+"&sortnrSecond="+sortnrSecond;
	document.location = urlholder;
}
// -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$sTempNew = '<a href="javascript:newGroup()" class="button icon add">Add a new  Group</a>';	

# Assign elements
$smarty->assign('sGroupNew',$sTempNew);
$smarty->assign('LDGroup',$LDGroup);

$smarty->assign('sFormAction',$thisfile);

# Generate and buffer group rows

ob_start();
echo '<form action="'. $thisfile .'" method="post" name="group_admin">';
$toggle=0;
if(isset($tgroups) && !empty($tgroups)) {
	$max_rows = $tgroups->NumRows();
	$array_groups = $tgroups->GetArray();
}
$i = 0;
if(is_object($tgroups)){
	for($i = 0; $i < $max_rows; $i++) {
		//if($toggle) $bgc='#ffffee'; else $bgc='#efefef';
		if($toggle) $bgc='wardlistrow1'; else $bgc='wardlistrow2';
		$toggle=!$toggle;
		if($array_groups[$i]['status']=='hidden') {
			echo '
			<tr bgcolor="green">
			<td ><nobr>&nbsp;';		
		} elseif($array_groups[$i]['status']=='deleted') {
			echo '
			<tr bgcolor="red">
			<td ><nobr>&nbsp;';	
		} else {
			echo '
			<tr class="'.$bgc.'">
			<td ><nobr>&nbsp;';	
		}
	
		echo $array_groups[$i]['name'];
		
		echo '&nbsp;</nobr></td>';
		
		echo '
				<td>
				<a href="javascript:editGroup('.$array_groups[$i]['nr'].')"  class="button icon edit">Edit</a>
				</td>';
		echo '<td>';
			if(isset($array_groups[$i-1]['nr'])) 
				echo '<a href="javascript:moveUp('.$array_groups[$i]['nr'].",".$array_groups[$i-1]['sort_nr'].','.$array_groups[$i-1]['nr'].','.$array_groups[$i]['sort_nr'].')"><img '.createLDImgSrc($root_path,'uparrow.png','0').'></a></td>';
			else echo '&nbsp;</td>';
		echo '<td>';			
			if(isset($array_groups[$i+1]['nr']))
				echo '<a href="javascript:moveUp('.$array_groups[$i]['nr'].",".$array_groups[$i+1]['sort_nr'].','.$array_groups[$i+1]['nr'].','.$array_groups[$i]['sort_nr'].')"><img '.createLDImgSrc($root_path,'downarrow.png','0').'></a></td>';
			else echo "&nbsp;</td>" ;
		echo '
			</tr>';
 }
}
echo '</form>';
$sTemp = ob_get_contents();

ob_end_clean();
$sShortHelp = $sShortHelp.  "<font color=\"green\">$LDHiddenGroups</font><br>";
$sShortHelp = $sShortHelp.   "<font color=\"red\">$LDDeletedGroups</font><br>";
$smarty->assign('sTestGroupsRows',$sTemp);
$smarty->assign('sShortHelp',$sShortHelp);

# Assign the group group hidden and submit inputs


$smarty->assign('sSubmitSelect','<input type=hidden name="sid" value="'.$sid.'">
	<input type=hidden name="lang" value="'.$lang.'">
	<input  type="image" '.createLDImgSrc($root_path,'auswahl2.gif','0').'>');

 $smarty->assign('sMainBlockIncludeFile',__DIR__ . '/view/test_groups.tpl');

 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>
