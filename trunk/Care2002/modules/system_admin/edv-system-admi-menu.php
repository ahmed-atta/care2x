<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
if(isset($ck_edv_admin_user)) setcookie('ck_edvzugang_user',$ck_edv_admin_user);
$breakfile='edv.php'.URL_APPEND;
require_once($root_path.'include/inc_config_color.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>
<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>
<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['bot_bgcolor'];?>>
<table width=100% border=0 cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="45"><FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> <?php echo "$LDEDP $LDSystemAdmin" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
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
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="edv_user_access_edit.php?sid=<?php echo $sid."&lang=$lang&src=sysadmin" ?>"><?php echo "$LDManageAccess - $LDManage" ?></a></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
 	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="../phpmyadmin/index.php3?sid=<?php echo $sid."&lang=$lang" ?>"><?php echo $LDMySQLManage ?></a></b> </FONT></td>
<!--  	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="phpmyadmin-start.php?sid=<?php echo $sid."&lang=$lang" ?>"><?php echo $LDMySQLManage ?></a></b> </FONT></td>
 -->  
  </tr>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="edv_system_format_date.php?sid=<?php echo $sid."&lang=$lang" ?>"><?php echo $LDSetDateFormat ?></a></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9" valign="top"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDCurrencyAdmin ?></b> </FONT><br>
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="edv_system_format_currency_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>"><?php echo $LDSetCurrency ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="edv_system_format_currency_add.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>"><?php echo $LDAddCurrency ?></a>
	</td>
  </tr>

  <tr>
	<td bgcolor="#e9e9e9" valign="top"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDConfigOptions;  ?></b> </FONT><br>
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="edv_system_menu_main_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>"><?php echo  $LDMainMenuItems?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="edv_system_menu_main_display_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>"><?php echo $LDMainMenuDisplay ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="edv_system_forms_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>"><?php echo $LDDataEntryForms ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="edv_system_controls_theme.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>"><?php echo $LDControlButImg ?></a>
	</td>
  </tr>
 
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="<?php echo $root_path; ?>modules/dept_admin/dept_manage.php<?php echo URL_APPEND; ?>"><?php echo $LDDeptAdmin ?></a></b> </FONT></td>
  </tr>
<!--  
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDSpexFunctions ?></a></b> </FONT></td>
  </tr>
   <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="<?php echo $root_path; ?>/modules/news/newscolumns.php?sid=<?php echo $sid."&lang=$lang&target=edp&title=$LDEDP" ?>"><?php echo $LDNewsTxt ?></a></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><img <?php echo createComIcon($root_path,'update.gif','0','absmiddle') ?>></b> </FONT></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo $LDMemoTxt ?></a></b> </FONT></td>
  </tr>
 --></table>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
</ul>
</FONT>
<p>
</td>
</tr>
</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
