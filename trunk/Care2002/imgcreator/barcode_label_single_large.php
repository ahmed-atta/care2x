<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/*
CARE 2002 Integrated Information System beta 1.0.02 - 30.07.2002 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/

if(!extension_loaded('gd')) dl('php_gd.dll');
define("LANG_FILE","konsil.php");
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
	   $result['pdate']=formatDate2Local($result['pdate'],$date_format);
	
	   if($child_img)
	   {
	   
	       if($subtarget=='chemlabor' || $subtarget=='baclabor')
	       {
	           $sql="SELECT * FROM care_test_request_".$subtarget." WHERE batch_nr='".$batch_nr."'";
	   		            if($ergebnis=mysql_query($sql,$link))
       		            {
				            if($editable_rows=mysql_num_rows($ergebnis))
					        {
							
     					       $stored_request=mysql_fetch_array($ergebnis);
							   
							   
							    if(isset($stored_request['parameters']))
							   {
							      //echo $stored_request['parameters'];
   						          parse_str($stored_request['parameters'],$stored_param);
                               }
							   
							   /* parse the material type */
							   if(isset($stored_request['material']))
							   {
   						          parse_str($stored_request['material'],$stored_material);
							   }
							   /* parse the test type */
							   if(isset($stored_request['test_type']))
							   {
   						          parse_str($stored_request['test_type'],$stored_test_type);
							   }
							}
			             }
	       }
	   
	       if($subtarget=='baclabor')
	       {
	           $sql="SELECT * FROM care_test_findings_baclabor WHERE batch_nr='".$batch_nr."'";
	   		            if($ergebnis=mysql_query($sql,$link))
       		            {
				            if($editable_rows=mysql_num_rows($ergebnis))
					        {
							
     					       $stored_findings=mysql_fetch_array($ergebnis);
							   
							       parse_str($stored_findings['type_general'],$parsed_type);
							       parse_str($stored_findings['resist_anaerob'],$parsed_resist_anaerob);
							       parse_str($stored_findings['resist_aerob'],$parsed_resist_aerob);
							       parse_str($stored_findings['findings'],$parsed_findings);
							}
			             }
	   
	       }
	    } // end of if($child_img)
	}
	else 
		{ print "$LDDbNoLink<br>$sql<br>"; }
		
    $addr=explode("\r\n",$result[address]);

    if($lang=="de") $result[sex]=strtr($result[sex],"mfMF","mwMW");
    
	/* Load the barcode img if it exists */
    if(file_exists("../cache/barcodes/pn_".$pn.".png"))
	{
	   $bc = ImageCreateFrompng("../cache/barcodes/pn_".$pn.".png");
	}
	 
	 /* Dimensions of the patient's label */
	 $label_w=282; 
	 $label_h=178;
	 
    // -- create label 
    $label=ImageCreate($label_w,$label_h);
    $ewhite = ImageColorAllocate ($label, 255,255,255); //white bkgrnd
    $elightgreen= ImageColorAllocate ($label, 205, 225, 236);
    $eblue=ImageColorAllocate($label, 0, 127, 255);
    $eblack = ImageColorAllocate ($label, 0, 0, 0);
	$egray= ImageColorAllocate($label,127,127,127);
	//ImageFillToBorder($label,2,2,$egray,$ewhite);
	ImageRectangle($label,0,0,281,177,$egray);
	
	
    if($bc) ImageCopy($label,$bc,145,4,9,9,134,37);
    
    ImageString($label,4,2,2,$result[patnum],$eblack);
    ImageString($label,2,80,2,$result[pdate],$eblack);
    ImageString($label,5,10,40,"$result[name], $result[vorname]",$eblack);
    ImageString($label,3,10,55,$result[gebdatum],$eblack);
    for($a=0,$l=75;$a<sizeof($addr);$a++,$l+=15) ImageString($label,4,10,$l,$addr[$a],$eblack);
    ImageString($label,5,10,125,strtoupper($result[sex]),$eblack);
    ImageString($label,5,30,125,$result[name],$eblack);
    ImageString($label,4,10,140,$result[kassename],$eblack);
    //ImageString($label,4,5,150,"$result[dept]   $result[ward]   $result[doc_art]   $result[s_code]",$black);
    ImageString($label,3,10,160,"PLA      P3B      WA      65p",$eblack);


	if(!$child_img)
	{
    Imagepng($label);
	
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
    ImageDestroy($label);
	}
	else
	{
	  if(file_exists('../imgcreator/gd_test_request_'.$subtarget.'.php'))   include_once('../imgcreator/gd_test_request_'.$subtarget.'.php');
	  else Imagepng($label);
	/*   Imagepng($label);*/
	  
	}
/*
}
*/
 ?>


