<?php

	require_once($root_path.'include/care_api_classes/class_core.php');

	/**
	*
	* Class for Multiple small functionalities of the system
	*
	* You should initialize "$db" in each db query
	*
	* @author Dennis Mollel
	*
	* @version beta 2.05.4d
	* @copyright 2009, Dennis Mollel
	* @package care_api
	*
	*/

	class multi extends Core {
		/**#@+
		* @access private
		*/
		var $str;
		var $sql;

		/*
		 * Save Patient numbers
		 */
		function _saveNumbers($s){
			global $db;

			#replace if incoming string is not in corect format
			if (strlen($s)<5) $s = '1|1|1';
			$this->sql = "UPDATE `care_config_global` SET " .
									"`value` = '".$s."' " .
									"WHERE " .
									"`type` = 'hospital_numbers_to_display';";

			if ($db->Execute($this->sql)) return 'saved';

		}

		/*
		 * Edit Patient numbers
		 */
		function __read_hospno(){
			global $db;
			$this->sql="Select `value` FROM `care_config_global` WHERE `type` = 'hospital_numbers_to_display'";
			$dc = $db->Execute($this->sql);
			if ($row=$dc->FetchRow()) return $row[0];
			else {
				$this->sql="INSERT INTO `care_config_global` (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES (" .
												"'hospital_numbers_to_display', " .
												"'1|1|1|0|0|0', " .
												"NULL, '', '', '', " .
												"CURRENT_TIMESTAMP, '', " .
												"'0000-00-00 00:00:00'" .
										");";
				if ( $db->Execute($this->sql)) return '1|1|1|0|0|0';
			}
		}

		function __genNumbers(){
			$vt = $this->__read_hospno();
			$vc = explode('|',$vt);
			return $vc;
		}

	}
?>
