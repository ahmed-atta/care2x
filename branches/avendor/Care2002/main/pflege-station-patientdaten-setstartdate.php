<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_pflege_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");

switch($winid)
{
	case "dayback": $title=$LDStartDate;
							$dayback=0;
							break;
	case "dayfwd": $title=$LDEndDate;
							$dayback=6;
							break;
}

$dy=date(d);
$mo=date(m);
$yr=date(Y);

?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<TITLE><?=$title ?></TITLE>

<script language="javascript">
<!-- 


 function parentrefresh(d)
{
	window.opener.location.replace("pflege-station-patientdaten-kurve.php?sid=<?=$ck_sid ?>&station=<?=$station ?>&pn=<?=$pn."&tag=\"+d.day.value+\"&kmonat=\"+d.month.value+\"&jahr=\"+d.year.value+\"&tagname=$tagname&dayback=$dayback\")"; ?>;
	window.close();
	return false;
}

-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.va12_b { font-family:verdana,arial;font-size:12;color:#000000 }
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080" 
onLoad="<? if($saved) print "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();" >

<font face=verdana,arial size=3 color=maroon>

<? 
	print "$LDShowCurveDate <br><b>$title</b>";	
?>

</font>
<p>


<font face=verdana,arial size=3 >
<form name="setdateform" action="<?=$thisfile ?>" method="post" onSubmit="return parentrefresh(this);">
<font face=verdana,arial size=2 >
<table border=0>
  <tr>
    <td class="va12_b"><?=$LDDay ?></td>
    <td class="va12_b"><?=$LDMonth ?></td>
    <td class="va12_b"><?=$LDYear ?></td>
  </tr>
  <tr>
    <td><select name="day">
	<? for($i=1;$i<32;$i++)
		{
			print '
        		<option value="'.$i.'" ';
		 	if($dy==$i) print "selected"; 
		 	print '> '.$i.'</option>';
		 }
	?>
        </select>
        </td>
    <td><select name="month">
 	<? for($i=1;$i<13;$i++)
		{
			print '
        		<option value="'.$i.'" ';
		 	if($mo==$i) print "selected"; 
		 	print '> '.$monat[$i-1].'</option>';
		 }
	?>

        </select>
        </td>
    <td><select name="year">
 	<? for($i=1999;$i<2011;$i++)
		{
			print '
        		<option value="'.$i.'" ';
		 	if($yr==$i) print "selected"; 
		 	print '> '.$i.'</option>';
		 }
	?>
        </select>&nbsp;
<input type="submit" value="<?="$LDGo" ?>">
        </td>
  </tr>
</table>

</form>
<p>
<br>
&nbsp;<p>
<a href="javascript:window.close()"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border="0" alt="<?=$LDClose ?>">
</a>


</BODY>

</HTML>
