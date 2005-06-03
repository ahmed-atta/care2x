<?php
require_once($root_path.'include/care_api_classes/class_core.php');


/**
*  Pharmacy methods for tanzania (the product-module is completely rewritten by Robert Meggle. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Robert Meggle
* @version beta 1.0.0
* @copyright 2005 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/



class Product extends Core {
  
  var $tbl_product_items='care_tz_druglist';
	var $fields_tbl_product=array(
	                'item_number',
									'is_pediatric',
									'is_adult',
									'is_other',
									'is_consumable',
									'item_description',
									'item_full_description',
									'purchasing_class',
									'unit_price');  
  var $result;
  var $rs_fuzziness;
  
  
  // Constructor
  function Product() {
    return TRUE;
  }  
  
  //------------------------------------------------------------------------------
  // Methods:
  
  function check_form_variable($me) {
    return (!empty($me)) ? FALSE : TRUE;
  }
  
  // -----------------------------------------------------------------------------
	function useProductTable(){
		$this->setTable($this->tbl_product_items);
		$this->setRefArray($this->fields_tbl_product);
	}  
  
  //------------------------------------------------------------------------------
  
  function item_number_exists($item_number) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    global $db;
    $this->sql = "SELECT * FROM ".$this->tbl_product_items." WHERE item_number = '".$item_number."'";
    $this->result = $db->Execute($this->sql);
    return ($this->result->RecordCount()) ? TRUE : FALSE;
  }
  
  //------------------------------------------------------------------------------
  
  // Private update class:
  function _updatePharmacyDataFromArray(&$array,$item_nr='',$isnum=TRUE) {
  	global $dbtype;
  	$x='';
  	$v='';
  	$elems='';
  	if($dbtype=='postgres7'||$dbtype=='postgres') $concatfx='||';
  		else $concatfx='concat';
  	if(empty($array)) return FALSE;
  	if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
  	while(list($x,$v)=each($array)) {
  
  	if(stristr($v,$concatfx)||stristr($v,'null')) $elems.="$x= $v,";
  	    else $elems.="$x='$v',";
  	}
  	# Bug fix. Reset array.
  	reset($array);
  	//echo strlen($elems)." leng<br>";
  	$elems=substr_replace($elems,'',(strlen($elems))-1);
  	$this->where="item_number='$item_nr'";
        $this->sql="UPDATE $this->coretable SET $elems WHERE $this->where";
  	# Bug fix. Reset the condition variable to prevent affecting subsequent update calls. 
  	$this->where=''; 
  	//echo $this->sql.'<br>';
  	return $this->Transact();
  }  
  
  // Public update class:
  function updatePharmacyDataFromInternalArray($item_nr='',$isnum=TRUE) {
		if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
	    $this->_prepSaveArray();
		return $this->_updatePharmacyDataFromArray($this->buffer_array,$item_nr,$isnum);
	}
  
  //------------------------------------------------------------------------------
  function delete_item($item_number){
    /**
    * Delete item out of the table
    */
    if(empty($item_number)) {
        return FALSE;
    } else {
      $this->where="item_number='$item_number'";
      $this->sql="DELETE FROM $this->coretable WHERE $this->where";
      return $this->Transact();
    }
    return FALSE;
  }
  
  //------------------------------------------------------------------------------
  
  function get_array_search_results($keyword){
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    
    // hit´s of 100 per cent
    
    $this->sql="CREATE TEMPORARY TABLE tmp_search_results TYPE=HEAP
                SELECT  
                      `item_number`,100 AS plausibility
               FROM ".$this->tbl_product_items." 
               WHERE 
                      `item_number` = '".$keyword."'
                     OR
                      `item_description` = '".$keyword."'
                     OR 
                      `item_full_description` = '".$keyword."'";
    $db->Execute($this->sql);
    
    if ($debug) {
      $this->sql="select * from tmp_search_results";
      $this->rs=$db->Execute($this->sql);
      echo "Datasets in the first step:".$this->rs->RecordCount()."<br>";
    }
      
    
    // store the datasets with fuzzy idea also in this temp-table:
    // Get at first a list of all item_numbers
    
    $this->sql="SELECT `item_number`, `item_description` FROM ".$this->tbl_product_items." WHERE `item_number`<>''";
    $this->rs_fuzziness = $db->Execute($this->sql);

    while ($this->elem = $this->rs_fuzziness->FetchRow()) {
      $this->blur = similar_text($this->elem['item_description'],$keyword,$this->percent); 
      // echo  $this->percent."<br>";
      if ($this->percent>0) {
        $this->percent = round($this->percent,0);
        $this->sql="INSERT INTO tmp_search_results (item_number, plausibility) VALUES ('".$this->elem['item_number']."','".$this->percent."')";
        $db->Execute($this->sql);
      }
    }
    if ($debug) {
      $this->sql="select * from tmp_search_results";
      $this->rs=$db->Execute($this->sql);
      echo "Datasets in the second step:".$this->rs->RecordCount()."<br>";
    }
    
    
    $this->sql="SELECT `item_number` FROM ".$this->tbl_product_items." WHERE 
                    `item_full_description` LIKE '%".$keyword."'
                  OR
                    `item_full_description` LIKE '%".$keyword."%'
                  OR
                    `item_full_description` LIKE '".$keyword."%'";
    $this->rs_fuzziness = $db->Execute($this->sql);
    while ($this->elem = $this->rs_fuzziness->FetchRow()) {
      $this->percent = "90";
      if ($this->percent>0) {
        $this->sql="INSERT INTO tmp_search_results (item_number, plausibility) VALUES ('".$this->elem['item_number']."','".$this->percent."')";
        $db->Execute($this->sql);
      }
    }                    
    
    if ($debug) {
      $this->sql="select * from tmp_search_results";
      $this->rs=$db->Execute($this->sql);
      echo "Datasets in the third step:".$this->rs->RecordCount()."<br>";
    }
    
    
    // perpareing return values:
    $this->sql="SELECT `item_number`, `plausibility`  FROM tmp_search_results WHERE `plausibility` >=40 GROUP BY `item_number`, `plausibility` ORDER BY `plausibility` DESC LIMIT 0,10";
    
    return $db->Execute($this->sql);
  }
  
  //------------------------------------------------------------------------------
  
  function get_all_items(){
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT `item_number`, \"n/a\" AS `plausibility` FROM care_tz_druglist ORDER BY purchasing_class, item_description ";
    return $db->Execute($this->sql);
  }
  
  //------------------------------------------------------------------------------
  
  // Notice by Robert Meggle: See to the following functions: If somebody has time and force, he could
  // think about a more intelligent solution. But this still works with a big lack of elegance...

  function get_description($item_number) {
    global $db;
    $this->sql="SELECT item_description FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }


  function get_item_peadric($item_number) {
    global $db;
    $this->sql="SELECT is_pediatric FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_item_adult($item_number){
    global $db;
    $this->sql="SELECT is_adult FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }  

  function get_item_other($item_number){
    global $db;
    $this->sql="SELECT is_other FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_item_consumable($item_number){
    global $db;
    $this->sql="SELECT is_consumable FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_selians_item_description($item_number){
    global $db;
    $this->sql="SELECT item_description FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_items_full_description($item_number){
    global $db;
    $this->sql="SELECT item_full_description FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_item_classification($item_number){
    global $db;
    $this->sql="SELECT purchasing_class FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      if ($this->elem[0]=="mems_drug_list")
        return "drug";
      if ($this->elem[0]=="mems_supplies")
        return "supplies";
      if ($this->elem[0]=="mems_supplies_laboratory")
        return "supplies lab.";
      if ($this->elem[0]=="mems_special_others_list")
        return "special others";
      
      //return $this->elem[0];
    }
    return "N/A";
  }

  function get_selians_item_price($item_number){
    global $db;
    $this->sql="SELECT unit_price FROM care_tz_druglist WHERE item_number='".$item_number."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
}

?>