<?php

$LDClose='Close';
$LDCancel='Cancel';
$LDResetEntry='Erase entries';
$LDSave='Save';
$LDReset='Reset';

$LDEnterData='Click to enter data';
$LDClk2See='Click to see data';
$LDFoundPatient='The search found ~nr~ patients';
$LDWildCards='What are wildcards and how to use them';
$LDNewSearch='New search';
$LDSearch='Search';

$LDOClock='o clock';
$LDContinue='Continue';
$LDBack='Go back';

$LDOn='On';
$LDAt='At';
$LDClk2Edit='Click to edit this report';

$LDNew='New';
$LDEdit='Edit';
$LDCreate='Create';
$LDValue='Value';
$LDProfile='List and configure';

$LDNews='News';
$LDNewsTxt='Read or write news articles pertaining to sytem administration department';
$LDMemo='Memo';
$LDMemoTxt='Read or write a memo';
$LDSearchPat='Search patient';
$LDCategory='Category';
$LDPast3Days='Past 3 days';
$LDPast3Months='Past 3 months';
$LDPastAll='All';
$LDSelect='Select';

$LDOrderArchive='Archive';



$LDNoDataFound='The search found no data.';
$LDClk2SeeInfo='Please click the right one to see the complete information';
/********************** Do not erase or replace the ~nr~ *****************************/
$LDFoundNrData='The search found ~nr~ data that corresponded to the search keyword.';
$LDOpenInfo='Show complete information about ';

$LDGoodMorning='Good morning';
$LDGoodDay='Hello, nice to see you';
$LDGoodEvening='Good evening';

$LDDate='Date';
$LDDept='Department';
$LDPrio='Priority';
$LDSearchIn='Search after';


$LDPlsEnterMore='Please enter some more information and try it again.';
$LDNoSingleChar='A single character will be ignored.';

$LDPlsInformDept='Please notify the ~tagword~ department and eventually the system admin department. Thank you.';

$LDReports='Reports';
$LDReportsTxt='Create, search, read reports, etc.';
$LDInfo='Information';
$LDInfoTxt='Search and read information pertaining to system admin';
$LDManage='Management';
$LDUpdateOk='Update was successful!';
$LDDataSaved='The following data was successully saved:';
$LDDataNoUpdate='Update  failed. Please check the entries.';
$LDDataNoSaved='Save failed. Please check the entries.';
$LDBack2Menu='Go back to databank menu';
$LDPageTop='Back to top.';
$LDPreview='Preview';
$LDUpdateData='Update or edit';
$LDRemoveFromDb='Remove from the databank';
$LDDataRemoved='The product was removed from the databank!';

$LDConfirmDelete='Do you really want to erase or remove the following data from the database ?';
$LDAlertDelete='ATTENTION! Delete CANNOT be undone!';
$LDNoDelete='Deletion of the data failed!Please notify the system admin department.';
$LDYesDelete='Yes, I am dead sure. Delete access right.';
$LDNoBack='No. Go back.';
$LDClk2Ack='Click the arrow button to acknowledge and\or print the order list.';
$LDOK='OK';
$LDManageAccess='Access Permissions';
$LDManageAccessTxt='Manage, create, lock, remove, update, or change, etc.';
$LDSqlDb='SQL Databank';
$LDSqlDbTxt='Direct SQL access. ATTENTION only for experts';
$LDSysOpLogin='System Admin';
$LDSysOpLoginTxt='Login as system administrator';
$LDEDP='System admin';
$LDNewAccess='Create new access permission';
$LDListActual='List access permission';
$LDName='Name';
$LDPassword='Password';
$LDUserId='User login ';
$LDArea='Area';
$LDAllowedArea='Allowed areas are:';
$LDActualAccess='Actual access permissions';
$LDAccessDeleted='The access permission was deleted successfully.';
$LDFfActualAccess='Following are the actual access permissions.';

$LDAccessIndex[0]='Name';
$LDAccessIndex[1]='Login';
$LDAccessIndex[2]='Password';
$LDAccessIndex[3]='';
$LDAccessIndex[4]='Allowedareas';
$LDAccessIndex[5]='Date\Time';
$LDAccessIndex[6]='Encoder';
$LDAccessIndex[7]='Option';

