<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Technik - Technische Dienste</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">



<table width=100% border=1 cellpadding="5">
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>Technik - Technische Dienste</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>
 
<FONT    SIZE=4  FACE="Arial" color=red>
<img src="../img/varrow.gif" width="20" height="15">
<b>Eine Reparaturarbeit anfordern</b></FONT><p>

<?
$mailtext="Eine Anforderung für eine Reparaturarbeit ist eingegangen. \n\n";
$mailtext .= "Datum: $datesent \n";
$mailtext .= "Uhrzeit: $timesent \n";
$mailtext .= "Abteilung: $abteilung \n";
$mailtext .= "Absender: $username \n";
$mailtext .= "Beschreibung: \n\n $damage \n";
mail("elpidio@latorilla.com","Reparaturanforderung",$mailtext,"");
?>

<FONT    SIZE=2  FACE="Arial" >

<?
print("<hr> <font color=red ><b>Eine Anforderung für eine Reparaturarbeit ist eingegangen.</b> <p>");
print("Datum:</font> $datesent <br>");
print("<font color=red >Uhrzeit:</font> $timesent <br>");
print("<font color=red >Abteilung:</font> $abteilung <br>");
print("<font color=red >Absender:</font> $username <br>");
print("<font color=red >Beschreibung:</font> <br> $damage <hr><p> ");
?>

</FONT>

<table align="center"  cellpadding="20" bgcolor=#ffffcc  border="1">
<tr>
<td>
<FONT    SIZE=3  FACE="Arial" >

Vielen Dank Herr/Frau <b><? print("$username") ?></b>. <p>
Ihre Anforderung wurde am <b><? print($datesent); ?></b> um <b><? print($timesent); ?></b> 
an der technischen Abteilung empfangen.
</td>

</tr>


</table>
<p>
<center>
<input type="submit" name="versand" value="Anforderung schicken"  >  
<input type="reset" value="Eingabe verwerfen und neu eingeben" >
</form>

<FORM action="technik.htm" >
<INPUT type="submit"  value="  OK  "></font></FORM>

</center>


</FONT>
<p>
</td>
</tr>
</table>        
<p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php"> Reparatur anmelden</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php">An die Technik oft gestellte Fragen (FAQ)</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php">Neue Frage an die Technik stellen</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php"> Technische Informationen selber suchen.</a><br>
</FONT>


</BODY>
</HTML>