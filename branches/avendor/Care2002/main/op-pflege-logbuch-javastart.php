<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
//if (!$sid||($sid!=$ck_sid)||!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if (!$internok&&!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require("../req/config-color.php"); // load color preferences


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><TITLE></TITLE>

<script language="javascript">

function makelogbuch()
{
<? if($cfg['dhtml'])
	print '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	print '
			w=800;
			h=650;';
?>
	logbuchwin=window.open("op-pflege-logbuch-start.php?sid=<? print "$ck_sid&lang=$lang&internok=$internok"; ?>","logbuchwin<?=uniqid("") ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
	window.logbuchwin.moveTo(0,0);
	window.location.replace('<? if($retpath=="calendar_opt") print "calendar-options.php?sid=$ck_sid&lang=$lang&day=$pday&month=$pmonth&year=$pyear"; else print "op-doku.php?sid=$ck_sid&lang=$lang";?>&forcestation=1&nofocus=1&nointern=1');
}
</script>

</HEAD>


<BODY BACKGROUND="#ffffff" onLoad="makelogbuch()">


</BODY>
</HTML>
