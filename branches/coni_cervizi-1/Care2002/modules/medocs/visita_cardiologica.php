<?php
include ("../registration_admission/Mappa.php");
include ("../registration_admission/salva_su_db.php");
echo '<p align="center" >';
?><big><big><big><?php echo $mappa['CO419'][0];?></big></big></big>
<?php
echo "</p>";
$query="SELECT per.*,enc.insurance_firm_id FROM care_person AS per LEFT JOIN care_encounter AS enc ON enc.pid=per.pid WHERE per.pid=".$_GET['pid'];
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
$vecchie_notizie="SELECT * FROM care_encounter_notes WHERE encounter_nr=".$_GET['encounter_nr']." ORDER BY nr DESC";
$i2=0;
$fine=0;
$concl='';
$risulta=$db->Execute($vecchie_notizie);

while($risultato=$risulta->FetchRow())
{
  $array=split("#",$risultato['notes']);
  while($array[$i2])
  {
  $array2=split("=",$array[$i2]);
  if($array2[0]=='familiare')
  	$fami=$array2[1];
  
  if($array2[0]=='personale')
  	$pers=$array2[1];
	
	
  if(($array2[0]=='item_code' && $array2[1]=='CO419') || ($array2[0]=='item_code' && $array2[1]=='CO420'))
  {
  $fine=1;
  break;
  }
   $i2++;
  }
 if($fine==1)
 break;
 
 $concl='';
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
<td align="right" bgcolor="#fffffff" >
Qualifica
</td>
<td>
<?php
if ($dati['insurance_firm_id']==13)
$qualifica='I.N.';
else if ($dati['insurance_firm_id']==14)
$qualifica='P.O.';
else if ($dati['nat_id_nr'] && $dati['insurance_firm_id']!=14 && $dati['insurance_firm_id']!=13)
$qualifica='Atleta';
else
$qualifica='Privato';
?>
<input type="text" name="eta" size="10" value="<?php echo $qualifica; ?>" disabled/>
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

function seiSicuro()
{
 risposta=window.confirm("In questo modo il referto sara' considerato terminato e non piu' modificabile, sei sicuro?");
if(risposta)
{ 

}
	else document.visita_cardiologica.stampa.value="";	
}
//-->
</script>

<form name='visita_cardiologica' method="POST">





<tr>
<big>Anamnesi familiare:</big><br>
<textarea name="familiare" cols="120" rows="5"><? if($info['familiare']) 
echo $info['familiare'];
else if ($fami) 
echo $fami;
else
echo "Negativa";
?></textarea>
<br /><br />
</tr>
<tr>
<big>Anamnesi personale:</big><br>
<textarea name="personale" cols="120" rows="5"><? if($info['personale']) 
echo $info['personale'];
else if($pers)
echo $pers;
else
echo "Anamnesi personale negativa per patologia e sintomi di natura cardiovascolare. L'atleta nega di assumere farmaci.";
?></textarea>
<br /><br />
</tr>


<tr>
<big>Esame obiettivo</big><br>
<textarea name="obiettivo" cols="120" rows="5"><? if ($info['obiettivo']) 
echo $info['obiettivo'];
else
echo "Primo e secondo tono netti. Pause libere.";
?></textarea>
<br /><br />
</tr>

<table cols="4" rows="2" border="1" cellspacing="10">

<tr>

<td size="10" bgcolor="#fffffff" >
<p align="center">
PAS <br>
(mmHg)
</p>
</td>
<td bgcolor="#fffffff" >
<p align="center">
PAD <br>
(mmHg)
</p>
</td>

</tr>
<?php
$colo[0]="PAS_";
$colo[1]="PAD_";



for($i=0;$i<2;$i++)
{
	echo "<td>";
		echo "<p align='center'>";
		
		echo '<input type="text" size="10" value ="'.$info[rtrim($colo[$i])] .'" name="'.rtrim($colo[$i]).'"onKeyUp="javascript:soloNumeri(this)">';
		echo"</p>";	
		echo"</td>";

	}
echo "</tr>";

?>
</table>
<br /><br />
<!--
<tr>
<big>Conclusioni:</big><br>
<textarea name="conclusioni" cols="139" rows="5"><? if($info['conclusioni']) 
echo $info['conclusioni'];
else
echo "Visita cardiologica nei limiti della norma";
?></textarea>
<br /><br />
</tr>
-->
<td align="center">
<input type="submit" name="salva" value="Salva" action="salva_su_db.php" >
</td>
<td align="center">
<input type="submit" name="stampa_temp" value="Stampa Temporanea">
</td>
<td align="center">
<input type="submit" name="stampa" value="Stampa Definitiva"  >
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
