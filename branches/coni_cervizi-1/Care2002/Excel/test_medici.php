<?php
 
 /*while (list($a,$b)=each($_POST))
 {
 echo "@@".$a."##".$b;
 }
 exit;
 */
 error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//require('./roots.php');
//require('../include/inc_environment_global.php');

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
HeaderingExcel("stats_medici_".$nomefile.'.xls');


if($_POST['dottore']=='Tutti i dottori' || $_POST['dottore']=='Tutti i dati')
$doc='';
else
$doc=$_POST['dottore'];


$dipartimento=Array('Tutti i reparti'=>'','Medicina'=>'3','Nutrizione'=>'4','Cardiologia'=>'5','Ortopedia'=>'6','Fisioterapia'=>'7','Diagnostica Eco Rx'=>'8','Neurologia ed Elettroencefalografia'=>'9','Otorinolaringoiatria'=>'10','Oftalmologia'=>'11','Ginecologia'=>'12','Eco Internistica'=>'13','Endocrinologia'=>'14','Urologia'=>'15','Immunologia e allergologia'=>'16','Angiologia'=>'17','Medicina Legale'=>'20','Neurofisiologia'=>'21','Laboratorio analisi'=>'18'); 
$dipartimento_inverso=Array('3'=>'Medicina','4'=>'Nutrizione','5'=>'Cardiologia','6'=>'Ortopedia','7'=>'Fisioterapia','8'=>'Diagnostica Eco Rx','9'=>'Neurologia ed Elettroencefalografia','10'=>'Otorinolaringoiatria','11'=>'Oftalmologia','12'=>'Ginecologia','13'=>'Eco Internistica','14'=>'Endocrinologia','15'=>'Urologia','16'=>'Immunologia e allergologia','17'=>'Angiologia','20'=>'Medicina Legale','21'=>'Neurofisiologia','18'=>'Laboratorio analisi'); 
$mesi=Array('Gennaio'=>'01','Febbraio'=>'02','Marzo'=>'03','Aprile'=>'04','Maggio'=>'05','Giugno'=>'06','Luglio'=>'07','Agosto'=>'08','Settembre'=>'09','Ottobre'=>'10','Novembre'=>'11','Dicembre'=>'12');

$dipa=$dipartimento[$_POST['reparto']];
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


  // Creating a workbook
$workbook = new Workbook("-");

// Creare il  worksheet
  $worksheet1 =& $workbook->add_worksheet('Statistiche');
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

   $formatot5 =& $workbook->add_format();
  $formatot5->set_size(10);
  $formatot5->set_align('left');
  $formatot5->set_color('black');
  $formatot5->set_pattern();
  $formatot5->set_border(1);
  $formatot5->set_fg_color('white');

  $query="SELECT * FROM care_appointment WHERE (appt_status='Fatto' OR appt_status='In attesa di referto') AND date>'".$inizioanno."-".$iniziomese."-".$iniziogiorno."' AND modify_id!='Francesco' AND date<'".$fineanno."-".$finemese."-".$finegiorno."'";
 if($dipa!='')
 $query.=" AND to_dept_nr='".$dipa."'";
 if($doc!='')
 $query.=" AND modify_id='".$doc."'";
 
 $query.=" ORDER BY date ASC";
//echo $query;
//exit;
 $answer=$db->Execute($query);

 $worksheet1->set_column(0,0,20);
  //$worksheet2->set_column(1,1,0);
  $worksheet1->set_column(1,2,25);
  //$worksheet2->set_column(3,3,0);
  
  $worksheet1->set_column(3,3,40);
  $worksheet1->set_column(4,4,15);
  $worksheet1->set_column(5,5,25);

  $worksheet1->write_string(0,0,"Dipartimento",$formatot);
  //$worksheet2->write_string(0,1,"",$formatot);
  $worksheet1->write_string(0,1,"Data Prenotazione",$formatot);
  //$worksheet2->write_string(0,3,"",$formatot);
    $worksheet1->write_string(0,2,"Data Prestazione",$formatot);
  $worksheet1->write_string(0,3,"Prestazione",$formatot);
  $worksheet1->write_string(0,4,"Fornita a",$formatot);
  $worksheet1->write_string(0,5,"Dottore",$formatot);

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
/*
echo "Dipa ".$dipartimento_inverso[$mappa[$codice[1]][4]]."<br>";
echo "codice ".str_replace("_"," ",$codice[0])."<br>";
echo "tizio ".$answer2['encounter_nr']."<br>";
echo "dottore".$answer2['modify_id']."<br>";
echo "DATA ".$answer2['date']."<br>";
*/
$query_qualifica="SELECT insurance_firm_id FROM care_encounter WHERE encounter_nr=".$answer2['encounter_nr'];

$answer_qualifica=$db->Execute($query_qualifica);
$qualifica=$answer_qualifica->FetchRow();
  switch ($qualifica['insurance_firm_id'])
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
	$worksheet1->write($i,0,$dipartimento_inverso[$mappa[$codice[1]][4]],$formatot4);
	//$worksheet1->write($i,0,$_POST['reparto'],$formatot4);
	$worksheet1->write($i,1,$answer2['date'],$formatot4);	
	$worksheet1->write($i,2,$data,$formatot4);
	$worksheet1->write($i,3,str_replace("_"," ",$codice[0]),$formatot4);
	//$worksheet1->write($i,2,$codice[0],$formatot4);
	//$worksheet1->write($i,2,rtrim(trim($rispostina['item_description'])),$formatot4);
	$worksheet1->write($i,4,$qualifica." ".$answer2['encounter_nr'],$formatot4);
	$worksheet1->write($i,5,$answer2['modify_id'],$formatotnumfatture);

$i++;
} 
 $workbook->close();
?>
