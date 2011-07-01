<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org,
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='prompt.php';
$lang_tables[]='departments.php';
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_department.php');
## Load all wards info
$dept_obj=new Department;
$allmed=&$dept_obj->getAllMedical();
$dept_count=$dept_obj->LastRecordCount();

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 extract($_GET);

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle', $LDTransferPatient);

  # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('outpatient_transfer.php','Outpatient Clinic :: Transfer')");

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

function TransferDept(dn,rm){
<?php
echo '
urlholder="amb_clinic_transfer_save.php?mode=transferdept&sid='.$sid.'&lang='.$lang.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn='.$pn.'&station='.$station.'&dept_nr='.$dept_nr.'&room="+rm+"&tgt_nr="+dn;
';
?>
window.opener.location.replace(urlholder);
window.close();
}
// -->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
#fliper:hover{background-color:yellow !important;}
b{color:darkgreen;}
</style>

<?php


# load config options
include_once($root_path.'include/care_api_classes/class_multi.php');
$cd_obj = new multi;
$vct = $cd_obj->__genNumbers();


$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<table border=0>
  <tr>
    <td><img <?php 	echo createMascot($root_path,'mascot2_r.gif','0'); ?>></td>
    <td><FONT class="warnprompt"><?php 	echo $LDWhereToTransfer; ?></td>
  </tr>
</table>

 <table border=0 cellpadding=2 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td colspan=2>&nbsp;<FONT class="prompt"><?php echo ($vct[8]!=2)? $LDTransferClinic : $LDTransferClinicRoom; ?></td>
  </tr>

<?php

# Generate the rows of departments and transfer links

# Note: the $allmed is an array
if ($vct[8]!=2){
	while(list($x,$v)=each($allmed)){
		if($v['nr']==$dept_nr) continue;
		echo '<tr bgcolor="#f6f6f6" id="fliper"><td width="80%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>';
		 if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
		 	else echo $v['name_formal'];
		echo'</b>
		 </td>
		 <td width="20%"><a href="javascript:TransferDept(\''.$v['nr'].'\',\''.$LDTransferGeneralRoom.'\')"><img '.createLDImgSrc($root_path,'transfer_sm.gif','0').' alt="'.$LDClkTransfer.'"></a></td>
		 </tr>';
	}
} else {
	while(list($x,$v)=each($allmed)){

		$hm = $cd_obj->GetRoomsAssigned($v['nr']);

		if ($hm->RecordCount()==0){
			if($v['nr']==$dept_nr) continue;

			echo '<tr bgcolor="#f6f6f6" id="fliper"><td colspan=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>';
			 if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
			 	else echo $v['name_formal'];
			echo'</b>
			 </td>
			 </tr>';

				echo '<tr id="fliper"><td width="80%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &mdash;&raquo;
							'.$LDTransferGeneralRoom.'
						 </td>
						 <td width="20%"><a href="javascript:TransferDept(\''.$v['nr'].'\',\''.$LDTransferGeneralRoom.'\')"><img '.createLDImgSrc($root_path,'transfer_sm.gif','0').' alt="'.$LDClkTransfer.'"></a></td>
					  </tr>';

		}else {
			# has no room specified
			echo '<tr bgcolor="#f6f6f6" id="fliper"><td colspan=2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>';
			 if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
			 	else echo $v['name_formal'];
			echo'</b>
			 </td>
			 </tr>';

			# START WITH GENERAL LIST
			# if (($cur_room!='GENERAL') && ($cur_room!='General Room'))
			echo '<tr id="fliper"><td width="80%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &mdash;&raquo;
						'.$LDTransferGeneralRoom.'
					 </td>
					 <td width="20%"><a href="javascript:TransferDept(\''.$v['nr'].'\',\''.$LDTransferGeneralRoom.'\')"><img '.createLDImgSrc($root_path,'transfer_sm.gif','0').' alt="'.$LDClkTransfer.'"></a></td>
				  </tr>';

			 # get all room lists
			while($rm = $hm->fetchRow()){
				if(($v['nr']==$dept_nr) && ($rm[0]==$cur_room)) continue;

				echo '<tr id="fliper"><td width="80%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &mdash;&raquo;
							'.$rm[0].'
						 </td>
						 <td width="20%"><a href="javascript:TransferDept(\''.$v['nr'].'\',\''.$rm[0].'\')"><img '.createLDImgSrc($root_path,'transfer_sm.gif','0').' alt="'.$LDClkTransfer.'"></a></td>
					  </tr>';
			}
		}
	}
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
 $smarty->display('common/mainframe.tpl');

 ?>
