<?php
/* API class for user configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Obstetrics extends Core {
	# tables
	var $tb_neonatal='care_neonatal'; 
	var $tb_person='care_person';
	var $tb_enc='care_encounter';
	var $tb_diseases='care_category_disease';
	var $tb_outcomes='care_type_outcome';
	var $tb_dmodes='care_mode_delivery';
	var $tb_feeds='care_type_feeding';
	var $tb_preg='care_pregnancy';
	var $tb_indmethod='care_method_induction';
	var $tb_perineum='care_type_perineum';
	var $tb_classif='care_classif_neonatal';
	var $tb_anest='care_type_anaesthesia';

	var $bd; # birth details holder
		
	var $fld_neonatal=array(
									'nr',
									'pid',
									'parent_encounter_nr',
									'delivery_nr',
									'encounter_nr',
									'delivery_place',
									'delivery_mode',
									'delivery_date',
									'c_s_reason',
									'born_before_arrival',
									'face_presentation',
									'posterio_occipital_position',
									'delivery_rank',
									'apgar_1_min',
									'apgar_5_min',
									'apgar_10_min',
									'time_to_spont_resp',
									'condition',
									'weight',
									'length',
									'head_circumference',
									'scored_gestational_age',
									'feeding',
									'congenital_abnormality',
									'classification',
									'disease_category',
									'outcome',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	var $fld_preg=array(
									'nr',
									'encounter_nr',
									'this_pregnancy_nr',
									'delivery_date',
									'delivery_time',
									'gravida',
									'para',
									'pregnancy_gestational_age',
									'nr_of_fetuses',
									'child_encounter_nr',
									'is_booked',
									'vdrl',
									'rh',
									'delivery_mode',
									'delivery_by',
									'bp_systolic_high',
									'bp_diastolic_high',
									'proteinuria',
									'labour_duration',
									'induction_method',
									'induction_indication',
									'is_epidural',
									'anaesth_type_nr',
									'complications',
									'perineum',
									'blood_loss',
									'blood_loss_unit',
									'is_retained_placenta',
									'post_labour_condition',
									'outcome',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**
	* Constructor
	*/
	function Obstetrics($nr=0){
		if($nr) $this->enc_nr=$nr;
		$this->coretable=$this->tb_neonatal;
		$this->ref_array=$this->fld_neonatal;
	}
	/** 
	* BirthDetails() gets all birth data
	* public
	* @param $pid (int) = pid number
	* return adodb record object
	*/
	function BirthDetails($pid){
		global $db;
		$this->sql="SELECT n.* FROM   $this->tb_neonatal AS n, $this->tb_person AS p
			WHERE p.pid=".$pid." AND p.pid=n.pid AND n.status NOT IN ($this->dead_stat)
			ORDER BY n.modify_time DESC";
        if($this->bd=$db->Execute($this->sql)) {
            if($this->rec_count=$this->bd->RecordCount()) {
				 return $this->bd;	 
			} else { return false; }
		} else { return false; }
	}
