<?php
/* API class for user configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Prescription extends Core {

	var $tb='care_encounter_prescription'; // table name
	var $tb_app_types='care_type_application';
	var $tb_pres_types='care_type_prescription';
	var $result;
	var $preload_dept;
	var $is_preloaded=false;
	var $dept_count;
	var $tabfields=array('nr',
									'encounter_nr',
									'prescription_type_nr',
									'article',
									'drug_class',
									'order_nr',
									'dosage',
									'application_type_nr',
									'notes',
									'prescribe_date',
									'prescriber',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function Prescription(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	
	function getPrescriptionTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var FROM $this->tb_pres_types WHERE 1")) {
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
	
	function getAppTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,group_nr,type,name,LD_var,description FROM $this->tb_app_types WHERE 1")) {
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
	
	function getAppTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,group_nr,name,LD_var,description FROM $this->tb_app_types WHERE nr=$type_nr")) {
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
	
	function getPrescriptionTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,name,LD_var,description FROM $this->tb_pres_types WHERE nr=$type_nr")) {
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
