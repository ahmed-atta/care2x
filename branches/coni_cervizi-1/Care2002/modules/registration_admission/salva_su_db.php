<?

/*
* Questa classe permette di caricare i dati riguardanti le info sull'ecocardiogramma doppler
*
*/

$codice=$_GET['codice'];
require ('Mappa.php');
require('./roots.php');
require('../../include/inc_environment_global.php');
$parametri="";

class gestisciDati
{
	
	function caricaDati($info)
	{
		global $db;
		global $parametri;
		$sql="Select * from care_encounter_notes where ref_notes_nr=".$info['appt_nr']*2;
		$riga=$db->Execute($sql);
		$riga=$riga->FetchRow();
		$dati=split("#",$riga['notes']);
		$pippo=0;
		$i=0;
		$dati2=split("=",$dati[0]);
		while($dati2[0])
		{
			
			if($pippo>200) break;
			$dati2=split("=",$dati[$i]);
			//echo $dati2;
			$parametri[$dati2[0]]=$dati2[1];
			
			$i++;
		}
		return $parametri;
	}
	function salvaDati($info,$db,$modalita)
	{
		$stringa="";
		while(list($chiave,$valore)=each($info))
		{
			$stringa.=rtrim($chiave)."=".$valore."#";
		}
		if ($info['carica']) $sql="update care_encounter_notes set notes='".$stringa."' where ref_notes_nr=".(2*$info['appt_nr']) ;
		else $sql="Insert into care_encounter_notes (encounter_nr,type_nr,notes,aux_notes,ref_notes_nr,date,time,history,modify_id,modify_time,create_id,create_time) values (".$info['encounter_nr'].",13,'".$stringa."',".$info['appt_nr'].",".(2*$info['appt_nr']).",'".date('Y-m-d')."','".date('H:i:s')."','Creato da ".$_SESSION['sess_login_username']." il ".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."')";
		
		$db->Execute($sql);
		//echo "p";
		
		if($modalita=="Stampa")
		{
			
			$query="UPDATE care_appointment  SET  appt_status='Fatto',
			history=CONCAT(history,'Fatto ".date('Y-m-d H:i:s')." ".$info['sess_user_name']."'),
			modify_id='".$info['sess_user_name']."',
			modify_time='".date('YmdHis')."'
			WHERE nr=".$info['appt_nr'];
			//echo $query;
			//exit;
 			$result=$db->Execute($query);	
		}
		
	}
	
	
}

#QUESTA CLASSE SERVE  A GESTIRE I DATI PER LE RELAZIONI CONCLUSIVE ESTESE
class gestisciDati2
{
	
	function caricaDati2($info)
	{
		global $db;
		global $parametri;
		$sql="Select * from care_encounter_notes where aux_notes='rel_conc' AND ref_notes_nr='".$info['encounter_nr'].$info['delta']."'";
		$riga=$db->Execute($sql);
		$riga=$riga->FetchRow();
		$dati=split("#",$riga['notes']);
		$pippo=0;
		$i=0;
		$dati2=split("=",$dati[0]);
		while($dati2[0])
		{
			
			if($pippo>200) break;
			$dati2=split("=",$dati[$i]);
			//echo $dati2;
			$parametri[$dati2[0]]=$dati2[1];
			
			$i++;
		}
		return $parametri;
	}
	function salvaDati2($info,$db,$modalita)
	{
	
		$stringa="";
		while(list($chiave,$valore)=each($info))
		{
			$stringa.=rtrim($chiave)."=".$valore."#";
		}
		
		if ($info['carica']) $sql="update care_encounter_notes set notes='".$stringa."' where ref_notes_nr=".$info['encounter_nr'].$info['delta']." AND aux_notes='rel_conc'";
		else $sql="Insert into care_encounter_notes (encounter_nr,type_nr,notes,aux_notes,ref_notes_nr,date,time,history,modify_id,modify_time,create_id,create_time) values (".$info['encounter_nr'].",13,'".$stringa."','rel_conc','".$info['encounter_nr'].$info['delta']."','".date('Y-m-d')."','".date('H:i:s')."','Creato da ".$_SESSION['sess_login_username']." il ".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."')";
		
		$db->Execute($sql);
		//echo "p";
		
		if($modalita=="Stampa")
		{
			
			$query="UPDATE care_encounter_notes  SET  status='Fatto',
			history=CONCAT(history,'Fatto ".date('Y-m-d H:i:s')." ".$_SESSION['sess_login_username']."'),
			modify_id='".$_SESSION['sess_login_username']."',
			modify_time='".date('YmdHis')."'
			WHERE aux_notes='rel_conc' AND  ref_notes_nr='".$info['encounter_nr'].$info['delta']."'";
			//echo $query;
			//exit;
 			$result=$db->Execute($query);	
			$query2="UPDATE care_appointment SET to_dept_id='no' WHERE nr=".$info['nr'];
			$result2=$db->Execute($query2);
		}
		
	}
}


#QUESTA CLASSE SERVE  A GESTIRE I DATI PER LE RELAZIONI CONCLUSIVE IN BREVE
class gestisciDati3
{
	
