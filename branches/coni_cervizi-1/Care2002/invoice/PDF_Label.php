<?php
////////////////////////////////////////////////////
// PDF_Label 
//
// Class to print labels in Avery or custom formats
//
//
// Copyright (C) 2003 Laurent PASSEBECQ (LPA)
// Based on code by Steve Dillon : steved@mad.scientist.com
//
//-------------------------------------------------------------------
// VERSIONS :
// 1.0  : Initial release
// 1.1  : + : Added unit in the constructor
//        + : Now Positions start @ (1,1).. then the first image @top-left of a page is (1,1)
//        + : Added in the description of a label : 
//				font-size	: defaut char size (can be changed by calling Set_Char_Size(xx);
//				paper-size	: Size of the paper for this sheet (thanx to Al Canton)
//				metric		: type of unit used in this description
//							  You can define your label properties in inches by setting metric to 'in'
//							  and printing in millimiter by setting unit to 'mm' in constructor.
//			  Added some labels :
//				5160, 5161, 5162, 5163,5164 : thanx to Al Canton : acanton@adams-blake.com
//				8600 						: thanx to Kunal Walia : kunal@u.washington.edu
//        + : Added 3mm to the position of labels to avoid errors 
// 1.2  : + : Added Set_Font_Name method
//        = : Bug of positioning
//        = : Set_Font_Size modified -> Now, just modify the size of the font
//        = : Set_Char_Size renamed to Set_Font_Size
////////////////////////////////////////////////////

/**
 * PDF_Label - PDF label editing
 * @package PDF_Label
 * @author Laurent PASSEBECQ <lpasseb@numericable.fr>
 * @copyright 2003 Laurent PASSEBECQ
**/

require_once('fpdf.php');

class PDF_Label extends FPDF {

	// Private properties
	var $_Avery_Name	= '';				// Name of format
	var $_Margin_Left	= 0;				// Left margin of labels
	var $_Margin_Top	= 0;				// Top margin of labels
	var $_X_Space 		= 0;				// Horizontal space between 2 labels
	var $_Y_Space 		= 0;				// Vertical space between 2 labels
	var $_X_Number 		= 0;				// Number of labels horizontally
	var $_Y_Number 		= 0;				// Number of labels vertically
	var $_Width 		= 0;				// Width of label
	var $_Height 		= 0;				// Height of label
	var $_Char_Size		= 10;				// Character size
	var $_Line_Height	= 10;				// Default line height
	var $_Metric 		= 'mm';				// Type of metric for labels.. Will help to calculate good values
	var $_Metric_Doc 	= 'mm';				// Type of metric for the document
	var $_Font_Name		= 'Arial';			// Name of the font

	var $_COUNTX = 1;
	var $_COUNTY = 1;


	// Listing of labels size
	var $_Avery_Labels = array (
		'5160'=>array('name'=>'5160',	'paper-size'=>'letter',	'metric'=>'mm',	'marginLeft'=>1.762,	'marginTop'=>10.7,		'NX'=>3,	'NY'=>10,	'SpaceX'=>3.175,	'SpaceY'=>0,	'width'=>66.675,	'height'=>25.4,		'font-size'=>8),
		'5161'=>array('name'=>'5161',	'paper-size'=>'letter',	'metric'=>'mm',	'marginLeft'=>0.967,	'marginTop'=>10.7,		'NX'=>2,	'NY'=>10,	'SpaceX'=>3.967,	'SpaceY'=>0,	'width'=>101.6,		'height'=>25.4,		'font-size'=>8),
		'5162'=>array('name'=>'5162',	'paper-size'=>'letter',	'metric'=>'mm',	'marginLeft'=>0.97,		'marginTop'=>20.224,	'NX'=>2,	'NY'=>7,	'SpaceX'=>4.762,	'SpaceY'=>0,	'width'=>100.807,	'height'=>35.72,	'font-size'=>8),
		'5163'=>array('name'=>'5163',	'paper-size'=>'letter',	'metric'=>'mm',	'marginLeft'=>1.762,	'marginTop'=>10.7, 		'NX'=>2,	'NY'=>5,	'SpaceX'=>3.175,	'SpaceY'=>0,	'width'=>101.6,		'height'=>50.8,		'font-size'=>8),
		'5164'=>array('name'=>'5164',	'paper-size'=>'letter',	'metric'=>'in',	'marginLeft'=>0.148,	'marginTop'=>0.5, 		'NX'=>2,	'NY'=>3,	'SpaceX'=>0.2031,	'SpaceY'=>0,	'width'=>4.0,		'height'=>3.33,		'font-size'=>12),
		'8600'=>array('name'=>'8600',	'paper-size'=>'letter',	'metric'=>'mm',	'marginLeft'=>7.1, 		'marginTop'=>19, 		'NX'=>3, 	'NY'=>10, 	'SpaceX'=>9.5, 		'SpaceY'=>3.1, 	'width'=>66.6, 		'height'=>25.4,		'font-size'=>8),
		'L7163'=>array('name'=>'L7163',	'paper-size'=>'A4',		'metric'=>'mm',	'marginLeft'=>5,		'marginTop'=>15, 		'NX'=>2,	'NY'=>7,	'SpaceX'=>25,		'SpaceY'=>0,	'width'=>99.1,		'height'=>38.1,		'font-size'=>9)
	);

