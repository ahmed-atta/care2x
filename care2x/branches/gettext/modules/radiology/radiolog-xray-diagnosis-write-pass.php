<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require('../../include/helpers/inc_environment_global.php');

define('MODULE','radiology');
define('LANG_FILE_MODULAR','radiology.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
require_once($root_path.'global_conf/areas_allow.php');

$allowedarea=&$allow_area['radio'];

$fileforward='radiolog-xray-diagnosis-write.php?sid='.$sid.'&lang='.$lang;

if($retpath=='read_diagnosis') $breakfile='radiolog-xray-diagnosis.php?sid='.$sid.'&lang='.$lang;
 	else $breakfile="javascript:window.top.location.replace('radiolog-xray-javastart.php?sid=$sid&lang=$lang&mode=display1')";
	
$thisfile=basename(__FILE__);

$userck='ck_radio_user';
//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/helpers/inc_2level_reset.php'); setcookie(ck_2level_sid.$sid,'');

require($root_path.'include/helpers/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/helpers/inc_passcheck.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<html>
<HEAD>

</HEAD>

<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>



<center>

<FORM action="<?php echo $thisfile; ?>" method="post" name="passwindow">
<?php if ((($userid!=NULL)||($keyword!=NULL))&&($passtag!=NULL)) 
{
echo '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf=$LDWriteDiag;

switch($passtag)
{
case 1:$errbuf=$errbuf.$LDWrongEntry; echo '<img '.createLDImgSrc($root_path,'cat-fe.gif','0').' align=left>';break;
case 2:$errbuf=$errbuf.$LDNoAuth; echo '<img '.createLDImgSrc($root_path,'cat-noacc.gif','0').' align=left>';break;
default:$errbuf=$errbuf.$LDAuthLocked; echo '<img '.createLDImgSrc($root_path,'cat-sperr.gif','0').' align=left>'; 
}

//logentry($userid,"PW ($keyword)","$REMOTE_ADDR $errbuf",$thisfile,$fileforward);

echo '</STRONG></FONT>';

}
?>

<table  border=0 cellpadding=0 cellspacing=0>
<tr>
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
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="<?php echo $mode ?>">
<input type="hidden" name="nointern" value="1"><p>
<input type="image" <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>>&nbsp;&nbsp;
<a href="<?php echo $breakfile; ?>" class="button icon remove danger">Cancel</a>
</font></td>
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
