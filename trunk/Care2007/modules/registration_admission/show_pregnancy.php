<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$thisfile=basename(__FILE__);
require_once($root_path.'include/care_api_classes/class_obstetrics.php');
$obj=new Obstetrics;
# Point the core data to pregnancy
$obj->usePregnancy();
# Create measurement object
require_once($root_path.'include/care_api_classes/class_measurement.php');
$msr=new Measurement;


if(!isset($allow_update)) $allow_update=FALSE;

if(!isset($mode)){
	$mode='show';
}elseif($mode=='newdata') {
	
	include_once($root_path.'include/inc_date_format_functions.php');
	$saved=FALSE;

	# Prepare additional info saving
	$HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
	$HTTP_POST_VARS['modify_time']=date('YmdHis'); # Create own timestamp for cross db compatibility
	if(empty($HTTP_POST_VARS['delivery_date'])) $HTTP_POST_VARS['delivery_date']=date('Y-m-d');
		else $HTTP_POST_VARS['delivery_date']=@formatDate2STD($HTTP_POST_VARS['delivery_date'],$date_format);
	if(empty($HTTP_POST_VARS['delivery_time'])) $HTTP_POST_VARS['delivery_time']=date('H:i:s');
		else $HTTP_POST_VARS['delivery_time']=@convertTimeToStandard($HTTP_POST_VARS['delivery_time']);

	//if(empty($HTTP_POST_VARS['blood_loss'])) $HTTP_POST_VARS['blood_loss_unit']=0;
		

	if($allow_update){
		$obj->setWhereCondition('nr='.$HTTP_POST_VARS['rec_nr']);
		$obj->setDataArray($HTTP_POST_VARS);

		if($obj->updateDataFromInternalArray($HTTP_POST_VARS['rec_nr'])) {
			$saved=true;
		}else{
			echo $obj->getLastQuery()."<br>$LDDbNoUpdate";
		}
	}else{
		# Deactivate the old record first if exists
		if(isset($rec_nr)&&$rec_nr){
			$obj->deactivatePregnancy($HTTP_POST_VARS['rec_nr']);
		}
		$HTTP_POST_VARS['history']="Create ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		$HTTP_POST_VARS['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$HTTP_POST_VARS['create_time']=date('YmdHis'); # Create own timestamp for cross db compatibility
		$obj->setDataArray($HTTP_POST_VARS);

		if($obj->insertDataFromInternalArray()) {
			$saved=true;
		}else{
			echo $obj->getLastQuery()."<br>$LDDbNoSave";
		}
	}
	if($saved){
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
	}
}
$lang_tables[]='obstetrics.php';
require('./include/init_show.php');

if($parent_admit){
	# Get the pregnancy data of this encounter
	$pregs=&$obj->Pregnancies($HTTP_SESSION_VARS['sess_en'],'_ENC');
}else{
	# Get all pregnancies  of this person
	$pregs=&$obj->Pregnancies($HTTP_SESSION_VARS['sess_pid'],'_REG');
}
$rows=$obj->LastRecordCount();

$subtitle=$LDPregnancies;
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
