<?php
/**
* The following lines are inserted for the purpose of integration to Care 2002
* Beta 1.0.04   Release 2003-03-31
*/
/******* START *********/
$old_reporting=error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
$old_inc_path=ini_get('include_path');
require_once('./roots.php');
define('NOSTART_SESSION',1);
require_once($root_path.'include/inc_environment_global.php');
$entry=0;

if($mode=='FORCE_ENABLE_PHP'){
    define('INIT_DECODE',1); // set flag to decrypt
    include($root_path.'include/inc_init_crypt.php'); // initialize crypt 
    $clear_ck_sid = $dec_hcemd5->DecodeMimeSelfRand($s2);
    if($clear_ck_sid==$s1) $entry=1;
}

if(!$entry){
	define('LANG_FILE','edp.php');
	define('NO_2LEVEL_CHK',1);
	require($root_path.'include/inc_front_chain_lang.php');
}

ini_set('include_path',$old_inc_path);
error_reporting($old_reporting);
/******** END  ***********/

// Process config file to determine default server (if any)
require('./grab_globals.inc.php3');
require('./lib.inc.php3');


// Get the host name
if (empty($HTTP_HOST)) {
  if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_HOST'])) {
    $HTTP_HOST = $HTTP_ENV_VARS['HTTP_HOST'];
  }
  else if (@getenv('HTTP_HOST')) {
    $HTTP_HOST = getenv('HTTP_HOST');
  }
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>phpMyAdmin <?php echo PHPMYADMIN_VERSION; ?> - <?php echo $HTTP_HOST;?></title>
</head>

<frameset cols="150,*" rows="*" border="0" frameborder="0"> 
  <frame src="left.php3?server=<?php echo $server;?>&lang=<?php echo $lang; echo (empty($db)) ? '' : '&db=' . urlencode($db); ?>" name="nav">

<!-- The "&sid=$sid" code was inserted for the purpose of integration to Care 2002  -->
  <frame src="<?php echo (empty($db)) ? 'main.php3' : 'db_details.php3'; ?>?server=<?php echo "$server&sid=$sid";?>&lang=<?php echo $lang; echo (empty($db)) ? '' : '&db=' . urlencode($db); ?>" name="phpmain">
</frameset>
<noframes>
<body bgcolor="#FFFFFF">

</body>
</noframes>
</html>
