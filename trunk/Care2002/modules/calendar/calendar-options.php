<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_date_format_functions.php');


if(($month<10)&&(strlen($month)<2)) $month="0".$month;
if(($day<10)&&(strlen($day)<2)) $day="0".$day;

$i_date=$year.'-'.$month.'-'.$day;

if(!isset($dept)||empty($dept))
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&($HTTP_COOKIE_VARS['ck_thispc_dept']!="")) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
		else $dept='plop';
?>
<html>
<head>
<?php echo setCharSet(); ?>
<title><?php echo "$LDCalendar - $LDOptions" ?></title>

</head>
<body onLoad="window.resizeTo(600,450);<?php if(!$nofocus) echo 'if(window.focus) window.focus();'; ?>" vlink="#0000ff" alink="#0000ff" link="#0000ff" >
<font face="Verdana, Arial" size=2>
<?php if(isset($HTTP_COOKIE_VARS["ck_login_username".$sid])&&($HTTP_COOKIE_VARS["ck_login_username".$sid]!="")) : ?>
<b> <?php echo "$LDOptions $LDFor ".$HTTP_COOKIE_VARS["ck_login_username".$sid]." ".$LDOn." ".formatDate2Local($i_date,$date_format) ?></b>
<ul>
<li><a href="#"><?php echo $LDShowMyCalendar ?></a></li>
<li><a href="#"><?php echo $LDShowMySched ?></a></li>
<li><a href="#"><?php echo $LDShowMyOvertime ?></a></li>
<li><a href="#"><?php echo $LDShowMyWorkTime ?></a></li>
	<?php
	 if($year.$month.$day>=date("Ymd"))
		{ echo '
				<li><a href="#">'.$LDPlanSched.'</a></li>
				<li><a href="#">'.$LDPlanDuty.'</a></li>';
		}
	?>
</ul>
<p>

	<?php //if($ck_thispc_dept) echo '<b><a href="calendar-options.php?forcestation=1&day='.$day.'&month='.$month.'&year='.$year.'">Optionen für '.strtoupper($ck_thispc_dept).'</a></b>'; ?>
<?php endif ?>
<?php if(($dept)) : ?>
	<?php // if($HTTP_COOKIE_VARS['ck_login_username'.$sid]) echo '<b><a href="calendar-options.php?&day='.$day.'&month='.$month.'&year='.$year.'">Optionen für '.$HTTP_COOKIE_VARS['ck_login_username'.$sid].'</a></b>'; ?>
<p>
<b><?php echo "$LDOptions $LDFor ".strtoupper($dept)." (".formatDate2Local($i_date,$date_format).")"; ?></b>
<ul>
<li><a href="#"><?php echo $LDORProgram ?></a></li>
<li><a href="<?php echo $root_path ?>modules/or/op-pflege-dienstplan-day.php<?php echo URL_APPEND."&pday=$day&pmonth=$month&pyear=$year" ?>&retpath=calendar_opt"><?php echo "$LDDutyPerson $LDOn (".formatDate2Local($i_date,$date_format).")" ?></a></li>
<li><a href="<?php echo $root_path ?>modules/or/op-pflege-dienstplan.php<?php echo URL_APPEND."&cday=$day&cmonth=$month&cyear=$year&pmonth=".((int)$month)."&pyear=".((int)$year) ?>&noedit=1&retpath=calendar_opt" onClick="window.resizeTo(600,700)"><?php echo "$LDDutyPerson ($LDMonth)" ?></a></li>
<li><a href="#"><?php echo "$LDDocsOnDuty (".formatDate2Local($i_date,$date_format).")" ?></a></li>
	<?php if($year.$month.$day==date("Ymd"))
		{ echo '
		<li><a href="'.$root_path.'modules/or/op-pflege-logbuch-pass.php'.URL_APPEND;
			echo "&target=entry&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept";
			echo '&retpath=calendar_opt">'.$LDORLogbook.'</a></li>
		';
		}
	?>
<li><a href="<?php echo $root_path ?>modules/or/op-pflege-logbuch-pass.php<?php echo URL_APPEND."&target=search&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept" ?>&retpath=calendar_opt"><?php echo $LDORLogbookSearch ?></a></li>
	<?php if($year.$month.$day<=date("Ymd"))
		{ echo '
			<li><a href="'.$root_path.'modules/or/op-pflege-logbuch-pass.php'.URL_APPEND;
			echo "&target=archiv&pday=$day&pmonth=$month&pyear=$year&dept=$dept";
			echo '&retpath=calendar_opt">'.$LDORLogbookArch.'</a></li>';
		}
	?>
</ul>

<?php else : ?>


<?php endif ?>
</font>

<p><br>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> onClick="window.opener.focus()"></a>
</body>
</html>
