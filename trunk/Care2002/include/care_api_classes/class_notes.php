<?php
/* API class for notes
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Notes extends Core {

	var $tb_notes='care_encounter_notes'; // table name
	var $tb_types='care_type_notes';
	var $tb_enc='care_encounter';
	var $result;
	var $preload_dept;
	var $is_preloaded=false;
	var $fld_notes=array('nr',
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
									'location_type_nr',
									'location_nr',
									'location_id',
									'ack_short_id',
									'date_ack',
									'date_checked',
									'date_printed',
									'send_by_mail',
									'send_by_email',
									'send_by_fax',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function Notes(){
		$this->setTable($this->tb_notes);
		$this->setRefArray($this->fld_notes);
	}
	function _Exists($enr,$type_nr){
		if($this->_RecordExists("type_nr=$type_nr AND encounter_nr=$enr")){
			return true;
		}else{return false;}
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
	function _getNotes($cond,$order='ORDER BY date,time DESC'){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_notes WHERE $cond $order";
		//echo $this->sql;
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        //return true;
		        return $this->result;
			}else{return false;}
		}else{return false;}
	}
	function _insertNotesFromInternalArray($type_nr=''){
		global $HTTP_SESSION_VARS;
		if(empty($type_nr)) return false;
		if(empty($this->data_array['date'])) $this->data_array['date']=date('Y-m-d');
		if(empty($this->data_array['time'])) $this->data_array['time']=date('H:i:s');
		$this->data_array['type_nr']=$type_nr;
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_time']='NULL';	
		$this->data_array['history']="Create: ".date('Y-m-d H-i-s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n\r";	
		if($this->insertDataFromInternalArray()){
			return true;
		}else{ return false;}
	}
	function _updateNotesFromInternalArray($nr){
		global $HTTP_SESSION_VARS;
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['history']="CONCAT(history,'Update: ".date('Y-m-d H-i-s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n\r')";	
		if($this->updateDataFromInternalArray($nr)){
			return true;
		}else{ return false; }
	}
	function _getNotesDateRange($enr='',$type_nr=0,$cond=''){
		global $db;
		if(empty($enr)){
			return false;
		}else{
			if(empty($cond)&&$type_nr){
				$cond="encounter_nr=$enr AND type_nr=$type_nr";
			}
			$this->sql="SELECT MIN(date) AS fe_date, MAX(date) AS le_date FROM $this->tb_notes WHERE $cond";
			if($this->result=$db->Execute($this->sql)){
				if($this->result->RecordCount()){
					return true;
				}else{return false;}
			}else{return false;}
		}
	}
	/**
	* getEncounterNotesByType() gets the notes by record's number
	* public
	* @param $nr (int) = record nr.
	*/
	function getEncounterNotes($nr){
		return $this->_getNotes("nr=$nr AND status NOT IN ($this->dead_stat)",'');
	}
}
?>
