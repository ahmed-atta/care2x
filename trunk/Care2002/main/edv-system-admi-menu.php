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
setcookie(ck_edvzugang_user,$ck_edv_admin_user);
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
<?php echo $LDWelcome ?> <FONT    SIZE=3 color=#800000 FACE="Arial"><b><?php echo $HTTP_COOKIE_VARS[$local_user.$sid];?></b></font>. <p>
<?php echo $LDForeWord ?></font><p>
<FONT    SIZE=-1  FACE="Arial">
<table border=0 cellspacin=1 cellpadding=3>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="edv_user_access_edit.php?sid=<?php echo $sid."&lang=$lang&src=sysadmin" ?>"><?php echo "$LDManageAccess - $LDManage" ?></a></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="../phpmyadmin/index.php3?sid=<?php echo $sid."&lang=$lang" ?>"><?php echo $LDMySQLManage ?></a></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="edv_system_format_date.php?sid=<?php echo $sid."&lang=$lang" ?>"><?php echo $LDSetDateFormat ?></a></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9" valign="top"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDCurrencyAdmin ?></b> </FONT><br>
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon('../','redpfeil.gif','0','absmiddle') ?>> <a href="edv_system_format_currency_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>"><?php echo $LDSetCurrency ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon('../','redpfeil.gif','0','absmiddle') ?>> <a href="edv_system_format_currency_add.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>"><?php echo $LDAddCurrency ?></a>
	</td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDSpexFunctions ?></a></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon('../','update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="newscolumns.php?sid=<?php echo $sid."&lang=$lang&target=edp&title=$LDEDP" ?>"><?php echo $LDNewsTxt ?></a></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img src="../gui/img/common/default/update.gif" border=0 width=19 height=19 align="absmiddle"></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="ucons.php<?php echo "?lang=$lang" ?>"><?php echo $LDMemoTxt ?></a></b> </FONT></td>
  </tr>
</table>

<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc('../','cancel.gif','0') ?>></a>
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
