<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?
if($x2=="pharma") print "Apotheke - "; else print "Medicallager - ";
	switch($src)
	{
	case "input": print "Eingabe von neuen Produkten in die Datenbank";
					break;
	case "search": print "Suchen nach einem Produkt";
					break;
	case "mng": print "Verwaltung von Produkten in der Datenbank";
					break;
	case "delete": print "Entfernen von Produkten aus der Datenbank";
					break;
	case "report": print "Bericht";
					break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<? if($src=="input") : ?>
	<? if($x1=="") : ?>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie gebe ich ein neues Produkt in die Datenbank ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Gibt zuerst alle vorhandene Information �ber das Produkt in die entsprechende Eingabefelder ein.<br>
</ul>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie w�hle ich ein Bild f�r das Produkt aus?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Durchsuchen..."> Knopf am Feld "<span style="background-color:yellow" > Bilddatei </span>" an.<br>
 	<b>Schritt 2: </b>Ein kleines Fenster zum ausw�hlen von Dateien �ffnet sich. W�hle die gew�nschte Bilddatei aus und klickt "OK" an.<br>
</ul>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Ich habe alle Information eingegeben. Wie kann ich sie speichern?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Speichern"> Knopf an.<br>
</ul>
	<? endif ?>	
	<? if($x1=="save") : ?>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie gebe ich ein neues Produkt in die Datenbank ein?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Neue Eingabe"> Knopf an.<br>
 	<b>Schritt 2: </b>Das Eingabeformular wird eingeblendet.<br>
 	<b>Schritt e: </b>Gibt  alle vorhandene Information �ber das Produkt in die entsprechende Eingabefelder ein.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Speichern"> Knopf an.<br>
</ul>
	<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich die Information des Produkts bearbeiten bzw. aktualisieren?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="�ndern bzw. aktualisieren"> Knopf an.<br>
 	<b>Schritt 2: </b>Die Information �ber das Produkt wird automatisch in Eingabefelder eingegeben.<br>
 	<b>Schritt 3: </b>Sie k�nnen jetzt die Information �ndern, erg�nzen, l�schen, usw.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Speichern"> Knopf an um die aktuelle �nderung zu speichern.<br>
</ul>
	
	<? endif ?>	
<? endif ?>	

<? if($src=="search") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie finde ich ein Produkt?</b>
</font>
<ul>       	
 
 	<b>Schritt 1: </b>	Gibt entweder eine vollst�ndige Information oder die erste Zeichen von dem Markennamen des Artikels, oder seinem Generic, oder seiner Bestellnummer, usw. in das Feld
				<nobr><span style="background-color:yellow" >" Suchbegriff f�r den Artikel: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Suchen"> Knopf an um den Artikel zu suchen.<br>
 	<b>Schritt 3: </b>Wenn die Suche einen Artikel findet der dem Suchbegriff exakt anspricht, werden alle Information �ber den Artikel gezeigt.<br>
 	<b>Schritt 4: </b>Wenn mehrere Artikel gefunden werden, wird eine Liste gezeigt.<br>
</ul>
	<? if($x1!="multiple") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Mehrere Artikel sind aufgelistet. Wie kann ich die komplette Information eines Artikels sehen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder den Namen des Artikels oder das Symbol <img src="../img/info3.gif" border=0> an.<br>
</ul>
	<? endif ?>
	<? if($x1=="multiple") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Ich m�chte die leztet Liste der Artikel noch mal sehen. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Zur�ck"> Knopf an.<br>
</ul>
	<? endif ?>
<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen m�chten klickt den <img src="../img/de/de_cancel.gif" border=0> Knopf an.
</ul>

<? endif ?>

<? if($src=="mng") : ?>
	<? if(($x3=="1")&&($x1!="multiple")) : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie bearbeite ich die Information eines Produkts?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Bearbeite die Information.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Speichern"> Knopf an um die aktuelle �nderung zu speichern.<br>
</ul>
	<? endif ?>

	<? if($x1=="multiple") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich die Information des Produkts der gerade gezeigt wird bearbeiten bzw. aktualisieren?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="�ndern bzw. aktualisieren"> Knopf an.<br>
 	<b>Schritt 2: </b>Die Information �ber das Produkt wird automatisch in Eingabefelder eingegeben.<br>
 	<b>Schritt 3: </b>Sie k�nnen jetzt die Information �ndern, erg�nzen, l�schen, usw.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Speichern"> Knopf an um die aktuelle �nderung zu speichern.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie entferne ich das Produkt der gerade gezeigt wird aus der Datenbank?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Aus der Datenbank entfernen bzw. l�schen"> Knopf an.<br>
 	<b>Schritt 2: </b>Sie werden nach einer Best�tigung gefragt.<br>
 	<b>Schritt 3: </b>Wenn Sie sicher sind das Produkt zu l�schen, klickt den<input type="button" value="Ja, ich bin sicher. Daten l�schen."> Knopf an.<p>
 	<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b> Achtung!</b></font> Das Entfernen von Produkten l�sst sich nicht r�ckg�ngig machen.<br>
</ul>	
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Ich m�chte das Produkt NICHT aus der Datenbank entfernen. Was soll ich jetzt tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > << Nein, zur�ck </span>" an.<br>
</ul>	
<? endif ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie verwalte ich ein Produkt in der Datenbank?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Suche zuerst den Artikel. 
	Gibt entweder eine vollst�ndige Information oder die erste Zeichen von dem Markennamen des Artikels, oder seinem Generic, oder seiner Bestellnummer, usw. in das Feld
				<nobr><span style="background-color:yellow" >" Geben Sie einen Suchbegriff ein: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 2: </b>Klickt den <input type="button" value="Artikel suchen"> Knopf an um den Artikel zu suchen.<br>
 	<b>Schritt 3: </b>Wenn die Suche einen Artikel findet der dem Suchbegriff exakt anspricht, werden alle Information �ber den Artikel gezeigt.<br>
 	<b>Schritt 4: </b>Wenn mehrere Artikel gefunden werden, wird eine Liste gezeigt.<br>
</ul>
	<? if(($x1!="multiple")&&($x3=="")) : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Mehrere Artikel sind aufgelistet. Wie kann ich die komplette Information eines Artikels sehen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt entweder den Namen des Artikels oder das Symbol <img src="../img/info3.gif" border=0> an.<br>
</ul>
	<? endif ?>
	<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
Wenn Sie abbrechen m�chten klickt den <img src="../img/de/de_cancel.gif" border=0> Knopf an.
</ul>
<? endif ?>



<? if($src=="delete") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie entferne ich das Produkt der gerade gezeigt wird aus der Datenbank?</b>
</font>
<ul>       	
 	<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b> Achtung!</b></font> Das Entfernen von Produkten l�sst sich nicht r�ckg�ngig machen.<p>
  	<b>Schritt 1: </b>Wenn Sie sicher sind das Produkt zu l�schen, klickt den<input type="button" value="Ja, ich bin sicher. Daten l�schen."> Knopf an.<p>

</ul>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Ich m�chte das Produkt NICHT aus der Datenbank entfernen. Was soll ich jetzt tun?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt die Option "<span style="background-color:yellow" > << Nein, zur�ck </span>" an.<br>
</ul>	
<ul>
<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b> Achtung!</b><br></font> 
       	
Wenn Sie abbrechen m�chten klickt den <img src="../img/de/de_cancel.gif" border=0> Knopf an.
</ul>

<? endif ?>	

<? if($src=="report") : ?>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie schreibe ich einen Bericht?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Schreibe den Bericht  in das Feld
				<nobr><span style="background-color:yellow" >" Bericht: <input type="text" name="s" size=10 maxlength=10> "</span></nobr>.<br>
 	<b>Schritt 2: </b>Gibt Ihren Namen  in das Feld
				<nobr><span style="background-color:yellow" >" Verfasser: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 3: </b>Gibt Ihre Personalnummer in das Feld
				<nobr><span style="background-color:yellow" >" Personalnummer: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> ein.<br>
 	<b>Schritt 4: </b>Klickt den <input type="button" value="Senden"> Knopf an um den Bericht zu senden.<br>
</ul>
<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b> Achtung!</b><br></font> 
       	
Wenn Sie abbrechen bzw. beenden m�chten klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an.
</ul>
<? endif ?>	
</form>

