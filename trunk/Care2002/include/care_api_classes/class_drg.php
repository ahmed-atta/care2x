<?php
/**
* class DRG 
* DRG = Diagnosis related groups
* extends class Encounter
* methods for Diagnosis and Procedure codes (ICD and OPS)
* Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');
class DRG extends Encounter{

	/**
	* Table names related to this class
	*/
	var $tb_diagnosis='care_encounter_diagnosis';
	var $tb_procedure='care_encounter_procedure';
	var $tb_localcode='care_diagnosis_localcode';
	var $tb_intern='care_drg_ops_intern';
	var $tb_qlist='care_drg_quicklist';
	var $tb_related='care_drg_related_codes';		
	var $tb_cat_diag='care_category_diagnosis';
	var $tb_type_loc='care_type_localization';
	
	/**
	* Fields names of related tables
	*/
	var $fld_diagnosis=array(
			'diagnosis_nr',
			'encounter_nr',
			'date',
			'code',
			'code_parent',
			'code_version',
			'localcode',
			'category_nr',
			'type',
			'localization',
			'diagnosing_clinician',
			'diagnosing_dept_nr',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
			
	var $fld_procedure=array(
			'procedure_nr',
			'encounter_nr',
			'date',
			'code',
			'code_parent',
			'code_version',
			'localcode',
			'category_nr',
			'localization',
			'responsible_clinician',
			'responsible_dept_nr',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');

	var $icd_version='10'; // default ICD version nr.
	var $ops_version='301'; // default OPS version nr.
	
	/**
	* source code table names
	*/
	var $tb_diag_codes;
	var $tb_proc_codes;
				
	/**
	* Constructor
	*/
	function DRG($enc_nr=0){
		global $lang;
		$this->enc_nr=$enc_nr;
		$this->coretable=$this->tb_diagnosis;
		$this->ref_array=$this->fld_diagnosis;
		$this->tb_diag_codes='care_icd'.$this->icd_version.'_'.$lang; // construct the code source table e.g. "care_icd10_en"
		//$this->tb_proc_codes='care_ops'.$this->ops_version.'_'.$lang; // construct the procedure source table e.g. "care_ops302_en"
		$this->tb_proc_codes='care_ops'.$this->ops_version.'_de'; // construct the procedure source table "care_ops302_de" because it is the only available
	}
	/**
	* Sets the core object to point to the diagnosis tables and fields
	* public
	* return void
	*/
	function useDiagnosis(){
		$this->coretable=$this->tb_diagnosis;
		$this->ref_array=$this->fld_diagnosis;
	}
	/**
	* Sets the core object to point to the procedure tables and fields
	* public
	* return void
	*/
	function useProcedure(){
		$this->coretable=$this->tb_procedure;
		$this->ref_array=$this->fld_procedure;
	}
	/**
	* Returns the ICD code version (Diagnosis codes)
	* public
	*/
	function ICDVersion(){
		return $this->icd_version;
	}
	/**
	* Returns the OPD code version (Procedure codes)
	* public
	*/
	function OPSVersion(){
		return $this->ops_version;
	}
	/**
	* Gets the diagnosis codes of an encounter
	* @param $enc_nr (int) = encounter number
	* return ADODB record set
	*/
	function DiagnosisCodes($enc_nr=0){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT d.*,c.description , m.description AS parent_desc
							FROM (
										$this->tb_diagnosis AS d,
										 $this->tb_diag_codes AS c
									)
									 LEFT JOIN $this->tb_diag_codes AS m ON d.code_parent=m.diagnosis_code
									 WHERE d.encounter_nr=$this->enc_nr 
									 	AND d.status NOT IN ($this->dead_stat)
										AND  d.code=c.diagnosis_code ORDER BY d.category_nr,d.date";
		//echo $this->sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* Gets the procedure codes of an encounter
	* @param $enc_nr (int) = encounter number
	* return ADODB record set
	*/
	function ProcedureCodes($enc_nr=0){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT p.*, c.description, m.description AS parent_desc
							FROM (
										$this->tb_procedure AS p,
									 	$this->tb_proc_codes AS c
									)
									 LEFT JOIN $this->tb_proc_codes AS m ON p.code_parent=m.code
									 WHERE p.encounter_nr=$this->enc_nr 
									 	AND p.status NOT IN ($this->dead_stat)
										AND  p.code=c.code ORDER BY p.category_nr,p.date";
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* "Deletes" a diagnosis code entry
	* public
	* The entry is actually not deleted from the table but its status is set to "deleted"
	* @param $diag_nr (int) = the diagnosis number entry
	* return true/false
	*/
	function deleteDiagnosis($diag_nr=0){
	    global $db, $HTTP_SESSION_VARS;
		if(!$diag_nr) return false;
		$this->sql="UPDATE $this->tb_diagnosis 
						SET status='deleted',history=CONCAT(history,'Delete ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						 WHERE diagnosis_nr=$diag_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* "Deletes" a procedure code entry
	* public
	* The entry is actually not deleted from the table but its status is set to "deleted"
	* @param $proc_nr (int) = the procedure number entry
	* return true/false
	*/
	function deleteProcedure($proc_nr=0){
	    global $db, $HTTP_SESSION_VARS;
		if(!$proc_nr) return false;
		$this->sql="UPDATE $this->tb_procedure 
						SET status='deleted',
						history=CONCAT(history,'Delete ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						 WHERE procedure_nr=$proc_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Sets the category of the diagnosis
	* public
	* @param $enc_nr (int) = the encounter number
	* @param $diag_nr (int) = the diagnosis number entry
	* @param $cat (char) = the category code/id
	* return true/false
	*/
	function setDiagnosisCategory($enc_nr,$diag_nr=0,$cat_nr=0){
	    global $db, $HTTP_SESSION_VARS;
		if(!$diag_nr||!$cat_nr) return false;
		// If the new category is most responsible  (1), change the possible current most responsible diagnosis to associated (2)
		if($cat_nr==1){
			$this->sql="UPDATE $this->tb_diagnosis 
							SET category_nr='2',
							history=CONCAT(history,'Reset main category ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')
							 WHERE encounter_nr=$enc_nr AND category_nr='1'";
			$this->Transact($this->sql);
		}
		$this->sql="UPDATE $this->tb_diagnosis 
						SET category_nr='$cat_nr',
						history=CONCAT(history,'Set category ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						 WHERE diagnosis_nr=$diag_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Sets the localization  of the diagnosis
	* public
	* @param $diag_nr (int) = the diagnosis number entry
	* @param $loc (char) = the localization code/id
	* return true/false
	*/
	function setDiagnosisLocalization($diag_nr=0,$loc=''){
	    global $db, $HTTP_SESSION_VARS;
		if(!$diag_nr||empty($loc)) return false;
		$this->sql="UPDATE $this->tb_diagnosis 
						SET localization='$loc',
						history=CONCAT(history,'Set Localization ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						WHERE diagnosis_nr=$diag_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Sets the category of the procedure
	* public
	* @param $enc_nr (int) = the encounter number
	* @param $diag_nr (int) = the diagnosis number entry
	* @param $cat (char) = the category code/id
	* return true/false
	*/
	function setProcedureCategory($enc_nr,$proc_nr=0,$cat_nr=0){
	    global $db, $HTTP_SESSION_VARS;
		if(!$proc_nr||!$cat_nr) return false;
		// If the new category is most responsible  (1), change the possible current most responsible diagnosis to associated (2)
		if($cat_nr==1){
			$this->sql="UPDATE $this->tb_procedure 
							SET category_nr='2',history=CONCAT(history,'Reset main category ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')
							 WHERE encounter_nr=$enc_nr AND category_nr='1'";
			$this->Transact($this->sql);
		}
		$this->sql="UPDATE $this->tb_procedure 
						SET category_nr='$cat_nr',
						history=CONCAT(history,'Set category ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						 WHERE procedure_nr=$proc_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Sets the localization  of the procedure
	* public
	* @param $diag_nr (int) = the procedure number entry
	* @param $loc (char) = the localization code/id
	* return true/false
	*/
	function setProcedureLocalization($proc_nr=0,$loc=''){
	    global $db, $HTTP_SESSION_VARS;
		if(!$proc_nr||empty($loc)) return false;
		$this->sql="UPDATE $this->tb_procedure 
						SET localization='$loc',
						history=CONCAT(history,'Set Localization ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						WHERE procedure_nr=$proc_nr";
		//echo $sql;
		return $this->Transact($this->sql);
	}
	/**
	* Gets the diagsnosis categories
	* return ADODB record object
	*/
	function DiagnosisCategories(){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_cat_diag WHERE status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* Gets the localization types
	* return ADODB record object
	*/
	function LocalizationTypes(){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_type_loc WHERE status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
}
