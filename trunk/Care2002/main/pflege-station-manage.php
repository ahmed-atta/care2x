<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_pflege_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_nursing.php");
require("../req/config-color.php"); // load color preferences

$breakfile="pflege.php?sid=$ck_sid&lang=$lang";



?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <script language="javascript" >
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

<? 
require("../req/css-a-hilitebu.php");
?>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<? if (!$cfg['dhtml']){ print 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?=$test ?>
<? //foreach($argv as $v) print "$v "; ?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp; <?=$LDNursingManage ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('nursing_ward_mng.php','main')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDCloseAlt ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>

  <p><br>
  <table border=0 cellpadding=5 >
    <tr>
      <td >&nbsp;</td>
      <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b><?=$LDProfile ?></b></td>
      <td >&nbsp;</td>
      <!-- <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b>Kommunikation</b></td> -->
    </tr>
    <tr>
      <td></td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 ><a href="pflege-station-new.php?sid=<?=$ck_sid ?>&mw=1<?="&station=$ck_thispc_station&name=$ck_thispc_dept" ?>"><b><?=$LDCreate ?></b></a><br>
	  		&nbsp;<?=$LDNewStation ?><p>
			<? if ($ck_thispc_station) $mode="show"; ?>
			<a href="pflege-station-info.php?sid=<?="$ck_sid&mode=$mode&station=$ck_thispc_station" ?>"><b><?=$LDShowStationData ?></b></a><br>
			<?=$LDShowStationDataTxt ?><p>
			<a href="ucons.php"><b><?=$LDLockBed ?></b></a><br>
			<?=$LDLockBedTxt ?><p>
			<a href="ucons.php"><b><?=$LDAccessRights ?></b></a><br>
			<?=$LDAccessRightsTxt ?>
			</td>
      <td></td>
      <!-- <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 >			
	  <a href="#"><b>Email Addresse</b></a><br>
			&nbsp;Stationsaddresse ändern<p>
<a href="#"><b>Antwort an:</b></a><br>
	  		&nbsp;Addresse ändern<p>
			<a href="#"><b>Unterschrift</b></a><br>
			&nbsp;Unterschift erstellen zum<br>
			&nbsp;anhängen an jedem <br>
			&nbsp;ausgehenden Email</td> -->
    </tr>
  </table>
  
</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=<? print $cfg['bot_bgcolor']; ?>  colspan=2>

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
