<?
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)||!$ck_intra_email_user) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_intramail.php");
require("../req/config-color.php"); // load color preferences

$thisfile="intra-email-options.php";
$breakfile="intra-email.php.?sid=$ck_sid&lang=$lang&mode=listmail";

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <script language="javascript" >
<!-- 

function submitForm(r)
{
	d=document.mailform;
	d.reply.value=r;
	d.submit();
}

function printer_v()
{
<?		$buf="&s_stamp=$content[send_stamp]&from=$content[sender]&date=".strtr($content[send_dt]," ","+")."&folder=$folder";
?>
	urlholder="intra-email-printer.php?sid=<? print "$ck_sid&lang=$lang$buf"; ?>";
	printwin=window.open(urlholder,"printwin","width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	//window.location.href=urlholder
	}
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
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" height="30"><FONT  COLOR="<? print $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?="$LDIntraEmail - $LDOptions" ?></STRONG></FONT></td>
<td bgcolor="<? print $cfg['top_bgcolor']; ?>" align=right><a href="javascript:history.back();"><img src="../img/<?="$lang/$lang" ?>_back2.gif" border=0 width=110 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="javascript:gethelp()"><img src="../img/<?="$lang/$lang" ?>_hilfe-r.gif" border=0 width=75 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?=$breakfile ?>"><img src="../img/<?="$lang/$lang" ?>_close2.gif" border=0 width=103 height=24 align="absmiddle" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<? print $cfg['body_bgcolor']; ?> valign=top colspan=2>

<FONT face="Verdana,Helvetica,Arial" size=2>
<?
 print '
<FONT face="Verdana,Helvetica,Arial" size=2>
  &nbsp; <b><a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=listmail">'.$LDInbox.'</a> | <a href="intra-email.php?sid='.$ck_sid.'&lang='.$lang.'&mode=compose">'.$LDNewEmail.'</a> | <a href="intra-email-addrbook.php?sid='.$ck_sid.'&lang='.$lang.'&mode='.$mode.'&folder='.$folder.'">'.$LDAddrBook.'</a> | '.$LDOptions.' | <a href="javascript:gethelp()">'.$LDHelp.'</a></b>
  <hr color=#000080>
   &nbsp; <FONT  color="#800000">'.$ck_intra_email_user.'</font>
   ';
// ******************************** Read email ***************************************
 
?>
  <p>
  <table border=0 cellpadding=5 >
    <tr>
      <td >&nbsp;</td>
      <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b><?=$LDUrInfo ?></b></td>
      <td >&nbsp;</td>
      <td bgcolor="#0066aa"><FONT face="Verdana,Helvetica,Arial" size=2 color="#ffffff"><b><?=$LDEmailProc ?></b></td>
    </tr>
    <tr>
      <td></td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 ><a href="#"><b><?=$LDProfile ?></b></a><br>
	  		&nbsp;<?=$LDProfileTxt ?><p>
			<a href="#"><b><?=$LDPassword ?></b></a><br>
			&nbsp; <?=$LDPasswordChange ?><p>
			<a href="#"><b><?=$LDSecretQ ?></b></a><br>
			&nbsp;<?=$LDSecretQChange ?><p>
			<a href="#"><b><?=$LDMemberDir ?></b></a><br>
			&nbsp;<?=$LDMemberDirTxt ?></td>
      <td></td>
      <td valign=top><FONT face="Verdana,Helvetica,Arial" size=2 ><a href="#"><b><?=$LDReply2 ?>:</b></a><br>
	  		&nbsp;<?=$LDReply2Txt ?><p>
			<a href="#"><b><?=$LDEmailAddr ?></b></a><br>
			&nbsp;<?=$LDEmailAddrChange ?><p>
			<a href="#"><b><?=$LDSignature ?></b></a><br>
			&nbsp;<?=$LDSignatureTxt ?></td>
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
