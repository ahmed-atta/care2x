<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['doctors'];
//$append="?sid=$sid&lang=$lang&from=pass"; 

switch($target)
{
	case "dutyplan": $fileforward="doctors-dienstplan-planen.php?sid=$sid&lang=$lang&dept=$dept&retpath=$retpath&pmonth=$pmonth&pyear=$pyear";
							$title=$LDDOCScheduler;
							break;
	case "setpersonal": $fileforward="doctors-dienst-personalliste.php?sid=$sid&lang=$lang&ipath=$retpath&retpath=$retpath";
							$title=$LDDocsList;
							break;
	default:{ header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}
}

							
$thisfile="doctors-main-pass.php";

$breakfile="aerzte.php?sid=$sid&lang=$lang";

$lognote="Doctors $title ok";

$userck="ck_doctors_dienstplan_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf="Doctors $title";

require("../include/inc_passcheck_head.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY  onLoad="document.passwindow.userid.focus();" bgcolor=<?php print $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ print ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/monitor2.gif" width=85 height=91 border=0 align="absmiddle">
<FONT  COLOR=#cc6600  SIZE=6  FACE="verdana"> <b><?php echo $title ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require("../include/inc_passcheck_mask.php") ?>  

<p>
<!-- <img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $title" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $title" ?></a><br>
 --><HR>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
