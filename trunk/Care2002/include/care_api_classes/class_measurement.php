<?php
/* API class for user configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Measurement extends Core {

	var $tb='care_encounter_measurement'; // table name
	var $tb_msr_types='care_type_measurement';
	var $tb_units='care_unit_measurement';
	var $tb_unit_types='care_type_unit_measurement';
	var $result;
	var $preload_dept;
	var $is_preloaded=false;
	var $dept_count;
	var $tabfields=array('nr',
									'msr_date',
									'msr_time',
									'encounter_nr',
									'msr_type_nr',
									'value',
									'unit_nr',
									'unit_type_nr',
									'notes',
									'measured_by',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function Measurement(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	
	function getAllMsrTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var FROM $this->tb_msr_types WHERE 1")) {
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
	
	function _getUnits($cond='1'){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,unit_type_nr,id,name,LD_var  FROM $this->tb_units WHERE $cond")) {
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
	
	function getUnits(){
	    return $this->_getUnits();
	}	
/*		function getmetricUnits(){
	    return $this->_getUnits("system='metric'");
	}	
	function getenglishUnits(){
	    return $this->_getUnits("system='english'");
	}	
	
function increaseUnitHit($nr,$count='1'){
	    global $db;
		if(empty($nr)) return false;
	    if ($this->result=$db->Execute("UPDATE $this->tb_units SET use_frequency=(use_frequency+$count) WHERE nr=$nr")) {
		    if ($db->Affected_Rows()) {
		        return true;
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}	
	*/
}
?>
