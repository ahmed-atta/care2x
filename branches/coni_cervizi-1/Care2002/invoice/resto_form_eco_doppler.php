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
$pdf->SetXY(65,60);
$pdf->Cell(190,5,"Referto Ecocardiogramma Doppler", $border=0, $align='R');
//$pdf=new PDF();
$pdf->Ln(14);
//Column titles
$pdf->SetFont('Arial','B',12);
$pdf->Cell(12,5,"Peso: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,str_replace("\\"," ",$_POST['peso_']), $border=0, $align='L');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,5,"Altezza: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,str_replace("\\"," ",$_POST['altezza_']." cm"), $border=0, $align='L');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Superficie corporea: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,str_replace("\\"," ",$_POST['superficie_']." m^2"), $border=0, $align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,5,"Motivo della visita: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(150,5,str_replace("\\"," ",str_replace("_"," ",$_POST['motivo'])), $border=0, $align='L');
$pdf->Ln(8);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,5,"Anamnesi Cardiologica: ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
if(strlen($_POST['anamnesi_cardiologica'])>72)
{
$stringa_corta=substr($_POST['anamnesi_cardiologica'],0,72);
$posizione_ultimo_vuoto=strrpos($stringa_corta," ");
$pdf->Cell(140,5,str_replace("\\"," ",substr($_POST['anamnesi_cardiologica'],0,$posizione_ultimo_vuoto)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['anamnesi_cardiologica'],$posizione_ultimo_vuoto+1)));
}
else 
$pdf->Cell(140,5,str_replace("\\"," ",$_POST['anamnesi_cardiologica']), $border=0, $align='L');
//$pdf->Cell(190,5,str_replace("\\"," ",$_POST['anamnesi_cardiologica']), $border=0, $align='L');
$pdf->Ln(4);

$header=array("Campo",'Valore'," ");

$dati[0][0]="SIV anteriore";
$dati[0][2]="mm";
$dati[0][1]=$_POST['siv_anteriore_'];

$dati[1][0]="Parete posteriore";
$dati[1][1]=$_POST['par_posteriore_'];;
$dati[1][2]="mm";

$dati[2][0]="Diametro V.S. diastolico";
$dati[2][1]=$_POST['diastolico_'];;
$dati[2][2]="mm";

$dati[3][0]="Aorta";
$dati[3][1]=$_POST['aorta'];;
$dati[3][2]="mm";

$dati[4][0]="Massa V.S.";
$dati[4][1]=$_POST['massa_vs_'];;
$dati[4][2]="gr";

$dati[5][0]="EF (%)";
$dati[5][1]=$_POST['ef'];;
//$dati[2][2]="";

$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(10,125);
$pdf->ImprovedTable6($header,$dati);

//$header=array("Campo",'Valore'," ");
$dati[0][0]="SIV posteriore";
$dati[0][2]="mm";
$dati[0][1]=$_POST['siv_posteriore'];

$dati[1][0]="Parete laterale";
$dati[1][1]=$_POST['par_laterale'];;
$dati[1][2]="mm";

$dati[2][0]="Diametro V.S. sistolico";
$dati[2][1]=$_POST['sistolico'];;
$dati[2][2]="mm";

$dati[3][0]="Atrio sinistro";
$dati[3][1]=$_POST['atrio'];;
$dati[3][2]="mm";

$dati[4][0]="Massa V.S./S.C.";
$dati[4][1]=$_POST['massa_sc_'];;
$dati[4][2]="gr/m^2";

$dati[5][0]="h/r";
$dati[5][1]=$_POST['hr_'];;
//$dati[2][2]="";

