<?php
/* API class for laboratory
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');

class Lab extends Encounter {
	
	var $tb_find_chemlab='care_test_findings_chemlab';
	var $tb_test_param='care_test_param';
	var $tb_test_group='care_test_group';
	var $en_prepend;
	var $tparams;
	var $tgroups;
	
	var $fld_find_chemlab=array(
				'batch_nr',
				'encounter_nr',
				'test_date',
				'test_time',
				'lab_notes',
				'job_id',
				'group_id',
				'serial_value',
				'validator',
				'validate_dt',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time');
				
	var $fld_test_param=array(
				'nr',
				'group_id',
				'name',
				'id',
				'msr_unit',
				'median',
				'hi_bound',
				'lo_bound',
				'hi_critical',
				'lo_critical',
				'hi_toxic',
				'lo_toxic',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time');

	/**
	* Constructor
	*/
	function Lab($enc_nr=''){
		if(!empty($enc_nr)) $this->enc_nr=$enc_nr;
		$this->setTable($this->tb_find_chemlab);
		$this->setRefArray($this->fld_find_chemlab);
		//$this->en_prepend=date('Y')*1000000;
	}
	/**
	* useTestParam()  sets the core table and fields to the care_test_param
	* public
	* return void
	*/
	function useTestParams(){
		$this->ref_array=$this->fld_test_param;
		$this->coretable=$this->tb_test_param;
	}
	/**
	* searchResults() searches for existing lab reports for an encounter 
	*/
	function createResultsList($enc_nr){
	    global $db;
	
		$this->sql="SELECT job_id,test_date,test_time,group_id FROM $this->tb_find_chemlab WHERE encounter_nr='$enc_nr' AND status<>'hidden' ORDER BY batch_nr DESC";
		
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return false;}
		}else {return false;}
	}
	/** 
	* BatchNr() gets batch number of a given encounter nr plus job id
	* @param $enc_nr (int) = encounter number
	* @param $job_id (str) = job id
	* return batch_nr if true else return false
	*/
	function BatchNr($enc_nr,$job_id,$grp_id){
	    global $db;
		$this->sql="SELECT batch_nr FROM $this->tb_find_chemlab WHERE encounter_nr='$enc_nr' AND job_id='$job_id' AND group_id='$grp_id'";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				$row=$this->result->FetchRow();
				return $row['batch_nr'];
			} else {return false;}
		}else {return false;}
	}
	/** 
	* JobIDExists() check if the job id is existing
	* @param $enc_nr (int) = encounter number
	* @param $job_id (str) = job id
	* return true/false
	*/
	function JobIDExists($enc_nr,$job_id,$grp_id){
		if($this->BatchNr($enc_nr,$job_id,$grp_id)){
			return true;
		} else {return false;}
	}
	/**
	* hideResultIfExists() hides the result if it exists
	* @param $enc_nr (int) = encounter number
	* @param $job_id (str) = job id
	* return true/false
	*/
	function hideResultIfExists($enc_nr,$job_id,$grp_id){
		global $HTTP_SESSION_VARS;
		$this->sql="UPDATE $this->tb_find_chemlab SET status='hidden',history=CONCAT(history,'Hide ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')
								WHERE encounter_nr='$enc_nr' AND job_id='$job_id' AND group_id='$grp_id' AND status NOT IN ($this->dead_stat)";
		return $this->Transact();
	}
	/**
	* getBatchResult() gets the result data basing on the batch nr
	* @param $bn (int) = batch nr
	* return serialized value
	*/
	function getBatchResult($bn){
		global $db;
		$this->sql="SELECT * FROM $this->tb_find_chemlab WHERE batch_nr=$bn";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return false;}
		}else {return false;}
	}
	/**
	* getResult() gets the result data  
	* return adodb record object
	*/
	function getResult($job_id,$grp_id,$enc_nr=''){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT * FROM $this->tb_find_chemlab WHERE encounter_nr='$this->enc_nr' AND job_id='$job_id' AND group_id='$grp_id' AND status<>'hidden'";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return false;}
		}else {return false;}
	}
	/**
	* getAllResults() gets the all result records for an encounter
	* @param $enc_nr (int) = encounter number
	* return adodb record object
	*/
	function getAllResults($enc_nr=''){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT * FROM $this->tb_find_chemlab WHERE encounter_nr='$this->enc_nr' AND status NOT IN ($this->dead_stat) ORDER BY test_date";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return false;}
		}else {return false;}
	}
	/**
	* TestParams() loads all test parameters belonging to a test group
	* public
	* @param $group_id (str) = group id of the test group, if empty all parameters will be returned
	* return adodb record set
	*/
	function TestParams($group_id=''){
		global $db;
		if(empty($group_id)) $cond='';
			else $cond="group_id='$group_id' AND";
		$this->sql="SELECT * FROM $this->tb_test_param WHERE $cond status NOT IN ($this->dead_stat)";
		if($this->tparams=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparams->RecordCount()) {
				return $this->tparams;
			} else {return false;}
		}else {return false;}
	}
	/**
	* TestGroups() loads all test groups 
	* public
	* return adodb record set
	*/
	function TestGroups(){
		global $db;
		$this->sql="SELECT * FROM $this->tb_test_group WHERE status NOT IN ($this->dead_stat) ORDER BY sort_nr";
		if($this->tgroups=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tgroups->RecordCount()) {
				return $this->tgroups;
			} else {return false;}
		}else {return false;}
	}
	/**
	* ResultExists() check whether at least one lab result exists for the encounter
	* public
	* @param $enc_nr (int) = encounter nr
	* return true/false
	*/
	function ResultExists($enc_nr=''){
		global $db;
		$buf;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT nr FROM $this->tb_find_chemlab WHERE encounter_nr='$this->enc_nr' AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
		    if($this->rec_count=$buf->RecordCount()) {
				return true;
			} else {return false;}
		}else {return false;}
	}
	/**
	* getTestParam($nr) gets all info of a test parameter
	* public
	* @param $nr (int) = the table record number of a test parameter
	* return adodb record set
	*/
	function getTestParam($nr=0,$id=''){
		global $db;
		if($nr){	
			$cond="nr='$nr'";
		}elseif(!empty($id)){
			$cond="id='$id'";
		}else{
			return false;
		}
		$this->sql="SELECT * FROM $this->tb_test_param WHERE $cond";
		if($this->buffer=$db->Execute($this->sql)){
		    if($this->buffer->RecordCount()) {
				return $this->buffer;
			} else {return false;}
		}else {return false;}
	}
	/**
	* searchEncounterLabResults()  searches for encounters with existing lab results
	* public
	* @param $key (mixed) = search keyword
	* return adodb record object
	*/
	function searchEncounterLabResults($key='',$add_opt='',$limit=FALSE,$len=30,$so=0){
		global $db;
		if(empty($key)) return false;
		$this->sql="SELECT e.encounter_nr, e.encounter_class_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.sex
				FROM ( $this->tb_enc AS e, $this->tb_find_chemlab AS f ) LEFT JOIN $this->tb_person AS p ON e.pid=p.pid";
		if(is_numeric($key)){
			$key=(int)$key;
			$this->sql.=" WHERE e.encounter_nr = $key";
		}else{
			$this->sql.=" WHERE (e.encounter_nr LIKE '$key%' 
						OR p.pid LIKE '$key%'
						OR p.name_last LIKE '$key%'
						OR p.name_first LIKE '$key%'
						OR p.date_birth LIKE '$key%')";
			if($enc_class) $sql.="	AND e.encounter_class_nr=$enc_class";
		}
		# Append the common condition
		$this->sql.=" AND NOT e.is_discharged AND e.encounter_nr=f.encounter_nr GROUP BY e.encounter_nr $add_opt";
		//echo $this->sql;
		if($limit){
	    	$this->res['selr']=$db->SelectLimit($this->sql,$len,$so);
		}else{
	    	$this->res['selr']=$db->Execute($this->sql);
		}
	    if ($this->res['selr']) {
		   	if ($this->record_count=$this->res['selr']->RecordCount()) {
				# Workaround
				$this->rec_count=$this->record_count;
				return $this->res['selr'];
			}else{return false;}
		}else{return false;}
	}	
	/**
	* searchLimitEncounterLabResults()  searches for encounters with existing lab results
	* similar to searchEncounterLabResults() but returns a limited number of rows
	* public
	* @param $key (mixed) = search keyword
	* return adodb record object
	*/
	function searchLimitEncounterLabResults($key,$len,$so,$sortitem='',$order='ASC'){
		if(!empty($sortitem)){
			$option=" ORDER BY $sortitem $order";
		}else{
			$option='';
		}
		return $this->searchEncounterLabResults($key,$option,TRUE,$len,$so); 
	}
	/**
	* getLastModifyTime() gets the latest modify_time info of an encounters lab result
	* public
	* @param $enc_nr (int) = encounter number
	* return timestamp
	*/
	function getLastModifyTime($enc_nr=0){
		global $db;
		$buf;
		$row;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT modify_time FROM $this->tb_find_chemlab WHERE encounter_nr='$this->enc_nr' AND status NOT IN ($this->dead_stat) ORDER BY modify_time DESC";
		if($buf=$db->SelectLimit($this->sql,1)){
		    if($buf->RecordCount()) {
				$row=$buf->FetchRow();
				return $row['modify_time'];
			} else {return false;}
		}else {return false;}
	}
}
?>
