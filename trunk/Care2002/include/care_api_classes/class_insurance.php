<?php
/* API class for insurance data.
* Extends the class "core".
* Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Insurance extends Core {

	var $tb_class='care_class_insurance'; // table name
	var $tb_insurance='care_insurance_firm';
	var $result;
	var $row;
	var $firm_id;
	var $buffer;
	var $sql;
	var $ok;
	/* Field names of the care_insurance_firm table */
	var $fld_insurance=array(
			'firm_id',
			'name',
			'iso_country_id',
			'sub_area',
			'type_nr',
			'addr',
			'addr_mail',
			'addr_billing',
			'addr_email',
			'phone_main',
			'phone_aux',
			'fax_main',
			'fax_aux',
			'contact_person',
			'contact_phone',
			'contact_fax',
			'contact_email',
			'use_frequency',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
			
	function Insurance($firm_id='') {
	    $this->firm_id=$firm_id;
		$this->coretable=$this->tb_insurance;
		$this->ref_array=$this->fld_insurance;
	}
	function setFirmID($firm_id='') {
	    $this->firm_id=$firm_id;
	}
	
	function _internResolveFirmID($firm_id='') {
	    if (empty($firm_id)) {
		    if(empty($this->firm_id)) {
			    return false;
			} else { return true; }
		} else {
		     $this->firm_id=$firm_id;
			return true;
		}
	}
	/**
	* sets the core table name and fields to insurance in run time
	*/
	function _useInsurance(){
		$this->coretable=$this->tb_insurance;
		$this->ref_array=$this->fld_insurance;
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
		
    function getInsuranceClassInfoObject($items='class_nr,class,name,LD_var,description,status,history') {
    
	    global $db;
	
        if ($this->result=$db->Execute("SELECT $items  FROM $this->tb_class")) {
            if ($this->result->RecordCount()) {
                return $this->result;
            } else {return false;}
		} else {return false; }
    }
	
    function getInsuranceClassInfoArray($items='class_nr,class,name,LD_var,description,status,history') {
    
	    global $db;
	
        if ($this->result=$db->Execute("SELECT $items  FROM $this->tb_class")) {
            if ($this->result->RecordCount()) {
			    $this->row=NULL;
                while($this->row[]=$this->result->FetchRow());
				return $this->row;
            } else {return false;}
		} else { return false; }
    }
	function Firm_exists($firm_id='') {
	    global $db;
	    if(!$this->_internResolveFirmID($firm_id)) return false;
	    if($this->result=$db->Execute("SELECT firm_id FROM $this->tb_insurance WHERE firm_id=$this->firm_id")) {
	        if($this->result->RecordCount()) {
			    return true;
		    } else { return false; }
	   } else { return false; }
   }
   /**
   * Alias of Firm_exists()
   * param firm_id = the insurance firm's id
   * return true = if firm exists, else false 
   */
	function FirmIDExists($firm_id) {
	    return $this->Firm_exists($firm_id);
   }

    function getUseFrequency($firm_id='') {
	
        global $db;
	   
	    if(!$this->_internResolveFirmID($firm_id)) return false;
	    if($this->result=$db->Execute("SELECT use_frequency FROM $this->tb_insurance WHERE firm_id=$this->firm_id")) {
	        if($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    return $this->row['use_frequency'];
		    } else { return false; }
	   } else { return false; }
    }

	function updateUseFrequency($firm_id='',$step=1) {
	
	    global $db;
		
	    if(!$this->_internResolveFirmID($firm_id)) return false;
		$this->buffer=getUseFrequency($this->firm_id);
	    if($this->result=$db->Execute("UPDATE $this->tb_insurance SET use_frequency=".($this->buffer+$step)." WHERE firm_id=$this->firm_id")) {
	        if($this->result->Affected_Rows()) {
			    return true;
		    } else { return false; }
	   } else { return false; }
   }

   function getFirmName($firm_id) {
       global $db;
	   if(!$this->_internResolveFirmID($firm_id)) return false;
	   
	   $this->sql="SELECT name FROM $this->tb_insurance WHERE firm_id='$this->firm_id'";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    return $this->row['name'];
		    } else { return false; }
	   } else { return false; }
   }
   function getFirmInfo($firm_id) {
       global $db;
	   if(!$this->_internResolveFirmID($firm_id)) return false;
	   $this->sql="SELECT * FROM $this->tb_insurance WHERE firm_id='$this->firm_id'";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
		        return $this->result;
		    } else { return false; }
	   } else { return false; }
	}
	/**
	* Insert new insurance firm info in the database
	*/
	function saveFirmInfoFromArray(&$data){
		global $HTTP_SESSION_VARS;
		$this->_useInsurance();
		$this->data_array=$data;
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_time']='NULL';
		return $this->insertDataFromInternalArray();
	}
	/**
	* updateFirmInfoFromArray()
	* updates the insurance firm's data
	* param nr = the ward's record nr.
	* param data =  2 dimensional array of the data passed as reference
	* return = true on success, else false on failure
	*/
	function updateFirmInfoFromArray($nr,&$data){
		global $HTTP_SESSION_VARS;
		$this->_useInsurance();
		$this->data_array=$data;
		// remove probable existing array data to avoid replacing the stored data
		if(isset($this->data_array['firm_id'])) unset($this->data_array['firm_id']);
		if(isset($this->data_array['create_id'])) unset($this->data_array['create_id']);
		// clear the where condition
		$this->where="firm_id=$nr";
		$this->data_array['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		return $this->updateDataFromInternalArray($nr);
	}

	/**
	* Gets all active insurance firms' info 
	* param sortby = "name" will return the result sorted by firm's name in ascending order
	* param sortby = "use_frequency" will return the result sorted by firm's use frequency in descending order
	* returns adodb record object
	*/
	function getAllActiveFirmsInfo($sortby='name'){
		global $db;
		if($sortby=='use_frequency') $sortby.=' DESC';
		$this->sql="SELECT * FROM $this->tb_insurance WHERE status NOT IN ('inactive','deleted','hidden','closed','void') ORDER BY $sortby";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
		        return $this->result;
		    } else { return false; }
	   } else { return false; }
   	}
   	function searchActiveFirm($key){
		global $db;
		if(empty($key)) return false;
		if(is_numeric($key)) $sortby=" ORDER BY firm_id";
			else $sortby=" ORDER BY name";
		$select="SELECT firm_id,name,phone_main,fax_main,addr_email  FROM $this->tb_insurance ";
		$append=" AND status NOT IN ('inactive','deleted','closed','hidden','void') $sortby";
		$this->sql="$select WHERE ( firm_id LIKE '$key%' OR name LIKE '$key%' OR addr_email LIKE '$key%' ) $append";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return $this->result;
		    }else{	
				$this->sql="$select WHERE ( firm_id LIKE '%$key' OR name LIKE '%$key' OR addr_email LIKE '%$key' ) $append";
				if($this->result=$db->Execute($this->sql)){
					if($this->result->RecordCount()){
						return $this->result;
					}else{
						$this->sql="$select WHERE ( firm_id LIKE '%$key%' OR name LIKE '%$key%' OR addr_email LIKE '%$key%' ) $append";
						if($this->result=$db->Execute($this->sql)){
							if($this->result->RecordCount()){
								return $this->result;
							}else{return false;}
						}else{return false;}
					}
				}else{return false;}
			}
	   } else { return false; }
   	}
			
}

