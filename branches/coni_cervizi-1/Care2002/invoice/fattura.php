<?php
/*
while (list($a,$b)=each($_GET))
{
echo "GG".$a."GG".$b."<br />";
}
while (list($a,$b)=each($_POST))
{
echo "##".$a."@@".$b."<br />";
}
exit;
*/
// (c) Xavier Nicolay
// Exemple de g��ation de devis/facture PDF

define('FPDF_FONTPATH','font/');
require('invoice.php');
require('../include/inc_environment_global.php');

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


//Variabili
$totale=12-(strlen($_POST['total']*100));
#echo $_POST['total'];
$bollo='no';
if ($_POST['total']>=77.47)
{
$_POST['total']=$_POST['total']+1.29;
$bollo='si';
}
#echo "<br>".$_POST['total'];
if($bollo=='no')
{
	$tot='';
	for($i=0;$i<$totale;$i++)
	{
	$tot.='0';
	}
	$tot.=$_POST['total']*100;
}
else
{
	$tot='';
	for($i=0;$i<$totale;$i++)
	{
	$tot.='0';
	}
	$tot.=$_POST['total']*100;
	####QUESTO SERVE PER AVERE IL TOTALE SENZA BOLLO - 12-10-2004
	$tot_senza_bollo='';
	for($i=0;$i<$totale;$i++)
	{
	$tot_senza_bollo.='0';
	}
	$tot_senza_bollo.=($_POST['total']-1.29)*100;
}
//echo $tot;
$fp=fopen("../Gesinf/temp/beneficiari/".date("d-m-Y").".txt",'a');
$query="SELECT * FROM care_encounter JOIN care_person WHERE care_encounter.pid=care_person.pid AND care_encounter.encounter_nr=".$_POST['patientno'];
$vai=$db->Execute($query);
$ecco=$vai->FetchRow();

