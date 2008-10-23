<?php
$LDOr='OP';
$LDLOGBOOK='LOGBUCH';
$LDOrDocument='OP Dokumentation';
$LDOrDocumentTxt='Dokumentation der OP Leistung';
$LDDOC='Dienst';
$LDORNOC='Dienst';
$LDScheduler='Planer';
$LDDutyPlan='Dienstplan';
$LDQuickView='Schnellsicht';
$LDQviewTxtDocs='�bersicht �ber die gegenw�rtige diensthabenden �rzte';
$LDOrLogBook='OP Pflege Logbuch';
$LDOrLogBookTxt='Dokumentation der Pflegeleistung in OP, Archiv';
$LDOrProgram='OP Programm';
$LDOrProgramTxt='OP Programm ansehen, erstellen, verarbeiten, u.s.w.';
$LDQviewTxtNurse='�bersicht �ber die gegenw�rtig diensthabenden OP Pfleger';
$LDDutyPlanTxt='Dienstplan erstellen, ansehen, verarbeiten, usw.';
$LDOnCallDuty='Bereitschaftsdienst';
$LDOnCallDutyTxt='Zeiterfassung der Arbeitsleistung in Bereitschaft';
$LDAnaLogBook='An�sthesie Logbuch';
$LDAnaLogBookTxt='Dokumentation der Leistung in An�sthese, Archiv';
$LDQviewTxtAna='�bersicht �ber die diensthabenden An�sthesie-Pfleger';
$LDNewDocu='Neue Eingabe';
$LDSearch='Suchen';
$LDArchive='Archiv';
$LDSee='Sehen';
$LDUpdate='Aktualisieren';
$LDCreate='Erstellen';
$LDCreatePersonList='Personalliste erstellen bzw. �ndern';
$LDDoctor='Arzt';
$LDNursing='Pflege';
$LDAna='Narkose';

$LDClose='Schlie�en';
$LDSave='Speichern';
$LDCancel='Abbrechen';
$LDReset='Zur�cksetzen';
$LDContinue='Weiter...';

$LDHideCat='Die Katze verstecken';
$LDPatientsFound='Es wurde mehrere Patienten gefunden!';
$LDPlsClk1='Bitte klicken Sie den richtigen an.';
$LDShowCat='Ich will die Katze noch mal sehen!';
$LDResearchArchive='In Archiv recherchieren';
$LDSearchDocu='Dokument suchen';

$LDMinor='kleine';
$LDMiddle='mittlere';
$LDMajor='gro�e';
$LDOperation='Eingriff';

$LDLastName='Name';
$LDName='Vorname';
$LDBday='Geburtsdatum';
$LDPatientNr='Fallnummer';
$LDMatchCode='Matchcode Name';
$LDOpDate='OP Datum';
$LDOperator='Operateur';
$LDStationary='Station�r';
$LDAmbulant='Ambulant';
$LDInsurance='Kasse';
$LDPrivate='Privat';
$LDSelfPay='X';

$LDDiagnosis='Diagnose/ICD-10';
$LDLocalization='Lokalisation';
$LDTherapy='Therapie';
$LDSpecials='Besonderheiten';
$LDClassification='Klassifikation';

$LDOpStart='OP Beginn';
$LDOpEnd='OP Ende';
$LDScrubNurse='OP Schwester/Pfleger';
$LDOpRoom='OP Saal';
$LDResetAll='Alle Eingaben verwerfen/l�schen.';
$LDUpdateData='Aktualisieren bzw. �ndern';
$LDStartNewDocu='Neues OP Dokument anlegen';
$LDSearchKeyword='Suchbegriff: z.B. Name oder Vorname';

$LDSrcListElements=array(
'',
'Name',
'Vorname',
'Geburstdatum',
'Nummer',
'OP Datum',
'OP Abteilung',
'OP Nummer'
);

$LDClk2Show='Klick zum zeigen';
$LDSrcCondition='Suchbegriff bzw. -bedingung';
$LDNewArchiveSearch='Neue Suche im Archiv';
$tage=array(
				'Sonntag',
				'Montag',
				'Dienstag',
				'Mittwoch',
				'Donnerstag',
				'Freitag',
				'Samstag');
$monat=array('',
				'Januar',
				'Februar',
				'M�rz',
				'April',
				'Mai',
				'Juni',
				'Juli',
				'August',
				'September',
				'Oktober',
				'November',
				'Dezember');
$LDPrevDay='Vortag';
$LDNextDay='Folgender Tag';
$LDChange='Wechseln';
$LDOpMainElements=array(
										nr_date=>'OP/Datum',
										patient=>'Patient',
										diagnosis=>'Diagnose',
										operator=>'Operateur Assistent',
										ana=>'Narkose &nbsp;An�sthesie',
										cutclose=>'Schnitt Nahtzeit',
										therapy=>'Therapie',
										result=>'Ausgang',
										inout=>'Ein/Aus:'
										);
