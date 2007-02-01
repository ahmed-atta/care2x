<?php
require_once($root_path.'include/care_api_classes/class_person.php');

class ARV_case extends Person
{	
    var $arv_facility_data=array(
    					   'main_info_facility_name',
    					   'main_info_facility_code',
    					   'main_info_facility_district');
    					   
    var $arv_person_data=array(
    					   'care_tz_arv_case_id',
                           'arv_pid',
                           'date_pos_hiv_test',
                           'start_date_arv',
                           'village',
                           'street',
                           'district',
                           'balozi',
                           'chairman_of_village',
                           'head_of_family',
                           'name_of_secretary',
                           'secretary_phone',
                           'secretary_adress',
                           'create_id');
                           
    var $person_reg_data=array(
    					   'pid',
                           'name_first',
                           'name_last',
                           'date_birth',
                           'sex',
                           'phone_1_code');
                         
    var $visit_count=0;
    var $a_arv_visits=array();
    
	var $res;
    var $sql;
    var $debug;
    
  	function ARV_case($pid) {
  		parent::Person($pid);
  	}
  	
  	function isChild() {
  		if((date('Y')-date('Y',strtotime($this->person_reg_data['date_birth'])))<=15) {	
  			return true;	
  		}
  		else {
  			return false;	
  		}
  	}
  	
  	function getPatientRegData() {
  		global $db;
  		$this->debug=false;
    	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		
		$this->sql="SELECT p.pid, 
                           p.name_first, 
                           p.name_last, 
                           p.date_birth,  
                           p.sex, 
                           p.phone_1_code 
                    FROM care_person p, care_encounter e 
                    WHERE p.pid=e.pid AND encounter_nr=".$this->enc_nr."
                    LIMIT 1";
	   
  		if ($this->res = $db->Execute($this->sql) AND $this->person_reg_data=$this->res->FetchRow()) {
	  		return $this->person_reg_data;
	  	}
	  	else {
	  		return false;
  		}	
  	}
  		
  	function getPatientARVData() {
  		global $db, $date_format;
  		$tehis->debug=FALSE;
    	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    	
    	$this->sql="SELECT 
						care_tz_arv_case_id,
						datetime_first_hivtest, 
						datetime_start_arv, 
						arv_pid, 
						district, 
						village, 
						street,
						balozi, 
						chairman_of_village, 
						head_of_family, 
						name_of_secretary, 
						secretary_phone, 
						secretary_adress
					FROM care_tz_arv_case 
					WHERE 
						pid=".$this->person_reg_data['pid'];
		
		if ($this->res = $db->Execute($this->sql) AND $this->arv_person_data=$this->res->FetchRow()) {
	  		return $this->arv_person_data;
	  	}
	  	else {
	  		return false; 	
  		}
  	}
  	
  	function getAllARVvisits() {
		global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT 
						care_tz_arv_visit_id, 
						create_time 
					FROM care_tz_arv_visit 
					WHERE care_tz_arv_case_id=".$this->arv_person_data['care_tz_arv_case_id'].";
					";
		
		if ($this->res = $db->Execute($this->sql)) {
	  		return $this->res;
		}
		else {
			return false;
		}
	}
//--------------------------------------------------------------------------------------------------------
	function getFacilityInfo() {
		global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT TYPE , value
					FROM care_config_global
					WHERE TYPE = 'main_info_facility_name'
					OR TYPE = 'main_info_facility_code'
					OR TYPE = 'main_info_facility_district'
					";
					
		$this->ok=$this->res = $db->Execute($this->sql);
		while ($this->row_elem = $this->res->FetchRow()) {
			$temp=$this->row_elem[0];
			$this->arv_facility_data[$temp]=$this->row_elem[1];;
		}			
	    
	    return ($this->ok) ? $this->arv_facility_data : false;
	}	
//--------------------------------------------------------------------------------------------------------  	
  	
  	function getPID () { return $this->person_reg_data['pid']; }
  	
  	function getARVcaseID() { return $this->arv_person_data['care_tz_arv_case_id'];}
  		