$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(100,125);
$pdf->ImprovedTable6bis($header,$dati);
$pdf->Ln(4);
//$pdf->SetFont('Arial','B',14);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"VENTRICOLO SINISTRO: ", $border=0, $align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(32,5,"-Morfologia ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
if(strlen($_POST['morfologia_sx'])>88)
{
$stringa_corta_2=substr($_POST['morfologia_sx'],0,88);
$posizione_ultimo_vuoto_2=strrpos($stringa_corta_2," ");
$pdf->Cell(163,5,str_replace("\\"," ",substr($_POST['morfologia_sx'],0,$posizione_ultimo_vuoto_2)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['morfologia_sx'],$posizione_ultimo_vuoto_2+1)));
}
else 
{
$pdf->Cell(155,5,str_replace("\\"," ",$_POST['morfologia_sx']), $border=0, $align='L');
//$pdf->Cell(130,5,str_replace("\\"," ",$_POST['arresto']), $border=0, $align='L');
$pdf->Ln(6);
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,5,"-Cinesi ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
if(strlen($_POST['cinesi_sn'])>90)
{
$stringa_corta_3=substr($_POST['cinesi_sn'],0,90);
$posizione_ultimo_vuoto_3=strrpos($stringa_corta_3," ");
$pdf->Cell(175,5,str_replace("\\"," ",substr($_POST['cinesi_sn'],0,$posizione_ultimo_vuoto_3)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['cinesi_sn'],$posizione_ultimo_vuoto_3+1)));
}
else
$pdf->Cell(175,5,str_replace("\\"," ",$_POST['cinesi_sn']), $border=0, $align='L');
//$pdf->Cell(130,5,str_replace("\\"," ",$_POST['arresto']), $border=0, $align='L');
$pdf->Ln(6);
//$pdf->SetFont('Arial','B',14);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"VENTRICOLO DESTRO: ", $border=0, $align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(32,5,"-Morfologia ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
if(strlen($_POST['morfologia_dx'])>88)
{
$stringa_corta_4=substr($_POST['morfologia_dx'],0,88);
$posizione_ultimo_vuoto_4=strrpos($stringa_corta_4," ");
$pdf->Cell(163,5,str_replace("\\"," ",substr($_POST['morfologia_dx'],0,$posizione_ultimo_vuoto_4)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['morfologia_dx'],$posizione_ultimo_vuoto_4+1)));
}
else
{
$pdf->Cell(155,5,str_replace("\\"," ",$_POST['morfologia_dx']), $border=0, $align='L');
//$pdf->Cell(130,5,str_replace("\\"," ",$_POST['arresto']), $border=0, $align='L');
$pdf->Ln(6);
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,5,"-Cinesi ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
if(strlen($_POST['cinesi_dx'])>90)
{
$stringa_corta_5=substr($_POST['cinesi_dx'],0,90);
$posizione_ultimo_vuoto_5=strrpos($stringa_corta_5," ");
$pdf->Cell(175,5,str_replace("\\"," ",substr($_POST['cinesi_dx'],0,$posizione_ultimo_vuoto_5)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['cinesi_dx'],$posizione_ultimo_vuoto_5+1)));
}
else
$pdf->Cell(175,5,str_replace("\\"," ",$_POST['cinesi_dx']), $border=0, $align='L');
//$pdf->Cell(130,5,str_replace("\\"," ",$_POST['arresto']), $border=0, $align='L');
$pdf->Ln(6);

