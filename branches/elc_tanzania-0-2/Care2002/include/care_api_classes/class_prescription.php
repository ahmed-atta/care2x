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
	/**
	* Table for drugs and supplies
	*/
	var $tb_drug_list='care_tz_druglist';
	/**#@-*/

	/**#@+
	* @access private
	*/
	/**
	* SQL query result buffer
	* @var adodb record object
	*/
	var $result;
	var $sql;
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
	    $debug = false;
	    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
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
	    $debug = false;
	    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
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
	    $debug = false;
	    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
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
	    $debug = false;
	    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
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

	/**
	* Merotech customation methods
	*/

	function getDrugList($class, $is_pediatric, $is_adult, $is_other, $is_consumable ) {
  	  global $db;
  	  
	    $debug = false;
	    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
	    if ($is_pediatric || $is_adult || $is_other || $is_consumable ) {
  	    $this->sql="SELECT item_id as drug_id, item_description as description FROM $this->tb_drug_list WHERE
  	                  	 purchasing_class = '$class' AND
  	                  	 is_pediatric = $is_pediatric AND
  	                  	 is_adult  = $is_adult AND
  	                  	 is_other  = $is_other AND
  	                  	 is_consumable = $is_consumable";
  	  } else {
  	    $this->sql="SELECT item_id as drug_id, item_description as description FROM $this->tb_drug_list WHERE
  	                  	 purchasing_class = '$class'";
  	  }
  	  
	    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
		    return false;
		}

	} // end of function getDrugList($class, $is_pediatric, $is_adult, $is_other, $is_consumable )
	
	function insert_prescription() {
	  global $db;
    $debug = false;
    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
    
	  $db->debug=FALSE;
	}

	function DisplayBGColor($actual, $target) {
	  //echo ($actual==$target) ?  'bgcolor="green"' : 'bgcolor="gray"';
	  echo ($actual==$target) ?  'bgcolor="#330066"' : 'class="adm_input"';
	  return TRUE;
	}

	function insertDrugItem() {
	  global $db;
	  $debug=FALSE;
	  ($debug)?$db->debug=TRUE:$db->debug=FALSE;
	  
	  $db->debug=FALSE;
	  return $ret;
	}

	function DisplaySelectedItems($items) {
	  global $db;
    if ($items) {
      $debug=FALSE;
     ($debug)?$db->debug=TRUE:$db->debug=FALSE;
     $js_command = '<script language="javascript">';
      foreach($items as $item_no) {
  	    $this->sql="SELECT item_id as drug_id, item_description as description FROM $this->tb_drug_list WHERE item_id = '$item_no' ";
  	    if ($this->result=$db->Execute($this->sql)) {
    		    if ($this->result->RecordCount()) {
    		        $this->item_array = $this->result->GetArray();
    		          while (list($x,$v)=each($this->item_array)) {
    		            $js_command .= "add_to_list('".$v['description']."', ".$v['drug_id'].");";
    		          }
    			} else {
    				return false;
    			}
        }
      }
      $js_command .= '</script>';
      echo $js_command;
    }
  return TRUE;
	}
	

	function DisplayDrugs($drug_list) {
			while(list($x,$v)=each($drug_list)){
				echo '<option value="'.$v['drug_id'].'">';
				echo $v['description'];
				echo '</option>
				';
			}
	  return TRUE;
	}

  function GetNameOfItem($item_number) {
    global $db;
    $debug=FALSE;
    ($debug)?$db->debug=TRUE:$db->debug=FALSE;
    $this->sql="SELECT item_description as description FROM $this->tb_drug_list WHERE item_id = '$item_number' ";
    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        $this->item_array = $this->result->GetArray();
		          while (list($x,$v)=each($this->item_array)) {
                $db->debug=FALSE;
		            return $v['description'];
		          }
			} else {
			  $db->debug=FALSE;
				return false;
			}
		}
  } // end of function GetNameOfDrug($item_number) 

}
?>
