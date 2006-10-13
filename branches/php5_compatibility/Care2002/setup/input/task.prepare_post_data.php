<?php



function task_prepare_post_data(&$status)
{
	$field_copy = $GLOBALS['actions']['fields'];
	
	
	foreach($field_copy as $field_name => $field_data)
	{
		$GLOBALS['actions']['fields'][$field_name]['has_error'] = false;
		
		if (isset($_REQUEST[$field_data['html_name']]))
		{
			// The data exists...
			
			if (!isset($field_data['type']))
			{
				// Raise an error
				$GLOBALS['errors'][] = "The field '$field_name' defined in the action list has no type.";
				continue;
			} 
			elseif (substr($field_data['type'], 0, 1) == 's')
			{
				// Check it against the preg
				
				if (isset($field_data['preg']) && (strlen($field_data['preg']) > 0))
				{
					if (!preg_match($field_data['preg'], $_REQUEST[$field_data['html_name']]))
					{
						// Raise an error
						$GLOBALS['errors'][] = "The field '$field_name' contains an invalid value supplied by the user.";
						$GLOBALS['actions']['fields'][$field_name]['has_error'] = true;
						continue;
					}
				}
			}
			elseif (substr($field_data['type'], 0, 1) == 'n')
			{
				// Check it against the ranges
				
				if (isset($field_data['min']) && isset($field_data['max']))
				{
					if (($field_data['min'] > $_REQUEST[$field_data['html_name']]) && ($_REQUEST[$field_data['html_name']] > $field_data['max']))
					{
						// Raise an error
						$GLOBALS['errors'][] = "The field '$field_name' contains an invalid value supplied by the user.";
						$GLOBALS['actions']['fields'][$field_name]['has_error'] = true;
						continue;
					}
				}
				else
				{
					// Raise a warning
					$GLOBALS['warnings'][] = "The field '$field_name' defined in the action list does not have a range of numbers to test against.";
				}
			}
			else
			{
				// Raise an error
				$GLOBALS['errors'][] = "The field '$field_name' defined in the action list contains an invalid data type.";
				continue;
			}
			
			// Both of these need to be set...
			$GLOBALS['actions']['fields'][$field_name]['value'] = $_REQUEST[$field_data['html_name']];
			$status['data'][$field_data['html_name']] = $_REQUEST[$field_data['html_name']];	
		}
		else
		{
			// Nothing in the $_REQUEST matches this field.  Let's default it
			$GLOBALS['actions']['fields'][$field_name]['value'] = $GLOBALS['actions']['fields'][$field_name]['default'];
		}
	}
	

	return true;
}

?>