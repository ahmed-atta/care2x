<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Person methods. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version deployment 1.1 (mysql) 2004-01-11
* @copyright 2002,2003,2004 Elpidio Latorilla
* @package care_api
*/
class Person extends Core {
	/**#@+
	* @access private
	*/
	/**
	* Table name for person registration data.
	* @var string
	*/
    var $tb_person='care_person';
	/**
	* Table name for city town name.
	* @var string
	*/
	var $tb_citytown='care_address_citytown';
	/**
	* Table name for encounter data.
	* @var string
	*/
	var $tb_enc='care_encounter';
	/**
	* Table name for employee data.
	* @var string
	*/
	var $tb_employ='care_personell';
	/**
	* SQL query
	*/
	var $sql;
	/**#@-*/
	/**
	* PID number
	* @var int
	*/
	var $pid;
	/**
	* Sql query result buffer
	* @var adodb record object
	*/
	var $result;
	/**
	* Universal flag
	* @var boolean
	*/
	var $ok;
	/**
	* Internal data buffer
	* @var array
	*/
	var $data_array;
	/**
	* Universal buffer
	* @var mixed
	*/
	var $buffer;
	/**
	* Returned row buffer
	* @var array
	*/
	var $row;
	/**
	* Returned person data buffer
	* @var array
	*/
	var $person=array();
	/**
	* Preloaded data flag
	* @var boolean
	*/
	var $is_preloaded=false;
	/**
	* Valid number flag
	* @var boolean
	*/
	var $is_nr=false;
	/**
	* Field names of basic registration data to be returned.
	* @var array
	*/
	var $basic_list='pid,title,name_first,name_last,name_2,name_3,name_middle,name_maiden,name_others,date_birth,
				           sex,addr_str,addr_str_nr,addr_zip,addr_citytown_nr,photo_filename';
	/**
	* Field names of table care_person
	* @var array
	*/
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
	/**
	* Constructor
	* @param int PID number
	*/
	function Person ($pid='') {
	    $this->pid=$pid;
		$this->ref_array=$this->elems_array;
		$this->coretable=$this->tb_person;
	}
	/**
	* Sets the PID number.
	* @access public
	* @param int PID number
	*/
	function setPID($pid) {
	    $this->pid=$pid;
	}
	/**
	* Resolves the PID number to used in the methods.
	* @access public
	* @param int PID number
	* @return boolean
	*/
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
	/**
	* Checks if PID number exists in the database.
	* @access public
	* @param int PID number
	* @return boolean
	*/
	function InitPIDExists($init_nr){
		global $db;
		$this->sql="SELECT pid FROM $this->tb_person WHERE pid=$init_nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Prepares the internal buffer array for insertion routine.
	* @access private
	*/
	function prepInsertArray(){
        global $HTTP_POST_VARS;
		$x='';
		$v='';
		$this->data_array=NULL;
		if(!isset($HTTP_POST_VARS['create_time'])||empty($HTTP_POST_VARS['create_time'])) $HTTP_POST_VARS['create_time']=date('YmdHis');
		while(list($x,$v)=each($this->elems_array)) {
	    	if(isset($HTTP_POST_VARS[$v])&&!empty($HTTP_POST_VARS[$v])) $this->data_array[$v]=$HTTP_POST_VARS[$v];
	    }
    }	
	/**
	* Database transaction. Uses the adodb transaction method.
	* @access private
	*/
	function Transact() {
	
	    global $db;
	    //$db->debug=true;
		
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
	/**
	* Inserts the data into the care_person table.
	* @access private
	* @param int PID number
	* @return boolean
	*/
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
	/**
	* Inserts the data from the internal buffer array into the care_person table.
	*
	* The data must be packed in the buffer array with index keys as outlined in the <var>$elems_array</var> array.
	* @access public
	* @return boolean
	*/
	function insertDataFromInternalArray() {
	    //$this->data_array=NULL;
		# Check if  "create_time" key has a value, if no, create a new value
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

	/**
	* Gets all person registration information based on its PID number key.
	*
	* The returned adodb record object contains a row or array.
	* This array contains data with the following index keys:
	* - all index keys as outlined in the <var>$elems_array</var> array
	* - addr_citytown_name = name of the city or town
	*
	* @access public
	* @param int PID number
	* @return mixed adodb object or boolean
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
	/**
	* Same as getAllInfoObject() but returns a 2 dimensional array.
	*
	* The returned  data in the array have the following index keys:
	* - all index keys as outlined in the <var>$elems_array</var> array
	* - citytown = name of the city or town
	*
	* @access public
	* @param int PID number
	* @return mixed array or boolean
	*/
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
	/**
	* Gets a particular registration item based on its PID number.
	*
	* Use this preferably after the person registration data was successfully preloaded in the internal buffer with the <var>preloadPersonInfo()</var> method.
	* For details on field names of items that can be fetched, see the <var>$elems_array</var> array.
	* @access private
	* @param string Field name of the item to be fetched
	* @param int PID number
	* @return mixed string, integer, or boolean
	*/
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
	/**
	* Gets registration items based on an item list and PID number.
	*
	* For details on field names of items that can be fetched, see the <var>$elems_array</var> array.
	* Several items can be fetched at once but their field names must be separated by comma.
	* @access public
	* @param string Field names of items to be fetched separated by comma.
	* @param int PID number
	* @return mixed
	*/
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
	/**
	* Preloads the person registration data in the internal buffer <var>$person</var>.
	*
	* The preload success status is stored in the <var>$is_preloaded</var> variable.
	* The buffered adodb record object contains a row or array.
	* This array contains data with index keys as outlined in the <var>$elems_array</var> array
	*
	* @access public
	* @param int PID number
	* @return boolean
	*/
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
	/**#@+
	*
	* Use this preferably after the person registration data was successfully preloaded in the internal buffer with the <var>preloadPersonInfo()</var> method.
	* @access public
	* @return string
	*/
	/**
	* Returns person's first name.
	*/
	function FirstName() {
        return $this->getValue('name_first');
	}
	/**
	* Returns person's last or family name.
	*/
	function LastName() {
        return  $this->getValue('name_last');
	}
	/**
	* Returns person's second name.
	*/
	function SecondName() {
        return  $this->getValue('name_2');
	}
	/**
	* Returns person's third name.
	*/
	function ThirdName() {
        return  $this->getValue('name_3');
	}
	/**
	* Returns person's middle name.
	*/
	function MiddleName() {
        return  $this->getValue('name_middle');
	}
	/**
	* Returns person's maiden (unmarried) name.
	*/
	function MaidenName() {
        return  $this->getValue('name_maiden');
	}
	/**
	* Returns person's other name(s).
	*/
	function OtherName() {
        return  $this->getValue('name_others');
	}
	/**
	* Returns person's date of birth.
	*/
	function BirthDate() {
        return  $this->getValue('date_birth');
	}
	/**
	* Returns street number. Not stricly numeric. Could be alphanumeric.
	*/
	function StreetNr() {
        return  $this->getValue('addr_str_nr');
	}
	/**
	* Returns street name.
	*/
	function StreetName() {
        return  $this->getValue('addr_str');
	}
	/**
	* Returns ZIP code.
	*/
	function ZIPCode() {
        return  $this->getValue('addr_zip');
	}
	/**
	* Returns the valid address status. Returns 1 or 0.
	*/
	function isValidAddress() {
        return  $this->getValue('addr_is_valid');
	}
	/**
	* Returns the city or town code number. Reserved.
	*/
	function CityTownCode() {
        return  $this->getValue('addr_citytown_nr');
	}
	/**
	* Returns citizenship.
	*/
	function Citizenship() {
        return  $this->getValue('citizenship');
	}
	/**
	* Returns first phone area code.
	*/
	function FirstPhoneAreaCode() {
        return  $this->getValue('phone_1_code');
	}
	/**
	* Returns first phone number. Can be used as private phone number.
	*/
	function FirstPhoneNumber() {
        return  $this->getValue('phone_1_nr');
	}
	/**
	* Returns second phone area code.
	*/
	function SecondPhoneAreaCode() {
        return  $this->getValue('phone_2_code');
	}
	/**
	* Returns second phone number. Can be used as business phone number.
	*/
	function SecondPhoneNumber() {
        return  $this->getValue('phone_2_nr');
	}
	/**
	* Returns first cellphone number. Can be used as private cellphone number.
	*/
	function FirstCellphoneNumber() {
        return  $this->getValue('cellphone_1_nr');
	}
	/**
	* Returns second cellphone number.Can be used as business cellphone number
	*/
	function SecondCellphoneNumber() {
        return  $this->getValue('cellphone_2_nr');
	}
	/**
	* Returns fax number.
	*/
	function FaxNumber() {
        return  $this->getValue('fax');
	}
	/**
	* Returns email address.
	*/
	function EmailAddress() {
        return  $this->getValue('email');
	}
	/**
	* Returns sex.
	*/
	function Sex() {
        return  $this->getValue('sex');
	}
	/**
	* Returns title.
	*/
	function Title() {
        return  $this->getValue('title');
	}
	/**
	* Returns filename of stored id photo.
	*/
	function PhotoFilename() {
        return  $this->getValue('photo_filename');
	}
	/**
	* Returns ethnic origin.
	*/
	function EthnicOrigin() {
        return  $this->getValue('ethnic_origin');
	}
	/**
	* Returns organization id.
	*/
	function OrgID() {
        return  $this->getValue('org_id');
	}
	/**
	* Returns social security (system) number.
	*/
	function SSSNumber() {
        return  $this->getValue('sss_nr');
	}
	/**
	* Returns national id number.
	*/
	function NationalIDNumber() {
        return  $this->getValue('nat_id_nr');
	}
	/**
	* Returns religion.
	*/
	function Religion() {
        return  $this->getValue('religion');
	}
	/**
	* Returns pid number of mother.
	*/
	function MotherPID() {
        return  $this->getValue('mother_pid');
	}
	/**
	* Returns pid number of father.
	*/
	function FatherPID() {
        return  $this->getValue('father_pid');
	}
	/**
	* Returns date of death. In case person is deceased.
	*/
	function DeathDate() {
        return  $this->getValue('death_date');
	}
	/**
	* Returns case of death. In case person is deceased.
	*/
	function DeathCause() {
        return  $this->getValue('death_cause');
	}
	/**
	* Returns table record's technical status.
	*/
	function RecordStatus() {
        return  $this->getValue('status');
	}
	/**
	* Returns table record's history.
	*/
	function RecordHistory() {
        return  $this->getValue('history');
	}
	/**#@-*/
	/**
	* Returns encounter number in case person died during that encounter.
	* @access public
	* @return int
	*/
	function DeathEncounterNumber() {
        return  $this->getValue('death_encounter_nr');
	}
	/**
	* Returns city or town name based on its "nr" key.
	* @access public
	* @return mixed string or boolean
	*/
	function CityTownName($code_nr=''){
	    global $db;
		if(!$this->is_preloaded) $this->sql="SELECT name FROM $this->tb_citytown WHERE nr=$code_nr";
            else $this->sql="SELECT name FROM $this->tb_citytown WHERE nr=".$this->CityTownCode();
			
		//echo $this->sql;exit;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 $this->row=$this->result->FetchRow();	 
				 return $this->row['name'];
			} else { return false; }
		} else { return false; }
    }
	/**
	* Returns person registration items as listed in the <var>$basic_list</var> array based on pid key.
	*
	* The data is returned as associative array.
	* @access public
	* @param int PID number
	* @return mixed string or boolean
	*/
	function BasicDataArray($pid){
        if(!$this->internResolvePID($pid)) return false;
		return $this->getValueByList($this->basic_list,$this->pid);
	}
	/**
	* Adds a "View" note in the history field of the person's registration record.
	*
	* @access public
	* @param string Name of viewing person
	* @param int PID number
	* @return mixed string or boolean
	*/
	function setHistorySeen($encoder='',$pid=''){
	    global $db, $dbtype;
	    //$db->debug=true;
		if(empty($encoder)) return false;
		if(!$this->internResolvePID($pid)) return false;
		if($dbtype=='mysql')
			$this->sql="UPDATE $this->tb_person SET history= CONCAT(history,'\nView ".date('Y-m-d H:i:s')." = $encoder') WHERE pid=$this->pid";
		else
			$this->sql="UPDATE $this->tb_person SET history= history || '\nView ".date('Y-m-d H:i:s')." = $encoder' WHERE pid=$this->pid";
		
		if($db->Execute($this->sql)) {return true;}
		   else  {echo $this->sql;return false;}
	}		
	/**
	* Checks if a person is currently admitted (either inpatient & outpatient).
	*
	* If person is currently admitted, his current encounter number is returned, else FALSE.
	* @access public
	* @param int PID number
	* @return mixed integer or boolean
	*/
	function CurrentEncounter($pid){
	    global $db;
		if(!$pid) return false;
		$this->sql="SELECT encounter_nr FROM $this->tb_enc WHERE pid='$pid' AND (is_discharged='' OR is_discharged=0) AND encounter_status <> 'cancelled' AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
		    if($buf->RecordCount()) {
				$buf2=$buf->FetchRow();
				//echo $this->sql;
				return $buf2['encounter_nr'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Gets all encounters of a person based on its pid key.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the encounter data with the following index keys:
	* - encounter_nr = the encounter number
	* - encounter_class_nr = encountr class number, contains 1 (inpatient) or 2 (outpatient), etc.
	* - is_discharged = discharge flag, contains 0 (not discharged) or  1 (discharged)
	* - discharge_date = date of discharge (end of encounter)
	*
	* @access public
	* @param int PID number
	* @return mixed integer or boolean
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
	* Searches and returns a list of persons based on search key.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the encounter data with the following index keys:
	* - pid = the PID number
	* - name_last = person's last or family name
	* - name_first = person's first or given name
	* - date_birth = date of birth
	* - sex = sex
	*
	* @access public
	* @param string Search keyword
	* @return mixed integer or boolean
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
	* Checks if the person is currently employed in this hospital.
	*
	* If currently employed the employee number is returned, else FALSE.
	* @access public
	* @param int PID number
	* @return mixed integer or boolean
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
	* Sets death information.
	* 
	* The data must be passed by reference with associative array.
	* Data array must have the following index keys.
	* - 'death_date' = date of death
	* - 'death_encounter_nr' = encounter number in case person died during that encounter
	* - 'death_cause' = text of death cause
	* - 'death_cause_code' = code of death cause (if available)
	* - 'history' = text to be appended to "history" item
	* - 'modify_id' = name of user
	* - 'modify_time' = time of this modification in yyyymmddhhMMss format
	*
	* @access public
	* @param int PID number
	* @param array Death information.
	* @return mixed integer or boolean
	*/
	function setDeathInfo($pid,&$data){
		$this->setDataArray($data);
		$this->setWhereCondition("pid=$pid");
		return $this->updateDataFromInternalArray($pid);
	}
	/**
	* Returns the PID ('nr' of a column) based on OID key
	*
	* Special for postgresql or dbms that returns an OID key after an insert
	*
	* @access public
	* @param int OID return insert key of a column
	* @return mixed integer or boolean
	*/
	function postgre_PIDbyOID($oid=0){
		if(!$oid) return false;
		else return $this->postgre_Insert_ID($this->tb_person,'pid',$oid);
	}
	
	/**
	* returns basic data of living person(s) based on family name, first name & b-day
	*
	* @access public
	* @param array The data keys
	* @param boolean Flags if non-living persons are also returned. Default = FALSE
	* @return mixed array or boolean
	*/
	function PIDbyData(&$data,$deadtoo=FALSE){
		global $db, $sql_LIKE, $dbf_nodate;
		$this->sql="SELECT pid,name_last,name_first,date_birth,sex FROM $this->tb_person WHERE name_last $sql_LIKE '".$data['name_last']."' 
					AND name_first $sql_LIKE '".$data['name_first']."'
					AND date_birth='".$data['date_birth']."'
					AND sex $sql_LIKE '".$data['sex']."'";
		if(!$deadtoo) $this->sql.=" AND death_date='$dbf_nodate'";
		if($res['pbd']=$db->Execute($this->sql)){
		    if($res['pbd']->RecordCount()) {
				return $res['pbd'];//
			}else{return false;}
		}else{return false;}
	}
}
?>
