<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_db_makelink.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/

/***************** these are the global data for mySQL databank connection ..................
  							edit these to correctly configure
***************************************************************************** */

$dbhost="localhost";  //,,, format is "host:port" 
$dbname="";
$dbusername="httpd";
$dbpassword="";

/***************** the ff: is to establish connection DO NOT EDIT ..................
  							the variable $DBLink_OK will be tested in the script to determine
							whether the link is established or not
***************************************************************************** */
if(!isset($root_path)||empty($root_path)) $root_path="../"; // default language table root path is "../"

if(file_exists($root_path."language/$lang/lang_".$lang."_db_msg.php")) include($root_path."language/$lang/lang_".$lang."_db_msg.php");
    else { include($root_path."language/en/lang_en_db_msg.php");}
	
if ($link=mysql_connect($dbhost,$dbusername,$dbpassword))
 {
	if(mysql_select_db($dbname,$link)) 
	{	
		$DBLink_OK=1;
	}
	else $DBLink_OK=0; 
}
?>
