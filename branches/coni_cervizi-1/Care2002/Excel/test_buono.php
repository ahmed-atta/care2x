<?php
  //require_once('OLEwriter.php');
  //require_once('BIFFwriter.php');
  require_once('Worksheet.php');
  require_once('Workbook.php');
  require('../include/inc_environment_global.php');

  function HeaderingExcel($filename) {
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
      }

  // HTTP headers
HeaderingExcel('StatAprile.xls');

  // Creating a workbook
$workbook = new Workbook("-");
  // Creating the first worksheet
  
  $datainizio="2004-04-01";
  $datafine="2004-05-01";
  $queryfatture="SELECT * from care_billing_bill WHERE bill_date_time>='".$datainizio."' AND bill_date_time<'".$datafine."'";
  $risqueryfatture=$db->Execute($queryfatture);
$i=0;
  $worksheet1 =& $workbook->add_worksheet('Fatture');
  
  // Format for the headings
  $formatot =& $workbook->add_format();
  $formatot->set_size(16);
  $formatot->set_align('center');
  $formatot->set_color('white');
  $formatot->set_pattern();
  $formatot->set_fg_color('green');
  
  $formatot1 =& $workbook->add_format();
  $formatot1->set_size(16);
  $formatot1->set_align('center');
  $formatot1->set_color('white');
  $formatot1->set_pattern();
  $formatot1->set_fg_color('blue');
  
  $formatot2 =& $workbook->add_format();
  $formatot2->set_size(12);
  $formatot2->set_align('left');
  $formatot2->set_color('white');
  $formatot2->set_pattern();
  $formatot2->set_fg_color('red');
  
  $formatot3 =& $workbook->add_format();
  $formatot3->set_size(12);
  $formatot3->set_align('left');
  $formatot3->set_color('white');
  $formatot3->set_pattern();
  $formatot3->set_fg_color('purple');
  
  $formatotnumfatture =& $workbook->add_format();
  $formatotnumfatture->set_size(10);
  $formatotnumfatture->set_align('center');
  $formatotnumfatture->set_color('black');
  $formatotnumfatture->set_pattern();
  $formatotnumfatture->set_fg_color('');
  
  $formatot4 =& $workbook->add_format();
  $formatot4->set_size(10);
  $formatot4->set_align('left');
  $formatot4->set_color('black');
  $formatot4->set_pattern();
  $formatot4->set_fg_color('');
 
  
  $worksheet1->set_column(0,0,25);
  $worksheet1->set_column(1,1,8);
  $worksheet1->set_column(2,2,35);
  $worksheet1->set_column(3,3,5);
  $worksheet1->set_column(4,4,20);
  
  $worksheet1->write_string(0,0,"Numero Fattura",$formatot1);
  $worksheet1->write_string(0,2,"Tipologia di Assicurazione",$formatot1);
  //$worksheet1->write_string(0,2,"Cognome",$formatot1);
  $worksheet1->write_string(0,4,"Totale Fatturato",$formatot1);
  //$worksheet1->write_string(0,4,"Test di laboratorio pendenti",$formatot1);
  
	while ($risqueryfatture2=$risqueryfatture->FetchRow())
 {

  $arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][0]=$risqueryfatture2['insurance'];

  
  $arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1]=$risqueryfatture2['bill_amount'];

  
  $worksheet1->set_column(1, 1, 10);
  $worksheet1->set_row(1, 20);
  //$worksheet1->write_number(1+$i,0,$i);
  $worksheet1->write(1+$i,0,$risqueryfatture2['bill_bill_no'], $formatotnumfatture);
  switch ($risqueryfatture2['insurance'])
  {
  case 1:
  $worksheet1->write(1+$i,2,"Privato",  $formatotnumfatture);
    $tot['Privato']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
  case 10:
    $worksheet1->write(1+$i,2,"Unisalute",  $formatotnumfatture);
	$tot['Unisalute']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
case 11:
	$worksheet1->write(1+$i,2,"Unisalute CONI",$formatotnumfatture);
	$tot['Unisalute CONI']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
case 12:
    $worksheet1->write(1+$i,2,"Legge 626/94",$formatotnumfatture);
	$tot['Legge 626/94']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
case 13:
	$worksheet1->write(1+$i,2,"I.N.",$formatotnumfatture);
	$tot['I.N.']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
case 14:
	$worksheet1->write(1+$i,2,"P.O.",$formatotnumfatture);
	$tot['P.O.']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
	break;
	}	  
 
	
