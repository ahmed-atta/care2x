<?php

  //require ('../modules/registration_admission/Mappa.php');


define('FPDF_FONTPATH','font/');
require('fpdf.php');
$riga[0]="Base";
$riga[1]="Max";
$riga[2]="Rec";

$colo[0]="ca_";
$colo[1]="fc_";
$colo[2]="pas_";
$colo[3]="pad_";
$colo[4]="grad_max_";
$colo[5]="grad_med_";
$colo[6]="ef_";


//$pdf=new PDF();

//Column titles


$header=array('',"Carico (W)",'FC (bpm)','PAS (mmHg)','PAD (mmHg)');

//Data loading

for($j=0;$j<3;$j++)
{
	switch ($j)
{
case 0:
$data="Base;";
break;
case 1:
$data="Max;";
break;
case 2:
$data="Rec;";
break;
	}
	for($i=0;$i<4;$i++)
	{
	$data.=($_POST[rtrim($colo[$i]).$riga[$j]]).";";
//echo $data;
	}

$dati[$j]=explode(';',chop($data));
$data="";

}



$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(10,65);
$pdf->ImprovedTable($header,$dati,$tre=0);

//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
//$pdf->Output();
$data="";
for($j=0;$j<3;$j++)
{
	for($i=4;$i<7;$i++)
	{
	$data.=($_POST[rtrim($colo[$i]).$riga[$j]]).";";

	}
$dati[$j]=explode(';',chop($data));
$data="";
}
$header=array('Gradiente max (mmHg)','Gradiente medio (mmHg)','EF(%)');
$pdf->SetFont('Arial','',10);
$pdf->SetXY(105,65);
$pdf->ImprovedTable($header,$dati,$tre=1);
$pdf->Ln(2);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Motivo della prova: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(130,5,$_POST['motivo'], $border=0, $align='L');

$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Motivo arresto prova: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(130,5,$_POST['arresto'], $border=0, $align='L');

$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Anomalie cinetiche: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(130,5,$_POST['anomalie'], $border=0, $align='L');

$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Commento: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
//$pdf->Cell(130,5,$_POST['commento'], $border=0, $align='L');
$pdf->Vai_a_capo($_POST['commento']);

$pdf->Ln(14);
$pdf->SetFont('Arial','B',14);
$pdf->SetX(90);
$pdf->Cell(45,5,"Conclusioni: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo($_POST['conclusioni']);

$pdf->Ln(8);

	   $pdf->SetFont('Arial','',12);
	 $pdf->SetX(10);
	 $pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(15);
	 $pdf->Cell(120,5,"Dott. ".$_POST['sess_user_name'],$border=0,$ln=0,$align='L');
   
  $pdf->Output("/var/www/html/Care2xd/referti/Prova.pdf","F");

header("Location:../referti/Prova.pdf");


?>