	function caricaDati3($info)
	{
		global $db;
		global $parametri;
		$sql="Select * from care_encounter_notes where aux_notes='rel_conc_short' AND encounter_nr=".$info['encounter_nr'];
		$riga=$db->Execute($sql);
		$riga=$riga->FetchRow();
		$dati=split("#",$riga['notes']);
		$pippo=0;
		$i=0;
		$dati2=split("=",$dati[0]);
		while($dati2[0])
		{
			
			if($pippo>200) break;
			$dati2=split("=",$dati[$i]);
			//echo $dati2;
			$parametri[$dati2[0]]=$dati2[1];
			
			$i++;
		}
		return $parametri;
	}
	function salvaDati3($info,$db,$modalita)
	{
	
		$stringa="";
		while(list($chiave,$valore)=each($info))
		{
			$stringa.=rtrim($chiave)."=".$valore."#";
		}
		$richiesta="SELECT * FROM care_encounter_notes WHERE aux_notes='rel_conc_short' AND status='da finire' AND encounter_nr=".$info['encounter_nr'];
	$risposta=$db->Execute($richiesta);
if($rispo=$risposta->FetchRow())
$carica=true;
		
		
		if ($carica) $sql="update care_encounter_notes set notes='".$stringa."' where ref_notes_nr=".$info['encounter_nr'].$info['delta']." AND aux_notes='rel_conc_short'";
		else $sql="Insert into care_encounter_notes (encounter_nr,type_nr,notes,aux_notes,ref_notes_nr,date,time,history,modify_id,modify_time,create_id,create_time,status) values (".$info['encounter_nr'].",13,'".$stringa."','rel_conc_short','".$info['encounter_nr'].$info['delta']."','".date('Y-m-d')."','".date('H:i:s')."','Creato da ".$_SESSION['sess_login_username']." il ".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."','da finire')";
		
		$db->Execute($sql);
		//echo "p";
		
		if($modalita=="Stampa")
		{
			/*$query="DELETE FROM care_encounter_notes WHERE aux_notes='rel_conc_short' AND encounter_nr=".$info['encounter_nr'];
			$db->Execute($query);
			
			$query="Insert into care_encounter_notes (encounter_nr,type_nr,notes,aux_notes,ref_notes_nr,date,time,history,modify_id,modify_time,create_id,create_time,status) values (".$info['encounter_nr'].",13,'".$stringa."','rel_conc_short','".$info['encounter_nr'].$info['delta']."','".date('Y-m-d')."','".date('H:i:s')."','Creato da ".$_SESSION['sess_login_username']." il ".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."','Fatto')";
			$db->Execute($query);
			*/
			
			
			$query="UPDATE care_encounter_notes  SET  status='Fatto',
			history=CONCAT(history,'Fatto ".date('Y-m-d H:i:s')." ".$_SESSION['sess_login_username']."'),
			modify_id='".$_SESSION['sess_login_username']."',
			modify_time='".date('YmdHis')."'
			WHERE aux_notes='rel_conc_short' AND  ref_notes_nr='".$info['encounter_nr'].$info['delta']."'";
			
			//echo $query;
			//exit;
 			$result=$db->Execute($query);	
			//$query2="UPDATE care_appointment SET to_dept_id='no' WHERE nr=".$info['nr'];
			//$result2=$db->Execute($query2);
		}
		
	}
}


#QUESTA CLASSE SERVE  A GESTIRE I DATI PER LE RELAZIONI CONCLUSIVE ESTESE CARDIOLOGICHE
class gestisciDati4
{
	
	function caricaDati4($info)
	{
		global $db;
		global $parametri;
		$sql="Select * from care_encounter_notes where aux_notes='rel_conc_cardio' AND ref_notes_nr='".$info['encounter_nr'].$info['delta']."'";
		$riga=$db->Execute($sql);
		$riga=$riga->FetchRow();
		$dati=split("#",$riga['notes']);
		$pippo=0;
		$i=0;
		$dati2=split("=",$dati[0]);
		while($dati2[0])
		{
			
			if($pippo>200) break;
			$dati2=split("=",$dati[$i]);
			//echo $dati2;
			$parametri[$dati2[0]]=$dati2[1];
			
			$i++;
		}
		return $parametri;
	}
	function salvaDati4($info,$db,$modalita)
	{
	
		$stringa="";
		while(list($chiave,$valore)=each($info))
		{
			$stringa.=rtrim($chiave)."=".$valore."#";
		}
		
		if ($info['carica']) $sql="update care_encounter_notes set notes='".$stringa."item_code=rel_conc_cardio' where ref_notes_nr=".$info['encounter_nr'].$info['delta']." AND aux_notes='rel_conc_cardio'";
		else $sql="Insert into care_encounter_notes (encounter_nr,type_nr,notes,aux_notes,ref_notes_nr,date,time,history,modify_id,modify_time,create_id,create_time) values (".$info['encounter_nr'].",13,'".$stringa."item_code=rel_conc_cardio','rel_conc_cardio','".$info['encounter_nr'].$info['delta']."','".date('Y-m-d')."','".date('H:i:s')."','Creato da ".$_SESSION['sess_login_username']." il ".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."','".$_SESSION['sess_login_username']."','".date('Y-m-d H:i:s')."')";
		
		$db->Execute($sql);
		//echo "p";
		
		if($modalita=="Stampa")
		{
			
			$query="UPDATE care_encounter_notes  SET  status='Fatto',
			history=CONCAT(history,'Fatto ".date('Y-m-d H:i:s')." ".$_SESSION['sess_login_username']."'),
			modify_id='".$_SESSION['sess_login_username']."',
			modify_time='".date('YmdHis')."'
			WHERE aux_notes='rel_conc_cardio' AND  ref_notes_nr='".$info['encounter_nr'].$info['delta']."'";
			//echo $query;
			//exit;
 			$result=$db->Execute($query);	
			$query2="UPDATE care_appointment SET to_dept_id='no' WHERE nr=".$info['nr'];
			$result2=$db->Execute($query2);
		}
		
	}
}




