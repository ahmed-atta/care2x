<?php

$pdf->SetFont('Arial','B',10);
 $pdf->SetXY (140,36);
 $pdf->Cell(50,5,"Societa' Sportiva:".str_replace("\\","",$_POST['societa']),$border=0,$ln=0,$align='L');

  //require ('../modules/registration_admission/Mappa.php');

  //$pdf->SetFont('Arial','',12);
  //$pdf->Cell(190,5,"In data ".date('d-m-Y')." si compila il seguente",$border=0,$ln=0,$align='L');

  $pdf->SetFont('Arial','B',18);
  $pdf->Ln(28);
  $pdf->Cell(190,5,"RELAZIONE CONCLUSIVA",$border=0,$ln=0,$align='C');
 $pdf->Ln(12);

$pdf->SetXY (10,80);
 $pdf->SetFont('Arial','',12);
 //$pdf->MultiCell(180,5,$_POST['Referto'],$border=0,$ln=0,$align='J');
 

  $lunghezza=strlen(str_replace("\\"," ",$_POST['rel_conc_short']));
 $i=0;
$j=110;

  while ($lunghezza>0)
  {
 
$stringa=substr(str_replace("\\"," ",$_POST['rel_conc_short']),$i,$j);
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
$stringa=substr($_POST['rel_conc_short'],$i,$j);
//echo "#####".$stringa;



$pdf->Cell(180,5,str_replace("\\"," ",$stringa),$border=0,$ln=0,$align='L');
$pdf->Ln(4);
$i=$i+$j;
//echo " i ".$i;
$lunghezza=($lunghezza-$j);

$j=110;
     }

     $pdf->Ln(8);
$oramin=date('Hi');

	   $pdf->SetFont('Arial','',12);
	 //$pdf->SetX(10);
	 //$pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_SESSION['sess_login_username']);
	 $pdf->SetX(145);
	 $pdf->Cell(145,5,"Dr. ".$_SESSION['sess_login_username'],$border=0,$ln=0,$align='L');
   
   //$pdf->Cell(190,5,$stringa2,$border=0,$ln=0,$align='L');
  $pdf->Output("../../rel_conc/".$_POST['encounter_nr']."_".$_POST['delta'].$oramin.".pdf","F");

header("Location:../../rel_conc/".$_POST['encounter_nr']."_".$_POST['delta'].$oramin.".pdf");



?>
