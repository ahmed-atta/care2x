<?php

include ("../registration_admission/Mappa.php");
include("../registration_admission/salva_su_db.php");

if($_POST['carica']) 
{
	
	$classe1=new gestisciDati();
	$classe1->caricaDati($_POST);
}
	echo '<p align="center" >';
	?><big><big><big><?php echo $mappa['CO422'][0];?></big></big></big>
<?php
	
	echo "</p>";
	$misura="mm";
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

function seiSicuro()
{
	risposta=window.confirm("In questo modo il referto sara' considerato terminato e non piu' modificabile, sei sicuro?");
if(risposta) document.primo.submit();
}

function superficie()
{
//window.alert("ciccio");
if(document.primo.peso_.value!='' && document.primo.altezza_.value!='')	
valore=(Math.pow(document.primo.peso_.value,0.425)*Math.pow(document.primo.altezza_.value,0.725))*71.84/10000;
else
valore='';
	//window.alert(valore);
document.primo.superficie_.value=round(valore);

}

function massavs()
{
if(document.primo.diastolico_.value!='' && document.primo.siv_anteriore_.value!='' && document.primo.par_posteriore_.value!='')	
{
valore1=Math.pow((Number(document.primo.diastolico_.value)+Number(document.primo.siv_anteriore_.value)+Number(document.primo.par_posteriore_.value)),3)-Math.pow(Number(document.primo.diastolico_.value),3);
//window.alert(valore1);
valore2=0.832*valore1/1000;
//window.alert(valore2);
valore=valore2+0.6
}
else
valore='';
	//window.alert(valore);
document.primo.massa_vs_.value=round(valore);
}


function massavssc()
{
if(document.primo.superficie_.value!='' && document.primo.massa_vs_.value!='')	
{
valore=document.primo.massa_vs_.value/document.primo.superficie_.value;
}
else
valore='';
	//window.alert(valore);
document.primo.massa_sc_.value=round(valore);
}



function accasuerre()
{
if(document.primo.siv_anteriore_.value!='' && document.primo.par_posteriore_.value!='' && document.primo.diastolico_.value!='')	
{
valore=(Number(document.primo.par_posteriore_.value)+Number(document.primo.siv_anteriore_.value))/Number(document.primo.diastolico_.value);
}
else
valore='';
	//window.alert(valore);
document.primo.hr_.value=round(valore);
}

function esua()
{


if(document.primo.emax.value!='' && document.primo.amax.value!='')	
{
//window.alert('ciao');
valore=(Number(document.primo.emax.value)/Number(document.primo.amax.value));
}
else
valore='';
	//window.alert(valore);
document.primo.e_su_a.value=round(valore);

}



function e1sua1()
{


if(document.primo.e1_TDI.value!='' && document.primo.a1_TDI.value!='')	
{
//window.alert('ciao');
valore=(Number(document.primo.e1_TDI.value)/Number(document.primo.a1_TDI.value));
}
else
valore='';
	//window.alert(valore);
document.primo.e1_su_a1_TDI.value=round(valore);

}



