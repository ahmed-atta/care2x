<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

/*if ($pdaten=="ja") setcookie(pdatencookie,"ja");*/

require_once('../global_conf/areas_allow.php');

$allowedarea=&$allow_area['lab_w'];

$fileforward="labor_data_patient_such.php?sid=$sid&lang=$lang&mode=edit";
$thisfile="labor_datainput_pass.php";

 if ($pdatencookie=="ja") 
 	$breakfile="javascript:window.history.go(-(window.history.length))";
	else
	  $breakfile="labor.php?sid=".$sid."&lang=".$lang;

$title="$LDMedLab -  $LDNewData";
$lognote="$title ok";

$userck='ck_lab_user';

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,"");
require('../include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include('../include/inc_passcheck.php');

$errbuf=$title;
$minimal=1;
require('../include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>
<BODY onLoad="if (window.focus) window.focus(); document.passwindow.userid.focus();">


<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon('../','micros.gif','0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  size=5 FACE="verdana"> <b><?php echo $title;  ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><a href="labor_datasearch_pass.php?sid=<?php echo "$sid&lang=$lang" ?>"><img <?php echo createLDImgSrc('../','such-gray.gif','0') ?>></a><img <?php echo createLDImgSrc('../','newdata-b.gif','0') ?>></td>
</tr>

<?php require('../include/inc_passcheck_mask.php') ?>  

<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>
</FONT>


</BODY>
</HTML>
