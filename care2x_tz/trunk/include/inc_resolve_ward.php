<?php

if(!isset($ward_nr)||!$ward_nr){
	if($cfg['thispc_ward_nr']){
		$ward_nr=$cfg['thispc_ward_nr'];
	}
}

require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=@new  Ward;
$ward_row=$ward_obj->getWardInfo($ward_nr);
$ward_id=$ward_row['ward_id'];
$ward_name=$ward_row['name'];
?>
