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

define('LANG_FILE','nuove_prestazioni.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');

//require("ecombill_pass.php");

?>
<script language="javascript">
<!--
function controlla()
{
	
	ris=(document.dati.codice.value=="") || (document.dati.descrizione.value=="")||(document.dati.privato.value=="") || (document.dati.unisalute.value=="")||(document.dati.coni.value=="") || (document.dati.legge.value=="")||(document.dati.inter.value=="") || (document.dati.po.value=="");
	if (ris) window.alert("Attenzione, non tutti i campi sono stati riempiti");
	else 
	{
		risposta=window.confirm("In questo modo l'elemento sara' inserito nel db, si vuole continuare?");
		if(risposta) document.dati.submit();
	}
}
function isNumerico(stringa)
{
var pattern=new RegExp("[a-zA-Z]|,");
var risultato;
var temp;
	temp=stringa.value;
	risultato=stringa.value.match(pattern);
	if(risultato.length>0) window.alert("Attenzione, e' consentito inserire solamente numeri! Per i decimali e' necessario utilizzare il punto");
	stringa.value=stringa.value.substr(0,stringa.value.length-1);
	//window.alert(stringa.value.substring(0,stringa.value.length-1));

}

//-->
</script>
<form name="dati" method="Post" action="salva_prestazioni.php">
<p align="center"><B >INSERISCI LA PRESTAZIONE CON I VARI PREZZI RELATIVI ALLE ASSICURAZIONI</B></p>
<br /><br />
<table border=1 align="center">
<tr>
<td bgcolor="#ffffdd">
Codice
</td>
<td bgcolor="#ffffdd">
Descrizione prestazione
</td>
<td bgcolor="#ffffdd">
Interno/esterno
</td>
<td bgcolor="#ffffdd">
Tipo esame
</td>
</tr>
<tr>
<td align="center" >
<input type="text" name="codice" size="6" maxlength="6"/>
</td>
<td align="center" >
<input type="text" name="descrizione" size=68 />
</td>
<td>
<select name="chi">
<option value="1" selected>Esame interno</option>
<option value="0">Esame esterno</option>
</select>
</td>
<td>
<select name="tipo">
<option value="LT">Analisi Chimico Clinica</option>
<option value="HS">Prestazione sanitaria</option>
</select>
</td>
</tr>
</table>
<table border=1 align="center">
<tr>
<td bgcolor="#ffffdd">
Prezzo Privato
</td>
<td bgcolor="#ffffdd">
Prezzo Unisalute / CASAGIT
</td>
<td bgcolor="#ffffdd">
Prezzo Unisalute Coni
</td>
<td bgcolor="#ffffdd">
Prezzo legge 626/94
</td>
<td bgcolor="#ffffdd">
Prezzo Interesse nazionale
</td>
<td bgcolor="#ffffdd">
Prezzo Probabile Olimpico
</td>

</tr>
<tr>

<td align="center" >
<input type="text" name="privato" size=5 onKeyUp="javascript:isNumerico(this)"/>
</td>
<td align="center" >
<input type="text" name="unisalute" size=5 onKeyUp="javascript:isNumerico(this)"/>
</td>
<td align="center" >
<input type="text" name="coni" size=5 onKeyUp="javascript:isNumerico(this)"/>
</td>
<td align="center" >
<input type="text" name="legge" size=5 onKeyUp="javascript:isNumerico(this)"/>
</td>
<td align="center" >
<input type="text" name="inter" size=5 onKeyUp="javascript:isNumerico(this)"/>
</td>
<td align="center" >
<input type="text" name="po" size=5 onKeyUp="javascript:isNumerico(this)"/>
</td>
</tr>



</table>
<br />
<p align="center">
<input type="button" name="invia" value="Registra" onClick="javascript:controlla()"/>
<input type="reset" name="reset" value="Reset" />
</p>

</form>