$LDOpCut='Schnitt';
$LDOpClose='Naht';
$LDOpIn='Ein';
$LDOpOut='Aus';
$LDOpInFull='Einschleusen';
$LDOpOutFull='Ausschleusen';
$LDEditPatientData='Logbuchdaten von ~tagword~ aktualisieren bzw. �ndern';
$LDOpenPatientFolder='Patientenmappe von ~tagword~ �ffnen';

$tbuf=array('O','A','I','S');
$cbuf=array('Operateur','Assistent','Instrumentierer','Springer');

$LDOpPersonElements=array(
											operator=>'Operateur',
											assist=>'Assistent',
											scrub=>'Instrumentierer',
											rotating=>'Springer',
											ana=>'Narkosearzt'
											);

$LDPatientNotFound='Der Patient wurde nicht gefunden!';
$LDPlsEnoughData='Bitte geben Sie ausreichende Informationen ein.';
$LDOpNr='OP Nummer';
$LDDate='Datum';
$LDClk2DropMenu='Klick um Men� zu sehen';
$LDSaveLatest='Aktuellen Eintrag speichern';
$LDHelp='Hilfe �ffnen';

$LDSearchPatient='Patient suchen';
$LDUsedMaterial='Verbrauchte OP-Materialien';
$LDContainer='Benutzte Siebe/Container';
$LDDRG='DRG';
$LDShowLogbook='Logbuch einblenden';
/**
*  ITN = Intratrachele Narkose
*  LA = Lokale anesthesie
*  DS = D�mmerschlaf = Analgosedierung
*  AS = Analgosidierung
*/
$LDAnaTypes=array(
					'ITN'=>'ITN',
					'ITN-Jet'=>'ITN-Jet',
					'ITN-Mask'=>'ITN-Maske',
					'LA'=>'LA',
					'DS'=>'DS',
					'AS'=>'AS',
					'Plexus'=>'Plexus',
					'Standby'=>'Standy'
					);

$LDAnaDoc='Narkosearzt';
$LDAnaPrefix='N';  // N = Narkose
$LDEnterPerson='Einen neuen ~tagword~ eingeben';
$LDExtraInfo='Weitere Angaben';
$LDFrom='ab';
$LDTo='bis';
$LDFunction='Funktion';
$LDCurrentEntries='Aktuelle Angaben';
$LDDeleteEntry='Eintrag l�schen';
$LDSearchNewPerson='Einen neuen ~tagword~ suchen';
$LDSorryNotFound='Ich habe leider keine Information gefunden. <br>Bitte versuchen sie ein anderes Stichwort.';
$LDSearchPerson='~tagword~ suchen';
$LDJobId='Berufsbezeichnung';
$LDSearchResult='Suchergebnisse';
$LDUseData='Diese Person als ~tagword~ eintragen';
$LDJobIdTag=array(
						nurse=>'Krankenschwester/Pfleger',
						doctor=>'Arzt'
						);
$LDQuickSelectList='Schnellauswahlliste';
$LDTimes='Zeiten';
$LDPlasterCast='Gipsen';
$LDReposition='Reposition';
$LDWaitTime='Wartezeit';
$LDStart='Anfang';
$LDEnd='Ende';
$LDPatNoExist='Patient ist noch nicht im Log Buch eingetragen. Bitte schlie�en Sie dieses Fenster
										und �ffnen Sie das Logbuch nochmals. Falls dieses weiterhin besteht, benachrichtigen
										Sie bitte die EDV-Abteilung.';
$opts=array('-',
					'Patient nicht rechzeitig im OP',
       				'An�sthesie nicht rechtzeitig im OP',
       				'OP Pflege nicht rechtzeitig im OP', 
					'Reinigung nicht rechtzeitig fertig',
       				'Besonderer Grund');
$LDReason='Grund';
$LDMaterialElements=array(
									'Order nr.',
    								'Art.name',
    								'&nbsp;',
    								'Generic',
    								'Zul.Nr.',
    								'Anzahl',
    								'&nbsp;'
									);
		
$LDSearchElements=array(
									'&nbsp;',
									'Art.nr.',
    								'Art.name',
    								'Beschreibung;',
 									'&nbsp;',
   									'Generic',
    								'Zul.Nr.'
									);
$LDContainerElements=array(
									'Siebnummer',
    								'Name/Beschreibung',
									'&nbsp;',
    								'Handelsnummer',
    								'Bestellnummer',
    								'Anzahl',
    								'&nbsp;'
									);								
