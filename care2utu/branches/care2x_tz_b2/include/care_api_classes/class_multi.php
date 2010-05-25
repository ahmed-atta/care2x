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
	* @package multi_moduler
	*
	*/

	class multi extends Core {
		/**#@+
		* @access private
		*/
		var $str;
		var $sql;
		var $tb_users = ' `care_users` ';
		var $tb_room = '`care_hospital_rooms`';
		var $tb_conf = '`care_hospital_rooms_conf`';
		var $tb_encounter = '`care_encounter`';

		/*
		 * Save Patient numbers
		 */
		function _saveNumbers($s){
			global $db;

			#replace if incoming string is not in corect format
			if (strlen($s)<5) $s = '1|1|1|0|0|0|0|0|1';
			$this->sql = "UPDATE `care_config_global` SET " .
									"`value` = '".$s."' " .
									" WHERE " .
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

			# if have data
			if ($row=$dc->FetchRow()) return $row[0];

			# its the first time to initialize this feature
			# create a single row of default values
			else {
				$this->sql="INSERT INTO `care_config_global` (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`)
										VALUES (" .
											"'hospital_numbers_to_display', " .
											"'1|1|1|0|0|0|0|0|1', "   .
											"NULL, '', '', '', "      .
											"CURRENT_TIMESTAMP, '', " .
											"'0000-00-00 00:00:00'"   .
										"); ";

				if($db->Execute($this->sql))
					return '1|1|1|0|0|0|0|0|1';

			}
		}

		# get all system config numbers
		# @ str
		function __genNumbers(){
			$vt = $this->__read_hospno();
			$vc = explode('|',$vt);
			return $vc;
		}

		/*save room (system conf)*/
		function SaveRoom($v){
			global $db;
			if ($v['name'])  $v['name']  = addslashes($v['name']);
			if ($v['notes']) $v['notes'] = addslashes($v['notes']);

			if ($v['mode']=='add'){
				$sql="INSERT INTO " . $this->tb_room . "
						(`name` ,`notes` ,`active`,`dpt` ,`createdby` ,`createdate`)
						VALUES ('".$v['name']."', '".$v['notes']."', '".$v['status']."','".$v['dpt']."', '".$v['by']."', '".date('Y-m-d')."');";

			} else if ($v['mode']=='edit') {
				$sql = "UPDATE " . $this->tb_room . " SET " .
						"`notes` = '".$v['notes']."'," .
						"`active` = '".$v['status']."', " .
						"`name` = '".$v['name']."', " .
						"`dpt` = '".$v['dpt']."' " .
						" WHERE `name` = '".$v['iname']."' " .
						" AND " .
						" `dpt` =".$v['idpt']." ;";
			} else if ($v['mode']=='remove') {
				$sql = "DELETE FROM " . $this->tb_room . " WHERE `name` = '".$v['name']."' AND `dpt` = ".$v['dpt']." LIMIT 1";
			} else if ($v['mode']=='conf') {
				$sql = "DELETE FROM  " . $this->tb_conf . " WHERE `name` = '".$v['name']."' AND `dpt` = ".$v['dpt']." LIMIT 1;";

				if (!$db->Execute($sql))
					print mysql_error();

				$sql = "INSERT INTO `caredb_training`.`care_hospital_rooms_conf` " .
						"(`name` ,`dpt` ,`users`)" .
						"VALUES " .
						"('".$v['name']."', '".$v['dpt']."', '".$v['users']."');";

			}

			if ($sql!='')
		    	if ($db->Execute($sql))
					return  1; # done;
			else {
		    		print mysql_error();
		    		return -1; # failed;
			}
		}


		/*get list of room saved (sys conf)*/
		function listRooms($v){
			global $db;

			$sql="SELECT * FROM " . $this->tb_room . $v . " ORDER BY name ASC";

		    if ($o = $db->Execute($sql))
				 return $o;      # done;
			else return array(); # failed;
		}

		/*get user list (sys conf)*/
		function GetAllUsers($jk,$v){
			global $db;
			$sql="SELECT `name`,`login_id` FROM " . $this->tb_users . " WHERE `lockflag` =0 AND `personell_nr` NOT IN (1) AND `name` NOT IN ('admin',".$jk.") ".$v." ORDER BY name ASC";
		    if ($o = $db->Execute($sql))
				 return $o;      # done;
		}

		/* Get room assigned by patient */
		function GetPatientRoom($id){
			global $db;
			$id = ($id)?$id:'-1';
			$sql="SELECT `room` FROM " . $this->tb_encounter . " WHERE `encounter_nr`=".$id;
			#print $sql.'<hr>';
		    if ($o = $db->Execute($sql))
		    if ($rw = $o->FetchRow())
				return $rw[0];      # done;

		}

		/* Get users assigned to a room */
		function ListAsignedUsers($n,$d){
			global $db;
			$sql="SELECT `users` FROM " . $this->tb_conf . " WHERE `name` = '".$n."' AND `dpt` = ".$d;
		    if ($o = $db->Execute($sql)){
		    	$u = $o->FetchRow();
				return $u[0];
		    }
		}

		/*get list of room assigned to the department */
		function GetRoomsAssigned($dpt){
			global $db;
			$dpt = ($dpt!='')?$dpt : '-1';
			$sql="SELECT `name` FROM " . $this->tb_conf . " WHERE `dpt` =".$dpt." ORDER BY name";
		    if ($o = $db->Execute($sql))
				return $o;
		}

		/* Get a room assigned from */
		function user_RoomLookup($users,$dpt){
			global $db;
			$room = 'General Room';
			$sql="SELECT * FROM " . $this->tb_conf . " WHERE `dpt` = ".$dpt;
		    $o = $db->Execute($sql);
	    	while( $u = $o->FetchRow()){
	    		$uza = explode('|',$u['users']);
				foreach($uza as $vx){
					if (strtolower($vx)==strtolower($users)){
		    			$room = $u['name'];
		    			break;
					}
				if ($room!='General Room') break;
	    		}
			}

			return $room;
		}

		/* transfer room from one room to another of any department*/
		function SwapPatientRoom($enc,$rm){
			global $db;
			$enc = ($enc!='')?$enc:'-1';
			$sql="UPDATE " . $this->tb_encounter . " SET room = '".$rm."' WHERE encounter_nr=".$enc;
		    $db->Execute($sql);

		}
	}
?>