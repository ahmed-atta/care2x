<?php
/* API class for user configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_notes.php');

class Medocs extends Notes {
	# tables
	var $tb_medocs='care_type_feeding';
	var $tb_person='care_person';
	
	/**
	* Constructor
	*/
	function Medocs($nr=0){
		if($nr) $this->enc_nr=$nr;
		$this->coretable=$this->tb_medocs;
	}
	/** 
	* _getMedocsList() gets all medocs list based on the given number
	* private
	* @param $nr (int) = select number
	* @param $nr_type (str) = type of  $nr (_ENC = encounter nr, _REG = pid nr.)
	* return adodb record object
	*/
	function _getMedocsList($nr,$nr_type='_ENC'){
		global $db;
		# type nr 12 = diagnosis text notes
		if($nr_type=='_ENC'){
			$this->sql="SELECT n.nr,n.encounter_nr,n.date,n.time,n.notes,e.is_discharged  FROM   $this->tb_notes, $this->tb_enc AS e
				WHERE n.encounter_nr=".$nr." AND n.encounter_nr=e.encounter_nr AND n.type_nr=12 AND n.status NOT IN ($this->dead_stat)
				ORDER BY n.date DESC";
		}elseif($nr_type='_REG'){
			$this->sql="SELECT  n.nr,n.encounter_nr,n.date,n.time,n.notes,e.is_discharged  FROM $this->tb_person AS p, $this->tb_notes AS n, $this->tb_enc AS e
				WHERE p.pid=".$nr." AND e.pid=p.pid AND e.encounter_nr=n.encounter_nr AND n.type_nr=12 AND n.status NOT IN ($this->dead_stat)
				ORDER BY n.date DESC";
		}
		//echo $this->sql;
        if($this->res['_gmed']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gmed']->RecordCount()) {
				 return $this->res['_gmed'];	 
			} else { return false; }
		} else { return false; }
	}
	/** 
	* encMedocsList() gets all medocs records of an encounter nr
	* public
	* @param $enc_nr (int) = encounter number
	* return adodb record object
	*/
	function encMedocsList($nr){
		return $this->_getMedocsList($nr,'_ENC');
	}
	/** 
	* pidMedocsList() gets all medocs records of a person's pid nr
	* public
	* @param $pid (int) = pid number
	* return adodb record object
	*/
	function pidMedocsList($nr){
		return $this->_getMedocsList($nr,'_REG');
	}

}
?>
