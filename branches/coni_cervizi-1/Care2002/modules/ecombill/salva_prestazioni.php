<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* Developed by
* Marco Bernardi
* Francesco Imme'
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
$controllo="select * from prezzi_1 where item_code='".$_POST['codice']."'";
$ris=$db->Execute($controllo);

if($ris->RecordCount()) echo "Il codice inserito e' gia' presente";
else 
{
// Inserisco i dati nelle varie tabelle
	$sql="Insert into prezzi_1 (item_code,item_description,item_unit_cost,item_discount_max_allowed,item_type,WHO) values ('".$_POST['codice']."','".$_POST['descrizione']."',".$_POST['privato'].",0,'".$_POST['tipo']."',".$_POST['chi'].")";	
$db->Execute($sql);		
$sql="Insert into prezzi_10  (item_code,item_description,item_unit_cost,item_discount_max_allowed,item_type,WHO) values ('".$_POST['codice']."','".$_POST['descrizione']."',".$_POST['unisalute'].",0,'".$_POST['tipo']."',".$_POST['chi'].")";
$db->Execute($sql);	
$sql="Insert into prezzi_11  (item_code,item_description,item_unit_cost,item_discount_max_allowed,item_type,WHO) values ('".$_POST['codice']."','".$_POST['descrizione']."',".$_POST['coni'].",0,'".$_POST['tipo']."',".$_POST['chi'].")";
$db->Execute($sql);	
$sql="Insert into prezzi_12  (item_code,item_description,item_unit_cost,item_discount_max_allowed,item_type,WHO) values ('".$_POST['codice']."','".$_POST['descrizione']."',".$_POST['legge'].",0,'".$_POST['tipo']."',".$_POST['chi'].")";
$db->Execute($sql);	
$sql="Insert into prezzi_13  (item_code,item_description,item_unit_cost,item_discount_max_allowed,item_type,WHO) values ('".$_POST['codice']."','".$_POST['descrizione']."',".$_POST['inter'].",0,'".$_POST['tipo']."',".$_POST['chi'].")";
$db->Execute($sql);	
$sql="Insert into prezzi_14  (item_code,item_description,item_unit_cost,item_discount_max_allowed,item_type,WHO) values ('".$_POST['codice']."','".$_POST['descrizione']."',".$_POST['po'].",0,'".$_POST['tipo']."',".$_POST['chi'].")";
$db->Execute($sql);	
$sql="Insert into prezzi_9  (item_code,item_description,item_unit_cost,item_discount_max_allowed,item_type,WHO) values ('".$_POST['codice']."','".$_POST['descrizione']."',".$_POST['unisalute'].",0,'".$_POST['tipo']."',".$_POST['chi'].")";
$db->Execute($sql);	

echo "Inserimento eseguito";
}
?>
