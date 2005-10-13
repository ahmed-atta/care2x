<?php

	/**
	 * Brazilian Portuguese language file for phpPgAdmin.
	 * @maintainer �ngelo Marcos Rigo (angelo_rigo@yahoo.com.br)
	 *
	 * $Id$
	 */

	// Language and character set
	$lang['applang'] = 'Portugu�s-Brasileiro';
	$lang['appcharset'] = 'ISO-8859-1';
	$lang['applocale'] = 'pt_BR';
  	$lang['appdbencoding'] = 'LATIN1';
  
	// Basic strings
	$lang['strintro'] = 'Bem-vindo ao phpPgAdmin.';	
$lang['strppahome'] = 'P�gina inicial phpPgAdmin ';
$lang['strpgsqlhome'] = 'P�gina inicial PostgreSQL ';
$lang['strpgsqlhome_url'] = 'http://www.postgresql.org/';
$lang['strreportbug'] = 'Reportar um Bug';
$lang['strviewfaq'] = 'Visualizar FAQ';
$lang['strviewfaq_url'] = 'http://phppgadmin.sourceforge.net/?page=faq';
	$lang['strlogin'] = 'Identifica��o';					
	$lang['strloginfailed'] = 'Falha na identifica��o';		
	$lang['strserver'] = 'Servidor';					
	$lang['strlogout'] = 'Deslogar';					
	$lang['strowner'] = 'Propiet�rio';					
	$lang['straction'] = 'A��o';					
	$lang['stractions'] = 'A��es';				
	$lang['strname'] = 'Nome';						
	$lang['strdefinition'] = 'Defini��o';		
	$lang['stroperators'] = 'Operadores';			
	$lang['straggregates'] = 'Agregados';			
	$lang['strproperties'] = 'Propriedades';			
	$lang['strbrowse'] = 'Navegar';					
	$lang['strdrop'] = 'Deletar';						
	$lang['strdropped'] = 'Deletado';				
	$lang['strnull'] = 'Nulo';						
	$lang['strnotnull'] = 'N�o Nulo';				
	$lang['strprev'] = 'Anterior';						
	$lang['strnext'] = 'Pr�ximo';							
	$lang['strfailed'] = 'Falha';					
	$lang['strcreate'] = 'Criar';					
	$lang['strcreated'] = 'Criado';				
	$lang['strcomment'] = 'Coment�rio';				
	$lang['strlength'] = 'Extens�o';					
	$lang['strdefault'] = 'Padr�o';				
	$lang['stralter'] = 'Alterar';					
	$lang['strok'] = 'OK';							
	$lang['strcancel'] = 'Cancelar';					
	$lang['strsave'] = 'Salvar';						
	$lang['strreset'] = 'Reiniciar';					
	$lang['strinsert'] = 'Inserir';					
	$lang['strselect'] = 'Selecionar';					
	$lang['strdelete'] = 'Deletar';					
	$lang['strupdate'] = 'Atualizar';				
	$lang['strreferences'] = 'Refer�ncias';			
	$lang['stryes'] = 'Sim';						
	$lang['strno'] = 'N�o';							
	$lang['stredit'] = 'Editar';					
	$lang['strcolumns'] = 'Colunas';				
	$lang['strrows'] = 'Linha(s)';					
	$lang['strrowsaff'] = 'Linha(s) afetadas.';		
	$lang['strexample'] = 'eg.';					
	$lang['strback'] = 'Voltar';						
	$lang['strqueryresults'] = 'Resultados da pesquisa';		
	$lang['strshow'] = 'Exibir';						
	$lang['strempty'] = 'Vazio';					
	$lang['strlanguage'] = 'Linguagem';				
	$lang['strencoding'] = 'Codifica��o';				
	$lang['strvalue'] = 'Valor';					
	$lang['strunique'] = '�nico';					
	$lang['strprimary'] = 'Prim�rio';				
	$lang['strexport'] = 'Exportar';				
	$lang['strsql'] = 'SQL';						
	$lang['strgo'] = 'Ir';							
