<?php
require ('Mappa.php');
include("salva_su_db.php");
?>
<script  language="javascript">
<!-- 
function Apri(path) {
//document.form.Medicina_Generale.target="_blank";
document.form.Medicina_Generale.action=path;

document.form.submit();

}

//funzione per controllare il titolo referto
function controlla_dati()
{
//window.alert('pippo');
	if (document.ref_radio.titoloreferto.value=='') {
		window.alert('Inserire il nome del referto');
		document.ref_radio.titoloreferto.focus();
		return false;
	}
	return true;
}


function seiSicuro()
{
	
	//controllo prima i dati
	if (!controlla_dati()) {
		document.Medicina_Generale.stampa.value="";
		return;
	}
	
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
<?php
$tipo_esame=$_GET['codice'];
#echo "#".$tipo_esame."#<br>";
$carica=$_GET['carica'];
if($carica==true) 
{
	
	$classe1=new gestisciDati();
	$dati=$classe1->caricaDati($_GET);
}
else $carica=false;
if ($_POST['save']!='Salva')
{


?>

<html>
<body>

<form name="ref_radio" method="POST" action="salva_su_db.php" onsubmit="return controlla_dati();">
<p align="center">
<!--<FONT SIZE=20  FACE="Arial" >C.O.N.I.</FONT>-->
<img src="../../gui/img/logos/lopo/default/logo_coni.jpg" />
<br />
<FONT SIZE=5  FACE="Arial" >Istituto di Scienza dello Sport</FONT>
<br /><br /><br /><br />
<FONT SIZE=5  FACE="Arial" ><?php echo $mappa[$tipo_esame][0]?>
<?php if ($mappa[$tipo_esame][4]==8) {?><input font type="text" name="titoloreferto" value="<?php echo $dati['titoloreferto'];?>" /> </FONT></p> <?}?>
<p align="center">

<!--<br><?php print_r($dati); ?> <br> -->

<br />
<br />
<br />
<br />

<FONT SIZE=5  FACE="Arial" >REFERTO</FONT>

<br />
<br />
<textArea name="conclusioni" rows="10" cols="80"><? echo $dati['conclusioni'];?></textarea>
<br />
<br />
<input type="submit" name="salva" value="Salva" onsubmit="return controlla_dati();" />
<input type="submit" name="stampa_temp" value="Stampa Temporanea" onsubmit="return controlla_dati();" />
<input type="submit" name="stampa" value="Stampa Definitiva" onClick="javascript:SeiSicuro()"/>
</p>
<input type="hidden" name="carica" value="<?echo $carica?>">
<input type="hidden" name="encounter_nr" value="<?echo $_GET['encounter_nr']?>">
<input type="hidden" name="appt_nr" value="<?echo $_GET['appt_nr']?>" >
<input type="hidden" name="sess_user_name" value="<?echo $_GET['sess_user_name']?>" >
<input type="hidden" name="tipo_esame" value="<?echo $tipo_esame?>" >
<input type="hidden" name="item_code" value="<?echo $_GET['codice']?>" >

</form>

</body>

</html>
<?php
}

	


?>
