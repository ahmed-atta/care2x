<?php
/* API class for user configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Immunization extends Core {

	var $tb='care_encounter_immunization'; // table name
	var $tb_types='care_type_application';
	var $result;
	var $preload_dept;
	var $is_preloaded=false;
	var $dept_count;
	var $tabfields=array('nr',
									'encounter_nr',
									'date',
									'type',
									'medicine',
									'dosage',
									'application_type_nr',
									'application_by',
									'titer',
									'refresh_date',
									'notes',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function Immunization(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	
	function _getalldata($cond='1',$sort=''){
	    global $db;
		
		if(!empty($sort)) $sort=" ORDER BY $sort";
	    if ($this->result=$db->Execute("SELECT * FROM $this->tb WHERE $cond AND (status='' OR status<>'hidden') $sort")) {
		    if ($this->dept_count=$this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
	function getAllNoCondition($sort=''){
	    global $db;
		
		if(!empty($sort)) $sort=" ORDER BY $sort";
	    if ($this->result=$db->Execute("SELECT * FROM $this->tb WHERE 1 $sort")) {
		    if ($this->dept_count=$this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
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
	
	
	function getAppTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,group_nr,type,name,LD_var,description FROM $this->tb_types WHERE 1")) {
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
	
	    if ($this->result=$db->Execute("SELECT type,group_nr,name,LD_var,description FROM $this->tb_types WHERE nr=$type_nr")) {
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
	
}
?>
