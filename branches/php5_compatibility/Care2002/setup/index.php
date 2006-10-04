<?php

	/*
	 *	This is the new installer for the Care2x project.  The installer works on
	 *	input functions that perform certain installation tasks.  Each one is
	 *	executed as part of a group, so that in the end you should either have a
	 *	working, installed copy of the program or a list of errors that need to be
	 *	fixed.  Please refrain from editing this particular script.
	 *
	 *	THE LIST OF ACTIONS can be found in:  input/action_list.php
	 *
	 *	Each action is made up of an action file and an action *function*.  As an
	 *	action is requested, the file will be included, and a function will be 
	 *	called.  The function SHOULD exist in the file that is included.  The
	 *	naming convention is:
	 *
	 *		Action:			myaction2
	 *		File:			input/task.myaction2.php
	 *		Function:		task_myaction2
	 *		Prototype:		function task_myaction2(&$status);
	 *
	 *	Note that each function is recieves a truncated copy of the $status array
	 *	from below.  Functions should only make edits that it knows are safe to do
	 *	and therefore careful coding will be a must.
	 *
	 *	This installer is much more strict than the original, but at least it will
	 *	work on almost all platforms.  Have a nice day.  --Brian Zab
	 */


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




	// Set this to TRUE to debug the installer.
	define('DEBUG', true);



	// The status file keeps the current installation progress.
	if (!file_exists(INSTALLER_PATH . '/output/status.php'))
	{
		die('Could not locate the installation status file.  Please re-extract this application from the archive.');
	}





	// Inititalize a couple of things:
	$install_status          = '';
	$previous_install_status = '';

	// Holds a couple of lists of things that went wrong
	$errors   = array();	// can't recover if this is not empty
	$warnings = array();	// recoverable, but whine about it anyway
	$messages = array();	// successful test with a message
	
	
	


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



	/*
	 * NOTICE
	 * 
	 * At this point we have a status array, which *is* an array, and it should contain
	 * fairly valid data.  We should start the output here for prosperity and happiness
	 * and then spit out specific errors.  We also need to read the inputs to see what
	 * stuff needs to be done.
	 * 
	 */
	
	

	// Get the action list
	include_once(INSTALLER_PATH . '/input/action_list.php');
	


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
	
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title>Care2x Installer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<table class="title">
	<tr>
		<td width="150"><img src="images/care_logo.gif" alt="Care2x Project" title="The Care2x Project" /></td>
		<td align="center">{$INSTALLER_PHASE}</td>
		<td width="150">&nbsp;</td>
	</tr>
</table>
	
<br />  

<div class="content">
	<div class="install_block">
		<a href="{$APP_URL}">Start using Care2x</a>
	</div>
	
	<table class="install_block">
		<tr>
			<td align="left"><a href="{$smarty.server.PHP_SELF}?restart_installer=true">Restart Installation</a></td>
			<td align="right"><a href="{$smarty.server.PHP_SELF}?next_step=true">Continue...</a></td>
		</tr>
	</table>
</div>



<div class="footer">
	<table width="100%" border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td>
				<a href="http://www.care2x.org/">Care2x Home</a> :: 
				<a href="http://www.care2x.org/wiki/">Wiki</a> :: 
				<a href="http://sourceforge.net/mailarchive/forum.php?forum_id=11772">Mailing List</a> :: 
				<a href="http://sourceforge.net/projects/care2002/">SF.net Project</a>
				<br />
				Copyright 2002-2006 Elpidio Latorilla, 2006 Brian Zablocky
			</td>
			<td align="right" valign="bottom">
				Portions derived from <a href="http://www.mirrormed.org">MirrorMed</a> installer
			</td>
		</tr>
	</table>
</div>


</html>
	
<?php
	if (DEBUG)
	{
		print '<pre>' . htmlspecialchars(print_r($GLOBALS, true)) . '</pre>';
	}
?>