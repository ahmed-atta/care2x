<?php

/**
 * Logs a user out of the app
 *
 * $Id$
 */

if (!ini_get('session.auto_start')) {
	session_name('PPA_ID'); 
	session_start();
}
unset($_SESSION);
session_destroy();

header('Location: index.php');

?>
