<?php
	
	/*************************************************************************************************************
	*	Questa form prende i input il cognome e visualizza tutti i pazienti il cui cognome inizia con i dati passati.
	* 
	*	Tutti i pazienti vengono mostrati in un elenco e ad ognuno di loro viene assegnato un valore
	*	che indica se l'ultima visita effettuata è più vecchia di 5 anni.
	*	Tutti questi dati vengono usati per modificare i controlli della form delle cartelle. 	
	**************************************************************************************************************/
	
	//devo includere questi files per effettuare le query sul db 
	require('./roots.php');
	require('../../include/inc_environment_global.php');
?>

<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	
	<script language="javascript" >
  	<!--
	//funzioni riportare i dati alla finestra della cartella
	function carica_dati(cognome,nome,datanascita,tipo){
		
		window.opener.document.frmMain.cognome.value = cognome ;
		window.opener.document.frmMain.nome.value = nome ;
		window.opener.document.frmMain.data_nascita.value = datanascita ;
		
		if (tipo=='A') window.opener.document.frmMain.tipo[0].checked=true;
		else window.opener.document.frmMain.tipo[1].checked=true;
		
		//chiude se stesso
		window.close();
	}
	-->
	</script>
	
</head>

<?php


/*********************************************************************************
*
*			Parte di script per la visualizzazione dei pazienti
*
**********************************************************************************/
$tabellaHTML='';


//Legge il cognome passato in GET
$var_cognome=$_GET['cognome']; 

//esegue la ricerca delle cartelle e della data dell'ultima visita del paziente
$sSQL = "SELECT DISTINCT care_person.pid, care_person.name_first, care_person.name_last, care_person.date_birth, MAX(care_appointment.date) AS ultimo_app"  
        . " FROM care_person"
        . " INNER JOIN care_appointment ON care_person.pid = care_appointment.pid"
        . " WHERE ( (care_person.name_last LIKE \"".$var_cognome."%\") "
        . " AND (care_appointment.appt_status!='cancelled' OR care_appointment.appt_status!='pending') )"
        . " GROUP BY care_person.pid, care_person.name_first, care_person.name_last, care_person.date_birth ;"; 
$risultati=$db->Execute($sSQL);

//DEBUG
//echo ($sSQL) ;exit;

//compila la tabella HTML dei risultati
$tabellaHTML="<HR><TABLE><TR bgcolor=#99ccff><TD>PID</TD><TD>Nome</TD><TD>Cognome</TD><TD>Data Nascita</TD><TD></TD>\n";
	
//variabili booleana per il colore alternato delle righe
$coloriga = true;
	
//scrive le cartelle trovate
while ($riga=$risultati->FetchRow()){

	if ($coloreriga) $colore="bgcolor=#efefef";
	else $colore="bgcolor=#ffffff"; 
	$coloreriga= !$coloreriga;
	
	//converte il formato della data di nascita
	$data_nascita=  substr($riga['date_birth'],8,2)."/".substr($riga['date_birth'],5,2)."/".substr($riga['date_birth'],0,4);
	
	//verifica se sono passati almeno 5 anni dall'ultimo appuntamento per stabilire se è storico o attuale 
	$g=substr($riga['ultimo_app'],8,2) ;
	$m=substr($riga['ultimo_app'],5,2) ;
	$a=substr($riga['ultimo_app'],0,4) ;
	if ((mktime(0,0,0,$m,$g,$a+5)- time())>0) $tipo="A";
	else $tipo="S";
					
	$tabellaHTML.="<TR $colore >\n";
	$tabellaHTML.="<TD>".$riga['pid']."</TD>\n";
	$tabellaHTML.="<TD>".$riga['name_first']."</TD>\n";		
	$tabellaHTML.="<TD>".$riga['name_last']."</TD>\n";			
	$tabellaHTML.="<TD>".$data_nascita."</TD>\n";
	$tabellaHTML.="<TD><A HREF=javascript:carica_dati(\"".$riga['name_last']."\",\"".$riga['name_first']."\",\"".$data_nascita."\",\"".$tipo."\") >";
	$tabellaHTML.="<IMG SRC='../../gui/img/control/default/it/it_ok_small.gif' border=0 width='105' height='16' ></A>\n";		
	$tabellaHTML.="</TD></TR>\n";
	
}
	
//chiude la tabella dei risultati
$tabellaHTML.= "</TABLE>\n";

?>




<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 >

	<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
		<tr valign=top>
			<td bgcolor="#99ccff" height="10">
				<font  COLOR="#330066"  SIZE=+2  FACE="Arial">
				<strong> &nbsp; Selezionare il paziente</strong></font></td>
			<td bgcolor="#99ccff" height="10" align=right><a href="javascript:window.close();"><img src="../../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24" alt=""  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
		</tr>

	<tr valign=top >
		<td bgcolor=#ffffff valign=top colspan=2><p>


	
<!-- *****************************************************************************************
							inizio parte principale della pagina HTML
  *****************************************************************************************  -->
<font face="Verdana,Helvetica,Arial" size=2>
<?php echo $tabellaHTML;  ?>
</FONT>

<!--fine parte principale della pagina-->
  </table>
</td>

</tr>
</table>
</td>
</tr>
</table>        
&nbsp;
</font>			
</body>
</html>
