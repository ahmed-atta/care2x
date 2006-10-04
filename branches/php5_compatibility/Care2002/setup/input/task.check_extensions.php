<?php



function task_check_extensions(&$status)
{
	// Circular-reference protection
	$checked_list = array();
	
	
	foreach($GLOBALS['actions']['extensions'] as $ext => $options)
	{
		if (@$checked_list[$ext] === true)
		{
			// Save us a load of stuff down the road.
			continue;
		}
		
		if (extension_loaded($ext))
		{
			$checked_list[$ext] = true;
			$GLOBALS['messages'][] = "The required extension '$ext' was found.";
		}
		else
		{
			$checked_list[$ext] = false;
			
			if (isset($options['required'])) 
			{
				if ($options['required'] === true)
				{
					// Issue an error
					$GLOBALS['errors'][] = "The required extension '$ext' was not found.";
				}
				elseif (is_string($options['required']))
				{
					// A reference!  Check it...
					
					if (extension_loaded($options['required']))
					{
						// We have a safe alternate...
						$checked_list[$options['required']] = true;
						$GLOBALS['warnings'][] = "The extension '$ext' was not found, but the alternate extension '".$options['required']."' appears ok.";
					}
					else
					{
						$checked_list[$options['required']] = false;
						
						
						if ($GLOBALS['actions']['extensions'][$options['required']] === true)
						{
							// Issue an error
							$GLOBALS['errors'][] = "The required extensions '$ext' and '".$options['required']."' were not found.";
						}
						elseif (is_string($GLOBALS['actions']['extensions'][$options['required']]))
						{
							// The reference continues.
							$GLOBALS['warnings'][] = "The extension '$ext' was not found.  We will check for alternates starting with the extension '".$options['required']."'...";
						}
						else
						{
							// Issue a warning.
							$GLOBALS['warnings'][] = "The recommended extensions '$ext' and '".$options['required']."' were not found.";
						}
					}
				}
				else
				{
					// Issue a warning...
					$GLOBALS['warnings'][] = "The recommended extension '$ext' was not found.";	
				}
			}
		}
	}


	return true;
}

?>