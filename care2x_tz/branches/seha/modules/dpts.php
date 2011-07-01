<tr>
<td class="reg_item">Department:
</td>
<td class="reg_input" colspan=2>
<select id="selector">
<?php

	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department;
	$all_meds=&$dept_obj->getAllMedicalObject();

	if(is_object($all_meds)){
		while($deptrow=$all_meds->FetchRow()){
			$sTemp = $sTemp.'
				<option value="'.$deptrow['nr'].'" ';
			if(isset($current_dept_nr)&&($current_dept_nr==$deptrow['nr'])) $sTemp = $sTemp.'selected';
			$sTemp = $sTemp.'>';
			if($$deptrow['LD_var']!='') $sTemp = $sTemp.$$deptrow['LD_var'];
				else $sTemp = $sTemp.$deptrow['name_formal'];
					$sTemp = $sTemp.'</option>';
		}
	}

	print $sTemp;

?>
</select>
</td>
</tr>