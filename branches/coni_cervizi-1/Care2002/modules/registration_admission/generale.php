<?php
require('./roots.php');
//require($root_path.'include/inc_environment_global.php');
include ("salva_su_db.php");
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

<form name="Medicina_Generale" method="POST" >
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
<input type="text" name="pr" size="10" disabled/>
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

</tr>
<tr>
<td bgcolor="#fffffff" >Motivo della consultazione</td>
<td>
<select name="consultazione">
<option>Valutazione P.O.</option> 
<option>Valutazione I.N.</option>
<option>Valutazione specialistica</option> 
<option>Controllo specialistico</option>
 </select>

</td>
</tr>


</table>

<br /><br />
<b><big>RILIEVI ANAMNESTICI</big></b>
<br />
<br />
<table border=1>
<tr>
<td bgcolor="#fffffff" >
Anamnesi familiare
</td>
<td>
<input type="text" name="familiare_medicina" size="140" value="<?php echo $info['familiare_medicina'];?>"/>
</td>
</tr>
</table>
<br />
<b><big>ANAMNESI PERSONALE FISIOLOGICA</big></b>
<br /><br />
<table border=1>
<tr>
<td bgcolor="#fffffff" >
Alimentazione
</td>
<td >
<input type="text" name="alimentazione"  value="<?php echo $info['alimentazione'];?>" size="140" />
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Nascita e sviluppo psicofisico
</td>
<td >
<input type="text" name="psicofisico"  value="<?php echo $info['psicofisico'];?>" size="140" />
</td>
</tr>
</table>
<table border=1>
<tr>
<td bgcolor="#fffffff" >
Digestione
</td>
<td >
<input type="text" name="digestione" size="30"  value="<?php echo $info['digestione'];?>"/>
</td>
<td bgcolor="#fffffff" >
Diuresi
</td>
<td >
<input type="text" name="diuresi" size="30"  value="<?php echo $info['diuresi'];?>"/>
</td>
<td bgcolor="#fffffff" >
Alvo
</td>
<td >
<input type="text" name="alvo" size="30"  value="<?php echo $info['alvo'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Caffe'
</td>
<td >
<input type="text" name="caffe" size="30"  value="<?php echo $info['caffe'];?>"/>
</td>
<td bgcolor="#fffffff" >
Alcolici
</td>
<td >
<input type="text" name="alcolici" size="30" value="<?php echo $info['alcolici'];?>" />
</td>
<td bgcolor="#fffffff" >
Fumo
</td>
<td >
<input type="text" name="fumo" size="30"  value="<?php echo $info['fumo'];?>"/>
</td>
</tr>
</table>
<table border=1>
<td bgcolor="#fffffff" >
Ciclo mestruale
</td>
<td >
<input type="text" name="ciclo" size="140"  value="<?php echo $info['ciclo'];?>"/>
</td>
</table>
<table border=1>
<td bgcolor="#fffffff" >
Riposo
</td>
<td >
<input type="text" name="riposo" size="30"  value="<?php echo $info['riposo'];?>"/>
</td>
</tr>
</table>
<br />
<table border=1>
<tr>
<td bgcolor="#fffffff" >
Terapie in atto
</td>
<td >
<input type="text" name="terapie" size="140"  value="<?php echo $info['terapie'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Uso di farmaci e integratori
</td>
<td >
<input type="text" name="farmaci" size="140"  value="<?php echo $info['farmaci'];?>"/>
</td>
<tr>
<td bgcolor="#fffffff" >
Fase di preparazione
</td>
<td >
<input type="text" name="preparazione" size="140"  value="<?php echo $info['preparazione'];?>"/>
</td>

