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
$breakfile="edv-system-admi-menu.php?sid=".$sid."&lang=".$lang;
$thisfile="edv_system_format_date.php";

include('../include/inc_db_makelink.php');
if($link&&$DBLink_OK) 
{	
   if(($mode=='save')&&($date_format!="")&&(eregi($date_format,$validator)))
   {
      $sql="UPDATE care_global_config SET date_format='".$date_format."'";
	  $date_result=mysql_query($sql,$link);
	  if(mysql_affected_rows($link))
      {
	    $new_date_ok=1;
      }
	  else
	  {
	    $new_date_ok=0;
      }
   }
  else
  {
    $sql="SELECT date_format FROM care_global_config WHERE 1";
	  $date_result=mysql_query($sql,$link);
	  if(mysql_num_rows($date_result))
      {
	    $df=mysql_fetch_array($date_result);
		$date_format=$df['date_format'];
      }
  }
}
else { echo "$LDDbNoLink<br> $sql<br>"; }
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
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


<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDSystemAdmin" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<br><ul>
<FONT    SIZE=2  FACE="verdana,Arial">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<?php echo $LDSetDateFormat ?> </FONT><FONT    SIZE=3 color=#800000 FACE="Arial"><p>
<?php
if(($mode=='save')&&$new_date_ok) echo '<img '.createMascot('../','mascot1_r.gif','0','bottom').'> '.$LDNewDateFormatSaved.'<p>';
echo $LDSelectDateFormat;
?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<form action="<?php echo $thisfile ?>" method="get">
<table border=0 cellspacing=1 cellpadding=5>  
<?php 
for($i=0;$i<sizeof($LDDateFormats);$i++)
{
  echo '<tr>
    <td bgcolor="#e9e9e9"><input type="radio" name="date_format" value="'.$LDDateFormats[$i].'"';
  if($date_format==$LDDateFormats[$i]) echo " checked";
  echo '></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b>';
  $dfbuffer="LD_".strtr($LDDateFormats[$i],".-/","phs");
  echo $$dfbuffer;
  echo '</b> </FONT></td>
	<td><FONT   FACE="verdana,arial" size=2>'.$LDDateFormatsTxt[$i].'<br></td>  
	</tr>';
}
?>
</table>
<p>
<input type="image" <?php echo createLDImgSrc('../','apply.gif','0') ?>>&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>></a>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="validator" value="<?php for($i=0;$i<sizeof($LDDateFormats);$i++) echo $LDDateFormats[$i]."_"; ?>">
</form>

</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require("../language/$lang/".$lang."_copyrite.php");
?>

</FONT>
</BODY>
</HTML>
