<?php
/* API class for diagnostics functions. Will be extended by other classes 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

require_once($root_path.'include/care_api_classes/class_core.php');

class Diagnostics extends Core {

    var $tb_req_chem='care_test_request_chemlabor';
    var $tb_req_bac='care_test_request_baclabor';
    var $tb_req_blood='care_test_request_blood';
    var $tb_req_generic='care_test_request_generic';
    var $tb_req_patho='care_test_request_patho';
    var $tb_req_radio='care_test_request_radio';
	var $result;
	var $chemlabor=array('batch_nr',
									'encounter_nr',
									'room_nr',
									'dept_nr',
									'parameters',
									'doctor_sign',
									'highrisk',
									'notes',
									'send_date',
									'sample_time',
									'sample_weekday',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function useChemLabRequestTable(){
		$this->setTable($this->tb_req_chem);
		$this->setRefArray($this->chemlabor);
	}			
	function useRequestTable($index){
		$this->setTable('care_test_request_'.$index);
		$this->setRefArray($this->$index);
	}
	function setWhereCond($cond){
		$this->where=$cond;
	}
}
