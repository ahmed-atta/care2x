<?php
/* API class for user configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

class UserConfig {

	var $tb='care_config_user'; // table name
	var $result;
	var $row;
	var $buffer;
	var $bool=false;
	var $is_preloaded=false;
	var $sql;
	var $ok;
	
	function Transact($sql=''){
	    global $db;
		if(!empty($sql)) $this->sql=$sql;
        $db->BeginTrans();
        $this->ok=$db->Execute($this->sql);
        if($this->ok){
            $db->CommitTrans();
			return true;
        }else{
	        $db->RollbackTrans();
			return false;
	    }
    }	
	function _getDefault(){
	    global $db;
		
	    if ($this->result=$db->Execute("SELECT serial_config_data FROM $this->tb WHERE user_id='default'")) {
		    if ($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    $this->buffer=unserialize($this->row['serial_config_data']);
			   	$this->is_preloaded=true;
			   	return true;
			}else{
				return false;
			}
		}else{
		    return false;
		}
	}
	function getConfig($user_id='default'){
	    global $db;
	
		if(empty($user_id)) return $this->_getDefault();
		
	    if ($this->result=$db->Execute("SELECT serial_config_data FROM $this->tb WHERE user_id='$user_id'")) {
		    if ($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    $this->buffer=unserialize($this->row['serial_config_data']);
				//echo $user_id.'<br>';
				//while(list($x,$v)=each($this->buffer)) echo $x.'>'.$v.'<br>';
			   	//return $this->buffer;
			   	$this->is_preloaded=true;
			   	return true;
			}else{
				return $this->_getDefault();
			}
		}else{
		    return false;
		}
	}
	function exists($user_id='') {
	    global $db;
	
		if(empty($user_id)) return false;
		
	    if ($this->result=$db->Execute("SELECT user_id FROM $this->tb WHERE user_id='$user_id'")) {
		    if ($this->result->RecordCount()) {
				return true;			
			}else{
				return false;
			}
		}else{
		    return false;
		}
	}
	
	function saveConfig($user_id='default',&$data) {
	    global $db;
	    
		if(empty($data)) return false;
		
	    $this->buffer=serialize($data);
	    $this->sql="REPLACE INTO $this->tb (user_id,serial_config_data) VALUES ('$user_id','$this->buffer')";
	    return $this->Transact();
/*	    if($this->result=$db->Execute("REPLACE INTO $this->tb (user_id,serial_config_data) VALUES ('$user_id','$this->buffer')")) {
		    return true;
		}else{
		    return false;
		}
*/
	}
	function replaceItem($user_id='default',$type='',$value='') {
	    global $db;
	    
		if(empty($type)||empty($value)) return false;
		
		$this->buffer=$this->getConfig($user_id);
		
		if($this->buffer!=false)  {
		    $this->buffer[$type]=$value;
			if($this->saveConfig($user_id,$this->buffer)) return true;
			   else return false;
		}else{
		    return false;
		}	         
	}
	function isPreLoaded(){
		return $this->is_preloaded;
	}
	function getConfigData(){
		return $this->buffer;
	}
}
?>
