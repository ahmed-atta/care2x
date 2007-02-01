<?php
require_once($root_path.'include/care_api_classes/class_report.php');

class ARV_Report extends report {
	
	var $sql;
	var $res;
	
	function ARV_Report() {
    	
	}   
	
	function prepareStatistics($start,$end) {
		global $db;
    	$this->debug=false;
    	$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
    	
    	$tmp_tbl_ARV_case = $this->SetReportingLink('care_person','pid', 'care_tz_arv_case','pid');
    	
    	$this->sql="SELECT date_birth,
						if(IF( date_birth != '0000-00-00', (
						YEAR( CURRENT_DATE ) - YEAR( date_birth ) - IF( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_birth, 5 ) , 1, 0 ) ) , NULL
						)>15,'adult','child')
						AS age, 
						sex, 
						YEAR(FROM_UNIXTIME(care_tz_arv_case_create_time) ) AS year
					FROM $tmp_tbl_ARV_case
					WHERE YEAR( FROM_UNIXTIME( care_tz_arv_case_create_time ) ) BETWEEN $start AND $end
					ORDER BY age ASC , sex ASC";
		
		if (!$this->res = $db->Execute($this->sql)) return false;
			if(!($this->res->RecordCount())) {return false;}
			while ($this->row_elem = $this->res->FetchRow()) {
				$res_array[$this->row_elem['year']][$this->row_elem['sex']][$this->row_elem['age']]+=1;
			}			
		
		$this->DisconnectReportingTable($tmp_tbl_ARV_case);
		return $res_array;
	}	
	
	function prepareStatistics_2($start,$end) {
		global $db;
    	$this->debug=false;
    	$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
    	
    	$tmp_tbl_ARV_case = $this->SetReportingLink('care_person','pid', 'care_tz_arv_case','pid');
    	
    	$this->sql="SELECT date_birth,
						if(IF( date_birth != '0000-00-00', (
						YEAR( CURRENT_DATE ) - YEAR( date_birth ) - IF( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_birth, 5 ) , 1, 0 ) ) , NULL
						)>15,'adult','child')
						AS age, 
						sex, 
						YEAR(FROM_UNIXTIME(care_tz_arv_case_create_time) ) AS year
					FROM $tmp_tbl_ARV_case
					WHERE YEAR( FROM_UNIXTIME( care_tz_arv_case_create_time ) ) BETWEEN $start AND $end
					ORDER BY age ASC , sex ASC";
		
		if (!$this->res = $db->Execute($this->sql)) return false;
			if(!($this->res->RecordCount())) {return false;}
			while ($this->row_elem = $this->res->FetchRow()) {
				$res_array[$this->row_elem['year']][$this->row_elem['sex']][$this->row_elem['age']]+=1;
			}			
		
		$this->DisconnectReportingTable($tmp_tbl_ARV_case);
		return $res_array;
	}	
	
	function cw_array_count($a) {
			  if(!is_array($a)) return $a;
			  foreach($a as $key=>$value)
			     $totale += $this->cw_array_count($value);
			  return $totale;
	} 
	
	function prepareTable ($res_array) {
		$td_count=0;
		
		while (list($year,$v) = each($res_array)) {
			$td1.="<td colspan=\"4\">$year</td>";
			
			$td2.="<td colspan=\"2\">male</td>";
			$td2.="<td colspan=\"2\">female</td>";
			
			$td3.="<td>child</td>";
			$td3.="<td>adult</td>";
			$td3.="<td>child</td>";
			$td3.="<td>adult</td>";
			
			$td4.="<td>".$res_array[$year]['m']['child']."</td>";
			$td4.="<td>".$res_array[$year]['m']['adult']."</td>";
			$td4.="<td>".$res_array[$year]['f']['child']."</td>";
			$td4.="<td>".$res_array[$year]['f']['adult']."</td>";
			
		}
		$td1.="<td>&nbsp;</td>";
		$td2.="<td>&nbsp;</td>";
		$td3.="<td>Total</td>";
		
		$td4.="<td>".$this->cw_array_count($res_array)."</td>";
		$table_string.="<table border=\"1\">
							<tr>$td1</tr>
							<tr>$td2</tr>
							<tr>$td3</tr>
							<tr>$td4</tr>
						</table>";
		
		return $table_string;
	}
	
	function prepareStatistics2($start,$end) {
		global $db;
    	$this->debug=FALSE;
    	$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
    	
    	$sql_timeframe = "  (timestamp>=".$start." AND timestamp<=".$end.") ";
    	
    	$tmp_tbl_ARV_case = $this->SetReportingLink('care_person','pid', 'care_tz_arv_case','pid');
    	
    	$this->sql="SELECT date_birth,
						if(IF( date_birth != '0000-00-00', (
						YEAR( CURRENT_DATE ) - YEAR( date_birth ) - IF( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_birth, 5 ) , 1, 0 ) ) , NULL
						)>15,'adult','child')
						AS age, 
						sex, 
						YEAR(FROM_UNIXTIME(arv.create_time) ) AS year,
						MONTH(FROM_UNIXTIME(arv.create_time) ) AS month,
					FROM care_tz_arv_case arv, care_person
					WHERE care_person.pid = arv.pid
					AND YEAR( FROM_UNIXTIME( arv.create_time ) )
					BETWEEN $start AND $end
					ORDER BY age ASC , sex ASC";
		
		if (!$this->res = $db->Execute($this->sql)) return false;
			if(!($this->res->RecordCount())) {return false;}
			while ($this->row_elem = $this->res->FetchRow()) {
				$res_array[$this->row_elem['year']][$this->row_elem['month']][$this->row_elem['sex']][$this->row_elem['age']]+=1;
			}			
		
		return $res_array;
	}	
	
}





?>