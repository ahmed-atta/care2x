<?php
/* API class for Charts and Documentation
*  Core 
*   |_ Notes
*         |_ NursingNotes
*              |_ Charts
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_notes.php');
require_once($root_path.'include/care_api_classes/class_notes_nursing.php');

class Charts extends NursingNotes {

	var $tb_measure='care_encounter_measurement';
	var $tb_prescription='care_encounter_prescription';
	var $tb_presc_notes='care_encounter_prescription_notes';
	var $fld_measure=array(
								'nr',
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
								
	var $fld_prescription=array(
								'nr',
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
								'color_marker',
								'is_current',
								'status',
								'history',
								'modify_id',
								'modify_time',
								'create_id',
								'create_time');
								
	var $fld_presc_notes=array(
								'nr',
								'date',
								'prescription_nr',
								'notes',
								'short_notes',
								'status',
								'history',
								'modify_id',
								'modify_time',
								'create_id',
								'create_time');
	
	function Charts(){
		$this->NursingNotes();
	}
	function _usePrescriptionTable(){
		$this->coretable=$this->tb_prescription;
		$this->ref_array=$this->fld_prescription;
	}
	function getDiagnosis($enr){
		if($this->_getNotes("encounter_nr=$enr AND type_nr=12","ORDER BY date,time")){
			return $this->result;
		}else{return false;}
	}
	function saveDiagnosisFromArray(&$data_array){
		//$this->setTable($this->tb_notes);
		$this->data_array=$data_array;
		//$this->setRefArray($this->fld_notes);
		if($this->_insertNotesFromInternalArray(12)){ // 12 = diagnosis text note type
			return true;
		}else{
			return false;
		}
	}
	function getChartNotes($enr,$type_nr){
		if($this->_getNotes("encounter_nr=$enr AND type_nr=$type_nr","ORDER BY date,time")){
			return $this->result;
		}else{return false;}
	}
	function saveChartNotesFromArray(&$data_array,$type_nr){
		//$this->setTable($this->tb_notes);
		$this->data_array=$data_array;
		//$this->setRefArray($this->fld_notes);
		if($this->_insertNotesFromInternalArray($type_nr)){ 
			return true;
		}else{
			return false;
		}
	}	
	function getDayChartNotes($enr,$type_nr,$date){
		if($this->_getNotes("encounter_nr=$enr AND type_nr=$type_nr AND date='$date'","ORDER BY modify_time DESC")){
			return $this->result;
		}else{return false;}
	}
	function _prepareSaveMeasurement(){
		global $HTTP_SESSION_VARS;
		$this->coretable=$this->tb_measure;
		$this->ref_array=$this->fld_measure;
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_time']='NULL';	
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
	}
	function saveBPFromArray(&$data){
		$this->data_array=$data;
		$this->_prepareSaveMeasurement();
		$this->data_array['msr_type_nr']=8;	 // 8 = bp composite type of measurement
		$this->data_array['unit_type_nr']=4;	 // 4 = pressure type of unit measurement
		//echo '<br>'.$this->data_array['msr_time'].' '.$this->data_array['value'].'<br>';
		if($this->insertDataFromInternalArray()){
			return true;
		}else{return false;}
	}
	function saveTemperatureFromArray(&$data){
		$this->data_array=$data;
		$this->_prepareSaveMeasurement();
		$this->data_array['msr_type_nr']=3;	 // 3 = temperature type of measurement
		$this->data_array['unit_type_nr']=5;	 // 5 = temperature type of unit measurement
		if($this->insertDataFromInternalArray()){
			return true;
		}else{return false;}
	}
	function getDayBP($enr,$date){
		global $db;
		$this->sql="SELECT * FROM $this->tb_measure WHERE encounter_nr=$enr AND msr_type_nr=8 AND msr_date='$date' ORDER BY msr_time";
		if($this->result=$db->Execute($this->sql)){
			return $this->result;
		}else{return false;}
	}
	function getDayTemperature($enr,$date){
		global $db;
		$this->sql="SELECT * FROM $this->tb_measure WHERE encounter_nr=$enr AND msr_type_nr=3 AND msr_date='$date' ORDER BY msr_time";
		if($this->result=$db->Execute($this->sql)){
			return $this->result;
		}else{return false;}
	}/**/
	function savePrescriptionFromArray(&$data){
		global $HTTP_SESSION_VARS;
		$this->_usePrescriptionTable();
		$this->data_array=$data;
		$this->data_array['prescribe_date']=date('Y-m-d');
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_time']='NULL';	
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		if($this->insertDataFromInternalArray()){
			return true;
		}else{return false;}
	}
	function updatePrescriptionFromArray($nr,&$data){
		global $HTTP_SESSION_VARS;
		$this->_usePrescriptionTable();
		$this->data_array=$data;
		if(isset($this->data_array['prescribe_date'])) unset($this->data_array['prescribe_date']);
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		if($this->updateDataFromInternalArray($nr)){
			return true;
		}else{return false;}
	}
	function EndPrescription($nr){
		global $HTTP_SESSION_VARS;
		$this->data_array=NULL;
		$this->_usePrescriptionTable();
		$this->data_array['is_stopped']=1;
		$this->data_array['stop_date']=date('Y-m-d');
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['history']="CONCAT(history,'Ended: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		if($this->updateDataFromInternalArray($nr)){
			return true;
		}else{return false;}
	}
	function getAllCurrentPrescription($enr){
		global $db;
		$this->sql="SELECT * FROM $this->tb_prescription WHERE encounter_nr=$enr AND NOT is_stopped ORDER BY nr";
		if($this->result=$db->Execute($this->sql)){
			return $this->result;
		}else{
			return false;
		}
	}
	function getDayPrescriptionNotes($enr,$date){
		global $db;
		$this->sql="SELECT m.*,n.nr AS notes_nr,n.short_notes AS day_notes 
							FROM $this->tb_prescription AS m LEFT JOIN $this->tb_presc_notes AS n ON m.nr=n.prescription_nr AND n.date='$date'
							WHERE m.encounter_nr=$enr AND NOT m.is_stopped";
		//echo $this->sql;
		if($this->result=$db->Execute($this->sql)){
			return $this->result;
		}else{
			return false;
		}
	}
	function savePrescriptionNotesFromArray(&$data){
		global $HTTP_SESSION_VARS;
		$this->data_array=$data;
		$this->coretable=$this->tb_presc_notes;
		$this->ref_array=$this->fld_presc_notes;
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_time']='NULL';	
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		if($this->insertDataFromInternalArray()){
			return true;
		}else{return false;}
	}
	function updatePrescriptionNotesFromArray($nr,&$data){
		global $HTTP_SESSION_VARS;
		$this->data_array=$data;
		$this->coretable=$this->tb_presc_notes;
		$this->ref_array=$this->fld_presc_notes;
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		if($this->updateDataFromInternalArray($nr)){
			return true;
		}else{return false;}
	}
	function _getChartDailyData($enr,$notes_id,$type_nr,$start,$end){
		global $db;
		$this->Notes(); // call constructor to set the table and field names
		$this->sql="SELECT date,$notes_id FROM $this->tb_notes WHERE encounter_nr=$enr AND type_nr=$type_nr AND date BETWEEN '$start' AND '$end' ORDER BY modify_time DESC";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			}else{return false;}
		}else{return false;}
	}
	function getChartDailyDietPlans($enr,$start,$end){
		if($this->_getChartDailyData($enr,'short_notes',23,$start,$end)){
			return $this->result;
		}else{return false;}
	}
	function getChartDailyMainNotes($enr,$start,$end){
		if($this->_getChartDailyData($enr,'notes',7,$start,$end)){
			return $this->result;
		}else{return false;}
	}
	function getChartDailyEtcNotes($enr,$start,$end){
		if($this->_getChartDailyData($enr,'notes',8,$start,$end)){
			return $this->result;
		}else{return false;}
	}
	function getChartDailyAnticoagNotes($enr,$start,$end){
		if($this->_getChartDailyData($enr,'short_notes',10,$start,$end)){
			return $this->result;
		}else{return false;}
	}
	function getChartDailyIVNotes($enr,$start,$end){
		if($this->_getChartDailyData($enr,'short_notes',9,$start,$end)){
			return $this->result;
		}else{return false;}
	}
	function getChartDailyPrescriptionNotes($enr,$start,$end){
		global $db;
		$this->sql="SELECT p.nr,n.date,n.short_notes,p.color_marker
						FROM $this->tb_prescription AS p
							LEFT JOIN $this->tb_presc_notes AS n  ON p.nr=n.prescription_nr  /* AND n.prescribed_date BETWEEN '$start' AND '$end' */
						 WHERE p.encounter_nr=$enr AND NOT p.is_stopped ORDER BY p.nr";
		if($this->result=$db->Execute($this->sql)){
			return $this->result;
		}else{ echo $this->sql;
			return false;
		}
	}

}
?>
