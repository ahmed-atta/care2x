<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","radio.php");
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

$thisfile="radiolog-xray-diagnosis.php";
?>
<html>
<head>
<?php echo setCharSet(); ?>
</head>
<body>
<?php
require('../global_conf/inc_remoteservers_conf.php');

if($disc_pix_mode) $diagnosis=file($xray_diagnosis_localpath."thorax.txt");
	else $diagnosis=file($xray_diagnosis_server_http."thorax.txt");
	
while(list($x,$v)=each($diagnosis))
echo nl2br($v);

?><p>
<?php if ($mode!="preview") 
{
?>
<form action="radiolog-xray-diagnosis-write-pass.php">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="retpath" value="read_diagnosis">
<input type="submit" value="<?php echo $LDEditXrayDiag ?>">

</form>
<?php 
}
?>
</body>
</html>
