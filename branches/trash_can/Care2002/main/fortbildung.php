<?
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:invalid-access-warning.php"); exit;}
require("../req/config-color.php");


//create unique id
$r=uniqid("");

$dept=array("Allgemeine Chirurgie","Unfall Chirurgie","Plastische Chirurgie","HNO","Augenklinik","Pathologie",
					"Gynäkologie",
					"Physio-therapie",
					"Innere Medizin",
					"Onkologie",
					"Technik",
					"Intermediate Care Unit",
					"Intensive Care Unit",
					"Labor");
$times=array("8.30 - 21.00", //Mo
					"8.30 - 21.00", //Di
					"8.30 - 21.00", //Mi
					"8.30 - 21.00", //Do
					"8.30 - 21.00", //Fr
					"8.30 - 21.00", //Sa
					"8.30 - 21.00"); //So
$visits=array("12.30 - 15.00 , 19.00 - 21.00", //Mo
					"12.30 - 15.00 , 19.00 - 21.00", //Di
					"12.30 - 15.00 , 19.00 - 21.00", //Mi
					"12.30 - 15.00 , 19.00 - 21.00", //Do
					"12.30 - 15.00 , 19.00 - 21.00", //Fr
					"12.30 - 15.00 , 19.00 - 21.00", //Sa
					"12.30 - 15.00 , 19.00 - 21.00"); //So

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE> Pflege</TITLE>

<script language="javascript">
<!-- 
var urlholder;
function gotostat(station){
	urlholder="pflege-station.php?station=" + station + "&sid=<? print $ck_sid.'"' ?>;
	stationwin=window.open(urlholder,station,"width=800,menubar=no,resizable=yes,scrollbars=yes");
	}

function closewin()
{
	location.href='startframe.php?sid=<?print $ck_sid.'&uid='.$r;?>';
}
// -->
</script>

<?
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
 if($idxreload=="j") print " onLoad=window.parent.STARTPAGE.location.replace('indexframe.php?uid=".$r."');";?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp; &nbsp; Fortbildung</STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="#" onClick=history.back(1)><img src="../img/zuruck.gif" border=0 style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="#"><img src="../img/hilfe.gif" border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="startframe.php?sid=<?print $ck_sid;?>"><img src="../img/fenszu.gif" border=0  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

	<table border=0 cellspacing=0 cellpadding=0>
   <tr>
     <td bgcolor=#0>
	 <table border=0 cellspacing=1 cellpadding=5>
    <tr bgcolor=#ffffff>
      <td><font face="Verdana,arial" size=2><b>Fortbildung</b></font></td>
      <td>&nbsp;</td>
	  <td><font face="Verdana,arial" size=2><b>Kurzinfo</b></font></td>
      <td><font face="Verdana,arial" size=2><b>Termin(e)</b></font></td>
    </tr>
<? for ($i=0;$i<sizeof($dept);$i++){
print '<tr bgcolor=#ffffff><td><font face=verdana,arial size=2> '.$dept[$i].'</td>
		<td><font face=verdana,arial size=2><a href="#"><img src="../img/info.gif" border=0 alt="Click für mehr Info über die Ausbildung."></a></td>		
		<td><font face=verdana,arial size=2> Info über die Fortbildung</td>
		<td><font face=verdana,arial size=2><nobr> 12.06.2001 Montag - 14.00 Uhr</td></tr>';
print "\r\n";
}
?>
  </table>
  
	 </td>
   </tr>
 </table>
 

<p>
<a href="#" onClick=closewin()><img src="../img/close.gif" border=0  alt="Dieses Fenster schliessen." align="middle"></a>

<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top>
<td bgcolor="<? print $cfg['bot_bgcolor']; ?>" colspan=2> 
<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
