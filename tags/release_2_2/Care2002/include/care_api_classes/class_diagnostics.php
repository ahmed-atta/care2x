<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Diagnostics.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Diagnostics extends Core {
	/**
	* Table name for chemical lab test request
	* @var string
	*/
    var $tb_req_chem='care_test_request_chemlabor';
	/**
	* Table name for bacteriology lab test request
	* @var string
	*/
    var $tb_req_bac='care_test_request_baclabor';
	/**
	* Table name for blood bank request
	* @var string
	*/
    var $tb_req_blood='care_test_request_blood';
	/**
	* Table name for generic request form
	* @var string
	*/
    var $tb_req_generic='care_test_request_generic';
	/**
	* Table name for pathology lab test request
	* @var string
	*/
    var $tb_req_patho='care_test_request_patho';
	/**
	* Table name for radiology test request
	* @var string
	*/
    var $tb_req_radio='care_test_request_radio';
	/**
	* Holder for sql query results.
	* @var object adodb record object
	*/
	var $result;
	/**
	* Field names of care_test_request_chemlabor
	* @var array
	*/
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
	/**
	* Sets the core to point to the care_test_request_chemlabor table
	* @access public
	*/
	function useChemLabRequestTable(){
		$this->setTable($this->tb_req_chem);
		$this->setRefArray($this->chemlabor);
	}			
	/**
	* Sets the core to point to the a care_test_request_????? table.
	* The ????? is replaced with string passed as parameter.
	* @access public
	* @param string The string to append to "care_test_request_" to create a complete table name.
	*/
	function useRequestTable($index){
		$this->setTable('care_test_request_'.$index);
		$this->setRefArray($this->$index);
	}
	/**
	* Sets the "where" variable of the core class.
	* The passed condition will be used in the WHERE part of the sql query.
	* @access public
	* @param string The string to append to "care_test_request_" to create a complete table name.
	*/
	function setWhereCond($cond){
		$this->where=$cond;
	}
}
