<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_lab_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_lab.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</HEAD>

<BODY bgcolor="#ffffff">
<P><br>

<img src="../img/catr.gif" border=0 width=88 height=80 align="left">
<font face=verdana,arial size=5 color=maroon><?="$LDNoLabReport ".ucfirst($ln).", ".ucfirst($fn) ?>.<br> (<?="$LDCaseNr $patnum" ?>)
<p><br>
<a href="labor_data_patient_such.php?sid=<?="$ck_sid&lang=$lang&keyword=$patnum&search=1" ?>">
<img src="../img/<?="$lang/$lang" ?>_back2.gif" border=0>
</a><p>
<?php
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
