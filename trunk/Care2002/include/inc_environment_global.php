<?php
# globalize the POST, GET, & COOKIE variables
require_once($root_path.'include/inc_vars_resolve.php'); 

# Set global defines 
if(!defined('LANG_DEFAULT')) define ('LANG_DEFAULT','en');

# Establish db connection 
require_once($root_path.'include/inc_db_makelink.php');

if(!defined('NOSTART_SESSION')||(defined('NOSTART_SESSION')&&!NOSTART_SESSION)){
	# Set sessions handler to "user"
	ini_set('session.save_handler','user');
	# Set transparent session id
	if(!ini_get('session.use_trans_sid')) ini_set('session.use_trans_sid',1);
	//ini_set('session.use_trans_sid',0);
	# Set session name to "sid"
	ini_set('session.name','sid');
	# Set garbage collection max lifetime
	ini_set('session.gc_maxlifetime',10800); # = 3 Hours
	# Set cache lifetime
	ini_set('session.cache_expire',180); # = 3 Hours
	# Start adodb session handling
	include_once($root_path.'classes/adodb/adodb-session.php');
	session_start();
}

# Set the url append data
if (ini_get('session.use_trans_sid')!=1) {
    //define('URL_APPEND','?'.SID.'&lang='.$lang);
    define('URL_APPEND','?sid='.$sid.'&lang='.$lang);
	//define('URL_REDIRECT_APPEND',URL_APPEND);
	$not_trans_id=true;
} else {
    define('URL_APPEND','?lang='.$lang);
    //define('URL_REDIRECT_APPEND','?'.SID.'&lang='.$lang);
	$not_trans_id=false;
}
//define('URL_REDIRECT_APPEND','?'.SID.'&lang='.$lang);
define('URL_REDIRECT_APPEND','?sid='.$sid.'&lang='.$lang);

# Set the default template theme
//$template_theme='biju';
//$template_theme='default';
$template_theme='human_aqua_2';
# Set the template path
$template_path=$root_path.'gui/html_template/';
?>
