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
	var $tb_cat_proc='care_category_procedure';
	var $tb_type_loc='care_type_localization';
	var $tb_enc_drg='care_encounter_drg_intern';
	var $tb_drg='care_drg_intern';
	var $tb_qlist='care_drg_quicklist';
	
	var $dept_nr;
	
	/**
	* Limits the select output
	 */
	var $sel_limit=50;
					
	/**
	* Fields names of related tables
	*/
	var $fld_diagnosis=array(
			'diagnosis_nr',
			'encounter_nr',
			'op_nr',
			'date',
			'code',
			'code_parent',
			'group_nr',
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
			'op_nr',
			'date',
			'code',
			'code_parent',
			'group_nr',
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
			
	var $fld_enc_drg=array(
			'nr',
			'encounter_nr',
			'date',
			'group_nr',
			'clinician',
			'dept_nr',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
			
	var $fld_drg=array(
			'nr',
			'code',
			'description',
			'synonyms',
			'notes',
			'std_code',
			'sub_level',
			'parent_code',
			'status',
			'history',
			'modify_id',
			'modify_time',
			'create_id',
			'create_time');
			
	var $fld_qlist=array(
				'nr',
				'code',
				'code_parent',
				'dept_nr',
				'qlist_type',
				'rank',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time');

	var $icd_version='10'; // default ICD version nr.
	var $ops_version='301'; // default OPS/ICPM version nr.
	
	/**
	* source code table names
	*/
	var $tb_diag_codes;
	var $tb_proc_codes;
	
	/**
	* Default tables. The default table must be existing in your database!
	*/
	var $tb_icd_default='care_icd10_en';
	var $tb_icpm_default='care_ops301_de';
	/**
	* Language codes that have corresponding tables
	*/
	var $tb_lang_icd='en,de';
	var $tb_lang_icpm='de';
	
	/**
	* Constructor
	*/
	function DRG($enc_nr=0,$dept_nr){
		global $lang;
		$this->enc_nr=$enc_nr;
		$this->dept_nr=$dept_nr;
		$this->coretable=$this->tb_diagnosis;
		$this->ref_array=$this->fld_diagnosis;
		# Check if language has a corresponding table. if not use default table
		if(stristr($this->tb_lang_icd,$lang)){
			$this->tb_diag_codes='care_icd'.$this->icd_version.'_'.$lang; # construct the code source table e.g. "care_icd10_en"
		}else{
			$this->tb_diag_codes=$this->tb_icd_default;
		}
		if(stristr($this->tb_lang_icpm,$lang)){
			$this->tb_proc_codes='care_ops'.$this->ops_version.'_'.$lang; # construct the code source table e.g. "care_icd10_en"
		}else{
			$this->tb_proc_codes=$this->tb_icpm_default;
		}
		//$this->tb_proc_codes='care_ops'.$this->ops_version.'_'.$lang; // construct the procedure source table e.g. "care_ops302_en"
		$this->tb_proc_codes='care_ops'.$this->ops_version.'_de'; # construct the procedure source table "care_ops302_de" because it is the only available
	}
	/**
	* Sets the core object to point to the encounter's diagnosis (care_encounter_diagnosis) table and fields
	* public
	* return void
	*/
	function useDiagnosis(){
		$this->coretable=$this->tb_diagnosis;
		$this->ref_array=$this->fld_diagnosis;
	}
	/**
	* Sets the core object to point to the encounter's procedure (care_encounter_procedure) table and fields
	* public
	* return void
	*/
	function useProcedure(){
		$this->coretable=$this->tb_procedure;
		$this->ref_array=$this->fld_procedure;
	}
	/**
	* Sets the core object to point to the local encounter DRG groups (care_encounter_drg_intern) table and fields
	* public
	* return void
	*/
	function useInternalDRG(){
		$this->coretable=$this->tb_enc_drg;
		$this->ref_array=$this->fld_enc_drg;
	}
	/**
	* Sets the core object to point to the internal DRG groups (care_drg_intern) table and fields
	* public
	* return void
	*/
	function useInternalDRGCodes(){
		$this->coretable=$this->tb_drg;
		$this->ref_array=$this->fld_drg;
	}
	/**
	* Sets the core object to point to the quick list (care_drg_quicklist) table and fields
	* public
	* return void
	*/
	function useQuicklistCodes(){
		$this->coretable=$this->tb_qlist;
		$this->ref_array=$this->fld_qlist;
	}
	/**
	* Returns the ICD code version (Diagnosis codes)
	* public
	*/
	function ICDVersion(){
		return $this->icd_version;
	}
	/**
	* Returns the OPS code version (Procedure codes)
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
	function DiagnosisCodes($grp_nr=0,$enc_nr=0){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT d.*,c.description , m.description AS parent_desc,
								cat.LD_var AS cat_LD_var, cat.LD_var_short_code AS cat_LD_var_short_code, cat.short_code AS cat_short_code, cat.name AS cat_name,
								loc.LD_var AS loc_LD_var, loc.LD_var_short_code AS loc_LD_var_short_code, loc.short_code AS loc_short_code,loc.name AS loc_name
							FROM 	$this->tb_diagnosis AS d
									LEFT JOIN $this->tb_diag_codes AS c ON d.code=c.diagnosis_code
									 LEFT JOIN $this->tb_diag_codes AS m ON d.code_parent=m.diagnosis_code AND d.code_parent NOT IN ('',' ')
									 LEFT JOIN $this->tb_cat_diag AS cat ON d.category_nr=cat.nr
									 LEFT JOIN $this->tb_type_loc AS loc ON d.localization=loc.nr
									 WHERE d.encounter_nr=$this->enc_nr 
									 	AND d.group_nr=$grp_nr
									 	AND d.status NOT IN ($this->dead_stat)
										ORDER BY d.category_nr,d.date";
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
	function ProcedureCodes($grp_nr=0,$enc_nr=0){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT p.*, c.description, m.description AS parent_desc
							FROM (
										$this->tb_procedure AS p,
									 	$this->tb_proc_codes AS c
									)
									 LEFT JOIN $this->tb_proc_codes AS m ON p.code_parent=m.code
									 WHERE p.encounter_nr=$this->enc_nr 
									 	AND p.group_nr=$grp_nr
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
	* Gets the internal DRG groups of an encounter
	* public
	* @param $enc_nr (int) = encounter number
	* return ADODB record set
	*/
	function InternDRGGroups($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT e.*, d.code,d.description,d.notes
							FROM (
										$this->tb_enc_drg AS e,
									 	$this->tb_drg AS d
									)								 
									 WHERE e.encounter_nr=$this->enc_nr 
									 	AND e.status NOT IN ($this->dead_stat)
										AND  e.group_nr=d.nr ORDER BY e.date";
		//echo $this->sql;
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
	* "Deletes" an internal DRG group number entry from the encounter
	* public
	* The entry is actually not deleted from the table but its status is set to "deleted"
	* @param $drg_nr (int) = the drg group  entry
	* return true/false
	*/
	function deleteEncounterDRGGroup($drg_nr=0){
	    global $db, $HTTP_SESSION_VARS;
		if(!$drg_nr) return false;
		$this->sql="UPDATE $this->tb_enc_drg 
						SET status='deleted',
						history=CONCAT(history,'Delete ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						 WHERE nr=$drg_nr";
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
	* Gets the procedure categories
	* return ADODB record object
	*/
	function ProcedureCategories(){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_cat_proc WHERE status NOT IN ($this->dead_stat)";
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
	/**
	* nongroupedDiagnosis() checks if non grouped encounter diagnosis entries  exist
	* @param $enc_nr (int) = encounter number
	*/
	function nongroupedDiagnosisExists($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT diagnosis_nr FROM $this->tb_diagnosis WHERE encounter_nr=$this->enc_nr AND group_nr=0 AND status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return true;
		    } else {return false;}
		} else {return false;}
	}
	/**
	* nongroupedProcedure() checks if non grouped encounter procedure entries  exist
	* @param $enc_nr (int) = encounter number
	*/
	function nongroupedProcedureExists($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT procedure_nr FROM $this->tb_procedure WHERE encounter_nr=$this->enc_nr AND NOT group_nr  AND status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return true;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* searchGroup() searches for a local  DRG group code
	* @param $key (mixed) = the search key
	* return ADODB record object if search finds result, false otherwise
	*/
	function searchGroup($key,$order='description'){
	    global $db;
		if(strlen($key)<3) $this->sql="SELECT nr,code,description FROM $this->tb_drg WHERE code LIKE '$key%' OR description LIKE '$key%'";
			else $this->sql="SELECT nr,code,description FROM $this->tb_drg WHERE code LIKE '%$key%' OR description LIKE '%$key%'";
		$this->sql.=" ORDER BY $order";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    }else{
				$this->sql="SELECT nr,code,description FROM $this->tb_drg WHERE synonyms LIKE '%$key%' ORDER BY $order";
				if($this->result=$db->Execute($this->sql)) {
		    		if($this->result->RecordCount()) {
						return $this->result;
					}else{return false;}
				}else{return false;}
			}
		}else{return false;}
	}
	/**
	* EncounterDRGGroupExists() checks if the local  DRG group exists for the encounter
	* @param $group_nr (int) = the group number to be checked
	* @param $enc_nr (int) = encounter number
	*/
	function EncounterDRGGroupExists($grp_nr,$enc_nr=0){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT nr FROM $this->tb_enc_drg WHERE encounter_nr=$this->enc_nr AND group_nr=$grp_nr AND status NOT IN ($this->dead_stat)";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()){
				return true;
		    }else{return false;}
		}else{return false;}
	}
	/**
	* groupNonGroupedItems() sets the group number of all non-grouped diagnosis and procedure entries of an encounter
	* public
	* @param $grp_nr (int) = group number
	* @param $enc_nr (int) = encounter number
	* return true/false
	*/
	function groupNonGroupedItems($grp_nr,$enc_nr){
	    global $db, $HTTP_SESSION_VARS;
		if(!$this->internResolveEncounterNr($enc_nr)||!$grp_nr) return false;
		$buf;
		
		$this->sql="UPDATE $this->tb_diagnosis 
						SET group_nr='$grp_nr',
						history=CONCAT(history,'Set group ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						WHERE encounter_nr=$this->enc_nr AND NOT group_nr AND status NOT IN ($this->dead_stat)";
		
		$buf=$this->Transact($this->sql);
		
		$this->sql="UPDATE $this->tb_procedure 
						SET group_nr='$grp_nr',
						history=CONCAT(history,'Set group ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						WHERE encounter_nr=$this->enc_nr AND NOT group_nr AND status NOT IN ($this->dead_stat)";
		 return $buf | $this->Transact($this->sql);
	}
	/**
	* ungroupDiagnoses() will set the group number of diagnosis entries of an encounter to 0 (no group)
	* @param $grp_nr (int) = the current group number
	* @param $enc_nr (int) = the encounter number
	* return true/false
	*/
	function ungroupDiagnoses($grp_nr,$enc_nr){
	    global $db, $HTTP_SESSION_VARS;
		if(!$this->internResolveEncounterNr($enc_nr)||!$grp_nr) return false;
		$this->sql="UPDATE $this->tb_diagnosis 
						SET group_nr=0,
						history=CONCAT(history,'Ungroup ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						WHERE encounter_nr=$this->enc_nr AND group_nr=$grp_nr AND status NOT IN ($this->dead_stat)";
		return $this->Transact($this->sql);
	}
	/**
	* ungroupProcedures() will set the group number of procedure entries of an encounter to 0 (no group)
	* @param $grp_nr (int) = the current group number
	* @param $enc_nr (int) = the encounter number
	* return true/false
	*/
	function ungroupProcedures($grp_nr,$enc_nr){
	    global $db, $HTTP_SESSION_VARS;
		if(!$this->internResolveEncounterNr($enc_nr)||!$grp_nr) return false;
		$this->sql="UPDATE $this->tb_procedure 
						SET group_nr=0,
						history=CONCAT(history,'Ungroup ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
						modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'			
						WHERE encounter_nr=$this->enc_nr AND group_nr=$grp_nr AND status NOT IN ($this->dead_stat)";
		return $this->Transact($this->sql);
	}
	/**
	* internResolveDeptNr() tries to get the department number
	* @param $dept_nr (int) = department number
	* returns department number/true/false
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
	* The record count is stored in the rec_count variable and can be fetched via the LastRecordCount()
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
				$cond="q.code AS nr,d.code AS code, d.description FROM $this->tb_qlist AS q  LEFT JOIN $this->tb_drg AS d ON q.code=d.nr";
				break;
			}
			case 'diagnosis':
			{
				$cond="q.code,q.code_parent ,d.diagnosis_code AS nr, d.description, p.description AS parent_desc FROM $this->tb_qlist AS q  
								LEFT JOIN $this->tb_diag_codes AS d ON q.code=d.diagnosis_code
								LEFT JOIN $this->tb_diag_codes AS p ON q.code_parent=p.diagnosis_code";
				break;
			}
			case 'procedure':
			{
				$cond="q.code,q.code_parent ,d.code AS nr, d.description, p.description AS parent_desc FROM $this->tb_qlist AS q  
								LEFT JOIN $this->tb_proc_codes AS d ON q.code=d.code
								LEFT JOIN $this->tb_proc_codes AS p ON q.code_parent=p.code";
				break;
			}
			//default: return false;
		}
		$this->sql="SELECT $cond WHERE q.dept_nr=$this->dept_nr AND q.qlist_type='$type' ORDER BY q.rank DESC";
		if($this->result=$db->SelectLimit($this->sql,$this->sel_limit)) {
		    if($this->rec_count=$this->result->RecordCount()){
				return $this->result;
		    }else{return false;}
		}else{return false;}
	}
	/**
	* QuickCodeExists() checks if the code exists in the quicklist
	* The record count is stored in the rec_count variable and can be fetched via the LastRecordCount()
	* @param $code (string) = code
	* return record entry number if exist, else false
	*/
	function QuickCodeExists($code=0){
		global $db;
		if(!$code) return false;
		$this->sql="SELECT nr FROM $this->tb_qlist WHERE code='$code'";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()){
				$row=$this->result->FetchRow();
				return $row['nr'];
		    }else{return false;}
		}else{return false;}
	}
	/**
	* upRankQuickCode() increases the ranking of the code in the quicklist by $step value
	* @param $code (str) = the code
	* @param $step (int) = increase step (default =1)
	* return true/false
	*/
	function upRankQuickCode($code=0,$step=1){
		if(!$code) return false;
		$this->sql="UPDATE $this->tb_qlist SET rank=(rank+$step) WHERE code='$code'";
		return $this->Transact();
	}
	/**
	* addQuickCode() inserts a new code entry in the quicklist
	* @param $code (str) = the code
	* @param $step (int) = increase step (default =1)
	* return void
	*/
	function addQuickCode(&$data){
		global $HTTP_SESSION_VARS;
		if(!is_array($data)) return false;
		if($this->QuickCodeExists($data['code'])){
			return $this->upRankQuickCode($data['code']);
		}else{
			$this->sql="INSERT INTO $this->tb_qlist (code,code_parent,dept_nr,qlist_type,rank,history,modify_id,create_id,create_time)
									VALUES ('".$data['code']."','".$data['code_parent']."','1','".$data['qlist_type']."','1','Create ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."','".$HTTP_SESSION_VARS['sess_user_name']."','".$HTTP_SESSION_VARS['sess_user_name']."',NULL)";
			return $this->Transact();
		}
	}
	/**
	* DRGRelatedCodeExists() checks if drg related code exists in the table
	* The record count is stored in the rec_count variable and can be fetched via the LastRecordCount()
	* @param $group_nr (int) = the drg group number
	* @param $relcode (string) = the related code
	* @param $code_type (string) = type of the related code (diagnosis, procedure)
	* return record entry number if exist, else false
	*/
	function DRGRelatedCodeExists($group_nr=0,$relcode=0,$code_type=0){
		global $db;
		if(!($relcode&&$group_nr&&$code_type)) return false;
		$this->sql="SELECT nr FROM $this->tb_related WHERE group_nr=$group_nr AND code='$relcode' AND code_type='$code_type'";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()){
				$row=$this->result->FetchRow();
				return $row['nr'];
		    }else{return false;}
		}else{return false;}
	}
	/**
	* upRankDRGRelatedCode() increases the ranking of a drg  related code by $step value
	* @param $group_nr (int) = the drg group number
	* @param $relcode (string) = the related code
	* @param $code_type (string) = type of the related code (diagnosis, procedure)
	* @param $step (int) = increase step (default =1)
	* return true/false
	*/
	function upRankDRGRelatedCode($group_nr=0,$relcode=0,$code_type=0,$step=1){
		if(!($relcode&&$group_nr&&$code_type)) return false;
		$this->sql="UPDATE $this->tb_related SET rank=(rank+$step) WHERE group_nr=$group_nr AND code='$relcode' AND code_type='$code_type'";
		return $this->Transact();
	}
	/**
	* addDRGRelatedCode() inserts a new related code entry in the care_drg_related_codes table
	* @param $data (array) reference pass = the data in array
	* return true/false
	*/
	function addDRGRelatedCode(&$data){
		global $HTTP_SESSION_VARS;
		if(!is_array($data)) return false;
		if($this->DRGRelatedCodeExists($data['group_nr'],$data['code'],$data['code_type'])){
			return $this->upRankDRGRelatedCode($data['group_nr'],$data['code'],$data['code_type']);
		}else{
			$this->sql="INSERT INTO $this->tb_related (group_nr,code,code_parent,code_type,rank,history,modify_id,create_id,create_time)
									VALUES ('".$data['group_nr']."','".$data['code']."','".$data['code_parent']."','".$data['code_type']."','1','Create ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."','".$HTTP_SESSION_VARS['sess_user_name']."','".$HTTP_SESSION_VARS['sess_user_name']."',NULL)";
			return $this->Transact();
		}
	}
	/**
	* RelatedDiagnoses() gets the diagnosis codes related to the internal drg group number
	* public
	* @param $group_nr (int) = the number of the intern drg group
	* return adodb record object or false
	*/
	function RelatedDiagnoses($group_nr=0){
		global $db;
		if(!$group_nr) return false;
		$this->sql="SELECT c.nr,c.code, c.code_parent,d.description, p.description AS parent_desc
							FROM  $this->tb_related AS c
									LEFT JOIN $this->tb_diag_codes AS d ON c.code=d.diagnosis_code
									LEFT JOIN $this->tb_diag_codes AS p ON c.code_parent=p.diagnosis_code
							 WHERE c.group_nr=$group_nr 
									AND c.code_type='diagnosis'
									AND c.status NOT IN ($this->dead_stat)
							ORDER BY c.rank DESC";
		if($this->result=$db->SelectLimit($this->sql,$this->sel_limit)) {
		    if($this->rec_count=$this->result->RecordCount()){
				return $this->result;
		    }else{return false;}
		}else{return false;}
	}
	/**
	* RelatedProcedures() gets the procedure codes related to the internal drg group number
	* public
	* @param $group_nr (int) = the number of the intern drg group
	* return adodb record object or false
	*/
	function RelatedProcedures($group_nr=0){
		global $db;
		if(!$group_nr) return false;
		$this->sql="SELECT c.nr,c.code, c.code_parent,d.description, p.description AS parent_desc
							FROM  $this->tb_related AS c
									LEFT JOIN $this->tb_proc_codes AS d ON c.code=d.code
									LEFT JOIN $this->tb_proc_codes AS p ON c.code_parent=p.code
							 WHERE c.group_nr=$group_nr 
									AND c.code_type='procedure'
									AND c.status NOT IN ($this->dead_stat)
							ORDER BY c.rank DESC";
		if($this->result=$db->SelectLimit($this->sql,$this->sel_limit)) {
		    if($this->rec_count=$this->result->RecordCount()){
				return $this->result;
		    }else{return false;}
		}else{return false;}
	}
	/**
	* Gets the diagnosis codes for an encounter's operative intervention
	* @param $op_nr (int) = operation number
	* @param $enc_nr (int) = encounter number
	* return ADODB record set
	*/
	function OPDiagnosisCodes($op_nr=0,$enc_nr=0){
	    global $db;
		//if(!$this->internResolveEncounterNr($enc_nr)||!$op_nr) return false;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT d.*,c.description , m.description AS parent_desc,
								cat.LD_var AS cat_LD_var, cat.LD_var_short_code AS cat_LD_var_short_code, cat.short_code AS cat_short_code, cat.name AS cat_name,
								loc.LD_var AS loc_LD_var, loc.LD_var_short_code AS loc_LD_var_short_code, loc.short_code AS loc_short_code,loc.name AS loc_name
							FROM 	$this->tb_diagnosis AS d
									LEFT JOIN $this->tb_diag_codes AS c ON d.code=c.diagnosis_code
									 LEFT JOIN $this->tb_diag_codes AS m ON d.code_parent=m.diagnosis_code AND d.code_parent NOT IN ('',' ')
									 LEFT JOIN $this->tb_cat_diag AS cat ON d.category_nr=cat.nr
									 LEFT JOIN $this->tb_type_loc AS loc ON d.localization=loc.nr
									 WHERE d.encounter_nr=$this->enc_nr 
									 	AND d.op_nr=$op_nr
									 	AND d.status NOT IN ($this->dead_stat)
										ORDER BY d.category_nr,d.date";
		//echo $this->sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* Gets the procedure codes for an encounter's operative intervention
	* @param $op_nr (int) = operation number
	* @param $enc_nr (int) = encounter number
	* return ADODB record set
	*/
	function OPProcedureCodes($op_nr=0,$enc_nr=0){
	    global $db;
		//if(!$this->internResolveEncounterNr($enc_nr)||!$op_nr) return false;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT p.*, c.description, m.description AS parent_desc,
								cat.LD_var AS cat_LD_var, cat.LD_var_short_code AS cat_LD_var_short_code, cat.short_code AS cat_short_code, cat.name AS cat_name,
								loc.LD_var AS loc_LD_var, loc.LD_var_short_code AS loc_LD_var_short_code, loc.short_code AS loc_short_code,loc.name AS loc_name	
							FROM (
										$this->tb_procedure AS p,
									 	$this->tb_proc_codes AS c
									)
									 LEFT JOIN $this->tb_proc_codes AS m ON p.code_parent=m.code
									 LEFT JOIN $this->tb_cat_proc AS cat ON p.category_nr=cat.nr
									 LEFT JOIN $this->tb_type_loc AS loc ON p.localization=loc.nr
							 WHERE p.encounter_nr=$this->enc_nr 
									 	AND p.op_nr=$op_nr
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
	* _getDRGList() gets all DRG entries based on the given number
	* private
	* @param $nr (int) = select number
	* @param $nr_type (str) = type of  $nr (_ENC = encounter nr, _REG = pid nr.)
	* return adodb record object
	*/
	function _getDRGList($nr,$nr_type='_ENC'){
		global $db;
		# Set field name for main selection
		if($nr_type=='_ENC'){
			$disc='encounter_nr';
		}elseif($nr_type='_REG'){
			$disc='pid';
		}else{
			$this->error_msg='Type of nr. invalid or empty';
			return false;
		}
		
		$this->sql="SELECT e.encounter_nr,e.encounter_date,e.is_discharged  
						FROM   $this->tb_enc AS e,
									$this->tb_enc_drg AS i,
									$this->tb_diagnosis AS d,
									$this->tb_procedure AS p
						WHERE e.$disc=$nr
							AND e.status NOT IN ($this->dead_stat) 
							AND (
									(i.encounter_nr=e.encounter_nr AND i.status NOT IN ($this->dead_stat))
									OR 
									(d.encounter_nr=e.encounter_nr AND d.status NOT IN ($this->dead_stat))
									OR 
									(p.encounter_nr=e.encounter_nr AND p.status NOT IN ($this->dead_stat))
								)
						GROUP BY e.encounter_nr
						ORDER BY e.encounter_date DESC";
		//echo $this->sql;
        if($this->res['_gmed']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gmed']->RecordCount()) {
				 return $this->res['_gmed'];	 
			} else { return false; }
		} else { return false; }
	}
	/** 
	* encDRGList() gets all DRG records of an encounter nr
	* public
	* @param $enc_nr (int) = encounter number
	* return adodb record object
	*/
	function encDRGList($nr){
		return $this->_getDRGList($nr,'_ENC');
	}
	/** 
	* pidDRGList() gets all DRG records of a person's pid nr
	* public
	* @param $pid (int) = pid number
	* return adodb record object
	*/
	function pidDRGList($nr){
		return $this->_getDRGList($nr,'_REG');
	}
	
}
