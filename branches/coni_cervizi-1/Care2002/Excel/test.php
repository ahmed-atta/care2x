<?php

$nomefile=date('hms_dmY');

  //require_once('OLEwriter.php');
  //require_once('BIFFwriter.php');
  require_once('Worksheet.php');
  require_once('Workbook.php');
  require('../include/inc_environment_global.php');
require('../modules/registration_admission/Mappa.php');
  function HeaderingExcel($filename) {
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
      }

  // HTTP headers
HeaderingExcel($nomefile.'.xls');


  // Creating a workbook
$workbook = new Workbook("-");


if($_POST['dottore']=='Tutti i dottori' || $_POST['dottore']=='Tutti i dati')
$doc='';
else
$doc=$_POST['dottore'];


$dipartimento=Array('Tutti i reparti'=>'','Medicina'=>'3','Nutrizione'=>'4','Cardiologia'=>'5','Ortopedia'=>'6','Fisioterapia'=>'7','Diagnostica Eco Rx'=>'8','Neurologia ed Elettroencefalografia'=>'9','Otorinolaringoiatria'=>'10','Oftalmologia'=>'11','Ginecologia'=>'12','Eco Internistica'=>'13','Endocrinologia'=>'14','Urologia'=>'15','Immunologia e allergologia'=>'16','Angiologia'=>'17','Medicina Legale'=>'20','Neurofisiologia'=>'21','Laboratorio analisi'=>'18'); 
$dipartimento_inverso=Array('3'=>'Medicina','4'=>'Nutrizione','5'=>'Cardiologia','6'=>'Ortopedia','7'=>'Fisioterapia','8'=>'Diagnostica Eco Rx','9'=>'Neurologia ed Elettroencefalografia','10'=>'Otorinolaringoiatria','11'=>'Oftalmologia','12'=>'Ginecologia','13'=>'Eco Internistica','14'=>'Endocrinologia','15'=>'Urologia','16'=>'Immunologia e allergologia','17'=>'Angiologia','20'=>'Medicina Legale','21'=>'Neurofisiologia','18'=>'Laboratorio analisi'); 
$mesi=Array('Gennaio'=>'01','Febbraio'=>'02','Marzo'=>'03','Aprile'=>'04','Maggio'=>'05','Giugno'=>'06','Luglio'=>'07','Agosto'=>'08','Settembre'=>'09','Ottobre'=>'10','Novembre'=>'11','Dicembre'=>'12');
  // Creating the first worksheet
   	$inizioanno=$_POST['anno'];
	$fineanno=$_POST['anno2'];
		
		$iniziomese=$mesi[$_POST['mese']];
		$finemese=$mesi[$_POST['mese2']];

$iniziogiorno=$_POST['giorno'];
$finegiorno=$_POST['giorno2']+1;

if ($finegiorno<10)
$finegiorno="0".$finegiorno;

$datainizio=$inizioanno."-".$iniziomese."-".$iniziogiorno;
$datafine=$fineanno."-".$finemese."-".$finegiorno;