$tot['totale']+=$arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1];
$num[$risqueryfatture2['insurance']]++;

$worksheet1->write(1+$i,4,($arrayfatture["'".$risqueryfatture2['bill_bill_no']."'"][1]),  $formatotnumfatture);

$i++;
}
$worksheet1->write_string(2+$i,0,"Totale Fatture",$formatot2);
//$worksheet1->write(2+$i, 0, "Totale Fatture:");
$worksheet1->write(2+$i, 1, $i);
$worksheet1->write(3+$i, 0, "Verso Privati:",$formatot2);
$worksheet1->write(3+$i, 1,$num[1]);
$worksheet1->write(3+$i, 2, "% dei Privati:",$formatot2);
$worksheet1->write(3+$i, 3, ($num[1]/$i)*100);
$worksheet1->write(4+$i, 0, "Verso Unisalute:",$formatot2);
$worksheet1->write(4+$i, 1, $num[10]);
$worksheet1->write(4+$i, 2, "% dei Unisalute:",$formatot2);
$worksheet1->write(4+$i, 3, ($num[10]/$i)*100);
$worksheet1->write(5+$i, 0, "Verso Unisalute CONI:",$formatot2);
$worksheet1->write(5+$i, 1, $num[11]);
$worksheet1->write(5+$i, 2, "% dei Unisalute CONI:",$formatot2);
$worksheet1->write(5+$i, 3, ($num[11]/$i)*100);
$worksheet1->write(6+$i, 0, "Verso Legge 626/94:",$formatot2);
$worksheet1->write(6+$i, 1, $num[12]);
$worksheet1->write(6+$i, 2, "% dei Legge 626/24:",$formatot2);
$worksheet1->write(6+$i, 3, ($num[12]/$i)*100);
$worksheet1->write(7+$i, 0, "Verso I.N.:",$formatot2);
$worksheet1->write(7+$i, 1, $num[13]);
$worksheet1->write(7+$i, 2, "% dei I.N.:",$formatot2);
$worksheet1->write(7+$i, 3, ($num[13]/$i)*100);
$worksheet1->write(8+$i, 0, "Verso P.O.:",$formatot2);
$worksheet1->write(8+$i, 1, $num[14]);
$worksheet1->write(8+$i, 2, "% dei P.O.:",$formatot2);
$worksheet1->write(8+$i, 3, ($num[14]/$i)*100);


$worksheet1->write(9+$i, 0, "Totale Fatturato:",$formatot3);
$worksheet1->write(9+$i, 1, $tot['totale']);
$worksheet1->write(10+$i, 0, "Verso Privati:",$formatot3);
$worksheet1->write(10+$i, 1,  $tot['Privato']);
$worksheet1->write(10+$i, 2, "% dei Privati:",$formatot3);
$worksheet1->write(10+$i, 3, ($tot['Privato']/$tot['totale'])*100);
$worksheet1->write(11+$i, 0, "Verso Unisalute:",$formatot3);
$worksheet1->write(11+$i, 1, $tot['Unisalute']);
$worksheet1->write(11+$i, 2, "% dei Unisalute:",$formatot3);
$worksheet1->write(11+$i, 3, ($tot['Unisalute']/$tot['totale'])*100);
$worksheet1->write(12+$i, 0, "Verso Unisalute CONI:",$formatot3);
$worksheet1->write(12+$i, 1, $tot['Unisalute CONI']);
$worksheet1->write(12+$i, 2, "% dei Unisalute CONI:",$formatot3);
$worksheet1->write(12+$i, 3, ($tot['Unisalute CONI']/$tot['totale'])*100);
$worksheet1->write(13+$i, 0, "Verso Legge 626/94:",$formatot3);
$worksheet1->write(13+$i, 1, $tot['Legge 626/94']);
$worksheet1->write(13+$i, 2, "% dei Legge 626/94:",$formatot3);
$worksheet1->write(13+$i, 3, ($tot['Legge 626/94']/$tot['totale'])*100);
$worksheet1->write(14+$i, 0, "Verso I.N.:",$formatot3);
$worksheet1->write(14+$i, 1, $tot['I.N.']);
$worksheet1->write(14+$i, 2, "% dei I.N.:",$formatot3);
$worksheet1->write(14+$i, 3, ($tot['I.N.']/$tot['totale'])*100);
$worksheet1->write(15+$i, 0, "Verso P.O.:",$formatot3);
$worksheet1->write(15+$i, 1, $tot['P.O.']);
$worksheet1->write(15+$i, 2, "% dei P.O.:",$formatot3);
$worksheet1->write(15+$i, 3, ($tot['P.O.']/$tot['totale'])*100);
  
  
  // Creating the second worksheet
  $worksheet2 =& $workbook->add_worksheet('Statistiche');

  

