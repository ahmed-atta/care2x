<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');

require_once('../global_conf/areas_allow.php');

$allowedarea=&$allow_area['duty_op'];

if($retpath=="calendar_opt")
{
	$fileforward="op-pflege-dienstplan-planen.php?sid=$sid&lang=$lang&dept=$dept&retpath=$retpath&pmonth=$cmonth&pyear=$cyear&cday=$cday&cmonth=$cmonth&cyear=$cyear";
	$c_flag=1;
}
	else
		$fileforward="op-pflege-dienstplan-planen.php?sid=$sid&lang=$lang&dept=$dept&retpath=$retpath&pmonth=$pmonth&pyear=$pyear";
			
$thisfile="op-pflege-dienstplan-pass.php";
/*
switch($retpath)
{
	case "qview":$breakfile="op-pflege-dienstplan.php?sid=$sid&lang=$lang&dept=$dept&retpath=$retpath&pmonth=$pmonth&pyear=$pyear";
						break;
	case "menu": $breakfile="op-doku.php?sid=".$sid."&lang=".$lang;
						break;
}
*/
$breakfile="javascript:history.back()";
$title="$LDORNOCScheduler";

$lognote="$title ok";
$passtag=0;

//echo $fileforward;
$userck="ck_op_dienstplan_user";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require('../include/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,"");

require('../include/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include('../include/inc_passcheck.php');

$errbuf=$title;

require('../include/inc_passcheck_head.php');
?>

<?php echo setCharSet(); ?>
<BODY bgcolor="#ffffff" onLoad="document.passwindow.userid.focus()">


<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon('../','monitor2.gif','0','absmiddle') ?>>
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=6  FACE="verdana"> <b><?php echo $title ?></b></font>

<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require('../include/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDIntro2 $title" ?></a><br>
<img <?php echo createComIcon('../','varrow.gif','0') ?>> <a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo "$LDWhat2Do $title" ?></a><br>
 --><HR>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>

</FONT>


</BODY>
</HTML>
