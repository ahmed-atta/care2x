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
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once('../include/inc_front_chain_lang.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
</HEAD>

<BODY bgcolor="#ffffff">
<P><br>

<img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="left">
<font face=verdana,arial size=5 color=maroon><?php echo "$LDNoLabReport ".ucfirst($ln).", ".ucfirst($fn) ?>.<br> (<?php echo "$LDCaseNr $patnum" ?>)
<p><br>
<a href="labor_data_patient_such.php?sid=<?php echo "$sid&lang=$lang&keyword=$patnum&search=1" ?>">
<img <?php echo createLDImgSrc('../','back2.gif','0') ?>>
</a><p>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
