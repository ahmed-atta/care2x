<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_specials.php");
require("../req/config-color.php");
$breakfile="spediens.php?sid=$ck_sid&lang=$lang";
$thisfile="my-passw-change.php";
if($n==$n2)
{
	$screenall=1;
	$fileforward="my-passw-change-update.php?sid=$ck_sid&lang=$lang&userid=$userid&n=$n";
	if ($pass=="check") 	
		include("../req/passcheck.php");
}
else $n_error=1;
?>

<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 
<script language=javascript>
function pruf(d)
{
	return true;
	if((d.userid.value=="")||(d.keyword.value=="")||(d.n.value=="")||(d.n2.value=="")) return false;
	if(d.n.value!=d.n2.value){ alert("<?=$LDAlertPwError ?>"); return false;}
	return true;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?=$lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>
 
<?
require("../req/css-a-hilitebu.php");
?>
 
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<? print $cfg['bot_bgcolor']; if($mode!="pwchg") print ' onLoad="document.pwchanger.userid.focus()"'; ?>>

<P>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<? print $cfg['top_bgcolor'];?>">
<FONT  COLOR="<? print $cfg['top_txtcolor'];?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?=$LDPWChange ?>
</STRONG></FONT>
</td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('')"><img src="../img/<?="$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?print $breakfile;?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?=$LDClose ?>"  <?if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<? if($n_error) : ?><font face="verdana,arial" size=3 color="#990000">
<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"> <?=$LDNewPwDiffer ?>
</font>
<? endif ?>
<ul>

<? if($mode=="pwchg") : ?>
<font face="verdana,arial" size=3 color="#009900">
	<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"><b><?=$LDPWChanged ?></b></font>
<? else : ?>

<? if (($pass=="check")&&$passtag) 
{
print '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf=$title;


switch($passtag)
{
case 1:$errbuf=$errbuf.$LDWrongEntry; print '<img src=../img/'.$lang.'/'.$lang.'_cat-fe.gif >';break;
case 2:$errbuf=$errbuf.$LDNoAuth; print '<img src=../img/'.$lang.'/'.$lang.'_cat-noacc.gif >';break;
default:$errbuf=$errbuf.$LDAuthLocked; print '<img src=../img/'.$lang.'/'.$lang.'_cat-sperr.gif >'; 
}

logentry($userid,$keyword,$errbuf,$thisfile,$fileforward);

print '</STRONG></FONT>';

}
?>

<br>
<form method=post action=<?print $thisfile; ?> onSubmit="return pruf(this)" name="pwchanger">
<table  border=0 cellpadding="0" cellspacing=1 bgcolor=#666666>
<tr>
<td >

<table border="0" cellpadding="20" cellspacing="0" bgcolor=#ffffdd>
<tr>
<td><font face=verdana,arial size=2 color=#800000>
<p>
<b><?=$LDUserIdPWPrompt ?></b><p></font>
<font face=verdana,arial size=2 color=#000080><?=$LDUserId ?>:<br>
<input type="text" name="userid" size=25 maxlength=40 value="<?=$userid ?>"><br>
<?=$LDPassword ?>:<br>
<input type="password" name="keyword" size=25 maxlength=40><p>
<font face=verdana,arial size=2 color=#800000>
<b></b></font>
<p><?=$LDNewPwPrompt ?><br>
<input type="password" name="n" size=25 maxlength=40 value="<?=$n ?>"><br>
<?=$LDNewPw2 ?>:<br>
<input type="password" name="n2" size=25 maxlength=40 value="">
                            </td>
</tr>

<tr><td>
		<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
		<input type="hidden" name="lang" value="<? print $lang; ?>">
		<input type="hidden" name="mode" value="change">
 		<input type="hidden" name="pass" value="check">
 		<input type="submit" value="<?=$LDChangePw ?>"><p>
		<input type="reset" value="<?=$LDOops ?>"></td>
</tr>
</table>
</td>
</tr>
</table>
</form>


<? endif ?>


       
</ul>
<p><br>

</td>
</tr>
</table>        

<p>
<a href="<? print $breakfile; ?>"><img src="../img/<?="$lang/$lang" ?>_<? if($mode=="pwchg") print 'close2.gif'; else print 'cancel.gif'; ?>" width=103 height=24 border=0>
</a>
<p>

<?php
require("../language/$lang/".$lang."_copyrite.htm");
 ?>

</BODY>
</HTML>
