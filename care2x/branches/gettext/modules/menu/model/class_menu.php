<?php

require_once(CARE_BASE.'include/core/class_core.php');

class Menu extends Core {


	function getMenuListing() {

		global $db;

		$this->sql = "SELECT nr, name, url FROM `care_menu_main` WHERE is_visible = '1' ORDER BY `sort_nr`";

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
	
	function getSubMenuListing() {

		global $db;

		$this->sql = "SELECT s_main_nr, s_name, s_url FROM `care_menu_sub` WHERE s_is_visible = '1' ORDER BY `s_sort_nr`";

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