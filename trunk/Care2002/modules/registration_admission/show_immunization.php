<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$thisfile=basename(__FILE__);
if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update') {
	include('./include/save_immunization.inc.php');
}

require('./include/init_show.php');

if($mode=='show'){
	$sql="SELECT i.*, t.LD_var AS app_LD_var, t.name AS app_type_name FROM care_encounter AS e, care_person AS p, care_encounter_immunization AS i, care_type_application AS t
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." AND p.pid=e.pid AND e.encounter_nr=i.encounter_nr  AND i.application_type_nr=t.nr
		ORDER BY i.modify_time DESC";
		
	if($result=$db->Execute($sql)){
		$rows=$result->RecordCount();
	}else{
		echo $sql;
	}
}

$subtitle=$LDImmunization;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