$dipa=$dipartimento[$_POST['reparto']];

   $queryfatture="SELECT * from care_billing_bill WHERE bill_date_time>='".$datainizio."' AND bill_date_time<'".$datafine."'";
  $risqueryfatture=$db->Execute($queryfatture);

  $worksheet1 =& $workbook->add_worksheet('Fatture');
  
  // Format for the headings
  $formatot =& $workbook->add_format();
  $formatot->set_size(16);
  $formatot->set_align('center');
  $formatot->set_color('white');
  $formatot->set_pattern();
  $formatot->set_border(1);
  $formatot->set_fg_color('green');
  
  $formatot1 =& $workbook->add_format();
  $formatot1->set_size(16);
  $formatot1->set_align('center');
  $formatot1->set_color('white');
  $formatot1->set_pattern();
  $formatot1->set_border(1);
  $formatot1->set_fg_color('blue');
  
  $formatot2 =& $workbook->add_format();
  $formatot2->set_size(12);
  $formatot2->set_align('left');
  $formatot2->set_color('white');
  $formatot2->set_pattern();
  $formatot2->set_border(1);
  $formatot2->set_fg_color('red');
  
  $formatot2bis =& $workbook->add_format();
  $formatot2bis->set_size(14);
  $formatot2bis->set_align('left');
  $formatot2bis->set_color('black');
  $formatot2bis->set_pattern();
  $formatot2bis->set_border(1);
  $formatot2bis->set_fg_color('red'); 
  
  $formatot3 =& $workbook->add_format();
  $formatot3->set_size(12);
  $formatot3->set_align('left');
  $formatot3->set_color('white');
  $formatot3->set_pattern();
  $formatot3->set_border(1);
  $formatot3->set_fg_color('purple');
  
  $formatot3bis =& $workbook->add_format();
  $formatot3bis->set_size(14);
  $formatot3bis->set_align('left');
  $formatot3bis->set_color('yellow');
  $formatot3bis->set_pattern();
  $formatot3bis->set_border(1);
  $formatot3bis->set_fg_color('purple');
  
  $formatotnumfatture =& $workbook->add_format();
  $formatotnumfatture->set_size(10);
  $formatotnumfatture->set_align('center');
  $formatotnumfatture->set_color('black');
  $formatotnumfatture->set_pattern();
  $formatotnumfatture->set_border(1);
  $formatotnumfatture->set_fg_color('white');
  
  $formatot4 =& $workbook->add_format();
  $formatot4->set_size(10);
  $formatot4->set_align('left');
  $formatot4->set_color('black');
  $formatot4->set_pattern();
  $formatot4->set_border(1);
  $formatot4->set_fg_color('white');
 
  
  $worksheet1->set_column(0,0,25);
  $worksheet1->set_column(1,1,8);
  $worksheet1->set_column(2,2,35);
  $worksheet1->set_column(3,3,5);
  $worksheet1->set_column(4,4,20);
  
  $worksheet1->write_string(0,0,"Numero Fattura",$formatot1);
  $worksheet1->write_string(0,1,'',$formatot1);
  $worksheet1->write_string(0,2,"Tipologia di Assicurazione",$formatot1);
  $worksheet1->write_string(0,3,'',$formatot1);
  $worksheet1->write_string(0,4,"Totale Fatturato",$formatot1);

  $i=0;
	while ($risqueryfatture2=$risqueryfatture->FetchRow())
 {

  $arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][0]=$risqueryfatture2['insurance'];

  
  $arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1]=$risqueryfatture2['bill_amount'];

  
  $worksheet1->set_column(1, 1, 10);
  $worksheet1->set_row(1, 20);
  //$worksheet1->write(1+$i,1,'',$formatotnumfatture);
  $worksheet1->write(2+$i,0,$risqueryfatture2['bill_bill_no'], $formatotnumfatture);
  switch ($risqueryfatture2['insurance'])
  {
  case 1:
  $worksheet1->write(2+$i,2,"Privato",  $formatotnumfatture);
    $tot['Privato']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
  case 10:
    $worksheet1->write(2+$i,2,"Unisalute",  $formatotnumfatture);
	$tot['Unisalute']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
case 11:
	$worksheet1->write(2+$i,2,"Unisalute CONI",$formatotnumfatture);
	$tot['Unisalute CONI']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
case 12:
    $worksheet1->write(2+$i,2,"Legge 626/94",$formatotnumfatture);
	$tot['Legge 626/94']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
case 13:
	$worksheet1->write(2+$i,2,"I.N.",$formatotnumfatture);
	$tot['I.N.']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
case 14:
	$worksheet1->write(2+$i,2,"P.O.",$formatotnumfatture);
	$tot['P.O.']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
	}	  
 
	
$tot['totale']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
$num[$risqueryfatture2['insurance']]++;

$worksheet1->write(2+$i,4,($arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1]),  $formatotnumfatture);

$i++;
}
$worksheet1->write_string(3+$i,0,"Totale Fatture:",$formatot2bis);
//$worksheet1->write(2+$i, 0, "Totale Fatture:");
$worksheet1->write(3+$i, 1, $i,$formatotnumfatture);
$worksheet1->write(4+$i, 0, "Verso Privati:",$formatot2);
$worksheet1->write(4+$i, 1,$num[1],$formatotnumfatture);
$worksheet1->write(4+$i, 2, "% dei Privati:",$formatot2);
$worksheet1->write(4+$i, 3, ($num[1]/$i)*100,$formatotnumfatture);
$worksheet1->write(5+$i, 0, "Verso Unisalute:",$formatot2);
$worksheet1->write(5+$i, 1, $num[10],$formatotnumfatture);
$worksheet1->write(5+$i, 2, "% dei Unisalute:",$formatot2);
$worksheet1->write(5+$i, 3, ($num[10]/$i)*100,$formatotnumfatture);
$worksheet1->write(6+$i, 0, "Verso Unisalute CONI:",$formatot2);
$worksheet1->write(6+$i, 1, $num[11],$formatotnumfatture);
$worksheet1->write(6+$i, 2, "% dei Unisalute CONI:",$formatot2);
$worksheet1->write(6+$i, 3, ($num[11]/$i)*100,$formatotnumfatture);
$worksheet1->write(7+$i, 0, "Verso Legge 626/94:",$formatot2);
$worksheet1->write(7+$i, 1, $num[12],$formatotnumfatture);
$worksheet1->write(7+$i, 2, "% dei Legge 626/24:",$formatot2);
$worksheet1->write(7+$i, 3, ($num[12]/$i)*100,$formatotnumfatture);
$worksheet1->write(8+$i, 0, "Verso I.N.:",$formatot2);
$worksheet1->write(8+$i, 1, $num[13],$formatotnumfatture);
$worksheet1->write(8+$i, 2, "% dei I.N.:",$formatot2);
$worksheet1->write(8+$i, 3, ($num[13]/$i)*100,$formatotnumfatture);
$worksheet1->write(9+$i, 0, "Verso P.O.:",$formatot2);
$worksheet1->write(9+$i, 1, $num[14],$formatotnumfatture);
$worksheet1->write(9+$i, 2, "% dei P.O.:",$formatot2);
$worksheet1->write(9+$i, 3, ($num[14]/$i)*100,$formatotnumfatture);


