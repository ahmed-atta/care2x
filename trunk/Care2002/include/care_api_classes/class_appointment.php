<?php
/* API class for appointment functions. Will be extended by other classes 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/

require_once($root_path.'include/care_api_classes/class_core.php');

class Appointment extends Core {

    var $tb='care_appointment';
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
									'encounter_class',
									'encounter_nr',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	
	function Appointment($pid){
		if(!empty($pid)) $this->pid=$pid;
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	
	function getAllObject($pid){
		return $this->getPersonsAppointmentsObj($pid);
	}
	function getAppointment($nr){
		global $db;
		if(empty($nr)) return false;
		if($this->result=$db->Execute("SELECT * FROM $this->tb WHERE nr=$nr")){
			if($this->result->RecordCount()) return $this->result->FetchRow();
				else return false;
		}
	}
	function getPersonsAppointmentsObj($pid=''){
		global $db;
		if(empty($pid)) return false;
		if($this->result=$db->Execute("SELECT * FROM $this->tb WHERE pid=$pid ORDER BY date DESC")){
			if($this->result->RecordCount()) return $this->result;
				else return false;
		}
	}
	function getAllByDateObj($y='',$m='',$d=''){
		global $db;
		if(empty($y)) $y=date('Y');
		if(empty($m)) $y=date('m');
		if(empty($d)) $y=date('d');
		$sql="SELECT a.*,p.name_last,p.name_first,p.date_birth 
				FROM $this->tb AS a LEFT JOIN $this->tb_person AS p ON a.pid=p.pid
				WHERE a.date='$y-$m-$d' ORDER BY a.date DESC";
		if($this->result=$db->Execute($sql)){
			if($this->count=$this->result->RecordCount()) return $this->result;
				else {return false;}
		}else {echo $sql; return false;}
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
