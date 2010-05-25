<?php
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');
	require($root_path.'include/inc_environment_global.php');
	/**
	* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
	* GNU General Public License
	* Copyright 2002,2003,2004,2005 Elpidio Latorilla
	* elpidio@care2x.org,
	*
	* See the file "copy_notice.txt" for the licence notice
	*/

	define('LANG_FILE','doctor_rooms.php');
	$local_user='ck_edv_user';
	require_once($root_path.'include/inc_front_chain_lang.php');
	include_once($root_path.'include/care_api_classes/class_multi.php');

	include_once($root_path.'include/care_api_classes/class_multi.php');
	$cd_obj = new multi;
	$obj= new multi;

	$vct = $cd_obj->__genNumbers();

	$ns = $obj->GetRoomsAssigned($_GET['dpt']);

	if ($ns->RecordCount()>0){
		print '<select name="room" id="room" style="width:180px; padding:2px;">';
			while($n = $ns->FetchRow())
				print '<option value="'.$n['name'].'">'.$n['name'].'</option>';

		print '</select>';
	} else
		print '<font color="red"><b>GENERAL</b></font> <input type="hidden" value="" name="room" id="room">';
	?>