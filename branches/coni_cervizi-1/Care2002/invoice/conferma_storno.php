<?
define('FPDF_FONTPATH','font/');
require('invoice.php'); 
require('../include/inc_environment_global.php'); ##SERVE PER USARE I METODI CHE AGISCONO SUL DB
##ENTRO ##@È LA SEZIONE CHE SI INTERESSA DI CREARE LO STORNO
$subtot=0;
while (list($a,$b)=each($_POST))
{
#echo $a."@@".$b."##<br>";
if(substr($a,0,11)=='da_stornare')
	{
	$codice=substr($a,12);
	$query_item="SELECT * FROM prezzi_".$_POST['insurance']." WHERE item_code='".$codice."'";
	#echo $query_prezzo;
	$risposta_query_item=$db->Execute($query_item);
	$item=$risposta_query_item->FetchRow();
	$subtot=$subtot+($item['item_unit_cost']*$b);
	#echo "AGGIUNTO ".$item['item_description']." ".$subtot."<br>";
	}
}
#echo "<br><br>TOTALE ".$subtot;
#if ($subtot==$_POST['bill_amount'])
#echo "<br>STORNO TOTALE";
##@
####CODICE DI FATTURA.PHP########################################################################################
function Riempimento($stringa,$lunghezza)
{
$ritorno='';
$lungh_stringa=strlen($stringa);
$differenza=$lunghezza-$lungh_stringa;
    if ($differenza>=0)
	{
	$ritorno=$stringa;
	 while($differenza>0)
	   	{
	      $ritorno=$ritorno." ";
		  $differenza--;
		}
	}
	else
	$ritorno=substr($stringa,0,$lunghezza);
	
return($ritorno);
}

$totale=12-(strlen($subtot*100));

$tot='';
for($i=0;$i<$totale;$i++)
{
$tot.='0';
}
$tot.=$subtot*100;

$fp=fopen("../Gesinf/temp/beneficiari/".date("d-m-Y").".txt",'a');
$query="SELECT * FROM care_encounter JOIN care_person WHERE care_encounter.pid=care_person.pid AND care_encounter.encounter_nr=".$_POST['encounter_nr'];
$vai=$db->Execute($query);
$ecco=$vai->FetchRow();

$cognome=Riempimento(strtoupper($ecco['name_last']),30);
$nome=Riempimento(strtoupper($ecco['name_first']),20);
$sesso=Riempimento(strtoupper($ecco['sex']),1);
$luogo_di_nascita=Riempimento(strtoupper($ecco['name_middle']),30);
$provincia_di_nascita=Riempimento('',2);
$data_di_nascita=riempimento(substr($ecco['date_birth'],8,2).substr($ecco['date_birth'],5,2).substr($ecco['date_birth'],0,4),8);
$persona_presso=Riempimento('',30);
$indirizzo_presso=Riempimento(strtoupper($ecco['addr_str']),30);
$numero_civico=Riempimento($ecco['addr_str_nr'],5);
$cap=Riempimento(strtoupper($ecco['addr_zip']),5);
$localita_di_residenza=Riempimento(strtoupper($ecco['sss_nr']),20);
$provincia_di_residenza=Riempimento('',2);
$telefono1=Riempimento($ecco['phone_1_nr'],20);
$telefono2=Riempimento($ecco['phone_2_nr'],20);
$codice_fiscale=Riempimento(strtoupper($ecco['insurance_nr']),16);
$piva=Riempimento('',11);
$codice_abi=Riempimento('',5);
$codice_cab=Riempimento('',5);
$codice_ritenuta_fiscale=Riempimento('',4);
$causale770=Riempimento('',1);
$modalita=Riempimento('4',2);
$numero_conto_corrente=Riempimento('',15);
fwrite($fp,$cognome.$nome.$sesso.$luogo_di_nascita.$provincia_di_nascita.$data_di_nascita.$persona_presso.$indirizzo_presso.$numero_civico.$cap.$localita_di_residenza.$provincia_di_residenza.$telefono1.$telefono2.$codice_fiscale.$piva.$codice_abi.$codice_cab.$codice_ritenuta_fiscale.$causale770.$modalita.$numero_conto_corrente."C\n");
fclose($fp);

$fp=fopen("../Gesinf/temp/fatture/".date("d-m-Y").".txt",'a');


$anno=Riempimento(date("Y"),4);
$codice_fiscale_beneficiario=Riempimento(strtoupper($ecco['insurance_nr']),16);
$descrizione=Riempimento('VARI ESAMI DEL SANGUE',100);
$numero_fattura=Riempimento('ISS-M-'.$_POST['fattura'],15);
$conto_bancario=Riempimento('9000',16);
$codice_clausola_prima_nota=Riempimento('NC',4);

fwrite($fp,$anno."2AN".$codice_fiscale_beneficiario."           ".date("dmY").$numero_fattura.$conto_bancario.$descrizione.$codice_clausola_prima_nota.$tot."610000000000000000000000000   000000000000000000000000   000000000000000000000000   000000000000".$tot."000000000000".$tot."CEA.01.01.08.01               FO.02.          FO.02.          GEN.            ".$tot."SPP.D.09.10.01                000000000000                                                                              000000000000                                                                              000000000000                                                                              000000000000   5                       \n");##il 5 a inizio riga indica il tipo di pagamento
fclose($fp);
$query_num_storno="SELECT storno_id FROM care_storno ORDER BY storno_id DESC LIMIT  1";
#echo $query_num_storno;
$risposta_query_num_storno=$db->Execute($query_num_storno);
$num_storno=$risposta_query_num_storno->FetchRow();


