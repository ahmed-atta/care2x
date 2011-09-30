<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require('../../include/helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('MODULE','system_admin');
define('LANG_FILE_MODULAR','system_admin.php');
$local_user='ck_admin_user';
require_once($root_path.'include/helpers/inc_front_chain_lang.php');
if(isset($ck_admin_admin_user)) setcookie('ck_edvzugang_user',$ck_admin_admin_user);
$breakfile='admin.php'.URL_APPEND;

# Set the db manager app here
switch($dbtype){
	case 'mysql' : $strDbAdminItem = $LDPhpMyAdmin;
							$strDbAdminUrl='phpmyadmin';
							break;
	case 'postgres':
	case 'postgres7':
							$strDbAdminItem = 'phpPgAdmin';
							$strDbAdminUrl = 'phppgadmin';
							break;
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>

<?php 
require($root_path.'include/helpers/inc_js_gethelp.php');
require($root_path.'include/helpers/inc_css_a_hilitebu.php');
?>
</HEAD>
<BODY topmargin=0 leftmargin=0 marginheight=0 marginwidth=0 bgcolor=<?php echo $cfg['body_bgcolor'];?>>
<table width=100% border=0 cellspacing=0>
<tr>
<td ><FONT    SIZE=+2  FACE="Arial">
<STRONG> <?php echo $LDAdminIndex ?></STRONG></FONT></td>
</tr>
<tr>
<td bgcolor=<?php echo $cfg['body_bgcolor'];?> colspan=2>
<FONT    SIZE=-1  FACE="Arial">
<table border=0 cellspacing=1 cellpadding=2>
  <tr>
	<td bgcolor="#e9e9e9" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDGeneral;  ?></b> </FONT><br>
	</td>
  </tr>
  <tr>
	<td bgcolor="#ffffff">
		&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>><FONT  color="#0000cc" FACE="verdana,arial" size=2><a href="admin_general_info_quick.php<?php echo URL_APPEND ?>" target="SYSADMIN_WFRAME"> <?php echo $LDQuickInformer; ?></a></FONT><br>
		&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>><FONT  color="#0000cc" FACE="verdana,arial" size=2><a href="admin_paginator_maxrows.php<?php echo URL_APPEND ?>" target="SYSADMIN_WFRAME"> <?php echo $LDPaginatorMaxRows; ?></a></FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDUsers;  ?></b> </FONT><br>
	</td>
  </tr>

  <tr>
	<td bgcolor="#ffffff">
		&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>><FONT  color="#0000cc" FACE="verdana,arial" size=2><a href="admin_user_access_edit.php?sid=<?php echo $sid."&lang=$lang&src=sysadmin" ?>" target="SYSADMIN_WFRAME"> <?php echo $LDCreateEditLock; ?></a></FONT><br>
		&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>><FONT  color="#0000cc" FACE="verdana,arial" size=2><a href="admin_user_role_edit.php?sid=<?php echo $sid."&lang=$lang&src=sysadmin" ?>" target="SYSADMIN_WFRAME"> <?php echo $LDCreateEditRoles; ?></a></FONT><br>
		&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>><FONT  color="#0000cc" FACE="verdana,arial" size=2><a href="admin_system_timeout.php?sid=<?php echo $sid."&lang=$lang&src=sysadmin" ?>" target="SYSADMIN_WFRAME"> <?php echo $LDTimeOut; ?></a></FONT></td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDGUI;  ?></b> </FONT><br>
	</td>
  </tr>
  <tr>
	<td bgcolor="#ffffff"><FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>><a href="admin_news_display.php?sid=<?php echo $sid."&lang=$lang" ?>" target="SYSADMIN_WFRAME"> <?php echo $LDNewsDisplay ?></a></FONT></td>
  </tr>
  <tr>
	<td bgcolor="#ffffff"><FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>><a href="admin_system_format_date.php?sid=<?php echo $sid."&lang=$lang" ?>" target="SYSADMIN_WFRAME"> <?php echo $LDSetDateFormat ?></a></FONT></td>
  </tr>
  <tr>
	<td bgcolor="#ffffff" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="admin_system_format_currency_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>" target="SYSADMIN_WFRAME"><?php echo $LDSetCurrency ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="admin_system_format_currency_add.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>" target="SYSADMIN_WFRAME"><?php echo $LDAddCurrency ?></a>
	</td>
  </tr>

  <tr>
	<td bgcolor="#e9e9e9" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDMainMenu;  ?></b> </FONT><br>
	</td>
  </tr>
  <tr>
	<td bgcolor="#ffffff" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="admin_system_menu_main_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>" target="SYSADMIN_WFRAME"><?php echo  "$LDHideShow, $LDSortOrder" ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="admin_system_menu_main_display_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>" target="SYSADMIN_WFRAME"><?php echo $LDConfigOptions ?></a><br>
	</td>
  </tr>
  <tr>
	<td bgcolor="#e9e9e9" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDDataEntryForms;  ?></b> </FONT><br>
	</td>
  </tr>
  <tr>
	<td bgcolor="#ffffff" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="admin_system_forms_set.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>" target="SYSADMIN_WFRAME"><?php echo $LDHideShow ?></a><br>
	</td>
  </tr>
 <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDTheme ?></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#ffffff" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>	
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="admin_system_controls_theme.php?sid=<?php echo $sid."&lang=".$lang."&target=currency_admin"; ?>" target="SYSADMIN_WFRAME"><?php echo $LDControlButImg ?></a>
	</td>
  </tr>
 <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDDeptAdmin ?></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#ffffff" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="<?php echo $root_path; ?>modules/dept_admin/dept_new.php<?php echo URL_APPEND; ?>" target="SYSADMIN_WFRAME"><?php echo $LDCreate ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="<?php echo $root_path; ?>modules/dept_admin/dept_list.php<?php echo URL_APPEND; ?>" target="SYSADMIN_WFRAME"><?php echo $LDList ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="<?php echo $root_path; ?>modules/dept_admin/dept_list_config.php<?php echo URL_APPEND; ?>" target="SYSADMIN_WFRAME"><?php echo $LDConfigOptions ?></a>
	</td>
  </tr> 
  <!-- gjergji new ward management -->
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDNursingManage ?></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#ffffff" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="<?php echo $root_path; ?>modules/nursing/nursing-ward-new.php<?php echo URL_APPEND; ?>" target="SYSADMIN_WFRAME"><?php echo $LDCreate ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="<?php echo $root_path; ?>modules/nursing/nursing-ward-info.php<?php echo URL_APPEND; ?>" target="SYSADMIN_WFRAME"><?php echo $LDProfile ?></a><br>
	</td>
  </tr>
<!-- end : gjergji -->  
  <tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDORAdmin ?></b> </FONT></td>
  </tr>
  <tr>
	<td bgcolor="#ffffff" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="<?php echo $root_path; ?>modules/or_admin/or_new.php<?php echo URL_APPEND; ?>" target="SYSADMIN_WFRAME"><?php echo $LDCreate ?></a><br>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="<?php echo $root_path; ?>modules/or_admin/or_list_config.php<?php echo URL_APPEND; ?>" target="SYSADMIN_WFRAME"><?php echo $LDListConfig ?></a>
	</td>
  </tr>
  <tr>
	<td bgcolor="#ffffff" valign="top">
	<FONT  color="#0000cc" FACE="verdana,arial" size=2>
	&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <a href="<?php echo $root_path; ?>modules/system_admin/access.php<?php echo URL_APPEND; ?>" target="SYSADMIN_WFRAME">Logs Administration</a><br>
	</td>
  </tr>  
<tr>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc" FACE="verdana,arial" size=2><b><?php echo $LDDatabase ?></b> </FONT></td>
  </tr>
  <tr>
 	<td bgcolor="#ffffff"><FONT  color="#0000cc" FACE="verdana,arial" size=2>&nbsp;&nbsp;&nbsp;<img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> 
	<a href="../<?php echo $strDbAdminUrl ?>/index.php?sid=<?php echo $sid."&lang=$lang" ?>" target="SYSADMIN_WFRAME"><?php  echo $strDbAdminItem ?>
	</a></FONT></td>
  </tr>


</FONT>
<p>
</td>
</tr>
</table>        
<p>
<a href="<?php echo $breakfile ?>" target="_parent"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>

</FONT>
</BODY>
</HTML>
