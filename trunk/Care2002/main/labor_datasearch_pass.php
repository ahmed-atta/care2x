<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");
require("../global_conf/areas_allow.php");

if ($pdaten=="ja") setcookie(pdatencookie,"ja");

$allowedarea=&$allow_area['lab_r'];

$fileforward="labor_data_patient_such.php?sid=$sid&lang=$lang";
$thisfile="labor_datasearch_pass.php";

 if ($pdatencookie=="ja") 
 	$breakfile="javascript:window.history.go(-(window.history.length))";
	else
	  $breakfile="labor.php?sid=$sid&lang=$lang";
	  
$title="$LDMedLab - $LDSeeData";

$lognote="$title ok";

$userck="ck_lab_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf=$title;
$minimal=1;
require("../include/inc_passcheck_head.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus()">

<FONT    SIZE=-1  FACE="Arial">

<P>

<img src=../img/micros.gif align="absmiddle"><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php print $title; ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><img src=../img/<?php echo "$lang/$lang" ?>_such-b.gif border=0><a href="labor_datainput_pass.php?sid=<?php echo "$sid&lang=$lang" ?>&route=validroute"><img src=../img/<?php echo "$lang/$lang" ?>_newdata-gray.gif border=0></a></td>
</tr>

<?php require("../include/inc_passcheck_mask.php") ?>  

<p>

<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>
</FONT>


</BODY>
</HTML>
