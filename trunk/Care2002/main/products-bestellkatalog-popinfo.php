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
define('LANG_FILE','products.php');
define("NO_2LEVEL_CHK","1");
require_once('../include/inc_front_chain_lang.php');
require_once('../include/inc_config_color.php');

//set order catalog flag
$bcat=true;

require("../include/inc_products_search_mod.php");
?>
<html>
<!-- Generated by AceHTML Freeware http://freeware.acehtml.com -->
<!-- Creation date: 24.07.01 -->
<head>
<?php echo setCharSet(); ?>
<title><?php echo $title_art?></title>
<meta name="Description" content="">
<meta name="Keywords" content="">
<meta name="Author" content="Lorilla Bong">
<meta name="Generator" content="AceHTML 4 Freeware">
</head>
<body bgcolor="#ffffff" onLoad="if (window.focus) window.focus()">
<?php
require("../include/inc_products_search_result_mod.php");
?>
<p>
<a href="<?php if($goback) echo "javascript:window.history.back()"; else echo "javascript:window.close()"; ?>"><img <?php echo createLDImgSrc('../','close2.gif','0') ?>></a>

</body>
</html>
