<?php
/* API class for encounter. Extends class Person (class_person.php) 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_notes.php');

class Encounter extends Notes {
    /* Table names related to encounter */
    var $tb_enc='care_encounter';
	var $tb_fc='care_class_financial';
	var $tb_enc_fc='care_encounter_financial_class';
	var $tb_ec='care_class_encounter';
	var $tb_ic='care_class_insurance';
	var $tb_person='care_person';
	var $tb_citytown='care_address_citytown';
	var $tb_location='care_encounter_location';
	var $tb_dis_type='care_type_discharge';
	var $tb_sickconfirm='care_encounter_sickconfirm';
	var $tb_dept='care_department';
	var $tb_insco='care_insurance_firm';
	/* Aux vars */
	var $enc_nr;
	var $encoder;
	var $ignore_status=false;
	var $entire_record=false;
	var $encounter;
	var $is_loaded=false;
	var $single_result=false;
	var $record_count;
	var $type_nr;
	var $loc_nr;
	var $group_nr;
	var $date;
	var $time;
	
	/* Field names */
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
	var $fld_sickconfirm=array(
								'nr',
								'encounter_nr',
	                           'date_confirm',
							   'date_start',
							   'date_end',
							   'date_create',
							   'diagnosis',
							   'dept_nr',
							   'insurance_co_nr',
							   'insurance_co_sub',
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
	function getNewEncounterNr($ref_nr,$enc_class_nr){
		global $db;
		$row=array();
		$this->sql="SELECT encounter_nr FROM $this->tb_enc WHERE encounter_nr>=$ref_nr AND encounter_class_nr=$enc_class_nr ORDER BY encounter_nr DESC";
		if($this->result=$db->SelectLimit($this->sql,1)){
			if($this->result->RecordCount()){
				$row=$this->result->FetchRow();
				return $row['encounter_nr']+1;
			}else{/*echo $this->sql.'no xount';*/return $ref_nr;}
		}else{/*echo $this->sql.'no sql';*/return $ref_nr;}
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
		return $this->encounter['current_ward_nr'];
	}
	function CurrentRoomNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_room_nr'];
	}
	function CurrentDeptNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_dept_nr'];
	}
	function CurrentFirmNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_firm_nr'];
	}
	function CurrentAttDrNr(){
	    if(!$this->is_loaded) return false;
		return $this->encounter['current_att_dr_nr'];
	}
	function In_Ward(){
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
				FROM $this->tb_enc AS e LEFT JOIN $this->tb_person AS p ON e.pid=p.pid";
		if(is_numeric($key)){
			$key=(int)$key;
			$sql.=" WHERE e.encounter_nr = $key AND NOT e.is_discharged ".$add_opt;
		}else{
			$sql.=" WHERE (e.encounter_nr LIKE '$key%' 
						OR p.pid LIKE '$key%'
						OR p.name_last LIKE '$key%'
						OR p.name_first LIKE '$key%'
						OR p.date_birth LIKE '$key%')";
			if($enc_class) $sql.="	AND e.encounter_class_nr=$enc_class";
			$sql.="  AND NOT e.is_discharged ".$add_opt;
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
		return $this->_searchAdmissionBasicInfo($key,0); // 0 = all kinds of admission
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
	function _InLocation($type_nr){
		global $db;
		if($this->result=$db->Execute("SELECT nr FROM $this->tb_location WHERE encounter_nr=$this->enc_nr AND type_nr=$type_nr AND location_nr=$this->loc_nr AND (date_to='' OR date_to='0000-00-00')")){
			if($this->result->RecordCount()){
				return $this->result['nr'];
			}else{return false;}
		}else{return false;}
	}
	function InWard($enr,$loc_nr){
		$this->enc_nr=$enr;
		$this->loc_nr=$loc_nr;
		return $this->_InLocation(2);
	}
	function InRoom($enr,$loc_nr){
		$this->enc_nr=$enr;
		$this->loc_nr=$loc_nr;
		return $this->_InLocation(4);
	}
	function InBed($enr,$loc_nr){
		$this->enc_nr=$enr;
		$this->loc_nr=$loc_nr;
		return $this->_InLocation(5);
	}
	function _setLocation($enr=0,$type_nr=0,$loc_nr=0,$group_nr,$date='',$time=''){
		global $HTTP_SESSION_VARS;
		//if(!($enr&&$type_nr&&$loc_nr)) return false;
		if(empty($date)) $date=date('Y-m-d');
		if(empty($time)) $time=date('H:i:s');
		$user=$HTTP_SESSION_VARS['sess_user_name'];
		$history="Create: ".date('Y-m-d H:i:s')." ".$user."\n";
		$this->sql="INSERT INTO $this->tb_location (encounter_nr,type_nr,location_nr,group_nr,date_from,time_from,history,modify_id,create_id,create_time) 
						VALUES 
						('$enr','$type_nr','$loc_nr','$group_nr','$date','$time','$history','$user','$user',NULL)";
		//echo $this->sql;
		if($this->Transact($this->sql)) return true; else	echo $this->sql;
		//return $this->Transact($this->sql);
	}
	function assignInWard($enr,$loc_nr,$group_nr,$date,$time){
		return $this->_setLocation($enr,2,$loc_nr,$group_nr,$date,$time);
	}
	function assignInRoom($enr,$loc_nr,$group_nr,$date,$time){
		return $this->_setLocation($enr,4,$loc_nr,$group_nr,$date,$time);
	}
	function assignInBed($enr,$loc_nr,$group_nr,$date,$time){
		return $this->_setLocation($enr,5,$loc_nr,$group_nr,$date,$time);
	}
	function AdmitInWard($enr,$ward_nr,$room_nr,$bed_nr){
		global $db;
		
		$date=date('Y-m-d');
		$time=date('H:i:s');
		if($this->InWard($enr,$ward_nr)){
			$ok=true;
		}else{
			if($this->assignInWard($enr,$ward_nr,$ward_nr,$date,$time)){
				$ok=true;
			}else{$ok=false;}
		}
		if($this->InRoom($enr,$room_nr)){
			$ok=true;
		}else{
			if($this->assignInRoom($enr,$room_nr,$ward_nr,$date,$time)){
				$ok=true;
			}else{$ok=false;}
		}
		if($ok&&!$this->InBed($enr,$bed_nr)){
			if($this->assignInBed($enr,$bed_nr,$ward_nr,$date,$time)){
				return true;
			}else{return false;}
		}else{
			return false;
		}
	}
	function _setCurrentAssignment($enr,$data){
		$this->sql="UPDATE $this->tb_enc SET $data WHERE encounter_nr=$enr";
		return $this->Transact($this->sql);
	}
	function setCurrentWard($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_ward_nr=$assign_nr");
	}
	function setCurrentRoom($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_room_nr=$assign_nr");
	}
	function setCurrentDept($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_dept_nr=$assign_nr");
	}
	function setCurrentFirm($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_firm_nr=$assign_nr");
	}
	function setCurrentAttdDr($enr,$assign_nr){
		return $this->_setCurrentAssignment($enr,"current_att_dr_nr=$assign_nr");
	}
	function setInWard($enr){
		return $this->_setCurrentAssignment($enr,'in_ward=1');
	}
	function setNotInWard($enr){
		return $this->_setCurrentAssignment($enr,'in_ward=0');
	}
	function setAdmittedInWard($enr,$ward_nr,$room_nr,$bed_nr){
		return $this->_setCurrentAssignment($enr,"current_ward_nr=$ward_nr,current_room_nr=$room_nr,in_ward=1");
	}
	/**
	* Flags that the encounter is fully discharged
	* Sets the is_discharged field of care_encounter table and clears the current department,ward,room fields
	*/
	function setIsDischarged($enr){
		$this->sql="UPDATE $this->tb_enc SET is_discharged=1,current_ward_nr=0,current_room_nr=0,current_dept_nr=0,current_firm_nr=0,in_ward=0 WHERE encounter_nr=$enr AND NOT is_discharged";
		//if($this->Transact($this->sql)) return true; else echo $this->sql;
		return $this->Transact($this->sql);
	}
	/**
	* Get the discharge types data
	* return = ADODB dataset object if ok
	* return = false if not ok
	*/
	function getDischargeTypesData(){
		global $db;
		$this->sql="SELECT nr,name,LD_var FROM $this->tb_dis_type WHERE 1 ORDER BY nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return $this->result;
			}else{return false;}
		}else{return false;}
	}		
	/**
	* Complete discharge
	* - private function
	* Avoid using this function directly. Use the approprite API functions
	*/
	function _discharge($enr,$loc_types,$d_type_nr,$date='',$time=''){
		global $HTTP_SESSION_VARS;
		if(empty($date)) $date=date('Y-m-d');
		if(empty($time)) $time=date('H:i:s');
		$this->sql="UPDATE $this->tb_location
							SET	discharge_type_nr=$d_type_nr,
									date_to='$date',
									time_to='$time',
									history=CONCAT(history,'Update (discharged): ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n'),
									modify_id='".$HTTP_SESSION_VARS['sess_user_name']."'
							WHERE encounter_nr=$enr AND type_nr IN ($loc_types) AND date_to IN ('','0000-00-00')";
		if($this->Transact($this->sql)) return true; else echo $this->sql;
		//return $this->Transact($this->sql);
	}
	/**
	* Complete discharge of patient from the hospital or clinic
	*/
	function Discharge($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'1','2','3','4','5','6'",$d_type_nr,$date,$time)){
			if($this->setIsDischarged($enr)){
				return true;
			}else{return false;}
		}else{return false;}
	}
	/**
	* Complete discharge of patient from the department, but patient remains current
	*/
	function DischargeFromDept($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'1','2','3','4','5','6'",$d_type_nr,$date,$time)){
			return true;
		}else{return false;}
	}
	/**
	* Complete discharge of patient from the ward but patient remains current
	*/
	function DischargeFromWard($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'2','4','5','6'",$d_type_nr,$date,$time)){
			return true;
		}else{return false;}
	}
	/**
	* Complete discharge of patient from the room but patient remains in ward
	*/
	function DischargeFromRoom($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'4','5','6'",$d_type_nr,$date,$time)){
			return true;
		}else{return false;}
	}
	/**
	* Complete discharge of patient from the bed but patient remains in room
	* Alias of DischargeFromBed()
	*/
	function DischargeFromBed($enr,$d_type_nr,$date='',$time=''){
		if($this->_discharge($enr,"'5'",$d_type_nr,$date,$time)){
			return true;
		}else{return false;}
	}
	/**
	* saveDischargeNotesFromArray() saves the discharge notes of an encounter
	* the data must be contained first in an array and passed to the function by reference
	* @param $data_array (array) = the data in the array
	* return true/false
	*/
	function saveDischargeNotesFromArray(&$data_array){
		$this->setTable($this->tb_notes);
		$this->data_array=$data_array;
		$this->setRefArray($this->fld_notes);
		if($this->_insertNotesFromInternalArray(3)){ // 3 = discharge summary note type
			return true;
		}else{
			return false;
		}
	}
	function getLoadedEncounterData(){
		if($this->is_loaded){
			return $this->encounter;
		}else{return false;}
	}	
	/**
	* getBasic4Data() returns an adodb object containing the encounter's first name, family name, birth date and sex
	* param $enc_nr = the encounter number
	*/
	function getBasic4Data($enc_nr){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT p.name_last, p.name_first, p.date_birth, p.sex
							FROM $this->tb_enc AS e, 
									 $this->tb_person AS p 
							WHERE e.encounter_nr=$this->enc_nr
								AND e.pid=p.pid";
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* useSicknessConfirm() points  the core to the care_encounter_sickconfirm table and fields
	* public
	* return void
	*/
	function useSicknessConfirm(){
		$this->coretable=$this->tb_sickconfirm;
		$this->ref_array=$this->fld_sickconfirm;
	}	
	/**
	* getSicknessConfirm() gets a stored sickness confirmations of an encounter
	* public
	* @param $nr (int) = the item nr of the record , if $nr=0 return false
	* return ADODB record object or false
	*/
	function getSicknessConfirm($nr=0){
	    global $db;
		if(!$nr) return false;
		$this->sql="SELECT s.*,d.sig_stamp,d.logo_mime_type 
							FROM $this->tb_sickconfirm AS s 
							LEFT JOIN $this->tb_dept AS d ON s.dept_nr=d.nr
							WHERE s.nr=$nr";
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* allSicknessConfirm() gets all stored sickness confirmations of an encounter
	* public
	* @param $dept_nr (int) = the department id number , if $dept_nr==0 all records for the encounter nr will be fetched
	* @param $enc_nr (int) = encounter number
	* return ADODB record object or false
	*/
	function allSicknessConfirm($dept_nr=0,$enc_nr=0){
	    global $db;
		//if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT s.*,d.LD_var,d.name_formal,d.sig_stamp,d.logo_mime_type
						FROM $this->tb_sickconfirm AS s
							LEFT JOIN $this->tb_dept AS d ON s.dept_nr=d.nr
						WHERE s.encounter_nr=$this->enc_nr AND s.status NOT IN ($this->dead_stat)";
		if($dept_nr) $this->sql=$this->sql." AND s.dept_nr=$dept_nr";
		$this->sql.=' ORDER BY s.date_confirm DESC';
		
		//echo $this->sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* saveSicknessConfirm() saves a sickness confirmation of an encounter
	* public
	* @param $data (array) = the data in arrray, passed by reference
	* return true/false;
	*/
	function saveSicknessConfirm(&$data){
		if(!is_array($data)) return false;
		$this->useSicknessConfirm();
		$data['date_create']=date('Y-m-d H:i:s');
		$this->data_array=$data;
		return $this->insertDataFromInternalArray();
	}
	/**
	* EncounterInsuranceData() returns the insurance relevant data of an encounter
	* public
	* @param $enc_nr (int) = encounter number
	* return adodb object or false
	*/
	function EncounterInsuranceData($enc_nr=0){
	    global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return false;
		$this->sql="SELECT e.insurance_nr, i.name, i.sub_area FROM $this->tb_enc  AS e
							LEFT JOIN $this->tb_insco AS i ON e.insurance_firm_id=i.firm_id
						WHERE e.encounter_nr=$this->enc_nr AND e.status NOT IN ($this->dead_stat)";	
		//echo $sql;
		if($this->result=$db->Execute($this->sql)) {
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	 
}
?>
