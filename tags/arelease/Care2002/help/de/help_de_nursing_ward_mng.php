<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Stationsverwaltung 
<?
switch($src)
{
	case "main": print "";
						break;
	case "new": print  " - Eine neue Station erschaffen";
						break;
	case "": print  " - Stationsprofil";
						break;
	case "show": print  " - Stationsprofil";
						break;
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<? if($src=="main") : ?>

<b>Erschaffen</b>

<ul>Um eine neue Station zu erschaffen klicken Sie diese Option an. 
	</ul>	
</ul>
<b>Stationsprofil</b>
<ul>Diese Option zeigt die Stationsprofil and andere relevante Information.
</ul>
<b>Bett sperren</b>
<ul>Um ein Bett bzw. mehrere Betten zu sperren klicken Sie diese Option an. Die angemeldete Station wird gezeigt. Wenn keine Station
angemeldet ist wird die standard Station gezeigt. Sperren von Betten erfordert ein gultiges Passwort und ein Zugangsrecht für diese Funktion.
</ul>
<b>Zugangsberechtigungen</b>
<ul> Mit dieser Option können Sie Zugangsberechtigungen für eine bestimmte Station erstellen, sperren, ändern, löschen, oder freigeben. Die erstellte
Zugangsberechtigung sind  nur innerhalb der Station berechtigt.
</ul>
<? endif ?>

<? if($src=="new") : ?>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich eine neue Station erschaffen?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Geben Sie den Namen der Station oder deren Abkürzung in das Feld "<span style="background-color:yellow" > Station: </span>" ein.<br>
 	<b>Schritt 2: </b>Wahlen Sie die Abteilung wo die Station angehört aus dem Feld "<span style="background-color:yellow" > Abteilung: </span>" aus.<br>
 	<b>Schritt 3: </b>Schreiben Sie die Beschreibun von der Station und andere relevante Information in das Feld  "<span style="background-color:yellow" > Beschreibung: </span>" ein.<br>
 	<b>Schritt 4: </b>Geben Sie die nummer des ersten Zimmers in das Feld "<span style="background-color:yellow" > Nummer des ersten Zimmers: </span>" ein.<br>
 	<b>Schritt 5: </b>Geben Sie die nummer des letzten Zimmers in das Feld "<span style="background-color:yellow" > Nummer des letzten Zimmers: </span>" ein.<br>
 	<b>Schritt 6: </b>Geben Sie das Vorzeichen der Zimmernummer Feld "<span style="background-color:yellow" > Vorzeichen der Zimmernummer: </span>" ein.<br>
 	<b>Schritt 7: </b>Geben Sie den Namen der Stationsleitung in das Feld "<span style="background-color:yellow" > Stationsleiter(in): </span>" ein.<br>
 	<b>Schritt 8: </b>Geben Sie den Namen der stellvertretende Stationsleitung in das Feld  "<span style="background-color:yellow" > Stellvertreter(in): </span>" ein.<br>
 	<b>Schritt 9: </b>Geben Sie die Namen der Schwester und Pfleger in das Feld "<span style="background-color:yellow" >Krankenschwester/Pfleger: </span>" ein.<br>
 	<b>Schritt 10: </b>Klickt den <input type="button" value="Station erschaffen"> Knopf an um die Station zu erschaffen.<br>
	</ul>
<b>Achtung!</b>
<ul>  Falls Sie abbrechen möchten den <img src="../img/de/de_cancel.gif" border=0> anklicken.
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Kann ich die Anzahl der Betten in einem Zimmer einstellen?</b>
</font>
<ul>       	
 	<b>Nein. </b>In dieser Version des Programms, die Anzahl der Betten ist auf 2 eingestellt. Sie können sie nicht ändern.<br>
	</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Kann ich die Bettenmarkierung einstellen?</b>
</font>
<ul>       	
 	<b>Nein. </b>In dieser Version des Programms, die Bettenmarkierung  ist auf A bzw. B eingestellt. Sie können sie nicht ändern.<br>
	</ul>
<b>Achtung!</b>
<ul>Falls Sie abbrechen möchten den <img src="../img/de/de_cancel.gif" border=0> anklicken.
</ul>
<? endif ?>
	
<? if($src=="show") : ?>
	<? if($x1=="1") : ?>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich das Stationsprofil speichern?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Speichern"> Knopf an.<br>
	</ul>
<b>Achtung!</b>
<ul> Falls Sie abbrechen möchten den <img src="../img/de/de_cancel.gif" border=0> anklicken.
</ul>

	<? else : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie bearbeite ich das Stationsprofil?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klickt den <input type="button" value="Profil aktualisieren bzw. ändern"> Knopf an.<br>
	</ul>
<b>Achtung!</b>
<ul>  Falls Sie abbrechen möchten den <img src="../img/de/de_cancel.gif" border=0> anklicken.
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Ich möchte das Profil einer anderen Station bearbeiten. Was soll ich tun?</b>
</font>
<ul>       	
 	<b>Schritt 1:</b> Klickt den "<span style="background-color:yellow" > <img src="../img/L-arrowGrnLrg.gif" width=16 height=16 border=0> Andere Stationen </span>" Knopf um andere Stationen aufzulisten.<br>
 	<b>Schritt 2:</b> Klicken Sie die Station in der Liste dessen Profil Sie bearbeiten möchten.
	</ul>
<b>Achtung!</b>
<ul> Falls Sie abbrechen möchten den <img src="../img/de/de_cancel.gif" border=0> anklicken.
</ul>

<? endif ?>
<? endif ?>


<? if($src=="") : ?>

<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie wähle ich eine Station zum bearbeiten aus?</b>
</font>
<ul>       	
 	<b>Schritt 1: </b>Klicken Sie die Station in der Liste an dessen Profil Sie bearbeiten möchten.<br>
	</ul>
<b>Achtung!</b>
<ul> If you decide to cancel click the button <img src="../img/de/de_cancel.gif" border=0>.
</ul>

<? endif ?>


</form>

