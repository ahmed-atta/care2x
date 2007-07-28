<?php
/* 
V4.21 20 Mar 2004  (c) 2000-2004 John Lim (jlim@natsoft.com.my). All rights reserved.
  Released under both BSD license and Lesser GPL library license. 
  Whenever there is any discrepancy between the two licenses, 
  the BSD license will take precedence. See License.txt. 
  Set tabs to 4 for best viewing.
  
  Latest version is available at http://php.weblogs.com/
*/


// Code contributed by "stefan bogdan" <sbogdan#rsb.ro>
//odbtp adodb extension

class ADODB_odbtp extends ADOConnection{
	var $databaseType = "odbtp";
	var $fmtDate = "'Y-m-d'";
	var $fmtTimeStamp = "'Y-m-d, h:i:sA'";
	var $replaceQuote = "''"; // string to use to replace quotes
	var $dataProvider = "odbtp";
	var $odbc_driver ='';
	var $hasAffectedRows = true;
	var $_genSeqSQL = "create table %s (id integer)";
	var $_autocommit = true;
	
	function ADODB_odbtp()
	{
	}
	
	function ErrorMsg()
	{
		if (empty($this->_connectionID)) return @odbtp_last_error();
		return @odbtp_last_error($this->_connectionID);
	}
	
	function ErrorNo()
	{
		if (empty($this->_connectionID)) return @odbtp_last_error_code();
			return @odbtp_last_error_code($this->_connectionID);
	}
	function _affectedrows()
	{
		if ($this->lastQuery) {
		   return odbtp_affected_rows ($this->lastQuery);
	   } else
		return 0;
	}
	function CreateSequence($seqname='adodbseq',$start=1)
	{
		if (empty($this->_genSeqSQL)) return false;
		$ok = $this->Execute(sprintf($this->_genSeqSQL,$seqname));
		if (!$ok) return false;
		$start -= 1;
		return $this->Execute("insert into $seqname values($start)");
	}

	var $_dropSeqSQL = 'drop table %s';
	function DropSequence($seqname)
	{
		if (empty($this->_dropSeqSQL)) return false;
		return $this->Execute(sprintf($this->_dropSeqSQL,$seqname));
	}
	
	function GenID($seq='adodbseq',$start=1)
	{
		// if you have to modify the parameter below, your database is overloaded,
		// or you need to implement generation of id's yourself!
		$MAXLOOPS = 100;
		//$this->debug=1;
		while (--$MAXLOOPS>=0) {
			$num = $this->GetOne("select id from $seq");
			if ($num === false) {
				$this->Execute(sprintf($this->_genSeqSQL ,$seq));
				//if(!$this->Execute("CREATE TABLE $seq ".
                //            '(id INT NOT NULL UNIQUE)')) echo 'naspa la creare tabela';

				$start -= 1;
				$num = '0';
				$ok = $this->Execute("insert into $seq values($start)");
				if (!$ok) return false;
			}
			$this->Execute("update $seq set id=id+1 where id=$num");

			if ($this->affected_rows() > 0) {
				$num += 1;
				$this->genID = $num;
				return $num;
			}
		}
		if ($fn = $this->raiseErrorFn) {
			$fn($this->databaseType,'GENID',-32000,"Unable to generate unique id after $MAXLOOPS attempts",$seq,$num);
		}
		return false;
	}

