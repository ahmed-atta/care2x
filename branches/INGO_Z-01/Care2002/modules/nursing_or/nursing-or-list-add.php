<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
//define('LANG_FILE','doctors.php');
if($HTTP_SESSION_VARS['sess_user_origin']=='personell_admin'){
	$local_user='aufnahme_user';
}else{
	$local_user='ck_op_dienstplan_user';
}
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_personell.php');
$pers_obj=new Personell;
$pers_obj->useAssignmentTable();
$data=array();

//$db->debug=true;

if($mode!='delete'){
	$data['personell_nr']=$nr;
	$data['role_nr']=16; // 16 = nurse (role person)
	$data['location_type_nr']=1; // 1 = dept (location type)
	$data['location_nr']=$dept_nr;
	$data['date_start']=date('Y-m-d');
}

$data['modify_id']=$HTTP_SESSION_VARS['sess_user_name'];

switch($mode){
	case 'save':
					$data['history']="Add: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n";
					$data['create_id']=$HTTP_SESSION_VARS['sess_user_name'];
					$data['create_time']=date('YmdHis');
					$pers_obj->setDataArray($data);
					if(!$pers_obj->insertDataFromInternalArray())  echo "$obj->sql<br>$LDDbNoSave";
					break;
	case 'update':
					$data['history']=$pers_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n");
					$pers_obj->setDataArray($data);
					$data['modfiy_id']=$HTTP_SESSION_VARS['sess_user_name'];
					$data['modify_time']=date('YmdHis');
					if(!$pers_obj->updateDataFromInternalArray($item_nr))  echo "$obj->sql<br>$LDDbNoUpdate";
					break;
	case 'delete':
					$data['status']='deleted';
					$data['date_end']=date('Y-m-d');
					$data['history']=$pers_obj->ConcatHistory("Deleted: ".date('Y-m-d H:i:s')." = ".$HTTP_SESSION_VARS['sess_user_name']."\n");
					$data['modfiy_id']=$HTTP_SESSION_VARS['sess_user_name'];
					$data['modify_time']=date('YmdHis');
					$pers_obj->setDataArray($data);
					if(!$pers_obj->updateDataFromInternalArray($item_nr))  echo "$obj->sql<br>$LDDbNoUpdate";
}
header("location:nursing-or-dienst-personalliste.php".URL_REDIRECT_APPEND."&saved=1&retpath=$retpath&ipath=$ipath&dept_nr=$dept_nr&nr=$nr");
exit;
?>
