<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');
?>
<?php html_rtl($lang); ?>
<head>
<title><?php echo $nm ?></title>
<?php echo setCharSet(); ?>

</head>
<body onLoad="if (window.focus) window.focus()">
<font size=2 face="verdana,arial"><?php echo $nm ?></font><br>
<?php
if(!empty($fn) && file_exists($root_path."fotos/registration/$fn")){
?>
<img src="<?php echo "$httprotocol://$main_domain" ?>/fotos/registration/<?php echo $fn ?>">
<?php
}
?>
</body>
</html>
