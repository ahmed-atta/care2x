<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('prompt.php');
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_department.php');
## Load all wards info 
$dept_obj=new Department;
$allmed=&$dept_obj->getAllMedical();
$dept_count=$dept_obj->LastRecordCount();
?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $LDTransferPatient ?></TITLE>

<script language="javascript">
<!-- 
var urlholder;

function TransferDept(dn){
<?php
echo '
urlholder="amb_clinic_transfer_save.php?mode=transferdept&sid='.$sid.'&lang='.$lang.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn='.$pn.'&station='.$station.'&dept_nr='.$dept_nr.'&tgt_nr="+dn;
';
?>
window.opener.location.replace(urlholder);
window.close();
}
// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  bgcolor="#99ccff" TEXT="#000000" LINK="#0000FF" VLINK="#800080"  topmargin="0" marginheight="0" onLoad="if (window.focus) window.focus()" >
<table border=0 width="100%">
  <tr>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $element ?>','','','<?php echo $title ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
  </tr>
</table>

<table border=0>
  <tr>
    <td><img <?php 	echo createMascot($root_path,'mascot2_r.gif','0'); ?>></td>
    <td><FONT SIZE=3  FACE="Arial"><?php 	echo $LDWhereToTransfer; ?></td>
  </tr>
</table>

 <table border=0 cellpadding=2 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td colspan=2>&nbsp;<FONT SIZE=3  FACE="Arial" color="maroon"><?php echo $LDTransferClinic; ?></td>
  </tr>
  

<?php
# Note: the $allmed is an array
while(list($x,$v)=each($allmed)){
	if($v['nr']==$dept_nr) continue;
	echo '<tr bgcolor="#f6f6f6"><td><FONT SIZE=2  FACE="Arial">&nbsp;<FONT SIZE=2  FACE="Arial">';
	 if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
	 	else echo $v['name_formal'];
	echo'
	 </td>
	 <td><a href="javascript:TransferDept(\''.$v['nr'].'\')"><img '.createLDImgSrc($root_path,'transfer_sm.gif','0').' alt="'.$LDClkTransfer.'"></a></td>
	 </tr>';
}
?>
	
  
</table>
</BODY>

</HTML>
