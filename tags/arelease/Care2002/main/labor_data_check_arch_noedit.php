<?
//setcookie(currentuser,"");
$thisfile="labor_data_patient_such.php";
$breakfile="labor.php";

$toggle=0;

$fieldname=array("Pat.nummer","Name","Vorname","Geburtsdatum");

$fielddata="patnum, name, vorname, gebdatum, item";

$keyword=trim($keyword);

require("../req/db_dbp.php");
$dbtable="lab_test_data";

	$link=mysql_connect($dbhost,$dbusername,$dbpassword);
	if ($link)
 	{ 

		if(mysql_select_db($dbname,$link)) 
		{
			$sql="SELECT job_id,encoding FROM $dbtable WHERE patnum='$patnum' ORDER BY job_id";

        	$ergebnis=mysql_query($sql,$link);
			$linecount=0;
			if($ergebnis)
       		{
				while ($zeile=mysql_fetch_array($ergebnis)) $linecount++;
				if ($linecount>0) 
				{ 		  
					
					mysql_data_seek($ergebnis,0);
				  	
				}
				else
				{
					mysql_close($link);
					header("location:pflege-station-patientdaten.php?sid=$ck_sid&station=$station&pn=$patnum&nodoc=labor");break;

				}
			}
			 else {print "<p>".$sql."<p>Das Lesen von Daten aus der Datenbank ist gescheitert.";};
		} else print " Tabelle konnte nicht ausgewählt werden.";
	  mysql_close($link);
	}
  	 else 
		{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }

?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Labor Check Archive</TITLE>
 <style type="text/css" name="1">
.va12_w{font-family:verdana,arial; font-size:12; color:#ffffff}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>

</HEAD>

<BODY BACKGROUND="leinwand.gif">

<img src=../img/micros.gif><FONT  COLOR=#cc6600  SIZE=9  FACE="verdana"> <b>Laborbefund</b></font>
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
<td valign=top><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

<?

print "<p>Fur die Fallnummer $patnum wurde <font color=red><b> $linecount</b></font> Laborbefund";
if($linecount>1) print "e";
print" gefunden.<br>Falls Sie ";
if($linecount>1) print "einen"; else print "diesen";
print " Befund bearbeiten möchten klicken Sie bitte den weiss-grünen Pfeil an.<p>";
				
					//	$abuf=array(); $last=array();
				
					print "<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor=#9f9f9f>";
					
						print'
						<td class="va12_w"><b>Auftragsnummer</b></td>
						<td class="va12_w"><b>Letzte Eingabe bzw. Aktualisierung am:</b></td>
					 <td class="va12_w">&nbsp;Um:</td>
					 <td class="va12_w">&nbsp;Von:</td>
					 </tr>';

					while($zeile=mysql_fetch_array($ergebnis))
					{
						$abuf=explode("~",$zeile[encoding]);	
						$abuf=array_pop($abuf);
						parse_str(trim($abuf),$last);
					print "<tr bgcolor=";
						if($toggle) { print "#dfdfdf>"; $toggle=0;} else {print "#ffffff>"; $toggle=1;};
	
							print'
							<td><font face=arial size=2>
							&nbsp;<a href=labor_datainput.php?&patnum='.$patnum.'&job_id='.$zeile[job_id].'>'.$zeile[job_id].'</a>
							</td>
							<td><font face=arial size=2>&nbsp;'.$last[d].'
							</td>
							<td><font face=arial size=2>&nbsp;'.$last[t].'
							</td>
							<td><font face=arial size=2>
							&nbsp;'.$last[e].'
							</td>';
						print'<td><font face=arial size=2>&nbsp';
					   print'<a href=labor_data_list_noedit.php?&patnum='.$patnum.'&job_id='.$zeile[job_id].'><img 
										src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0 alt="Laborwerte aktualisieren"></a>&nbsp;</td></tr>';

					}
					print "</table>";

?>
<p>
<hr width=80% align=left>
<FORM action="<? print $breakfile; ?>" >
<INPUT type="image" src=../img/abbrech.gif border=0>
</FORM>

<p>

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
Copyright © 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>



</FONT>


</BODY>
</HTML>