// ********** class PersonInsurance 

class PersonInsurance extends Insurance {

    var $tb_person_insurance='care_person_insurance';
	var $pid;
	
	function PersonInsurance ($pid='') {
	    $this->pid=$pid;
	}
	
	function setPID($pid) {
	    $this->pid=$pid;
	}

	function internResolvePID($pid) {
	    if (empty($pid)) {
		    if(empty($this->pid)) {
			    return false;
			} else { return true; }
		} else {
		     $this->pid=$pid;
			return true;
		}
	}

    function updateDataFromArray(&$array,$item_nr='') {
		$x='';
		$v='';
		$sql='';
		if(!is_array($array)||empty($item_nr)||!is_numeric($item_nr)) return false;
		while(list($x,$v)=each($array)) {
		    $sql.="$x='$v',";
		}
		$sql=substr_replace($sql,'',(strlen($sql))-1);
        $this->sql="UPDATE $this->tb_person_insurance SET $sql WHERE item_nr=$item_nr";				
		return $this->Transact();
	}
	
    function insertDataFromArray(&$array) {
		$x='';
		$v='';
		$index='';
		$values='';
		if(!is_array($array)) return false;
		while(list($x,$v)=each($array)) {
		    $index.="$x,";
		    $values.="$v,";
		}
		    $index=substr_replace($index,'',(strlen($index))-1);
		    $values=substr_replace($values,'',(strlen($values))-1);

        $this->sql="INSERT INTO $this->tb_person_insurance ($index) VALUES ($values)";		
		return $this->Transact();
	}
	
	function getPersonInsuranceObject($pid='') {
	    global $db;

		if(!$this->internResolvePID($pid)) return false;
		
        $this->sql="SELECT 
		                           item_nr AS insurance_item_nr,
								   type AS insurance_type,
			                       insurance_nr,
								   firm_id AS insurance_firm_id, 
								   class_nr AS insurance_class_nr 
								   FROM $this->tb_person_insurance 
						  WHERE 
						          pid='$this->pid' AND (is_void=0 OR is_void='') 
						  ORDER BY 
						          modify_time DESC";
			    
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
                return $this->result;
            } else { return false;}
        } else { return false; }
    }
	
    function getInsuranceClassInfo($class_nr) {
        global $db;
		
        if($this->result=$db->Execute("SELECT name FROM $this->tb_class WHERE class_nr=$class_nr")) {
            if($this->result->RecordCount()) {
				 $this->row= $this->result->FetchRow();
				 return $this->row;	 
			} else { return false; }
		} else { return false; }
	}

}
?>