$worksheet1->write(10+$i, 0, "Totale Fatturato:",$formatot3bis);
$worksheet1->write(10+$i, 1, $tot['totale'],$formatotnumfatture);
$worksheet1->write(11+$i, 0, "Verso Privati:",$formatot3);
$worksheet1->write(11+$i, 1,  $tot['Privato'],$formatotnumfatture);
$worksheet1->write(11+$i, 2, "% dei Privati:",$formatot3);
$worksheet1->write(11+$i, 3, ($tot['Privato']/$tot['totale'])*100,$formatotnumfatture);
$worksheet1->write(12+$i, 0, "Verso Unisalute:",$formatot3);
$worksheet1->write(12+$i, 1, $tot['Unisalute'],$formatotnumfatture);
$worksheet1->write(12+$i, 2, "% dei Unisalute:",$formatot3);
$worksheet1->write(12+$i, 3, ($tot['Unisalute']/$tot['totale'])*100,$formatotnumfatture);
$worksheet1->write(13+$i, 0, "Verso Unisalute CONI:",$formatot3);
$worksheet1->write(13+$i, 1, $tot['Unisalute CONI'],$formatotnumfatture);
$worksheet1->write(13+$i, 2, "% dei Unisalute CONI:",$formatot3);
$worksheet1->write(13+$i, 3, ($tot['Unisalute CONI']/$tot['totale'])*100);
$worksheet1->write(14+$i, 0, "Verso Legge 626/94:",$formatot3);
$worksheet1->write(14+$i, 1, $tot['Legge 626/94'],$formatotnumfatture);
$worksheet1->write(14+$i, 2, "% dei Legge 626/94:",$formatot3);
$worksheet1->write(14+$i, 3, ($tot['Legge 626/94']/$tot['totale'])*100,$formatotnumfatture);
$worksheet1->write(15+$i, 0, "Verso I.N.:",$formatot3);
$worksheet1->write(15+$i, 1, $tot['I.N.'],$formatotnumfatture);
$worksheet1->write(15+$i, 2, "% dei I.N.:",$formatot3);
$worksheet1->write(15+$i, 3, ($tot['I.N.']/$tot['totale'])*100,$formatotnumfatture);
$worksheet1->write(16+$i, 0, "Verso P.O.:",$formatot3);
$worksheet1->write(16+$i, 1, $tot['P.O.'],$formatotnumfatture);
$worksheet1->write(16+$i, 2, "% dei P.O.:",$formatot3);
$worksheet1->write(16+$i, 3, ($tot['P.O.']/$tot['totale'])*100,$formatotnumfatture);
  
  
  // Creating the second worksheet
  $worksheet2 =& $workbook->add_worksheet('Statistiche Fatture');

  

$queryitem="SELECT * from care_billing_bill_item WHERE bill_item_date>='".$datainizio."' AND bill_item_date <'".$datafine."'";
$resultitem=$db->Execute($queryitem);
//$conto=$resultitem->RecordCount();

  $worksheet2->set_column(0,0,10);
  //$worksheet2->set_column(1,1,0);
  $worksheet2->set_column(1,1,35);
  //$worksheet2->set_column(3,3,0);
  $worksheet2->set_column(2,2,12);
  $worksheet2->set_column(3,3,8);
  $worksheet2->set_column(4,4,12);
  $worksheet2->set_column(5,5,15);
  $worksheet2->set_column(6,6,18);
  $worksheet2->set_column(7,8,6);

  
  $worksheet2->write_string(0,0,"Codice",$formatot);
  //$worksheet2->write_string(0,1,"",$formatot);
  $worksheet2->write_string(0,1,"Descrizione Prestazione",$formatot);
  //$worksheet2->write_string(0,3,"",$formatot);
  $worksheet2->write_string(0,2,"Quantita'",$formatot);
  $worksheet2->write_string(0,3,"Privati",$formatot);
  $worksheet2->write_string(0,4,"Unisalute",$formatot);
  $worksheet2->write_string(0,5,"Unis. CONI",$formatot);
  $worksheet2->write_string(0,6,"Legge 626/94",$formatot);
  $worksheet2->write_string(0,7,"I.N.",$formatot);
  $worksheet2->write_string(0,8,"P.O.",$formatot);


