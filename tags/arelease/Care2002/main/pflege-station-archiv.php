<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php");

if(!$dept) 
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
		else $dept="plop";

$breakfile="pflege.php?sid=$ck_sid&lang=$lang";

$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;
//$monat=array("Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");
//$tage=array("Mo","Di","Mi","Do","Fr","Sa","So");
$pmonth=(int)$pmonth;
if($pmonth=="") $pmonth=date("n");
if($pyear=="") $pyear=date("Y");

$maxdays=date("t",mktime(0,0,0,$pmonth,1,$pyear));

function wkdaynum($daynum,$mon,$yr){
		$jd=gregoriantojd($mon,$daynum,$yr);
		switch(JDDayOfWeek($jd,0))
			{
				case 0: return 6;
				case 1: return 0;
				case 2: return 1;
				case 3: return 2;
				case 4: return 3;
				case 5: return 4;
				case 6: return 5;
			}
	}

$daynumber=array();

for ($n=0;$n<wkdaynum(1,$pmonth,$pyear);$n++){
	$daynumber[$n]="";
}
for($i=1;$i<=$maxdays;$i++)
{
	$daynumber[$n]=$i;$n++;
}
while ($n<35) 
{
	$daynumber[$n]="";
	$n++;
}



?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript" >
<!-- 
var urlholder;

function update()
{

	var mbuf=document.direct.month.selectedIndex+1;
	var jbuf=document.direct.jahr.value;
	if(!isNaN(jbuf))
	{
	jbuf=parseInt(jbuf);
	var urltarget="pflege-station-archiv.php?sid=<?print "$ck_sid&lang=$lang"; ?>&pmonth="+mbuf+"&pyear="+jbuf;
	window.location.replace(urltarget);
	}
	else document.direct.jahr.select();
	return false;
}

function cxjahr(offs)
{
	
	var buf=document.direct.jahr.value;
	if(offs<1) buf--; else buf++;
	if(!isNaN(buf)) 
	{
	buf=parseInt(buf);
	document.direct.jahr.value=buf;
	}
	else document.direct.jahr.select();
} 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?
require("../req/css-a-hilitebu.php");
?>



</HEAD>

<BODY  alink=navy vlink=navy topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?="$LDNursingStations - $LDArchive" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('nursing_how2search.php','','','arch')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseAlt ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<FONT    SIZE=2  FACE="verdana,Arial" >
<?=$LDClkDate ?>
</font><p>
<? 
print '<table cellspacing=0 cellpadding=0 border=0>
		<tr><td align=left>';
print '<a href="pflege-station-archiv.php?sid='.$ck_sid.'&pmonth=';
if($pmonth<2) print '12&pyear='.($pyear-1).'" title="'.$LDLastMonth.'"><FONT  SIZE=1 FACE="Arial" color=silver>&lt;'.$monat[11];
else print ($pmonth-1).'&pyear='.$pyear.'" title="'.$LDLastMonth.'"><FONT  SIZE=1 FACE="Arial" color=silver>&lt;'.$monat[$pmonth-2];
print '</a></td><td  align=center>';
print '<FONT  SIZE=2 FACE="verdana,Arial" color=navy><b>'.$monat[$pmonth-1].' '.$pyear.'</b></font>';
print '</td><td align=right>';
print '<a href="pflege-station-archiv.php?sid='.$ck_sid.'&pmonth=';
if($pmonth>11) print '1&pyear='.($pyear+1).'" title="'.$LDNextMonth.'"><FONT  SIZE=1 FACE="Arial" color=silver>'.$monat[0];
else print ($pmonth+1).'&pyear='.$pyear.'" title="'.$LDNextMonth.'"><FONT  SIZE=1 FACE="Arial" color=silver>'.$monat[$pmonth];
print '&gt;</a></td></tr><tr><td bgcolor=black colspan=3>';

print '<table border="0" cellspacing=1 cellpadding=5>';

