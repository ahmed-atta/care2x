<?php

	/**
	 * Manage conversions in a database
	 *
	 * $Id: conversions.php,v 1.1 2006/01/13 13:42:14 irroal Exp $
	 */

	// Include application functions
	include_once('libraries/lib.inc.php');
	
	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	if (!isset($msg)) $msg = '';
	$PHP_SELF = $_SERVER['PHP_SELF'];

	/**
	 * Show default list of conversions in the database
	 */
	function doDefault($msg = '') {
		global $data, $localData, $misc, $database;
		global $PHP_SELF, $lang;

		echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strconversions']}</h2>\n";
		$misc->printMsg($msg);
		
		$conversions = &$localData->getconversions();

		if ($conversions->recordCount() > 0) {
			echo "<table>\n";
			echo "<tr><th class=\"data\">{$lang['strname']}</th><th class=\"data\">{$lang['strsourceencoding']}</th>";
			echo "<th class=\"data\">{$lang['strtargetencoding']}</th><th class=\"data\">{$lang['strdefault']}</th>";
			echo "</tr>\n";
			$i = 0;
			while (!$conversions->EOF) {
				$conversions->f['condefault'] = $data->phpBool($conversions->f['condefault']);
				$id = (($i % 2) == 0 ? '1' : '2');
				echo "<tr><td class=\"data{$id}\">", $misc->printVal($conversions->f['conname']), "</td>\n";
				echo "<td class=\"data{$id}\">", $misc->printVal($conversions->f['conforencoding']), "</td>\n";
				echo "<td class=\"data{$id}\">", $misc->printVal($conversions->f['contoencoding']), "</td>\n";
				echo "<td class=\"data{$id}\">", ($conversions->f['condefault']) ? $lang['stryes'] : $lang['strno'], "</td>\n";
				echo "</tr>\n";
				$conversions->moveNext();
				$i++;
			}
			echo "</table>\n";
		}
		else {
			echo "<p>{$lang['strnoconversions']}</p>\n";
		}
	}

	$misc->printHeader($lang['strconversions']);
	$misc->printBody();

	switch ($action) {
		default:
			doDefault();
			break;
	}	

	$misc->printFooter();

?>
