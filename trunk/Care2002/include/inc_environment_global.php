<?php
// globalize the POST, GET, & COOKIE variables
require_once($root_path.'include/inc_vars_resolve.php'); 

// Set global defines 
if(!defined('LANG_DEFAULT')) define ('LANG_DEFAULT','en');

/* Establish db connection */
require_once($root_path.'include/inc_db_makelink.php');

if(!defined('NOSTART_SESSION')||(defined('NOSTART_SESSION')&&!NOSTART_SESSION)){
	// set sessions handler to "user"
	ini_set('session.save_handler','user');
	// set transparent session id
	if(!ini_get('session.use_trans_sid')) ini_set('session.use_trans_sid',1);
	//ini_set('session.use_trans_sid',0);
	// set session name to "sid"
	ini_set('session.name','sid');
	/* Set garbage collection max lifetime*/
	ini_set('session.gc_maxlifetime',10800); //= 3 Hours
	/* Set cache lifetime*/
	ini_set('session.cache_expire',180); //= 3 Hours

	// Start adodb session handling
	include_once($root_path.'classes/adodb/adodb-session.php');
	session_start();
}
/*
if(!session_is_registered('sess_user_name')) session_register('sess_user_name');
if(!session_is_registered('sess_user_origin')) session_register('sess_user_origin');
if(!session_is_registered('sess_file_forward')) session_register('sess_file_forward');
if(!session_is_registered('sess_file_return')) session_register('sess_file_return');
if(!session_is_registered('sess_file_break')) session_register('sess_file_break');
if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
if(!session_is_registered('sess_dept_nr')) session_register('sess_dept_nr');
if(!session_is_registered('sess_title')) session_register('sess_title');
if(!session_is_registered('sess_lang')) session_register('sess_lang');
if(!session_is_registered('sess_user_id')) session_register('sess_user_id');
if(!session_is_registered('sess_cur_page')) session_register('sess_cur_page');
*/

// Set the url append data
if (ini_get('session.use_trans_sid')!=1) {
    define('URL_APPEND','?'.SID.'&lang='.$lang);
	//define('URL_REDIRECT_APPEND',URL_APPEND);
	$not_trans_id=true;
} else {
    define('URL_APPEND','?lang='.$lang);
    //define('URL_REDIRECT_APPEND','?'.SID.'&lang='.$lang);
	$not_trans_id=false;
}
define('URL_REDIRECT_APPEND','?'.SID.'&lang='.$lang);
/* reformat top dir */
//$top_dir=substr($top_dir,1).'/';
?>
