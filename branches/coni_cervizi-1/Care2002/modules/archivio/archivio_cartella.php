<?php
	//devo includere questi files per effettuare le query sul db 
	require('./roots.php');
	require('../../include/inc_environment_global.php');
?>

<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/javascript" src="jslibreria.js"></script>

<script language="JavaScript" >
  
//funzioni per il controllo dati
function controlla_dati()
{
	var stringa;	
	var msg='';
	
	//Deve esser indicato obbligatoriamente il numero della cartella	
	stringa = new String(window.document.frmMain.numero.value);
	if (stringa.Trim()=='' && 
		window.document.frmMain.inviadati.value=='Aggiungi' )	msg=msg+"Indicare il numero della cartella\n";
		
	//controllo che la data ritiro sia corretta
	stringa = new String(window.document.frmMain.data_ritiro.value);
	if (stringa.len()>0 || !isDate(stringa.Trim()) ) msg=msg+"Data di ritiro non corretta\n";

	//controllo che la data nascita sia corretta
	stringa = new String(window.document.frmMain.data_nascita.value);
	if ((stringa.length<10) || !isDate(stringa.Trim()) ) msg=msg+"Data di nascita non corretta\n";
			
	if (msg!='') {
		window.alert (msg);
		return false;
	}else return true;
}; 

//funzione che apre la finestra della selezione del paziente.
//Apre la form dell'elenco pazienti passandogli i dati scritti in cognome
function cerca_paziente(){	
	var url_dest = './archivio_cercapaziente.php?cognome='+window.document.frmMain.cognome.value;	
	window.open(url_dest,'','width=600,height=700,scrollbars=yes');
};

</script>


<script language="javascript" >
<!-- 
function closewin()
{
	location.href='startframe.php?sid=8871309d69cbc4fbcba9c66435c6e6ae&lang=it';
}
// -->
</script> 
 
