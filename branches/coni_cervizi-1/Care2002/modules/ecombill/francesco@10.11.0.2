<?php
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
$query_persona="SELECT * FROM care_billing_bill WHERE bill_encounter_nr=".$_GET['encounter_nr'];
//echo $query_persona;
$risposta_su_fatture=$db->Execute($query_persona);
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
	stringa.value=stringa.value.substr(0,stringa.value.length-risultato.lenght);
	//window.alert(stringa.value.substring(0,stringa.value.length-1));
}

//-->
</script>

<html>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 >
<? 
if($_GET['fattura']=='')
{
?>
<table width=100% border=0 height=30 cellpadding="0" cellspacing="0" >
<tr valign=top>
<td bgcolor="#99ccff" height="10" align="left">
<font  COLOR="#330066"  SIZE=+2  FACE="Arial">
<strong> &nbsp; Storno</strong></font></td>
<td bgcolor="#99ccff" height="10" align=right><a href="../../main/startframe.php?lang=it"><img src="../../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24" alt=""  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr><tr height=10></tr>
<tr valign="top" >

<td align="center">
		<b><i>Qui di seguito vengono riportate le varie fatture del paziente selezionato.<br>Cliccare su quella che si intende stornare o relativamente alla quale si deve emettere una nota di credito.</i></b>
		</td>
		</tr>
	

</table>


<!--<body>-->
<div align="center">
        <center>
    <table border="0" width="585" height="11" bordercolor="#000000">
<tr><td colspan=2><hr></td></tr>
    	<tr><td width=420><b><?php echo "Fattura numero"; ?></b></td><td><b><?php echo "Data di fatturazione"; ?></b></td></tr>
    	<tr><td colspan=2><hr></td></tr>
    	<?
    	while ($result=$risposta_su_fatture->FetchRow())
    	{
    		echo "<tr>";
    		//echo "<td>".$result['bill_bill_no']."</a></td>";    
    		echo "<td><a href=storno.php?fattura=".$result['bill_bill_no']."&encounter_nr=".$_GET['encounter_nr']."&bill_amount=".$result['bill_amount']."&insurance=".$result['insurance']."&data_fattura=".substr($result['bill_date_time'],8,2)."-".substr($result['bill_date_time'],5,2)."-".substr($result['bill_date_time'],0,4).">".$result['bill_bill_no']."</a></td>";   
    		echo "<td>".substr($result['bill_date_time'],8,2)."-".substr($result['bill_date_time'],5,2)."-".substr($result['bill_date_time'],0,4)."</td>";
    		echo "</tr>";
    	}
    	echo "<tr><td colspan=2><hr></td></tr>";
    	?>
		<tr>
<td bgcolor="#ffffff" height="10" align='center'><a href="../../main/startframe.php?lang=it"><img src="../../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24" alt=""  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
    	</table>
</div>
<?
}##QUI SI CHIUDE L'IF CHE CARICA LA LISTA DELLE FATTURE DEL PAZIENTE SELEZIONATO; UN IF POICHÈ IN QUESTO MODO NN VIENE CARICATO TALE CODICE QUANDO SI RICARICA LO STESSO SCRIPT PER VEDERE GLI ITEM DELLA FATTURA SELEZIONATA
else
{ 
	$query_item_fattura="SELECT * FROM care_billing_bill_item WHERE bill_item_bill_no=".$_GET['fattura'];
	$risposta_query_item_fattura=$db->Execute($query_item_fattura);
?>
<table width=100% border=0 height=30 cellpadding="0" cellspacing="0" >
		<tr valign=top>
<td bgcolor="#99ccff" height="10" align="left">
<font  COLOR="#330066"  SIZE=+2  FACE="Arial">
<strong> &nbsp; Storno</strong></font></td>
</tr>
</table>
<form name="stornare" method="POST" action="../../invoice/conferma_storno.php">
	<div align="center">
        <center>
    <table border="0" width="585" height="11" bordercolor="#000000">

<tr><td colspan=3><hr></td></tr>
    	<tr><td width=420><b><?php echo "Item e numero di Item"; ?></b></td><td></td><td><b><?php echo "Prezzo Item"; ?></b></td></tr>
    	<tr><td colspan=3><hr></td></tr>
    	<?
    	while ($result=$risposta_query_item_fattura->FetchRow())
    	{
    		echo "<tr>";
    		$query_item_singolo="SELECT item_description FROM prezzi_1 WHERE item_code='".$result['bill_item_code']."'";
    		#echo $query_item_singolo;
    		$risposta_query_item_singolo=$db->Execute($query_item_singolo);
    		$descrizione=$risposta_query_item_singolo->FetchRoW();
    		echo "<td>".$descrizione['item_description']."    Q.tita' ".$result['bill_item_units']."</a></td>";
			echo "<td>";
			#$i=$result['bill_item_units'];
			#$j=$i+1;
			echo "<select name='da_stornare#".$result['bill_item_id']."' >";
			$i=0;
			while($i<=$result['bill_item_units'])
			{
			
			?>
			<option name="<? echo $result['bill_item_id']; ?>" value="<? echo $i; ?>"><? echo $i;?></option> 
			<?
			$i++;
			}
			echo "</select>"; 
			echo "</td>";   
			
    		echo "<td>".$result['bill_item_unit_cost']."</td>";
    		echo "</tr>";
			echo "<tr height=5></tr>";
    	}
    	echo "<tr><td colspan=3><hr></td></tr>";
    	?>
<tr>
<td bgcolor="#ffffff" height="10" align='center'><a href="javascript:document.stornare.submit();"><img src="../../gui/img/control/default/it/it_abschic.gif" border=0 width="103" height="24" alt=""  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
<td bgcolor="#ffffff" height="10" align='center'><a href="../../main/startframe.php?lang=it"><img src="../../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24" alt=""  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
</table>

</div>
<input type="hidden" name="encounter_nr" value="<? echo $_GET['encounter_nr'];?>">
<input type="hidden" name="bill_amount" value="<? echo $_GET['bill_amount'];?>">
<input type="hidden" name="insurance" value="<? echo $_GET['insurance'];?>">
<input type="hidden" name="fattura" value="<? echo $_GET['fattura'];?>">
<input type="hidden" name="data_fattura" value="<? echo $_GET['data_fattura'];?>">
</form>
<?
}
?>	
<!--
<form method="POST" action="../../invoice/form_storno.php" >
Testo della Nota di Credito
<br>
<input type="text" name="storno1" value="A storno parziale della fattura n. ISS-M-"  size="65" readonly>
<br> <br>
Inserire Numero Fattura
<br /><font color="red">*
<input type="number" name="num_fattura" value="XXX" size="3" onKeyUp="javascript:soloNumeri(this)">
<br /><br /></font>
<input type="text" name="storno2" value="del "  size="4" readonly>
Inserire la data della fattura <font color="red"> *
<input type="text" name="data" value="XX/XX/XXXX" size="12" onKeyUp="javascript:soloNumeri(this)">
<br /><br /></font>
<input type="text" name="storno3" value="per un importo di Euro " size="30" readonly/>&nbsp;&nbsp;
Inserire l'importo totale della fattura in questione <font color="red"> *
<input type="text" name="tot_fattura" value="xxx.xx" size="6" onKeyUp="javascript:soloNumeri(this)">
<br /><br /></font>
<input type="text" name="storno4" value=", di cui Euro " size="14" readonly/>&nbsp;&nbsp;
Inserire l'importo della Nota di credito<font color="red"> *
<input type="text" name="credito" value="xxx.xx" size="6" onKeyUp="javascript:soloNumeri(this)"/>
 <br /><br />*
 <input type="text" name="storno5" value="per prestazioni sanitarie ed Euro 1.29 per marca da bollo." size="60" />
 <br /><br /></font>
<input type="submit" value="Invia" name="B1"> <input type="reset" value="Reimposta" name="B2"> 
        <input type="hidden" name="encounter_nr" value=<?php echo $_GET['encounter_nr']?>>
  	<input type="hidden" name="billno" value=<?=$billno; ?>>
	<input type="hidden" name="presdate" value=<?=$presdate ?>>
	<!-- Campi passati nel file precedente (patient_due_first.php)
   
  	<input type="hidden" name="total" value="<?php echo $total; ?>">
  	<input type="hidden" name="outstanding" value="<?php echo $outstanding; ?>">
	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
   --><!--
</form>




N.B.: Bisogna sostituire alle x i valori corretti della fattura da stornare. I campi editabili sono contrassegnati con un asterisco rosso! 

-->

