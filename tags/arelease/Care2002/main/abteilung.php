<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
		
if(($sid==NULL)||($sid!=$ck_sid)) { header("location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}

require("../language/".$lang."/lang_".$lang."_abteilung.php");
require("../req/config-color.php");

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <TITLE><?=$LDPageTitle ?></TITLE>

<?
require("../req/css-a-hilitebu.php");
?>

<script language="">
<!-- Script Begin
function gethelp(x)
{
	urlholder="help-router.php?helpidx="+x+"&lang=<?=$lang ?>";
	helpwin=window.open(urlholder,"helpwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
//  Script End -->
</script>

</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" >
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
<STRONG>&nbsp; &nbsp;<?=$LDPageTitle ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="#" onClick=history.back()><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>';?>
<a href="javascript:gethelp()"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="startframe.php?sid=<?print "$ck_sid&lang=$lang";?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

	<table border=0 cellspacing=0 cellpadding=0>
   <tr>
     <td bgcolor=#000000>
	 <table border=0 cellspacing=1 cellpadding=5>
    <tr bgcolor=#ffffff>
      <td><font face="Verdana,arial" size=2><b><?=$LDDeptTxt ?></b></font></td>
      <td>&nbsp;</td>
	  <td><font face="Verdana,arial" size=2><b><?=$LDOpenHrsTxt ?></b></font></td>
      <td><font face="Verdana,arial" size=2><b><?=$LDChkHrsTxt ?></b></font></td>
    </tr>
	<? for ($i=0;$i<sizeof($dept);$i++){
print '<tr bgcolor="#ffffff"><td><font face=verdana,arial size=2><a href="newscolumns.php?sid='.$ck_sid.'&lang='.$lang.'&target='.$target[$i].'"> '.$dept[$i].'</a></td>
		<td><font face=verdana,arial size=2><a href="newscolumns.php?sid='.$ck_sid.'&lang='.$lang.'&target='.$target[$i].'"><img src="../img/info.gif" border=0 alt="'.$LDClk4Info.' '.$dept[$i].'."></a></td>		
		<td><font face=verdana,arial size=2><nobr> 9.00 - 21.00</td>
		<td><font face=verdana,arial size=2><nobr> 13.00 - 15.00 , 19.30 - 21.00</td></tr>';
print "\r\n";
}
?>
  </table>
  
	 </td>
   </tr>
 </table>
 

<p>
<a href="javascript:window.history.back()"><img src="../img/<?="$lang/$lang" ?>_back2.gif" border=0  alt="<?=$LDBackTxt ?>" align="absmiddle"></a>

<p>
</ul>

</FONT>

</td>
</tr>

<tr valign=top>
<td bgcolor="<? print $cfg['bot_bgcolor']; ?>" colspan=2> 
<?php
 // get a  page into an array and print it out
require("../language/".$lang."/".$lang."_copyrite.htm");
 ?>
</td>
</tr>
</table>        
&nbsp;

</BODY>
</HTML>
