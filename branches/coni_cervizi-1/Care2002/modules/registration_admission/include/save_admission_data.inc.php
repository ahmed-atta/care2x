<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
//require('Mappa.php');
if (eregi('save_admission_data.inc.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');	


$appoggio=split ('#',$HTTP_POST_VARS['purpose']);
$query="SELECT * from prezzi_1 WHERE item_code='".$appoggio[1]."'";
$ris=$db->Execute($query);
$ris=$ris->FetchRow();
$risultato=$mappa[$appoggio[1]][4];
#echo "DIPART ".$appoggio[1];
$HTTP_POST_VARS['to_dept_nr']=$risultato;		
if($HTTP_POST_VARS['purpose']=="Valutazione_dietologica_completa#CO431")
{

	if($mode=='create')
	{
		$HTTP_POST_VARS['purpose']="Controllo_dietologico#CO432";
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
		$HTTP_POST_VARS['purpose']="Antropometria_e_composizione_corporea#CO435";
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
		$HTTP_POST_VARS['purpose']="Controllo_dietetico#CO434";
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
	}
	else
	{
		echo "IMPOSSIBILE SELEZIONARE QUESTA VISITA COME Valutazione dietologica completa";
		echo "<br /> ANNULLARE L'APPUNTAMENTO E CREARNE UNO NUOVO";
		exit;
		
	}
	

}

else if($HTTP_POST_VARS['purpose']=="Routine cardiologica P.O./I.N.")
{

	if($mode=='create')
	{
		$HTTP_POST_VARS['purpose']="Visita_specialistica_cardiologica_+_ECG#CO420";
		$HTTP_POST_VARS['to_dept_nr']='5';
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
		$HTTP_POST_VARS['purpose']="ECG_da_sforzo#CO427";
		$HTTP_POST_VARS['to_dept_nr']='5';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
		$HTTP_POST_VARS['purpose']="Ecocardiocolordoppler#CO422";
		$HTTP_POST_VARS['to_dept_nr']='5';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
	}


}

else if($HTTP_POST_VARS['purpose']=="Visita_specialistica_cardiologica_+_ECG_da_sforzo#CO421")
{
if($mode=='create')
	{
		$HTTP_POST_VARS['purpose']="Visita_specialistica_cardiologica#CO419";
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
		$HTTP_POST_VARS['purpose']="ECG_da_sforzo#CO427";
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
	
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
	}
		else
	{
		echo "IMPOSSIBILE SELEZIONARE QUESTA VISITA COME Visita specialistica cardiologica + ECG da sforzo";
		echo "<br /> ANNULLARE L'APPUNTAMENTO E CREARNE UNO NUOVO";
		exit;
		
	}
}
	else if($HTTP_POST_VARS['purpose']=="Routine P.O.")
{
if($mode=='create')
	{
		$HTTP_POST_VARS['purpose']="Visita_specialistica_di_medicina_generale#CO430";
		$HTTP_POST_VARS['to_dept_nr']='3';
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Antropometria_e_composizione_corporea#CO435";
		$HTTP_POST_VARS['to_dept_nr']='4';
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Controllo_dietologico#CO432";
		$HTTP_POST_VARS['to_dept_nr']='4';
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Visita_specialistica_cardiologica_+_ECG_di_base#CO420";
		$HTTP_POST_VARS['to_dept_nr']='5';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Ecocardiocolordoppler#CO422";
		$HTTP_POST_VARS['to_dept_nr']='5';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Spirometria_di_base#CO482";
		$HTTP_POST_VARS['to_dept_nr']='3';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Visita_specialistica_ortopedica#CO446";
		$HTTP_POST_VARS['to_dept_nr']='6';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="ECG_da_sforzo#CO427";
		$HTTP_POST_VARS['to_dept_nr']='5';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Visita_specialistica_neurologica#CO436";
		$HTTP_POST_VARS['to_dept_nr']='9';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Visita_specialistica_otorinolaringoiatrica#CO466";
		$HTTP_POST_VARS['to_dept_nr']='10';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Visita_oculistica_+_esame_ortottico#CO568";
		$HTTP_POST_VARS['to_dept_nr']='11';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
	 	$HTTP_POST_VARS['purpose']="Analisi_di_Laboratorio#COXXX";
		$HTTP_POST_VARS['to_dept_nr']='18';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
	}
}
	
	
	else if($HTTP_POST_VARS['purpose']=="Routine I.N.")
{
if($mode=='create')
	{
		$HTTP_POST_VARS['purpose']="Visita_specialistica_di_medicina_generale#CO430";
		$HTTP_POST_VARS['to_dept_nr']='3';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Antropometria_e_composizione_corporea#CO435";
		$HTTP_POST_VARS['to_dept_nr']='4';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Controllo_dietologico#CO432";
		$HTTP_POST_VARS['to_dept_nr']='4';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Visita_specialistica_cardiologica_+_ECG_di_base#CO420";
		$HTTP_POST_VARS['to_dept_nr']='5';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Ecocardiocolordoppler#CO422";
		$HTTP_POST_VARS['to_dept_nr']='5';
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Spirometria_di_base#CO482";
		$HTTP_POST_VARS['to_dept_nr']='3';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Visita_specialistica_ortopedica#CO446";
		$HTTP_POST_VARS['to_dept_nr']='6';			
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="ECG_da_sforzo#CO427";
		$HTTP_POST_VARS['to_dept_nr']='5';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		
		$HTTP_POST_VARS['purpose']="Analisi_di_Laboratorio#COXXX";
		$HTTP_POST_VARS['to_dept_nr']='18';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
	}
}
	else if($HTTP_POST_VARS['purpose']=="Analisi di Laboratorio")
{
if($mode=='create')
	{
		$HTTP_POST_VARS['purpose']="Analisi_di_Laboratorio#COXXX";
		$HTTP_POST_VARS['to_dept_nr']='18';		
		$obj->setDataArray($HTTP_POST_VARS);
		$obj->insertDataFromInternalArray();
	
		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
		exit;
}
}

else
{
$obj->setDataArray($HTTP_POST_VARS);
switch($mode){	
		case 'create': 
								if($obj->insertDataFromInternalArray()) {
									if(!$no_redirect){
										header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']);
										//echo "$obj->getLastQuery<br>$LDDbNoSave";
										exit;
									}
								} else echo "$obj->getLastQuery<br>$LDDbNoSave";
								break;
		case 'update': 
								$HTTP_POST_VARS['pid']=$_GET['pid'];
								$obj->setDataArray($HTTP_POST_VARS);
								$obj->where=' nr='.$nr;
								if($obj->updateDataFromInternalArray($nr)) {
									if(!$no_redirect){
											header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$_GET['pid']);
										//echo "$obj->sql<br>$LDDbNoUpdate";
										exit;
									}
								} else echo "$obj->getLastQuery<br>$LDDbNoUpdate";
								break;
}// end of switch
}
?>
