<?php

/**
 * A class that implements the DB interface for Postgres
 * Note: This class uses ADODB and returns RecordSets.
 *
 * $Id: Postgres.php,v 1.1 2006/01/13 13:42:15 irroal Exp $
 */

// @@@ THOUGHT: What about inherits? ie. use of ONLY???

include_once('classes/database/BaseDB.php');

class Postgres extends BaseDB {

	var $dbFields = array('dbname' => 'datname', 'dbcomment' => 'description', 'encoding' => 'encoding', 'owner' => 'owner');
	var $tbFields = array('tbname' => 'tablename', 'tbowner' => 'tableowner', 'tbcomment' => 'tablecomment');
	var $vwFields = array('vwname' => 'viewname', 'vwowner' => 'viewowner', 'vwdef' => 'definition');
	var $uFields = array('uname' => 'usename', 'usuper' => 'usesuper', 'ucreatedb' => 'usecreatedb', 'uexpires' => 'valuntil');
	var $grpFields = array('groname' => 'groname', 'grolist' => 'grolist');
	var $sqFields = array('seqname' => 'relname', 'seqowner' => 'usename', 'lastvalue' => 'last_value', 'incrementby' => 'increment_by', 'maxvalue' => 'max_value', 'minvalue'=> 'min_value', 'cachevalue' => 'cache_value', 'logcount' => 'log_cnt', 'iscycled' => 'is_cycled', 'iscalled' => 'is_called' );
	var $ixFields = array('idxname' => 'relname', 'idxdef' => 'pg_get_indexdef', 'uniquekey' => 'indisunique', 'primarykey' => 'indisprimary');
	var $rlFields = array('rulename' => 'rulename', 'ruledef' => 'definition');
	var $tgFields = array('tgname' => 'tgname', 'tgdef' => 'tgdef');
	var $cnFields = array('conname' => 'conname', 'consrc' => 'consrc', 'contype' => 'contype');
	var $typFields = array('typname' => 'typname', 'typowner' => 'typowner', 'typin' => 'typin',
		'typout' => 'typout', 'typlen' => 'typlen', 'typdef' => 'typdef', 'typelem' => 'typelem',
		'typdelim' => 'typdelim', 'typbyval' => 'typbyval', 
		'typalign' => 'typalign', 'typstorage' => 'typstorage');
	var $fnFields = array('fnname' => 'proname', 'fnreturns' => 'return_type', 'fnarguments' => 'arguments','fnoid' => 'oid', 'fndef' => 'source', 'fnlang' => 'language', 'setof' => 'proretset' );
	var $langFields = array('lanname' => 'lanname');

	// Array of allowed type alignments
	var $typAligns = array('char', 'int2', 'int4', 'double');
	// The default type alignment
	var $typAlignDef = 'int4';
	// Array of allowed type storage attributes
	var $typStorages = array('plain', 'external', 'extended', 'main');
	// The default type storage
	var $typStorageDef = 'plain';
	// Extra "magic" types
	var $extraTypes = array('SERIAL');
	// Array of allowed index types
	var $typIndexes = array('BTREE', 'RTREE', 'GIST', 'HASH');
	// Default index type 
	var $typIndexDef = 'BTREE';
	// Array of allowed trigger events	
	var $triggerEvents= array('INSERT', 'UPDATE', 'DELETE', 'INSERT OR UPDATE', 'INSERT OR DELETE', 
		'DELETE OR UPDATE', 'INSERT OR DELETE OR UPDATE');
	// When to execute the trigger	
	var $triggerExecTimes = array('BEFORE', 'AFTER');
	// Foreign key actions
	var $fkactions = array('NO ACTION', 'RESTRICT', 'CASCADE', 'SET NULL', 'SET DEFAULT');
	// Function properties
	var $funcprops = array(array('', 'ISCACHABLE'));
	var $defaultprops = array('');
	
	// Last oid assigned to a system object
	var $_lastSystemOID = 18539;
	var $_maxNameLen = 31;
	
	// Name of id column
	var $id = 'oid';
	
	// Map of database encoding names to HTTP encoding names.  If a
	// database encoding does not appear in this list, then its HTTP
	// encoding name is the same as its database encoding name.
	var $codemap = array(
		'ALT' => 'CP866',
		'EUC_CN' => 'GB2312',
		'EUC_JP' => 'EUC-JP',
		'EUC_KR' => 'EUC-KR',
		'EUC_TW' => 'EUC-TW', 
		'ISO_8859_5' => 'ISO-8859-5',
		'ISO_8859_6' => 'ISO-8859-6',
		'ISO_8859_7' => 'ISO-8859-7',
		'ISO_8859_8' => 'ISO-8859-8',
		'JOHAB' => 'CP1361',
		'KOI8' => 'KOI8-R',
		'LATIN1' => 'ISO-8859-1',
		'LATIN2' => 'ISO-8859-2',
		'LATIN3' => 'ISO-8859-3',
		'LATIN4' => 'ISO-8859-4',
		// The following encoding map is a known error in PostgreSQL < 7.2
		// See the constructor for Postgres72.
		'LATIN5' => 'ISO-8859-5',
		'LATIN6' => 'ISO-8859-10',
		'LATIN7' => 'ISO-8859-13',
		'LATIN8' => 'ISO-8859-14',
		'LATIN9' => 'ISO-8859-15',
		'LATIN10' => 'ISO-8859-16',
		'SQL_ASCII' => 'US-ASCII',
		'TCVN' => 'CP1258',
		'UNICODE' => 'UTF-8',
		'WIN' => 'CP1251',
		'WIN874' => 'CP874',
		'WIN1256' => 'CP1256'
	);
	
	// List of all legal privileges that can be applied to different types
	// of objects.
	var $privlist = array(
		'table' => array('SELECT', 'INSERT', 'UPDATE', 'RULE', 'ALL'),
		'view' => array('SELECT', 'RULE', 'ALL'),
		'sequence' => array('SELECT', 'UPDATE', 'ALL')
	);

	// List of characters in acl lists and the privileges they
	// refer to.
	var $privmap = array(
		'r' => 'SELECT',
		'w' => 'UPDATE',
		'a' => 'INSERT',
		'R' => 'RULE'
	);
	
	// Rule action types
	var $rule_events = array('SELECT', 'INSERT', 'UPDATE', 'DELETE');

	// Select operators
	// Operators of type 'i' are 'infix', eg. a = '1'.  Type 'p' means postfix unary, eg. a IS TRUE.
	// 'x' is a bracketed subquery form.  eg. IN (1,2,3)
	var $selectOps = array('=' => 'i', '!=' => 'i', '<' => 'i', '>' => 'i', '<=' => 'i', '>=' => 'i', 'LIKE' => 'i', 'NOT LIKE' => 'i', 
									'~' => 'i', '!~' => 'i', '~*' => 'i', '!~*' => 'i', 'IS NULL' => 'p', 'IS NOT NULL' => 'p', 
									'IN' => 'x', 'NOT IN' => 'x');

	/**
	 * Constructor
	 * @param $host The hostname to connect to
	 * @param $post The port number to connect to
	 * @param $database The database name to connect to.
	 * @param $user The user to connect as
	 * @param $password The password to use
	 */
	function Postgres($host, $port, $database, $user, $password) {
		$this->BaseDB('postgres7');

		// Ignore host if null
		if ($host === null || $host == '')
			$pghost = '';
		else
			$pghost = "{$host}:{$port}";

		$this->conn->connect($pghost, $user, $password, $database);
	}

	/**
	 * Cleans (escapes) a string
	 * @param $str The string to clean, by reference
	 * @return The cleaned string
	 */
	function clean(&$str) {
		if ($str === null) return null;
		if (function_exists('pg_escape_string'))
			$str = pg_escape_string($str);
		else
			$str = addslashes($str);
		return $str;
	}
	
	/**
	 * Cleans (escapes) an object name (eg. table, field)
	 * @param $str The string to clean, by reference
	 * @return The cleaned string
	 */
	function fieldClean(&$str) {
		if ($str === null) return null;
		$str = str_replace('"', '""', $str);
		return $str;
	}

	/**
	 * Cleans (escapes) an array
	 * @param $arr The array to clean, by reference
	 * @return The cleaned array
	 */
	function arrayClean(&$arr) {
		foreach ($arr as $k => $v) {
			if ($v === null) continue;
			if (function_exists('pg_escape_string'))
				$arr[$k] = pg_escape_string($v);
			else
				$arr[$k] = addslashes($v);
		}
		return $arr;
	}

	/**
	 * Cleans (escapes) an array of field names
	 * @param $arr The array to clean, by reference
	 * @return The cleaned array
	 */
	function fieldArrayClean(&$arr) {
		foreach ($arr as $k => $v) {
			if ($v === null) continue;
			$arr[$k] = str_replace('"', '""', $v);
		}
		return $arr;
	}

	// Database functions

	/**
	 * Return all database available on the server
	 * @return A list of databases, sorted alphabetically
	 */
	function &getDatabases() {
		global $conf;

		if (isset($conf['owned_only']) && $conf['owned_only'] && !$this->isSuperUser($_SESSION['webdbUsername'])) {
			$username = $_SESSION['webdbUsername'];
			$this->clean($username);
			$clause = " AND pu.usename='{$username}'";
		}
		else $clause = '';

		if (!$conf['show_system'])
			$where = "AND pdb.datname NOT IN ('template1')";
		else
			$where = '';

		$sql = "SELECT pdb.datname, pu.usename AS owner, pg_encoding_to_char(encoding) AS encoding, 
					(SELECT description FROM pg_description pd WHERE pdb.oid=pd.objoid) AS description 
					FROM pg_database pdb, pg_user pu
					WHERE pdb.datdba = pu.usesysid
					{$where}
					{$clause}
					ORDER BY pdb.datname";

		return $this->selectSet($sql);
	}

	/**
	 * Return all information about a particular database
	 * @param $database The name of the database to retrieve
	 * @return The database info
	 */
	function &getDatabase($database) {
		$this->clean($database);
		$sql = "SELECT * FROM pg_database WHERE datname='{$database}'";
		return $this->selectRow($sql);
	}

	/**
	 * Returns the current database encoding
	 * @return The encoding.  eg. SQL_ASCII, UTF-8, etc.
	 */
	function getDatabaseEncoding() {
		$sql = "SELECT getdatabaseencoding() AS encoding";
		
		return $this->selectField($sql, 'encoding');
	}
	
	/**
	 * Sets the client encoding
	 * @param $encoding The encoding to for the client
	 * @return 0 success
	 */
	function setClientEncoding($encoding) {
		return -99;
	}

	// Schema functions
	
	/**
	 * Sets the current working schema.  This is a do nothing method for
	 * < 7.3 and is just here for polymorphism's sake.
	 * @param $schema The the name of the schema to work in
	 * @return 0 success
	 */
	function setSchema($schema) {
		return 0;
	}
	
	// Table functions

	/**
	 * Returns the SQL for changing the current user
	 * @param $user The user to change to
	 * @return The SQL
	 */
	function getChangeUserSQL($user) {
		$this->fieldClean($user);
		return "\\connect - \"{$user}\"";
	}

	/**
	 * Sets up the data object for a dump.  eg. Starts the appropriate
	 * transaction, sets variables, etc.
	 * @return 0 success
	 */
	function beginDump() {
		// Begin serializable transaction (to dump consistent data)
		$status = $this->beginTransaction();
		if ($status != 0) return -1;
		
		// Set serializable
		$sql = "SET TRANSACTION ISOLATION LEVEL SERIALIZABLE";
		$status = $this->execute($sql);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -1;
		}

