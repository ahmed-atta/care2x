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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
$breakfile="edv.php?sid=".$sid."&lang=".$lang;

/* Establish db connection */
/* Establish db connection */
require('../include/inc_db_makelink.php');

if($link&&$DBLink_OK) 
{	
    $sql='SELECT * FROM care_users WHERE login_id="'.$itemname.'"';
	
	$ergebnis=mysql_query($sql,$link);
	
	if($ergebnis)
	{
	    if ($finalcommand=='delete')
		{	
			$sql='DELETE FROM care_users WHERE login_id="'.$itemname.'"';	
			
			if (mysql_query($sql,$link))
			{
				header("Location: edv_user_access_list.php?sid=$sid&lang=$lang&remark=itemdelete"); exit;
			}//else {echo "Löschen der Daten gescheitert."}
		}
		else 
		{$zeile=mysql_fetch_array($ergebnis);};
	}
}
  else { echo "$LDDbNoLink<br>$sql"; }
?>
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require('../include/inc_css_a_hilitebu.php');
?>
<script language="javascript">
<!-- 

function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?>>
<FONT    SIZE=-1  FACE="Arial">
<P>
<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDAccessRight $LDDelete"; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('edp.php','access','delete')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>

<p><br>
<center>
<table width=50% border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffdd"><font face=verdana,arial size=2>
<p>
<?php echo $LDSureDelete ?><p>

<table border="0" cellpadding="5" cellspacing="1">
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDName ?>:
</td><td><font face=verdana,arial size=2 color=#800000>
<?php
echo $zeile['name'];
?>
</td>
</tr>
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDUserId ?>:</td>
<td><font face=verdana,arial size=2 color=#800000>
<?php
echo $zeile['login_id'];
?>
</td>
</tr>
<tr>
<td align=right><font face=verdana,arial size=2 color=#000080><?php echo $LDPassword ?>:</td>
<td><font face=verdana,arial size=2 color=#800000>
<?php
echo $zeile['password'];
?>
</td>
</tr>
</table>

<br>
<FORM action="edv_user_access_delete.php" method="post">
<INPUT type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="finalcommand" value="delete">
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<INPUT type="submit" name="versand" value="<?php echo $LDYesDelete ?>"></font></FORM>

<FORM  method="get" action="edv_user_access_list.php" >
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<INPUT type="submit"  value="<?php echo $LDNoBack ?>"></font></FORM>

</center>

</td>
</tr>
</table>        

<p><br>

</td>
</tr>
</table>        

<p>
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>
</FONT>
</BODY>
</HTML>
