<? if ($route!="validroute") {header("Location: invalid-access-warning.htm"); exit;}; ?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Apotheke - Bestellung</TITLE>
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
<b>Den Bestellkorb an die Apotheke abschicken</b></FONT> <font size="2" face="arial">
</font><p>

<?
$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");

?>

<form ENCTYPE="multipart/form-data" action="apotheke-bestellung-korb-schicken-empfang.php" method="post" > 

<table align="center"  cellpadding="15" bgcolor=#ffffcc  border="1" >
<tr>
<td colspan="2"> 
<FONT    SIZE=-1  FACE="Arial">
<? echo strftime("%d.%m.%Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<FONT color=red> <? echo strftime("%H.%M.%S"); ?></FONT>
</td>
</tr>

<tr >
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<p >Der Inhalt Ihres Bestellkorbes:

<table border="0" cellpadding="5" width=100%>
<tr>
<td bgcolor=#cecece>Artikel
</td>
<td bgcolor="#cecece">Menge
</td>
<td bgcolor=#cecece>Einheit
</td>
</tr>

<tr>
<td>Jelonet (5 x 7)
</td>
<td>1
</td>
<td>Packung (10 Stück)
</td>
</tr>

<tr>
<td>Xylocain 2% 1:200.000
</td>
<td>1
</td>
<td>Packung (10 stück)
</td>
</tr>
</table>

<p>
</td>
</tr>

<tr>
<td>
<FONT    SIZE=-1  FACE="Arial">
<input type="hidden" name="datesent" value="<? print ($datum) ?>" >
<input type="hidden" name="timesent" value= "<? print ($zeit) ?>">
<input type="hidden" name="abteilung" value= "p3a">
Benutzername des Bestellers:<br><input type="text" name="username" size=20 > <p>
Kennwort des Bestellers:<br><input type="password" name="userkeyword" size="20">

</td>

<td><FONT    SIZE=-1  FACE="Arial">
Benutzername des Arztes:<br><input type="text" name="docname" size=20 > <p>
Kennwort des Arztes:<br><input type="password" name="cockeyword" size="20">
</td>
</tr>
<p>
</table>
<p>
<center>
<input type="submit" name="versand" value="Abschicken"  >  
<input type="reset" value="Eingabe verwerfen und Neues eingeben" >
</form>

<FORM action="apotheke.htm" >
<INPUT type="submit"  value="Abbrechen"></font></FORM>

</center>


</FONT>
<p>
</td>
</tr>
</table>        
<p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php"> Eine Reparaturarbeit anfordern</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php">Fragen an der Technik</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php"> Technische Informationen</a><br>
</FONT>
<p>
<hr>

<FONT    SIZE=1  FACE="Arial">
Copyright &copy; 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts used here for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>

</BODY>
</HTML>