$pdf->SetFont('Arial','B',12);
//$pdf->Cell(42,5,"-Apparati valvolari ", $border=0, $align='L');
$pdf->Cell(42,5,"APPARATI VALVOLARI :", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
//if(strlen($_POST['apparati'])>78)
if(strlen($_POST['apparati'])>62)
{
//$stringa_corta_6=substr($_POST['apparati'],0,78);
$stringa_corta_6=substr($_POST['apparati'],0,62);
$posizione_ultimo_vuoto_6=strrpos($stringa_corta_6," ");
$pdf->Cell(100,5,"       ".str_replace("\\"," ",substr($_POST['apparati'],0,$posizione_ultimo_vuoto_6)), $border=0, $align='L');
//$pdf->Cell(153,5,str_replace("\\"," ",substr($_POST['apparati'],0,$posizione_ultimo_vuoto_6)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['apparati'],$posizione_ultimo_vuoto_6+1)));
}
else
{
$pdf->Cell(100,5,"       ".str_replace("\\"," ",$_POST['apparati']), $border=0, $align='L');
//$pdf->Cell(153,5,str_replace("\\"," ",$_POST['apparati']), $border=0, $align='L');
$pdf->Ln(6);
}
$pdf->SetFont('Arial','B',12);
//$pdf->Cell(37,5,"-Osti coronarici ", $border=0, $align='L');
$pdf->Cell(37,5,"OSTI CORONARICI :", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
//if(strlen($_POST['osti'])>85)
if(strlen($_POST['osti'])>55)
{
//$stringa_corta_7=substr($_POST['osti'],0,85);
$stringa_corta_7=substr($_POST['osti'],0,55);
$posizione_ultimo_vuoto_7=strrpos($stringa_corta_7," ");
//$pdf->Cell(158,5,str_replace("\\"," ",substr($_POST['osti'],0,$posizione_ultimo_vuoto_7)), $border=0, $align='L');
$pdf->Cell(100,5,"    ".str_replace("\\"," ",substr($_POST['osti'],0,$posizione_ultimo_vuoto_7)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['osti'],$posizione_ultimo_vuoto_7+1)));
}
else
{
//$pdf->Cell(158,5,str_replace("\\"," ",$_POST['osti']), $border=0, $align='L');
$pdf->Cell(100,5,"    ".str_replace("\\"," ",$_POST['osti']), $border=0, $align='L');
$pdf->Ln(6);
}
$pdf->SetFont('Arial','B',12);
//$pdf->Cell(32,5,"-Arco aortico ", $border=0, $align='L');
$pdf->Cell(32,5,"ARCO AORTICO :", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
//if(strlen($_POST['arco'])>88)
if(strlen($_POST['arco'])>65)
{
//$stringa_corta_8=substr($_POST['arco'],0,88);
$stringa_corta_8=substr($_POST['arco'],0,65);
$posizione_ultimo_vuoto_8=strrpos($stringa_corta_8," ");
//$pdf->Cell(145,5,str_replace("\\"," ",substr($_POST['arco'],0,$posizione_ultimo_vuoto_8)), $border=0, $align='L');
$pdf->Cell(145,5,"     ".str_replace("\\"," ",substr($_POST['arco'],0,$posizione_ultimo_vuoto_8)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['arco'],$posizione_ultimo_vuoto_8+1)));
}
else
{
//$pdf->Cell(145,5,str_replace("\\"," ",$_POST['arco']), $border=0, $align='L');
$pdf->Cell(145,5,"     ".str_replace("\\"," ",$_POST['arco']), $border=0, $align='L');
$pdf->Ln(6);
}
$pdf->SetFont('Arial','B',12);
//$pdf->Cell(40,5,"-Arteria Polmonare ", $border=0, $align='L');
$pdf->Cell(40,5,"ARTERIA POLMONARE :", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
//if(strlen($_POST['arte_polmonare'])>88)
if(strlen($_POST['arte_polmonare'])>58)
{
//$stringa_corta_9=substr($_POST['arte_polmonare'],0,88);
$stringa_corta_9=substr($_POST['arte_polmonare'],0,58);
$posizione_ultimo_vuoto_9=strrpos($stringa_corta_9," ");
//$pdf->Cell(150,5,str_replace("\\"," ",substr($_POST['arte_polmonare'],0,$posizione_ultimo_vuoto_9)), $border=0, $align='L');
$pdf->Cell(150,5,"          ".str_replace("\\"," ",substr($_POST['arte_polmonare'],0,$posizione_ultimo_vuoto_9)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['arte_polmonare'],$posizione_ultimo_vuoto_9+1)));
}
else
//$pdf->Cell(150,5,str_replace("\\"," ",$_POST['arte_polmonare']), $border=0, $align='L');
$pdf->Cell(150,5,"         ".str_replace("\\"," ",$_POST['arte_polmonare']), $border=0, $align='L');



####LA SECONDA PAGINA
$pdf->Open();
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
  #$pdf->Cell(30,5,"Roma, ".date('d-m-Y'),$border=0, $align='L');
  $query_data_app="SELECT date FROM care_appointment WHERE nr=".$_POST['appt_nr'];
  $rispo_data_app=$db->Execute($query_data_app);
  $data_app=$rispo_data_app->FetchRow();
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
 
  $pdf->SetX( 147 );
  $pdf->Cell(190,5,"Qualifica: ".$qualifica,$border=0, $align='L');

$codice=$_POST['item_code'];
 $pdf->SetFont('Arial','B',18);
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Polmonare ", $border=0, $align='L');
  $pdf->Ln(6);
$header=array("Campo",'Valore'," ");


$dati2[0][0]="Gradiente max";
$dati2[0][2]="mmHg";
$dati2[0][1]=$_POST['grad_polmonare'];


$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(10,65);
$pdf->ImprovedTable6($header,$dati2);
$pdf->Ln(8);


$dati2[0][0]="Reflusso";
$dati2[0][2]="";
$dati2[0][1]=$_POST['reflusso_polmonare'];


$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(100,65);
$pdf->ImprovedTable6bis($header,$dati2);
$pdf->Ln(6);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Tricuspide ", $border=0, $align='L');
//  $pdf->Ln(6);
$header=array("Campo",'Valore'," ");


$dati2[0][0]="Gradiente max";
$dati2[0][2]="mmHg";
$dati2[0][1]=$_POST['gradmax_tricuspide'];
$dati2[1][0]="Press. in arteria polm.";
$dati2[1][2]="mmHg";
$dati2[1][1]=$_POST['pres_tricuspide'];

$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(10,83);
$pdf->ImprovedTable6($header,$dati2);
$pdf->Ln(8);


$dati3[0][0]="Reflusso";
$dati3[0][2]="";
$dati3[0][1]=$_POST['refl_tricuspide'];


$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(100,83);
$pdf->ImprovedTable6bis($header,$dati3);
$pdf->Ln(12);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Aorta ", $border=0, $align='L');
  $pdf->Ln(6);
$header=array("Campo",'Valore'," ");


$dati2[0][0]="V max";
$dati2[0][2]="cm/s";
$dati2[0][1]=$_POST['vmax_aorta'];
$dati2[1][0]="AVA";
$dati2[1][2]="cm^2";
$dati2[1][1]=$_POST['ava_aorta'];

$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(10,107);
$pdf->ImprovedTable6($header,$dati2);
$pdf->Ln(8);


$dati3[0][0]="Gradiente max";
$dati3[0][2]="mmHg";
$dati3[0][1]=$_POST['grad_aorta_max'];
$dati3[1][0]="Gradiente medio";
$dati3[1][2]="mmHg";
$dati3[1][1]=$_POST['grad_aorta_med'];
$dati3[2][0]="Reflusso";
$dati3[2][2]="";
$dati3[2][1]=$_POST['refl_aorta'];

$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(100,107);
$pdf->ImprovedTable6bis($header,$dati3);
$pdf->Ln(5);



$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"Mitrale ", $border=0, $align='L');
  $pdf->Ln(6);
