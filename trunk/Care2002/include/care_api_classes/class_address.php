<?php
/* API class for user configuration data 
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Address extends Core {

	var $tb_citytown='care_address_citytown'; // table name
	var $fld_citytown=array(
									'nr',
									'unece_modifier',
									'unece_locode',
									'name',
									'iso_country_id',
									'unece_locode_type',
									'unece_coordinates',
									'info_url',
									'use_frequency',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function Address($nr){
		$this->coretable=$this->tb_citytown;
		$this->ref_array=$this->fld_citytown;
	}
	function _useCityTown(){
		$this->coretable=$this->tb_citytown;
		$this->ref_array=$this->fld_citytown;
	}
	function getAllActiveCityTown(){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_citytown WHERE status NOT IN ('inactive','hidden','deleted','void')";
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result;
			}else{return false;}
		}else{return false;}
	}
	function CityTownExists($name='') {
	    global $db;
	    if(empty($name)) return false;
		$this->sql="SELECT nr FROM $this->tb_citytown WHERE name LIKE $name";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
			    return true;
		    } else { return false; }
	   } else { return false; }
   }
	function getCityTownInfo($nr='') {
	    global $db;
	    if(empty($nr)) return false;
		$this->sql="SELECT * FROM $this->tb_citytown WHERE nr=$nr";
	    if($this->result=$db->Execute($this->sql)) {
	        if($this->result->RecordCount()) {
			    return $this->result;
		    } else { return false; }
	   } else { return false; }
   }
	/**
	* Insert new city/town info in the database
	*/
	function saveCityTownInfoFromArray(&$data){
		global $HTTP_SESSION_VARS;
		$this->_useCityTown();
		$this->data_array=$data;
		$this->data_array['history']="Create: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$this->data_array['create_time']='NULL';
		return $this->insertDataFromInternalArray();
	}
	/**
	* updateCityTownInfoFromArray()
	* updates the city/town's data
	* param nr = the city/town's record nr.
	* param data =  2 dimensional array of the data passed as reference
	* return = true on success, else false on failure
	*/
	function updateCityTownInfoFromArray($nr,&$data){
		global $HTTP_SESSION_VARS;
		$this->_useCityTown();
		$this->data_array=$data;
		// remove probable existing array data to avoid replacing the stored data
		if(isset($this->data_array['nr'])) unset($this->data_array['nr']);
		if(isset($this->data_array['create_id'])) unset($this->data_array['create_id']);
		// clear the where condition
		$this->where='';
		$this->data_array['history']="CONCAT(history,'Update: ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n')";
		$this->data_array['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
		return $this->updateDataFromInternalArray($nr);
	}
   	function searchActiveCityTown($key){
		global $db;
		if(empty($key)) return false;
		$select="SELECT *  FROM $this->tb_citytown ";
		$append=" AND status NOT IN ('inactive','deleted','closed','hidden','void')";
		$this->sql="$select WHERE ( name LIKE '$key%' OR unece_locode LIKE '$key%' ) $append";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return $this->result;
		    }else{	
				$this->sql="$select WHERE ( name LIKE '%$key' OR unece_locode LIKE '%$key' ) $append";
				if($this->result=$db->Execute($this->sql)){
					if($this->result->RecordCount()){
						return $this->result;
					}else{
						$this->sql="$select WHERE ( name LIKE '%$key%' OR unece_locode LIKE '%$key%' ) $append";
						if($this->result=$db->Execute($this->sql)){
							if($this->result->RecordCount()){
								return $this->result;
							}else{return false;}
						}else{return false;}
					}
				}else{return false;}
			}
	   } else { return false; }
   	}
}
?>
