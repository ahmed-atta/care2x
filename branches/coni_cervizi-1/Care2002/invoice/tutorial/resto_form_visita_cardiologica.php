<?php

  //require ('../modules/registration_admission/Mappa.php');

define('FPDF_FONTPATH','font/');
require('fpdf.php');


$colo[0]="PAS_";
$colo[1]="PAD_";



$pdf->SetFont('Arial','B',14);
$pdf->SetXY(65,65);
$pdf->Cell(190,5,"Referto Visita cardiologica", $border=0, $align='C');
//$pdf=new PDF();

//Column titles


$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$data['nat_id_nr']),$border=0,$ln=0,$align='L');

$pdf->Ln(46);
$pdf->SetFont('Arial','B',14);
//$pdf->SetX(90);
$pdf->Cell(45,5,"Anamnesi familiare: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['familiare']),115);

$pdf->Ln(14);
$pdf->SetFont('Arial','B',14);
//$pdf->SetX(90);
$pdf->Cell(45,5,"Anamnesi personale: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['personale']),115);



$pdf->Ln(6);
$pdf->SetFont('Arial','B',14);
//$pdf->SetX(90);
$pdf->Cell(45,5,"Esame obiettivo: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['obiettivo']),115);
$pdf->Ln(4);
$header=array('PAS (mmHg)','PAD (mmHg)');

//Data loading

$data="";

	for($i=0;$i<5;$i++)
	{
	$data.=($_POST[rtrim($colo[$i])]).";";
//echo $data;
	}

$dati[$j]=explode(';',chop($data));
$data="";




//$pdf->Ln(2);
$pdf->SetFont('Arial','',12);
//$pdf->AddPage();
$pdf->SetX(10);
$pdf->ImprovedTable4($header,$dati);


$pdf->Ln(14);
$pdf->SetFont('Arial','B',14);
//$pdf->SetX(90);
/*
$pdf->Cell(45,5,"Conclusioni: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni']),115);
*/
$pdf->Ln(8);

	   $pdf->SetFont('Arial','',12);
	 //$pdf->SetX(10);
	 //$pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(150);
	 $pdf->Cell(120,5,"Roma, ".date('d-m-Y'),$border=0,$ln=0,$align='L');
		  $pdf->Ln(6);
		  	 $pdf->SetX(150);
	 $pdf->Cell(120,5,"Dott. ".$_POST['sess_user_name'],$border=0,$ln=0,$align='L');
   
  $pdf->Output("../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf","F");

header("Location:../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf");


?>
