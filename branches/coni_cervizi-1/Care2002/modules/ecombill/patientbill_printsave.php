<?php
/*
while (list($a,$b)=each($_GET))
{
echo "GG".$a."GG".$b."<br />";
}
while (list($a,$b)=each($_POST))
{
echo "##".$a."@@".$b."<br />";
}
exit;
*/
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* 
* 
* 
* 
* 
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');


?>


<script language="javascript">
<!--
function parti()
{
document.getElementById('livello').style.visibility='hidden';
}
function controlla()
{
a=(document.dati.rag_soc.value!="") && (document.dati.indirizzo.value!="") && (document.dati.cap.value!="") && (document.dati.comune.value!="") && ((document.dati.cod_fis.value!="") || (document.dati.piva.value!="") );
b=(document.dati.rag_soc.value!="") || (document.dati.indirizzo.value!="") || (document.dati.cap.value!="") || (document.dati.comune.value!="") || ((document.dati.cod_fis.value!="") || (document.dati.piva.value!="") );
c=((document.dati.cod_fis.value!="") && (document.dati.piva.value!=""));
if(!c)
{
if(a) 
{
	risposta=window.confirm("I dati non saranno piu' modificabili, si e' sicuri di continuare?");
	if (risposta) document.dati.submit();
}
else if(b) window.alert("Il modulo per intestare la fattura alla societa' non e' stato compilato correttamente, controllare!");
else
{
	risposta=window.confirm("I dati non saranno piu' modificabili, si ? sicuri di continuare?");
	if (risposta) document.dati.submit();
}
}
if (c)
window.alert("Si sono inseriti sia una Codice Fiscale sia una Partita IVA. Deve essere presente solo uno dei due!!");
}

function inserimento() {
ins=window.prompt('Inserisci dati','');
if(ins==null)
document.dati.note.value='Note: Codice di presa in carico xxxxx.La persona assicurata non paga franchigia.';
else
document.dati.note.value='Note: Codice di presa in carico '+ins+'.La persona assicurata non paga franchigia.';
}

function inserimento1() {

ins1=window.prompt('TOP CARD','');
if(ins1==null)
document.dati.tip_pag.value='Pagamento con bonifico bancario su C/C 9000 BNL Ag. 6309 ABI 01005 CAB 03309. Nella causale indicare per intero il numero della fattura.';
else
{
document.dati.tip_pag.value='Pagamento con topcard '+ins1;
document.dati.note.value="";
}
}

function inserimento2() {

ins2=window.prompt('ASSEGNO BANCARIO','');
if(ins2==null)
document.dati.tip_pag.value='Pagamento con bonifico bancario su C/C 9000 BNL Ag. 6309 ABI 01005 CAB 03309. Nella causale indicare per intero il numero della fattura.';
else
{
document.dati.tip_pag.value='Pagamento con assegno bancario '+ins2;
document.dati.note.value="";
}
}


function inserimento3() {

ins3=window.prompt('ASSEGNO CIRCOLARE','');
if(ins3==null)
document.dati.tip_pag.value='Pagamento con bonifico bancario su C/C 9000 BNL Ag. 6309 ABI 01005 CAB 03309. Nella causale indicare per intero il numero della fattura.';
else
{
document.dati.tip_pag.value='Pagamento con assegno circolare '+ins3;
document.dati.note.value="";
}
}

function inserimento4() {

ins4=window.prompt('BANCOMAT','');
if(ins4==null)
document.dati.tip_pag.value='Pagamento con bonifico bancario su C/C 9000 BNL Ag. 6309 ABI 01005 CAB 03309. Nella causale indicare per intero il numero della fattura.';
else
{
document.dati.tip_pag.value='Pagamento con bancomat '+ins4;
document.dati.note.value="";
}
}
//-->
</script>
<?
$core= new Core;

	ob_start();
	
	$presdate=date("Y-m-d");

$valore=0;
$assicurazione= $_POST['insurance'];
while (!$valore)
{	


	$billquery="INSERT INTO care_billing_bill (bill_bill_no, bill_encounter_nr, bill_date_time, bill_amount, bill_outstanding, insurance) VALUES ($billno,$patientno,'$presdate',$total,$outstanding, $assicurazione)";
	
		
	$valore=$core->Transact($billquery);
	if (!$valore) $billno++;
//echo "valore=$valore";
}
    
       $savebillquery="UPDATE care_billing_bill_item SET bill_item_status='1',bill_item_bill_no='$billno' where bill_item_encounter_nr='$patientno' and bill_item_status='0'";
	//$savebillresult=mysql_query($savebillquery);
       $core->Transact($savebillquery);
  



