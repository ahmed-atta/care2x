<?
require ('../include/inc_environment_global.php');
require_once($root_path.'include/care_api_classes/class_core.php');
$core= new Core;



$percorso=file("prestazioni.txt");
while(list(,$value)=each($percorso))
{
  list($codice,$prestazione,$privato,$unisalute,$coni)=split("#",$value);
  $codice=trim($codice);
  $codice=str_replace(" ","",$codice);
 $query="INSERT INTO prezzi_11 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('$codice', '$prestazione', $coni, 'HS', '0')"; 
 // $query2="INSERT INTO prezzi_10 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('$codice', '$prestazione', $unisalute, 'HS', '0')"; 
 //$query3="INSERT INTO prezzi_0 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('$codice', '$prestazione', $privato, 'HS', '0')"; 
 //echo $query.";<br>";


$db->Execute($query);
$db->Execute($query2);
$db->Execute($query3);

 //echo "ciao";

//echo $codice. " ". $prestazione. " " . $privato. " " . $unisalute . " ". $coni. "<br>";
}
//QUESTE RIGHE FUORI DAI WHILE SONO PER AGGIUNGERE I POCHI ITEM CHE NEL CICLO NON VENIVANO INSERITE
$query4="INSERT INTO prezzi_0 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('CO419', 'Visita specialistica cardiologica', 60.00, 'HS', '0')";
$db->Execute($query4);
/*
$query5="INSERT INTO prezzi_0 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('CO491', 'Ecotomografia muscolare e tendinea e/o articolare (per segmento di arto)', 60.00, 'HS', '0')";  
$query6="INSERT INTO prezzi_10 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('CO491', 'Ecotomografia muscolare e tendinea e/o articolare (per segmento di arto)', 54.00, 'HS', '0')";
 $query7="INSERT INTO prezzi_11 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('CO491', 'Ecotomografia muscolare e tendinea e/o articolare (per segmento di arto)', 48.00, 'HS', '0')";
$db->Execute($query5);
$db->Execute($query6);
$db->Execute($query7);
$query8="INSERT INTO prezzi_0 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('CO517', 'Rx grandi segmenti di arto (2 proiezioni)', 40.00, 'HS', '0')";  
$query9="INSERT INTO prezzi_10 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('CO491', 'Rx grandi segmenti di arto (2 proiezioni)', 36.00, 'HS', '0')";
 $query10="INSERT INTO prezzi_11 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('CO491', 'Rx grandi segmenti di arto (2 proiezioni)', 32.00, 'HS', '0')";
$db->Execute($query8);
$db->Execute($query9);
$db->Execute($query10);
*/

$percorso2=file("analisi.txt");
while(list(,$value2)=each($percorso2))
{
  list($codice,$prestazione,$privato,$unisalute,$coni)=split("#",$value2);
  $codice=trim($codice);
  $codice=str_replace(" ","",$codice);
  $privato=(double) str_replace(",",".",$privato);
  $unisalute=(double) str_replace(",",".",$unisalute);
  $coni=(double) str_replace(",",".",$coni);
  $query11="INSERT INTO prezzi_11 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('$codice', '$prestazione', $coni,'LT', '0')"; 
  $query12="INSERT INTO prezzi_10 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('$codice', '$prestazione', $unisalute,'LT', '0')";
  $query13="INSERT INTO prezzi_0 (item_code, item_description, item_unit_cost, item_type, item_discount_max_allowed) VALUES ('$codice', '$prestazione', $privato,'LT', '0')";
  $db->Execute($query11);
$db->Execute($query12);
$db->Execute($query13);
  //echo "salve";

  // echo $codice. " ". $prestazione. " " . $privato. " " . $unisalute . " ". $coni. "<br>";
}

echo "L'operazione e' andata a buon fine!!!";
?>