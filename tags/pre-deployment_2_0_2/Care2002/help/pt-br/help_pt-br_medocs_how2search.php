<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como procurar um documento sdm</b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if(($src=="?")||($x1=="0")) : ?>
<b>Passo 1</b>

<ul> Entre em "<span style="background-color:yellow" >documentos sdm de:</span>" campo field either a full information or a few letters from a patient's information, like for example patient's number, or name, or Given name.
		<p>Example 1: enter "21000012" or "12".
		<br>Example 2: enter "Guerero" or "gue".
		<br>Example 3: enter "Alfredo" or "Alf".

</ul>
<b>Passo 2</b>
<ul> Clique no botão <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>>  para começar a procurar.<p>
</ul>
<b>Passo 3</b>
<ul> Se a procura achar um único resultado, será mostrado por completo um documento sdm.
		Se entretanto, a procura achar vários resultados, uma lista será mostrada.<p>
		Para ver o documento sdm do paciente que você está procurando, clique no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente, ou
		no sobrenome, ou no número do documento, ou data.
</ul>
<?php endif ?>
<?php if($x1>1) : ?>
		Para ver o documento sdm do paciente que você está procurando, clique no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente, ou
		no sobrenome, ou no número do documento, ou data.<p>
<?php endif ?>
<?php if(($src!="?")&&($x1=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero atualizar o documento</b></font>
<ul> Se voce quiser atualizar a visualizaçaõ do documento, clique no botão <input type="button" value="Atualizar dados">.
</ul>
<?php endif ?>
<b>Nota</b>
<ul> Se você decidir canclear a procura clique no botão <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>


</form>