function aggiungi(bottone)
{
//window.alert(bottone.name);

window.open(bottone.name+".php","selezione","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

//-->
</script>

<table border=1>
<tr >
<td align="right" bgcolor="#fffffff"><b>Cognome</b> </td>
<td>
<input type="text" name="cognome" size="20"   value="<?php echo $dati['name_last']; ?>" readonly/>
</td>
<td bgcolor="#fffffff" align="right">
<b>Nome</b>
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
echo $dati['name_middle'];
}
else
{
?>
Nata a 
<?php
echo $dati['name_middle'];
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
<input type="text" name="pr" size="10" value="<?php echo $dati['citizenship']; ?>" readonly/>
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
<form name="primo" method="POST" action="../registration_admission/salva_su_db.php">

<br>
<td>
<b>Peso:</b>
<input type="text" name="peso_"  size="20" value="<?php echo $parametri['peso_'];?>" onBlur="javascript:superficie();javascript:massavssc()">
</td>
<td>
&nbsp;&nbsp;
<b>Altezza:</b>
<input type="text" name="altezza_" size="20" value="<?php echo $parametri['altezza_'];?>"  onBlur="javascript:superficie();javascript:massavssc()">
</td>

<td>
&nbsp; &nbsp;
<b>Superficie corporea:</b>
<input type="text" name="superficie_" size="20" value="<?php echo $parametri['superficie_'];?>"  readonly>
</td>
<br>
<br>
<b>Motivo dell'esame:<br></b>
<select name="motivo" title="Motivo">
<option value="Routine">Routine</option>
<option value="Controllo_cardiologico">Controllo cardiologico</option>
<?
if($parametri['motivo']) echo "<option SELECTED value=".str_replace("_"," ",$parametri['motivo']).">".str_replace("_"," ",$parametri['motivo'])." </option>";
			
			?>
</select>

<!--
<input type="text" name="motivo"  value="<?php echo $parametri['motivo'];?>" size="50">
-->
<br>
<br>
<b>Anamnesi cardiologica <br /></b>
<textarea name="anamnesi_cardiologica" cols="100" rows="3"><? if ($parametri['anamnesi_cardiologica'])
echo $parametri['anamnesi_cardiologica'];
else
{
$query2="SELECT  nr FROM care_appointment WHERE pid=".$_GET['pid']." AND purpose LIKE '%Visita_specialistica_cardiologica%' ORDER BY nr DESC LIMIT 1 ";

$ans2=$db->Execute($query2);
	if ($answer2=$ans2->FetchRow())
	{
	$query3="SELECT notes FROM care_encounter_notes WHERE ref_notes_nr=".(2*$answer2['nr']);
	$ans3=$db->Execute($query3);
	$answer3=$ans3->FetchRow();
	$array=split("#",$answer3['notes']);
	$array2=split("=",$array[0]);
	$array3=split("=",$array[1]);
	$dire=$array2[1].". ".$array3[1];
	}
#echo $dire."#ciao <br>";
if($dire!='. ')
echo $dire;
else
{
$dire='';
echo $dire;
}
}
?></textarea>
<a  name="anamnesi"   onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
<br />
<br />
<table cols="7" rows="6" border="1">

<tr>
<td>
<p align="center">
<b>SIV anteriore</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="siv_anteriore_" size="7" onKeyUp="javascript:soloNumeri(this)" onBlur="javascript:massavs();javascript:massavssc();javascript:accasuerre()" value="<?php echo $parametri['siv_anteriore_'];?>" >
</p>
</td>
<td>
<p align="center">
<b><?echo "$misura";?></b>
</p>
</td>
<td>
</td>
<td>
<p align="center">
<b>SIV Posteriore</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="siv_posteriore" value="<?php echo $parametri['siv_posteriore'];?>" onKeyUp="soloNumeri(this)" size="7">
</p>
</td>
<td>
<p align="center">
<b><? echo "$misura" ?></b>
</p>
</td>
</tr>
<!-- fine prima riga -->

<tr>
<td>
<p align="center">
<b>Parete posteriore</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="par_posteriore_" value="<?php echo $parametri['par_posteriore_'];?>" size="7" onKeyUp="javascript:soloNumeri(this)" onBlur="javascript:massavs();javascript:massavssc();javascript:accasuerre()">
</p>
</td>
<td>
<p align="center">
<b><?echo "$misura";?></b>
</p>
</td>
<td>
</td>
<td>
<p align="center">
<b>Parete laterale</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="par_laterale" value="<?php echo $parametri['par_laterale'];?>" size="7" onKeyUp="soloNumeri(this)">
</p>
</td>
<td>
<p align="center">
<b><? echo "$misura" ?></b>
</p>
</td>
</tr>

<!-- fine seconda riga -->

<tr>
<td>
<p align="center">
<b>Diametro V.S. diastolico</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="diastolico_" value="<?php echo $parametri['diastolico_'];?>" size="7" onBlur="javascript:massavs();javascript:massavssc();javascript:accasuerre()">
</p>
</td>
<td>
<p align="center">
<b><?echo "$misura";?></b>
</p>
</td>
<td>
</td>
<td>
<p align="center">
<b>Diametro V.S. sistolico</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="sistolico" value="<?php echo $parametri['sistolico'];?>" size="7">
</p>
</td>
<td>
<p align="center">
<b><? echo "$misura" ?></b>
</p>
</td>
</tr>
<!-- fine terza riga -->
<tr>
<td>
<p align="center">
<b>Aorta</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="aorta" value="<?php echo $parametri['aorta'];?>" size="7">
</p>
</td>
<td>
<p align="center">
<b><?echo "$misura";?></b>
</p>
</td>
<td>
</td>
<td>
<p align="center">
<b>Atrio sinistro</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="atrio" value="<?php echo $parametri['atrio'];?>" size="7">
</p>
</td>
<td>
<p align="center">
<b><? echo "$misura" ?></b>
</p>
</td>
</tr>
<!--fine quarta riga-->

<tr>
<td>
<p align="center">
<b>Massa V.S.</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="massa_vs_" value="<?php echo $parametri['massa_vs_'];?>" size="7" readonly>
</p>
</td>
<td>
<p align="center">
<b><?echo "gr";?></b>
</p>
</td>
<td>
</td>
<td>
<p align="center">
<b>Massa V.S./S.C.</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="massa_sc_" value="<?php echo $parametri['massa_sc_'];?>" size="7" onBlur="javascript:massavssc()" readonly>
</p>
</td>
<td>
<p align="center">
<b>gr/m<sup> 2 </sup> </b>
</p>
</td>
</tr>
<!-- fine quinta riga -->
<tr>
<td>
<p align="center">
<b>EF(%)</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="ef" value="<?php echo $parametri['ef'];?>" size="7">
</p>
</td>
<td>
<p align="center">
<?echo "";?>
</p>
</td>
<td>
</td>
<td>
<p align="center">
<b>h/r</b>
</p>
</td>
<td>
<p align="center">
<input type="text" name="hr_" value="<?php echo $parametri['hr_'];?>" size="7" readonly>
</p>
</td>
<td>
<p align="center">
<? echo "" ?>
</p>
</td>
</tr>
<!-- fine sesta riga -->


</table>
<br>
<table cols="3" border="3">
<tr>
<td>
<b>VENTRICOLO SINISTRO</b>
</td>
<td>
</td>
<td>
<b>VENTRICOLO DESTRO</b>
</td>
</tr>
<tr>
<td>
<b>Morfologia</b>
</td>
<td>
</td>
<td>
<b>Morfologia</b>
</td>
<tr>
<td>
<textarea name="morfologia_sx"  cols="50" rows="5"><?php echo $parametri['morfologia_sx'];?></textarea>
</td>
<td>
<a  name="morfologia_sx"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
</td>

<td>
<textarea name="morfologia_dx"  cols="50" rows="5"><?php echo $parametri['morfologia_dx'];?></textarea>
</td>
<td>
<a  name="morfologia_dx"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
</td>
</tr>
<tr>
<td>
<b>Cinesi:</b>
</td>
<td>
</td>
<td>
<b>Cinesi:</b>
</td>
<tr>
<td>
<textarea name="cinesi_sn" cols="50" rows="5"><?php echo $parametri['cinesi_sn'];?></textarea>
</td>
<td>
<a  name="cinesi_sn"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
</td>
<td>
<textarea name="cinesi_dx" cols="50" rows="5"><?php echo $parametri['cinesi_dx'];?></textarea>
</td>
<td>
<a  name="cinesi_dx"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
</td>
</tr>
</table>
<p>&nbsp;</p>
<table cols="3" border="3">
<tr>
<td height="96"><b>Apparati valvolari </b><br />
  <textarea name="apparati" cols="50"  rows="5"><?php echo $parametri['apparati'];?></textarea><a  name="apparati"  onclick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a></td>
<td>
<b> Osti Coronarici </b><br /><textarea name="osti" cols="50" rows="5"><?php echo $parametri['osti'];?></textarea><a  name="osti"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
</td>
</tr>
<tr>
<td><b>Arco Aortico</b><br /><textarea name="arco" cols="50" rows="5"><?php echo $parametri['arco'];?></textarea><a  name="arco"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
</td>
<!-- *** Ho inserito questa cella per aggiungere il campo Arteria Polmonare (Giuseppe - 15/9/2004) *** --> 
<td>
<b> Arteria Polmonare </b><br />
<textarea name="arte_polmonare" cols="50" rows="5"><?php echo $parametri['arte_polmonare'];?></textarea>
<a  name="arte_polmonare"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a> </td>
</tr>

</table>
<table border="0" cellpadding="20">


<td>
<b>Polmonare</b>
	<table border="1">
		<tr>
			<td>
			<b>Gradiente Max</b>
			<td>
			<input type="text" name="grad_polmonare"  size="7" value="<?php echo $parametri['grad_polmonare'];?>"/>
			</td>
			<td>
			<b>mmHg</b>
			<td>
		</tr>
		<tr>
			<td>
			<b>Reflusso</b>
			<td>
			<input type="text" name="reflusso_polmonare"  size="7" value="<?php echo $parametri['reflusso_polmonare'];?>"/>
			</td>
		</tr>
	</table>
</td>

<td>
	<b>Tricuspide</b>
	<table border="1">
		<tr>
			<td>
			<b>Gradiente Max</b>
			</td>
			<td>
			<input type="text" name="gradmax_tricuspide"  size="7" value="<?php echo $parametri['gradmax_tricuspide'];?>" onBlur="javascript:document.primo.pres_tricuspide.value=Number(document.primo.gradmax_tricuspide.value)+5"/>
			</td>
			<td>
			<b>mmHg</b>
			</td>
		</tr>	
		<tr>
			<td>
			<b>Pressione stimata <br />nell'arteria polmonare</b>
			</td>
			<td>
			<input type="text" name="pres_tricuspide"  size="7" value="<?php echo $parametri['pres_tricuspide'];?>"  readonly/>
			</td>
			<td>
			<b>mmHg</b>
			</td>
		</tr>	
		<tr>
			<td>
			<b>Reflusso</b>
			</td>
			<td>
			<input type="text" name="refl_tricuspide"  size="7" value="<?php echo $parametri['refl_tricuspide'];?>"/>
			</td>
		</tr>	
	</table>
</td>

<td>
	<b>Aorta</b>
	<table border="1">
		<tr>
			<td>
			<b>V Max</b>
			</td>
			<td>
			<input type="text" name="vmax_aorta"  size="7" value="<?php echo $parametri['vmax_aorta']?>"/>
			</td>
			<td>
			<b>cm/s</b>
			</td>
		</tr>	
		<tr>
			<td>
			<b>AVA</b>
			</td>
			<td>
			<input type="text" name="ava_aorta"  size="7" value="<?php echo $parametri['ava_aorta'];?>"/>
			</td>
			<td>
			<b>cm<sup>2</sup></b>
			</td>
		</tr>	
		<tr>
			<td>
			<b>Gradiente Max</b>
			</td>
			<td>
			<input type="text" name="grad_aorta_max"  size="7" value="<?php echo $parametri['grad_aorta_max'];?>"/>
			</td>
			<td>
			<b>mmHg</b>
			</td>
		</tr>	
		<!-- *** Questa ultima riga l'ho inserita per aggiungere il campo Gradiente medio (Giuseppe - 15/9/2004) *** --> 
		<tr> 
			<td>
			<b>Gradiente Medio</b>
			</td>
			<td>
			<input type="text" name="grad_aorta_med"  size="7" value="<?php echo $parametri['grad_aorta_med']?>"/>
			</td>
			<td>
			<b>mmHg</b>
			</td>
		</tr>	
		<tr>
			<td>
			<b>Reflusso</b>
			</td>
			<td>
			<input type="text" name="refl_aorta"  size="7" value="<?php echo $parametri['refl_aorta'];?>"/>
			</td>
		</tr>	 
	</table>
</td>
</table>
<!--cazzo-->
<table border="0" cellpadding="20">


<td>
<b>Mitrale</b>
	<table columns="7" border="1">

<td>
<b>E max</b>
</td>
<td>
<input type="text" name="emax" size="7" value="<?php echo $parametri['emax'];?>" onBlur="javascript:esua()"/>
</td>
<td>
<b>cm/s</b>
</td>
<td>
</td>
<td>
<b>AVM</b>
</td>
<td>
<input type="text" name="avm" size="7" value="<?php echo $parametri['avm'];?>"/>
</td>
<td>
<b>cm <sup>2</sup></b>
</td>

</tr>

<tr>
<td>
<b>A max</b>
</td>
<td>
<input type="text" name="amax" size="7" value="<?php echo $parametri['amax'];?>" onBlur="javascript:esua()"/>
</td>
<td>
<b>cm/s</b>
</td>
<td>
</td>
<td>
<b>Reflusso</b>
</td>
<td>
<input type="text" name="refl_mitrale" size="7" value="<?php echo $parametri['refl_mitrale'];?>"/>
</td>
<td>
</td>
</tr>

<tr>
<td>
<b>E/A</b>
</td>
<td>
<input type="text" name="e_su_a" size="7" value="<?php echo $parametri['e_su_a'];?>" onBlur="javascript:esua()" readonly/>
</td>

<td>
</td>
<td>
</td>
<td>
<b>Gradiente max</b>
</td>
<td>
<input type="text" name="gradmax_mitrale" size="7" value="<?php echo $parametri['gradmax_mitrale'];?>"/>
</td>
<td>
<b>mmHg</b>
</td>
</tr>

<tr>
<td>
<b>EF slope</b>
</td>
<td>
<input type="text" name="efslope" size="7" value="<?php echo $parametri['efslope'];?>"/>
</td>
<td>
<b>cm/s <sup>2</sup></b>
</td>
<td>
</td>
<td>
<b>Gradiente medio</b>
</td>
<td>
<input type="text" name="gradmed_mitrale" size="7" value="<?php echo $parametri['gradmed_mitrale'];?>"/>
</td>
<td>
<b>mmHg</b>
</td>
<td>
</td>
</tr>

</table>
</td>

<td>
	<b>TDI</b>
	<table border="1">
		<tr>
			<td>
			<b>E1 max</b>
			</td>
			<td>
			<input type="text" name="e1_TDI"  size="7" value="<?php echo $parametri['e1_TDI'];?>" onBlur="javascript:e1sua1()"/>
			</td>
			<td><b>
			cm/s</b></td>
			<td>
			<b>A1 max</b>
			</td>
			<td>
			<input type="text" name="a1_TDI"  size="7" value="<?php echo $parametri['a1_TDI'];?>" onBlur="javascript:e1sua1()"/>
			</td>
			<td><b>
			cm/s</b></td>
		</tr>	
		<tr>
			<td>
			<b>E1/A1</b>
			</td>
			<td>
			<input type="text" name="e1_su_a1_TDI"  size="7" value="<?php echo $parametri['e1_su_a1_TDI'];?>" onBlur="javascript:e1sua1()" readonly/>
			</td>
		    <td>
           </td>
			<td>
			<b>S1 max</b>
			</td>
			<!-- *** Questa ultima cella l'ho inserita per aggiungere il campo S1 (Giuseppe - 15/9/2004)*** -->
			<td>
			<input type="text" name="s1_TDI"  size="7" value="<?php echo $parametri['s1_TDI'];?>" />
			</td>
			<td><b>
			cm/s</b></td>
			<td>
		</tr>	
		
	   
	</table>
</td>


<br /> <br />

<td>

<table>
</table>
</td>
</table>

<br />
<b>Commento <br /></b>
<textarea name="commenti" cols="100" rows="2"><? echo $parametri['commenti'];?></textarea>
<a  name="commenti"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
<br /> <br />
<b>CONCLUSIONI <br /></b>
<textarea name="conclusioni" cols="100" rows="2"><? echo $parametri['conclusioni'];?></textarea>
<!--<input type="button" name="prova" value="PROVA" onClick="javascript:aggiungi(this)" />-->
<a  name="conclusioni"  onClick="javascript:aggiungi(this)"  width="22" height="15"><img  src="../../gui/img/common/default/b-write_addr.gif" border=0/></a>
<br />
<br />
<td align="center">
<input type="submit" name="salva" value="Salva"  >
</td>
<td align="center">
<input type="submit" name="stampa_temp" value="Stampa Temporanea" >
</td>
<td align="center">
<input type="submit" name="stampa" value="Stampa Definitiva"  onClick="javascript:seiSicuro(this)" >
</td>
<input type="hidden" name="carica" value="<?echo $devi_caricare ?>" >
<input type="hidden" value="<?php echo $_GET['encounter_nr']; ?>" name="encounter_nr">
<input type="hidden" name="appt_nr" value="<?php echo $_GET['appt_nr']; ?>">
<input type="hidden" name="item_code" value="<?php echo $_GET['codice']; ?>">
<br />




</form>
