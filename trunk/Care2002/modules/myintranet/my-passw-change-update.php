<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
				/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok) 
					{	
								$m=date('m');
								$y=date('Y');
								$m=$m+3;
								if($m>12)
								{
									$m=$m-12;
									$y++;
								} 
								if($m<10) $m='0'.$m;
								$xd="$y-$m-".date('d');
						
								$sql="UPDATE care_users SET	password='$n', expire_date='$xd'  WHERE login_id='$userid'";
							
								if($db->Execute($sql))
								{ 
								//echo "ok";
									header("location:my-passw-change.php?sid=$sid&lang=$lang&mode=pwchg");
									exit;
								}
								else
								{
								   echo "$sql<br>$LDDbNoSave";
								 }
						}
header ("location:my-passw-change.php?sid=$sid&lang=$lang&userid=$userid&keyword=$keyword");
exit;
?>
