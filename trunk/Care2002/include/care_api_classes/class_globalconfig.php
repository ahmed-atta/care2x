<?php
/* API class for global configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

class GlobalConfig {

	var $tb='care_config_global'; // the table's name
	var $result;
	var $row;
	var $config;
	var $condition;
	var $ok;
	
	function GlobalConfig(&$handler) {
	    $this->config=&$handler;
	}
	
	function getConfig($type='') {
	    global $db;
		
	    if(empty($type)||!$type) {
		    $this->condition='1';
		} else {
		    $this->condition="type LIKE '$type'";
		}
		if($this->result=$db->Execute("SELECT type,value FROM $this->tb WHERE $this->condition")) {
            if ($this->result->RecordCount()) {
                while($this->row=$this->result->FetchRow()) {
                    $this->config[$this->row['type']]=$this->row['value'];
				}
				return true;
			} else {
			    return false;
			}
		} else {
		    return false;
		}
	}
	
	function saveConfigItem($type='',$value='') {
	    global $db;
		
		if(empty($type)) return false;
		
		$db->BeginTrans();
	    $this->ok=$db->Execute("REPLACE INTO $this->tb (type,value) VALUES ('$type','$value')");
	    if($this->ok&&$db->Affected_Rows()) {
	       $db->CommitTrans();
	       return true;
	    } else { 
           $db->RollbackTrans();	  
		   return false;
	    }
	}
}
?>
