<?php
$LDOr='Centro Cirúrgico';
$LDLOGBOOK='Livro de registros';
$LDOrDocument='CC documentação';
$LDOrDocumentTxt='Documentando operações';

/**
*  A tiny dictionary:
*  DOC = doctor on call duty
*  ORNOC = Operating room nurse on call duty
* Chamada da enfermeira a espera no Centro Cirurgico
*  OR = operating room (surgery room)
*/
$LDDOC='DOC';
$LDORNOC='CEECC';
$LDScheduler='Programado';

$LDQuickView='Visualizar';
$LDQviewTxtDocs='Visualizar os documentos de hoje (Médico-em-chamada)';
$LDOrLogBook='CC livro de registros de cuidados';
$LDOrLogBookTxt='Documentando os serviços de cuidados no arquivo';
$LDOrProgram='CC programa';
$LDOrProgramTxt='Mostrar, editar, criar, etc. ou programa';
$LDQviewTxtNurse='Visualizar as enfermeiras que estão na espera.';
$LDDutyPlanTxt='Mostrar, editar, criar (enfermeira-em-chamada)';
$LDOnCallDuty='À espera';
$LDOnCallDutyTxt='Documentando o trabalho durante uma chamada à espera';
$LDAnaLogBook='Livro de registros de anestesia';
$LDAnaLogBookTxt='Documentando os serviços de anestesia no arquivo';
$LDQviewTxtAna='Ver as Chamadas de hoje do anestesista';
$LDNewDocu='Novo documentos';
$LDSearch='Procurar';
$LDArchive='Arquivo';
$LDSee='Ver';
$LDUpdate='Atualizar';
$LDCreate='Criar';
$LDCreatePersonList='Criar ou listar enfermeiras';
$LDDoctor='Médico/Cirurgião';
$LDNursing='Cuidados';
$LDAna='Anestesia';

$LDClose='Fechar';
$LDSave='salvar';
$LDCancel='Cancelar';
$LDReset='Restaurar';
$LDContinue='Continuar...';

$LDHideCat='Ocultar o mascote';
$LDPatientsFound='Diversos pacientes encontrados!';
$LDPlsClk1='Clique aqui.';
$LDShowCat='Eu quero ver o mascote!';
$LDResearchArchive='Buscar nos arquivos';
$LDSearchDocu='Procurar documentos';

$LDMinor='menor';
$LDMiddle='média';
$LDMajor='maior';
$LDOperation='operação';

$LDLastName='Sobrenome';
$LDName='Nome';
$LDBday='data de Nasc.';
$LDPatientNr='Nº paciente';
$LDMatchCode='Matchcode';
$LDOpDate='Data de operação';
$LDOperator='Cirurgião';
$LDStationary='Entrada paciente';
$LDAmbulant='Saida paciente';
$LDInsurance='Seguro';
$LDPrivate='Confidencial';
$LDSelfPay='Pgto próprio';

$LDDiagnosis='Diagnóstico/ICD-10';
$LDLocalization='Localização';
$LDTherapy='Terapia';
$LDSpecials='Noticias especiais';
$LDClassification='Classificação';

/**
*  A tiny dictionary:
*  OP = operation (surgical operation)
*/
$LDOpStart='CC Start';
$LDOpEnd='CC End';
/**
*  A tiny dictionary:
*  Scrub nurse =  the nurse in sterile clothing assisting the surgeon, in charge of the sterile instruments and surgical materials
*/
$LDScrubNurse='Enfermeira Instrumentalista';
$LDOpRoom='Sala do CC';
$LDResetAll='Apagar todos os dados';
$LDUpdateData='Atualizar dados';
$LDStartNewDocu='Start a new document';
$LDSearchKeyword='Procurar por palavra-chave:';

$LDSrcListElements=array(
'',
'Sobrenome',
'Nome',
'Data de nasc.',
'nº paceinte',
'Data do CC',
'Departamento do CC',
'Nº CC'
);
$LDClk2Show='Clique para mostrar';
$LDSrcCondition='Procurar por palavra-chave e/ou condição';
$LDNewArchiveSearch='Nova pesquisa no arquivo';
$tage=array(
				'Domingo',
				'Segunda',
				'Terça',
				'Quarta',
				'Quinta',
				'Sexta',
				'Sábado');
