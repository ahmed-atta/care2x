<?php
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
$pdf->Cell(180,5,str_replace("\\"," ",$stringa),$border=0,$ln=0,$align='J',$fill=0,$link='',$med_gen=1);
$pdf->Ln(6);
$i=$i+$j;
//echo " i ".$i;
$lunghezza=($lunghezza-$j);

$j=105;
     }
}
$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$_POST['societa']),$border=0,$ln=0,$align='L');
  //require ('../modules/registration_admission/Mappa.php');

  //$pdf->Cell(190,5,$mappa['$codice'],$border=0,$ln=0,$align='C');
  $pdf->Ln(16);
  //$pdf->SetFont('Arial','',12);
  //$pdf->Cell(190,5,"In data ".date('d-m-Y')." si compila il seguente",$border=0,$ln=0,$align='L');
$codice=$_POST['item_code'];
 $pdf->SetFont('Arial','B',16);
  $pdf->Ln(12);
  if ($codice!="CO430")
  $pdf->Cell(190,5,"REFERTO DI ".strtoupper($mappa[$codice][0]),$border=0,$ln=0,$align='C');
  else
    $pdf->Cell(190,5,"VALUTAZIONE CLINICA",$border=0,$ln=0,$align='C');


$pdf->SetXY (10,75);
 $pdf->SetFont('Arial','B',12);
 //$pdf->MultiCell(180,5,$_POST['Referto'],$border=0,$ln=0,$align='J');
   $pdf->Cell(57,5,"Motivo della consultazione: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
   $pdf->Cell(125,5,str_replace("\\","",$_POST['consultazione']),$border=0,$ln=0,$align='L');
$pdf->Ln(10);
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(190,5,"RILIEVI ANAMNESTICI",$border=0,$ln=0,$align='L');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',12);
$pdf->Cell(43,5,"Anamnesi Familiare:",$border=0,$ln=0,$align='L');
 $pdf->SetFont('Arial','',12);
 if(strlen($_POST['familiare_medicina'])>82)
{
$stringa_corta=substr($_POST['familiare_medicina'],0,82);
$posizione_ultimo_vuoto=strrpos($stringa_corta," ");
$pdf->Cell(140,5,str_replace("\\"," ",substr($_POST['familiare_medicina'],0,$posizione_ultimo_vuoto)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['familiare_medicina'],$posizione_ultimo_vuoto+1)));
}
else 
$pdf->Cell(140,5,str_replace("\\"," ",$_POST['familiare_medicina']), $border=0, $align='L');
$pdf->Ln(4);
//$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['familiare_medicina']));
if ($_POST['familiare_medicina'])
$pdf->Ln(2);
else
  $pdf->Ln(8);
 //$pdf->Cell(190,5,str_replace("\\","",$_POST['familiare']),$border=0,$ln=0,$align='L');
//$pdf->Ln(8);
 $pdf->SetFont('Arial','B',14);
 $pdf->Cell(190,5,"ANAMNESI PERSONALE FISIOLOGICA",$border=0,$ln=0,$align='L');
 $pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
 $pdf->Cell(62,5,"Nascita e Sviluppo psicofisico :",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['psicofisico']));
if ($_POST['psicofisico'])
$pdf->Ln(2);
else
  $pdf->Ln(6);
  $pdf->SetFont('Arial','B',12);
