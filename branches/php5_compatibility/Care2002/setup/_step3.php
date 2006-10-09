<?php
	if (!defined('INSTALLER_PATH')) { header('Location: index.php'); exit; }


	echo "<table border=\"0\" width=\"60%\" align=\"center\">\n";
	
	foreach($actions['fields'] as $field_name => $field_data)
	{
		if ($field_data['group'] == 1)
		{
			echo "<tr>\n";
			echo "<td align=\"left\" valign=\"middle\">";
				echo '<label for="'. $field_data['html_name'] .'">';
					echo $field_data['html_label'];
				echo "</label>\n";
			echo "</td>\n";
			echo "<td align=\"left\" valign=\"middle\">";
				
				echo '<input name="'. $field_data['html_name'] .'" type="'. $field_data['html_type'] .'" value="'.
				
					((@$_REQUEST[$field_data['html_name']] != '')
						? $_REQUEST[$field_data['html_name']]
						: ((@$field_data['value'] != '') 
							? $field_data['value']
							: (@$status['data'][$field_data['html_name']] != ''
								? $status['data'][$field_data['html_name']]
								: @$field_data['default'])))
					
				.'" />';
			
			echo "</td>";
			echo "</tr>\n";
		}	
	}
	
	echo "</table>\n";
?>