$monat=array('',
				'Janeiro',
				'Fevereiro',
				'Março',
				'Abril',
				'Maio',
				'Junho',
				'Julho',
				'Agosto',
				'Setembro',
				'Outubro',
				'Novembro',
				'Dezembro');
$LDPrevDay='Dia anterior';
$LDNextDay='Próximo dia';
$LDChange='Mudança';
$LDOpMainElements=array(
										nr_date=>'nº/data',
										patient=>'Paciente',
										diagnosis=>'Diagnóstico',
										operator=>'Cirurgião/Assisntente',
										ana=>'Anestesista',
										cutclose=>'corte/Sutura',
										therapy=>'Terapia',
										result=>'Resultado',
										inout=>'entrada/Saída'
										);
$LDOpCut='Corte';
$LDOpClose='Sutura';
$LDOpIn='Entrada';
$LDOpOut='Saída';
$LDOpInFull='entrada';
$LDOpOutFull='Saída';
$LDEditPatientData='Editar o livro de registro de dados de ~tagword~';
$LDOpenPatientFolder='Abrir a pasta de cuidados de ~tagword~';

$tbuf=array('O','A','S','R');
$cbuf=array('Cirurgião','Assistente','Enfermeira instrumentalista','Enfermeira Assistente');

/**
*  A tiny dictionary:
*  rotating nurse =  the nurse in non-sterile clothing assisting the scrub nurse, in charge of the non-sterile instruments and surgical materials
*/
$LDOpPersonElements=array(
											operator=>'Cirurgião',
											assist=>'Assistente',
											scrub=>'Enfermeira instrumentalista',
											rotating=>'Enfermeira Assistente',
											ana=>'Anestesista'
											);

$LDPatientNotFound='Paceinte não encontrado!';
$LDPlsEnoughData='Entre com mais informações.';
$LDOpNr='nº CC';
$LDDate='Data';
$LDClk2DropMenu='Clique para baixar o menu';
$LDSaveLatest='Salvar os últimos dados';
$LDHelp='Abrir ajuda';

$LDSearchPatient='Procurar paciente';
$LDUsedMaterial='Materiais usados no CC';
$LDContainer='Recipientes/materiais usados';
$LDDRG='DRG';
$LDShowLogbook='Mostrar livro de registros';

/**
*  A tiny dictionary:
*  ITA = Intra Tracheal Anesthesia
*  ITN = Intratrachele Narkose (german)
*  LA =  Local anesthesia (locally injected or applied)
*  DS = Daemmerschlaf (a local dialect meaning analgesic sedation )
*  AS = Analgesic sedation (german = Analgosidierung)
*  Plexus = Anesthesia on the Plexus nerve 
*/

$LDAnaTypes=array(
					'ITN'=>'ITA',
					'ITN-Jet'=>'ITA-Jet',
					'ITN-Mask'=>'ITA-Mask',
					'LA'=>'LA',
					'DS'=>'DS',
					'AS'=>'AS',
					'Plexus'=>'Plexus',
					'Standby'=>'Standy'
					);

$LDAnaDoc='Anesthesiologist';
$LDAnaPrefix='AN';
$LDEnterPerson='Digite um novo ~tagword~';
$LDExtraInfo='Informações adicionais';
$LDFrom='De';
$LDTo='Para';
$LDFunction='Função';
$LDCurrentEntries='Dados atuais';
$LDDeleteEntry='Apagar dados';
$LDSearchNewPerson='Procurar um novo ~tagword~';
$LDSorryNotFound='Não foi encontrado nenhum registro.';
$LDSearchPerson='Procurar ~tagword~';
$LDJobId='Profissão';
$LDSearchResult='Resultados da busca';
$LDUseData='Inscreva esta pessoa como ~tagword~';
$LDJobIdTag=array(
						nurse=>'Enfermeira',
						doctor=>'Médico/Cirurgião'
						);
$LDQuickSelectList='Selecione a lista';
$LDTimes='Hora';
$LDPlasterCast='Plaster cast';
/**
*  Reposition = repositioning of bone dislocation or fracture
*/
$LDReposition='Reposição';
$LDWaitTime='Tempo inativo';
$LDStart='Inicio';
$LDEnd='Fim';
$LDPatNoExist='O paciente não está cadastrado. reinicie o cadastro. Se o problema persistir, contate o CPD';
$opts=array('-',
					'O paciente chegou tarde no CC',
       				'O anestesista chegou tarde no CC',
       				'As enfermeiras chegaram tarde no CC', 
					'A equipe da limpeza terminou tarde',
       				'Razões especiais');
