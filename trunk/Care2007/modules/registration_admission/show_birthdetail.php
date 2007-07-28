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

//$db->debug=true;

if(!isset($allow_update)) $allow_update=false;

if(!isset($mode)){
	$mode='show';
}elseif($mode=='newdata') {
	
	include_once($root_path.'include/inc_date_format_functions.php');
	$saved=false;

	# Prepare additional info for saving
	$HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
	$HTTP_POST_VARS['modify_time']=date('YmdHis'); # Create own timestamp for cross db compatibility
	if($HTTP_POST_VARS['docu_by']) $HTTP_POST_VARS['modify_id']=$HTTP_POST_VARS['docu_by'];
		else $HTTP_POST_VARS['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];
	if(empty($HTTP_POST_VARS['delivery_date'])) $HTTP_POST_VARS['delivery_date']=date('Y-m-d');
		//else $HTTP_POST_VARS['delivery_date']=@formatDate2STD($HTTP_POST_VARS['delivery_date'],$date_format);

	# Update child encounter to parent encounter
	if(!empty($HTTP_POST_VARS['parent_encounter_nr'])) $obj->AddChildNrToParent($HTTP_SESSION_VARS['sess_en'],$HTTP_POST_VARS['parent_encounter_nr'],$HTTP_POST_VARS);
	//echo $obj->getLastQuery();
	
	if($allow_update){
		$obj->setWhereCondition('pid='.$HTTP_POST_VARS['pid']);
		$obj->setDataArray($HTTP_POST_VARS);

		if($obj->updateDataFromInternalArray($HTTP_POST_VARS['pid'])) {
			$saved=true;
		}else{
			echo $obj->getLastQuery."<br>$LDDbNoUpdate";
		}
	}else{
		# Deactivate the old record first if exists
		$obj->deactivateBirthDetails($HTTP_SESSION_VARS['sess_pid']);
		
		$HTTP_POST_VARS['history']="Create ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n";
		if($HTTP_POST_VARS['docu_by']) $HTTP_POST_VARS['create_id']=$HTTP_POST_VARS['docu_by'];
			else $HTTP_POST_VARS['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
		$HTTP_POST_VARS['create_time']=date('YmdHis'); # Create own timestamp for cross db compatibility
		$obj->setDataArray($HTTP_POST_VARS);

		if($obj->insertDataFromInternalArray()) {
			$saved=true;
		}else{
			echo $obj->getLastQuery."<br>$LDDbNoSave";
		}		
	}
	if($saved){
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
	}
}

# Add extra language table
$lang_tables=array('obstetrics.php');
require('./include/init_show.php');

# Get all birth details data of the person
$result=&$obj->BirthDetails($HTTP_SESSION_VARS['sess_pid']);
if($rows=$obj->LastRecordCount()){
	$birth=$result->FetchRow();
}

$subtitle=$LDBirthDetails;

$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
