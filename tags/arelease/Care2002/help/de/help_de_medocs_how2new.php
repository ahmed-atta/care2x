<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Erstellen eines Medocs Dokuments</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<? if($src=="?") : ?>
<b>Schritt 1</b>

<ul> Suchen Sie zuerst den Patient.<br>
		Geben Sie in das Feld "Den folgenden Patient dokumentieren:" eine von diesen Informationen:<br>
		<Ul type="disc">
			<li>Fallnummer (Patientennummer) oder<br>
			<li>Name vom Patient oder<br>
			<li>Vorname vom Patient<br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>Tipp:</b> Wenn Ihr System über einen Strichcode Scanner verfügt, klicken Sie das Feld "Den folgenden Patient dokumetieren:" an und
		lesen Sie den Strichcode mit dem Scanner ein. Überspringen Sie den Schritt 2.
		</font>
		</ul>
		
</ul>
<b>Schritt 2</b>

<ul> Den <input type="button" value="Suchen">  anklicken um die Suche zu starten.
		
</ul>
<b>Alternativen zum Schritt 2</b>
<ul> Sie können eine von folgenden tun:<br>
		<Ul type="disc">		
		<li>Den Name vom Patient in das Feld "Name:" eingeben <br>
		<li>oder den Vornamen vom Patient in das Feld "Vorname:" eingeben <br>
		</ul>
		 anschliessend die  "Enter" Taste auf der Tastatur drücken.
		
</ul>
<b>Schritt 3</b>
<ul> Wenn die Suche ein einziges Ergebnis findet werden die Daten sofort gezeigt.<br>
		Wenn die Suche allerdings mehrere Ergebnisse liefert wird eine Liste gezeigt.<br>
<? endif ?>

<? if(($src=="?")||($x1>1)) : ?>

 <br>
 		Um einen Patient in der Liste zu dokumentieren,  den nebenstehenden <img src="../img/R_arrowGrnSm.gif" border=0 height=12 border=0> , oder
		den Namen, oder den Vornamen, oder die Fallnummer oder das Aufnahmedatum anklicken.

</ul>
<? endif ?>

<? if($src=="?") : ?>
<b>Schritt 4</b>
<? endif ?>

<? if(($src!="?")&&($x1==1)) : ?>
<b>Schritt 1</b>
<? endif ?>
<? if(($x1=="1")||($src=="?")) : ?>
<ul> Wenn die Patientendaten eingeblendet sind können Sie folgendes tun: 
		<Ul type="disc">		
    	<li>Zusatzangaben über die Krankenkasse bzw. Versicherung in das Feld "weitere Angaben:" eingeben,<br>
		<li>den "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Ja</span>" am  "Aufklärung" anklicken wenn der Patient eine Aufklärung erhalten hat,<br>
    	<li>den "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Nein</span>" am  "Aufklärung" anklicken wenn der Patient KEINE Aufklärung erhalten hat,<br>
		<li>die Diagnose bzw. den Befund in das Feld "Diagnose:" eingeben,<br>
		<li>die Therapie in das Feld "Therapie:" eingeben,<br>
		<li>falls erforderlich, das Bearbeitungsdatum in das Feld "Bearbeitet am:" eingeben,<br>
		<li>falls erforderlich, den Namen in das Feld "Bearbeitet von:" eingeben,<br>
		<li>falls erforderlich, eine Schlüsselnummer in das Feld "Schlüsselnummer:" eingeben.<br>
		</ul>
</ul>
<b>Achtung!</b>
<ul> Falls Sie alle Eingaben löschen möchten den <input type="button" value="Rücksetzen"> anklicken.
</ul>

<b>Schritt <? if($src!="?") print "2"; else print "5"; ?></b>
<ul> Den <input type="button" value="Speichern"> anklicken um das Dokument zu speichern.
</ul>
<? endif ?>
<b>Achtung!</b>
<ul> Falls Sie abbrechen möchten, den  <img src="../img/de/de_cancel.gif" border=0 > anklicken.
		
</ul>


</form>

