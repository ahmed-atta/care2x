<form action="#">

<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?

switch($x1)
{
 	case "entry": print 'Ein neues Medocs Dokument erstellen'; break;
	case "search": print 'Suchen nach einem Medocs Dokument';break;
	case "archiv": print 'Recherche im Medocs Archiv';break;
 }
?>

<? if(!$x1) : ?>
		<? require("help_de_main.php"); ?>
<? else : ?>
</b></font>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<p>
<font face="Verdana, Arial" size=2>

<? if($src!=$x1) : ?>
<b>Schritt 1</b>
<ul> Den <img src="../img/de/de<? switch($x1)
																			{
																				case "entry": print '_newdata-gray.gif'; break;
																				case "search": print '_such-gray.gif'; break;
																				case "archiv": print '_arch-gray.gif'; break;
																			}
?>" border="0"> anklicken.
		
</ul>
<b>Schritt 2</b>
<? endif ?>
<ul> Wenn Sie sich vorher angemeldet haben und ein Zugangsrecht in dieser Funktion haben wird
<? switch($x1)
	{
		case "entry": print 'das Formular zur Eingabe'; break;
		case "search": print 'die Eingabefelder zum Suchen '; break;
		case "archiv": print 'die Engabefelder zum Archiv'; break;
	}
?>  eingeblendet.<p>
		Ansonsten werden Sie nach Ihrem Benutzernamen und Passwort gefragt.<p>
		Geben Sie Ihren Benutzernamen und Passwort ein und klicken Sie den <img src="../img/de/de_continue.gif" border=0> an.<br>
		Falls Sie abbrechen m�chten, klicken Sie den <img src="../img/de/de_cancel.gif" border=0> an.
		
</ul>


</form>
<? endif ?>
