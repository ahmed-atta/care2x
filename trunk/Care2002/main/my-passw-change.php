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
$thisfile='my-passw-change.php';

if($n==$n2)
{
	$screenall=1;
	$fileforward="my-passw-change-update.php?sid=$sid&lang=$lang&userid=$userid&n=$n";
	if ($pass=='check') 	
		include('../include/inc_passcheck.php');
}
else $n_error=1;
?>

<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 
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
require('../include/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor']; if($mode!="pwchg") echo ' onLoad="document.pwchanger.userid.focus()"'; ?>>

<P>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor'];?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor'];?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;<?php echo $LDPWChange ?>
</STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<?php if($n_error) : ?><font face="verdana,arial" size=3 color="#990000">
<img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"> <?php echo $LDNewPwDiffer ?>
</font>
<?php endif ?>
<ul>

<?php if($mode=='pwchg') : ?>
<font face="verdana,arial" size=3 color="#009900">
	<img <?php echo createMascot('../','mascot1_r.gif','0','bottom') ?> align="absmiddle"><b><?php echo $LDPWChanged ?></b></font>
<?php else : ?>

<?php if (($pass=='check')&&$passtag) 
{
echo '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf=$title;

/*
switch($passtag)
{
case 1:$errbuf=$errbuf.$LDWrongEntry; echo '<img src=../img/'.$lang.'/'.$lang.'_cat-fe.gif >';break;
case 2:$errbuf=$errbuf.$LDNoAuth; echo '<img src=../img/'.$lang.'/'.$lang.'_cat-noacc.gif >';break;
default:$errbuf=$errbuf.$LDAuthLocked; echo '<img src=../img/'.$lang.'/'.$lang.'_cat-sperr.gif >'; 
}*/
switch($passtag)
{
case 1:$errbuf="$errbuf $LDWrongEntry"; print '<img '.createLDImgSrc('../','cat-fe.gif','0').'>';break;
case 2:$errbuf="$errbuf $LDNoAuth"; print '<img '.createLDImgSrc('../','cat-noacc.gif','0').'>';break;
default:$errbuf="$errbuf $LDAuthLocked"; print '<img '.createLDImgSrc('../','cat-sperr.gif','0').'>'; 
}

logentry($userid,$keyword,$errbuf,$thisfile,$fileforward);

echo '</STRONG></FONT><p>';

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
		<input type="hidden" name="sid" value="<?php echo $sid; ?>">
		<input type="hidden" name="lang" value="<?php echo $lang; ?>">
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
<a href="<?php echo $breakfile; ?>"><img <?php if($mode=='pwchg') echo createLDImgSrc('../','close2.gif','0'); else echo createLDImgSrc('../','cancel.gif','0'); ?>>
</a>
<p>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</BODY>
</HTML>