$LDChange='Change';
$LDInitChange='C';
$LDLock='Lock';
$LDInitLock='L';
$LDUnlock='Unlock';
$LDInitUnlock='U';
$LDDelete='Delete';
$LDInitDelete='D';
$LDUpdateRight='Update access right';
$LDInputError='Your entry is either erroneous or some data are missing. Input fields marked red are to be filled in or the entry to be corrected.';
$LDAccessRight='Access right';
$LDSureLock='Are you sure you want to LOCK this access right?';
$LDSureUnlock='Are you sure you want to UNLOCK this access right?';
$LDSureDelete='Are you sure you want to DELETE this access right?';
$LDYesSure='Yes, Im sure.';
$LDKeywordPrompt='Enter a search keyword';
$LDSystemAdmin='System Administrator';
$LDMySQLManage='Manage SQL databank with PHP MySQLAdmin';
$LDSpexFunctions='More configuration options';
$LDWelcome='Welcome';
$LDForeWord='You now have the highest access privileges.The following functions are available without restrictions. Please be very careful with what you do.';

$LDSetDateFormat='Set date format';
$LDSelectDateFormat='Please select the needed date format:';

# Date formats
# Add additional date formats as array element.
# Do not forget to add the correspondign sample text in the $LDDateFormatsTxt array.
# Do not translate $LDDateFormats
$LDDateFormats[0]='dd.MM.yyyy';
$LDDateFormats[1]='yyyy-MM-dd';
$LDDateFormats[2]='MM/dd/yyyy';
$LDDateFormats[3]='dd/MM/yyyy';


$LDDateFormatsTxt[0]='For example: 01.10.2010 (01 October 2010)';
$LDDateFormatsTxt[1]='For example: 2010-10-01 (2010 October 01)';
$LDDateFormatsTxt[2]='For example: 10/01/2010 (October 01, 2010)';
$LDDateFormatsTxt[3]='For example: 01/10/2010 (01 October , 2010)';



/**
* The following lines must be modified according to the examples:
* english:
* day = d , month = m, year = y
* result => dd.mm.yyyy
*
* german:
* day = t, month = m, year = j
* result => tt.mm.jjjj
*
* indonesian:
* day = h, month = b, year = t
* result => hh.bb.tttt
*
* BEGIN */
$LD_ddpMMpyyyy='dd.mm.yyyy';
$LD_yyyyhMMhdd='yyyy-mm-dd';
$LD_MMsddsyyyy='mm\dd\yyyy';
$LD_ddsMMsyyyy='dd\mm\yyyy';
/* END */

$LDNewDateFormatSaved='The new date format is now in effect.';

$LDSetCurrency='Set currency';
$LDNewCurrencySet='The new currency is now active.';
$LDPlsSelectCurrency='Please select currency.';
$LDAddCurrency='Add new type of currency';
$LDPlsAddCurrency='Please enter the information about the currency. Then click Save.';
$LDAddedNewCurrency='The information about the new currency was saved.';
$LDmain='main';
$LDClk2AddCurrency='To enter new currency type, please click here.';
$LDCurrencyShortName='Currencys symbolic or short :';
$LDCurrencyLongName='Currencys descriptive :';
$LDCurrencyInfo='Additional information:';
$LDClk2SetCurrency='To set the main currency, please click here.';
$LDCurrencyUpdated='The currency information is updated.';
$LDUpdateCurrencyInfo='Edit Currency Information';
$LDPlsEnterUpdate='Please edit the currency information. Then press Update.';

$LDEditInfo='Edit';
$LDCurrencyAdmin='Currency';


