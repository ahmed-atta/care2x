<?php
/* API class for Doctor's Notes and Documentation
*  Core 
*   |_ Notes
*         |_ DoctorsNotes
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* Notes types:
* 19 = doctor's directive
* 18 = inquiry to doctor
*/
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_notes.php');

class DoctorsNotes extends Notes {

	function DoctorsNotes(){
		$this->Notes();
	}
	function DirectiveExists($enr){
		if($this->_RecordExists("type_nr=19 AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}
	function InquiryExists($enr){
		if($this->_RecordExists("type_nr=18 AND encounter_nr=$enr")){
			return true;
		}else{return false;}
	}	
	function getDirectives($enr){
		if($this->_getNotes(" type_nr=19 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	function getInquiries($enr){
		if($this->_getNotes(" type_nr=18 AND encounter_nr=$enr","ORDER BY date,time")){
			return $this->result;
		}else{
			return false;
		}
	}
	function getDirectivesAndInquiries($enr){
		global $db;
		if($this->result=$db->Execute("SELECT n.*,
														e.nr AS eff_nr,
														e.notes AS eff_notes,
														e.aux_notes AS eff_aux_notes,
														e.date AS eff_date,
														e.time AS eff_time,
														e.personell_name AS eff_personell_name
														 FROM $this->tb_notes AS n LEFT JOIN $this->tb_notes AS e ON n.nr=e.ref_notes_nr AND e.encounter_nr=$enr
													WHERE (n.type_nr=19 AND n.encounter_nr=$enr)
														OR (n.type_nr=18 AND n.encounter_nr=$enr)
													 ORDER BY date,time")){
			if($this->result->RecordCount()){
				return $this->result;
			}else{return false;}
		}else{
			return false;
		}
	}

	function saveDirective(&$data){
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
		if($this->_insertNotesFromInternalArray(19)){
			return true;
		}else{return false;}
	}
	function saveInquiry(&$data){
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
		if($this->_insertNotesFromInternalArray(18)){
			return true;
		}else{return false;}
	}
	function getDoctorsDirectivesDateRange($enr){
		if($this->_getNotesDateRange($enr,0,"encounter_nr=$enr AND (type_nr=19 OR type_nr=18)")){
			return $this->result->FetchRow();
		}else{return false;}
	}
}
?>
