<?php
/* API class for person's basic personal data.
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

class Person {

    var $tb_person='care_person';
	var $tb_citytown='care_address_citytown';
	var $pid;
	var $result;
	var $ok;
	var $sql;
	var $data_array;
	var $buffer;
	var $row;
	var $person=array();
	var $is_preloaded=false;
	var $basic_list='title,name_first,name_last,name_2,name_3,name_middle,name_maiden,name_others,date_birth,
				           sex,addr_str,addr_str_nr,addr_zip,addr_citytown_nr,photo_filename';
						   
	var  $elems_array=array(
				 'title',
				 'date_reg',
				 'name_last',
				 'name_first',
				 'date_birth',
				 'sex',
				 'name_2',
				 'name_3',
				 'name_middle',
				 'name_maiden',
				 'name_others',
				 'date_birth',
				 'addr_str',
				 'addr_nr',
				 'addr_zip',
				 'addr_citytown_nr',
				 'phone_1_code',
				 'phone_1_nr',
				 'phone_2_code',
				 'phone_2_nr',
				 'cellphone_1_nr',
				 'cellphone_2_nr',
				 'fax',
				 'email',
				 'civil_status',
				 'photo_filename',
				 'ethnic_orig',
				 'org_id',
				 'sss_nr',
				 'nat_id_nr',
				 'religion',
				 'mother_pid',
				 'father_pid',
				 'contact_person',
				 'contact_pid',
				 'contact_relation',
				 'death_date',
				 'death_encounter_nr',
				 'death_cause',
				 'death_cause_code',
				 'status',
				 'history',
				 'modify_id',
				 'modify_time',
				 'create_id',
				 'create_time');
	
	function Person ($pid='') {
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

    function prepInsertArray(){
        global $HTTP_POST_VARS;
		$x='';
		$v='';
		$this->data_array=NULL;
		
		while(list($x,$v)=each($this->elems_array)) {
	    if(isset($HTTP_POST_VARS[$v])&&!empty($HTTP_POST_VARS[$v])) $this->data_array[$v]=$HTTP_POST_VARS[$v];
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
	
    function insertDataFromArray(&$array) {
		$x='';
		$v='';
		$index='';
		$values='';
		if(!is_array($array)) return false;
		while(list($x,$v)=each($array)) {
		    $index.="$x,";
		    $values.="'$v',";
		}
		    $index=substr_replace($index,'',(strlen($index))-1);
		    $values=substr_replace($values,'',(strlen($values))-1);

        $this->sql="INSERT INTO $this->tb_person ($index) VALUES ($values)";		

		return $this->Transact();
	}
	
    function insertDataFromInternalArray() {
	    //$this->data_array=NULL;
	    $this->prepInsertArray();
		return $this->insertDataFromArray($this->data_array);
	}

    function updateDataFromArray(&$array,$item_nr='') {
	    
		$x='';
		$v='';
		$sql='';
		
		if(!is_array($array)) return false;
		if(empty($item_nr)||!is_numeric($item_nr)) return false;
		while(list($x,$v)=each($array)) {
		    $sql.="$x='$v',";
		}
		$sql=substr_replace($sql,'',(strlen($sql))-1);
		
        $this->sql="UPDATE $this->tb_person SET $sql WHERE item_nr=$item_nr";
		
		return $this->Transact();
	}

	function getAllInfoObject($pid='') {
	    global $db;
		 
		if(!$this->internResolvePID($pid)) return false;
		
	    $this->sql="SELECT p.* , addr.name AS addr_citytown_name 
					FROM $this->tb_person AS p LEFT JOIN  $this->tb_citytown AS addr ON p.addr_citytown_nr=addr.nr
					WHERE p.pid='$this->pid' ";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
			
	function getAllInfoArray($pid='') {
	    global $db;
		 $x='';
		 $v='';
		if(!$this->internResolvePID($pid)) return false;
		
	    $this->sql="SELECT p.* , addr.name AS citytown 
					FROM $this->tb_person AS p , $this->tb_citytown AS addr ON p.addr_citytown_nr=addr.nr
					WHERE p.pid='$this->pid'";
        
        if($this->result=$db->Execute($this->sql)) {
	
            if($this->result->RecordCount()) {
			    $this->buffer=NULL;
	            $this->row=$this->result->FetchRow();	 
                while(list($x,$v)=each($this->row))	$this->buffer[$x]=$v;
			    return $this->buffer;
			} else { return false; }
		} else { return false; }
	}
	
	function preloadPersonInfo($pid) {
	    global $db;
	    
		if(!$this->internResolvePID($pid)) return false;
		$this->sql="SELECT * FROM $this->tb_person WHERE pid=$this->pid";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 $this->person=$this->result->FetchRow();	
				 $this->is_preloaded=true; 
				 return true;
			} else { return false; }
		} else { return false; }
	}

	function getValue($item,$pid='') {
	    global $db;
	    if($this->is_preloaded) {
		    if(isset($this->person[$item])) return $this->person[$item];
		        else  return false;
		} else {
		    if(!$this->internResolvePID()) return false;
		    $this->sql="SELECT $item FROM $this->tb_person WHERE pid=$this->pid";
            if($this->result=$db->Execute($this->sql)) {
                if($this->result->RecordCount()) {
				     $this->person=$this->result->FetchRow();	 
				     return $this->person[$item];
			    } else { return false; }
		    } else { return false; }
		}
	}
	
	function getValueByList($list,$pid='') {
	    global $db;
	
		if(empty($list)) return false;
		if(!$this->internResolvePID()) return false;
		$this->sql="SELECT $list FROM $this->tb_person WHERE pid=$this->pid";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				$this->person=$this->result->FetchRow();	 
				return $this->person;
			} else { return false; }
		} else { return false; }
	}	
	function FirstName() {
        return $this->getValue('name_first');
	}
	function LastName() {
        return  $this->getValue('name_last');
	}
	function SecondName() {
        return  $this->getValue('name_2');
	}
	function ThirdName() {
        return  $this->getValue('name_3');
	}
	function MiddleName() {
        return  $this->getValue('name_middle');
	}
	function MaidenName() {
        return  $this->getValue('name_maiden');
	}
	function OtherName() {
        return  $this->getValue('name_others');
	}
	function BirthDate() {
        return  $this->getValue('date_birth');
	}
	function StreetNr() {
        return  $this->getValue('addr_str_nr');
	}
	function StreetName() {
        return  $this->getValue('addr_str');
	}
	function ZIPCode() {
        return  $this->getValue('addr_zip');
	}
	function isValidAddress() {
        return  $this->getValue('addr_is_valid');
	}
	function CityTownCode() {
        return  $this->getValue('');
	}
	function Citizenship() {
        return  $this->getValue('citizenship');
	}
	function FirstPhoneAreaCode() {
        return  $this->getValue('phone_1_code');
	}
	function FirstPhoneNumber() {
        return  $this->getValue('phone_1_nr');
	}
	function SecondPhoneAreaCode() {
        return  $this->getValue('phone_2_code');
	}
	function SecondPhoneNumber() {
        return  $this->getValue('phone_2_nr');
	}
	function FirstCellphoneNumber() {
        return  $this->getValue('cellphone_1_nr');
	}
	function SecondCellphoneNumber() {
        return  $this->getValue('cellphone_2_nr');
	}
	function FaxNumber() {
        return  $this->getValue('fax');
	}
	function EmailAddress() {
        return  $this->getValue('email');
	}
	function Sex() {
        return  $this->getValue('sex');
	}
	function Title() {
        return  $this->getValue('title');
	}
	function PhotoFilename() {
        return  $this->getValue('photo_filename');
	}
	function EthnicOrigin() {
        return  $this->getValue('ethnic_origin');
	}
	function OrgID() {
        return  $this->getValue('org_id');
	}
	function SSSNumber() {
        return  $this->getValue('sss_nr');
	}
	function NationalIDNumber() {
        return  $this->getValue('nat_id_nr');
	}
	function Religion() {
        return  $this->getValue('religion');
	}
	function MotherPID() {
        return  $this->getValue('mother_pid');
	}
	function FatherPID() {
        return  $this->getValue('father_pid');
	}
	function DeathDate() {
        return  $this->getValue('death_date');
	}
	function DeathEncounterNumber() {
        return  $this->getValue('death_encounter_nr');
	}
	function DeathCause() {
        return  $this->getValue('death_cause');
	}
	function RecordStatus() {
        return  $this->getValue('status');
	}
	function RecordHistory() {
        return  $this->getValue('history');
	}
	
	function CityTownName($code_nr=''){
	    global $db;
		if(!$this->is_preloaded) $this->sql="SELECT name FROM $this->tb_citytown WHERE nr=$code_nr";
            else $this->sql="SELECT name FROM $this->tb_citytown WHERE nr=$this->CityTownCode()";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 $this->row=$this->result->FetchRow();	 
				 return $this->row['name'];
			} else { return false; }
		} else { return false; }
    }
	
	function BasicDataArray($pid){
        if(!$this->internResolvePID($pid)) return false;
		return $this->getValueByList($this->basic_list,$this->pid);
	}
	
	function setHistorySeen($encoder='',$pid=''){
	    global $db;
		if(empty($encoder)) return false;
		if(!$this->internResolvePID($pid)) return false;
		$this->sql="UPDATE $this->tb_person SET history= CONCAT(history,\"\nView ".date('Y-m-d H:i:s')." = $encoder\") WHERE pid=$this->pid";
		
		if($db->Execute($this->sql)) {return true;}
		   else  {echo $this->sql;return false;}
	}		
}
?>
