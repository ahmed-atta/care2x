<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.02 - 30.07.2002
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","editor.php");
$local_user="ck_cafenews_user";
require("../include/inc_front_chain_lang.php");
$breakfile="cafenews.php?sid=$sid&lang=$lang";
?>
<html>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<!-- Creation date: 21.12.2001 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>

<script language="javascript">
function chkForm(d)
{
	if((d.week[0].checked)||(d.week[1].checked)||(d.week[2].checked)) return true;
		else return false;
}
</script>

</head>
<body>
<FONT  SIZE=6 COLOR="#cc6600" FACE="verdana,Arial">
<img src="../img/basket.gif" width=74 height=70 border=0><b><?php echo $LDCafeMenu ?></b></FONT>
<hr>
<form name="selectform" action="cafenews-edit-menu.php" onSubmit="return chkForm(this)">
<table border=0>
  <tr>
    <td><img src="../img/catr.gif" width=88 height=80 border=0></td>
    <td colspan=2><FONT FACE="verdana,Arial"><FONT  SIZE=5 COLOR="#000066" FACE="verdana,Arial">
		<?php echo $LDMarkWeek ?></font><p>
			<font size=2><?php echo $LDClkContinue ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="ccffff" colspan=2><FONT FACE="verdana,Arial"><p><br>
		<input type="radio" name="week" value="1"> <a href="#" onClick="document.selectform.week[0].checked=true"><?php echo $LDThisWeek ?></a><br>
    	<input type="radio" name="week" value="2"> <a href="#" onClick="document.selectform.week[1].checked=true"><?php echo $LDNextWeek ?></a><br>
    	<input type="radio" name="week" value="3"> <a href="#" onClick="document.selectform.week[2].checked=true"><?php echo $LD3rdWeek ?></a><br><p>
  </td>
  </tr>
  <tr>
   <td>&nbsp;</td>
     <td ><FONT FACE="verdana,Arial">
	<a href="javascript:window.history.back()"><img src="../img/<?php echo $lang ?>/<?php echo $lang ?>_back2.gif" border=0></a>
	<a href="<?php echo $breakfile ?>"><img src="../img/<?php echo $lang ?>/<?php echo $lang ?>_cancel.gif" border=0></a>
  </td>
    <td align=right ><FONT FACE="verdana,Arial">
<input type="image" src="../img/<?php echo $lang ?>/<?php echo $lang ?>_continue.gif" border=0>
  </td>
<!--     <td><p><br>
		<input type="button" value="<?php echo $LDBackBut ?>" onClick="window.history.back()">&nbsp;&nbsp;&nbsp;
        <input type="button" value="<?php echo $LDCancelBut ?>" onClick="window.location.replace('cafenews.php?sid=<?php echo "$sid&lang=$lang" ?>')"></td>
    <td align=right><p><br><FONT FACE="verdana,Arial">
		<input type="submit" value="<?php echo $LDContinueBut ?>">
  </td>
 -->  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
</form></body>
</html>
