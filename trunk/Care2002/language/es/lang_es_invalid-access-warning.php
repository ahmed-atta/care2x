<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Invalid Access Warning</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Unauthorized Page Access</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>You have no access rights to open this document!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
Probable causes of this problem:
</FONT><p>
<font size=2 face="verdana,arial">
<img src="../../img/achtung.gif" width=18 height=23 border=0>
You might have used the standard "Back" or "Forward" function of your browser. Avoid using these buttons.<br>
<img src="../../img/achtung.gif" width=18 height=23 border=0>
You might have rejected a cookie. The program is dependent on cookies to operate properly. So please accept the
cookies.
<br>
<img src="../../img/achtung.gif" width=18 height=23 border=0>
Your browser might not be accepting cookies. Please set up your browser to accept cookies automatically.
<br>
<img src="../../img/achtung.gif" width=18 height=23 border=0>
Your browser might not be able to run javascript or the javascript might be disabled. Please enable the javascript in your browser.
<br>
<img src="../../img/achtung.gif" width=18 height=23 border=0>
In rare cases there might have been an error in the data transfer. To correct the situation just click the
"reload" button of your browser.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
$path_root="../../";
require("../Copy%20of%20en/en_copyrite.php"); 
?>
</FONT>


</BODY>
</HTML>
