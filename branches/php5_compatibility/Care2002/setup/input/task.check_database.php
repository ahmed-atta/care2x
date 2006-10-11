<?php


	require_once(APP_PATH.'/classes/adodb/adodb.inc.php');
	require_once(APP_PATH.'/classes/adodb/adodb-errorhandler.inc.php');
	require_once(APP_PATH.'/classes/adodb/adodb-xmlschema.inc.php');





function task_check_database(&$status)
{
	if ($status['step'] != 4)
	{
		return true;
	}
	

	
	@$db = ADONewConnection($status['data']['db_type']);

	if (!$db)
	{
		$GLOBALS['errors'][] = "The ADO driver does not support the db type " . $status['data']['db_type'];		
		$status['step'] = 3;
		return true;
	}

	
	@$ok = $db->Connect($status['data']['db_host'] . ':' . $status['data']['db_port'], $status['data']['db_user'], $status['data']['db_pass'], $status['data']['db_name']);
	

	if (!$ok)
	{
		$GLOBALS['errors'][] = "The ADO driver could not connect to the database using the information you provided.";
		$status['step'] = 3;
		return true; 	
	}


	return true;
}

?>