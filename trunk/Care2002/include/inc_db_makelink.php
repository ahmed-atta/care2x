<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_db_makelink.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
	
if(!isset($root_path)||empty($root_path)) $root_path='../'; // default language table root path is "../"

/*------end------*/


/**
*   :::::NOTE:::::
*   The variable declarations for database access were moved in the
*   inc_init_main.php script.  If you are trying to set up
*   your database manually, edit the variable values in the inc_init_main.php script
*/


/* This line loads those variables */
include_once('../include/inc_init_main.php');



/*********************************************************
*   the following lines establish connection to the database 
*    
*	 DO NOT EDIT 
*  	
*   the variable $DBLink_OK will be tested in the scripts to determine
*	whether the database is available or not
***********************************************************/

/* Load the db error messages lang table*/
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_db_msg.php')) include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_db_msg.php');
    else { include_once($root_path.'language/en/lang_en_db_msg.php');}
	
/* Establish a link */
if ($link=mysql_connect($dbhost,$dbusername,$dbpassword))
 {
	if(mysql_select_db($dbname,$link)) 
	{	
		$DBLink_OK=1;
	}
	else $DBLink_OK=0; 
}

/* Load the database functions */
require_once('../include/inc_db_fx.php');

?>
