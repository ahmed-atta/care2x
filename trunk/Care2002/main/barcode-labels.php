<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.03 - 2002-10-26 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','aufnahme.php');
define('NO_2LEVEL_CHK',1);
require_once('../include/inc_front_chain_lang.php');
?>
<html>
<head>
<?php echo setCharSet(); ?>
<title>Barcode Labels Patient nr. <?php echo $pn ?></title>
</head>
<body onLoad="if(window.focus) window.focus()">
<?php if(file_exists("../cache/barcodes/pn_".$pn.".png")) : ?>
<a href="javascript:window.echo()"><img src="../imgcreator/barcode-etik.php?<?php echo "sid=$sid&lang=$lang&pn=$pn" ?>" border=0 alt="<?php echo $LDClick2echo ?>"></a>
<?php else : ?>
<a href="javascript:window.echo()"><img src="../classes/barcode/image.php?<?php echo "code=$pn&style=68&type=I25&width=145&height=50&xres=2&font=5&sid=$sid&lang=$lang&pn=$pn&label=1" ?>" border=0 alt="<?php echo $LDClick2echo ?>"></a>
<?php endif ?>
</body>
</html>
