<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php');
require('../include/inc_environment_global.php');

$array=split("#",$_POST['analisiselezionate']);
$i=0;
$j=0;
$z=0;
$stringa="";
$q="select item_description from prezzi_1 where ";
$q2="select item_description from prezzi_1 where ";
while($array[$i])
{
  $array2= split("=",$array[$i]);

  $array3= split(",",$array2[0]);
  if($array3[1]==0) 
    {
      $stringa=$stringa." $array3[0]"."=1#";
      //  $analisi_esterne[$j]=$array3[0];
      $j++;
      if ($j==1) $q=$q."item_code='".$array3[0]."'";
      else $q=$q."or item_code='".$array3[0]."'";
      //$j++;
    }
  else
    {  
      $stringa=$stringa." $array3[0]"."=0#";
      $analisi_interne[$z]=$array3[0];
      $z++;
      if ($z==1) $q2=$q2."item_code='".$array3[0]."'";
      else $q2=$q2."or item_code='".$array3[0]."'";
      //$z++;
    }
 
 $i++;
}


$query='INSERT INTO care_test_request_chemlabor (batch_nr, encounter_nr, parameters, send_date, status) VALUES ('.$_POST['batch_nr'].','.$_POST['pn'].','."'".$stringa."'".', '."'".$_POST['data']."'".', "pending")';

$db->Execute($query);

$query2='SELECT date_birth,sex FROM care_person join care_encounter  WHERE care_person.pid=care_encounter.pid and care_encounter.encounter_nr='.$_POST['pn'].'';
$risult=$db->Execute($query2);
$datiperson=$risult->FetchRow();

class PDF extends FPDF
{
function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
                $op='f';
        elseif($style=='FD' or $style=='DF')
                $op='B';
        else
                $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2f %.2f m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l', $xc*$k,($hp-$y)*$k ));
        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
}
function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
  $h = $this->h;
  $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c ', $x1*$this->k, ($h-$y1)*$this ->k, $x2*$this->k, ($h-$y2)*$this->k, $x3*$this-> k, ($h-$y3)*$this->k));
}


function addDate( $date )
{
        $r1  = $this->w - 61;
        $r2  = $r1 + 24;
        $y1  = 17;
        $y2  = $y1 ;
        $mid = $y1 + ($y2 / 2);
        $this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
        $this->Line( $r1, $mid, $r2, $mid);
        $this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
        $this->SetFont( "Helvetica", "B", 10);
        $this->Cell(10,5, "Data", 0, 0, "C");
        $this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+9 );
        $this->SetFont( "Helvetica", "", 10);
        $this->Cell(10,5,$date, 0,0, "C");
}


function addPageNumber( $page )
{
        $r1  = $this->w - 80;
        $r2  = $r1 + 19;
        $y1  = 17;
        $y2  = $y1;
        $mid = $y1 + ($y2 / 2);
        $this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
        $this->Line( $r1, $mid, $r2, $mid);
        $this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
        $this->SetFont( "Helvetica", "B", 10);
        $this->Cell(10,5, "Pagina", 0, 0, "C");
        $this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1 + 9 );
        $this->SetFont( "Helvetica", "", 10);
        $this->Cell(10,5,$page, 0,0, "C");
}
function addClientAdresse( $adresse )
{
        $r1     = $this->w - 80;
        $r2     = $r1 + 68;
        $y1     = 40;
        $this->SetXY( $r1, $y1);
        $this->MultiCell( 60, 4, $adresse);
}




function EAN13($x,$y,$barcode,$h=16,$w=.35)
{
    $this->Barcode($x,$y,$barcode,$h,$w,13);
}

function UPC_A($x,$y,$barcode,$h=16,$w=.35)
{
    $this->Barcode($x,$y,$barcode,$h,$w,12);
}

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
    $this->SetFont('Arial','',12);
    $this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
}
}