  	function setARVdata($values) { $this->arv_person_data=$values; }

//-------------------------------------------------------------------------------------------------------- 	
  	function addARV_visit(&$o_visit) {
  		$this->a_arv_visits[$o_visit->arv_pid]=$o_visit;
  		$this->visit_count++;
  	}
  	
//----------------------------------------------------------------------------------------------------------	
  	function updateARVdata($values) {
  		global $db,$date_format;
    	$this->debug=true;
    	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    	$this->setARVdata($values);
    	$this->sql="UPDATE care_tz_arv_case
					SET datetime_first_hivtest='".formatDate2STD($this->arv_person_data['datetime_first_hivtest'],$date_format)."', 
						datetime_start_arv='".formatDate2STD($this->arv_person_data['datetime_start_arv'], $date_format)."', 
						arv_pid=".$this->arv_person_data['arv_pid'].", 
						district='".$this->arv_person_data['district']."', 
						village= '".$this->arv_person_data['village']."', 
						street= '".$this->arv_person_data['street']."', 
						balozi= '".$this->arv_person_data['balozi']."', 
						chairman_of_village='".$this->arv_person_data['chairman_of_village']."',
						head_of_family='".$this->arv_person_data['head_of_family']."',
						name_of_secretary='".$this->arv_person_data['name_of_secretary']."',
						secretary_phone='".$this->arv_person_data['secretary_phone']."', 
						secretary_adress='".$this->arv_person_data['secretary_adress']."',
						history=".$this->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$this->arv_person_data['create_id']."\n").", 
						modify_id='".$this->arv_person_data['create_id']."'
                    WHERE pid=".$this->person_reg_data['pid'];
    	
    	$this->Transact($this->sql); 
  	}
  	
  	function insertARVdata($values) {
  		global $db,$date_format;
    	$this->debug=false;
    	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    	$this->setARVdata($values);
    	$this->sql="INSERT INTO care_tz_arv_case (
	                    care_tz_arv_case_id, 
	                    pid, 
	                    datetime_first_hivtest, 
	                    datetime_start_arv, 
	                    arv_pid, 
						district,
						village,
						street,
	                    balozi, 
	                    chairman_of_village, 
	                    head_of_family, 
	                    name_of_secretary, 
	                    secretary_phone, 
	                    secretary_adress, 
	                    history, 
						create_id, 
	                    create_time, 
	                    modify_id, 
	                    modify_time) 
                    VALUES(
						null,
						".$this->person_reg_data['pid'].",
						'".formatDate2STD($this->arv_person_data['datetime_first_hivtest'],$date_format)."',
                        '".formatDate2STD($this->arv_person_data['datetime_start_arv'],$date_format)."',
						".$this->arv_person_data['arv_pid'].",
						'".$this->arv_person_data['district']."',
						'".$this->arv_person_data['village']."',
						'".$this->arv_person_data['street']."',
                        '".$this->arv_person_data['balozi']."',
						'".$this->arv_person_data['chairman_of_village']."',
						'".$this->arv_person_data['head_of_family']."',
						'".$this->arv_person_data['name_of_secretary']."',
						'".$this->arv_person_data['secretary_phone']."',
						'".$this->arv_person_data['secretary_adress']."',
						'Created ".date('Y-m-d H:i:s')." ".$this->arv_person_data['create_id'].";\n',
						'".$this->arv_person_data['create_id']."',
						".time().",
						null,
					    null)";
		
		Core::Transact($this->sql); 
  	}