	// convert units (in to mm, mm to in)
	// $src and $dest must be 'in' or 'mm'
	function _Convert_Metric ($value, $src, $dest) {
		if ($src != $dest) {
			$tab['in'] = 39.37008;
			$tab['mm'] = 1000;
			return $value * $tab[$dest] / $tab[$src];
		} else {
			return $value;
		}
	}

	// Give the height for a char size given.
	function _Get_Height_Chars($pt) {
		// Array matching character sizes and line heights
		$_Table_Hauteur_Chars = array(6=>2, 7=>2.5, 8=>3, 9=>4, 10=>5, 11=>6, 12=>7, 13=>8, 14=>9, 15=>10);
		if (in_array($pt, array_keys($_Table_Hauteur_Chars))) {
			return $_Table_Hauteur_Chars[$pt];
		} else {
			return 100; // There is a prob..
		}
	}

	function _Set_Format($format) {
		$this->_Metric 		= $format['metric'];
		$this->_Avery_Name 	= $format['name'];
		$this->_Margin_Left	= $this->_Convert_Metric ($format['marginLeft'], $this->_Metric, $this->_Metric_Doc);
		$this->_Margin_Top	= $this->_Convert_Metric ($format['marginTop'], $this->_Metric, $this->_Metric_Doc);
		$this->_X_Space 	= $this->_Convert_Metric ($format['SpaceX'], $this->_Metric, $this->_Metric_Doc);
		$this->_Y_Space 	= $this->_Convert_Metric ($format['SpaceY'], $this->_Metric, $this->_Metric_Doc);
		$this->_X_Number 	= $format['NX'];
		$this->_Y_Number 	= $format['NY'];
		$this->_Width 		= $this->_Convert_Metric ($format['width'], $this->_Metric, $this->_Metric_Doc);
		$this->_Height	 	= $this->_Convert_Metric ($format['height'], $this->_Metric, $this->_Metric_Doc);
		$this->Set_Font_Size($format['font-size']);
	}

	// Constructor
	function PDF_Label ($format, $unit='mm', $posX=1, $posY=1) {
		if (is_array($format)) {
			// Custom format
			$Tformat = $format;
		} else {
			// Avery format
			$Tformat = $this->_Avery_Labels[$format];
		}

		parent::FPDF('P', $Tformat['metric'], $Tformat['paper-size']);
		$this->_Set_Format($Tformat);
		$this->Set_Font_Name('Arial');
		$this->SetMargins(0,0); 
		$this->SetAutoPageBreak(false); 

		$this->_Metric_Doc = $unit;
		// Start at the given label position
		if ($posX > 1) $posX--; else $posX=0;
		if ($posY > 1) $posY--; else $posY=0;
		if ($posX >=  $this->_X_Number) $posX =  $this->_X_Number-1;
		if ($posY >=  $this->_Y_Number) $posY =  $this->_Y_Number-1;
		$this->_COUNTX = $posX;
		$this->_COUNTY = $posY;
	}

