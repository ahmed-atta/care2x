<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
$breakfile="edv.php?sid=".$sid."&lang=".$lang;

$thisfile="edv-accessplan-such.php";

if($mode)
{
	include('../include/inc_db_makelink.php');
	if($link&&$DBLink_OK) 
					{	$sql='SELECT * FROM mahopass WHERE mahopass_id LIKE "'.addslashes($name).'%" OR mahopass_name LIKE "'.addslashes($name).'%"';
						$ergebnis=mysql_query($sql,$link);
						if($ergebnis)
							{
											$rows=0;
											while($zeile=mysql_fetch_array($ergebnis)) $rows++;
											if($rows)
											{ mysql_data_seek($ergebnis,0);
											}
							}
	}
  	else { echo "$LDDbNoLink<br>$sql"; }
}

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
</script></HEAD>

<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?> onLoad="document.searchwin.name.select()">


<FONT    SIZE=-1  FACE="Arial">

<P>


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDAccessRight $LDSearch" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="javascript:gethelp('')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>

<p><br>
<ul>

<?php if(($mode=='search')&&($rows))
{
 echo '
				<table border=0 bgcolor=#999999 cellpadding=0 cellspacing=0>
				<tr><td>
				<table border="0" cellpadding="5" cellspacing="1">';
        echo "
					<tr bgcolor=#dddddd >";
		echo "
					<td colspan=8><FONT SIZE=1  FACE=verdana,Arial color=\"#800000\"><b>$LDActualAccess</b></td>";
        echo "
					</tr>"; 
        echo "	
					<tr bgcolor=#dfdfdf>";
		for($i=0;$i<sizeof($LDAccessIndex);$i++)
			echo "
			<td><FONT    SIZE=1  FACE=verdana,Arial><b>".$LDAccessIndex[$i]."</b></td>";
            echo "</tr>"; 

		while ($zeile=mysql_fetch_array($ergebnis))
		{  
			if($zeile[exc]) continue;
			 echo "
						<tr  bgcolor=#efefef>\n";
			echo "
						<td><FONT    SIZE=1  FACE=Arial>".$zeile[mahopass_name]."</td>\n
						<td><FONT    SIZE=1  FACE=Arial>".$zeile[mahopass_id]."</td>\n
						<td><FONT    SIZE=1  FACE=Arial>".$zeile[mahopass_password]."</td><td>\n";
			if ($zeile[mahopass_lockflag])
				   echo '
				   		<img src="../img/padlock.gif" border=0 width=12 height=15>'; else echo '<img src=../img/arrow-gr.gif width=12 height=12>';
			echo "
						</td>\n <td><FONT    SIZE=1  FACE=Arial>".
														$zeile[mahopass_area1]." ".
														$zeile[mahopass_area2]." ".
														$zeile[mahopass_area3]." ".
														$zeile[mahopass_area4]." ".
														$zeile[mahopass_area5]." ".
														$zeile[mahopass_area6]." ".
														$zeile[mahopass_area7]." ".
														$zeile[mahopass_area8]." ".
														$zeile[mahopass_area9]." ".
														$zeile[mahopass_area10].
														"</td>\n";
			echo "
					<td><FONT    SIZE=1  FACE=Arial> $zeile[mahopass_date] / $zeile[mahopass_time] </td>";
			echo "
					<td><FONT    SIZE=1  FACE=Arial>".$zeile[mahopass_encoder]."</td>";
            echo "
					<td><FONT    SIZE=1  FACE=verdana,Arial>
					<a href=edv_user_access_update.php?sid=$sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." title=\"$LDChange\"> $LDInitChange</a> \n
			<a href=edv_user_access_lock.php?sid=$sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." ";
			if ($zeile[mahopass_lockflag]) echo "title=\"$LDUnlock\" > $LDInitUnlock"; else echo "title=\"$LDLock\"> $LDInitLock";
			echo "</a> \n
			<a href=edv_user_access_delete.php?sid=$sid&lang=$lang&itemname=".str_replace(' ','+',$zeile[mahopass_id])." title=\"$LDDelete\">	$LDInitDelete</a> </td>";
			echo "</tr>";
        };
        echo "
					</table>
				</td></tr>
				</table>";
}
?>

<form method="post" action="<?php echo $thisfile; ?>" name="searchwin">
<table  border=1 cellpadding="20">
<tr>
<td bgcolor="#ffffdd"><font face=verdana,arial size=2 color=#800000>
<p>
<b><?php echo $LDKeywordPrompt ?></b><p>

<table border="0" cellpadding="5" cellspacing="1">
<tr>
<td><font face=verdana,arial size=2 color=#000080><?php echo "$LDName / $LDUserId" ?>:<br>
<input type="text" name="name" size=25 maxlength=40>
</td>
</tr>

<tr><td><input type="submit" value="<?php echo $LDSearch ?>"><p>
		<input type="reset" value="<?php echo $LDReset ?>"></td>
</tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<input type="hidden" name="mode" value="search">

</form>
</ul>
</td>
</tr>
</table>        

<p>

</td>
</tr>
</table>        
<br>

<FORM  method=get action="edv-accessplan-such-pass.php" >
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang;?>">
<INPUT type="submit"  value="<?php echo $LDCancel ?>"></FORM>
<p>

<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');?>


</FONT>


</BODY>
</HTML>