$header=array("Campo",'Valore'," ");


$dati2[0][0]="E max";
$dati2[0][2]="cm/s";
$dati2[0][1]=$_POST['emax'];
$dati2[1][0]="A max";
$dati2[1][2]="cm/s";
$dati2[1][1]=$_POST['amax'];
$dati2[2][0]="E/A";
$dati2[2][2]="";
$dati2[2][1]=$_POST['e_su_a'];
$dati2[3][0]="EF slope";
$dati2[3][2]="cm/s^2";
$dati2[3][1]=$_POST['efslope'];

$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(10,137);
$pdf->ImprovedTable6($header,$dati2);
$pdf->Ln(8);

$dati3[0][0]="AVM";
$dati3[0][2]="cm^2";
$dati3[0][1]=$_POST['avm'];
#$dati3[0][0]="EF slope";
#$dati3[0][2]="cm/s^2";
#$dati3[0][1]=$_POST['efslope'];
$dati3[1][0]="Reflusso";
$dati3[1][2]="";
$dati3[1][1]=$_POST['refl_mitrale'];
$dati3[2][0]="Gradiente max";
$dati3[2][2]="mmHg";
$dati3[2][1]=$_POST['gradmax_mitrale'];
$dati3[3][0]="Gradiente medio";
$dati3[3][2]="mmHg";
$dati3[3][1]=$_POST['gradmed_mitrale'];