$queryitem="SELECT * from care_billing_bill_item WHERE bill_item_date>='".$datainizio."' AND bill_item_date<'".$datafine."'";
$resultitem=$db->Execute($queryitem);
//$conto=$resultitem->RecordCount();

  $worksheet2->set_column(0,0,10);
  $worksheet2->set_column(1,1,3);
  $worksheet2->set_column(2,2,35);
  $worksheet2->set_column(3,3,3);
  $worksheet2->set_column(4,4,12);
  $worksheet2->set_column(5,5,8);
  $worksheet2->set_column(6,6,12);
  $worksheet2->set_column(7,7,20);
  $worksheet2->set_column(8,8,18);
  $worksheet2->set_column(9,10,6);

  
  $worksheet2->write_string(0,0,"Codice",$formatot);
  //$worksheet2->write_string(0,1,"Nome",$formatot);
  $worksheet2->write_string(0,2,"Descrizione Prestazione",$formatot);
  //$worksheet2->write_string(0,3,"Tipologia di Assicurazione",$formatot);
  $worksheet2->write_string(0,4,"Quantita'",$formatot);
  $worksheet2->write_string(0,5,"Privati",$formatot);
  $worksheet2->write_string(0,6,"Unisalute",$formatot);
  $worksheet2->write_string(0,7,"Unisalute CONI",$formatot);
  $worksheet2->write_string(0,8,"Legge 626/94",$formatot);
  $worksheet2->write_string(0,9,"I.N.",$formatot);
  $worksheet2->write_string(0,10,"P.O.",$formatot);


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
	$worksheet2->write($i,2,trim($answer['item_description']),$formatot4);
	$worksheet2->write($i,4,$dati[1][0],$formatotnumfatture);
	$worksheet2->write($i,5,$dati[1][1],$formatotnumfatture);
	$worksheet2->write($i,6,$dati[1][10],$formatotnumfatture);
	$worksheet2->write($i,7,$dati[1][11],$formatotnumfatture);
	$worksheet2->write($i,8,$dati[1][12],$formatotnumfatture);
	$worksheet2->write($i,9,$dati[1][13],$formatotnumfatture);
	$worksheet2->write($i,10,$dati[1][14],$formatotnumfatture);
	
 $i++;
} 

  
/*
  // Calculate some statistics
  $worksheet2->write(7, 0, "Average Salary:");
  $worksheet2->write_formula(7, 4, "= AVERAGE(E4:E6)");
  $worksheet2->write(8, 0, "Minimum Salary:");
  $worksheet2->write_formula(8, 4, "= MIN(E4:E6)");
  $worksheet2->write(9, 0, "Maximum Salary:");
  $worksheet2->write_formula(9, 4, "= MAX(E4:E6)");
*/
  //$worksheet2->insert_bitmap(0, 0, "some.bmp",10,10);

 $workbook->close();
?>
