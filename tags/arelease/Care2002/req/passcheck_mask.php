<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<tr>
<td bgcolor=#333399 colspan=3><FONT    SIZE=3  FACE="Arial" color="#ffffff">
&nbsp;<!-- &nbsp;&nbsp;<?=$LDPwNeeded ?> -->
</td>
</tr>

<tr bgcolor="#DDE1EC">
<td bgcolor=#333399 width=1%><font size=1>&nbsp;</td>

<td>

<p><br>
<center>


<? if (($pass=="check")&&($passtag)) 
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
<FORM action="<? print $thisfile; ?>" method="post" name="passwindow" onSubmit="return pruf(this);">
<font color=maroon size=3>
<b><?=$LDPwNeeded ?>!</b></font><p>
<font face="Arial,Verdana"  color="#000000" size=-1>
<nobr><?=$LDUserPrompt ?>:</nobr><br></font>
<INPUT type="text" name="userid" size="14" maxlength="25"> <p>
<font face="Arial,Verdana"  color="#000000" size=-1><nobr><?=$LDPwPrompt ?>:</font><br>
<INPUT type="password" name="keyword" size="14" maxlength="25"> 
<input type=hidden name=direction value="<? print $direction; ?>">
<input type=hidden name="pass" value="check">
<input type="hidden" name="nointern" value="1">
<input type="hidden" name="sid" value="<? print $ck_sid; ?>">
<input type="hidden" name="lang" value="<?=$lang ?>">
<input type="hidden" name="mode" value="<? print $mode; ?>">
<input type="hidden" name="target" value="<?=$target ?>">
<input type="hidden" name="title" value="<? print $title; ?>">
<? if(!$minimal) : ?>
<input type="hidden" name="dept" value="<?=$dept ?>">
<input type="hidden" name="retpath" value="<?=$retpath ?>">
<input type="hidden" name="edit" value="<?=$edit ?>">
<input type="hidden" name="pmonth" value="<?=$pmonth ?>">
<input type="hidden" name="pyear" value="<?=$pyear ?>">
<input type="hidden" name="pday" value="<? print $pday; ?>">
<input type="hidden" name="station" value="<?=$station ?>">
<input type="hidden" name="ipath" value="<?=$ipath ?>">
<? endif ?>
<? if($c_flag) : ?>
<input type="hidden" name="cmonth" value="<?=$cmonth ?>">
<input type="hidden" name="cyear" value="<?=$cyear ?>">
<input type="hidden" name="cday" value="<? print $cday; ?>">
<? endif ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type="image"  src="../img/<?="$lang/$lang" ?>_continue.gif" width=110 height=24 border=0></font></nobr>
</form>

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