/* 2002-10-22 EL */
$LDUserInfoSaved='The user access was successfully created';
$LDUserInfoNoSave='The access creation failed. Please check the entered information';
$LDNoAreas='You have not selected any area!';
$LDUserDouble='The access creation failed. Please use a different user login .';
$LDEnterNewUser='Create a new user access';
/* 2002-11-22 EL*/
$LDDeleteCurrency='Are you sure, you really want to delete this currency?';
$LDNoMainDelete='You cannot delete a main currency. \nPlease set a different main currency first.';
$LDCurrencyExisting='This currency exists already!';
/* 2003-02-21 EL*/
$LDMenuItem='Menu item';
$LDOrderNr='Sort nr.';
$LDStatus='Status';
$LDHideBy='Hide by:';
$LDPath='Path';
$LDVisible='Visible';
$LDFrameResizable='Frame is resizable';
$LDBorderColor='Border color';
$LDBorderWidth='Border width';
$LDFrameWidth='Frame width';
$LDNo='No';
$LDYes='Yes';
$LDAllowMultiLang='Allow multiple language choice';
$LDDefaultLang='Default language (if multi-language is not allowed)';
/* 2003-02-22 EL*/
$LDMainMenuItems='Main menu items';
$LDMainMenuDisplay='Main menu display';
$LDDataEntryForms='Data entry forms';
$LDControlButImg='Control buttons & images';
$LDSampleButtons='Sample buttons';
$LDTheme='Theme';
$LDItem='Item';
/* 2003-02-26- EL*/
$LDDeptAdmin='Department Administration';
$LDNewDept='Create and configure new departments';
$LDShowDeptInfo ='Department Profiles';
$LDShowDeptInfoTxt='Display profile information of existing active departments';
$LDConfigOptions='Configuration options';
$LDDeptConfigOptions='Configuration, update info, deactivate, activate, hide and unhide departments';
$LDDescription='Description';
/* 2003-023-01 EL*/
$LDFormalName='Formal Name';
$LDInternalID='Internal ID Code';
$LDPlsSelect='Please select one';
$LDTypeDept='Type of Department';
$LDIsSubDept='Is this a sub-department ?';
$LDParentDept='Parent Department';
$LDLangVariable='Language variable';
$LDShortName='Short Name';
$LDAlternateName='Alternate Name';
$LDAdmitsOutpatients='Admits outpatients ?';
$LDAdmitsInpatients='Admits inpatients ?';
$LDBelongsToInst='Belongs to this institution ?';
$LDWorkHrs='Working hours';
$LDConsultationHrs='Consultation Hours';
$LDSigLine='Signature Line';
$LDSigStampTxt='Signature Stamp Text';
$LDDeptLogo='Departments Logo';
$LDHidden='Hidden';
$LDNormal='Normal';
$LDInactive='Inactive';
$LDActive='Active';
$LDDeptStatus='Departments status';
$LDRecordStatus='Records status';
/* 2003-03-30 EL*/
$LDConfigOptions='Configuration Options';
$LDDoesSurgeryOp='Does operative surgery?';
$LDList='List';
$LDUpdate='Update';
# 2003-08-03 EL
$LDFindEmployee='Find an employee';
#2003-10-27 EL
$LDMainMenu='Main menu';
$LDHideShow='Hide-show';
$LDSortOrder='sort order';
$LDAdminIndex='Admin index';
$LDUsers='Users';
$LDCreateEditLock='Create, edit, lock';
$LDDatabase='Database';
$LDPhpMyAdmin='PhpMyAdmin';
$LDGeneral='General';
$LDQuickInformer='Quick informer';
$LDEnterInfo='Please edit or enter the information. Then click Save.';
$LDPaginatorMaxRows='Paginator max rows';

