<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_passcheck_mask.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(empty($maskBorderColor)) $maskBorderColor='#333399';
?>
<tr>
<td bgcolor="<?php echo $maskBorderColor ?>" colspan=3><FONT    SIZE=3  FACE="Arial" color="#ffffff">
&nbsp;<!-- &nbsp;&nbsp;<?php echo $LDPwNeeded ?> -->
</td>
</tr>

<tr bgcolor="#DDE1EC">
<td bgcolor="<?php echo $maskBorderColor ?>" width=1%><font size=1>&nbsp;</td>

<td>

<p><br>
<center>


<?php if (isset($pass)&&($pass=='check')&&($passtag)) 
{

switch($passtag)
{
	case 1:$errbuf="$errbuf $LDWrongEntry"; 
				$err_msg="$LDWrongEntry<br><font size=2 color=\"#000000\">$LDPlsTryAgain</font>";
				//echo '<img '.createLDImgSrc($root_path,'cat-fe.gif','0','left').'>';
				break;
	case 2:$errbuf="$errbuf $LDNoAuth"; 
				$err_msg="$LDNoAuth<br><font size=2 color=\"#000000\">$LDPlsContactEDP</font>";
				//echo '<img '.createLDImgSrc($root_path,'cat-noacc.gif','0','left').'>';
				break;
	default:$errbuf="$errbuf $LDAuthLocked"; 
				$err_msg="$LDAuthLocked<br><font size=2 color=\"#000000\">$LDPlsContactEDP</font>";
				//echo '<img '.createLDImgSrc($root_path,'cat-sperr.gif','0','left').'>'; 
}

logentry($userid,"PW ($keyword)","$REMOTE_ADDR $errbuf",$thisfile,$fileforward);

?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0') ?>></td>
    <td align="center"><FONT  COLOR="#cc0000"  SIZE=+2  FACE="Arial"><STRONG><?php echo $err_msg ?></STRONG></FONT></td>
  </tr>
</table>

<?php
}
?>


<table  border=0 cellpadding=0 cellspacing=0>
<tr>
<?php if(!$passtag) echo '
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
<FORM action="<?php echo $thisfile; ?>" method="post" name="passwindow" onSubmit="return pruf(this);">
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
<input type="hidden" name="mode" value="<?php echo $mode; ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">
<input type="hidden" name="subtarget" value="<?php echo $subtarget ?>">
<input type="hidden" name="user_origin" value="<?php echo $user_origin ?>">
<input type="hidden" name="title" value="<?php echo $title; ?>">
<input type="hidden" name="fwd_nr" value="<?php echo $fwd_nr; ?>">
<?php if(!isset($minimal) || !$minimal) { ?>
<input type="hidden" name="dept" value="<?php echo $dept ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
<input type="hidden" name="retpath" value="<?php echo $retpath ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="pmonth" value="<?php echo $pmonth ?>">
<input type="hidden" name="pyear" value="<?php echo $pyear ?>">
<input type="hidden" name="pday" value="<?php print $pday; ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="ward_nr" value="<?php echo $ward_nr ?>">
<input type="hidden" name="ipath" value="<?php echo $ipath ?>">
<?php } ?>
<?php if(isset($c_flag)&&$c_flag) { ?>
<input type="hidden" name="cmonth" value="<?php echo $cmonth ?>">
<input type="hidden" name="cyear" value="<?php echo $cyear ?>">
<input type="hidden" name="cday" value="<?php echo $cday; ?>">
<?php } ?>
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
<td bgcolor="<?php echo $maskBorderColor ?>"><font size=1>&nbsp;</td>
</tr>

<tr >
<td bgcolor="<?php echo $maskBorderColor ?>" colspan=3><font size=1>
&nbsp; 
</td>
</tr>


</table>      


