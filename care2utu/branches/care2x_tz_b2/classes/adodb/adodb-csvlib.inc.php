<?php
global $ADODB_INCLUDED_CSV;
$ADODB_INCLUDED_CSV = 1;

/* 
  V4.21 20 Mar 2004  (c) 2000-2004 John Lim (jlim@natsoft.com.my). All rights reserved.
  Released under both BSD license and Lesser GPL library license. 
  Whenever there is any discrepancy between the two licenses, 
  the BSD license will take precedence. See License.txt. 
  Set tabs to 4 for best viewing.
  
  Latest version is available at http://php.weblogs.com/
  
  Library for CSV serialization. This is used by the csv/proxy driver and is the 
  CacheExecute() serialization format. 
  
  ==== NOTE ====
  Format documented at http://php.weblogs.com/ADODB_CSV
  ==============
*/

	/**
 	 * convert a recordset into special format
	 *
	 * @param rs	the recordset
	 *
	 * @return	the CSV formated data
	 */
	function _rs2serialize(&$rs,$conn=false,$sql='')
	{
		$max = ($rs) ? $rs->FieldCount() : 0;
		
		if ($sql) $sql = urlencode($sql);
		// metadata setup
		
		if ($max <= 0 || $rs->dataProvider == 'empty') { // is insert/update/delete
			if (is_object($conn)) {
				$sql .= ','.$conn->Affected_Rows();
				$sql .= ','.$conn->Insert_ID();
			} else
				$sql .= ',,';
			
			$text = "====-1,0,$sql\n";
			return $text;
		}
		$tt = ($rs->timeCreated) ? $rs->timeCreated : time();
		
		## changed format from ====0 to ====1
		$line = "====1,$tt,$sql\n";
		
		if ($rs->databaseType == 'array') {
			$rows =& $rs->_array;
		} else {
			$rows = array();
			while (!$rs->EOF) {	
				$rows[] = $rs->fields;
				$rs->MoveNext();
			} 
		}
		
		for($i=0; $i < $max; $i++) {
			$o =& $rs->FetchField($i);
			$flds[] = $o;
		}
		
		$rs =& new ADORecordSet_array();
		$rs->InitArrayFields($rows,$flds);
		return $line.serialize($rs);
	}

	
/**
* Open CSV file and convert it into Data. 
*
* @param url  		file/ftp/http url
* @param err		returns the error message
* @param timeout	dispose if recordset has been alive for $timeout secs
*
* @return		recordset, or false if error occured. If no
*			error occurred in sql INSERT/UPDATE/DELETE, 
*			empty recordset is returned
*/
	function &csv2rs($url,&$err,$timeout=0)
	{
		$err = false;
		$fp = @fopen($url,'r');
		if (!$fp) {
			$err = $url.' file/URL not found';
			return false;
		}
		flock($fp, LOCK_SH);
		$arr = array();
		$ttl = 0;
		
		if ($meta = fgetcsv($fp, 32000, ",")) {
			// check if error message
			if (strncmp($meta[0],'****',4) === 0) {
				$err = trim(substr($meta[0],4,1024));
				fclose($fp);
				return false;
			}
			// check for meta data
			// $meta[0] is -1 means return an empty recordset
			// $meta[1] contains a time 
	
			if (strncmp($meta[0], '====',4) === 0) {
			
				if ($meta[0] == "====-1") {
					if (sizeof($meta) < 5) {
						$err = "Corrupt first line for format -1";
						fclose($fp);
						return false;
					}
					fclose($fp);
					
					if ($timeout > 0) {
						$err = " Illegal Timeout $timeout ";
						return false;
					}
					$rs->fields = array();
					$rs->timeCreated = $meta[1];
					$rs =& new ADORecordSet($val=true);
					$rs->EOF = true;
					$rs->_numOfFields=0;
					$rs->sql = urldecode($meta[2]);
					$rs->affectedrows = (integer)$meta[3];
					$rs->insertid = $meta[4];	
					return $rs;
				} 
			# Under high volume loads, we want only 1 thread/process to _write_file
			# so that we don't have 50 processes queueing to write the same data.
			# Would require probabilistic blocking write 
			#
			# -2 sec before timeout, give processes 1/16 chance of writing to file with blocking io
			# -1 sec after timeout give processes 1/4 chance of writing with blocking
			# +0 sec after timeout, give processes 100% chance writing with blocking
				if (sizeof($meta) > 1) {
					if($timeout >0){ 
						$tdiff = $meta[1]+$timeout - time();
						if ($tdiff <= 2) {
							switch($tdiff) {
							case 2: 
								if ((rand() & 15) == 0) {
									fclose($fp);
									$err = "Timeout 2";
									return false;
								}
								break;
							case 1:
								if ((rand() & 3) == 0) {
									fclose($fp);
									$err = "Timeout 1";
									return false;
								}
								break;
							default: 
								fclose($fp);
								$err = "Timeout 0";
								return false;
							} // switch
							
						} // if check flush cache
					}// (timeout>0)
					$ttl = $meta[1];
				}
				//================================================
				// new cache format - use serialize extensively...
				if ($meta[0] === '====1') {
					// slurp in the data
					$MAXSIZE = 128000;
					
					$text = fread($fp,$MAXSIZE);
					if (strlen($text) === $MAXSIZE) {
						while ($txt = fread($fp,$MAXSIZE)) {
							$text .= $txt;
						}
					}
					fclose($fp);
					@$rs = unserialize($text);
					if (is_object($rs)) $rs->timeCreated = $ttl;
					return $rs;
				}
				
				$meta = false;
				$meta = fgetcsv($fp, 32000, ",");
				if (!$meta) {
					fclose($fp);
					$err = "Unexpected EOF 1";
					return false;
				}
			}

			// Get Column definitions
			$flds = array();
			foreach($meta as $o) {
				$o2 = explode(':',$o);
				if (sizeof($o2)!=3) {
					$arr[] = $meta;
					$flds = false;
					break;
				}
				$fld =& new ADOFieldObject();
				$fld->name = urldecode($o2[0]);
				$fld->type = $o2[1];
				$fld->max_length = $o2[2];
				$flds[] = $fld;
			}
		} else {
			fclose($fp);
			$err = "Recordset had unexpected EOF 2";
			return false;
		}
		
		// slurp in the data
		$MAXSIZE = 128000;
		
		$text = '';
		while ($txt = fread($fp,$MAXSIZE)) {
			$text .= $txt;
		}
			
		fclose($fp);
		@$arr = unserialize($text);
		//var_dump($arr);
		if (!is_array($arr)) {
			$err = "Recordset had unexpected EOF (in serialized recordset)";
			if (get_magic_quotes_runtime()) $err .= ". Magic Quotes Runtime should be disabled!";
			return false;
		}
		$rs =& new ADORecordSet_array();
		$rs->timeCreated = $ttl;
		$rs->InitArrayFields($arr,$flds);
		return $rs;
	}
?>