#2003-10-28 EL
$LDAddressList='Address list';
$LDAddressListTxt='When the address list is displayed in the  address manager module.';
$LDAddressSearch='Address search';
$LDAddressSearchTxt='When the search for addresses returns a list';
$LDInsuranceList='Insurance companies list';
$LDInsuranceListTxt='When the insurance companies list is displayed in the insurance company module.';
$LDInsuranceSearch='Insurance search';
$LDInsuranceSearchTxt='When the search for insurance company returns a list.';
$LDstaffSearch='Employee search';
$LDstaffSearchTxt='When the search for an employee returns a list.';
$LDstaffList='Employee list';
$LDstaffListTxt='When the employees list is displayed in the staff manager module.';
$LDPersonSearch='Person search';
$LDPersonSearchTxt='When the search for a person returns a list.';
$LDPatientSearch='Patient search';
$LDPatientSearchTxt='When the search for a patient returns a list.';
$LDORPatientSearch='Patient for operation search';
$LDORPatientSearchTxt='When the search for patient for operation returns a list.
This value is usually less than 10 due to a narrow display space in the OR logbook module';
$LDEnterMaxRows='Please enter the maximum number rows displayed  per page after a successful search.';
#2003-11-01 EL
$LDTimeOut='Time out';
$LDTimeOutActive='Time out active';
$LDTimeOutTxt='Should the password protected modules time out (lock itselt) after a set time of inactivity?';
$LDTimeOutTime='Elapsed time';
$LDTimeOutTimeTxt='Elapsed idle time (inactivity) that triggers the time out and locks the module. Note:
If your entry is invalid, the system will use the default maximum values.';
#2003-11-09 EL
$LDGUI='GUI';
$LDNewsDisplay='News display';
$LDTitleFontSize='Title font size';
$LDTitleFontColor='Title font color';
$LDTitleFont='Title font';
$LDPrefaceFontSize='Lead summary font size';
$LDPrefaceFontColor='Lead summary font color';
$LDPrefaceFont='Lead summary font';
$LDBodyFontSize='News body font size';
$LDBodyFontColor='News body font color';
$LDBodyFont='News body font';
$LDPreviewMaxlen='News preview maximum characters';
$LDTitleFontBold='Title font weight';
$LDPrefaceFontBold='Lead summary font weight';
$LDDisplayWidth='News display width (in pixel or %)';
$LDBold='Bold';
$LDNoteDefault='Note: If you enter an invalid value, the system will just replace it with the default value.';
$LDUseDefault='Use default values';
$LDClkPickColor='Click here to pick up the color';
#2003-11-11 EL
$LDORAdmin='OR administration';
$LDListConfig='List and configure';
$LDOR='OR';
$LDORNr='OR number';
$LDTempClosed='Is temporary closed?';
$LDOwnerWard='Owner ward';
$LDOwnerDept='Owner department';
$LDDateCreation='Date of creation';
$LDDateClose='Date of closure';
$LDOPTableNr='Number of OP table';
$LDORName='OR room name';
$LDORNrExists='OR room number already exists!';
$LDToggle='Toggle';
$LDChange='Change';
$LDClkNextNr='Click to use next available number';
$LDOPTable='OP table';
/* Gjergj Sheldija 11.08.2007 */
$LDWelcome='Welcome';
$LDClearFields='Clear fields';
#27 novembre 2007 Claudio Torbinio
$LDEnterNewRole='New Role';
$LDFindRole='Search Role';
$LDCreateEditRoles='Create Role';
$LDWelcome='Wellcome';
$LDNursingManage='Wards administration';
$LDRole = 'Role';
$LDNewRole='New Role';

$LDClose = 'Close';
$LDBack = 'Back';
$LDHelp = 'Help';$fieldname[0]="Familyname";
$fieldname[1]="Name";
$fieldname[2]="Phone1";
$fieldname[3]="Phone2";
$fieldname[4]="Phone3";
$fieldname[5]="Beeper1";
$fieldname[6]="Beeper2";
$fieldname[7]="Private1";
$fieldname[8]="Private2";

$LDPhoneDir="Phone directory";
$LDSearch="Search";
$LDDir="Directory";
$LDNewData="New data";
$LDSEARCH="SEARCH";

/**************** note the " ~nr~ " must not be erased it will be replaced by the script with the number of search results ******/
$LDPhoneFound="Search found  ~nr~  relevant data.";

$LDKeywordPrompt="Enter search keyword. For example: a name, or a department, or a shortform, etc.";
$LDShowDir="Show the complete directory";
$LDNewEntry="Enter new phone or beeper data";

$LDExtFields[0]="Nr.";
$LDExtFields[1]="Title";
$LDExtFields[2]="Familyname";
$LDExtFields[3]="Name";
$LDExtFields[4]="Profession";
$LDExtFields[5]="Dept.1";
$LDExtFields[6]="Dept.2";
$LDExtFields[7]="Tel.1";
$LDExtFields[8]="Tel.2";
$LDExtFields[9]="Tel.3";
$LDExtFields[10]="Private1";
$LDExtFields[11]="Private2";
$LDExtFields[12]="Beeper1";
$LDExtFields[13]="Beeper2";
$LDExtFields[14]="RoomNr.";
$LDExtFields[15]="Date";
$LDExtFields[16]="Time";
$LDExtFields[17]="Encoder";
$LDEditFields[0]="Nr.";
$LDEditFields[1]="Title";
$LDEditFields[2]="Familyname";
$LDEditFields[3]="Name";
$LDEditFields[4]="Profession";
$LDEditFields[5]="Department1";
$LDEditFields[6]="Department2";
$LDEditFields[7]="Telephone(internal)1";
$LDEditFields[8]="Telephone(internal)2";
$LDEditFields[9]="Telephone(internal)3";
$LDEditFields[10]="Private(external)1";
$LDEditFields[11]="Private(external)2";
$LDEditFields[12]="Beeper1";
$LDEditFields[13]="Beeper2";
$LDEditFields[14]="RoomNr.";
$LDEditFields[15]="Date";
$LDEditFields[16]="Time";
$LDEditFields[17]="Encoder";
$LDOK=" OK ";
$LDCancel="Cancel";
$LDSave="Save";
$LDEdit="Edit";
$LDDelete="Delete";
$LDReset="Reset";
$LDNewPhoneEntry="Enter new phone information";
$LDShow="Show";
$LDActualDir="Current directory contents";
$LDMoreInfo="More directory info";
$LDMaxItem="Total number of directory entries";
$LDUpdateOk="The information was updated succesfully";
$LDRows="Rows";

