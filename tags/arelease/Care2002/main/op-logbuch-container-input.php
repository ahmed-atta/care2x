<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">
<!-- 

function sendnum(d)
{
	d.material_nr.select();
	if(d.material_nr.value=="") return false;
	else
	{	window.parent.OPMLISTFRAME.location.replace('op-logbuch-container-list.php?sid=<? print "$ck_sid&lang=$lang&op_nr=$op_nr&dept=$dept&saal=$saal&patnum=$patnum&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&mode=search&material_nr='+d.material_nr.value);
	return false;
	}
}
// -->
</script>


</head>
<body onLoad="document.mat_input.material_nr.focus();document.mat_input.material_nr.select()" onFocus="document.mat_input.material_nr.select()" >
<form name="mat_input" onSubmit="return sendnum(this)">
<font face="Verdana, Arial" size=2 color=#800000>
<?=$LDContainerNr ?>:<br>
<input type="text" name="material_nr" size=20 maxlength=40 onFocus="this.select()" ><br>
<input type="submit" value="OK">
</font>
</form><p>
<hr>
<p>
<font face="Verdana, Arial" size=2>
<a href="oplogmain.php?sid=<?  print "$ck_sid&lang=$lang&patnum=$patnum&dept=$dept&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>" target="_parent">
<img src="../img/manfldr.gif" width=35 height=35 border=0><br> <?=$LDShowLogbook ?>
</a>
</body>
</html>
