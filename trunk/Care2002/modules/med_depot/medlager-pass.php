<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['depot'];

$append=URL_REDIRECT_APPEND."&cat=medlager&from=$src&userck=";

switch($mode)
{
	case "archive":$title=$LDOrderArchive;
						$src="archivepass";
						$userck="ck_prod_arch_user";
						$fileforward=$root_path."modules/products/products-archive.php".$append.$userck;
						break;
	case "dbank":  $title="$LDPharmaDb";
						$src="dbankpass";
						$userck="ck_prod_db_user";
						$fileforward="medlager-datenbank-functions.php".$append.$userck;
						break;
	case "bot":	$title="$LDMediBotActivate";
						$src="medibotpass";
						$userck="ck_prod_bot_user";
						$fileforward=$root_path."modules/products/products-bestellbot.php".$append.$userck;
						break;
	default: 	$title=$LDPharmaOrder;
						$src="orderpass";
					   $mode="order";
						$userck="ck_prod_order_user";
					   $fileforward=$root_path."modules/products/products-bestellung.php".$append.$userck;
}

$thisfile=basename(__FILE__);
$breakfile='medlager.php'.URL_APPEND;

$lognote="$LDMedDepot $title ok";

// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/inc_2level_reset.php'); setcookie('ck_2level_sid'.$sid,'',0,'/');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/inc_passcheck.php');

$errbuf="$LDMedDepot $title";
$minimal=1;
require($root_path.'include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>
<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.select()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo "$LDMedDepot $title" ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntro2 $LDMedDepot $title " ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhat2Do $LDMedDepot $title " ?>?</a><br>
 --><HR>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>


</FONT>


</BODY>
</HTML>
