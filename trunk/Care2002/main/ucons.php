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
if(!$lang)
	if(!$HTTP_COOKIE_VARS["ck_lang"]) include("../chklang.php");
		else $lang=$HTTP_COOKIE_VARS["ck_lang"];
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</HEAD>
<BODY bgcolor="#ffffff">
<P><br>
<img src="../img/catr.gif" border=0 width=88 height=80 align="left">
<font face=verdana,arial size=5 color=maroon>
<?php if($lang=="de") print '... wird noch weiter ausgebaut.'; else print 'We are working on it. Please be patient.';
?>
<form>
<input type="button" value=" OK " onClick="javascript:window.history.back()">
</form>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</FONT>
</BODY>
</HTML>
