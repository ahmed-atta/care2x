<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['radio'];

$fileforward="radiolog-xray-diagnosis-write.php?sid=$ck_sid&lang=$lang";

if($retpath=="read_diagnosis") $breakfile="radiolog-xray-diagnosis.php?sid=$ck_sid&lang=$lang";
 	else $breakfile="javascript:window.top.location.replace('radiolog-xray-javastart.php?sid=$ck_sid&lang=$lang&mode=display1')";
	
$thisfile="radiolog-xray-diagnosis-write-pass.php";

$userck="ck_radio_user";
//reset cookie;
setcookie($userck,"");

if($ck_login_logged&&$ck_login_userid&&!$nointern)
{
$userid=$ck_login_userid;
$checkintern=1;
$lognote="Direct access ".$lognote;
$pass="check";
}

if ($pass=="check") 	
	include("../req/passcheck.php");

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</HEAD>

<BODY  <? if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>



<center>

<FORM action="<? print $thisfile; ?>" method="post" name="passwindow">
<? if ((($userid!=NULL)||($keyword!=NULL))&&($passtag!=NULL)) 
{
print '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf=$LDWriteDiag;

switch($passtag)
{
case 1:$errbuf=$errbuf.$LDWrongEntry; print '<img src=../img/'.$lang.'/'.$lang.'_cat-fe.gif align=left>';break;
case 2:$errbuf=$errbuf.$LDNoAuth; print '<img src=../img/'.$lang.'/'.$lang.'_cat-noacc.gif align=left>';break;
default:$errbuf=$errbuf.$LDAuthLocked; print '<img src=../img/'.$lang.'/'.$lang.'_cat-sperr.gif align=left>'; 
}

logentry($userid,"PW ($keyword)","$REMOTE_ADDR $errbuf",$thisfile,$fileforward);

print '</STRONG></FONT>';

}
?>


<table  border=0 cellpadding=0 cellspacing=0>
<tr>
<? if(!$passtag) print'
<td>

<img src="../img/ned2r.gif" border=0 width=100 height=138 >
</td>
';
?>
<td bgcolor="#999999" valign=top>

<table cellpadding=1 bgcolor=#999999 cellspacing=0>
<tr>
<td>
<table cellpadding=20 bgcolor=#eeeeee >
<tr>
<td>




<font color=maroon size=3>
<b><?=$LDPwNeeded ?>!</b></font><p>
<font face="Arial,Verdana"  color="#000000" size=-1>
<nobr><?=$LDUserPrompt ?>:</nobr><br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1><nobr><?=$LDPwPrompt ?>:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type="hidden" name="pass" value="check">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="mode" value="<?=$mode ?>">
<input type="hidden" name="nointern" value="1">
<input type="image" src="../img/<?="$lang/$lang" ?>_continue.gif" border=0 width=110 height=24>
</font>
<p>
<a href="<?=$breakfile; ?>"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" border=0 width=103 height=24 alt="<?=$LDCancel ?>" align="absmiddle"></a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>        
</FORM>
<p><br>

</center>




</BODY>
</HTML>
