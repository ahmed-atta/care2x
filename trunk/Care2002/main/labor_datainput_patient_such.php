<?
//setcookie(currentuser,"");

$dbname="maho";
$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
$dbtable="mahopatient";
$thisfile="labor_datainput_patient_such.php";
$breakfile="labor.php";

$toggle=0;

$fieldname=array("Pat.nummer","Name","Vorname","Geburtsdatum");

$fielddata="mahopatient_patnum, mahopatient_name, mahopatient_vorname, mahopatient_gebdatum, mahopatient_item";

?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Labor Patientendaten Suchen</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">

<img src=../img/micros.gif><FONT  COLOR=#cc6600  SIZE=9  FACE="verdana"> <b>patientendaten suchen</b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img src=../img/such-b.gif></td>
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

<FORM action="<? print $thisfile; ?>" method="post">
<font face="Arial,Verdana"  color="#000000" size=-1>
<B>Stichwort eingeben. z.B. Name, Vorname, Geburtsdatum, oder Abkürzung u.s.w.</B></font><p>
<font size=3><INPUT type="text" name="keyword" size="14" maxlength="40" value=<? print $keyword ?>></font> 
<INPUT type="submit" name="versand" value="SUCHEN"></FORM>


<p>

<?

if(($versand!="")and($keyword))
  {
	$suchwort=trim($keyword);
	$link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
			if($suchwort<20000000) $suchbuffer=$suchwort+20000000; else $suchbuffer=$suchwort;
			$sql='SELECT '.$fielddata.' FROM '.$dbtable.' 
			WHERE mahopatient_name LIKE "'.$suchwort.'%" 
			OR mahopatient_vorname LIKE "'.$suchwort.'%"
			OR mahopatient_gebdatum LIKE "'.$suchwort.'%"
			OR mahopatient_patnum LIKE "'.$suchbuffer.'" 
			ORDER BY mahopatient_patnum';

        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				print "<hr width=80% align=left><p>Die Suche hat <font color=red><b>".$linecount."</b></font> Patientendaten gefunden.<p>";
				if ($linecount>0) 
				{ 
					mysql_data_seek($ergebnis,0);
					print "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=orange>";
					for($i=0;$i<sizeof($fieldname);$i++) 
					{
						print"<td><font face=arial size=2><b>".$fieldname[$i]."</b></td>";
		
					}
					 print"<td>&nbsp;</td></tr>";

					while($zeile=mysql_fetch_array($ergebnis))
					{
						print "<tr bgcolor=";
						if($toggle) { print "#cecece>"; $toggle=0;} else {print "#ffffaa>"; $toggle=1;};
	
						for($i=0;$i<mysql_num_fields($ergebnis)-1;$i++) 
						{
							print"<td><font face=arial size=2>";
							if($zeile[$i]=="")print "&nbsp;"; else print $zeile[$i];
							print "</td>";
						}
					    print'<td><font face=arial size=2>&nbsp;
							<a href=labor_datainput.php?route=validroute&from=such&itemname='.$zeile[mahopatient_item].'>
							<img src=../img/file_update.gif border=0 alt="Laborwerte diesem Patient eingeben"></a>&nbsp;</td></tr>';

					}
					print "</table>";
					if($linecount>15)
					{
						print '
						<p><font color=red><B>Neue Suche:</font>
						<FORM action="'.$thisfile.'" method="post">
						<font face="Arial,Verdana"  color="#000000" size=-1>
						Stichwort eingeben. z.B. Fallnummer, Name, Vorname, Geburtsdatum, oder Abkürzung u.s.w.</B><p>
						<INPUT type="text" name="keyword" size="14" maxlength="25" value='.$keyword.'> 
						<INPUT type="submit" name="versand" value="SUCHEN"></font></FORM>
						<p>';
					}
				}
			}
			 else {print "<p>".$sql."<p>Das Lesen von Daten aus der Datenbank ist gescheitert.";};
		} else print " Tabelle konnte nicht ausgewählt werden.";
	  mysql_close($link);
	}
  	 else 
		{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }

	
}

?>
<p>
<p>
<FORM action="<? print $breakfile; ?>" >
<INPUT type="submit"  value="Abbrechen">
</FORM>
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