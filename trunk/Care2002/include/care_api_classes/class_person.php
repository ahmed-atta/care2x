<?php
/* API class for person's basic personal data extends core class
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Person extends Core {

    var $tb_person='care_person';
	var $tb_citytown='care_address_citytown';
	var $tb_enc='care_encounter';
	var $tb_employ='care_personell';
	var $pid;
	var $result;
	var $ok;
	var $sql;
	var $data_array;
	var $buffer;
	var $row;
	var $person=array();
	var $is_preloaded=false;
	var $is_nr=false;
	
	var $basic_list='pid,title,name_first,name_last,name_2,name_3,name_middle,name_maiden,name_others,date_birth,
				           sex,addr_str,addr_str_nr,addr_zip,addr_citytown_nr,photo_filename';
						   
	var  $elems_array=array(
				'pid',
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
				 'blood_group',
				 'addr_str',
				 'addr_str_nr',
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
		$this->ref_array=$this->elems_array;
		$this->coretable=$this->tb_person;
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
	function InitPIDExists($init_nr){
		global $db;
		$this->sql="SELECT pid FROM $this->tb_person WHERE pid=$init_nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			} else { return false; }
		} else { return false; }
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
		//echo $this->sql;
		return $this->Transact();
	}
	
    function insertDataFromInternalArray() {
	    //$this->data_array=NULL;
	    $this->prepInsertArray();
		return $this->insertDataFromArray($this->data_array);
	}

/*    function updateDataFromArray(&$array,$item_nr='') {
	    
		$x='';
		$v='';
		$sql='';
		
		if(!is_array($array)) return false;
		if(empty($item_nr)||!is_numeric($item_nr)) return false;
		while(list($x,$v)=each($array)) {
			if(stristr($v,'concat')||stristr($v,'null')) $sql.="$x= $v,";
		    	else $sql.="$x='$v',";
		}
		$sql=substr_replace($sql,'',(strlen($sql))-1);
		
        $this->sql="UPDATE $this->tb_person SET $sql WHERE pid=$item_nr";
		
		return $this->Transact();
	}
*/
	function getAllInfoObject($pid='') {
	    global $db;
		 
		if(!$this->internResolvePID($pid)) return false;
		
	    $this->sql="SELECT p.*, addr.name AS addr_citytown_name 
					FROM $this->tb_person AS p 
					LEFT JOIN  $this->tb_citytown AS addr ON p.addr_citytown_nr=addr.nr
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
	/**
	* CurrentEncounter() checks if a person is currently admitted (both inpatient & outpatient)
	* public
	* @param $pid (int) =  pid number
	* returns encounter nr. if true, else false
	*/
	function CurrentEncounter($pid){
	    global $db;
		if(!$pid) return false;
		$this->sql="SELECT encounter_nr FROM $this->tb_enc 
							WHERE pid='$pid' AND NOT is_discharged AND NOT (encounter_status LIKE 'cancelled') AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
		    if($buf->RecordCount()) {
				$buf2=$buf->FetchRow();
				//echo $this->sql;
				return $buf2['encounter_nr'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* EncounterList() gets all encounters of a person
	* public
	* @param $pid (int) =  pid number
	* returns adodb record object, else false
	*/
	function EncounterList($pid){
	    global $db;
		if(!$pid) return false;
		$this->sql="SELECT encounter_nr,encounter_date,encounter_class_nr,is_discharged,discharge_date FROM $this->tb_enc WHERE pid='$pid' AND status NOT IN ($this->dead_stat)";
		if($this->res['_enl']=$db->Execute($this->sql)){
		    if($this->rec_count=$this->res['_enl']->RecordCount()) {
				return $this->res['_enl'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Persons() gets a list of persons based on search key
	* public
	* @param $pid (int) =  pid number
	* returns adodb record object, else false
	*/
	function Persons($searchkey=''){
	    global $db;
		$searchkey=trim($searchkey);
		if(is_numeric($searchkey)) {
            $searchkey=(int) $searchkey;
			$this->is_nr=true;
			$order_item='pid';			
	    } else {
            $order_item='name_last';
			$this->is_nr=false;
		}
			 
		$this->sql="SELECT pid, name_last, name_first, date_birth, sex FROM $this->tb_person";
		if(empty($searchkey)){
			$this->sql.=' WHERE';
		}else{
			$this->sql.=" WHERE ( pid='$suchwort'
									OR  name_last LIKE '$searchkey%' 
			                		OR name_first LIKE '$searchkey%'
			                		OR pid LIKE '$searchkey' 
									)
									AND";
		}
		$this->sql.=" status NOT IN ($this->dead_stat) ORDER BY $order_item";
		if($this->res['pers']=$db->Execute($this->sql)){
		    if($this->rec_count=$this->res['pers']->RecordCount()) {			
				return $this->res['pers'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* CurrentEmployment() checks if the person is currently employed in the hospital and returns its employee nr.
	* public
	* @param $pid (int) = person id nr.
	* return employee nr, else false
	*/
	function CurrentEmployment($pid){
	    global $db;
		if(!$pid) return false;
		$this->sql="SELECT nr FROM $this->tb_employ 
							WHERE pid='$pid' AND NOT is_discharged AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
		    if($buf->RecordCount()) {
				$buf2=$buf->FetchRow();
				//echo $this->sql;
				return $buf2['nr'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* setDeathInfo() sets death information
	* @public
	* @param $pid (int) the pid number of the person
	* @data (array) the data in associative array
	* return true/false
	*/
	function setDeathInfo($pid,&$data){
		$this->setDataArray($data);
		$this->setWhereCondition("pid=$pid");
		return $this->updateDataFromInternalArray($pid);
	}
	
}
?>
