<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
if (!isset($logout)||!$logout) {header('Location:'.$root_path.'/language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 

# Reset all login cookies 

//setcookie('ck_login_pw'.$sid,'',0,'/');
//setcookie('ck_login_userid'.$sid,'',0,'/');
//setcookie('ck_login_username'.$sid,'',0,'/');
setcookie('ck_login_logged'.$sid,'',0,'/');
setcookie('ck_login_reset'.$sid,FALSE,0,'/');

# Empty session login values
$HTTP_SESSION_VARS['sess_login_userid']='';		
$HTTP_SESSION_VARS['sess_login_username']='';
$HTTP_SESSION_VARS['sess_login_pw']='';

#
# Redirect to login page for eventual new login
#
header("location: login.php".URL_REDIRECT_APPEND."&is_logged_out=1");
exit;
?>