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
define("LANG_FILE","abteilung.php");
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');

require_once('../include/inc_config_color.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDOpenHrsTxt ?></TITLE>

<?php
require('../include/inc_css_a_hilitebu.php');
?>
<script language="">
<!-- Script Begin
function gethelp(x)
{
	urlholder="help-router.php?helpidx="+x+"&lang=<?php echo $lang ?>";
	helpwin=window.open(urlholder,"helpwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
//  Script End -->
</script>
</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } 
?> >

<table width=100% border=0 cellspacing=0 cellpadding="0" height=100%>

<tr valign=top height=45>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" >
	<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+3  FACE="Arial">
	<STRONG>&nbsp; &nbsp; <?php echo $LDOpenHrsTxt ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="#" onClick=history.back()><img '.createLDImgSrc('../','back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>';?><a href="javascript:gethelp()"><img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="startframe.php?sid=<?php echo "$sid&lang=$lang";?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">

	<table border=0 cellspacing=0 cellpadding=0>
   <tr>
     <td bgcolor=#999999>
	 <table border=0 cellspacing=1 cellpadding=5>
    <tr bgcolor=#ffffff>
      <td><font face="Verdana,arial" size=2><b><?php echo $LDDayTxt ?></b></font></td>
	  <td><font face="Verdana,arial" size=2><b><?php echo $LDOpenHrsTxt ?></b></font></td>
      <td><font face="Verdana,arial" size=2><b><?php echo $LDChkHrsTxt ?></b></font></td>
    </tr>
	<?php for ($i=0;$i<sizeof($LDOpenDays);$i++){
echo '<tr bgcolor="#ffffff"><td><font face=verdana,arial size=2> '.$LDOpenDays[$i].'</td><td><font face=verdana,arial size=2><nobr>  '.$LDOpenTimes[$i].'</td><td><font face=verdana,arial size=2><nobr> '.$LDVisitTimes[$i].'</td></tr>';
echo "\r\n";
}
?>
  </table>
  
	 </td>
   </tr>
 </table>
 

<p>
<a href="javascript:window.history.back()"><img <?php echo createLDImgSrc('../','back2.gif','0') ?>  alt="<?php echo $LDBackTxt ?>"></a>

<p>
</ul>
</FONT>
</td>
</tr>
<tr valign=top>
<td bgcolor="<?php echo $cfg['bot_bgcolor']; ?>" colspan=2> 
<?php
if(file_exists('../language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');
?>
</td>
</tr>
</table>        
&nbsp;
</BODY>
</HTML>
