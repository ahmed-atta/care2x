<?php
$LDOr='Opera�n� s�l';
$LDLOGBOOK='S�lov� kniha';
$LDOrDocument='Dokumentace opera�n�ho s�lu';
$LDOrDocumentTxt='Dokumentace opera�n�ch v�kon�';

/**
*  A tiny dictionary:
*  DOC = doctor on call duty
*  ORNOC = Operating room nurse on call duty
*  OR = operating room (surgery room)
*/
$LDDOC='DOC';
$LDORNOC='ORNOC';
$LDScheduler='Pl�nova�';

$LDQuickView='Rychl� n�hled';
$LDQviewTxtDocs='Rychl� nalezen� l�ka�e na telefonu';
$LDOrLogBook='Z�znamy s�lov� sestry';
$LDOrLogBookTxt='Dokumentace v�kon� sestry na opera�n�m s�le, arch�vn� soubory';
$LDOrProgram='Program opera�n�ho s�lu';
$LDOrProgramTxt='Zobrazit, editovat nebo vytvo�it program opera�n�ho s�lu';
$LDQviewTxtNurse='Rychl� p�ehled sester �ekaj�c�ch na  zavol�n�';
$LDDutyPlanTxt='Zobrazen�, editace a vytvo�en� ORNOC(===p�elo�it----OR Nurse-On-Call)';
$LDOnCallDuty='Standby duty';
$LDOnCallDutyTxt='Documenting the work during an On-Call duty';
$LDAnaLogBook='Anesthesia logbook';
$LDAnaLogBookTxt='Documenting the anesthesia services, archive files';
$LDQviewTxtAna='Quick view of today\'s ORNOC for anesthesia';
$LDNewDocu='Nov� dokument';
$LDSearch='Hledat';
$LDArchive='Arch�v';
$LDSee='Prohl�dnout';
$LDUpdate='Aktualizovat';
$LDCreate='Vytvo�it';
$LDCreatePersonList='Vytvo�it seznam sester na opera�n�m s�le';
$LDDoctor='L�ka�/Chirurg';
$LDNursing='Sestry';
$LDAna='Anast�zie';

$LDClose='Zav��t';
$LDSave='Ulo�it';
$LDCancel='Zru�it';
$LDReset='Vymazat formul��';
$LDContinue='Pokra�ovat...';

$LDHideCat='Schovat ko�i�ku';
$LDPatientsFound='Bylo nalezeno v�ce pacient�!';
$LDPlsClk1='Pros�m vyberte po�adovan�ho pacienta ze seznamu.';
$LDShowCat='Chci vid�t ko�i�ku, pros�m!';
$LDResearchArchive='Prohled�vat arch�v';
$LDSearchDocu='Hledat dokument';

$LDMinor='zrcadlit';
$LDMiddle='uprost�ed';
$LDMajor='hlavn�';
$LDOperation='Operace';

$LDLastName='P��jmen�';
$LDName='Jm�no';
$LDBday='Narozen�';
$LDPatientNr='��slo pacienta.';
$LDMatchCode='_____translate____Matchcode Name';
$LDOpDate='Datum operace';
$LDOperator='Chirurg';
$LDStationary='Pacient z nemocnice';
$LDAmbulant='Abulantn� pacient';
$LDInsurance='Poji�t�n�';
$LDPrivate='Priv�tn�';
$LDSelfPay='Plat� s�m';

$LDDiagnosis='Diagn�za/ICD-10';
$LDLocalization='Lokalizace --- Hospitalizace---';
$LDTherapy='L��ba';
$LDSpecials='Zvl�tn� pozn�mka';
$LDClassification='Klasifikace';

/**
*  A tiny dictionary:
*  OP = operation (surgical operation)
*/
$LDOpStart='Za��tek operace';
$LDOpEnd='Konec operace';
/**
*  A tiny dictionary:
*  Scrub nurse =  the nurse in sterile clothing assisting the surgeon, in charge of the sterile instruments and surgical materials
*/
$LDScrubNurse='Scrub nurse Steriln� oble�en� sestra pod�vaj�c� n�stroje';
$LDOpRoom='Opera�n� s�l';
$LDResetAll='Smazat v�echny polo�ky';
$LDUpdateData='Doplnit �i modifikovat �daje';
$LDStartNewDocu='Za��t nov� dokument';
$LDSearchKeyword='Kl��ov� slovo:  nap��klad jm�no �i p��jmen�';

