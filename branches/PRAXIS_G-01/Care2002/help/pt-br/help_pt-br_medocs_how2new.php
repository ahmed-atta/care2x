<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como documentar um paciente no SDM</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>Pass 1</b>

<ul> Procure os dados b�sicos do paciente.<br>
		Entre em "Documente o paciente a seguir:" preenchendo qualquer uma das seguintes informa��es:<br>
		<Ul type="disc">
			<li>n�mero do paciente ou<br>
			<li>Sobrenome do paciente ou<br>
			<li>nome do paciente <br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>Dica:</b> Se o seu sistema � equipado com um sanner de c�digo de barras, clique no "Document the following patient:" e scanei o c�digo
		de barras do paciente. Pule o passo 2.
		</font>
		</ul>

</ul>
<b>Passo 2</b>

<ul> Clique no bot�o <input type="button" value="Procurar"> para come�ar a pesquisa.

</ul>
<b>Passo 3</b>
<ul> Se a procura achou um �nico resultado, um novo formul�rio de documento com os dados b�sicos do paciente ser�o mostrados.
		Se entretanto, a procura encontrar encontra v�rios resultados, uma lista ser� mostrada.
<?php endif ?>

<?php if(($src=="?")||($x1>1)) : ?>

 <br>Para documentar um paciente na lista,
		clique tanto no bot�o <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente, ou
		no sobrenome, ou nome, ou n�mero do pacinte, ou na data de admiss�o.
</ul>
<?php endif ?>

<?php if($src=="?") : ?>
<b>Passo 4</b>
<?php endif ?>

<?php if(($src!="?")&&($x1==1)) : ?>
<b>Passo 1</b>
<?php endif ?>
<?php if(($x1=="1")||($src=="?")) : ?>
<ul> Uma vez que um novo formul�rio de documento com os dados b�sicos do paciento � mostrado voc� pode:
		<Ul type="disc">
    	<li>entre informa��es adicionais sobre o seguro ou seguradora no campo "Informa��es extras:",<br>
		<li>clique "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Sim</span>" no bot�o "Opini�o M�dica" se o paciente recebeu o avis� m�dico obrigat�rio,<br>
		<li>clique "<span style="background-color:yellow" ><input type="radio" name="n" value="a">N�o</span>" no bot�o "Opini�o M�dica" se o paciente n�o recebeu o avis� m�dico obrigat�rio,<br>
		<li>entre com o relat�rio do diagnostico no campo "Diagn�stico:"<br>
		<li>entre com o relat�rio da terapia no campo "Terapia:",<br>
		<li>se necess�rio, mude a data do documento no campo "Documentado em:",<br>
		<li>se necess�rio, mude a nome no campo "Documentado por:",<br>
		<li>se necess�rio, entre com o n�mero chave no campo "N�mero chave:",<br>
		</ul>
</ul>
<b>Nota</b>
<ul> Se voc� decidir apagar suas entradas clique no bot�o <input type="button" value="Resetar">.
</ul>

<b>Passo <?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> Clique no bot�o <input type="button" value="Salvar"> para salvar o documento.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Se voc� decidir cancelar o documento clique no bot�o <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.

</ul>


</form>