//--------------------------------------------------------------------------------------------------- 	
  	function getAIDSEventsGroups () {
    	global $db;
   		$debug=true;
        ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		
		if ($this->isChild()) { $parent=2; }
		else { $parent=62; }
    	
    	$this->sql="SELECT care_tz_arv_events_id, who_code, who_code_text
                    FROM care_tz_arv_events_events
					WHERE parent=$parent
					ORDER by who_code asc;";
		
		 if ($this->res = $db->Execute($this->sql)) {
	  	 	return $this->res;
  		 }
  		 else {
  			return false;
  		 }
  	}
  
  	function displayAIDSEventsGroups($selected) {
    	$this->res = $this->getAIDSEventsGroups(); 	
    	while ($this->row_elem = $this->res->FetchRow()) {
    		if($this->row_elem[0] == $selected) $checked = 'selected'; else $checked= '';
     	 	echo "<option value=\"".$this->row_elem[0]."\" ".$checked.">Clinical Stage ".$this->row_elem[1].": ".$this->row_elem[2]."</option>\n";
    		$counter++;		
    	}
    	if(!$counter) echo '<option value="-1">Empty!</opion>';
    	return TRUE;
  	}
  	
  	function displayAIDSEventsGroups_Items($selected) {
  		if (empty($selected) || $selected==-1)
    	{
      		echo '<option value="-1"></opion>';
      		return false;
    	}
    	$this->res = $this->getAIDSEventsGroups_Items($selected);
    	while ($this->row_elem = $this->res->FetchRow()) {
      		echo "<option value=\"".$this->row_elem[0]."\">".$this->row_elem[1].". ".$this->row_elem[2]."</option>\n";
    		$counter++;
    	}
    	if(!$counter) echo '<option value="-1">Empty!</opion>';
    	return TRUE;
  	}
  	
  	function getAIDSEventsGroups_Items($stage) {
	    global $db;
	    $debug=TRUE;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    if (empty($stage)) {
	    	return FALSE;
	    }
		
		$this->sql="SELECT care_tz_arv_events_id,who_code,who_code_text
                    FROM care_tz_arv_events
                    WHERE parent=$stage";
                    
	    if ($this->res = $db->Execute($this->sql)) {
	  		return $this->res;
  		}
  		else {
  			return false;
  		}
   }
 
   function displaySelectedAIDSEvents ($itemlist) {
   		global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
   		if(empty($itemlist)) { return false;}
   		
   		$this->sql="SELECT who_code,who_code_text
				    FROM care_tz_arv_events
                    WHERE care_tz_arv_events_id IN (".implode(",",$itemlist).")";
         
        $this->res = $db->Execute($this->sql);
	  	$table_string="<table border=1>\n";
	  	while ($this->row_elem = $this->res->FetchRow()) {
	    	$table_string=$table_string."<tr><td>".$this->row_elem[0]."</td><td>".$this->row_elem[1]."</td></tr>\n";
	    } 
	    $table_string=$table_string."</table>\n"; 
	    return $table_string;     
   }

	function displaySelectedAIDSEvents_Items($array){
		$counter=0;
	    if (empty($array))return FALSE;
	    while (list($x,$v) = each($array)) {
	    	echo "<option value=\"".$x."\">".$this->get_AIDSEventsDesc_from_code($v)."</option>\n";
	      	$counter++;
	    }
	    if(!$counter) echo '<option value="-1">Empty!</opion>';
  	}
  	
  	function get_AIDSEventsDesc_from_code($code) {
  	 	global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    if ($debug) echo $code;
	    
  		$this->sql="SELECT who_code,who_code_text
				    FROM care_tz_arv_events
                    WHERE care_tz_arv_events_id=$code";
		
		if ($this->res = $db->Execute($this->sql) AND ($this->row_elem = $this->res->FetchRow())){
			return $this->row_elem[0].". ".$this->row_elem[1];
		}
		else {
			return false;
		}
  	}