$LDSrcListElements=array(
'',
'P��jmen�',
'Jm�no',
'Datum narozen�',
'��slo pacienta',
'Datum operace',
'Odd�len� opera�no s�lu',
'��slo opera�n�ho s�lu'
);
$LDClk2Show='Kliknut�m se zobraz� �daje';
$LDSrcCondition='Hled�n� podle kl��ov�ch slov nebo jin�ch podm�nelk';
$LDNewArchiveSearch='Nov� prohled�v�n� archivu';
$tage=array(
				'Ned�le',
				'Pond�l�',
				'�ter�',
				'St�eda',
				'�tvrtek',
				'P�tek',
				'Sobota');
$monat=array('',
				'Leden',
				'�nor',
				'B�ezen',
				'Duben',
				'Kv�ten',
				'�erven',
				'�ervenec',
				'Srpen',
				'Z���',
				'��jen',
				'Listopad',
				'Prosinec');
$LDPrevDay='V�erej�� den';
$LDNextDay='Z�tra';
$LDChange='Zm�nit';
$LDOpMainElements=array(
										nr_date=>'��slo dne',
										patient=>'Pacient',
										diagnosis=>'Diagn�za',
										operator=>'Chirurg/Asistent',
										ana=>'Anest�zie',
										cutclose=>'Cut/Suture',
										therapy=>'L��ba/Therapy',
										result=>'V�sledek',
										inout=>'Vstup/V�stup'
										);
$LDOpCut='�ez';
$LDOpClose='Suture';
$LDOpIn='Vstup';
$LDOpOut='V�stup';
$LDOpInFull='Entry';
$LDOpOutFull='Exit';
$LDEditPatientData='Editovat data v knize z�znam� ze dne ~tagword~';
$LDOpenPatientFolder='Otev��t po�ada� sestry ze dne ~tagword~';

$tbuf=array('O','A','S','R');
$cbuf=array('Surgeon','Assistant','Scrub nurse','Rotating nurse');

/**
*  A tiny dictionary:
*  rotating nurse =  the nurse in non-sterile clothing assisting the scrub nurse, in charge of the non-sterile instruments and surgical materials
*/
$LDOpPersonElements=array(
											operator=>'Surgeon',
											assist=>'Assistant',
											scrub=>'Scrub nurse',
											rotating=>'Rotating nurse',
											ana=>'Anesthesiologist'
											);

$LDPatientNotFound='Patient not found!';
$LDPlsEnoughData='Please enter enough information.';
$LDOpNr='OP nr.';
$LDDate='Date';
$LDClk2DropMenu='Click to drop down menu';
$LDSaveLatest='Save latest entries';
$LDHelp='Open help window';

$LDSearchPatient='Search patient';
$LDUsedMaterial='Used OP materials';
$LDContainer='Used container/instruments';
$LDDRG='DRG';
$LDShowLogbook='Show logbook';

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
						doctor=>'Physician/Surgeon'
						);
$LDQuickSelectList='Quick select list';
$LDTimes='Time';
$LDPlasterCast='Plaster cast';
/**
*  Reposition = repositioning of bone dislocation or fracture
*/
$LDReposition='Reposition';
$LDWaitTime='Idle time';
$LDStart='Start';
$LDEnd='End';
$LDPatNoExist='The patient is not yet entered in the logbook. Please close this window and start the logbook from the very	beginning. If this problem persists, please notify the EDP department.';
$opts=array('-',
					'Patient arrived late in OR',
       				'Anesthesiologists arrived late in OR',
       				'OR nurses arrived late in OR',
					'Cleaning team finished late',
       				'Special reason');
$LDReason='Reason';
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
    								'Description;',
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
$LDPromptSearch='Please enter a search keyword.<br>Like for example a given name, family name, or a birthdate, etc.	(Read also the  <a href=\'ucons.php\'>Tips</a>.)';
$LDKeyword='Keyword';
$LDOtherFunctions='Other functions';
$LDInfoNotFound='The needed information is not found!';
$LDButFf='But the following';
$LDSimilar=' entry is';
$LDSimilarMany=' entries are';
$LDNeededInfo=' similar to the search keyword.';
$LDPatLogbook='The patient is documented in the following logbook.';
$LDPatLogbookMany='The patient is documented in the following logbooks.';
$LDDepartment='Department';
$LDRoom='Room';
$LDLastEntry='The following is the last entry in the logbook';
$LDLastEntryMany='The following are the last entries in the logbook';
$LDFrom='from';
$LDFromMany='from';
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
$LDDutyElements = array('Date','&nbsp;','Family name, Given name','from','to','OP Room','Diagnosis & therapy');
$LDPrint='Print';
$LDAlertNoPrinter='You must print manually. Right click on the window,  then select Print.';
$LDAlertNotSavedYet='The latest entry is not saved yet. Do you want to save first?';
$LDPhone='Phone';
$LDBeeper='Beeper';
$LDOn='on';
$LDNoPersonList='The list of personell is not yet created. Please create the list first. Click on the following button.';
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

?>
