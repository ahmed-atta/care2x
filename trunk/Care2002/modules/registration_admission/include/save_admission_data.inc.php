<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('save_admission_data.inc.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');	
	
if(!isset($db)||!$db) include_once($root_path.'include/inc_db_makelink.php');
if($dblink_ok){
	
	$obj->setDataArray($HTTP_POST_VARS);
	
	switch($mode)
	{	
		case 'create': 
								if($obj->insertDataFromInternalArray()) {
										header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&pid=".$HTTP_SESSION_VARS['sess_pid']);
										exit;
								} else echo "$obj->sql<br>$LDDbNoSave";
								break;
		case 'update': 
								$obj->where=' nr='.$nr;
								if($obj->updateDataFromInternalArray($nr)) {
										header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&pid=".$HTTP_SESSION_VARS['sess_pid']);
										//echo "$obj->sql<br>$LDDbNoUpdate";
										exit;
								} else echo "$obj->sql<br>$LDDbNoUpdate";
								break;
	}// end of switch
} else { echo "$LDDbNoLink<br>"; } 
?>
