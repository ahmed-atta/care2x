<?php
/**
* Care2x API package
* @package care_api
*/

/**
*  Core methods. Will be extended by other classes.
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 1.0.08
* @copyright 2002,2003 Elpidio Latorilla
* @package care_api
*/
class Core {
	/**
	* @var string Table name used for core routines. Default table name.
	*/
    var $coretable; 
	/**
	* @var string Holder for SQL query. Can be extracted with the "getLastQuery()" method.
	*/
	var $sql=''; 
	/**
	* @var array  Contains fieldnames of the table named in the $coretable. For internal update/insert operations.
	*/
	var $ref_array=array();
	/**
	* @var array   For internal update/insert operations
	*/
	var $data_array=array();
	/**
	* @var array   For internal update/insert operations
	*/
	var $buffer_array=array();
	/**
	* @var ADODB record object  For sql query results.
	*/
	var $result; 
	/**
	* @var string  For update sql queries condition
	*/
	var $where; 
	/**
	* @var int  For counting resulting rows. Can be extracted w/ the "LastRecordCount()" method.
	*/
	var $rec_count;
	/**
	* @var mixed  
	*/
	var $buffer;
	/**
	* @var array  Used for containing results returned as pointer.
	*/
	var $res=array();
	/**#@+
	* @var boolean
	* @access private  
	*/
	var $do_intern;
	var $ok;
	/**#@-*/
	var $is_preloaded=FALSE;
	/**
	*  Internal error message  usually used in debugging.
	* @var string
	* @access private  
	*/
	var $error_msg='';
	/**
	* Status items used in sql queries "IN (???)"
	* @var string
	* @access private  
	*/
	var $dead_stat="'deleted','hidden','inactive','void'";
	/**
	* Status items used in sql queries "IN (???)"
	* @var string
	* @access private  
	*/
	var $normal_stat="'','normal'";
	/**
	* Sets the coretable variable to the name of the database table.
	*
	* This points the core object to that database table and all core routines will use this table
	* until the core table is reset or replaced with another table name
	* @param string Table name
	* @return void
	*/
	function setTable($table) {
	    $this->coretable=$table;
	}
	/**
	* Points the reference variable $ref_array to the field names' array.
	*
	* This field names array corresponds to  the database table set by the setTable() method
	* @param array By reference, the associative array containing the field names.
	* @return boolean
	*/
	function setRefArray(&$array) {
	    if(!is_array($array)){ 
			return FALSE;
		}else{
	   		$this->ref_array=$array;
			return TRUE;
		}
	}
	/**
	* Points the core data array to the external array that holds the data to be stored.
	* @param array  By reference, the associative array holding the data.
	*/
	function setDataArray(&$array){
	    $this->data_array=$array;
	}
	/**
	* Checks if a certain database record exists based onthe supplied query condition.
	*
	* Should be used privately.
	* @param string The query "where" condition without the WHERE word.
	* @return boolean
	*/
	function _RecordExists($cond=''){
		global $db;
		if(empty($cond)) return FALSE;
		if($this->result=$db->Execute("SELECT create_time FROM $this->coretable WHERE $cond")){
			if($this->result->RecordCount()){
				return TRUE;
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Sets the internal sql query variable to the sql query.
	* @param string Query statement.
	*/
	function setSQL(&$sql){
		$this->sql=$sql;
	}
	/**
	* Transaction routine, ADODB transaction. It internally uses the ADODB transaction routine.
	*
	* <code>
	* $sql="INSERT INTO care_users (item) VALUES ('value')";
	* $core->Transact($sql);
	* </code>
	* If the query parameter is empty, the method will use the sql query stored internally.
	* This internal sql query statement must be set with the setSQL() method or direct setting of variable before Transact() is called.
	*
	* <code>
	* $sql="INSERT INTO care_users (item) VALUES ('value')";
	* $core->setSQL($sql);
	* $core->Transact();
	* </code>
	*
	* or internally in class extensions 
	*
	* <code>
	* $this->sql="INSERT INTO care_users (item) VALUES ('value')";
	* $this->Transact();
	* </code>
	*
	* @param string sql  SQL query statement. 
	* @return TRUE/FALSE
	* @global ADODB db link 
	* @access public
	*/
	function Transact($sql='') {
	    global $db;
		if(!empty($sql)) $this->sql=$sql;
        $db->BeginTrans();
        $this->ok=$db->Execute($this->sql);
        if($this->ok) {
            $db->CommitTrans();
			return TRUE;
        } else {
	        $db->RollbackTrans();
			return FALSE;
	    }
    }	
	/**
	* Filters the data array intended for saving, removing the key-value pairs that do not correspond to the table's field names.
	* @access private 
	* @return int Size of the resulting data array. 
	*/		
    function _prepSaveArray(){
		$x='';
		$v='';
		//$this->buffer_array=NULL;
		while(list($x,$v)=each($this->ref_array)) {
	       // if(isset($this->data_array[$v])&&!empty($this->data_array[$v])) $this->buffer_array[$v]=$this->data_array[$v];
	        if(isset($this->data_array[$v])) { 
				$this->buffer_array[$v]=$this->data_array[$v]; 
			}
	    }
		# Reset the source array index to start
		reset($this->ref_array);
		return sizeof($this->buffer_array);
    }	
	/**
	* Inserts data from the internal array previously filled with data by the <var>setDataArray()</var> method. 
	*
	* This method also uses the field names from the internal array $ref_array previously set by "use????" methods that point 
	* the core object to the proper table and fields names.
	* @access public
	* @return boolean
	*/		
    function insertDataFromInternalArray() {
	    //$this->data_array=NULL;
	    $this->_prepSaveArray();
		return $this->insertDataFromArray($this->buffer_array);
	}
	/**
	* Returns all records with the needed items from the table. 
	*
	* The table name must be set in the coretable first by <var>setTable()</var> method.
	* @param string  items By reference. Items to be returned from each record fetched from the table. The items should be separted with commas.
	* @return mixed ADODB record object or boolean
	*
	* Example:
	*
	* <code>
	* $items="pid, name_last, name_first, birth_date, sex";
	* $core->setTable('care_person');
	* $persons = $core->getAllItemsObject($items);
	* while($row=$persons->FetchRow()){
	* ...
	* }
	* </code>
	*
	*/
	function getAllItemsObject(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->res['gaio']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gaio']->RecordCount()) {
				 return $this->res['gaio'];	 
			} else { return FALSE; }
		} else { return FALSE; }	
	}
	/**
	* Returns all records with all items from the table. 
	*
	* The table name must be set in the coretable first by setTable() method.
	* @return mixed ADODB record object or boolean
	*
	* Example:
	*
	* <code>
	* $core->setTable('care_person');
	* $persons = $core->getAllDataObject();
	* while($row=$persons->FetchRow()){
	* ...
	* }
	* </code>
	*/
	function getAllDataObject() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->res['gado']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gado']->RecordCount()) {
				 return $this->res['gado'];	 
			} else { return FALSE; }
		} else { return FALSE; }	
	}	
	/**
	* Similar to getAllItemsObject() method but returns the records in an associative array.
	*
	* Returns all records with the needed items from the table. The table name must be set in the coretable first by <var>setTable()</var> method.
	*
	* Example:
	* <code>
	* $items="pid, name_last, name_first, birth_date, sex";
	* $core->setTable('care_person');
	* $persons = $core->getAllItemsArray($items);
	* while(list($x,$v)=each($persons)){
	* ...
	* }
	* </code>
	*
	* @param  string items By reference. Items to be returned from each record fetched from the table. The items should be separted with commas.
	* @return array associative 
	* @access private
	*/
	function getAllItemsArray(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->ref_array=$this->result->FetchRow());
				 return $this->ref_array; 
			} else { return FALSE; }
		} else { return FALSE; }	
	}
	/**
	* Returns all records with the all items from the table. 
	*
	* The table name must be set in the coretable first by setTable() method.
	* @return mixed ADODB record object or boolean
	* @global ADODB db link
	*
	* Example:
	* <code>
	* $core->setTable('care_person');
	* $persons = $core->getAllDataArray();
	* while(list($x,$v)=each($persons)){
	* ...
	* }
	* </code>
	*/
	function getAllDataArray() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->ref_array=$this->result->FetchRow());
				 return $this->ref_array; 
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/**
	* Inserts data from an array  (passed by reference) into a table.
	*
	* This method  uses the table and field names from  internal variables previously set by "use????" methods that point 
	* the object to the proper table and fields names. Private or public (preferably private being called by other methods).
	* @access private
	* @param array By reference. The array containing the data. Note: the array keys must correspond to the table field names.
	* @return boolean
	*/	
    function insertDataFromArray(&$array) {
		$x='';
		$v='';
		$index='';
		$values='';
		if(!is_array($array)){ return FALSE;}
		while(list($x,$v)=each($array)) {
		    $index.="$x,";
			if(stristr($v,'null')) $values.='NULL,';
				else $values.="'$v',";
		}
		reset($array);
		$index=substr_replace($index,'',(strlen($index))-1);
		$values=substr_replace($values,'',(strlen($values))-1);
        $this->sql="INSERT INTO $this->coretable ($index) VALUES ($values)";		
		//echo $this->sql;//exit;
		reset($array);
		return $this->Transact();
	}
	/**
	* Updates a record with the data from an array  (passed by reference) based on the primary key.
	*
	* This method also uses the field names from an internal array previously set by "use????" methods that point 
	* the object to the proper table and fields names.
	* private or public (preferably private being called by other methods)
	* @param array Data. By reference. Note: the array keys must correspond to the table field names
	* @param int Key used in the update queries' "where" condition 
	* @param boolean Flags if the param $item_nr should be strictly numeric or not. Defaults to TRUE = strictly numeric. 
	* @return boolean
	*/
    function updateDataFromArray(&$array,$item_nr='',$isnum=TRUE) {
		$x='';
		$v='';
		$elems='';
		if(empty($array)) return FALSE;
		if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
		while(list($x,$v)=each($array)) {
		if(stristr($v,'concat')||stristr($v,'null')) $elems.="$x= $v,";
		    else $elems.="$x='$v',";
		}
		# Bug fix. Reset array.
		reset($array);
		//echo strlen($elems)." leng<br>";
		$elems=substr_replace($elems,'',(strlen($elems))-1);
		if(empty($this->where)) $this->where="nr=$item_nr";
        $this->sql="UPDATE $this->coretable SET $elems WHERE $this->where";
		# Bug fix. Reset the condition variable to prevent affecting subsequent update calls. 
		$this->where=''; 
		//echo $this->sql.'<br>';
		return $this->Transact();
	}
	/**
	* Updates a table using data from an internal array previously filled with data by the <var>setDataArray()</var> method. 
	*
	* Update the record based on the primary key.
	* This method also uses the field names from an internal array previously set by "use????" methods that point 
	* the object to the proper table and fields names.
	* @access public
	* @param int Key used in the update queries' "where" condition 
	* @param boolean Flags if the param $item_nr should be strictly numeric or not. Defaults to TRUE = strictly numeric. 
	* @return boolean
	*/
    function updateDataFromInternalArray($item_nr='',$isnum=TRUE) {
		if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
	    $this->_prepSaveArray();
		return $this->updateDataFromArray($this->buffer_array,$item_nr,$isnum);
	}
	/**
	* Returns the the last sql query string  
	* @return string
	*/
	function getLastQuery(){
		return $this->sql;
	}
	/**
	* Feturns the value of result 
	* @return mixed
	*/
	function getResult(){
		return $this->result;
	}
	/**
	* Feturns the value of error_msg, the internal error message.
	* @return string
	*/
	function getErrorMsg(){
		return $this->error_msg;
	}
	/**
	* Sets the "where"  condition in an update query used with the updateDataFromInternalArray() method.
	* 
	* The where condition defaults to "nr='$nr'".
	* @access private
	* @param string cond The constraint for the sql query.
	* @return void
	*/
	function setWhereCondition($cond){
		$this->where=$cond;
	}
	/**
	* Returns the value of is_preloaded that is set by methods that preload large number of data.
	* @return boolean
	*/
	function isPreLoaded(){
		return $this->is_preloaded;
	}
	/**
	* Returns the value of rec_count
	* @return int 
	*/
	function LastRecordCount(){
		return $this->rec_count;
	}
	/**
	* Saves temporary data to a cache in database.
	* @access public
	* @param string Cached data identification
	* @param mixed By referece.  Data to be saved.
	* @param boolean Signals the type of the data contained in the param $data.  FALSE=nonbinary data, TRUE=binary
	* @return boolean
	*/
	function saveDBCache($id,&$data,$bin=FALSE){
		if($bin) $elem='cbinary';
			else $elem='ctext';
		$this->sql="INSERT INTO care_cache (id,$elem) VALUES ('$id','$data')";
		return $this->Transact();
	}
	/**
	* Gets temporary data from the database cache.
	* @access public
	* @param string Cached data identification
	* @param mixed By reference.  Variable for the data to be fetched.
	* @param boolean   Signals the type of data contained in the $data.  FALSE=nonbinary data, TRUE=binary.
	* @return mixed string, binary or boolean
	*/
	function getDBCache($id,&$data,$bin=FALSE){
		global $db;
		$buf;
		$row;
		if($bin) $elem='cbinary';
			else $elem='ctext';
		$this->sql="SELECT $elem FROM care_cache WHERE id='$id'";
        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				 $row=$buf->FetchRow();
				 $data=$row[$elem];
				 return TRUE; 
			} else { return FALSE; }
		} else { return FALSE; }
	}
	/**
	* Deletes data from the database cache based on the id key.
	* @access public
	* @param char ID of data for deletion.
	* @return boolean
	*/
	function deleteDBCache($id){
		if(empty($id)) return FALSE;
		$this->sql="DELETE  FROM care_cache WHERE id LIKE '$id'";
		return $this->Transact();
	}
	/**
	* Returns the  core field names of the core table in an array.
	* @access public
	* @return array
	*/
	function coreFieldNames(){
		return $this->ref_array;
	}
	/**
	* Returns a list of filename within a path in array.
	* @access public
	* @param string Path of the filenames relative to the root path.
	* @param string Discriminator string.
	* @param  string The sort direction (ASC or DESC) defaults to ASC (ascending)
	* @return mixed  array or boolean
	*/
	function FilesListArray($path='',$filter='',$sort='ASC'){
		$localpath=$path.'/.';
		//echo "<br>$localpath<br>";
		$this->res['fla']=array();
		if(file_exists($localpath)){
			$handle=opendir($path); 
			$count=0;
 			while (FALSE!==($file = readdir($handle))) { 
     			if ($file != "." && $file != ".."){ 
					if(!empty($filter)){
						if(stristr($file,$filter)){
							$this->res['fla'][$count]=$file;
							$count++;
						}
					}else{
						$this->res['fla'][$count]=$file; 
						$count++;
					}
     			} 
			}
 			closedir($handle); 
			if($count){
				$this->rec_count=$count;
				if($sort=='ASC'){
					@sort($this->res['fla']);
				}elseif($sort=='DESC'){
					@rsort($this->res['fla']);
				}
					return $this->res['fla'];
			}
		}else{
			return FALSE;
		}
	}
}
