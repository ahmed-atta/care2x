<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
require("../req/config-color.php");

$fixdate="&cday=$cday&cmonth=$cmonth&cyear=$cyear";
switch($retpath)
{
	case "menu": $rettarget="op-doku.php?sid=$ck_sid&lang=$lang"; break;
	case "qview": $rettarget="op-pflege-dienst-schnellsicht.php?sid=$ck_sid&lang=$lang&hilitedept=$dept"; break;
	case "calendar_opt":$rettarget="calendar-options.php?sid=$ck_sid&lang=$lang&dept=$dept&day=$cday&month=$cmonth&year=$cyear";break;
	case "calendar_main":$rettarget="calendar.php?sid=$ck_sid&lang=$lang&dept=$dept";break;
	default: $rettarget="javascript:window.history.back()";
}

/********************************* Resolve the or department  only ***********************/
$saal="exclude";
require("../req/resolve_opr_dept.php");

setcookie(username,"");
setcookie(ck_plan,"1");
if($pmonth=="") $pmonth=date('n');
if($pyear=="") $pyear=date('Y');
$thisfile="op-pflege-dienstplan.php";

$abtname=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

$dbtable="nursing_dutyplan";

require("../req/db-makelink.php");
if($link&&$DBLink_OK) 
	{	
		
		 	$sql="SELECT a_dutyplan,r_dutyplan FROM $dbtable 
							WHERE dept='$dept'
								AND year='$pyear'
								AND month='$pmonth'";
			
			if($ergebnis=mysql_query($sql,$link))
       		{
				$rows=0;
				if( $result=mysql_fetch_array($ergebnis)) $rows++;
				if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					//print $sql."<br>";
				}
			}
				else print "<p>".$sql."<p>$LDDbNoRead"; 
	}
  	 else { print "$LDDbNoLink<br>"; } 

$firstday=date("w",mktime(0,0,0,$pmonth,1,$pyear));

$maxdays=date("t",mktime(0,0,0,$pmonth,1,$pyear));

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }

	A:visited {text-decoration: none;}

div.a3 {font-family: arial; font-size: 14; margin-left: 3; margin-right:3; }

.infolayer {
	position:absolute;
	visibility: hide;
	left: 100;
	top: 10;

}

</style>

<script language="javascript">

  var urlholder;
  var infowinflag=0;

function newplan()
{
<? if($retpath=="calendar_opt") : ?>
	window.opener.location.href="op-pflege-dienstplan-pass.php?dept=<? print "$dept&sid=$ck_sid&lang=$lang&pmonth=$pmonth&pyear=$pyear&retpath=$retpath$fixdate"; ?>";
	window.close();
<? else : ?>
	window.location.href="op-pflege-dienstplan-pass.php?dept=<? print "$dept&sid=$ck_sid&lang=$lang&pmonth=$pmonth&pyear=$pyear&retpath=$retpath"; ?>";
<? endif ?>
}


function popinfo(l,f,b)
{
	w=window.screen.width;
	h=window.screen.height;
	ww=400;
	wh=400;
	urlholder="op-pflege-dienstplan-popinfo.php?<?="sid=$ck_sid&lang=$lang" ?>&ln="+l+"&fn="+f+"&bd="+b+"&dept=<?=$dept ?>&route=validroute&user=<? print $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"infowin","width=" + ww + ",height=" + wh +",menubar=no,resizable=yes,scrollbars=yes");
	window.infowin.moveTo((w/2)+20,(h/2)-(wh/2));

}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
function killchild() {
 if (window.infowin) if(!window.infowin.closed) window.infowin.close();
 if (window.helpwin) if(!window.helpwin.closed) window.helpwin.close();
}
</script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"  >


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" ><FONT  size=+2 COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial">
<STRONG><?="$LDOr - $LDDutyPlan $abtname[$dept]"; ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align="right"><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" alt="<?=$LDBack ?>"></a><a 
href="javascript:gethelp('op_duty.php','show','<?=$rows ?>')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" alt="<?=$LDHelp ?>"></a><a href="<?=$rettarget ?>" onClick=killchild()><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" alt="<?=$LDClosePlan ?>"></a></td>
</tr>
<tr>
<td bgcolor="<? print $cfg['body_bgcolor']; ?>" valign=top colspan=2><p>
<ul>


<FONT    SIZE=-1  FACE="Arial">

