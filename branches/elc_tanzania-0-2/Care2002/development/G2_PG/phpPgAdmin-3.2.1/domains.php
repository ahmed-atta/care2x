<?php

	/**
	 * Manage domains in a database
	 *
	 * $Id$
	 */

	// Include application functions
	include_once('libraries/lib.inc.php');
	
	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	if (!isset($msg)) $msg = '';
	$PHP_SELF = $_SERVER['PHP_SELF'];
	
	/** 
	 * Function to save after altering a domain
	 */
	function doSaveAlter() {
		global $localData, $lang;
		
		$status = $localData->alterDomain($_POST['domain'], $_POST['domdefault'], 
			isset($_POST['domnotnull']), $_POST['domowner']);
		if ($status == 0)
			doProperties($lang['strdomainaltered']);
		else
			doAlter($lang['strdomainalteredbad']);
	}

	/**
	 * Allow altering a domain
	 */
	function doAlter($msg = '') {
		global $data, $localData, $misc;
		global $PHP_SELF, $lang;
	
		echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strdomains']}: ", $misc->printVal($_REQUEST['domain']), ": {$lang['stralter']}</h2>\n";
		$misc->printMsg($msg);
		
		// Fetch domain info
		$domaindata = &$localData->getDomain($_REQUEST['domain']);
		// Fetch all users
		$users = &$data->getUsers();
		
		if ($domaindata->recordCount() > 0) {
			if (!isset($_POST['domname'])) {				
				$_POST['domtype'] = $domaindata->f['domtype'];
				$_POST['domdefault'] = $domaindata->f['domdef'];
				$domaindata->f['domnotnull'] = $data->phpBool($domaindata->f['domnotnull']);
				if ($domaindata->f['domnotnull']) $_POST['domnotnull'] = 'on';
				$_POST['domowner'] = $domaindata->f['domowner'];
			}
			
			// Display domain info
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<table>\n";
			echo "<tr><th class=\"data\" width=\"70\">{$lang['strname']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($domaindata->f['domname']), "</td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strtype']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($domaindata->f['domtype']), "</td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strnotnull']}</th>\n";
			echo "<td class=\"data1\"><input type=\"checkbox\" name=\"domnotnull\"", (isset($_POST['domnotnull']) ? ' checked="checked"' : ''), " /></td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strdefault']}</th>\n";
			echo "<td class=\"data1\"><input name=\"domdefault\" size=\"32\" maxlength=\"{$data->_maxNameLen}\" value=\"", 
				htmlspecialchars($_POST['domdefault']), "\" /></td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strowner']}</th>\n";
			echo "<td class=\"data1\"><select name=\"domowner\">";
			while (!$users->EOF) {
				$uname = $users->f[$data->uFields['uname']];
				echo "<option value=\"", htmlspecialchars($uname), "\"",
					($uname == $_POST['domowner']) ? ' selected="selected"' : '', ">", htmlspecialchars($uname), "</option>\n";
				$users->moveNext();
			}
			echo "</select></td></tr>\n";				
			echo "</table>\n";
			echo "<p><input type=\"hidden\" name=\"action\" value=\"save_alter\" />\n";
			echo "<input type=\"hidden\" name=\"domain\" value=\"", htmlspecialchars($_REQUEST['domain']), "\" />\n";
			echo $misc->form;
			echo "<input type=\"submit\" name=\"alter\" value=\"{$lang['stralter']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
			echo "</form>\n";
		}
		else echo "<p>{$lang['strnodata']}</p>\n";
	}
	
	/**
	 * Confirm and then actually add a CHECK constraint
	 */
	function addCheck($confirm, $msg = '') {
		global $PHP_SELF, $data, $localData, $misc;
		global $lang;

		if (!isset($_POST['name'])) $_POST['name'] = '';
		if (!isset($_POST['definition'])) $_POST['definition'] = '';

		if ($confirm) {
			echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strdomains']}: ",
				$misc->printVal($_REQUEST['domain']), ": {$lang['straddcheck']}</h2>\n";
			$misc->printMsg($msg);

			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<table>\n";
			echo "<tr><th class=\"data\">{$lang['strname']}</th>\n";
			echo "<th class=\"data\">{$lang['strdefinition']}</th></tr>\n";

			echo "<tr><td class=\"data1\"><input name=\"name\" size=\"16\" maxlength=\"{$data->_maxNameLen}\" value=\"",
				htmlspecialchars($_POST['name']), "\" /></td>\n";

			echo "<td class=\"data1\">(<input name=\"definition\" size=\"32\" value=\"",
				htmlspecialchars($_POST['definition']), "\" />)</td></tr>\n";
			echo "</table>\n";

			echo "<input type=\"hidden\" name=\"action\" value=\"save_add_check\" />\n";
			echo "<input type=\"hidden\" name=\"domain\" value=\"", htmlspecialchars($_REQUEST['domain']), "\" />\n";
			echo $misc->form;
			echo "<p><input type=\"submit\" name=\"ok\" value=\"{$lang['strok']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
			echo "</form>\n";

		}
		else {
			if (trim($_POST['definition']) == '')
				addCheck(true, $lang['strcheckneedsdefinition']);
			else {
				$status = $localData->addDomainCheckConstraint($_POST['domain'],
					$_POST['definition'], $_POST['name']);
				if ($status == 0)
					doProperties($lang['strcheckadded']);
				else
					addCheck(true, $lang['strcheckaddedbad']);
			}
		}
	}

	/**
	 * Show confirmation of drop constraint and perform actual drop
	 */
	function doDropConstraint($confirm, $msg = '') {
		global $localData, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) { 
			echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strdomains']}: ", 
				$misc->printVal($_REQUEST['domain']), ": ", $misc->printVal($_REQUEST['constraint']), ": {$lang['strdrop']}</h2>\n";
			$misc->printMsg($msg);
			
			echo "<p>", sprintf($lang['strconfdropconstraint'], $misc->printVal($_REQUEST['constraint']), 
				$misc->printVal($_REQUEST['domain'])), "</p>\n";	
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"drop_con\" />\n";
			echo "<input type=\"hidden\" name=\"domain\" value=\"", htmlspecialchars($_REQUEST['domain']), "\" />\n";
			echo "<input type=\"hidden\" name=\"constraint\" value=\"", htmlspecialchars($_REQUEST['constraint']), "\" />\n";
			echo $misc->form;
			// Show cascade drop option if supportd
			if ($localData->hasDropBehavior()) {
				echo "<p><input type=\"checkbox\" name=\"cascade\" /> {$lang['strcascade']}</p>\n";
			}
			echo "<input type=\"submit\" name=\"yes\" value=\"{$lang['stryes']}\" />\n";
			echo "<input type=\"submit\" name=\"no\" value=\"{$lang['strno']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $localData->dropDomainConstraint($_POST['domain'], $_POST['constraint'], isset($_POST['cascade']));
			if ($status == 0)
				doProperties($lang['strconstraintdropped']);
			else
				doDropConstraint(true, $lang['strconstraintdroppedbad']);
		}
		
	}
	
	/**
	 * Show properties for a domain.  Allow manipulating constraints as well.
	 */
	function doProperties($msg = '') {
		global $data, $localData, $misc;
		global $PHP_SELF, $lang;
	
		echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strdomains']}: ", $misc->printVal($_REQUEST['domain']), ": {$lang['strproperties']}</h2>\n";
		$misc->printMsg($msg);
		
		$domaindata = &$localData->getDomain($_REQUEST['domain']);
		
		if ($domaindata->recordCount() > 0) {
			// Display domain info
			$domaindata->f['domnotnull'] = $data->phpBool($domaindata->f['domnotnull']);
			echo "<table>\n";
			echo "<tr><th class=\"data\" width=\"70\">{$lang['strname']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($domaindata->f['domname']), "</td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strtype']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($domaindata->f['domtype']), "</td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strnotnull']}</th>\n";
			echo "<td class=\"data1\">", ($domaindata->f['domnotnull'] ? 'NOT NULL' : ''), "</td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strdefault']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($domaindata->f['domdef']), "</td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strowner']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($domaindata->f['domowner']), "</td></tr>\n";
			echo "</table>\n";
			
			// Display domain constraints
			if ($data->hasDomainConstraints()) {
				$domaincons = &$localData->getDomainConstraints($_REQUEST['domain']);
				if ($domaincons->recordCount() > 0) {
					echo "<h3>{$lang['strconstraints']}</h3>\n";
					echo "<table>\n";
					echo "<tr><th class=\"data\">{$lang['strname']}</th><th class=\"data\">{$lang['strdefinition']}</th><th class=\"data\">{$lang['stractions']}</th>\n";
					$i = 0;
					
					while (!$domaincons->EOF) {
						$id = (($i % 2 ) == 0 ? '1' : '2');
						echo "<tr><td class=\"data{$id}\">", $misc->printVal($domaincons->f[$data->cnFields['conname']]), "</td>";
						echo "<td class=\"data{$id}\">";
						echo $misc->printVal($domaincons->f[$data->cnFields['consrc']]);
						echo "</td>";
						echo "<td class=\"opbutton{$id}\">";
						echo "<a href=\"$PHP_SELF?action=confirm_drop_con&{$misc->href}&constraint=", urlencode($domaincons->f[$data->cnFields['conname']]),
							"&domain=", urlencode($_REQUEST['domain']), "&type=", urlencode($domaincons->f['contype']), "\">{$lang['strdrop']}</td></tr>\n";
		
						$domaincons->moveNext();
						$i++;
					}
					
					echo "</table>\n";
				}
			}
		}
		else echo "<p>{$lang['strnodata']}</p>\n";
		
		echo "<p><a class=\"navlink\" href=\"$PHP_SELF?{$misc->href}\">{$lang['strshowalldomains']}</a>\n";
		if ($data->hasDomainConstraints()) {
			echo "| <a class=\"navlink\" href=\"{$PHP_SELF}?action=add_check&{$misc->href}&domain=", urlencode($_REQUEST['domain']),
				"\">{$lang['straddcheck']}</a>\n";
			echo "| <a class=\"navlink\" href=\"$PHP_SELF?action=alter&{$misc->href}&domain=", 
				urlencode($_REQUEST['domain']), "\">{$lang['stralter']}</a>\n";
		}
		echo "</p>\n";
	}
	
	/**
	 * Show confirmation of drop and perform actual drop
	 */
	function doDrop($confirm) {
		global $localData, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) { 
			echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strdomains']}: ", $misc->printVal($_REQUEST['domain']), ": {$lang['strdrop']}</h2>\n";
			
			echo "<p>", sprintf($lang['strconfdropdomain'], $misc->printVal($_REQUEST['domain'])), "</p>\n";	
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"drop\" />\n";
			echo "<input type=\"hidden\" name=\"domain\" value=\"", htmlspecialchars($_REQUEST['domain']), "\" />\n";
			echo $misc->form;
			// Show cascade drop option if supportd
			if ($localData->hasDropBehavior()) {
				echo "<p><input type=\"checkbox\" name=\"cascade\" /> {$lang['strcascade']}</p>\n";
			}
			echo "<input type=\"submit\" name=\"drop\" value=\"{$lang['strdrop']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $localData->dropDomain($_POST['domain'], isset($_POST['cascade']));
			if ($status == 0)
				doDefault($lang['strdomaindropped']);
			else
				doDefault($lang['strdomaindroppedbad']);
		}
		
	}
	
	/**
	 * Displays a screen where they can enter a new domain
	 */
	function doCreate($msg = '') {
		global $data, $localData, $misc;
		global $PHP_SELF, $lang;
		
		if (!isset($_POST['domname'])) $_POST['domname'] = '';
		if (!isset($_POST['domtype'])) $_POST['domtype'] = '';
		if (!isset($_POST['domdefault'])) $_POST['domdefault'] = '';
		if (!isset($_POST['domcheck'])) $_POST['domcheck'] = '';

		$types = &$localData->getTypes(true);
		
		echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strdomains']}: {$lang['strcreatedomain']}</h2>\n";
		$misc->printMsg($msg);

		echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
		echo "<table>\n";
		echo "<tr><th class=\"data\" width=\"70\">{$lang['strname']}</th>\n";
		echo "<td class=\"data1\"><input name=\"domname\" size=\"32\" maxlength=\"{$data->_maxNameLen}\" value=\"", 
			htmlspecialchars($_POST['domname']), "\" /></td></tr>\n";
		echo "<tr><th class=\"data\">{$lang['strtype']}</th>\n";
		echo "<td class=\"data1\">\n";
		// Output return type list		
		echo "<select name=\"domtype\">\n";
		while (!$types->EOF) {
			echo "<option value=\"", htmlspecialchars($types->f[$data->typFields['typname']]), "\"", 
				($types->f[$data->typFields['typname']] == $_POST['domtype']) ? ' selected="selected"' : '', ">",
				$misc->printVal($types->f[$data->typFields['typname']]), "</option>\n";
			$types->moveNext();
		}
		echo "</select>\n";		
		echo "</td></tr>\n";
		echo "<tr><th class=\"data\">{$lang['strnotnull']}</th>\n";
		echo "<td class=\"data1\"><input type=\"checkbox\" name=\"domnotnull\"", 
			(isset($_POST['domnotnull']) ? ' checked="checked"' : ''), " /></td></tr>\n";
		echo "<tr><th class=\"data\">{$lang['strdefault']}</th>\n";
		echo "<td class=\"data1\"><input name=\"domdefault\" size=\"32\" maxlength=\"{$data->_maxNameLen}\" value=\"", 
			htmlspecialchars($_POST['domdefault']), "\" /></td></tr>\n";
		if ($data->hasDomainConstraints()) {
			echo "<tr><th class=\"data\">{$lang['strconstraints']}</th>\n";
			echo "<td class=\"data1\">CHECK (<input name=\"domcheck\" size=\"32\" maxlength=\"{$data->_maxNameLen}\" value=\"", 
				htmlspecialchars($_POST['domcheck']), "\" />)</td></tr>\n";
		}
		echo "</table>\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"save_create\" />\n";
		echo $misc->form;
		echo "<p><input type=\"submit\" value=\"{$lang['strcreate']}\" />\n";
		echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
		echo "</form>\n";
	}
	
	/**
	 * Actually creates the new domain in the database
	 */
	function doSaveCreate() {
		global $localData, $lang;
		
		if (!isset($_POST['domcheck'])) $_POST['domcheck'] = '';

		// Check that they've given a name and a definition
		if ($_POST['domname'] == '') doCreate($lang['strdomainneedsname']);
		else {		 
			$status = $localData->createDomain($_POST['domname'], $_POST['domtype'], 
																isset($_POST['domnotnull']), $_POST['domdefault'], $_POST['domcheck']);
			if ($status == 0)
				doDefault($lang['strdomaincreated']);
			else
				doCreate($lang['strdomaincreatedbad']);
		}
	}	

	/**
	 * Show default list of domains in the database
	 */
	function doDefault($msg = '') {
		global $data, $localData, $misc;
		global $PHP_SELF, $lang;
		
		echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strdomains']}</h2>\n";
		$misc->printMsg($msg);
		
		$domains = &$localData->getDomains();
		
		if ($domains->recordCount() > 0) {
			echo "<table>\n";
			echo "<tr><th class=\"data\">{$lang['strdomain']}</th><th class=\"data\">{$lang['strnotnull']}</th>";
			echo "<th class=\"data\">{$lang['strdefault']}</th><th class=\"data\">{$lang['strowner']}</th>";
			echo "<th colspan=\"2\" class=\"data\">{$lang['stractions']}</th></tr>\n";
			$i = 0;
			while (!$domains->EOF) {
				$domains->f['domnotnull'] = $data->phpBool($domains->f['domnotnull']);
				$id = (($i % 2) == 0 ? '1' : '2');
				echo "<tr><td class=\"data{$id}\">", $misc->printVal($domains->f['domname']), "</td>\n";
				echo "<td class=\"data{$id}\">", ($domains->f['domnotnull'] ? 'NOT NULL' : ''), "</td>\n";
				echo "<td class=\"data{$id}\">", $misc->printVal($domains->f['domdef']), "</td>\n";
				echo "<td class=\"data{$id}\">", $misc->printVal($domains->f['domowner']), "</td>\n";
				echo "<td class=\"opbutton{$id}\"><a href=\"$PHP_SELF?action=properties&{$misc->href}&domain=", urlencode($domains->f['domname']), "\">{$lang['strproperties']}</a></td>\n"; 
				echo "<td class=\"opbutton{$id}\"><a href=\"$PHP_SELF?action=confirm_drop&{$misc->href}&domain=", urlencode($domains->f['domname']), "\">{$lang['strdrop']}</a></td>\n";
				echo "</tr>\n";
				$domains->moveNext();
				$i++;
			}
			echo "</table>\n";
		}
		else {
			echo "<p>{$lang['strnodomains']}</p>\n";
		}
		
		echo "<p><a class=\"navlink\" href=\"$PHP_SELF?action=create&{$misc->href}\">{$lang['strcreatedomain']}</a></p>\n";

	}

	$misc->printHeader($lang['strdomains']);
	$misc->printBody();

	switch ($action) {
		case 'add_check':
			addCheck(true);
			break;
		case 'save_add_check':
			if (isset($_POST['cancel'])) doProperties();
			else addCheck(false);
			break;
		case 'drop_con':
			if (isset($_POST['yes'])) doDropConstraint(false);
			else doProperties();
			break;
		case 'confirm_drop_con':
			doDropConstraint(true);
			break;			
		case 'save_create':
			if (isset($_POST['cancel'])) doDefault();
			else doSaveCreate();
			break;
		case 'create':
			doCreate();
			break;
		case 'drop':
			if (isset($_POST['drop'])) doDrop(false);
			else doDefault();
			break;
		case 'confirm_drop':
			doDrop(true);
			break;			
		case 'save_alter':
			if (isset($_POST['alter'])) doSaveAlter();
			else doProperties();
			break;
		case 'alter':
			doAlter();
			break;
		case 'properties':
			doProperties();
			break;
		default:
			doDefault();
			break;
	}	

	$misc->printFooter();
	
?>
