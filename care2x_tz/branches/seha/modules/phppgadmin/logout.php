<?php

/**
 * Logs a user out of the app
 *
 * $Id: logout.php,v 1.1 2006/01/13 13:42:14 irroal Exp $
 */

if (!ini_get('session.auto_start')) {
	session_name('PPA_ID'); 
	session_start();
}
unset($_SESSION);
session_destroy();

header('Location: index.php');

?>
