<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2X Integrated Information System deployment 1.1 (mysql) 2004-01-11 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
// Modified on ( 22/01/2004) By Walid Fathalla
GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','aufnahme.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title>Barcode Labels Patient nr. <?php echo $full_en ?></title>
</head>
<body onLoad="if(window.focus) window.focus()">
<?php if(file_exists($root_path."cache/barcodes/en_".$full_en.".png")) : ?>
<?php if($lang=='ar'||$lang=='fa') :?>
<a href="javascript:window.print()" title="<?php echo $LDClickImgToPrint ?>"><img src="./imgcreator/barcode_img_wristbands-ar.php<?php echo URL_REDIRECT_APPEND."&en=$en" ?>" border=0 alt="<?php echo $LDClickImgToPrint ?>"></a>
<?php else : ?>
<a href="javascript:window.print()" title="<?php echo $LDClickImgToPrint ?>"><img src="./imgcreator/barcode_img_wristbands.php<?php echo URL_REDIRECT_APPEND."&en=$en" ?>" border=0 alt="<?php echo $LDClickImgToPrint ?>"></a>
<?php endif ?>
<?php else : ?>
<a href="javascript:window.print()" title="<?php echo $LDClickImgToPrint ?>"><img src="<?php echo $root_path ?>classes/barcode/image.php?<?php echo "code=$full_en&style=68&type=I25&width=145&height=50&xres=2&font=5&sid=$sid&lang=$lang&pn=$full_en&label=1" ?>" border=0 alt="<?php echo $LDClickImgToPrint ?>"></a>
<?php endif ?>
</body>
</html>
