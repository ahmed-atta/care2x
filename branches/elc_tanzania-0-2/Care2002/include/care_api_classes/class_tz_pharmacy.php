<?php
require_once($root_path.'include/care_api_classes/class_core.php');


/**
*  Pharmacy methods for tanzania (the product-module is completely rewritten by Robert Meggle. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Robert Meggle
* @author Alexander Irro (Version 2.0.0) - alexander.irro@merotech.de
* @version beta 2.0.0
* @copyright 2005 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/



class Product extends Core {
  
  var $tbl_product_items='care_tz_druglist';
  var $tbl_temp="tmp_search_results";
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
  
  function item_id_exists($item_id) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    global $db;
    $this->sql = "SELECT * FROM ".$this->tbl_product_items." WHERE item_id = '".$item_id."'";
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
  	$this->where="item_id='$item_nr'";
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
  function delete_item($item_id){
    /**
    * Delete item out of the table
    */
    if(empty($item_id)) {
        return FALSE;
    } else {
      $this->where="item_id='$item_id'";
      $this->sql="DELETE FROM $this->coretable WHERE $this->where";
      return $this->Transact();
    }
    return FALSE;
  }
  
  //------------------------------------------------------------------------------
  
  function get_array_search_results($keyword){
    /*
    
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    
    // hit´s of 100 per cent
    
    $this->sql="CREATE TEMPORARY TABLE tmp_search_results TYPE=HEAP
                SELECT  
                      `item_id`,100 AS plausibility
               FROM ".$this->tbl_product_items." 
               WHERE 
                      (`item_id` LIKE '".$keyword."' OR `item_description` LIKE '".$keyword."' OR `item_full_description` LIKE '".$keyword."')
                      OR
                      (`item_id` LIKE '%".$keyword."' OR `item_description` LIKE '%".$keyword."' OR `item_full_description` LIKE '%".$keyword."')
                      OR
                      (`item_id` LIKE '%".$keyword."%' OR `item_description` LIKE '%".$keyword."%' OR `item_full_description` LIKE '%".$keyword."%')
                      OR
											(`item_id` LIKE '".$keyword."%' OR `item_description` LIKE '".$keyword."%' OR `item_full_description` LIKE '".$keyword."%')
                      ";
    $db->Execute($this->sql);
    
    if ($debug) {
      $this->sql="select * from tmp_search_results";
      $this->rs=$db->Execute($this->sql);
      echo "Datasets in the first step:".$this->rs->RecordCount()."<br>";
    }
      
    
    // store the datasets with fuzzy idea also in this temp-table:
    // Get at first a list of all item_numbers
    
    $this->sql="SELECT `item_id`, `item_description` FROM ".$this->tbl_product_items;
    $this->rs_fuzziness = $db->Execute($this->sql);

    while ($this->elem = $this->rs_fuzziness->FetchRow()) {
    	
      
      $this->array_item_description = explode(",",$this->elem['item_description']);
      $best_levenshtein=100;
      $best_percent_similar=0;
      while(list($x,$v) = each($this->array_item_description))
      {
      	if(strlen($v)>strlen($keyword)-3)
      	{
	  			$this->blur = similar_text(trim(strtolower($v)),strtolower($keyword),$percent_similar);
	  			if($percent_similar > $best_percent_similar) $best_percent_similar = $percent_similar;
	      	if(strlen($v)+1 >= strlen($keyword))
	      	{
	      		$levenshteinvalue = levenshtein(trim(strtolower($v)),strtolower($keyword)); 
	      		if($levenshteinvalue < $best_levenshtein) 
	      			$best_levenshtein = $levenshteinvalue;
	      	}
      	}
      }
      if($best_levenshtein>6) 
      	$percent_levenshtein=0;
      else
      	$percent_levenshtein=100-(($best_levenshtein)*($best_levenshtein) + 10*$best_levenshtein);
      if($percent_levenshtein<0) $percent_levenshtein=0;
      $this->percent = ((($percent_levenshtein)*2 + $best_percent_similar)/3);
      if ($this->percent>=40) {
        $this->percent = round($this->percent,0);
        $this->sql="INSERT INTO tmp_search_results (item_id, plausibility) VALUES ('".$this->elem['item_id']."',".$this->percent.")";
        $db->Execute($this->sql);
      }
    }
    if ($debug) {
      $this->sql="select * from tmp_search_results";
      $this->rs=$db->Execute($this->sql);
      echo "Datasets in the second step:".$this->rs->RecordCount()."<br>";
    }
    
    
    $this->sql="SELECT origin.item_id FROM ".$this->tbl_product_items." as origin, tmp_search_results as tmp WHERE 
                  (  origin.item_full_description LIKE '%".$keyword."'
                  OR
                    origin.item_full_description LIKE '%".$keyword."%'
                  OR
                    origin.item_full_description LIKE '".$keyword."%')
                  AND origin.item_id != tmp.item_id
                  GROUP by origin.item_id  	
                    ";
    $this->rs_fuzziness = $db->Execute($this->sql);
    while ($this->elem = $this->rs_fuzziness->FetchRow()) {
      $this->percent = "100";
      if ($this->percent>0) {
        $this->sql="INSERT INTO tmp_search_results (item_id, plausibility) VALUES ('".$this->elem['item_id']."',".$this->percent.")";
        $db->Execute($this->sql);
      }
    }                    
    
    if ($debug) {
      $this->sql="select * from tmp_search_results";
      $this->rs=$db->Execute($this->sql);
      echo "Datasets in the third step:".$this->rs->RecordCount()."<br>";
    }
    
    
    // perpareing return values:
    $this->sql="SELECT `item_id`, `plausibility`  FROM tmp_search_results WHERE `plausibility` >=40 GROUP BY `item_id`, `plausibility` ORDER BY plausibility DESC LIMIT 0,10";
    
    return $db->Execute($this->sql);
  }
  
  
  */
  
  
  
  
  
 	global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    
    if ($debug) echo "class_tz_diagnostics::get_array_select_results starts here<br>";
    if($keyword=="*")
    {
	    $this->sql="SELECT `item_id`, 100 as plausibility, `item_description` FROM ".$this->tbl_product_items."
                WHERE 1";
	    return $db->Execute($this->sql);

  	}
  	else
  	{
    // Just after 3 letters, try to find a keyword:
    if (strlen($keyword)<3)
      return $this->get_all_items();

    // Create the temporary table:
    $this->sql="CREATE TEMPORARY TABLE ".$this->tbl_temp." (
                `item_id` VARCHAR( 20 ) ,
                `plausibility` INT UNSIGNED,
                `item_description` VARCHAR(255)
                ) TYPE = HEAP ";
                
    // Get at first a list of all item_numbers
    $db->Execute($this->sql);
    
    if ($debug) 
      //$this->sql="SELECT `item_id`, `item_description` FROM ".$this->tbl_product_items." where diagnosis_code LIKE \"B5%\" LIMIT 1,100";
      $this->sql="SELECT `item_id`, `item_description` FROM ".$this->tbl_product_items;
    else
        $this->sql="SELECT `item_id`, `item_description` FROM ".$this->tbl_product_items;
    $this->rs_tbl=$db->Execute($this->sql);
    
    if ($debug) echo "class_tz_diagnostics::get_array_select_results -> TMP-table is created<br>";
    
    $this->arr_keywords = explode (" ", $keyword);
    
    if ($debug) echo "class_tz_diagnostics::get_array_select_results -> keyword >".$keyword."< is slpitted into ".count($this->arr_keywords)." words<br>";

    $this->EXACT_MATCH=FALSE;

    while ($this->row_elem = $this->rs_tbl->FetchRow()) {
      if ($debug) echo "class_tz_diagnostics::get_array_select_results -> reading to the description >>".$this->row_elem[$this->tbl_col_content]."<<<br>";
      if ($debug) echo $this->row_elem['item_description'];
      $this->arr_tbl_col_content = explode (" ", $this->row_elem['item_description']);
      
      $this->avg_levensthein=0;
      $this->arr_levenshtein=array();  
      
      reset($this->arr_keywords);
      reset($this->arr_tbl_col_content);
      $nice_factor=0;
      
      while (list($keyword_index,$keyword_value) = each ($this->arr_keywords)) {
        reset($this->arr_tbl_col_content);
        while (list($content_index,$content_value) = each ( $this->arr_tbl_col_content )) {
          // if this word has more than three letters, then cover it into our search algorithm:
          if (strlen($content_value)>3 && strlen($keyword_value)>3 ) {
            if ($debug) echo "compare:".$keyword_value."<->".$content_value.":";
            if (strcmp($content_value,$keyword_value)==0) {
              $this->nice_factor=100;
              $this->EXACT_MATCH=TRUE;
              array_push($this->arr_nice_factor,"100");
              if ($debug) echo "<b>WOUW</b>:".$keyword_value." with ".$content_value." gives a nice factor of:".$this->nice_factor."<br>";
              continue 2;
            } else {
              $m1=metaphone(strtolower($keyword_value));
              $m2=metaphone(strtolower($content_value));
              //echo "<br>".$m1."::".$m2."<br>";
              //$nix=similar_text($m1,$m2,$this->nice_factor);
              $levenshtein=levenshtein(strtolower($keyword_value),strtolower($content_value));
              
              if ($debug) echo $levenshtein."<br>";
              
              // Step 1: Function value of levensthein comparison:
              $this->nice = - 1/2 * $levenshtein + strlen($keyword_value);
              
              // Step 2: Percent value of levensthein comparison:
              $this->nice_factor = 100/strlen($keyword_value)*$this->nice;
              
              // By more exact hits increase the nice value more higher than the exact percent match
              if ($this->nice_factor > 90) $this->nice_factor=500;
              if ($this->nice_factor >= 75) $this->nice_factor=200;
              
              
              //$this->nice_factor = ($levenshtein/strlen($keyword_value));
              
              if ($this->nice_factor) {
                array_push($this->arr_nice_factor,$this->nice_factor);
                if ($debug) echo "<u>".$keyword_value."</u> with <u>".$content_value."</u> gives a nice factor of:".$this->nice_factor."<br>";
              }
              $nice_factor=0;
            }
          } // end of if (strlen($content_value)>3)
        } // end of while (list($content_index,$content_value) = each ( $this->arr_tbl_col_content ) 
      } // (list($keyword_index,$keyword_value) = each ($this->arr_keywords))
      
      // If there is an exact match:
      if (!$this->EXACT_MATCH) {
        // average of levensthein values:
        $this->nice_factor=0;
        /*
        for ($i=0; $i < count($this->arr_nice_factor); $i++) 
          $this->nice_factor = $this->nice_factor + ( 1 / $this->arr_nice_factor[$i]);
        $this->nice_factor = 1 / count($this->arr_nice_factor) * ( $this->nice_factor );
        $this->nice_factor = 1/ $this->nice_factor;
        */
        for ($i=0; $i < count($this->arr_nice_factor); $i++) 
          $this->nice_factor = $this->nice_factor + $this->arr_nice_factor[$i];
        $this->nice_factor = $this->nice_factor / count($this->arr_nice_factor)  ;
      } else {
        $this->nice_factor=1000;
      }
      
      if ($debug) echo "=".$this->nice_factor."<br>";      
      
      if ($this->nice_factor) {
        $this->sql="INSERT INTO ".$this->tbl_temp." (`item_id`,`plausibility`, `item_description`) VALUES ('".$this->row_elem['item_id']."',".round($this->nice_factor,0).",'".$this->row_elem['item_description']."')";
        if ($debug) echo $this->sql."<br>";
        $db->Execute($this->sql);
        $this->EXACT_MATCH=FALSE; // Reset the exact match flag
      }
      $this->arr_nice_factor=array();
      

      

      
    } // end of while ($this->row_elem = $this->rs_tbl->FetchRow())
      $this->sql="SELECT item_id, plausibility, item_description FROM ".$this->tbl_temp." ORDER BY plausibility DESC LIMIT 0,40";
      return $db->Execute($this->sql);
  }
 }
  
  
  
  
  
  //------------------------------------------------------------------------------
  
  function get_all_items(){
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;    
    $this->sql="SELECT `item_id`, \"n/a\" AS `plausibility` FROM care_tz_druglist ORDER BY purchasing_class, item_description ";
    return $db->Execute($this->sql);
  }
  
  //------------------------------------------------------------------------------
  
  // Notice by Robert Meggle: See to the following functions: If somebody has time and force, he could
  // think about a more intelligent solution. But this still works with a big lack of elegance...

  function get_description($item_id) {
    global $db;
    $this->sql="SELECT item_description FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_itemnumber($item_id) {
    global $db;
    $this->sql="SELECT item_number FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }


  function get_item_peadric($item_id) {
    global $db;
    $this->sql="SELECT is_pediatric FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_item_adult($item_id){
    global $db;
    $this->sql="SELECT is_adult FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }  

  function get_item_other($item_id){
    global $db;
    $this->sql="SELECT is_other FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_item_consumable($item_id){
    global $db;
    $this->sql="SELECT is_consumable FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_selians_item_description($item_id){
    global $db;
    $this->sql="SELECT item_description FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_items_full_description($item_id){
    global $db;
    $this->sql="SELECT item_full_description FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_item_classification($item_id){
    global $db;
    $this->sql="SELECT purchasing_class FROM care_tz_druglist WHERE item_id='".$item_id."'";
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
      if ($this->elem[0]=="mems_xray")
        return "x-ray";
      if ($this->elem[0]=="mems_service")
        return "service";
      if ($this->elem[0]=="mems_dental")
        return "dental services";
      if ($this->elem[0]=="mems_smallop")
        return "small op";
      if ($this->elem[0]=="mems_bigop")
        return "major op";
      
      //return $this->elem[0];
    }
    return "N/A";
  }

  function get_selians_item_price($item_id){
    global $db;
    $this->sql="SELECT unit_price FROM care_tz_druglist WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
}

?>