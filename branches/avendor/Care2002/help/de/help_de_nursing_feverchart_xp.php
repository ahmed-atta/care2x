<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?="$x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<? if($src=="bp_temp") : ?>
<a name="cbp"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich Temperatur und Blutdruck eingeben?</b></font>
<ul>
		<b>Schritt 1: </b>Geben Sie die Temperatur- und Blutdruckdaten ein.<br>
		<ul type="disc">
		<li>Geben Sie die Uhrzeit und Temperatur auf der rechten "<font color="#0000ff">Temperatur</font>" Spalte ein.<br>
		Beispiel: <input type="text" name="t" size=5 maxlength=5 value="12.35">&nbsp;&nbsp;<input type="text" name="u" size=8 maxlength=8 value="37.3">
		<li>Geben Sie die Uhrzeit und Blutdruck auf der linken"<font color="#cc0000">Blutdruck</font>" Spalte ein.<br>
		Beispiel: <input type="text" name="v" size=5 maxlength=5 value="10.05">&nbsp;&nbsp;<input type="text" name="w" size=8 maxlength=8 value="128/85">
		</ul>		
		<ul >
		<font color="#000099" size=1><b>Tipp:</b>Um die aktuelle Zeit einzugeben, tippt "j" oder "J" (bedeutet JETZT) in das Uhrzeit Feld ein. Die aktuelle Zeit zeigt sich automatisch.</font>
		</ul>
		<b>Schritt 2: </b>Wenn es mehrere Daten gibt, gibt sie alle ein.<br>
		<b>Schritt 3: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf um die neue Daten zu speichern.<br>
		<b>Schritt 4: </b>Wenn Sie einen Fehler korrigieren m�chten klickt die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 5: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="diet") : ?>

<a name="diet"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich einen Kostplan eingeben?</b></font>
<ul> <b>Schritt 1: </b>Gibt den Kostplan ein.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um den Kostplan zu speichern.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="allergy") : ?>
<a name="allergy"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich Information �ber Allergie eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Allergie oder CAVE Information in das Feld <br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information im Feld <br>in the "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="diag_ther") : ?>
<a name="diag"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich die Hauptdiagnose bzw. Therapie eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Diagnose oder Therapie in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information im Feld  "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="diag_ther_dailyreport") : ?>
<a name="daydiag"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich t�gliche Information �ber Diagnose oder Therapieplan eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Diagnose oder Therapieplan in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information im Feld  "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="xdiag_specials") : ?>
<a name="extra"><a name="diag"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a></a>
Wie kann ich Besonderheiten oder Nebendiagnose eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Besonderheiten oder Nebendiagnose in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information im Feld "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klickt die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="kg_atg_etc") : ?>
<a name="pt"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich t�gliche Information �ber PT, ATG, usw eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Information in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information im Feld "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="anticoag") : ?>
<a name="coag"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich Antikoagulant(ien) eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Information �ber das Antikoagulant und dessen Dosierung in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information im Feld "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="anticoag_dailydose") : ?>
<a name="daycoag"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich t�gliche Information �ber Antikoagulant(ien) und deren Verabreichung eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Information �ber das Antikoagulant und dessen Verabreichung in das Feld<br> "<span style="background-color:yellow" >Bitte hier eintragen bzw. die aktuelle Information ver�ndern: </span>" ein.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="lot_mat_etc") : ?>
<a name="lot"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich Angaben eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Angaben (LOT, Chargen Nr., Implantat, usw.) in das Feld<br> "<span style="background-color:yellow" > Ihre neue Eintragung bitte hier unten eingeben: </span>" ein.<br>
  		<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information im Feld "<span style="background-color:yellow" > Aktuelle Eintragung(en): </span>" bearbeiten.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="medication") : ?>
<a name="med"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich Medikamente und deren Dosierungsplan eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Gibt die Medikamente auf die linke Spalte ein.<br> 
	<b>Schritt 2: </b>Tippt den Dosierungsplan auf die mittlere Spalte ein.<br> 
	<b>Schritt 3: </b>Klickt den radiobutton f�r die entsprechende Farbkodierung des Medikaments an.<br> 
	<ul type=disc>
		<li>Weiss f�r normal oder standard.
		<li><span style="background-color:#00ff00" >Gr�n</span> f�r Antibiotika und deren Derivativen.
		<li><span style="background-color:yellow" >Gelb</span> f�r Wasserabschwemmende Medikamente.
		<li><span style="background-color:#0099ff" >Blau</span> f�r h�molytische Medikamente.
		<li><span style="background-color:#ff0000" >Rot</span> f�r i.v. verabreichte Medikamente.
	</ul>
  	<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information bearbeiten.<br>
	<b>Schritt 4: </b>Geben Sie Ihren Namen in das Feld "<span style="background-color:yellow" > Schwester/Pfleger: </span>" ein.<br> 
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 5: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um den Medikationsplan zu speichern.<br>
		<b>Schritt 6: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 7: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>