while ($resultitem2=$resultitem->FetchRow())
{
if (!$item_data["'".$resultitem2['bill_item_code']."'"])
{
$item_data["'".$resultitem2['bill_item_code']."'"][0]=$resultitem2['bill_item_units'];
$item_data["'".$resultitem2['bill_item_code']."'"][$arrayfatture["'".$resultitem2['bill_item_bill_no']."'"][0]]=$resultitem2['bill_item_units'];


}
 else
 {
  $item_data["'".$resultitem2['bill_item_code']."'"][0]+=$resultitem2['bill_item_units'];
$item_data["'".$resultitem2['bill_item_code']."'"][$arrayfatture["'".$resultitem2['bill_item_bill_no']."'"][0]]+=$resultitem2['bill_item_units'];
  
 }
}
$i=1;

while($dati=each($item_data))
{
$domanda="SELECT item_description FROM prezzi_1 WHERE item_code=".$dati[0]."";
	$risposta=$db->Execute($domanda);
	$answer=$risposta->Fetchrow();
	$worksheet2->write($i,0,str_replace("'","",$dati[0],$formatotnumfatture));
	//$worksheet2->write($i,1,'',$formatotnumfatture);
	$worksheet2->write($i,1,trim($answer['item_description']),$formatot4);
	//$worksheet2->write($i,3,'',$formatotnumfatture);
	$worksheet2->write($i,2,$dati[1][0],$formatotnumfatture);
	$worksheet2->write($i,3,$dati[1][1],$formatotnumfatture);
	$worksheet2->write($i,4,$dati[1][10],$formatotnumfatture);
	$worksheet2->write($i,5,$dati[1][11],$formatotnumfatture);
	$worksheet2->write($i,6,$dati[1][12],$formatotnumfatture);
	$worksheet2->write($i,7,$dati[1][13],$formatotnumfatture);
	$worksheet2->write($i,8,$dati[1][14],$formatotnumfatture);
	
 $i++;
} 
// Creare il terzo worksheet
  $worksheet3 =& $workbook->add_worksheet('Statistiche');

  $query="SELECT * FROM care_appointment WHERE (appt_status='Fatto' OR appt_status='In attesa di referto') AND date>'".$inizioanno."-".$iniziomese."-".$iniziogiorno."' AND date<'".$fineanno."-".$finemese."-".$finegiorno."'";
 if($dipa!='')
 $query.=" AND to_dept_nr='".$dipa."'";
 if($doc!='')
 $query.=" AND modify_id='".$doc."'";
 
 $query.=" ORDER BY date ASC";
 $answer=$db->Execute($query);
 $worksheet3->set_column(0,0,20);
  //$worksheet2->set_column(1,1,0);
  $worksheet3->set_column(1,1,25);
  //$worksheet2->set_column(3,3,0);
  $worksheet3->set_column(2,2,40);
  $worksheet3->set_column(3,3,20);
  $worksheet3->set_column(4,4,25);

  $worksheet3->write_string(0,0,"Dipartimento",$formatot);
  //$worksheet2->write_string(0,1,"",$formatot);
  $worksheet3->write_string(0,1,"Data Prestazione",$formatot);
  //$worksheet2->write_string(0,3,"",$formatot);
  $worksheet3->write_string(0,2,"Prestazione",$formatot);
  $worksheet3->write_string(0,3,"Fornita a",$formatot);
  $worksheet3->write_string(0,4,"Dottore",$formatot);

  $i=1;
  while($answer2=$answer->FetchRow())
{
$data=substr($answer2['modify_time'],0,4)."-".substr($answer2['modify_time'],4,2)."-".substr($answer2['modify_time'],6,2);
$codice=split('#',$answer2['purpose']);
/*
$domandona="SELECT * FROM prezzi_1 WHERE item_code='".$codice[1]."'";
$rispostona=$db->Execute($domandona);
$rispostina=$rispostona->FetchRow();
*/
	
	$worksheet3->write($i,0,$dipartimento_inverso[$mappa[$codice[1]][4]],$formatot4);
	//$worksheet3->write($i,0,$_POST['reparto'],$formatot4);
	$worksheet3->write($i,1,$data,$formatot4);
	$worksheet3->write($i,2,substr("_"," ",$codice[0]),$formatot4);
	//$worksheet3->write($i,2,rtrim(trim($rispostina['item_description'])),$formatot4);
	$worksheet3->write($i,3,$answer2['encounter_nr'],$formatot4);
	$worksheet3->write($i,4,$answer2['modify_id'],$formatotnumfatture);
$i++;
} 
  
  
 $workbook->close();
 
?>
