<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
				/* Establish db connection */
require('../include/inc_db_makelink.php');
				if($link&&$DBLink_OK) 
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
							
								if(mysql_query($sql,$link))
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