//-----------------------------------------------------------------------------------------------------------------------------
   
   function getARVStatusReasonGroup ($status_code) {
    	global $db;
   		$debug=false;
        ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		
		switch ($status_code) {
			case 1:
	   			$temp="2,3,4";
	  			break;
			case 2:
   				$temp="1";
   				break;
			case 3:
   				$temp="1";
   				break;
   			case 4:
   				$temp="2,3,4";
   				break;
   			case 5:
   				$temp="2,3,4";
   				break;
			default:
				$temp="1,2,3,4";
				break;
		}
    	
    	$this->sql="SELECT care_tz_arv_status_txt_code_id, status_code, status_text
					FROM care_tz_arv_status_txt_code
					WHERE care_tz_arv_status_txt_code_id IN ( $temp ) ";
		
		 if ($this->res = $db->Execute($this->sql)) {
	  	 	return $this->res;
  		 }
  		 else {
  			return false;
  		 }
  	}
  	
  	function displayARVStatusReasonGroup($selected,$status_code) {
    	$this->res = $this->getARVStatusReasonGroup($status_code); 	
    	while ($this->row_elem = $this->res->FetchRow()) {
    		if($this->row_elem[0] == $selected) $checked = 'selected'; else $checked= '';
     	 	echo "<option value=\"".$this->row_elem[0]."\" ".$checked.">".$this->row_elem[2]."</option>\n";
    		$counter++;
    	}
    	if(!$counter) echo '<option value="-1">Empty!</opion>';
    	return TRUE;
  	}
  	
	function getARVStatusReasonGroup_Items($selected) {
	    global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    if (empty($selected)) { return FALSE; }
		
		$this->sql="SELECT care_tz_arv_status_txt_code_id, status_code, status_text              
					FROM care_tz_arv_status_txt_code
					WHERE parent=$selected";
	                
	    if ($this->res = $db->Execute($this->sql)) {
	  		return $this->res;
		}
		else {
			return false;
		}
    }
    
    function displayARVStatusReasonGroup_Items($selected) {
    	if (empty($selected) || $selected==-1)
    	{
      		echo '<option value="-1">no entries</opion>';
      		return false;
    	}
    	$this->res = $this->getARVStatusReasonGroup_Items($selected);
    	while ($this->row_elem = $this->res->FetchRow()) {
      		echo "<option value=\"".$this->row_elem[0]."\">".$this->row_elem[1].". ".$this->row_elem[2]."</option>\n";
    		$counter++;	
    	}
    	if(!$counter) echo '<option value="-1">no entries</opion>';

    	return true;
  	}
  	
  	function displaySelectedARVStatusReason_Items($array,$text){
	    if (empty($array))return FALSE;
	    while (list($x,$v) = each($array)) {
	    #for ($i=0; $i<count($array); $i++) {
	    	#echo "<option value=\"".$v."\">".$this->get_ARVStatusReasonDesc_from_code($v).$text[0]."</option>\n";
	    	#echo "<option value=\"".$array[$i]."\">".$this->get_ARVStatusReasonDesc_from_code($array[$i])." ".$text[$i]."</option>\n";
	    	#echo "<option value=\"".$array[$i]."\">".$text[$i]."</option>\n";
	    	echo "<option value=\"".$x."\">".$v."</option>\n";
	      	$counter++;
	    }
	    if(!$counter) echo '<option value="-1">Empty!</opion>';
  	}
  	
  	function get_ARVStatusReasonDesc_from_code($code) {
  	 	global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    if ($debug) echo $code;
	    
  		$this->sql="SELECT status_code,status_text 
                    FROM care_tz_arv_status_txt_code 
                    WHERE care_tz_arv_status_txt_code_id=$code";
		
		if ($this->res = $db->Execute($this->sql) AND ($this->row_elem = $this->res->FetchRow())){
			return $this->row_elem[0].". ".$this->row_elem[1];
		}
		else {
			return false;
		}
  	}
  	
  	function displaySelectedARVStatusReason_table($r_item_no) {
	    $table_string="<table border=1>\n";
	    while (list($x,$v) = each($r_item_no)) {
	    	$table_string=$table_string."<tr><td>".$v."</td></tr>\n"; 
	    }
	    $table_string=$table_string."</table>\n"; 
	    return $table_string;     
   }
  	
//-------------------------------------------------------------------------------------------------------------------------------
	function displayAllARVvisits() {
		global $db,$root_path;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    $this->res = $this->getAllARVvisits();
		
		$table_string="<table width=\"784\">\n";
    	$count=1;
    	while ($this->row_elem = $this->res->FetchRow()) {
    		
    	if ($color_change) {
	        $BGCOLOR='bgcolor="#FFFFB9"';
	        $color_change=FALSE;
     	 } else {
	        $BGCOLOR='bgcolor="#F0F5FF"';
	        $color_change=TRUE;
      	}
			$table_string.="<tr>";
			$table_string.="<td width=\"10\"  $BGCOLOR >$count</td>";
	    	$table_string.="<td width=\"19\"  $BGCOLOR ><img src=\"$root_path/gui/img/common/default/eyeglass.gif\" width=\"17\" height=\"17\"></td>";
	   		$table_string.="<td width=\"534\" $BGCOLOR >".date("d.m.Y H:i",$this->row_elem['create_time'])."</td>";
	    	$table_string.="<td width=\"97\"  $BGCOLOR ><a href=\"arv_visit.php?arv_visit_id=".$this->row_elem['care_tz_arv_visit_id']."&mode=edit\">show&gt;&gt;</a></td>";
	    	$table_string.="<td width=\"102\" $BGCOLOR ><a href=\"arv_visit.php?arv_visit_id=".$this->row_elem['care_tz_arv_visit_id']."&mode=edit\">edit&gt;&gt;</a></td>";
	  		$table_string.="</tr>";
	  		
	  		$count++;
    	}
		$table_string.="</table>";
		return $table_string;
	}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	
	
}
?>
