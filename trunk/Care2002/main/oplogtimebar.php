<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
require("../language/".$lang."/lang_".$lang."_or.php");


$template=array();

setcookie(opfclic_rt,"timebar");
setcookie(opfclic_filename,$filename);
$imgsrc="../imgcreator/log-timebar.php?sid=$ck_sid&lang=$lang&winid=$winid&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";
setcookie(ck_comdat,"patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday");

$hi=90;
$wid=3000;
$min=($wid*100)/(24*12);
$min2= $min/2;

$min=(int) $min;
$min2=(int) $min2;
$min/=100;
$min2/=100;

$tabrows=$hi/6;
$tabrows=$tabrows*100;
$tabrows=(int) $tabrows;
$tabrows/=100;


$i=$min2;

$hr="00";
$minute="05";

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
function refreshparent()
{
	<? $comdat='&dept='.$dept.'&saal='.$saal.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&op_nr='.$op_nr; ?>
	window.top.LOGINPUT.location.replace('<? print "oploginput.php?sid=$ck_sid&lang=$lang&patnum=$patnum&mode=notimereset$comdat"; ?>');
	window.top.OPLOGMAIN.location.replace('<? print "oplogmain.php?sid=$ck_sid&lang=$lang&gotoid=$patnum$comdat"; ?>');
}
function pruf(t)
{
	alert("hello");
	//window.location.replace("opfclic.php?v='.$hr.'.'.$minute.'&g='.$group[$m]
}

function scroll2input(d)
{
 	tb=125;
	hr=d*tb;
	xtab=tb*2;
	scroll(hr-xtab,0);
}

function scroll2time()
{
 	zeit=new Date();
	hr=zeit.getHours()*125;
	xtab=250;
	scroll(hr-xtab,0);
}

function s(h,m,x)
{
	switch (x)
	{
		case "e": group="entry_out";
						break;
		case "c": group="cut_close";
						break;
		case "w": group="wait_time";
						break;
		case "b": group="bandage_time";
						break;
		case "r": group="repos_time";
						break;
	}
	window.location.href="opfclic.php?lang=<?=$lang ?>&v="+h+"."+m+"&g="+group;
}
</script>
 
</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=#cde1ec alink="navy" vlink="navy" 
onLoad="
<?
	if($resetmainput) print 'refreshparent();'; 
	if($scrolltab) print 'scroll2input(\''.$scrolltab.'\');setTimeout(\'scroll2time()\',30000);';
	 else print 'scroll2time();';
?>setInterval('scroll2time()',900000);">

<table cellpadding="0" cellspacing="0" border=0 width=100%> 
<tr>
<td >
<map name="timebar">
<?

$clas=array("$LDOpIn/$LDOpOut","$LDOpCut/$LDOpClose",$LDWaitTime,$LDPlasterCast,$LDReposition);

/*
$group=array("entry_out","cut_close","wait_time","bandage_time","repos_time");
for($n=$tabrows,$m=0;$n<$hi;$n+=$tabrows,$m++)
{
	print '<AREA SHAPE="RECT" COORDS="0,'.$n.','.($min2-1).','.($n+$tabrows-1).'" href="opfclic.php?lang='.$lang.'&v='.$hr.'.0&g='.$group[$m].'"  alt="'.$hr.'.00 ('.$clas[$m].')" >';
	print "\r\n";
	while($i<$wid)
	{
		$line='<AREA SHAPE="RECT" COORDS="'.$i.','.$n.','.(($i+$min)-1).','.($n+$tabrows-1).'" href="opfclic.php?lang='.$lang.'&v='.$hr.'.'.$minute.'&g='.$group[$m].'" alt="'.$hr.'.'.$minute.' ('.$clas[$m].')" >';

		print $line;
		print "\n";
		$i+=$min;
		if($minute==55) {$minute=0; $hr++;} else {$minute+=5;}
		if ($minute<10) $minute="0".$minute;
	}
	$i=$min2;
	$hr="00";
	$minute="05";
}
*/

$group=array("e","c","w","b","r");

for($n=$tabrows,$m=0;$n<$hi;$n+=$tabrows,$m++)
{
	print '<AREA SHAPE="RECT" COORDS="0,'.$n.','.($min2-1).','.($n+$tabrows-1).'" href="javascript:s(\''.$hr.'\',\'0\',\''.$group[$m].'\')">';
	print "\r\n";
	while($i<$wid)
	{
		$line='<AREA SHAPE="RECT" COORDS="'.$i.','.$n.','.(($i+$min)-1).','.($n+$tabrows-1).'" href="javascript:s(\''.$hr.'\',\''.$minute.'\',\''.$group[$m].'\')">';

		print $line;
		print "\n";
		$i+=$min;
		if($minute==55) {$minute=0; $hr++;} else {$minute+=5;}
		if ($minute<10) $minute="0".$minute;
	}
	$i=$min2;
	$hr="00";
	$minute="05";
}



?>
</map><img ismap usemap="#timebar" src="<? print $imgsrc; ?>" border=0>
</td>
</tr>

</table>


</BODY>
</HTML>
