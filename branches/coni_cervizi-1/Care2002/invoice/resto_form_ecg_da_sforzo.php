<?php

  //require ('../modules/registration_admission/Mappa.php');

define('FPDF_FONTPATH','font/');
require('fpdf.php');
$colo2[0]="fc_base";
$colo2[1]="pas_base";
$colo2[2]="pad_base";

$colo[0]="fc_";
$colo[1]="pas_";
$colo[2]="pad_";
$colo[3]="carico_";
$colo[4]="rendimento_";

$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$data['nat_id_nr']),$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(65,75);
$pdf->Cell(190,5,"Referto Elettrocardiogramma da Sforzo", $border=0, $align='C');
//$pdf=new PDF();

//Column titles


$header=array('FC base (bpm)','PAS base (mmHg)','PAD base(mmHg)');

//Data loading

$data="";

	for($i=0;$i<3;$i++)
	{
	$data.=($_POST[rtrim($colo2[$i])]).";";
//echo $data;
	}

$dati[$j]=explode(';',chop($data));
$data="";





$pdf->SetFont('Arial','',12);
//$pdf->AddPage();
$pdf->SetXY(40,95);
$pdf->ImprovedTable7($header,$dati);




$header=array('FC Max (bpm)','PAS Max (mmHg)','PAD Max (mmHg)',"Carico (W)","Rendimento (Watt/Kg)");

//Data loading

$data="";

	for($i=0;$i<5;$i++)
	{
	$data.=($_POST[rtrim($colo[$i])]).";";
//echo $data;
	}

$dati[$j]=explode(';',chop($data));
$data="";





$pdf->SetFont('Arial','',12);
//$pdf->AddPage();
$pdf->SetXY(15,115);
$pdf->ImprovedTable2($header,$dati);

//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
//$pdf->Output();


$pdf->Ln(14);
$pdf->SetFont('Arial','B',14);
$pdf->SetX(90);
$pdf->Cell(45,5,"Conclusioni: ", $border=0, $align='C');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni']),115);

$pdf->Ln(12);

	   $pdf->SetFont('Arial','',12);
	 //$pdf->SetX(10);
	 //$pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(145);
	 $pdf->Cell(120,5,"Roma, ".date('d-m-Y'),$border=0,$ln=0,$align='L');
		  $pdf->Ln(6);
		  	 $pdf->SetX(145);
	 $pdf->Cell(120,5,"Dott. ".$_POST['sess_user_name'],$border=0,$ln=0,$align='L');
   
  $pdf->Output("../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf","F");

header("Location:../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf");


?>
