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
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');
?>
<html>
<head>
<title><?php echo $nm ?></title>
<?php echo setCharSet(); ?>

</head>
<body onLoad="if (window.focus) window.focus()">
<font size=2 face="verdana,arial"><?php echo $nm ?><br>
<img src="<?php echo "$httprotocol://$main_domain" ?>/fotos/registration/<?php echo $fn ?>">
</body>
</html>
