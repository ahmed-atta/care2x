<?
	// Klasse einbinden
	include("sendmail.class.php");

	// Neue Instanz der Klasse erstellen (Ab jetzt kann auf die Funktionen der Klasse zugegriffen werden)
	$mail = new sendmail();

	// Angeben des zu verwendenden CharSet�s
	$mail->SetCharSet("ISO-8859-1");

	// Angeben des Absenders und der Absenderemailadresse
	$mail->from("Name","Email@Adresse.de");

	// Angeben der Empf�ngeremailadresse
	$mail->to("Email@Adresse.de");

	// Angeben des Cc Empf�nger
	$mail->cc("Email@Adresse.de");
	$mail->cc("Email@Adresse.de");

	// Angeben dec Bcc Empf�nger
	$mail->bcc("Email@Adresse.de");
	$mail->bcc("Email@Adresse.de");

	// Angeben des Betreff�s
	$mail->subject("Hier kommt der Betreff rein");

	// Angeben des Textes (Auch HTML m�glich)
	// Beim eingeben des HTML Textes bitte <HTML><BODY></BODY></HTML> weglassen,
	// da dies automatisch hinzugef�gt wird
	$mail->text("Hier kommt der Text hin");

	// Anegeben eines Attachment�s (sind auch mehrere m�glich)
	$mail->attachment("test.zip");
	$mail->attachment("test2.zip");

	// Versenden der E-Mail
	$mail->send();
?>