$lang['strimport'] = 'Importar';
	$lang['stradmin'] = 'Administrador';					
	$lang['strvacuum'] = 'V�cuo';					
	$lang['stranalyze'] = 'Analiza';				
	$lang['strcluster'] = 'Cluster';				
	$lang['strreindex'] = 'Reordenar';				
	$lang['strrun'] = 'Rodar';						
	$lang['stradd'] = 'Adicionar';						
	$lang['strevent'] = 'Evento';					
	$lang['strwhere'] = 'Onde';					
	$lang['strinstead'] = 'Fazer ao inv�s';				
	$lang['strwhen'] = 'Quando';						
	$lang['strformat'] = 'Formato';					

	// Error handling
$lang['strdata'] = 'Data';
$lang['strconfirm'] = 'Confirmar';
$lang['strexpression'] = 'Express�o';
$lang['strellipsis'] = '...';
$lang['strexpand'] = 'Expandir';
$lang['strcollapse'] = 'Diminuir';
	$lang['strnoframes'] = 'Voc� necessita um navegador com suporte a frames para utilizar esta aplica��o.';
	$lang['strbadconfig'] = 'Seu config.inc.php est� desatualizado. Voc� deve ger�-lo novamente a partir do novo config.inc.php-dist.';
	$lang['strnotloaded'] = 'Voc� n�o compilou suporte � banco de dados apropriado em sua instala��o do PHP.';
	$lang['strbadschema'] = 'Esquema inv�lido especificado.';
	$lang['strbadencoding'] = 'Falha ao definir codifica��o do cliente no banco de dados.';
	$lang['strsqlerror'] = 'Erro de SQL:';
	$lang['strinstatement'] = 'Indica��o de entrada :';
	$lang['strinvalidparam'] = 'Par�metros de script inv�lidos.';
	$lang['strnodata'] = 'N�o foram encontradas linhas.';

	// Tables
	$lang['strtable'] = 'Tabela';
	$lang['strtables'] = 'Tabelas';
	$lang['strshowalltables'] = 'Exibir todas as tabelas';
	$lang['strnotables'] = 'Tabelas n�o encontradas .';
	$lang['strnotable'] = 'Tabela n�o encontradas.';
	$lang['strcreatetable'] = 'Criar tabela';
	$lang['strtablename'] = 'Nome da tabela ';
	$lang['strtableneedsname'] = 'Voc� deve dar um nome � sua tabela.';
	$lang['strtableneedsfield'] = 'Voc� deve especificar pelo menos um campo.';
	$lang['strtableneedscols'] = 'Tabelas requerem um n�mero v�lido de colunas.';
	$lang['strtablecreated'] = 'Tabela criada.';
	$lang['strtablecreatedbad'] = 'Falha na cria��o de tabela.';
	$lang['strconfdroptable'] = 'Tem certeza que quer deletar a tabela "%s"?';
	$lang['strtabledropped'] = 'Tabela deletada.';
	$lang['strtabledroppedbad'] = 'Falha na dele��o de tabela.';
	$lang['strconfemptytable'] = 'Tem certeza que quer esvaziar a tabela "%s"?';
	$lang['strtableemptied'] = 'Tabela esvaziada.';
	$lang['strtableemptiedbad'] = 'Falha no esvaziamento de tabela.';
	$lang['strinsertrow'] = 'Inserir linha';
	$lang['strrowinserted'] = 'Linha inserida.';
	$lang['strrowinsertedbad'] = 'Falha ao inserir linha.';
	$lang['streditrow'] = 'Editar linha';
	$lang['strrowupdated'] = 'Linha modificada.';
	$lang['strrowupdatedbad'] = 'Falha na modifica��o de linha.';
	$lang['strdeleterow'] = 'Deletar linha';
	$lang['strconfdeleterow'] = 'Tem certeza que quer deletar esta linha?';
	$lang['strrowdeleted'] = 'Linha deletada.';
	$lang['strrowdeletedbad'] = 'Falha na dele��o de linha .';
	$lang['strsaveandrepeat'] = 'Salve & Repita';
	$lang['strfield'] = 'Campo';
	$lang['strfields'] = 'Campos';
	$lang['strnumfields'] = 'N�mero de campos';
	$lang['strfieldneedsname'] = 'Voc� deve nomear seu campo';
	$lang['strselectneedscol'] = 'Voc� deve exibir ao menos uma coluna';
	$lang['straltercolumn'] = 'Alterar coluna';
	$lang['strcolumnaltered'] = 'Coluna altereda.';
	$lang['strcolumnalteredbad'] = 'Falha na altera��o de coluna.';
	$lang['strconfdropcolumn'] = 'Tem certeza que quer deletar a coluna "%s" da tabela "%s"?';
	$lang['strcolumndropped'] = 'Coluna deletada.';
	$lang['strcolumndroppedbad'] = 'Dele��o de coluna falhou.';
	$lang['straddcolumn'] = 'Adicione coluna';
	$lang['strcolumnadded'] = 'Coluna adicionada.';
	$lang['strcolumnaddedbad'] = 'Adi��o de coluna falhou.';
	$lang['strschemaanddata'] = 'Esquema & Dados';
	$lang['strschemaonly'] = 'Esquema apenas';
	$lang['strdataonly'] = 'Dados apenas';

	// Users
