<?php
include ("../registration_admission/Mappa.php");
include ("../registration_admission/salva_su_db.php");
echo '<p align="center" >';
?><big><big><big><?php echo $mappa['CO427'][0];?></big></big></big>
<?php
echo "</p>";
$query="SELECT * FROM care_person WHERE pid=".$_GET['pid'];
//$query="SELECT per.name_first, per.name_last, per.date_birth, per.sex FROM care_encounter AS
//enc LEFT JOIN care_person AS per ON per.pid=enc.pid WHERE enc.encounter_nr=".$_GET['encounter_nr'];
$resultset=$db->Execute($query);
$dati=$resultset->FetchRow();
$devi_caricare=false;
if($_GET['carica']==true)
{ 
	$carica=new GestisciDati();
	$info=$carica->caricaDati($_GET);
	//echo $info['motivo'];
	$devi_caricare=true;
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

?>


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
if($dati['cellphone_1_nr']) 
echo $dati['cellphone_1_nr']; 
else 
echo $dati['phone_1_nr'];?>" disabled/>
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
<input type="text" name="specialita" size="10" value="<?php echo $dati['name_3']; ?>" disabled/>
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
</table>

<script language="javascript">
<!--
var pattern=new RegExp("[a-zA-Z]");
var risultato;
var temp;
function soloNumeri(stringa)
{
	temp=stringa.value;
	risultato=stringa.value.match(pattern);
	if(risultato.length>0) window.alert("Attenzione, e\' consentito inserire solamente numeri!");
	stringa.value=stringa.value.substr(0,stringa.value.length-1);
	//window.alert(stringa.value.substring(0,stringa.value.length-1));
}

function round(number,X)
   {
   X = (!X ? 2 : X);
   return Math.round(number*Math.pow(10,X))/Math.pow(10,X);
   }

function rendimento()
{
	//window.alert(carico.value);
	//window.alert(document.ecg_da_sforzo.peso.value);
if(document.ecg_da_sforzo.carico_.value!='' && document.ecg_da_sforzo.peso.value!='')	
valore=document.ecg_da_sforzo.carico_.value/document.ecg_da_sforzo.peso.value;
else
valore='';
	//window.alert(stringa.value.substring(0,stringa.value.length-1));
document.ecg_da_sforzo.rendimento_.value=round(valore);
}
function seiSicuro()
{
 risposta=window.confirm("In questo modo il referto sara' considerato terminato e non piu' modificabile, sei sicuro?");
if(risposta)
{ 

}
	else document.Ecocardiogramma_da_sforzo.stampa.value="";	
}
//-->
</script>

<form name='ecg_da_sforzo' method="POST">

Peso:<br>
<input type="text" name="peso" value="<? echo $info['peso']?>" size="20" onKeyUp="javascript:soloNumeri(this)" onBlur="javascript:rendimento()">
<br>
<br>
<table cols="8" rows="4" border="1">

<tr>

<td size="10" bgcolor="#fffffff" >
<p align="center">
Frequenza Cardiaca di base <br>
(bpm)
</p>
</td>
<td bgcolor="#fffffff" >
<p align="center">
Pressione arteriosa sistolica di base <br>
(mmHg)
</p>
</td>
<td bgcolor="#fffffff" >
<p align="center">
Pressione arteriosa diastolica  di base<br>
(mmHG)
</p>
</td>
</tr>
<?php
$colo[0]="fc_base";
$colo[1]="pas_base";
$colo[2]="pad_base";


for($i=0;$i<3;$i++)
{
	echo "<td>";
		echo "<p align='center'>";
		echo '<input type="text" size="8" value ="'.$info[rtrim($colo[$i])] .'" name="'.rtrim($colo[$i]).'"onKeyUp="javascript:soloNumeri(this)">';
		
		echo"</p>";
		
		echo"</td>";
		

	}
echo "</tr>";

?>
</table>
<br />

<table cols="8" rows="4" border="1">

<tr>

<td size="10" bgcolor="#fffffff" >
<p align="center">
Frequenza Max <br>
(bpm)
</p>
</td>
<td bgcolor="#fffffff" >
<p align="center">
Pressione arteriosa sistolica <br>
(mmHg)
</p>
</td>
<td bgcolor="#fffffff" >
<p align="center">
Pressione arteriosa diastolica <br>
(mmHG)
</p>
</td>
<td bgcolor="#fffffff" >
<p align="center">
Carico<br>
(W)
</p>
</td>
<td bgcolor="#fffffff" >
<p align="center">
Rendimento <br>
(Watt/Kg)
</p>
</td>
</tr>
<?php
$colo[0]="fc_";
$colo[1]="pas_";
$colo[2]="pad_";
$colo[3]="carico_";
$colo[4]="rendimento_";

for($i=0;$i<5;$i++)
{
	echo "<td>";
		echo "<p align='center'>";
		if($i<3)
		echo '<input type="text" size="8" value ="'.$info[rtrim($colo[$i])] .'" name="'.rtrim($colo[$i]).'"onKeyUp="javascript:soloNumeri(this)">';
		else if ($i==3)
		echo '<input type="text" size="8" value ="'.$info[rtrim($colo[$i])] .'" name="'.rtrim($colo[$i]).'" onKeyUp="javascript:soloNumeri(this)" onBlur="javascript:rendimento()">';
		else
		echo '<input type="text" size="8" value ="'.$info[rtrim($colo[$i])] .'" name="'.rtrim($colo[$i]).'"onKeyUp="javascript:soloNumeri(this)" readonly>';
		echo"</p>";
		
		echo"</td>";
		

	}
echo "</tr>";

?>
</table>
<br />

<br />
<tr>
Conclusioni:<br>
<textarea name="conclusioni" cols="120" rows="5"><? if ($info['conclusioni']) 
echo $info['conclusioni'];
else
echo "Nei limiti della norma. Assenti aritmia e anomalie della ripolarizzazione ventricolare. Assenti sintomi.";
?></textarea>
<br /><br />
</tr>
<td align="center">
<input type="submit" name="salva" value="Salva" action="salva_su_db.php" >
</td>
<td align="center">
<input type="submit" name="stampa_temp" value="Stampa Temporanea">
</td>
<td align="center">
<input type="submit" name="stampa" value="Stampa Definitiva" onClick="javascript:seiSicuro(this)" >
</td>
<input type="hidden" name="carica" value="<?echo $devi_caricare ?>" >
<input type="hidden" name="colonne" value="<?echo $i?>">
<input type="hidden" name="righe" value="<?echo $j?>" >
<input type="hidden" name="encounter_nr" value="<?echo $_GET['encounter_nr']?>">
<input type="hidden" name="appt_nr" value="<?echo $_GET['appt_nr']?>" >
<input type="hidden" name="sess_user_name" value="<?echo $_GET['sess_user_name']?>" >
<input type="hidden" name="tipo_esame" value="<?echo $_GET['tipo_esame']?>" >
<!-- ATTENZIONE, QUESTA DEVE ESSERE SEMPRE L'ULTIMO CAMPO DI INPUT!!! -->
<input type="hidden" name="item_code" value="<?echo $_GET['codice']?>" >

</form>




<?php

?>
