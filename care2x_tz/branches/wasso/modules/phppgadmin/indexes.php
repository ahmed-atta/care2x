<?php

	/**
	 * List indexes on a table
	 *
	 * $Id: indexes.php,v 1.1 2006/01/13 13:42:14 irroal Exp $
	 */

	// Include application functions
	include_once('libraries/lib.inc.php');
	include_once('classes/class.select.php');
		
	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	$PHP_SELF = $_SERVER['PHP_SELF'];

	/**
	 * Show confirmation of cluster index and perform actual cluster
	 */
	function doClusterIndex($confirm) {
		global $localData, $database, $misc, $action;
		global $PHP_SELF, $lang;

		if ($confirm) {
			// Default analyze to on
			if ($action == 'confirm_cluster_index') $_REQUEST['analyze'] = 'on';
			
			echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strtables']}: ",
				$misc->printVal($_REQUEST['table']), ": " , $misc->printVal($_REQUEST['index']), ": {$lang['strcluster']}</h2>\n";

			echo "<p>", sprintf($lang['strconfcluster'], $misc->printVal($_REQUEST['index'])), "</p>\n";

			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"cluster_index\" />\n";
			echo "<input type=\"hidden\" name=\"table\" value=\"", htmlspecialchars($_REQUEST['table']), "\" />\n";
			echo "<input type=\"hidden\" name=\"index\" value=\"", htmlspecialchars($_REQUEST['index']), "\" />\n";
			echo $misc->form;
			echo "<p><input type=\"checkbox\" name=\"analyze\"", (isset($_REQUEST['analyze']) ? ' checked="checked"' : ''), " /> {$lang['stranalyze']}</p>\n";
			echo "<input type=\"submit\" name=\"cluster\" value=\"{$lang['strcluster']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $localData->clusterIndex($_POST['index'], $_POST['table'], isset($_POST['analyze']));
			if ($status == 0)
				doDefault($lang['strclusteredgood'] . ((isset($_POST['analyze']) ? ' ' . $lang['stranalyzegood'] : '')));
			else
				doDefault($lang['strclusteredbad']);
		}

	}

	/**
	 * Displays a screen where they can enter a new index
	 */
	function doCreateIndex($msg = '') {
		global $data, $localData, $misc;
		global $PHP_SELF, $lang;

		if (!isset($_POST['formIndexName'])) $_POST['formIndexName'] = '';
		if (!isset($_POST['formIndexType'])) $_POST['formIndexType'] = null;
		if (!isset($_POST['formCols'])) $_POST['formCols'] = '';
		if (!isset($_POST['formWhere'])) $_POST['formWhere'] = '';		

		echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strindexes']}: {$lang['strcreateindex']} </h2>\n";
		$misc->printMsg($msg);

		$attrs = &$localData->getTableAttributes($_REQUEST['table']);

		$selColumns = new XHTML_select("TableColumnList",true,10);
		$selColumns->set_style("width: 10em;");

		if ($attrs->recordCount() > 0) {
			while (!$attrs->EOF) {
				$selColumns->add(new XHTML_Option($attrs->f['attname']));
				$attrs->moveNext();
			}
		}

		$selIndex = new XHTML_select("IndexColumnList[]", true, 10);
		$selIndex->set_style("width: 10em;");
		$selIndex->set_attribute("id", "IndexColumnList");
		$buttonAdd    = new XHTML_Button("add", ">>");
		$buttonAdd->set_attribute("onclick", "buttonPressed(this);");
		$buttonAdd->set_attribute("type", "button");

		$buttonRemove = new XHTML_Button("remove", "<<");
		$buttonRemove->set_attribute("onclick", "buttonPressed(this);");		
		$buttonRemove->set_attribute("type", "button");

		echo "<form onsubmit=\"doSelectAll();\" name=\"formIndex\" action=\"$PHP_SELF\" method=\"post\">\n";


		echo "<table>\n";
		echo "<tr><th class=\"data\" colspan=\"3\">{$lang['strindexname']}</th></tr>";
		echo "<tr>";
		echo "<td class=\"data1\" colspan=\"3\"><input type=\"text\" name=\"formIndexName\" size=\"32\" maxlength=\"{$data->_maxNameLen}\" value=\"", 
			htmlspecialchars($_POST['formIndexName']), "\" /></td></tr>";
		echo "<tr><th class=\"data\">{$lang['strtablecolumnlist']}</th><th class=\"data\">&nbsp;</th>";
		echo "<th class=\"data\">{$lang['strindexcolumnlist']}</th></tr>\n";
		echo "<tr><td class=\"data1\">" . $selColumns->fetch() . "</td>\n";
		echo "<td class=\"data1\">" . $buttonRemove->fetch() . $buttonAdd->fetch() . "</td>";
		echo "<td class=\"data1\">" . $selIndex->fetch() . "</td></tr>\n";
		echo "</table>\n";

		echo "<table> \n";
		echo "<tr>";
		echo "<th class=\"data\">{$lang['strindextype']}</th>";
		echo "<td class=\"data1\"><select name=\"formIndexType\">";
		foreach ($localData->typIndexes as $v) {
			echo "<option value=\"", htmlspecialchars($v), "\"",
				($v == $_POST['formIndexType']) ? ' selected="selected"' : '', ">", htmlspecialchars($v), "</option>\n";
		}
		echo "</select></td></tr>\n";				
		echo "</tr>";
		echo "<tr>";
		echo "<th class=\"data\">{$lang['strunique']}</th>";
		echo "<td class=\"data1\"><input type=\"checkbox\" name=\"formUnique\"", (isset($_POST['formUnique']) ? 'checked="checked"' : ''), " /></td>";
		echo "</tr>";
		if ($data->hasPartialIndexes()) {
			echo "<tr>";
			echo "<th class=\"data\">{$lang['strwhere']}</th>";
			echo "<td class=\"data1\">(<input name=\"formWhere\" size=\"32\" maxlength=\"{$data->_maxNameLen}\" value=\"", 
				htmlspecialchars($_POST['formWhere']), "\" />)</td>";
			echo "</tr>";
		}
		echo "</table>";

		echo "<p><input type=\"hidden\" name=\"action\" value=\"save_create_index\" />\n";
		echo $misc->form;
		echo "<input type=\"hidden\" name=\"table\" value=\"", htmlspecialchars($_REQUEST['table']), "\" />\n";
		echo "<input type=\"submit\" value=\"{$lang['strcreate']}\" />\n";
		echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
		echo "</form>\n";
	}

	/**
	 * Actually creates the new index in the database
	 * @@ Note: this function can't handle columns with commas in them
	 */
	function doSaveCreateIndex() {
		global $localData;
		global $lang;
		
		// Handle databases that don't have partial indexes
		if (!isset($_POST['formWhere'])) $_POST['formWhere'] = '';
		
		// Check that they've given a name and at least one column
		if ($_POST['formIndexName'] == '') doCreateIndex($lang['strindexneedsname']);
		elseif (!isset($_POST['IndexColumnList']) || $_POST['IndexColumnList'] == '') doCreateIndex($lang['strindexneedscols']);
		else {
			$status = $localData->createIndex($_POST['formIndexName'], $_POST['table'], $_POST['IndexColumnList'], 
				$_POST['formIndexType'], isset($_POST['formUnique']), $_POST['formWhere']);
			if ($status == 0)
				doDefault($lang['strindexcreated']);
			else
				doCreateIndex($lang['strindexcreatedbad']);
		}
	}

	/**
	 * Show confirmation of drop index and perform actual drop
	 */
	function doDropIndex($confirm) {
		global $localData, $database, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) {
			echo "<h2>", $misc->printVal($_REQUEST['database']), ": {$lang['strtables']}: ",
				$misc->printVal($_REQUEST['table']), ": " , $misc->printVal($_REQUEST['index']), ": {$lang['strdrop']}</h2>\n";

			echo "<p>", sprintf($lang['strconfdropindex'], $misc->printVal($_REQUEST['index'])), "</p>\n";

			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"drop_index\" />\n";
			echo "<input type=\"hidden\" name=\"table\" value=\"", htmlspecialchars($_REQUEST['table']), "\" />\n";
			echo "<input type=\"hidden\" name=\"index\" value=\"", htmlspecialchars($_REQUEST['index']), "\" />\n";
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
			$status = $localData->dropIndex($_POST['index'], isset($_POST['cascade']));
			if ($status == 0)
				doDefault($lang['strindexdropped']);
			else
				doDefault($lang['strindexdroppedbad']);
		}

	}

	function doDefault($msg = '') {
		global $data, $localData, $misc;
		global $PHP_SELF, $lang;

		$misc->printTableNav();
		echo "<h2>", $misc->printVal($_REQUEST['database']), ": ", $misc->printVal($_REQUEST['table']), ": {$lang['strindexes']}</h2>\n";
		$misc->printMsg($msg);

		$indexes = &$localData->getIndexes($_REQUEST['table']);
		
		if ($indexes->recordCount() > 0) {
			echo "<table>\n";
			echo "<tr>\n";
			echo "<th class=\"data\">{$lang['strname']}</th><th class=\"data\">{$lang['strdefinition']}</th>";
			if ($data->hasCluster()) {
				echo "<th class=\"data\">{$lang['strclustered']}</th>";
				echo "<th class=\"data\" colspan=\"2\">{$lang['stractions']}</th>\n";
			}
			else {
				echo "<th class=\"data\">{$lang['stractions']}</th>\n";
			}
			echo "</tr>\n";
			$i = 0;
			
			while (!$indexes->EOF) {
				$id = ( ($i % 2 ) == 0 ? '1' : '2' );
				echo "<tr><td class=\"data{$id}\">", $misc->printVal( $indexes->f[$data->ixFields['idxname']]), "</td>";
				echo "<td class=\"data{$id}\">", $misc->printVal( $indexes->f[$data->ixFields['idxdef']]), "</td>";
				if ($data->hasCluster()) {
					$indexes->f['indisclustered'] = $data->phpBool($indexes->f['indisclustered']);
					echo "<td class=\"data{$id}\">", ($indexes->f['indisclustered'] ? $lang['stryes'] : $lang['strno']), "</td>";
				}
				echo "<td class=\"opbutton{$id}\">";
				echo "<a href=\"$PHP_SELF?action=confirm_drop_index&{$misc->href}&index=", urlencode( $indexes->f[$data->ixFields['idxname']]), 
					"&table=", urlencode($_REQUEST['table']), "\">{$lang['strdrop']}</td>";
				if ($data->hasCluster()) {
					echo "<td class=\"opbutton{$id}\">";
					echo "<a href=\"$PHP_SELF?action=confirm_cluster_index&{$misc->href}&index=", urlencode( $indexes->f[$data->ixFields['idxname']]), 
						"&table=", urlencode($_REQUEST['table']), "\">{$lang['strcluster']}</td>";
				}
				echo "</tr>\n";

				$indexes->movenext();
				$i++;
			}

			echo "</table>\n";
			}
		else
			echo "<p>{$lang['strnoindexes']}</p>\n";
		
		echo "<p><a class=\"navlink\" href=\"$PHP_SELF?action=create_index&{$misc->href}&table=", urlencode($_REQUEST['table']), "\">{$lang['strcreateindex']}</a></p>\n";		
	}

	$misc->printHeader($lang['strindexes'], "<script src=\"indexes.js\" type=\"text/javascript\"></script>");

	if ($action == 'create_index' || $action == 'save_create_index')
		echo "<body onload=\"init();\">";
	else
		$misc->printBody();
	
	switch ($action) {
		case 'cluster_index':
			if (isset($_POST['cluster'])) doClusterIndex(false);
			else doDefault();
			break;
		case 'confirm_cluster_index':
			doClusterIndex(true);
			break;
		case 'save_create_index':
			if (isset($_POST['cancel'])) doDefault();
			else doSaveCreateIndex();
			break;
		case 'create_index':
			doCreateIndex();
			break;
		case 'drop_index':
			if (isset($_POST['drop'])) doDropIndex(false);
			else doDefault();
			break;
		case 'confirm_drop_index':
			doDropIndex(true);
			break;
		default:
			doDefault();
			break;
	}

	$misc->printFooter();

?>
