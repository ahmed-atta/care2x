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


<form ENCTYPE="multipart/form-data" action="bitte-rep-weiter.php" method="post" > 
<table align="center"  cellpadding="20" bgcolor=#ffffcc  border="1">
<tr>
<td>
<FONT    SIZE=-1  FACE="Arial">

Abteilung, wo die Reparatur gemacht werden muﬂ:<p>
<select name="abteilung" size=5 >
<option value="">bitte hier bl‰ttern und Abteilung anklicken...</option>
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
<p>Bitte beschreiben Sie hier die Sch‰den oder die Reparaturarbeit, die Sie
anfordern.
<TEXTAREA NAME="damage" Content-Type="text/html"
	COLS="60" ROWS="10"></TEXTAREA>
<p>
</td>
</tr>

</table>
<p>
<center>
<input type="submit" name="versand" value="Anforderung schicken"  >  
<input type="reset" value="Eingabe verwerfen und neu eingeben" >
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
<a href="ucons.php"> Reparatur anmelden</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php">Fragen an der Technik</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="ucons.php"> Technische Informationen</a><br>
</FONT>


</BODY>
</HTML>