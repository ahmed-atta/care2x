<?php
	
	// NOTE:  Scroll past the introduction to manage the config


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




	// Set this to TRUE to debug the installer.
	define('DEBUG', true);
	


	// How many steps in the installer?  This is just for assertion checking.
	define('STEP_COUNT', 9);






	// Include all the support stuff
	include_once('_main.php');



	switch ($status['step'])
	{
		case 1:
			$output['page_title'] = 'Introduction';
			break;
		
		case 2:
			$output['page_title'] = 'Running Some Checks';
			break;
			
		case 3:
			$output['page_title'] = 'Setup Database Server';
			break;

		case 4:
			$output['page_title'] = 'Setup Care2x Administrator';
			break;

		case 5:
			$output['page_title'] = 'Configure Protocol Options';
			break;
		
		case 6:
			$output['page_title'] = 'Advanced Settings';
			break;
		
		case 7:
			$output['page_title'] = 'Ready to Install';
			break;
		
		case 8:
			$output['page_title'] = 'Care2x Installation';
			break;
		
		case 9:
			$output['page_title'] = 'Finished!';
			break;
		
	}


	
	include('_html_head.php');
	include('_step'. $status['step'] .'.php');
	include('_html_foot.php');

	
?>