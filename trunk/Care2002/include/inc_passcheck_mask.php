<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_passcheck_mask.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
?>
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


<?php if (isset($pass)&&($pass=='check')&&($passtag)) 
{

print '<FONT  COLOR="red"  SIZE=+2  FACE="Arial"><STRONG>';

switch($passtag)
{
case 1:$errbuf="$errbuf $LDWrongEntry"; print '<img '.createLDImgSrc($root_path,'cat-fe.gif','0','left').'>';break;
case 2:$errbuf="$errbuf $LDNoAuth"; print '<img '.createLDImgSrc($root_path,'cat-noacc.gif','0','left').'>';break;
default:$errbuf="$errbuf $LDAuthLocked"; print '<img '.createLDImgSrc($root_path,'cat-sperr.gif','0','left').'>'; 
}

print '</STRONG></FONT><P>';

logentry($userid,"PW ($keyword)","$REMOTE_ADDR $errbuf",$thisfile,$fileforward);

}
?>

<table  border=0 cellpadding=0 cellspacing=0>
<tr>
<?php if(!$passtag) print'
<td>

<img '.createMascot($root_path,'mascot3_r.gif','0').'>
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
<?php 
if($not_trans_id) { 
	echo '<input type="hidden" name="sid" value="'.$sid.'">';
} ?>
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="<?php print $mode; ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">
<input type="hidden" name="subtarget" value="<?php echo $subtarget ?>">
<input type="hidden" name="user_origin" value="<?php echo $user_origin ?>">
<input type="hidden" name="title" value="<?php print $title; ?>">
<?php if(!isset($minimal) || !$minimal) : ?>
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="pday" value="<?php print $pday; ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="ipath" value="<?php echo $ipath ?>">
<?php endif ?>
<?php if(isset($c_flag)&&$c_flag) : ?>
<input type="hidden" name="cmonth" value="<?php echo $cmonth ?>">
<input type="hidden" name="cyear" value="<?php echo $cyear ?>">
<input type="hidden" name="cday" value="<?php print $cday; ?>">
<?php endif ?>
</font></nobr><p>
<INPUT type="image"  <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php print $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>>
</a>
</form>

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