/*	function DeliveryDate(){
		return $bd['delivery_date'];
	}
	function PregnancyNr(){
		return $bd['pregnancy_nr'];
	}
	function DeliveryPlace(){
		return $bd['delivery_place'];
	}
	function DeliveryMode(){
		return $bd['delivery_mode'];
	}
	function CSReason(){
		return $bd['c_s_reason'];
	}
	function BornBeforeArrival(){
		return $bd['born_before_arrival'];
	}
	function FacePresentation(){
		return $bd['face_presentation'];
	}
	function PostOcciPos(){
		return $bd['posterio_occipital_position'];
	}
	function DeliveryRank(){
		return $bd['delivery_rank'];
	}
	function Apgar1(){
		return $bd['apgar_1_min'];
	}
	function Apgar5(){
		return $bd['apgar_5_min'];
	}
	function Apgar10(){
		return $bd['apgar_10_min'];
	}
	function Condition(){
		return $bd['condition'];
	}
	function Weight(){
		return $bd['weight'];
	}
	function Length(){
		return $bd['length'];
	}
	function HeadCircumference(){
		return $bd['head_circumference'];
	}
	function ScoredGestAge(){
		return $bd['scored_gestational_age'];
	}
	function Feeding(){
		return $bd['feeding'];
	}
	function CongenAbnormality(){
		return $bd['congenital_abnormality'];
	}
	function Classification(){
		return $bd['classification'];
	}
	function DiseaseCategory(){
		return $bd['disease_category'];
	}
	function Outcome(){
		return $bd['outcome'];
	}
*/
	/**
	* DiseaseCategories() gets all disease categories data stored in the care_category_disease table
	* public
	* returns adodb record object
	*/ 
	function DiseaseCategories(){
		global $db;
		$this->sql="SELECT * FROM   $this->tb_diseases WHERE group_nr=2 AND status NOT IN ($this->dead_stat) ORDER BY nr"; # group_nr = 2 is Neonatal
        if($this->res['_dcat']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_dcat']->RecordCount()) {
				 return $this->res['_dcat'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* FeedingTypes() gets all feeding types data stored in the care_type_feeding table
	* public
	* returns adodb record object
	*/ 
	function FeedingTypes(){
		global $db;
		$this->sql="SELECT * FROM   $this->tb_feeds WHERE group_nr=2 AND status NOT IN ($this->dead_stat) ORDER BY nr"; # group_nr = 2 is Neonatal
        if($this->res['_feed']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_feed']->RecordCount()) {
				return $this->res['_feed'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Outcomes() gets all outcome types data stored in the care_type_outcome table
	* public
	* returns adodb record object
	*/ 
	function Outcomes(){
		global $db;
		$this->sql="SELECT * FROM   $this->tb_outcomes WHERE group_nr=2 AND status NOT IN ($this->dead_stat) ORDER BY nr"; # group_nr = 2 is Neonatal
        if($this->res['_outs']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_outs']->RecordCount()) {
				return $this->res['_outs'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* DeliveryModes() gets all delivery modes data stored in the care_mode_delivery table
	* public
	* returns adodb record object
	*/ 
	function DeliveryModes(){
		global $db;
		$this->sql="SELECT * FROM   $this->tb_dmodes WHERE group_nr=2 AND status NOT IN ($this->dead_stat) ORDER BY nr"; # group_nr = 2 is Neonatal
        if($this->res['_dmodes']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_dmodes']->RecordCount()) {
				return $this->res['_dmodes'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* deactivateBirthDetails() sets the status of a neonatal birth details record to "inactive"
	* public
	* @param $pid (int) the pid nr of the person
	* returns true/false
	*/ 
	function deactivateBirthDetails($pid){
		global $HTTP_SESSION_VARS;
		$this->sql="UPDATE  $this->tb_neonatal SET status='inactive', history=CONCAT(history,'Deactivated ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n') WHERE pid=$pid"; 
		return $this->Transact();
	}
	/**
	* getDiseaseCategory() gets disease category data 
	* public
	* @param $nr (int) = category nr
	* returns one row (associative array)
	*/ 
	function getDiseaseCategory($nr){
		global $db;
		if(!$nr) return false;
		$this->sql="SELECT * FROM   $this->tb_diseases WHERE group_nr=2 AND nr=$nr AND status NOT IN ($this->dead_stat)"; # group_nr = 2 is Neonatal
        if($this->res['_gdcat']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gdcat']->RecordCount()) {
				 return $this->res['_gdcat']->FetchRow();
			} else { return false; }
		} else { return false; }
	}
	/**
	* getFeedingType() gets  feeding type data 
	* public
	* @param $nr (int) = type nr
	* returns one row (associative array)
	*/ 
	function getFeedingType($nr){
		global $db;
		if(!$nr) return false;
		$this->sql="SELECT * FROM   $this->tb_feeds WHERE group_nr=2 AND nr=$nr AND status NOT IN ($this->dead_stat)"; # group_nr = 2 is Neonatal
        if($this->res['_gfeed']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gfeed']->RecordCount()) {
				return $this->res['_gfeed']->FetchRow();
			} else { return false; }
		} else { return false; }
	}
	/**
	* getOutcome() gets outcome types data 
	* public
	* @param $nr (int) = type nr
	* returns one row (associative array)
	*/ 
	function getOutcome($nr){
		global $db;
		if(!$nr) return false;
		$this->sql="SELECT * FROM   $this->tb_outcomes WHERE group_nr=2 AND nr=$nr AND status NOT IN ($this->dead_stat)"; # group_nr = 2 is Neonatal
        if($this->res['_gout']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gout']->RecordCount()) {
				return $this->res['_gout']->FetchRow();
			} else { return false; }
		} else { return false; }
	}
	/**
	* getDeliveryMode() gets a  delivery mode
	* public
	* @param $nr (int) = type nr
	* returns one row (associative array)
	*/ 
	function getDeliveryMode($nr){
		global $db;
		if(!$nr) return false;
		$this->sql="SELECT * FROM   $this->tb_dmodes WHERE group_nr=2 AND nr=$nr AND status NOT IN ($this->dead_stat)"; # group_nr = 2 is Neonatal
        if($this->res['_gdmode']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gdmode']->RecordCount()) {
				return $this->res['_gdmode']->FetchRow();
			} else { return false; }
		} else { return false; }
	}
	/** 
	* Pregnancies() gets all pregnancy data
	* public
	* @param $nr (int) = encounter number
	* return adodb record object
	*/
	function Pregnancies($nr,$nr_type='_ENC'){
		global $db;
		if($nr_type=='_ENC'){
			$this->sql="SELECT n.* FROM   $this->tb_preg AS n
				WHERE n.encounter_nr=".$nr." AND n.status NOT IN ($this->dead_stat)
				ORDER BY n.modify_time DESC";
		}elseif($nr_type='_REG'){
			$this->sql="SELECT n.* FROM $this->tb_person AS p, $this->tb_preg AS n, $this->tb_enc AS e
				WHERE p.pid=".$nr." AND e.pid=p.pid AND e.encounter_nr=n.encounter_nr AND n.status NOT IN ($this->dead_stat)
				ORDER BY n.modify_time DESC";
		}
		//echo $this->sql;
        if($this->res['_preg']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_preg']->RecordCount()) {
				 return $this->res['_preg'];	 
			} else { return false; }
		} else { return false; }
	}
	/**
	* usePregnancy() points the core table to care_pregnancy
	* public
	* return void
	*/
	function usePregnancy(){
		$this->coretable=$this->tb_preg;
		$this->ref_array=$this->fld_preg;
	}
	/**
	* deactivatePregnancy() sets the status of a pregnancy record to "inactive"
	* public
	* @param $nr (int) the record nr 
	* returns true/false
	*/ 
	function deactivatePregnancy($nr){
		global $HTTP_SESSION_VARS;
		$this->sql="UPDATE  $this->tb_preg SET status='inactive', history=CONCAT(history,'Deactivated ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n') 
							WHERE nr=$nr"; 
		return $this->Transact();
	}
	/**
	* InductionMethods() gets all induction methods data stored in the care_method_induction table
	* public
	* @param $grp (int) = the group number, default is 1 = pregnancy
	* returns adodb record object
	*/ 
	function InductionMethods($grp=1){
		global $db;
		# Group nr. 1 = pregnancy group
		$this->sql="SELECT * FROM   $this->tb_indmethod WHERE group_nr=$grp AND status NOT IN ($this->dead_stat) ORDER BY nr"; 
        if($this->res['_indm']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_indm']->RecordCount()) {
				return $this->res['_indm'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* getInductionMethod() gets the induction method
	* public
	* @param $nr (int) = the method number
	* returns one row (associative array)
	*/ 
	function getInductionMethod($nr){
		global $db;
		if(!$nr) return false;
		# Group nr. 1 = pregnancy group
		$this->sql="SELECT * FROM   $this->tb_indmethod WHERE nr=$nr"; 
		
        if($this->res['_gin']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gin']->RecordCount()) {
				return $this->res['_gin']->FetchRow();
			} else { return false; }
		} else { return false; }
	}
	/**
	* Perineums() gets all perineum types data stored in the care_type_perineum table
	* public
	* returns adodb record object
	*/ 
	function Perineums(){
		global $db;
		$this->sql="SELECT * FROM   $this->tb_perineum WHERE status NOT IN ($this->dead_stat) ORDER BY nr"; 
        if($this->res['_peri']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_peri']->RecordCount()) {
				return $this->res['_peri'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* getPerineum() gets a perineum data
	* public
	* @param $nr (int) = perineum number
	* returns one row (associative array)
	*/ 
	function getPerineum($nr=0){
		global $db;
		if(!$nr) return false;
		$this->sql="SELECT * FROM   $this->tb_perineum WHERE nr=$nr"; 
		
        if($this->res['_gper']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['_gper']->RecordCount()) {
				return $this->res['_gper']->FetchRow();
			} else { return false; }
		} else { return false; }
	}
	/**
	* Classifications() gets all classification  data stored in the care_classif_neonatal table
	* public
	* returns adodb record object
	*/ 
	function Classifications(){
		global $db;
		$this->sql="SELECT * FROM   $this->tb_classif WHERE status NOT IN ($this->dead_stat) ORDER BY nr"; 
        if($this->res['classif']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['classif']->RecordCount()) {
				return $this->res['classif'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* getClassification() gets a neonatal classification data
	* public
	* @param $nr (int) = classification number
	* returns one row (associative array)
	*/ 
	function getClassification($nr=0){
		global $db;
		$this->rec_count=0;
		if(!$nr) return false;
		$this->sql="SELECT * FROM   $this->tb_classif WHERE nr=$nr"; 
        if($this->res['gclasif']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gclasif']->RecordCount()) {
				return $this->res['gclasif']->FetchRow();
			} else { return false; }
		} else { return false; }
	}
	/**
	* AnaesthesiaTypes() gets all anaesthesia data stored in the care_type_anaesthesial table
	* public
	* returns adodb record object
	*/ 
	function AnaesthesiaTypes(){
		global $db;
		$this->rec_count=0;
		$this->sql="SELECT * FROM   $this->tb_anest WHERE status NOT IN ($this->dead_stat) ORDER BY nr"; 
        if($this->res['anat']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['anat']->RecordCount()) {
				return $this->res['anat'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* getAnaesthesia() gets an anaesthesia data
	* public
	* @param $nr (int) = anaesthesia type number
	* returns one row (associative array)
	*/ 
	function getAnaesthesia($nr=0){
		global $db;
		if(!$nr) return false;
		$this->sql="SELECT * FROM   $this->tb_anest WHERE nr=$nr"; 
		
        if($this->res['gana']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gana']->RecordCount()) {
				return $this->res['gana']->FetchRow();
			} else { return false; }
		} else { return false; }
	}
/**
	* EncountersPregnancyExists() checks if the encounter has a pregnancy record. This is limited to the encounter only
	* public
	* @param $nr (int) = the encounter number
	* return record number if exists, false if not exists
	*/
	function EncounterPregnancyExists($nr=0){
		global $db;
		if(!$nr) return false;
		$this->sql="SELECT nr FROM   $this->tb_preg WHERE encounter_nr=$nr AND status NOT IN ($this->dead_stat)"; 
		
        if($buf=$db->Execute($this->sql)) {
            if($this->rec_count=$buf->RecordCount()) {
				$buf2=$buf->FetchRow();
				return $buf2['nr'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* ChildNrAtParent() checks if the encounter nr of a child is recorded at the parents encounter record. 
	* public
	* @param $child_nr (int) = the encounter number of the child
	* @param $parent_nr (int) = the encounter number of the parent
	* return _CHILD_EXISTS = child encounter nr is recorded at parent
	*			_NO_CHILD = child encounter nr is not recorded at parent
	* 			_NO_EXISTS = parent pregnancy record not exists
	*/
	function ChildNrAtParent($child_nr=0,$parent_nr=0){
		global $db;
		if(!$child_nr||!$parent_nr) return false;
		if($this->EncounterPregnancyExists($parent_nr)){
			$this->sql="SELECT encounter_nr FROM   $this->tb_preg WHERE encounter_nr=$parent_nr AND child_encounter_nr LIKE '%$child_nr%' AND status NOT IN ($this->dead_stat)"; 
		
			if($this->res['_cnbp']=$db->Execute($this->sql)) {
           		if($this->rec_count=$this->res['_cnbp']->RecordCount()) {
					return  '_CHILD_EXISTS';
				}else{return  '_NO_CHILD';}
			}else{ return  '_NO_EXISTS';}
		}else{
			return '_NO_EXISTS';
		}
	}
	/**
	* AddChildNrToParent() adds the encounter nr of a child to the parents encounter record. 
	* public
	* @param $child_nr (int) = the encounter number of the child
	* @param $parent_nr (int) = the encounter number of the parent
	* return true/false
	*/
	function AddChildNrToParent($child_nr=0,$parent_nr=0,&$birth){
		global $HTTP_SESSION_VARS;
		if(!$child_nr||!$parent_nr) return false;
		switch($this->ChildNrAtParent($child_nr,$parent_nr))
		{
			case '_NO_CHILD': # Update
				$this->sql="UPDATE $this->tb_preg 
								SET child_encounter_nr=CONCAT(child_encounter_nr,' $child_nr'),
										history=CONCAT(history,'Updated by child  ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')
								WHERE encounter_nr=$parent_nr AND status NOT IN ($this->dead_stat)";
				return $this->Transact();
				break; 
        	# If record not exists create it
			case '_NO_EXISTS':
				$this->sql="INSERT INTO $this->tb_preg 
									(delivery_date,
									para,
									encounter_nr,
									child_encounter_nr,
									delivery_mode,
									outcome,
									history,
									modify_id,
									modify_time,
									create_id,
									create_time
									) 
									VALUES 
									('".$birth['delivery_date']."',
									'".$birth['delivery_nr']."',
									'$parent_nr',
									'$child_nr',
									'".$birth['delivery_mode']."',
									'".$birth['outcome']."',
									'Created by child ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n',
									'".$HTTP_SESSION_VARS['sess_user_name']."',
									'".date('YmdHis')."',
									'".$HTTP_SESSION_VARS['sess_user_name']."',
									'".date('YmdHis')."')";
				return $this->Transact();
				break;
			default: return false;
		}
	}
}
?>
