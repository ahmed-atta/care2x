<?php

require_once(CARE_BASE.'include/core/class_core.php');

class Menu extends Core {


	function getMenuListing() {

		global $db;
		$refs = array();
		$list = array();

		$this->sql = "SELECT DISTINCT nr, name, url, parent, image  FROM care_menu_main ORDER BY sort";

		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				
				while($data = $this->result->FetchRow()) {
					
					$thisref = &$refs[ $data['nr'] ];
					
					$thisref['parent'] = $data['parent'];
					$thisref['name'] = $data['name'];
					$thisref['url'] = $data['url'];
					$thisref['image'] = $data['image'];
					
					if ($data['parent'] == 0) {
						$list[ $data['nr'] ] = &$thisref;
					} else {
						$refs[ $data['parent'] ]['children'][ $data['nr'] ] = &$thisref;
					}
					
					
				}
				return $list;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;

		}
	}
}