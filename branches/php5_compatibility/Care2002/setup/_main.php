<?php


	// This is the only place that this particular define should
	// actually get defined.  Child scripts can check this define
	// for security purposes.
	
	define('INSTALLER_PATH', str_replace('\\', '/', dirname(__FILE__)));


	// Set up the application path so we have a frame of reference.	
	if (!defined('APP_PATH'))
	{
		define('APP_PATH', str_replace('\\', '/', realpath(INSTALLER_PATH . '/..')));
		
		if (APP_PATH === false)
		{
			// Unconditional failure
			die('We are unable to locate the current application path.  This is a serious and unrecoverable error relating to the php realpath() function.');	
		}
	}







	// The status file keeps the current installation progress.
	if (!file_exists(INSTALLER_PATH . '/output/status.php'))
	{
		die('Could not locate the installation status file.  Please re-extract this application from the archive.');
	}






	if ((!function_exists('version_compare')) || (version_compare(PHP_VERSION, '5.0', '<')))
	{
		// Define missing stuff here
		
		
		if (!defined('FILE_APPEND'))
		{
			define('FILE_APPEND', 1);
		}
		
		
		
		// Thanks to Kurt Brauchli for this quick piece of code.
		if( !function_exists('file_put_contents') )
		{	
			function file_put_contents($filename, $content, $flag = 0)
			{
				if ($flag == FILE_APPEND)
				{
					$fp = fopen($filename, 'w+');
				}
				else
				{
					$fp = fopen($filename, 'w');
				}
					
				fwrite($fp, $content);
				fclose($fp);
			}
		}




		
	}
















	// Inititalize a couple of things:
	$install_status          = '';
	$previous_install_status = '';


	// Action list (modified in input/action_list).
	$actions = array();
	$actions['list'] = array();
	$actions['writable_paths'] = array();
	$actions['writable_files'] = array();


	// Holds a couple of lists of things that went wrong
	$errors   = array();	// can't recover if this is not empty
	$warnings = array();	// recoverable, but whine about it anyway
	$messages = array();	// successful test with a message
	
	
	// Set up the output dump
	$output   = array();
	
	


	// Load the installation status file (contains the variable
	// $install_status which is a serialized array of what is 
	// going on in the install process.
	include_once(INSTALLER_PATH . '/output/status.php');

	// Save the status so we can see if the status file needs
	// updating later on.
	$previous_install_status = $install_status;
	
	
	// Attempt to unserialize the status array
	$status = @unserialize(base64_decode($install_status));
	
	
	
	/* The following cases will cause this installer to reload:
	 * 
	 * 		1)	$status is not an array (fresh checkout)
	 * 		2)	$status is empty (admin wants to reinstall)
	 * 		3)	The query string has reload==1 AND debug mode is enabled
	 */
	if (((!is_array($status)) || (count($status) == 0)) || ((@$_REQUEST['reload'] == 1) && DEBUG))
	{
		// We are in step 1.  We need to initialize the status array.
		$status = array();
	}


	// Safety checks on the current step
	if ((!isset($status['step'])) || ($status['step'] < 1) || ($status['step'] > STEP_COUNT) || (floor($status['step']) != $status['step']))
	{
		$status['step'] = 1;
	}











	/*
	 * NOTICE
	 * 
	 * At this point we have a status array, which *is* an array, and it should contain
	 * fairly valid data.  We should start the output here for prosperity and happiness
	 * and then spit out specific errors.  We also need to read the inputs to see what
	 * stuff needs to be done.
	 * 
	 */
	
	
	// Super secret trick here:  if you don't include the action list,
	// no actions will be run.  Perfect for if you want to block the
	// installer!


	if (isset($status['installed']) && ($status['installed'] == true))
	{
		$GLOBALS['errors'][] = "This application is already installed.";	
	}
	{
		// Get the action list
		include_once(INSTALLER_PATH . '/input/action_list.php');
		
		// Set this up just for the hell of it.
		$status['installed'] = false;
	}
	
	
	
	
	if ((!isset($status['data'])) || (!is_array($status['data'])))
	{
		$status['data'] = array();	
	}
	
	
	
	
	
	
	
	


	$action_preg = '/^[a-z0-9_]{1,24}$/iU';
	

	foreach($actions['list'] as $action)
	{
		if (@$status['fatal'] === true)
		{
			// We are screwed!
			$GLOBALS['errors'][] = "A fatal error occured that will prevent installation from continuing.";
			break;
		}
		
		if (!preg_match($action_preg, $action))
		{
			$GLOBALS['errors'][] = "FATAL: The action word '$action' must match the PCRE '$action_preg', but it doesn't!";
			$status['fatal'] = true;
			continue;	
		}
		
		$filename = INSTALLER_PATH . "/input/task.$action.php";
		$function = 'task_' . $action;
		
		if (!include_once($filename))
		{
			$GLOBALS['warnings'][] = "Unable to include '$filename' for the action word '$action'.  Checking if function exists anyway...";
			continue;
		}
		
		if (!function_exists($function))
		{
			$GLOBALS['errors'][] = "Unable to find '$function' for the action word '$action'.";
			continue;	
		}
		
		if (!$function($status))
		{
			$GLOBALS['errors'][] = "The action '$action' failed to execute and returned false.";	
			continue;
		}
		
		// We are good!
	}





	// Save the status
	$install_status = base64_encode(serialize($status));
	
	if (!($previous_install_status == $install_status))
	{
		// We have dirty data!
		
		$status_output = '';
		$status_output .= '<?php' . "\n";
		$status_output .= '// This file is automatically generated and maintained by the installer' . "\n\n";
		$status_output .= 'if (!defined(\'INSTALLER_PATH\')) { die(\'Hacking attempt detected.\'); }' . "\n\n";
		$status_output .= '$install_status = ' ."'$install_status';\n";
		$status_output .= '?>';
		
		
		file_put_contents(INSTALLER_PATH . '/output/status.php', $status_output);
	}
	












?>