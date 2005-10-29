<?php

	/**
	 * List databases in a server
	 * @param $webdbServerID The ID of the current server
	 *
	 * $Id$
	 */

	// Include application functions
	include_once('libraries/lib.inc.php');

	$misc->printHeader($lang['strdatabases']);
	$misc->printBody();
?>

<h1><?php echo $appName ?></h1>

<p><?php echo $appIntro ?></p>

<?php
	$misc->printFooter();
?>
