<?php
/*
*	IMPORTANT!	All words or characters inclosed with ~ ~ must not be changed.
*/
$LDNursing='Perawat';
$LDStation='Ward';

$LDQuickView='Tinjauan cepat';
$LDSearchPatient='Cari seorang pasien';
$LDArchive='Arsip';
$LDStationMan='Pengelolaan bangsal';
$LDNews='Berita';
$LDMemo='Memo';
$LDNursingForum='Forum perawat';
$LDNursingStations='Perewat Ruangan';

$LDQuickViewTxt='Quick view of today\'s occupancy of the nursing wards.';
$LDSearchPatientTxt='Search the wards for an admitted patient.';
$LDArchiveTxt='Research in the wards\' archived files.';
$LDStationManTxt='Create a ward, initialize parameters like number of beds, personell, etc.';
$LDNewsTxt='Read, compose, or edit a news article.';
$LDMemoTxt='Read, compose, or edit a memo.';
$LDNursingForumTxt='Discussions forum about nursing.';
$LDNursingStationsTxt='Occupancy, patient\' charts, photos, etc.';

$LDCloseBack2Main='Close and go back to start page';
$LDOld='Old';
$LDTodays='Today\'s';
$LDOccupancy='occupancy';
$LDBedNr='No. of beds';
$LDOptions='Options';
$LDFreeBed='Unoccupied';

$LDNoOcc='Today\'s occupancy list is not available!';
$LDClk2Archive='Click this to go to archive.';
$LDNrUnocc='Number of unoccupied beds';
$LDEditStation='Edit data in ward ~station~';
$LDSearchKeyword='The search keyword';
$LDWasFound='was found in ~rows~ occupancy lists!';
$LDPlsClk='Please click the right one.';
$LDMoreFunctions='More functions';
$LDSrcKeyword='Search keyword';
$LDSearchArchive='Include archive in search.';
$LDSearchPrompt='Please enter a search keyword.<br>	For example: a name, a Given name, or both, etc.';
$LDSearch='Cari';
$LDCancel='Batal';
$LDHow2Search='Help! How can I find a patient?';
$LDClk2Show='Click to show data';
$LDDate='Date';
$LDClockTime='Time';

$LDClkDate='Click the desired date.';
$monat=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
$tage=array('Aha','Sen','Sel','Rab','Kam','Jum','Sab');
			
$LDDay='Day';					
$LDMonth='Bulan';
$LDYear='Tahun';

$LDDirectSelect='Direct selection';
$LDPlusYear='Add one year';
$LDMinusYear='Minus one year';
$LDGo='GO';
$LDLastMonth='Last month';
$LDNextMonth='Next month';
$LDNursingManage='Ward management';
$LDShowStationDataTxt='&nbsp;Show, edit, create, <br> &nbsp;description, number of beds<br>	&nbsp;etc.';
$LDLockBedTxt='&nbsp;or free a bed';
$LDAccessRightsTxt='&nbsp;Create, lock, change,<br>&nbsp;activate, delete, usw.';
$LDShowStationData='Wards\' profile data';
$LDLockBed='Lock a bed';
$LDAccessRights='Access rights';
$LDProfile='Profile';
$LDCreate='Create';
$LDNewStation='New ward';
$LDDescription='Description';
$LDDept='Department';
$LDRoom1Nr='Room number of the first room';
$LDRoom2Nr='Room number of the last room';
$LDRoomPrefix='Room prefix';
$LDNrBeds='Number of beds in a room';
$LDMaxBeds='Maximale Anzahl der Betten';
$LDMaxBeds='Total number of available beds';
$LDBed1Prefix='Prefix for the first bed';
$LDBed2Prefix='Prefix for the second bed';
$LDHeadNurse='Head nurse';
$LDHeadNurse2='Assistant head nurse';
$LDNurses='Nurses';
$LDCreateStation='Create the ward';
$LDEnterAllFields ='The fields marked with <font color=#ff0000><b>*</b></font> must be filled.';
$LDPlsSelect='Please select a department';
$LDStationExists='The ward ~station~ is already existing!';
$LDAlertIncomplete='Some information are missing. Please fill in the important information.';
$LDAlertRoomNr='The number of the last room MUST BE HIGHER than the number of the first room!';
$LDExistStations='Existing wards. Please click the desired one.';
$LDOtherStations='Other wards';
$LDEditProfile='Edit ward\'s profile';
$LDCreatedOn='Created on:';
$LDCreatedBy='Created by:';

/**********do not change the ~station~ **************************/
$LDTemplateMissing='Template for ward ~station~ missing!';
$LDNoOrigData='Original data not found!';

