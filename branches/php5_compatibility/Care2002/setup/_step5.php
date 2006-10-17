<?php if (!defined('INSTALLER_PATH')) { header('Location: index.php'); exit; } ?> 


<p>
	If you don't know what this field does, it is recommended that you leave it at
	the default value.  Alternatively (and even better) you should contact your web
	server administrator for help with determining the correct setting.<br />
	<br />
	Some people may google for the differences and find that HTTPS seems to be a 
	smarter choice for the security-conscious.  However, if your web server does
	not agree with this setting, the application will intermittently fail.
</p>


<?php

	echo "<table border=\"0\" width=\"60%\" align=\"center\">\n";
	
	foreach($actions['fields'] as $field_name => $field_data)
	{
		if ($field_data['group'] == 2)
		{
			echo "<tr>\n";
			echo "<td align=\"left\" valign=\"middle\">";
				echo '<label for="'. $field_data['html_name'] .'">';
					echo $field_data['html_label'];
				echo "</label>\n";
			echo "</td>\n";
			echo "<td align=\"left\" valign=\"middle\">";
				
				if ($field_data['html_type'] == 'select')
				{
					echo '<select name="'. $field_data['html_name'] .'">' . "\n";
					
					$have_selected = false;
					
					foreach($field_data['values'] as $k => $v)
					{
						echo '<option value="'. $k .'"'; 
						
						if	(
								(@$status['data'][$field_data['html_name']] == $k) ||
								((@$field_data['default'] == $k) && ($have_selected == false))
							)
						{
							echo ' selected="selected" ';
							$have_selected = true;
						}
						
						echo '>' . $v . '</option>' . "\n";
					}
					
					echo '</select>';	
				}
				else
				{
					echo '<input name="'. $field_data['html_name'] .'" type="'. $field_data['html_type'] .'" value="'.
				
					((@$_REQUEST[$field_data['html_name']] != '')
						? $_REQUEST[$field_data['html_name']]
						: ((@$field_data['value'] != '') 
							? $field_data['value']
							: (@$status['data'][$field_data['html_name']] != ''
								? $status['data'][$field_data['html_name']]
								: @$field_data['default'])))
					
					.'" />';
				}
			
			echo "</td>";
			echo "</tr>\n";
		}	
	}
	
	echo "</table>\n";

?>