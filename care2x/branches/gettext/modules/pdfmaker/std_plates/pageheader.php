<?php
#Get care logo
$pdf->addPngFromFile($logo,20,780,140,23);

# Attach logo
$diff=array(199=>'Ccedilla',208=>'Gbreve',
             221=>'Idotaccent',214=>'Odieresis',
             222=>'Scedilla',220=>'Udieresis',
             231=>'ccedilla',240=>'gbreve',
             253=>'dotlessi',246=>'odieresis',
	     	 254=>'scedilla',252=>'udieresis',
             226=>'acircumflex');
$pdf->selectFont($fontpath.'Helvetica.afm');
$pdf->ezStartPageNumbers(550,25,8);
# Get the main informations
if(!isset($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
include_once($root_path.'include/core/class_globalconfig.php');
$glob=& new GlobalConfig($GLOBAL_CONFIG);
# Get all config items starting with "main_"
$glob->getConfig('main_%');
$addr[]=array($GLOBAL_CONFIG['main_info_address'],
						"$LDPhone:\n$LDFax:\n$LDEmail:",
						$GLOBAL_CONFIG['main_info_phone']."\n".$GLOBAL_CONFIG['main_info_fax']."\n".$GLOBAL_CONFIG['main_info_email']."\n"
						);
$pdf->ezTable($addr,'','',array('xPos'=>165,'xOrientation'=>'right','showLines'=>0,'showHeadings'=>0,'shaded'=>0,'fontsize'=>6,'cols'=>array(1=>array('justification'=>'right'))));
?>