<?php

	/**
	 * Manage groups in a database cluster
	 *
	 * $Id$
	 */

	// Include application functions
	include_once('libraries/lib.inc.php');

	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	if (!isset($msg)) $msg = '';
	$PHP_SELF = $_SERVER['PHP_SELF'];

	/**
	 * Add user to a group
	 */
	function doAddMember() {
		global $data, $misc;
		global $PHP_SELF, $lang;

		$status = $data->addGroupMember($_REQUEST['groname'], $_REQUEST['user']);
		if ($status == 0)
			doProperties($lang['strmemberadded']);
		else
			doProperties($lang['strmemberaddedbad']);
	}
	
	/**
	 * Show confirmation of drop user from group and perform actual drop
	 */
	function doDropMember($confirm) {
		global $data, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) { 
			echo "<h2>{$lang['strgroups']}: ", $misc->printVal($_REQUEST['groname']), ": {$lang['strdropmember']}</h2>\n";
			
			echo "<p>", sprintf($lang['strconfdropmember'], $misc->printVal($_REQUEST['user']), $misc->printVal($_REQUEST['groname'])), "</p>\n";
			
			echo "<form action=\"{$PHP_SELF}\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"drop_member\" />\n";
			echo "<input type=\"hidden\" name=\"groname\" value=\"", htmlspecialchars($_REQUEST['groname']), "\" />\n";
			echo "<input type=\"hidden\" name=\"user\" value=\"", htmlspecialchars($_REQUEST['user']), "\" />\n";
			echo "<input type=\"submit\" name=\"drop\" value=\"{$lang['strdrop']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $data->dropGroupMember($_REQUEST['groname'], $_REQUEST['user']);
			if ($status == 0)
				doProperties($lang['strmemberdropped']);
			else
				doDropMember(true, $lang['strmemberdroppedbad']);
		}		
	}
	
	/**
	 * Show read only properties for a group
	 */
	function doProperties($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;
	
		if (!isset($_POST['user'])) $_POST['user'] = '';
	
		echo "<h2>{$lang['strgroup']}: ", $misc->printVal($_REQUEST['groname']), ": {$lang['strproperties']}</h2>\n";
		$misc->printMsg($msg);
		
		$groupdata = &$data->getGroup($_REQUEST['groname']);
		$users = &$data->getUsers();
		
		if ($groupdata->recordCount() > 0) {
			echo "<table>\n";
           	echo "<tr><th class=\"data\">{$lang['strmembers']}</th><th class=\"data\">{$lang['stractions']}</th></tr>\n";
           	$i = 0;
           	while (!$groupdata->EOF) {
					$id = (($i % 2) == 0 ? '1' : '2');
            	echo "<tr><td class=\"data{$id}\">", $misc->printVal($groupdata->f[$data->uFields['uname']]), "</td>\n";
					echo "<td class=\"opbutton{$id}\"><a href=\"$PHP_SELF?action=confirm_drop_member&{$misc->href}&groname=",
						urlencode($_REQUEST['groname']), "&user=", urlencode($groupdata->f[$data->uFields['uname']]), "\">{$lang['strdrop']}</a></td>\n";
            	echo "</tr>\n";
            	$groupdata->moveNext();
           	}
			echo "</table>\n";
		}
		else echo "<p>{$lang['strnousers']}</p>\n";

		// Display form for adding a user to the group			
		echo "<form action=\"{$PHP_SELF}\" method=\"post\">\n";
		echo "<select name=\"user\">";
		while (!$users->EOF) {
			$uname = $misc->printVal($users->f[$data->uFields['uname']]);
			echo "<option value=\"{$uname}\"",
				($uname == $_POST['user']) ? ' selected="selected"' : '', ">{$uname}</option>\n";
			$users->moveNext();
		}
		echo "</select>\n";
		echo "<input type=\"submit\" value=\"{$lang['straddmember']}\" />\n";
		echo $misc->form;
		echo "<input type=\"hidden\" name=\"groname\" value=\"", htmlspecialchars($_REQUEST['groname']), "\" />\n";
		echo "<input type=\"hidden\" name=\"action\" value=\"add_member\" />\n";
		echo "</form>\n";
		
		echo "<p><a class=\"navlink\" href=\"$PHP_SELF\">{$lang['strshowallgroups']}</a></p>\n";
	}
	
	/**
	 * Show confirmation of drop and perform actual drop
	 */
	function doDrop($confirm) {
		global $data, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) { 
			echo "<h2>{$lang['strgroups']}: ", $misc->printVal($_REQUEST['groname']), ": {$lang['strdrop']}</h2>\n";
			
			echo "<p>", sprintf($lang['strconfdropgroup'], $misc->printVal($_REQUEST['groname'])), "</p>\n";
			
			echo "<form action=\"{$PHP_SELF}\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"drop\" />\n";
			echo "<input type=\"hidden\" name=\"groname\" value=\"", htmlspecialchars($_REQUEST['groname']), "\" />\n";
			echo "<input type=\"submit\" name=\"drop\" value=\"{$lang['strdrop']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $data->dropGroup($_REQUEST['groname']);
			if ($status == 0)
				doDefault($lang['strgroupdropped']);
			else
				doDefault($lang['strgroupdroppedbad']);
		}		
	}
	
	/**
	 * Displays a screen where they can enter a new group
	 */
	function doCreate($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;
		
		if (!isset($_POST['name'])) $_POST['name'] = '';
		if (!isset($_POST['members'])) $_POST['members'] = array();

		// Fetch a list of all users in the cluster
		$users = &$data->getUsers();
		
		echo "<h2>{$lang['strgroups']}: {$lang['strcreategroup']}</h2>\n";
		$misc->printMsg($msg);

		echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
		echo "<table>\n";
		echo "\t<tr>\n\t\t<th class=\"data left required\">{$lang['strname']}</th>\n";
		echo "\t\t<td class=\"data\"><input size=\"32\" maxlength=\"{$data->_maxNameLen}\" name=\"name\" value=\"", htmlspecialchars($_POST['name']), "\" /></td>\n\t</tr>\n";
		if ($users->recordCount() > 0) {
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strmembers']}</th>\n";

			echo "\t\t<td class=\"data\">\n";
			echo "\t\t\t<select name=\"members[]\" multiple=\"multiple\" size=\"", min(6, $users->recordCount()), "\">\n";
			while (!$users->EOF) {
				$username = $users->f[$data->uFields['uname']];
				echo "\t\t\t\t<option value=\"{$username}\"",
						(in_array($username, $_POST['members']) ? ' selected="selected"' : ''), ">", $misc->printVal($username), "</option>\n";
				$users->moveNext();
			}
			echo "\t\t\t</select>\n";
			echo "\t\t</td>\n\t</tr>\n";
			}
		echo "</table>\n";
		echo "<p><input type=\"hidden\" name=\"action\" value=\"save_create\" />\n";
		echo "<input type=\"submit\" value=\"{$lang['strcreate']}\" />\n";
		echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
		echo "</form>\n";
	}
	
	/**
	 * Actually creates the new group in the database
	 */
	function doSaveCreate() {
		global $data;
		global $lang;

		if (!isset($_POST['members'])) $_POST['members'] = array();

		// Check form vars
		if (trim($_POST['name']) == '')
			doCreate($lang['strgroupneedsname']);
		else {		
			$status = $data->createGroup($_POST['name'], $_POST['members']);
			if ($status == 0)
				doDefault($lang['strgroupcreated']);
			else
				doCreate($lang['strgroupcreatedbad']);
		}
	}	

	/**
	 * Show default list of groups in the database
	 */
	function doDefault($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;
		
		echo "<h2>{$lang['strgroups']}</h2>\n";
		$misc->printMsg($msg);
		
		$groups = &$data->getGroups();
		
		if ($groups->recordCount() > 0) {
			echo "<table>\n";
			echo "<tr><th class=\"data\">{$lang['strgroup']}</th><th colspan=\"2\" class=\"data\">{$lang['stractions']}</th></tr>\n";
			$i = 0;
			while (!$groups->EOF) {
				$id = (($i % 2) == 0 ? '1' : '2');
				echo "<tr><td class=\"data{$id}\">", $misc->printVal($groups->f[$data->grpFields['groname']]), "</td>\n";
				echo "<td class=\"opbutton{$id}\"><a href=\"$PHP_SELF?action=properties&groname=",
					urlencode($groups->f[$data->grpFields['groname']]), "\">{$lang['strproperties']}</a></td>\n";
				echo "<td class=\"opbutton{$id}\"><a href=\"$PHP_SELF?action=confirm_drop&groname=", 
					urlencode($groups->f[$data->grpFields['groname']]), "\">{$lang['strdrop']}</a></td>\n";
				echo "</tr>\n";
				$groups->moveNext();
				$i++;
			}
			echo "</table>\n";
		}
		else {
			echo "<p>{$lang['strnogroups']}</p>\n";
		}
		
		echo "<p><a class=\"navlink\" href=\"$PHP_SELF?action=create\">{$lang['strcreategroup']}</a></p>\n";

	}

	$misc->printHeader($lang['strgroups']);
	$misc->printBody();

	switch ($action) {
		case 'add_member':
			doAddMember();
			break;
		case 'drop_member':
			if (isset($_REQUEST['drop'])) doDropMember(false);
			else doProperties();
			break;
		case 'confirm_drop_member':
			doDropMember(true);
			break;			
		case 'save_create':
			if (isset($_REQUEST['cancel'])) doDefault();
			else doSaveCreate();
			break;
		case 'create':
			doCreate();
			break;
		case 'drop':
			if (isset($_REQUEST['drop'])) doDrop(false);
			else doDefault();
			break;
		case 'confirm_drop':
			doDrop(true);
			break;			
		case 'save_edit':
			doSaveEdit();
			break;
		case 'edit':
			doEdit();
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