$LDShowLastList='Show last occupancy list.';
$LDNoListYet='Today\'s list is not yet created!';
$LDLastList='Last occupancy list.';
$LDNotToday='(Not today!!)';
$LDFromYesterday='(Yesterday\'s list!!)';
/**********do not change the ~nr~ **************************/
$LDListFrom='This list is already ~nr~ day(s) old.';
$LDCopyAnyway='Copy this list for today anyway.';
$LDTakeoverList='Copy this list for today.';
$LDDoNotCopy='Do not copy this! Create a new list.';
$LDOldList='This is an old list!';
$LDQuickInformer='Quick Informer';
$LDAttention='Attention!';
$LDOccupied='Occupied';
$LDFree='Free';
$LDLocked='Locked';
$LDDutyDoctor='<b>Doctor</b><br>(on Duty)';
$LDShortMale='M';
$LDShortFemale='F';
$LDLegend='Legend';

$LDOpenFile='Open file';
$LDNotesEmpty='Empty notice';
$LDNotes='Notice';
$LDRelease='Dismiss';
$LDFreeOccupy='Free/Occupy';
$LDMale='Male';
$LDFemale='Female';
/**********do not change the ~station~ **************************/
$LDNoInit='The ward ~station~ is not yet initialized!';
$LDIfInit='To initialize the ward, please click here.';
$LDShowPatData='Open patient\'s data file';
$LDReleasePatient='Dismiss patient';
$LDNoticeRW='Read or write notice';
$LDInfoUnlock='Read info or unlock';
$LDPatListElements=array(
										'Room',
										'Bed',
										'Family name, Name',
										'Birthdate',
										'Patient nr.',
										'Insurance',
										'Options'
										);
/********** NOTE: !! do not change the \'+b+\' and \'+r+\'  !! **************************/
$LDConfirmUnlock='Do you really want to unlock the \'+b+\' bed in room \'+r+\' ?';							
/********** NOTE: !! do not change the \'+t+\' \'+n+\' and \'+r+b+\'  **************************/
$LDConfirmDelete='Do you really want to delete \'+t+\' \'+n+\' from room \'+r+b+\'?';
$LDConfirmLock='Do you really want to lock this bed?';
$LDClk2Occupy='Click to occupy this bed';
$LDInsurance=array(
								x=>'Self pay',
								privat=>'Private',
								kasse=>'General'
								);
$LDSave='Save';
$LDNurse='Nurse';
$LDYesSure='Yes, I\'m sure. Dismiss the patient.';
$LDFtpAttempted='Attempted to connect to the FTP server.<br>The FTP server may be down or busy. If this problem persists for a long time, contact the EDP dept.';
$LDFtpNoLink='FTP login failed';
$LDJustReleased='The patient was dismissed. Click \'Close\' to continue.';
$LDReleaseType='Dismissal type';
$LDRegularRelease='Regular dismissal';
$LDSelfRelease='Patient left the hospital on his own will';
$LDEmRelease='Emergency dismissal';
$LDAlertNoName='Please enter your name.';
$LDAlertNoDate='Enter the date in the ff: format: dd.mm.YYYY.';
$LDAlertNoTime='Enter the time in the ff: format: HH.mm.';
$LDPatDataFolder='Patient\'s data folder';

$LDClose='Close';
$LDHelp='Pertolongan';
$LDReset='Reset';

$LDNoLabReport='No lab reports available!';
$LDFeverCurve='Fever chart';
$LDNursingReport='Nursing report';
$LDDocsPrescription='Doctor\'s directives';
$LDNursingPlan='Nursing plan';
$LDRootData='Root data';
$LDReports='Diagnostic reports';
$LDLabReports='Lab reports';
$LDPhotos='Photos';
$LDChkUpRequests='Checkup requests';
$LDPleaseSelect='Select diagnostic test request';
$LDSetColorRider='Click to set or reset color rider';
$LDDiet='Diet plan';
$LDBackDay='Move back 1 day. (right click to enter any date)';
$LDFwdDay='Move forward 1 day. (right click to enter any date)';
$LDClk2PlanDiet='Click to plan the diet for this day';

$LDAllergy='Allergy';
$LDDiagnosisTherapy='Diagnosis / Therapy';
$LDBpTemp='Temperature/Blood pressure';
$LDPtAtgEtc='PT,Atg,etc';
$LDAntiCoag='Anticoagulant(s)';
$LDExtraNotes='Notes';
$LDMedication='Medication';
$LDIvPort='Intravenous';
$LDPtAtgEtcTxt='Physical therapy, Anti thrombosis, etc.';
$LDExtraNotesTxt='Notes, LOT, Charge nr., etc.';

$LDBp='Blood pressure';
$LDTemp='Temperature';

