<?php
/**
* @package care_api
*/
/** */
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Prescription methods. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Prescription extends Core {
	/**#@+
	* @access private
	* @var string
	*/
	/**
	* Table name for prescription data
	*/
	var $tb='care_encounter_prescription';
	/**
	* Table name for application types
	*/
	var $tb_app_types='care_type_application';
	/**
	* Table name for prescription types
	*/
	var $tb_pres_types='care_type_prescription';
	/**#@-*/
	
	/**#@+
	* @access private
	*/
	/**
	* SQL query result buffer
	* @var adodb record object
	*/
	var $result;
	/**
	* Preloaded department data
	* @var adodb record object
	*/
	var $preload_dept;
	/**
	* Preloaded data flag
	* @var boolean
	*/
	var $is_preloaded=false;
	/**
	* Number of departments
	* @var int
	*/
	var $dept_count;
	/**
	* Field names of care_encounter_prescription table
	* @var int
	*/
	var $tabfields=array('nr',
									'encounter_nr',
									'prescription_type_nr',
									'article',
									'drug_class',
									'order_nr',
									'dosage',
									'application_type_nr',
									'notes',
									'prescribe_date',
									'prescriber',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	/**#@-*/
						
	/**
	* Constructor
	*/
	function Prescription(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	/**
	* Gets all prescription types returned in a 2 dimensional array.
	*
	* The resulting data have the following index keys:
	* - nr = the primary key number
	* - type = prescription type
	* - name = type default name
	* - LD_var = variable's name for the foreign laguange version of type's name
	*
	* @access public
	* @return mixed array or boolean
	*/
	function getPrescriptionTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,type,name,LD_var AS \"LD_var\" FROM $this->tb_pres_types")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	/**
	* Gets all application types returned in a 2 dimensional array.
	*
	* The resulting data have the following index keys:
	* - nr = the primary key number
	* - group_nr = the group number
	* - type = application type
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @return mixed array or boolean
	*/
	function getAppTypes(){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT nr,group_nr,type,name,LD_var AS \"LD_var\" ,description FROM $this->tb_app_types")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	/**
	* Gets the information of an application type based on its type number key.
	*
	* The resulting data have the following index keys:
	* - type = application type
	* - group_nr = the group number
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @param int Type number
	* @return mixed array or boolean
	*/
	function getAppTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,group_nr,name,LD_var AS \"LD_var\" ,description FROM $this->tb_app_types WHERE nr=$type_nr")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	/**
	* Gets the information of a prescription type based on its type number key.
	*
	* The resulting data have the following index keys:
	* - type = application type
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @param int Type number
	* @return mixed array or boolean
	*/
	function getPrescriptionTypeInfo($type_nr){
	    global $db;
	
	    if ($this->result=$db->Execute("SELECT type,name,LD_var  AS \"LD_var\",description FROM $this->tb_pres_types WHERE nr=$type_nr")) {
		    if ($this->result->RecordCount()) {
		        return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
}
?>
