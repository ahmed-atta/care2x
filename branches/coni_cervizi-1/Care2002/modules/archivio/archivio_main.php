<?php
	//devo includere questi files per effettuare le query sul db 
	require('./roots.php');
	require('../../include/inc_environment_global.php');
?>

<?php
/*********************************************************************************
*
*			Parte di script per la visualizzazione dei risultati della ricerca cartella
*
**********************************************************************************/
$tabellaHTML='';

//Se ho effettuato una ricerca visualizzo la tabella con i risultati
if ($_POST['tipo_op']=='CERCA') 
{ 	
	//parametri di ricerca
	$var_numero= $_POST['numero'];
	$var_cognome= $_POST['cognome'];
	$var_nome= $_POST['nome'];
	$var_scatola= $_POST['scatola'];
	
	//tutti gli * dei parametri di ricerca vengono tradotti in %
	$var_numero= str_replace('*', '%', $var_numero);
	$var_cognome= str_replace('*', '%', $var_cognome);
	$var_nome= str_replace('*', '%', $var_nome);
	$var_scatola= str_replace('*', '%', $var_scatola);
	
	//esegue la ricerca delle cartelle
	$sSQL = "SELECT * FROM care_archivio WHERE numero LIKE \"".$var_numero."%\" ".
			"AND cognome LIKE \"".$var_cognome."%\" AND nome LIKE \"".$var_nome."%\" ".
			"AND scatola LIKE \"".$var_scatola."%\"";
	
		
	$risultati=$db->Execute($sSQL);
	
	//compila la tabella HTML dei risultati
	$tabellaHTML="<HR><TABLE><TR bgcolor=#99ccff><TD>Numero</TD><TD>Cognome</TD><TD>Nome</TD><TD>Data Nascita</TD><TD>Scatola</TD><TD></TD>\n";
	
	//variabile booleana per il colore alternato delle righe
	$coloriga = true;
	
	//scrive le cartelle trovate
	while ($riga=$risultati->FetchRow()){
	
		if ($coloreriga) $colore="bgcolor=#efefef";
		else $colore="bgcolor=#ffffff"; 
		$coloreriga= !$coloreriga;
		
		//converte il formato della data di nascita
		$data_nascita=  substr($riga['data_nascita'],8,2)."/".substr($riga['data_nascita'],5,2)."/".substr($riga['data_nascita'],0,4);
				
		$tabellaHTML.="<TR $colore >\n";
		$tabellaHTML.="<TD>".$riga['numero']."</TD>\n";		
		$tabellaHTML.="<TD>".$riga['cognome']."</TD>\n";		
		$tabellaHTML.="<TD>".$riga['nome']."</TD>\n";
		$tabellaHTML.="<TD>".$data_nascita."</TD>\n";
		$tabellaHTML.="<TD>".$riga['scatola']."</TD>\n";
 		$tabellaHTML.="<TD><A HREF='./archivio_cartella.php?id=".$riga['id']."' >";
 		$tabellaHTML.="<IMG SRC='../../gui/img/control/default/it/it_ok_small.gif' border=0 width='105' height='16' ></A>\n";		
		$tabellaHTML.="</TD></TR>\n";
	}
	
	//chiude la tabella dei risultati
	$tabellaHTML.= "</TABLE>\n";
}
?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
		</style>
		<script language="JavaScript">
		<!--
		function popPic(nd,fn){
			regpicwindow = window.open("../../main/pop_reg_pic.php?sid=8871309d69cbc4fbcba9c66435c6e6ae&lang=it&nm="+nd+"&fn="+fn,"regpicwin","toolbar=no,scrollbars,width=180,height=250");
		}
		// -->
		</script>
		<script language="JavaScript" src="../../js/sublinker-nd.js">
		</SCRIPT>

	<script language="JavaScript" type="text/javascript" src="jslibreria.js"></script>
	<script language="JavaScript" >
  
	//funzione che verifica che sia inserito almeno un parametro di ricerca.
	function controlla_dati()
	{
		var stringa1;	
		var stringa2;
		var stringa3;
		var stringa4;
		var msg='';
	
		//Deve esser indicato almeno un campo di ricerca	
		stringa1 = new String(window.document.frmMain.numero.value);
		stringa2 = new String(window.document.frmMain.cognome.value);
		stringa3 = new String(window.document.frmMain.nome.value);
		stringa4 = new String(window.document.frmMain.scatola.value);
		if (stringa1.Trim()=='' && stringa2.Trim()=='' && stringa3.Trim()=='' && stringa4.Trim()=='') 
			msg = msg + 'Indicare almeno un campo per la ricerca delle cartelle';
		
		
	if (msg!='') {
		window.alert (msg);
		return false;
	}else return true;
} 

</script>
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
			<td bgcolor=#ffffff valign=top colspan=2><p><br><ul>
				<font face="Verdana,Helvetica,Arial" size=3 color="#990000"><b>Archivio cartelle</b></font>
 				<table cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        			<tbody>
        			<tr>
          				<td>
            				<table cellSpacing=1 cellPadding=3 width=600 bgColor=#999999 border=0>
              		<tbody>
 						<tr bgColor=#eeeeee>
 						 
                			<td vAlign=top width=180><font face="Verdana,Helvetica,Arial" size=2><b><nobr>
				 				<img src="../../gui/img/common/default/blaupfeil.gif" border=0 align="middle" width="4" height="7">  
 								<a href="archivio_cartella.php" >Inserisci nuova voce</a><br>
				  				</nobr></b></font>
				  			</td>
			                <td>
			                	<font face="Verdana,Helvetica,Arial" size=2>Inserisce una nuova cartella nell'archivo</font>
			                </td>
						</tr> 
               			<tr bgColor=#eeeeee>
                		<td vAlign=top width=180><font face="Verdana,Helvetica,Arial" size="2"><b><nobr>
				 			<img src="../../gui/img/common/default/blaupfeil.gif" border=0 align="middle" width="4" height="7">Ricerca una voce</a><br>
				  			</nobr></b>
				  		</td>
                		<td>
                			<font face="Verdana,Helvetica,Arial" size="2"> 
 							Ricerca una nuova cartella nell'archivio per
							<form name="frmMain" method="post" onsubmit="return controlla_dati();"><br>
								<table>
									<tr>
										Cognome:<input type="text" name="cognome"  maxlength="60"/>
									</tr>
									<tr>
										Nome:<input type="text" name="nome"  maxlength="60"/>
									</tr>
									<tr>
										Numero Cartella:<input type="text" name="numero"  maxlength="10"/>
									</tr>
									<tr>
										Scatola:<input type="text" name="scatola"  maxlength="30"/>
									</tr>
								</table>
							</font><br>
							<input type="submit" value="Ricerca" name="cerca_archivio" />							
							<input type="hidden" name="tipo_op" value="CERCA"/>
							</form>							
						</td>
					</tr> 
					</tbody>
					</td>
					</tr>
				</tbody>
		</table>
	</td>
</tr>
</tbody>

</table>
<br><br>
<font face=Arial size=2> 
<!--  
		Inserisce la tabella HTML con i risultati della ricerca
-->
<?php echo ($tabellaHTML); ?>
</font>
<p>
<a href="../../main/startframe.php?lang=it"><img src="../../gui/img/control/default/it/it_close2.gif" border=0 width="103" height="24"  alt="" align="middle"></a>
<p>
</ul>

<p>
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

	
<font    SIZE=1  FACE="Arial" color=gray>
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