	// Sets the character size
	// This changes the line height too
	function Set_Font_Size($pt) {
		if ($pt > 3) {
			$this->_Char_Size = $pt;
			$this->_Line_Height = $this->_Get_Height_Chars($pt);
			$this->SetFontSize($this->_Char_Size);
		}
	}

	// Method to change font name
	function Set_Font_Name($fontname) {
		if ($fontname != '') {
			$this->_Font_Name = $fontname;
			$this->SetFont($this->_Font_Name);
		}
	}

//PROVIAMO UNA  AGGIUNTA, tra ##D
function GetCheckDigit($barcode)
{
    //Compute the check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    $r=$sum%10;
    if($r>0)
        $r=10-$r;
    return $r;
}

function TestCheckDigit($barcode)
{
    //Test validity of check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    return ($sum+$barcode{12})%10==0;
}
function UPC_A($x,$y,$barcode,$h=16,$w=.35)
{
    $this->Barcode($x,$y,$barcode,$h,$w,12);
}


function Barcode($x,$y,$barcode,$h,$w,$len)
{
    //Padding
    $barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
    if($len==12)
        $barcode='0'.$barcode;
    //Add or control the check digit
    if(strlen($barcode)==12)
        $barcode.=$this->GetCheckDigit($barcode);
    elseif(!$this->TestCheckDigit($barcode))
        $this->Error('Incorrect check digit');
    //Convert digits to bars
    $codes=array(
        'A'=>array(
            '0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
            '5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
        'B'=>array(
            '0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
            '5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
        'C'=>array(
            '0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
            '5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
        );
    $parities=array(
        '0'=>array('A','A','A','A','A','A'),
        '1'=>array('A','A','B','A','B','B'),
        '2'=>array('A','A','B','B','A','B'),
        '3'=>array('A','A','B','B','B','A'),
        '4'=>array('A','B','A','A','B','B'),
        '5'=>array('A','B','B','A','A','B'),
        '6'=>array('A','B','B','B','A','A'),
        '7'=>array('A','B','A','B','A','B'),
        '8'=>array('A','B','A','B','B','A'),
        '9'=>array('A','B','B','A','B','A')
        );
    $code='101';
    $p=$parities[$barcode{0}];
    for($i=1;$i<=6;$i++)
        $code.=$codes[$p[$i-1]][$barcode{$i}];
    $code.='01010';
    for($i=7;$i<=12;$i++)
        $code.=$codes['C'][$barcode{$i}];
    $code.='101';
    //Draw bars
    for($i=0;$i<strlen($code);$i++)
    {
        if($code{$i}=='1')
            $this->Rect($x+$i*$w,$y,$w,$h,'F');
    }
    //Print text uder barcode
    //$this->SetFont('Arial','',12);
    $this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
}
##d##TERMINE AGGIUNTA

	// Print a label
	function Add_PDF_Label($texte,$num) {
		// We are in a new page, then we must add a page
		if (($this->_COUNTX ==0) and ($this->_COUNTY==0)) {
			//$this->AddPage();
		}

		$_PosX = $this->_Margin_Left+($this->_COUNTX*($this->_Width+$this->_X_Space));
		$_PosY = $this->_Margin_Top+($this->_COUNTY*($this->_Height+$this->_Y_Space));
		$this->SetXY($_PosX+3, $_PosY+3);
		$this->MultiCell($this->_Width, $this->_Line_Height, $texte);
		##Francesco:lo aggiungo per stampare il codice a barre a fianco della label; compreso
		## tra i ##A
		//$this->SetXY($_PosX+60, $_PosY+3);
		//$this->Cell(180,5,"cazzo!!!",$border=0, $align="C");
		$this->UPC_A($_PosX+35, $_PosY+3,$num);
		##in pratica stampa il codice a barre nelle posizioni in cui stampa le label
		##A
		$this->_COUNTY++;

		if ($this->_COUNTY == $this->_Y_Number) {
			// End of column reached, we start a new one
			$this->_COUNTX++;
			$this->_COUNTY=0;
		}

		if ($this->_COUNTX == $this->_X_Number) {
			// Page full, we start a new one
			$this->_COUNTX=0;
			$this->_COUNTY=0;
		}
	}

}
?>