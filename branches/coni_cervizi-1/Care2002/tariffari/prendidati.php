<?
require ('../include/inc_environment_global.php');
require_once('../include/care_api_classes/class_core.php');

$query="select distinct prezzi_1.item_code,prezzi_1.item_description, prezzi_1.item_unit_cost, prezzi_10.item_unit_cost, prezzi_11.item_unit_cost from prezzi_1 join prezzi_10 join prezzi_11 where prezzi_1.item_code=prezzi_10.item_code and prezzi_1.item_code=prezzi_11.item_code";

echo $query;
$ris=$db->Execute($query);
//echo $ris;
$file="tabulati.txt";
$fp=fopen($file,"w") or die ("errore in apertura");
while ($dati=$ris->FetchRow())
{
  
  fwrite($fp,trim($dati[0])."#".trim($dati[1])."#".trim($dati[2])."#".trim($dati[3])."#".trim($dati[4])."\n");
}
fclose($fp);
?>