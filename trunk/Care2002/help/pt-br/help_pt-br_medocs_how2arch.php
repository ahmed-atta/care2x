
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Como pesquisar em arquivso sdm</b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="select") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero atualizar os documentos sdm mostrados</b></font>
<ul> <b>Passo : </b>Clique no botão <input type="button" value="Atualizar dados"> para começar a editar o documento.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu que começar uma nova pesquisa nos arquivos</b></font>
<ul> <b>Passo : </b>Clique no botão <input type="button" value="Nova pesquisa
nos arquivos"> para começar uma nova pesquisa.<br>
</ul>
<?php elseif(($src=="search")&&($x1)) : ?>
<b>Note</b>
<ul><?php if($x1==1) : ?>Se a procura achar um único resultado, o documento por
completo será mostrado imediatamento.<br>
		Entretano, se a procura achar vários resultados, uma lista será mostrada.<br>
		<?php endif ?>
		Para ver a informação para o paciente que você está procurando, clique tanto
no botão  <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>>
correspondente, ou
		no nome, ou Sobrenome ou data de admissão.
</ul>
<b>Nota</b>
<ul> Se você quiser começar uma nova pesquisa clique no botão <input
type="button" value="Nova pesquisa nos arquivos">.
</ul>
<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero listar todos os documentos sdm de um certo
departamento</b></font>
<ul> <b>Passo 1: </b>Entre com o cógido do departamento no campo
"Departamento:". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar"> para
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu estou procurando por um certo documento sdm de um certo
paciente</b></font>
<ul> <b>Passo 1: </b>Entre com a palavra-chave no campo correspondente. Pode ser 
uma palavra ou frase completa ou apenas algumas letras de uma palavra dos dados 
pessoais do paciente. <br>
		<ul><font size=1 color="#000099" >
		<b>Os campos a seguir podem ser preenchidos com uma palavra-chave:</b>
		<br> Número do paciente
		<br> Sobrenome
		<br> Nome
		<br> Data de nascimento
		<br> Endereço
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para 
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font 
color="#990000"><b>Eu quero listar todos os documentos sdm com uma certa 
seguradora</b></font>
<ul> <b>Passo 1: </b>Entre com as iniciais da seguradora no campo "Seguradora:". 
<br>
		<b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para 
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font 
color="#990000"><b>Eu quero listar todos os documentos sdm com certas 
informações adicionais de uma seguradora</b></font>
<ul> <b>Passo 1: </b>Entre com a palavra-chave no campo "Informações extra:". 
<br>
		<b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para 
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero listar todos os documentos sdm de paciente
MASCULINOS</b></font>
<ul> <b>Passo 1: </b>Clique no botão "<span style="background-color:yellow"
>Sexo <input type="radio" name="r" value="1">masculino</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero listar todos os documentos sdm paciente
FEMINIOS</b></font>
<ul> <b>Passo 1: </b>Clique no botão "<span style="background-color:yellow"
><input type="radio" name="r" value="1">feminino</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero listar todos os documentos sdm de pacientes que
receberam o aviso médico obrigatório</b></font>
<ul> <b>Passo 1: </b>Clique no botão "<span style="background-color:yellow"
>Opinião médica: <input type="radio" name="r" value="1">Sim</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero listar todos os documentos sdm de pacientes que NÂO
receberam o aviso médico obrigatório</b></font>
<ul> <b>Passo 1: </b>Clique no botão "<span style="background-color:yellow"
><input type="radio" name="r" value="1">Não</span>". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero listar todos os documentos sdm através de uma palavra-chave</b></font>
<ul> <b>Passo 1: </b>Entre com a palavra-chave no campo correspondente. Pode ser uma palavra ou frase por completa ou apenas algunas letras de
uma palavra. <br>
		<ul><font size=1 color="#000099" >
		<b>Exemplo:</b> Para a palavra-chave diagnóstica entre entre no campo "Diagnóstico".<br>
		<b>Exemplo:</b> Para a palavra-chave observação entre no campo "Observação" <br>
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero listar todos os documentos sdm escritos em uma data específicas</b></font>
<ul> <b>Passo 1: </b>Entre com a data do documento no campo "Documentado em:". <br>
		<ul><font size=1 color="#000099">
		<b>Dica:</b> Entre "T" ou "t" para automaticamente ter a data de hoje preenchida.<br>
		<b>Dica:</b> Entre "Y" ou "y" para automaticamente ter a data de ontem preenchida..<br>
		</font>
		</ul><b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para
começar a procura.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font
color="#990000"><b>Eu quero listar todos os documentos sdm escrito por uma certa pessoa</b></font>
<ul> <b>Passo 1: </b>Entre com todas ou as primeiras letras do nome da pessoa no campo "Documentado por:". <br>
		<b>Passo 2: </b>Deixe todos os outros campos vazio.<br>
		<b>Passo 3: </b>Clique no botão <input type="button" value="Procurar">  para
começar a procura.<br>
</ul>
<b>Nota</b>
<ul> Você pode combinar várias condiçoes de procura. Por exemplo: Se você quiser listar todos os paciente MASCULINOS que operaram em cirurgia plastica,
que tiveram recebido o obligatory medical advice, and who have
the therapy containing a word which starts with "lipo":<p>
		<b>Passo 1: </b>Entre com "plop" no campo "Departamento:". <br>
		<b>Passo 2: </b>Clique no botão "<span style="background-color:yellow"
>Sexo<input type="radio" name="r" value="1">masculino</span>".<br>
		<b>Passo 3: </b>Clique no botão "<span style="background-color:yellow"
>Medical advice:<input type="radio" name="r" value="1">Yes</span>".<br>
		<b>Passo 4: </b>Entre com "lipo" no campo "Terapia:". <br>
		<b>Passo 5: </b>Clique no botão <input type="button" value="Procurar">  para
começar a procura.<br>
</ul>
<b>Nota</b>
<ul> Se a procura achar um único resultado, a informação por completa será mostrada imediatamento.<br>
		Entretano, se a procura achar vários resultados, uma lista será mostrada.<br>
		Para ver a informação para o paciente que você está procurando, clique tanto no botão <img <?php echo createComIcon('../','r_arrowgrnsm.gif','0') ?>> correspondente, ou
		no nome, ou Sobrenome ou data de admissão.
</ul>

<?php endif ?>
<b>Nota</b>
<ul> Se você decidir cancelar a pesquisa clique no botão <input type="button"
value="Fechar">.
</ul>
</form>

