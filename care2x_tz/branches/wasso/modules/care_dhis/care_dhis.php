<?php
session_start();
?>
<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top><td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;&nbsp;&nbsp;DHIS Care2x Import Export</STRONG></FONT></td>
</tr>
<tr><td valign="top"><?php include('./gui/care_dhis_gui.php'); ?></td></tr>
<tr>
  <td valign="top" bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10%"><strong><font color="#990066" size="4"><?php if ($_SERVER['REQUEST_METHOD'] == "POST") { print "You have successfully Export data , <a href='./Export.zip'>Click here to download the file</a> "; } ?></font></strong></td>
</tr>
</table>
