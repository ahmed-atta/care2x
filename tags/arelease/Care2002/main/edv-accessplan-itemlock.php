<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_edvzugang_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_edp.php");

require("../req/config-color.php");
$breakfile="edv.php?sid=$ck_sid&lang=$lang";

require("../req/db-makelink.php");
if($link&&$DBLink_OK)  
{	
		$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$itemname.'"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{	$zeile=mysql_fetch_array($ergebnis);
								if ($finalcommand=="changelock")
								{	if ($zeile[mahopass_lockflag]) $newlockflag=0; else $newlockflag=1;
									$sql='UPDATE mahopass SET mahopass_lockflag='.$newlockflag.' WHERE mahopass_id="'.$itemname.'"';	
									if (mysql_query($sql,$link))
									{
							        header("Location: edv-accessplan-list.php?sid=$ck_sid&lang=$lang&remark=lockchanged"); exit;
									}//else {print "Ändern  der Daten gescheitert."}
								}else {};
							}
}
  else { print "$LDDbNoLink<br>$sql"; } 

?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? 
require("../req/css-a-hilitebu.php");
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

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<? print $cfg['bot_bgcolor'];?>>


<FONT    SIZE=-1  FACE="Arial">

<P>

<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <? print "$LDEDP $LDAccessRight ";  if($zeile[mahopass_lockflag]) print $LDUnlock; else print $LDLock; ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('edp.php','access','lock','<?=$zeile[mahopass_lockflag] ?>')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<? print $cfg['body_bgcolor'];?> colspan=2>


<p><br>
<center>


<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffdd"><font face=verdana,arial size=2>
<p>
<? if ($zeile[mahopass_lockflag]) 
print $LDSureUnlock; else print $LDSureLock; ?>?<p>

<table border="0" cellpadding="5" cellspacing="1">
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?=$LDName ?>:
</td><td><font face=verdana,arial size=2 color=#800000>
<?
print $zeile[mahopass_name];
?>
</td>
</tr>
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?=$LDUserId ?>:</td>
<td><font face=verdana,arial size=2 color=#800000>
<?
print $zeile[mahopass_id];
?>
</td>
</tr>
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?=$LDPassword ?>:</td>
<td><font face=verdana,arial size=2 color=#800000>
<?
print $zeile[mahopass_password];
?>
</td>
</tr>
</table>

<br>
<FORM action="edv-accessplan-itemlock.php" method="post">
<INPUT type="hidden" name="itemname" value="<? print $itemname ?>">
<input type="hidden" name="finalcommand" value="changelock">
<input type="hidden" name="sid" value="<? print $ck_sid;?>">
<input type="hidden" name="lang" value="<? print $lang;?>">
<INPUT type="submit" name="versand"  value="  <?=$LDYesSure ?>  "></font></FORM>

<FORM  method=get action="edv-accessplan-list.php" >
<input type="hidden" name="sid" value="<? print $ck_sid;?>">
<input type="hidden" name="lang" value="<? print $lang;?>">
<INPUT type="submit"  value="<?=$LDNoBack ?>"></font></FORM>

</center>

</td>
</tr>
</table>        

<p><br>

</td>
</tr>
</table>        

<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</FONT>


</BODY>
</HTML>
