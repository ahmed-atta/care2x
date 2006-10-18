<?php




function task_write_config(&$status)
{
	if ($status['step'] != 9)
	{
		return true;
	}
	
	
	$data = array(
		'dbtype'        => $status['data']['db_type'],
		'dbhost'        => $status['data']['db_host'],
		'dbname'        => $status['data']['db_name'],
		'dbusername'    => $status['data']['db_user'],
		'dbpassword'    => $status['data']['db_pass'],
		
		'key'           => $status['data']['key1'],
		'key_2level'    => $status['data']['key2'],
		'key_login'     => $status['data']['key3'],
	
		'main_domain'   => $status['data']['path'],
		'fotoserver_ip' => $status['data']['path'],
		
		'httpprotocol'  => $status['data']['protocol']
	);

	$output = "<?php\n\n";
	
	foreach ($data as $dk => $dv)
	{
		$output .= ('$' . $dk . " = '" . str_replace("'", "\\'", $dv) . "';\n");
	}

	$output .= "\n\n?>";


	
	$GLOBALS['errors'][] = "We have output to write to write to the config file.\n";
	
	return true;
}

?>