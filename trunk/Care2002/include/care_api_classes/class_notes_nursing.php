<?php
/* API class for Nursing Notes and Documentation
*  Core 
*   |_ Notes
*         |_ NursingNotes
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_notes.php');

class NursingNotes extends Notes {

	function NursingNotes(){
		$this->Notes();
	}
	function Exists($enr){
		if($this->_RecordExists("type_nr=15 AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}
	function EffectivityExists($enr){
		if($this->_RecordExists("type_nr=17 AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}	
	function DailyWardNotesExists($enr){
		$buf;
		if($this->_RecordExists("type_nr=6 AND encounter_nr=$enr")){
			$buf=$this->result->FetchRow();
			return $buf['nr'];
		}else{return false;}
	}
	function getNursingReport($enr){
		if($this->_getNotes(" type_nr=15 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	function getEffectivityReport($enr){
		if($this->_getNotes(" type_nr=17 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	function getNursingAndEffectivityReport($enr){
		global $db;
		if($this->result=$db->Execute("SELECT n.*,
														e.nr AS eff_nr,
														e.notes AS eff_notes,
														e.aux_notes AS eff_aux_notes,
														e.date AS eff_date,
														e.time AS eff_time,
														e.personell_name AS eff_personell_name
														 FROM $this->tb_notes AS n LEFT JOIN $this->tb_notes AS e ON n.nr=e.ref_notes_nr AND e.encounter_nr=$enr
													WHERE (n.type_nr=15 AND n.encounter_nr=$enr)
														OR (n.type_nr=17 AND n.encounter_nr=$enr)
													 ORDER BY date,time")){
			if($this->result->RecordCount()){
				return $this->result;
			}else{return false;}
		}else{ 
			return false;
		}
	}

	function saveNursingReport(&$data){
		if(empty($data)){
			return false;
		}else{
			$this->data_array['encounter_nr']=$data['pn'];
			$this->data_array['notes']=$data['berichtput'];
			$this->data_array['date']=$data['dateput'];
			$this->data_array['time']=$data['timeput'];
			$this->data_array['personell_name']=$data['author'];
			$this->data_array['aux_notes']=$data['warn'];
		}
		if($this->_insertNotesFromInternalArray(15)){
			return true;
		}else{return false;}
	}
	function saveEffectivityReport(&$data){
		if(empty($data)){
			return false;
		}else{
			$this->data_array['encounter_nr']=$data['pn'];
			$this->data_array['notes']=$data['berichtput2'];
			$this->data_array['date']=$data['dateput2'];
			$this->data_array['time']=$data['timeput'];
			$this->data_array['personell_name']=$data['author2'];
			$this->data_array['aux_notes']=$data['warn2'];
			$this->data_array['ref_notes_nr']=$data['ref_notes_nr'];
		}
		if($this->_insertNotesFromInternalArray(17)){
			return true;
		}else{return false;}
	}
	function getNursingReportDateRange($enr){
		if($this->_getNotesDateRange($enr,0,"encounter_nr=$enr AND (type_nr=15 OR type_nr=17)")){
			return $this->result->FetchRow();
		}else{return false;}
	}
	function getDailyWardNotes($enr){
		if($this->_getNotes("type_nr=6 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	function saveDailyWardNotes(&$data){
		$buf;	
		if(empty($data)){
			return false;
		}else{
			$this->data_array=$data;
			$this->data_array['encounter_nr']=$data['pn'];
			$this->data_array['location_nr']=$data['dept_nr'];
			$this->data_array['location_id']=$data['station'];
			$this->data_array['date']=date('Y-m-d');
			$this->data_array['time']=date('H:i:s');
			if($this->_insertNotesFromInternalArray(6)){
				return true;
			}else{return false;}
		}
	}	/**/
}
?>
