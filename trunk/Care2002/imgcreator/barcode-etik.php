<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/

if(!extension_loaded('gd')) dl('php_gd.dll');
define("LANG_FILE","aufnahme.php");
define("NO_CHAIN",1);
require("../include/inc_front_chain_lang.php");
header ("Content-type: image/png");

if(!$pn) $pn="22000029";

/*
if(file_exists("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png"))
{
    $im = ImageCreateFrompng("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png");
    Imagepng($im);
}
else
{
*/
    include('../include/inc_db_makelink.php');
    if($link&&$DBLink_OK)
	{	
	    // get orig data
	    $dbtable="care_admission_patient";
	    $sql="SELECT * FROM $dbtable WHERE patnum='$pn' ";
	    if($ergebnis=mysql_query($sql,$link))
       	{
			$rows=0;
			if( $result=mysql_fetch_array($ergebnis)) $rows++;
			if($rows)
				{
					mysql_data_seek($ergebnis,0);
					$result=mysql_fetch_array($ergebnis);
					if($edit&&$result['discharge_date']) $edit=0;
				}
		}
		else {print "<p>$sql$LDDbNoRead"; exit;}
       
	   include_once("../include/inc_date_format_functions.php");
       $date_format=getDateFormat($link,$DBLink_OK);
	   
	   $result['gebdatum']=formatDate2Local($result['gebdatum'],$date_format);
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }
		
    $addr=explode("\r\n",$result[address]);

    if($lang=="de") $result[sex]=strtr($result[sex],"mfMF","mwMW");

    $bc = ImageCreateFrompng("../cache/barcodes/pn_".$pn.".png");

    $w=745; 
    $h=1080;
    $im=ImageCreate($w,$h);

    $white = ImageColorAllocate ($im, 255,255,255); //white bkgrnd
    $background= ImageColorAllocate ($im, 205, 225, 236);
    $blue=ImageColorAllocate($im, 0, 127, 255);
    $black = ImageColorAllocate ($im, 0, 0, 0);
  
    // draw black lines
    ImageLine($im,0,25,569,25,$black);
    ImageLine($im,0,220,569,220,$black);
    ImageLine($im,0,334,569,334,$black);
    for($n=0,$j=95;$n<3;$n++,$j+=95) ImageLine($im,$j,0,$j,25,$black);
    for($n=0,$j=114;$n<4;$n++,$j+=114) ImageLine($im,$j,334,$j,359,$black);
    ImageLine($im,285,26,285,220,$black);
    ImageLine($im,285,50,569,50,$black);
    ImageLine($im,285,75,569,75,$black);
    for($n=0,$j=380;$n<2;$n++,$j+=95) ImageLine($im,$j,0,$j,50,$black);
    // write item labels
    ImageString($im,1,5,1,"$LDCaseNr:",$black);
    ImageString($im,4,5,9,$result[patnum],$black);
    ImageString($im,1,100,1,"$LDAdmitDate:",$black);
    ImageString($im,4,105,9,$result[pdate],$black);
    ImageString($im,1,195,1,"$LDAdmitTime:",$black);
    ImageString($im,4,205,9,$result[ptime],$black);
    ImageString($im,1,290,1,"$LDDept:",$black);
    ImageString($im,4,295,9,$result[dept],$black);
    ImageString($im,1,385,1,"$LDRoomNr:",$black);
    ImageString($im,4,390,9,$result[dept],$black);
    ImageString($im,1,480,1,"$LDAdmitType:",$black);
    ImageString($im,4,485,9,$result[dept],$black);
    ImageString($im,1,290,26,"$LDBday:",$black);
    ImageString($im,4,290,34,$result[gebdatum],$black);
    ImageString($im,1,385,26,"$LDSex:",$black);
    ImageString($im,4,425,34,strtoupper($result[sex]),$black);
    ImageString($im,1,480,26,"$LDCivilStat:",$black);
    ImageString($im,4,485,34,$result[civstatus],$black);
    ImageString($im,1,290,51,"$LDPhone:",$black);
    ImageString($im,4,350,60,$result[phone1],$black);
    ImageString($im,1,290,78,"$LDInsurance:",$black);
    ImageString($im,4,300,95,$result[kassename],$black);
    ImageString($im,1,290,195,"$LDInsuranceNr:",$black);
    ImageString($im,4,300,95,$result[kasse_nr],$black);
    // name & address
    ImageString($im,1,5,40,"$LDNameAddr:",$black);
    ImageCopy($im,$bc,110,28,9,9,134,37);
    ImageString($im,3,10,70,"$result[name], $result[vorname]",$black);
    for($a=0,$l=90;$a<sizeof($addr);$a++,$l+=15) ImageString($im,3,10,$l,$addr[$a],$black);

    ImageString($im,1,5,145,"$LDBillInfo:",$black);
    ImageString($im,3,10,160,"$result[name], $result[vorname]",$black);
    ImageString($im,3,10,175,$result[kassename],$black);
    // diagnosis, therapie, 
    ImageString($im,3,10,225,"$LDDiagnosis: $result[diagnose]",$black);
    ImageString($im,3,10,240,"$LDRecBy: $result[referrer]",$black);
    ImageString($im,3,10,255,"$LDTherapy: $result[therapie]",$black);
    ImageString($im,3,10,270,"$LDSpecials: $result[besonder]",$black);
    ImageString($im,3,10,285,"$LDAdmitDiagnosis: $result[admit_diagnosis]",$black);
    ImageString($im,3,10,300,"$LDInfo2: $result[info2]",$black);
    // -- print date, religion, 
    ImageString($im,1,5,336,"$LDPrintDate:",$black);
    ImageString($im,4,5,343,date("d.m.Y"),$black);
    ImageString($im,1,119,336,"$LDReligion:",$black);
    ImageString($im,4,119,343,$result[religion],$black);
    ImageString($im,1,238,336,"$LDTherapyType:",$black);
    ImageString($im,4,238,343,$result[therapy_type],$black);
    ImageString($im,1,352,336,"$LDTherapyOpt:",$black);
    ImageString($im,4,352,343,$result[therapy_option],$black);
    ImageString($im,1,466,336,"$LDServiceType:",$black);
    ImageString($im,4,466,343,$result[service_type],$black);

    // -- create label 
    $label=ImageCreate(282,178);
    $ewhite = ImageColorAllocate ($label, 255,255,255); //white bkgrnd
    $elightgreen= ImageColorAllocate ($im, 205, 225, 236);
    $eblue=ImageColorAllocate($im, 0, 127, 255);
    $eblack = ImageColorAllocate ($im, 0, 0, 0);
    ImageCopy($label,$bc,145,4,9,9,134,37);
    
    ImageString($label,4,2,2,$result[patnum],$black);
    ImageString($label,2,80,2,$result[pdate],$black);
    ImageString($label,5,10,40,"$result[name], $result[vorname]",$black);
    ImageString($label,3,10,55,$result[gebdatum],$black);
    for($a=0,$l=75;$a<sizeof($addr);$a++,$l+=15) ImageString($label,4,10,$l,$addr[$a],$black);
    ImageString($label,5,10,125,strtoupper($result[sex]),$black);
    ImageString($label,5,30,125,$result[name],$black);
    ImageString($label,4,10,140,$result[kassename],$black);
    //ImageString($label,4,5,150,"$result[dept]   $result[ward]   $result[doc_art]   $result[s_code]",$black);
    ImageString($label,3,10,160,"PLA      P3B      WA      65p",$black);

    // -- create smaller label
    $label2=ImageCreate(173,133);
    $e2white = ImageColorAllocate ($label2, 255,255,255); //white bkgrnd
    ImageCopy($label2,$bc,35,0,9,7,134,37);

    ImageString($label2,2,35,34,$result[patnum],$black);
    ImageString($label2,2,110,34,$result[pdate],$black);
    ImageString($label2,4,10,50,"$result[name],",$black);
    ImageString($label2,4,10,65,"$result[vorname]",$black);
    //$addr=explode("\r\n",$result[address]);
    //for($a=0,$l=70;$a<sizeof($addr);$a++,$l+=15) ImageString($label2,2,5,$l,$addr[$a],$black);
    ImageString($label2,4,10,85,strtoupper($result[sex]),$black);
    ImageString($label2,3,50,85,$result[gebdatum],$black);
    //ImageString($label2,4,30,90,$result[name],$black);
    ImageString($label2,3,10,100,$result[kassename],$black);
    //ImageString($label,4,5,150,"$result[dept]   $result[ward]   $result[doc_art]   $result[s_code]",$black);
    ImageString($label2,2,10,115,"PLA   P3B   WA   65p",$black);
    
    // ------------------------------------ create smaller label without barcode
    $label3=ImageCreate(173,133);
    $e3white = ImageColorAllocate ($label3, 255,255,255); //white bkgrnd
    ImageString($label3,4,10,2,$result[patnum],$black);
    ImageString($label3,2,110,2,$result[pdate],$black);
    ImageString($label3,4,10,25,"$result[name],",$black);
    ImageString($label3,4,10,40,"$result[vorname]",$black);
    ImageString($label3,2,10,55,$result[gebdatum],$black);
    for($a=0,$l=75;$a<sizeof($addr);$a++,$l+=15) ImageString($label3,2,10,$l,$addr[$a],$black);

    //-------------- place 6 labels
    for($i=0,$wi=359;$i<4;$i++,$wi+=179)
    {
        ImageCopy($im,$label,1,$wi,0,0,282,178);
        ImageCopy($im,$label,285,$wi,0,0,282,178);
        //ImageLine($im,0,$wi,569,$wi,$blue);
    }

    // ---  place the smaller labels
    for($i=0,$j=1;$i<1080;$i+=135,$j++)
    {
        if($j>4) ImageCopy($im,$label2,570,$i+1,0,0,173,133);
	        else ImageCopy($im,$label3,570,$i+1,0,0,173,133);
        //ImageLine($im,569,$i,$w-1,$i,$blue);
    }
	
	// *******************************************************************
    // * draw blue border lines - uncomment the following lines of code to create
	// * border lines around the labels
	// *******************************************************************
	
   /*
   // START 
    ImageLine($im,0,0,$w-1,0,$blue);
    ImageLine($im,0,0,0,$h-1,$blue);
    ImageLine($im,0,$h-1,$w-1,$h-1,$blue);
    ImageLine($im,$w-1,0,$w-1,$h-1,$blue);
    ImageLine($im,569,0,569,$h-1,$blue);
    ImageLine($im,284,359,284,$h-1,$blue);
	// END
   */
	
    Imagepng ($im);
	
	// *******************************************************************
    // * comment the following one line if you want to deactivate caching of 
	// * the barcode label image
	// *******************************************************************
/*    
	// START
    Imagepng ($im,"../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png");
	// END
*/	
	// Do not edit the following lines
    ImageDestroy ($label);
    ImageDestroy ($label2);
    ImageDestroy ($label3);
/*
}
*/
ImageDestroy ($im);
 ?>


