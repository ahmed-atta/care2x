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
define("LANG_FILE","specials.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");

if(($month<10)&&(strlen($month)<2)) $month="0".$month;
if(($day<10)&&(strlen($day)<2)) $day="0".$day;

if(!isset($dept)||empty($dept))
	if(isset($HTTP_COOKIE_VARS['ck_thispc_dept'])&&($HTTP_COOKIE_VARS['ck_thispc_dept']!="")) $dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];
		else $dept="plop";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo "$LDCalendar - $LDOptions" ?></title>

</head>
<body onLoad="window.resizeTo(600,450);<?php if(!$nofocus) print 'if(window.focus) window.focus();'; ?>" vlink="#0000ff" alink="#0000ff" link="#0000ff" >
<font face="Verdana, Arial" size=2>
<?php if(isset($HTTP_COOKIE_VARS["ck_login_username".$sid])&&($HTTP_COOKIE_VARS["ck_login_username".$sid]!="")) : ?>
<b> <?php print "$LDOptions $LDFor ".$HTTP_COOKIE_VARS["ck_login_username".$sid]." $LDOn $day.$month.$year" ?></b>
<ul>
<li><a href="#"><?php echo $LDShowMyCalendar ?></a></li>
<li><a href="#"><?php echo $LDShowMySched ?></a></li>
<li><a href="#"><?php echo $LDShowMyOvertime ?></a></li>
<li><a href="#"><?php echo $LDShowMyWorkTime ?></a></li>
	<?php
	 if($year.$month.$day>=date("Ymd"))
		{ print '
				<li><a href="#">'.$LDPlanSched.'</a></li>
				<li><a href="#">'.$LDPlanDuty.'</a></li>';
		}
	?>
</ul>
<p>

	<?php //if($ck_thispc_dept) print '<b><a href="calendar-options.php?forcestation=1&day='.$day.'&month='.$month.'&year='.$year.'">Optionen für '.strtoupper($ck_thispc_dept).'</a></b>'; ?>
<?php endif ?>
<?php if(($dept)) : ?>
	<?php // if($HTTP_COOKIE_VARS['ck_login_username'.$sid]) print '<b><a href="calendar-options.php?&day='.$day.'&month='.$month.'&year='.$year.'">Optionen für '.$HTTP_COOKIE_VARS['ck_login_username'.$sid].'</a></b>'; ?>
<p>
<b><?php print "$LDOptions $LDFor ".strtoupper($dept)." $LDOn $day.$month.$year" ?></b>
<ul>
<li><a href="#"><?php echo $LDORProgram ?></a></li>
<li><a href="op-pflege-dienstplan-day.php?sid=<?php echo "$sid&lang=$lang&pday=$day&pmonth=$month&pyear=$year" ?>&retpath=calendar_opt"><?php echo "$LDDutyPerson $LDOn ($day.$month.$year)" ?></a></li>
<li><a href="op-pflege-dienstplan.php?sid=<?php echo "$sid&lang=$lang&cday=$day&cmonth=$month&cyear=$year&pmonth=".((int)$month)."&pyear=".((int)$year) ?>&noedit=1&retpath=calendar_opt" onClick="window.resizeTo(600,700)"><?php echo "$LDDutyPerson ($LDMonth)" ?></a></li>
<li><a href="#"><?php echo "$LDDocsOnDuty ($day.$month.$year)" ?></a></li>
	<?php if($year.$month.$day==date("Ymd"))
		{ print '
		<li><a href="op-pflege-logbuch-pass.php?target=entry&sid=';
			print "$sid&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept";
			print '&retpath=calendar_opt">'.$LDORLogbook.'</a></li>
		';
		}
	?>
<li><a href="op-pflege-logbuch-pass.php?target=search&sid=<?php echo "$sid&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept" ?>&retpath=calendar_opt"><?php echo $LDORLogbookSearch ?></a></li>
	<?php if($year.$month.$day<=date("Ymd"))
		{ print '
			<li><a href="op-pflege-logbuch-pass.php?target=archiv&sid=';
			print "$sid&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept";
			print '&retpath=calendar_opt">'.$LDORLogbookArch.'</a></li>';
		}
	?>
</ul>

<?php else : ?>


<?php endif ?>
</font>

<p><br>
<a href="javascript:window.close()"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" width=103 height=24 border=0 onClick="window.opener.focus()"></a>
</body>
</html>