<? if($src=="medication_dailydose") : ?>
	<? if($x2) : ?>

<a name="daymed"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich t�gliche Information �ber Medikamente und deren Verabreichung bzw. Dosierung eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Klickt das Eingabefeld des gew�hlten Medikaments.<br>
	<b>Schritt 2: </b>Geben Sie entweder die Verabreichung, Dosierung, Name des Verabreichers, oder Symbole f�r Beginn oder Ende der Verabreichung ein.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 3: </b>Wenn Sie mehrere Eintragungen haben, tragen Sie sie alle ein.<br>
		<b>Schritt 4: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 5: </b>Wenn Sie einen Fehler korrigieren m�chten klickt die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 6: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
	<? else : ?>
<a name="daymed"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Es heisst "Es gibt noch keine Medikamente". Was soll ich tun?</b></font>
<ul> 
		<b>Schritt 1: </b>Klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
	<b>Schritt 2: </b>Klickt die "<span style="background-color:yellow" > Medikamente </span>" an.<br>
	<b>Schritt 3: </b>Ein kleines Fenster mit Eingabefelder f�r Medikamente und deren Dosierungsplan �ffnet sich.<br>
	<b>Schritt 4: </b>Gibt die Medikamente auf die linke Spalte ein.<br> 
	<b>Schritt 5: </b>Tippt den Dosierungsplan auf die mittlere Spalte ein.<br> 
	<b>Schritt 6: </b>Klickt den radiobutton f�r die entsprechende Farbkodierung des Medikaments an.<br> 
	<ul type=disc>
		<li>Weiss f�r normal oder standard.
		<li><span style="background-color:#00ff00" >Gr�n</span> f�r Antibiotika und deren Derivativen.
		<li><span style="background-color:yellow" >Gelb</span> f�r Wasserabschwemmende Medikamente.
		<li><span style="background-color:#0099ff" >Blau</span> f�r h�molytische Medikamente.
		<li><span style="background-color:#ff0000" >Rot</span> f�r i.v. verabreichte Medikamente.
	</ul>
  	<b>Achtung! </b>Sie k�nnen auch falls erforderlich die aktuelle Information bearbeiten.<br>
	<b>Schritt 7: </b>Geben Sie Ihren Namen in das Feld "<span style="background-color:yellow" > Schwester/Pfleger: </span>" ein.<br> 
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 8: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um den Medikationsplan zu speichern.<br>
		<b>Schritt 9: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 10: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
	<? endif ?>
<? endif ?>
<? if($src=="iv_needle") : ?>
<a name="iv"><img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b></a>
Wie kann ich t�gliche Information �ber i.v. Medikamente und deren Dosierung bzw. Verabreichung eingeben?</b></font>
<ul> 
	<b>Schritt 1: </b>Geben Sie entweder die Verabreichung, Dosierung, Name des Verabreichers, oder Symbole f�r Beginn oder Ende der Verabreichung  in das Feld "<span style="background-color:yellow" > Bitte hier eintragen bzw. die aktuelle Information ver�ndern: </span>" ein.<br>
  		<b>Achtung! </b>Wenn Sie abbrechen m�chten klickt den<img src="../img/de/de_cancel.gif" border=0 align="absmiddle"> Knopf an.<br>
		<b>Schritt 2: </b>Klickt den <img src="../img/de/de_savedisc.gif" border=0> Knopf an um die Information zu speichern.<br>
		<b>Schritt 3: </b>Wenn Sie einen Fehler korrigieren m�chten klicken Sie die fehlerhafte Daten an, gibt das richtige ein und speichere erneut ab.<br>
		<b>Schritt 4: </b>Wenn Sie fertig sind klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an um das Fenster zu schliessen und in die Kurve zur�ck zu gehen.<br>
</ul>
<? endif ?>

</form>

