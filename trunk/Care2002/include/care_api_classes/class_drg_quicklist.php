<?php
/**
* Quicklist Class
* extends DRG class
*/
require_once($root_path.'include/care_api_classes/class_drg.php');

class Quicklist extends DRG{
	
	/**
	* Table name
	*/
	var $tb_qlist='care_drg_quicklist';
	
	var $dept_nr;
	
	/**
	* Tables fields
	*/
	var $fld_qlist=array(
				'nr',
				'code',
				'dept_nr',
				'type',
				'rank',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time');
				
	/**
	* Constructor
	*/
	function Quicklist($enc_nr,$dept_nr){
		$this->enc_nr=$enc_nr;
		$this->dept_nr=$dept_nr;
		$this->DRG($enc_nr);
	}
	/**
	* internResolveDeptNr() tries to get the encounter number
	* @param $enc_nr (int) = encounter number
	* returns encouter number/true/false
	*/
	function internResolveDeptNr($dept_nr='') {
	    if (empty($dept_nr)) {
		    if(empty($this->dept_nr)) {
			    return false;
			} else { return true; }
		} else {
		     $this->dept_nr=$dept_nr;
			return true;
		}
	}
	/**
	* DeptQuicklist() returns the quicklist code items of a department
	* @param $dept_nr (int) = department number
	* @param $type = quicklist items type (drg_intern, diagnosis, procedure)
	* return ADODB record set
	*/
	function DeptQuicklist($type='',$dept_nr=0){
		global $db;
		//if(!$this->internResolveDeptNr($dept_nr)||empty($type)) return false;
		$this->dept_nr=1;
		switch($type){
			case 'drg_intern':
			{
				$cond=", d.nr, d.description FROM $this->tb_qlist AS q  LEFT JOIN $this->tb_drg AS d ON q.code=d.code";
				break;
			}
			case 'diagnosis':
			{
				$cond=", d.diagnosis_code AS nr, d.description, p.description AS parent_desc FROM $this->tb_qlist AS q  
								LEFT JOIN $this->tb_diag_codes AS d ON q.code=d.diagnosis_code
								LEFT JOIN $this->tb_diag_codes AS p ON q.code_parent=p.diagnosis_code";
				break;
			}
			case 'procedure':
			{
				$cond=", d.code AS nr, d.description, p.description AS parent_desc FROM $this->tb_qlist AS q  
								LEFT JOIN $this->tb_proc_codes AS d ON q.code=d.code
								LEFT JOIN $this->tb_proc_codes AS p ON q.code_parent=p.code";
				break;
			}
			//default: return false;
		}
		$this->sql="SELECT q.code,q.code_parent $cond WHERE q.dept_nr=$this->dept_nr AND q.qlist_type='$type' ORDER BY q.rank DESC";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()){
				return $this->result;
		    }else{return false;}
		}else{return false;}
	}
	/**
	* QuickCodeExists() checks if the code exists in the quicklist
	* @param $code (string) = code
	* return record entry number if exist, else false
	*/
	function QuickCodeExists($code=0){
		if(!$code) return false;
		$this->sql="SELECT nr FROM $this->tb_qlist WHERE code='$code'";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()){
				$row=$this->result->FetchRow();
				return $row['nr'];
		    }else{return false;}
		}else{return false;}
	}
	/**
	* upRank($step=1) increases the ranking of the code in the quicklist by $step value
	* @param $code (str) = the code
	* @param $step (int) = increase step (default =1)
	* return true/false
	*/
	function upRank($code=0,$step=1){
		if(!$code) return false;
		$this->sql="UPDATE $this->tb_qlist SET rank=(rank+$step) WHERE code=$code";
		return $this->Transact($this->sql);
	}
}
