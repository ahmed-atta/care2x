<?php
$LDLab='Laborat�rios';
$LDMedLab='Laborat�rio M�dico';
$LDPathLab='Laborat�rio Patol�gico';
$LDBacLab='Laborat�rio Bacteriol�gico';
$LDClose='Fechar';
$LDSeeLabData='Procurar e mostrar dos dados de laborat�rio do paciente.';
$LDSeeData='Exibir dados';
$LDEnterLabData='Entre com os dados de laborat�rio do paciente';
$LDNewData='Entre com novos dados';
$LDEnterPrioParams='Estabelecer prioridade de par�metros';
$LDPrioParams='Par�metros priorit�rios';
$LDEnterNorms='Estabelecer uma escala normal.';
$LDNorms='Escala normal';
$LDOtherOptions='Outras op��es';
$LDOptions='Op��es';
$LDMemo='Ler ou compor um menorando';
$LDTitleMemo='Memomenorando';

$LDfieldname=array('Nr do paciente.','Sobrenome','Nome','Data de nascimento');
$LDSearchWordPrompt='Entre com uma palavra-chave, por exemplo: um Sobrenome, um nome, ou uma data de nascimento, etc.';
$LDEnterData='Clique para entrar com dados';
$LDClk2See='Clique para exibir dados';
$LDFoundPatient='A procura encontrou <b>~nr~</b> pacientes.';
$LDWildCards='O que s�o coringas e como us�-los';
$LDNewSearch='Nova procura';

$LDCaseNr='Nr do paciente.';
$LDLabReport='Relat�rio laboratorial';
$LDLastName='Sobrenome';
$LDName='Nome';
$LDBday='Data de nascimento';
$LDNoLabReport='Sem relat�rio do lab dispon�vel para';
$LDParameter='Par�metro';
$LDNormalValue='Escala normal';
$LDOClock='Hora';
$LDClk2Graph='Clique para exibir o gr�fico';
$LDClk2SelectAll='Clique para selecionar ou deselecionar todo gr�fico';
$LDGraph='Gr�fico';
$LDBack='Voltar';
$LDReportFound='O seguinte � um relat�rio do lab para o paciente n�mero  ';
$LDReportFoundMany='Os seguintes s�o relat�rios do lab para os pacientes n�meros  ';
$LDIfWantEdit='Se voc� quiser editar o relat�rio,clique no bot�o.';
$LDIfWantEditMany='Se voc� quiser editar um deles,clique no bot�o.';

$LDJobIdNr='Nr do lote.';
$LDExamDate='Data do exame';
$LDOn='On';
$LDAt='At';
$LDClk2Edit='Clique para editar este relat�rio';

$LDNewJob='Eu quero criar um novo relat�rio de lab!';
$LDNew='Novo';
$LDEdit='Editar';
$LDCreate='Criar';
$LDParamGroup='Grupo de par�metros';
$LDSelectParamGroup='Selecione o grupo de par�metros';
$LDValue='Valor';

$LDParamNoSee='O par�metro que eu preciso n�o est� exibido!';
$LDOnlyPair='Eu preciso entrar com apenas alguns valores!';
$LDHow2Save='Como eu devo salvar os valores?';
$LDWrongValueHow='Eu salvei um valor errado. Como que posso corrigir isso?';
$LDVal2Note='Eu preciso entrar com uma nota em vez de um valor. Como fa�o isso?';
$LDImDone='Eu terminei. E agora?';
$LDAlertJobId='Entre com o n�mero do lote primeiro!';
$LDAlertTestDate='Entre com a data do exame primeiro!';

/* 2002-09-01 EL */
$LDTestRequest='Requisi��o de exame';
$LDFillUpSend='Preencha e envie o formul�rio de requisi��o para ';
$LDTestRequestPathoTxt=$LDFillUpSend.'exame patol�gico/histol�gico';
$LDTestRequestBacterioTxt=$LDFillUpSend.'exame bacteriol�gico';
$LDTestRequestChemLabTxt=$LDFillUpSend.'exame de laborat�rio qu�mico';
$LDBloodBank='Banco de sangue';
$LDBloodRequest='Requisi��o de sangue';
$LDBloodRequestTxt=$LDFillUpSend.'Materiais sangu�neos';

$LDRequestSent['insert']='A requisi��o do exame foi enviada. ';
$LDFormSaved['insert']='O formul�rio foi salvo (n�o enviado ainda).';
$LDRequestSent['update']='A atualiza��o da requisi��o do exame foi enviado. ';
$LDFormSaved['update']='A atualiza��o da requisi��o do exame foi salva (n�o enviada ainda).';
$LDWhatToDo=' O que voc� quer fazer agora?';

$LDNewFormSamePatient='Criar uma nova requisi��o de exame para o <b>mesmo</b> paciente';
$LDEditForm='Editar a mesma requisi�o de exame';
$LDEndTestRequest='Eu terminei.';
$LDNewFormOtherPatient='Criar uma requisi��o de exame para um <b>outro</b> paciente';

/* 2002-09-03 EL */
$LDSearchPatient='Procurar paciente';
$LDSearchFound='~nr~ pacientes foram encontrados.';
/* 2002-09-04 EL */
$LDTestRequestFor='Requisi��o para ';
$LDTestType=array('chemlabor'=>'exame de laborat�rio qu�mico',
                                     'patho'=>'exame patol�gico',
								 'baclabor'=>'exame bacteriol�gico',
								 'blood'     =>'material sangu�neo',
								 'radio' => 'exame de radiologico');
/* 2002-09-10 EL */
$LDTestReception='Requisi��o pendente';
$LDTestReceptionTxt='Receber e processar requisi��es, escrever resultados/descobertas/diagn�sticos';
/* 2002-09-15 EL */
$LDPrintForm='Imprimir o formul�rio de requisi��o';

/* 2002-09-21 EL */
$LDInitFindings='Descobertas iniciais';
$LDCurrentFindings='Descobertas atuais';
$LDFinalFindings='Descobertas finais';

$LDFillLabOnly='Somente para uso do laborat�rio';
$LDLEN='NRL';  /* Lab entry number - Numero do Registro do Lab*/
/*2003-07-11 EL*/
$LDAdministration='Gerenciamento';
$LDTestParameters='Par�metros do exame';
$LDTestParametersTxt='Digite ou edite unidades ou medidas, valores, faixas,limites, etc.';
$LDMsrUnit='Medida unit�ria';
$LDMedian='Mediano';
$LDUpperBound='Limite superior';
$LDLowerBound='Limite inferior';
$LDUpperCritical='superiormente cr�tico';
$LDLowerCritical='inferiormente cr�tico';
$LDUpperToxic='superiormente t�xico';
$LDLowerToxic='inferiormente t�xico';
?>
