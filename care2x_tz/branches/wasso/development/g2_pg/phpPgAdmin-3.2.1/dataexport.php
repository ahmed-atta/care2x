<?php

	/**
	 * Does an export to the screen or as a download
	 *
	 * $Id: dataexport.php,v 1.1 2006/01/13 13:21:39 irroal Exp $
	 */

	$extensions = array(
		'sql' => 'sql',
		'copy' => 'sql',
		'csv' => 'csv',
		'tab' => 'txt',
		'html' => 'html',
		'xml' => 'xml'
	);

	// if (!isset($_REQUEST['table']) && !isset($_REQUEST['query']))
	// What must we do in this case? Maybe redirect to the homepage?

	// If format is set, then perform the export
	if (isset($_REQUEST['what'])) {		 
		 
		switch ($_REQUEST['what']) {
			case 'dataonly':
				$format = $_REQUEST['d_format'];
				$oids = $_REQUEST['d_oids'];
				break;
			case 'structureonly':
				$clean = $_REQUEST['s_clean'];
				break;
			case 'structureanddata':
				$format = $_REQUEST['sd_format'];
				$clean = $_REQUEST['sd_clean'];
				$oids = $_REQUEST['sd_oids'];
				break;
		}

		// Make it do a download, if necessary
		if (isset($_REQUEST['download'])) {
			header('Content-Type: application/download');
	
			if (isset($extensions[$format]))
				$ext = $extensions[$format];
			else
				$ext = 'txt';
	
			header('Content-Disposition: attachment; filename=dump.' . $ext);
		}
		else {
			header('Content-Type: text/plain');
		}
	
		// Include application functions
		$_no_output = true;
		include_once('libraries/lib.inc.php');
	
		if (isset($_REQUEST['query'])) $_REQUEST['query'] = trim(unserialize($_REQUEST['query']));

		// Set up the dump transaction
		$status = $localData->beginDump();

		// If the dump is not dataonly then dump the structure prefix
		if ($_REQUEST['what'] != 'dataonly')
			echo $localData->getTableDefPrefix($_REQUEST['table'], isset($clean));

		// If the dump is not structureonly then dump the actual data
		if ($_REQUEST['what'] != 'structureonly') {
			// Get database encoding
			$dbEncoding = $localData->getDatabaseEncoding();

			// Set fetch mode to NUM so that duplicate field names are properly returned
			$localData->conn->setFetchMode(ADODB_FETCH_NUM);

			// Execute the query, if set, otherwise grab all rows from the table
			if (isset($_REQUEST['table']))
				$rs = &$localData->dumpRelation($_REQUEST['table'], isset($oids));
			else
				$rs = $localData->conn->Execute($_REQUEST['query']);

			if ($format == 'copy') {
				$data->fieldClean($_REQUEST['table']);
				echo "COPY \"{$_REQUEST['table']}\"";
				if (isset($oids)) echo " WITH OIDS";
				echo " FROM stdin;\n";
				while (!$rs->EOF) {
					$first = true;
					while(list($k, $v) = each($rs->f)) {
						// Escape value
						// addCSlashes converts all weird ASCII characters to octal representation,
						// EXCEPT the 'special' ones like \r \n \t, etc.
						$v = addCSlashes($v, "\0..\37\177..\377");
						// We add an extra escaping slash onto octal encoded characters
						$v = ereg_replace('\\\\([0-7]{3})', '\\\\\1', $v);
						if ($first) {
							echo ($v == null) ? '\\N' : $v;
							$first = false;
						}
						else echo "\t", ($v == null) ? '\\N' : $v;
					}
					echo "\n";
					$rs->moveNext();
				}
				echo "\\.\n";
			}
			elseif ($format == 'html') {
				echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n";
				echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n";
				echo "<head>\r\n";
				echo "\t<title></title>\r\n";
				echo "\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset={$localData->codemap[$dbEncoding]}\" />\r\n";
				echo "</head>\r\n";
				echo "<body>\r\n";
				echo "<table class=\"phppgadmin\">\r\n";
				echo "\t<tr>\r\n";
				if (!$rs->EOF) {
					// Output header row
					$j = 0;
					foreach ($rs->f as $k => $v) {
						$finfo = $rs->fetchField($j++);
						if ($finfo->name == $localData->id && !isset($oids)) continue;
						echo "\t\t<th>", $misc->printVal($finfo->name, true), "</th>\r\n";
					}
				}
				echo "\t</tr>\r\n";
				while (!$rs->EOF) {
					echo "\t<tr>\r\n";
					$j = 0;
					foreach ($rs->f as $k => $v) {
						$finfo = $rs->fetchField($j++);
						if ($finfo->name == $localData->id && !isset($oids)) continue;
						echo "\t\t<td>", $misc->printVal($v, true, $finfo->type), "</td>\r\n";
					}
					echo "\t</tr>\r\n";
					$rs->moveNext();
				}
				echo "</table>\r\n";
				echo "</body>\r\n";
				echo "</html>\r\n";
			}
			elseif ($format == 'xml') {
				echo "<?xml version=\"1.0\"";
				if (isset($localData->codemap[$dbEncoding]))
					echo " encoding=\"{$localData->codemap[$dbEncoding]}\"";
				echo " ?>\n";
				echo "<data>\n";
				if (!$rs->EOF) {
					// Output header row
					$j = 0;
					echo "\t<header>\n";
					foreach ($rs->f as $k => $v) {
						$finfo = $rs->fetchField($j++);
						$name = htmlspecialchars($finfo->name);
						$type = htmlspecialchars($finfo->type);
						echo "\t\t<column name=\"{$name}\" type=\"{$type}\" />\n";
					}
					echo "\t</header>\n";
				}
				echo "\t<records>\n";
				while (!$rs->EOF) {
					$j = 0;
					echo "\t\t<row>\n";
					foreach ($rs->f as $k => $v) {
						$finfo = $rs->fetchField($j++);
						$name = htmlspecialchars($finfo->name);
						if ($v != null) $v = htmlspecialchars($v);
						echo "\t\t\t<column name=\"{$name}\"", ($v == null ? ' null="null"' : ''), ">{$v}</column>\n";
					}
					echo "\t\t</row>\n";
					$rs->moveNext();
				}
				echo "\t</records>\n";
				echo "</data>\n";
			}
			elseif ($format == 'sql') {
				$data->fieldClean($_REQUEST['table']);
				while (!$rs->EOF) {
					echo "INSERT INTO \"{$_REQUEST['table']}\" (";
					$first = true;
					$j = 0;
					foreach ($rs->f as $k => $v) {
						$finfo = $rs->fetchField($j++);
						$k = $finfo->name;
						// SQL (INSERT) format cannot handle oids
	//						if ($k == $localData->id) continue;
						// Output field
						$data->fieldClean($k);
						if ($first) echo "\"{$k}\"";
						else echo ", \"{$k}\"";

						if ($v != null) {
							// Output value
							// addCSlashes converts all weird ASCII characters to octal representation,
							// EXCEPT the 'special' ones like \r \n \t, etc.
							$v = addCSlashes($v, "\0..\37\177..\377");
							// We add an extra escaping slash onto octal encoded characters
							$v = ereg_replace('\\\\([0-7]{3})', '\\\1', $v);
							// Finally, escape all apostrophes
							$v = str_replace("'", "''", $v);
						}
						if ($first) {
							$values = ($v === null) ? 'NULL' : "'{$v}'";
							$first = false;
						}
						else $values .= ', ' . (($v === null) ? 'NULL' : "'{$v}'");
					}
					echo ") VALUES ({$values});\n";
					$rs->moveNext();
				}
			}
			else {
				switch ($format) {
					case 'tab':
						$sep = "\t";
						break;
					case 'csv':
					default:
						$sep = ',';
						break;
				}
				if (!$rs->EOF) {
					// Output header row
					$first = true;
					foreach ($rs->f as $k => $v) {
						$finfo = $rs->fetchField($k);
						$v = $finfo->name;
						if ($v != null) $v = str_replace('"', '""', $v);
						if ($first) {
							echo "\"{$v}\"";
							$first = false;
						}
						else echo "{$sep}\"{$v}\"";
					}
					echo "\r\n";
				}
				while (!$rs->EOF) {
					$first = true;
					foreach ($rs->f as $k => $v) {
						if ($v != null) $v = str_replace('"', '""', $v);
						if ($first) {
							echo ($v == null) ? "\"\\N\"" : "\"{$v}\"";
							$first = false;
						}
						else echo ($v == null) ? "{$sep}\"\\N\"" : "{$sep}\"{$v}\"";
					}
					echo "\r\n";
					$rs->moveNext();
				}
			}
		}

		// If the dump is not dataonly then dump the structure suffix
		if ($_REQUEST['what'] != 'dataonly') {
			// Set fetch mode back to ASSOC for the table suffix to work
			$localData->conn->setFetchMode(ADODB_FETCH_ASSOC);
			echo $localData->getTableDefSuffix($_REQUEST['table']);
		}

		// Finish the dump transaction
		$status = $localData->endDump();
	}
	else {
		if (!isset($msg)) $msg = null;
		
		// Include application functions
		include_once('libraries/lib.inc.php');

		$misc->printHeader($lang['strexport']);		
		echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strexport']}</h2>\n";
		$misc->printMsg($msg);

		echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"post\">\n";
		echo "<table>\n";
		echo "<tr><th class=\"data\">{$lang['strformat']}:</th><td><select name=\"d_format\">\n";
		// COPY and SQL require a table
		if (isset($_REQUEST['table'])) {
			echo "<option value=\"copy\">COPY</option>\n";
			echo "<option value=\"sql\">SQL</option>\n";
		}
		echo "<option value=\"csv\">CSV</option>\n";
		echo "<option value=\"tab\">Tabbed</option>\n";
		echo "<option value=\"html\">XHTML</option>\n";
		echo "<option value=\"xml\">XML</option>\n";
		echo "</select></td></tr>";
		echo "<tr><th class=\"data\">{$lang['strdownload']}</th><td><input type=\"checkbox\" name=\"download\" /></td></tr>";
		echo "</table>\n";

		echo "<p><input type=\"hidden\" name=\"action\" value=\"export\" />\n";
		echo "<input type=\"hidden\" name=\"what\" value=\"dataonly\" />\n";
		if (isset($_REQUEST['table'])) {
			echo "<input type=\"hidden\" name=\"table\" value=\"", htmlspecialchars($_REQUEST['table']), "\" />\n";
		}
		echo "<input type=\"hidden\" name=\"query\" value=\"", htmlspecialchars(serialize($_REQUEST['query'])), "\" />\n";
		echo $misc->form;
		echo "<input type=\"submit\" value=\"{$lang['strexport']}\" /></p>\n";
		echo "</form>\n";
	}	

?>
