<?php
/* API class for notes
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Notes extends Core {

	var $tb='care_encounter_notes'; // table name
	var $tb_types='care_type_notes';
	var $result;
	var $preload_dept;
	var $is_preloaded=false;
	var $tabfields=array('nr',
									'encounter_nr',
									'type_nr',
									'notes',
									'short_notes',
									'aux_notes',
									'ref_notes_nr',
									'personell_nr',
									'personell_name',
									'send_to_pid',
									'send_to_name',
									'date',
									'time',
									'location_type',
									'location_id',
									'ack_short_id',
									'date_ack',
									'date_checked',
									'date_printed',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function Notes(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	
	function getAllTypesSort($sort=''){
	    global $db;
	
		if(empty($sort)) $sort=" ORDER BY nr";
			else $sort=" ORDER BY $sort";
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var FROM $this->tb_types WHERE 1 $sort")) {
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
	
	function getAllTypes(){
		return $this->getAllTypesSort();
	}
	
	function getType($nr=1){
	    global $db;

	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var FROM $this->tb_types WHERE nr=$nr")) {
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