</tr>
<tr>
<td bgcolor="#fffffff" >
Anamnesi personale patologica
</td>
<td >
<textarea cols="108" rows="5" name="personale_medicina"><?php echo $info['personale_medicina'];?></textarea>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Vaccinazioni
</td>
<td>
<input type="text" name="vaccinazioni" size="100"  value="<?php echo $info['vaccinazioni'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Allergie
</td>
<td>
<input type="text" name="allergie" size="100"  value="<?php echo $info['allergie'];?>"/>
</td>
</tr>
</table>
<br /><br />
<b><big>ESAME CLINICO GENERALE</big></b>
<br />
<br />
<table border=1>
<tr>
<td bgcolor="#fffffff" >
Condizioni generali
</td>
<td>
<input type="text" name="generali" size="100"  value="<?php echo $info['generali'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Cute e mucose visibili
</td>
<td>
<input type="text" name="visibili" size="100"  value="<?php echo $info['visibili'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Sottocutaneo
</td>
<td>
<input type="text" name="sottocutaneo" size="100"  value="<?php echo $info['sottocutaneo'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Masse muscolari
</td>
<td>
<input type="text" name="masse" size="100"  value="<?php echo $info['masse'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Capo
</td>
<td>
<input type="text" name="capo" size="100"  value="<?php echo $info['capo'];?>"/>
</td>
</tr>

<tr>
<td bgcolor="#fffffff" >
Faringe
</td>
<td>
<input type="text" name="faringe" size="100"  value="<?php echo $info['faringe'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Dentatura
</td>
<td>
<input type="text" name="dentatura" size="100"  value="<?php echo $info['dentatura'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Tiroide
</td>
<td>
<input type="text" name="tiroide" size="100"  value="<?php echo $info['tiroide'];?>"/>
</td>
</tr>
</table>
<br />
<table border=1>
<tr>
<td bgcolor="#fffffff" >
Torace
</td>
<td>
<input type="text" name="torace" size="100"  value="<?php echo $info['torace'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Apparato respiratorio
</td>
<td>
<input type="text" name="respiratorio" size="100"  value="<?php echo $info['respiratorio'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Apparato cardiovascolare
</td>
<td>
<input type="text" name="cardiovascolare" size="100"  value="<?php echo $info['cardiovascolare'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Apparato digerente
</td>
<td>
<input type="text" name="digerente" size="100"  value="<?php echo $info['digerente'];?>"/>
</td>
</tr>
<tr>
<td bgcolor="#fffffff" >
Apparato urogenitale
</td>
<td>
<input type="text" name="urogenitale" size="100"  value="<?php echo $info['urogenitale'];?>"/>
</td>
</tr>

<tr>
<td bgcolor="#fffffff" >
Apparato osteoarticolare
</td>
<td>
<input type="text" name="osteoarticolare" size="100"  value="<?php echo $info['osteoarticolare'];?>"/>
</td>
</tr>

<tr>
<td bgcolor="#fffffff" >
Apparato neuromuscolare
</td>
<td>
<input type="text" name="neuromuscolare" size="100"  value="<?php echo $info['neuromuscolare'];?>"/>
</td>
</tr>


<tr></tr>
<tr>
<td bgcolor="#fffffff" >
ALTRO
</td>
<td>
<input type="text" name="altro" size="100"  value="<?php echo $info['altro'];?>"/>
</td>
</tr>
</table>

<br />
<td align="center">
<input type="submit" name="salva" value="Salva" action="salva_su_db.php">
</td>
<td align="center">
<input type="submit" name="stampa_temp" value="Stampa Temporanea" action="salva_su_db.php">
</td>
<td align="center">
<input type="submit" name="stampa" value="Stampa Definitiva" onClick="javascript:seiSicuro()">
</td>
<!--
<td align="center">
<input type="submit" name="altro_foglio" value="Conclusioni in breve" action="salva_su_db.php">
</td>
-->
<input type="hidden" name="carica" value="<?echo $devi_caricare?>" >
<input type="hidden" name="colonne" value="<?echo $i?>">
<input type="hidden" name="righe" value="<?echo $j?>" >
<input type="hidden" name="encounter_nr" value="<?echo $_GET['encounter_nr']?>">
<input type="hidden" name="appt_nr" value="<?echo $_GET['appt_nr']?>" >
<input type="hidden" name="sess_user_name" value="<?echo $_GET['sess_user_name']?>" >
<input type="hidden" name="tipo_esame" value="<?echo $_GET['tipo_esame']?>" >
<!-- ATTENZIONE, QUESTA DEVE ESSERE SEMPRE L'ULTIMO CAMPO DI INPUT!!! -->
<input type="hidden" name="item_code" value="<?echo $_GET['codice']?>" >

</form>
