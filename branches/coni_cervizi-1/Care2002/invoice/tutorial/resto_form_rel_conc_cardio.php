<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php');
//require_once("../modules/registration_admission/Mappa.php");
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(65,65);
$pdf->Cell(190,5,"RELAZIONE CONCLUSIVA CARDIOLOGIA", $border=0, $align='C');
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
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['anamnestica_familiare']),115);

$pdf->Ln(6);
$pdf->SetFont('Arial','B',14);
//$pdf->SetX(90);
$pdf->Cell(45,5,"Anamnesi personale: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['anamnestica_personale']),115);


/*
$pdf->Ln(6);

$pdf->SetFont('Arial','B',14);
//$pdf->SetX(90);
$pdf->Cell(45,5,"Conclusioni Visita Specialistica: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni_visita_spec']),115);
*/
$pdf->Ln(8);
if ($_POST['conclusioni_ecg_di_base'])
{
$pdf->SetFont('Arial','B',14);
//$pdf->SetX(90);
$pdf->Cell(45,5,"Conclusioni ECG di Base: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni_ecg_di_base']),115);
$pdf->Ln(6);
}
for($cont=0;$cont<$_POST['contatore'];$cont++)
{
$stringa='conclusioni'.$cont;
$altre=split("#",$_POST[$stringa]);
$codice=split("@",$_POST['codici']);
//echo $codice[$cont];
$pdf->SetFont('Arial','B',14);
//$pdf->SetX(90);
if($codice[$cont]=="CO419" || $codice[$cont]=="CO420")
$pdf->Cell(45,5,"Esame obbiettivo", $border=0, $align='C');
else
$pdf->Cell(45,5,$mappa[$codice[$cont]][0], $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$altre[0]),115);
$pdf->Ln(6);
}

$pdf->SetFont('Arial','B',18);
//$pdf->SetX(90);
$pdf->Cell(45,5,"Conclusioni: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni_globali']),115);
$pdf->Ln(8);

	   $pdf->SetFont('Arial','',12);
	 //$pdf->SetX(10);
	 //$pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(150);
	 $pdf->Cell(120,5,"Dott. ".$_SESSION['sess_login_username'],$border=0,$ln=0,$align='L');
   
  $pdf->Output("../../rel_conc/".$_POST['encounter_nr']."_".$_POST['delta'].".pdf","F");

header("Location:../../rel_conc/".$_POST['encounter_nr']."_".$_POST['delta'].".pdf");


?>
