<?php

  //require ('../modules/registration_admission/Mappa.php');

define('FPDF_FONTPATH','font/');
require('fpdf.php');


$colo[0]="FCmedia_";
$colo[1]="FCmax_";
$colo[2]="FCmin_";
$colo[3]="numaritven_";
$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$data['nat_id_nr']),$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(55,65);
$pdf->Cell(190,5,"Referto Elettrocardiogramma dinamico Holter", $border=0, $align='C');
//$pdf=new PDF();

//Column titles


$header=array('FC media (bpm)','FC max (bpm)','FC min (bpm)','N.aritnmie ventricolari');

//Data loading

$data="";

	for($i=0;$i<4;$i++)
	{
	$data.=($_POST[rtrim($colo[$i])]).";";
//echo $data;
	}

$dati[$j]=explode(';',chop($data));
$data="";
$pdf->Ln(12);
$pdf->SetFont('Arial','B',14);
$pdf->SetX(10);
$pdf->Cell(45,5,"Motivo dell'esame: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Cell(190,5,str_replace("\\"," ",$_POST['motivo']), $border=0, $align='L');
//$pdf->Vai_a_capo($_POST['conclusioni_holter'],115);
$pdf->Ln(8);

$pdf->SetFont('Arial','B',14);
$pdf->SetX(10);
$pdf->Cell(45,5,"Durata della registrazione: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['durata']),100);
$pdf->Ln(6);
//$pdf->SetFont('Arial','',12);
//$pdf->AddPage();
$pdf->SetX(15);
$pdf->ImprovedTable5($header,$dati);

//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
//$pdf->Output();


$pdf->Ln(14);
$pdf->SetFont('Arial','B',14);
$pdf->SetX(90);
$pdf->Cell(45,5,"Conclusioni: ", $border=0, $align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni_holter']),115);

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
	 $pdf->Cell(120,5,"Dott. ".$_SESSION['sess_login_username'],$border=0,$ln=0,$align='L');
   
  $pdf->Output("../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf","F");

header("Location:../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf");


?>
