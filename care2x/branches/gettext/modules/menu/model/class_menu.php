<?php

require_once(CARE_BASE.'include/core/class_core.php');

class Menu extends Core {


	function getMenuListing() {

		global $db;

		$this->sql = "SELECT name, url FROM `care_menu_main` WHERE is_visible = '1' ORDER BY `sort_nr`";

		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return $this->result;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;

		}
	}
}