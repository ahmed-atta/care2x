<?php
/**
* class Image
*  extends Core
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Image extends Core{

	var $tb_image='care_encounter_image';
	
	var $fld_image=array('nr',
											'encounter_nr',
											'shot_date',
											'shot_nr',
											'mime_type',
											'upload_date',
											'notes',
											'status',
											'history',
											'modify_id',
											'modify_time',
											'create_id',
											'create_time');
	function Image(){
		$this->coretable=$this->tb_image;
		$this->ref_array=$this->fld_image;
	}
	/**
	*  Checks if the image notes record exists in the table
	*  return true if  record is availabe (note it returns true even if the notes fields is empty)
	*/
	function ImageNotesExists(&$data){
		global $db;
		$row=array();
		$this->sql="SELECT nr FROM $this->tb_image WHERE encounter_nr=".$data['encounter_nr']." AND shot_date='".$data['shot_date']."' AND shot_nr=".$data['shot_nr'];
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				$row=$this->result->FetchRow();
				return $row['nr'];
		    } else { return false;}
		} else { return false;}
	}
	function updateImageNotes(&$data){
	    global $db;
		if(empty($data['notes'])){
			return false;
		}else{
			$this->data_array=$data;
			$nr=$this->data_array['nr'];
			unset($this->data_array['nr']);
			$this->data_array['notes']="CONCAT(notes,'[[".date('Y-m-d')."]]\n [[".$this->data_array['modify_id']."]]\n ".$this->data_array['notes']."\n')";
			return $this->updateDataFromInternalArray($nr);
		}
		
	}
	/**
	* Gets the image' s data from the table
	* param mixed $nr = int or array
	* return adodb record object
	*/
	function getImageData(&$data){
		global $db;
		if(is_array($data)){
			$this->sql="SELECT * FROM $this->tb_image WHERE encounter_nr=".$data['encounter_nr']." AND shot_date='".$data['shot_date']."' AND shot_nr=".$data['shot_nr'];
		}else{
			$this->sql="SELECT * FROM $this->tb_image WHERE nr=$data";
		}
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
	/**
	* Gets the last shot nr of an image data by encounter nr and shot date
	* param array $data = passed by reference
	* $data = array, contains at least the ff: indexes: 'enc_nr' => encounter number, 'shot_date' => shot date
	* return adodb record object
	*/
	function getLastShotNr(&$data){
		global $db;
		$this->sql="SELECT shot_nr FROM $this->tb_image WHERE encounter_nr=".$data['encounter_nr']." AND shot_date='".$data['shot_date']."' ORDER BY shot_nr DESC";
		if($this->result=$db->SelectLimit($this->sql,1)) {
		    if($this->result->RecordCount()) {
				$row=$this->result->FetchRow();
				return $row['shot_nr'];
		    } else { return false;}
		} else { return false;}
	}
	function saveImageData(&$data){
	    global $db;
		$nr;
		if($nr=$this->getLastShotNr($data)){
			$data['shot_nr']=$nr+1;
		}else{
			$data['shot_nr']=1;
		}
		$this->data_array=$data;
		if($this->insertDataFromInternalArray()){
			return $db->Insert_ID();
		}else{
			return false;
		}
	}
	function getAllImageData($enc_nr,$shot_date=0){
		global $db;
		if($shot_date){
			$this->sql="SELECT * FROM $this->tb_image WHERE encounter_nr=$enc_nr AND shot_date='$shot_date' ORDER BY shot_date DESC";
		}else{
			$this->sql="SELECT * FROM $this->tb_image WHERE encounter_nr=$enc_nr ORDER BY shot_date DESC";
		}
		if($this->result=$db->Execute($this->sql)) {
		    if($this->result->RecordCount()) {
				return $this->result;
		    } else { return false;}
		} else { return false;}
	}
}
?>
