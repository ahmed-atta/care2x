<?php

require('./roots.php');
//require($root_path.'include/inc_environment_global.php');
include ("../registration_admission/salva_su_db.php");
/*$query="SELECT * FROM care_person WHERE pid=".$_GET['pid'];
//$query="SELECT per.name_first, per.name_last, per.date_birth, per.sex FROM care_encounter AS
//enc LEFT JOIN care_person AS per ON per.pid=enc.pid WHERE enc.encounter_nr=".$_GET['encounter_nr'];
$resultset=$db->Execute($query);
$dati=$resultset->FetchRow();
$devi_caricare=false;*/
$delta=substr(date('Y-m-d'),2,2).substr(date('Y-m-d'),5,2).substr(date('Y-m-d'),8,2);
$sql=" SELECT per.*, enc.* FROM care_person AS per LEFT JOIN care_encounter AS enc ON per.pid=enc.pid WHERE encounter_nr=".$_GET['encounter_nr'];
$rispos=$db->Execute($sql);
$rispo=$rispos->FetchRow();

$sql2="";

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
		document.Medicina_Generale.action="../registration_admission/salva_su_db.php";
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

<form name="Medicina_Generale" method="POST" action="../registration_admission/salva_su_db.php">
<table border=1>
<tr >
<td align="right" bgcolor="#fffffff">Cognome </td>
<td>
<input type="text" name="cognome" size="20" value="<?php echo $rispo['name_last']; ?>"/>
</td>

<td bgcolor="#fffffff" align="right">
Nome
</td>
<td>
<input type="text" name="nome" size="15" value="<?php echo $rispo['name_first']; ?>"/>
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
<input type="text" name="nato" size="10"  value="<?php echo $rispo['name_middle']; ?>"/>
</td>
</tr>
<tr >

<td align="right" bgcolor="#fffffff" >
Provincia di nascita
</td>
<td>
<input type="text" name="provincia" size="20"/>
</td>
<td align="right" bgcolor="#fffffff" >
Il
</td>
<td>
<input type="text" name="il" size="15" value="<?php echo $rispo['date_birth']; ?>"/>
</td>
<td align="right" bgcolor="#fffffff" >
Eta'
</td>
<td>
<input type="text" name="eta" size="10" />
</td>
</tr>
<tr>
<td align="right" bgcolor="#fffffff" >
Residente a
</td>
<td>
<input type="text" name="residente" size="20" value="<?php echo $rispo['sss_nr']; ?>"/>
</td>
<td align="right" bgcolor="#fffffff" >
Indirizzo
</td>
<td>
<input type="text" name="indirizzo" size="30" value="<?php echo $rispo['addr_str']; ?>"/>
</td>
<td align="right" bgcolor="#fffffff" >
PR
</td>
<td>
<input type="text" name="pr" size="10" value="<?php echo $rispo['citizenship']; ?>" />
</td>

<td align="right" bgcolor="#fffffff" >
Tel.
</td>
<td>
<input type="text" name="telefono" size="10" value="<?php if($rispo['cellphone_1_nr']) echo $rispo['cellphone_1_nr']; else echo $rispo['phone_1_nr'];?>"/>
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
<input type="text" name="sport" size="10" value="<?php echo $rispo['name_maiden']; ?>"/>
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
<input type="text" name="specialita" size="10" value="<?php echo $rispo['name_3']; ?>"/>
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
<input type="text" name="anni" size="8" value="<?php echo $rispo['name_others'];?>"/>
</td>
<td bgcolor="#fffffff" >
Societa' di appartenenza
</td>
<td>
<input type="text" name="societa" size="10" value="<?php echo $rispo['nat_id_nr'];?>"/>
</td>

</tr>
<tr>
<td bgcolor="#fffffff" >Motivo della consultazione</td>
<td>
<select name="consultazione">
<option>Controllo</option> 
<option>Stanchezza</option>
 </select>

</td>
</tr>


</table>
<?php
$query="SELECT * FROM care_encounter_notes WHERE aux_notes='rel_conc_short' AND encounter_nr=".$_GET['encounter_nr']." AND status='da finire'";
$answer=$db->Execute($query);
$ans=$answer->FetchRow();
$array1=split("#",$ans['notes']);
$cont=0;
while($array1[$cont])
{
$array2=split("=",$array1[$cont]);
if ($array2[0]=='rel_conc_short')
break;
$cont++;
}

?>
<table border=1>
<tr>
<td bgcolor="#fffffff" >
<br />
<b><big>RELAZIONE CONCLUSIVA</big></b>
<br /><br />
</td>
<td>
<textArea  name="rel_conc_short" rows="10" cols="80" /><?php echo $array2[1]; ?></textarea>
</td>
</tr>
</table>


<br />
<td align="center">
<input type="submit" name="salva_rel_conc_short" value="Salva" action="salva_su_db.php">
</td>
<td align="center">
<input type="submit" name="stampa_temp_rel_conc_short" value="Stampa Temporanea" action="salva_su_db.php">
</td>
<td align="center">
<input type="submit" name="stampa_rel_conc_short" value="Stampa Definitiva" onClick="javascript:seiSicuro()">
</td>
<!--
<td align="center">
<input type="submit" name="altro_foglio" value="Conclusioni in breve" action="salva_su_db.php">
</td>

<input type="hidden" name="carica" value="<?echo $devi_caricare?>" >
-->
<input type="hidden" name="encounter_nr" value="<?echo $_GET['encounter_nr']?>">
<input type="hidden" name="delta" value="<?echo $delta?>">
<!--
<input type="hidden" name="appt_nr" value="<?echo $_GET['appt_nr']?>" >
<input type="hidden" name="sess_user_name" value="<?echo $_GET['sess_user_name']?>" >
<input type="hidden" name="tipo_esame" value="<?echo $_GET['tipo_esame']?>" >
-->
<!-- ATTENZIONE, QUESTA DEVE ESSERE SEMPRE L'ULTIMO CAMPO DI INPUT!!! -->
<input type="hidden" name="item_code" value="rel_conc_short" >

</form>


