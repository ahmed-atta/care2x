<?php
/* API class for core functions. Will be extended by other classes 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

class Core {

    var $coretable;
	var $ok;
	var $sql;
	var $ref_array=array();
	var $data_array=array();
	var $buffer_array=array();
	var $result;
	var $where;
	
	function setTable($table) {
	    $this->coretable=$table;
	}

	function setRefArray(&$array) {
	    if(!is_array($array)) return false;
	    $this->ref_array=$array;
	}
	function setDataArray(&$array){
	    $this->data_array=$array;
	}
	
	function Transact() {
	
	    global $db;
		
        $db->BeginTrans();
        $this->ok=$db->Execute($this->sql);
        if($this->ok) {
            $db->CommitTrans();
			return true;
        } else {
	        $db->RollbackTrans();
			return false;
	    }
    }	
	
    function _prepSaveArray(){
		$x='';
		$v='';
		//$this->buffer_array=NULL;
		while(list($x,$v)=each($this->ref_array)) {
	       // if(isset($this->data_array[$v])&&!empty($this->data_array[$v])) $this->buffer_array[$v]=$this->data_array[$v];
	        if(isset($this->data_array[$v])) { $this->buffer_array[$v]=$this->data_array[$v]; }
	    }
		reset($this->ref_array);
		return 1;
    }	
		
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
			} else { return false; }
		} else { return false; }	
	}
	
	function getAllDataObject() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}	
	
	function getAllItemsArray(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->ref_array=$this->result->FetchRow());
				 return $this->ref_array; 
			} else { return false; }
		} else { return false; }	
	}
	
	function getAllDataArray() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->coretable WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->ref_array=$this->result->FetchRow());
				 return $this->ref_array; 
			} else { return false; }
		} else { return false; }
	}
	
    function insertDataFromArray(&$array) {
		$x='';
		$v='';
		$index='';
		$values='';
		if(!is_array($array)) return false;
		while(list($x,$v)=each($array)) {
		    $index.="$x,";
			if(stristr($v,'null')) $values.='NULL,';
				else $values.="'$v',";
		}
		$index=substr_replace($index,'',(strlen($index))-1);
		$values=substr_replace($values,'',(strlen($values))-1);
        $this->sql="INSERT INTO $this->coretable ($index) VALUES ($values)";		
		//echo $this->sql;exit;
		reset($array);
		return $this->Transact();
	}

    function updateDataFromArray(&$array,$item_nr='') {
		$x='';
		$v='';
		$elems='';
		if(empty($array)) return false;
		if(empty($item_nr)||!is_numeric($item_nr)) return false;
		while(list($x,$v)=each($array)) {
		if(stristr($v,'concat')||stristr($v,'null')) $elems.="$x= $v,";
		    else $elems.="$x='$v',";
		}
		$elems=substr_replace($elems,'',(strlen($elems))-1);
		if(empty($this->where)) $this->where="nr=$item_nr";
        $this->sql="UPDATE $this->coretable SET $elems WHERE $this->where";
		//echo $this->sql;
		return $this->Transact();
	}

    function updateDataFromInternalArray($item_nr='') {
	    //$this->data_array=NULL;
		//echo $item_nr;
		if(empty($item_nr)||!is_numeric($item_nr)) return false;
	    $this->_prepSaveArray();
		return $this->updateDataFromArray($this->buffer_array,$item_nr);
	}
	
}
