<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
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
<? if($lang=="de") print '... wird noch weiter ausgebaut.'; else print 'We are working on it. Please be patient.';
?>

<form>
<input type="button" value=" OK " onClick="javascript:window.history.back()">
</form>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
