<?
/*
CARE 2002 Integrated Information System for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	
Beta version 1.0    2002-05-10
GNU GPL. For details read file "copy_notice.txt".
*/
if(!$lang)
	if(!$ck_language) include("../chklang.php");
		else $lang=$ck_language;
require("../language/".$lang."/lang_".$lang."_aufnahme.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Barcode Labels Patient nr. <?=$pn ?></title>
</head>
<body onLoad="if(window.focus) window.focus()">
<? if(file_exists("../cache/barcodes/pn_".$pn.".png")) : ?>
<a href="javascript:window.print()"><img src="../imgcreator/barcode-etik.php?<?="sid=$ck_sid&lang=$lang&pn=$pn" ?>" border=0 alt="<?=$LDClick2Print ?>"></a>
<? else : ?>
<a href="javascript:window.print()"><img src="../barcode/image.php?<?="code=$pn&style=68&type=I25&width=145&height=50&xres=2&font=5&sid=$ck_sid&lang=$lang&pn=$pn&label=1" ?>" border=0 alt="<?=$LDClick2Print ?>"></a>
<? endif ?>
</body>
</html>