$LDGoodMorning="Good Morning!";
$LDGoodDay="Hi! Nice to see you!";
$LDGoodEvening="Good Evening";

$LDShowActualDir="Show current directory entries";
$LDYesDelete="Yes, delete";
$LDNoCancel="NO! CANCEL";
$LDDeleteEntry="Delete entry";
$LDNoData="You did not enter anything. Please enter the data before clicking the Save button.";
$LDReallyDelete="Do you really want to erase the following entry?";

$LDHowManage="How to manage the directory";
$LDHow2OpenDir="How to open the entire directory";
$LDHowEnter="How to enter new phone information";
$LDHow2SearchPhone="How to search for a phone number";
$LDUpdate="Update data";

$LDDirData="Edit directory entry nr. ~nr~";
$LDTelephone='Telephone';
$LDBeeper='Beeper';

$LDClose = 'Close';
$LDBack = 'Back';
$LDHelp = 'Help';


/**
* Note: the first element of $monat is set to empty string
*/
$monat[0]='';
$monat[1]='January';
$monat[2]='February';
$monat[3]='March';
$monat[4]='April';
$monat[5]='May';
$monat[6]='June';
$monat[7]='July';
$monat[8]='August';
$monat[9]='September';
$monat[10]='October';
$monat[11]='November';
$monat[12]='December';

$LDDoctors='Doctors';
$LDQView='DOC Quickview';  // DOC = doctor on call
$LDQViewTxt='Quickview of todays DOC (doctor-on-call) schedule';
$LDDutyPlan='Duty plan';
$LDDutyPlanTxt='Duty plan, view, update, delete, manage, etc.';
$LDDocsList='Doctors list';
$LDDocsListTxt='Create or update doctors list, enter data, etc..';
$LDDocsForum='Forum';
$LDDocsForumTxt='Discussions forum for doctors';
$LDNews='News';
$LDNewsTxt='Compose, read, edit news';
$LDMemo='Memo';
$LDMemoTxt='Compose, read, edit memo';
$LDCloseAlt='Close physicians-surgeons window';
$LDDocsOnDuty='Doctors on Call';

$LDTabElements[0]='Department';
$LDTabElements[1]='DOC1';
$LDTabElements[2]='Beeper-Phone';
$LDTabElements[3]='DOC2';
$LDTabElements[4]='Beeper-Phone';
$LDTabElements[5]='Dutyplan';

$LDShowActualPlan='Show actual duty plan';

$LDShortDay[0]='Su';
$LDShortDay[1]='Mo';
$LDShortDay[2]='Tu';
$LDShortDay[3]='We';
$LDShortDay[4]='Th';
$LDShortDay[5]='Fr';
$LDShortDay[6]='Sa';

$LDFullDay[0]='Sunday';
$LDFullDay[1]='Monday';
$LDFullDay[2]='Tuesday';
$LDFullDay[3]='Wednesday';
$LDFullDay[4]='Thursday';
$LDFullDay[5]='Friday';
$LDFullDay[6]='Saturday';

$LDDoc1='Doctor-On-Call 1';
$LDDoc2='Doctor-On-Call 2';
$LDClosePlan='Close this plan';
$LDNewPlan='Create a new plan';
$LDBack='Back';
$LDHelp='Help';
$LDMakeDutyPlan='Create dutyplan';
$LDClk2Plan='Click to open staff list';
$LDInfo4Duty='Information';
$LDStayIn='Stay-in duty';
$LDOnCall='On call duty';
$LDPhone='Phone';
$LDBeeper='Beeper';
$LDMoreInfo='More Info';
$LDOn='on';
$LDCloseWindow='Close window';
$LDMonth='Month';
$LDYear='Year';
$LDPerElements[0]='Familyname';
$LDPerElements[1]='Givenname';
$LDPerElements[2]='Dateofbirth';
$LDPerElements[3]='Beeper';
$LDPerElements[4]='Phone';
$LDPerElements[5]='Beeper';
$LDPerElements[6]='Phone';