	//example for $argDSN
	//for visual fox : DRIVER={Microsoft Visual FoxPro Driver};SOURCETYPE=DBF;SOURCEDB=c:\YourDbfFileDir;EXCLUSIVE=NO;
	//for access : DRIVER={Microsoft Access Driver (*.mdb)};DBQ=c:\path_to_access_db\base_test.mdb;UID=root;PWD=;
	//for mssql : DRIVER={SQL Server};SERVER=myserver;UID=myuid;PWD=mypwd;DATABASE=OdbtpTest;
	//if uid & pwd can be separate
    function _connect($argHost, $argUsername='', $argPassword='', $argDSN='',$persist=false)
	{
		if ($argUsername) $argDSN .= ";uid=$argUsername";
		if ($argPassword) $argDSN .= ";pwd=$argPassword";
		
		if ($persist) $this->_connectionID = @odbtp_rconnect($argHost,$argDSN);
		else $this->_connectionID = @odbtp_connect($argHost,$argDSN);
		
		if ($this->_connectionID === false)
		{
			$this->_errorMsg = $this->ErrorMsg() ;
			return false;
		}
		$this->odbc_driver = @odbtp_get_attr(ODB_ATTR_DRIVER, $this->_connectionID);
        //$this->oic_level = @odbtp_get_attr(ODB_ATTR_OICLEVEL, $this->_connectionID);
        $tc = @odbtp_get_attr('ODB_ATTR_TXNCAPABLE', $this->_connectionID);
		if($tc == 0){
			$this->hasTransactions = false;
		}
		else {
			$this->hasTransactions = true;
		}
        
		return true;
	}
	function BeginTrans()
	{
		if (!$this->hasTransactions) return false;
		if ($this->transOff) return true;
		$this->transCnt += 1;
		$this->_autocommit = false;
		$rs = @odbtp_set_attr(ODB_ATTR_TRANSACTIONS,ODB_TXN_READUNCOMMITTED,$this->_connectionID);
		if(!$rs) return false;
		else return true;
	}
	function CommitTrans($ok=true)
	{
		if ($this->transOff) return true;
		if (!$ok) return $this->RollbackTrans();
		if ($this->transCnt) $this->transCnt -= 1;
		$this->_autocommit = true;
		@odbtp_set_attr(ODB_ATTR_TRANSACTIONS,ODB_TXN_READCOMMITTED,$this->_connectionID);//set transaction off
		$ret = odbtp_commit($this->_connectionID);
		return $ret;
	}
	function RollbackTrans()
	{
		if ($this->transOff) return true;
		if ($this->transCnt) $this->transCnt -= 1;
		$this->_autocommit = true;
		$ret = odbtp_rollback($this->_connectionID);
        @odbtp_set_attr(ODB_ATTR_TRANSACTIONS,ODB_TXN_READCOMMITTED,$this->_connectionID);//set transaction off
		return $ret;
	}
	function Prepare($sql)
	{
	//	return $sql;
		$stmt = odbtp_prepare($sql);
		if (!$stmt) return false;
		return array($sql,$stmt);
	}
	
	function _pconnect($argHost, $argUsername='', $argPassword='', $argDSN='')
	{
  		return $this->_connect($argHost,$argUsername,$argPassword,$argDSN,true);
	}
	
