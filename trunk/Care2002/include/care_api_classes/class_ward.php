<?php
/* API class for core functions. Will be extended by other classes 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');

class Ward extends Encounter {

    var $tb_ward='care_ward';
	var $tb_dept='care_department';
	var $tb_room='care_room';
	var $tb_notes='care_encounter_notes';
	var $ward_nr;
	var $dept_nr;
	//var $ok; // is within core
	//var $sql;  // is within core
	//var $result; // is within core

	function Ward($ward_nr) {
	    $this->ward_nr=$ward_nr;
		$this->Encounter();
	}	
	
	function setDeptNr($dept_nr) {
	    $this->dept_nr=$dept_nr;
	}

	
	function getAllWardsItemsObject(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->tb_ward WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	
	
	function getAllWardsDataObject() {
	    global $db;
	    $this->sql="SELECT *  FROM $this->tb_ward WHERE 1)";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else { return false; }
		} else { return false; }
	}
	
	function getAllWardsItemsArray(&$items) {
	    global $db;
	    $this->sql="SELECT $items  FROM $this->tb_ward WHERE 1";
        //echo $this->sql;
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 while($this->buffer_array[]=$this->result->FetchRow());
				 return $this->buffer_array; 
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
		$this->sql="SELECT * FROM $this->tb_ward WHERE nr=$ward_nr AND status NOT IN ('delete','hide','inactive','void')";
        if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result->FetchRow();	 
			} else { return false; }
		} else { return false; }
	}	
	function getRoomInfo($ward_nr,$s_nr,$e_nr){
		global $db;
		$this->sql="SELECT * FROM $this->tb_room WHERE type_nr=1 AND ward_nr=$ward_nr AND room_nr  BETWEEN '$s_nr' AND '$e_nr' AND  status NOT IN ('delete','hide','inactive','void') ORDER BY room_nr";
		if($this->result=$db->Execute($this->sql)) {
            if($this->result->RecordCount()) {
				 return $this->result;	 
			} else {return false; }
		} else {return false; }
	}	
	function getWardOccupants($ward_nr){
		global $db;
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
									e.insurance_class_nr,
									i.name AS insurance_name,
									i.LD_var AS insurance_LDvar,
									n.nr AS ward_notes
							FROM $this->tb_location AS r 
									LEFT JOIN $this->tb_location AS b  ON 	(r.encounter_nr=b.encounter_nr
																								AND r.group_nr=b.group_nr 
																								AND	b.type_nr=5 
																								AND b.status NOT IN ('hidden','deleted','inactive','void')
										 														AND b.date_to IN ('0000-00-00','')
																								)	
									LEFT JOIN $this->tb_enc AS e ON b.encounter_nr=e.encounter_nr
									LEFT JOIN $this->tb_person AS p ON e.pid=p.pid
									LEFT JOIN $this->tb_ic AS i ON e.insurance_class_nr=i.class_nr
									LEFT JOIN $this->tb_notes AS n ON b.encounter_nr=n.encounter_nr AND n.type_nr=6
							WHERE  r.group_nr=$ward_nr 
											AND	r.type_nr=4 
											AND r.status NOT IN ('hidden','deleted','inactive','void')
										 	AND r.date_to IN ('0000-00-00','')
							/*GROUP BY r.location_nr*/
							ORDER BY r.location_nr,b.location_nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				//echo $this->result->RecordCount();
				return $this->result;
			}else{
				//echo $this->sql.'no count';
				return false;
			}
		}else{echo $this->sql.'no sql';return false;}
	}
	function exitBed($loc_nr){
	}
	function exitRoom($loc_nr){
	}
	function exitWard($loc_nr){
	}
	function closeBed($ward_nr,$room_nr,$bed_nr){
		$this->sql="UPDATE $this->tb_room SET closed_beds=CONCAT(closed_beds,'$bed_nr/') WHERE type_nr=1 AND room_nr=$room_nr AND ward_nr=$ward_nr";
		//echo $this->sql;
		if( $this->Transact($this->sql)) return true; else echo $this->sql;
		//return $this->Transact($this->sql);
	}
	function openBed($ward_nr,$room_nr,$bed_nr){
		$this->sql="UPDATE $this->tb_room SET closed_beds=REPLACE(closed_beds,'$bed_nr/','') WHERE type_nr=1 AND room_nr=$room_nr AND ward_nr=$ward_nr";
		if( $this->Transact($this->sql)) return true; else echo $this->sql;
		//return $this->Transact($this->sql);
	}
}
