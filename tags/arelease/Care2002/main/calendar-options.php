<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_specials.php");

if(($month<10)&&(strlen($month)<2)) $month="0".$month;
if(($day<10)&&(strlen($day)<2)) $day="0".$day;

if(!$dept)
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
		else $dept="plop";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?="$LDCalendar - $LDOptions" ?></title>

</head>
<body onLoad="window.resizeTo(600,450);<? if(!$nofocus) print 'if(window.focus) window.focus();'; ?>" vlink="#0000ff" alink="#0000ff" link="#0000ff" >
<font face="Verdana, Arial" size=2>
<? if(($ck_login_username)) : ?>
<b> <? print "$LDOptions $LDFor $ck_login_username $LDOn $day.$month.$year" ?></b>
<ul>
<li><a href="#"><?=$LDShowMyCalendar ?></a></li>
<li><a href="#"><?=$LDShowMySched ?></a></li>
<li><a href="#"><?=$LDShowMyOvertime ?></a></li>
<li><a href="#"><?=$LDShowMyWorkTime ?></a></li>
	<?
		 if($year.$month.$day>=date("Ymd"))
		{ print '
				<li><a href="#">'.$LDPlanSched.'</a></li>
				<li><a href="#">'.$LDPlanDuty.'</a></li>';
		}
	?>
</ul>
<p>

	<? //if($ck_thispc_dept) print '<b><a href="calendar-options.php?forcestation=1&day='.$day.'&month='.$month.'&year='.$year.'">Optionen für '.strtoupper($ck_thispc_dept).'</a></b>'; ?>
<? endif ?>
<? if(($dept)) : ?>
	<?// if($ck_login_username) print '<b><a href="calendar-options.php?&day='.$day.'&month='.$month.'&year='.$year.'">Optionen für '.$ck_login_username.'</a></b>'; ?>
<p>
<b><? print "$LDOptions $LDFor ".strtoupper($dept)." $LDOn $day.$month.$year" ?></b>
<ul>
<li><a href="#"><?=$LDORProgram ?></a></li>
<li><a href="op-pflege-dienstplan-day.php?sid=<?="$ck_sid&lang=$lang&pday=$day&pmonth=$month&pyear=$year" ?>&retpath=calendar_opt"><?="$LDDutyPerson $LDOn ($day.$month.$year)" ?></a></li>
<li><a href="op-pflege-dienstplan.php?sid=<?="$ck_sid&lang=$lang&cday=$day&cmonth=$month&cyear=$year&pmonth=".((int)$month)."&pyear=".((int)$year) ?>&noedit=1&retpath=calendar_opt" onClick="window.resizeTo(600,700)"><?="$LDDutyPerson ($LDMonth)" ?></a></li>
<li><a href="#"><?="$LDDocsOnDuty ($day.$month.$year)" ?></a></li>
	<? if($year.$month.$day==date("Ymd"))
		{ print '
		<li><a href="op-pflege-logbuch-pass.php?sid=';
			print "$ck_sid&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept";
			print '&retpath=calendar_opt">'.$LDORLogbook.'</a></li>
		';
		}
	?>
<li><a href="op-pflege-logbuch-such-pass.php?sid=<?="$ck_sid&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept" ?>&retpath=calendar_opt"><?=$LDORLogbookSearch ?></a></li>
	<? if($year.$month.$day<=date("Ymd"))
		{ print '
			<li><a href="op-pflege-logbuch-arch-pass.php?sid=';
			print "$ck_sid&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept";
			print '&retpath=calendar_opt">'.$LDORLogbookArch.'</a></li>';
		}
	?>
</ul>

<? else : ?>


<? endif ?>
</font>

<p><br>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_close2.gif" width=103 height=24 border=0 onClick="window.opener.focus()"></a>
</body>
</html>
