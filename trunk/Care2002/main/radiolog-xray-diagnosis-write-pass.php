<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define("LANG_FILE","stdpass.php");
define("NO_2LEVEL_CHK",1);
require("../include/inc_front_chain_lang.php");
require("../include/inc_config_color.php");
require("../global_conf/areas_allow.php");

$allowedarea=&$allow_area['radio'];

$fileforward="radiolog-xray-diagnosis-write.php?sid=$sid&lang=$lang";

if($retpath=="read_diagnosis") $breakfile="radiolog-xray-diagnosis.php?sid=$sid&lang=$lang";
 	else $breakfile="javascript:window.top.location.replace('radiolog-xray-javastart.php?sid=$sid&lang=$lang&mode=display1')";
	
$thisfile="radiolog-xray-diagnosis-write-pass.php";

$userck="ck_radio_user";
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,"");
require("../include/inc_2level_reset.php"); setcookie(ck_2level_sid.$sid,"");

require("../include/inc_passcheck_internchk.php");
if ($pass=="check") 	
	include("../include/inc_passcheck.php");

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</HEAD>

<BODY  <?php if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>



<center>

<FORM action="<?php print $thisfile; ?>" method="post" name="passwindow">
<?php if ((($userid!=NULL)||($keyword!=NULL))&&($passtag!=NULL)) 
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
<?php if(!$passtag) print'
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
<b><?php echo $LDPwNeeded ?>!</b></font><p>
<font face="Arial,Verdana"  color="#000000" size=-1>
<nobr><?php echo $LDUserPrompt ?>:</nobr><br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1><nobr><?php echo $LDPwPrompt ?>:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type="hidden" name="pass" value="check">
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="hidden" name="lang" value="<?php print $lang; ?>">
<input type="hidden" name="mode" value="<?php echo $mode ?>">
<input type="hidden" name="nointern" value="1">
<input type="image" src="../img/<?php echo "$lang/$lang" ?>_continue.gif" border=0 width=110 height=24>
</font>
<p>
<a href="<?php echo $breakfile; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" border=0 width=103 height=24 alt="<?php echo $LDCancel ?>" align="absmiddle"></a>
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
