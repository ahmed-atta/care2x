<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?="Laboratory - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
Come inserire il grafico dei parametri di test</b>
</font>
<ul>      
 	<b>1: </b>Selezionare la casella <input type="checkbox" name="s" value="s" checked> che corrisponde al parametro desiderato per sceglierlo.<br>
		<b>2: </b>Per visualizzare più di un parametro per volta, selezionare le caselle corrispondenti.<br>
		<b>3: </b>Selezionare l'icona <img src="../img/chart.gif" width=16 height=17 border=0> per visualizzare il grafico.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
C'è un modo rapido per selezionare tutti i parametri?</b>
</font>
<ul>      
		<b>Sì!</b><br>
		<b>1: </b>Selezionare il bottone <img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 border=0> per scegliere tutti i parametri.<br>
</ul>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>
E per deselezionare tutti i parametri??</b>
</font>
<ul>      
		<b>1: </b>Selezionare il bottone <img src="../img/dwnArrowGrnLrg.gif" width=16 height=16 border=0 border=0> di nuovo. Questo deselezionerà tutti i parametri.<br>
</ul>
<?php endif ?>
<?php if($src=="graph") : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>Come si fa a tornare ai test senza grafici? </b></font>
<ul> <b>Nota: </b>Per tornare indietro, selezionare il bottone <img src="../img/it/it_back2.gif" border=0 align="absmiddle">.</ul>
<?php endif ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>How to close the laboratory <?=$x3 ?>? </b></font>
<ul> <b>Nota: </b>Per chiudere, selezionare il bottone <img src="../img/it/it_close2.gif" border=0 align="absmiddle">.</ul>
</form>