if($_POST['rag_soc']=='')
{
if($ecco['addr_str_nr'])
$civico=$ecco['addr_str_nr'];
else
$civico='snc';
if (strstr(strtolower($_POST['tip_pag']),'bancomat') || strstr(strtolower($_POST['tip_pag']),'topcard'))
$pagamento=11;
else if (strstr(strtolower($_POST['tip_pag']),'assegno bancario'))
$pagamento=2;
else if (strstr(strtolower($_POST['tip_pag']),'assegno circolare'))
$pagamento=3;
else
$pagamento=5;
$cognome=Riempimento(strtoupper($ecco['name_last']),30);
$nome=Riempimento(strtoupper($ecco['name_first']),20);
$sesso=Riempimento(strtoupper($ecco['sex']),1);
$luogo_di_nascita=Riempimento(strtoupper($ecco['name_middle']),30);
$provincia_di_nascita=Riempimento('XX',2);
$data_di_nascita=riempimento(substr($ecco['date_birth'],8,2).substr($ecco['date_birth'],5,2).substr($ecco['date_birth'],0,4),8);
$persona_presso=Riempimento('',30);
$indirizzo_presso=Riempimento(strtoupper($ecco['addr_str']),30);
$numero_civico=Riempimento($civico,5);
$cap=Riempimento(strtoupper($ecco['addr_zip']),5);
$localita_di_residenza=Riempimento(strtoupper($ecco['sss_nr']),20);
$provincia_di_residenza=Riempimento('XX',2);
$telefono1=Riempimento($ecco['phone_1_nr'],20);
$telefono2=Riempimento($ecco['phone_2_nr'],20);
$codice_fiscale=Riempimento(strtoupper($ecco['insurance_nr']),16);
$piva=Riempimento('',11);
$codice_abi=Riempimento('',5);
$codice_cab=Riempimento('',5);
$codice_ritenuta_fiscale=Riempimento('',4);
$causale770=Riempimento('',1);
$modalita=Riempimento($pagamento,2);
$numero_conto_corrente=Riempimento('',15);
fwrite($fp,$cognome.$nome.$sesso.$luogo_di_nascita.$provincia_di_nascita.$data_di_nascita.$persona_presso.$indirizzo_presso.$numero_civico.$cap.$localita_di_residenza.$provincia_di_residenza.$telefono1.$telefono2.$codice_fiscale.$piva.$codice_abi.$codice_cab.$codice_ritenuta_fiscale.$causale770.$modalita.$numero_conto_corrente."C\n");
}
else
{
if($_POST['civico'])
$civico=$_POST['civico'];
else
$civico='snc';
if (strstr(strtolower($_POST['tip_pag']),'bancomat') || strstr(strtolower($_POST['tip_pag']),'topcard'))
$pagamento=11;
else if (strstr(strtolower($_POST['tip_pag']),'assegno bancario'))
$pagamento=2;
else if (strstr(strtolower($_POST['tip_pag']),'assegno circolare'))
$pagamento=3;
else
$pagamento=5;
$cognome=Riempimento(strtoupper($_POST['rag_soc']),30);
$nome=Riempimento('',20);
$sesso=Riempimento('S',1);
$luogo_di_nascita=Riempimento('',30);
$provincia_di_nascita=Riempimento('XX',2);
$data_di_nascita=Riempimento('',8);
$persona_presso=Riempimento('',30);
$indirizzo_presso=Riempimento(strtoupper($_POST['indirizzo']),30);
$numero_civico=Riempimento($civico,5);
$cap=Riempimento(strtoupper($_POST['cap']),5);
$localita_di_residenza=Riempimento(strtoupper($_POST['comune']),20);
$provincia_di_residenza=Riempimento('XX',2);
$telefono1=Riempimento('',20);
$telefono2=Riempimento('',20);
$codice_fiscale=Riempimento(strtoupper($_POST['cod_fis']),16);
$piva=Riempimento(strtoupper($_POST['piva']),11);
$codice_abi=Riempimento('',5);
$codice_cab=Riempimento('',5);
$codice_ritenuta_fiscale=Riempimento('',4);
$causale770=Riempimento('',1);
$modalita=Riempimento($pagamento,2);
$numero_conto_corrente=Riempimento('',15);
Fwrite($fp,$cognome.$nome.$sesso.$luogo_di_nascita.$provincia_di_nascita.$data_di_nascita.$persona_presso.$indirizzo_presso.$numero_civico.$cap.$localita_di_residenza.$provincia_di_residenza.$telefono1.$telefono2.$codice_fiscale.$piva.$codice_abi.$codice_cab.$codice_ritenuta_fiscale.$causale770.$modalita.$numero_conto_corrente."C\n");
}
fclose($fp);


$fp=fopen("../Gesinf/temp/fatture/".date("d-m-Y").".txt",'a');


if ($pagamento==5)
{
$tot_dummy=$tot;
$p_iva='03843680376';

}
else
{
$tot_dummy='000000000000';
$p_iva='           ';
}