/*CODICE ORIGINALE
	$savebillquery="UPDATE care_billing_bill_item SET bill_item_status='1',bill_item_bill_no='$billno' where bill_item_encounter_nr='$patientno' and bill_item_status='0'";
	//$savebillresult=mysql_query($savebillquery);
	$core->Transact($savebillquery);
	
		

	
	$billquery="INSERT INTO care_billing_bill (bill_bill_no, bill_encounter_nr, bill_date_time, bill_amount, bill_outstanding) VALUES ($billno,$patientno,'$presdate',$total,$outstanding)";
	
		
	$core->Transact($billquery);
*/
//CODICE ORIGINALE
	//$resultbillquery=mysql_query($billquery);	
	//$core->Transact($resultbillquery);
	
	//echo $resultbillquery;
	
	/*$redir="patientbill.php?patnum=".$pno;
	header("Location:".$redir);
	exit;*/

	//disconnect_db();

	//$patmenu="patient_bill_links.php".URL_REDIRECT_APPEND."&patientno=$patientno&full_en=$full_en"; commentato da noi
	//echo("<META http-equiv='refresh' content='0;url=$patmenu'>");
//header('Location:'.$patmenu); commentato da noi
//exit; commentato da noi


?>

<html>

<head>
<title> Fatturazione </title>

</head>

<body onLoad="javascript:parti()">
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong>Inserimento dati</strong></font></td>
      </tr>
    </table>
<form method="POST" action="../../invoice/fattura.php" name="dati" >
  <p>  
  <p>  
  <p><b>Inserisci note</b>
    <br>
    <input type="text" name="note" value="Note: Codice di presa in carico xxxxx. La persona assicurata non paga franchigia." size="65" readonly="">
	<input type="button" name="bottone_inserimento" value="Inserimento codice presa incarico" onClick="javascript:inserimento()">
	<br>
	<br>
	<b>N.B.</b>Il campo si annuller&agrave automaticamente se il pagamento verr&agrave effettuato tramite TopCad o Assegno. 
    <br>
    <br>
<b>Modalita' di pagamento</b>
<br>
<input type="text" name="tip_pag" value="Pagamento con bonifico bancario su C/C 9000 BNL Ag. 6309 ABI 01005 CAB 03309. Nella causale indicare per intero il numero della fattura." size="65" readonly="true">
<input type="button" name="topcard" value="Topcard" onclick="javascript:inserimento1()">

<input type="button" name="bancomat" value="Bancomat" onclick="javascript:inserimento4()">

<input type="button" name="bancario" value="Assegno Bancario" onclick="javascript:inserimento2()">

<input type="button" name="circolare" value="Assegno Circolare" onclick="javascript:inserimento3()">

<br> 
<br>
<input type="button" value="Invia" name="B1" onClick="javascript:controlla()"> 
<input type="reset" value="Reimposta" name="B2"> 
        <input type="hidden" name="patientno" value=<?=$patientno ?>>
      <input type="hidden" name="billno" value=<?=$billno; ?>>
      <input type="hidden" name="presdate" value=<?=$presdate ?>>
      <!-- Campi passati nel file precedente (patient_due_first.php)
   
  	<input type="hidden" name="total" value="<?php echo $total; ?>">
  	<input type="hidden" name="outstanding" value="<?php echo $outstanding; ?>">
	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
   -->
     <!--AGGIUNTI DOPO 28/07/2004-->
     <input type="hidden" name="total" value="<?php echo $_POST['total']; ?>">
      <input type="hidden" name="outstanding" value="<?php echo $_POST['outstanding']; ?>">
     <br />
     <br />
   <font size="+1"><b>N.B.:</b></font> <br><i>qualora il pagamento sia effettuato tramite assicurazione,e' sufficiente indicare nel campo note il corretto codice di presa in carico (al posto delle x).</i>
   <br />
  <p><br />
   <p>&nbsp;&nbsp;</p>
   <p><b>Modulo da riempire solo nel caso in cui si volesse intestare la fattura ad una societa':</b>&nbsp;
     <input type="radio" name="prova" value="Nascondi il livello" onclick="document.getElementById('livello').style.visibility='hidden'" CHECKED>
	&nbsp;no
	 <input type="radio" name="prova" value="Visualizza il livello" onclick="document.getElementById('livello').style.visibility='visible'" >
     &nbsp;yes
	
	
  </p>
   <br> 
   
   <table width="427" border="2" >
  		<tr border="3">
		<tr>
 			<td>
				Ragione sociale
  			</td>
  			<td align="center">
  				<input type="text" name="rag_soc" size="40" />
  			</td>
	   </tr>
	   
  		<tr>
  			<td>
  				Indirizzo
  			</td>
  			<td align="center">
  				<input type="text" name="indirizzo" size="40" />
  			</td>
 	   </tr>
	   <tr>
  			<td>
  				Numero Civico
  			</td>
  			<td align="center">
  				<input type="text" name="civico" size="5" />
  			</td>
 	   </tr>
  		<tr>
  			<td>
  				Cap
 			</td>
            <td align="center">
              <input type="text" name="cap" size="40" />
</td>
  		</tr>
  		<tr>
  			<td>
  				Comune
  			</td>
  			<td align="center">
  				<input type="text" name="comune" size="40" />
  			</td>
  		</tr>
  		<tr>
  			<td>
  				Codice Fiscale
  			</td>
 			 <td align="center">
  				<input type="text"  name="cod_fis" size="40" />
 			 </td>
 		</tr>
   		<tr>
  			<td>
  				Partita I.V.A.
 			</td>
  			<td align="center">
  				<input type="text" name="piva" size="40" />
  			</td>
  		</tr>
  </table>
</div>
</form>

</body>

</html>
