<?php 
include ("../registration_admission/salva_su_db.php");
//include ("precotto.html");
require("../registration_admission/Mappa.php");
$cosa=new gestisciDati4();
$info=$cosa->caricaDati4($_GET);
if($info)
$carica=true;
else
$carica=false;
$domanda=" SELECT enc.pid, per.* FROM care_encounter AS enc LEFT JOIN care_person AS per  ON enc.pid=per.pid WHERE enc.encounter_nr=".$_GET['encounter_nr'];
$risp=$db->Execute($domanda);
$dati=$risp->FetchRow();
$query="SELECT * FROM care_encounter_notes WHERE encounter_nr=".$_GET['encounter_nr']." AND aux_notes=".$_GET['nr'];
$answer=$db->Execute($query);
$risp=$answer->FetchRow();
$array1=split("#",$risp['notes']);
$i=0;
while($array1[$i])
{
$array2=split("=",$array1[$i]);
if ($array2[0]=='conclusioni' || $array2[0]=='conclusioni_visita_specialistica' || $array2[0]=='obiettivo')
$conclusioni_visita_gen=$array2[1];
if($array2[0]=='conclusioni_ecg_di_base')
$conclusioni_ecg_di_base=$array2[1];
if($array2[0]=='personale')
$anamnesipersonale=$array2[1];
if($array2[0]=='familiare')
$anamnesifamiliare=$array2[1];

//echo " ".$array2[1]."<br />";

$i++;

}

###FUNZIONE CHE CALCOLA L'ETA'
$eta=(substr(date('Y-m-d'),0,4)-substr($dati['date_birth'],0,4));
if(substr(date('Y-m-d'),5,2)<substr($dati['date_birth'],5,2))
$eta--;
else if (substr(date('Y-m-d'),5,2)==substr($dati['date_birth'],5,2))
	{
		if (substr(date('Y-m-d'),8,2)<substr($dati['date_birth'],8,2))
		$eta--;
	}

###qui deve ricaricare i dati salvati
?>
<html>
<head>
</head>
<body>


<script  language="javascript">
<!-- 
function Apri(path) {
//document.form.Medicina_Generale.target="_blank";
document.form.Medicina_Generale.action=path;

document.form.submit();

}
function seiSicuro()
{
	risposta=window.confirm("In questo modo il referto sara' considerato terminato e non piu' modificabile, sei sicuro?");
	
	if(risposta) 
	{
		document.Medicina_Generale.action="salva_su_db.php";
		document.Medicina_Generale.submit();
	}
	else document.Medicina_Generale.stampa.value="";
}
-->
</script>

<p align="center"><b><big>ISTITUTO NAZIONALE DI MEDICINA DELLO SPORT</big></b>
<br />
<b><big>C.O.N.I.</big></b>
<br />
<img src="../../gui/img/logos/lopo/default/logo_coni.jpg"  align="center"/>
<br />
Direttore: Prof. G. Caselli
</p>

<br />

<form name="rel_concl_cardio" method="POST" >
<table border=1>
<tr >
<td align="right" bgcolor="#fffffff">Cognome </td>
<td>
<input type="text" name="cognome" size="20" value="<?php echo $dati['name_last']; ?>" disabled/>
</td>

<td bgcolor="#fffffff" align="right">
Nome
</td>
<td>
<input type="text" name="nome" size="15" value="<?php echo $dati['name_first']; ?>" disabled/>
</td>
<td align="right" bgcolor="#fffffff" >
<?php
if ($dati['sex']=='m')
{
?>
Nato a
<?php
}
else
{
?>
Nata a 
<?php
}?>
</td>
<td>
<input type="text" name="nato" size="10"  value="<?php echo $dati['name_middle']; ?>" disabled/>
</td>
</tr>
<tr >

<td align="right" bgcolor="#fffffff" >
Provincia di nascita
</td>
<td>
<input type="text" name="provincia" size="20" disabled/>
</td>
<td align="right" bgcolor="#fffffff" >
Il
</td>
<td>
<?php
$compl=substr($dati['date_birth'],8,2)."-".substr($dati['date_birth'],5,2)."-".substr($dati['date_birth'],0,4);
?>
<input type="text" name="il" size="15" value="<?php echo $compl; ?>" disabled/>
</td>
<td align="right" bgcolor="#fffffff" >
Eta'
</td>
<td>
<input type="text" name="eta" size="10" value="<?php echo $eta; ?>" disabled/>
</td>
</tr>
<tr>
<td align="right" bgcolor="#fffffff" >
Residente a
</td>
<td>
<input type="text" name="residente" size="20" value="<?php echo $dati['sss_nr']; ?>" disabled/>
</td>
<td align="right" bgcolor="#fffffff" >
Indirizzo
</td>
<td>
<input type="text" name="indirizzo" size="30" value="<?php echo $dati['addr_str']; ?>" disabled/>
</td>
<td align="right" bgcolor="#fffffff" >
PR
</td>
<td>
<input type="text" name="pr" size="10" value="<?php echo $dati['citizenship']; ?>" disabled/>
</td>