if($_POST['rag_soc']=='')
{
 

$anno=Riempimento(date("Y"),4);
$codice_fiscale_beneficiario=Riempimento(strtoupper($ecco['insurance_nr']),16);
$descrizione=Riempimento('VARI ESAMI DEL SANGUE',100);
$numero_fattura=Riempimento('ISS-M-'.$_POST['billno'],15);
$conto_bancario=Riempimento('9000',16);
$codice_clausola_prima_nota=Riempimento('FA',4);
if($bollo=='no')
fwrite($fp,$anno."2AF".$codice_fiscale_beneficiario."           ".date("dmY").$numero_fattura.$conto_bancario.$descrizione.$codice_clausola_prima_nota.$tot."610000000000000000000000000   000000000000000000000000   000000000000000000000000   000000000000".$tot."000000000000".$tot."CEA.01.01.08.01               FO.02.          FO.02.          GEN.            ".$tot."SPP.D.09.10.01                000000000000                                                                              000000000000                                                                              000000000000                                                                              000000000000   5".$p_iva.$tot_dummy."\n");
else
fwrite($fp,$anno."2AF".$codice_fiscale_beneficiario."           ".date("dmY").$numero_fattura.$conto_bancario.$descrizione.$codice_clausola_prima_nota.$tot_senza_bollo."610000000000000000000000129715000000000000000000000000   000000000000000000000000   000000000000".$tot."000000000000".$tot."CEA.01.01.08.01               FO.02.          FO.02.          GEN.            ".$tot."SPP.D.09.10.01                000000000000                                                                              000000000000                                                                              000000000000                                                                              000000000000   5".$p_iva.$tot_dummy."\n");
}
else
{

$anno=Riempimento(date("Y"),4);
$codice_fiscale_beneficiario=Riempimento(strtoupper($_POST['cod_fis']),16);
$partita_iva=Riempimento(strtoupper($_POST['piva']),11);
$descrizione=Riempimento('VARI ESAMI DEL SANGUE',100);
$numero_fattura=Riempimento('ISS-M-'.$_POST['billno'],15);
$conto_bancario=Riempimento('9000',16);
$codice_clausola_prima_nota=Riempimento('FA',4);


if($bollo=='no')
fwrite($fp,$anno."2AF".$codice_fiscale_beneficiario.$partita_iva.date("dmY").$numero_fattura.$conto_bancario.$descrizione.$codice_clausola_prima_nota.$tot."610000000000000000000000000   000000000000000000000000   000000000000000000000000   000000000000".$tot."000000000000".$tot."CEA.01.01.08.01               FO.02.          FO.02.          GEN.            ".$tot."SPP.D.09.10.01                000000000000                                                                              000000000000                                                                              000000000000                                                                              000000000000   5".$p_iva.$tot_dummy."\n");
else
fwrite($fp,$anno."2AF".$codice_fiscale_beneficiario.$partita_iva.date("dmY").$numero_fattura.$conto_bancario.$descrizione.$codice_clausola_prima_nota.$tot_senza_bollo."610000000000000000000000129715000000000000000000000000   000000000000000000000000   000000000000".$tot."000000000000".$tot."CEA.01.01.08.01               FO.02.          FO.02.          GEN.            ".$tot."SPP.D.09.10.01                000000000000                                                                              000000000000                                                                              000000000000                                                                              000000000000   5".$p_iva.$tot_dummy."\n");
}


fclose($fp);

$query1='SELECT * from care_encounter WHERE encounter_nr='.$_POST['patientno'];
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
$pdf->fact_dev( "Fattura ", "ISS-M-".$_POST['billno'] );


//$query=" SELECT * from care_billing_bill where bill_no=".$num_bill.'"';
//$db->Execute($query);
//cambiamo l formato della data

$data=substr($_POST['presdate'],8,2).'-'.substr($_POST['presdate'],5,3).substr($_POST['presdate'],0,4);
$pdf->addDate($data);
$pdf->addClient($_POST['patientno']);
$pdf->addPageNumber("1");
if ($dati['sex']=='m') $titolo='Egr. Sig.';
else $titolo='Gen.le Sig.ra';
if(!$_POST['cap'] || !$_POST['indirizzo'])
{
$pdf->addClientAdresse("$titolo \n".$dati['name_first']." ".$dati['name_last']." \n".$dati['addr_str'].", ".$dati['addr_str_nr']."\n".$dati['addr_zip']." ".$dati['sss_nr']."\n\nCod.Fiscale:".$codicefiscale);
$pdf->addReference(" ".$_POST['note']);
}
else 
{
	$pdf->addClientAdresse($_POST['rag_soc']." \n".$_POST['indirizzo'].", ".$_POST['civico']."\n".$_POST['cap']." ".$_POST['comune']."\n\nCodice Fiscale/P. Iva:\n".$_POST['cod_fis'].$_POST['piva']);
	$pdf->addReference(" "."Le prestazioni sanitarie/analisi di laboratorio sotto indicate sono state effettuate per ".$dati['name_first']." ".$dati['name_last'] ."\n"." ".$_POST['note']);
}


