<? 
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
if (!$sid||($sid!=$ck_sid)) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require("../language/".$lang."/lang_".$lang."_stdpass.php");
require("../req/config-color.php");

$allowedarea="System_Admin,alle";
$fileforward="medlager.php";
$thisfile="medlager-bestellbot-pass.php";
$breakfile="medlager.php?sid=$ck_sid&lang=$lang";
$title=$LDMediBotActivate;

$userck="ck_medlager_user";
//reset cookie;
setcookie($userck,"");

if($ck_login_logged&&$ck_login_userid&&!$nointern)
{
 header("location: passcheck-intern.php?sid=$ck_sid&lang=$lang&allowedarea=$allowedarea&fileforward=$fileforward%sid=$ck_sid~lang=$lang~stb=1&retfilepath=$thisfile&a_info=Pharma+Orderbot&internck=$userck");
 exit;
}

require("../req/pass-f2f.php"); // loads the validarea and logentry functions

if ($versand=="Abschicken")
{
	include("../req/db-makelink.php");
		if($link&&$DBLink_OK)  
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id="'.$userid.'"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{$zeile=mysql_fetch_array($ergebnis);
								if (($zeile[mahopass_password]==$keyword)&&($zeile[mahopass_id]==$userid))
								{	
									if (!($zeile[mahopass_lockflag]))
									{
										if (validarea($allowedarea,$zeile,mysql_num_fields($ergebnis)))
										{				
										setcookie($userck,$zeile[mahopass_name]);	
										//setcookie(ck_apo_src,"bestellbotpass");	
										logentry($zeile[mahopass_name],"*","IP:".$REMOTE_ADDR."Meddepot Bestellbot Launch OK'd",$thisfile,$fileforward);
										header("Location: $fileforward?sid=$ck_sid&lang=$lang&stb=1");
										exit;
										}else {$passtag=2;};
									}else $passtag=3;
								}else {$passtag=1;};
							}
							else {$passtag=1;};
		}
  		 else { print "$LDDbNoLink<br>"; } 
}



?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 
 <? 
require("../req/css-a-hilitebu.php");
?>
 
</HEAD>

<BODY  <? if (!$nofocus) print 'onLoad="document.passwindow.userid.focus()"'; print  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ print ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT    SIZE=-1  FACE="Arial">

<P>
<FONT  COLOR="<?=$cfg[top_txtcolor] ?>"   SIZE=5  FACE="verdana"> <b><?=$title ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 
<tr>
<td colspan=3><FONT   SIZE=2  FACE="verdana,Arial"><br></td>
</tr>

<tr>
<td bgcolor=#333399 colspan=3>
<FONT   SIZE=1  FACE="Arial"><STRONG>&nbsp;</STRONG></FONT>
</td>
</tr>

<tr bgcolor="#DDE1EC">
<td bgcolor=#333399><font size=1>&nbsp;</td>

<td>

<p><br>
<center>


<? if ((($userid!=NULL)||($keyword!=NULL))&&($passtag!=NULL)) 
{
print '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

$errbuf=$title;

switch($passtag)
{
case 1:$errbuf=$errbuf.$LDWrongEntry; print '<img src=../img/'.$lang.'/'.$lang.'_cat-fe.gif align=left>';break;
case 2:$errbuf=$errbuf.$LDNoAuth; print '<img src=../img/'.$lang.'/'.$lang.'_cat-noacc.gif align=left>';break;
default:$errbuf=$errbuf.$LDAuthLocked; print '<img src=../img/'.$lang.'/'.$lang.'_cat-sperr.gif align=left>'; 
}


logentry($userid,$keyword,$errbuf,$thisfile,$fileforward);


print '</STRONG></FONT><P>';

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

<p>
<FORM action="<? print $thisfile; ?>" method="post" name="passwindow">

<font color=maroon size=3>
<b><?=$LDPwNeeded ?>!</b></font><p>
<font face="Arial,Verdana"  color="#000000" size=-1>
<nobr><?=$LDUserPrompt ?>:</nobr><br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1><nobr><?=$LDPwPrompt ?>:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type="hidden" name="versand" value="Abschicken">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<? print $lang; ?>">
<input type="hidden" name="mode" value="<?=$mode ?>">
<input type="hidden" name="nointern" value="1">
<input type="image" src="../img/<?="$lang/$lang" ?>_continue.gif" border=0 width=110 height=24>
</font>
</FORM>
<a href="<? print $breakfile; ?>"><img src="../img/<?="$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0>
</a>

</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>        

<p><br>

</center>

</td>
<td bgcolor=#333399><font size=1>&nbsp;</td>
</tr>

<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>


</table>        

<p>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDIntro2 $LDMedibot $title " ?></a><br>
<img src="../img/varrow.gif" width="20" height="15"> <a href="ucons.php"><?="$LDWhat2Do $LDMedibot $title " ?>?</a><br>
<HR>
<p>

<?php
// write the copyright thing
require("../req/copyrite.php");
 ?>


</FONT>


</BODY>
</HTML>
