<?php

/*if($_POST['mappa_richiesta'])
include ('../modules/registration_admission/Mappa.php');*/
//require('../include/inc_environment_global.php');
/*
	$sql="Insert into care_encounter_notes ('encounter_nr','type_nr','notes','aux_notes','ref_notes_nr','date','time','history','modify_id','modify_time','create_id','create_time') values (".$_POST['encounter_nr'].",13,'".$_POST['Referto']."',".$_POST['appt_nr'].",".(2*$_POST['appt_nr']).",'".date('Y-m-d')."','".date('H:i:s')."','Creato da ".$_POST['sess_user_name']." il ".date('Y-m-d H:i:s')."','".$_POST['sess_user_name']."','".date('Y-m-d H:i:s')."','".$_POST['sess_user_name']."','".date('Y-m-d H:i:s')."')";
	//$db->Execute($sql);
	$query="SELECT * from care_encounter WHERE encounter_nr=".$_POST['encounter_nr'];
	
	$pidtemp=$db->Execute($query);
	$pidtemp=$pidtemp->FetchRow();
	$pid=$pidtemp['pid'];
	$query2="SELECT * from care_person WHERE pid=".$pid;
	$complea=$db->Execute($query2);
	$complea=$complea->FetchRoW();
	$compleanno=''.substr($complea['date_birth'],8,2).'-'.substr($complea['date_birth'],5,3).'-'.substr($complea['date_birth'],0,4).'';
	$federazione=$complea['religion'];
	$Referto=$_POST['Referto'];
	*/
	
	//$risultato=$db->Execute($sql);

define('FPDF_FONTPATH','font/');
require('ref_radio.php');


$pdf = new INVOICE( 'P', 'mm', 'A4' );
$pdf->Open();
$pdf->AddPage();
$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                 "P.IVA 07207761003\n" );

  
$pdf->UPC_A(10,35,$_POST['encounter_nr']);
$chi="SELECT per.*, enc.insurance_firm_id FROM care_encounter AS enc LEFT JOIN care_person AS per ON per.pid=enc.pid WHERE enc.encounter_nr=".$_POST['encounter_nr'];
$rispo=$db->Execute($chi);
$data=$rispo->FetchRow();
$nome=$data['name_first'];
$cognome=$data['name_last'];


 $pdf->SetFont('Arial','B',10);
  $pdf->SetXY(165,20);
  if(!$_POST['delta'])
  {
    $query_data_app="SELECT date FROM care_appointment WHERE nr=".$_POST['appt_nr'];
	#$query_data_app="SELECT date FROM care_appointment WHERE nr=".$_GET['nr'];
  #echo $query_data_app;
  $rispo_data_app=$db->Execute($query_data_app);
  $data_app=$rispo_data_app->FetchRow();
  $pdf->Cell(30,5,"Roma, ".substr($data_app['date'],8,2)."-".substr($data_app['date'],5,2)."-".substr($data_app['date'],0,4),$border=0, $align='L');
  }
  else
  $pdf->Cell(30,5,"Roma, ".substr(date('Y-m-d'),8,2)."-".substr(date('Y-m-d'),5,2)."-".substr(date('Y-m-d'),0,4),$border=0, $align='L');
  #$pdf->Cell(30,5,"Roma, ".date('d-m-Y'),$border=0, $align='L');
  
/*
$query="SELECT * FROM care_encounter WHERE encounter_nr=".$_POST['encounter_nr'];
$pid=$db->Execute($query);
$pid=$pid->FetchRow();
$pidgiusto=$pid['pid'];
$query2="SELECT * FROM care_person WHERE pid=".$pidgiusto;
$data=$db->Execute($query2);
$data=$data->FetchRow();
*/


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
 


 //if ($_POST['item_code']=='CO430')
 //$pdf->Ln(14);

  $pdf->Ln(14);
  $pdf->SetX( 55 );
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,"Paziente: ".$nome." ".$cognome, $border=0, $align='L');
    #la linea commentata qua sotto d? il numero univoco del paziente e non il nome
  //$pdf->Cell(190,5,"Paziente: ".$_POST['encounter_nr'], $border=0, $align='L');
  if(!$_POST['delta'])
  {
  $pdf->SetX( 110 );
  $pdf->Cell(190,5,"Visita Num.: ".$_POST['appt_nr'],$border=0, $align='L');
  }
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
  if($_POST['delta'] || $_POST['conclusioni_holter'])
  {
  $pdf->SetX(175);
  $pdf->Cell(190,5,"Qualifica: ".$qualifica,$border=0, $align='L');
  }




/*
if($med_gen==1)
require ('resto_form_normale.php');
  */
  
  
  
  if($_POST['delta'] && $_POST['item_code']=='rel_conc_short')
   require ('resto_form_rel_conc_short.php');
   
   
    else if($_POST['cardio']=="vero")
   require('resto_form_rel_conc_cardio.php');
   
   
   else if($_POST['delta'])
   require('resto_form_rel_conc.php');
   
  
   
else if($mappa[$_POST['item_code']][1]=="true")
 require ('resto_form_normale.php');

else
require ($mappa[$_POST['item_code']][3]);



?>
