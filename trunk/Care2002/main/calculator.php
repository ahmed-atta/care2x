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
require_once('../include/inc_config_color.php');
$breakfile="spediens.php?sid=".$sid."&lang=".$lang;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php if($cfg['dhtml'])
{ echo' 
	<script language="javascript" src="../js/hilitebu.js">
	</script>';
}
?>

<script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDCalc ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>

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
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
 
</td>
</tr>
</table>        
&nbsp;

</FONT>

</BODY>
</HTML>
