<?php
/* API class for core functions. Will be extended by other classes 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Ward extends Core {
//class Ward  {

    var $tb_ward='care_ward';
	var $tb_dept='care_department';
	var $ward_nr;
	var $dept_nr;
	//var $ok; // is within core
	//var $sql;  // is within core
	//var $result; // is within core

	function Ward($ward_nr) {
	    $this->ward_nr=$ward_nr;
	}	
	
	function setDeptNr($dept_nr) {
	    $this->dept_nr=$dept_nr;
	}

	
	function getAllWardsItemsObject(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->tb_ward WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	
	
	function getAllWardsDataObject() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->tb_ward WHERE 1)";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	
	function getAllWardsItemsArray(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->tb_ward WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->buffer_array[]=$this->result->FetchRow());
				 return $this->buffer_array; 
			} else { return false; }
		} else { return false; }	
	}
		
	function getAllWardsDataArray() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->tb_ward WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->buffer_array=$this->result->FetchRow());
				 return $this->buffer_array; 
			} else { return false; }
		} else { return false; }
    }/**/

	function WardName($nr){
	    global $db;
		if(empty($nr)) return false;
        if($this->result=$db->Execute("SELECT name FROM $this->tb_ward WHERE nr=$nr")) {
            if($this->result->RecordCount()) {
				 $this->row=$this->result->FetchRow();
				 return $this->row['name'];	 
			} else { return false; }
		} else { return false; }
	}
	
}
