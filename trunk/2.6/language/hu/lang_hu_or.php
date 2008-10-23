<?php
$LDOr='M&#369;t&#337;';
$LDLOGBOOK='M&#369;t�ti ki�r�s';
$LDOrDocument='M&#369;t�ti leir�s';
$LDOrDocumentTxt='A m&#369;t�tek dokument�l�sa';

/**
*  A tiny dictionary:
*  DOC = doctor on call duty
*  ORNOC = Operating room nurse on call duty
*  OP Room = operating room (surgery room)
*/
$LDDOC='Orvosi �gyelet';
$LDORNOC='�gyeletes m&#369;t&#337;sn&#337;';
$LDScheduler=' - ki�r�s';

$LDQuickView='- �ttekint&#337;';
$LDQviewTxtDocs='�gyeletes orvos - �ttekint&#337;';
$LDOrLogBook='M&#369;t�ti ki��s';
$LDOrLogBookTxt='M&#369;t�ti tev�kenys�g dokument�ci�ja, arch�vum';
$LDOrProgram='M&#369;t�ti program';
$LDOrProgramTxt='M&#369;t�ti program ki�r�sa, jav�t�sa';
$LDQviewTxtNurse='�gyeletes m&#369;t&#337;sn&#337; - �ttekint&#337;';
$LDDutyPlanTxt='M&#369;t&#337;sn&#337; �gyelet, ki�r�sa, jav�t�sa';
$LDOnCallDuty='Beh�v�s �gyelet';
$LDOnCallDutyTxt='Documenting the work during an On-Call duty';
$LDAnaLogBook='Aneszteziol�gus ki�r�s';
$LDAnaLogBookTxt='Aneszteziol�giai tev�kenys�g dokument�ci�ja, arch�vum';
$LDQviewTxtAna='�gyeletes aneszt asszisztens - �ttekint&#337;';
$LDNewDocu='�j dokumentum';
$LDSearch='Keres';
$LDArchive='Arch�vum';
$LDSee='Megtekint';
$LDUpdate='Jav�t';
$LDCreate='�jat';
$LDCreatePersonList='M&#369;t&#337;sn&#337;i list�t k�sz�t';
$LDDoctor='Orvosok';
$LDNursing='N&#337;v�rek';
$LDAna='Anaeszt�zia';

$LDClose='Bez�r';
$LDSave='Elment';
$LDCancel='M�gse';
$LDReset='�jra';
$LDContinue='Folytat...';

$LDHideCat='Hide the cat';
$LDPatientsFound='Several patients found!';
$LDPlsClk1='Please click the right one.';
$LDShowCat='I want to see the cat please!';
$LDResearchArchive='Keres�s az arh�vumban';
$LDSearchDocu='Search a document';

$LDMinor='minor';
$LDMiddle='middle';
$LDMajor='major';
$LDOperation='M&#369;t�t';

$LDLastName='Vezet�kn�v';
$LDName='Keresztn�v';
$LDBday='Sz�let�si d�tum';
$LDPatientNr='Azonos�t�';
$LDMatchCode='Matchcode Name';
$LDOpDate='M&#369;t�t d�tuma';
$LDOperator='Seb�sz';
$LDStationary='Inpatient';
$LDAmbulant='Outpatient';
$LDInsurance='Insurance';
$LDPrivate='Private';
$LDSelfPay='Self pay';

$LDDiagnosis='Diagn�zis';
$LDLocalization='Localiz�ci�';
$LDTherapy='Beavatkoz�s';
$LDSpecials='Megjegyz�s';
$LDClassification='Klasszifik�ci�';

/**
*  A tiny dictionary:
*  OP = operation (surgical operation)
*/
$LDOpStart='OP Start';
$LDOpEnd='OP End';
/**
*  A tiny dictionary:
*  Scrub nurse =  the nurse in sterile clothing assisting the surgeon, in charge of the sterile instruments and surgical materials
*/
$LDScrubNurse='M&#369;t&#337;sn&#337;';
$LDOpRoom='M&#369;t&#337;';
$LDResetAll='Erase all entries';
$LDUpdateData='Update data';
$LDStartNewDocu='�j dokumentum k�sz�t�se';
$LDSearchKeyword='Search keyword: eg. given name or family name';

