<?php
/* API class for communication
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Comm extends Core {

	var $tb_phone='care_phone'; // table name
	var $fld_phone=array('item_nr',
									'title',
									'name',
									'vorname',
									'pid',
									'personell_nr',
									'dept_nr',
									'beruf',
									'bereich1',
									'bereich2',
									'inphone1',
									'inphone2',
									'inphone3',
									'exphone1',
									'exphone2',
									'funk1',
									'funk2',
									'room_nr',
									'date',
									'time',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Constructor, sets default table to care_phone (phone directory)
	*/				
	function Comm(){
		$this->setTable($this->tb_phone);
		$this->setRefArray($this->fld_phone);
	}
	/**
	* DeptInfoExists() checks whether the department's phone info if exists
	* public
	* @param $dept_nr (int) department number
	* @param $retinfo (bool) determines the return information
	* return: if param $retinfo is true (return phone info if dept info exists, else false)
	* return: if param $retinfo is false (return true if exists, else false)
	*/
	function DeptInfoExists($dept_nr,$retinfo=false){
		global $db;
		if($retinfo) $elems='*';
			else $elems='item_nr';
		$this->sql="SELECT $elems FROM $this->tb_phone WHERE dept_nr=$dept_nr";
        if($this->res['diex']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['diex']->RecordCount()) {
				 if($retinfo) return $this->res['diex'];
					else return true;
			} else { return false; }
		} else { return false; }
	}
	/**
	* DeptInfo() returns the department's phone info if exists
	* public
	* @param $dept_nr (int) department number
	* return: return phone info in row if dept info exists, else false
	*/
	function DeptInfo($dept_nr){
		if($arr=$this->DeptInfoExists($dept_nr,true))	return $arr->FetchRow();
			else return false;
	}
	
}
?>
