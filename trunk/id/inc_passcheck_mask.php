<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_front_chain_lang.php",$PHP_SELF)) 
	die("<meta http-equiv='refresh' content='0; url=../'>");
/*------end------*/
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<tr>
<td bgcolor=#333399 colspan=3><FONT    SIZE=3  FACE="Arial" color="#ffffff">
&nbsp;<!-- &nbsp;&nbsp;<?php echo $LDPwNeeded ?> -->
</td>
</tr>

<tr bgcolor="#DDE1EC">
<td bgcolor=#333399 width=1%><font size=1>&nbsp;</td>

<td>

<p><br>
<center>


<?php if (($pass=="check")&&($passtag)) 
{

print '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

switch($passtag)
{
case 1:$errbuf="$errbuf $LDWrongEntry"; print '<img src=../img/'.$lang.'/'.$lang.'_cat-fe.gif align=left>';break;
case 2:$errbuf="$errbuf $LDNoAuth"; print '<img src=../img/'.$lang.'/'.$lang.'_cat-noacc.gif align=left>';break;
default:$errbuf="$errbuf $LDAuthLocked"; print '<img src=../img/'.$lang.'/'.$lang.'_cat-sperr.gif align=left>'; 
}

print '</STRONG></FONT><P>';

logentry($userid,"PW ($keyword)","$REMOTE_ADDR $errbuf",$thisfile,$fileforward);

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
<p>
<FORM action="<?php print $thisfile; ?>" method="post" name="passwindow" onSubmit="return pruf(this);">
<font color=maroon size=3>
<b><?php echo $LDPwNeeded ?>!</b></font><p>
<font face="Arial,Verdana"  color="#000000" size=-1>
<nobr><?php echo $LDUserPrompt ?>:</nobr><br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1><nobr><?php echo $LDPwPrompt ?>:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type=hidden name=direction value="<?php print $direction; ?>">
<input type=hidden name="pass" value="check">
<input type="hidden" name="nointern" value="1">
<input type="hidden" name="sid" value="<?php print $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="<?php print $mode; ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">
<input type="hidden" name="title" value="<?php print $title; ?>">
<?php if(!$minimal) : ?>
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="pday" value="<?php print $pday; ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="ipath" value="<?php echo $ipath ?>">
<?php endif ?>
<?php if($c_flag) : ?>
<input type="hidden" name="cmonth" value="<?php echo $cmonth ?>">
<input type="hidden" name="cyear" value="<?php echo $cyear ?>">
<input type="hidden" name="cday" value="<?php print $cday; ?>">
<?php endif ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type="image"  src="../img/<?php echo "$lang/$lang" ?>_continue.gif" width=110 height=24 border=0></font></nobr>
</form>

<a href="<?php print $breakfile; ?>"><img src="../img/<?php echo "$lang/$lang" ?>_cancel.gif" width=103 height=24 border=0>
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