$LDArticleNr='Artikelnummer';		
$LDContainerNr='Sieb/Container Nr.';							
$LDArticleNotFound='Artikel nicht gefunden!';
$LDNoArticleTxt='Der Artikel ist entweder nicht in der Datenbank vorhanden <br>oder Sie haben eine  falsche Artikelnummer eingetippt.';
$LDClk2ManualEntry='<b>Klicken Sie hier </b>, um den Artikel manuell einzugeben.';
$LDPlsClkArticle='Bitte klicken Sie den richtigen Artikel an!';
$LDSelectArticle='Diesen Artikel eingeben';
$LDDbInfo='Info aus der Datenbank';
$LDRemoveArticle='Artikel aus der Liste entfernen';
$LDArticleNoList='Artikel nicht in der datenbank verzeichnet';
$LDPromptSearch='Bitte geben Sie das Stichwort zum Suchen ein. <br>
							z.B. die Aufnahmenummer, den Namen, den Vornamen oder das Geburtsdatum. 
							(Beachten Sie auch die <a href=\'ucons.php\'>Tips</a>.)';
$LDKeyword='Stichwort';
$LDOtherFunctions='Weitere Funktionen';
$LDInfoNotFound='Die gesuchte Information wurde nicht gefunden!';
$LDButFf='Aber, folgende';
$LDSimilar='Eintrag entspricht';
$LDSimilarMany='Eintr�ge entsprechen';
$LDNeededInfo='dem gesuchten am n�chsten';
$LDPatLogbook='Patient ist im OP Logbuch wie folgt eingetragen.';
$LDPatLogbookMany='Patient ist in OP Logb�chern wie folgt eingetragen';
$LDDepartment='Abteilung';
$LDRoom='Saal';
$LDLastEntry='Folgendes ist der letzte Eintrag im OP Logbuch';
$LDLastEntryMany='Folgende sind die letzte Eintr�ge im OP Logbuch';
$LDFrom='von';
$LDFromMany='von vor';
$LDYesterday='Gestern';
$LDVorYesterday='Vorgestern';
$LDDays='Tagen';
$LDChangeDept='OP Abteilung bzw. Saal wechseln';

$LDTabElements=array('OP Abteilung',
								 'Anwesenheitsdienst',
								 'Funk/Telefon',
								 'Rufdienst',
								 'Funk/Telefon',
								 'Dienstplan'
								 );
$LDStandbyPerson='Anwesenheit';
$LDOnCallPerson='Rufdienst';
$LDMonth='Monat';
$LDYear='Jahr';
$LDDutyElements = array('Datum','&nbsp;','Name, Vorname','Von','Bis','OP Saal','Diagnose & Therapie');
$LDPrint='Drucken';
$LDAlertNoPrinter='In Ihrem Browser m�ssen Sie den Ausdruck leider manuell starten. Gehen Sie dazu bitte mit der Maus auf das Dokument, dr�cken Sie die rechte Maustaste und w�hlen w�heln Drucken!';
$LDAlertNotSavedYet='Die Daten sind noch nicht gespeichert! Wollen Sie sie speichern?';
$LDPhone='Telefon';
$LDBeeper='Funk';
$LDOn='am';
$LDNoPersonList='Die Personalliste ist noch nicht vorhanden. Bitte erstellen Sie zuerst die Liste.';
$LDNoEntryFound='Keinen Eintrag im Plan gefunden!';
$LDShowPrevLog='Den n�chsten Logbuch Eintrag zeigen';
$LDShowNextLog='Den vorigen Logbuch Eintrag zeigen';
$LDShowGuideCal='Den Leitkalender zeigen';

$LDShow='Zeigen';
$LDPerformance='Leistungen';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='Bitte suchen Sie zuerst den Patient.';
$LD_ddpMMpyyyy='TT.MM.YYYY';
$LD_yyyyhMMhdd='YYYY-MM-TT';
$LD_MMsddsyyyy='MM/TT/YYYY';
/* 2002-10-15 EL */
$LDStandbyInit='A';
$LDOncallInit='R';
$LDDutyPlan='Dienstplan';
/* 2003-03-18 EL */
$LDSearchInAllDepts='Suchen in allen Abteilungen';
$LDAddNurseToList='Pflegepersonal in die Liste eintragen';
$LDNursesList='Pflegepersonal-Liste';
/* 2003-03-19 EL */
$LDPlsSelectDept='Bitte w�hlen Sie die  Abteilung aus.';
$LDSelectORoomNr='...und den OP Saal.';
$LDAlertNoDeptSelected='Bitte w�hlen Sie eine Abteilung aus!';
$LDAlertNoORSelected='Bitte w�hlen Sie einen OP Saal aus!';
?>
