<?php
// (c) Xavier Nicolay
// Exemple de g�n�ration de devis/facture PDF

define('FPDF_FONTPATH','font/');
require('invoice.php');
require('../include/inc_environment_global.php');

//Variabili
//while (list($a,$b)=each($HTTP_POST_VARS))
//echo " AAA ".$a. " BBB ".$b;;

$stringa1='';
$stringa1.=$_POST['storno1'];
$stringa1.=$_POST['num_fattura'];
$stringa1.=$_POST['storno2'];
$stringa1.=$_POST['data'];
$stringa1.=$_POST['storno3'];
$stringa1.=$_POST['tot_fattura'];
$stringa1.=$_POST['storno4'];
$stringa1.=$_POST['credito'];
$stringa1.=$_POST['storno5'];
$dataini=date('Y-m-d');

$data=substr($dataini,8,2).'-'.substr($dataini,5,3).substr($dataini,0,4);
$query="INSERT INTO care_storno (storno_encounter_nr, storno_bill_no, storno_date, storno_total_amount) VALUES (".$_POST['encounter_nr'].",".$_POST['num_fattura'].",".$dataini.",".$_POST['credito'].")";
$db->Execute($query);
function Vai_a_capo($testo)
{
global $pdf;
  $j=105;
  $lunghezza=strlen($testo);
  while ($lunghezza>0)
  {
 
$stringa=substr($testo,$i,$j);
$verifica=substr($stringa,$j-1,1);

$pippo=0;
while($verifica!=' ')
{
	--$j;
	//echo " VERIFICA ".$verifica;

	$verifica=substr($stringa,$j-1,1);
//echo substr($stringa,$j-1,$j);
//echo " VERIFICA ".$verifica;
//echo " j ".$j;
$pippo++;
if ($pippo>12) break;

}
//echo $j;
$stringa=substr($testo,$i,$j);
//echo "#####".$stringa;
###La funzione originale nelle due linee qui sotto ha $this-> e non $pdf->, ma qui funziona cos?, per cui...
$pdf->Cell(180,5,$stringa,$border=0,$ln=0,$align='J');
$pdf->Ln(6);
$i=$i+$j;
//echo " i ".$i;
$lunghezza=($lunghezza-$j);

$j=105;
     }
}



$query0="SELECT storno_id FROM care_storno ORDER BY storno_id DESC LIMIT 1";
$risposta0=$db->Execute($query0);
$risposta0=$risposta0->FetchRow();
$num_storno=$risposta0['storno_id'];

$query1='SELECT * from care_encounter WHERE encounter_nr='.$_POST['encounter_nr'];
$res1=$db->Execute($query1);
$pid=$res1->FetchRow();
$codicefiscale=$pid['insurance_nr'];
$pid=$pid['pid'];
$query2='SELECT * from care_person WHERE pid='.$pid;
$res2=$db->Execute($query2);
$dati=$res2->FetchRow();
//$querycity='SELECT * from care_ WHERE nr='.$dati['addr_citytown_nr'];
//$rescity=$db->Execute($querycity);
//$city=$rescity->FetchRow();
//$city=$city['name'];

$pdf = new INVOICE( 'P', 'mm', 'A4' );
$pdf->Open();
$pdf->AddPage();
$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                  "P.IVA 07207761003\n" .
                  "" );
$pdf->fact_dev( "Nota di credito ", "ISS-M-".$num_storno );


//$query=" SELECT * from care_billing_bill where bill_no=".$num_bill.'"';
//$db->Execute($query);
//cambiamo l formato della data


$pdf->addDate($data);
$pdf->addClient($_POST['encounter_nr']);
$pdf->addPageNumber("1");
if ($dati['sex']=='m') $titolo='Egr. Sig.';
else $titolo='Gen.le Sig.ra';
$pdf->addClientAdresse("$titolo \n".$dati['name_first']." ".$dati['name_last']." \n".$dati['addr_str'].", ".$dati['addr_str_nr']."\n".$dati['addr_zip']." ".$dati['sss_nr']."\n\nCod.Fiscale:".$codicefiscale);
$pdf->Ln(8);
$pdf->SetFont('Arial','',12);
//$pdf->Cell(10,5,$_POST['storno'], $border=0, $align='C');
Vai_a_capo($stringa1);
##NOTA: qui chiamiamo la funzione senza mettere $pdf->Vai_a_capo($testo), perch? si ? modificata la funzione 
##sopra mettendo $pdf-> anzich? $this->...come mai cos? vada e col? no non lo so, per? funziona ora!!!!!

//$pdf->addReference(" ".$_POST['storno']);




//$y   += $size + 2;

//$line = array( "Codice"    => " ",
              // "Descrizione della prestazione"  => $_POST['storno'],
              // "Quantita'"     => " ",
              // "Prezzo Unitario"      => " ",
               //"Importo" => " " );
//$size = $pdf->addLine( $y, $line );
//$y   += $size +2;


$pdf->Output("../storni/".$num_storno.".pdf","F");
//$pdf->Output();
header("Location:../storni/".$num_storno.".pdf");


?>

