<?php

	/**
	 * List rules on a table
	 *
	 * $Id: rules.php,v 1.1 2006/01/13 13:42:14 irroal Exp $
	 */

	// Include application functions
	include_once('libraries/lib.inc.php');

	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	$PHP_SELF = $_SERVER['PHP_SELF'];

	/**
	 * Confirm and then actually create a rule
	 */
	function createRule($confirm, $msg = '') {
		global $PHP_SELF, $data, $localData, $misc;
		global $lang;

		if (!isset($_POST['name'])) $_POST['name'] = '';
		if (!isset($_POST['event'])) $_POST['event'] = '';
		if (!isset($_POST['where'])) $_POST['where'] = '';
		if (!isset($_POST['type'])) $_POST['type'] = 'SOMETHING';
		if (!isset($_POST['raction'])) $_POST['raction'] = '';

		if ($confirm) {
			echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strtables']}: ",
				$misc->printVal($_REQUEST['table']), ": {$lang['strcreaterule']}</h2>\n";
			$misc->printMsg($msg);

			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<table>\n";
			echo "<tr><th class=\"data\">{$lang['strname']}</th>\n";
			echo "<td class=\"data1\"><input name=\"name\" size=\"16\" maxlength=\"{$data->_maxNameLen}\" value=\"",
				htmlspecialchars($_POST['name']), "\" /></td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strevent']}</th>\n";
			echo "<td class=\"data1\"><select name=\"event\">\n";
			foreach ($data->rule_events as $v) {
				echo "<option value=\"{$v}\"", ($v == $_POST['event']) ? ' selected="selected"' : '',
				">{$v}</option>\n";
			}
			echo "</select></td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strwhere']}</th>\n";
			echo "<td class=\"data1\"><input name=\"where\" size=\"32\" value=\"",
				htmlspecialchars($_POST['where']), "\" /></td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['strinstead']}</th>\n";
			echo "<td class=\"data1\">";
			echo "<input type=\"checkbox\" name=\"instead\" ", (isset($_POST['instead'])) ? ' checked="checked"' : '', " />\n";
			echo "</td></tr>\n";
			echo "<tr><th class=\"data\">{$lang['straction']}</th>\n";
			echo "<td class=\"data1\">";
			echo "<input type=\"radio\" name=\"type\" value=\"NOTHING\"", ($_POST['type'] == 'NOTHING') ? ' checked="checked"' : '', " /> NOTHING<br />\n";
			echo "<input type=\"radio\" name=\"type\" value=\"SOMETHING\"", ($_POST['type'] == 'SOMETHING') ? ' checked="checked"' : '', " />\n";
			echo "(<input name=\"raction\" size=\"32\" value=\"",
				htmlspecialchars($_POST['raction']), "\" />)</td></tr>\n";
			echo "</table>\n";

			echo "<input type=\"hidden\" name=\"action\" value=\"save_create_rule\" />\n";
			echo "<input type=\"hidden\" name=\"table\" value=\"", htmlspecialchars($_REQUEST['table']), "\" />\n";
			echo $misc->form;
			echo "<p><input type=\"submit\" name=\"ok\" value=\"{$lang['strcreate']}\" /> <input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
			echo "</form>\n";

		}
		else {
			if (trim($_POST['name']) == '')
				createRule(true, $lang['strruleneedsname']);
			else {
				$status = $localData->createRule($_POST['name'],
					$_POST['event'], $_POST['table'], $_POST['where'],
					isset($_POST['instead']), $_POST['type'], $_POST['raction']);
				if ($status == 0)
					doDefault($lang['strrulecreated']);
				else
					createRule(true, $lang['strrulecreatedbad']);
			}
		}
	}

	/**
	 * Show confirmation of drop and perform actual drop
	 */
	function doDrop($confirm) {
		global $localData, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) {
			echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strtables']}: ",
				$misc->printVal($_REQUEST['table']), ": " , $misc->printVal($_REQUEST['rule']), ": {$lang['strdrop']}</h2>\n";

			echo "<p>", sprintf($lang['strconfdroprule'], $misc->printVal($_REQUEST['rule']),
				$misc->printVal($_REQUEST['table'])), "</p>\n";

			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"drop\" />\n";
			echo "<input type=\"hidden\" name=\"table\" value=\"", htmlspecialchars($_REQUEST['table']), "\" />\n";
			echo "<input type=\"hidden\" name=\"rule\" value=\"", htmlspecialchars($_REQUEST['rule']), "\" />\n";
			echo $misc->form;
			// Show cascade drop option if supportd
			if ($localData->hasDropBehavior()) {
				echo "<p><input type=\"checkbox\" name=\"cascade\" /> {$lang['strcascade']}</p>\n";
			}
			echo "<input type=\"submit\" name=\"yes\" value=\"{$lang['stryes']}\" /> <input type=\"submit\" name=\"no\" value=\"{$lang['strno']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $localData->dropRule($_POST['rule'], $_POST['table'], isset($_POST['cascade']));
			if ($status == 0)
				doDefault($lang['strruledropped']);
			else
				doDefault($lang['strruledroppedbad']);
		}

	}

	/**
	 * List all the rules on the table
	 */
	function doDefault($msg = '') {
		global $data, $localData, $misc;
		global $PHP_SELF;
		global $lang;

		$misc->printTableNav();
		echo "<h2>", $misc->printVal($_REQUEST['database']), ": ", $misc->printVal($_REQUEST['table']), ": {$lang['strrules']}</h2>\n";
		$misc->printMsg($msg);

		$rules = &$localData->getRules($_REQUEST['table']);
		
		if ($rules->recordCount() > 0) {
			echo "<table>\n";
			echo "<tr><th class=\"data\">{$lang['strname']}</th><th class=\"data\">{$lang['strdefinition']}</th><th class=\"data\">{$lang['stractions']}</th>\n";
			$i = 0;
			
			while (!$rules->EOF) {
				$id = ( ($i % 2 ) == 0 ? '1' : '2' );
				echo "<tr><td class=\"data{$id}\">", $misc->printVal( $rules->f[$data->rlFields['rulename']]), "</td>";
				echo "<td class=\"data{$id}\">", $misc->printVal( $rules->f[$data->rlFields['ruledef']]), "</td>";
				echo "<td class=\"opbutton{$id}\">";
				echo "<a href=\"$PHP_SELF?action=confirm_drop&{$misc->href}&rule=", urlencode($rules->f[$data->rlFields['rulename']]),
					"&table=", urlencode($_REQUEST['table']), "\">{$lang['strdrop']}</a></td></tr>\n";

				$rules->movenext();
				$i++;
			}

			echo "</table>\n";
			}
		else
			echo "<p>{$lang['strnorules']}</p>\n";

		echo "<p><a class=\"navlink\" href=\"{$PHP_SELF}?action=create_rule&{$misc->href}&table=", urlencode($_REQUEST['table']),
			"\">{$lang['strcreaterule']}</a></p>\n";
	}

	$misc->printHeader($lang['strtables'] . ' - ' . $_REQUEST['table'] . ' - ' . $lang['strrules']);
	$misc->printBody();
	
	switch ($action) {
		case 'create_rule':
			createRule(true);
			break;
		case 'save_create_rule':
			if (isset($_POST['cancel'])) doDefault();
			else createRule(false);
			break;
		case 'drop':
			if (isset($_POST['yes'])) doDrop(false);
			else doDefault();
			break;
		case 'confirm_drop':
			doDrop(true);
			break;
		default:
			doDefault();
			break;
	}
	
	$misc->printFooter();

?>
