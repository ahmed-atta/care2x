<?php

//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org,
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='aufnahme.php';
$lang_tables[]='pharmacy.php';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_person.php');
$person_obj = new Person;

// If this side is called by an external cross link, this will be stored into a session variable:
//echo $externalcall."....".$target;exit();

if (empty($encounter_nr) and !empty($pid)) {
	$encounter_nr = $person_obj->CurrentEncounter($pid);
	$HTTP_SESSION_VARS['sess_en'] = $encounter_nr;
}
$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;
if ($debug) {
	if (!empty($back_path)) $backpath=$back_path;

	echo "file: show_prescription<br>";
    if (!isset($externalcall))
      echo "internal call<br>";
    else
      echo "external call<br>";

    echo "mode=".$mode."<br>";

		echo "show=".$show."<br>";

    echo "nr=".$nr."<br>";

    echo "breakfile: ".$breakfile."<br>";

    echo "backpath: ".$backpath."<br>";

    echo "pid:".$pid."<br>";

    echo "encounter_nr:".$encounter_nr."<br>";

	echo "Session-ecnounter_nr: ".$HTTP_SESSION_VARS['sess_en'];
}

if(!$prescription_date) $prescription_date = date("Y-m-d");
define('NO_2LEVEL_CHK',1);
$thisfile=basename(__FILE__);
if(!isset($mode)){
	$mode='show';
} elseif($mode=='create'||$mode=='update' || $mode=='delete') {

	include_once($root_path.'include/care_api_classes/class_prescription.php');
	if(!isset($obj)) $obj=new Prescription;

	include_once($root_path.'include/inc_date_format_functions.php');

	if($_POST['prescribe_date']) $_POST['prescribe_date']=@formatDate2STD($_POST['prescribe_date'],$date_format);
	else $_POST['prescribe_date']=date('Y-m-d');

	$_POST['create_id']=$HTTP_SESSION_VARS['sess_user_name'];

	//$db->debug=true;
	// Insert the prescription without other checks into the database. This should be dony be the doctor and
	// there was the requirement that there should be no restrictions given...
	//include('./include/save_admission_data.inc.php');

	include('./include/save_prescription_data.inc.php');

}

/* For external call, there is no encounter number given. This can be determined if we have the encounter no in the $pn variable */

if (isset($pn)) {
  require_once($root_path.'include/care_api_classes/class_encounter.php');
  $encounter_obj=new Encounter($pn);
  $pid=$encounter_obj->EncounterExists($pn);
  $HTTP_SESSION_VARS['sess_pid']=$pid;
  $HTTP_SESSION_VARS['sess_en']=$pn;
}


require('./include/init_show.php');

if($parent_admit){
    $sql="SELECT pr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_prescription AS pr
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']."
			AND p.pid=e.pid
			AND e.encounter_nr=".$HTTP_SESSION_VARS['sess_en']."
			AND e.encounter_nr=pr.encounter_nr
			AND pr.prescribe_date = '".$prescription_date."'
		ORDER BY pr.modify_time DESC";
}else{
	$sql="SELECT pr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_prescription AS pr
		  WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." AND p.pid=e.pid AND e.encounter_nr=pr.encounter_nr
		  ORDER BY pr.modify_time DESC";
}

if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
}else{
echo $sql;
}
$subtitle=$LDPrescriptions;
$notestype='prescription';
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer);


/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