<script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=8871309d69cbc4fbcba9c66435c6e6ae&lang=it&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 
 
	<script language="javascript" src="../../js/hilitebu.js">
	</script>



	<style TYPE="text/css">

	A:link  {text-decoration: none; color: #000066;}
	A:hover {text-decoration: underline; color: #cc0033;}
	A:active {text-decoration: none; color: #cc0000;}
	A:visited {text-decoration: none; color: #000066;}
	A:visited:active {text-decoration: none; color: #cc0000;}
	A:visited:hover {text-decoration: underline; color: #cc0033;}
	</style><script language="JavaScript">
<!--
function popPic(nd,fn){

	regpicwindow = window.open("../../main/pop_reg_pic.php?sid=8871309d69cbc4fbcba9c66435c6e6ae&lang=it&nm="+nd+"&fn="+fn,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>

<script language="JavaScript" src="../../js/sublinker-nd.js">

</SCRIPT>

</head>

<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 >

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0" >
<tr valign=top>
	<td bgcolor="#99ccff" height="10">
		<font  COLOR="#330066"  SIZE=+2  FACE="Arial">
			<strong> &nbsp; Archivio</strong></font></td>
	<td bgcolor="#99ccff" height="10" align=right><a href="../../main/startframe.php?lang=it"><img src="../../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24" alt=""  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>

<tr valign=top >
	<td bgcolor=#ffffff valign=top colspan=2><p>

<?php


/****************************************************************************************
*
*
*							PARTE PRINCIPALE DELLO SCRIPT
*
*
*****************************************************************************************/

//Se sono passati come parametri visualizza i dati della cartella
$var_id=$_POST['id'];
$var_numero=$_POST['numero'];
$var_cognome=$_POST['cognome'];
$var_nome=$_POST['nome'];
$var_scatola=$_POST['scatola'];
$var_ritirato_da=$_POST['ritirato_da'];
$var_data_ritiro=$_POST['data_ritiro'];
$var_tipo=$_POST['tipo'];
$var_data_nascita=$_POST['data_nascita'];

//Estra il giorno mese ed anno dalle date per poter creare l'eventuale query
//data ritiro
$ggR=substr($var_data_ritiro,0,2);
$mmR=substr($var_data_ritiro,3,2);
$aaR=substr($var_data_ritiro,6,4);
//se la data ritito �nulla (tutti 0) non la visualizzo
if ($aaR=='0000') { $var_data_ritiro='';$ggR='';$mmR='';$aaR='';}
			
//data nascita
$ggN=substr($var_data_nascita,0,2);
$mmN=substr($var_data_nascita,3,2);
$aaN=substr($var_data_nascita,6,4);			
			
//questo campo indica quale operazione eseguire sulla cartella (visualizzare,salvare ecc.)
$tipo_operazione=$_POST['tipo_operazione'];

//Se viene passato l'id tramite GET allora vuol dire che �stata selezionata una cartella dell'elenco
//"ricerca cartelle" su archivio_main.php . 
if ($_GET['id']!='') {
	$var_id=$_GET['id'];
	$tipo_operazione="MODIFICA";
}


switch ($tipo_operazione) {
 	
 	//salva una cartella per la quale sono stati inseriti i dati
	case 'SALVA':
	
		//prima di inserire la cartella verifico che il suo numero (se indicato) non sia gi�presente.
		$sSQL="SELECT numero FROM care_archivio WHERE numero=\"".$var_numero."\"";
		$ris=$db->Execute($sSQL);
	
		if (trim($var_numero)!='' && $ris->NumRows()){
				$messaggio="Errore esiste' gia' una cartella con questo numero";	
				$testo_submit="Aggiungi";
				$tipo_operazione="SALVA";	
		}else{; 	
						
			
			$sSQL="INSERT INTO care_archivio (numero,cognome,nome,scatola,ritirato_da,data_ritiro,tipo,data_nascita) VALUES ".
				  " (\"".$var_numero."\",\"".$var_cognome."\",\"".$var_nome."\",\"".$var_scatola."\",\"".
			  	$var_ritirato_da."\",\"".$aaR."-".$mmR."-".$ggR."\",\"".$var_tipo."\",\"".$aaN."-".$mmN."-".$ggN."\")"; 		
			//DEBUG
			//echo $sSQL;exit;
		
			$db->Execute($sSQL);		

			$messaggio="Cartella aggiunta correttamente";
			$testo_submit="Aggiungi";
			$tipo_operazione="SALVA";
		}
		break;
	
	//aggiorna un cartella esistente		
	case 'AGGIORNA':
	
		$sSQL="UPDATE care_archivio SET numero=\"".$numero."\",cognome=\"".$var_cognome."\",nome=\"".$var_nome."\",".
			  " scatola=\"".$var_scatola."\",ritirato_da=\"".$var_ritirato_da."\",data_ritiro=\"".$aaR."-".$mmR."-".$ggR."\",".
			  " tipo=\"".$var_tipo."\",data_nascita=\"".$aaN."-".$mmN."-".$ggN."\"".
			  " WHERE id=\"".$var_id."\""; 		
		//DEBUG
		//echo $sSQL;exit;
		
		$db->Execute($sSQL);
				
		$messaggio="Cartella aggiornata correttamente";
		$testo_submit="Aggiungi";
		$tipo_operazione="SALVA";
		break;
	
	//visualizza i dati di una cartella esistente e non consente di modificare il numero di cartella
	case 'MODIFICA':
		
		//carica i dati sulla cartella con l'id passato
		$sSQL="SELECT * FROM care_archivio WHERE id=\"".$var_id."\"";
		
		$risultati=$db->Execute($sSQL);
		
		//carica i dati sulla cartella appena caricata.
		$riga=$risultati->FetchRow();
		$var_numero= $riga['numero'];
		$var_cognome= $riga['cognome'];
		$var_nome=$riga['nome'];
		$var_scatola=$riga['scatola'];
		$var_data_ritiro=$riga['data_ritiro'];
		$var_ritirato_da=$riga['ritirato_da'];
		$var_tipo=$riga['tipo'];			
		$var_data_nascita=$riga['data_nascita'];
		
		//cambia formato alle date
		$aaR=substr($var_data_ritiro,0,4);
		$mmR=substr($var_data_ritiro,5,2);
		$ggR=substr($var_data_ritiro,8,2);
		$var_data_ritiro=$ggR."/".$mmR."/".$aaR;
		//se la data ritito �nulla (tutti 0) non la visualizzo
		if ($aaR=='0000') { $var_data_ritiro='';$ggR='';$mmR='';$aaR='';}
		
		$aaN=substr($var_data_nascita,0,4);
		$mmN=substr($var_data_nascita,5,2);
		$ggN=substr($var_data_nascita,8,2);
		$var_data_nascita=$ggN."/".$mmN."/".$aaN;
		
		
		$testo_submit="Aggiorna";
		$tipo_operazione="AGGIORNA";					
		break;
	
	
	/*case 'NUOVO':
		$testo_submit="Aggiungi";
		$tipo_operazione="SALVA";
		break;
	*/
	
	default:
		
		$testo_submit="Aggiungi";
		$tipo_operazione="SALVA";
}

?>


	
<!-- *****************************************************************************************
							inizio parte principale della pagina HTML
  *****************************************************************************************  -->
<font face="Verdana,Helvetica,Arial" size=2>
<form  name="frmMain" method="post" action="archivio_cartella.php" onsubmit="return controlla_dati();" > 
 <a href="archivio_cartella.php" >Inserisci nuova voce</a>
   | <a href="archivio_main.php" >Ricerca una voce</a>
 <br><br>
 <FONT SIZE=3 ><b><?php echo $messaggio; ?></b></FONT>
 <FONT SIZE=2 >
<table>
	<br><br>
    <tr>
      <td>Numero Cartella:</td>
      <td><input type="text" name="numero" size="10" maxlength="10" value="<?php echo $var_numero; ?>" /> </td>
    </tr>
    <tr>
      <td>Cognome:</td>
      <td><input type="text" name="cognome" size="60" maxlength="60" value="<?php echo $var_cognome; ?>"/> 
      	  <a  href="javascript:cerca_paziente();"><img src="../../gui/img/common/default/b-write_addr.gif"></a>  
      </td>
    </tr>
    <tr>
      <td>Nome:</td>
      <td><input type="text" name="nome" size="60" maxlength="60" value="<?php echo $var_nome; ?>"/></td>
    </tr>    
    <tr>
    <td>Data Nascita:</td>
      <td><input type="text" name="data_nascita" size="10" maxlength="10" value="<?php echo $var_data_nascita; ?>"/><font size=2>[gg/mm/aaaa]</font></td>
    </tr>
      <td>Scatola:</td>
      <td><input type="text" name="scatola" size="30" maxlength="30" value="<?php echo $var_scatola; ?>"/></td>
    </tr>
    <tr>
      <td>Ritirato Da:</td>
      <td><input type="text" name="ritirato_da" size="60" maxlength="60" value="<?php echo $var_ritirato_da; ?>"/></td>
    </tr>
    <tr>
      <td>In data:</td>
      <td><input type="text" name="data_ritiro" size="10" maxlength="10" value="<?php echo $var_data_ritiro; ?>"/><font size=2>[gg/mm/aaaa]</font></td>
    </tr>
	<tr>
      <td>Tipo:</td>
      	<td><input CHECKED type="radio" name="tipo" value="A"/>Attuale
      		<input type="radio" name="tipo" value="S"/>Storico
   		</td>
    </tr>
	<tr>      
      <td><input type="submit" name="inviadati" value="<?php echo $testo_submit ?>"/>
      <td>	<input type="hidden" name="id" value="<?php echo $id; ?>" />
      		<input type="hidden" name="tipo_operazione" value="<?php echo $tipo_operazione; ?>"/> 
      </td>
   </td>
    </tr>        
 </table>
  
</form>
</FONT>

<!--fine parte principale della pagina-->
</td>	
</tr>
</tbody>
</table>
	<a href="../../main/startframe.php?lang=it"><img src="../../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24"  alt="" align="middle"></a>
	</td>
</tr>
<tr>
<td bgcolor=#cccccc height=70 colspan=2>
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf"><tr><td align="center">
  <table width="100%" bgcolor="ffffff" cellspacing=0 cellpadding=5>
   <tr>
	<td>

<script language="JavaScript">
<!-- Script Begin
function openCreditsWindow() {

	urlholder="../../language/it/it_credits.php?lang=it";
	creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
//  Script End -->
</script>

	
<font   SIZE=1  FACE="Arial" color=gray>
 <a href="http://www.care2x.com" target=_new>Deployment version 1.1 CARE 2X</a>::<a href="../../license.htm" target=_new>Licenza</a> :: 
 <a href=mailto:info@care2x.com>Contattaci</a> <font size=1 face="arial"> :: <a href="../../language/it/it_privacy.htm" target="pp">Tutela della Privacy: Le nostre regole di privacy</a> :: 
 <a href="../../docs/show_legal.php?lang=it" target="lgl">Legal</a> ::</font>

 <a href="javascript:openCreditsWindow()">Ringraziamenti</a> ::.<br></font>
</font>
	<font size=1 face="verdana,arial">
Page generation time: 0.093660831451416	</font>
     </td>
   <tr>
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
