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

require_once($root_path.'include/care_api_classes/class_ward.php');
## Load all wards info 
$ward_obj=new Ward;
$items='nr,ward_id,name';
$ward_info=&$ward_obj->getAllWardsItemsObject($items);
$ward_count=$ward_obj->LastRecordCount();
?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $LDTransferPatient ?></TITLE>

<script language="javascript">
<!-- 
var urlholder;

function TransferWard(wd){
<?php
echo '
urlholder="nursing-station-transfer-save.php?mode=transferward&sid='.$sid.'&lang='.$lang.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn='.$pn.'&station='.$station.'&ward_nr='.$ward_nr.'&trwd="+wd;
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
    <td>&nbsp;
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $element ?>','','','<?php echo $title ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>

<table border=0>
  <tr>
    <td><img <?php 	echo createMascot($root_path,'mascot2_r.gif','0'); ?>></td>
    <td><FONT SIZE=3  FACE="Arial"><?php 	echo $LDWhereToTransfer; ?></td>
  </tr>
</table>

 <table border=0 cellpadding=4 cellspacing=1 width=100%>
	<form method="post" name="transbed" action="nursing-station-assignwaiting.php"> 
	<tr>
    <td colspan=2 bgcolor="#f6f6f6"><FONT SIZE=3  FACE="Arial" color="maroon"><?php 	echo $LDTransferToBed.' ('.$station.')'; ?></td>
    <td bgcolor="#f6f6f6"><FONT SIZE=3  FACE="Arial">

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
    <td colspan=3><FONT SIZE=3  FACE="Arial" color="maroon"><?php echo $LDTransferToWard; ?></td>
  </tr>
  

<?php
while($ward=$ward_info->FetchRow()){
	if($ward['nr']==$ward_nr) continue;
	echo '<tr bgcolor="#f6f6f6"><td><FONT SIZE=2  FACE="Arial">'.$ward['ward_id'].'</td>
	 <td><FONT SIZE=2  FACE="Arial">'.$ward['name'].'</td>
	 <td><a href="javascript:TransferWard(\''.$ward['nr'].'\')"><img '.createLDImgSrc($root_path,'transfer_sm.gif','0').'></a></td></tr>';
}
?>
	
  
</table>
</BODY>

</HTML>