$LDChgDept='Change department: ';
$LDChange='Change';
$LDCreatePersonList='Create a list for staff';
$LDNoPersonList='The list of staff is not yet created. Please create the list first.';
$LDShow='Show';

$LDDOCS='DOC Scheduler';
$LDDOCSTxt='Doctor On Call Scheduler, plan, view, update, edit, etc.';
$LDDOCSR='DOCSR';
$LDDOCSRTxt='Doctor On Call Schedule Requester';
/* 2002-09-15 EL */
$LDTestRequest='Test request';
/* 2003-03-16 EL */
$LDContactInfo='Contact Info';
$LDPersonalContactInfo='Personal Contact Info';
$LDOnCallContactInfo='On-Call Contact Info';
$LDPlsSelectDept='Please select a department';
$LDCreateDoctorsList='Create doctors list';
$LDPlsCreateList='Please create the list first.';
$LDPlsClickButton='Click on the following button.';
$LDFamilyName='Family name';
$LDGivenName='Given name';
$LDDateOfBirth='Date of birth';
$LDEntryPrompt='Please enter a search keyword:(e.g. family name, given name, staff number, etc.)';
$LDstaffNr='staff Nr.';
$LDFunction='Function';
$LDOptions='Options';
$LDSearchFound='Search found ~nr~ relevant data.';
$LDAddDoctorToList='Add a doctor to list.';
$LDAdd='Add';
$LDDelete='Delete';
$LDSureToDeleteEntry='Are you sure you want to delete this entry?';
/* 2003-03-18 EL */
$LDChangeOnlyDept='Change the department';
$LDCreateNursesList='Create Nurses List';

$LDClose = 'Close';
$LDBack = 'Back';
$LDHelp = 'Help';

$LDAdmission='Admission';
$LDHeadline='Headline';
$LDHeadlines='Headlines';
$LDManagement='Management';
$LDHealthTips='Health tips';
$LDAdmission='Admission';
$LDNursing='Nursing';
/* 2003-04-27 EL */
$LDMedical='Medical';
$LDSupport='Support';
$LDNews='News';
$LDDepartment='Department';
$LDPressRelations='Press Relations';
/* 2003-05-19 EL */
$LDSelectDept='Select a Department';
/*2003-06-15 EL*/
$LDPlsSelectDept='Please Select a Department';
$LD_AllMedicalDept='____All Medical Departments_____';
$LDClinic='Clinic';

#2003-10-23 EL
$LDPlsNameFormal='Please write the Formal Name';
$LDPlsDeptID='Please write the Department ID';
$LDPlsSelectType='Please select the type';

$LDIsPharmacy='Is Pharmacy ?';
$LDPharmacy='Select the Pharmacy this department will use.';

$LDClose = 'Close';
$LDBack = 'Back';
$LDHelp = 'Help';

$LDUserPrompt='Username';
$LDPwPrompt='Password';
$LDSubmitBut='Continue...';
$LDPwNeeded='Password needed';
$LDIntroTo='Introduction to editing news articles in';
$LDWhatTo='What and how can I edit news articles in';

$LDWrongEntry='Wrong entries!';
$LDNoAuth='You have no access permission!';
$LDAuthLocked='Your access permission is locked!';

$LDNewData='New Data';
$LDEdit='Edit';
$LDAdmit='Admit';
$LDSearch='Search';
$LDArchive='Archive';
$LDAdmission='Patient Admission';
$LDAdmTargetEntry='Admission';
$LDAdmTargetSearch='Search Admitted Patients';
$LDAdmTargetArchive='Research in Archive';
$LDAdmWantEntry='I need to admit a patient';
$LDAdmWantSearch='I am looking for a patient';
$LDAdmWantArchive='I need to research in the archive';
$LDAdmHow2Enter='How to admit a patient';
$LDAdmHow2Edit='How to edit a patients data';
$LDAdmHow2Search='How to find a certain patients data';
$LDAdmHow2Archive='How to research in the archives';

