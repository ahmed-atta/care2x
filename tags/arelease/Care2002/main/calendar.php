<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_specials.php");
require("../req/config-color.php");

if($retpath=="home") $breakfile="startframe.php?sid=$ck_sid&lang=$lang";
	else $breakfile="spediens.php?sid=$ck_sid&lang=$lang";
	
$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;
//$tage=array("Mon","Die","Mit","Don","Fre","Sam","Son");

if($pmonth=="") $pmonth=date("n");
if($pyear=="") $pyear=date("Y");

function getmaxdays($mon,$yr)
{
	if ($mon==2){ if (checkdate($mon,29,$yr)) return 29; else return 28;}
	else
	{
		if(checkdate($mon,31,$yr)) return 31; else return 30;
	}
}

$maxdays=getmaxdays($pmonth,$pyear);

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
	var urltarget="calendar.php?sid=<?print $ck_sid; ?>&pmonth="+mbuf+"&pyear="+jbuf;
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
function optionwin(d,m,y)
{
	if (!d) d="";
	urlholder="calendar-options.php?sid=<?="$ck_sid&lang=$lang" ?>&day="+d+"&month="+m+"&year="+y;
	optwin=window.open(urlholder,"optwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
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
<td bgcolor="<? print $cfg['top_bgcolor']; ?>"  height="35"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>
 &nbsp;<?="$LDCalendar"; ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('calendar.php')"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<? 
print '<table cellspacing=0 cellpadding=0 border=0>
		<tr><td align=left>';
print '<a href="calendar.php?sid='.$ck_sid.'&pmonth=';
if($pmonth<2) print '12&pyear='.($pyear-1).'" title="'.$LDPrevMonth.'"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>&lt;'.$monat[12];
else print ($pmonth-1).'&pyear='.$pyear.'" title="'.$LDPrevMonth.'"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>&lt;'.$monat[$pmonth-1];
print '</a></td><td  align=center>';
print '<FONT  SIZE=6 FACE="verdana,Arial" color=navy><b>'.$monat[(int)$pmonth].' '.$pyear.'</b></font>';
print '</td><td align=right><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>';
print '<a href="calendar.php?sid='.$ck_sid.'&pmonth=';
if($pmonth>11) print '1&pyear='.($pyear+1).'" title="'.$LDNextMonth.'"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>'.$monat[1];
else print ($pmonth+1).'&pyear='.$pyear.'" title="'.$LDNextMonth.'"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>'.$monat[$pmonth+1];
print '&gt;</a></td></tr><tr><td bgcolor=black colspan=3>';

print '<table border="0" cellspacing=1 cellpadding=5 width="100%">';

print '<tr>';
for($n=0;$n<6;$n++)
	{
		print '<td bgcolor=white><FONT    SIZE=4  FACE="Arial" ><b>'.$tagename[$n].'</b></td>';
	}
print '<td bgcolor="#ffffcc"><FONT    SIZE=4  FACE="Arial" color=red ><b>'.$tagename[6].'</b></td>';
print '</tr>';

$j=0;
for($x=0;$x<6;$x++)
{	print '<tr>';
	
		for($n=0;$n<6;$n++)
		{
			if($daynumber[$j].$pmonth.$pyear==date(jnY)) print '<td bgcolor=orange>'; else print '<td bgcolor=white>';
			print '<FONT face="times new roman"   SIZE=8  color=navy><b>&nbsp;<a href="javascript:optionwin(\''.$daynumber[$j].'\',\''.$pmonth.'\',\''.$pyear.'\')" title="'.$LDClk4Options.'">'.$daynumber[$j].' </a></b></td>'; $j++;
		}
	if($daynumber[$j].$pmonth.$pyear==date(jnY)) print '<td bgcolor=orange>'; else print '<td bgcolor=white>';
	print '<b>&nbsp;<a href="javascript:optionwin(\''.$daynumber[$j].'\',\''.$pmonth.'\',\''.$pyear.'\')" title="'.$LDClk4Options.'"><FONT  face="times new roman"   SIZE=8  color=red>'.$daynumber[$j].'</a></b></td>'; 	$j++;
	print '</tr>';
	if($daynumber[$j]=="") break;

}
print '</table>';
print '</td></tr></table>';
?>

<br><FONT    SIZE=-1  FACE="Arial" color=navy>

<form name="direct" method=get onSubmit="return update()" >
<b><?=$LDDirectDial ?>:</b>&nbsp;&nbsp;<?=$LDMonth ?> <select name="month" size="1"> 

<? for ($n=1;$n<sizeof($monat);$n++)
{	
	print '<option ';
	if($n==$pmonth) print 'selected';
	print'>'.$monat[$n].'</option>';
}
?>
</select>
<?=$LDYear ?> <input type="text" name="jahr" size=4 value="<? print $pyear; ?>" >
<? if($cfg['dhtml'])
print '
<a href="#" onclick=cxjahr(\'1\')><img src="../img/varrow-u.gif" border="0" width=15 height=20 alt="'.$LDPlus1Year.'"></a>
<a href="#" onClick=cxjahr(\'0\')><img src="../img/varrow-d.gif" border="0"  width=15 height=20 alt="'.$LDMinus1Year.'"></a>';
else print'<input  type="button" value="+1" onClick=cxjahr(\'1\')> <input  type="button" value="-1" onClick=cxjahr(\'0\')>';
?>
&nbsp;&nbsp;&nbsp;<input  type="submit" value="<?=$LDGO ?>">
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
