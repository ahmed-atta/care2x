<?php
/**
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');

/**
*  Appointment methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Elpidio Latorilla
* @version deployment 1.1 (mysql) 2004-01-11
* @copyright 2002,2003,2004 Elpidio Latorilla
* @package care_api
*/
class Appointment extends Core {
	/**
	* Database table for the appointment data.
	* @var string
	*/
    var $tb_appt='care_appointment';
	/**
	* Database table for the person data.
	* @var string
	*/
	var $tb_person='care_person';
		/** INSERITO DA NOI
	* Database table for the encounter data.
	* @var string
	*/
	var $tb_encounter='care_encounter';
	/**
	* Person ID
	* @var int
	*/
	var $pid;
	/**
	* SQL query result. Resulting ADODB record object.
	* @var object
	*/
	var $result;
	/**
	* Resulting record count
	* @var int
	*/
	var $count;
	/**
	* Fieldnames of the care_appointment table.
	* @var array
	*/
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
									
	/**
	* Constructor
	* @param int Person ID
	*/
	function Appointment($pid){
		if(!empty($pid)) $this->pid=$pid;
		$this->setTable($this->tb_appt);
		$this->setRefArray($this->tabfields);
	}
	/**
	* Gets  person's appointment data based on his pid key. 
	* Returns an ADODB record object or boolean. The return adodb record contains rows of associative array
	* with index keys corresponding to fieldnames in the $tabfields array.
	*
	* For example:
	* <code>
	* $obj->getPersonsAppointmentObj(100033344);
	* $row=$obj->FetchRow();
	* echo $row['purpose']; # Displays the appointment purpose
	* </code>
	*
	* @param int Person ID
	* @return mixed
	*/
	function getPersonsAppointmentsObj($pid=''){
		global $db;
		if(empty($pid)) return false;
		if($this->result=$db->Execute("SELECT * FROM $this->tb_appt WHERE pid=$pid ORDER BY date DESC, time ASC")){
			if($this->result->RecordCount()) return $this->result;
				else return false;
		}
	}
	/**
	* Alias of getPersonsAppointmentObj()
	* @param int Person ID
	* @return mixed
	*/
	function getAllObject($pid){
		return $this->getPersonsAppointmentsObj($pid);
	}
	/**
	* Gets  appointment data based on primary record key "nr". 
	* Returns  array or boolean. The returned array has index keys corresponding to fieldnames in the $tabfields array.
	*
	* For example:
	* <code>
	* $row=$obj->getAppointment(155);
	* echo $row['purpose']; # Displays the appointment purpose
	* </code>
	*
	* @param int Record number
	* @return mixed
	*/
	function getAppointment($nr){
		global $db;
		if(empty($nr)) return false;
		if($this->result=$db->Execute("SELECT * FROM $this->tb_appt WHERE nr=$nr ORDER BY time ASC")){
			if($this->result->RecordCount()) return $this->result->FetchRow();
				else return false;
		}
	}
	/**
	* Gets a list of appointments based on a constraint type.
	* Constraint types are: 
	* -  '_DEPT' = by department nr
	* -  '_DOC' = by doctor
	* - '_PRIO' =  by priority
	*
	* @access private
	* @param int Year of appointment
	* @param int Month of appointment
	* @param int Day of appointment
	* @param string Condition
	* @param string Value of constraint.
	* @return mixed adodb record object or boolean
	*/
	function _getAll($y=0,$m=0,$d=0,$by='',$val='', $val2='',$sort=''){
		global $db;
		# Set to defaults if empty
		if(!$y) $y=date('Y');
		if(!$m) $b=date('m');
		if(!$d) $d=date('d');
		$this->sql="SELECT DISTINCT a.*,p.name_last,p.name_first,p.date_birth,p.sex,p.death_date
				FROM ($this->tb_appt AS a LEFT JOIN $this->tb_person AS p ON a.pid=p.pid) LEFT JOIN care_encounter AS e ON e.pid=a.pid
				WHERE a.date='$y-$m-$d'";
		switch($by){
			case '_DEPT': $this->sql.=" AND a.to_dept_nr=$val "; break;
			case '_DOC': $this->sql.=" AND a.to_personell_name  LIKE '%$val%' "; break;
			###MODIFICATO DA NOI PER SEMPLIFICARCI LA VITA NEL FILTRAGGIO PRIVATI ATLETI
			case '_QUA': $this->sql.=" AND e.insurance_firm_id=$val"; break;
			//case '_DUE': $this->sql.=" AND a.to_dept_id LIKE '%$val%' AND a.to_dept_nr=$val2 "; break;
			case '_DEPT_AND_QUA': $this->sql.=" AND e.insurance_firm_id=$val2 AND a.to_dept_nr=$val"; break;
			case '_DEPT_AND_NOT_QUA': $this->sql.=" AND a.to_dept_nr=$val AND  (e.insurance_firm_id=1 OR e.insurance_firm_id=10 OR e.insurance_firm_id=11 OR e.insurance_firm_id=12)"; break;
			###SERVE A CARICARE CHI NON E' UN ATLETA I.N. o P.O.
			case '_QUA2': $this->sql.=" AND  (e.insurance_firm_id=1 OR e.insurance_firm_id=10 OR e.insurance_firm_id=11 OR e.insurance_firm_id=12)"; break;
		}
		#MODIFICATO PER IMPOSTARE L'ORDINAMENTO
		#$this->sql.=" AND a.status NOT IN ($this->dead_stat) ORDER BY  p.name_last ASC, a.date DESC, a.time ASC";
				
		switch(trim($sort)){
			case 'ora': #ORDINA PER DATA
				$this->sql.=" AND a.status NOT IN ($this->dead_stat) ORDER BY  a.time ASC";
				break;
			case 'cognome': #ORDINA PER COGNOME E POI DATA
				$this->sql.=" AND a.status NOT IN ($this->dead_stat) ORDER BY  p.name_last ASC, a.date DESC, a.time ASC";
				break;
			case '':#CASO GENERALE X ORA IDENTICO AL CASO cognome 
				$this->sql.=" AND a.status NOT IN ($this->dead_stat) ORDER BY  p.name_last ASC, a.date DESC, a.time ASC";
				break;
			
		}
		
		
		if($this->res['_ga']=$db->Execute($this->sql)){
			if($this->count=$this->res['_ga']->RecordCount()){
				return $this->res['_ga'];
			}else {return false;}
		}else {echo $this->sql; return false;}
	}
	/**
	* Gets all appointments by a given date.
	* Returns an adodb record object or boolean.
	*
	* For example:
	* <code>
	* $obj->getAllByDateObj(2003,12,1);
	* while($row=$obj->FetchRow()){
	* 	echo $row['purpose']; # Displays the appointment purpose
	* }
	* </code>
	*
	* @access public
	* @param int Year of appointment
	* @param int Month of appointment
	* @param int Day of appointment
	* @return mixed
	*/
	function getAllByDateObj($y=0,$m=0,$d=0,$sort=''){
		return $this->_getAll($y,$m,$d,'','','',$sort);
	}
	/**
	* Gets all appointments by a given date and department number.
	* Returns an adodb record object or boolean.
	*
	* For example:
	* <code>
	* $dept_nr=13
	* $obj->getAllByDeptObj(2003,12,1,$dept_nr);
	* while($row=$obj->FetchRow()){
	* 	echo $row['purpose']; # Displays the appointment purpose
	* }
	* </code>
	*
	* @access public
	* @param int Year of appointment
	* @param int Month of appointment
	* @param int Day of appointment
	* @param int Department number
	* @return mixed
	*/
	function getAllByDeptObj($y=0,$m=0,$d=0,$nr,$sort=''){
		return $this->_getAll($y,$m,$d,'_DEPT',$nr,'',$sort);
	}
	/**
	* Gets all appointments by a given date and doctor's name.
	* Returns an adodb record object or boolean.
	*
	* For example:
	* <code>
	* $doctor='Whitbey';
	* $obj->getAllByDocObj(2003,12,1,$doctor);
	* while($row=$obj->FetchRow()){
	* 	echo $row['purpose']; # Displays the appointment purpose
	* }
	* </code>
	*
	* @access public
	* @param int Year of appointment
	* @param int Month of appointment
	* @param int Day of appointment
	* @param string Doctor's name
	* @return mixed
	*/
	function getAllByDocObj($y=0,$m=0,$d=0,$doc,$sort=''){
		return $this->_getAll($y,$m,$d,'_DOC',$doc,'',$sort);
	}
	/**
	* Cancels an appointment based on the primary record key "nr".
	* The cancel reason and name of person who made the cancellation can be passed.
	* @param int Appointment record number
	* @param string Reason of cancellation
	* @param string Person who made the cancellation
	* @return boolean
	*/
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
	function getAllByQuaObj($y=0,$m=0,$d=0,$qua,$sort=''){
		return $this->_getAll($y,$m,$d,'_QUA',$qua,'' ,$sort);
	}
	function getAllByNonQuaObj($y=0,$m=0,$d=0,$sort=''){
		return $this->_getAll($y,$m,$d,'_QUA2','','',$sort);
	}
	function getAllByDeptandQuaObj($y=0,$m=0,$d=0,$dept,$val,$sort=''){
		return $this->_getAll($y,$m,$d,'_DEPT_AND_QUA',$dept, $val,$sort);
	}
function getAllByDeptandNotQuaObj($y=0,$m=0,$d=0,$dept,$sort=''){
		return $this->_getAll($y,$m,$d,'_DEPT_AND_NOT_QUA',$dept,'',$sort);
	}
	}
