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

$allowedarea=&$allow_area['edp'];

switch($target)
{
	case "sqldb":		 $title=$LDSqlDb;
								//$userck="ck_edv_mysql_user";
								$fileforward="phpmyadmin-start.php?sid=$sid&lang=$lang";
								//$fileforward="../start.php";
								break;
								
	case "adminlogin":	$title=$LDSystemLogin;
								//$userck="ck_edv_admin_user";
								$fileforward="edv-system-admi-menu.php?sid=$sid&lang=$lang";
								break;
	default:{header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

$userck="ck_edv_user";
$thisfile="edv-main-pass.php";
$breakfile="edv.php?sid=$sid&lang=$lang";
$lognote="$title ok";

// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf="$title";
$minimal=1;
require("../include/inc_passcheck_head.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  <?php if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo $title ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require("../include/inc_passcheck_mask.php") ?>  

<p>
<!-- <img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $title " ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $title " ?>?</a><br>
 --><HR>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>


</FONT>


</BODY>
</HTML>
