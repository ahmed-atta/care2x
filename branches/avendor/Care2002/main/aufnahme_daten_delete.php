<? 

if (($route!=validroute)or($aufnahme_user==""))
{header("Location: invalid-access-warning.php"); exit;}

$dbhost="localhost";
$dbusername="httpd";
$dbpassword="";
$dbname="maho";
$dbtable="mahopatient";
$forwardfile="aufnahme_list.php";
$breakfile="aufnahme_list.php";
$thisfile="aufnahme_daten_delete.php";


$fieldnames=array("no.","Pat.nummer","Anrede","Name","Vorname","Geburstdatum");



				$link=mysql_connect($dbhost,$dbusername,$dbpassword);
				if ($link)
 				{ if(mysql_select_db($dbname,$link)) 
					{
						if ($finalcommand=="delete")
								{
									if($itemname!=$linecount)
									{		
									// first renumber the remaining data
										for ($i=$itemname+1;$i<=$linecount;$i++)
										{
											$sql='UPDATE '.$dbtable.' SET mahopatient_item="'.($i*10000).'" WHERE mahopatient_item="'.$i.'"';	
											if (!(mysql_query($sql,$link))) print $sql."  Vorbereitung der Daten zum Löschen ist gescheitert.";
										}
									// then delete the  data
										$sql='DELETE FROM '.$dbtable.' WHERE mahopatient_item="'.$itemname.'"';	
										if (!(mysql_query($sql,$link))) print $sql."  Das Löschen der Daten ist gescheitert.";

									// then correctly itemize the remaining data
										for ($i=$itemname+1;$i<=$linecount;$i++)
										{
											$sql='UPDATE '.$dbtable.' SET mahopatient_item="'.($i-1).'" WHERE mahopatient_item="'.($i*10000).'"';	
											if (!(mysql_query($sql,$link))) print $sql."  Vorbereitung der Daten zum Löschen ist gescheitert.";
										}	
										
									}else 									
										// if item is the last then simply delete the  data
										{
											$sql='DELETE FROM '.$dbtable.' WHERE mahopatient_item="'.$itemname.'"';	
											if (!(mysql_query($sql,$link))) print $sql."  Das Löschen der Daten ist gescheitert.";										
										}

									// check if the pagecount is reduced
									
									$buffer=($pagecount-1)*$displaysize;
									if (($buffer+1)==$linecount)
										 { $pagecount--; if($batchnum>1)  $batchnum--; };						
									$linecount--;
									header("Location: aufnahme_list.php?route=validroute&remark=itemdelete&batchnum=".$batchnum."&displaysize=".$displaysize."&linecount=".$linecount."&pagecount=".$pagecount); exit;
								}else 
									{
										$sql='SELECT * FROM '.$dbtable.' WHERE mahopatient_item="'.$itemname.'"';
										$ergebnis=mysql_query($sql,$link);
										if($ergebnis) $zeile=mysql_fetch_array($ergebnis); 
											else print "Das Lesen von Daten aus der Datenbank ist gescheitert.";
									}
						
	
					};
				mysql_close($link);
				}
				 else 
				{ print "Verbindung zur Datenbank konnte nicht hergestellt werden.<br>"; }


?>

<HTML>
<HEAD>
 <TITLE>EDV - Zugangsberechtigunge löschen</TITLE>
</HEAD>

<BODY BACKGROUND="leinwand.gif">


<FONT    SIZE=-1  FACE="Arial">

<img src=../img/phone.gif><FONT  COLOR=#cc6600  SIZE=9  FACE="verdana"> <b>aufnahme</b></font>

<table width=100% border=1>
<tr>
<td bgcolor="navy" >
<FONT  COLOR="white"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;Patientendaten löschen</STRONG></FONT>



</td>
</tr>
<tr>
<td bgcolor="#DDE1EC">


<p><br>
<center>


<table  border=1 cellpadding="20" >
<tr nowrap>
<td bgcolor="#ffffaa">
<p><FONT SIZE=2  FACE=Arial><img src="../img/exclaim.gif"><br>
Wollen Sie die folgende Patientendaten wirklich löschen?<p>

<table border="0" cellpadding="2" cellspacing="1">
<tr bgcolor=orange nowrap>
<?
	for($i=0;$i<(sizeof($fieldnames));$i++) 
 	{	
		if($zeile[$i]!="") 	
		print "<td nowrap><FONT color=#0000cc SIZE=2  FACE=Arial><b>".$fieldnames[$i]."</b></td>\n";
   	}

?>
</tr>
<tr bgcolor=#cecece nowrap>
<?
	for($i=0;$i<(sizeof($fieldnames));$i++) 
 	{	
		if($zeile[$i]!="") 	
		print "<td nowrap><FONT color=#000000 SIZE=2  FACE=Arial><nobr>".$zeile[$i]."</td>\n";
   	}

?>

</tr>

</table>

<br>
<FORM action="<? print $thisfile ?>" method="post">
<INPUT type="hidden" name="itemname" value="<? print $itemname ?>">
<input type=hidden name=finalcommand value="delete">
<input type=hidden name=route value="validroute">
<input type=hidden name=batchnum value="<? print $batchnum ?>">
<input type=hidden name=displaysize value="<? print $displaysize ?>">
<input type=hidden name=linecount value="<? print $linecount ?>">
<input type=hidden name=pagecount value="<? print $pagecount ?>">
<img src="../img/delete.gif"> <INPUT type="submit" name="versand" value="Ja, löschen"></font></FORM>

<FORM  method=post action="<?print $breakfile ?>" >
<input type=hidden name=route value="validroute">
<input type=hidden name=batchnum value="<? print $batchnum ?>">
<input type=hidden name=displaysize value="<? print $displaysize ?>">
<input type=hidden name=linecount value="<? print $linecount ?>">
<input type=hidden name=pagecount value="<? print $pagecount ?>">
<img src="../img/suspend.gif"> <INPUT type="submit"  value="Nein, Abbrechen"></font></FORM>

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
<img src="../img/varrow.gif" width="20" height="15"> <a href="edv-accessplan-wie.htm">Wie verwalte ich die Zugangsberechtigungen?</a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="edv-accessplan-werwo.htm">Wer hat wo Zugangsberechtigung?</a><br>
<HR>
<p>

<FONT    SIZE=1  FACE="Arial" color=gray>
Copyright &copy; 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts used here for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@latorilla.com>elpidio@latorilla.com</a>.
</FONT>


</FONT>


</BODY>
</HTML>