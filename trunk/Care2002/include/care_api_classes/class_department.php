<?php
/* API class for user configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Department extends Core {

	var $tb='care_department'; // table name
	var $tb_types='care_type_department';
	var $tb_cphone='care_phone';
	var $result;
	var $preload_dept;
	var $is_preloaded=false;
	var $dept_count;
	var $dept_nr;
	var $tabfields=array('nr',
									'id',
									'type',
									'name_formal',
									'name_short',
									'name_alternate',
									'LD_var',
									'description',
									'admit_inpatient',
									'admit_outpatient',
									'has_oncall_doc',
									'has_oncall_nurse',
									'this_institution',
									'is_sub_dept',
									'parent_dept_nr',
									'work_hours',
									'consult_hours',
									'is_inactive',
									'sort_order',
									'sig_line',
									'sig_stamp',
									'logo_file',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function Department(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	
	function _getalldata($cond='1',$sort='name_formal'){
	    global $db;
		
	    if ($this->result=$db->Execute("SELECT * FROM $this->tb WHERE $cond AND (status='' OR status<>'hidden') ORDER BY $sort")) {
		    if ($this->dept_count=$this->result->RecordCount()) {
		        return $this->result->GetArray();
			}else{
				return false;
			}
		}else{
		    return false;
		}
	}
	
	function getAllNoCondition($sort=''){
	    global $db;
		
		if(!empty($sort)) $sort=" ORDER BY $sort";
	    if ($this->result=$db->Execute("SELECT * FROM $this->tb WHERE 1 $sort")) {
		    if ($this->dept_count=$this->result->RecordCount()) {
		        return $this->result->GetArray();
			}else{
				return false;
			}
		}else{
		    return false;
		}
	}
	
	function getAll() {
		return $this->_getalldata('1');
	}
	
	function getAllSort($sort='') {
		return $this->_getalldata('1',$sort);
	}
	
	function getAllActiveSort($sort='') {
		return $this->_getalldata('is_inactive="" OR is_inactive="0"',$sort);
	}
	
	function getAllMedical() {
		return $this->_getalldata('type=1 AND (is_inactive="" OR is_inactive="0")');
	}
	function getAllMedicalWithOnCall() {
		return $this->_getalldata('type=1 AND (is_inactive="" OR is_inactive="0") AND (has_oncall_doc=1 OR has_oncall_nurse=1)');
	}
	function getAllSupporting() {
		return $this->_getalldata('type=2 AND (is_inactive="" OR is_inactive="0")');
	}
	function getAllNewsGroup() {
		return $this->_getalldata('type=3 AND (is_inactive="" OR is_inactive="0")');
	}
	function getAllActiveWithDOC(){
		return $this->_getalldata('type=1 AND (is_inactive="" OR is_inactive="0") AND has_oncall_doc=1');
	}
	function getAllActiveWithNOC(){
		return $this->_getalldata('type=1 AND (is_inactive="" OR is_inactive="0") AND has_oncall_nurse=1');
	}
	function getAllActiveWithSurgery(){
		return $this->_getalldata('type=1 AND (is_inactive="" OR is_inactive="0") AND does_surgery=1');
	}
	
	function getTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var,description FROM $this->tb_types WHERE 1")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
	function getTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,name,LD_var,description FROM $this->tb_types WHERE nr=$type_nr")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
	function getDeptAllInfo($nr){
	    global $db;
	    if ($this->result=$db->Execute("SELECT * FROM $this->tb WHERE nr=$nr")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
	function preloadDept($nr){
	    global $db;
	    if ($this->result=$db->Execute("SELECT * FROM $this->tb WHERE nr=$nr")) {
		    if ($this->dept_count=$this->result->RecordCount()) {
		        $this->preload_dept=$this->result->FetchRow();
				$this->is_preloaded=true;
				return true;
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
	function unloadDept(){
		if($this->is_preloaded){
			$this->preload_dept=NULL;
			$this->is_preloaded=false;
		}
		return true;
	}
		
	function Nr(){
		if(!$this->is_preloaded) return false;
		return $this->preload_dept['nr'];
	}
	function ID(){
		if(!$this->is_preloaded) return false;
		return $this->preload_dept['id'];
	}
	function Type(){
		if(!$this->is_preloaded) return false;
		return $this->preload_dept['type'];
	}
	function FormalName(){
		if(!$this->is_preloaded) return false;
		return $this->preload_dept['name_formal'];
	}
	function ShortName(){
		if(!$this->is_preloaded) return false;
		return $this->preload_dept['name_short'];
	}
	function Address($nr=0){
		if(!$this->is_preloaded){
			if($nr) $this->dept_nr=$nr;
			return $this->_getItem('address');
		}
		return $this->preload_dept['address'];
	}
	function SignatureStamp($nr=0){
		if(!$this->is_preloaded){
			if($nr) $this->dept_nr=$nr;
			return $this->_getItem('sig_stamp');
		}
		return $this->preload_dept['sig_stamp'];
	}
	function LDvar($nr=0){
		if(!$this->is_preloaded){
			if($nr) $this->dept_nr=$nr;
			return $this->_getItem('LD_var');
		}
		return $this->preload_dept['LD_var'];
	}
	
	function _getItem($item=''){
	    global $db;
		$row='';
		if(empty($item)) return false;
	    if ($this->result=$db->Execute("SELECT $item FROM $this->tb WHERE nr=$this->dept_nr")) {
		    if ($this->result->RecordCount()) {
		        $row=$this->result->FetchRow();
				return $row[$item];
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
	function getPhoneInfo($nr){
		global $db;
		$sql="SELECT *	FROM $this->tb_cphone WHERE dept_nr=$nr";
				 
	    if ($this->result=$db->Execute($sql)) {
		   	if ($this->record_count=$this->result->RecordCount()) {
				return $this->result->FetchRow();
			} else {
				return false;
			}
		}else {
			return false;
		}
	}
	
}
?>
