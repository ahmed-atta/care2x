<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/helpers/inc_environment_global.php');

define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

// TODO Create or define permission for that module
//$allowedarea=&$allow_area['reporting'];

$fileforward='reporting.php'.URL_REDIRECT_APPEND;
$thisfile=basename(__FILE__);
$breakfile=$root_path.'main/spediens.php'.URL_APPEND;

$lognote="$LDBilling ok";

$userck='aufnahme_user';

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/helpers/inc_2level_reset.php'); 
setcookie('ck_2level_sid'.$sid,'',0,'/');

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') include($root_path.'include/helpers/inc_passcheck.php');

$errbuf=$LDNursingManage;

require($root_path.'include/helpers/inc_passcheck_head.php');
?>
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<P> 
<img <?php echo createComIcon($root_path,'billing.jpg','0','absmiddle') ?> /> 
<FONT  COLOR=<?php echo $cfg[top_txtcolor] ?>  SIZE=6  FACE="verdana"> 
<b> <?php echo $LDBilling ?> </b>
</font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<?php require($root_path.'include/helpers/inc_passcheck_mask.php') ?>
<p>
<?php
require($root_path.'include/helpers/inc_load_copyrite.php');
?>
</BODY>
</HTML>