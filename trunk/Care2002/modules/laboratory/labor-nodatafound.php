<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
</HEAD>

<BODY bgcolor="#ffffff">
<P><br>

<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="left">
<font face=verdana,arial size=5 color=maroon><?php echo "$LDNoLabReport ".ucfirst($ln).", ".ucfirst($fn) ?>.<br> (<?php echo "$LDCaseNr $patnum" ?>)
<p><br>
<a href="labor_data_patient_such.php?sid=<?php echo "$sid&lang=$lang&keyword=$patnum&search=1" ?>">
<img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>>
</a><p>
require($root_path.'include/inc_load_copyrite.php');

</FONT>


</BODY>
</HTML>
