<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Come fare a: 
<?php
switch($x1)
{
 	case "search": print 'cercare un numero di telefono'; break;
	case "dir": print 'aprire l'elenco telefonico';break;
	case "newphone": print 'inserire un nuovo telefono';break;
 }
 ?></b></font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($x1=="search") : ?>
	<?php if($src=="newphone") : ?>
	<b>1</b>
	<ul> Selezionare il bottone <img src="../img/en/en_such-gray.gif" border="0">.
	</ul>
	<?php endif ?>
<b><?php if($src=="newphone") print "2"; else print "1"; ?></b>

<ul>Inserire l'elemento da cercare (bastano poche lettere) nel campo "<span style="background-color:yellow" >Nuova ricerca</span>"; per esempio si possono
iserire il dipartimento, il nome o il cognome.
		<br>Example 1: enter "m9a" or "M9A" or "M9".
		<br>Example 2: enter "Rossi" or "ros".
		<br>Example 3: enter "Mario" or "mar".
		<br>Example 4: enter "op11" or "OP11" or "op".
</ul>
<b><?php if($src=="newphone") print "3"; else print "2"; ?></b>
<ul> Selezionare il bottone <input type="button" value="SEARCH"> per avviare la ricerca.<p>
</ul>
<b><?php if($src=="newphone") print "4"; else print "3"; ?></b>
<ul> Se la ricerca trova dei dati, apparirà un elenco.<p>
</ul>
<?php endif ?>
<?php if($x1=="dir") : ?>
<b>1</b>
<ul> Selezionare il bottone <img src="../img/en/en_phonedir-gray.gif" border="0">.
</ul>
<?php endif ?>
<?php if($x1=="newphone") : ?>
	<?php if($src=="search") : ?>
<b>1</b>
<ul> Selezionare il bottone <img src="../img/en/en_newdata-gray.gif" border="0">.
</ul>
<b>2</b>
<ul> Se si è fatto login precedentemente e si hanno i privilegi di accesso sufficienti,
nella finestra centrale apparirà il modulo da compilare per inserire un nuovo
telefono.<br>
		Se invece non si è ancora effettuato il login, verrà richiesto di inserire username e password. <p>
	<?php endif ?>
		Inserire username e password, poi selezionare il bottone <img src="../img/en/en_continue.gif" border=0>.<p>
</ul><?php endif ?>
<b>Nota</b>
<ul> Per 
<?php
switch($x1)
{
 	case "search": print ' annullare la ricerca selezionare il bottone <img src="../img/en/en_cancel.gif" border=0>.'; break;
	case "dir": print ' chiudere l''elenco selezionare il bottone <input type="button" value="Annulla">.';break;
	case "newphone": print ' annullre selezionare il bottone <img src="../img/en/en_cancel.gif" border=0>.';break;
 }
 ?>
</ul>
</form>
