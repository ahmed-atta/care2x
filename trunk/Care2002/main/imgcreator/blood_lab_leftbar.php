<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2X Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
if(!extension_loaded('gd')) dl('php_gd.dll');

header ('Content-type: image/png');

define('LANG_FILE','konsil.php');
define('NO_CHAIN',1);
require($root_path.'include/inc_front_chain_lang.php');

$im =@ ImageCreateFromPNG($root_path.'gui/img/common/default/blood_wardfill.png');

$black = ImageColorAllocate ($im, 0, 0, 0);

if($form_bottom) $str_print=$LDFillByLab;
else $str_print=$LDFillByWard;
//ImageColorTransparent($im,$green);
// *******************************************************************
// * the following code is for ttf fonts use only for php machines with ttf support
// *******************************************************************
if($lang=='ar' || $lang=='fa'){// Modified on ( 22/01/2004) By Walid Fathalla
	# path of ttf is ok
	include_once($root_path.'include/inc_ttf_check_ar.php');
    include_once($root_path.'include/inc_ttf_ar2uni.php');//To actvate function of show arabic
	ImageTTFText($im,14,90,16,390,$black,$arial,ar2uni("$str_print"));

}else{
// ******************************************************************
// * the following code is the default - uses system fonts
// ******************************************************************

/* -------------- START  ----------------------*/

//if($form_bottom) $str_print=$LDFillByLab;
 //else $str_print=$LDFillByWard;
ImageStringUp($im,5,2,390,$str_print,$black);
}

/* -------------- END --------------------------*/

Imagepng ($im);
ImageDestroy ($im);
 ?>
