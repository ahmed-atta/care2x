<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

define('AUTOSHOW_ONERESULT',1); # Defining to 1 will automatically show the admission data if the search result is one, otherwise the result will be listed

function Cond($item,$k){
	global $where,$tab,$HTTP_POST_VARS;
	if(empty($HTTP_POST_VARS[$item])) return false;
	else{
		$buf=" $tab.$item LIKE \"".$HTTP_POST_VARS[$item]."%\"";
		if(!empty($where)) $where.=' AND '.$buf;
		 else $where=$buf;
	}
}
	
function fCond($item,$k){
	global $orwhere,$tab,$HTTP_POST_VARS;
	if(empty($HTTP_POST_VARS[$item])) return false;
	else{
		$buf=" f.class_nr LIKE \"".$HTTP_POST_VARS[$item]."%\"";
		if(!empty($orwhere)) $orwhere.=' OR '.$buf;
		 else $orwhere=$buf;
	}
}


define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

if (isset($mode) && ($mode=='search')){

	$select="SELECT p.name_last,p.name_first,p.date_birth,p.sex,e.encounter_nr,e.encounter_class_nr,e.is_discharged,e.encounter_date FROM ";

	$where=''; 		# ANDed where condition
	$orwhere='';	# ORed where condition
	$datecond='';	# date condition
	 
	# Walk the arrays in the function to preprocess the search condition data
	$parray=array('name_last','name_first','date_birth','sex');
	$tab='p';
	array_walk($parray,'Cond');
	$earray=array('encounter_nr','encounter_class_nr','current_ward_nr','referrer_diagnosis','referrer_dr','referrer_recom_therapy','referrer_notes','insurance_class_nr');
	$tab='e';
	array_walk($earray,'Cond');
	$farray=array('sc_care_class_nr','sc_room_class_nr','sc_att_dr_class_nr');
	array_walk($farray,'fCond');
	
	# Process the dates
	 if(isset($date_start)&&!empty($date_start)) $date_start=@formatDate2STD($date_start,$date_format);
	 if(isset($date_end)&&!empty($date_end)) $date_end=@formatDate2STD($date_end,$date_format);
	 if(isset($date_birth)&&!empty($date_birth)) $date_birth=@formatDate2STD($date_birth,$date_format);
	
	if($date_start){
		if($date_end){
			$datecond="(e.encounter_date LIKE '$date_start%' OR e.encounter_date>'$date_start') AND (e.encounter_date<'$date_end' OR e.encounter_date LIKE '$date_end%')";
		}else{
			$datecond="e.encounter_date LIKE '$date_start%'";
		}
	}elseif($date_end){
			$datecond="(e.encounter_date< '$date_end' OR e.encounter_date LIKE '$date_end%')";
	}
	
	if(!empty($datecond)){
		if(empty($where)) $where=$datecond;
		    else $where.=' AND '.$datecond;
	}
			
	if(!empty($orwhere)) {
		if(empty($where)) $where='('.$orwhere.')';
		    else $where.=' AND ('.$orwhere.') ';
	}
	
	if($name_last||$name_first||$date_birth||$sex){
		if($encounter_nr||$encounter_class_nr||$current_ward_nr||$referrer_diagnosis||$referrer_dr||$referrer_recom_therapy||$referrer_notes||$insurance_class_nr){
			if($sc_care_class_nr||$sc_room_class_nr||$sc_att_dr_class_nr){
	        	$from=" care_person AS p, care_encounter AS e, care_encounter_financial_class AS f ";
				$where.=" AND e.encounter_nr=f.encounter_nr AND e.pid=p.pid ";
			}else{
				$from=" care_person AS p, care_encounter AS e";
				$where.=" AND p.pid=e.pid";
			}
		}else{
			$from=" care_person AS p, care_encounter AS e";
			$where.=" AND p.pid=e.pid";
		}
				
	}else{
		if($date_start||$date_end||$encounter_nr||$encounter_class_nr||$current_ward_nr||$referrer_diagnosis||$referrer_dr||$referrer_recom_therapy||$referrer_notes||$insurance_class_nr){
			if($sc_care_class_nr||$sc_room_class_nr||$sc_att_dr_class_nr){
				$from=" care_person AS p, care_encounter AS e, care_encounter_financial_class AS f";
				$where.=" AND p.pid=e.pid AND e.encounter_nr=f.encounter_nr";
			}else{
				$from="  care_person AS p, care_encounter AS e";
				$where.=" AND p.pid=e.pid";
			}
		}else{
			if($sc_care_class_nr||$sc_room_class_nr||$sc_att_dr_class_nr){
				$from="  care_person AS p, care_encounter AS e, care_encounter_financial_class as f";
				$where.=" AND p.pid=e.pid AND f.encounter_nr=e.encounter_nr";
			}
		}
	}
	
	if(!empty($where)) {

		$sql="$select$from WHERE $where AND NOT (e.encounter_status LIKE 'cancelled') AND e.status NOT IN ('void','inactive','hidden','deleted') ORDER by e.create_time DESC";
		if($ergebnis=$db->Execute($sql)) {			
  			$rows=$ergebnis->RecordCount();			
			
			if(AUTOSHOW_ONERESULT){					
	        	if($rows==1){
		      		# If result is single item, display the data immediately 
				   	$result=$ergebnis->FetchRow();
				   	header("Location:aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&target=archiv&origin=archiv&encounter_nr=".$result['encounter_nr']);
				   	exit;
	        	}
			}
		}else{
			echo "$LDDbNoRead<p>$sql";
			$rows=0;
		}
	}
}
require_once($root_path.'include/care_api_classes/class_globalconfig.php');

$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient%');
$glob_obj->getConfig('person%');

$thisfile=basename(__FILE__);
$breakfile='patient.php';
$newdata=1;
$target='archiv';


if(!isset($rows)||!$rows) {

	include($root_path.'include/care_api_classes/class_encounter.php');
	include($root_path.'include/care_api_classes/class_ward.php');
	include_once($root_path.'include/care_api_classes/class_insurance.php');

	# Create encounter object
	$encounter_obj=new Encounter();
	# Load the wards info 
	$ward_obj=new Ward;
	$items='nr,name';
	$ward_info=&$ward_obj->getAllWardsItemsObject($items);
	# Get all encounter classes
	$encounter_classes=$encounter_obj->AllEncounterClassesObject();
	# Get the insurance classes */
	# Create new person's insurance object */
	$insurance_obj=new Insurance;	 
	$insurance_classes=&$insurance_obj->getInsuranceClassInfoObject('class_nr,LD_var,name');

	if(!$GLOBAL_CONFIG['patient_service_care_hide']){
		# Get the care service classes
		$care_service=$encounter_obj->AllCareServiceClassesObject();
	}
	if(!$GLOBAL_CONFIG['patient_service_room_hide']){
		# Get the room service classes 
		$room_service=$encounter_obj->AllRoomServiceClassesObject();
	}
	if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
		# Get the attending doctor service classes 
		$att_dr_service=$encounter_obj->AllAttDrServiceClassesObject();
	}			
}
# Load GUI page
require('./gui_bridge/default/gui_aufnahme_list.php');
?>
