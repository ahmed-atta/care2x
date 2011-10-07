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
define('MODULE','nursing');
define('LANG_FILE_MODULAR','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'include/core/class_ward.php');
## Load all wards info 
$ward_obj=new Ward;
$items='nr,ward_id,name';
$ward_info=&$ward_obj->getAllWardsItemsObject($items);
$ward_count=$ward_obj->LastRecordCount();

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle', $LDTransferPatient);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 
  # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/inpatient_transfer_select.html"); 
 # href for close button
 $smarty->assign('breakfile',"javascript:window.close();");

 # OnLoad Javascript code
 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus();"');

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTransferPatient);

 # Hide Copyright footer
 $smarty->assign('bHideCopyright',TRUE);

 # Collect extra javascript code

 ob_start();
?>
<script language="javascript">
<!-- 
var urlholder;

function TransferWard(wd){
<?php
echo '
urlholder="nursing-ward-transfer-save.php?mode=transferward&sid='.$sid.'&lang='.$lang.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn='.$pn.'&station='.$station.'&ward_nr='.$ward_nr.'&trwd="+wd;
';
?>
window.opener.location.replace(urlholder);
window.close();
}
// -->
</script>

<?php

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>
<table border=0>
  <tr>
    
    <td class="prompt"><?php 	echo $LDWhereToTransfer; ?></td>
  </tr>
</table>

 <table border=0 cellpadding=4 cellspacing=1 width=100%>
	<form method="post" name="transbed" action="nursing-ward-assignwaiting.php"> 
	<tr>
    <td colspan=2 bgcolor="#f6f6f6"><?php 	echo $LDTransferToBed.' ('.$station.')'; ?></td>
    <td bgcolor="#f6f6f6">
<input type="submit" value="<?php echo $LDShowBeds; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="pn" value="<?php echo $pn; ?>">
<input type="hidden" name="ward_nr" value="<?php echo $ward_nr; ?>">
<input type="hidden" name="station" value="<?php echo $station; ?>">
<input type="hidden" name="pat_station" value="<?php echo $station; ?>">
<input type="hidden" name="transfer" value="1">

	</td>
  </tr>
</form>  
<tr>
    <td colspan=3>&nbsp;</td>
  </tr>
  <tr bgcolor="#f6f6f6">
    <td colspan=3><?php echo $LDTransferToWard; ?></td>
  </tr>

<?php

while($ward=$ward_info->FetchRow()){
	if($ward['nr']==$ward_nr) continue;
	echo '<tr bgcolor="#f6f6f6"><td>'.$ward['ward_id'].'</td>
	 <td>'.$ward['name'].'</td>
	 <td><a href="javascript:TransferWard(\''.$ward['nr'].'\')"><img '.createLDImgSrc($root_path,'transfer_sm.gif','0').'></a></td></tr>';
}

?>
</table>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the page output to the mainframe center block

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

 ?>