<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.09 - 2003-11-25
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['pharma'];
$append=URL_REDIRECT_APPEND.'&cat=pharma&userck=';
switch($mode)
{
	case "order": 	$title=$LDPharmaOrder;
						$src="orderpass";
						$mode="order";
						$userck="ck_prod_order_user";
						$fileforward=$root_path."modules/products/products-bestellung.php".$append.$userck."&from=".$src;
						//$fileforward="select_dept.php".$append.$userck."&from=".$src;
						break;
	case "archive":$title=$LDOrderArchive;
						$src="archivepass";
						$userck="ck_prod_arch_user";
						$fileforward=$root_path."modules/products/products-archive.php".$append.$userck."&from=".$src;
						break;
	case "dbank":  $title=$LDPharmaDb;
						$src="dbankpass";
						$userck="ck_prod_db_user";
						$fileforward="apotheke-datenbank-functions.php".$append.$userck."&from=".$src;
						break;
	case "catalog":  $title=$LDOrderCat;
						$src="catalogpass";
						$userck="ck_prod_order_user";
						$fileforward=$root_path."modules/products/products-bestellkatalog-edit.php".$append.$userck."&target=catalog&from=".$src;
						break;
	default: 	{header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}
$thisfile=basename(__FILE__);
$breakfile='apotheke.php'.URL_APPEND;
$lognote="$LDPharmacy $title ok";

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php'); 
setcookie('ck_2level_sid'.$sid,'',0,'/');

require($root_path.'include/inc_passcheck_internchk.php');
if ($pass=='check') include($root_path.'include/inc_passcheck.php');

$errbuf="$LDPharmacy $title";
$minimal=1;
require($root_path.'include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>
<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo "$LDPharmacy :: $title" ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntro2 $LDPharmacy $title " ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhat2Do $LDPharmacy $title " ?>?</a><br>
 -->
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>


</FONT>


</BODY>
</HTML>