$lang['strcascade'] = 'CASCATA';
	$lang['struseradmin'] = 'Administra��o de usu�rio ';
	$lang['struser'] = 'Usu�rio';
	$lang['strusers'] = 'Usu�rios';
	$lang['strusername'] = 'Nome de usu�rio';
	$lang['strpassword'] = 'Senha';
	$lang['strsuper'] = 'Superusu�rio?';
	$lang['strcreatedb'] = 'Criar DB?';
	$lang['strexpires'] = 'Expira';
	$lang['strnousers'] = 'Usu�rios n�o encontrados.';
    $lang['struserupdated'] = 'Usu�rio alterado.';
	$lang['struserupdatedbad'] = 'Altera��o de usu�rio falhou.';
	$lang['strshowallusers'] = 'Exibir todos os usu�rios';
	$lang['strcreateuser'] = 'Criar Usu�rio';
	$lang['strusercreated'] = 'Usu�rio criado.';
	$lang['strusercreatedbad'] = 'Falhou ao criar usu�rio.';
	$lang['strconfdropuser'] = 'Tem certeza que quer deletar o usu�rio "%s"?';
	$lang['struserdropped'] = 'Usu�rio deletado.';
	$lang['struserdroppedbad'] = 'Falha ao deletar usu�rio.';
		
	// Groups
$lang['straccount'] = 'Conta';
$lang['strchangepassword'] = 'Alterar senha';
$lang['strpasswordchanged'] = 'Senha alterada.';
$lang['strpasswordchangedbad'] = 'Falha ao alterar senha.';
$lang['strpasswordshort'] = 'Senha muito curta.';
$lang['strpasswordconfirm'] = 'Senha n�o confere com a confirma��o.';
	$lang['strgroupadmin'] = 'Administra��o de Grupo';
	$lang['strgroup'] = 'Grupo';
	$lang['strgroups'] = 'Grupos';
	$lang['strnogroups'] = 'Grupos n�o encotrados.';
	$lang['strshowallgroups'] = 'Exibir todos os grupos';
	$lang['strgroupneedsname'] = 'Voc� deve dar um nome ao seu grupo.';
	$lang['strgroupcreated'] = 'Grupo criado.';
	$lang['strgroupcreatedbad'] = 'Falha na cria��o de grupo.';	
	$lang['strconfdropgroup'] = 'Tem certeza que quer deletar o grupo "%s"?';
	$lang['strgroupdropped'] = 'Grupo deletado.';
	$lang['strgroupdroppedbad'] = 'Falha ao deletar grupo.';
	$lang['strmembers'] = 'Membros';

	// Privilges
	$lang['strprivilege'] = 'Privil�gio';
	$lang['strprivileges'] = 'Privil�gios';
	$lang['strnoprivileges'] = 'Este objeto tem privil�gios padr�es de propriet�rio.';
	$lang['strgrant'] = 'Concede';
	$lang['strrevoke'] = 'Revoga';
	$lang['strgranted'] = 'Privil�gios concedidos.';
	$lang['strgrantfailed'] = 'Falha ao conceder privil�gios.';
