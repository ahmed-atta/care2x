<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";
?>
<?php html_rtl($lang); ?>
<head>
<title></title>
</head>
<body>

<table border=0>
  <tr>
    <td><img <?php  echo createMascot($root_path,'mascot1_r.gif','0') ?></td>
    <td><b><font face="Verdana, Arial" color=#800000><?php echo $LDNoDiagReport ?></font></b></td>
  </tr>
</table>
<p><br>
<a href="<?php echo $breakfile ?>" target="_top"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>>
</a>
</body>
</html>
