<?
/*
* Questa classe permette di caricare i dati riguardanti le info sull'ecocardiogramma doppler
*
*/

require('./roots.php');
require($root_path.'include/inc_environment_global.php');
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
	}
	function salvaDati($info,$db)
	{
		$stringa="";
		while(list($chiave,$valore)=each($info))
		{
			$stringa.=rtrim($chiave)."=".$valore."#";
		}
		
		$sql="Insert into care_encounter_notes (encounter_nr,type_nr,notes,aux_notes,ref_notes_nr,date,time,history,modify_id,modify_time,create_id,create_time) values (".$info['encounter_nr'].",13,'".$stringa."',".$info['appt_nr'].",".(2*$info['appt_nr']).",'".date('Y-m-d')."','".date('H:i:s')."','Creato da ".$info['sess_user_name']." il ".date('Y-m-d H:i:s')."','".$info['sess_user_name']."','".date('Y-m-d H:i:s')."','".$info['sess_user_name']."','".date('Y-m-d H:i:s')."')";
		//echo $sql;
		$db->Execute($sql);
		//echo "p";
		
		
	}
	
}

if($_POST['salva'])
{
$classe=new gestisciDati();
$classe->salvaDati($_POST,$db);
}



?>
