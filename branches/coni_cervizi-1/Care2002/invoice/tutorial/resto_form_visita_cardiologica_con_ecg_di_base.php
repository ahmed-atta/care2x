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




//$pdf->Ln(6);
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
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni_visita_specialistica']),115);
*/
$pdf->Ln(8);

	   $pdf->SetFont('Arial','',12);
	 //$pdf->SetX(10);
	 //$pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(150);
	 $pdf->Cell(120,5,"Dott. ".$_POST['sess_user_name'],$border=0,$ln=0,$align='L');
   
	 
	 
	 $pdf->AddPage();
$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                 "P.IVA 07207761003\n" );
 
$pdf->UPC_A(10,35,$_POST['encounter_nr']);
$chi="SELECT per.* FROM care_encounter AS enc LEFT JOIN care_person AS per ON per.pid=enc.pid WHERE enc.encounter_nr=".$_POST['encounter_nr'];
$rispo=$db->Execute($chi);
$data=$rispo->FetchRow();
$nome=$data['name_first'];
$cognome=$data['name_last'];

 $pdf->SetFont('Arial','B',10);
  $pdf->SetXY(165,20);
  $pdf->Cell(30,5,"Roma, ".substr($data_app['date'],8,2)."-".substr($data_app['date'],5,2)."-".substr($data_app['date'],0,4),$border=0, $align='L');
  



$compleanno=substr($data['date_birth'],8,2)."-".substr($data['date_birth'],5,2)."-".substr($data['date_birth'],0,4);

$federazione=$data['religion'];
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
 


  $pdf->Ln(14);
  $pdf->SetX( 55 );
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,"Paziente: ".$nome." ".$cognome, $border=0, $align='L');
    #la linea commentata qua sotto d? il numero univoco del paziente e non il nome
  //$pdf->Cell(190,5,"Paziente: ".$_POST['encounter_nr'], $border=0, $align='L');

  
  $pdf->SetX( 110 );
  $pdf->Cell(190,5,"Visita Num.: ".$_POST['appt_nr'],$border=0, $align='L');
  
  $pdf->Ln(8);
  $pdf->SetX( 55 );
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,"Data di nascita: ".$compleanno, $border=0, $align='L');
  $pdf->SetX( 110 );
  $pdf->Cell(190,5,"Federazione: ".$federazione,$border=0, $align='L');
  $pdf->Ln(8);
  $pdf->SetX( 55 );
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,"Sport: ".$data['name_maiden'], $border=0, $align='L');
  $pdf->SetX( 110 );
  $pdf->Cell(190,5,"Specialita':".$data['name_3'],$border=0, $align='L');
  if($_POST['delta'])
  {
  $pdf->SetX( 147 );
  $pdf->Cell(190,5,"Qualifica: ".$qualifica,$border=0, $align='L');
  }


$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$data['nat_id_nr']),$border=0,$ln=0,$align='L');
	 
	 
$colo[0]="ritmo_";
$colo[1]="fc_";
$colo[2]="PR_";
$colo[3]="QT_";

$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$data['nat_id_nr']),$border=0,$ln=0,$align='L');
$header=array('Ritmo','Freq. cardiaca (bpm)','PR (sec)',"QT (sec)");

//Data loading

$data="";

	for($i=0;$i<4;$i++)
	{
	$data.=($_POST[rtrim($colo[$i])]).";";
//echo $data;
	}

$dati[$j]=explode(';',chop($data));
$data="";




$pdf->SetFont('Arial','',12);
//$pdf->AddPage();
$pdf->SetXY(15,80);
$pdf->ImprovedTable3($header,$dati);

//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
//$pdf->Output();


$pdf->Ln(14);
$pdf->SetFont('Arial','B',14);
$pdf->SetX(90);
$pdf->Cell(45,5,"Conclusioni: ", $border=0, $align='C');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(190,5,$_POST['conclusioni'], $border=0, $align='L');
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni_ecg_di_base']),115);
$pdf->Ln(6);

$pdf->SetFont('Arial','',12);
$pdf->SetX(150);
$pdf->Cell(120,5,"Roma, ".date('d-m-Y'),$border=0,$ln=0,$align='L');
		  $pdf->Ln(6);
		  	 $pdf->SetX(150);
	 $pdf->Cell(120,5,"Dott. ".$_POST['sess_user_name'],$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(65,65);
$pdf->Cell(190,5,"Referto Elettrocardiogramma di Base", $border=0, $align='C');



  $pdf->Output("../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf","F");

header("Location:../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf");


?>