$LDReason='Razões';
$LDMaterialElements=array(
									'Nº',
    								'Nome do Artigo',
    								'&nbsp;',
    								'Genérico',
    								'Nº licença',
    								'Nº Pçs.',
    								'&nbsp;'
									);
$LDSearchElements=array(
									'&nbsp;',
									'Nº Artigo',
    								'Nome do Artigo',
    								'Descrição;',
 									'&nbsp;',
   									'Genérico',
    								'Nº Licença'
									);
$LDContainerElements=array(
									'Nº do recipiente',
    								'Nome/Descrição',
									'&nbsp;',
    								'Nº da industria',
    								'Nº da requisição',
    								'Nº pçs',
    								'&nbsp;'
									);
$LDArticleNr='Nº Artigo';			
$LDContainerNr='Nº Recipiente.';							
$LDArticleNotFound='Artigo não encontrado!';
$LDNoArticleTxt='O artigo não existe ou seu número está incorreto.';
$LDClk2ManualEntry='Clique aqui para digitar um artigo manualmente';
$LDPlsClkArticle='Clique no arquivo desejado!';
$LDSelectArticle='Clique para selecionar o artigo';
$LDDbInfo='Informações do Banco de dados';
$LDRemoveArticle='Remover o artigo desta lista';
$LDArticleNoList='Artigo não listado no banco de dados';
$LDPromptSearch='Digite uma palavra-chave.<br>por exemplo o Nome, Sobrenome, data de nascimento, etc.)';
$LDKeyword='palavra-chave';
$LDOtherFunctions='Outras funções';
$LDInfoNotFound='Não foi encontrada nenhuma informação!';
$LDButFf='mas o seguinte';
$LDSimilar=' A entrada é';
$LDSimilarMany=' As entradas são';
$LDNeededInfo=' Procurar por palavras similares.';
$LDPatLogbook='O paciente está documentado no livro de registros.';
$LDPatLogbookMany='O paciente está documentado nos livros de registros.';
$LDDepartment='Departamento';
$LDRoom='Sala';
$LDLastEntry='Última entrada no registro';
$LDLastEntryMany='Últimas entradas no registro';
$LDFrom='de';
$LDFromMany='de';
$LDYesterday='ontem';
$LDVorYesterday='há 2 dias';
$LDDays='há dias';
$LDChangeDept='Mudar o departamento ou Sala CC';

$LDTabElements=array('OR Department',
								 'À espera',
								 'Beeper/Fone',
								 'Em chamada',
								 'Beeper/Fone',
								 'Planejamento das rotinas'
								 );
$LDStandbyPerson='À espera';
$LDOnCallPerson='Em chamada';
$LDMonth='Mês';
$LDYear='Ano';
$LDDutyElements = array('Data','&nbsp;','Sobrenome, Nome','de','para','Sala CC','diagnóstico e terapia.');
$LDPrint='Imprimir';
$LDAlertNoPrinter='Você deve imprimir manualmente. Clique na janela e selecione a impressora.';
$LDAlertNotSavedYet='A última entrada não está salva ainda. Salvá-la primeiro?';
$LDPhone='fome';
$LDBeeper='Beeper';
$LDOn='em';
$LDNoPersonList='A lista de pessoas não foi criada ainda. Primeiro crie a lista. clique na seta.';
$LDNoEntryFound='Nenhuma entrada foi encontrada!';
$LDShow='Mostrar';
$LDShowPrevLog='Mostre as entradas precedentes do registro';
$LDShowNextLog='Mostre as entradas seguintes do registro';
$LDShowGuideCal='Mostre o calendário';

$LDPerformance='Performance';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='Encontre o paciente primeiro.';
$LD_ddpMMpyyyy='dd.mm.yyyy';
$LD_yyyyhMMhdd='yyyy-mm-dd';
$LD_MMsddsyyyy='mm/dd/yyyy';
/* 2002-10-15 EL */
$LDStandbyInit='S'; /* S = Standby */
$LDOncallInit='O'; /* O = Oncall */
$LDDutyPlan='Plano de rotinas';
/* 2003-03-18 EL */
$LDSearchInAllDepts='Search in all departments';
$LDAddNurseToList='Add a nurse to list';
$LDNursesList='Nurses\' List';
/* 2003-03-19 EL */
$LDPlsSelectDept='Please select a department.';

?>
