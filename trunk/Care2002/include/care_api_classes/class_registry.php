<?php
/* API class for module registry data
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

class Registry {

	var $tb='care_registry'; // table name
	var $result;
	var $row;
	var $id;
	
	function setID($id='') {
	
	    global $db;
		
	    if(empty($id)) {
		    return false;
		} else {
	        $this->id=$id;
		    return true;
		}
	}	
	
	function get($type='') {
    
	    global $db;
		
		if(empty($type)) {
		    return false; 
	    } else {
	
	        if ($this->result=$db->Execute("SELECT $type FROM $this->tb WHERE registry_id='$this->id'")) {
		        if ($this->result->RecordCount()) {
		            $this->row=$this->result->FetchRow();
			        return $this->row[$type];
			    } else {
			        return false;
			    }
		    } else {
		        return false;
		    }
	   }	
   }
}
?>
