<?php
	// Klasse einbinden
	include("sendmail.class.php");

	// Neue Instanz der Klasse erstellen (Ab jetzt kann auf die Funktionen der Klasse zugegriffen werden)
	$mail = new sendmail();

	// Angeben des zu verwendenden CharSet´s
	$mail->SetCharSet("ISO-8859-1");

	// Angeben des Absenders und der Absenderemailadresse
	$mail->from("Name","Email@Adresse.de");

	// Angeben der Empfängeremailadresse
	$mail->to("francesco.imme@guest.coni.it");

	// Angeben des Cc Empfänger
	$mail->cc("");
	$mail->cc("");

	// Angeben dec Bcc Empfänger
	$mail->bcc("");
	$mail->bcc("");

	// Angeben des Betreff´s
	$mail->subject("Hier kommt der Betreff rein");

	// Angeben des Textes (Auch HTML möglich)
	// Beim eingeben des HTML Textes bitte <HTML><BODY></BODY></HTML> weglassen,
	// da dies automatisch hinzugefügt wird
	$mail->text("Hier kommt der Text hin");

	// Anegeben eines Attachment´s (sind auch mehrere möglich)
	$mail->attachment("sample.php");
	$mail->attachment("leo.php");

	// Versenden der E-Mail
	$mail->send();
?>