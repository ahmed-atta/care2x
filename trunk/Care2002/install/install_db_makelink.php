<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('install_db_makelink.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=install.php">');
/*------end------*/


$root_path='../'; // default language table root path is "../"

if(file_exists($root_path."language/$lang/lang_".$lang."_db_msg.php")) include_once($root_path."language/$lang/lang_".$lang."_db_msg.php");
    else { include_once($root_path.'language/en/lang_en_db_msg.php');}
	
if ($link=mysql_connect($dbhost,$dbusername,$dbpassword))
 {
	if(mysql_select_db($dbname,$link)) 
	{	
		$DBLink_OK=1;
	}
	else $DBLink_OK=0; 
}

require_once('../include/inc_db_fx.php');

?>