		// Set datestyle to ISO
		$sql = "SET DATESTYLE = ISO";
		$status = $this->execute($sql);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -1;
		}
	}

	/**
	 * Ends the data object for a dump.
	 * @return 0 success
	 */
	function endDump() {
		return $this->endTransaction();
	}

	/**
	 * Returns the SQL definition for the table.
	 * @pre MUST be run within a transaction
	 * @param $table The table to define
	 * @param $clean True to issue drop command, false otherwise
	 * @return A string containing the formatted SQL code
	 * @return null On error
	 */
	function &getTableDefPrefix($table, $clean = false) {
		// Fetch table
		$t = &$this->getTable($table);
		if (!is_object($t) || $t->recordCount() != 1) {
			$this->rollbackTransaction();
			return null;
		}
		$this->fieldClean($t->f['tablename']);

		// Fetch attributes
		$atts = &$this->getTableAttributes($table);
		if (!is_object($atts)) {
			$this->rollbackTransaction();
			return null;
		}

		// Fetch constraints
		$cons = &$this->getConstraints($table);
		if (!is_object($cons)) {
			$this->rollbackTransaction();
			return null;
		}

		// Output a reconnect command to create the table as the correct user
		$sql = $this->getChangeUserSQL($t->f['tableowner']) . "\n\n";

		// Set schema search path if we support schemas
		if ($this->hasSchemas()) {
			$sql .= "SET search_path = \"{$this->_schema}\", pg_catalog;\n\n";
		}
		
		// Begin CREATE TABLE definition
		$sql .= "-- Definition\n\n";
		// DROP TABLE must be fully qualified in case a table with the same name exists
		// in pg_catalog.
		if (!$clean) $sql .= "-- ";
		$sql .= "DROP TABLE ";
		if ($this->hasSchemas()) {
			$sql .= "\"{$this->_schema}\".";
		}
		$sql .= "\"{$t->f['tablename']}\";\n";
		$sql .= "CREATE TABLE \"{$t->f['tablename']}\" (\n";

		// Output all table columns
		$num = $atts->recordCount() + $cons->recordCount();
		$i = 1;
		while (!$atts->EOF) {
			$this->fieldClean($atts->f['attname']);
			$sql .= "    \"{$atts->f['attname']}\"";
			// Dump SERIAL and BIGSERIAL columns correctly
			if ($this->phpBool($atts->f['attisserial']) && 
					($atts->f['type'] == 'integer' || $atts->f['type'] == 'bigint')) {
				if ($atts->f['type'] == 'integer')
					$sql .= " SERIAL";
				else
					$sql .= " BIGSERIAL";
			}
			else {
				$sql .= " " . $this->formatType($atts->f['type'], $atts->f['atttypmod']);

				// Add NOT NULL if necessary
				if ($this->phpBool($atts->f['attnotnull']))
					$sql .= " NOT NULL";
				// Add default if necessary
				if ($atts->f['adsrc'] !== null) 
					$sql .= " DEFAULT {$atts->f['adsrc']}";
			}

			// Output comma or not
			if ($i < $num) $sql .= ",\n";
			else $sql .= "\n";

			$atts->moveNext();
			$i++;
		}
		// Output all table constraints
		while (!$cons->EOF) {
			$this->fieldClean($cons->f['conname']);
			$sql .= "    CONSTRAINT \"{$cons->f['conname']}\" ";
			// Nasty hack to support pre-7.4 PostgreSQL
			if ($cons->f['consrc'] !== null)
				$sql .= $cons->f['consrc'];
			else {
				switch ($cons->f['contype']) {
					case 'p':
						$keys = &$this->getKeys($table, explode(' ', $cons->f['indkey']));
						$sql .= "PRIMARY KEY (" . join(',', $keys) . ")";
						break;
					case 'u':
						$keys = &$this->getKeys($table, explode(' ', $cons->f['indkey']));
						$sql .= "UNIQUE (" . join(',', $keys) . ")";
						break;
					default:
						// Unrecognised constraint
						$this->rollbackTransaction();
						return null;
				}
			}

			// Output comma or not
			if ($i < $num) $sql .= ",\n";
			else $sql .= "\n";

			$cons->moveNext();
			$i++;
		}

		$sql .= ")";

		// @@@@ DUMP CLUSTERING INFORMATION

		// Inherits
		/*
		 * XXX: This is currently commented out as handling inheritance isn't this simple.
		 * You also need to make sure you don't dump inherited columns and defaults, as well
		 * as inherited NOT NULL and CHECK constraints.  So for the time being, we just do
		 * not claim to support inheritance.
		$parents = &$this->getTableParents($table);
		if ($parents->recordCount() > 0) {
			$sql .= " INHERITS (";
			while (!$parents->EOF) {
				$this->fieldClean($parents->f['relname']);
				// Qualify the parent table if it's in another schema
				if ($this->hasSchemas() && $parents->f['schemaname'] != $this->_schema) {
					$this->fieldClean($parents->f['schemaname']);
					$sql .= "\"{$parents->f['schemaname']}\".";
				}
				$sql .= "\"{$parents->f['relname']}\"";
				
				$parents->moveNext();
				if (!$parents->EOF) $sql .= ', ';
			}			
			$sql .= ")";
		}
		*/

		// Handle WITHOUT OIDS
		if ($this->hasWithoutOIDs()) {
			if ($this->hasObjectID($table))
				$sql .= " WITH OIDS";
			else
				$sql .= " WITHOUT OIDS";
		}

		$sql .= ";\n";

		// Column storage and statistics
		$atts->moveFirst();
		$first = true;
		while (!$atts->EOF) {
			$this->fieldClean($atts->f['attname']);
			// Statistics first
			if ($atts->f['attstattarget'] >= 0) {
				if ($first) {
					$sql .= "\n";
					$first = false;
				}
				$sql .= "ALTER TABLE ONLY \"{$t->f['tablename']}\" ALTER COLUMN \"{$atts->f['attname']}\" SET STATISTICS {$atts->f['attstattarget']};\n";
			}
			// Then storage
			if ($atts->f['attstorage'] != $atts->f['typstorage']) {
				switch ($atts->f['attstorage']) {
					case 'p':
						$storage = 'PLAIN';
						break;
					case 'e':
						$storage = 'EXTERNAL';
						break;
					case 'm':
						$storage = 'MAIN';
						break;
					case 'x':
						$storage = 'EXTENDED';
						break;
					default:
						// Unknown storage type
						$this->rollbackTransaction();
						return null;
				}
				$sql .= "ALTER TABLE ONLY \"{$t->f['tablename']}\" ALTER COLUMN \"{$atts->f['attname']}\" SET STORAGE {$storage};\n";
			}

			$atts->moveNext();
		}

		// Comment
		if ($t->f['tablecomment'] !== null) {
				$this->clean($t->f['tablecomment']);
				$sql .= "\n-- Comment\n\n";
				$sql .= "COMMENT ON TABLE \"{$t->f['tablename']}\" IS '{$t->f['tablecomment']}';\n";
		}

		// Privileges
		$privs = &$this->getPrivileges($table, 'table');
		if (!is_array($privs)) {
			$this->rollbackTransaction();
			return null;
		}

		if (sizeof($privs) > 0) {
			$sql .= "\n-- Privileges\n\n";
			/*
			 * Always start with REVOKE ALL FROM PUBLIC, so that we don't have to
			 * wire-in knowledge about the default public privileges for different
			 * kinds of objects.
			 */
			$sql .= "REVOKE ALL ON TABLE \"{$t->f['tablename']}\" FROM PUBLIC;\n";
			foreach ($privs as $v) {
				// Get non-GRANT OPTION privs
				$nongrant = array_diff($v[2], $v[4]);
				
				// Skip empty or owner ACEs
				if (sizeof($v[2]) == 0 || ($v[0] == 'user' && $v[1] == $t->f['tableowner'])) continue;
				
				// Change user if necessary
				if ($this->hasGrantOption() && $v[3] != $t->f['tableowner']) {
					$grantor = $v[3];
					$this->clean($grantor);
					$sql .= "SET SESSION AUTHORIZATION '{$grantor}';\n";
				}				
				
				// Output privileges with no GRANT OPTION
				$sql .= "GRANT " . join(', ', $nongrant) . " ON TABLE \"{$t->f['tablename']}\" TO ";
				switch ($v[0]) {
					case 'public':
						$sql .= "PUBLIC;\n";
						break;
					case 'user':
						$this->fieldClean($v[1]);
						$sql .= "\"{$v[1]}\";\n";
						break;
					case 'group':
						$this->fieldClean($v[1]);
						$sql .= "GROUP \"{$v[1]}\";\n";
						break;
					default:
						// Unknown privilege type - fail
						$this->rollbackTransaction();
						return null;
				}

				// Reset user if necessary
				if ($this->hasGrantOption() && $v[3] != $t->f['tableowner']) {
					$sql .= "RESET SESSION AUTHORIZATION;\n";
				}				
				
				// Output privileges with GRANT OPTION
				
				// Skip empty or owner ACEs
				if (!$this->hasGrantOption() || sizeof($v[4]) == 0) continue;

				// Change user if necessary
				if ($this->hasGrantOption() && $v[3] != $t->f['tableowner']) {
					$grantor = $v[3];
					$this->clean($grantor);
					$sql .= "SET SESSION AUTHORIZATION '{$grantor}';\n";
				}				
				
				$sql .= "GRANT " . join(', ', $v[4]) . " ON \"{$t->f['tablename']}\" TO ";
				switch ($v[0]) {
					case 'public':
						$sql .= "PUBLIC";
						break;
					case 'user':
						$this->fieldClean($v[1]);
						$sql .= "\"{$v[1]}\"";
						break;
					case 'group':
						$this->fieldClean($v[1]);
						$sql .= "GROUP \"{$v[1]}\"";
						break;
					default:
						// Unknown privilege type - fail
						return null;
				}
				$sql .= " WITH GRANT OPTION;\n";
				
				// Reset user if necessary
				if ($this->hasGrantOption() && $v[3] != $t->f['tableowner']) {
					$sql .= "RESET SESSION AUTHORIZATION;\n";
				}				

			}
		}

		// Add a newline to separate data that follows (if any)
		$sql .= "\n";

		return $sql;
	}

	/**
	 * Returns extra table definition information that is most usefully
	 * dumped after the table contents for speed and efficiency reasons
	 * @param $table The table to define
	 * @return A string containing the formatted SQL code
	 * @return null On error
	 */
	function &getTableDefSuffix($table) {
		$sql = '';

		// Indexes
		if ($this->hasIndicies()) {
			$indexes = &$this->getIndexes($table);
			if (!is_object($indexes)) {
				$this->rollbackTransaction();
				return null;
			}

			if ($indexes->recordCount() > 0) {
				$sql .= "\n-- Indexes\n\n";
				while (!$indexes->EOF) {
					$sql .= $indexes->f['pg_get_indexdef'] . ";\n";

					$indexes->moveNext();
				}
			}
		}

		// Triggers
		if ($this->hasTriggers()) {
			$triggers = &$this->getTriggers($table);
			if (!is_object($triggers)) {
				$this->rollbackTransaction();
				return null;
			}

			if ($triggers->recordCount() > 0) {
				$sql .= "\n-- Triggers\n\n";
				while (!$triggers->EOF) {
					// Nasty hack to support pre-7.4 PostgreSQL
					if ($triggers->f['tgdef'] !== null)
						$sql .= $triggers->f['tgdef'];
					else 
						$sql .= $this->getTriggerDef($triggers->f);	

					$sql .= ";\n";

					$triggers->moveNext();
				}
			}
		}

		// Rules
		if ($this->hasRules()) {
			$rules = &$this->getRules($table);
			if (!is_object($rules)) {
				$this->rollbackTransaction();
				return null;
			}

			if ($rules->recordCount() > 0) {
				$sql .= "\n-- Rules\n\n";
				while (!$rules->EOF) {
					$sql .= $rules->f['definition'] . "\n";

					$rules->moveNext();
				}
			}
		}

		return $sql;
	}

	/**
	 * Checks to see whether or not a table has a unique id column
	 * @param $table The table name
	 * @return True if it has a unique id, false otherwise
	 * @return -99 error
	 */
	function hasObjectID($table) {
		// 7.0 and 7.1 always had an oid column
		return true;
	}

	/**
	 * Given an array of attnums and a relation, returns an array mapping
	 * atttribute number to attribute name.
	 * @param $table The table to get attributes for
	 * @param $atts An array of attribute numbers
	 * @return An array mapping attnum to attname
	 * @return -1 $atts must be an array
	 * @return -2 wrong number of attributes found
	 */
	function getAttributeNames($table, $atts) {
		$this->clean($table);
		$this->arrayClean($atts);

		if (!is_array($atts)) return -1;

		if (sizeof($atts) == 0) return array();

		$sql = "SELECT attnum, attname FROM pg_attribute WHERE attrelid=(SELECT oid FROM pg_class WHERE relname='{$table}') AND attnum IN ('" .
			join("','", $atts) . "')";

		$rs = $this->selectSet($sql);
		if ($rs->recordCount() != sizeof($atts)) {
			return -2;
		}
		else {
			$temp = array();
			while (!$rs->EOF) {
				$temp[$rs->f['attnum']] = $rs->f['attname'];
				$rs->moveNext();
			}
			return $temp;
		}
	}

	/**
	 * Get the fields for uniquely identifying a row in a table
	 * @param $table The table for which to retrieve the identifier
	 * @return An array mapping attribute number to attribute name, empty for no identifiers
	 * @return -1 error
	 */
	function getRowIdentifier($table) {
		$oldtable = $table;
		$this->clean($table);
		
		$status = $this->beginTransaction();
		if ($status != 0) return -1;
		
		// Get the first primary or unique index (sorting primary keys first) that
		// is NOT a partial index.
		$sql = "SELECT indrelid, indkey FROM pg_index WHERE indisunique AND indrelid=(SELECT oid FROM pg_class 
					WHERE relname='{$table}') AND indpred='' AND indproc=0 ORDER BY indisprimary DESC LIMIT 1";
		$rs = $this->selectSet($sql);

		// If none, check for an OID column.  Even though OIDs can be duplicated, the edit and delete row
		// functions check that they're only modiying a single row.  Otherwise, return empty array.
		if ($rs->recordCount() == 0) {			
			// Check for OID column
			$temp = array();
			if ($this->hasObjectID($table)) {
				$temp = array('oid');
			}
			$this->endTransaction();
			return $temp;
		}
		// Otherwise find the names of the keys
		else {
			$attnames = $this->getAttributeNames($oldtable, explode(' ', $rs->f['indkey']));
			if (!is_array($attnames)) {
				$this->rollbackTransaction();
				return -1;
			}
			else {
				$this->endTransaction();
				return $attnames;
			}
		}			
	}

	// Inheritance functions
	
	/**
	 * Finds the names and schemas of parent tables (in order)
	 * @param $table The table to find the parents for
	 * @return A recordset
	 */
	function &getTableParents($table) {
		$this->clean($table);
		
		$sql = "
			SELECT 
				NULL AS schemaname, relname
			FROM
				pg_class pc, pg_inherits pi
			WHERE
				pc.oid=pi.inhparent
				AND pi.inhrelid = (SELECT oid from pg_class WHERE relname='{$table}')
			ORDER BY
				pi.inhseqno
		";
		
		return $this->selectSet($sql);					
	}	


	/**
	 * Finds the names and schemas of child tables
	 * @param $table The table to find the children for
	 * @return A recordset
	 */
	function &getTableChildren($table) {
		$this->clean($table);
		
		$sql = "
			SELECT 
				NULL AS schemaname, relname
			FROM
				pg_class pc, pg_inherits pi
			WHERE
				pc.oid=pi.inhrelid
				AND pi.inhparent = (SELECT oid from pg_class WHERE relname='{$table}')
		";
		
		return $this->selectSet($sql);					
	}	
	
	// Formatting functions
	
	/**
	 * Outputs the HTML code for a particular field
	 * @param $name The name to give the field
	 * @param $value The value of the field.  Note this could be 'numeric(7,2)' sort of thing...
	 * @param $type The database type of the field
	 */
	function printField($name, $value, $type) {
		global $lang;
		switch ($type) {
			case 'bool':
			case 'boolean':
				if ($value !== null && $value == '') $value = null;
				elseif ($value == 'true') $value = 't';
				elseif ($value == 'false') $value = 'f';
				
				// If value is null, 't' or 'f'...
				if ($value === null || $value == 't' || $value == 'f') {
					echo "<select name=\"", htmlspecialchars($name), "\">\n";
					echo "<option value=\"\"", ($value === null) ? ' selected="selected"' : '', "></option>\n";
					echo "<option value=\"t\"", ($value == 't') ? ' selected="selected"' : '', ">{$lang['strtrue']}</option>\n";
					echo "<option value=\"f\"", ($value == 'f') ? ' selected="selected"' : '', ">{$lang['strfalse']}</option>\n";
					echo "</select>\n";
				}
				else {
					echo "<input name=\"", htmlspecialchars($name), "\" value=\"", htmlspecialchars($value), "\" size=\"35\" />\n";
				}				
				break;
			case 'text':
			case 'bytea':
				// addCSlashes converts all weird ASCII characters to octal representation,
				// EXCEPT the 'special' ones like \r \n \t, etc.
				if ($type == 'bytea') $value = addCSlashes($value, "\0..\37\177..\377");
				echo "<textarea name=\"", htmlspecialchars($name), "\" rows=\"5\" cols=\"28\" wrap=\"virtual\">\n";
				echo htmlspecialchars($value);
				echo "</textarea>\n";
				break;
			default:
//				echo "<input name=\"", htmlspecialchars($name), "\" value=\"", htmlspecialchars($value), "\" size=\"35\" onBlur=\"isEmpty(this);\" />\n";
				echo "<input name=\"", htmlspecialchars($name), "\" value=\"", htmlspecialchars($value), "\" size=\"35\" />\n";
				break;
		}		
	}
	
	/**
	 * Formats a value or expression for sql purposes
	 * @param $type The type of the field
	 * @param $mode VALUE or EXPRESSION
	 * @param $value The actual value entered in the field.  Can be NULL
	 * @return The suitably quoted and escaped value.
	 */
	function formatValue($type, $format, $value) {
		switch ($type) {
			case 'bool':
			case 'boolean':
				if ($value == 't')
					return 'TRUE';
				elseif ($value == 'f')
					return 'FALSE';
				elseif ($value == '')
					return 'NULL';
				else
					return $value;
				break;		
			default:
				// Checking variable fields is difficult as there might be a size
				// attribute...			
				if (strpos($type, 'time') === 0) {
					// Assume it's one of the time types...
					if ($value == '') return "''";
					elseif (strcasecmp($value, 'CURRENT_TIMESTAMP') == 0 
							|| strcasecmp($value, 'CURRENT_TIME') == 0
							|| strcasecmp($value, 'CURRENT_DATE') == 0
							|| strcasecmp($value, 'LOCALTIME') == 0
							|| strcasecmp($value, 'LOCALTIMESTAMP') == 0) {
						return $value;
					}
					elseif ($format == 'EXPRESSION')
						return $value;
					else {
						$this->clean($value);
						return "'{$value}'";
					}
				}
				else {
					if ($format == 'VALUE') {
						$this->clean($value);
						return "'{$value}'";					
					}
					return $value;
				}
		}
	}

	/**
	 * Creates a database
	 * @param $database The name of the database to create
	 * @param $encoding Encoding of the database
	 * @return 0 success
	 */
	function createDatabase($database, $encoding) {
		$this->fieldClean($database);
		$this->clean($encoding);

		if ( $encoding == '' ) {
			$sql = "CREATE DATABASE \"{$database}\"";
		} else {
			$sql = "CREATE DATABASE \"{$database}\" WITH ENCODING='{$encoding}'";
		}
		return $this->execute($sql);
	}

	/**
	 * Drops a database
	 * @param $database The name of the database to drop
	 * @return 0 success
	 */
	function dropDatabase($database) {
		$this->fieldClean($database);
		$sql = "DROP DATABASE \"{$database}\"";
		return $this->execute($sql);
	}
	
	/**
	 * Dumps a database
	 */
	function dbDump($database) {
		global $appDumper;

		$database = escapeshellarg($database);

		passthru("/usr/local/bin/pg_dump {$database}");
	}

	// Table functions

	/**
	 * Returns table information
	 * @param $table The name of the table
	 * @return A recordset
	 */
	function &getTable($table) {
		$this->clean($table);
				
		$sql = "SELECT pc.relname AS tablename, 
							pg_get_userbyid(pc.relowner) AS tableowner, 
							(SELECT description FROM pg_description pd WHERE pc.oid=pd.objoid) AS tablecomment 
							FROM pg_class pc
							WHERE pc.relname='{$table}'";
							
		return $this->selectSet($sql);
	}

	/**
	 * Return all tables in current database
	 * @param $all True to fetch all tables, false for just in current schema
	 * @return All tables, sorted alphabetically 
	 */
	function &getTables($all = false) {
		global $conf;
		if (!$conf['show_system'] || $all) $where = "WHERE tablename NOT LIKE 'pg\\\\_%' ";
		else $where = '';
		$sql = "SELECT NULL AS schemaname, tablename, tableowner FROM pg_tables {$where}ORDER BY tablename";
		return $this->selectSet($sql);
	}

	/**
	 * Retrieve the attribute definition of a table
	 * @param $table The name of the table
	 * @param $field (optional) The name of a field to return
	 * @return All attributes in order
	 */
	function &getTableAttributes($table, $field = '') {
		$this->clean($table);
		$this->clean($field);
		
		if ($field == '') {
			$sql = "SELECT
					a.attname, t.typname as type, a.attlen, a.atttypmod, a.attnotnull, a.atthasdef, -1 AS attstattarget, a.attstorage,
					(SELECT adsrc FROM pg_attrdef adef WHERE a.attrelid=adef.adrelid AND a.attnum=adef.adnum) AS adsrc,
					a.attstorage AS typstorage, false AS attisserial
				FROM
					pg_attribute a,
					pg_class c,
					pg_type t
				WHERE
					c.relname = '{$table}' AND a.attnum > 0 AND a.attrelid = c.oid AND a.atttypid = t.oid
				ORDER BY a.attnum";
		}
		else {
			$sql = "SELECT
					a.attname, t.typname as type, a.attlen, a.atttypmod, a.attnotnull, a.atthasdef, -1 AS attstattarget, a.attstorage,
					(SELECT adsrc FROM pg_attrdef adef WHERE a.attrelid=adef.adrelid AND a.attnum=adef.adnum) AS adsrc,
					a.attstorage AS typstorage
				FROM
					pg_attribute a ,
					pg_class c,
					pg_type t
				WHERE
					c.relname = '{$table}' AND a.attname='{$field}' AND a.attrelid = c.oid AND a.atttypid = t.oid
				ORDER BY a.attnum";
		}
		
		return $this->selectSet($sql);
	}

	/**
	 * Formats a type correctly for display.  Postgres 7.0 had no 'format_type'
	 * built-in function, and hence we need to do it manually.
	 * @param $typname The name of the type
	 * @param $typmod The contents of the typmod field
	 */
	function formatType($typname, $typmod) {
		// This is a specific constant in the 7.0 source
		$varhdrsz = 4;
		
		// Show lengths on bpchar and varchar
		if ($typname == 'bpchar') {
			$len = $typmod - $varhdrsz;
			$temp = 'character';
			if ($len > 1)
				$temp .= "({$len})";
		}
		elseif ($typname == 'varchar') {
			$temp = 'character varying';
			if ($typmod != -1)
				$temp .= "(" . ($typmod - $varhdrsz) . ")";			
		}
		elseif ($typname == 'numeric') {
			$temp = 'numeric';
			if ($typmod != -1) {
				$tmp_typmod = $typmod - $varhdrsz;
				$precision = ($tmp_typmod >> 16) & 0xffff;
				$scale = $tmp_typmod & 0xffff;
				$temp .= "({$precision}, {$scale})";
			}			
		}
		else $temp = $typname;
		
		return $temp;
	}

	/**
	 * Drops a column from a table
	 * @param $table The table from which to drop a column
	 * @param $column The column to be dropped
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 * @return -99 not implemented
	 */
	function dropColumn($table, $column, $cascade) {
		return -99;
	}
	
	/**
	 * Alters a column in a table
	 * @param $table The table in which the column resides
	 * @param $column The column to alter
	 * @param $name The new name for the column
	 * @param $notnull (boolean) True if not null, false otherwise
	 * @param $default The new default for the column
	 * @param $olddefault THe old default for the column
	 * @return 0 success
	 * @return -1 set not null error
	 * @return -2 set default error
	 * @return -3 rename column error
	 */
	function alterColumn($table, $column, $name, $notnull, $default, $olddefault) {
		$this->beginTransaction();

		// @@ NEED TO HANDLE "NESTED" TRANSACTION HERE
		$status = $this->setColumnNull($table, $column, !$notnull);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -1;
		}

		// Set default, if it has changed
		if ($default != $olddefault) {
			if ($default == '')
				$status = $this->dropColumnDefault($table, $column);
			else 
				$status = $this->setColumnDefault($table, $column, $default);

			if ($status != 0) {
				$this->rollbackTransaction();
				return -2;
			}
		}

		// Rename the column, if it has been changed
		if ($column != $name) {
			$status = $this->renameColumn($table, $column, $name);
			if ($status != 0) {
				$this->rollbackTransaction();
				return -3;
			}
		}

		return $this->endTransaction();
	}	

	/**
	 * Creates a new table in the database
	 * @param $name The name of the table
	 * @param $fields The number of fields
	 * @param $field An array of field names
	 * @param $type An array of field types
	 * @param $length An array of field lengths
	 * @param $notnull An array of not null
	 * @param $default An array of default values
	 * @param $withoutoids True if WITHOUT OIDS, false otherwise
	 * @return 0 success
	 * @return -1 no fields supplied
	 */
	function createTable($name, $fields, $field, $type, $length, $notnull, $default, $withoutoids) {
		$this->fieldClean($name);

		$found = false;
		$sql = "CREATE TABLE \"{$name}\" (";
		for ($i = 0; $i < $fields; $i++) {
			$this->fieldClean($field[$i]);
			$this->clean($type[$i]);
			$this->clean($length[$i]);

			// Skip blank columns - for user convenience
			if ($field[$i] == '' || $type[$i] == '') continue;
			
			switch ($type[$i]) {
				// Have to account for weird placing of length for with/without
				// time zone types
				case 'timestamp with time zone':
				case 'timestamp without time zone':
					$qual = substr($type[$i], 9);
					$sql .= "\"{$field[$i]}\" timestamp";
					if ($length[$i] != '') $sql .= "({$length[$i]})";
					$sql .= $qual;
					break;
				case 'time with time zone':
				case 'time without time zone':
					$qual = substr($type[$i], 4);
					$sql .= "\"{$field[$i]}\" time";
					if ($length[$i] != '') $sql .= "({$length[$i]})";
					$sql .= $qual;
					break;
				default:
					$sql .= "\"{$field[$i]}\" {$type[$i]}";
					if ($length[$i] != '') $sql .= "({$length[$i]})";
			}

			if (isset($notnull[$i])) $sql .= " NOT NULL";
			if ($default[$i] != '') $sql .= " DEFAULT {$default[$i]}";
			if ($i != $fields - 1) $sql .= ", ";

			$found = true;
		}
		
		if (!$found) return -1;
		
		$sql .= ")";
		
		// WITHOUT OIDS
		if ($this->hasWithoutOIDs() && $withoutoids)
			$sql .= ' WITHOUT OIDS';
		
		return $this->execute($sql);
	}	

	/**
	 * Alters a table
	 * @param $table The name of the table
	 * @param $name The new name for the table
	 * @param $owner The new owner for the table	
	 * @param $comment The comment on the table
	 * @return 0 success
	 * @return -1 transaction error
	 * @return -2 owner error
	 * @return -3 rename error
	 * @return -4 comment error
	 */
	function alterTable($table, $name, $owner, $comment) {
		$this->fieldClean($table);
		$this->fieldClean($name);
		$this->fieldClean($owner);
		$this->clean($comment);

		$status = $this->beginTransaction();
		if ($status != 0) {
			$this->rollbackTransaction();
			return -1;
		}
		
		// Comment
		$sql = "COMMENT ON TABLE \"{$table}\" IS ";
		if ($comment == '') $sql .= 'NULL';
		else $sql .= "'{$comment}'";

		$status = $this->execute($sql);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -4;
		}
		
		// Owner
		if ($this->hasAlterTableOwner() && $owner != '') {
			$sql = "ALTER TABLE \"{$table}\" OWNER TO \"{$owner}\"";
	
			$status = $this->execute($sql);
			if ($status != 0) {
				$this->rollbackTransaction();
				return -2;
			}
		}

		// Rename (only if name has changed)
		if ($name != $table) {
			$sql = "ALTER TABLE \"{$table}\" RENAME TO \"{$name}\"";
			$status = $this->execute($sql);
			if ($status != 0) {
				$this->rollbackTransaction();
				return -3;
			}
		}
				
		return $this->endTransaction();
	}
	
	/**
	 * Removes a table from the database
	 * @param $table The table to drop
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropTable($table, $cascade) {
		$this->fieldClean($table);

		$sql = "DROP TABLE \"{$table}\"";
		if ($cascade) $sql .= " CASCADE";

		return $this->execute($sql);
	}

	/**
	 * Empties a table in the database
	 * @param $table The table to be emptied
	 * @return 0 success
	 */
	function emptyTable($table) {
		$this->fieldClean($table);

		$sql = "DELETE FROM \"{$table}\"";

		return $this->execute($sql);
	}

	/**
	 * Renames a table
	 * @param $table The table to be renamed
	 * @param $newName The new name for the table
	 * @return 0 success
	 */
	function renameTable($table, $newName) {
		$this->fieldClean($table);
		$this->fieldClean($newName);
		
		$sql = "ALTER TABLE \"{$table}\" RENAME TO \"{$newName}\"";

		return $this->execute($sql);
	}

	/**
	 * Finds the number of rows that would be returned by a
	 * query.
	 * @param $query The SQL query
	 * @param $count The count query
	 * @return The count of rows
	 * @return -1 error
	 */
	function browseQueryCount($query, $count) {
		// Count the number of rows
		$rs = $this->selectSet($query);
		if (!is_object($rs)) {
			return -1;
		}
		
		return $rs->recordCount();	
	}
	
	/**
	 * Returns a recordset of all columns in a query.  Supports paging.
	 * @param $type Either 'QUERY' if it is an SQL query, or 'TABLE' if it is a table identifier,
	 *              or 'SELECT" if it's a select query
	 * @param $table The base table of the query.  NULL for no table.
	 * @param $query The query that is being executed.  NULL for no query.
	 * @param $sortkey The column number to sort by, or '' or null for no sorting
	 * @param $sortdir The direction in which to sort the specified column ('asc' or 'desc')
	 * @param $page The page of the relation to retrieve
	 * @param $page_size The number of rows per page
	 * @param &$max_pages (return-by-ref) The max number of pages in the relation
	 * @return A recordset on success
	 * @return -1 transaction error
	 * @return -2 counting error
	 * @return -3 page or page_size invalid
	 * @return -4 unknown type
	 */
	function &browseQuery($type, $table, $query, $sortkey, $sortdir, $page, $page_size, &$max_pages) {
		// Check that we're not going to divide by zero
		if (!is_numeric($page_size) || $page_size != (int)$page_size || $page_size <= 0) return -3;

		// If $type is TABLE, then generate the query
		switch ($type) {
			case 'TABLE':
				if (ereg('^[0-9]+$', $sortkey) && $sortkey > 0) $orderby = array($sortkey => $sortdir);
				else $orderby = array();
				$query = $this->getSelectSQL($table, array(), array(), array(), $orderby);
				break;
			case 'QUERY':
			case 'SELECT':
				// Trim query
				$query = trim($query);
				// Trim off trailing semi-colon if there is one
				if (substr($query, strlen($query) - 1, 1) == ';')
					$query = substr($query, 0, strlen($query) - 1);
				break;
			default:
				return -4;
		}

		// Generate count query
		$count = "SELECT COUNT(*) AS total FROM ($query) AS sub";

		// Open a transaction
		$status = $this->beginTransaction();
		if ($status != 0) return -1;
		
		// Count the number of rows
		$total = $this->browseQueryCount($query, $count);
		if ($total < 0) {
			$this->rollbackTransaction();
			return -2;
		}

		// Calculate max pages
		$max_pages = ceil($total / $page_size);
		
		// Check that page is less than or equal to max pages
		if (!is_numeric($page) || $page != (int)$page || $page > $max_pages || $page < 1) {
			$this->rollbackTransaction();
			return -3;
		}

		// Set fetch mode to NUM so that duplicate field names are properly returned
		// for non-table queries.  Since the SELECT feature only allows selecting one
		// table, duplicate fields shouldn't appear.
		if ($type == 'QUERY') $this->conn->setFetchMode(ADODB_FETCH_NUM);

		// Figure out ORDER BY.  Sort key is always the column number (based from one)
		// of the column to order by.  Only need to do this for non-TABLE queries
		if ($type != 'TABLE' && ereg('^[0-9]+$', $sortkey) && $sortkey > 0) {
			$orderby = " ORDER BY {$sortkey}";
			// Add sort order
			if ($sortdir == 'desc')
				$orderby .= ' DESC';
			else
				$orderby .= ' ASC';
		}	
		else $orderby = '';

		// Actually retrieve the rows, with offset and limit
		if ($this->hasFullSubqueries())
			$rs = $this->selectSet("SELECT * FROM ({$query}) AS sub {$orderby} LIMIT {$page_size} OFFSET " . ($page - 1) * $page_size);
		else
			$rs = $this->selectSet("{$query} LIMIT {$page_size} OFFSET " . ($page - 1) * $page_size);
		$status = $this->endTransaction();
		if ($status != 0) {
			$this->rollbackTransaction();
			return -1;
		}
		
		return $rs;
	}
		
	/**
	 * Returns a recordset of all columns in a table
	 * @param $table The name of a table
	 * @param $key The associative array holding the key to retrieve
	 * @return A recordset
	 */
	function &browseRow($table, $key) {
		$this->fieldClean($table);

		$sql = "SELECT * FROM \"{$table}\"";
		if (is_array($key) && sizeof($key) > 0) {
			$sql .= " WHERE true";
			foreach ($key as $k => $v) {
				$this->fieldClean($k);
				$this->clean($v);
				$sql .= " AND \"{$k}\"='{$v}'";
			}
		}

		return $this->selectSet($sql);
	}

	// Sequence functions
	
	/**
	 * Returns all sequences in the current database
	 * @return A recordset
	 */
	function &getSequences() {
		$sql = "SELECT c.relname, u.usename FROM pg_class c, pg_user u WHERE c.relowner=u.usesysid AND c.relkind = 'S' ORDER BY relname";
		
		return $this->selectSet( $sql );
	}

	/**
	 * Returns properties of a single sequence
	 * @param $sequence Sequence name
	 * @return A recordset
	 */
	function &getSequence($sequence) {
		$this->fieldClean($sequence);
		
		$sql = "SELECT sequence_name AS relname, * FROM \"{$sequence}\""; 
		
		return $this->selectSet( $sql );
	}

	/** 
	 * Drops a given sequence
	 * @param $sequence Sequence name
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropSequence($sequence, $cascade) {
		$this->fieldClean($sequence);
		
		$sql = "DROP SEQUENCE \"{$sequence}\"";
		if ($cascade) $sql .= " CASCADE";
		
		return $this->execute($sql);
	}

	/** 
	 * Resets a given sequence to 2 (lowest possible in 7.0)
	 * @param $sequence Sequence name
	 * @return 0 success
	 */
	function &resetSequence($sequence) {
		/* This double-cleaning is deliberate */
		$this->fieldClean($sequence);
		$this->clean($sequence);
		
		$sql = "SELECT SETVAL('\"{$sequence}\"', 1)";
		
		return $this->execute($sql);
	}

	/**
	 * Creates a new sequence
	 * @param $sequence Sequence name
	 * @param $increment The increment
	 * @param $minvalue The min value
	 * @param $maxvalue The max value
	 * @param $startvalue The starting value
	 * @return 0 success
	 */
	function createSequence($sequence, $increment, $minvalue, $maxvalue, $startvalue) {
		$this->fieldClean($sequence);
		
		$sql = "CREATE SEQUENCE \"{$sequence}\"";
		if ($increment != '') $sql .= " INCREMENT {$increment}";
		if ($minvalue != '') $sql .= " MINVALUE {$minvalue}";
		if ($maxvalue != '') $sql .= " MAXVALUE {$maxvalue}";
		if ($startvalue != '') $sql .= " START {$startvalue}";
		
		return $this->execute($sql);
	}

	// Constraint functions

	/**
	 * Adds a check constraint to a table
	 * @param $table The table to which to add the check
	 * @param $definition The definition of the check
	 * @param $name (optional) The name to give the check, otherwise default name is assigned
	 * @return 0 success
	 */
	function addCheckConstraint($table, $definition, $name = '') {
		$this->fieldClean($table);
		$this->fieldClean($name);
		// @@ How the heck do you clean a definition???

		$sql = "ALTER TABLE \"{$table}\" ADD ";
		if ($name != '') $sql .= "CONSTRAINT \"{$name}\" ";
		$sql .= "CHECK ({$definition})";

		return $this->execute($sql);
	}
	
	/**
	 * Drops a check constraint from a table
	 * @param $table The table from which to drop the check
	 * @param $name The name of the check to be dropped
	 * @return 0 success
	 * @return -2 transaction error
	 * @return -3 lock error
	 * @return -4 check drop error
	 */
	function dropCheckConstraint($table, $name) {
		$this->clean($table);
		$this->clean($name);
		
		// Begin transaction
		$status = $this->beginTransaction();
		if ($status != 0) return -2;

		// Properly lock the table
		$sql = "LOCK TABLE \"{$table}\" IN ACCESS EXCLUSIVE MODE";
		$status = $this->execute($sql);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -3;
		}

		// Delete the check constraint
		$sql = "DELETE FROM pg_relcheck WHERE rcrelid=(SELECT oid FROM pg_class WHERE relname='{$table}') AND rcname='{$name}'";
	   	$status = $this->execute($sql);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -4;
		}
		
		// Update the pg_class catalog to reflect the new number of checks
		$sql = "UPDATE pg_class SET relchecks=(SELECT COUNT(*) FROM pg_relcheck WHERE 
					rcrelid=(SELECT oid FROM pg_class WHERE relname='{$table}')) 
					WHERE relname='{$table}'";
	   	$status = $this->execute($sql);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -4;
		}

		// Otherwise, close the transaction
		return $this->endTransaction();
	}	

	// Constraint functions

	/**
	 * Removes a constraint from a relation
	 * @param $constraint The constraint to drop
	 * @param $relation The relation from which to drop
	 * @param $type The type of constraint (c, f, u or p)
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 * @return -99 dropping foreign keys not supported
	 */
	function dropConstraint($constraint, $relation, $type, $cascade) {
		$this->fieldClean($constraint);
		$this->fieldClean($relation);

		switch ($type) {
			case 'c':
				// CHECK constraint		
				return $this->dropCheckConstraint($relation, $constraint);
				break;
			case 'p':
			case 'u':
				// PRIMARY KEY or UNIQUE constraint
				return $this->dropIndex($constraint, $cascade);
				break;
			case 'f':
				// FOREIGN KEY constraint
				return -99;
		}				
	}

	/**
	 * Adds a unique constraint to a table
	 * @param $table The table to which to add the unique
	 * @param $fields (array) An array of fields over which to add the unique
	 * @param $name (optional) The name to give the unique, otherwise default name is assigned
	 * @return 0 success
	 * @return -1 invalid fields
	 */
	function addUniqueKey($table, $fields, $name = '') {
		if (!is_array($fields) || sizeof($fields) == 0) return -1;
		$this->fieldClean($table);
		$this->fieldArrayClean($fields);
		$this->fieldClean($name);
		
		if ($name != '')
			$sql = "CREATE UNIQUE INDEX \"{$name}\" ON \"{$table}\"(\"" . join('","', $fields) . "\")";
		else return -99; // Not supported

		return $this->execute($sql);
	}

	/**
	 * Adds a foreign key constraint to a table
	 * @param $targschema The schema that houses the target table to which to add the foreign key
	 * @param $targtable The table to which to add the foreign key
	 * @param $target The table that contains the target columns
	 * @param $sfields (array) An array of source fields over which to add the foreign key
	 * @param $tfields (array) An array of target fields over which to add the foreign key
	 * @param $upd_action The action for updates (eg. RESTRICT)
	 * @param $del_action The action for deletes (eg. RESTRICT)
	 * @param $name (optional) The name to give the key, otherwise default name is assigned
	 * @return 0 success
	 * @return -1 no fields given
	 */
	function addForeignKey($table, $targschema, $targtable, $sfields, $tfields, $upd_action, $del_action, $name = '') {
		if (!is_array($sfields) || sizeof($sfields) == 0 ||
			!is_array($tfields) || sizeof($tfields) == 0) return -1;
		$this->fieldClean($table);
		$this->fieldClean($targschema);
		$this->fieldClean($targtable);
		$this->fieldArrayClean($sfields);
		$this->fieldArrayClean($tfields);
		$this->fieldClean($name);

		$sql = "ALTER TABLE \"{$table}\" ADD ";
		if ($name != '') $sql .= "CONSTRAINT \"{$name}\" ";
		$sql .= "FOREIGN KEY (\"" . join('","', $sfields) . "\") ";
		$sql .= "REFERENCES ";
		// Target table needs to be fully qualified
		if ($this->hasSchemas()) {
			$sql .= "\"{$targschema}\".";
		}		
		$sql .= "\"{$targtable}\"(\"" . join('","', $tfields) . "\") ";
		if ($upd_action != 'NO ACTION') $sql .= " ON UPDATE {$upd_action}";
		if ($del_action != 'NO ACTION') $sql .= " ON DELETE {$del_action}";

		return $this->execute($sql);
	}
	 
	/**
	 * Adds a primary key constraint to a table
	 * @param $table The table to which to add the primery key
	 * @param $fields (array) An array of fields over which to add the primary key
	 * @param $name (optional) The name to give the key, otherwise default name is assigned
	 * @return 0 success
	 */
	function addPrimaryKey($table, $fields, $name = '') {
		// This function can be faked with a unique index and a catalog twiddle, however
		// how do we ensure that it's only used on NOT NULL fields?
		return -99; // Not supported.
	}

	/**
	 * Changes the owner of a table
	 * @param $table The table whose owner is to change
	 * @param $owner The new owner (username) of the table
	 * @return 0 success
	 */
	function setOwnerOfTable($table, $owner) {
		$this->fieldClean($table);
		$this->fieldClean($owner);
		
		$sql = "ALTER TABLE \"{$table}\" OWNER TO \"{$owner}\"";

		return $this->execute($sql);
	}

	/**
	 * Finds the foreign keys that refer to the specified table
	 * @param $table The table to find referrers for
	 * @return A recordset
	 */
	function &getReferrers($table) {
		// In PostgreSQL < 7.3, there is no way to discover foreign keys
		return -99;
	}

	// Column Functions

	/**
	 * Add a new column to a table
	 * @param $table The table to add to
	 * @param $column The name of the new column
	 * @param $type The type of the column
	 * @param $length The optional size of the column (ie. 30 for varchar(30))
	 * @return 0 success
	 */
	function addColumn($table, $column, $type, $length) {
		$this->fieldClean($table);
		$this->fieldClean($column);
		$this->clean($type);
		$this->clean($length);

		if ($length == '')
			$sql = "ALTER TABLE \"{$table}\" ADD COLUMN \"{$column}\" {$type}";
		else {
			switch ($type) {
				// Have to account for weird placing of length for with/without
				// time zone types
				case 'timestamp with time zone':
				case 'timestamp without time zone':
					$qual = substr($type, 9);
					$sql = "ALTER TABLE \"{$table}\" ADD COLUMN \"{$column}\" timestamp({$length}){$qual}";
					break;
				case 'time with time zone':
				case 'time without time zone':
					$qual = substr($type, 4);
					$sql = "ALTER TABLE \"{$table}\" ADD COLUMN \"{$column}\" time({$length}){$qual}";
					break;
				default:
					$sql = "ALTER TABLE \"{$table}\" ADD COLUMN \"{$column}\" {$type}({$length})";
			}
		}
		return $this->execute($sql);
	}

	/**
	 * Sets default value of a column
	 * @param $table The table from which to drop
	 * @param $column The column name to set
	 * @param $default The new default value
	 * @return 0 success
	 */
	function setColumnDefault($table, $column, $default) {
		$this->fieldClean($table);
		$this->fieldClean($column);
		
		$sql = "ALTER TABLE \"{$table}\" ALTER COLUMN \"{$column}\" SET DEFAULT {$default}";

		return $this->execute($sql);
	}

	/**
	 * Drops default value of a column
	 * @param $table The table from which to drop
	 * @param $column The column name to drop default
	 * @return 0 success
	 */
	function dropColumnDefault($table, $column) {
		$this->fieldClean($table);
		$this->fieldClean($column);

		$sql = "ALTER TABLE \"{$table}\" ALTER COLUMN \"{$column}\" DROP DEFAULT";

		return $this->execute($sql);
	}

	/**
	 * Sets whether or not a column can contain NULLs
	 * @param $table The table that contains the column
	 * @param $column The column to alter
	 * @param $state True to set null, false to set not null
	 * @return 0 success
	 * @return -1 attempt to set not null, but column contains nulls
	 * @return -2 transaction error
	 * @return -3 lock error
	 * @return -4 update error
	 */
	function setColumnNull($table, $column, $state) {
		$this->fieldClean($table);
		$this->fieldClean($column);

		// Begin transaction
		$status = $this->beginTransaction();
		if ($status != 0) return -2;

		// Properly lock the table
		$sql = "LOCK TABLE \"{$table}\" IN ACCESS EXCLUSIVE MODE";
		$status = $this->execute($sql);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -3;
		}

		// Check for existing nulls
		if (!$state) {
			$sql = "SELECT COUNT(*) AS total FROM \"{$table}\" WHERE \"{$column}\" IS NULL";
			$result = $this->selectField($sql, 'total');
			if ($result > 0) {
				$this->rollbackTransaction();
				return -1;
			}
		}

		// Otherwise update the table.  Note the reverse-sensed $state variable
		$sql = "UPDATE pg_attribute SET attnotnull = " . (($state) ? 'false' : 'true') . " 
					WHERE attrelid = (SELECT oid FROM pg_class WHERE relname = '{$table}') 
					AND attname = '{$column}'";

		$status = $this->execute($sql);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -4;
		}

		// Otherwise, close the transaction
		return $this->endTransaction();
	}

	/**
	 * Renames a column in a table
	 * @param $table The table containing the column to be renamed
	 * @param $column The column to be renamed
	 * @param $newName The new name for the column
	 * @return 0 success
	 */
	function renameColumn($table, $column, $newName) {
		$this->fieldClean($table);
		$this->fieldClean($column);
		$this->fieldClean($newName);

		$sql = "ALTER TABLE \"{$table}\" RENAME COLUMN \"{$column}\" TO \"{$newName}\"";

		return $this->execute($sql);
	}

	/**
	 * Grabs a list of indexes for a table
	 * @param $table The name of a table whose indexes to retrieve
	 * @return A recordset
	 */
	function &getIndexes($table = '') {
		$this->clean($table);
		$sql = "SELECT c2.relname, i.indisprimary, i.indisunique, pg_get_indexdef(i.indexrelid)
			FROM pg_class c, pg_class c2, pg_index i
			WHERE c.relname = '{$table}' AND c.oid = i.indrelid AND i.indexrelid = c2.oid
			AND NOT i.indisprimary AND NOT i.indisunique
			ORDER BY c2.relname";

		return $this->selectSet($sql);
	}

	/**
	 * Creates an index
	 * @param $name The index name
	 * @param $table The table on which to add the index
	 * @param $columns An array of columns that form the index
	 * @param $type The index type
	 * @param $unique True if unique, false otherwise
	 * @param $where Index predicate ('' for none)
	 * @return 0 success
	 */
	function createIndex($name, $table, $columns, $type, $unique, $where) {
		$this->fieldClean($name);
		$this->fieldClean($table);
		$this->arrayClean($columns);

		$sql = "CREATE";
		if ($unique) $sql .= " UNIQUE";
		$sql .= " INDEX \"{$name}\" ON \"{$table}\" USING {$type} ";
		$sql .= "(\"" . implode('","', $columns) . "\")";

		if ($this->hasPartialIndexes() && trim($where) != '') {
			$sql .= " WHERE ({$where})";
		}

		return $this->execute($sql);
	}

	/**
	 * Removes an index from the database
	 * @param $index The index to drop
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropIndex($index, $cascade) {
		$this->fieldClean($index);

		$sql = "DROP INDEX \"{$index}\"";
		if ($cascade) $sql .= " CASCADE";

		return $this->execute($sql);
	}

	// Rule functions
	
	/**
	 * Removes a rule from a relation
	 * @param $rule The rule to drop
	 * @param $relation The relation from which to drop (unused)
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropRule($rule, $relation, $cascade) {
		$this->fieldClean($rule);

		$sql = "DROP RULE \"{$rule}\"";
		if ($cascade) $sql .= " CASCADE";

		return $this->execute($sql);
	}

	/**
	 * Creates a rule
	 * @param $name The name of the new rule
	 * @param $event SELECT, INSERT, UPDATE or DELETE
	 * @param $table Table on which to create the rule
	 * @param $where When to execute the rule, '' indicates always
	 * @param $instead True if an INSTEAD rule, false otherwise
	 * @param $type NOTHING for a do nothing rule, SOMETHING to use given action
	 * @param $action The action to take
	 * @param $replace (optional) True to replace existing rule, false otherwise
	 * @return 0 success
	 * @return -1 invalid event
	 */
	function createRule($name, $event, $table, $where, $instead, $type, $action, $replace = false) {
		$this->fieldClean($name);
		$this->fieldClean($table);
		if (!in_array($event, $this->rule_events)) return -1;

		$sql = "CREATE";
		if ($replace) $sql .= " OR REPLACE";
		$sql .= " RULE \"{$name}\" AS ON {$event} TO \"{$table}\"";
		// Can't escape WHERE clause
		if ($where != '') $sql .= " WHERE {$where}";
		$sql .= " DO";
		if ($instead) $sql .= " INSTEAD";
		if ($type == 'NOTHING') 
			$sql .= " NOTHING";
		else $sql .= " ({$action})";

		return $this->execute($sql);
	}
	
	/**
	 * Edits a rule
	 * @param $name The name of the new rule
	 * @param $event SELECT, INSERT, UPDATE or DELETE
	 * @param $table Table on which to create the rule
	 * @param $where When to execute the rule, '' indicates always
	 * @param $instead True if an INSTEAD rule, false otherwise
	 * @param $type NOTHING for a do nothing rule, SOMETHING to use given action
	 * @param $action The action to take
	 * @return 0 success
	 * @return -1 invalid event
	 * @return -2 transaction error
	 * @return -3 drop existing rule error
	 * @return -4 create new rule error
	 */
	function setRule($name, $event, $table, $where, $instead, $type, $action) {
		$status = $this->beginTransaction();
		if ($status != 0) return -2;

		$status = $this->dropRule($name, $table);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -3;
		}

		$status = $this->createRule($name, $event, $table, $where, $instead, $type, $action);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -4;
		}
		
		$status = $this->endTransaction();
		return ($status == 0) ? 0 : -2;
	}

	// View functions
	
	/**
	 * Returns a list of all views in the database
	 * @return All views
	 */
	function &getViews() {
		global $conf;
		if (!$conf['show_system'])
			$where = "WHERE viewname NOT LIKE 'pg\\\\_%'";
		else $where  = '';
		
		$sql = "SELECT viewname, viewowner FROM pg_views {$where} ORDER BY viewname";

		return $this->selectSet($sql);
	}
	
	/**
	 * Returns all details for a particular view
	 * @param $view The name of the view to retrieve
	 * @return View info
	 */
	function &getView($view) {
		$this->clean($view);
		
		$sql = "SELECT viewname, viewowner, definition FROM pg_views WHERE viewname='$view'";

		return $this->selectSet($sql);
	}	

	/**
	 * Creates a new view.
	 * @param $viewname The name of the view to create
	 * @param $definition The definition for the new view
	 * @param $replace True to replace the view, false otherwise
	 * @return 0 success
	 */
	function createView($viewname, $definition, $replace) {
		$this->fieldClean($viewname);
		// Note: $definition not cleaned
		
		$sql = "CREATE ";
		if ($replace) $sql .= "OR REPLACE ";		
		$sql .= "VIEW \"{$viewname}\" AS {$definition}";
		
		return $this->execute($sql);
	}
	
	/**
	 * Drops a view.
	 * @param $viewname The name of the view to drop
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropView($viewname, $cascade) {
		$this->fieldClean($viewname);

		$sql = "DROP VIEW \"{$viewname}\"";
		if ($cascade) $sql .= " CASCADE";

		return $this->execute($sql);
	}

	/**
	 * Updates a view.  Postgres 7.1 and below don't have CREATE OR REPLACE view,
	 * so we do it with a drop and a recreate.
	 * @param $viewname The name fo the view to update
	 * @param $definition The new definition for the view
	 * @return 0 success
	 * @return -1 transaction error
	 * @return -2 drop view error
	 * @return -3 create view error
	 */
	function setView($viewname, $definition) {
		$status = $this->beginTransaction();
		if ($status != 0) return -1;
		
		$status = $this->dropView($viewname, false);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -2;
		}
		
		$status = $this->createView($viewname, $definition, false);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -3;
		}
		
		$status = $this->endTransaction();
		return ($status == 0) ? 0 : -1;
	}	

	// Find object functions
	
	/**
	 * Searches all system catalogs to find objects that match a certain name.
	 * @param $term The search term
	 * @return A recordset
	 */
	function findObject($term) {
		global $conf;

		// Escape search term for ~* match
		$special = array('.', '*', '^', '$', ':', '?', '+', ',', '=', '!', '[', ']', '(', ')', '{', '}', '<', '>', '-', '\\');
		foreach ($special as $v) {
			$term = str_replace($v, "\\{$v}", $term);
		}
		$this->clean($term);

		// Build SQL, excluding system relations as necessary
		// Relations
		$sql = "
			SELECT CASE WHEN relkind='r' THEN 'TABLE'::VARCHAR WHEN relkind='v' THEN 'VIEW'::VARCHAR WHEN relkind='S' THEN 'SEQUENCE'::VARCHAR END AS type, 
				pc.oid, NULL::VARCHAR AS schemaname, NULL::VARCHAR AS relname, pc.relname AS name FROM pg_class pc
				WHERE relkind IN ('r', 'v', 'S') AND relname ~* '.*{$term}.*'";
		if (!$conf['show_system']) $sql .= " AND pc.relname NOT LIKE 'pg\\\\_%'";				

		// Columns
		$sql .= "				
			UNION ALL
			SELECT 'COLUMN', NULL, NULL, pc.relname, pa.attname FROM pg_class pc,
				pg_attribute pa WHERE pc.oid=pa.attrelid 
				AND pa.attname ~* '.*{$term}.*' AND pa.attnum > 0 AND pc.relkind IN ('r', 'v')";
		if (!$conf['show_system']) $sql .= " AND pc.relname NOT LIKE 'pg\\\\_%'";				

		// Functions
		$sql .= "
			UNION ALL
			SELECT 'FUNCTION', pp.oid, NULL, NULL, pp.proname FROM pg_proc pp
				WHERE proname ~* '.*{$term}.*'";
		if (!$conf['show_system']) $sql .= " AND pp.oid > '{$this->_lastSystemOID}'::oid";
			
		// Indexes
		$sql .= "
			UNION ALL
			SELECT 'INDEX', NULL, NULL, pc.relname, pc2.relname FROM pg_class pc,
				pg_index pi, pg_class pc2 WHERE pc.oid=pi.indrelid 
				AND pi.indexrelid=pc2.oid
				AND pc2.relname ~* '.*{$term}.*' AND NOT pi.indisprimary AND NOT pi.indisunique";
		if (!$conf['show_system']) $sql .= " AND pc2.relname NOT LIKE 'pg\\\\_%'";				

		// Check Constraints
		$sql .= "
			UNION ALL
			SELECT 'CONSTRAINT', NULL, NULL, pc.relname, pr.rcname FROM pg_class pc,
				pg_relcheck pr WHERE pc.oid=pr.rcrelid
				AND pr.rcname ~* '.*{$term}.*'";
		if (!$conf['show_system']) $sql .= " AND pc.relname NOT LIKE 'pg\\\\_%'";				
		// Unique and Primary Key Constraints
		$sql .= "
			UNION ALL
			SELECT 'CONSTRAINT', NULL, NULL, pc.relname, pc2.relname FROM pg_class pc,
				pg_index pi, pg_class pc2 WHERE pc.oid=pi.indrelid 
				AND pi.indexrelid=pc2.oid
				AND pc2.relname ~* '.*{$term}.*' AND (pi.indisprimary OR pi.indisunique)";
		if (!$conf['show_system']) $sql .= " AND pc2.relname NOT LIKE 'pg\\\\_%'";				

		// Triggers
		$sql .= "
			UNION ALL
			SELECT 'TRIGGER', NULL, NULL, pc.relname, pt.tgname FROM pg_class pc,
				pg_trigger pt WHERE pc.oid=pt.tgrelid
				AND pt.tgname ~* '.*{$term}.*'";
		if (!$conf['show_system']) $sql .= " AND pc.relname NOT LIKE 'pg\\\\_%'";				

		// Rules
		$sql .= "
			UNION ALL
			SELECT 'RULE', NULL, NULL, tablename, rulename FROM pg_rules
				WHERE rulename ~* '.*{$term}.*'";
		if (!$conf['show_system']) $sql .= " AND tablename NOT LIKE 'pg\\\\_%'";				

		// Advanced Objects
		if ($conf['show_advanced']) {
			// Types
			$sql .= "
				UNION ALL
				SELECT 'TYPE', pt.oid, NULL, NULL, pt.typname FROM pg_type pt
					WHERE typname ~* '.*{$term}.*' AND (pt.typrelid = 0 OR (SELECT c.relkind = 'c' FROM pg_class c WHERE c.oid = pt.typrelid))";
			if (!$conf['show_system']) $sql .= " AND pt.oid > '{$this->_lastSystemOID}'::oid";

			// Operators
			$sql .= "				
				UNION ALL
				SELECT 'OPERATOR', po.oid, NULL, NULL, po.oprname FROM pg_operator po
					WHERE oprname ~* '.*{$term}.*'";
			if (!$conf['show_system']) $sql .= " AND po.oid > '{$this->_lastSystemOID}'::oid";

			// Languages
			$sql .= "				
				UNION ALL
				SELECT 'LANGUAGE', pl.oid, NULL, NULL, pl.lanname FROM pg_language pl
					WHERE lanname ~* '.*{$term}.*'";
			if (!$conf['show_system']) $sql .= " AND pl.lanispl";
		}
				
		$sql .= " ORDER BY type, schemaname, relname, name";
			
		return $this->selectSet($sql);
	}

	// Operator functions

	/**
	 * Returns a list of all operators in the database
	 * @return All operators
	 */
	function &getOperators() {
		global $conf;
		if (!$conf['show_system'])
			$where = "WHERE po.oid > '{$this->_lastSystemOID}'::oid";
		else $where  = '';
		
		$sql = "
			SELECT
            po.oid,
				po.oprname,
				(SELECT typname FROM pg_type pt WHERE pt.oid=po.oprleft) AS oprleftname,
				(SELECT typname FROM pg_type pt WHERE pt.oid=po.oprright) AS oprrightname,
				(SELECT typname FROM pg_type pt WHERE pt.oid=po.oprresult) AS resultname
			FROM
				pg_operator po
			{$where}				
			ORDER BY
				po.oprname, oprleftname, oprrightname
		";

		return $this->selectSet($sql);
	}

	/**
	 * Returns all details for a particular operator
	 * @param $operator_oid The oid of the operator
	 * @return Function info
	 */
	function getOperator($operator_oid) {
		$this->clean($operator_oid);

		$sql = "
			SELECT
            po.oid,
				po.oprname,
				(SELECT typname FROM pg_type pt WHERE pt.oid=po.oprleft) AS oprleftname,
				(SELECT typname FROM pg_type pt WHERE pt.oid=po.oprright) AS oprrightname,
				(SELECT typname FROM pg_type pt WHERE pt.oid=po.oprresult) AS resultname,
				po.oprcanhash,
				(SELECT oprname FROM pg_operator po2 WHERE po2.oid=po.oprcom) AS oprcom,
				(SELECT oprname FROM pg_operator po2 WHERE po2.oid=po.oprnegate) AS oprnegate,
				(SELECT oprname FROM pg_operator po2 WHERE po2.oid=po.oprlsortop) AS oprlsortop,
				(SELECT oprname FROM pg_operator po2 WHERE po2.oid=po.oprltcmpop) AS oprltcmpop,
				(SELECT oprname FROM pg_operator po2 WHERE po2.oid=po.oprgtcmpop) AS oprgtcmpop,
				po.oprcode::regproc AS oprcode,
				--(SELECT proname FROM pg_proc pp WHERE pp.oid=po.oprcode) AS oprcode,
				(SELECT proname FROM pg_proc pp WHERE pp.oid=po.oprrest) AS oprrest,
				(SELECT proname FROM pg_proc pp WHERE pp.oid=po.oprjoin) AS oprjoin
			FROM
				pg_operator po
			WHERE
				po.oid='{$operator_oid}'
		";
	
		return $this->selectSet($sql);
	}

	/**
	 * Drops an operator
	 * @param $operator_oid The OID of the operator to drop
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropOperator($operator_oid, $cascade) {
		// Function comes in with $object as operator OID
		$opr = &$this->getOperator($operator_oid);
		$this->fieldClean($opr->f['oprname']);

		$sql = "DROP OPERATOR {$opr->f['oprname']} (";
		// Quoting or formatting here???
		if ($opr->f['oprleftname'] !== null) $sql .= $opr->f['oprleftname'] . ', ';
		else $sql .= "NONE, ";
		if ($opr->f['oprrightname'] !== null) $sql .= $opr->f['oprrightname'] . ')';
		else $sql .= "NONE)";
		
		if ($cascade) $sql .= " CASCADE";
		
		return $this->execute($sql);
	}	

	// User functions
	
	/**
	 * Changes a user's password
	 * @param $username The username
	 * @param $password The new password
	 * @return 0 success
	 */
	function changePassword($username, $password) {
		$this->fieldClean($username);
		$this->clean($password);
		
		$sql = "ALTER USER \"{$username}\" WITH PASSWORD '{$password}'";
		
		return $this->execute($sql);
	}
	
	/**
	 * Returns all users in the database cluster
	 * @return All users
	 */
	function &getUsers() {
		$sql = "SELECT usename, usesuper, usecreatedb, valuntil FROM pg_user ORDER BY usename";
		
		return $this->selectSet($sql);
	}
	
	/**
	 * Return information about a single user
	 * @param $username The username of the user to retrieve
	 * @return The user's data
	 */
	function &getUser($username) {
		$this->clean($username);
		
		$sql = "SELECT usename, usesuper, usecreatedb, valuntil FROM pg_user WHERE usename='{$username}'";
		
		return $this->selectSet($sql);
	}
	
	/**
	 * Determines whether or not a user is a super user
	 * @param $username The username of the user
	 * @return True if is a super user, false otherwise
	 */
	function isSuperUser($username) {
		$this->clean($username);
		
		$sql = "SELECT usesuper FROM pg_user WHERE usename='{$username}'";
		
		$usesuper = $this->selectField($sql, 'usesuper');
		if ($usesuper == -1) return false;
		else return $usesuper == 't';
	}	
	
	/**
	 * Creates a new user
	 * @param $username The username of the user to create
	 * @param $password A password for the user
	 * @param $createdb boolean Whether or not the user can create databases
	 * @param $createuser boolean Whether or not the user can create other users
	 * @param $expiry string Format 'YYYY-MM-DD HH:MM:SS'.  When the account expires.
	 * @param $group (array) The groups to create the user in
	 * @return 0 success
	 */
	function createUser($username, $password, $createdb, $createuser, $expiry, $groups) {
		$this->fieldClean($username);
		$this->clean($password);
		$this->clean($expiry);
		$this->fieldArrayClean($groups);		

		$sql = "CREATE USER \"{$username}\"";
		if ($password != '') $sql .= " WITH PASSWORD '{$password}'";
		$sql .= ($createdb) ? ' CREATEDB' : ' NOCREATEDB';
		$sql .= ($createuser) ? ' CREATEUSER' : ' NOCREATEUSER';
		if (is_array($groups) && sizeof($groups) > 0) $sql .= " IN GROUP \"" . join('", "', $groups) . "\"";
		if ($expiry != '') $sql .= " VALID UNTIL '{$expiry}'";
		
		return $this->execute($sql);
	}	
	
	/**
	 * Adjusts a user's info
	 * @param $username The username of the user to modify
	 * @param $password A new password for the user
	 * @param $createdb boolean Whether or not the user can create databases
	 * @param $createuser boolean Whether or not the user can create other users
	 * @param $expiry string Format 'YYYY-MM-DD HH:MM:SS'.  When the account expires.
	 * @return 0 success
	 */
	function setUser($username, $password, $createdb, $createuser, $expiry) {
		$this->fieldClean($username);
		$this->clean($password);
		$this->clean($expiry);
		
		$sql = "ALTER USER \"{$username}\"";
		if ($password != '') $sql .= " WITH PASSWORD '{$password}'";
		$sql .= ($createdb) ? ' CREATEDB' : ' NOCREATEDB';
		$sql .= ($createuser) ? ' CREATEUSER' : ' NOCREATEUSER';
		if ($expiry != '') $sql .= " VALID UNTIL '{$expiry}'";
		
		return $this->execute($sql);
	}	
	
	/**
	 * Removes a user
	 * @param $username The username of the user to drop
	 * @return 0 success
	 */
	function dropUser($username) {
		$this->fieldClean($username);
		
		$sql = "DROP USER \"{$username}\"";
		
		return $this->execute($sql);
	}
	
	// Group functions
	
	/**
	 * Returns all groups in the database cluser
	 * @return All groups
	 */
	function &getGroups() {
		$sql = "SELECT groname FROM pg_group ORDER BY groname";
		
		return $this->selectSet($sql);
	}

	/**
	 * Return users in a specific group
	 * @param $groname The name of the group
	 * @return All users in the group
	 */
	function &getGroup($groname) {
		$this->clean($groname);

		$sql = "SELECT grolist FROM pg_group WHERE groname = '{$groname}'";
      
		$grodata = $this->selectSet($sql);
		if ($grodata->f['grolist'] !== null && $grodata->f['grolist'] != '{}') {
			$members = $grodata->f['grolist'];
			$members = ereg_replace("\{|\}","",$members);
			$this->clean($members);

			$sql = "SELECT usename FROM pg_user WHERE usesysid IN ({$members}) ORDER BY usename";
		}
		else $sql = "SELECT usename FROM pg_user WHERE false";

		return $this->selectSet($sql);
	}

	/**
	 * Creates a new group
	 * @param $groname The name of the group
	 * @param $users An array of users to add to the group
	 * @return 0 success
	 */
	function createGroup($groname, $users) {
		$this->fieldClean($groname);

		$sql = "CREATE GROUP \"{$groname}\"";
		
		if (is_array($users) && sizeof($users) > 0) {
			$this->fieldArrayClean($users);
			$sql .= ' WITH USER "' . join('", "', $users) . '"';			
		}		
		
		return $this->execute($sql);
	}	
	
	/**
	 * Removes a group
	 * @param $groname The name of the group to drop
	 * @return 0 success
	 */
	function dropGroup($groname) {
		$this->fieldClean($groname);
		
		$sql = "DROP GROUP \"{$groname}\"";
		
		return $this->execute($sql);
	}

	/**
	 * Adds a group member
	 * @param $groname The name of the group
	 * @param $user The name of the user to add to the group
	 * @return 0 success
	 */
	function addGroupMember($groname, $user) {
		$this->fieldClean($groname);
		$this->fieldClean($user);
		
		$sql = "ALTER GROUP \"{$groname}\" ADD USER \"{$user}\"";

		return $this->execute($sql);
	}
	
	/**
	 * Removes a group member
	 * @param $groname The name of the group
	 * @param $user The name of the user to remove from the group
	 * @return 0 success
	 */
	function dropGroupMember($groname, $user) {
		$this->fieldClean($groname);
		$this->fieldClean($user);
		
		$sql = "ALTER GROUP \"{$groname}\" DROP USER \"{$user}\"";

		return $this->execute($sql);
	}
	
	// Type functions

	/**
	 * Returns a list of all types in the database
	 * @param $all If true, will find all available functions, if false just those in search path
	 * @return A recordet
	 */
	function &getTypes($all = false) {
		global $conf;
		
		if ($all || $conf['show_system'])
			$where = '';
		else
			$where = "AND pt.oid > '{$this->_lastSystemOID}'::oid";
		
		$sql = "SELECT
				pt.typname,
				pu.usename AS typowner
			FROM
				pg_type pt,
				pg_user pu
			WHERE
				pt.typowner = pu.usesysid
				AND typrelid = 0
				AND typname !~ '^_.*'
				{$where}
			ORDER BY typname
		";

		return $this->selectSet($sql);
	}

	/**
	 * Returns all details for a particular type
	 * @param $typname The name of the view to retrieve
	 * @return Type info
	 */
	function &getType($typname) {
		$this->clean($typname);
		
		$sql = "SELECT *, typinput AS typin, typoutput AS typout 
			FROM pg_type WHERE typname='{$typname}'";

		return $this->selectSet($sql);
	}	
	
	/**
	 * Creates a new type
	 * @param ...
	 * @return 0 success
	 */
	function createType($typname, $typin, $typout, $typlen, $typdef,
				$typelem, $typdelim, $typbyval, $typalign, $typstorage) {
		$this->fieldClean($typname);
		$this->fieldClean($typin);
		$this->fieldClean($typout);

		$sql = "
			CREATE TYPE \"{$typname}\" (
				INPUT = \"{$typin}\",
				OUTPUT = \"{$typout}\",
				INTERNALLENGTH = {$typlen}";
		if ($typdef != '') $sql .= ", DEFAULT = {$typdef}";
		if ($typelem != '') $sql .= ", ELEMENT = {$typelem}";
		if ($typdelim != '') $sql .= ", DELIMITER = {$typdelim}";
		if ($typbyval) $sql .= ", PASSEDBYVALUE, ";
		if ($typalign != '') $sql .= ", ALIGNMENT = {$typalign}";
		if ($typstorage != '') $sql .= ", STORAGE = {$typstorage}";
		
		$sql .= ")";

		return $this->execute($sql);
	}
	
	/**
	 * Drops a type.
	 * @param $typname The name of the type to drop
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropType($typname, $cascade) {
		$this->fieldClean($typname);

		$sql = "DROP TYPE \"{$typname}\"";
		if ($cascade) $sql .= " CASCADE";

		return $this->execute($sql);
	}

	// Trigger functions

	/**
	 * A helper function for getTriggers that translates
	 * an array of attribute numbers to an array of field names.
	 * @param $trigger An array containing fields from the trigger table
	 * @return The trigger definition string
	 */
	function &getTriggerDef($trigger) {
		// Constants to figure out tgtype

		if (!defined('TRIGGER_TYPE_ROW')) define ('TRIGGER_TYPE_ROW', (1 << 0));
		if (!defined('TRIGGER_TYPE_BEFORE')) define ('TRIGGER_TYPE_BEFORE', (1 << 1));
		if (!defined('TRIGGER_TYPE_INSERT')) define ('TRIGGER_TYPE_INSERT', (1 << 2));
		if (!defined('TRIGGER_TYPE_DELETE')) define ('TRIGGER_TYPE_DELETE', (1 << 3));
		if (!defined('TRIGGER_TYPE_UPDATE')) define ('TRIGGER_TYPE_UPDATE', (1 << 4));

		$trigger['tgisconstraint'] = $this->phpBool($trigger['tgisconstraint']);
		$trigger['tgdeferrable'] = $this->phpBool($trigger['tgdeferrable']);
		$trigger['tginitdeferred'] = $this->phpBool($trigger['tginitdeferred']);

		// Constraint trigger or normal trigger
		if ($trigger['tgisconstraint'])
			$tgdef = 'CREATE CONSTRAINT TRIGGER ';
		else
			$tgdef = 'CREATE TRIGGER ';

		$tgdef .= "\"{$trigger['tgname']}\" ";

		// Trigger type
		$findx = 0;
		if (($trigger['tgtype'] & TRIGGER_TYPE_BEFORE) == TRIGGER_TYPE_BEFORE)
			$tgdef .= 'BEFORE';
		else
			$tgdef .= 'AFTER';

		if (($trigger['tgtype'] & TRIGGER_TYPE_INSERT) == TRIGGER_TYPE_INSERT) {
			$tgdef .= ' INSERT';
			$findx++;
		}
		if (($trigger['tgtype'] & TRIGGER_TYPE_DELETE) == TRIGGER_TYPE_DELETE) {
			if ($findx > 0)
				$tgdef .= ' OR DELETE';
			else {
				$tgdef .= ' DELETE';
				$findx++;
			}
		}
		if (($trigger['tgtype'] & TRIGGER_TYPE_UPDATE) == TRIGGER_TYPE_UPDATE) {
			if ($findx > 0)
				$tgdef .= ' OR UPDATE';
			else
				$tgdef .= ' UPDATE';
		}
	
		// Table name
		$tgdef .= " ON \"{$trigger['relname']}\" ";
		
		// Deferrability
		if ($trigger['tgisconstraint']) {
			if ($trigger['tgconstrrelid'] != 0) {
				// Assume constrelname is not null
				$tgdef .= " FROM \"{$trigger['tgconstrrelname']}\" ";
			}
			if (!$trigger['tgdeferrable'])
				$tgdef .= 'NOT ';
			$tgdef .= 'DEFERRABLE INITIALLY ';
			if ($trigger['tginitdeferred'])
				$tgdef .= 'DEFERRED ';
			else
				$tgdef .= 'IMMEDIATE ';
		}

		// Row or statement
		if ($trigger['tgtype'] & TRIGGER_TYPE_ROW == TRIGGER_TYPE_ROW)
			$tgdef .= 'FOR EACH ROW ';
		else
			$tgdef .= 'FOR EACH STATEMENT ';

		// Execute procedure
		$tgdef .= "EXECUTE PROCEDURE \"{$trigger['tgfname']}\"(";
		
		// Parameters
		// Escape null characters
		$v = addCSlashes($trigger['tgargs'], "\0");
		// Split on escaped null characters
		$params = explode('\\000', $v);		
		for ($findx = 0; $findx < $trigger['tgnargs']; $findx++) {
			$param = "'" . str_replace('\'', '\\\'', $params[$findx]) . "'";
			$tgdef .= $param;
			if ($findx < ($trigger['tgnargs'] - 1))
				$tgdef .= ', ';
		}
		
		// Finish it off
		$tgdef .= ')';

		return $tgdef;
	}

	/**
	 * Grabs a list of triggers on a table
	 * @param $table The name of a table whose triggers to retrieve
	 * @return A recordset
	 */
	function &getTriggers($table = '') {
		$this->clean($table);

		// We include constraint triggers
		$sql = "SELECT t.tgname, t.tgisconstraint, t.tgdeferrable, t.tginitdeferred, t.tgtype, 
			t.tgargs, t.tgnargs, t.tgconstrrelid,
			(SELECT relname FROM pg_class c2 WHERE c2.oid=t.tgconstrrelid) AS tgconstrrelname,
			(SELECT proname FROM pg_proc p WHERE t.tgfoid=p.oid) AS tgfname, 
			c.relname, NULL AS tgdef
			FROM pg_trigger t, pg_class c
			WHERE t.tgrelid=c.oid
			AND c.relname='{$table}'";

		return $this->selectSet($sql);
	}
	
	/**
	 * Creates a trigger
	 * @param $tgname The name of the trigger to create
	 * @param $table The name of the table
	 * @param $tgproc The function to execute
	 * @param $tgtime BEFORE or AFTER
	 * @param $tgevent Event
	 * @param $tgargs The function arguments
	 * @return 0 success
	 */
	function createTrigger($tgname, $table, $tgproc, $tgtime, $tgevent, $tgargs) {
		$this->fieldClean($tgname);
		$this->fieldClean($table);
		$this->fieldClean($tgproc);
		
		/* No Statement Level Triggers in PostgreSQL (by now) */
		$sql = "CREATE TRIGGER \"{$tgname}\" {$tgtime} 
				{$tgevent} ON \"{$table}\"
				FOR EACH ROW EXECUTE PROCEDURE \"{$tgproc}\"({$tgargs})";
				
		return $this->execute($sql);
	}

	/**
	 * Drops a trigger
	 * @param $tgname The name of the trigger to drop
	 * @param $table The table from which to drop the trigger
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropTrigger($tgname, $table, $cascade) {
		$this->fieldClean($tgname);
		$this->fieldClean($table);

		$sql = "DROP TRIGGER \"{$tgname}\" ON \"{$table}\"";
		if ($cascade) $sql .= " CASCADE";

		return $this->execute($sql);
	}

	// Privilege functions

	/**
	 * Internal function used for parsing ACLs
	 * @param $acl The ACL to parse (of type aclitem[])
	 * @return Privileges array
	 */
	function _parseACL($acl) {
		// Take off the first and last characters (the braces)
		$acl = substr($acl, 1, strlen($acl) - 2);

		// Pick out individual ACE's by carefully parsing.  This is necessary in order
		// to cope with usernames and stuff that contain commas
		$aces = array();
		$i = $j = 0;		
		$in_quotes = false;
		while ($i < strlen($acl)) {
			// If current char is a double quote and it's not escaped, then
			// enter quoted bit
			$char = substr($acl, $i, 1);
			if ($char == '"' && ($i == 0 || substr($acl, $i - 1, 1) != '\\')) 
				$in_quotes = !$in_quotes;
			elseif ($char == ',' && !$in_quotes) {
				// Add text so far to the array
				$aces[] = substr($acl, $j, $i - $j);
				$j = $i + 1;
			}
			$i++;
		}
		// Add final text to the array
		$aces[] = substr($acl, $j);

		// Create the array to be returned
		$temp = array();

		// For each ACE, generate an entry in $temp
		foreach ($aces as $v) {
			
			// If the ACE begins with a double quote, strip them off both ends
			// and unescape backslashes and double quotes
			$unquote = false;
			if (strpos($v, '"') === 0) {
				$v = substr($v, 1, strlen($v) - 2);
				$v = str_replace('\\"', '"', $v);
				$v = str_replace('\\\\', '\\', $v);
			}
			
			// Figure out type of ACE (public, user or group)
			if (strpos($v, '=') === 0)
				$atype = 'public';
			elseif (strpos($v, 'group ') === 0) {
				$atype = 'group';
				// Tear off 'group' prefix
				$v = substr($v, 6);
			}
			else
				$atype = 'user';

			// Break on unquoted equals sign...
			$i = 0;		
			$in_quotes = false;
			$entity = null;
			$chars = null;	
			while ($i < strlen($v)) {
				// If current char is a double quote and it's not escaped, then
				// enter quoted bit
				$char = substr($v, $i, 1);
				$next_char = substr($v, $i + 1, 1);
				if ($char == '"' && ($i == 0 || $next_char != '"')) {
					$in_quotes = !$in_quotes;
				}
				// Skip over escaped double quotes
				elseif ($char == '"' && $next_char == '"') {
					$i++;
				}
				elseif ($char == '=' && !$in_quotes) {
					// Split on current equals sign					
					$entity = substr($v, 0, $i);
					$chars = substr($v, $i + 1);
					break;
				}
				$i++;
			}
			
			// Check for quoting on entity name, and unescape if necessary
			if (strpos($entity, '"') === 0) {
				$entity = substr($entity, 1, strlen($entity) - 2);
				$entity = str_replace('""', '"', $entity);
			}
			
			// New row to be added to $temp
			// (type, grantee, privileges, grantor, grant option?
			$row = array($atype, $entity, array(), '', array());

			// Loop over chars and add privs to $row
			for ($i = 0; $i < strlen($chars); $i++) {
				// Append to row's privs list the string representing
				// the privilege
				$char = substr($chars, $i, 1);
				if ($char == '*')
					$row[4][] = $this->privmap[substr($chars, $i - 1, 1)];
				elseif ($char == '/') {
					$grantor = substr($chars, $i + 1);
					// Check for quoting
					if (strpos($grantor, '"') === 0) {
						$grantor = substr($grantor, 1, strlen($grantor) - 2);
						$grantor = str_replace('""', '"', $grantor);
					}
					$row[3] = $grantor;
					break;
				}
				else {
					if (!isset($this->privmap[$char]))
						return -3;
					else
						$row[2][] = $this->privmap[$char];
				}
			}
			
			// Append row to temp
			$temp[] = $row;
		}

		return $temp;
	}
	
	/**
	 * Grabs an array of users and their privileges for an object,
	 * given its type.
	 * @param $object The name of the object whose privileges are to be retrieved
	 * @param $type The type of the object (eg. relation, view or sequence)
	 * @return Privileges array
	 * @return -1 invalid type
	 * @return -2 object not found
	 * @return -3 unknown privilege type
	 */
	function getPrivileges($object, $type) {
		$this->clean($object);

		switch ($type) {
			case 'table':
			case 'view':
			case 'sequence':
				$sql = "SELECT relacl AS acl FROM pg_class WHERE relname='{$object}'";
				break;
			default:
				return -1;
		}

		// Fetch the ACL for object
		$acl = $this->selectField($sql, 'acl');
		if ($acl == -1) return -2;
		elseif ($acl == '' || $acl == null) return array();
		else return $this->_parseACL($acl);
	}
	
	/**
	 * Grants a privilege to a user, group or public
	 * @param $mode 'GRANT' or 'REVOKE';
	 * @param $type The type of object
	 * @param $object The name of the object
	 * @param $public True to grant to public, false otherwise
	 * @param $usernames The array of usernames to grant privs to.
	 * @param $groupnames The array of group names to grant privs to.	 
	 * @param $privileges The array of privileges to grant (eg. ('SELECT', 'ALL PRIVILEGES', etc.) )
	 * @param $grantoption True if has grant option, false otherwise
	 * @param $cascade True for cascade revoke, false otherwise
	 * @return 0 success
	 * @return -1 invalid type
	 * @return -2 invalid entity
	 * @return -3 invalid privileges
	 * @return -4 not granting to anything
	 * @return -4 invalid mode
	 */
	function setPrivileges($mode, $type, $object, $public, $usernames, $groupnames, $privileges, $grantoption, $cascade) {
		$this->fieldArrayClean($usernames);
		$this->fieldArrayClean($groupnames);

		// Input checking
		if (!is_array($privileges) || sizeof($privileges) == 0) return -3;
		if (!is_array($usernames) || !is_array($groupnames) || 
			(!$public && sizeof($usernames) == 0 && sizeof($groupnames) == 0)) return -4;
		if ($mode != 'GRANT' && $mode != 'REVOKE') return -5;

		$sql = $mode;

		// Grant option
		if ($this->hasGrantOption() && $mode == 'REVOKE' && $grantoption) {
			$sql .= ' GRANT OPTION FOR';
		}		

		if (in_array('ALL PRIVILEGES', $privileges))
			$sql .= " ALL PRIVILEGES ON";
		else
			$sql .= " " . join(', ', $privileges) . " ON";
		switch ($type) {
			case 'table':
			case 'view':
			case 'sequence':
				$this->fieldClean($object);
				$sql .= " \"{$object}\"";
				break;
			case 'database':
				$this->fieldClean($object);
				$sql .= " DATABASE \"{$object}\"";
				break;
			case 'function':
				// Function comes in with $object as function OID
				$fn = &$this->getFunction($object);
				$this->fieldClean($fn->f[$this->fnFields['fnname']]);
				$sql .= " FUNCTION \"{$fn->f[$this->fnFields['fnname']]}\"({$fn->f[$this->fnFields['fnarguments']]})";
				break;
			case 'language':
				$this->fieldClean($object);
				$sql .= " LANGUAGE \"{$object}\"";
				break;
			case 'schema':
				$this->fieldClean($object);
				$sql .= " SCHEMA \"{$object}\"";
				break;
			default:
				return -1;
		}
		
		// Dump PUBLIC
		$first = true;
		$sql .= ($mode == 'GRANT') ? ' TO ' : ' FROM ';
		if ($public) {
			$sql .= 'PUBLIC';
			$first = false;
		}
		// Dump users
		foreach ($usernames as $v) {
			if ($first) {
				$sql .= "\"{$v}\"";
				$first = false;
			}
			else {
				$sql .= ", \"{$v}\"";
			}
		}			
		// Dump groups
		foreach ($groupnames as $v) {
			if ($first) {
				$sql .= "GROUP \"{$v}\"";
				$first = false;
			}
			else {
				$sql .= ", GROUP \"{$v}\"";
			}
		}			

		// Grant option
		if ($this->hasGrantOption() && $mode == 'GRANT' && $grantoption) {
			$sql .= ' WITH GRANT OPTION';
		}
		
		// Cascade revoke
		if ($this->hasGrantOption() && $mode == 'REVOKE' && $cascade) {
			$sql .= ' CASCADE';
		}

		return $this->execute($sql);
	}
 
	// Administration functions

	/**
	 * Vacuums a database
	 * @param $table (optional) The table to vacuum
	 */
	function vacuumDB($table = '') {
		if ($table != '') {
			$this->fieldClean($table);
			$sql = "VACUUM \"{$table}\"";
		}
		else
			$sql = "VACUUM";

		return $this->execute($sql);
	}

	/**
	 * Analyze a database
	 * @param $table (optional) The table to analyze
	 */
	function analyzeDB($table = '') {
		if ($table != '') {
			$this->fieldClean($table);
			$sql = "VACUUM ANALYZE \"{$table}\"";
		}
		else
			$sql = "VACUUM ANALYZE";

		return $this->execute($sql);
	}

	// Constraint functions

	/**
	 * A helper function for getConstraints that translates
	 * an array of attribute numbers to an array of field names.
	 * @param $table The name of the table
	 * @param $columsn An array of column ids
	 * @return An array of column names
	 */
	function &getKeys($table, $colnums) {
		$this->clean($table);
		$this->arrayClean($colnums);

		$sql = "SELECT attnum, attname FROM pg_attribute
			WHERE attnum IN ('" . join("','", $colnums) . "')
			AND attrelid = (SELECT oid FROM pg_class WHERE relname='{$table}')";

		$rs = $this->selectSet($sql);

		$temp = array();
		while (!$rs->EOF) {
			$temp[$rs->f['attnum']] = $rs->f['attname'];
			$rs->moveNext();
		}

		$atts = array();
		foreach ($colnums as $v) {
			$atts[] = '"' . $temp[$v] . '"';
		}
		
		return $atts;
	}

	/**
	 * Returns a list of all constraints on a table
	 * @param $table The table to find rules for
	 * @return A recordset
	 */
	function &getConstraints($table) {
		$this->clean($table);

		$status = $this->beginTransaction();
		if ($status != 0) return -1;

		$sql = "
			SELECT
				rcname AS conname,
				'CHECK (' || rcsrc || ')' AS consrc,
				'c' AS contype,
				NULL::int2vector AS indkey
			FROM
				pg_relcheck
			WHERE 
				rcrelid = (SELECT oid FROM pg_class WHERE relname='{$table}')
			UNION ALL
			SELECT
				pc.relname,
				NULL,
				CASE WHEN indisprimary THEN
					'p'
				ELSE
					'u'
				END,
				indkey
			FROM
				pg_class pc,
				pg_index pi
			WHERE
				pc.oid=pi.indexrelid
				AND (pi.indisunique OR pi.indisprimary)
				AND pi.indrelid = (SELECT oid FROM pg_class WHERE relname='{$table}')
			ORDER BY
				1
		";

		return $this->selectSet($sql);
	}

	// Function functions

	/**
	 * Returns a list of all functions in the database
 	 * @param $all If true, will find all available functions, if false just userland ones
	 * @return All functions
	 */
	function &getFunctions($all = false) {
		global $conf;
		
		if ($all || $conf['show_system'])
			$where = '';
		else
			$where = "AND pc.oid > '{$this->_lastSystemOID}'::oid";

		$sql = 	"SELECT
				pc.oid,
				proname,
				proretset,
				pt.typname AS return_type,
				oidvectortypes(pc.proargtypes) AS arguments
			FROM
				pg_proc pc, pg_user pu, pg_type pt
			WHERE
				pc.proowner = pu.usesysid
				AND pc.prorettype = pt.oid
				{$where}
			UNION
			SELECT 
				pc.oid,
				proname,
				proretset,
				'OPAQUE' AS result,
				oidvectortypes(pc.proargtypes) AS arguments
			FROM
				pg_proc pc, pg_user pu, pg_type pt
			WHERE	
				pc.proowner = pu.usesysid
				AND pc.prorettype = 0
				{$where}
			ORDER BY
				proname, return_type
			";

		return $this->selectSet($sql);
	}
	
	/**
	 * Returns a list of all functions that can be used in triggers
	 */
	function &getTriggerFunctions() {
		return $this->getFunctions(true);
	}

	/**
	 * Returns all details for a particular function
	 * @param $function_oid The OID of the function to retrieve
	 * @return Function info
	 */
	function getFunction($function_oid) {
		$this->clean($function_oid);
		
		$sql = "SELECT 
					pc.oid,
					proname,
					lanname as language,
					pt.typname as return_type,
					prosrc as source,
					probin as binary,
					proretset,
					proiscachable,
					oidvectortypes(pc.proargtypes) AS arguments
				FROM
					pg_proc pc, pg_language pl, pg_type pt
				WHERE 
					pc.oid = '$function_oid'::oid
					AND pc.prolang = pl.oid
					AND pc.prorettype = pt.oid
				";
	
		return $this->selectSet($sql);
	}

	/** 
	 * Returns an array containing a function's properties
	 * @param $f The array of data for the function
	 * @return An array containing the properties
	 */
	function getFunctionProperties($f) {
		$temp = array();

		// Cachable
		$f['proiscachable'] = $this->phpBool($f['proiscachable']);
		if ($f['proiscachable'])
			$temp[] = 'ISCACHABLE';
		else
			$temp[] = '';
					
		return $temp;
	}
	
	/**
	 * Updates a function.  Postgres 7.1 doesn't have CREATE OR REPLACE function,
	 * so we do it with a drop and a recreate.
	 * @param $function_oid The OID of the function
	 * @param $funcname The name of the function to create
	 * @param $args The array of argument types
	 * @param $returns The return type
	 * @param $definition The definition for the new function
	 * @param $language The language the function is written for
	 * @param $flags An array of optional flags
	 * @param $setof True if returns a set, false otherwise
	 * @return 0 success
	 * @return -1 transaction error
	 * @return -2 drop function error
	 * @return -3 create function error
	 */
	function setFunction($function_oid, $funcname, $args, $returns, $definition, $language, $flags, $setof) {
		$status = $this->beginTransaction();
		if ($status != 0) return -1;

		$status = $this->dropFunction($function_oid, false);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -2;
		}
		
		$status = $this->createFunction($funcname, $args, $returns, $definition, $language, $flags, $setof, false);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -3;
		}

		$status = $this->endTransaction();
		return ($status == 0) ? 0 : -1;
	}
	
	/**
	 * Creates a new function.
	 * @param $funcname The name of the function to create
	 * @param $args A comma separated string of types
	 * @param $returns The return type
	 * @param $definition The definition for the new function
	 * @param $language The language the function is written for
	 * @param $flags An array of optional flags
	 * @param $setof True if it returns a set, false otherwise
	 * @param $replace (optional) True if OR REPLACE, false for normal
	 * @return 0 success
	 */
	function createFunction($funcname, $args, $returns, $definition, $language, $flags, $setof, $replace = false) {
		$this->fieldClean($funcname);
		$this->clean($args);
		$this->clean($definition);
		$this->clean($language);
		$this->arrayClean($flags);

		$sql = "CREATE";
		if ($replace) $sql .= " OR REPLACE";
		$sql .= " FUNCTION \"{$funcname}\" (";
		
		if ($args != '')
			$sql .= $args;

		// For some reason, the returns field cannot have quotes...
		$sql .= ") RETURNS ";
		if ($setof) $sql .= "SETOF ";
		$sql .= "{$returns} AS '\n";
		$sql .= $definition;
		$sql .= "\n'";
		$sql .= " LANGUAGE '{$language}'";
		
		// Add flags
		$first = true;
		foreach ($flags as  $v) {
			// Skip default flags
			if ($v == '') continue;
			elseif ($first) {
				$sql .= " WITH ({$v}";
				$first = false;
			}
			else {
				$sql .= ", {$v}";
			}
		}
		// Close off WITH clause if necessary
		if (!$first) $sql .= ")";

		return $this->execute($sql);
	}
		
	/**
	 * Drops a function.
	 * @param $function_oid The OID of the function to drop
	 * @param $cascade True to cascade drop, false to restrict
	 * @return 0 success
	 */
	function dropFunction($function_oid, $cascade) {
		// Function comes in with $object as function OID
		$fn = &$this->getFunction($function_oid);
		$this->fieldClean($fn->f[$this->fnFields['fnname']]);
		
		$sql = "DROP FUNCTION \"{$fn->f[$this->fnFields['fnname']]}\"({$fn->f[$this->fnFields['fnarguments']]})";
		if ($cascade) $sql .= " CASCADE";
		
		return $this->execute($sql);
	}	

	// Rule functions

	/**
	 * Returns a list of all rules on a table
	 * @param $table The table to find rules for
	 * @return A recordset
	 */
	function &getRules($table) {
		$this->clean($table);

		$sql = "SELECT
				*
			FROM
				pg_rules
			WHERE
				tablename='{$table}'
			ORDER BY
				rulename
		";

		return $this->selectSet($sql);
	}

	// Language functions
	
	/**
	 * Gets all languages
	 * @param $all True to get all languages, regardless of show_system
	 * @return A recordset
	 */
	function &getLanguages($all = false) {
		global $conf;
		
		if ($conf['show_system'] || $all)
			$where = '';
		else
			$where = 'AND lanispl';

		$sql = "
			SELECT
				pl.lanname,
				pl.lanpltrusted,
				pp.proname AS lanplcallf
			FROM
				pg_language pl, pg_proc pp
			WHERE
				pl.lanplcallfoid = pp.oid
				{$where}
			ORDER BY
				lanname
		";
		
		return $this->selectSet($sql);
	}

	// Type conversion routines

	/**
	 * Change the value of a parameter to 't' or 'f' depending on whether it evaluates to true or false
	 * @param $parameter the parameter
	 */
	function dbBool(&$parameter) {
		if ($parameter) $parameter = 't';
		else $parameter = 'f';

		return $parameter;
	}

	/**
	 * Change a parameter from 't' or 'f' to a boolean, (others evaluate to false)
	 * @param $parameter the parameter
	 */
	function phpBool($parameter) {
		$parameter = ($parameter == 't');
		return $parameter;
	}

	// Capabilities
	function hasTables() { return true; }
	function hasViews() { return true; }
	function hasSequences() { return true; }
	function hasFunctions() { return true; }
	function hasTriggers() { return true; }
	function hasOperators() { return true; }
	function hasTypes() { return true; }
	function hasAggregates() { return true; }
	function hasIndicies() { return true; }
	function hasRules() { return true; }
	function hasLanguages() { return true; }
	function hasDropColumn() { return false; }
	function hasSRFs() { return true; }

}

?>
