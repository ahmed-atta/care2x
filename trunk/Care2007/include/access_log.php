<?php
/**
 * @callgraph
 * @class      AccessLogs
 * @short      Simple Read/Write log manager
 * @version    0.0.1
 * @since      Mon Aug  4 15:14:45 CEST 2008
 * @code
 $sqlite = new AccessLog( );
 if ( $sqlite->INSERTING = time() )
 var_dump( $sqlite->INSERTING );
 else
 echo "Nothing done!";
 * @endcode
 */

class AccessLog {

	private $SQL;
	private $DB = "logs.sqlite";
	private $TB = "access";
	private $ID = "ID";
	private $DT = "DATETIME";
	private $IP = "IP";
	private $LG = "LOGNOTE";
	private $UI = "USERID";
	private $UN = "USERNAME";
	private $PA = "PASSWORD";
	private $TF = "THISFILE";
	private $FF = "FILEFORWARD";
	private $LS = "LOGIN_SUCCESS";


	function __construct( $filepath = '../logs/') {

		try {
			$this->DB = chop( $filepath . "/" . $this->DB );
			$this->sql_init();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	private function sql_init() {
		$this->SQL = new SQLiteDatabase( $this->DB, 0660 );
		if ( ! file_exists( $this->DB ) )
		die( "Permission Denied!" );

		$q = $this->SQL->query("PRAGMA table_info(" . $this->TB . ")");
		if ( $q->numRows() == 0 ) {
			
			$sqlcreate= "CREATE TABLE " . $this->TB . " ( "
			. $this->ID . " INTEGER PRIMARY KEY, "
			. $this->DT . " DATETIME DEFAULT '', "
			. $this->IP . " CHAR(255) DEFAULT '', "
			. $this->LG . " TEXT DEFAULT '', "
			. $this->UI . " CHAR(255) DEFAULT '', "
			. $this->UN . " CHAR(255) DEFAULT '', "
			. $this->PA . " CHAR(255) DEFAULT '', "
			. $this->TF . " TEXT DEFAULT '', "
			. $this->FF . " TEXT DEFAULT '', "
			. $this->LS . " INTEGER(1) DEFAULT '' );" ;

			$this->SQL->query($sqlcreate);
			$this->SQL->query("CREATE  INDEX 'id' ON " . $this->TB . " ( ". $this->ID . " ASC);");
		}
	}

	public function __get( $p ) {
		$q = $this->SQL->arrayQuery( "SELECT * FROM " . $this->TB . " ORDER BY " . $this->ID , SQLITE_ASSOC );
		return $q;
	}

	/*
	 * writes a log line
	 */
	public function writeline( $datetime = '', $ip = '', $lognote = '',
							$userid = '', $username = '', $password = '',
							$thisfile = '', $fileforward = '', $loginsuccess = '0' ) {
		return $this->SQL->query( "INSERT INTO " . $this->TB . " ( "
				. $this->DT . ", "
				. $this->IP . ", "
				. $this->LG . ", "
				. $this->UI . ", "
				. $this->UN . ", "
				. $this->PA . ", "
				. $this->TF . ", "
				. $this->FF . ", "
				. $this->LS . " )
				VALUES (
				'$datetime',
				'$ip',
				'$lognote',
				'$userid',
				'$username',
				'$password',
				'$thisfile',
				'$fileforward',
				'$loginsuccess' );" 
		);

	}
}
?>