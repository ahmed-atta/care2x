<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como documentar um paciente no SDM</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="?") : ?>
<b>Pass 1</b>

<ul> Procure os dados básicos do paciente.<br>
		Entre em "Documente o paciente a seguir:" preenchendo qualquer uma das seguintes informações:<br>
		<Ul type="disc">
			<li>número do paciente ou<br>
			<li>Sobrenome do paciente ou<br>
			<li>nome do paciente <br>
		<font size=1 color="#000099" face="verdana,arial">
		<b>Dica:</b> Se o seu sistema é equipado com um sanner de código de barras, clique no "Document the following patient:" e scanei o código
		de barras do paciente. Pule o passo 2.
		</font>
		</ul>

</ul>
<b>Passo 2</b>

<ul> Clique no botão <input type="button" value="Procurar"> para começar a pesquisa.

</ul>
<b>Passo 3</b>
<ul> Se a procura achou um único resultado, um novo formulário de documento com os dados básicos do paciente serão mostrados.
		Se entretanto, a procura encontrar encontra vários resultados, uma lista será mostrada.
<?php endif ?>

<?php if(($src=="?")||($x1>1)) : ?>

 <br>Para documentar um paciente na lista,
		clique tanto no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente, ou
		no sobrenome, ou nome, ou número do pacinte, ou na data de admissão.
</ul>
<?php endif ?>

<?php if($src=="?") : ?>
<b>Passo 4</b>
<?php endif ?>

<?php if(($src!="?")&&($x1==1)) : ?>
<b>Passo 1</b>
<?php endif ?>
<?php if(($x1=="1")||($src=="?")) : ?>
<ul> Uma vez que um novo formulário de documento com os dados básicos do paciento é mostrado você pode:
		<Ul type="disc">
    	<li>entre informações adicionais sobre o seguro ou seguradora no campo "Informações extras:",<br>
		<li>clique "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Sim</span>" no botão "Opinião Médica" se o paciente recebeu o avisõ médico obrigatório,<br>
		<li>clique "<span style="background-color:yellow" ><input type="radio" name="n" value="a">Não</span>" no botão "Opinião Médica" se o paciente não recebeu o avisõ médico obrigatório,<br>
		<li>entre com o relatório do diagnostico no campo "Diagnóstico:"<br>
		<li>entre com o relatório da terapia no campo "Terapia:",<br>
		<li>se necessário, mude a data do documento no campo "Documentado em:",<br>
		<li>se necessário, mude a nome no campo "Documentado por:",<br>
		<li>se necessário, entre com o número chave no campo "Número chave:",<br>
		</ul>
</ul>
<b>Nota</b>
<ul> Se você decidir apagar suas entradas clique no botão <input type="button" value="Resetar">.
</ul>

<b>Passo <?php if($src!="?") print "2"; else print "5"; ?></b>
<ul> Clique no botão <input type="button" value="Salvar"> para salvar o documento.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Se você decidir cancelar o documento clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.

</ul>


</form>

