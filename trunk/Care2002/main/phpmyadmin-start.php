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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once('../include/inc_front_chain_lang.php');
?>
<html>
<head>
<?php echo setCharSet(); ?>
<title></title>
</head>
<body>
<font size=3 face="verdana,arial" color="#990000">
<center>
<img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"><b><?php echo $LDMySQLManage ?></b><p>
<form action="../phpmyadmin/index.php3" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="submit" value="<?php echo $LDContinue ?>">
</form><p>
<form action="edv.php" method="post">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="target" value="sqldb">
<input type="submit" value="<?php echo $LDCancel ?>">
</form>
</font>
</body>
</html>
