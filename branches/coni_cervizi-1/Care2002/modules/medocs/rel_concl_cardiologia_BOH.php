
<?php




// Questo file consente di visualizzare i pazienti che hanno effettuato un'altra visita oltre 
// a quella specialistica di cardiologia, nello stesso giorno. Premendo sul pulsante No, ? aggiornato
// il campo to_dept_id='no' della visita specialistica cardiologica.
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require("../registration_admission/Mappa.php");
?>
<script language="javascript">
<!--
function seiSicuro(name)
{
  risposta=window.confirm("Sei sicuro?");
  if(risposta) ;
  else
  {
	name.value="";
  }
}
//-->
</script>
<?
/* Il no è stato tolto perchè dalla riunione del 18/10/2004 è stato detto che per tutti si devono fare le relazioni conclusive
if($_POST['no']=="No")
{
	$sql_update="update care_appointment set to_dept_id='no' where nr=".$_POST['nr'];
	$db->Execute($sql_update);
#echo $sql_update;
}
else */if($_POST['si']=="Si") 
{

?>
<script language="javascript">
<!--
window.open("../medocs/rel_concl_cardiologia_form.php?nr=<?php echo $_POST['nr'];?>&delta=<?php echo $_POST['delta'];?>&encounter_nr=<?php echo $_POST['encounter_nr'];?>&appt_nr=<?php echo $_POST['appt'];?>");
//-->
</script>
<?
}


?>

<P align="center" ><b><big><big>RELAZIONI CONCLUSIVE PER CARDIOLOGIA</big></big></b></P>


<?


$sql="select * from care_appointment  where (appt_status='Fatto' OR appt_status='In attesa di referto')and (purpose like '%CO419%' OR purpose like '%CO420%')  and date>='2004-09-01' and to_dept_nr=5 and to_dept_id  !='no'";
###TO DO: recuperare lo stato della CO419 o CO420 che scatena tutto il fatto
$risultato=$db->Execute($sql);
//echo "<br />";

while($ris=$risultato->FetchRow())
{
$stato_visita_spec_cardio=$ris['appt_status'];
$ecg_base=0;

$conto_occhio=0;
if (strpos($ris['purpose'],"CO420"))
{
$ecg_base=1;##questa serve per capire che è una visita cardiologica + ecg da sforzo
$stato_ecg_base=$ris['appt_status'];
}

$sql_occhio="select * from care_appointment where pid=".$ris['pid']." and appt_status='pending'  and date='".$ris['date']."' and purpose not like '%CO419%' and purpose not like '%CO420%'";

//echo $sql_occhio;

$risultato_occhio=$db->Execute($sql_occhio);
if($risultato_occhio->recordCount()>0) 
	{
		while($ris_occhio=$risultato_occhio->fetchrow())
		{//echo "<b>while</b>";
			$esame_occhio=split("#",$ris_occhio['purpose']);
			if (($mappa[$esame_occhio[1]][4]==5)&& $esame_occhio[1]!='CO422' && $esame_occhio[1]!='CO428' && $esame_occhio[1]!='CO424' && $esame_occhio[1]!='CO425' && $esame_occhio[1]!='CO426')$conto_occhio++;###conta gli item che nn sono di cardiologia....serve???
		}
	}
	
	//echo "<b><i>$conto_occhio</i></b>";
	$sql2="select * from care_appointment where pid=".$ris['pid']." and (appt_status='Fatto' OR appt_status='In attesa di referto')and date='".$ris['date']."' and to_dept_nr='5' and purpose not like '%CO419%' and purpose not like '%CO420%'";
	
	
	//echo "<br />";
	$conto=0;
	$appt_nr='';
	$risultato2=$db->Execute($sql2);
	if(($risultato2->recordCount()>0 || $ecg_base==1))
		{
		while($ris2=$risultato2->fetchrow())
	{

		$esame=split("#",$ris2['purpose']);
		if ($mappa[$esame[1]][4]==5)
		{
		$conto++;
		$appt_nr=$appt_nr.($ris2['nr']*2)."@";
		}
	}
		#$conto++;
		#echo "prova ".$ris2['nr']."<br>";
		#$appt_nr=$appt_nr.($ris2['nr']*2)."@";	
		//echo $appt_nr;
		$risultato2=$db->Execute($sql2);
		
		$sql4="SELECT encounter_nr FROM care_encounter WHERE pid=".$ris['pid'];
		$risultato4=$db->Execute($sql4);
		$risultato4=$risultato4->FetchRow();
		$encounter_nr=$risultato4['encounter_nr'];
		$sql3="SELECT * FROM care_person WHERE pid=".$ris['pid'];

		$risultato3=$db->Execute($sql3);
		$risultato3=$risultato3->FetchRow();
		$nome=$risultato3['name_first'];
		$cognome=$risultato3['name_last'];
		$dataita=substr($ris['date'],8,2)."-".substr($ris['date'],5,2)."-".substr($ris['date'],0,4);
		if($conto!=0 || $ecg_base==1)
		echo "Il paziente ".$nome." ".$cognome." ha eseguito in data ".$dataita.", oltre ad una visita specialistica cardiologica  (eseguita da ".$ris['modify_id'].", esame ".strtolower($stato_visita_spec_cardio)."), anche le seguenti visite<br />";
	?>
	<form name="<?php echo $ris['pid'];?>"  method="POST" action="">
	<?
	
	if($conto!=0 || $ecg_base==1)
	{
	echo "<table bgcolor=#bcdbcd border=1> ";
	
	if($conto!=0)
	{ 
	while($ris2=$risultato2->fetchrow())
	{
	$esame=split("#",$ris2['purpose']);
		if ($mappa[$esame[1]][4]==5)
		{
	?>
		<tr ><td >
		<?
		
		$descrizione=str_replace("_"," ",$esame[0]);
		//if ($mappa[$esame[1]][4]==5)
		echo $descrizione.", <b>esame ".strtolower($ris2['appt_status'])."</b>";
		echo "</td></tr>";
		}
	}
	}
	if($ecg_base==1)
	{
?>
<tr ><td >
<?php
	echo "ECG di base, <b>esame ".strtolower($stato_ecg_base)."</b>";
		echo "</td></tr>";
	}
	
	echo "</table>";
	echo "creare una relazione conclusiva?";
	$delta=substr($ris['date'],2,2).substr($ris['date'],5,2).substr($ris['date'],8,2);
	//$prova='onClick="javascript:seiSicuro('.$ris['pid'].')"';
	
	
	?>

	<input type="submit" name="si" value="Si">
	<!--<input type="submit" name="no" value="No" onClick="javascript:seiSicuro(this)" >-->
	<!--Il no è stato tolto perchè dalla riunione del 18/10/2004 è stato detto che per tutti si devono fare le relazioni conclusive-->
	<input type="hidden" name="nr" value="<?php echo $ris['nr']?>">
	<input type="hidden" name="delta" value="<?php echo $delta?>">
	<input type="hidden" name="encounter_nr" value="<?php echo $encounter_nr?>">
	<input type="hidden" name="appt" value="<?php 	echo $appt_nr; ?>">
	</form>
	<?
	//echo "<br />";

	}
	
	}

}

//echo "nr vale ".$_POST['nr'];
?>
