<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

require("../include/inc_config_color.php");
require("../global_conf/areas_allow.php");
$allowedarea=&$allow_area['cafenews'];

$fileforward="cafenews-edit-select.php?sid=$sid&lang=$lang";
						
$thisfile="cafenews-edit-pass.php";
$breakfile="cafenews.php?sid=$sid&lang=$lang";
$lognote="$title $LDEdit ok";

$userck="ck_cafenews_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

$errbuf="$title $LDEdit";

require("../include/inc_passcheck_head.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<BODY bgcolor="#ffffff" onLoad="document.passwindow.userid.focus()">


<FONT    SIZE=-1  FACE="Arial">

<P>

<img src="../img/basket.gif" width=74 height=70 border=0>
<FONT  COLOR=#cc6600  SIZE=6  FACE="verdana"> <b><?php echo "$title $LDEdit" ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require("../include/inc_passcheck_mask.php") ?>  

<p>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntroTo $title $LDEdit" ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhatTo $title $LDEdit" ?>?</a><br>
<HR>
<?php
require("../language/".$lang."/".$lang."_copyrite.php");
 ?>

</FONT>


</BODY>
</HTML>
