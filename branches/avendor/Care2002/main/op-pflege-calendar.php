<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}
require("../req/config-color.php");


//create unique id
$r=uniqid("");

$thisfile="op-pflege-dienstplan-checkpoint.php";
$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;
$monat=array("Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember");
$tage=array("Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag","Sonntag");

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

$filename="dienst/abt_list.pid";

if (file_exists($filename))
	{
	$abtname=get_meta_tags($filename);
	$file=fopen($filename,"r");
	if ($file)
	  {
		for ($n=0;$n<$abtname['size'];$n++)
		{
			$abtarr[$n]=fgets($file,255);
			$bufferarr=explode("\t",$abtarr[$n]);
			$bufferarr=explode(" ",$bufferarr[0]);
			$bufferarr=explode(",",$bufferarr[0]);
			$abtarr[$n]=trim($bufferarr[0]);
		}	
		fclose($file);
	  }
	
	}
else $abtarr[0]="?";

//send last-modified as always modified to prevent client from caching
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Kalender</TITLE>

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
	var urltarget="op-pflege-calendar.php?sid=<?print $ck_sid; ?>&pmonth="+mbuf+"&pyear="+jbuf;
	window.location.replace(urltarget);
	}
	else document.direct.jahr.select();
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
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10"><FONT  COLOR="<? print  $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG>&nbsp; &nbsp;Kalender</STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="#"><img src="../img/hilfe.gif" border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="startframe.php?sid=<?print $ck_sid;?>"><img src="../img/fenszu.gif" border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>


<? 
print '<table cellspacing=0 cellpadding=0 border=0>
		<tr><td align=left>';
print '<a href="op-pflege-calendar.php?sid='.$ck_sid.'&pmonth=';
if($pmonth<2) print '12&pyear='.($pyear-1).'" title="Voriger Monat"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>&lt;'.$monat[11];
else print ($pmonth-1).'&pyear='.$pyear.'" title="Voriger Monat"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>&lt;'.$monat[$pmonth-2];
print '</a></td><td  align=center>';
print '<FONT  SIZE=6 FACE="verdana,Arial" color=navy><b>'.$monat[$pmonth-1].' '.$pyear.'</b></font>';
print '</td><td align=right><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>';
print '<a href="op-pflege-calendar.php?sid='.$ck_sid.'&pmonth=';
if($pmonth>11) print '1&pyear='.($pyear+1).'" title="Nächster Monat"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>'.$monat[0];
else print ($pmonth+1).'&pyear='.$pyear.'" title="Nächster Monat"><FONT  SIZE=4 FACE="verdana,Arial" color=silver><b>'.$monat[$pmonth];
print '&gt;</a></td></tr><tr><td bgcolor=black colspan=3>';

print '<table border="0" cellspacing=1 cellpadding=5>';

print '<tr>';
for($n=0;$n<6;$n++)
	{
		print '<td bgcolor=white><FONT    SIZE=4  FACE="Arial" ><b>'.$tage[$n].'</b></td>';
	}
print '<td bgcolor=#ffffcc><FONT    SIZE=4  FACE="Arial" color=red ><b>'.$tage[6].'</b></td>';
print '</tr>';

$j=0;
for($x=0;$x<6;$x++)
{	print '<tr>';
	
		for($n=0;$n<6;$n++)
		{
			if($daynumber[$j].$pmonth.$pyear==date(jnY)) print '<td bgcolor=orange>'; else print '<td bgcolor=white>';
			print '<FONT face="times new roman"   SIZE=8  color=navy><b>&nbsp;'.$daynumber[$j].'</b></td>'; $j++;
		}
	if($daynumber[$j].$pmonth.$pyear==date(jnY)) print '<td bgcolor=orange>'; else print '<td bgcolor=white>';
	print '<FONT  face="times new roman"   SIZE=8  color=red><b>&nbsp;'.$daynumber[$j].'</b></td>'; 	$j++;
	print '</tr>';
	if($daynumber[$j]=="") break;

}
print '</table>';
print '</td></tr></table>';
?>

<br><FONT    SIZE=-1  FACE="Arial" color=navy>

<form name="direct" method=get >
<b>Direktwahl:</b>&nbsp;&nbsp;Monat<select name="month" size="1"> 

<? for ($i=0,$n=1;$i<sizeof($monat);$i++,$n++)
{	
	print '<option ';
	if($n==$pmonth) print 'selected';
	print'>'.$monat[$i].'</option>';
}
?>
</select>
Jahr<input type="text" name="jahr" size=4 value="<? print $pyear; ?>" >
<? if($cfg['dhtml'])
print '
<a href="#" onclick=cxjahr(\'1\')><img src="../img/varrow-u.gif" border="0" alt="Jahr um 1 rauf"></a>
<a href="#" onClick=cxjahr(\'0\')><img src="../img/varrow-d.gif" border="0" alt="Jahr um 1 runter"></a>';
else print'<input  type="button" value="+1" onClick=cxjahr(\'1\')> <input  type="button" value="-1" onClick=cxjahr(\'0\')>';
?>
&nbsp;&nbsp;&nbsp;<input  type="button" value="GO" onClick=update()>
<p>

</form>
<img src="../img/varrow.gif" width="20" height="15"> <a href="#"  >Nachrichten</a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="#" >Rundbrief</a><br>

<p>

<p>
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