$lang['strgrantbad'] = 'Voc� deve especificar ao menos um usu�rio ou grupo e ao menos um privil�gio.';
$lang['stralterprivs'] = 'Alterar privil�gios';

	// Databases
	$lang['strdatabase'] = 'Banco de dados';
	$lang['strdatabases'] = 'Banco de dados';
	$lang['strshowalldatabases'] = 'Exibir todos os banco de dados';
	$lang['strnodatabase'] = 'Banco de dado n�o encontrado.';
	$lang['strnodatabases'] = 'Bancos de dados n�o encontrados.';
	$lang['strcreatedatabase'] = 'Criar banco de dados';
	$lang['strdatabasename'] = 'Nome do banco de dados';
	$lang['strdatabaseneedsname'] = 'Voc� deve dar um nome ao seu banco de dados.';
	$lang['strdatabasecreated'] = 'Banco de dados criado.';
	$lang['strdatabasecreatedbad'] = 'Falhou na cria��o de Banco de dados.';	
	$lang['strconfdropdatabase'] = 'Tem certeza que quer deletar o banco de dados"%s"?';
	$lang['strdatabasedropped'] = 'Banco de dados deletado.';
	$lang['strdatabasedroppedbad'] = 'Falha na dele��o de banco de dados.';
	$lang['strentersql'] = 'Digite a cl�usula SQL a ser executada abaixo :';
	$lang['strsqlexecuted'] = 'SQL executado.';
	$lang['strvacuumgood'] = 'V�cuo completo.';
	$lang['strvacuumbad'] = 'Falha ao executar v�cuo.';
	$lang['stranalyzegood'] = 'An�lize completa.';
	$lang['stranalyzebad'] = 'Falha ao executar an�lize.';

	// Views
	$lang['strview'] = 'Visualiza��o';
	$lang['strviews'] = 'Visualiza��es';
	$lang['strshowallviews'] = 'Exibir todas as visualiza��es';
	$lang['strnoview'] = 'Visualiza��o n�o encontrada.';
	$lang['strnoviews'] = 'Visualiza��es n�o encontradas.';
	$lang['strcreateview'] = 'Criar visualiza��o';
	$lang['strviewname'] = 'Nome da visualiza��o';
	$lang['strviewneedsname'] = 'Voc� deve dar um nome a sua visualiza��o.';
	$lang['strviewneedsdef'] = 'Voc� deve dar uma defini��o para sua visualiza��o.';
	$lang['strviewcreated'] = 'Visualiza��o criada.';
	$lang['strviewcreatedbad'] = 'Falha na cria��o de visualiza��o.';
	$lang['strconfdropview'] = 'Tem certeza que quer deletar a visualiza��o "%s"?';
	$lang['strviewdropped'] = 'Visualiza��o deletada.';
	$lang['strviewdroppedbad'] = 'Falha na dele��o de visualiza��o.';
	$lang['strviewupdated'] = 'Visualiza��o alterada.';
	$lang['strviewupdatedbad'] = 'Falha ao alterar visualiza��o.';

	// Sequences
	$lang['strsequence'] = 'Sequ�ncia';
	$lang['strsequences'] = 'Sequ�ncias';
	$lang['strshowallsequences'] = 'Exibir todas as sequ�ncias';
	$lang['strnosequence'] = 'Sequ�ncia n�o encontrada.';
	$lang['strnosequences'] = 'Sequ�ncias n�o encontradas.';
	$lang['strcreatesequence'] = 'Criar sequ�ncia';
	$lang['strlastvalue'] = '�ltimo valor';
	$lang['strincrementby'] = 'Incrementar por';	
	$lang['strstartvalue'] = 'Valor inicial';
	$lang['strmaxvalue'] = 'Valor m�ximo';
	$lang['strminvalue'] = 'Valor m�nimo';
	$lang['strcachevalue'] = 'Valor de cache';
	$lang['strlogcount'] = 'Contador do log';
	$lang['striscycled'] = 'Foi dado um ciclo ?';
	$lang['striscalled'] = 'Foi chamado ?';
	$lang['strsequenceneedsname'] = 'Voc� deve dar um nome a sua sequ�ncia.';
	$lang['strsequencecreated'] = 'Sequ�ncia criada.';
	$lang['strsequencecreatedbad'] = 'Falha na cria��o de sequ�ncia.'; 
	$lang['strconfdropsequence'] = 'Tem certeza que quer deletar a sequ�ncia "%s"?';
	$lang['strsequencedropped'] = 'Sequ�ncia deletada.';
	$lang['strsequencedroppedbad'] = 'Falha na dele��o de sequ�ncia.';

	// Indexes
	$lang['strindexes'] = '�ndices';
	$lang['strindexname'] = 'Nome do �ndice';
	$lang['strshowallindexes'] = 'Exibir todos os �ndices';
	$lang['strnoindex'] = '�ndice n�o encontrado.';
	$lang['strnoindexes'] = '�ndices n�o encontrados.';
	$lang['strcreateindex'] = 'Criar �ndice';
	$lang['strindexname'] = 'Nome do �ndice';
	$lang['strtabname'] = 'Nome da tabela';
	$lang['strcolumnname'] = 'Nome da coluna';
	$lang['strindexneedsname'] = 'Voc� deve dar um nome ao seu �ndice';
	$lang['strindexneedscols'] = '�ndices requerem um n�mero v�lido de colunas.';
	$lang['strindexcreated'] = '�ndice criado';
	$lang['strindexcreatedbad'] = 'Falha na cria��o de �ndice.';
	$lang['strconfdropindex'] = 'Tem certeza que quer deletar o �ndice "%s"?';
	$lang['strindexdropped'] = '�ndice deletado.';
	$lang['strindexdroppedbad'] = 'Falha na dele��o de �ndice.';
	$lang['strkeyname'] = 'Nome da chave';
	$lang['struniquekey'] = 'Chave �nica';
	$lang['strprimarykey'] = 'Chave prim�ria';
 	$lang['strindextype'] = 'Tipo de �ndice';
	$lang['strindexname'] = 'Nome do �ndice';
	$lang['strtablecolumnlist'] = 'Colunas na tabela';
	$lang['strindexcolumnlist'] = 'Colunas no �ndice';

	// Rules
	$lang['strrules'] = 'Regras';
	$lang['strrule'] = 'Regra';
	$lang['strshowallrules'] = 'Exibir todas as regras';
	$lang['strnorule'] = 'Regra n�o encontrada.';
	$lang['strnorules'] = 'Regras n�o encontradas.';
	$lang['strcreaterule'] = 'Criar regra';
	$lang['strrulename'] = 'Nome da regra';
	$lang['strruleneedsname'] = 'Voc� deve especificar um nome para sua regra.';
	$lang['strrulecreated'] = 'Regra criada.';
	$lang['strrulecreatedbad'] = 'Falha na cria��o de regra.';
	$lang['strconfdroprule'] = 'Tem certeza que quer deletar a regra "%s" on "%s"?';
	$lang['strruledropped'] = 'Regra deletada.';
	$lang['strruledroppedbad'] = 'Falha na dele��o de regra.';

	// Constraints
	$lang['strconstraints'] = 'Restri��o';
	$lang['strshowallconstraints'] = 'Exibir todos as restri��es';
	$lang['strnoconstraints'] = 'Restri��es n�o encontradas.';
	$lang['strcreateconstraint'] = 'Criar restri��o';
	$lang['strconstraintcreated'] = 'Restri��o criada.';
	$lang['strconstraintcreatedbad'] = 'Falha na cria��o de restri��o.';
	$lang['strconfdropconstraint'] = 'Tem certeza que quer deletar a restri��o "%s" on "%s"?';
	$lang['strconstraintdropped'] = 'Restri��o deletada.';
	$lang['strconstraintdroppedbad'] = 'Falha na dele��o de restri��o.';
	$lang['straddcheck'] = 'Adicona checagem';
	$lang['strcheckneedsdefinition'] = 'Checagem de regras necessita de uma defini��o.';
	$lang['strcheckadded'] = 'Checagem de restri��o adicionada.';
	$lang['strcheckaddedbad'] = 'Falha ao adicionar checagem de restri��o.';
	$lang['straddpk'] = 'Adicionar chave prim�ria';
	$lang['strpkneedscols'] = 'Chave prim�ria requer pelo menos uma coluna.';
	$lang['strpkadded'] = 'Chave prim�ria adicionada.';
	$lang['strpkaddedbad'] = 'Falha ao adicinoar chave prim�ria.';
	$lang['stradduniq'] = 'Adiciona chave �nica';										
	$lang['struniqneedscols'] = 'Chave �nica requer ao menos uma coluna.';					
	$lang['struniqadded'] = 'Chave �nica adicionada.';										
	$lang['struniqaddedbad'] = 'Falha ao adicionar chave �nica.';								
	$lang['straddfk'] = 'Adicionar chave estrangeira';												
	$lang['strfkneedscols'] = 'Chave estrangeira requer ao menos uma coluna.';				
	$lang['strfkneedstarget'] = 'Chave estrangeira requer uma tabela de refer�ncia.';				
	$lang['strfkadded'] = 'Chave estrangeira adicionada.';										
	$lang['strfkaddedbad'] = 'Falha ao adicionar chave estrangeira.';							
	$lang['strfktarget'] = 'Tabela alvo';											
	$lang['strfkcolumnlist'] = 'Colunas em chaves';									
	$lang['strondelete'] = 'DELETE ATIVO';												
	$lang['stronupdate'] = 'ALTERAR ATIVO';	

	// Functions
	$lang['strfunction'] = 'Fun��o';
	$lang['strfunctions'] = 'Fun��es';
	$lang['strshowallfunctions'] = 'Exibir todas as fun��es';
	$lang['strnofunction'] = 'Fun��o n�o encontrada.';
	$lang['strnofunctions'] = 'Fun��es n�o encontradas.';
	$lang['strcreatefunction'] = 'Criar fun��es';
	$lang['strfunctionname'] = 'Nome da fun��o';
	$lang['strreturns'] = 'Retorno';
	$lang['strarguments'] = 'Argumentos';
	$lang['strproglanguage'] = 'Linguagem';				
	$lang['strfunctionneedsname'] = 'Voc� deve dar um nome � sua fun��o.';
	$lang['strfunctionneedsdef'] = 'Voc� deve dar uma defini��o � sua fun��o.';
	$lang['strfunctioncreated'] = 'Fun��o criada.';
	$lang['strfunctioncreatedbad'] = 'Falha na cria��o de fun��o.';
	$lang['strconfdropfunction'] = 'Tem certeza que quer deletar a fun��o "%s"?';
	$lang['strfunctiondropped'] = 'Fun��o deletada.';
	$lang['strfunctiondroppedbad'] = 'Falha na dele��o de fun��o.';
	$lang['strfunctionupdated'] = 'Fun��o modificada.';
	$lang['strfunctionupdatedbad'] = 'Falha na modifica��o de fun��o.';

	// Triggers
	$lang['strtrigger'] = 'Gatilho';	
	$lang['strtriggers'] = 'Gatilhos';	
	$lang['strshowalltriggers'] = 'Exibir todos os gatilhos';	
	$lang['strnotrigger'] = 'N�o foi encontrado gatilho.';		
	$lang['strnotriggers'] = 'N�o foram encontrados gatilhos.';		
	$lang['strcreatetrigger'] = 'Criar Gatilhos';		
	$lang['strtriggerneedsname'] = 'Voc� deve especificar um nome para seu gatilho.';	
	$lang['strtriggerneedsfunc'] = 'Voc� deve especificar uma fun��o para seu gatilho.';
	$lang['strtriggercreated'] = 'Gatilho criado.';
	$lang['strtriggercreatedbad'] = 'Falha na cria��o de gatilho.';			
	$lang['strconfdroptrigger'] = 'Tem certeza que quer deletar o gatilho "%s" em "%s"?';	 
	$lang['strtriggerdropped'] = 'Gatilho deletado.'; 
	$lang['strtriggerdroppedbad'] = 'Falha na dele��o de gatilho.';	

	// Types
	$lang['strtype'] = 'Tipo';		
	$lang['strtypes'] = 'Tipos';	
	$lang['strshowalltypes'] = 'Exibir todos os tipos';	
	$lang['strnotype'] = 'Tipo n�o encontrado.';			
	$lang['strnotypes'] = 'Tipos n�o encontrados.';		
	$lang['strcreatetype'] = 'Criar tipo';			
	$lang['strtypename'] = 'Nome do tipo';				
	$lang['strinputfn'] = 'Fun��o de entrada';			
	$lang['stroutputfn'] = 'Fun��o de sa�da';		
	$lang['strpassbyval'] = 'Passado por valor?';		
	$lang['stralignment'] = 'Alinhamento';			
	$lang['strelement'] = 'Elemento';				
	$lang['strdelimiter'] = 'Delimitador';			
	$lang['strstorage'] = 'Armazenamento';				
	$lang['strtypeneedsname'] = 'Voc� deve dar um nome ao seu tipo.';		
	$lang['strtypeneedslen'] = 'Voce deve dar uma extens�o ao seu tipo.';		
	$lang['strtypecreated'] = 'Tipo criado';								
	$lang['strtypecreatedbad'] = 'Cria��o de tipo falhou.';					
	$lang['strconfdroptype'] = 'Tem certeza que que deletar o tipo "%s"?';	
	$lang['strtypedropped'] = 'Tipo deletado.';									
	$lang['strtypedroppedbad'] = 'Dele��o de tipo falhou.';							

	// Schemas
	$lang['strschema'] = 'Esquema';	 
	$lang['strschemas'] = 'Esquemas';		
	$lang['strshowallschemas'] = 'Exibir todos os esquemas';	
	$lang['strnoschema'] = 'Esquema n�o encontado.';		
	$lang['strnoschemas'] = 'N�o foram encontrados esquemas.';	
	$lang['strcreateschema'] = 'Criar esquema';		
	$lang['strschemaname'] = 'Nome do esquema';		
	$lang['strschemaneedsname'] = 'Voc� deve dar um nome ao seu esquema.';		
	$lang['strschemacreated'] = 'Esquema criado';		
	$lang['strschemacreatedbad'] = 'Falha na cria��o de esquemas.';		
	$lang['strconfdropschema'] = 'Tem certeza que quer deletar o esquema "%s"?';	
	$lang['strschemadropped'] = 'Esquema deletado.';		
	$lang['strschemadroppedbad'] = 'Falha na dele��o de esquema.';		

	// Reports
	$lang['strreport'] = 'Reporte';			
	$lang['strreports'] = 'Reportes';			
	$lang['strshowallreports'] = 'Exibir todos os reportes';		
	$lang['strnoreports'] = 'Reporte n�o encontrado.';		
	$lang['strcreatereport'] = 'Criar reporte';		
	$lang['strreportdropped'] = 'Reporte deletado.';		
	$lang['strreportdroppedbad'] = 'Falha ao deletar o reporte.';		
	$lang['strconfdropreport'] = 'Tem certeza que voc� quer deletar seu reporte "%s"?';		
	$lang['strreportneedsname'] = 'Voc� deve dar um nome ao seu reporte.';	
	$lang['strreportneedsdef'] = 'Voc� deve adicionar SQL ao seu reporte.';	
	$lang['strreportcreated'] = 'Reporte salvo.';					
	$lang['strreportcreatedbad'] = 'Falha ao salvar o reporte.';		

	// Miscellaneous
	$lang['strtopbar'] = '%s rodando em %s:%s -- Voc� est� logado como usu�rio "%s", %s';
	$lang['strtimefmt'] = 'jS M, Y g:iA';

?>
