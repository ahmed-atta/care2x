<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Unerlaubter Zugriff</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Unerlaubter Zugriff</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Sie sind nicht berechtigt dieses Dokument zu öffnen!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>

<p>
<ul>
<font size=3 face="verdana,arial">
Mögliche Ursachen des Problems:
</FONT><p>
<font size=2 face="verdana,arial">
<img src="../../img/achtung.gif" width=18 height=23 border=0>
Sie hätten die "Zurück" oder "Vorwärts" Funktion des Browsers benutzt. Vermeiden Sie bitte diese Funktionen bzw. Knöpfe zu benutzen.<br>
<img src="../../img/achtung.gif" width=18 height=23 border=0>
Sie hätten eine Cookie abgelehnt. Dieses Program ist von Cookies abhängig um einwandfrei zu laufen. Nehmen Sie bitte
die Cookies an.
<br>
<img src="../../img/achtung.gif" width=18 height=23 border=0>
Ihr Browser nehme keine Cookies an. Stellen Sie bitte Ihren Browser zur automatischen Annahme von Cookies ein.
<br>
<img src="../../img/achtung.gif" width=18 height=23 border=0>
Ihr Browser würde Javascript nicht unterstützen oder das Javascript könnte ausgeschaltet sein. Schalten Sie bitte das
Javascript ein.<br>
<img src="../../img/achtung.gif" width=18 height=23 border=0>
In seltenen Fällen könnte die Datenübertragung gestört gewesen sein. Klicken Sie den "Aktualisieren" in Ihrem Browser an.
<p>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
$path_root="../../";
require("de_copyrite.php"); 
?>
</FONT>
</BODY>
</HTML>
