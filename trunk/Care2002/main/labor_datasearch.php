<?php
//setcookie(currentuser,"");

$dbname="maho";
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
$dbtable='care_phone';

$breakfile="labor.php";

$toggle=0;

$fieldname=array("Name","Vorname","Telefon 1","Telefon 2","Telefon 3",
					"Funk 1","Funk 2","Privat 1",
					"Privat 2");
$fielddata="name, vorname, inphone1, inphone2,
			inphone3, funk1,
			funk2, exphone1, exphone2";

?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Laborwerte Abfrage</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">

<img src=../img/micros.gif><FONT  COLOR=#cc6600  SIZE=9  FACE="verdana"> <b>laborwerte</b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img src=../img/such-b.gif><a href="labor_datainput_pass.php"><img src=../img/einga-m.gif border=0></a></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>
<FONT  SIZE=1  FACE="Arial"><STRONG> &nbsp; </STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td ><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

<FORM action="telesuch.php" method="post">
<font face="Arial,Verdana"  color="#000000" size=-1>
<B>Stichwort eingeben. z.B. Name, Vorname, Geburstdatum, Fallnummer, Abteilung, oder Abkürzung u.s.w.</B><p>
<INPUT type="text" name="keyword" size="14" maxlength="25" value=<?php echo $keyword ?>> 
<INPUT type="submit" name="versand" value="SUCHEN"></font></FORM>

<p>
<FORM action="<?php echo $breakfile ?>" >
<INPUT type="submit"  value="Abbrechen"></FORM>
<p>

<?php 
if($versand!="")
  {
	$suchwort=trim($keyword);
	$link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' WHERE name LIKE "'.$suchwort.'%" OR vorname LIKE "'.$suchwort.'%"';
        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				echo "<hr width=80% align=left><p>Die Suche hat <font color=red><b>".$linecount."</b></font> Telefonnummer gefunden.<p>";
				if ($linecount>0) 
				{ 
					mysql_data_seek($ergebnis,0);
					echo "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=orange>";
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						echo"<td><font face=arial size=2><b>".$fieldname[$i]."</b></td>";
		
					}
					echo "</tr>";
					while($zeile=mysql_fetch_array($ergebnis))
					{
						echo "<tr bgcolor=";
						if($toggle) { echo "#cecece>"; $toggle=0;} else {echo "#ffffaa>"; $toggle=1;};
	
						for($i=0;$i<mysql_num_fields($ergebnis);$i++) 
						{
							echo"<td><font face=arial size=2>";
							if($zeile[$i]=="")echo "&nbsp;"; else echo $zeile[$i];
							echo "</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
					if($linecount>15)
					{
						echo '
						<p><font color=red><B>Neue Suche:</font>
						<FORM action="telesuch.php" method="post">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						Stichwort eingeben. z.B. Name oder Abteilung, u.s.w.</B><p>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value='.$keyword.'> 
						<INPUT type="submit" name="versand" value="SUCHEN"></font></FORM>
						<p>
						<FORM action="'.$breakfile.'" >
						<INPUT type="submit"  value="Abbrechen"></FORM>
						<p>';
					}
				}
			}
			 else {echo "<p>".$sql."<p>Das Lesen von Daten aus der Datenbank ist gescheitert.";};
		} else echo " Tabelle konnte nicht ausgewählt werden.";
	  mysql_close($link);
	}
  	 else 
		{ echo "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }

	
}

?>
<p>
<hr width=80% align=left><p>
<a href="telesuch_phonelist.php">Aktuelle Einträge im Telefonverzeichnis</a><br>
<a href="telesuch_edit_pass.php">Neue Telefondaten eintragen</a>
</ul>
&nbsp;
</FONT>
<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>

</table>        
<p>

<FONT    SIZE=1  FACE="Arial">
Copyright &copy; 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>



</FONT>


</BODY>
</HTML>