<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Apotheke</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">



<table width=100% border=1 cellpadding="5">
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>Apotheke - Bestellung</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>
 
<FONT    SIZE=4  FACE="Arial" color=red>
<img src="../img/varrow.gif" width="20" height="15">
<b>Eine Apothekenbestellung</b></FONT><p>



<?
$mailtext="Ein Bestellkorb ist eingegangen. \n\n";
$mailtext .= "Datum: $datesent \n";
$mailtext .= "Uhrzeit: $timesent \n";
$mailtext .= "Abteilung: $abteilung \n";
$mailtext .= "Absender: $username \n";
$mailtext .= "Arzt: $docname \n";
//mail("elpidio@latorilla.com","Bestellkorb abgeschickt",$mailtext,"");
?>


<FONT    SIZE=2  FACE="Arial" >

<?
print("<hr> <font color=red ><b>Ein Bestellkorb ist eingegangen.</b> <p>");
print("Datum:</font> $datesent <br>");
print("<font color=red >Uhrzeit:</font> $timesent <br>");
print("<font color=red >Abteilung:</font> $abteilung <br>");
print("<font color=red >Absender:</font> $username <br>");
print("<font color=red >Arzt:</font> $docname <br> <hr> <p>");
?>

</FONT>

<table align="center"  cellpadding="20" bgcolor=#ffffcc  border="1">
<tr>
<td>
<FONT    SIZE=3  FACE="Arial" >

Vielen Dank Herr/Frau <b><? print("$username") ?></b>. <p>
Ihre Bestellung wurde am <b><? print($datesent); ?></b> um <b><? print($timesent); ?></b> 
an der Apotheke empfangen.
</td>

</tr>


</table>
<p>
<center>

<FORM action="apotheke.htm" >
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
<p>
<HR>

<FONT    SIZE=1  FACE="Arial">
Copyright &copy; 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts used here for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>

</BODY>
</HTML>