$LDSrcListElements=array(
'',
'Family name',
'Given name',
'Birthdate',
'Patient nr.',
'OP Date',
'OR Department',
'OP Nr.'
);
$LDClk2Show='Click to show';
$LDSrcCondition='Search keyword and/or condition';
$LDNewArchiveSearch='New archive research';
$tage=array(
				'Vas�rnap',
				'H�tf&#337;',
				'Kedd',
				'Szerda',
				'Cs�t�rt�k',
				'P�ntek',
				'Szombat');
$monat=array('',
				'Janu�r',
				'Febru�r',
				'M�rcius',
				'�prilis',
				'M�jus',
				'J�nius',
				'J�lius',
				'Augusztus',
				'Szeptember',
				'Okt�ber',
				'November',
				'December');
$LDPrevDay='El&#337;z&#337; nap';
$LDNextDay='K�vetkez&#337; nap';
$LDChange='V�lt';
$LDOpMainElements=array(
										nr_date=>'Sorsz�m/D�tum',
										patient=>'Beteg',
										diagnosis=>'Diagn�zis',
										operator=>'Seb�sz/Asszisztens',
										ana=>'Aneszt�zia',
										cutclose=>'B&#337;rmetsz�s/Z�r�s',
										therapy=>'Beavatkoz�s',
										result=>'Kimenet',
										inout=>'Kezd�s/V�ge'
										);
$LDOpCut='B&#337;rmetsz�s';
$LDOpClose='Z�r�s';
$LDOpIn='M&#369;t&#337;be �rkez�s';
$LDOpOut='M&#369;t&#337;b&#337;l t�voz�s';
$LDOpInFull='Kezd�s';
$LDOpOutFull='V�ge';
$LDEditPatientData='Edit the journal data of ~tagword~';
$LDOpenPatientFolder='Open the nursing folder of ~tagword~';

$tbuf=array('O','A','S','R');
$cbuf=array('Seb�sz','Asszisztens','M&#369;t&#337;sn&#337;','M&#369;t&#337;sfi�');

/**
*  A tiny dictionary:
*  rotating nurse =  the nurse in non-sterile clothing assisting the scrub nurse, in charge of the non-sterile instruments and surgical materials
*/
$LDOpPersonElements=array(
											operator=>'Seb�sz',
											assist=>'Asszisztens',
											scrub=>'M&#369;t&#337;sn&#337;',
											rotating=>'M&#369;t&#337;sfi�',
											ana=>'Altat�orvos'
											);

$LDPatientNotFound='Patient not found!';
$LDPlsEnoughData='Please enter enough information.';
$LDOpNr='M&#369;t�t sz�ma';
$LDDate='D�tum';
$LDClk2DropMenu='Click to drop down menu';
$LDSaveLatest='Save latest entries';
$LDHelp='S�g� megnyit�sa';

$LDSearchPatient='Beteg keres�se';
$LDUsedMaterial='Used OP materials';
$LDContainer='Used container/instruments';
$LDDRG='K�dok';
$LDShowLogbook='Show journal';

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

$LDAnaDoc='Altat�orvos';
$LDAnaPrefix='AN';
$LDEnterPerson='Enter a new ~tagword~';
$LDExtraInfo='Egy�b inform�ci�';
$LDFrom='T�l';
$LDTo='Ig';
$LDFunction='Funkci�';
$LDCurrentEntries='Jelenlegi bejegyz�sek';
$LDDeleteEntry='Bejegyz�s t�rl�se';
$LDSearchNewPerson='�j ~tagword~ keres�se';
$LDSorryNotFound='Sorry. I did not find anything. Please try a different keyword.';
$LDSearchPerson='Search ~tagword~';
$LDJobId='Beoszt�s';
$LDSearchResult='Search results';
$LDUseData='A szem�ly hozz�ad�sa mint ~tagword~';
$LDJobIdTag=array(
						nurse=>'Nurse',
						doctor=>'Physician/Surgeon'
						);
$LDQuickSelectList='V�laszt�s';
$LDTimes='Id�';
$LDPlasterCast='Motor indul';
/**
*  Reposition = repositioning of bone dislocation or fracture
*/
$LDReposition='Aorta kirekeszt�s';
$LDWaitTime='V�rakoz�s';
$LDStart='Kezd�s';
$LDEnd='V�ge';
$LDPatNoExist='The patient is not yet entered in the journal. Please close this window and start the journal from the very	beginning. If this problem persists, please notify the EDP department.';
$opts=array('-',
					'A beteg k�s&#337;n �rkezett',
       				'Az anaszteziol�gus k�s&#337;n �rkezett',
       				'Seb�sz k�s&#337;n �rkezett', 
					'Takar�t�s k�sett',
       				'Egy�b ok');
