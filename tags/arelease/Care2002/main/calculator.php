<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_specials.php");
require("../req/config-color.php");
$breakfile="spediens.php?sid=$ck_sid&lang=$lang";
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<? if($cfg['dhtml'])
{ print' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>';
}
?>

<script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?=$LDCalc ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>

</FONT>
<p>

<CENTER>
<FORM name="Keypad" action="">

<TABLE border=2 width=50 height=60 cellpadding=1 cellspacing=5>
<TR>
<TD colspan=3 align=middle>
<input name="ReadOut" type="Text" size=24 value="0" width=100%>
</TD>
<TD
</TD>
<TD>
<input name="btnClear" type="Button" value="  C  " onclick="Clear()">
</TD>
<TD><input name="btnClearEntry" type="Button" value="  CE " onclick="ClearEntry()">
</TD>
</TR>
<TR>
<TD>
<input name="btnSeven" type="Button" value="  7  " onclick="NumPressed(7)">
</TD>
<TD>
<input name="btnEight" type="Button" value="  8  " onclick="NumPressed(8)">
</TD>
<TD>
<input name="btnNine" type="Button" value="  9  " onclick="NumPressed(9)">
</TD>
<TD>
</TD>
<TD>
<input name="btnNeg" type="Button" value=" +/- " onclick="Neg()">
</TD>
<TD>
<input name="btnPercent" type="Button" value="  % " onclick="Percent()">
</TD>
</TR>
<TR>
<TD>
<input name="btnFour" type="Button" value="  4  " onclick="NumPressed(4)">
</TD>
<TD>
<input name="btnFive" type="Button" value="  5  " onclick="NumPressed(5)">
</TD>
<TD>
<input name="btnSix" type="Button" value="  6  " onclick="NumPressed(6)">
</TD>
<TD>
</TD>
<TD align=middle><input name="btnPlus" type="Button" value="  +  " onclick="Operation('+')">
</TD>
<TD align=middle><input name="btnMinus" type="Button" value="   -   " onclick="Operation('-')">
</TD>
</TR>
<TR>
<TD>
<input name="btnOne" type="Button" value="  1  " onclick="NumPressed(1)">
</TD>
<TD>
<input name="btnTwo" type="Button" value="  2  " onclick="NumPressed(2)">
</TD>
<TD>
<input name="btnThree" type="Button" value="  3  " onclick="NumPressed(3)">
</TD>
<TD>
</TD>
<TD align=middle><input name="btnMultiply" type="Button" value="  *  " onclick="Operation('*')">
</TD>
<TD align=middle><input name="btnDivide" type="Button" value="   /   " onclick="Operation('/')">
</TD>
</TR>
<TR>
<TD>
<input name="btnZero" type="Button" value="  0  " onclick="NumPressed(0)">
</TD>
<TD>
<input name="btnDecimal" type="Button" value="   .  " onclick="Decimal()">
</TD>
<TD colspan=3>
</TD>
<TD>
<input name="btnEquals" type="Button" value="  =  " onclick="Operation('=')">
</TD>
</TR>
</TABLE>

</B>
</FORM>
</CENTER>
<font face="Verdana, Arial, Helvetica" size=2>
<SCRIPT LANGUAGE="JavaScript" src="../js/calculator.js">

</SCRIPT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
 
</td>
</tr>
</table>        
&nbsp;

</FONT>

</BODY>
</HTML>
