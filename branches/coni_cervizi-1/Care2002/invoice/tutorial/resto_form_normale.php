<?php
$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (140,34);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$_POST['societa']),$border=0,$ln=0,$align='L');

  //require ('../modules/registration_admission/Mappa.php');

  //$pdf->SetFont('Arial','',12);
  //$pdf->Cell(190,5,"In data ".date('d-m-Y')." si compila il seguente",$border=0,$ln=0,$align='L');
if($med_gen==1)
{
  $pdf->SetFont('Arial','B',14);
  $pdf->Ln(12);
  $pdf->Cell(190,5,"CONCLUSIONE BREVE",$border=0,$ln=0,$align='C');
}
else
{
  $codice=$_POST['item_code'];
  $pdf->Ln(28);
  $pdf->SetFont('Arial','B',16);
  //aggiungo il titolo del referto
  $pdf->Cell(190,5,"REFERTO ".$mappa[$codice][0]." ".$_POST['titoloreferto'],$border=0,$ln=0,$align='C');
  //$pdf->Cell(190,5,"REFERTO ".$mappa[$codice][0],$border=0,$ln=0,$align='C');
  //$pdf->Cell(190,5,$mappa['$codice'],$border=0,$ln=0,$align='C');
  $pdf->Ln(12);
}

$pdf->SetXY (10,80);
 $pdf->SetFont('Arial','',12);
 //$pdf->MultiCell(180,5,$_POST['Referto'],$border=0,$ln=0,$align='J');
 

  $lunghezza=strlen($_POST['Referto']);
 $i=0;
$j=105;

  while ($lunghezza>0)
  {
 
$stringa=substr($_POST['Referto'],$i,$j);
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
$stringa=substr($_POST['Referto'],$i,$j);
//echo "#####".$stringa;



$pdf->Cell(180,5,str_replace("\\"," ",$stringa),$border=0,$ln=0,$align='L');
$pdf->Ln(4);
$i=$i+$j;
//echo " i ".$i;
$lunghezza=($lunghezza-$j);

$j=110;
     }

     $pdf->Ln(8);

	   $pdf->SetFont('Arial','',12);
	 //$pdf->SetX(10);
	 //$pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(145);
	 $pdf->Cell(145,5,"Dr. ".$_POST['sess_user_name'],$border=0,$ln=0,$align='L');
   $pdf->Cell(120,5,"Roma, ".date('d-m-Y'),$border=0,$ln=0,$align='L');
		  $pdf->Ln(6);
		  	 $pdf->SetX(145);
   //$pdf->Cell(190,5,$stringa2,$border=0,$ln=0,$align='L');
  $pdf->Output("../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf","F");

header("Location:../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf");

?>
