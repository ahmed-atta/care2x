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
<b>Eine Reparaturarbeit melden</b></FONT> <font size="2" face="arial">
(Bitte melden Sie hier nur die Reparaturarbeit an, die erledigt ist.)</font><p>


<form ENCTYPE="multipart/form-data" action="technik-reparatur-melden-empfang.php" method="post" > 
<table align="center"  cellpadding="20" bgcolor=#ffffcc  border="1">
<tr>
<td>
<FONT    SIZE=-1  FACE="Arial">

Abteilung, wo die Reparatur gemacht wurde:<p>
<select name="abteilung" size=5 >
<option value="">bitte hier blättern und Abteilung anklicken...</option>
<option value="op1">OP 1</option>
<option value="op2">OP 2</option>
<option value="op3">OP 3</option>
<option value="op4">OP 4</option>
<option value="op5">OP 5</option>
<option value="op6">OP 6</option>
<option value="op7">OP 7</option>
<option value="op8">OP 8</option>
<option value="op9">OP 9</option>
<option value="op10">OP 10</option>
<option value="op11">OP 11</option>
<option value="op12">OP 12</option>
<option value="op13">OP 13</option>
<option value="p3a">P3 a</option>
<option value="p3b">P3 b</option>
<option value="m6a">M6 a</option>
<option value="m6b">M6 b</option>
<option value="m8a">M8 a</option>
<option value="m8b">M8 b</option>
</select><p>
</td>

<td><FONT    SIZE=-1  FACE="Arial">
<?
$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
?>

<input type="hidden" name="datesent" value="<? print ($datum) ?>" >
<input type="hidden" name="timesent" value= "<? print ($zeit) ?>">


<? echo strftime("%d.%m.%Y"); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<FONT color=red> <? echo strftime("%H.%M.%S"); ?></FONT><p> 
Benutzername des Anmelders:<br><input type="text" name="username" size=20 > <p>
Kennwort des Anmelders:<br><input type="password" name="keyword" size="20">
</td>
</tr>
<tr>
<td colspan=2><FONT    SIZE=-1  FACE="Arial">
<p>Bitte beschreiben Sie hier die Art der Reparatur die Sie
gemacht haben.
<TEXTAREA NAME="damage" Content-Type="text/html"
	COLS="60" ROWS="10"></TEXTAREA>
<p>
</td>
</tr>

</table>
<p>
<center>
<input type="submit" name="versand" value="Verschicken"  >  
<input type="reset" value="Eingabe verwerfen und Neues eingeben" >
</form>

<FORM action="technik.htm" >
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