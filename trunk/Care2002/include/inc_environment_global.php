<?php
# define to 1 to measure page generation time
define('USE_PAGE_GEN_TIME',1);

# Define the time when the doc-on-duty will change in 24 hours H.M format (eg. 3 PM = 15.00, 12 PM = 0.00)
define('DOC_CHANGE_TIME','7.30'); 

# Define the time when the nurse-on-duty will change in 24 hours H.M format (eg. 3 PM = 15.00, 12 PM = 0.00)
define('NOC_CHANGE_TIME','7.30'); 

# Define to TRUE if you want to send the html output in base64 encrypted form
define('ENCRYPT_PAGE_BASE64',FALSE);

# Set the default template theme
$template_theme='biju';
//$template_theme='default';
# Set the template path
$template_path=$root_path.'gui/html_template/';

# ---------- Do not edit below this ---------------------------------------------
# Load the html page encryptor
if(defined('ENCRYPT_PAGE_BASE64')&&ENCRYPT_PAGE_BASE64){
	include_once($root_path.'classes/html_encryptor/csource.php');
}

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
	//ini_set('session.cache_expire',1); # = 3 Hours
	# Start adodb session handling
	include_once($root_path.'classes/adodb/adodb-session.php');
	session_start();
}

# Set the url append data
if (ini_get('session.use_trans_sid')!=1) {
    define('URL_APPEND','?sid='.$sid.'&lang='.$lang);
	$not_trans_id=true;
} else {
    define('URL_APPEND','?lang='.$lang);
	$not_trans_id=false;
}
//define('URL_REDIRECT_APPEND','?'.SID.'&lang='.$lang);
define('URL_REDIRECT_APPEND','?sid='.$sid.'&lang='.$lang);

# Page generation time start
if(defined('USE_PAGE_GEN_TIME')&&USE_PAGE_GEN_TIME){
	include($root_path.'classes/ladezeit/ladezeitclass.php');
	$pgt=new ladezeit();
	$pgt->start();
}

$TP_ALIGN='left'; # template variable for document direction
# Function to generate the html or html dir-rtl tag
function html_rtl($lang){
	global $TP_ALIGN;
	if(($lang=='ar')||($lang=='fa')){
		echo '<HTML dir=rtl>';
		$TP_ALIGN='right';
		}else{
			echo '<HTML>';
		}
}
?>