$LDMedocs='Medocs';
$LDMedocsHow2Enter='How to start a new medocs document';
$LDMedocsHow2Edit='How to edit a medocs document';
$LDMedocsHow2Search='How to find a certain medocs document';
$LDMedocsHow2Archive='How to research in the medocs archives';

$LDIntro2='Introduction to';
$LDWhat2Do='How to do what in';
$LDHowManage='How to manage the directory';
$LDHowEnter='How to enter new phone information';

$LDPhoneDir='Phone directory';
$LDMakeDutyPlan='Create dutyplan';
$LDDocsList='Doctors list';
$LDNursingManage='Ward management';

$LDNursingStation='Nursing ward';
$LDOrDocu='OR Documentation';
$LDOrLogBook='OR nursing logbook';
$LDOrNursing='OR nursing';
$LDCreate='Create';
$LDPersonList='staff list';
$LDRepairbotActivate='Activate Repairbot';
$LDQBotActivate='Activate Q-Bot';

$LDMedLab='Medical laboratory';
$LDCancel='Cancel';

$LDPharmacy='Pharmacy';
$LDOrderArchive='Archive';
$LDPharmaOrder='Ordering';
$LDOrderCat='My product catalog';
$LDPharmaDb='Databank';
$LDPharmaOrderBot='Activate OrderBot';

$LDMedDepot='Medical Depot';
$LDMediBotActivate='Activate Medibot';
$LDSqlDb='SQL Databank';
$LDManageAccess='Manage Access Rights';
$LDListAll='List all';
$LDSystemLogin='System Administrator Login';
$LDSeeData='Display data';
$LDNewData='Enter new data';

$LDWelcome='Welcome';
$LDLogin='Login';
$LDChangeSaved='The changes were saved.';
$LDPcID='Current identity of this computer';
$LDDept='Department';
$LDWard='Ward';
$LDWardOR='Ward room or OR number';
$LDPhoneNr='Rooms telephone number';
$LDIntercomNr='Rooms intercom number';
$LDPcIP='IP address of this computer';
$LDSave='Save changes';
$LDNoChange='Do not change current settings';
$LDClose='Close';
$LDLogout='Log out';
$LDNewLogin='New login';
$LDLogoutConfirm='Do you really want to log out?';
$LDOK='OK';
$LDYes='Yes';
$LDNotReally='No, not really.';
$LDDOCScheduler='DOC Scheduler';
$LDORNOCScheduler='ORNOC Scheduler';
$LDFotolab='Photolab';
/* 2002-09-08 EL */
$LDTestRequest='Diagnostic Test Request';

$LDTestType['patho']='Pathology';
$LDTestType['chemlabor']='Medical Laboratory';
$LDTestType['baclabor']='Bacteriological Laboratory';
$LDTestType['blood']='Blood Bank';
$LDTestType['radio']='Radiology';
$LDTestType['sono']='Sonography';
$LDTestType['allamb']='General Ambulatory';
$LDTestType['unfamb']='Emergency Ambulatory';
$LDTestType['nuklear']='Nuclear Diagnostics';
$LDTestType['inmed']='Internal Medicine';

$LDBloodOrder='Request for blood products';
/* 2002-09-22 EL */
$LDPendingRequest='Pending request';
/* 2002-10-06 EL*/
$LDLoggedOut='Logged out';
/* 2003-03-18 EL */
$LDNursesList='Nurses List';
$LDAppointments='Appointments';
/* 2003-04-27 */
$LDInsuranceCoManager='Insurance Company Manager';
$LDAddressMngr='Address Manager';
/* 2003-04-30 EL*/
$LDBilling='eComBill';
/* 2003-05-18 EL */
$LDPlsContactEDP='Please contact the EDP department.';
$LDPlsTryAgain='Please try again';
/* 2003-07-11 EL */
$LDAdministration='Administration';
$LDOutpatientClinic='Outpatient clinic';
$LDUploadDicom='Upload DICOM images';
$LDViewDicom='View DICOM images';
# 2003-08-22 EL
$LDYellowList='Yellow List';
$LDRedList='Red List';
#2003-11-22 EL
$LDAdvancedSearch='Advanced search';
$LDNewPerson='Register new person';

$LDClose = 'Close';
$LDBack = 'Back';
$LDHelp = 'Help';
?>