<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","specials.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");
$breakfile="spediens.php?sid=$sid&lang=$lang";
$thisfile="my-passw-change.php";
if($n==$n2)
{
	$screenall=1;
	$fileforward="my-passw-change-update.php?sid=$sid&lang=$lang&userid=$userid&n=$n";
	if ($pass=="check") 	
		include("../include/inc_passcheck.php");
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
	if(d.n.value!=d.n2.value){ alert("<?php echo $LDAlertPwError ?>"); return false;}
	return true;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>
 
<?php
require("../include/inc_css_a_hilitebu.php");
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php print $cfg['bot_bgcolor']; if($mode!="pwchg") print ' onLoad="document.pwchanger.userid.focus()"'; ?>>

<P>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php print $cfg['top_bgcolor'];?>">
<FONT  COLOR="<?php print $cfg['top_txtcolor'];?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo $LDPWChange ?>
</STRONG></FONT>
</td>
<td bgcolor="<?php print $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])print'<a href="javascript:window.history.back()"><img src="../img/'.$lang.'/'.$lang.'_back2.gif" width=110 height=24 border=0  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img src="../img/<?php echo "$lang/$lang"; ?>_hilfe-r.gif" border=0 width=75 height=24  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img src="../img/<?php echo "$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])print'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php print $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<?php if($n_error) : ?><font face="verdana,arial" size=3 color="#990000">
<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"> <?php echo $LDNewPwDiffer ?>
</font>
<?php endif ?>
<ul>

<?php if($mode=="pwchg") : ?>
<font face="verdana,arial" size=3 color="#009900">
	<img src="../img/catr.gif" border=0 width=88 height=80 align="absmiddle"><b><?php echo $LDPWChanged ?></b></font>
<?php else : ?>

<?php if (($pass=="check")&&$passtag) 
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
<form method=post action=<?php echo $thisfile; ?> onSubmit="return pruf(this)" name="pwchanger">
<table  border=0 cellpadding="0" cellspacing=1 bgcolor=#666666>
<tr>
<td >

<table border="0" cellpadding="20" cellspacing="0" bgcolor=#ffffdd>
<tr>
<td><font face=verdana,arial size=2 color=#800000>
<p>
<b><?php echo $LDUserIdPWPrompt ?></b><p></font>
<font face=verdana,arial size=2 color=#000080><?php echo $LDUserId ?>:<br>
<input type="text" name="userid" size=25 maxlength=40 value="<?php echo $userid ?>"><br>
<?php echo $LDPassword ?>:<br>
<input type="password" name="keyword" size=25 maxlength=40><p>
<font face=verdana,arial size=2 color=#800000>
<b></b></font>
<p><?php echo $LDNewPwPrompt ?><br>
<input type="password" name="n" size=25 maxlength=40 value=""><br>
<?php echo $LDNewPw2 ?>:<br>
<input type="password" name="n2" size=25 maxlength=40 value="">
                            </td>
</tr>

<tr><td>
		<input type="hidden" name="sid" value="<?php print $sid; ?>">
		<input type="hidden" name="lang" value="<?php print $lang; ?>">
		<input type="hidden" name="mode" value="change">
 		<input type="hidden" name="pass" value="check">
 		<input type="submit" value="<?php echo $LDChangePw ?>"><p>
		<input type="reset" value="<?php echo $LDOops ?>"></td>
</tr>
</table>
</td>
</tr>
</table>
</form>
<?php endif ?>   
</ul>
<p><br>

</td>
</tr>
</table>        
<p>
<a href="<?php print $breakfile; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_<?php if($mode=="pwchg") print 'close2.gif'; else print 'cancel.gif'; ?>" width=103 height=24 border=0>
</a>
<p>
<?php
require("../language/$lang/".$lang."_copyrite.php");
 ?>
</BODY>
</HTML>
