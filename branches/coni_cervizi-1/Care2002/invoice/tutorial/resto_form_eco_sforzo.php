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


	if($data['nat_id_nr'])
$qualifica="Atleta";
 
 switch ($pid['insurance_firm_id'])
  {
  case 13:
  $qualifica='Interesse Nazionale';
	break;
  case 14:
    $qualifica='Probabile Olimpico';
	break;
	}	
$pdf->SetX( 175 );
$pdf->Cell(190,5,"Qualifica: ".$qualifica,$border=0, $align='L');


$pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$data['nat_id_nr']),$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(65,65);
$pdf->Cell(190,5,"Referto Ecocardiogramma da Sforzo", $border=0, $align='R');
//$pdf=new PDF();
$pdf->Ln(14);
//Column titles
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Motivo della prova: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(130,5,str_replace("\\"," ",$_POST['motivo']), $border=0, $align='L');
$pdf->Ln(8);


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
$pdf->SetXY(10,95);
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
$pdf->SetXY(105,95);
$pdf->ImprovedTable($header,$dati,$tre=1);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Motivo arresto prova: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(130,5,str_replace("\\"," ",$_POST['arresto']), $border=0, $align='L');

$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Anomalie cinetiche: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
//$pdf->Cell(130,5,str_replace("\\"," ",$_POST['anomalie']), $border=0, $align='L');
$pdf->Vai_a_capo3(str_replace("\\"," ",$_POST['anomalie']));

$pdf->Ln(2);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Commento: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
//$pdf->Cell(130,5,$_POST['commento'], $border=0, $align='L');
$pdf->Vai_a_capo3(str_replace("\\"," ",$_POST['commento']));

$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->SetX(90);
$pdf->Cell(45,5,"Conclusioni: ", $border=0, $align='C');
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo3(str_replace("\\"," ",$_POST['conclusioni']));

$pdf->Ln(8);

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