$LDReason='A v�rakoz�s oka';
$LDMaterialElements=array(
									'Best.nr.',
    								'Art.name',
    								'&nbsp;',
    								'Generic',
    								'License.Nr.',
    								'No.Pcs.',
    								'&nbsp;'
									);
$LDSearchElements=array(
									'&nbsp;',
									'Art.nr.',
    								'Art.name',
    								'Description',
 									'&nbsp;',
   									'Generic',
    								'License.Nr.'
									);
$LDContainerElements=array(
									'Container nr.',
    								'Name/Description',
									'&nbsp;',
    								'Industry nr.',
    								'Order nr.',
    								'No.pcs.',
    								'&nbsp;'
									);
$LDArticleNr='Article nr.';			
$LDContainerNr='Container nr.';							
$LDArticleNotFound='Article not found!';
$LDNoArticleTxt='The article is either not listed in the databank or you have typed the number incorrectly.';
$LDClk2ManualEntry='To enter the article manually, <b>click here.</b>';
$LDPlsClkArticle='Please click the desired article!';
$LDSelectArticle='Click to select this article';
$LDDbInfo='Info from the databank';
$LDRemoveArticle='Remove article from this list';
$LDArticleNoList='Article not listed in the databank';
$LDPromptSearch='K�rem adja meg a keresett sz�t.<br>P�ld�ul: vezet�kn�v, keresztn�v, sz�let�si d�tum.';
$LDKeyword='Kulcssz�';
$LDOtherFunctions='Tov�bbi funkci�k';
$LDInfoNotFound='The needed information is not found!';
$LDButFf='But the following';
$LDSimilar=' entry is';
$LDSimilarMany=' entries are';
$LDNeededInfo=' similar to the search keyword.';
$LDPatLogbook='The patient is documented in the following journal.';
$LDPatLogbookMany='The patient is documented in the following logbooks.';
$LDDepartment='Department';
$LDRoom='M&#369;t&#337;';
$LDLastEntry='The following is the last entry in the journal';
$LDLastEntryMany='The following are the last entries in the journal';
$LDFrom='t�l';
$LDFromMany='t�l';
$LDYesterday='yesterday';
$LDVorYesterday='2 days ago';
$LDDays='days ago';
$LDChangeDept='Change the department or OP room';

$LDTabElements=array('OR Department',
								 'Standby',
								 'Beeper/Phone',
								 'On Call',
								 'Beeper/Phone',
								 'Duty plan'
								 );
$LDStandbyPerson='Standby';
$LDOnCallPerson='On call';
$LDMonth='Month';
$LDYear='Year';
$LDDutyElements = array('Date','&nbsp;','Family name, Given name','t�l','ig','OP Room','Diagnosis & therapy');
$LDPrint='Print';
$LDAlertNoPrinter='You must print manually. Right click on the window,  then select Print.';
$LDAlertNotSavedYet='The latest entry is not saved yet. Do you want to save first?';
$LDPhone='Phone';
$LDBeeper='Beeper';
$LDOn='on';
$LDNoPersonList='The list of personnel is not yet created. Please create the list first.';
$LDNoEntryFound='No entry in plan found!';
$LDShow='Show';
$LDShowPrevLog='Show the previous log entries';
$LDShowNextLog='Show the next log entries';
$LDShowGuideCal='Show the guide calendar';

$LDPerformance='Performance';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='Please find the patient first.';
$LD_ddpMMpyyyy='dd.mm.yyyy';
$LD_yyyyhMMhdd='yyyy-mm-dd';
$LD_MMsddsyyyy='mm/dd/yyyy';
/* 2002-10-15 EL */
$LDStandbyInit='S'; /* S = Standby */
$LDOncallInit='O'; /* O = Oncall */
$LDDutyPlan='Duty plan';
/* 2003-03-18 EL */
$LDSearchInAllDepts='Search in all departments';
$LDAddNurseToList='Add a nurse to list';
$LDNursesList='Nurses\' List';
/* 2003-03-19 EL */
$LDPlsSelectDept='Please select a department.';
$LDSelectORoomNr='...and an OP Room.';
$LDAlertNoDeptSelected=$LDPlsSelectDept;
$LDAlertNoORSelected='Please select an operating room!';
?>
