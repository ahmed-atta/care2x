<?php
$LDLab='Labor';
$LDMedLab='Medizinisches Labor';
$LDPathLab='Pathologisches Labor';
$LDBacLab='Bakteriologisches Labor';
$LDClose='Schlie�en';
$LDSeeLabData='Suchen und Anzeigen von Laborwerten bzw. Laborbefunde';
$LDSeeData='Laborwerte';
$LDEnterLabData='Eingabe von Laborwerten bzw. Laborbefunden';
$LDNewData='Neue Eingabe';
$LDEnterPrioParams='Priorit�tsparameter einstellen';
$LDPrioParams='Priorit�tsparameter';
$LDEnterNorms='Normbereiche einstellen';
$LDNorms='Normbereich';
$LDOtherOptions='Andere Optionen';
$LDOptions='Optionen';
$LDMemo='Lesen oder Schreiben von Rundbriefen';
$LDTitleMemo='Rundbrief';

$LDfieldname=array('Fallnummer','Name','Vorname','Geburtsdatum');
$LDSearchWordPrompt='Stichwort eingeben. z.B. Fallnummer, Name, Vorname, Geburtsdatum, Abk�rzung u.s.w.';
$LDEnterData='Klick um Daten einzugeben';
$LDClk2See='Klick zum zeigen';
$LDFoundPatient='Die Suche hat <b>~nr~</b> Patient(en) gefunden.';
$LDWildCards='Was sind \'Wildcards\' and wie benutze ich sie beim suchen?';
$LDNewSearch='Neue Suche';

$LDCaseNr='Fallnummer';
$LDLabReport='Laborbefund';
$LDLastName='Name';
$LDName='Vorname';
$LDBday='Geburtsdatum';

$LDNoLabReport='Kein Laborbefund gefunden f�r';
$LDParameter='Parameter';
$LDNormalValue='Normbereich';
$LDOClock='Uhr';
$LDClk2Graph='Klick f�r grafische Kurve';
$LDClk2SelectAll='Klick um alles zu w�hlen';
$LDGraph='Grafische darstellung';
$LDBack='Zur�ck';

$LDReportFound='Folgendes is ein Laborbefund von Patient Nr. ';
$LDReportFoundMany='Folgende sind Laborbefunde von Patient Nr. ';
$LDIfWantEdit='Falls Sie den Befund bearbeiten m�chten, klicken Sie den wei�-gr�nen Pfeil an.';
$LDIfWantEditMany='Falls Sie einen Befund bearbeiten m�chten, klicken Sie den entsprechenden wei�-gr�nen Pfeil an.';

$LDJobIdNr='Auftragsnummer';
$LDExamDate='Untersuchungsdatum';
$LDOn='am';
$LDAt='um';
$LDClk2Edit='Laborbefund bearbeiten';

$LDNewJob='Ich will einen neuen Befund anlegen!';
$LDNew='Neue';
$LDEdit='Aktualisieren';
$LDCreate='Anlegen';
$LDParamGroup='Testgruppe';
$LDSelectParamGroup='Testgruppe ausw�hlen';
$LDValue='Wert';

$LDParamNoSee='Der Parameter, den ich brauche, ist nicht angezeigt!';
$LDOnlyPair='Aber ich muss nur ein paar Werte eingeben!';
$LDHow2Save='Wie soll ich die Werte speichern?';
$LDWrongValueHow='Ich habe einen falschen Wert gespeichert. Wie korrigiere ich das?';
$LDVal2Note='I muss einen Vermerk anstatt eines Werts eingeben. Wie geht das?';
$LDImDone='Ich bin fertig. Was nun?';
$LDAlertJobId='Bitte geben Sie die Auftragsnummer ein!';
$LDAlertTestDate='Bitte geben Sie das Untersuchungsdatum ein!';

/* 2002-09-01 EL */
$LDTestRequest='Anforderung';
$LDFillUpSend='Anforderung ';
$LDTestRequestPathoTxt=$LDFillUpSend.' einer pathologischen/histologischen Untersuchung';
$LDTestRequestBacterioTxt=$LDFillUpSend.' einer bakteriologischen Untersuchung';
$LDTestRequestChemLabTxt=$LDFillUpSend.'von Bluttests bzw.  chemischen Untersuchung';
$LDBloodBank='Blutzentrale';
$LDBloodRequest='Blutkonserven';
$LDBloodRequestTxt=$LDFillUpSend.'Blutkonserven bzw. -pr�paraten';

$LDRequestSent= array('insert'=>'Die Anforderung wurde gesendet.',
                                    'update'=>'Die aktualisierte Anforderung wurde gesendet.');
$LDFormSaved=array('insert'=>'Die Anforderung wurde gespeichert (nicht gesendet).',
                                 'update'=>'Die aktualisierte Anforderung wurde gespeichert (nicht gesendet).');
$LDWhatToDo=' Was m�chten Sie jetzt tun?';

$LDNewFormSamePatient='Eine neue Anforderung f�r <b>denselben</b> Patient erstellen';
$LDEditForm='Dieselbe Anforderung nachbearbeiten';
$LDEndTestRequest='Anforderung beenden';
$LDNewFormOtherPatient='Ein neues Formular f�r einen anderen Patient bereitstellen';

/* 2002-09-03 EL */							  
$LDSearchPatient='Patient suchen';
$LDSearchFound='Die Suche hat ~nr~ Patienten gefunden.';
/* 2002-09-04 EL */		
$LDTestRequestFor='Anforderung f�r ';
$LDTestType=array('chemlabor'=>'Laboruntersuchung',
                                     'patho'=>'Pathologie',
								 'baclabor'=>'bakteriologische Untersuchung',
								      'blood'=>'Blutkonserven',
									  'radio'=>'radiologische Untersuchung');
/* 2002-09-10 EL */
$LDTestReception='Unbearbeitete Anforderung';
$LDTestReceptionTxt='Anforderung verarbeiten, Befunde eingeben';
/* 2002-09-15 EL */
$LDPrintForm='Die Anforderung drucken';

/* 2002-09-21 EL */
$LDInitFindings='Vorbefund';
$LDCurrentFindings='Zwischenbefund';
$LDFinalFindings='Endbefund';

$LDFillLabOnly='Nur vom Labor auszuf�llen!';
$LDLEN='LDN';  /* Lab entry number */
/*2003-07-11 EL*/
$LDAdministration='Verwaltung';
$LDTestParameters='Test parameter';
$LDTestParametersTxt='Eingeben bzw. bearbeiten von Me�einheit, Bereiche, Grenzen, usw.';
$LDMsrUnit='Me�einheit';
$LDMedian='Mittelwert';
$LDUpperBound='Obere Grenze (OG)';
$LDLowerBound='Untere Grenze (UG)';
$LDUpperCritical='OG: kritisch';
$LDLowerCritical='UG: kritisch';
$LDUpperToxic='OG: toxisch';
$LDLowerToxic='UG: toxisch';

?>
