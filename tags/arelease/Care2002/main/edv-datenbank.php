<?
if (($sid=="")or($sid==NULL)or($sid!=$ck_sid)or($ck_edv_db_user==""))
{header("Location: invalid-access-warning.php"); exit;}

require("../req/config-color.php");


//create unique id
$r=uniqid("");

//erase relevant cookies
setcookie(ck_edvzugang_user,"");
setcookie(ck_edvzugang_src,"");
setcookie(ck_edv_db_user,"");
setcookie(ck_edv_sql_user,"");
setcookie(ck_edv_sysadmin,"");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> EDV - Datenbank</TITLE>

<script language="javascript" >
<!-- 
function closewin()
{
	location.href='edv.php?sid=<?print $ck_sid.'&uid='.$r;?>';
}
// -->
</script> 
 
<? 
require("../req/css-a-hilitebu.php");
?>
</HEAD>

<BODY  topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing=0 height=100%>

<tr valign=top height=10>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" ><FONT  COLOR="<? print  $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp; &nbsp; EDV Datenbank mit Menuführung</STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#" onClick=history.back()><img src="../img/zuruck.gif" border=0 <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="#"><img src="../img/hilfe.gif" border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="startframe.php?sid=<?print $ck_sid;?>"><img src="../img/fenszu.gif" border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul><FONT 
                  face="Verdana,Helvetica,Arial" size=2>
			
<?
$curtime=date("H.i");
if ($curtime<"9.00") print "Guten Morgen ";
if (($curtime>"9.00")and($curtime<"18.00")) print "Guten Tag ";
if ($curtime>"18.00") print "Guten Abend ";
print "$ck_edv_db_user!";

?>
				  

<p>
<a href="#">Neue Datenbank erstellen</a><br>
<a href="#">Neue Tabelle erstellen</a><br>
<a href="#">Neue Daten eingeben</a><br>
<a href="#">Vorhandene Daten aktualisieren</a><br>
<a href="#">Daten löschen</a><br>
<a href="#">Tabelle löschen</a><br>
<a href="#">Datenbank löschen</a><br>
<a href="#">Daten Suchen</a><p>
<a href="#" onClick=closewin()><img src="../img/close.gif" border=0  alt="Dieses Fenster schliessen." align="middle"></a>

<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top  >
<td bgcolor=<? print $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
