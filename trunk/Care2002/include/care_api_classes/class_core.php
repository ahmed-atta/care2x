<?php
/* API class for core functions. Will be extended by other classes 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

class Core {

    var $coretable; # For the default db table
	var $sql; # For SQL query. Can be extracted with the "getLastQuery()" method
	var $ref_array=array(); # For internal update/insert operations
	var $data_array=array(); # For internal update/insert operations
	var $buffer_array=array(); # For internal update/insert operations
	var $result; # For sql query results
	var $where; # For update sql queries condition
	var $rec_count; # For counting resulting rows. Can be extracted w/ the "LastRecordCount()" method
	var $buffer;
	var $res=array(); # Array used for containing results returned as pointer
	# Private flags
	var $do_intern;
	var $ok;
	var $is_preloaded=FALSE;
	# internal error message variable, usually used in debugging
	var $error_msg='';
	
	var $dead_stat="'deleted','hidden','inactive','void'";
	
	function setTable($table) {
	    $this->coretable=$table;
	}
	function setRefArray(&$array) {
	    if(!is_array($array)) return FALSE;
	    $this->ref_array=$array;
	}
	function setDataArray(&$array){
	    $this->data_array=$array;
	}
	function _RecordExists($cond=''){
		global $db;
		if(empty($cond)) return FALSE;
		if($this->result=$db->Execute("SELECT * FROM $this->coretable WHERE $cond")){
			if($this->result->RecordCount()){
				return TRUE;
			}else{return FALSE;}
		}else{return FALSE;}
	}
	function setSQL(&$sql){
		$this->sql=$sql;
	}
	/**
	* Transaction routine
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
	* _prepSaveArray() filters the data array intended for saving, removing the key-value pairs that do not correspond to the table's field names
	* private 
	* return size of the resulting data array
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
	* insertDataFromInternalArray() inserts data from an internal array 
	* previously filled with data by the setDataArray() method. 
	* This method also uses the field names from an internal array previously set by "use????" methods that point 
	* the object to the proper table and fields names.
	* public
	* return TRUE/FALSE
	*/		
    function insertDataFromInternalArray() {
	    //$this->data_array=NULL;
	    $this->_prepSaveArray();
		return $this->insertDataFromArray($this->buffer_array);
	}

	function getAllItemsObject(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return FALSE; }
		} else { return FALSE; }	
	}
	
	function getAllDataObject() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return FALSE; }
		} else { return FALSE; }
	}	
	
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
	* insertDataFromArray() inserts data from an array  passed by reference into a table 
	* This method  uses the table and field names from  internal variables previously set by "use????" methods that point 
	* the object to the proper table and fields names.
	* private or public (preferably private being called by other methods)
	* @param $array (array, passed by reference), the array containing the data. Note: the array keys must correspond to the table field names
	*/	
    function insertDataFromArray(&$array) {
		$x='';
		$v='';
		$index='';
		$values='';
		if(!is_array($array)) return FALSE;
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
	* updateDataFromArray() updates a table using data from an array  passed by reference.
	* This method also uses the field names from an internal array previously set by "use????" methods that point 
	* the object to the proper table and fields names.
	* private or public (preferably private being called by other methods)
	* @param $array (array, passed by reference), the array containing the data. Note: the array keys must correspond to the table field names
	* @param $item_nr (int), the nr used in the update queries' "where" condition 
	*/
    function updateDataFromArray(&$array,$item_nr='') {
		$x='';
		$v='';
		$elems='';
		if(empty($array)) return FALSE;
		if(empty($item_nr)||!is_numeric($item_nr)) return FALSE;
		while(list($x,$v)=each($array)) {
		if(stristr($v,'concat')||stristr($v,'null')) $elems.="$x= $v,";
		    else $elems.="$x='$v',";
		}
		reset($array);
		//echo strlen($elems)." leng<br>";
		$elems=substr_replace($elems,'',(strlen($elems))-1);
		if(empty($this->where)) $this->where="nr=$item_nr";
        $this->sql="UPDATE $this->coretable SET $elems WHERE $this->where";
		# reset the condition variable to prevent affecting subsequent update calls
		$this->where=''; 
		//echo $this->sql.'<br>';
		return $this->Transact();
	}
	/**
	* updateDataFromInternalArray() updates a table using data from an internal array 
	* previously filled with data by the setDataArray() method. 
	* This method also uses the field names from an internal array previously set by "use????" methods that point 
	* the object to the proper table and fields names.
	* public
	* @param $item_nr (int), the nr used in the update queries' "where" condition 
	*/
    function updateDataFromInternalArray($item_nr='') {
		if(empty($item_nr)||!is_numeric($item_nr)) return FALSE;
	    $this->_prepSaveArray();
		return $this->updateDataFromArray($this->buffer_array,$item_nr);
	}
	/**
	* getLastQuery() returns the value of sql, the last sql query  
	*/
	function getLastQuery(){
		return $this->sql;
	}
	/**
	* getResult() returns the value of result 
	*/
	function getResult(){
		return $this->result;
	}
	/**
	* getErrorMsg() returns the value of error_msg, the internal error message
	*/
	function getErrorMsg(){
		return $this->error_msg;
	}
	/**
	* setWhereCondition() sets the "where"  condition in an update query, 
	* used with the updateDataFromInternalArray() method. 
	* The where condition defaults to "nr='$nr'",
	*/
	function setWhereCondition($cond){
		$this->where=$cond;
	}
	/**
	* isPreLoaded() returns the value of is_preloaded that is set by methods that preload large number of data
	*/
	function isPreLoaded(){
		return $this->is_preloaded;
	}
	/**
	* LastRecordCount() returns the value of rec_count 
	*/
	function LastRecordCount(){
		return $this->rec_count;
	}
	/**
	* saveDBCache() saves temporary data to cache in database
	* @param $id (char) = data id
	* @param $data (mixed) (pass by referece) = data to be saved
	* @param $bin (bool)  = FALSE=nonbinary data, TRUE=binary
	* return TRUE/FALSE
	*/
	function saveDBCache($id,&$data,$bin=FALSE){
		if($bin) $elem='cbinary';
			else $elem='ctext';
		$this->sql="INSERT INTO care_cache (id,$elem) VALUES ('$id','$data')";
		return $this->Transact();
	}
	/**
	* getDBCache() gets temporary data from the database cache 
	* @param $id (char) = data id
	* @param $data (mixed) (pass by referece) = variable for the data to be fetched
	* @param $bin (bool)  = FALSE=nonbinary data, TRUE=binary
	* return data
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
	* deleteDBCache() deletes data from the database cache 
	* @param $id (char) = id of data for deletion
	* return TRUE/FALSE
	*/
	function deleteDBCache($id){
		if(empty($id)) return FALSE;
		$this->sql="DELETE  FROM care_cache WHERE id LIKE '$id'";
		return $this->Transact();
	}
	/**
	* coreFieldNames() returns the array of the core field names
	* public
	* return array
	*/
	function coreFieldNames(){
		return $this->ref_array;
	}
	/**
	* FilesListArray() returns a list of filename within a path in array
	* public
	* @param $path (str) the path of the filenames relative to the root path
	* @param $filter (str) , discriminator string
	* @param $sort (str), ASC or DESC, default to ASC (ascending)
	* return array, else FALSE
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
