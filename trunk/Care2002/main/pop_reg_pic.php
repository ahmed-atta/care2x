<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.06 - 2003-08-06
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $nm ?></title>

</head>
<body onLoad="if (window.focus) window.focus()">
<font size=2 face="verdana,arial"><?php echo $nm ?><br>
<img src="http://<?php echo $main_domain ?>/fotos/registration/<?php echo $fn ?>">
</body>
</html>