//Variabili
if($j>0)
{

  $pdf = new PDF( 'P', 'mm', 'A4' );
  
  $pdf->Open();
  $pdf->AddPage();
  $pdf->Image('coniservizi.png',10,4,50);
  $x1 = 10;
  $y1 = 18;
  $pdf->SetXY( $x1, $y1 );
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell( 150, 4,"Istituto Nazionale di Medicina dello Sport" );
  $pdf->SetFont('Arial','',10);
  $pdf->Ln(4);
  $pdf->MultiCell(100, 4,  "Via dei Campi Sportivi, 46\n00197 - Roma\nP.IVA 07207761003\n");
  
  $date=substr($_POST['data'],8,2).'-'.substr($_POST['data'],5,3).substr($_POST['data'],0,4);
  $pdf->addDate($date);
  
  $pdf->addPageNumber("1");
  
  $pdf->UPC_A(10,40,$_POST['pn']);
  
  $pdf->addClientAdresse("Spett.le\nBIOS S.r.l.\nLaboratorio di Analisi Cliniche\nVia D. Chelini, 39\nRoma"); 

  $pdf->Ln(8);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(150,5,"Oggetto: Richiesta esami di laboratorio");
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',10);
  $pdf->MultiCell(150,5,"   Si richiedono i seguenti esami di laboratorio sul prelievo del ".$date." per il cliente ".$_POST['pn']." sesso ".strtoupper($datiperson['sex'])." nato il ".substr($datiperson['date_birth'],8,2).'-'.substr($datiperson['date_birth'],5,3).substr($datiperson['date_birth'],0,4).":" );
  $pdf->Ln(8);
  $y=90;
  
  $analisiesterne=$db->Execute($q);
  $num=1;
  
  while($cond=$analisiesterne->FetchRow())
    {
      $pdf->SetXY(30,$y);
      $pdf->Cell(5,6,"$num",1,0,"C");
      $pdf->SetXY(36,$y);
      $pdf->Cell(100,6,$cond['item_description']);
      $y+=7;
      $num++;
    }
  
$pdf->Output("../richieste/e".$_POST['pn']."_".$_POST['batch_nr'].".pdf","F");
//$pdf->Output();
//header("Location:../richieste/rq_srv.pdf");
}

if($z>0)
{
 $pdf = new PDF( 'P', 'mm', 'A4' );
  
  $pdf->Open();
  $pdf->AddPage();
  $pdf->Image('coniservizi.png',10,4,50);
  $x1 = 10;
  $y1 = 18;
  $pdf->SetXY( $x1, $y1 );
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell( 150, 4,"Istituto Nazionale di Medicina dello Sport" );
  $pdf->SetFont('Arial','',10);
  $pdf->Ln(4);
  $pdf->MultiCell(100, 4,  "Via dei Campi Sportivi, 46\n00197 - Roma\nP.IVA 07207761003\n");
  
  $date=substr($_POST['data'],8,2).'-'.substr($_POST['data'],5,3).substr($_POST['data'],0,4);
  $pdf->addDate($date);
  
  $pdf->addPageNumber("1");
  
  $pdf->UPC_A(10,40,$_POST['pn']);
  
  $pdf->addClientAdresse("\nAlla cortese attenzione \ndel laboratorio interno\n "); 

  $pdf->Ln(8);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(150,5,"Oggetto: Richiesta esami di laboratorio");
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',10);
  $pdf->MultiCell(150,5,"   Si richiedono i seguenti esami di laboratorio sul prelievo del ".$date." per il cliente ".$_POST['pn']." sesso ".strtoupper($datiperson['sex'])." nato il ".substr($datiperson['date_birth'],8,2).'-'.substr($datiperson['date_birth'],5,3).substr($datiperson['date_birth'],0,4).":" );
  $pdf->Ln(8);
  $y=90;
  
  $analisiinterne=$db->Execute($q2);
  $num=1;
  
  while($cond=$analisiinterne->FetchRow())
    {
      $pdf->SetXY(30,$y);
      $pdf->Cell(5,6,"$num",1,0,"C");
      $pdf->SetXY(36,$y);
      $pdf->Cell(100,6,$cond['item_description']);
      $y+=7;
      $num++;
    }
$pdf->Output("../richieste/i".$_POST['pn']."_".$_POST['batch_nr'].".pdf","F");  
//$pdf->Output("../richieste/rq_srv1.pdf","F");
//header("Location:../richieste/rq_srv1.pdf");
//$pdf->Output();




}
// echo "Per visualizzare le due fatture, clicca sui link qui sotto";

?>
<html>
<body>
<?php if($z>0)
{
?>
<a href="<?echo "../richieste/i".$_POST['pn']."_".$_POST['batch_nr'].".pdf"?>"> Per il laboratorio interno </a>
<br>
   <?php 
}
if($j>0)
{
?>
<a href="<?echo "../richieste/e".$_POST['pn']."_".$_POST['batch_nr'].".pdf"?>" > Per il laboratorio esterno</a>
<br>
<?php
   }
?>
<a href="../modules/laboratory/labor.php?lang=it"> Ho finito </a>
</body>
</html>