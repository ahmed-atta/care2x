<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
if(!extension_loaded("gd")) dl("php_gd.dll");

header ("Content-type: image/png");

define("LANG_FILE","nursing.php");
define("NO_CHAIN",1);
require("../include/inc_front_chain_lang.php");

$im = ImageCreateFromPNG("../img/cat-com8.png");
$blue=ImageColorAllocate ($im, 0, 0, 255);
$black = ImageColorAllocate ($im, 0, 0, 0);

// *******************************************************************
// * the following code is for ttf fonts use only for php machines with ttf support
// *******************************************************************
/*
/* -------------- START ----------------------------------------------*/
/*$txt=$LDNoOccList;
ImageTTFText ($im, 15, 0, 9, 27, $black, "arial.ttf",$txt);
$txt=$LDFromWard.strtoupper($station);
ImageTTFText ($im, 15, 0, 9, 52, $black, "arial.ttf",$txt);
$txt=$LDWithinLast.($c-1).$LDDays;
ImageTTFText ($im, 15, 0, 9, 77, $black, "arial.ttf",$txt);
$txt=$LDAvailable;
ImageTTFText ($im, 15, 0, 9, 102, $black, "arial.ttf",$txt);
*/
/* -------------- END -------------------------------------------------*/


// ******************************************************************
// * the following code is the default - uses system fonts
// ******************************************************************

/* -------------- START  ----------------------*/
$txt=$LDNoOccList;
ImageString($im,3,9,17,$txt,$black);
$txt=$LDFromWard.strtoupper($station);
ImageString($im,3,9,42,$txt,$black);
$txt=$LDWithinLast;
ImageString($im,3,9,67,$txt,$black);
$txt=($c-1).$LDDays." ".$LDAvailable;
ImageString($im,3,9,92,$txt,$black);
/* -------------- END --------------------------*/

Imagepng ($im);
ImageDestroy ($im);
 ?>


