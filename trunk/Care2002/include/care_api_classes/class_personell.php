<?php
/* API class for personell
*  Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Personell extends Core {

	var $tb='care_personell'; // table name
	var $tb_assign='care_personell_assignment';
	var $tb_person='care_person';
	var $tb_dpoc='care_dutyplan_oncall';
	var $tb_cphone='care_phone';
	var $tb_citytown='care_address_citytown';
	var $result;
	var $is_loaded='false';
	var $row;
	var $depts;
	var $record_count;
	var $personell_data;
	var $dpoc_fields=array('nr',
									'dept_nr',
									'role_nr',
									'year',
									'month',
									'duty_1_txt',
									'duty_2_txt',
									'duty_1_pnr',
									'duty_2_pnr',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	var $assign_fields=array('nr',
									'personell_nr',
									'role_nr',
									'location_type_nr',
									'location_nr',
									'date_start',
									'date_end',
									'is_temporary',
									'list_frequency',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
	var $personell_fields=array('nr',
									'short_id',
									'pid',
									'job_type_nr',
									'job_function_title',
									'date_join',
									'date_exit',
									'contract_class',
									'contract_start',
									'contract_end',
									'pay_class',
									'pay_class_sub',
									'local_premium_id',
									'tax_account_nr',
									'ir_code',
									'nr_workday',
									'nr_weekhour',
									'nr_vacation_day',
									'multiple_employer',
									'nr_dependent',
									'status',
									'history',
									'modify_id',
									'modify_time',
									'create_id',
									'create_time');
									
	function Personell(){
		$this->setTable($this->tb);
		$this->setRefArray($this->personell_fields);
	}
	function useDutyplanTable(){
		$this->setTable($this->tb_dpoc);
		$this->setRefArray($this->dpoc_fields);
	}
	function useAssignmentTable(){
		$this->setTable($this->tb_assign);
		$this->setRefArray($this->assign_fields);
	}
	function usePersonellTable(){
		$this->setTable($this->tb);
		$this->setRefArray($this->personell_fields);
	}
	function InitPersonellNrExists($init_nr){
		global $db;
		$this->sql="SELECT nr FROM $this->tb WHERE nr=$init_nr";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			} else { return false; }
		} else { return false; }
	}	
	function getDoctorsOfDept($dept_nr=0){
		if(!$dept_nr) return false;
			else return $this->_getAllPersonell(1,17,$dept_nr); // 1= dept (location), 17 = doctor (role)
	}
	function getNursesOfDept($dept_nr=0){
		if(!$dept_nr) return false;
		else return $this->_getAllPersonell(1,16,$dept_nr); // 1= dept (location); 16 = nurse (role)
	}
	
	function _getAllPersonell($loc_type_nr,$role_nr=0,$dept_nr){
	    global $db;
		$row=array();
		
		$sql="SELECT a.nr, a.personell_nr, ps.job_function_title, p.name_last, p.name_first, p.date_birth
				FROM 	$this->tb_assign AS a,
							$this->tb AS ps,
							$this->tb_person AS p			
				WHERE a.role_nr=$role_nr 
					AND a.location_type_nr=$loc_type_nr 
					AND a.location_nr=$dept_nr
					AND (a.date_end='' OR a.date_end='0000-00-00' OR a.date_end>='".date('Y-m-d')."')
					AND NOT (a.status='deleted' OR a.status='hidden' OR a.status='void')
					AND a.personell_nr=ps.nr
					AND ps.pid=p.pid 
				ORDER BY a.list_frequency DESC";
				
		
	    if ($this->result=$db->Execute($sql)) {
		    if ($this->record_count=$this->result->RecordCount()) {
		    	return $this->result;
			} else {
				return false;
			}
		}
		else {
		    return false;
		}
	}
	
	function _OCDutyplanExists($role_nr,$dept_nr=0,$year=0,$month=0){
		global $db;
		
		if(!$role_nr||!$dept_nr||!$year||!$month){
			return false;
		}else{
			$sql="SELECT nr FROM $this->tb_dpoc WHERE role_nr=$role_nr AND dept_nr=$dept_nr AND year=$year AND month=$month";
	    	if ($this->result=$db->Execute($sql)) {
		    	if ($this->result->RecordCount()) {
					$this->row=$this->result->FetchRow();
		    		return $this->row['nr'];
				} else {
					return false;
				}
			}else {
		   	 return false;
			}
		}
	}
	function DOCDutyplanExists($dept_nr,$year,$month){
		return $this->_OCDutyplanExists(15,$dept_nr,$year,$month); // 15 = doctor_on_call (role)
	}
	function NOCDutyplanExists($dept_nr,$year,$month){
		return $this->_OCDutyplanExists(14,$dept_nr,$year,$month); // 14 = nurse_on_call (role)
	}
	
	function _getOCDutyplan($role_nr,$dept_nr=0,$year=0,$month=0){
		global $db;
		
		if(!$role_nr||!$dept_nr||!$year||!$month){
			return false;
		}else{
			$sql="SELECT * FROM $this->tb_dpoc WHERE role_nr=$role_nr AND dept_nr=$dept_nr AND year=$year AND month=$month";
	    	if ($this->result=$db->Execute($sql)) {
		    	if ($this->record_count=$this->result->RecordCount()) {
					return $this->result->FetchRow();
				} else {
					return false;
				}
			}else {
		   	 return false;
			}
		}
	}
	function getDOCDutyplan($dept_nr,$year,$month){
		return $this->_getOCDutyplan(15,$dept_nr,$year,$month);
	}
	function getNOCDutyplan($dept_nr,$year,$month){
		return $this->_getOCDutyplan(14,$dept_nr,$year,$month);
	}
	
	function getPersonellInfo($nr){
		global $db;
		$sql="SELECT ps.*,p.*,
							c.funk1,
							c.funk2,
							c.inphone1,
							c.inphone2,
							c.inphone3 
				FROM $this->tb AS ps, 
						$this->tb_person AS p LEFT JOIN
						$this->tb_cphone AS c ON c.personell_nr=$nr
				WHERE ps.nr=$nr
				 AND ps.pid=p.pid";
				 
	    if ($this->result=$db->Execute($sql)) {
		   	if ($this->record_count=$this->result->RecordCount()) {
				return $this->result->FetchRow();
			} else {
				return false;
			}
		}else {
			return false;
		}
	}
	function _getOCQuicklist($role_nr,$year=0,$month=0){
		global $db;
		$x='';
		$v='';
		$d=$this->depts;
		$row;
		$buffer=array();
		if(!$role_nr||!$year||!$month){
			return false;
		}else{
			list($x,$v)=each($d);
			$dept_list='dept_nr='.$v['nr'];
			while(list($x,$v)=each($d)){
				$dept_list.=' OR dept_nr='.$v['nr'];
			}
			$sql="SELECT dept_nr FROM $this->tb_dpoc WHERE role_nr=$role_nr AND ($dept_list) AND year=$year AND month=$month";
			
	    	if ($this->result=$db->Execute($sql)) {
		    	if ($this->record_count=$this->result->RecordCount()) {
					$row=$this->result->GetArray();
					while(list($x,$v)=each($row)) {
						$buffer[]=$v['dept_nr']; 
					}
					return $buffer;
				} else {
					return false;
				}
			}else {
		   	 return false;
			}
		}
	}
	function getDOCQuicklist(&$depts,$year,$month){
		$this->depts=$depts;
		return $this->_getOCQuicklist(15,$year,$month);
	}
	function getNOCQuicklist(&$depts,$year,$month){
		$this->depts=$depts;
		return $this->_getOCQuicklist(14,$year,$month);
	}	
	
	function searchPersonellBasicInfo($key){
		global $db;
		if(empty($key)) return false;
		$sql="SELECT ps.nr, ps.job_function_title, p.pid, p.name_last, p.name_first, p.date_birth 
				FROM $this->tb AS ps, $this->tb_person AS p";
		if(is_numeric($key)){
			$key=(int)$key;
			$sql.=" WHERE ps.nr = $key AND ps.pid=p.pid";
		}else{
			$sql.=" WHERE (ps.nr LIKE '$key%' 
						OR ps.job_function_title LIKE '$key%'
						Or p.pid LIKE '$key%'
						OR p.name_last LIKE '$key%'
						OR p.name_first LIKE '$key%'
						OR p.date_birth LIKE '$key%')
						AND p.pid=ps.pid";
		}
		$sql.=' ORDER BY p.name_last';
	    if ($this->result=$db->Execute($sql)) {
		   	if ($this->record_count=$this->result->RecordCount()) {
				return $this->result;
			} else {
				return false;
			}
		}else {
			return false;
		}
	}		
	function Exists($pid=0){
		global $db;
		if(!$pid){
			return false;
		}else{
			$sql="SELECT nr FROM $this->tb WHERE pid=$pid";
	    	if ($this->result=$db->Execute($sql)) {
		    	if ($this->result->RecordCount()) {
					$this->row=$this->result->FetchRow();
		    		return $this->row['nr'];
				} else {
					return false;
				}
			}else {
		   		return false;
			}
		}
	}
	function loadPersonellData($nr=0){
	    global $db;
		if(!$nr) return false;
/*		$sql="SELECT ps.*
				FROM $this->tb AS ps
				WHERE ps.nr=$nr";
*/		$this->sql="SELECT ps.*, p.title, p.name_last, p.name_first, p.date_birth, p.sex,
							p.addr_str,p.addr_str_nr,p.addr_zip, 
							p.photo_filename,
							c.funk1,
							c.funk2,
							c.inphone1,
							c.inphone2,
							c.inphone3,
							t.name AS citytown_name 
				FROM $this->tb AS ps, 
						$this->tb_person AS p 
						LEFT JOIN $this->tb_cphone AS c ON c.personell_nr=$nr
						LEFT JOIN $this->tb_citytown AS t ON p.addr_citytown_nr=t.nr
				WHERE ps.nr=$nr
						AND ps.pid=p.pid";
		if($this->result=$db->Execute($this->sql)) {
		    if($this->record_count=$this->result->RecordCount()) {
			    $this->personell_data=$this->result->FetchRow();
				$this->result=NULL;
			    $this->is_loaded=true;
			    $this->is_preloaded=true;
				//echo $this->sql; 
				return true;
		    } else {echo $this->sql;  return false;}
		} else {return false;}
	}
	function Title(){
	    //if(!$this->is_loaded) return false;
		return $this->personell_data['title'];
	}
	function LastName(){
	    //if(!$this->is_loaded) return false;
		return $this->personell_data['name_last'];
	}
	function FirstName(){
	    //if(!$this->is_loaded) return false;
		return $this->personell_data['name_first'];
	}
	function BirthDate(){
	    //if(!$this->is_loaded) return false;
		return $this->personell_data['date_birth'];
	}
	function PID(){
	    //if(!$this->is_loaded) return false;
		return $this->personell_data['pid'];
	}	
	function formattedAddress_DE(){
	    //if(!$this->is_loaded) return false;
		return $this->personell_data['addr_str'].' '.$this->personell_data['addr_str_nr'].'<br>'.$this->personell_data['addr_str_zip'].' '.$this->personell_data['citytown_name'];
	}
}
?>
