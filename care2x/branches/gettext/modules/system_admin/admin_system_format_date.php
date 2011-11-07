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
define('MODULE','system_admin');
define('LANG_FILE_MODULAR','system_admin.php');
$local_user='ck_admin_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

$breakfile='admin_system-admi-welcome.php'.URL_APPEND;
$thisfile=basename(__FILE__);

if(!isset($mode)) $mode='';
if(!isset($date_format)) $date_format='';
if(!isset($validator)) $validator='';

$dbtable='care_config_global'; // Table name for global configurations
$GLOBAL_CONFIG=array();

$new_date_ok=0;

# Create global config object
require_once($root_path.'include/core/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	
if(($mode=='save')&&($date_format!='')&&(stristr($date_format,$validator))){  
	  $new_date_ok=$glob_obj->saveConfigItem('date_format',$date_format);
}else{
	if($glob_obj->getConfig('date_format')) $date_format=$GLOBAL_CONFIG['date_format'];
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once(CARE_BASE.'/include/helpers/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDDate);
$smarty->assign('LDBack', $LDBack);
 $smarty->assign('LDHelp', $LDHelp);
 $smarty->assign('LDClose', $LDClose);
 # href for help button
$smarty->assign('pbHelp',CARE_GUI . "modules/" . MODULE . "/help/" . $lang . "/date_format_set.html"); 
 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDDate);

 # Buffer page output
 
 ob_start();

?>
<ul>
<FONT  SIZE=+2>
<?php echo $LDSetDateFormat ?> </FONT><FONT class="prompt"><p>
<?php
if(($mode=='save')&&$new_date_ok) echo ' '.$LDNewDateFormatSaved.'<p>';
echo $LDSelectDateFormat;
?>
</font>

<form action="<?php echo $thisfile ?>" method="get">
<table border=0 cellspacing=1 cellpadding=5>  
<?php 
for($i=0;$i<sizeof($LDDateFormats);$i++)
{
  echo '<tr>
    <td bgcolor="#e9e9e9"><input type="radio" name="date_format" value="'.$LDDateFormats[$i].'"';
  if($date_format==$LDDateFormats[$i]) echo " checked";
  echo '></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc"><b>';
  $dfbuffer="LD_".strtr($LDDateFormats[$i],".-/","phs");
  echo $$dfbuffer;
  echo '</b> </FONT></td>
	<td>'.$LDDateFormatsTxt[$i].'<br></td>
	</tr>';
}
?>
</table>
<p>
<input type="image" <?php echo createLDImgSrc($root_path,'apply.gif','0') ?>>&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>" class="button icon remove danger">Cancel</a>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="validator" value="<?php for($i=0;$i<sizeof($LDDateFormats);$i++) echo $LDDateFormats[$i]."_"; ?>">
</form>

</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display(CARE_BASE . 'main/view/mainframe.tpl');

?>