<?php
/**
* class Image
*  extends Core
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Image extends Core{

	var $tb_image='care_encounter_image'; # table for encounter's images
	var $mimefilter='jpg,gif,png,bmp'; # allowed mime types
	var $ul_img_ext=''; # uploaded img file's extension/mime type
	var $def_root_path='fotos/encounter/'; # default root path for images
	
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
	/**
	* Constructor
	*/
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
	/**
	* saveImageData() saves all data pertinent to the image
	* public
	* @param $data (array) = the data in array
	* return last insert ID / false
	*/
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
	/**
	* getAllImageData() gets all data from the care_encounter_image table which are pertinent to the encounter
	* public
	* @param $enc_nr (int) = encounter number
	* @param $shot_date = the shot date of the image
	* return ADODB record object
	*/
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
		    }else{ return false;}
		}else{ return false;}
	}
	/**
	* isValidUploadedImage() checks whether the uploaded image file is valid or not
	* public
	* the file's extension/mime type will be extracted and saved in the objects ul_img_ext variable
	* @param $img (array) (pass by reference) the image pointer, usually $HTTP_POST_FILES
	* @param $mfilter (str)  optional filter mime types, if empty, default will be used
	* return true/false
	*/
	function isValidUploadedImage(&$img,$mfilter=''){
		if(empty($mfilter)) $mfilter=$this->mimefilter;
		if(is_uploaded_file($img['tmp_name']) && $img['size']){
			$this->ul_img_ext=substr($img['name'],strrpos($img['name'],'.')+1);
			if(stristr($mfilter,$this->ul_img_ext)){
				return true;
		    }else{ return false;}
		}else{ return false;}
	}
	/**
	* UploadedImageMimeType() returns the mime type of the uploaded image file
	* public
	* return the mime type/file extension
	*/
	function UploadedImageMimeType(){
		return $this->ul_img_ext;
	}
	/**
	* saveUploadedImage() saves the uploaded image with the given filename into a given path
	* public
	* @param $img (array) (pass by reference) the image file in array (usually $HTTP_POST_FILES)
	* @param $fpath (string) the complete path for the stored image. If empty, the default will be used
	* @param $fname (string) thefilename of the stored image. If empty, the original file name will be used
	*/
	function saveUploadedImage(&$img,$fpath='',$fname=''){
		if(empty($fpath)) $fpath=$this->def_root_path;
		if(empty($fname)) return copy($img['tmp_name'],$fpath.$img['name']);
	 		else return copy($img['tmp_name'],$fpath.$fname);
	}
}
?>