	function _close()
	{
		$ret = @odbtp_close($this->_connectionID);
		$this->_connectionID = false;
		return $ret;
	}
	function _query($sql,$inputarr=false)
	{
	GLOBAL $php_errormsg;
		$php_errormsg = '';
		$this->_error = '';

		if ($inputarr) {
			if (is_array($sql)) {
				$stmtid = $sql[1];
			} else {
				$stmtid = odtp_prepare($sql,$this->_connectionID);

				if ($stmtid == false) {
					$this->_errorMsg = $php_errormsg;
					return false;
				}
			}
			if (! odbtp_execute($stmtid,$inputarr)) {
				return false;
			}

		} else if (is_array($sql)) {
			$stmtid = $sql[1];
			if (!odbtp_execute($stmtid)) {
				return false;
			}
		} else
		{
			$stmtid = odbtp_query($sql,$this->_connectionID);
		}
		$this->_lastAffectedRows = 0;
		if ($stmtid) {
				$this->_lastAffectedRows = odbtp_affected_rows($stmtid);
		}
		$this->_errorMsg = $php_errormsg;
		return $stmtid;
		//return true;
	}
}
class ADORecordSet_odbtp extends ADORecordSet {
	var $databaseType = 'odbtp';
	var $canSeek = true;
	function ADORecordSet_odbtp($queryID,$mode=false)
	{
		if ($mode === false) {
			global $ADODB_FETCH_MODE;
			$mode = $ADODB_FETCH_MODE;
		}
		$this->fetchMode = $mode;
		$this->ADORecordSet($queryID);
		//$this->_currentRow = 0;
	}
	function _seek($row)
	{
		return @odbtp_data_seek($this->_queryID, $row);
	}
	function &FetchField($fieldOffset = 0)
	{
		$off=$fieldOffset; // offsets begin at 0
		$o= new ADOFieldObject();
		$o->name = odbtp_field_name($this->_queryID,$off);
		$o->type = odbtp_field_type($this->_queryID,$off);
        strstr( PHP_OS, "WIN") ? $o->max_length = odbtp_field_length($this->_queryID,$off): $o->max_length = 'unknown';
		if (ADODB_ASSOC_CASE == 0) $o->name = strtolower($o->name);
		else if (ADODB_ASSOC_CASE == 1) $o->name = strtoupper($o->name);
		return $o;
	}
	function fields($colname)
	{
		if ($this->fetchMode & ADODB_FETCH_ASSOC) return $this->fields[$colname];
		if (!$this->bind) {
			$this->bind = array();
			for ($i=0; $i < $this->_numOfFields; $i++) {
				$o = $this->FetchField($i);
				$this->bind[strtoupper($o->name)] = $i;
			}
		}
		 return $this->fields[$this->bind[strtoupper($colname)]];
	}
	function _initrs()
	{
		$this->_numOfRows = -1; //odbtp_num_rows - odbtp_num_rows -- get number of fetched rows from query ;
		$this->_numOfFields = odbtp_num_fields($this->_queryID);
	}
	function _fetch()
	{
		$f = odbtp_fetch_row($this->_queryID);
		if ($f === false) {
			$this->fields = false;
			return false;
		}
		
		$this->fields = $f;
		if ($this->fetchMode & ADODB_FETCH_ASSOC) {
			$this->fields = $this->GetRowAssoc(ADODB_ASSOC_CASE);
		}
	//	print_r($f);
		//return $stmtid;
		return true;
  /*
		global $ADODB_FETCH_MODE;
		if ($this->fetchMode & ADODB_FETCH_ASSOC) {
			echo 'am luat-o pe assoc';
			$f = odbtp_fetch_assoc($this->_queryID);
			//$this->fields = $this->GetRowAssoc(ADODB_ASSOC_CASE);
			if ($f === false) {
				$this->fields = false;
				return false;
			}
		}
		else
		{
			$f = @odbtp_fetch_row($this->_queryID);
			if ($f === false) {
				$this->fields = false;
				return false;
			}
			$this->fields = $f;
		}*/
		print_r($f);
		
		return true;
	}
	function MoveFirst()
	{
	  $this->fields = @odbtp_fetch_row($this->_queryID, "ODB_FETCH_FIRST");
	  if ($this->fields) $this->EOF = false;
	  $this->_currentRow = 0;

	  if ($this->fetchMode == ADODB_FETCH_NUM) {
		 foreach($this->fields as $v) {
			$arr[] = $v;
		 }
		 $this->fields = $arr;
	  }

	  return true;
    }
    function MoveLast()
   {
	  $this->fields = @odbtp_fetch_row($this->_queryID, "ODB_FETCH_LAST");
	  if ($this->fields) $this->EOF = false;
	  $this->_currentRow = -1;

	  if ($this->fetchMode == ADODB_FETCH_NUM) {
		 foreach($this->fields as $v) {
			$arr[] = $v;
		 }
		 $this->fields = $arr;
	  }

	  return true;
    }
	function NextRecordSet($result)
	{
		return @odbtp_next_result($result);
	}

	function _close()
	{
		return @odbtp_free_query($this->_queryID);
	}
}

?>
