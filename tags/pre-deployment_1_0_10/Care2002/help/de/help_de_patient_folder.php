<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Patientenmappe" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Was soll diese Farbbalken  <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> > bedeuten? </b></font>
<ul> <b>Achtung! </b>Sie sind "Signalfarben". <p>Jede Farbe in diesem Balken (wenn gesetzt) bedeutet  �nderung, Anordnung, Fragen, Befund, Beobachtung,
		usw.<br>
			Die Bedeutung einer Farbe l�sst sich f�r jede Station einstellen. <p>
			Die Reihe von sieben gr�nen Farbbalken signalisieren die sieben Tage in der Woche. (Sonntag bis Samstag)<p>
			Die Reihe von 24 rosa Farbbalken signalisieren die 24 Stunden des Tages.<br>
			Zum Beispiel: Der sechste rosa Farbbalke bedeutet "6 Uhr", der zehnte bedeutet "10 Uhr", usw.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Was bewirken diese Kn�pfe?</b></font>
<ul> <input type="button" value="Patientenkurve">
	<ul>
		Dieser Knopf �ffnet die Patientenkurve. Sie k�nne die Temperatur und Blutdruck Daten eingeben, bearbeiten, oder l�schen.
<br>
		Weitere Daten zum eingeben:
	<ul type="disc">
	<li>Allergi<br>
	<li>Kostplan<br>
	<li>Hauptdiagnose & Therapie<br>
	<li>T�gliche Diagnose & Therapieplan<br>
	<li>Besonderheiten & Nebendiagnosen<br>
	<li>PT, ATG, usw.<br>
	<li>Antikoagulantien<br>
	<li>T�gliche Dokumentation von Antikoagulantien<br>
	<li>i.v. Medikation und Verbandswechsel<br>
	<li>T�gliche Dokumentation von i.v. Medikation<br>
	<li>Zusatzangaben<br>
	<li>Medikationsplan, Dosierung & Verabreichung<br>
	<li>T�gliche Dokumentation des Medikationsplans<br>
	</ul>		
	</ul>
<input type="button" value="Pflegebericht">
	<ul>
		Dieser Knopf �ffnet den Pflegebericht. Sie k�nnen hier Ihre Pflege berichten, dokumentieren, usw.
	</ul>
	<input type="button" value="�rztliche Anordnung">
	<ul>
	Der Stationsarzt tr�gt hier seine Anordnung, Anweisung, Antworten auf Anfragen, uvm. ein.
	</ul>	
	<input type="button" value="Befund">
	<ul>
	Dieser Knopf �ffnet die Befunde aus verschiedenen Abteilungen und Kliniken.
	</ul>	
	<input type="button" value="Stammblatt">
	<ul>
	Dieser Knopf �ffnet das Stammblatt des Patients.
	</ul>	
	<input type="button" value="Pflegeplanung">
	<ul>
	Dies ist die Pflegeplanung f�r den Patient.
	</ul>	
	<input type="button" value="Laborwerte">
	<ul>
	Dieser Knopf �ffnet die Laborwerte und Laborbefunde vom Patient.
	</ul>	
	<input type="button" value="Fotos">
	<ul>
	Dieser Knopf �ffnet den Fotokatalog vom Patient.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Was ist die Funktion von diesem Auswahlfeld </b>	<select name="d"><option value="">bitte ausw�hlen</option></select>?
</font>
<ul>       	<b>Achtung! </b>Hier k�nnen Sie einen neuen Konsilschein ausw�hlen.<br>
 	<b>Schritt 1: </b>Klickt das Auswahlfeld <select name="d"><option value="">bitte ausw�hlen</option></select> an.
                                                                     <br>
		<b>Schritt 2: </b>Klickt die Abteilung an.<br>
		<b>Schritt 3: </b>Ein neuer Konsilschein wird eingeblendet.<br>
</ul>
<?php endif ?>

<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> 
<font color="#990000"><b>Kein Laborbefund vorhanden. </b></font>
<ul> Klickt den <input type="button" value="OK"> Knopf an um in die Patientenmappe zur�ck zu gehen.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Wie schliesse ich die Patientenmappe? </b></font>
<ul> <b>Achtung! </b>Wenn Sie die Patientenmappe schliessen m�chten klicken Sie den 
<img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> Knopf an.</ul>

<?php endif ?>

</form>

