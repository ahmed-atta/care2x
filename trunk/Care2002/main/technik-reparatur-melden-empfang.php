<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}
 require("../req/config-color.php");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE>Technik - Bestätigung</TITLE>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <!-- <img src="../img/gears.gif" align="absmiddle">  -->Technik</STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 width=93 height=41  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="#"><img src="../img/hilfe.gif" border=0 width=93 height=41   <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="startframe.php?sid=<?print $ck_sid;?>"><img src="../img/fenszu.gif" border=0 width=93 height=41   <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr>
<td colspan=2 bgcolor=<? print $cfg['body_bgcolor']; ?>>
 
<FONT    SIZE=4  FACE="Arial" color="#cc0000">
<ul>
<b>Bestätigung</b></FONT><p>
</ul>
<FONT    SIZE=2  FACE="Arial" >

<?/*
print("<hr> <font color=#cc0000 ><b>Eine Anforderung für eine Reparaturarbeit ist eingegangen.</b> <p>");
print("Datum:</font> $tdate <br>");
print("<font color=#cc0000 >Uhrzeit:</font> $ttime <br>");
print("<font color=#cc0000 >Abteilung:</font> $dept <br>");
print("<font color=#cc0000 >Absender:</font> $reporter <br>");
*/
?>

</FONT>
<p>
<table align="center"  cellpadding="15"  border="0">
<tr>
<td>
<img src="../img/catr.gif" border=0 width=88 height=80 align=left>
</td>
<td bgcolor=#fefefe>
<FONT    SIZE=2  FACE="Verdana,Arial" >
Vielen Dank Herr/Frau <b><? print("$reporter") ?></b>. <p>
Ihre Anforderung wurde am <b><? print($tdate); ?></b> um <b><? print($ttime); ?></b> 
an der technischen Abteilung empfangen.
</td>

</tr>

</table>
<p>
<center>

<FORM action="technik-reparatur-anfordern.php" >
<input type="hidden" name="sid" value="<?=$ck_sid ?>">

<INPUT type="submit"  value="  OK  "></font></FORM>

</center>


</FONT>
<ul>
<p>
<FONT    SIZE=-1  FACE="Arial">
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-reparatur-anfordern.php?sid=<?=$ck_sid ?>"> Eine Reparaturarbeit anfordern</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-reparatur-melden.php?sid=<?=$ck_sid ?>"> Eine Reparatur anmelden</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-questions.php?sid=<?=$ck_sid ?>">Fragen an der Technik</a><br>
<img src="../img/varrow.gif" width="20" height="15">
<a href="technik-info.php?sid=<?=$ck_sid ?>"> Technische Informationen</a><br>
</FONT>
</ul>
<p>
<HR>

<?php
require("../language/$lang/".$lang."_copyrite.htm");

 ?>

</td>
</tr>
</table>        
</BODY>
</HTML>
