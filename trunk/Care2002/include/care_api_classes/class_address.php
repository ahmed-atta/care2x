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
									
	/**
	* Constructor
	*/
	function Address($nr){
		$this->coretable=$this->tb_citytown;
		$this->ref_array=$this->fld_citytown;
	}
	function _useCityTown(){
		$this->coretable=$this->tb_citytown;
		$this->ref_array=$this->fld_citytown;
	}
	/**
	* Gets all active city town addresses
	*/
	function getAllActiveCityTown(){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_citytown WHERE status NOT IN ('inactive','hidden','deleted','void')";
	    if ($this->res['gaact']=$db->Execute($this->sql)) {
		    if ($this->rec_count=$this->res['gaact']->RecordCount()) {
		        return $this->res['gaact'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Same as getAllActiveCityTown but uses the limit feature of adodb 
	* @param $len = length of data, or number of rows to be returned, default 30 rows
	* @param $so = start index offset, default 0 = start index
	* @param $oitem = order item, default = name
	* @param $odir = order direction, default = ASC
	*/
	function getLimitActiveCityTown($len=30,$so=0,$oitem='name',$odir='ASC'){
	    global $db;
		$this->sql="SELECT * FROM $this->tb_citytown WHERE status NOT IN ('inactive','hidden','deleted','void') ORDER BY $oitem $odir";
	    if ($this->res['glact']=$db->SelectLimit($this->sql,$len,$so)) {
		    if ($this->rec_count=$this->res['glact']->RecordCount()) {
		        return $this->res['glact'];
			}else{return false;}
		}else{return false;}
	}
	/**
	* Counts all active city town addresses
	* returns the count, else return zero 
	*/
	function countAllActiveCityTown(){
	    global $db;
		$this->sql="SELECT nr FROM $this->tb_citytown WHERE status NOT IN ($this->dead_stat)";
	    if ($this->res['caact']=$db->Execute($this->sql)) {
		    return $this->res['caact']->RecordCount();
		}else{return 0;}
	}
	function CityTownExists($name='',$country='') {
	    global $db;
	    if(empty($name)) return false;
		$this->sql="SELECT nr FROM $this->tb_citytown WHERE name LIKE '$name' AND iso_country_id LIKE '$country'";
	    if($buf=$db->Execute($this->sql)) {
	        if($buf->RecordCount()) {
			    return true;
		    } else { return false; }
	   } else { return false; }
   }
	function getCityTownInfo($nr='') {
	    global $db;
	    if(empty($nr)) return false;
		$this->sql="SELECT * FROM $this->tb_citytown WHERE nr=$nr";
	    if($this->res['gcti']=$db->Execute($this->sql)) {
	        if($this->res['gcti']->RecordCount()) {
			    return $this->res['gcti'];
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
	/**
	* Searches for the active city or town
	* @param $key (char) the search keyword
	*/
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
	/**
	* Limited return search for the active city or town
	* @param $key (char) the search keyword
	* @param $len (int) the max nr of rows returned, default=30
	* @param $so (int)  start index offset, defaut 0 = start
	* @param $oitem (char)  the sort order item, default= name
	* @param $odir (char)  sort direction, default = ASC
	*/
   	function searchLimitActiveCityTown($key,$len=30,$so=0,$oitem='name',$odir='ASC'){
		global $db;
		if(empty($key)) return false;
		$select="SELECT *  FROM $this->tb_citytown ";
		$append=" AND status NOT IN ('inactive','deleted','closed','hidden','void') ORDER BY $oitem $odir";
		$this->sql="$select WHERE ( name LIKE '$key%' OR unece_locode LIKE '$key%' ) $append";
		if($this->res['slact']=$db->SelectLimit($this->sql,$len,$so)){
			if($this->rec_count=$this->res['slact']->RecordCount()){
				return $this->res['slact'];
		    }else{	
				$this->sql="$select WHERE ( name LIKE '%$key' OR unece_locode LIKE '%$key' ) $append";
				if($this->res['slact']=$db->SelectLimit($this->sql,$len,$so)){
					if($this->rec_count=$this->res['slact']->RecordCount()){
						return $this->res['slact'];
					}else{
						$this->sql="$select WHERE ( name LIKE '%$key%' OR unece_locode LIKE '%$key%' ) $append";
						if($this->res['slact']=$db->SelectLimit($this->sql,$len,$so)){
							if($this->rec_count=$this->res['slact']->RecordCount()){
								return $this->res['slact'];
							}else{return false;}
						}else{return false;}
					}
				}else{return false;}
			}
	   } else { return false; }
   	}
	/**
	* Searches for the active city or town but returns only the total count
	* @param $key (char) the search keyword
	* Returns the count value, else returns zero
	*/
   	function searchCountActiveCityTown($key){
		global $db;
		if(empty($key)) return false;
		$select="SELECT nr FROM $this->tb_citytown ";
		$append=" AND status NOT IN ('inactive','deleted','closed','hidden','void')";
		$this->sql="$select WHERE ( name LIKE '$key%' OR unece_locode LIKE '$key%' ) $append";
		if($this->res['scact']=$db->Execute($this->sql)){
			if($this->rec_count=$this->res['scact']->RecordCount()){
				return $this->rec_count;
			}else{	
				$this->sql="$select WHERE ( name LIKE '%$key' OR unece_locode LIKE '%$key' ) $append";
				if($this->res['scact']=$db->Execute($this->sql)){
					if($this->rec_count=$this->res['scact']->RecordCount()){
						return $this->rec_count;
					}else{
						$this->sql="$select WHERE ( name LIKE '%$key%' OR unece_locode LIKE '%$key%' ) $append";
						if($this->res['scact']=$db->Execute($this->sql)){
							if($this->rec_count=$this->res['scact']->RecordCount()){
								return $this->rec_count;
							}else{return 0;}
						}else{return 0;}
					}
				}else{return 0;}
			}
		}else{return 0;}
	}
}
?>