print '<tr>';
for($n=0;$n<6;$n++)
	{
		print '<td bgcolor=white><FONT    SIZE=4  FACE="Arial" ><b>'.$tage[$n].'</b></td>';
	}
print '<td bgcolor="#ffffcc"><FONT    SIZE=4  FACE="Arial" color=red ><b>'.$tage[6].'</b></td>';
print '</tr>';

$j=0;
for($x=0;$x<6;$x++)
{	print '<tr>';
	
		for($n=0;$n<6;$n++)
		{
			if($daynumber[$j].$pmonth.$pyear==date(jnY)) print '<td bgcolor=orange>'; else print '<td bgcolor=white>';
			if($daynumber[$j]<10) $dn="0".$daynumber[$j]; else $dn=$daynumber[$j];
			if($pmonth<10) $mn="0".$pmonth; else $mn=$pmonth;
			print '<FONT face="times new roman"   SIZE=5 ';
			if($pyear.$mn.$dn>date(Ymd))  print 'color="#dfdfdf"'; else print 'color="#000088"';
			print '><b>&nbsp;';
			if($pyear.$mn.$dn<=date(Ymd))  print '<a href="pflege-schnellsicht.php?sid='.$ck_sid.'&lang='.$lang.'&from=arch&dept='.$dept.'&edit=0&pday='.$dn.'&pmonth='.$mn.'&pyear='.$pyear.'">';
			print $daynumber[$j];
			if($pyear.$mn.$dn<=date(Ymd))  print '</a>';
			print '</b></td>'; $j++;
		}
	if($daynumber[$j].$pmonth.$pyear==date(jnY)) print '<td bgcolor=orange>'; else print '<td bgcolor=white>';
	if($daynumber[$j]<10) $dn="0".$daynumber[$j]; else $dn=$daynumber[$j];
	if($pmonth<10) $mn="0".$pmonth; else $mn=$pmonth;
	print '<FONT  face="times new roman"   SIZE=5 ';
	if($pyear.$mn.$dn>date(Ymd))  print 'color="#dfdfdf"'; else print 'color="#ff0000"';
	print '><b>&nbsp;';
	if($pyear.$mn.$dn<=date(Ymd))  print '<a href="pflege-schnellsicht.php?sid='.$ck_sid.'&lang='.$lang.'&from=arch&dept='.$dept.'&edit=0&pday='.$dn.'&pmonth='.$mn.'&pyear='.$pyear.'">';
	print $daynumber[$j];
	if($pyear.$mn.$dn<=date(Ymd))  print '</a>';
	print '</b></td>'; 	$j++;
	print '</tr>';
	if($daynumber[$j]=="") break;

}
print '</table>';
print '</td></tr></table>';
?>

<br><FONT    SIZE=-1  FACE="Arial" color=navy>

<form name="direct" method=get onSubmit="return update()" >
<b><?=$LDDirectSelect ?>:</b>&nbsp;&nbsp;<?=$LDMonth ?><select name="month" size="1"> 

<? for ($i=0,$n=1;$i<sizeof($monat);$i++,$n++)
{	
	print '<option ';
	if($n==$pmonth) print 'selected';
	print'>'.$monat[$i].'</option>';
}
?>
</select>
<?=$LDYear ?><input type="text" name="jahr" size=4 value="<? print $pyear; ?>" >
<? if($cfg['dhtml'])
print '
<a href="#" onclick=cxjahr(\'1\')><img src="../img/varrow-u.gif" border="0" width=15 height=20 alt="'.$LDPlusYear.'"></a>
<a href="#" onClick=cxjahr(\'0\')><img src="../img/varrow-d.gif" border="0"  width=15 height=20 alt="'.$LDMinusYear.'"></a>';
else print'<input  type="button" value="+1" onClick=cxjahr(\'1\')> <input  type="button" value="-1" onClick=cxjahr(\'0\')>';
?>
&nbsp;&nbsp;&nbsp;<input  type="submit" value="<?=$LDGo ?>">
<p>

</form>
</ul>

</FONT>

</td>
</tr>

<tr valign=top >
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