$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(100,137);
$pdf->ImprovedTable6bis($header,$dati3);
$pdf->Ln(8);


$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,"TDI ", $border=0, $align='L');
  $pdf->Ln(6);
$header=array("Campo",'Valore'," ");

$dati4[0][0]="E1 max";
$dati4[0][2]="cm/s";
$dati4[0][1]=$_POST['e1_TDI'];
$dati4[1][0]="A1 max";
$dati4[1][2]="cm/s";
$dati4[1][1]=$_POST['a1_TDI'];


$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(10,175);
$pdf->ImprovedTable6($header,$dati4);
$pdf->Ln(10);


$pdf->SetFont('Arial','B',12);

$header=array("Campo",'Valore'," ");

$dati4[0][0]="E1/A1";
$dati4[0][2]="";
$dati4[0][1]=$_POST['e1_su_a1_TDI'];
$dati4[1][0]="S1 max";
$dati4[1][2]="cm/s";
$dati4[1][1]=$_POST['s1_TDI'];
$pdf->SetFont('Arial','',10);
//$pdf->AddPage();
$pdf->SetXY(100,175);
$pdf->ImprovedTable6bis($header,$dati4);
$pdf->Ln(6);

//$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(25,5,"Commento ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
if(strlen($_POST['commenti'])>92)
{
$stringa_corta_10=substr($_POST['commenti'],0,92);
$posizione_ultimo_vuoto_10=strrpos($stringa_corta_10," ");
$pdf->Cell(165,5,str_replace("\\"," ",substr($_POST['commenti'],0,$posizione_ultimo_vuoto_10)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['commenti'],$posizione_ultimo_vuoto_10+1)));
}
else
$pdf->Cell(165,5,str_replace("\\"," ",$_POST['commenti']), $border=0, $align='L');
$pdf->Ln(6);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,5,"Conclusioni ", $border=0, $align='L');
$pdf->SetFont('Arial','',12);
if(strlen($_POST['conclusioni'])>90)
{
$stringa_corta_11=substr($_POST['conclusioni'],0,90);
$posizione_ultimo_vuoto_11=strrpos($stringa_corta_11," ");
$pdf->Cell(160,5,str_replace("\\"," ",substr($_POST['conclusioni'],0,$posizione_ultimo_vuoto_11)), $border=0, $align='L');
$pdf->Ln(6);
$pdf->Vai_a_capo(str_replace("\\"," ",substr($_POST['conclusioni'],$posizione_ultimo_vuoto_11+1)));
}
else
$pdf->Cell(160,5,str_replace("\\"," ",$_POST['conclusioni']), $border=0, $align='L');
$pdf->Ln(2);

	   $pdf->SetFont('Arial','',12);
	 //$pdf->SetX(10);
	 //$pdf->Cell(120,5,"In Fede,",$border=0,$ln=0,$align='L');
	  $pdf->Ln(4);
	  $nome=strlen($_POST['sess_user_name']);
	 $pdf->SetX(145);
	 	 $pdf->Cell(120,5,"Roma, ".date('d-m-Y'),$border=0,$ln=0,$align='L');
		  $pdf->Ln(6);
		  	 $pdf->SetX(145);
	 $pdf->Cell(120,5,"Dott. ".$_SESSION['sess_login_username'],$border=0,$ln=0,$align='L');
   
  $pdf->Output("../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf","F");

header("Location:../../referti/".$_POST['encounter_nr']."_".$_POST['appt_nr'].".pdf");


?>