<td align="right" bgcolor="#fffffff" >
Tel.
</td>
<td>
<input type="text" name="telefono" size="10" value="<?php 
if($dati['phone_1_nr']) 
echo $dati['phone_1_nr']; 
else 
echo $dati['cellphone_1_nr'];?>" disabled/>
</td>
</tr>
<!--</table>-->
<br /><br />
<!--<table border=1>-->
<tr>
<td bgcolor="#fffffff" >
Sport
</td>
<td>
<input type="text" name="sport" size="10" value="<?php echo $dati['name_maiden']; ?>" disabled/>
<!--<select name="sport">
<option>Atletica leggera</option>
<option>Baseball</option>
</select>
-->
</td>
<td bgcolor="#fffffff" >
Specialita'/Ruolo/Categoria
</td>
<td>
<input type="text" name="specialita" size="15" value="<?php echo $dati['name_3']; ?>" disabled/>
<!--
<select name="specialita">
<option>Lanciatore</option> 
<option>Ricevitore</option>
 </select>
-->
</td>
<td bgcolor="#fffffff" >
Inizio ad anni
</td>
<td>
<input type="text" name="anni" size="8" value="<?php echo $dati['name_others'];?>" disabled/>
</td>
<td bgcolor="#fffffff" >
Societa' di appartenenza
</td>
<td>
<input type="text" name="societa" size="10" value="<?php echo $dati['nat_id_nr'];?>" disabled/>
</td>
<table>
<form method="POST" action="../registration_admission/salva_su_db.php">
<b><big>SINTESI ANAMNESTICA</big></b>
<br /><br />
<b>Anamnesi Familiare</b>
<br />
<textarea cols="80" rows="5" name="anamnestica_familiare"><?php if($info['anamnestica_familiare'])
echo $info['anamnestica_familiare'];
else
echo  $anamnesifamiliare;?></textarea>
<br /><br />
<b>Anamnesi Personale</b>
<br />
<textarea cols="80" rows="5" name="anamnestica_personale"><?php 
if ($info['anamnestica_personale'])
echo $info['anamnestica_personale'];
else
echo $anamnesipersonale; ?></textarea>
<br /><br />
<big>SINTESI DEGLI ACCERTAMENTI ESEGUITI</big></b>
<br />

<b><?php echo "Visita Specialistica Cardiologica";?></b>
<br />
<textarea cols="80" rows="20" name="conclusioni_visita_spec" readonly><?php echo $conclusioni_visita_gen;?></textarea>
<br />

<?php
if($conclusioni_ecg_di_base)
{
?>
<br />
<b><?php echo "ECG di Base"; ?></b>
<br />
<textarea cols="80" rows="20" name="conclusioni<?php echo $cont?>" readonly><?php  echo $conclusioni_ecg_di_base; ?></textarea>
<br />
<?php
}

//$altre=split("@","777@888@999@");
$altre=split("@",$_GET['appt_nr']);
$cont_max=count($altre)-1;
#print_r($altre);
for($cont=0;$cont<$cont_max;$cont++)
{
$query2="SELECT * FROM care_encounter_notes WHERE ref_notes_nr=".$altre[$cont];
#echo $query2;
$answer2=$db->Execute($query2);
$answer2=$answer2->FetchRow();
$array3=split("#",$answer2['notes']);
$j=0;
while($array3[$j])
{
$array4=split("=",$array3[$j]);
if ($array4[0]=='item_code')
{
$item_code_glob.=$array4[1]."@";
$item_code=$array4[1];
}
if ($array4[0]=='conclusioni' || $array4[0]=='conclusioni_holter')
$conclusioni=$array4[1];
$j++;

}
?>
<br />
<b><?php echo $mappa[$item_code][0]?></b>
<br />
<textarea cols="80" rows="20" name="conclusioni<?php echo $cont?>" readonly><?php  echo $conclusioni; ?></textarea>
<br />
<?php
}
?>
<br /><br />
<b><big>CONCLUSIONI</big></b>
<br />
<textarea cols="80" rows="20" name="conclusioni_globali"><?php if ($info['conclusioni_globali']) 
echo $info['conclusioni_globali'];
else
echo "Esame clinico ed esami strumentali nei limiti della norma.";
?></textarea>
<br />
<br />
<input type="submit" name="salva_rel_con_card" value="Salva" />
<input type="submit" name="stampa_rel_con_card" value="Stampa Definitiva" />
<input type="submit" name="stampa_temp_rel_con_card" value="Stampa Temporanea" />
<input type="hidden" name="nr" value="<?php echo $_GET['nr']?>">
<input type="hidden" name="delta" value="<?php echo $_GET['delta']?>">
<input type="hidden" name="encounter_nr" value="<?php echo $_GET['encounter_nr']?>">
<input type="hidden" name="cardio" value="<?php echo "vero" ?>">
<?php
if($conclusioni_ecg_di_base)
{
?>
<input type="hidden" name="conclusioni_ecg_di_base" value="<?php echo $conclusioni_ecg_di_base; ?>">
<?php
}
?>
<input type="hidden" name="codici" value="<?php echo $item_code_glob; ?>">
<input type="hidden" name="contatore" value="<?php echo $cont_max ?>">
<input type="hidden" name="carica" value="<?php echo $carica?>">
</form>
</table>
</body>
</html>
