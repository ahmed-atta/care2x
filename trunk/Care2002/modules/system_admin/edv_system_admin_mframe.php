<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/

$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
if(isset($ck_edv_admin_user)) setcookie('ck_edvzugang_user',$ck_edv_admin_user);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title></title>
</head>
<frameset cols="22%,*">
  <frame name="SYSADMIN_INDEX" src="edv-system-admi-menu.php<?php echo URL_REDIRECT_APPEND ?>">
  <frame name="SYSADMIN_WFRAME" src="edv-system-admi-welcome.php<?php echo URL_REDIRECT_APPEND ?>">
<noframes>
<body>
</body>
</noframes>
</frameset>
</html>
