<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","lab.php");
$local_user="ck_lab_user";
require("../include/inc_front_chain_lang.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</HEAD>

<BODY bgcolor="#ffffff">
<P><br>

<img src="../img/catr.gif" border=0 width=88 height=80 align="left">
<font face=verdana,arial size=5 color=maroon><?php echo "$LDNoLabReport ".ucfirst($ln).", ".ucfirst($fn) ?>.<br> (<?php echo "$LDCaseNr $patnum" ?>)
<p><br>
<a href="labor_data_patient_such.php?sid=<?php echo "$sid&lang=$lang&keyword=$patnum&search=1" ?>">
<img src="../img/<?php echo "$lang/$lang" ?>_back2.gif" border=0>
</a><p>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
