<?php
include ("../registration_admission/Mappa.php");
include ("../registration_admission/salva_su_db.php");
echo '<p align="center" >';
?><big><big><big><?php echo $mappa['CO428'][0];?></big></big></big>
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
<input type="text" name="cognome" size="20" value="<?php echo $dati['name_last']; ?>" readonly/>
</td>

<td bgcolor="#fffffff" align="right">
Nome
</td>
<td>
<input type="text" name="nome" size="15" value="<?php echo $dati['name_first']; ?>" readonly/>
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
<input type="text" name="nato" size="10"  value="<?php echo $dati['name_middle']; ?>" readonly/>
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
<?php
$compl=substr($dati['date_birth'],8,2)."-".substr($dati['date_birth'],5,2)."-".substr($dati['date_birth'],0,4);
?>
<input type="text" name="il" size="15" value="<?php echo $compl; ?>" readonly/>
</td>
<td align="right" bgcolor="#fffffff" >
Eta'
</td>
<td>
<input type="text" name="eta" size="10" value="<?php echo $eta; ?>" readonly/>
</td>
</tr>
<tr>
<td align="right" bgcolor="#fffffff" >
Residente a
</td>
<td>
<input type="text" name="residente" size="20" value="<?php echo $dati['sss_nr']; ?>" readonly/>
</td>
<td align="right" bgcolor="#fffffff" >
Indirizzo
</td>
<td>
<input type="text" name="indirizzo" size="30" value="<?php echo $dati['addr_str']; ?>" readonly/>
</td>
<td align="right" bgcolor="#fffffff" >
PR
</td>
<td>
<input type="text" name="pr" size="10" value="<?php echo $dati['citizenship']; ?>" readonly />
</td>

<td align="right" bgcolor="#fffffff" >
Tel.
</td>
<td>
<input type="text" name="telefono" size="10" value="<?php 
if($dati['phone_1_nr']) 
echo $dati['phone_1_nr']; 
else 
echo $dati['cellphone_1_nr'];?>" readonly/>
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
<input type="text" name="sport" size="10" value="<?php echo $dati['name_maiden']; ?>" readonly/>
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
<input type="text" name="specialita" size="10" value="<?php echo $dati['name_3']; ?>" readonly/>
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
<input type="text" name="anni" size="8" value="<?php echo $dati['name_others'];?>" readonly/>
</td>
<td bgcolor="#fffffff" >
Societa' di appartenenza
</td>
<td>
<input type="text" name="societa" size="10" value="<?php echo $dati['nat_id_nr'];?>" readonly/>
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
	else document.Ecocardiogramma_da_sforzo.stampa.value="";	
}
//-->
</script>
<br /><br />
<form name='Ecocardiogramma_da_sforzo' method="POST">
<b>
Motivo dell'esame:<br></b>
<input type="text" name="motivo"  value="<? echo $info['motivo']?>" size="120">
<br /><br />
<br /><br />
<table cols="8" rows="4" border="1">

<tr>

<td size="10">
</td>
<td>
<p align="center">
Carico <br>
(W)
</p>
</td>
<td>
<p align="center">
FC <br>
(bpm)
</p>
</td>
<td>
<p align="center">
PAS <br>
(mmHG)
</p>
</td>
<td>
<p align="center">
PAD <br>
(mmHg)
</p>
</td>
<td>
<p align="center">
Gradiente max <br>
(mmHg)
</p>
</td>
<td>
<p align="center">
Gradiente medio <br>
(mmHg)
</p>
</td>
<td>
<p align="center">
EF <br>
(%)
</p>
</td>

</tr>



<?php
$riga[0]="Base";
$riga[1]="Max";
$riga[2]="Rec";

$colo[0]="ca_";
$colo[1]="fc_";
$colo[2]="pas_";
$colo[3]="pad_";
$colo[4]="grad_max_";
$colo[5]="grad_med_";
$colo[6]="ef_";
for($j=0;$j<3;$j++)
{
		echo "<tr>";	
                echo"<td>";
                echo "$riga[$j]";
                echo"</td>";


			for($i=0;$i<7;$i++)
	{
		echo "<td>";
		echo "<p align='center'>";
		echo '<input type="text" size="4" value ="'.$info[rtrim($colo[$i]).$riga[$j]] .'" name="'.rtrim($colo[$i]).$riga[$j].'"onKeyUp="javascript:soloNumeri(this)">';
		echo"</p>";
		
		echo"</td>";
		

	}
echo "</tr>";
}
?>
</table>
<br /><br /><b>
Motivo dell'arresto della prova:<br></b>
<input type="text" name="arresto" size="120" value="<? echo $info['arresto']?>">
<br><br /><br /><b>
Anomalie cinetiche:<br></b>
<textarea name="anomalie" cols="102" rows="3"><? echo $info['anomalie']?></textarea>
<br><br /><br /><b>
Commento:<br></b>
<textarea name="commento" cols="102" rows="3"><? echo $info['commento']?></textarea>
<br><br /><br /><b>
Conclusioni:<br></b>
<textarea name="conclusioni" cols="102" rows="3"><? echo $info['conclusioni']?></textarea>
<br /><br />
<td align="center">
<input type="submit" name="salva" value="Salva" action="salva_su_db.php" >
</td>
<td align="center">
<input type="submit" name="stampa_temp" value="Stampa Temporanea" action="salva_su_db.php">
</td>
<td align="center">
<input type="submit" name="stampa" value="Stampa Definitiva" action="salva_su_db.php" onClick="javascript:seiSicuro(this)" >
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


