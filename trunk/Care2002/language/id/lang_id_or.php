<?php

$LDOr='RO';
$LDLOGBOOK='LOGBOOK';
$LDORNOC='ORNOC';

$LDOrDocument='OR Documentation';
$LDOrDocumentTxt='Documenting the operative services';
$LDDutyPlan='Standby duty plan';
$LDQuickView='Tinjauan cepat';
$LDQviewTxtDocs='Quick view of today\'s physician/surgeon on standby duty';
$LDOrLogBook='OR nursing logbook';
$LDOrLogBookTxt='Documenting the nursing services in OR, archive files';
$LDOrProgram='RO program';
$LDOrProgramTxt='Show, edit, create, etc. an OR program';
$LDQviewTxtNurse='Quick view of today\'s nurses\' on standby duty';
$LDDutyPlanTxt='Show, edit, create a standby duty plan for nurses';
$LDOnCallDuty='Standby duty';
$LDOnCallDutyTxt='Documenting the work during a standby duty';
$LDAnaLogBook='Anestesi logbook';
$LDAnaLogBookTxt='Documenting the anesthesia services, archive files';
$LDQviewTxtAna='Quick view of today\'s nurses on stanby duty for anesthesia';
$LDNewDocu='New document';
$LDSearch='Mencari pasien';
$LDArchive='Arsip';
$LDSee='See';
$LDUpdate='Update';
$LDCreate='Buat baru';
$LDCreatePersonList='Create a personnel list';
$LDDoctor='Dokter/Surgeon';
$LDNursing='Perawat';
$LDAna='Anestesi';

$LDClose='Tutup';
$LDCancel='Batal';
$LDResetEntry='Hapus Masukan';
$LDSave='Simpan';

$LDReset='Reset';
$LDContinue='Lanjutkan...';

$LDHideCat='Hide the cat';
$LDPatientsFound='Several patients found!';
$LDPlsClk1='Please click the right one.';
$LDShowCat='I want to see the cat please!';
$LDResearchArchive='Research in the archives';
$LDSearchDocu='Mencari dokumen';

$LDMinor='minor';
$LDMiddle='middle';
$LDMajor='major';
$LDOperation='Operasi';

$LDLastName='Nama Keluarga';
$LDName='Nama';
$LDBday='Tanggal Lahir';

$LDPatientNr='No. Pasien';
$LDMatchCode='Matchcode Name';
$LDOpDate='Operation date';
$LDOperator='Surgeon';
$LDStationary='Inpatient';
$LDAmbulant='Outpatient';
$LDInsurance='Insurance';
$LDPrivate='Private';
$LDSelfPay='Self pay';

$LDDiagnosis='Diagnosis/ICD-10';
$LDLocalization='Localization';
$LDTherapy='Therapy';
$LDSpecials='Special notice';
$LDClassification='Classification';

$LDOpStart='OP Start';
$LDOpEnd='OP End';
$LDScrubNurse='Scrub nurse';
$LDOpRoom='OP room';
$LDResetAll='Erase all entries';
$LDUpdateData='Update data';
$LDStartNewDocu='Start a new document';
$LDSearchKeyword='Search keyword: eg. given name or family name';

$LDSrcListElements=array(
'',
'Nama Keluarga',
'Nama',
'Tanggal Lahir',
'No. Pasien',
'OP Date',
'RO Departemen',
'No. RO'
);
$LDClk2Show='Click to show';
$LDSrcCondition='Search keyword and/or condition';
$LDNewArchiveSearch='New archive research';
$monat=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
$tage=array('Ahad','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu');

$LDPrevDay='Previous day';
$LDNextDay='Next day';
$LDChange='Change';
$LDOpMainElements=array(
										nr_date=>'Nr/Date',
										patient=>'Pasien',
										diagnosis=>'Diagnosis',
										operator=>'Dokter/Assistant',
										ana=>'Anestesi',
										cutclose=>'Cut/Suture',
										therapy=>'Therapy',
										result=>'Result',
										inout=>'Entry/Exit'
										);
$LDOpCut='Cut';
$LDOpClose='Suture';
$LDOpIn='Entry';
$LDOpOut='Exit';
$LDOpInFull='Entry';
$LDOpOutFull='Exit';
$LDEditPatientData='Edit the logbook data of ~tagword~';
$LDOpenPatientFolder='Open the nursing folder of ~tagword~';

$tbuf=array('O','A','S','R');
$cbuf=array('Surgeon','Assistant','Scrub nurse','Rotating nurse');

$LDOpPersonElements=array(
											operator=>'Surgeon',
											assist=>'Assistant',
											scrub=>'Scrub nurse',
											rotating=>'Rotating nurse',
											ana=>'Anesthesiologist'
											);

$LDPatientNotFound='Patient not found!';
$LDPlsEnoughData='Please enter enough information.';
$LDOpNr='No. RO';
$LDDate='Date';
$LDClk2DropMenu='Click to drop down menu';
$LDSaveLatest='Save latest entries';
$LDHelp='Open help window';