<table border=0>
<tr><td align=left><a href="<? print $thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&retpath='.$retpath.'&dept='.$dept.'&pmonth=';
if ($pmonth==1) print '12'.'&pyear='.($pyear-1); 
else print ($pmonth-1).'&pyear='.$pyear;
print $fixdate; ?>">
<font size=2 face=arial color=gray><b><? if ($pmonth==1) print $monat[12]; else print $monat[$pmonth-1]; ?></b></a></td>
<td align=center><font size=4 face=arial color=navy>
<? print $monat[(int)$pmonth].'&nbsp;&nbsp;'.$pyear; ?>
</font></td>

<td align=right><a href="<? print $thisfile.'?sid='.$ck_sid.'&lang='.$lang.'&retpath='.$retpath.'&dept='.$dept.'&pmonth=';
if ($pmonth==12) print '1'.'&pyear='.($pyear+1); 
else print ($pmonth+1).'&pyear='.$pyear;
print $fixdate; ?>">
<font size=2 face=arial color=gray><b><? if ($pmonth==12) print $monat[1];else print $monat[$pmonth+1]; ?></b></td>
<td>&nbsp;</td></tr>


<tr>
<td colspan=3>

<table border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="#6f6f6f">

<table border=0 cellpadding=0 cellspacing=1>
<tr><td></td><td></td>
<td><div class=a3><font face=arial size=2 color=white><b><?=$LDStandbyPerson ?></b></div></td>
<td><div class=a3><font face=arial size=2 color=white><b><?=$LDOnCallPerson ?>&nbsp;&nbsp;&nbsp;&nbsp;</b></div></td>
</tr>
<?

$aduty=explode("~",$result[a_dutyplan]);
$rduty=explode("~",$result[r_dutyplan]);

for ($i=1,$n=0,$wd=$firstday;$i<=$maxdays;$i++,$n++,$wd++){
	//$wd=weekday($i,$pmonth,$pyear);
	switch ($wd){
		case 6: $backcolor="bgcolor=#ffffcc";break;
		case 0: $backcolor="bgcolor=#ffff00";break;
		default: $backcolor="bgcolor=white";
		}
	
	parse_str(trim($aduty[$n]),$aelems);
	parse_str(trim($rduty[$n]),$relems);
	print '
	<tr >
	<td  height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>'.$i.'</div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	if (!$wd) print '<font color=red>';
	print $LDShortDay[$wd].'</div>
	</td>
	<td height=5 '.$backcolor.'><div class="a3"><font face="arial" size=2>';
	print '&nbsp;<a href="javascript:popinfo(\''.$aelems[l].'\',\''.$aelems[f].'\',\''.$aelems[b].'\')">'.$aelems[s].'</a></div>
	</td>
	<td height=5 '.$backcolor.'><div class=a3><font face=arial size=2>';
	print '&nbsp;<a href="javascript:popinfo(\''.$relems[l].'\',\''.$relems[f].'\',\''.$relems[b].'\')">'.$relems[s].'</a></div>
	</td>
	</tr>';
	if ($wd==6)  $wd=-1;
	}
?>

</table>

</td>
</tr>
</table>

	
</td>


<td valign="top">
<!-- <a href="op-pflege-dienstplan-pass.php?dept=<? print $dept.'&sid='.$ck_sid.'&lang='.$lang.'&pmonth='.$pmonth.'&pyear='.$pyear.'&retpath='.$retpath.'&lang='.$lang; ?>"><img src="../img/<?="$lang/$lang" ?>_newplan.gif" border="0" alt="<?=$LDNewPlan ?>"></a>
 --><a href="javascript:newplan()"><img src="../img/<?="$lang/$lang" ?>_newplan.gif" border="0" alt="<?=$LDNewPlan ?>"></a>
<br>
<a href="<?=$rettarget ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0"  alt="<?=$LDClosePlan ?>"></a>
</td>
</tr>
</table>

<p>
<!-- <a href="op-pflege-dienstplan-pass.php?dept=<? print $dept.'&sid='.$ck_sid.'&lang='.$lang.'&pmonth='.$pmonth.'&pyear='.$pyear.'&retpath='.$retpath.'&lang='.$lang; ?>"><img src="../img/<?="$lang/$lang" ?>_newplan.gif" border="0" alt="<?=$LDNewPlan ?>"></a>
 --><a href="javascript:newplan()"><img src="../img/<?="$lang/$lang" ?>_newplan.gif" border="0" alt="<?=$LDNewPlan ?>"></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?=$rettarget ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border="0" alt="<?=$LDClosePlan ?>"></a>
<p>
</ul>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor="<?=$cfg[bot_bgcolor] ?>" height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;




</FONT>

</BODY>
</HTML>
