
<?php



// Questo file consente di visualizzare i pazienti che hanno effettuato un'altra visita oltre 
// a quella di medicina generale, nello stesso giorno. Premendo sul pulsante No, ? aggiornato
// il campo to_dept_id='no' della visita di medicina generale.
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

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
/*Il no è stato tolto perchè dalla riunione del 18/10/2004 è stato detto che per tutti si devono fare le relazioni conclusive
if($_POST['no']=="No")
{
	$sql_update="update care_appointment set to_dept_id='no' where nr=".$_POST['nr'];
	$db->Execute($sql_update);

}
else */if($_POST['si']=="Si\'") 
{

?>
<script language="javascript">
<!--

window.open("../medocs/rel_concl_form.php?nr=<?php echo $_POST['nr'];?>&delta=<?php echo $_POST['delta'];?>&encounter_nr=<?php echo $_POST['encounter_nr'];?>");
//-->
</script>
<?
}


?>

<P align="center" ><b><big><big>RELAZIONI CONCLUSIVE PER LA MEDICINA GENERALE</big></big></b></P>


<?


$sql="select * from care_appointment  where (appt_status='Fatto' OR appt_status='In attesa di referto') and purpose like '%CO430%' AND to_dept_id=''";
###TO DO: recuperare lo stato della CO430 che scatena tutto il fatto
$risultato=$db->Execute($sql);

echo "<br />";

while($ris=$risultato->FetchRow())
{
$stato_visita_spec_generale=$ris['appt_status'];
$conto_occhio=0;
	$sql_occhio="select * from care_appointment where pid=".$ris['pid']." and appt_status='pending'  and date='".$ris['date']."' and purpose not like '%CO430%'";

//echo $sql_occhio;

$risultato_occhio=$db->Execute($sql_occhio);
if($risultato_occhio->recordCount()>0) 
	$conto_occhio=1;##E' un flag che serve solo a dire che tra i vari appuntamenti di quel giorno per quella persona alcuni non sono stati neanche accettati, per cui pending
		
	$sql2="select * from care_appointment where pid=".$ris['pid']." and (appt_status='Fatto' OR appt_status='In attesa di referto') and date='".$ris['date']."' and purpose not like '%CO430%'";
	
	
	echo "<br />";
	$risultato2=$db->Execute($sql2);
	if($risultato2->recordCount()>0) 
		{
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
		echo "Il paziente ".$nome." ".$cognome." ha eseguito in data ".$dataita.", oltre ad una visita di Medicina generale  (eseguita da ".$ris['modify_id'].", esame ".strtolower($stato_visita_spec_generale)."), anche le seguenti visite<br />";
	?>
	<form name="<?php echo $ris['pid'];?>"  method="POST" action="">
	<?
	
	
	echo "<table bgcolor=#bcdbcd border=1> ";
	
	while($ris2=$risultato2->fetchrow())
	{
	?>
		<tr ><td >
		<?
		$esame=split("#",$ris2['purpose']);
		echo str_replace("_"," ",$esame[0]).", <b>esame ".strtolower($ris2['appt_status'])."</b>";
		echo "</td></tr>";
	}
	
	echo "</table>";
	echo "creare una relazione conclusiva?";
	$delta=substr($ris['date'],2,2).substr($ris['date'],5,2).substr($ris['date'],8,2);
	//$prova='onClick="javascript:seiSicuro('.$ris['pid'].')"';
	?>

	<input type="submit" name="si" value="Si'">
	<!--<input type="submit" name="no" value="No" onClick="javascript:seiSicuro(this)" >-->
	<!--Il no è stato tolto perchè dalla riunione del 18/10/2004 è stato detto che per tutti si devono fare le relazioni conclusive-->
	<input type="hidden" name="nr" value="<?php echo $ris['nr']?>">
	<input type="hidden" name="delta" value="<?php echo $delta?>">
	<input type="hidden" name="encounter_nr" value="<?php echo $encounter_nr?>">
	</form>
	<?
	echo "<br />";
	
	}

}

//echo "nr vale ".$_POST['nr'];
?>
