<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/

/*****************************************************
*  To align the entire image (4 images), 
* change only the $leftmargin and $topmargin variables
*****************************************************/
	
	$leftmargin=5;
	$topmargin=40;

//* Do not change anything below this line, unless you are sure of what you are doing */

//* The $yoffset variable determines the spacing between the wristbands */
	$yoffset=115;


if(!extension_loaded('gd')) dl('php_gd.dll');
define('LANG_FILE','aufnahme.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
header ('Content-type: image/png');

    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {	
	    // get orig data
	    $dbtable='care_person';
	    //$sql="SELECT * FROM $dbtable WHERE patient_nr='$pn' ";
		
		$sql="SELECT c1.name_last, c1.name_first, c1.date_birth, c2.current_ward_nr, c2.current_dept_nr,
		           c2.insurance_firm_id, c2.insurance_2_firm_id, c2.encounter_class_nr, c2.encounter_nr
				   FROM care_encounter as c2 
				     LEFT JOIN care_person as c1 ON c1.pid=c2.pid 
				         WHERE c2.encounter_nr='$en'";
				 
	    if($ergebnis=$db->Execute($sql))
       	{
			if($ergebnis->RecordCount())
				{
					$result=$ergebnis->FetchRow();
				}
		}
		else {print "<p>$sql$LDDbNoRead"; exit;}
       
	   /* Load the date formatter */
	   include_once($root_path.'include/inc_date_format_functions.php');
       //$date_format=getDateFormat($link,$DBLink_OK);
	   
	   	/* Get the patient global configs */
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');
	   
	   $result['date_birth']=@formatDate2Local($result['date_birth'],$date_format);
	}
	else { print "$LDDbNoLink<br>$sql<br>"; exit;}
	
	/* Create full admission number */
/*	switch ($result['encounter_class_nr'])
    {
    case '2' :     $full_en = $en+ $GLOBAL_CONFIG['patient_outpatient_nr_adder'];
						break;
	case '1' :     $full_en = $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
	default:       $full_en = $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
    }
*/
	$full_en=$en;
	
    if($lang=='de') $result['sex']=strtr($result['sex'],'mfMF','mwMW');

	/* Load the barcode image*/
    $bc = ImageCreateFrompng($root_path.'cache/barcodes/en_'.$full_en.'.png');
	
	/* Load the wristband images */
	
	$wb_lrg = ImageCreateFrompng('wristband_large.png');
	$wb_med = ImageCreateFrompng('wristband_medium.png');
	$wb_sml = ImageCreateFrompng('wristband_small.png');
	$wb_bby = ImageCreateFrompng('wristband_baby.png');
	
	/* Get the image sizes*/
	$size_lrg = GetImageSize('wristband_large.png');
	$size_med = GetImageSize('wristband_medium.png');
	$size_sml = GetImageSize('wristband_small.png');
	$size_bby = GetImageSize('wristband_baby.png');

    $w=1085;  // The width of the image = equal to the DIN-A4 paper
    $h=700; // The height of the image = egual to the  DIN-A4 paper
	
	/* Create the main image */
    $im=ImageCreate($w,$h);
	

    $white = ImageColorAllocate ($im, 255,255,255); //white bkgrnd
/*    $background= ImageColorAllocate ($im, 205, 225, 236);
    $blue=ImageColorAllocate($im, 0, 127, 255);
*/  
    $black = ImageColorAllocate ($im, 0, 0, 0);
	
	//* Write the print instructions */
	
	ImageString($im,2,10,2,$LDPrintPortraitFormat,$black);
    ImageString($im,2,10,15,$LDClickImgToPrint,$black);
	
	
	/* Creat the name label */
	$namelabel=ImageCreate(145,45);
	
    $nm_white = ImageColorAllocate ($namelabel, 255,255,255); //white bkgrnd
    $nm_black= ImageColorAllocate ($namelabel, 0, 0, 0);
	
	ImageString($namelabel,2,1,2,$result['name_last'].', '.$result['name_first'],$nm_black);
    ImageString($namelabel,2,1,15,$result['date_birth'],$nm_black);
    ImageString($namelabel,2,1,28,$result['current_ward'].' '.$result['current_dept'].' '.$result['insurance_co_id'].' '.$result['insurance_2_co_id'],$nm_black);
	
	
    //-------------- place the wristbands
	    $topm=$topmargin;
        ImageCopy($im,$wb_lrg,$leftmargin,$topm,0,0,$size_lrg[0],$size_lrg[1]);
		$topm+=$yoffset;
		ImageCopy($im,$wb_med,$leftmargin,$topm,0,0,$size_med[0],$size_med[1]);
		$topm+=$yoffset;
        ImageCopy($im,$wb_sml,$leftmargin,$topm,0,0,$size_sml[0],$size_sml[1]);
		$topm+=$yoffset;
        ImageCopy($im,$wb_bby,$leftmargin,$topm,0,0,$size_bby[0],$size_bby[1]);

    //* Place the barcodes */
	$topm=$topmargin+15;
	$topm2=$topmargin+60;

    ImageCopy($im,$bc,$leftmargin+220,$topm,9,9,170,37);
	ImageString($im,2,$leftmargin+225,$topm-13,$full_en,$black);
    ImageCopy($im,$bc,$leftmargin+480,$topm2,9,9,170,37);
	ImageString($im,2,$leftmargin+485,$topm2-13,$full_en,$black);
	/* Print admit nr vertically*/
	ImageStringUp($im,5,$leftmargin+420,$topm+78,$full_en,$black);
	
	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+200,$topm,9,9,170,37);
	ImageString($im,2,$leftmargin+205,$topm-13,$full_en,$black);
    ImageCopy($im,$bc,$leftmargin+430,$topm2,9,9,170,37);
	ImageString($im,2,$leftmargin+435,$topm2-13,$full_en,$black);
	/* Print admit nr vertically*/
	ImageStringUp($im,5,$leftmargin+380,$topm+78,$full_en,$black);
	
	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+160,$topm,9,9,170,37);
	ImageString($im,2,$leftmargin+175,$topm-13,$full_en,$black);
    ImageCopy($im,$bc,$leftmargin+340,$topm2,9,9,170,37);
	ImageString($im,2,$leftmargin+355,$topm2-13,$full_en,$black);
	/* Print admit nr vertically*/
	ImageStringUp($im,5,$leftmargin+325,$topm+78,$full_en,$black);
	
	$topm+=$yoffset;
    ImageCopy($im,$bc,$leftmargin+200,$topm,9,9,170,37);
	ImageString($im,2,$leftmargin+215,$topm-13,$full_en,$black);
	/* Print admit nr vertically*/
	ImageStringUp($im,5,$leftmargin+370,$topm+78,$full_en,$black);
	
    //* Place the name labels*/
	
	$topm=$topmargin+50;
	$topm2=$topmargin+5;
	
    ImageCopy($im,$namelabel,$leftmargin+225,$topm,0,0,144,44);
    ImageCopy($im,$namelabel,$leftmargin+485,$topm2,0,0,144,44);

	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$namelabel,$leftmargin+205,$topm,0,0,144,44);
    ImageCopy($im,$namelabel,$leftmargin+435,$topm2,0,0,144,44);

	$topm+=$yoffset;
	$topm2+=$yoffset;
    ImageCopy($im,$namelabel,$leftmargin+175,$topm,0,0,144,44);
    ImageCopy($im,$namelabel,$leftmargin+355,$topm2,0,0,144,44);

	$topm+=$yoffset;
    ImageCopy($im,$namelabel,$leftmargin+215,$topm,0,0,144,44);
	
	/* Create the final image */
    Imagepng ($im);
	

	// Do not edit the following lines
    ImageDestroy ($wb_lrg);
    ImageDestroy ($wb_med);
    ImageDestroy ($wb_sml);
    ImageDestroy ($wb_bby);

    ImageDestroy ($im);
?>
