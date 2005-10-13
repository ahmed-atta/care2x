<?php

	/**
	 * Manage users in a database cluster
	 *
	 * $Id$
	 */

	// Include application functions
	include_once('libraries/lib.inc.php');

	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	if (!isset($msg)) $msg = '';
	$PHP_SELF = $_SERVER['PHP_SELF'];
		
	/**
	 * If a user is not a superuser, then we have an 'account management' page
	 * where they can change their password, etc.  We don't prevent them from
	 * messing with the URL to gain access to other user admin stuff, because
	 * the PostgreSQL permissions will prevent them changing anything anyway.
	 */
	function doAccount($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;
	
		echo "<h2>{$lang['strusers']}: ", $misc->printVal($_SESSION['webdbUsername']), ": {$lang['straccount']}</h2>\n";
		$misc->printMsg($msg);
		
		$userdata = &$data->getUser($_SESSION['webdbUsername']);
		
		if ($userdata->recordCount() > 0) {
			$userdata->f[$data->uFields['usuper']] = $data->phpBool($userdata->f[$data->uFields['usuper']]);
			$userdata->f[$data->uFields['ucreatedb']] = $data->phpBool($userdata->f[$data->uFields['ucreatedb']]);
			echo "<table>\n";
			echo "<tr><th class=\"data\">{$lang['strusername']}</th><th class=\"data\">{$lang['strsuper']}</th><th class=\"data\">{$lang['strcreatedb']}</th><th class=\"data\">{$lang['strexpires']}</th></tr>\n";
			echo "<tr><td class=\"data1\">", $misc->printVal($userdata->f[$data->uFields['uname']]), "</td>\n";
			echo "<td class=\"data1\">", (($userdata->f[$data->uFields['usuper']]) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "<td class=\"data1\">", (($userdata->f[$data->uFields['ucreatedb']]) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "<td class=\"data1\">", $misc->printVal($userdata->f[$data->uFields['uexpires']]), "</td></tr>\n";
			echo "</table>\n";
		}
		else echo "<p>{$lang['strnodata']}</p>\n";
		
		echo "<p><a class=\"navlink\" href=\"$PHP_SELF?action=confchangepassword\">{$lang['strchangepassword']}</a></p>\n";
	}
	
	/**
	 * Show confirmation of change password and actually change password
	 */
	function doChangePassword($confirm, $msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang, $conf;

		if ($confirm) { 
			echo "<h2>{$lang['strusers']}: ", $misc->printVal($_SESSION['webdbUsername']), ": {$lang['strchangepassword']}</h2>\n";
			$misc->printMsg($msg);
						
			if (!isset($_POST['password'])) $_POST['password'] = '';
			if (!isset($_POST['confirm'])) $_POST['confirm'] = '';
			
			
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<table>\n";
			echo "\t<tr>\n\t\t<th class=\"data left required\">{$lang['strpassword']}</th>\n";
			echo "\t\t<td><input type=\"password\" name=\"password\" size=\"32\" value=\"", 
				htmlspecialchars($_POST['password']), "\" /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left required\">{$lang['strconfirm']}</th>\n";
			echo "\t\t<td><input type=\"password\" name=\"confirm\" size=\"32\" value=\"\" /></td>\n\t</tr>\n";
			echo "<table>\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"changepassword\" />\n";
			echo "<input type=\"submit\" name=\"ok\" value=\"{$lang['strok']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</form>\n";
		}
		else {
			// Check that password is minimum length
			if (strlen($_POST['password']) < $conf['min_password_length'])
				doChangePassword(true, $lang['strpasswordshort']);
			// Check that password matches confirmation password
			elseif ($_POST['password'] != $_POST['confirm'])
				doChangePassword(true, $lang['strpasswordconfirm']);
			else {
				$status = $data->changePassword($_SESSION['webdbUsername'], 
					$_POST['password']);
				if ($status == 0)
					doAccount($lang['strpasswordchanged']);
				else
					doAccount($lang['strpasswordchangedbad']);
			}
		}		
	}

	/**
	 * Function to allow editing of a user
	 */
	function doEdit($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;
	
		echo "<h2>{$lang['strusers']}: ", $misc->printVal($_REQUEST['username']), ": {$lang['stralter']}</h2>\n";
		$misc->printMsg($msg);
		
		$userdata = &$data->getUser($_REQUEST['username']);
		
		if ($userdata->recordCount() > 0) {
			$userdata->f[$data->uFields['ucreatedb']] = $data->phpBool($userdata->f[$data->uFields['ucreatedb']]);
			$userdata->f[$data->uFields['usuper']] = $data->phpBool($userdata->f[$data->uFields['usuper']]);
		
			if (!isset($_POST['formPassword'])) $_POST['formPassword'] = '';
			if (!isset($_POST['formConfirm'])) $_POST['formConfirm'] = '';
			if (!isset($_POST['formExpires'])) $_POST['formExpires'] = $userdata->f[$data->uFields['uexpires']];
		
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<table>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strusername']}</th>\n";
			echo "\t\t<td class=\"data1\">", $misc->printVal($userdata->f[$data->uFields['uname']]), "</td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strsuper']}</th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"checkbox\" name=\"formSuper\"", 
				($userdata->f[$data->uFields['usuper']]) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strcreatedb']}</th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"checkbox\" name=\"formCreateDB\"", 
				($userdata->f[$data->uFields['ucreatedb']]) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strexpires']}</th>\n";
			echo "\t\t<td class=\"data1\"><input size=\"16\" name=\"formExpires\" value=\"", htmlspecialchars($_POST['formExpires']), "\" /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strpassword']}</th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"password\" size=\"16\" name=\"formPassword\" value=\"", htmlspecialchars($_POST['formPassword']), "\" /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strconfirm']}</th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"password\" size=\"16\" name=\"formConfirm\" value=\"\" /></td>\n\t</tr>\n";
			echo "</table>\n";
			echo "<p><input type=\"hidden\" name=\"action\" value=\"save_edit\" />\n";
			echo "<input type=\"hidden\" name=\"username\" value=\"", htmlspecialchars($_REQUEST['username']), "\" />\n";
			echo "<input type=\"submit\" value=\"{$lang['stralter']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
			echo "</form>\n";
		}
		else echo "<p>{$lang['strnodata']}</p>\n";
	}
	
	/** 
	 * Function to save after editing a user
	 */
	function doSaveEdit() {
		global $data, $lang;
		
		// Check password
		if ($_POST['formPassword'] != $_POST['formConfirm'])
			doEdit($lang['strpasswordconfirm']);
		else {		
			$status = $data->setUser($_POST['username'], $_POST['formPassword'], isset($_POST['formCreateDB']), isset($_POST['formSuper']), $_POST['formExpires']);
			if ($status == 0)
				doDefault($lang['struserupdated']);
			else
				doEdit($lang['struserupdatedbad']);
		}
	}

	/**
	 * Show confirmation of drop and perform actual drop
	 */
	function doDrop($confirm) {
		global $data, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) { 
			echo "<h2>{$lang['strusers']}: ", $misc->printVal($_REQUEST['username']), ": {$lang['strdrop']}</h2>\n";
			
			echo "<p>", sprintf($lang['strconfdropuser'], $misc->printVal($_REQUEST['username'])), "</p>\n";	
			
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"drop\" />\n";
			echo "<input type=\"hidden\" name=\"username\" value=\"", htmlspecialchars($_REQUEST['username']), "\" />\n";
			echo "<input type=\"submit\" name=\"drop\" value=\"{$lang['strdrop']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $data->dropUser($_REQUEST['username']);
			if ($status == 0)
				doDefault($lang['struserdropped']);
			else
				doDefault($lang['struserdroppedbad']);
		}		
	}
	
	/**
	 * Displays a screen where they can enter a new user
	 */
	function doCreate($msg = '') {
		global $data, $misc, $username;
		global $PHP_SELF, $lang;
		
		if (!isset($_POST['formUsername'])) $_POST['formUsername'] = '';
		if (!isset($_POST['formPassword'])) $_POST['formPassword'] = '';
		if (!isset($_POST['formConfirm'])) $_POST['formConfirm'] = '';
		if (!isset($_POST['formExpires'])) $_POST['formExpires'] = '';
		
		echo "<h2>{$lang['strusers']}: {$lang['strcreateuser']}</h2>\n";
		$misc->printMsg($msg);

		echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
		echo "<table>\n";
		echo "\t<tr>\n\t\t<th class=\"data left required\">{$lang['strusername']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"15\" name=\"formUsername\" value=\"", htmlspecialchars($_POST['formUsername']), "\" /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strpassword']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"15\" type=\"password\" name=\"formPassword\" value=\"", htmlspecialchars($_POST['formPassword']), "\" /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strconfirm']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"15\" type=\"password\" name=\"formConfirm\" value=\"", htmlspecialchars($_POST['formConfirm']), "\" /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strsuper']}</th>\n";
		echo "\t\t<td class=\"data1\"><input type=\"checkbox\" name=\"formSuper\"", 
			(isset($_POST['formSuper'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strcreatedb']}</th>\n";
		echo "\t\t<td class=\"data1\"><input type=\"checkbox\" name=\"formCreateDB\"", 
			(isset($_POST['formCreateDB'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strexpires']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"30\" name=\"formExpires\" value=\"", htmlspecialchars($_POST['formExpires']), "\" /></td>\n\t</tr>\n";
		echo "</table>\n";
		echo "<p><input type=\"hidden\" name=\"action\" value=\"save_create\" />\n";
		echo "<input type=\"submit\" value=\"{$lang['strcreate']}\" />\n";
		echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
		echo "</form>\n";
	}
	
	/**
	 * Actually creates the new user in the database
	 */
	function doSaveCreate() {
		global $data;
		global $lang;

		// Check data
		if ($_POST['formUsername'] == '')
			doCreate($lang['struserneedsname']);
		else if ($_POST['formPassword'] != $_POST['formConfirm'])
			doCreate($lang['strpasswordconfirm']);
		else {		
			$status = $data->createUser($_POST['formUsername'], $_POST['formPassword'], 
				isset($_POST['formCreateDB']), isset($_POST['formSuper']), $_POST['formExpires'], array());
			if ($status == 0)
				doDefault($lang['strusercreated']);
			else
				doCreate($lang['strusercreatedbad']);
		}
	}	

	/**
	 * Show default list of users in the database
	 */
	function doDefault($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;
		
		echo "<h2>{$lang['strusers']}</h2>\n";
		$misc->printMsg($msg);
		
		$users = &$data->getUsers();
		
		if ($users->recordCount() > 0) {
			echo "<table>\n";
			echo "<tr><th class=\"data\">{$lang['strusername']}</th><th class=\"data\">{$lang['strsuper']}</th>";
			echo "<th class=\"data\">{$lang['strcreatedb']}</th><th class=\"data\">{$lang['strexpires']}</th><th colspan=\"2\" class=\"data\">{$lang['stractions']}</th></tr>\n";
			$i = 0;
			while (!$users->EOF) {
				$users->f[$data->uFields['usuper']] = $data->phpBool($users->f[$data->uFields['usuper']]);
				$users->f[$data->uFields['ucreatedb']] = $data->phpBool($users->f[$data->uFields['ucreatedb']]);
				$id = (($i % 2) == 0 ? '1' : '2');
				echo "<tr><td class=\"data{$id}\">", $misc->printVal($users->f[$data->uFields['uname']]), "</td>\n";
				echo "<td class=\"data{$id}\">", ($users->f[$data->uFields['usuper']]) ? $lang['stryes'] : $lang['strno'], "</td>\n";
				echo "<td class=\"data{$id}\">", ($users->f[$data->uFields['ucreatedb']]) ? $lang['stryes'] : $lang['strno'], "</td>\n";
				echo "<td class=\"data{$id}\">", $misc->printVal($users->f[$data->uFields['uexpires']]), "</td>\n";
				echo "<td class=\"opbutton{$id}\"><a href=\"$PHP_SELF?action=edit&amp;username=",
					urlencode($users->f[$data->uFields['uname']]), "\">{$lang['stralter']}</a></td>\n";
				echo "<td class=\"opbutton{$id}\"><a href=\"$PHP_SELF?action=confirm_drop&amp;username=", 
					urlencode($users->f[$data->uFields['uname']]), "\">{$lang['strdrop']}</a></td>\n";
				echo "</tr>\n";
				$users->moveNext();
				$i++;
			}
			echo "</table>\n";
		}
		else {
			echo "<p>{$lang['strnousers']}</p>\n";
		}
		
		echo "<p><a class=\"navlink\" href=\"$PHP_SELF?action=create\">{$lang['strcreateuser']}</a></p>\n";

	}

	$misc->printHeader($lang['strusers']);
	$misc->printBody();

	switch ($action) {
		case 'changepassword':
			if (isset($_REQUEST['ok'])) doChangePassword(false);
			else doAccount();
			break;
		case 'confchangepassword':
			doChangePassword(true);
			break;			
		case 'account':
			doAccount();
			break;
		case 'save_create':
			if (isset($_REQUEST['cancel'])) doDefault();
			else doSaveCreate();
			break;
		case 'create':			
			doCreate();
			break;
		case 'drop':
			if (isset($_REQUEST['cancel'])) doDefault();
			else doDrop(false);
			break;
		case 'confirm_drop':
			doDrop(true);
			break;			
		case 'save_edit':
			if (isset($_REQUEST['cancel'])) doDefault();
			else doSaveEdit();
			break;
		case 'edit':
			doEdit();
			break;
		default:
			doDefault();
			break;
	}	

	$misc->printFooter();

?>