if($_POST['salva']=='Salva')
{

$classe=new gestisciDati();
$classe->salvaDati($_POST,$db,"Salva");
//Header ("Location:../appointment_scheduler/gui_bridge/default/gui_show_appointment.php?lang=it&sess_user_name=".$HTTP_SESSION_VARS['sess_user_name']);
//$info['encounter_nr'].",13,'".$stringa."',".$info['appt_nr'].",".(2*$info['appt_nr']).",'".date('Y-m-d')."','".date('H:i:s')."','Creato da ".$info['sess_user_name']." il ".date('Y-m-d H:i:s')."','".$info['sess_user_name']."','".date('Y-m-d H:i:s')."','".$info['sess_user_name']."','".date('Y-m-d H:i:s')."')";
//Header ("Location:../../main/login-pc-config.php?lang=it&sess_user_name=".$HTTP_SESSION_VARS['sess_user_name']);
?>
<script>
<!--
window.close();
//-->
</script>
<?php
}

if($_POST['stampa']=='Stampa Definitiva')
{

$classe=new gestisciDati();
$classe->salvaDati($_POST,$db,"Stampa");
//echo " prova ".$_POST['item_code'].$_POST['encounter_nr'].$_POST['appt_nr'];

require ("../../invoice/form_generico.php");
}


if($_POST['stampa_temp']=='Stampa Temporanea')
{
$classe=new gestisciDati();
$classe->salvaDati($_POST,$db,"Salva");
require ("../../invoice/form_generico.php");

}

######

if($_POST['salva_rel_con']=='Salva')
{

$classe=new gestisciDati2();
$classe->salvaDati2($_POST,$db,"Salva");
?>
<script>
<!--
window.close();
//-->
</script>
<?php
}

if($_POST['stampa_rel_con']=='Stampa Definitiva')
{

$classe=new gestisciDati2();
$classe->salvaDati2($_POST,$db,"Stampa");
//echo " prova ".$_POST['item_code'].$_POST['encounter_nr'].$_POST['appt_nr'];

require ("../../invoice/form_generico.php");
}


if($_POST['stampa_temp_rel_con']=='Stampa Temporanea')
{

$classe=new gestisciDati2();
$classe->salvaDati2($_POST,$db,"Salva");
//require ("../../invoice/form_rel_conc.php");
require ("../../invoice/form_generico.php");
}


if($_POST['salva_rel_con_card']=='Salva')
{

$classe=new gestisciDati4();
$classe->salvaDati4($_POST,$db,"Salva");
?>
<script>
<!--
window.close();
//-->
</script>
<?php
}

if($_POST['stampa_rel_con_card']=='Stampa Definitiva')
{

$classe=new gestisciDati4();
$classe->salvaDati4($_POST,$db,"Stampa");
//echo " prova ".$_POST['item_code'].$_POST['encounter_nr'].$_POST['appt_nr'];

require ("../../invoice/form_generico.php");
}


if($_POST['stampa_temp_rel_con_card']=='Stampa Temporanea')
{

$classe=new gestisciDati4();
$classe->salvaDati4($_POST,$db,"Salva");
//require ("../../invoice/form_rel_conc.php");
require ("../../invoice/form_generico.php");
}




if($_POST['salva_rel_conc_short']=='Salva')
{

$classe=new gestisciDati3();
$classe->salvaDati3($_POST,$db,"Salva");
?>
<script>
<!--
window.close();
//-->
</script>
<?php
}

if($_POST['stampa_rel_conc_short']=='Stampa Definitiva')
{

$classe=new gestisciDati3();
$classe->salvaDati3($_POST,$db,"Stampa");
//echo " prova ".$_POST['item_code'].$_POST['encounter_nr'].$_POST['appt_nr'];

require ("../../invoice/form_generico.php");
}


if($_POST['stampa_temp_rel_conc_short']=='Stampa Temporanea')
{

$classe=new gestisciDati3();
$classe->salvaDati3($_POST,$db,"Salva");
//require ("../../invoice/form_rel_conc.php");
require ("../../invoice/form_generico.php");

}

?>
