<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='startframe.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND.'&target=currency_admin';
$thisfile=basename(__FILE__);

$GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Save data if save mode
if(isset($mode)&&$mode=='save'){
	$glob_obj->saveConfigArray($HTTP_POST_VARS,'pagin_',TRUE,20);
	header("location:$thisfile".URL_REDIRECT_APPEND."&save_ok=1");
	exit;
# Else get current global data
}else{ 
	$glob_obj->getConfig('pagin_%');
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php 
echo setCharSet(); 
?>
<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?> 

 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['body_bgcolor'];?>>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo $LDPaginatorMaxRows ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<br>
<ul>
<FONT    SIZE=2  FACE="verdana,Arial">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
</FONT><FONT    SIZE=3 color=#800000 FACE="Arial"><p>
<?php
if(isset($save_ok)&&$save_ok) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>'.$LDDataSaved.'<p>';

echo $LDEnterMaxRows;
?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<form action="<?php echo $thisfile ?>" method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>  
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDAddressList</b><br><font color=#000000>$LDAddressListTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_address_list_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_address_list_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDAddressSearch</b><br><font color=#000000>$LDAddressSearchTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_address_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_address_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDInsuranceList</b><br><font color=#000000>$LDInsuranceListTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_insurance_list_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_insurance_list_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDInsuranceSearch</b><br><font color=#000000>$LDInsuranceSearchTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_insurance_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_insurance_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDPersonnelList</b><br><font color=#000000>$LDPersonnelListTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_personell_list_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_personell_list_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDPersonnelSearch</b><br><font color=#000000>$LDPersonnelSearchTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_personell_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_personell_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDPersonSearch</b><br><font color=#000000>$LDPersonSearchTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_person_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_person_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDPatientSearch</b><br><font color=#000000>$LDPatientSearchTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_patient_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_patient_search_max_block_rows'] ?>">
      </td>  
	</tr>
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><?php echo "<b>$LDORPatientSearch</b><br><font color=#000000>$LDORPatientSearchTxt</font><br>" ?></FONT></td>
	<td bgcolor="#f9f9f9"><input type="text" name="pagin_or_patient_search_max_block_rows" size=2 maxlength=2 value="<?php echo $GLOBAL_CONFIG['pagin_or_patient_search_max_block_rows'] ?>">
      </td>  
	</tr>
</table>
<p>
<?php if($item_no) $save_button='update.gif'; else $save_button='savedisc.gif'; ?>
<input type="image" <?php echo createLDImgSrc($root_path,$save_button,'0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<?php if($item_no) : ?>
<a href="<?php echo $thisfile.''.URL_APPEND.'&from='.$from ?>"><img <?php echo createLDImgSrc($root_path,'newcurrency.gif','0') ?>></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
</form>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
