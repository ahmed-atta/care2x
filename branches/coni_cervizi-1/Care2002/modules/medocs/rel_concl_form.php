<?php 
include ("../registration_admission/salva_su_db.php");
include ("precotto.html");

$cosa=new gestisciDati2();
$info=$cosa->caricaDati2($_GET);
if($info)
$carica=true;
else
$carica=false;
$query="SELECT * FROM care_encounter_notes WHERE encounter_nr=".$_GET['encounter_nr']." AND aux_notes=".$_GET['nr'];
$answer=$db->Execute($query);
$risp=$answer->FetchRow();
$array1=split("#",$risp['notes']);
$i=0;
while($array1[$i])
{
$array2=split("=",$array1[$i]);
if ($array2[0]=='consultazione')
$motivoconsult=$array2[1];
if($array2[0]=='personale')
break;
//echo " ".$array2[1]."<br />";

$i++;

}

###qui deve ricaricare i dati salvati
?>
<html>
<head>
</head>
<body>
<form method="POST" action="../registration_admission/salva_su_db.php">
<b><big>SINTESI ANAMNESTICA</big></b>
<br /><br />
<textarea cols="80" rows="5" name="anamnestica"><?php if($info['anamnestica']) echo $info['anamnestica']; else echo $array2[1]; ?></textarea>
<br /><br />
<b><big>SINTESI DEGLI ACCERTAMENTI ESEGUITI</big></b>
<br />
<textarea cols="80" rows="20" name="accertamenti"><?php if($info['accertamenti']) echo $info['accertamenti']; else echo $accertamenti;?></textarea>
<br />
<b><big>CONCLUSIONI</big></b>
<br />
<textarea cols="80" rows="20" name="conclusioni"><?php if($info['conclusioni']) echo $info['conclusioni']; else echo $conclusioni; ?></textarea>
<br />
<br />
<input type="submit" name="salva_rel_con" value="Salva" />
<input type="submit" name="stampa_rel_con" value="Stampa Definitiva" />
<input type="submit" name="stampa_temp_rel_con" value="Stampa Temporanea" />
<input type="hidden" name="nr" value="<?php echo $_GET['nr']?>">
<input type="hidden" name="delta" value="<?php echo $_GET['delta']?>">
<input type="hidden" name="encounter_nr" value="<?php echo $_GET['encounter_nr']?>">
<input type="hidden" name="motivoconsult" value="<?php echo $motivoconsult ?>">
<input type="hidden" name="carica" value="<?php echo $carica?>">
</form>
</body>
</html>
