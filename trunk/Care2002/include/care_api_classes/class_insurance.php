<?php
/* API class for insurance data
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
class Insurance {

	var $tb_class='care_class_insurance'; // table name
	var $tb_firm='care_insurance_firm';
	var $result;
	var $row;
	var $firm_id;
	var $buffer;
	var $sql;
	var $ok;
	
	function Insurance($firm_id='') {
	    $this->firm_id=$firm_id;
	}

	function setFirmID($firm_id='') {
	    $this->firm_id=$firm_id;
	}
	
	function internResolveFirmID($firm_id='') {
	    if (empty($firm_id)) {
		    if(empty($this->firm_id)) {
			    return false;
			} else { return true; }
		} else {
		     $this->firm_id=$firm_id;
			return true;
		}
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
		} else { return false; }
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
		
	    if(!$this->internResolveFirmID($firm_id)) return false;
	    if($this->result=$db->Execute("SELECT firm_id FROM $this->tb_firm WHERE firm_id=$this->firm_id")) {
	        if($this->result->RecordCount()) {
			    return true;
		    } else { return false; }
	   } else { return false; }
   }

    function getUseFrequency($firm_id='') {
	
        global $db;
	   
	    if(!$this->internResolveFirmID($firm_id)) return false;
	    if($this->result=$db->Execute("SELECT use_frequency FROM $this->tb_firm WHERE firm_id=$this->firm_id")) {
	        if($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    return $this->row['use_frequency'];
		    } else { return false; }
	   } else { return false; }
    }

	function updateUseFrequency($firm_id='',$step=1) {
	
	    global $db;
		
	    if(!$this->internResolveFirmID($firm_id)) return false;
		$this->buffer=getUseFrequency($this->firm_id);
	    if($this->result=$db->Execute("UPDATE $this->tb_firm SET use_frequency=".($this->buffer+$step)." WHERE firm_id=$this->firm_id")) {
	        if($this->result->Affected_Rows()) {
			    return true;
		    } else { return false; }
	   } else { return false; }
   }

   function getFirmName($firm_id) {
       global $db;
	   if(!$this->internResolveFirmID($firm_id)) return false;
	   
	   $this->sql="SELECT name FROM $this->tb_firm WHERE firm_id='$this->firm_id'";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
		        $this->row=$this->result->FetchRow();
			    return $this->row['name'];
		    } else { return false; }
	   } else { return false; }
   }
	  
}

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
