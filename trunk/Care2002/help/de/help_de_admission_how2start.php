<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

$foreword='
<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b> ';

switch($x1)
{
 	case "entry": print $foreword.'Aufnehmen von neuen Patienten'; break;
	case "search": print $foreword.'Suchen von Patientendaten';break;
	case "archiv": print $foreword.'Recherchieren im Archiv';break;
 }
?>

<?php if(!$x1) : ?>
		<?php require("help_de_main.php"); ?>
<?php else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p>
<font face="Verdana, Arial" size=2>

<?php if($src!=$x1) : ?>
<b>Schritt 1</b>
<ul> Den  <img src="../img/de/de<?php switch($x1)
																			{
																				case "entry": print '_ein-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0"> anklicken.
		
</ul>
<b>Schritt 2</b>
<?php endif ?>
<ul> Wenn sie sich vorher angemeldet haben und ein Zugangsrecht in dieser Funktion haben, wird 
<?php switch($x1)
	{
		case "entry": print 'das Formular zur Aufnahme von Patienten'; break;
		case "search": print 'die Suchfelder '; break;
		case "archiv": print 'die Suchfelder vom Archiv'; break;
	}
?>  eingeblendet.<br>
		Ansonsten werden Sie nach Ihrem Benutzernamen und Passwort gefragt.<p>
		Geben Sie Ihren Benutzernamen und Passwort ein und klicken Sie den <img src="../img/de/de_continue.gif" border=0> an.<br>
		Falls Sie abbrechen möchten, klicken Sie den <img src="../img/de/de_cancel.gif" border=0> an.
		
</ul>


</form>
<?php endif ?>