$pdf = new INVOICE( 'P', 'mm', 'A4' );
$pdf->Open();
$pdf->AddPage();
$pdf->addSociete( "Istituto Nazionale di Medicina dello Sport",
                  "Via dei Campi Sportivi, 46\n" .
                  "00197 - Roma\n".
                  "P.IVA 07207761003\n" .
                  "" );
$pdf->fact_dev( "Storno ", "ISS-M-".($num_storno['storno_id']+1) );

$data=substr(date('Y-m-d'),8,2).'-'.substr(date('Y-m-d'),5,3).substr(date('Y-m-d'),0,4);
$pdf->addDate($data);
$pdf->addClient($_POST['encounter_nr']);
$pdf->addPageNumber("1");
if ($ecco['sex']=='m') $titolo='Egr. Sig.';
else $titolo='Gen.le Sig.ra';

$pdf->addClientAdresse("$titolo \n".$ecco['name_first']." ".$ecco['name_last']." \n".$ecco['addr_str'].", ".$ecco['addr_str_nr']."\n".$ecco['addr_zip']." ".$ecco['sss_nr']."\n\nCod.Fiscale:".$codicefiscale);

if ($subtot==$_POST['bill_amount'])
$storno_come='totale';
else
$storno_come='parziale';

if($_POST['bill_amount']>=77.47)
$bollo=" di cui 1.29 euro di bollo";
else $bollo=" ";

if($_POST['bill_amount']>=77.47)
$_POST['bill_amount']=$_POST['bill_amount']+1.29;

$pdf->addReference("  Si emette nota di credito a storno ".$storno_come." della fattura ISS-M-".$_POST['fattura']." , del ".$_POST['data_fattura'].", il cui importo era ".$_POST['bill_amount'].$bollo);


$cols=array( 
	     "Codice" => 18,
             "Descrizione della prestazione"  => 110,
             "Quantita'"     => 18,
             "Prezzo Unitario"      => 26,
             "Importo" => 18);


$pdf->addCols( $cols);
$cols=array( "Codice"    => "L",
             "Descrizione della prestazione"  => "L",
             "Quantita'"     => "C",
             "Prezzo Unitario"      => "R",
             "Importo" => "R" );


$pdf->addLineFormat($cols);

$y    = 90;

$totale=0;
reset($_POST);
while (list($a,$b)=each($_POST))
{
#echo $a."@@".$b."##<br>";
#echo substr($a,0,11);
if(substr($a,0,11)=='da_stornare')
	{
	$codice=substr($a,12);
	$query_item="SELECT * FROM care_billing_bill_item WHERE bill_item_id=".$codice;
	#echo $query_item;
	$risposta_query_item=$db->Execute($query_item);
	$item=$risposta_query_item->FetchRow();
	$query_descrizione="SELECT * FROM prezzi_1 WHERE item_code='".$item['bill_item_code']."'";
	$risposta_query_descrizione=$db->Execute($query_descrizione);
	$item_description=$risposta_query_descrizione->FetchRow();
	#$subtot=$subtot+($item['item_unit_cost']*$b);
	#echo "AGGIUNTO ".$item['item_description']." ".$subtot."<br>";
	$line = array( "Codice"    => $item['bill_item_code'],
               "Descrizione della prestazione"  => $item_description['item_description']." \n", 
               "Quantita'"     => $b,
               "Prezzo Unitario"      => $item['bill_item_unit_cost'],
               "Importo" => $b*$item['bill_item_unit_cost'] );
  $totale=$totale+($b*$item['bill_item_unit_cost']);
  #echo $totale."<br>";
  			if ($b!=0)
			{
			$size = $pdf->addLine( $y, $line );
			$y   += $size + 1;
			}
	}
}
/*
$tot_prods=array( array ("px_unit" => $totale ));
$tab_tva = array( "1"       => 0,
                  "2"       => 0);
$params  = array( "RemiseGlobale" => 0,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 0,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 0,
                      "portTTC"        => 0,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 0,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 0,
                      "accompte"         => 1.29,     // il valore del bollo  usato solo se > 77.47
                      "accompte_percent" => 0,    // pourcentage d'acompte (TTC)
                 "Remarque" => "" );
;
*/

$query_insert_storno="INSERT INTO care_storno (storno_encounter_nr, storno_bill_no, storno_date, storno_total_amount) VALUES (".$_POST['encounter_nr'].",".$_POST['fattura'].",'".date('Y-m-d')."',".$totale.")";
#echo $query_insert_storno;
#echo $subtot;
$db->Execute($query_insert_storno);
			
#$pdf->addTVAs( $params, $tab_tva, $subtot,$assicurazione);
$pdf->addCadreEurosFrancs2($totale);
$pdf->Output("../storni/".($num_storno['storno_id']+1).".pdf","F");
//$pdf->Output();
header("Location:../storni/".($num_storno['storno_id']+1).".pdf");

?>
