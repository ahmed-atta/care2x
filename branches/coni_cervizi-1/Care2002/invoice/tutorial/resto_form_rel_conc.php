<?php
/*while(list($a,$b)=each($_POST))
{
echo "@@".$a."##".$b;
}
*/
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

$giorno="20".substr($_POST['delta'],0,2)."-".substr($_POST['delta'],2,2)."-".substr($_POST['delta'],4,2)."";
$pdf->SetFont('Arial','B',18);
  $pdf->Ln(6);
  $pdf->Cell(190,5,"VALUTAZIONE MEDICO SPORTIVA",$border=0,$ln=0,$align='C');
      $pdf->Ln(20);
  $pdf->Rect(10,74,190,57,'D');
  $chi="SELECT per.*, enc.* FROM care_encounter AS enc LEFT JOIN care_person AS per ON per.pid=enc.pid WHERE enc.encounter_nr=".$_POST['encounter_nr'];
$answer=$db->Execute($chi);
$ans=$answer->FetchRow();
 
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,5,"COGNOME ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Cell(65,5,$ans['name_last'],$border=0,$ln=0,$align='L');
 $pdf->SetFont('Arial','B',14);
$pdf->Cell(20,5,"NOME ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Cell(75,5,$ans['name_first'],$border=0,$ln=0,$align='L');
 $pdf->Ln(8);
 
 $pdf->SetFont('Arial','B',14);
$pdf->Cell(25,5,"NATO A ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
  if($ans['name_middle'])
  $natoa=$ans['name_middle'];
  else
  $natoa=$ans['sss_nr'];
 $pdf->Cell(70,5,$natoa,$border=0,$ln=0,$align='L');
 $pdf->SetFont('Arial','B',14);
$pdf->Cell(10,5,"IL ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Cell(85,5,$ans['date_birth'],$border=0,$ln=0,$align='L');
 $pdf->Ln(8);
 
 
 $pdf->SetFont('Arial','B',14);
$pdf->Cell(35,5,"RESIDENTE A ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Cell(60,5,$ans['sss_nr'],$border=0,$ln=0,$align='L');
 $pdf->SetFont('Arial','B',14);
$pdf->Cell(30,5,"TELEFONO ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
   if($ans['phone_1_nr'])
  $tel=$ans['phone_1_nr'];
  else
  $tel=$ans['cellphone_1_nr'];
 $pdf->Cell(65,5,$tel,$border=0,$ln=0,$align='L');
 $pdf->Ln(8);
 
  $pdf->SetFont('Arial','B',14);
$pdf->Cell(20,5,"SPORT ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Cell(75,5,$ans['name_maiden'],$border=0,$ln=0,$align='L');
 $pdf->SetFont('Arial','B',14);
$pdf->Cell(50,5,"SPEC./CAT./RUOLO ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Cell(70,5,$ans['name_3'],$border=0,$ln=0,$align='L');
 $pdf->Ln(8);
 
   $pdf->SetFont('Arial','B',14);
$pdf->Cell(30,5,"QUALIFICA ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
  if($ans['insurance_firm_id']=='13')
   $qualifica='Interesse Nazionale';
   else if ($ans['insurance_firm_id']=='14')
  $qualifica='Probabile Olimpico';
  else if($ans['nat_id_nr'])
  $qualifica="Atleta";
  else
  $qualifica='Privato';
  
 $pdf->Cell(65,5,$qualifica,$border=0,$ln=0,$align='L');
  $pdf->Ln(8);
 $pdf->SetFont('Arial','B',14);
$pdf->Cell(82,5,"MOTIVO DELLA CONSULTAZIONE",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Cell(80,5,$_POST['motivoconsult'],$border=0,$ln=0,$align='L');
 $pdf->Ln(8);
 $pdf->SetFont('Arial','B',14);
$pdf->Cell(75,5,"SOCIETA' DI APPARTENENZA ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Cell(80,5,$ans['nat_id_nr'],$border=0,$ln=0,$align='L');
 $pdf->SetXY(10,150);
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(190,5,"ACCERTAMENTI ESEGUITI",$border=0,$ln=0,$align='C');
    $pdf->Ln(16);
$domanda="SELECT * FROM care_appointment WHERE encounter_nr=".$_POST['encounter_nr']." AND date='".$giorno."'";

$pdf->SetFont('Arial','B',12);

 $risposta=$db->Execute($domanda);
 $riga=0;
 $righe=1;
 while($rispo=$risposta->FetchRow())
 {
 	if($riga<3)
 	{
	$array=split("#",$rispo['purpose']);
	if ($array[1]!='CO430')
	
	{
	 $x=$riga*40;
 	 $pdf->SetX($x+10);
	 $pdf->Cell(40,5,str_replace("_"," ",$array[0]),$border=0,$ln=0,$align='L');
	 $riga++;
	}
	}
	else
	{
	$riga=0;
	$righe++;
	$pdf->Ln(6);
	}
 }
  $pdf->Ln(8);
  $altezza=10*$righe;
$pdf->Rect(10,163,190,$altezza,'D');



####LA SECONDA PAGINA
$pdf->Open();
$pdf->AddPage();
$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                 "P.IVA 07207761003\n" );

  
$pdf->UPC_A(10,35,$_POST['encounter_nr']);


#####HA DETTO CHE VUOLE IL FORM RIQUADRATO, PER CUI QUESTI LI COMMENTO; FINO AL ####
/*
$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (110,36);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$data['nat_id_nr']),$border=0,$ln=0,$align='L');
 
 $pdf->SetFont('Arial','B',10);
 $pdf->SetXY (160,44);
 $pdf->Cell(50,5,"Nato a:".str_replace("\\","",$data['name_middle']),$border=0,$ln=0,$align='L');
*/
####


  //$pdf->Cell(190,5,$mappa['$codice'],$border=0,$ln=0,$align='C');
  /*
  $pdf->Ln(18);
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(190,5,"ACCERTAMENTI ESEGUITI",$border=0,$ln=0,$align='C');
  $domanda="SELECT * FROM care_appointment WHERE encounter_nr=".$_POST['encounter_nr']." AND date='".$giorno."'";
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
 $risposta=$db->Execute($domanda);
 $riga=0;
 while($rispo=$risposta->FetchRow())
 {
 	if($riga<3)
 	{
	$array=split("#",$rispo['purpose']);
	if ($array[1]!='CO430')
	
	{
	 $x=$riga*40;
 	 $pdf->SetX($x+10);
	 $pdf->Cell(40,5,str_replace("_"," ",$array[0]),$border=0,$ln=0,$align='L');
	 $riga++;
	}
	}
	else
	{
	$riga=0;
	$pdf->Ln(6);
	}
 }
  $pdf->Ln(8);
  */
  //$pdf->SetFont('Arial','',12);
  //$pdf->Cell(190,5,"In data ".date('d-m-Y')." si compila la seguente",$border=0,$ln=0,$align='L');

$pdf->SetFont('Arial','B',10);
  $pdf->SetXY(150,20);
  $pdf->Cell(30,5,"Roma, ".date('d-m-Y'),$border=0, $align='L');
$codice=$_POST['item_code'];
 $pdf->SetFont('Arial','B',18);
  $pdf->Ln(22);
  $pdf->Cell(190,5,"RELAZIONE CONCLUSIVA",$border=0,$ln=0,$align='C');
  $pdf->SetFont('Arial','B',14);
  $pdf->Ln(16);
    $pdf->Cell(190,5,"SINTESI ANAMNESTICA ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
 $pdf->Ln(8);
 $pdf->Vai_a_capo(str_replace("\\"," ",$_POST['anamnestica']));
 $pdf->Ln(4);
 $pdf->SetFont('Arial','B',14);
 
    $pdf->Cell(190,5,"SINTESI DEGLI ACCERTAMENTI COMPIUTI ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
   $pdf->Ln(8);
   $dascrivere=str_replace("\\"," ",$_POST['accertamenti']);
   
   $arraydascrivere=split("---",$dascrivere);
  $i2=1;
  while($arraydascrivere[$i2])
  { 
  $arraydascrivere2=split("@:",$arraydascrivere[$i2]);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(50,5,$arraydascrivere2[0]." :",$border=0,$ln=0,$align='L');
  $pdf->Ln(6);
   $pdf->SetFont('Arial','',12);
 $pdf->Vai_a_capo(ltrim($arraydascrivere2[1]));
 $pdf->Ln(2);
  $i2++;
  }
 $pdf->Ln(4);
 $pdf->SetFont('Arial','B',14);
 
    $pdf->Cell(190,5,"CONCLUSIONI ",$border=0,$ln=0,$align='L');
  $pdf->SetFont('Arial','',12);
   $pdf->Ln(8);
 $pdf->Vai_a_capo(str_replace("\\"," ",$_POST['conclusioni']));
 
 $pdf->Ln(8);
	   $pdf->SetFont('Arial','',12);
	 //$pdf->SetX(140);
	 //$pdf->Cell(25,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=rtrim(ltrim($_SESSION['sess_login_username']));
	 $pdf->SetX(145);
	 $pdf->Cell(50,5,"Dr. ".$nome,$border=0,$ln=0,$align='L');
 
$pdf->Output("../../rel_conc/".$_POST['encounter_nr']."_".$_POST['delta'].".pdf","F");

header("Location:../../rel_conc/".$_POST['encounter_nr']."_".$_POST['delta'].".pdf");

?>
