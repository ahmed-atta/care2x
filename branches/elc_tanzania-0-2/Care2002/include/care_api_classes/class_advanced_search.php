<?php

require_once($root_path.'include/care_api_classes/class_core.php');

class advanced_search extends Core {

	/**
	* Constructor
	*/
	function advanced_search(){
		global $root_path;
	}  
	
	/**
	*
	* $array = get_equal_words (<column-name>(STRING) , <table_name>(STRING) , <Name for comparison>(STRING) , <percent of quality>(INTEGER) )
  *
	* Example:
	*
  *   $search_obj = & new advanced_search();
  *   if ($result_array=$search_obj->get_equal_words("tribe_name", "care_tz_tribes", $tribe, 65)) {
  *     $tribe_array=$result_array;
  *     $error++;
  *     $SHOW_TRIBE_SELECTION=TRUE;        
  *   } else {
  *     $SHOW_TRIBE_SELECTION=FALSE;        
  *   }
  */	

  function get_equal_words($column, $table, $word_to_compare, $sharpeness) {
    
    global $db;
    $debug = FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
  
        $SQLStatement = "SELECT DISTINCT $column FROM $table ORDER BY $column";
        $rs_ptr = $db->Execute($SQLStatement);
        $res_array = $rs_ptr->GetArray();
        $arr_index = 0;
        $hit_index = 0;
        $PERFECT_HIT=FALSE;
        while (list($u,$v)=each($res_array)){
  
            $s1 = rtrim(strtoupper($word_to_compare));
            $s2 = rtrim(strtoupper($v[$column]));
            
            $st = similar_text($s1,$s2,$percent);
            
            $all_record_array[$arr_index] = $v[$column];
            if ($percent==100) {
            	
              // the spelling is okay
              if ($debug) echo "Yepp...$s1 and $s2 are equal!<br>";
              $PERFECT_HIT = TRUE;
              $database_cell_value = $s2;
              continue;
            } elseif ($percent>=$sharpeness) {
              // we have a selection:
              if ($debug) echo "<br>$s1 and $s2 are more than $percent equal<br>";
              $hit_array[$hit_index]=$v[$column];
              $hit_index++;
            }
            if ($debug) echo "$all_record_array[$arr_index]--";
            $arr_index ++;
        } // end of while

        // anyway, what's set up before: Reset the global debug-variable
        $db->debug=FALSE;
        
        if ($debug) echo "<br>Perfect-Hit:".$PERFECT_HIT."<br>";
        if ($debug) echo "<br>Hit-Index:".$hit_index."<br>";

        if ($PERFECT_HIT || $hit_index==1) {
          // Exact (100%) -> Retrun the word out of the database
          // or exact one hit (no one is more equal) -> Retrun an array with one field
          return ($PERFECT_HIT) ? $database_cell_value : $hit_array;
        } elseif ($hit_index==0) {
            // no field in the databse can be compared by search value -> Return all values of the databse;
            if ($debug) echo "no hits -> returning all!<br>";
            return $all_record_array;
          } elseif ($hit_index>1) {
              if ($debug) echo "some hits<br>!";
              return $hit_array;
            } else {
              return FALSE;
            }
}
}
?>