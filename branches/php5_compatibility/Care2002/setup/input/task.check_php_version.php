<?php


function task_check_php_version(&$status)
{
	if (!function_exists('version_compare'))
	{
		// We may be using a version smaller than 4.1
	
		$GLOBALS['errors'][] = "You must run at least php version 4.1 or else this application WILL FAIL.";
		$status['fatal'] = true;
		return false;
	}
	
	if ((version_compare(PHP_VERSION, $GLOBALS['actions']['params']['maximum_php_version'], ">")) ||
	    (version_compare(PHP_VERSION, $GLOBALS['actions']['params']['minimum_php_version'], "<")))
	{
		$GLOBALS['warnings'][] = "This application strongly recommends a PHP version between " . $GLOBALS['actions']['params']['minimum_php_version'] . " and " . $GLOBALS['actions']['params']['maximum_php_version'];
		return true;
	}
	
	
	$GLOBALS['messages'][] = "PHP Version is between " . $GLOBALS['actions']['params']['minimum_php_version'] . " and " . $GLOBALS['actions']['params']['maximum_php_version'];
	
	return true;
}




?>