$pdf->Cell(31,5,"Alimentazione: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(139,5,str_replace("\\","",$_POST['alimentazione']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(24,5,"Digestione: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(156,5,str_replace("\\","",$_POST['digestione']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(16,5,"Diuresi: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(74,5,str_replace("\\","",$_POST['diuresi']),$border=0,$ln=0,$align='L');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(12,5,"Alvo: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(180,5,str_replace("\\","",$_POST['alvo']),$border=0,$ln=0,$align='L');

 $pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(35,5,"Riposo Notturno: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(145,5,str_replace("\\","",$_POST['riposo']),$border=0,$ln=0,$align='L');

$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(14,5,"Caffe': ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(45,5,str_replace("\\","",$_POST['caffe']),$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(13,5,"Fumo: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(45,5,str_replace("\\","",$_POST['fumo']),$border=0,$ln=0,$align='L');
//$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(19,5,"Alcolici: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,5,str_replace("\\","",$_POST['alcolici']),$border=0,$ln=0,$align='L');

$query="SELECT per.sex FROM care_encounter AS enc LEFT JOIN care_person AS per ON per.pid=enc.pid WHERE enc.encounter_nr=".$_POST['encounter_nr'];
$sesso=$db->Execute($query);
$sesso=$sesso->FetchRow();

if ($sesso['sex']=='f')
{
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(35,5,"Ciclo Mestruale :",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(105,5,str_replace("\\","",$_POST['ciclo']),$border=0,$ln=0,$align='L');
}
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(31,5,"Terapie in atto: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['terapie']));

//$pdf->Cell(149,5,str_replace("\\","",$_POST['terapie']),$border=0,$ln=0,$align='L');
if($_POST['terapie'])
$pdf->Ln(2);
else
$pdf->Ln(6);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,5,"Uso di farmaci od integratori: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['farmaci']));
//$pdf->Cell(130,5,str_replace("\\","",$_POST['farmaci']),$border=0,$ln=0,$align='L');
if($_POST['farmaci'])
$pdf->Ln(2);
else
$pdf->Ln(6);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Fase di preparazione: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(145,5,str_replace("\\","",$_POST['preparazione']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,5,"Anamnesi personale patologica: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\","",$_POST['personale_medicina']));
if($_POST['personale_medicina'])
$pdf->Ln(2);
else
$pdf->Ln(6);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(27,5,"Vaccinazioni: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(153,5,str_replace("\\","",$_POST['vaccinazioni']),$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','B',12);
 $pdf->Ln(8);
$pdf->Cell(18,5,"Allergie: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(162,5,str_replace("\\","",$_POST['allergie']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetX(130);
$pdf->Cell(50,5,"Firmato.............................",$border=0,$ln=0,$align='L');


$pdf->Open();
$pdf->AddPage();
$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                 "P.IVA 07207761003\n" );

  
$pdf->UPC_A(10,35,$_POST['encounter_nr']);
  

####l'if viene commentato perch? di fatto la data ? presumibile che la vogliano tutti
//if ($_POST['item_code']=='CO430')
 // {
 $pdf->SetFont('Arial','B',10);
  $pdf->SetXY(150,20);
  $pdf->Cell(30,5,"Roma, ".substr($data_app['date'],8,2)."-".substr($data_app['date'],5,2)."-".substr($data_app['date'],0,4),$border=0, $align='L');
  //}
  /*
$query="SELECT * FROM care_encounter WHERE encounter_nr=".$_POST['encounter_nr'];
$pid=$db->Execute($query);
$pid=$pid->FetchRow();
$pidgiusto=$pid['pid'];
$query2="SELECT * FROM care_person WHERE pid=".$pidgiusto;
$data=$db->Execute($query2);
$data=$data->FetchRow();
*/
$chi="SELECT per.* FROM care_encounter AS enc LEFT JOIN care_person AS per ON per.pid=enc.pid WHERE enc.encounter_nr=".$_POST['encounter_nr'];
$rispo=$db->Execute($chi);
$data=$rispo->FetchRow();
$nome=$data['name_first'];
$cognome=$data['name_last'];

$compleanno=$data['date_birth'];
$federazione=$data['religion'];

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
  $pdf->Cell(190,5,"Data di nascita: ".$compleanno, $border=0, $align='L');
  $pdf->SetX( 110 );
  $pdf->Cell(190,5,"Federazione: ".$federazione,$border=0, $align='L');
  $pdf->Ln(8);
  $pdf->SetX( 55 );
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,"Sport: ".$data['name_maiden'], $border=0, $align='L');
  $pdf->SetX( 110 );
  $pdf->Cell(190,5,"Specialita':".$data['name_3'],$border=0, $align='L');
  $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".$_POST['societa'],$border=0,$ln=0,$align='L');
  //require ('../modules/registration_admission/Mappa.php');

  //$pdf->Cell(190,5,$mappa['$codice'],$border=0,$ln=0,$align='C');
  $pdf->Ln(24);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,5,"ESAME CLINICO GENERALE",$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(43,5,"Condizioni Generali: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(145,5,str_replace("\\"," ",$_POST['generali']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(47,5,"Cute e mucose visibili: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(135,5,str_replace("\\"," ",$_POST['visibili']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,5,"Sottocutaneo: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(145,5,str_replace("\\"," ",$_POST['sottocutaneo']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(35,5,"Masse muscolari: ",$border=0,$ln=0,$align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(75,5,str_replace("\\"," ",$_POST['masse']),$border=0,$ln=0,$align='L');

$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(12,5,"Capo: ",$border=0,$ln=0,$align='L');
//$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Vai_a_capo($_POST['capo']);
$pdf->Cell(182,5,str_replace("\\"," ",$_POST['capo']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(17,5,"Faringe: ",$border=0,$ln=0,$align='L');
//$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Vai_a_capo($_POST['faringe']);
$pdf->Cell(173,5,str_replace("\\"," ",$_POST['faringe']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(24,5,"Dentatura: ",$border=0,$ln=0,$align='L');
//$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Vai_a_capo($_POST['dentatura']);
$pdf->Cell(160,5,str_replace("\\"," ",$_POST['dentatura']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(17,5,"Tiroide: ",$border=0,$ln=0,$align='L');
//$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Vai_a_capo($_POST['tiroide']);
$pdf->Cell(163,5,str_replace("\\"," ",$_POST['tiroide']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(16,5,"Torace: ",$border=0,$ln=0,$align='L');
//$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//$pdf->Vai_a_capo($_POST['torace']);
$pdf->Cell(174,5,str_replace("\\"," ",$_POST['torace']),$border=0,$ln=0,$align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
if ($_POST['respiratorio'])
{
$pdf->Cell(45,5,"Apparato respiratorio: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['respiratorio']));
//$pdf->Cell(145,5,$_POST['respiratorio'],$border=0,$ln=0,$align='L');
$pdf->Ln(2);
}
if($_POST['cardiovascolare'])
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(55,5,"Apparato cardiovascolare: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['cardiovascolare']));
//$pdf->Cell(135,5,$_POST['cardiovascolare'],$border=0,$ln=0,$align='L');
$pdf->Ln(2);
}
if($_POST['digerente'])
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(42,5,"Apparato digerente: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['digerente']));
//$pdf->Cell(148,5,$_POST['digerente'],$border=0,$ln=0,$align='L');
$pdf->Ln(2);
}
if($_POST['urogenitale'])
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(46,5,"Apparato urogenitale: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['urogenitale']));
$pdf->Ln(2);
}
if ($_POST['osteoarticolare'])
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(46,5,"Apparato osteoarticolare: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['osteoarticolare']));
$pdf->Ln(2);
}
if($_POST['neuromuscolare'])
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(46,5,"Apparato neuromuscolare: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['neuromuscolare']));
$pdf->Ln(2);
}
if($_POST['altro'])
{
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,5,"Altro: ",$border=0,$ln=0,$align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
$pdf->Vai_a_capo(str_replace("\\"," ",$_POST['altro']));
}
//$pdf->Cell(144,5,$_POST['urogenitale'],$border=0,$ln=0,$align='L');
$pdf->Ln(8);
	   $pdf->SetFont('Arial','',12);
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(145);
	 $pdf->Cell(120,5,"Roma, ".date('d-m-Y'),$border=0,$ln=0,$align='L');
		  $pdf->Ln(6);
		  	 $pdf->SetX(145);
	 $pdf->Cell(50,5,"Dr. ".$_POST['sess_user_name'],$border=0,$ln=0,$align='L');
   
##ERANO LE CONCLUSIONI IN BREVE	 
/*
$pdf->Open();
$pdf->AddPage();
$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                 "P.IVA 07207761003\n" );

  
$pdf->UPC_A(10,35,$_POST['encounter_nr']);
  
	

  $pdf->SetX( 55 );
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,"Paziente: ".$_POST['encounter_nr'], $border=0, $align='L');
  $pdf->SetX( 110 );
  $pdf->Cell(190,5,"Visita Num.: ".$_POST['appt_nr'],$border=0, $align='L');
  $pdf->Ln(8);
  $pdf->SetX( 55 );
  $pdf->Cell(190,5,"Data di nascita: ".$compleanno, $border=0, $align='L');
  $pdf->SetX( 110 );
  $pdf->Cell(190,5,"Federazione: ".$federazione,$border=0, $align='L');
  
  $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".$_POST['societa'],$border=0,$ln=0,$align='L');
 
	  $pdf->Ln(24);
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(190,5,"In data ".date('d-m-Y')." si compilano le seguenti",$border=0,$ln=0,$align='L');
 $pdf->SetFont('Arial','B',16);
  $pdf->Ln(16);
  $pdf->Cell(190,5,"CONCLUSIONI IN BREVE",$border=0,$ln=0,$align='C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',12);
  $pdf->Vai_a_capo(str_replace("\\","",$_POST['conc_brevi']));
  
  $pdf->Ln(8);
	   $pdf->SetFont('Arial','',12);
	 $pdf->SetX(10);
	 $pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(15);
	 $pdf->Cell(120,5,"Dott. ".$_POST['sess_user_name'],$border=0,$ln=0,$align='L');
 */ $pdf->Output("../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf","F");

header("Location:../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf");

?>
