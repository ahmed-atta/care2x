<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?
switch($x2)
{
	case "search": 
 						if($x1) print 'Belegungsliste einer Station zeigen';
						else  print 'Suchen nach einem Patienten';
						break;
	case "quick": print  "Pflegestationen - Schnellsicht der Belegungslisten";
						break;
	case "arch": print "Pflegestationen - Archiv";
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<? if($x2=="search") : ?>
<? if(!$x1) : ?>
<b>Schritt 1</b>

<ul>
Geben Sie in das Feld "<span style="background-color:yellow" >Bitte ein Stichwort eingeben.</span>" entweder die vollständige Information oder die erste Zeichen wie zum Beispiel Name, oder Vorname, oder beides.
		<ul type=disc>
		<li>Beispiel 1: "Guerero" oder "gue".
		<li>Beispiel 2: "Alfredo" oder "Alf".
		<li>Beispiel 3: "Guerero, Alf".
	</ul>	
</ul>
<b>Schritt 2</b>
<ul> Den <input type="button" value="Suchen">  anklicken um die Suche zu starten.<br>
</ul>
<b>Schritt 3</b>
<ul> Wenn die Suche ein Ergebnis liefert wird die Belegungsliste der Station gezeigt.<br>
</ul>
<b>Schritt 4</b>
<ul> Wenn die Suche mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
</ul>
<b>Achtung!</b>
<ul>  Falls Sie abbrechen möchten den <img src="../img/de/de_cancel.gif" border=0> anklicken.
</ul><? endif ?>
<b>Schritt <? if($x1) print "1"; else print "5"; ?></b>
<ul>Um die Belegungsliste zu sehen, den <img src="../img/bul_arrowBluSm.gif" width=12 height=12 border=0>,
oder das Datum, oder den Stationsnamen anklicken.
<p><b>Achtung!</b> Das Stichwort wird in der Belegungsliste hervorgehoben.
<br><b>Achtung!</b> Die Belegungsliste is nur zum sehen. Sie lässt sich nicht bearbeiten. Wenn Sie trotzdem versuchen die Liste zu bearbeiten werden Sie nach Ihrem 
Benutzername und Passwort gefragt.
</ul>
<? endif ?>
<? if($x2=="quick") : ?>
	<? if($x1) : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich die Belegungsliste einer Station sehen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie den Namen der Station auf der linke Spalte.<br>
	<b>Achtung! </b>Die Belegungsliste wird eingeblendet zum sehen. Die Liste und Daten lassen sich nicht ändern.<br>
	</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich die Belegungsliste zeigen lassen zum aktualisieren bzw. ändern?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie das entsprechende Symbol <img src="../img/statbel2.gif" width=20 height=20 border=0> einer Station auf der rechten Spalte.<br>
 	<b>Schritt 2: </b>Wenn Sie sich vorher angemeldet und ein Zugangsrecht in dieser Funktion haben wird die Belegungsliste sofort eingeblendet.
	Ansonsten werden Sie nach Ihrem Benutzernamen und Passwort gefragt.<br>
 	<b>Schritt 3: </b>Falls erforderlich, geben Sie Ihre Benutzenamen und Passswort ein.<br>
 	<b>Schritt 4: </b>Den <input type="button" value="Weiter..."> Knopf anklicken.<br>
 	<b>Schritt 5: </b>Wenn Sie ein Zugangsrecht in dieser Funktion haben wird die Belegungsliste eingeblendet.<p>
	<b>Achtung! </b>Die Belegungsliste und Daten lässen sich bearbeiten d.h. aktualisieren bzw. ändern. Verschieden Optionen für Bearbeitungen werden
	auch eingeblendet.
		Sie können auch die Patientenmappe öffnen zum sehen bzw. bearbeiten.<br>
	</ul>
	<? else : ?>
<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Keine Stationsbelegung vorhanden!</b>
</font><p>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie lassen sich die alte Belegungslisten über das Archiv zeigen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Den "<span style="background-color:yellow" > Klick hier zum Archiv <img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0> </span>" anklicken.<br>
 	<b>Schritt 2: </b>Ein Leitkalender wird eingeblendet.<br>
 	<b>Schritt 3: </b>Klicken Sie das Datum im Kalender um die Belegungslisten von diesem Tag zu sehen.<br>
	</ul>
	
	<? endif ?>
<b>Achtung!</b>
<ul> Falls Sie die Schnellsicht schliessen möchten den <img src="../img/de/de_close2.gif" border=0> anklicken.
</ul><? endif ?>

<? if($x2=="arch") : ?>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie lassen sich die alte Belegungslisten über das Archiv zeigen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie das Datum im Kalender um die Belegungslisten von diesem Tag zu sehen.<br>
	</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich den Monat des Leitkalenders wechseln?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Um den nächsten Monat zu zeigen klicken Sie den "<span style="background-color:yellow" >Monat ></span>" auf der oberen RECHTEN Ecke des Leitkalenders.
								Klicken Sie so oft wie nötig bis der gewünschte Monat angezeigt ist.<p>
 	<b>Schritt 2: </b>Um den vorigen Monat zu zeigen klicken Sie den "<span style="background-color:yellow" >< Monat</span>" auf der oberen LINKEN Ecke des Leitkalenders.
								Klicken Sie so oft wie nötig bis der gewünschte Monat angezeigt ist.<br>
	</ul>
	
	<? endif ?>


</form>

