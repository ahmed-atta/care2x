<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/

if(!extension_loaded('gd')) dl('php_gd.dll');
define('LANG_FILE','aufnahme.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
header ('Content-type: image/png');

/* Check the encounter number */
if((!isset($en)||!$en)&&$HTTP_SESSION_VARS['sess_en']) $en=$HTTP_SESSION_VARS['sess_en'];

/*
if(file_exists("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png"))
{
    $im = ImageCreateFrompng("../cache/barcodes/pn_".$pn."_bclabel_".$lang.".png");
    Imagepng($im);
}
else
{
*/
    if(!isset($db) || !$db) include_once($root_path.'include/inc_db_makelink.php');
    if($dblink_ok) {
	    // get orig data
	    //$dbtable='care_patient_encounter';
		$sql="SELECT c1.name_last, c1.name_first, c1.date_birth, c1.sex, c1.civil_status, c1.phone_1_nr,
		          c1.religion, c1.addr_str, c1.addr_str_nr, c1.addr_zip, c1.addr_citytown_nr, c1.contact_person, c2.* 
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
		// else {print "<p>$sql$LDDbNoRead"; exit;} /* Remove comment for debugging*/
       
	   include_once($root_path.'include/inc_date_format_functions.php');
       //$date_format=getDateFormat($link,$DBLink_OK);

	   	/* Get the patient global configs */
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');
	   
	//   $result['date_birth']=formatDate2Local($result['date_birth'],$date_format);
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }
		
		
		
	switch ($result['encounter_class_nr'])
	{
	    case '1':    $full_en= $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
		                      $result['encounter_class']=$LDStationary;
		                      break;
	    case '2':   $full_en= $en + $GLOBAL_CONFIG['patient_outpatient_nr_adder'];
		                      $result['encounter_class']=$LDAmbulant;
	    default:    $full_en= $en + $GLOBAL_CONFIG['patient_inpatient_nr_adder'];
		                      $result['encounter_class']=$LDStationary;
		}
			
    if($lang=='de') $result['sex']=strtr($result['sex'],'mfMF','mwMW');

    $bc = ImageCreateFrompng($root_path.'cache/barcodes/en_'.$full_en.'.png');

    $w=745;  // The width of the image = equal to the width of DIN-A4 paper
    $h=1080; // The height of the image = egual to the height of DIN-A4 paper
	
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
    ImageString($im,4,5,9,$full_en,$black);
    ImageString($im,1,100,1,"$LDAdmitDate:",$black);
    ImageString($im,4,105,9,formatDate2Local($result['encounter_date'],$date_format),$black);
    ImageString($im,1,195,1,"$LDAdmitTime:",$black);
    ImageString($im,4,205,9,formatDate2Local($result['encounter_date'],$date_format,1,1),$black);
    ImageString($im,1,290,1,"$LDDept:",$black);
    ImageString($im,4,295,9,$result['current_dept'],$black);
    ImageString($im,1,385,1,"$LDRoomNr:",$black);
    ImageString($im,4,390,9,$result['current_room'],$black);
    ImageString($im,1,480,1,"$LDAdmitType:",$black);
    ImageString($im,4,485,9,$result['encounter_type'],$black);
    ImageString($im,1,290,26,"$LDBday:",$black);
    ImageString($im,4,290,34,formatDate2Local($result['date_birth'],$date_format),$black);
    ImageString($im,1,385,26,"$LDSex:",$black);
    ImageString($im,4,425,34,strtoupper($result['sex']),$black);
    ImageString($im,1,480,26,"$LDCivilStat:",$black);
    ImageString($im,4,485,34,$result['civil_status'],$black);
    ImageString($im,1,290,51,"$LDPhone:",$black);
    ImageString($im,4,350,60,$result['phone_1_nr'],$black);
    ImageString($im,1,290,78,"$LDInsurance:",$black);
    ImageString($im,4,300,95,$result['insurance_co_id'],$black);
    ImageString($im,1,290,195,"$LDInsuranceNr:",$black);
    ImageString($im,4,360,195,$result['insurance_nr'],$black);
    // name & address
    ImageString($im,1,5,40,"$LDNameAddr:",$black);
	// place the barcode 
    ImageCopy($im,$bc,110,28,9,9,170,37);
    ImageString($im,3,10,70,$result['name_last'].', '.$result['name_first'],$black);
	
    //for($a=0,$l=90;$a<sizeof($addr);$a++,$l+=15) ImageString($im,3,10,$l,$addr[$a],$black);
     ImageString($im,3,10,90,$result['addr_str'].' '.$result['addr_str_nr'],$black);
     ImageString($im,3,10,105,$result['addr_zip'].' '.$result['addr_city_town'],$black);

	 /* Bill payer information
	 *  Note: the address format is german
     */
     ImageString($im,1,5,145,"$LDBillInfo:",$black);
	 if ($result['payer_other']=='')
	 {
         ImageString($im,3,10,160,$result['name_last'].', '.$result['name_first'],$black);
         ImageString($im,3,10,175,$result['addr_str'].' '.$result['addr_str_nr'],$black);
         ImageString($im,3,10,190,$result['addr_zip'].' '.$result['addr_city_town'],$black);
	}
	else
	{
	    $addr_buffer=nl2br($result['payer_other']);
		$addr_buffer=explode('<br>',$addr_buffer);
		for($i=0,$n=160;$i<sizeof($addr_buffer);$i++,$n+=15)
		{
            ImageString($im,3,10,$n,trim($addr_buffer[$i]),$black);
		}
			
	}
    // diagnosis, therapie, 
    ImageString($im,3,10,225,$LDDiagnosis.': '.$result['referrer_diagnosis'],$black);
    ImageString($im,3,10,240,$LDRecBy.': '.$result['referrer'],$black);
    ImageString($im,3,10,255,$LDTherapy.': '.$result['referrer_recom_therapy'],$black);
    ImageString($im,3,10,270,$LDSpecials.': '.$result['referrer_notes'],$black);
    ImageString($im,3,10,285,$LDAdmitDiagnosis.': '.$result['referrer_diagnosis'],$black);
    ImageString($im,3,10,300,$LDInfo2.': '.$result[info2],$black);
	
	// Contact person
	if($result['contact_person']!='')
	{
	    //$addr_buffer=nl2br($result['contact_person']);
		$addr_buffer=str_replace("\r",', ',$result['contact_person']);
		$addr_buffer=str_replace("\n",'',$addr_buffer);
        ImageString($im,4,90,305,$addr_buffer,$black);
	}
	
    // -- print date, religion, 
    ImageString($im,1,5,336,"$LDPrintDate:",$black);
    ImageString($im,4,5,343,formatDate2Local(date('Y-m-d'),$date_format),$black);
    ImageString($im,1,119,336,"$LDReligion:",$black);
    ImageString($im,4,119,343,$result['religion'],$black);
    ImageString($im,1,238,336,"$LDTherapyType:",$black);
    ImageString($im,4,238,343,$result[therapy_type],$black);
    ImageString($im,1,352,336,"$LDTherapyOpt:",$black);
    ImageString($im,4,352,343,$result[therapy_option],$black);
    ImageString($im,1,466,336,"$LDServiceType:",$black);
    ImageString($im,4,466,343,$result['service_type'],$black);

    // -- create label 
    $label=ImageCreate(282,178);
    $ewhite = ImageColorAllocate ($label, 255,255,255); //white bkgrnd
    $elightgreen= ImageColorAllocate ($im, 205, 225, 236);
    $eblue=ImageColorAllocate($im, 0, 127, 255);
    $eblack = ImageColorAllocate ($im, 0, 0, 0);
	// place the barcode
    ImageCopy($label,$bc,101,4,9,9,170,37);
    
	// encounter number
    ImageString($label,4,2,2,$full_en,$black);
	// encounter date
    ImageString($label,2,2,18,formatDate2Local($result['encounter_date'],$date_format),$black); 
    ImageString($label,5,10,40,$result['name_last'].', '.$result['name_first'],$black);
    ImageString($label,3,10,55,formatDate2Local($result['date_birth'],$date_format),$black);
    //for($a=0,$l=75;$a<sizeof($addr);$a++,$l+=15) ImageString($label,4,10,$l,$addr[$a],$black);
     ImageString($label,4,10,75,$result['addr_str'].' '.$result['addr_str_nr'],$black);
     ImageString($label,4,10,90,$result['addr_zip'].' '.$result['addr_city_town'],$black);
	
	
    ImageString($label,5,10,125,strtoupper($result['sex']),$black);
    ImageString($label,5,30,125,$result['name_last'],$black);
    ImageString($label,4,10,140,$result['insurance_co_id'],$black);
    //ImageString($label,4,5,150,"$result[dept]   $result[ward]   $result[doc_art]   $result[s_code]",$black);
    ImageString($label,3,10,160,$result['current_dept'].'      '.$result['current_room'].'      '.$result['extra_service'],$black);

    // -- create smaller label
    $label2=ImageCreate(173,133);
    $e2white = ImageColorAllocate ($label2, 255,255,255); //white bkgrnd
	// -- place barcode
    ImageCopy($label2,$bc,2,0,9,7,170,37);

    ImageString($label2,2,10,34,$full_en,$black);
    ImageString($label2,2,110,34,formatDate2Local($result['encounter_date'],$date_format),$black);
    ImageString($label2,4,10,50,$result['name_last'].',',$black);
    ImageString($label2,4,10,65,$result['name_first'],$black);
    //$addr=explode("\r\n",$result[address]);
    //for($a=0,$l=70;$a<sizeof($addr);$a++,$l+=15) ImageString($label2,2,5,$l,$addr[$a],$black);
    ImageString($label2,4,10,85,strtoupper($result['sex']),$black);
    ImageString($label2,3,50,85,formatDate2Local($result['date_birth'],$date_format),$black);
    //ImageString($label2,4,30,90,$result[name],$black);
    ImageString($label2,3,10,100,$result['insurance_co_id'],$black);
    //ImageString($label,4,5,150,"$result[dept]   $result[ward]   $result[doc_art]   $result[s_code]",$black);
    ImageString($label2,2,10,115,$result['current_dept'].'      '.$result['current_room'].'      '.$result['extra_service'],$black);
    
    // ------------------------------------ create smaller label without barcode
    $label3=ImageCreate(173,133);
    $e3white = ImageColorAllocate ($label3, 255,255,255); //white bkgrnd
    ImageString($label3,4,10,2,$full_en,$black);
    ImageString($label3,2,110,2,formatDate2Local($result['encounter_date'],$date_format),$black);
    ImageString($label3,4,10,25,$result['name_last'].',',$black);
    ImageString($label3,4,10,40,$result['name_first'],$black);
    ImageString($label3,2,10,55,formatDate2Local($result['date_birth'],$date_format),$black);
    //for($a=0,$l=75;$a<sizeof($addr);$a++,$l+=15) 
	//ImageString($label3,2,10,$l,$addr[$a],$black);
     ImageString($label3,2,10,75,$result['addr_str'].' '.$result['addr_str_nr'],$black);
     ImageString($label3,2,10,90,$result['addr_zip'].' '.$result['addr_city_town'],$black);
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
