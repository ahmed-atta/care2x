<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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

}
require('./include/init_show.php');

$sql="SELECT n.* FROM   care_neonatal AS n, care_person AS p
		WHERE p.pid=".$HTTP_SESSION_VARS['sess_pid']." AND p.pid=n.pid 
		ORDER BY n.modify_time DESC";
		
if($result=$db->Execute($sql)){
	$rows=$result->RecordCount();
}else{
	echo "$sql<p>$LDDbNoRead";
}
$subtitle=$LDBirthDetails;

$buffer=str_replace('~tag~',$title.' '.$name_last,$LDNoRecordFor);
$norecordyet=str_replace('~obj~',strtolower($subtitle),$buffer); 

/* Load GUI page */
require('./gui_bridge/default/gui_show.php');
?>
