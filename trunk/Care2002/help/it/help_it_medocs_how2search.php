<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come cercare un medoc</b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>1</b>

<ul> Inserire nel campo "<span style="background-color:yellow" >medoc di:</span>" qualche dato del paziente, per esempio il codice o il nome
(bastano poche lettere).
		<p>Esempio 1: inserire "21000012" o "12".
		<br>Esempio 2: inserire "Rossi" o "ros".
		<br>Esempio 3: inserire "Mario" o "mar".
</ul>
<b>2</b>
<ul> Selezionare il bottone <img src="../img/it/it_searchlamp.gif" border=0> per avviare la ricerca.<p>
</ul>
<b>3</b>
<ul> Se la ricerca trova un solo medoc, questo sar� immediatamente mostrato.
Se ne vengono trovati pi� di uno, apparir� una lista per la selezione..<p>
Per visualizzare i documenti del paziente desiderato, selezionare il bottone <img src="../img/R_arrowGrnSm.gif" border=0 height=12> corrispondente,
oppure il cognome, il codice del documento o la data.
</ul>
<?php endif ?>
<?php if($x1>1) : ?>
Per visualizzare i documenti del paziente desiderato, selezionare il bottone <img src="../img/R_arrowGrnSm.gif" border=0 height=12> corrispondente,
oppure il cognome, il codice del documento o la data.
<?php endif ?>
<?php if(($src!="?")&&($x1=="1")) : ?>
<img src="../img/frage.gif" border=0 align="absmiddle"> <font color="#990000"><b>Desidero aggiornare il documento</b></font>
<ul> Per aggiornare il documento visualizzato, selezionare il bottone <input type="button" value="Update data">.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Per annullare la ricerca, selezionare il bottone <img src="../img/it/it_close2.gif" border=0>.
</ul>
</form>