$LDSearchPatient='Mencari Pasien';
$LDUsedMaterial='Used OP materials';
$LDContainer='Used container/instruments';
$LDDRG='DRG';
$LDShowLogbook='Show logbook';

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

$LDAnaDoc='Dokter Anestesi';
$LDAnaPrefix='AN';
$LDEnterPerson='Enter a new ~tagword~';
$LDExtraInfo='Additional information';
$LDFrom='From';
$LDTo='To';
$LDFunction='Function';
$LDCurrentEntries='Current entries';
$LDDeleteEntry='Delete entry';
$LDSearchNewPerson='Search a new ~tagword~';
$LDSorryNotFound='Sorry. I have not found anything. Please try a different keyword.';
$LDSearchPerson='Search ~tagword~';
$LDJobId='Profession';
$LDSearchResult='Search results';
$LDUseData='Enter this person as ~tagword~';
$LDJobIdTag=array(
						nurse=>'Nurse',
						doctor=>'Dokter/Surgeon'
						);
$LDQuickSelectList='Quick select list';
$LDTimes='Jam';
$LDPlasterCast='Plaster cast';
$LDReposition='Reposition';
$LDWaitTime='Idle time';
$LDStart='Start';
$LDEnd='End';
$LDPatNoExist='The patient is not yet entered in the logbook. Please close this window and start the logbook from the very beginning. If this problem persists, please notify the EDP department.';
$opts=array('-',
					'Patient arrived late in OR',
       				'Anesthesiologists arrived late in OR',
       				'OR nurses arrived late in OR', 
					'Cleaning team finished late',
       				'Special reason');
$LDReason='Reason';
$LDMaterialElements=array(
									'Art.nr.',
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
    								'Description;',
 									'&nbsp;',
   									'Generic',
    								'License.Nr.'
									);
$LDContainerElements=array(
									'Container nr.',
    								'Nama/Description',
									'&nbsp;',
    								'Industry nr.',
    								'Order nr.',
    								'No.pcs.',
    								'&nbsp;'
									);
$LDArticleNr='No. artikel';			
$LDContainerNr='Container nr.';							
$LDArticleNotFound='Article not found!';
$LDNoArticleTxt='The article is either not listed in the databank or you have typed the number incorrectly.';
$LDClk2ManualEntry='To enter the article manually, <b>click here.</b>';
$LDPlsClkArticle='Please click the desired article!';
$LDSelectArticle='Click to select this article';
$LDDbInfo='Info from the databank';
$LDRemoveArticle='Remove article from this list';
$LDArticleNoList='Article not listed in the databank';
$LDPromptSearch='Please enter a search keyword.<br>	Like for example a given name, family name, or a birthdate, etc. (Read also the  <a href=\'ucons.php\'>Tips</a>.)';
$LDKeyword='Keyword';
$LDOtherFunctions='Other functions';
$LDInfoNotFound='The needed information is not found!';
$LDButFf='But the following';
$LDSimilar=' entry is';
$LDSimilarMany=' entries are';
$LDNeededInfo=' similar to the search keyword.';
$LDPatLogbook='The patient is documented in the following logbook.';
$LDPatLogbookMany='The patient is documented in the following logbooks.';
$LDDepartment='Departemen';
$LDRoom='Ruang';
$LDLastEntry='The following is the last entry in the logbook';
$LDLastEntryMany='The following are the last entries in the logbook';
$LDFrom='from';
$LDFromMany='from';
$LDYesterday='yesterday';
$LDVorYesterday='2 days ago';
$LDDays='days ago';
$LDChangeDept='Change the department or OP room';

$LDTabElements=array('RO Departemen',
								 'Standby',
								 'Beeper/Telepon',
								 'On Call',
								 'Beeper/Telepon',
								 'Rencana'
								 );
$LDStandbyPerson='Standby';
$LDOnCallPerson='On call';
$LDMonth='Bulan';
$LDYear='Tahun';
$LDDutyElements = array('Tanggal','&nbsp;','N.Keluarga, Nama','dari','untuk','OP Ruang','Diagnosi/Terapi');
$LDPrint='Print';
$LDAlertNoPrinter='You must print manually. Right click on the window,  then select Print.';
$LDAlertNotSavedYet='The latest entry is not saved yet. Do you want to save first?';
$LDPhone='Telepon';
$LDBeeper='Beeper';
$LDOn='on';
$LDNoPersonList='The list of personell is not yet created. Please create the list first. Click on the following button.';
$LDNoEntryFound='No entry in plan found!';
$LDShow='Show';
$LDShowPrevLog='Show the previous log entries';
$LDShowNextLog='Show the next log entries';
$LDShowGuideCal='Show the guide calendar';

$LDPerformance='Performance';
/* 2002-10-15 EL */
$LDStandbyInit='S'; /* S = Standby */
$LDOncallInit='O'; /* O = Oncall */
?>
