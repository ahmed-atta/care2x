<?php
/* API class for appointment functions. Will be extended by other classes 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

require_once($root_path.'include/care_api_classes/class_core.php');

class Appointment extends Core {

    var $tb_appt='care_appointment';
	var $tb_person='care_person';
	var $pid;
	var $result;
	var $count;
	var $tabfields=array('nr',
									'pid',
									'date',
									'time',
									'to_dept_id',
									'to_dept_nr',
									'to_personell_nr',
									'to_personell_name',
									'purpose',
									'urgency',
									'remind',
									'remind_email',
									'remind_mail',
									'remind_phone',
									'appt_status',
									'cancel_by',
									'cancel_date',
									'cancel_reason',
									'encounter_class_nr',
									'encounter_nr',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	
	function Appointment($pid){
		if(!empty($pid)) $this->pid=$pid;
		$this->setTable($this->tb_appt);
		$this->setRefArray($this->tabfields);
	}
	
	function getAllObject($pid){
		return $this->getPersonsAppointmentsObj($pid);
	}
	function getAppointment($nr){
		global $db;
		if(empty($nr)) return false;
		if($this->result=$db->Execute("SELECT * FROM $this->tb_appt WHERE nr=$nr")){
			if($this->result->RecordCount()) return $this->result->FetchRow();
				else return false;
		}
	}
	function getPersonsAppointmentsObj($pid=''){
		global $db;
		if(empty($pid)) return false;
		if($this->result=$db->Execute("SELECT * FROM $this->tb_appt WHERE pid=$pid ORDER BY date DESC")){
			if($this->result->RecordCount()) return $this->result;
				else return false;
		}
	}
	/**
	* _getAll() is a private function that gets a list of appointments based on a condition
	* private
	* @param $y (int) the year
	* @param $m (int) the month
	* @param $d (int) the day
	* @param $by (str) the condition 
	* conditions '_DEPT' = by department nr, '_DOC' = by doctor, '_PRIO' = by priority
	* return adodb record object
	*/
	
	function _getAll($y=0,$m=0,$d=0,$by='',$val=''){
		global $db;
		# Set to defaults if empty
		if(!$y) $y=date('Y');
		if(!$m) $b=date('m');
		if(!$d) $d=date('d');
		$this->sql="SELECT a.*,p.name_last,p.name_first,p.date_birth,p.sex,p.death_date
				FROM $this->tb_appt AS a LEFT JOIN $this->tb_person AS p ON a.pid=p.pid
				WHERE a.date='$y-$m-$d'";
		switch($by){
			case '_DEPT': $this->sql.=" AND a.to_dept_nr=$val"; break;
			case '_DOC': $this->sql.=" AND a.to_personell_name  LIKE '%$val%'"; break;
		}
		$this->sql.=" AND a.status NOT IN ($this->dead_stat) ORDER BY a.date DESC";
		if($this->res['_ga']=$db->Execute($this->sql)){
			if($this->count=$this->res['_ga']->RecordCount()){
				return $this->res['_ga'];
			}else {return false;}
		}else {echo $this->sql; return false;}
	}
	/**
	* getAllByDateObj() gets all appointments by a given date
	* public
	* @param $y (int) the year
	* @param $m (int) the month
	* @param $d (int) the day
	* return adodb record object
	*/
	function getAllByDateObj($y=0,$m=0,$d=0){
		return $this->_getAll($y,$m,$d);
	}
	/**
	* getAllByDeptObj() gets all appointments by a given date and dept nr
	* public
	* @param $y (int) the year
	* @param $m (int) the month
	* @param $d (int) the day
	* @param $nr (int) department nr
	* return adodb record object
	*/
	function getAllByDeptObj($y=0,$m=0,$d=0,$nr){
		return $this->_getAll($y,$m,$d,'_DEPT',$nr);
	}
	/**
	* getAllByDocObj() gets all appointments by a given date and doctor's name
	* public
	* @param $y (int) the year
	* @param $m (int) the month
	* @param $d (int) the day
	* @param $doc (str) the doctors name
	* return adodb record object
	*/
	function getAllByDocObj($y=0,$m=0,$d=0,$doc){
		return $this->_getAll($y,$m,$d,'_DOC',$doc);
	}
	function cancelAppointment($nr='',$reason='',$by=''){	
		if(empty($nr)) return false;
		$buffer['history']="CONCAT(history,'Cancel: ".date('Y-m-d H:i:s')." : ".$by."\n')";
		$buffer['appt_status']='cancelled';
		$buffer['cancel_reason']=$reason;
		$this->setDataArray($buffer);
		$this->where=' nr='.$nr;
		if($this->updateDataFromInternalArray($nr)) {
			return true;
		}else return false;
	}
}
