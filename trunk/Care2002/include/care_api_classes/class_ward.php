<?php
/* API class for core functions. Will be extended by other classes 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');

class Ward extends Encounter {

    var $tb_ward='care_ward';
	var $tb_dept='care_department';
	var $tb_room='care_room';
	var $tb_notes='care_encounter_notes';
	var $ward_nr;
	var $dept_nr;
	var $techinfo;
	//var $ok; // is within core
	//var $sql;  // is within core
	//var $result; // is within core
	
	var $fld_ward=array('nr',
									'ward_id',
									'name',
									'is_temp_closed',
									'date_create',
									'date_close',
									'description',
									'info',
									'dept_nr',
									'room_nr_start',
									'room_nr_end',
									'maxbed',
									'roomprefix',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/* Field names of table care_room */
	var $fld_room=array('nr',
									'type_nr',
									'date_create',
									'date_close',
									'is_temp_closed',
									'room_nr',
									'ward_nr',
									'dept_nr',
									'nr_of_beds',
									'info',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	/* Constructor */
	function Ward($ward_nr) {
	    $this->ward_nr=$ward_nr;
		$this->Encounter();
	}	
	
	function setDeptNr($dept_nr) {
	    $this->dept_nr=$dept_nr;
	}
	function _useWard(){
		$this->ref_array=&$this->fld_ward;
		$this->coretable=$this->tb_ward;
	}
	function getAllWardsItemsObject(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->tb_ward WHERE status NOT IN ($this->dead_stat)";
        //echo $this->sql;
        if($this->res['gawio']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gawio']->RecordCount()) {
				 return $this->res['gawio'];	 
			} else { return false; }
		} else { return false; }
	}
	function getAllWardsDataObject() {
	    global $db;
	    $this->sql="SELECT w.*,d.name_formal AS dept_name  FROM $this->tb_ward AS w LEFT JOIN $this->tb_dept AS d ON w.dept_nr=d.nr
				 WHERE w.status NOT IN ('closed','deleted','hidden','inactive','void')";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	function getAllWardsItemsArray(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->tb_ward WHERE  status NOT IN ('hidden','deleted','closed','inactive')";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result->GetArray(); 
			} else { return false; }
		} else { return false; }	
	}
		
	function getAllWardsDataArray() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->tb_ward WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->buffer_array=$this->result->FetchRow());
				 return $this->buffer_array; 
			} else { return false; }
		} else { return false; }
    }/**/

	function WardName($nr){
	    global $db;
		if(empty($nr)) return false;
        if($this->result=$db->Execute("SELECT name FROM $this->tb_ward WHERE nr=$nr")) {
            if($this->result->RecordCount()) {
				 $this->row=$this->result->FetchRow();
				 return $this->row['name'];	 
			} else { return false; }
		} else { return false; }
	}
	function getWardInfo($ward_nr){
		global $db;
		$this->sql="SELECT w.*,d.name_formal AS dept_name FROM $this->tb_ward AS w LEFT JOIN $this->tb_dept AS d ON w.dept_nr=d.nr
					WHERE w.nr=$ward_nr AND w.status NOT IN ('closed',$this->dead_stat)";
        if($this->res['gwi']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['gwi']->RecordCount()) {
				 return $this->res['gwi']->FetchRow();	 
			} else { return false; }
		} else { return false; }
	}	
	function getRoomInfo($ward_nr,$s_nr,$e_nr){
		global $db;
		$this->sql="SELECT * FROM $this->tb_room WHERE type_nr=1 AND ward_nr=$ward_nr AND room_nr  BETWEEN '$s_nr' AND '$e_nr' AND  status NOT IN ('closed','deleted','hidden','inactive','void') ORDER BY room_nr";
		if($this->result=$db->Execute($this->sql)) {
            if($this->rec_count=$this->result->RecordCount()) {
				 return $this->result;	 
			} else {return false; }
		} else {return false; }
	}	
	function _getWardOccupants($ward_nr,$date){
		global $db;
		
		if($date==date('Y-m-d')) $pstat='discharged';
			else $pstat='dummy';
			
		$this->sql="SELECT r.location_nr AS room_nr,
									r.nr AS room_loc_nr,
									b.location_nr AS bed_nr, 
									b.encounter_nr,
									b.nr AS bed_loc_nr,
									p.name_last,
									p.name_first,
									p.date_birth,
									p.title,
									p.sex,
									p.photo_filename,
									e.insurance_class_nr,
									i.name AS insurance_name,
									i.LD_var AS insurance_LDvar,
									n.nr AS ward_notes
							FROM $this->tb_location AS r 
									LEFT JOIN $this->tb_location AS b  ON 	(r.encounter_nr=b.encounter_nr
																								AND r.group_nr=b.group_nr 
																								AND	b.type_nr=5 
																								AND b.status NOT IN ('$pstat','closed',$this->dead_stat)
																								AND b.date_from<='$date'
										 														AND ('$date'<=b.date_to OR b.date_to IN ('0000-00-00',''))
																								)	
									LEFT JOIN $this->tb_enc AS e ON b.encounter_nr=e.encounter_nr
									LEFT JOIN $this->tb_person AS p ON e.pid=p.pid
									LEFT JOIN $this->tb_ic AS i ON e.insurance_class_nr=i.class_nr
									LEFT JOIN $this->tb_notes AS n ON b.encounter_nr=n.encounter_nr AND n.type_nr=6
							WHERE  r.group_nr=$ward_nr 
											AND	r.type_nr=4 
											AND r.status NOT IN ('$pstat','closed',$this->dead_stat)
										 	AND ('$date'<=r.date_to OR r.date_to IN ('0000-00-00',''))
							/*GROUP BY r.location_nr*/
							ORDER BY r.location_nr,b.location_nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->rec_count=$this->result->RecordCount()){
				//echo $this->result->RecordCount();
				//echo $this->sql.'  count';
				return true;
			}else{
				//echo $this->sql.'no count';
				return false;
			}
		}else{echo $this->sql.'no sql';return false;}
	}
	function getDayWardOccupants($ward_nr,$date=''){
		if(empty($date)) $date=date('Y-m-d');
		if($this->_getWardOccupants($ward_nr,$date)){
			return $this->result;
		}else{return false;}
	}
	function exitBed($loc_nr){
	}
	function exitRoom($loc_nr){
	}
	function exitWard($loc_nr){
	}
	function closeBed($ward_nr,$room_nr,$bed_nr){
		$this->sql="UPDATE $this->tb_room SET closed_beds=CONCAT(closed_beds,'$bed_nr/') WHERE type_nr=1 AND room_nr=$room_nr AND ward_nr=$ward_nr";
		//if( $this->Transact($this->sql)) return true; else echo $this->sql;
		return $this->Transact($this->sql);
	}
	function openBed($ward_nr,$room_nr,$bed_nr){
		$this->sql="UPDATE $this->tb_room SET closed_beds=REPLACE(closed_beds,'$bed_nr/','') WHERE type_nr=1 AND room_nr=$room_nr AND ward_nr=$ward_nr";
		//if( $this->Transact($this->sql)) return true; else echo $this->sql;
		return $this->Transact($this->sql);
	}
	function saveWard(&$data){
		global $HTTP_SESSION_VARS;
		$this->_useWard();
		$this->data_array=$data;
		$this->data_array['date_create']=date('Y-m-d');
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_time']=NULL;
		return $this->insertDataFromInternalArray();
	}
	/**
	* updateWard()
	* updates the ward's data
	* param nr = the ward's record nr.
	* param data =  2 dimensional array of the data passed as reference
	* return = true on success, else false on failure
	*/
	function updateWard($nr,&$data){
		global $HTTP_SESSION_VARS;
		$this->_useWard();
		$this->data_array=$data;
		// remove probable existing array data to avoid replacing the stored data
		if(isset($this->data_array['date_create'])) unset($this->data_array['date_create']);
		if(isset($this->data_array['create_id'])) unset($this->data_array['create_id']);
		// clear the where condition
		$this->where='';
		$this->data_array['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		return $this->updateDataFromInternalArray($nr);
	}
	/**
	* IDExists() checks if the ward id is existing
	* param id = the supplied ward id
	* return = true/false
	*/
	function IDExists($id){
		global $db;
		$this->sql="SELECT ward_id FROM $this->tb_ward WHERE ward_id='$id' AND status NOT IN ('closed','inactive','void','deleted','hidden')";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			}else{return false;}
		}else{return false;}
	}
	/** 
	* hasPatient() checks if there is at least one patient admitted in the ward
	* param nr = the ward nr
	* return = the number of currently admitted patients,else false if no patient
	*/
	function hasPatient($nr){
		global $db;
		$this->sql="SELECT nr FROM $this->tb_location 
						WHERE type_nr=4 
							AND group_nr=$nr 
							AND date_from NOT  IN  ('0000-00-00','') 
							AND date_to  IN  ('0000-00-00','') 
							AND status NOT IN ('closed','inactive','void','hidden','deleted')";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			}else{return false;}
		}else{return false;}
	}
	/**
	* _isSetTemporaryClosed() toggles the is_temp_closed field of the care_ward table
	* [private]
	* param nr = the ward number
	* param flag = 1 for temporary closed, 0 for open
	* return = true on success, else false
	*/
	function _setIsTemporaryClosed($nr,$flag=1){
		global $HTTP_SESSION_VARS;
		$this->_useWard();
		// clear the where condition
		$this->where='';
		$data['is_temp_closed']=$flag;
		if($flag){
			$action='Closed temporary';
		}else{
			$action='Reopened';
		}
		$data['history']="CONCAT(history,'$action: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		$data['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array=$data;
		return $this->updateDataFromInternalArray($nr);
	}
	/**
	* closeWardTemporary() closes a ward temporarily
	* param nr = the ward number
	* return = true on success, else false
	*/
	function closeWardTemporary($nr){
			return $this->_setIsTemporaryClosed($nr,1);
	}
	/**
	* reOpenWard() reopens a ward that was previously closed temporarily 
	* param nr = the ward number
	* return = true on success, else false
	*/
	function reOpenWard($nr){
			return $this->_setIsTemporaryClosed($nr,0);
	}
	function closeWardNonReversible($nr){
		global $HTTP_SESSION_VARS;
		$this->_useWard();
		// clear the where condition
		$this->where='';
		$data['date_close']=date('Y-m-d');
		$data['status']='inactive';
		$data['history']="CONCAT(history,'Closed nonreversible: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		$data['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array=$data;
		return $this->updateDataFromInternalArray($nr);
	}
	function getAllActiveWards() {
	    global $db;
	    $this->sql="SELECT w.*,d.name_formal AS dept_name
						FROM $this->tb_ward AS w 
							LEFT JOIN $this->tb_dept AS d ON w.dept_nr=d.nr
				 		WHERE w.status NOT IN ('closed','inactive','void','hidden','deleted')";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	function countCreatedRooms(){
	    global $db;
		$this->sql="SELECT r.room_nr,COUNT(*) AS nr_rooms,w.nr 
							FROM $this->tb_room AS r 
								LEFT JOIN $this->tb_ward AS w ON w.nr=r.ward_nr
							WHERE r.status NOT IN ('closed','inactive','void','hidden','deleted') 
							GROUP BY w.nr ORDER by w.nr";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	function saveWardRoomInfoFromArray(&$data){
		$this->coretable=$this->tb_room;
		$this->ref_array=$this->fld_room;
		$this->data_array=$data;
		$this->data_array['type_nr']=1; // 1 = ward room type nr
		return $this->insertDataFromInternalArray();
	}
	function RoomExists($room_nr=0,$ward_nr=0){
	    global $db;
		if(!$room_nr) return false;
		if($ward_nr) $this->ward_nr=$ward_nr;
			elseif(!$this->ward_nr) return false;
		$this->sql="SELECT room_nr FROM $this->tb_room 
							WHERE ward_nr=$this->ward_nr 
								AND room_nr=$room_nr 
								AND date_close IN ('0000-00-00','') 
								AND status NOT IN ('inactive','closed','void','hidden','deleted')";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return true;
			} else { return false; }
		} else { return false; }
	}
	/**
	* Gets one/all active (not closed) room(s) information
	* [private]
	* param room_nr = the room number. If supplied, the open room's info will be returned, else all open rooms info will be returned.
	* param ward_nr = the ward number (optional). Used if supplied, else the ward number set by the constructor will used
	* return true = if room(s) found.  The result is stored in the internal result variable and returned by a public function
	* return false = if ward_nr is 0 AND internal ward_nr is 0
	* return false = if no open room(s) found
	*/
	function _getActiveRoomInfo($room_nr=0,$ward_nr=0){
	    global $db;
		if($ward_nr) $this->ward_nr=$ward_nr;
			elseif(!$this->ward_nr) return false;
		$this->sql="SELECT * FROM $this->tb_room 
							WHERE ward_nr=$this->ward_nr";
							
		if($room_nr) $this->sql.=" AND room_nr=$room_nr";
		
		$this->sql.="  AND date_close IN ('0000-00-00','') 
							AND status NOT IN ('inactive','closed','void','hidden','deleted')";
							
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return true;
			} else { return false; }
		} else { return false; }
	}
	/** 
	* Gets all active rooms information
	* [public]
	* param ward_nr = the ward's number
	* return result object = if rooms found
	* return false = if no room found
	*/
	function getAllActiveRoomsInfo($ward_nr=0){
        if($this->_getActiveRoomInfo(0,$ward_nr)) {
			return $this->result;
		} else { return false; }
	}
	/** 
	* Gets one active room information
	* [public]
	* param room_nr = the room's number
	* param ward_nr = the ward's number
	* return result object = if room found
	* return false = if room_nr is 0
	* return false = if no room found
	*/
	function getActiveRoomInfo($room_nr=0,$ward_nr=0){
		if(!$room_nr) return false;
        if($this->_getActiveRoomInfo($room_nr,$ward_nr)) {
			return $this->result;
		} else { return false; }
	}
	/**
	* countBeds() counts all beds available to the ward
	* public
	* @param $ward_nr (int ) = the ward nr of the ward
	* return number of bed (int)
	*/
	function countBeds($ward_nr){
	    global $db;
		$this->sql="SELECT SUM(nr_of_beds) AS nr FROM $this->tb_room WHERE ward_nr=$ward_nr AND NOT is_temp_closed AND status NOT IN ($this->dead_stat)";
        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				$row=$buf->FetchRow();
				 return $row['nr'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* createWaitingList() creates a list of patients waiting to be assigned a room or bed 
	* public
	* @param $ward_nr (int) = the nr of the ward. If zero, all waiting patients regardless of ward preassignment will be returned
	* return adodb record set
	*/
	function createWaitingInpatientList($ward_nr=0){
		global $db;
		if($ward_nr) $cond="AND current_ward_nr='$ward_nr'";
			else $cond='';
		//if(empty($key)) return false;
		$this->sql="SELECT e.encounter_nr, e.encounter_class_nr, e.current_ward_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.sex,w.ward_id
				FROM $this->tb_enc AS e 
					LEFT JOIN $this->tb_person AS p ON e.pid=p.pid
					LEFT JOIN $this->tb_ward AS w ON e.current_ward_nr=w.nr
				WHERE e.encounter_class_nr='1' AND NOT e.is_discharged $cond AND NOT in_ward";
		//echo $sql;
	    if ($this->res['_cwil']=$db->Execute($this->sql)){
		   	if ($this->rec_count=$this->res['_cwil']->RecordCount()){
				return $this->res['_cwil'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* EncounterLocationsInfo() returns the current dept id, dept name, ward id, ward name, room and bed number of an encounter
	* @public
	* @param $enc_nr (int) encounter number
	* return row in assoc array
	*/
	function EncounterLocationsInfo($enc_nr){
		global $db;

		$this->sql="SELECT w.ward_id,w.name AS ward_name, w.roomprefix,
							d.id AS dept_id,d.name_formal AS dept_name,
							r.location_nr AS room_nr, b.location_nr AS bed_nr
				FROM $this->tb_enc AS e 
					LEFT JOIN $this->tb_ward AS w ON e.encounter_class_nr=1 AND e.current_ward_nr=w.nr
					LEFT JOIN $this->tb_dept AS d ON (e.encounter_class_nr=1 AND e.current_ward_nr=d.nr) 
																	OR	(e.encounter_class_nr=2 AND e.current_dept_nr=d.nr)
					LEFT JOIN $this->tb_location AS r ON r.encounter_nr=$enc_nr AND r.group_nr=w.nr AND r.type_nr=4 AND r.status<>'discharged'
					LEFT JOIN $this->tb_location AS b ON b.encounter_nr=$enc_nr AND  b.group_nr=w.nr AND b.type_nr=5 AND b.status<>'discharged'
					WHERE e.encounter_nr=$enc_nr AND e.status NOT IN ($this->dead_stat)";
		//echo $sql;
	    if ($this->res['eli']=$db->Execute($this->sql)){
		   	if ($this->rec_count=$this->res['eli']->RecordCount()){
				return $this->res['eli']->FetchRow();
			}else{return false;}
		}else{return false;}
	}
}
