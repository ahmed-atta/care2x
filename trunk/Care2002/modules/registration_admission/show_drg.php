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
$thisfile=basename(__FILE__);

# Create DRG object
require_once($root_path.'include/care_api_classes/class_drg.php');
$obj=new DRG;

if(!isset($mode)) $mode='show';

require('./include/init_show.php');

if($parent_admit){
	# Get the DRG records data of this encounter
	$drg_obj=&$obj->encDRGList($HTTP_SESSION_VARS['sess_en']);
}else{
	# Get all DRG records  of this person
	$drg_obj=&$obj->pidDRGList($HTTP_SESSION_VARS['sess_pid']);
}
$rows=$obj->LastRecordCount();
//echo $obj->getLastQuery();

$subtitle=$LDDRG;
$HTTP_SESSION_VARS['sess_file_return']=$thisfile;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
