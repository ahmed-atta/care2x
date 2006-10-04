<?php



function task_check_writables(&$status)
{
	foreach($GLOBALS['actions']['writable_paths'] as $path)
	{
		if (!file_exists($path))
		{
			// File does not exist.
			$GLOBALS['errors'][] = "The path '$path' is either invalid, or could not be found.  Check if it exists.";
			continue;
		}
		
		if (!is_dir($path))
		{
			$GLOBALS['errors'][] = "The path '$path' appears to exist, but doesn't look like a directory.";
			continue;
		}
		
		if (!is_readable($path))
		{
			$GLOBALS['errors'][] = "The path '$path' is not readable.  This is most likely a permissions issue.";
			continue;
		}
		
		if (!is_writable($path))
		{
			$GLOBALS['errors'][] = "The path '$path' is not writable.  This is most likely a permissions issue.";
			continue;
		}
		
		$GLOBALS['messages'][] = "The path '$path' exists, and appears to be a readable and writable directory.";
	}


	foreach($GLOBALS['actions']['writable_files'] as $path)
	{
		if (!file_exists($path))
		{
			// File does not exist.
			$GLOBALS['errors'][] = "The file '$path' is either invalid, or could not be found.  Check if it exists.";
			continue;
		}
		
		if (!is_file($path))
		{
			$GLOBALS['errors'][] = "The file '$path' appears to exist, but doesn't look like a file.";
			continue;
		}
		
		if (!is_readable($path))
		{
			$GLOBALS['errors'][] = "The file '$path' is not readable.  This is most likely a permissions issue.";
			continue;
		}
		
		if (!is_writable($path))
		{
			$GLOBALS['errors'][] = "The file '$path' is not writable.  This is most likely a permissions issue.";
			continue;
		}
		
		$GLOBALS['messages'][] = "The file '$path' exists, and appears to be readable and writable.";
	}


	return true;
}

?>