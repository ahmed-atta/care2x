<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
if (!$internok&&!$ck_op_pflegelogbuch_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_or.php");

$comdat="?sid=$ck_sid&lang=$lang&patnum=$patnum&op_nr=$op_nr&dept=$dept&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear";

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript">

function opentimewin(s)
{
	w=window.parent.screen.width;
	h=window.parent.screen.height;
	ww=550; 
	wh=500;
	if(s=="wait_time") t="op-pflege-graph-getwaittime.php";
		else t="op-pflege-graph-getinfo.php";
	timewin=window.open(t+"<?=$comdat ?>&winid="+s,"timewin","menubar=no,resizable=yes,scrollbars=yes, width=" + ww + ", height=" + wh);
	window.timewin.moveTo((w/2)-(ww/2),(h/2)-(wh/2));

}
</script>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }
	A:visited {text-decoration: none;}
</style>

</HEAD>

<BODY bgcolor=#cde1ec topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 alink="navy" vlink="navy">


<table cellpadding="0" cellspacing="0" border=0 width=100%> 
<tr>
<td  align=right><font face=verdana,arial size=2><b><?=$LDTimes ?>:</b></td>
</tr>
<tr>
<td align=right><font face=arial size=2><nobr><a href="#" onclick=opentimewin('entry_out')><?="$LDOpIn/$LDOpOut" ?>:<img src="../img/bul_arrowGrnSm.gif" width=12 height=12 border=0 align=absmiddle></a></td>

</tr>
<tr>
<td align=right>
<font face=arial size=2><a href="#" onclick=opentimewin('cut_close')><?="$LDOpCut/$LDOpClose" ?>: <img src="../img/bul_arrowGrnSm.gif" width=12 height=12 border=0 align=absmiddle></a></td>

</tr>
<tr><td align=right>
<font face=arial size=2><a href="#" onclick=opentimewin('wait_time')><?=$LDWaitTime ?>: <img src="../img/bul_arrowGrnSm.gif" width=12 height=12 border=0 align=absmiddle></a></td>

</tr>
<tr><td align=right>
<font face=arial size=2><a href="#" onclick=opentimewin('bandage_time')><?=$LDPlasterCast ?>: <img src="../img/bul_arrowGrnSm.gif" width=12 height=12 border=0 align=absmiddle></a></td>

</tr>
<tr><td align=right>
<font face=arial size=2><a href="#" onclick=opentimewin('repos_time')><?=$LDReposition ?>: <img src="../img/bul_arrowGrnSm.gif" width=12 height=12 border=0 align=absmiddle></a></td>

</tr>

</table>


</BODY>
</HTML>
