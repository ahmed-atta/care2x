<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../../include/helpers/inc_environment_global.php');

define('MODULE','address');
define('LANG_FILE_MODULAR','place.php');
define('NO_2LEVEL_CHK',1);
require_once(CARE_BASE.'/include/helpers/inc_front_chain_lang.php');
require_once(CARE_BASE.'/global_conf/areas_allow.php');

$allowedarea=$allow_area['admit'];

$fileforward='address_manage.php'.URL_REDIRECT_APPEND;
$thisfile=basename(__FILE__);
$breakfile=CARE_GUI.'/main/plugin.php'.URL_APPEND;

$lognote="$LDInsuranceCoManage ok";

$userck='aufnahme_user';

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require(CARE_BASE.'/include/helpers/inc_2level_reset.php'); 
setcookie('ck_2level_sid'.$sid,'',0,'/');

require(CARE_BASE.'/include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') include(CARE_BASE.'/include/helpers/inc_passcheck.php');

$errbuf=$LDNursingManage;

require(CARE_BASE.'/include/helpers/inc_passcheck_head.php');
?>
<BODY  onLoad="document.passwindow.userid.focus();" >
<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon(CARE_BASE,'home50x50.gif','0','top') ?>>
<FONT SIZE=6  FACE="verdana"> <b><?php echo $LDAddressMngr; ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<?php require(CARE_BASE.'/include/helpers/inc_passcheck_mask.php') ?>  
<p>
</FONT>
</BODY>
</HTML>
