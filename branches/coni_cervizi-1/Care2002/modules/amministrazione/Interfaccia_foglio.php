<?php
if ($_POST['cancella'])
header("Location:amministrazione.php");
else if($_POST['invio'])
{
header("Location:../../invoice/amministrazione/foglio_giornaliero.php?anno=".$_POST['anno']."&mese=".$_POST['mese']."&giorno=".$_POST['giorno']);
}
else if ($_POST['cancella'] && $_POST['invio'])
echo "<b><u><font face='Verdana'><font color='red'>Si e' verificata una situazione non prevista. Per andare avanti cliccare nuovamente sul menu' sulla sinistra e riprovare!</font></font></u></b>";
else
{
?>
<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 >
<table  width=100% border=0  cellpadding="0" cellspacing="0" >
	<tr>
	<td bgcolor="#99ccff" valing="top" height="28">
	<font  COLOR="#330066"  SIZE=+2  FACE="Arial">
<strong> &nbsp; Stampa foglio giornaliero</strong></font>
	</td>
	</tr>
</table>
</body>
<form name="dati" method="POST" scrollbar size="" action="">
<table cellspacing="10" cellpadding="10">
	<tr >
		<td align="center">
		<b>Attraverso tale operazione verra' stampato un foglio con le visite effettuate nella data che viene selezionata dal menu' sottostante. Tale foglio reca indicazione del paziente visitato, del tipo di prestazione clinica di cui ha goduto ed il medico che l'ha effettuata. Sara' presente uno spazio nel quale detto medico dovra' apporre la sua firma.
		</td>
	</tr>

	<tr>
		<td>
		<table width="450" height="300" border=0 align="center" cellspacing="15" background="../CONIServizi.jpg">
<tr>
	<td width="350" align="center" >
		
<b>Seleziona il giorno</b>
<br />
<select title="Giorno" name="giorno">
<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>
</td>

</tr>
<tr>
	<td width="350" align="center">
<b>Seleziona il mese</b>
<br />
<select title="Mese" name="mese">
<option>Gennaio</option>
<option>Febbraio</option>
<option>Marzo</option>
<option>Aprile</option>
<option>Maggio</option>
<option>Giugno</option>
<option>Luglio</option>
<option>Agosto</option>
<option>Settembre</option>
<option>Ottobre</option>
<option>Novembre</option>
<option>Dicembre</option>
</select>	
	</td>
	
</tr>
<tr>
	<td width="350" align="center">	
  <b>Seleziona l'anno iniziale</b>
<br />
<select title="anno" name="anno"> Mese
<option>2004</option>
<option>2005</option>
</select>
	</td>
	
</tr>	
	<tr>
		<td align="center">
		<b>Si e' certi di voler proseguire?</b>
		</td>
	</tr>
<tr align="center">
	<td>
	<input type="submit" name="invio" value="Invia" />
	<input type="submit" name="cancella" value="Cancella">
	<input type="reset" value="Resetta" />
	</td>
</tr>
</table>
		</td>
	</tr>
</table>

</form>
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
<?php
}
?>
