<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
define('NOSTART_SESSION',1);
require($root_path.'include/inc_environment_global.php');
$lang='en';
define('LANG_FILE','');
define('NO_CHAIN',1);
require_once('../include/inc_front_chain_lang.php');

require('../chklang.php');
$notable=1;
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){
	$sql='select * from care_users';
	if( $ergebnis=$db->Execute($sql)) {
		if($ergebnis->RecordCount()) $notable=0;
	}
}
if (!$notable){
	header('Location:../language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php?lang='.$lang); 
	exit;
}else{
	$usid=uniqid('');
	include('../include/inc_init_crypt.php'); // initialize crypt
	$ciphersid=$enc_hcemd5->encodeMimeSelfRand($usid);
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title>Initialization</title>
	</head>
	<body bgcolor=white>
		<font size=3 color=maroon>Please click the "Start phpMyAdmin" button to start...</font>
		<p>
		<p>
		<br>
		<form action="../modules/phpmyadmin/index.php3" method=post>
			<input type="submit" value="Start phpMyAdmin">
			<input type="hidden" name="s1" value="<?php echo $usid ?>">
			<input type="hidden" name="s2" value="<?php echo $ciphersid ?>">
			<input type="hidden" name="mode" value="FORCE_ENABLE_PHP">
			<input type="hidden" name="lang" value="<?php echo $lang ?>">
			<input type="button" value="Cancel" onClick="window.location.replace('../blank.htm');">
		</form>
	</body>
</html>

