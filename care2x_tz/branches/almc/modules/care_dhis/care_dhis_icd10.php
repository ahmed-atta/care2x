<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');

if ($_SERVER['REQUEST_METHOD'] == "POST"){
session_start();
	  
$_SESSION['dhis_dataelement'] = $_POST['dhis_element'];
$_SESSION['underAge'] = $_POST['under5'];
}
?>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top><td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;&nbsp;&nbsp;<?php print $LDheader; ?></STRONG></FONT></td>
</tr>
<form name="search" action="" method="get">
<tr><td valign="centre"><input type="text" name="search">
  <input type="submit" value="search"></td>
  <td>&nbsp;</td>
</tr>
</form>
<tr><td valign="top"><?php include('./gui/icd_element_gui.php'); ?></td></tr>
<tr>
  <td valign="top" bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10%"><strong><font color="#990066" size="4"></font></strong></td>
</tr>
</table>
