<?php
$LDClose='Close';
$LDCancel='Cancel';
$LDResetEntry='Erase entries';
$LDSave='Save';
$LDReset='Reset';

$LDEnterData='Click to enter data';
$LDClk2See='Click to see data';
$LDFoundPatient='The search found <b>~nr~</b> patients';
$LDWildCards='What are wildcards and how to use them';
$LDNewSearch='New search';
$LDSearch='Search';

$LDOClock='o\'clock';
$LDContinue='Continue';
$LDBack='Go back';

$LDOn='On';
$LDAt='At';
$LDClk2Edit='Click to edit this report';

$LDNew='New';
$LDEdit='Edit';
$LDCreate='Create';
$LDValue='Value';

$LDNews='News';
$LDNewsTxt='Read or write news articles pertaining to edp department';
$LDMemo='Memo';
$LDMemoTxt='Read or write a memo';
$LDSearchPat='Search patient';
$LDCategory='Category';
$LDPast3Days='Past 3 days';
$LDPast3Months='Past 3 months';
$LDPastAll='All';
$LDSelect='Select';

$LDOrderArchive='Archive';



$LDNoDataFound='The search found <font color=red><b>no</b></font> data.';
$LDClk2SeeInfo='Please click the right one to see the complete information';
/********************** Do not erase or replace the ~nr~ *****************************/
$LDFoundNrData='The search found <font color=red><b>~nr~</b></font> data that corresponded to the search keyword.';
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

$LDPlsInformDept='Please notify the ~tagword~ department and eventually the EDP department. Thank you.';

$LDReports='Reports';
$LDReportsTxt='Create, search, read reports, etc.';
$LDInfo='Information';
$LDInfoTxt='Search and read information pertaining to edp';
$LDManage='Management';
$LDUpdateOk='Update was <b>successful</b>!';
$LDDataSaved='The following data was successully saved:';
$LDDataNoUpdate='Update  <b>failed</b>. Please check the entries.';
$LDDataNoSaved='Save <b>failed</b>. Please check the entries.';
$LDBack2Menu='Go back to databank menu';
$LDPageTop='Back to top.';
$LDPreview='Preview';
$LDUpdateData='Update or edit';
$LDRemoveFromDb='Remove from the databank';
$LDDataRemoved='The product was removed from the databank!';

$LDConfirmDelete='Do you really want to <b>erase</b> or <b>remove</b> the following data from the databank ?';
$LDAlertDelete='<b>ATTENTION!</b> Delete <b>CANNOT</b> be undone!';
$LDNoDelete='Deletion of the data failed!<br>Please notify the EDP department.';
$LDYesDelete='Yes, I am dead sure. Delete access right.';
$LDNoBack='No. Go back.';
$LDClk2Ack='Click the arrow button to acknowledge and/or print the order list.';
$LDOK='OK';
$LDManageAccess='Access rights';
$LDManageAccessTxt='Manage, create, lock, remove, update, or change, etc.';
$LDSqlDb='SQL Databank';
$LDSqlDbTxt='Direct SQL access. <b>ATTENTION</b> only for experts';
$LDSysOpLogin='System Admin';
$LDSysOpLoginTxt='Login as system administrator';
$LDEDP='EDP';
$LDNewAccess='Create new access right';
$LDListActual='List actual access rights';
$LDName='Name';
$LDPassword='Password';
$LDUserId='User login name';
$LDArea='Area';
$LDAllowedArea='Allowed areas are:';
$LDActualAccess='Actual access rights';
$LDAccessDeleted='The access right was deleted successfully.';
$LDFfActualAccess='Following are the actual access rights.';

$LDAccessIndex=array(
				'Name',
			 	'Login name',    
			 	'Password', 
				'',
			 	'Allowed areas', 
			 	'Date/Time', 
			 	'Encoder', 
			 	'Option'
			 	);
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
$LDYesSure='Yes, I\'m sure.';
$LDKeywordPrompt='Enter a search keyword';
$LDSystemAdmin='System Administrator';
$LDMySQLManage='Manage SQL databank with PHP MySQLAdmin';
$LDSpexFunctions='More configuration options';
$LDWelcome='Welcome';
$LDForeWord='You now have the highest access privileges.<br>The following functions are available without restrictions. <br><b>Please be very careful with what you do.</b>';

$LDSetDateFormat='Set Date Format';
$LDSelectDateFormat='Please select the needed date format:';
/* Do not translate $LDDateFormats */
$LDDateFormats=array('dd.MM.yyyy','yyyy-MM-dd','MM/dd/yyyy');

$LDDateFormatsTxt= array('For example: 01.10.2002 (01 October 2002)',
                                         'For example: 2002-10-01 (2002 October 01)',
										 'For example: 10/01/2002 (October 01, 2002)');

$LDNewDateFormatSaved='The new date format is now in effect.';
									
$LDSetCurrency='Set currency';
$LDNewCurrencySet='The new currency is now active.';
$LDPlsSelectCurrency='Please select currency.';
$LDAddCurrency='Add new type of currency';
$LDPlsAddCurrency='Please enter the information about the currency. Then click "Save".';
$LDAddedNewCurrency='The information about the new currency is saved.';
$LDmain='main';
$LDClk2AddCurrency='To enter new currency type, please click here.';
$LDCurrencyShortName='Currency\'s symbolic or short name:';
$LDCurrencyLongName='Currency\'s descriptive name:';
$LDCurrencyInfo='Additional information:';
$LDClk2SetCurrency='To set the main currency, please click here.';
$LDCurrencyUpdated='The currency information is updated.';
$LDUpdateCurrencyInfo='Edit Currency Information';
$LDPlsEnterUpdate='Please edit the currency information. Then press "Update".';

$LDEditInfo='Edit';
$LDCurrencyAdmin='Currency administration';

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
$LD_MMsddsyyyy='mm/dd/yyyy';
/* END */
/* 2002-10-22 EL */
$LDUserInfoSaved='The user access was successfully created';
$LDUserInfoNoSave='The access creation failed. Please check the entered information';
$LDNoAreas='You have not selected any area!';
$LDUserDouble='The access creation failed. Please use a different user login name.';
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
$LDControlButImg='Control buttons & images\' theme';
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
$LDIsSubDept='Is department a sub-department ?';
$LDParentDept='Parent Department';
$LDLangVariable='Language variable';
$LDShortName='Short Name';
$LDAlternateName='Altenate Name';
$LDAdmitsOutpatients='Admits outpatients ?';
$LDAdmitsInpatients='Admits inpatients ?';
$LDBelongsToInst='Belongs to this institution ?';
$LDWorkHrs='Working hours';
$LDConsultationHrs='Consultation Hours';
$LDSigLine='Signature Line';
$LDSigStampTxt='Signature Stamp Text';
$LDDeptLogo='Department\'s Logo';
$LDHidden='Hidden';
$LDNormal='Normal';
$LDInactive='Inactive';
$LDActive='Active';
$LDDeptStatus='Department\'s status';
$LDRecordStatus='Record\'s status';
/* 2003-03-30 EL*/
$LDConfigOptions='Configuration Options';
$LDDoesSurgeryOp='Does operative surgery?';
$LDList='List';
$LDUpdate='Update';
?>
