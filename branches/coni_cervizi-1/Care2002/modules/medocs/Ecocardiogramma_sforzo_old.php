<?php
include ("Mappa.php");
include ("salva_su_db.php");
echo '<p align="center" >';
echo $mappa['CO428'][0];
echo "</p>";
$devi_caricare=false;
if($_GET['carica']==true)
{ 
	$carica=new GestisciDati();
	$info=$carica->caricaDati($_GET);
	//echo $info['motivo'];
	$devi_caricare=true;
}
?>

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
function seiSicuro(pulsante)
{
if(pulsante.value=="Stampa") risposta=window.confirm("In questo modo il referto sara' considerato terminato e non piu' modificabile, sei sicuro?");
	if(risposta)
{ 

}
	else document.Ecocardiogramma_da_sforzo.stampa.value="";	
}
//-->
</script>

<form name='Ecocardiogramma_da_sforzo' method="POST">

Motivo dell'esame:<br>
<input type="text" name="motivo" value="<? echo $info['motivo']?>" size="20">
<br>
<br>

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
<br>
Motivo dell'arresto della prova:<br>
<input type="text" name="arresto" value="<? echo $info['arresto']?>">
<br>
Anomalie cinetiche:<br>
<input type="text" name="anomalie" value="<? echo $info['anomalie']?>">
<br>
Commento:<br>
<textarea name="commento" cols="50" rows="5"><? echo $info['commento']?></textarea>
<br>
Conclusioni:<br>
<textarea name="conclusioni" cols="50" rows="5"><? echo $info['conclusioni']?></textarea>
<br /><br />
<td align="center">
<input type="submit" name="salva" value="Salva" onClick="javascript:seiSicuro(this)" >
</td>
<td align="center">
<input type="submit" name="stampa" value="Stampa" onClick="javascript:seiSicuro(this)" >
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