$queryitems='SELECT * from care_billing_bill_item WHERE bill_item_bill_no='.$_POST['billno'];
$resultitems=$db->Execute($queryitems);
$conteggio=$resultitems->RecordCount();

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
$queryassicurazione="SELECT insurance_firm_id from care_encounter WHERE encounter_nr='".$_POST['patientno']."'";
$risassicurazione=$db->Execute($queryassicurazione);
$assicurazione=$risassicurazione->FetchRow();
$assicurazione=$assicurazione['insurance_firm_id'];
for ($i=0; $i<$conteggio; $i++)
{
  $itemdata=$resultitems->FetchRow();
 $querydes="SELECT item_description from prezzi_".$assicurazione." WHERE item_code='".$itemdata['bill_item_code']."'";
  $resultdes=$db->Execute($querydes);
  $resultdes2=$resultdes->FetchRow(); 
  $line = array( "Codice"    => $itemdata['bill_item_code'],
               "Descrizione della prestazione"  => $resultdes2['item_description']." \n", 
               "Quantita'"     => $itemdata['bill_item_units'],
               "Prezzo Unitario"      => $itemdata['bill_item_unit_cost'],
               "Importo" => $itemdata['bill_item_amount'] );
  $totale=$totale+$itemdata['bill_item_amount'];
$size = $pdf->addLine( $y, $line );
$y   += $size + 1;
	      
}




/*
$cols=array( 
	     "Codice" => 24,
             "Descrizione della prestazione"  => 88,
             "Quantita'"     => 22,
             "Prezzo Unitario"      => 26,
             "Importo" => 30);


$pdf->addCols( $cols);
$cols=array( "Codice"    => "L",
             "Descrizione della prestazione"  => "L",
             "Quantita'"     => "C",
             "Prezzo Unitario"      => "R",
             "Importo" => "R" );

$pdf->addLineFormat( $cols);


$y    = 109;
*/
/*
$line = array( "Codice"    => "CO 430",
               "Descrizione della prestazione"  => "Visita specialistica medicina generale`\n", 
               "Quantita'"     => "1",
               "Prezzo Unitario"      => "48.00",
               "Importo" => "48.00" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;

$line = array( "Codice"    => "CO 409",
               "Descrizione della prestazione"  => "Urinocoltura",
               "Quantita'"     => "1",
               "Prezzo Unitario"      => "7.80",
               "Importo" => "7.80" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;
$line = array( "Codice"    => "CO 32",
               "Descrizione della prestazione"  => "Antibiogramma",
               "Quantita'"     => "1",
               "Prezzo Unitario"      => "12.10",
               "Importo" => "12.10" );
$size = $pdf->addLine( $y, $line );
*/
$y   += $size + 2;

$line = array( "Codice"    => " ",
               "Descrizione della prestazione"  => $_POST['tip_pag'],
               "Quantita'"     => " ",
               "Prezzo Unitario"      => " ",
               "Importo" => " " );
$size = $pdf->addLine( $y, $line );
$y   += $size +2;


/*
$pdf->addCadreTVAs();
*/        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte

$tot_prods=array( array ("px_unit" => $totale, "qte" => 1, "tva" => 1 ));
/*
$tot_prods = array( array ( "px_unit" => 48, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" =>  7.80, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" => 12.10, "qte" => 1, "tva" => 1 ));
*/
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
                  "Remarque" => "La fattura rilasciata per prestazioni sanitarie\ne' esente da IVA ai sensi dell'art.10 del\nD.P.R. 633/1972 e successive modificazioni" );

$pdf->addTVAs( $params, $tab_tva, $tot_prods,$assicurazione);
$pdf->addCadreEurosFrancs();
$pdf->Output("../fatture/".$billno.".pdf","F");
//$pdf->Output();
header("Location:../fatture/".$billno.".pdf");


?>

