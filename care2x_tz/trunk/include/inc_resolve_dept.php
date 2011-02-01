<?php

if(!isset($dept_nr)||!$dept_nr){
	if($cfg['thispc_dept_nr']){
		$dept_nr=$cfg['thispc_dept_nr'];
	}
}

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=@new  Department;
@$dept_obj->preloadDept($dept_nr);
$buffer=$dept_obj->LDvar();
if(isset($$buffer)&&!empty($$buffer)) $dept_name=$$buffer;
	else $dept_name=$dept_obj->FormalName();

?>
