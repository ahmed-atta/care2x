<?php  if (($username=="bong")&&($keyword=="bobong")) {header("Location: op-doku-start.php"); exit;}
			else {$passtag="wrong";};
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>OP Dokumentation</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">


<FONT    SIZE=-1  FACE="Arial">

<P>


<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>OP Logbuch</STRONG></FONT>



</td>
</tr>
<tr>
<td >


<p><br>
<center>


<?php if (($username!="")or($keyword!="")&&($passtag=="wrong")) : ?>

<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>Sorry, aber Ihre Eingaben sind falsch.
Versuchen Sie es noch ein mal.</STRONG></FONT><P>
<?php endif; ?>

<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffaa">
<p><br>
<FORM action="op-doku-logbuch-pass.php" method="post">
<INPUT type="hidden" name="usernum" value="861661832">
<INPUT type="hidden" name="cpv" value="1">
<font face="Arial,Verdana"  color="#000000" size=-1>
Benutzername eingeben:<br>
<INPUT type="text" name="username" size="14" maxlength="25"> <p>
Kennwort eingeben:<br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<INPUT type="submit" name="versand" value="Abschicken"></font></FORM>

<FORM action="op-doku.htm" >
<INPUT type="submit"  value="Abbrechen"></font></FORM>

</center>

</td>
</tr>
</table>        

<p><br>

</td>
</tr>
</table>        

<p>
<hr>
<p>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>">Einführung in das OP Logbuch</a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>">Wie mache ich was mit OP Logbuch?</a><br>
<HR>


</FONT>


</BODY>
</HTML>