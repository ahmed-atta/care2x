<?php
$root_path='../../';
require($root_path.'include/inc_environment_global.php');
define('FPDF_FONTPATH','font/');
require('../ref_radio.php');
/*
while(list($a,$b)=each($_POST))
{
echo "@@".$a."##".$b;
}

while(list($a,$b)=each($_GET))
{
echo "GG".$a."GG".$b;
}
*/
function InvertiData ($anno_mese_giorno)
{
 $giorno_mese_anno=substr($anno_mese_giorno,8,2)."-".substr($anno_mese_giorno,5,2)."-".substr($anno_mese_giorno,0,4);
 return($giorno_mese_anno);
}
/*
function nuovo_elemento($elemento,$nome_cognome,$numero)
{

//echo $risposta;
if($numero==12)
	{
	$pdf = new INVOICE( 'P', 'mm', 'A4' );
	$pdf->Open();
	$pdf->AddPage();
	$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                 "P.IVA 07207761003\n" );
				 
				 
 	$pdf->SetFont('Arial','B',10);
  	$pdf->SetXY(165,20);
  	$pdf->Cell(30,5,"Roma, ".date('d-m-Y'),$border=0, $align='L');
	$pdf->Ln(16);
 	$pdf->SetFont('Arial','B',16);
  	$pdf->SetX(70);
  	$pdf->Cell(30,5,"Prestazioni del ".InvertiData($data),$border=0, $align='C');
  	$pdf->Ln(10);
	}

$prestazione=split('#',$elemento['purpose']);
##$prestazione[1] è il codice
$presta=str_replace('_',' ',$prestazione[0]);
//$presta=$prestazione[0];
$medico=$elemento['modify_id'];
//$query_pid="SELECT name_last,name_first FROM care_person WHERE pid='".$elemento['pid']."'";
//echo $query_pid;
//$risposta_pid=$db->Execute($query_pid);
//$risp_pid=$risposta_pid->FetchRow();
$pdf->Ln(6);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(10);
$pdf->Cell(20,5,"Paziente ", $border=0, $align='L');
$pdf->SetFont('Arial','',10);
$pdf->SetX(26);
$pdf->Cell(60,5,$nome_cognome['name_last']." ".$nome_cognome['name_first'], $border=0, $align='L');
$pdf->SetFont('Arial','B',10);
$pdf->SetX(85);
$pdf->Cell(20,5,"Prestazione ", $border=0, $align='L');
$pdf->SetFont('Arial','',10);
$pdf->SetX(106);
$pdf->Cell(45,5,$presta, $border=0, $align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(10);
$pdf->Cell(10,5,"Dott.", $border=0, $align='L');
$pdf->SetFont('Arial','',10);
$pdf->SetX(20);
$pdf->Cell(90,5,$medico, $border=0, $align='L');
$pdf->SetFont('Arial','B',10);
$pdf->SetX(85);
$pdf->Cell(10,5,"Firma", $border=0, $align='L');
$pdf->Ln(8);
}
*/
$mesi=Array('Gennaio'=>'01','Febbraio'=>'02','Marzo'=>'03','Aprile'=>'04','Maggio'=>'05','Giugno'=>'06','Luglio'=>'07','Agosto'=>'08','Settembre'=>'09','Ottobre'=>'10','Novembre'=>'11','Dicembre'=>'12');
  // Creating the first worksheet
   	$anno=$_GET['anno'];		
	$mese=$mesi[$_GET['mese']];
	$giorno=$_GET['giorno'];

$data=$anno."-".$mese."-".$giorno;
#(appt_status='Fatto' OR appt_status='In attesa di referto') and
$query="SELECT * from care_appointment where  date='".$data."' AND (appt_status='Fatto' OR appt_status='In attesa di referto') and modify_id!='Francesco'";
//echo $query;
$answer=$db->Execute($query);
//echo $answer;


$pdf = new INVOICE( 'P', 'mm', 'A4' );
$pdf->Open();
$pdf->AddPage();
$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                 "P.IVA 07207761003\n" );
				 
				 
 $pdf->SetFont('Arial','B',10);
  $pdf->SetXY(165,20);
  $pdf->Cell(30,5,"Roma, ".date('d-m-Y'),$border=0, $align='L');
$pdf->Ln(16);
 $pdf->SetFont('Arial','B',16);
  $pdf->SetX(70);
  $pdf->Cell(30,5,"Prestazioni del ".InvertiData($data),$border=0, $align='C');

$conto=0;
while($risposta=$answer->FetchRow())
{
$conto++;

$query_pid="SELECT name_last,name_first FROM care_person WHERE pid='".$risposta['pid']."'";
//echo $query_pid;
$risposta_pid=$db->Execute($query_pid);
$risp_pid=$risposta_pid->FetchRow();
//nuovo_elemento($risposta,$risp_pid,$conto);

$prestazione=split('#',$risposta['purpose']);
##$prestazione[1] è il codice
$presta=str_replace('_',' ',$prestazione[0]);
//$presta=$prestazione[0];
$medico=$risposta['modify_id'];
$query_pid="SELECT name_last,name_first FROM care_person WHERE pid='".$risposta['pid']."'";
$risposta_pid=$db->Execute($query_pid);
$risp_pid=$risposta_pid->FetchRow();

$pdf->Ln(8);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(10);
$pdf->Cell(20,5,"Paziente ", $border=0, $align='L');
$pdf->SetFont('Arial','',10);
$pdf->SetX(26);
$pdf->Cell(60,5,$risp_pid['name_last']." ".$risp_pid['name_first'], $border=0, $align='L');
$pdf->SetFont('Arial','B',10);
$pdf->SetX(85);
$pdf->Cell(20,5,"Prestazione ", $border=0, $align='L');
$pdf->SetFont('Arial','',10);
$pdf->SetX(106);
$pdf->Cell(45,5,$presta, $border=0, $align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(10);
$pdf->Cell(10,5,"Dott.", $border=0, $align='L');
$pdf->SetFont('Arial','',10);
$pdf->SetX(20);
$pdf->Cell(90,5,$medico, $border=0, $align='L');
$pdf->SetFont('Arial','B',10);
$pdf->SetX(85);
$pdf->Cell(10,5,"Firma", $border=0, $align='L');
$pdf->Ln(8);

if($conto==10)
{
$conto=0;
//$pdf = new INVOICE( 'P', 'mm', 'A4' );
	//$pdf->Open();
	$pdf->AddPage();
	$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                 "P.IVA 07207761003\n" );
				 
				 
 	$pdf->SetFont('Arial','B',10);
  	$pdf->SetXY(165,20);
  	$pdf->Cell(30,5,"Roma, ".date('d-m-Y'),$border=0, $align='L');
	$pdf->Ln(16);
 	$pdf->SetFont('Arial','B',16);
  	$pdf->SetX(70);
  	$pdf->Cell(30,5,"Prestazioni del ".InvertiData($data),$border=0, $align='C');
  	$pdf->Ln(10);
}

}

  $pdf->Output("../../fogli_giornalieri/".date('d-m-Y')."_".$data.".pdf","F");

header("Location:../../fogli_giornalieri/".date('d-m-Y')."_".$data.".pdf");

?>
