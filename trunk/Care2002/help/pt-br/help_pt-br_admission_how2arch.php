<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como pesquisar em arquivos</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero atualizar dos dados mostrados</b></font>
<ul> <b>Passo : </b>Clique no botão <input type="button" value="Atualizar dado"> para começar a editão dos dados.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero começar uma nova procura nos arquivos</b></font>
<ul> <b>Passo : </b>Clique no botão <input type="button" value="New research in archive"> para começar uma nova procura.<br>
</ul>
<?php elseif($src=="search") : ?>
<b>Nota</b>
<ul> Se a procura achar um único resultado, a informação por completa será mostrada imediatamento.<br>
		Entretano, se a procura achar vários resultados, uma lista será mostrada.<br>
		Para ver a informação para o paciente que você está procurando, clique tanto no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente, ou
		no nome, ou Sobrenome ou data de admissão.
</ul>
<b>Nota</b>
<ul> Se você quiser começar uma nova pesquisa clique no botão <input type="button" value="Nova pesquisa no arquivo">.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero lista todos os paciente admitidos hoje</b></font>
<ul> <b>Passo 1: </b>Entre com a data de hoje no campo "Data de admissão: de:". <br>
		<ul><font size=1 color="#000099">
		<b>Dica:</b> Entre "T" ou "t" para automaticamente ter a data de hoje preenchida.<br>
		</font>
		</ul><b>Passo 2: </b>Deixe o campo "para:" vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os pacientes admitidos entre duas datas incluíndo-as</b></font>
<ul> <b>Passo 1: </b>Entre com a data inicial no campo "Data de admissão: de:". <br>
		<ul><font size=1 color="#000099">
		<b>Dica:</b> Entre "T" ou "t" para automaticamente ter a data de hoje preenchida.<br>
		<b>Dica:</b> Entre "Y" ou "y" para automaticamente ter a data de ontem preenchida..<br>
		</font>
		</ul><b>Passo 2: </b>Entre com a data final no campo "para:".<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero lista todos os pacientes MASCULINOS admitidos</b></font>
<ul> <b>Passo 1: </b>Clique no botão "Sexo <input type="radio" name="r" value="1">masculino". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero lista todos os pacientes FEMINIAS admitidos </b></font>
<ul> <b>Passo 1: </b>Clique no botão "<input type="radio" name="r" value="1">feminino". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os pacientes particulares </b></font>
<ul> <b>Passo 1: </b>Clique no botão "<input type="radio" name="r" value="1">Particular". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os pacientes com seguro privado </b></font>
<ul> <b>Passo 1: </b>Clique no botão "<input type="radio" name="r" value="1">Privado". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os pacientes com seguro publico </b></font>
<ul> <b>Passo 1: </b>Clique no botão "<input type="radio" name="r" value="1">Seguro". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu que listar todos os pacientes com planos de saúde</b></font>
<ul> <b>Passo 1: </b>Clique no botão "<input type="radio" name="r" value="1"> Seguro". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazios<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu quero listar todos os pacientes com uma palavra-chave</b></font>
<ul> <b>Passo 1: </b>Entre com a palavra chave no campo correspondente. Pode ser uma palavra ou frase completa ou apenas algumas letras de uma palavra. <br>
		<ul><font size=1 color="#000099" >
		<b>Exemplo:</b> Para a palavra-chave diagnóstica entre entre no campo "Diagnóstico".<br>
		<b>Exemplo:</b> Para a palavra-chave recomendar entre no campo "Recomendado por " .<br>
		<b>Exemplo:</b> Para a palavra-chave observação entre no campo "Observação" .<br>
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos vazios<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Eu estou procurando um certo paciente com uma palavra-chave</b></font>
<ul> <b>Passo 1: </b>Entre com a palavra-chave no campo correspondente. Pode ser uma palavra ou frase completa ou apenas algumas letras de uma palavra. <br>
		<ul><font size=1 color="#000099" >
		<b>Os campos a seguir podem ser preenchidos com uma palavra-chave:</b>
		<br> Número do paciente
		<br> Sobrenome
		<br> Nome
		<br> Data de nascimento
		<br> Endereço
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos vazios<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<b>Nota</b>
<ul> Você pode combinar várias condiçoes de procura. Por exemplo: Se você quiser listar todos os pacientes MASCULINOS que foram admitidos
		entre 10.12.1999 e 24.01.2001 inclusive:<p>
		<b>Passo 1: </b>Entre "10.12.1999" no campo "Data de admissão: de:". <br>
		<b>Passo 2: </b>Entre "24.01.2001 no campo "para:".<br>
		<b>Passo 3: </b>Clique no botão "Sexo <input type="radio" name="r" value="1">masculino". <br>
		<b>Passo 4: </b>Clique no botão <input type="button" value="PROCURAR">  para iniciar a procura.<br>
</ul>
<b>Nota</b>
<ul> Se a procura achar um único resultado, a informação por completa será mostrada imediatamento.<br>
		Entretano, se a procura achar vários resultados, uma lista será mostrada.<br>
		Para ver a informação para o paciente que você está procurando, clique tanto no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente, ou
		no nome, ou Sobrenome ou data de admissão.
</ul>

<?php endif ?>
<b>Nota</b>
<ul> Se você decidir cancelar a pesquisa clique no botão <input type="button" value="Cancelar">.
</ul>
</form>

