<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");

require("../req/config-color.php"); // load color preferences

$breakfile="pflege.php?sid=$ck_sid&lang=$lang";

if($pday=="") $pday=date(d);
if($pmonth=="") $pmonth=date(m);
if($pyear=="") $pyear=date(Y);
$t_date=$pday.".".$pmonth.".".$pyear;

$dbtable="nursing_station_patients";

require("../req/db-makelink.php");
	if($link&&$DBLink_OK) 
		{
					// check if already exists
					$sql="SELECT station, maxbed, freebed, usebed_percent FROM $dbtable
					WHERE t_date='$t_date' ORDER BY station";
					if($ergebnis=mysql_query($sql,$link))
       					{
							$rows=0;
							while( $dbdata=mysql_fetch_array($ergebnis)) $rows++;
							if($rows)
							{
								mysql_data_seek($ergebnis,0);
							}
						}
							else print "$sql<br>$LDDbNoRead"; 
		}
  		 else { print "$LDDbNoLink<br>"; } 

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!-- 

var urlholder;

  function gotostat(station){
	winw=screen.width ;
	winw=(winw / 2) - 400;
	winh=screen.height ;
	winh=(winh / 2) - 300;
	winspecs="width=800,height=600,screenX=" + winw + ",screenY=" + winh + ",menubar=no,resizable=yes,scrollbars=yes";

	urlholder="pflege-station.php?route=validroute&station=" + station + "&user=<? print $aufnahme_user.'"' ?>;
	stationwin=window.open(urlholder,station,winspecs);
	}

  function statbel(station,e){
<?php
	if($cfg['dhtml'])
	{
	print 'w=window.parent.screen.width; h=window.parent.screen.height;';
	}
	else print 'w=800;
					h=600;';
?>
	winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);
	
	if (e==1) urlholder="pflege-station-pass.php?rt=pflege&station="+station+"&sid=<? print "$ck_sid&lang=$lang&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&edit=1&retpath=quick";
		else urlholder="pflege-station.php?rt=pflege&station="+station+"&sid=<? print "$ck_sid&lang=$lang&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&edit=0&retpath=quick"
	//stationwin=window.open(urlholder,station,winspecs);	
	window.location.href=urlholder;
<?// if($cfg['dhtml']) print 'window.stationwin.moveTo(0,0);'; ?>
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

<BODY bgcolor=<? print $cfg['bot_bgcolor']; ?> marginwidth=0 marginheight=0 topmargin=0 leftmargin=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?> >

<table width=100% border=0  height=100% cellspacing="0">
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?="$LDNursing - $LDQuickView" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('nursing_how2search.php','','<?=$rows ?>','quick')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseAlt ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<FONT    SIZE=4  FACE="Arial" color=red>
<img src="../img/varrow.gif" width="20" height="15">
<b>
<? if($pyear.$pmonth.$pday<date(Ymd)) print $LDOld; else print $LDTodays; ?> <?=$LDOccupancy ?></b>
</FONT> &nbsp;&nbsp;<font size="2" face="arial">(
<?=$pday.".".$pmonth.".".$pyear ?>)
</font><p>

<?
if($rows)
{
print '
		<table  cellpadding="0" cellspacing=0 border="0" >';

print '
		<tr bgcolor="aqua" align=center><td><font face="verdana,arial" size="2" ><b>&nbsp; '.$LDStation.' &nbsp;</b></td>';
print '
		<td><img src="../img/man-gr.gif" border="0" width=15 height=16 alt="'.$LDNrUnocc.'"> <font face="verdana,arial" size="2" ><b>'.$LDFreeBed.'</b></td>';
print '
		<td ><font face="verdana,arial" size="2" ><b>'.$LDOccupancy.' (%)</b></td>';
print '
		<td><font face="verdana,arial" size="2" > <b>'.$LDBedNr.'</b></td>';
print '
		<td><font face="verdana,arial" size="2" > <b>&nbsp; '.$LDOptions.' &nbsp;</b></td>';
print '
		</tr>';

$randombett=0;
$randommaxbett=0;
$frei=0;

srand(time());

while ($result=mysql_fetch_array($ergebnis))
	{
	$frei=floor(($result[freebed]/$result[maxbed])*10);
	if ($toggler==0) 
		{ print '
						<tr bgcolor="#ffffcc">'; $toggler=1;} 
		else { print '
						<tr bgcolor="#dfdfdf">'; $toggler=0;}
	print "\r\n";
	print '
						<td align=center><font face="verdana,arial" size="2" ><a href="javascript:statbel(\''.$result[station].'\',\'0\')"  title="'.$LDClk2Show.'">';
	print strtoupper($result[station]).'
						</a></td><td align=center><font face="verdana,arial" size="2" >
						'.$result[freebed].'&nbsp;&nbsp;&nbsp;</td>';
	print '
						<td>';
	print "\r\n";
	for ($n=0;$n<(10-$frei);$n++) print '<img src="../img/mans-red.gif" align=absmiddle  border=0 width=12 height=15>';
	for ($n=0;$n<$frei;$n++) print '<img src="../img/mans-gr.gif" align=absmiddle  border=0 width=12 height=15>';
	print '
			</td><td align=center>
			<font face="verdana,arial" size="2" >'.$result[maxbed].'
			</td>';
	print "\r\n";
	print '
			</td><td align=center> <a href="javascript:statbel(\''.$result[station].'\',\'1\')">
			<img src="../img/statbel2.gif" align=absmiddle  border=0 width=20 height=20 alt="'.str_replace("~station~",$result[station],$LDEditStation).'" border="0"></a>
			</td></tr>
			</tr>
	 <tr><td bgcolor="#0000ee" colspan="7"><img src="../img/pixel.gif" border=0 width=1 height=1></td></tr>
	 ';

	}

print '
			</table>';
			
if($pyear.$pmonth.$pday<>date(Ymd))
			print '<p>
			<font face="Verdana, Arial" size=2 >
			<a href="pflege-station-archiv.php?sid='.$ck_sid.'&lang='.$lang.'&pyear='.$pyear.'&pmonth='.$pmonth.'">'.$LDClk2Archive.' <img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0 align="absmiddle"></a>
			</font><p>';
}
else
{
	print '
			<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"><font face="Verdana, Arial" size=3 color="#880000">
			<b>'.$LDNoOcc.'</b><p>
			<font size=2 color="#0">
			<a href="pflege-station-archiv.php?sid='.$ck_sid.'&lang='.$lang.'&pyear='.$pyear.'&pmonth='.$pmonth.'">'.$LDClk2Archive.' <img src="../img/bul_arrowGrnLrg.gif" width=16 height=16 border=0 align="absmiddle"></a>
			</font></font><p>
			<br>&nbsp;';
}


?>


<p><br>
<? if($from=="arch") : ?>
<a href="pflege-station-archiv.php?sid=<?="$ck_sid&lang=$lang&pyear=$pyear&pmonth=$pmonth" ?>"><img src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24></a>
<? else : ?>
<a href="pflege.php?sid=<?="$ck_sid&lang=$lang" ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24></a>
<? endif ?>
</ul>



</FONT>
<p>
</td>
</tr>
</table>        
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</BODY>
</HTML>
