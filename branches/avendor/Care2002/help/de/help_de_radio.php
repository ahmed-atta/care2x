<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radiologie - 
<?

if($src=="search")
{
	print "Suchen nach einem Patient";	
/*	switch($x1)
	{
	case "search": print "Selecting a particular document";
						break;
	case "": 
						break;
	case "get": print  "Patient's operation's log document";
						break;
	case "fresh": print "Search for a operation's log document";
	}
*/}

 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >


<? if($src=="search") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie finde ich einen Patient?</b>
</font>
	
	<ul>       	
 	<b>Schritt 1: </b>Gibt entweder eine vollständige Information oder die erste Zeichen von der Fallnummer vom Patient, von seinem Namen, oder von seinem Vornamen, oder
	von seinem Geburtstdatum in das entsprechende Eingabefeld ein. <br>
 	<b>Schritt 2: </b>Klickt den <img src="../img/de/de_searchlamp.gif" border=0> Knopf an um die Suche zu starten.<p> 
<ul>       	
 	<b>Achtung! </b>Wenn die Suche ein Ergebnis bzw. mehrere Ergebnisse liefert wird eine Liste gezeigt. <p>
	</ul>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich die Vorschau des Röntgenbildes und den Befund zeigen lassen?</b>
</font>
	
	<ul>       	
 	<b>Schritt 1: </b>Klick den "<span style="background-color:yellow" > <font color="#0000cc">Vorschau/Befund</font> <input type="radio" name="d" value="a"> </span>" Radiobutton an.<br>
	Die Vorschau des Röntgenbildes wird in den unteren linken Rahmen eingeblendet.<br> 
	Der Befund wird in den unteren rechten Rahmen gezeigt.<br> 
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Wie kann ich das Röntgenbild in voller Große zeigen lassen?</b>
</font>
	<ul>       	
 	<b>Schritt 1: </b>Klickt das Symbol  <img src="../img/torso.gif" border=0> an.<br>
</ul>
<img src="../img/warn.gif" border=0 align="absmiddle"> <font color="#990000"><b> Achtung!</b></font> 
<ul>       	
 Wenn Sie abbrechen möchten klickt den <img src="../img/de/de_close2.gif" border=0> Knopf an.
</ul>
<? endif ?>

</form>

