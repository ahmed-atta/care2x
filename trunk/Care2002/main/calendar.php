<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.03 - 2002-10-26
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

// reset all 2nd level lock cookies
require('../include/inc_2level_reset.php');

require_once('../include/inc_config_color.php');

if($retpath=="home") $breakfile="startframe.php?sid=".$sid."&lang=".$lang;
	else $breakfile="spediens.php?sid=".$sid."&lang=".$lang;
	
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
<?php echo setCharSet(); ?>

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
	var urltarget="calendar.php?sid=<?php echo "$sid&lang=$lang"; ?>&pmonth="+mbuf+"&pyear="+jbuf;
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
	urlholder="calendar-options.php?sid=<?php echo "$sid&lang=$lang" ?>&day="+d+"&month="+m+"&year="+y;
	optwin=window.open(urlholder,"optwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?php
require('../include/inc_css_a_hilitebu.php');
?>


</HEAD>

<BODY  alink=navy vlink=navy topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"  height="35"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>
 &nbsp;<?php echo "$LDCalendar"; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img 
<?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?> 
style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a 
href="javascript:gethelp('calendar.php')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>

<?php 
echo '<table cellspacing=0 cellpadding=0 border=0>
		<tr><td align=left>';
echo '<a href="calendar.php?sid='.$sid.'&lang='.$lang.'&pmonth=';
if($pmonth<2) echo '12&pyear='.($pyear-1).'" title="'.$LDPrevMonth.'"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>&lt;'.$monat[12];
else echo ($pmonth-1).'&pyear='.$pyear.'" title="'.$LDPrevMonth.'"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>&lt;'.$monat[$pmonth-1];
echo '</a></td><td  align=center>';
echo '<FONT  SIZE=6 FACE="verdana,Arial" color=navy><b>'.$monat[(int)$pmonth].' '.$pyear.'</b></font>';
echo '</td><td align=right><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>';
echo '<a href="calendar.php?sid='.$sid.'&lang='.$lang.'&pmonth=';
if($pmonth>11) echo '1&pyear='.($pyear+1).'" title="'.$LDNextMonth.'"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>'.$monat[1];
else echo ($pmonth+1).'&pyear='.$pyear.'" title="'.$LDNextMonth.'"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>'.$monat[$pmonth+1];
echo '&gt;</a></td></tr><tr><td bgcolor=black colspan=3>';

echo '<table border="0" cellspacing=1 cellpadding=5 width="100%">';

echo '<tr>';
for($n=0;$n<6;$n++)
	{
		echo '<td bgcolor=white><FONT    SIZE=4  FACE="Arial" ><b>'.$tagename[$n].'</b></td>';
	}
echo '<td bgcolor="#ffffcc"><FONT    SIZE=4  FACE="Arial" color=red ><b>'.$tagename[6].'</b></td>';
echo '</tr>';

$j=0;
for($x=0;$x<6;$x++)
{	echo '<tr>';
	
		for($n=0;$n<6;$n++)
		{
			if($daynumber[$j].$pmonth.$pyear==date(jnY)) echo '<td bgcolor=orange>'; else echo '<td bgcolor=white>';
			echo '<FONT face="times new roman"   SIZE=8  color=navy><b>&nbsp;<a href="javascript:optionwin(\''.$daynumber[$j].'\',\''.$pmonth.'\',\''.$pyear.'\')" title="'.$LDClk4Options.'">'.$daynumber[$j].' </a></b></td>'; $j++;
		}
	if($daynumber[$j].$pmonth.$pyear==date(jnY)) echo '<td bgcolor=orange>'; else echo '<td bgcolor=white>';
	echo '<b>&nbsp;<a href="javascript:optionwin(\''.$daynumber[$j].'\',\''.$pmonth.'\',\''.$pyear.'\')" title="'.$LDClk4Options.'"><FONT  face="times new roman"   SIZE=8  color=red>'.$daynumber[$j].'</a></b></td>'; 	$j++;
	echo '</tr>';
	if($daynumber[$j]=="") break;

}
echo '</table>';
echo '</td></tr></table>';
?>

<br><FONT    SIZE=-1  FACE="Arial" color=navy>

<form name="direct" method=get onSubmit="return update()" >
<b><?php echo $LDDirectDial ?>:</b>&nbsp;&nbsp;<?php echo $LDMonth ?> <select name="month" size="1"> 

<?php for ($n=1;$n<sizeof($monat);$n++)
{	
	echo '<option ';
	if($n==$pmonth) echo 'selected';
	echo'>'.$monat[$n].'</option>';
}
?>
</select>
<?php echo $LDYear ?> <input type="text" name="jahr" size=4 value="<?php echo $pyear; ?>" >
<?php if($cfg['dhtml'])
echo '
<a href="#" onclick=cxjahr(\'1\')><img '.createComIcon('../','varrow-u.gif','0').' alt="'.$LDPlus1Year.'"></a>
<a href="#" onClick=cxjahr(\'0\')><img '.createComIcon('../','varrow-d.gif','0').' alt="'.$LDMinus1Year.'"></a>';
else echo'<input  type="button" value="+1" onClick=cxjahr(\'1\')> <input  type="button" value="-1" onClick=cxjahr(\'0\')>';
?>
&nbsp;&nbsp;&nbsp;<input  type="submit" value="<?php echo $LDGO ?>">
<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form>
</ul>
</FONT>
</td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</td>
</tr>
</table>        
&nbsp;
</BODY>
</HTML>
