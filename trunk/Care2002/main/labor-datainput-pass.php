<?php  if (($username=="bong")&&($keyword=="bobong")) {header("Location: m4a-main.php"); exit;}
			else {$passtag="wrong";};
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Labor</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">


<FONT    SIZE=-1  FACE="Arial">

<P>


<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>Labor - Laborwerte eingeben</STRONG></FONT>



</td>
</tr>
<tr>
<td >


<p><br>
<center>


<?php if (($username!="")or($keyword!='')&&($passtag=="wrong")) : ?>

<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>Sorry, aber Ihre Eingaben sind falsch.
Versuchen Sie es noch ein mal.</STRONG></FONT><P>
<?php endif; ?>

<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffaa">
<p><br>
<FORM action="labor-datainput-pass.php" method="post">
<INPUT type="hidden" name="usernum" value="861661832">
<INPUT type="hidden" name="cpv" value="1">
<font face="Arial,Verdana"  color="#000000" size=-1>
Benutzername eingeben:<br>
<INPUT type="text" name="username" size="14" maxlength="25"> <p>
Kennwort eingeben:<br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<INPUT type="submit" name="versand" value="Abschicken"></font></FORM>

<FORM action="labor.htm" >
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
<img <?php echo createComIcon('../','varrow.gif','0') ?>><a href="ucons.php<?php echo "?lang=$lang" ?>">Laborstandards</a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>><a href="ucons.php<?php echo "?lang=$lang" ?>">Nachrichten</a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>><a href="ucons.php<?php echo "?lang=$lang" ?>">Rundbrief</a><br>
<HR>


</FONT>


</BODY>
</HTML>