<?php
define('FPDF_FONTPATH','font/');
//require('ref_radio.php');
require_once('PDF_Label.php');
require('../include/inc_environment_global.php');

/*-------------------------------------------------
To create the object, 2 possibilities:
either pass a custom format via an array
or use a built-in AVERY name
-------------------------------------------------*/

// Example of custom format; we start at the second column
//$pdf = new PDF_Label(array('name'=>'perso1', 'paper-size'=>'A4', 'marginLeft'=>1, 'marginTop'=>1, 'NX'=>2, 'NY'=>7, 'SpaceX'=>0, 'SpaceY'=>0, 'width'=>99.1, 'height'=>38.1, 'metric'=>'mm', 'font-size'=>14), 1, 2);
// Standard format
$pdf = new PDF_Label('L7163', 'mm', 1, 2);
//$pdf = new INVOICE( 'P', 'mm', 'A4' );
$pdf->Open();
$pdf->AddPage();

$query_persona="SELECT e.pid,e.insurance_firm_id,p.name_last,p.name_first,p.sex,p.nat_id_nr,p.date_birth FROM care_encounter AS e LEFT JOIN care_person AS p ON e.pid=p.pid WHERE encounter_nr=".$_GET['pn'];
$risposta=$db->Execute($query_persona);
$dati_persona=$risposta->FetchRow();
$data_nascita=substr($dati_persona['date_birth'],8,2)."-".substr($dati_persona['date_birth'],5,2)."-".substr($dati_persona['date_birth'],0,4);
$query_numero="SELECT * FROM care_test_request_chemlabor WHERE create_time='".date('Ymd')."000000'";
$risposta_query_numero=$db->Execute($query_numero);
$numero=$risposta_query_numero->Recordcount();
switch ($dati_persona['insurance_firm_id'])
  {
  case 1:
  $qualifica='Privato';
	break;
  case 10:
    $qualifica="Unisalute";
	break;
case 11:
	$qualifica="Unisalute CONI";
case 12:
    $qualifica="Legge 626/94";
    break;
case 13:
	$qualifica="I.N.";
	break;
case 14:
$qualifica="P.O.";
	break;
	}	
if (($qualifica=="Privato" || $qualifica=="Unisalute" || $qualifica=="Unisalute CONI" || $qualifica=="Legge 626/94") && $dati_persona['nat_id_nr']!='')
$qualifica="Atleta di Societa'";
// Print labels
for($i=1;$i<=3;$i++)#nella riga qua sotto ho tolto un %s, ovvero un campo per il multicell fpdf!!
	$pdf->Add_PDF_Label(sprintf("%s\n%s%s%s\n%s, %s\n%s\n%s", date('d-m-Y'),substr($dati_persona['name_last'],0,1).".", substr($dati_persona['name_first'],0,1).".","Rich.N.".$numero, strtoupper($dati_persona['sex']), $data_nascita,"_________________","_________________"),$_GET['pn']);
	
//$pdf->Output();
$pdf->Output("../richieste/etichette/".$_GET['pn'].".pdf","F");

header("Location:../richieste/etichette/".$_GET['pn'].".pdf");

?> 
