<?php
/* API class for encounter. Extends class Person (class_person.php) 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Encounter extends Core {
    /* Table names related to encounter */
    var $tb_enc='care_encounter';
	var $tb_fc='care_class_financial';
	var $tb_enc_fc='care_encounter_financial_class';
	var $tb_ec='care_class_encounter';
	var $tb_ic='care_class_insurance';
	var $tb_person='care_person';
	var $tb_citytown='care_address_citytown';
	/* Aux vars */
	var $enc_nr;
	var $encoder;
	var $ignore_status=false;
	var $entire_record=false;
	var $encounter;
	var $is_loaded=false;
	var $single_result=false;
	var $record_count;
	
	var $tabfields=array('encounter_nr',
	                           'pid',
							   'encounter_date',
							   'encounter_class_nr',
							   'encounter_type',
							   'encounter_status',
							   'referrer_diagnosis',
							   'referrer_recom_therapy',
							   'referrer_dr',
							   'referrer_dept',
							   'referrer_institution',
							   'referrer_notes',
							   'financial_class',
							   'insurance_nr',
							   'insurance_class_nr',
							   'insurance_firm_id',
							   'insurance_2_nr',
							   'insurance_2_firm_id',
                               'current_ward_nr',
							   'current_room_nr',
							   'in_ward',
							   'current_dept_nr',
							   'current_firm_nr',
							   'current_att_dr',
							   'consulting_dr',
							   'extra_service',
							   'followup_date',
							   'followup_responsibility',
							   'post_encounter_notes',
							   'status',
							   'history',
							   'modify_id',
							   'modify_time',
							   'create_id',
							   'create_time');
							   
	function Encounter($enc_nr='') {
	    $this->enc_nr=$enc_nr;
		$this->setTable($this->tb_enc);
		$this->setRefArray($this->tabfields);
	}
	function setEncounterNr($enc_nr='') {
	    $this->enc_nr=$enc_nr;
	}
	function setEncoder($encoder='') {
	    $this->encoder=$encode;
	}
	function setIgnoreStatus($bool=false){
	    $this->ignore_status=$bool;
	}
	function setGetEntireRecord($bool=false){
	    $this->entire_record=$bool;
	}
	function setCoreTable($table){
	    $this->setTable($table);
	}
	function setSingleResult($bool=false){
	    $this->single_result=$bool;
	}

	function internResolveEncounterNr($enc_nr='') {
	    if (empty($enc_nr)) {
		    if(empty($this->enc_nr)) {
			    return false;
			} else { return true; }
		} else {
		     $this->enc_nr=$enc_nr;
			return true;
		}
	}
		
    function getServiceClass($type,$enc_nr) {
        global $db;
	    
		if(empty($type)) return false;
	    if(!$this->internResolveEncounterNr($enc_nr)) return false;
		
		$this->sql="SELECT   enfc.class_nr       AS sc_".$type."_class_nr,  
			                          enfc.date_start  AS sc_".$type."_start,
									  enfc.date_end    AS sc_".$type."_end,
									  enfc.nr               AS sc_".$type."_nr,
									  fc.name             AS sc_".$type."_name,
									  fc.code              AS sc_".$type."_code,
									  fc.LD_var           AS sc_".$type."_LD_var
							FROM
							          $this->tb_fc AS fc,
									  $this->tb_enc_fc AS enfc
							WHERE
							          enfc.encounter_nr='$this->enc_nr' AND fc.type='$type' AND enfc.class_nr=fc.class_nr
							 ORDER BY enfc.date_create ";
							 
		if($this->single_result) $this->sql.=' LIMIT 1';				 
				     
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
			    // echo $this->sql.'<p>';
				 return $this->result;
		     } else { return false;}
		} else { return false;}
    }
	
	function CareServiceClass($enc_nr) {
	    return $this->getServiceClass('care',$enc_nr);
	}
	function RoomServiceClass($enc_nr) {
	    return $this->getServiceClass('room',$enc_nr);
	}
	function AttDrServiceClass($enc_nr) {
	    return $this->getServiceClass('att_dr',$enc_nr);
	}

    function saveServiceClass($type, &$val_array,$enc_nr='')
    {
	    global $db;
    
	    if(empty($type)||empty($val_array)) return false;
        if(!$this->internResolveEncounterNr($enc_nr)) return false;
	
	    $this->sql="INSERT INTO $this->tb_enc_fc
	        (
	               encounter_nr,
				   class_nr,
				   date_start,
				   date_end,
				   date_create,
				   history,
				   modify_id,
				   modify_time,
				   create_id,
				   create_time
            )
			 VALUES
			 (
			    '$this->enc_nr',
				'".$val_array['sc_'.$type.'_class_nr']."',
				'".$val_array['sc_'.$type.'_start']."',
				'".$val_array['sc_'.$type.'_end']."',
				'".date('Y-m-d H:i:s')."',
				'Init.entry ".date('Y-m-d H:i:s')." = ".$val_array['encoder']."',
				'".$val_array['encoder']."',
				NULL,
				'".$val_array['encoder']."',
				NULL
			)";
			
        return $this->Transact();
    }	

	function saveCareServiceClass(&$val_array,$enc_nr) {
	    return $this->saveServiceClass('care',$val_array,$enc_nr);
	}
	function saveRoomServiceClass(&$val_array,$enc_nr) {
	    return $this->saveServiceClass('room',$val_array,$enc_nr);
	}
	function saveAttDrServiceClass(&$val_array,$enc_nr) {
	    return $this->saveServiceClass('att_dr',$val_array,$enc_nr);
	}
	
    function updateServiceClass($type, &$val_array)
    {
	    global $db;
	     
		if(empty($val_array['sc_'.$type.'_class_nr'])) return false;
	    $this->sql="UPDATE $this->tb_enc_fc SET
				   class_nr = '".$val_array['sc_'.$type.'_class_nr']."',
				   date_start = '".$val_array['sc_'.$type.'_start']."',
				   date_end = '".$val_array['sc_'.$type.'_end']."',
				   history =(CONCAT(history,'\n Update ".date('Y-m-d H:i:s')." = ".$val_array['encoder']."')),
				   modify_id = '".$val_array['encoder']."'
			WHERE nr = '".$val_array['sc_'.$type.'_nr']."'";
			
		return $this->Transact();
    }	
	
	function updateCareServiceClass(&$val_array) {
		if(empty($val_array['sc_care_nr'])) return $this->saveCareServiceClass($val_array);
	        else return $this->updateServiceClass('care',$val_array);
	}
	function updateRoomServiceClass(&$val_array,$nr) {
		if(empty($val_array['sc_room_nr'])) return $this->saveRoomServiceClass($val_array);
	        else return $this->updateServiceClass('room',$val_array);
	}
	function updateAttDrServiceClass(&$val_array,$nr) {
		if(empty($val_array['sc_att_dr_nr'])) return $this->saveAttDrServiceClass($val_array);
	        else return $this->updateServiceClass('att_dr',$val_array);
	}

    function getAllServiceClassesObject($type=''){
	    global $db;
		if(empty($type)) return false;
		$this->sql="SELECT class_nr,class_id,code,name,LD_var FROM $this->tb_fc WHERE type='$type'";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
			    return $this->result;
		    } else { return false;}
		} else { return false;}
    }		
	
	function AllCareServiceClassesObject(){
	    return $this->getAllServiceClassesObject('care');
	}
	function AllRoomServiceClassesObject(){
	    return $this->getAllServiceClassesObject('room');
	}
	function AllAttDrServiceClassesObject(){
	    return $this->getAllServiceClassesObject('att_dr');
	}
	
	function AllEncounterClassesObject(){
	    global $db;
		$this->sql="SELECT class_nr,class_id,name,LD_var FROM $this->tb_ec WHERE 1";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
			    return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	
	function loadEncounterData($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT e.*, p.title,p.name_last, p.name_first, p.date_birth, p.sex,
									p.addr_str,p.addr_str_nr,p.addr_zip, 
									p.photo_filename, t.name AS citytown_name
							FROM $this->tb_enc AS e, 
									 $this->tb_person AS p 
									 LEFT JOIN $this->tb_citytown AS t ON p.addr_citytown_nr=t.nr
							WHERE e.encounter_nr=$this->enc_nr
								AND e.pid=p.pid";
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->record_count=$this->result->RecordCount()) {
			    $this->encounter=$this->result->FetchRow();
				$this->result=NULL;
			    $this->is_loaded=true;
				return true;
		    } else { return false;}
		} else { return false;}
	}
	
	function LastName(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['name_last'];
	}
	function FirstName(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['name_first'];
	}
	function BirthDate(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['date_birth'];
	}
	function PID(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['pid'];
	}
	function EncounterDate(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['encounter_date'];
	}
	function EncounterClass(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['encounter_class_nr'];
	}
	function FinancialClass(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['financial_class'];
	}
	function BillingClass(){
		return $this->FinancialClass();
	}
	function RefererDiagnosis(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['referrer_diagnosis'];
	}
	function RefererRecomTherapy(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['referrer_recom_therapy'];
	}
	function RefererNotes(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['referrer_notes'];
	}
	function Referer(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['referrer_dr'];
	}
	function RefererDept(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['referrer_dept'];
	}
	function RefererInstitution(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['referrer_institution'];
	}
	function InsuranceNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['insurance_nr'];
	}
	function InsuranceFirmID(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['insurance_firm_id'];
	}
	function CurrentWardNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_ward'];
	}
	function CurrentRoomNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_room'];
	}
	function CurrentDeptNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_dept'];
	}
	function CurrentFirmNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_firm'];
	}
	function CurrentAttDr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_att_dr'];
	}
	function inWard(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['in_ward'];
	}
	function EncounterStatus(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['encounter_status'];
	}
	function EncounterType(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['encounter_type'];
	}
	function ConsultingDr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['consulting_dr'];
	}
	function FollowUpDate(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['followup_date'];
	}
	function FollowUpResponsibility(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['followup_responsibility'];
	}
	function PostEncounterNotes(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['post_encounter_notes'];
	}
	function RecordStatus(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['status'];
	}
	function RecordHistory(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['history'];
	}
	function RecordModifierID(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['modify_id'];
	}
	function RecordCreatorID(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['create_id'];
	}
	
    function updateEncounterFromInternalArray($item_nr='') {
		if(empty($item_nr)) return false;
		$this->where=" encounter_nr=$item_nr";
		return $this->updateDataFromInternalArray($item_nr);
	}
	
	function isCurrentlyAdmitted($pid){
	    global $db;
		$this->sql="SELECT encounter_nr FROM $this->tb_enc WHERE pid='$pid' AND NOT is_discharged";
		if($this->result=$db->Execute($this->sql)){
		    if($this->result->RecordCount()) {
			    $this->row=$this->result->FetchRow();
				return $this->row['encounter_nr'];
			} else return false;
		}else {
		    return false;
		}
	}
	
	function setHistorySeen($encoder='',$enc_nr=''){
	    global $db;
		if(empty($encoder)) return false;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="UPDATE $this->tb_enc SET history= CONCAT(history,\"\nView ".date('Y-m-d H:i:s')." = $encoder\") WHERE encounter_nr=$this->enc_nr";
		
		if($db->Execute($this->sql)) {return true;}
		   else  {echo $this->sql;return false;}
	}		
	
	function getEncounterClassInfo($class_nr){
	    global $db;
		$this->sql="SELECT class_id,name,LD_var FROM $this->tb_ec WHERE class_nr=$class_nr";
		if($this->result=$db->Execute($this->sql)){
		    if($this->result->RecordCount()) {
			    $this->row=$this->result->FetchRow();
				return $this->row;
			} else return false;
		}else {
		    return false;
		}
	}
	
    function getInsuranceClassInfo($class_nr){
	    global $db;
		$this->sql="SELECT class_id,name,LD_var FROM $this->tb_ic WHERE class_nr=$class_nr";
		if($this->result=$db->Execute($this->sql)){
		    if($this->result->RecordCount()) {
			    $this->row=$this->result->FetchRow();
				return $this->row;
			} else return false;
		}else {
		    return false;
		}
	}
	function _searchAdmissionBasicInfo($key,$enc_class=0,$add_opt=''){
		global $db;
		//if(empty($key)) return false;
		$sql="SELECT e.encounter_nr, e.encounter_class_nr, p.pid, p.name_last, p.name_first, p.date_birth 
				FROM $this->tb_enc AS e, $this->tb_person AS p";
		if(is_numeric($key)){
			$key=(int)$key;
			$sql.=" WHERE e.encounter_nr = $key AND NOT e.is_discharged AND e.pid=p.pid";
		}else{
			$sql.=" WHERE (e.encounter_nr LIKE '$key%' 
						OR p.pid LIKE '$key%'
						OR p.name_last LIKE '$key%'
						OR p.name_first LIKE '$key%'
						OR p.date_birth LIKE '$key%')";
			if($enc_class) $sql.="	AND e.encounter_class_nr=$enc_class";
			$sql.="  AND NOT e.is_discharged
						AND e.pid=p.pid ".$add_opt;
		}
		//echo $sql;
	    if ($this->result=$db->Execute($sql)) {
		   	if ($this->record_count=$this->result->RecordCount()) {
				return $this->result;
			} else {
				return false;
			}
		}else {
			return false;
		}
	}	
	function searchInpatientBasicInfo($key){
		return $this->_searchAdmissionBasicInfo($key,1); // 1 = inpatient (encounter class)
	}
	function searchOutpatientBasicInfo($key){
		return $this->_searchAdmissionBasicInfo($key,2); // 2 = outpatient (encounter class)
	}
	function searchEncounterBasicInfo($key){
		return $this->_searchAdmissionBasicInfo($key,0); // 2 = outpatient (encounter class)
	}
	function searchInpatientNotInWardBasicInfo($key){
		return $this->_searchAdmissionBasicInfo($key,1,'AND NOT in_ward'); // 2 = outpatient (encounter class)
	}
	function EncounterExists($enc_nr){
	    global $db;
		$this->sql="SELECT pid FROM $this->tb_enc WHERE encounter_nr='$enc_nr'";
		if($this->result=$db->Execute($this->sql)){
		    if($this->result->RecordCount()) {
			    $this->row=$this->result->FetchRow();
				return $this->row['pid'];
			} else return false;
		}else {
		    return false;
		}
	}
}
?>
