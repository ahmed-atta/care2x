<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
switch($x1)
{
 	case "search": print 'Suchen nach Telefonnummern'; break;
	case "dir": print 'Telefonverzeichnis zeigen';break;
	case "newphone": print 'Eingabe von neuen Telefonnummern';break;
 }
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($x1=="search") : ?>
	<?php if($src=="newphone") : ?>
	<b>Schritt 1</b>
	<ul> Den <img src="../img/de/de_such-gray.gif" border="0"> anklicken.
	</ul>
	<?php endif ?>
<b>Schritt <?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul> Geben Sie in das Feld "<span style="background-color:yellow" >Suchbegriff eingeben.</span>" entweder die vollständige Information oder die erste Zeichen wie zum Beispiel Name, oder Vorname, oder Station's Name oder deren Abkürzung
oder Zimmernummer.
		<p>Beispiel 1: "m9a" oder "M9A" oder "M9".
		<br>Beispiel 2: "Guerero" oder "gue".
		<br>Beispiel 3: "Alfredo" oder "Alf".
		<br>Beispiel 4: "op11" oder "OP11" oder "op".
		
</ul>
<b>Schritt <?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> Den <input type="button" value="SUCHEN">  anklicken um die Suche zu starten.<br>
</ul>
<b>Schritt <?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> Wenn die Suche Ergebnisse liefert wird eine Liste gezeigt.<br>
</ul>
<?php endif ?>
<?php if($x1=="dir") : ?>
<b>Schritt 1</b>
<ul> Den <img src="../img/de/de_phonedir-gray.gif" border="0"> anklicken.
</ul>
<?php endif ?>
<?php if($x1=="newphone") : ?>
	<?php if($src=="search") : ?>
<b>Schritt 1</b>
<ul> Den <img src="../img/de/de_newdata-gray.gif" border="0"> anklicken.
</ul>
<b>Schritt 2</b>
<ul>  Wenn Sie sich vorher angemeldet haben und ein Zugangsrecht in dieser Funktion haben wird das Eingabeformular eingeblendet.<br>
		Ansonsten werden Sie nach Ihrem Benutzernamen und Passwort gefragt.<p>
	<?php endif ?>
		Geben Sie Ihren Benutzernamen und Passwort ein und klicken Sie den <img src="../img/de/de_continue.gif" border=0> an.<br>
		
</ul><?php endif ?>

<b>Achtung!</b>
<ul> Falls Sie
<?php
switch($x1)
{
 	case "search": print ' die Suche abbrechen möchten den <img src="../img/de/de_cancel.gif" border=0> anklicken.'; break;
	case "dir": print ' das Verzeichnis schliessen möchten den <input type="button" value="Abbrechen"> anklicken.';break;
	case "newphone": print  ' abbrechen möchten den <img src="../img/de/de_cancel.gif" border=0> anklicken.';break;
 }
 ?>
</ul>


</form>

