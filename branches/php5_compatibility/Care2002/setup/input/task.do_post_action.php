<?php



function task_do_post_action(&$status)
{
	
	if (!isset($_REQUEST['submit']))
	{
		// There is no post action to do
		return true;
	}


	if ($_REQUEST['submit'] == 'Next >')
	{
		if (($status['step'] >= 2) && (count($GLOBALS['errors']) > 0))
		{
			$GLOBALS['warnings'][] = "You must correct the errors before continuing.";
			return true;	
		}
		
		$status['step'] += 1;
		
		if ($status['step'] > STEP_COUNT)
		{
			$status['step'] = STEP_COUNT;
		}
	}
	elseif ($_REQUEST['submit'] == '< Back')
	{
		$status['step'] -= 1;
		
		if ($status['step'] < 1)
		{
			$status['step'] = 1;
		}
	}
	elseif ($_REQUEST['submit'] == 'Start Over')
	{
		$status['step'] = 1;
		$status['data'] = array();
		$GLOBALS['warnings'][] = "You have started the installation process over.";
	}
	elseif ($_REQUEST['submit'] == 'Refresh')
	{
		// Do nothing
	}
	else
	{
		// Raise a warning
		$GLOBALS['warnings'][] = "Unknown post action '".$_REQUEST['submit']."'.  Please try again.";
		return true;	
	}
	


	return true;
}

?>