$LDClk2Enter='Click to enter ~tagword~';
$LDClk2EnterDaily='Click to enter ~tagword~ for this day';
$LDSpecialsExtra='Notes, extra diagnoses';
$LDClk2PlanDaily='Click to plan ~tagword~ for this day';
$LDInputWin='Input window';
$LDFullDayName=array(
									'Sunday',
									'Monday',
									'Tuesday',
									'Wednesday',
									'Thursday',
									'Friday',
									'Saturday',
									'Sunday',
									'Monday',
									'Tuesday',
									'Wednesday',
									'Thursday',
									'Friday',
									'Saturday',
									'Sunday'
									);
$LDCurrentEntry='Current entries';
$LDEntryPrompt='Please enter the new information here';
$LDConfirmSetDate='Do you want to set the \'+dayID+\' ?';
$LDStartDate='Start date';
$LDEndDate='End date';
$LDShowCurveDate='Show the curve with the following';
$LDDailyDiagTher='Therapy, report, nursingplan, etc.';
$LDAntiCoagTxt='Anticoagulants - daily report';
$LDSFormatPrompt='Enter the new information here or edit the current entries:<br><font size=1 > Maximum 16 characters.</font>';
$LDDosage='Dosage';
$LDColorMark='Color mark with';
$LDNormal='Normal';
$LDAntibiotic='Antibiotic';
$LDDialytic='Dialytic';
$LDHemolytic='Hemolytic';
$LDIntravenous='Intravenous';
$LDTodaysReport='Today\'s report';
$LDNoMedicineYet='There is no medication yet!';
$LDEffectReport='Effectivity report';
$LDFrom='From';
$LDTo='to';
$LDPage='Page';
$LDSignature='Sign';
$LDInsertSymbol='Place this symbol at the start.';
$LDInsertDate='Insert today\'s date';
$LDInsertTimeNow='Insert the time now';
$LDSpecialNotice='Special notice';
$LDAddendum='Additional information';
$LDDiagnosticReport='Diagnostic report';
$LDDoctor='Doctor';
$LDPassword='Password';
$LDCallBackPhone='For inquiries call';

$LDPicShots='Shots';
$LDClk2Preview='Click to preview';
$LDPreview='Preview';
$LDShotDate='Shot date';
$LDShotNr='Shot nr.';

$LDLastName='Family name';
$LDName='Name';
$LDBirthDate='Birthdate';
$LDLockThisBed='Lock this bed';
$LDClk2LockBed='Click to lock this bed';
$LDAssignOcc='Assign occupant';
$LDSearchFound='Search found <font color=red><b>~nr~</b></font> patients.';
$LDAssign2Bed='Assign this patient as occupant';
$LDSend='Send';
$LDSendLater='Send later';
$LDReqTest='Requested diagnostic test';
$LDSpeedTest='Urgent test.';
$LDDiagnosticTest='Request diagnostic test';
$LDRelayResult='Relay diagnosis at Phone/Beeper';
$LDSpeedCut='Express cut.';
$LDClk4Phone='Click to show Phone/Beeper info';
$LDHour='Hour';

$LDClkHere='Please click here';

$LDNoOccList='There is no available past';
$LDFromWard='list from ward ';
$LDWithinLast='within the last ';
$LDDays=' days.';
$LDAvailable='';

$LDQueries='Inquiries to the Physician';
$LDChangeWard='Change of ward';
$LDChangeBed='Change of bed';
$LDPatientDied='Death of patient';

$LDFollowing='following';
$LDErrorDuplicateBed='Error: Duplicate bed occupancy record in table nursing_station_patients';
$LDNoFound='Search found no patient.';

$LDNoWardsYet='There are no nursing wards yet.';
$LDClk2CreateWard='To create a ward, please click here.';
/* 2002-10-12 EL */
$LDToCreateNewList='To create a new list';
$LD_ddpMMpyyyy='hh.bb.tttt';
$LD_yyyyhMMhdd='tttt-bb-hh';
$LD_MMsddsyyyy='bb/hh/ttttt';
/* 2002-10-23 EL*/
$LDQueryDoctor='Query to doctor';
$LDDoctorInfo='Doctor\'s info, instructions';
$LDDiagnosticsReport='Diagnostics report arrived';
$LDInfusionTherapy='Infusion therapy/program';
$LDMonitorFluidDischarge='Monitor fluids discharge';
$LDBloodProgram='Blood sample/transfusion';
$LDVitalStatistics='Vital statistics';
$LDAntibioticsProgram='Antibiotics therapy/program';
$LDAnticoagProgram='Anticoagulants';
$LDSpecialCare='Special care, vital statistics';
$LDTestConsultRequested='Test/Consult requested';
$LDNurseReport='Nurse report (new)';
$LDDaily='Daily';
$LDSaveChanges='Save changes';
?>
