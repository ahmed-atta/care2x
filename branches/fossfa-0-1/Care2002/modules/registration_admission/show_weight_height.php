<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

# Set defaults
if(!isset($wt_unit_nr)||!$wt_unit_nr) $wt_unit_nr=6; # set your default unit of weight msrmnt type, default 6 = kilogram
if(!isset($ht_unit_nr)||!$ht_unit_nr) $ht_unit_nr=7; # set your default unit of height msrmnt type, default 7 = centimeter
if(!isset($hc_unit_nr)||!$hc_unit_nr) $hc_unit_nr=7; # set your default unit of head circumfernce msrmnt type, default 7 = centimeter

$thisfile=basename(__FILE__);

require_once($root_path.'include/care_api_classes/class_measurement.php');
$obj=new Measurement;
$unit_types=$obj->getUnits();
# Prepare unit ids in array
$unit_ids=array();
while(list($x,$v)=each($unit_types)){
	$unit_ids[$v['nr']]=$v['id'];
}
reset($unit_types);

if(!isset($mode)){
	$mode='show';
}elseif($mode=='create'||$mode=='update') {

	include_once($root_path.'include/inc_date_format_functions.php');
	if($HTTP_POST_VARS['msr_date']) 	$HTTP_POST_VARS['msr_date']=@formatDate2STD($HTTP_POST_VARS['msr_date'],$date_format);
		else $HTTP_POST_VARS['msr_date']=date('Y-m-d');
	
	# Non standard time format
	$HTTP_POST_VARS['msr_time']=date('H.i');
	$HTTP_POST_VARS['create_time']=date('YmdHis'); # Create the timestamp to group the values
	//include('./include/save_prescription.inc.php');
	if($weight||$height||$head_c){
		# Set to no redirect
		$no_redirect=true;
		
		if($weight){
			$HTTP_POST_VARS['value']=$weight;
			$HTTP_POST_VARS['msr_type_nr']=6; # msrmt type 6 = weight
			$HTTP_POST_VARS['notes']=$wt_notes;
			$HTTP_POST_VARS['unit_nr']=$wt_unit_nr;
			$HTTP_POST_VARS['unit_type_nr']=2; # 2 = weight
			include('./include/save_admission_data.inc.php');
		}
		if($height){
			$HTTP_POST_VARS['value']=$height;
			$HTTP_POST_VARS['msr_type_nr']=7;  # msrmt type 7 = height
			$HTTP_POST_VARS['notes']=$ht_notes;
			$HTTP_POST_VARS['unit_nr']=$ht_unit_nr;
			$HTTP_POST_VARS['unit_type_nr']=3; # 3 = length
			include('./include/save_admission_data.inc.php');
		}
		if($head_c){
			$HTTP_POST_VARS['value']=$head_c;
			$HTTP_POST_VARS['msr_type_nr']=9; # msrmt type 9 = head circumference
			$HTTP_POST_VARS['notes']=$hc_notes;
			$HTTP_POST_VARS['unit_nr']=$hc_unit_nr;
			$HTTP_POST_VARS['unit_type_nr']=3; # 3 = length
			include('./include/save_admission_data.inc.php');
		}
	
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
	}
}

$lang_tables[]='obstetrics.php';
require('./include/init_show.php');

if($mode=='show'){

	$sql="SELECT m.nr,m.value,m.msr_date,m.msr_time,m.unit_nr,m.encounter_nr,m.msr_type_nr,m.create_time, m.notes
		FROM 	care_encounter AS e, 
					care_person AS p, 
					care_encounter_measurement AS m
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." 
			AND p.pid=e.pid 
			AND e.encounter_nr=m.encounter_nr  
			AND (m.msr_type_nr=6 OR m.msr_type_nr=7 OR m.msr_type_nr=9)
		ORDER BY m.msr_date DESC";

	if($result=$db->Execute($sql)){
		if($rows=$result->RecordCount()){
			while($msr_row=$result->FetchRow()){
				# group the elements
				$msr_comp[$msr_row['create_time']]['encounter_nr']=$msr_row['encounter_nr'];
				$msr_comp[$msr_row['create_time']]['msr_date']=$msr_row['msr_date'];
				$msr_comp[$msr_row['create_time']]['msr_time']=$msr_row['msr_time'];
				$msr_comp[$msr_row['create_time']][$msr_row['msr_type_nr']]=$msr_row;
			}
		}
	}
}

if(!isset($wt_unit_nr)||!$wt_unit_nr) $wt_unit_nr=6; # set your default unit of msrmnt type, default 6 = kilogram
if(!isset($ht_unit_nr)||!$ht_unit_nr) $ht_unit_nr=7; # set your default unit of msrmnt type, default 7 = centimeter
if(!isset($hc_unit_nr)||!$hc_unit_nr) $hc_unit_nr=7; # set your default unit of msrmnt type, default 7 = centimeter

$subtitle=$LDMeasurements;
$notestype='msr';
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

# Load GUI page
require('./gui_bridge/default/gui_show.php');
?>
