<?php
/* $Id$ */

/* Translated by Kyriakos Xagoraris <theremon at users.sourceforge.net> */

$charset = 'iso-8859-7';
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'tahoma, verdana, helvetica, geneva, sans-serif';
$number_thousands_separator = '.';
$number_decimal_separator = ',';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('���', '���', '���', '���', '���', '���', '���');
$month = array('���', '���', '���', '���', '���', '����', '����', '���', '���', '���', '���', '���');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%d %B %Y, ���� %I:%M %p';

// To Arrange

$timespanfmt = '%s �����, %s ����, %s ����� and %s ������������'; 

$strAPrimaryKey = '��� �������� ������ ���������� ��� %s';
$strAbortedClients = '���������� ���������'; 
$strAbsolutePathToDocSqlDir = '�������� �������� ��� ������� �������� ���� ���������� ��� ��� ����������� ��� docSQL';  
$strAccessDenied = '\'������ ���������';
$strAccessDeniedExplanation = '�� phpMyAdmin ���������� �� �������� �� ��� ���������� MySQL ���� � ����������� ������� �� �������. �� ������ �� �������� ��� ���������, �� ����� ������ ��� ��� ������ ��������� ��� ������ ��������� config.inc.php ��� �� ����������� ��� ������������ �� ���� ��� ��� ���� ����� � ������������ ��� ���������� MySQL.'; 
$strAction = '��������';
$strAddAutoIncrement = '�������� ����� AUTO_INCREMENT';  
$strAddDeleteColumn = '��������/�������� ������ ������';
$strAddDeleteRow = '��������/�������� ������� ���������';
$strAddDropDatabase = '�������� DROP DATABASE';
$strAddIntoComments = '�������� ��� ������';
$strAddNewField = '�������� ���� ������';
$strAddPriv = '�������� ���� ���������';
$strAddPrivMessage = '���������� ��� ��������.';
$strAddPrivilegesOnDb = '�������� ��������� ���� �������� ���� ���������'; 
$strAddPrivilegesOnTbl = '�������� ��������� ���� �������� ������'; 
$strAddSearchConditions = '�������� ���� ���� (���� ��� "where" ��������):';
$strAddToIndex = '�������� ��� ��������� &nbsp;%s&nbsp;�������(��)';
$strAddUser = '�������� ���� ������';
$strAddUserMessage = '���������� ��� ��� ������.';
$strAddedColumnComment = '�� ������ ��� ������ ����������';  
$strAddedColumnRelation = '� ��������� ��� ������ ����������';  
$strAdministration = '����������'; 
$strAffectedRows = '�������������� ��������:';
$strAfter = '���� �� %s';
$strAfterInsertBack = '���������';
$strAfterInsertNewInsert = '�������� ���� ��������';
$strAll = '���';
$strAllTableSameWidth = '�������� ���� ��� ������� �� �� ���� ������;';
$strAlterOrderBy = '������ ����������� ������ ����';
$strAnIndex = '��� ��������� ���������� ��� %s';
$strAnalyzeTable = '������� ������';
$strAnd = '���';
$strAny = '�����������';
$strAnyColumn = '����������� �����';
$strAnyDatabase = '����������� ����';
$strAnyHost = '����������� �������';
$strAnyTable = '������������ �������';
$strAnyUser = '������������ �������';
$strArabic = '�������';  
$strArmenian = '��������';  
$strAscending = '�������';
$strAtBeginningOfTable = '���� ���� ��� ������';
$strAtEndOfTable = '��� ����� ��� ������';
$strAttr = '��������������';
$strAutodetect = '�������� ���������';  
$strAutomaticLayout = '�������� �������';  

$strBack = '���������';
$strBaltic = '��������';  
$strBeginCut = 'BEGIN CUT';  
$strBeginRaw = 'BEGIN RAW';  
$strBinary = '�������';
$strBinaryDoNotEdit = '������� - ����� ���������� ������������';
$strBookmarkDeleted = '� ������� ��������.';
$strBookmarkLabel = '������';
$strBookmarkQuery = '������������ ��������� SQL';
$strBookmarkThis = '���������� ����� ��� ������������ SQL';
$strBookmarkView = '���� ��������';
$strBrowse = '���������';
$strBulgarian = '����������';  
$strBzError = '�� phpMyAdmin ��� ������� �� ��������� �� ������ ������ ���� ����������� ���� �������� Bz2 ����� ��� ������� php. ����������� �� ������� ��� ���� ��� ���������� <code>$cfg[\'BZipDump\']</code> ��� ������ ��������� ��� phpMyAdmin �� <code>FALSE</code>. ��� ������ �� ��������������� ����������� ��������� ����� Bz2, �� ������ �� ������������ ��� php �� ������������� ������. ����� ��� ������� ����������� php %s ��� ������������ ������������.'; 
$strBzip = '�������� �bzip�';

$strCSVOptions = '�������� CSV';
$strCannotLogin = '��� ���� ������ � ������� �� ��� ���������� MySQL';  
$strCantLoad = '��� ���� ������ � ������� ��� ��������� %s ,<br />�������� ������� ��� ��������� ��� PHP';  
$strCantLoadMySQL = '��� ������ �� �������� � �������� MySQL,<br />�������� ������� ��� ��������� ��� PHP.';
$strCantLoadRecodeIconv = '��� ����� ������ � ������� ��� ��������� iconv � recode ��� ���������� ��� ��� ��������� ��� ��� ����������. �������� ��� php �� ��������� ��� ����� ����� ��� ���������� � ��������������� ��� ��������� ���������� ��� phpMyAdmin.'; 
$strCantRenameIdxToPrimary = '� ����������� ��� ���������� �� PRIMARY �� ����� ������!';
$strCantUseRecodeIconv = '��� ����� ������ � ����� ��� ��������� iconv ���� ��� libiconv ���� ��� �������� recode_string, ��� � �������� ���� ��������. ������ ��� ��������� ��� php.'; 
$strCardinality = '������������';
$strCarriage = '���������� ����������: \\r';
$strCentralEuropean = '��������� �������';  
$strChange = '������';
$strChangeCopyMode = '���������� ��� ������ �� �� ���� �������� ��� ...';  
$strChangeCopyModeCopy = '... ��������� ��� ������ ������.';  
$strChangeCopyModeDeleteAndReload = ' ... �������� ��� ������ ������ ��� ���� ������� ������� ��� ������������ ��� ���������.';  
$strChangeCopyModeJustDelete = ' ... �������� ��� ������ ������ ��� ���� ������� �������.';  
$strChangeCopyModeRevoke = ' ... �������� ��� ��������� ��� ������ ������ ��� �������� ���.';  
$strChangeCopyUser = '������ ��������� ��������� / ��������� ������';  
$strChangeDisplay = '�������� ����� ��� ��������';
$strChangePassword = '������ ������� ���������';
$strCharset = '��� ����������';  
$strCharsetOfFile = '��� ���������� ��� �������:'; 
$strCharsets = '��� ����������';  
$strCheckAll = '������� ����';
$strCheckDbPriv = '������� ��������� �����';
$strCheckPrivs = '������� ���������';  
$strCheckPrivsLong = '������� ��������� ��� �� ���� &quot;%s&quot;.';  
$strCheckTable = '������� ������';
$strChoosePage = '�������� �������� ������ ��� ������';  
$strColComFeat = '�������� ������� ������';
$strColumn = '�����';
$strColumnNames = '������� ������';
$strColumnPrivileges = '�������� ������'; 
$strCommand = '������'; 
$strComments = '������';  
$strCompleteInserts = '������������� ������� �Insert�';
$strCompression = '��������'; 
$strConfigFileError = '�� phpMyAdmin ��� ������� �� �������� �� ������ ���������!<br />���� ������ �� ������ ��� � php ���� ������ ����� ��� ������ � ��� � php ��� ������ �� ���� �� ������.<br />�������� ������� �� ������ ��������� ��\' ������� ��������������� �� �������� link ��� �������� �� �������� ������ ��� �� ���������� � php. ���� ������������ ����������� ����� ������� ���������� (") � ����������� (;).<br />��� � php ���������� ��� ����� ������, ��� ����� �����.'; 
$strConfigureTableCoord = '�������� ������ ��� ������������� ��� ��� ������ %s';  
$strConfirm = '���������� ������ �� �� ����������;';
$strConnections = '���������'; 
$strCookiesRequired = '��� ���� �� ������ ������ �� ����� �������������� cookies.';
$strCopyTable = '��������� ������ �� (����<b>.</b>�������):';
$strCopyTableOK = '� ������� %s ����������� ��� %s.';
$strCopyTableSameNames = '��� ����� ������ � ��������� ��� ������ ���� ����� ���!';  
$strCouldNotKill = '�� phpMyAdmin ��� ������� �� �������� �� ���������� %s. ������ �� ���� ��� ����������.'; 
$strCreate = '����������';
$strCreateIndex = '���������� ���������� �� &nbsp;%s&nbsp;�����';
$strCreateIndexTopic = '���������� ���� ����������';
$strCreateNewDatabase = '���������� ���� �����';
$strCreateNewTable = '���������� ���� ������ ��� ���� %s';
$strCreatePage = '���������� ���� �������';  
$strCreatePdfFeat = '���������� ������� PDF';
$strCriteria = '��������';
$strCroatian = '��������';  
$strCyrillic = '���������';  
$strCzech = '�������';  

$strDBComment = '������ �����: ';
$strDBGContext = 'Context';  
$strDBGContextID = 'Context ID';  
$strDBGHits = 'Hits';  
$strDBGLine = '������';  
$strDBGMaxTimeMs = '���. ������, ms';  
$strDBGMinTimeMs = '����. ������, ms';  
$strDBGModule = 'Module';  
$strDBGTimePerHitMs = '������/Hit, ms';  
$strDBGTotalTimeMs = '�����. ������, ms';  
$strDanish = '������';  
$strData = '��������';
$strDataDict = '������ ���������';  
$strDataOnly = '���� �� ��������';
$strDatabase = '���� ';
$strDatabaseExportOptions = '�������� �������� ����� ���������';
$strDatabaseHasBeenDropped = '� ���� ��������� %s ��������.';
$strDatabaseNoTable = '���� � ���� ��� �������� �������!';
$strDatabaseWildcard = '���� ��������� (������������ wildcards):';
$strDatabases = '������ ���������';
$strDatabasesDropped = '%s ������ ��������� ����������� ��������.';  
$strDatabasesStats = '���������� �����';
$strDatabasesStatsDisable = '�������������� �����������';  
$strDatabasesStatsEnable = '������������ �����������';  
$strDatabasesStatsHeavyTraffic = '��������: � ������������ ����������� ������ �� ���������� ������ �������� ��������� ������ ��� ���������� ���������� ��� ��� ���������� MySQL.';  
$strDbPrivileges = '�������� ����� ���������'; 
$strDbSpecific = '������� �����';  
$strDefault = '��������������';
$strDefaultValueHelp = '��� ��������������� �����, �������� �������� ��� ����, ����� ���������� �������� � ����������, ��������������� �� �����: a';  
$strDelOld = '� �������� ������ ���� �������� �� ������� ��� ��� �������� ���. ������ �� ��������� ����� �� ��������;';  
$strDelete = '��������';
$strDeleteAndFlush = '�������� ��� ������� ��� ������������ ��� ���������.'; 
$strDeleteAndFlushDescr = '����� ����� � ��� "�������" ������, ���� � ������������ ��� ��������� ������ �� ������������.'; 
$strDeleteFailed = '� �������� �������';
$strDeleteUserMessage = '���������� ��� ������ %s.';
$strDeleted = '� ������� ���� ���������';
$strDeletedRows = '������������ ��������:';
$strDeleting = '�������� %s'; 
$strDescending = '��������';
$strDescription = '���������';  
$strDictionary = '������';  
$strDisabled = '����������������';
$strDisplay = '��������';
$strDisplayFeat = '����������� ���������';
$strDisplayOrder = '����� ���������:';
$strDisplayPDF = '�������� �������� PDF';  
$strDoAQuery = '�������� ��� ���������� ���� ���������� (���������� ��������� "%")';
$strDoYouReally = '������ �� ���������� ��� ������';
$strDocu = '����������';
$strDrop = '��������';
$strDropDB = '�������� ����� %s';
$strDropSelectedDatabases = '�������� ����������� ������ ���������';  
$strDropTable = '�������� ������';
$strDropUsersDb = '�������� ������ ��������� ��� ����� ���� ������� �� �������.'; 
$strDumpComments = '�� �������������� �� ������ ������ �� ��������� ������ SQL';
$strDumpSaved = '�� ������ ������ ������������ �� %s.';  
$strDumpXRows = '�������� %s �������� ���������� ��� ��� ������� %s.'; 
$strDumpingData = '\'�������� ��������� ��� ������';
$strDynamic = '��������';

$strEdit = '�����������';
$strEditPDFPages = '������ ������� PDF';  
$strEditPrivileges = '����������� ���������';
$strEffective = '���������������';
$strEmpty = '\'��������';
$strEmptyResultSet = '� MySQL ��������� ��� ����� ������ ������������� (�.�. ������ �������).';
$strEnabled = '��������������';
$strEnd = '�����';
$strEndCut = 'END CUT';  
$strEndRaw = 'END RAW';  
$strEnglish = '�������';  
$strEnglishPrivileges = ' ��������: �� ������� ��������� ��� MySQL ����������� ��� ������� ';
$strError = '�����';
$strEstonian = '��������';  
$strExcelOptions = '�������� Excel';  
$strExecuteBookmarked = '�������� ������������� ������������';  
$strExplain = '������� SQL';  
$strExport = '�������';  
$strExportToXML = '������� �� ����� XML'; 
$strExtendedInserts = '����������� ������� �Insert�';
$strExtra = '��������';

$strFailedAttempts = '������������ �����������'; 
$strField = '�����';
$strFieldHasBeenDropped = '�� ����� %s ��������';
$strFields = '�����';
$strFieldsEmpty = ' � ���������� ��� ������ ����� ����! ';
$strFieldsEnclosedBy = '����� ��� ������������� ��';
$strFieldsEscapedBy = '�� ����� ������������� �� ��������� �������� ';
$strFieldsTerminatedBy = '����� ��� ���������� ��';
$strFileAlreadyExists = '�� ������ %s ������� ��� ���� ����������. �������� ����������� ����� ������� � ������������� ��� ������� ��������������.';  
$strFileCouldNotBeRead = '��� ���� ������ � �������� ��� �������';  
$strFileNameTemplate = '����� �������� �������';
$strFileNameTemplateHelp = '�������������� __DB__ ��� ����� �����, __TABLE__ ��� ����� ������ ��� %s����������� ������� strftime%s ��� ������ ����. � �������� �� ��������� ��������. ����������� ���� ������� �� ����������.';
$strFileNameTemplateRemember = '���������� ������';
$strFixed = '��������������� ������';
$strFlushPrivilegesNote = '��������: �� phpMyAdmin �������� �� �������� ��� ������� ��\' �������� ��� ���� ������� ��������� ��� MySQL. �� ����������� ����� ��� ������� ������ �� �������� ��� �� �������� ��� ������������ � ����������� ��� ����� ����� ������� �����������. �� ����� ��� ���������, �� ������ �� %s�������������� �� ��������%s ���� ����������.'; 
$strFlushTable = '���������� ("FLUSH") ������';
$strFormEmpty = '�������� ���� ��� ����� !';
$strFormat = '�����������';
$strFullText = '����� �������';
$strFunction = '�������';

$strGenBy = '������������� ���:'; 
$strGenTime = '������ �����������';
$strGeneralRelationFeat = '������� ����������� ����������';
$strGerman = '���������';  
$strGlobal = '�������';  
$strGlobalPrivileges = '������ ��������'; 
$strGlobalValue = '������ ����'; 
$strGo = '��������';
$strGrantOption = '��������'; // Grant
$strGrants = '������������';
$strGreek = '��������';  
$strGzip = '�������� �gzip�';

$strHasBeenAltered = '���� ��������.';
$strHasBeenCreated = '���� ������������.';
$strHaveToShow = '������ �� ��������� ����������� ��� ����� ��� ��������';  
$strHebrew = '�������';  
$strHome = '�������� ������';
$strHomepageOfficial = '������� ������ ��� phpMyAdmin';
$strHomepageSourceforge = '������ ��� Sourceforge ��� ��� �������� ��� phpMyAdmin';
$strHost = '�������';
$strHostEmpty = '�� ����� ��� ���������� ����� ����!';
$strHungarian = '��������';  

$strId = 'ID'; 
$strIdxFulltext = '������ �������';
$strIfYouWish = '�� ������������ �� ��������� ���� ������� ��� ��� ������ ��� ������, ��������� ��� ����� ������ ������������ �� �����.';
$strIgnore = '��������';
$strIgnoringFile = '��������� ��� ������� %s';  
$strImportDocSQL = '�������� ������� docSQL';  
$strImportFiles = '�������� �������';  
$strImportFinished = '� �������� ��������';  
$strInUse = '�� �����';
$strIndex = '���������';
$strIndexHasBeenDropped = '�� ��������� %s ��������';
$strIndexName = '����� ����������&nbsp;:';
$strIndexType = '����� ����������&nbsp;:';
$strIndexes = '���������';
$strInnodbStat = '��������� InnoDB';  
$strInsecureMySQL = '�� ������ ��������� ��� �������� ��������� (������� root ����� ������ ���������) ��� ������������ ���� ��\' ������� ���������� ������ MySQL. � ����������� MySQL ��� ��� ������ �� ���� �� �������, ����� �������� �� ��������� ��� �� ������ �� ���������� �� ��������.';  
$strInsert = '��������';
$strInsertAsNewRow = '�������� �� ��� ��������';
$strInsertNewRow = '�������� ���� ��������';
$strInsertTextfiles = '�������� ������� �������� ���� ������';
$strInsertedRowId = 'id ���������� ��������:';  
$strInsertedRows = '����������� ��������:';
$strInstructions = '�������';
$strInvalidName = '� �%s� ����� ���������� ����, ��� �������� �� ��� ��������������� �� ����� ��� ����, ������ � �����.';

$strJapanese = '��������';  
$strJumpToDB = '���������� ���� ���� &quot;%s&quot;.';  
$strJustDelete = '���� �������� ��� ������� ��� ���� ������� ���������.'; 
$strJustDeleteDescr = '�� &quot;������������&quot; ������� �� ���������� �� ����� �������� ���� ���������� ������ ���� �� �������������� �� ������� ���������.'; 

$strKeepPass = '��������� ������� ���������';
$strKeyname = '����� ��������';
$strKill = '�����������';
$strKorean = '���������';  

$strLaTeX = 'LaTeX';  
$strLaTeXOptions = '�������� LaTeX';  
$strLandscape = '��������� �������';  
$strLength = '�����';
$strLengthSet = '�����/�����*';
$strLimitNumRows = '�������� ��� ������';
$strLineFeed = '���������� ��������� �������: \\n';
$strLines = '�������';
$strLinesTerminatedBy = '������� ��� ���������� ��';
$strLinkNotFound = '��� ������� � �������';  
$strLinksTo = '������� ��';  
$strLithuanian = '����������';  
$strLoadExplanation = '� �������� ������� ����� �������������� ��\' �������, ���� �������� �� ��� �������� �� ��������.';  
$strLoadMethod = '������� LOAD';  
$strLocalhost = '������';
$strLocationTextfile = '��������� ��� ������� ��������';
$strLogPassword = '������� ���������:';
$strLogUsername = '����� ������:';
$strLogin = '�������';
$strLoginInformation = '����������� ��������'; 
$strLogout = '����������';

$strMIME_MIMEtype = '����� MIME';
$strMIME_available_mime = '���������� ����� MIME';
$strMIME_available_transform = '���������� ����������';
$strMIME_description = '���������';
$strMIME_file = '����� �������';
$strMIME_nodescription = '��� ������� ��������� ��������� ��� ���� �� ���������.<br />�������� ������������ ���� ��������� ��� ��� �� ������, �� ����� � ��������� %s.';
$strMIME_transformation = '��������� ���������';
$strMIME_transformation_note = '��� ��� ����� �� ��� ���������� ���������� ��� ��� ���������� ����� MIME, ������� %s���������� ����������%s';
$strMIME_transformation_options = '�������� ����������';
$strMIME_transformation_options_note = '�������� �������� ��� ����� ��� �� ��������� ��������������� �� �����: \'a\',\'b\',\'c\'...<br />��� ����������� �� ��������������� �������� ("\") � ���� ���������� ("\'") ���� �����, �������������� �������� (���������� \'\\\\xyz\' � \'a\\\'b\').';
$strMIME_without = '�� ����� MIME ��� ������������ �� ������ �������� ��� ����� ��������� ���������� ����������';
$strMissingBracket = '������ ��� ������';  
$strModifications = '�� ������� �������������';
$strModify = '�����������';
$strModifyIndexTopic = '������ ���� ����������';
$strMoreStatusVars = '������������ ���������� ����������'; 
$strMoveTable = '�������� ������ �� (����<b>.</b>�������):';
$strMoveTableOK = '� ������� %s ����������� ��� %s.';
$strMoveTableSameNames = '��� ����� ������ � �������� ��� ������ ���� ����� ���!';  
$strMultilingual = '������������';  
$strMustSelectFile = '������ �� ��������� �� ������ ��� ������ �� ��������.';  
$strMySQLCharset = '��� ���������� ��� MySQL';  
$strMySQLReloaded = '� MySQL ��������������.';
$strMySQLSaid = '� MySQL ��������� �� ������: ';
$strMySQLServerProcess = '� MySQL %pma_s1% ���������� ���� %pma_s2% �� %pma_s3%';
$strMySQLShowProcess = '�������� ����������';
$strMySQLShowStatus = '�������� ���������� ��������� ��� MySQL';
$strMySQLShowVars = '�������� ���������� ��� MySQL';

$strName = '�����';
$strNext = '�������';
$strNo = '���';
$strNoDatabases = '��� �������� ������ ���������';
$strNoDatabasesSelected = '��� ����� �������� ������.';  
$strNoDescription = '����� ���������';  
$strNoDropDatabases = '�� ������� �DROP DATABASE� ����� ���������������.';
$strNoExplain = '����� ������� SQL';  
$strNoFrames = '�� phpMyAdmin ����� ��� ������ �� ���� browser <b>��� ����������� frames</b>.';
$strNoIndex = '��� �������� ���������!';
$strNoIndexPartsDefined = '��� ��������� �� �������� ��� ����������!';
$strNoModification = '����� ������';
$strNoOptions = '���� � ����� ��� ���� ��������';
$strNoPassword = '����� ������ ���������';
$strNoPermission = '� ����������� ��� ���� ���������� ����������� ��� ������� %s.';  
$strNoPhp = '����� ������ PHP';  
$strNoPrivileges = '����� ��������';
$strNoQuery = '��� ������� ������ SQL!';
$strNoRights = '��� ����� ������ ���������� �� ������� ��� ����!';
$strNoSpace = '��� ������� ���������� ����� ��� ��� ���������� ��� ������� %s.';  
$strNoTablesFound = '��� �������� ������� ��� ����.';
$strNoUsersFound = '��� �������� �������.';
$strNoUsersSelected = '��� ��������� �������.'; 
$strNoValidateSQL = 'Skip Validate SQL';  
$strNone = '������';
$strNotNumber = '���� ��� ����� �������!';
$strNotOK = '�����';
$strNotSet = '� ������� <b>%s</b> ��� ������� � ��� �������� ��� %s';  
$strNotValidNumber = ' ��� ����� �������� ������� ��������!';
$strNull = '����';
$strNumSearchResultsInTable = '%s ������������ ���� ������ <i>%s</i>';
$strNumSearchResultsTotal = '<b>������:</b> <i>%s</i> ������������';
$strNumTables = '�������'; 

$strOK = 'OK';
$strOftenQuotation = '����� ����������. �� OPTIONALLY �������� ��� ���� �� ����� char ��� varchar ������������� �� ��� ��������� ���������������� ����.';
$strOperations = '�����������';  
$strOptimizeTable = '�������������� ������';
$strOptionalControls = '�����������. �������� ��� �� ������� � �������� ��� � ������� ������� ����������.';
$strOptionally = '�����������';
$strOptions = '��������';  
$strOr = '�';
$strOverhead = '����������';
$strOverwriteExisting = '������������� ���������� �������';  

$strPHP40203 = '�������������� ��� PHP 4.2.3, � ����� ���� ��� ������ �������� �� ������������� ����� multi-byte (mbstring). ����� �� ������� ����������� PHP 19404. ���� � ������ ��� PHP ��� ����������� ��� ����� �� �� phpMyAdmin.';  
$strPHPVersion = '������ PHP';
$strPageNumber = '������:';  
$strPaperSize = '������� �������';  
$strPartialText = '��������� �������';
$strPassword = '������� ���������';
$strPasswordChanged = '� ������� ��������� ��� ��� ������ %s ������ ��������.'; 
$strPasswordEmpty = '� ������� ��������� ����� �����!';
$strPasswordNotSame = '�� ������� ��������� ��� ����� �����!';
$strPdfDbSchema = '����� ��� ����� "%s" - ������ %s';  
$strPdfInvalidPageNum = '��� �������� ������� ������� PDF!';  
$strPdfInvalidTblName = '� ������� "%s" ��� �������!';  
$strPdfNoTables = '��� �������� �������';
$strPerHour = '��� ���'; 
$strPerMinute = '��� �����';
$strPerSecond = '��� ������������';
$strPhoneBook = '���. ���������';  
$strPhp = '���������� ������ PHP';  
$strPmaDocumentation = '���������� phpMyAdmin';
$strPmaUriError = '� ������ <tt>$cfg[\'PmaAbsoluteUri\']</tt> ������ �� ������� ��� ������ ���������!';
$strPortrait = '������ �������';  
$strPos1 = '����';
$strPrevious = '�����������';
$strPrimary = '��������';
$strPrimaryKey = '�������� ������';
$strPrimaryKeyHasBeenDropped = '�� �������� ������ ��������';
$strPrimaryKeyName = '�� ����� ��� ����������� �������� ������ �� �����... PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>������</b> �� ����� �� ����� ��� ����������� �������� ��� <b>���� �����</b> !)';
$strPrint = '��������';  
$strPrintView = '�������� ��� ��������';
$strPrivDescAllPrivileges = '������������ ��� �� �������� ����� ��� �� GRANT.'; 
$strPrivDescAlter = '��������� ��� ������ ����� ��� ���������� �������.'; 
$strPrivDescCreateDb = '��������� �� ���������� ���� ������ ��� �������.'; 
$strPrivDescCreateTbl = '��������� �� ���������� ���� �������.'; 
$strPrivDescCreateTmpTable = '��������� �� ���������� ���������� �������.'; 
$strPrivDescDelete = '��������� �� �������� ���������.'; 
$strPrivDescDropDb = '��������� �� �������� ������ ��� �������.'; 
$strPrivDescDropTbl = '��������� �� �������� �������.'; 
$strPrivDescExecute = '��������� ��� �������� ������������� ��������. ��� ���� ����� �� ����� ��� ������ MySQL version.'; 
$strPrivDescFile = '��������� ��� �������� ��� ������� ��������� ��� ��� �� ������.'; 
$strPrivDescGrant = '��������� ��� �������� ������� ��� ��������� ����� �� �������������� ���� ������� ���������.'; 
$strPrivDescIndex = '��������� ��� ���������� ��� ��� �������� ����������.'; 
$strPrivDescInsert = '��������� ��� �������� ��� ��� ������������� ���������.'; 
$strPrivDescLockTables = '��������� �� �������� ������� ��� ��� �������� ����������.'; 
$strPrivDescMaxConnections = '���������� ��� ������ ��� ���� ��������� ��� � ������� ������ �� ��������� ��� ���.';
$strPrivDescMaxQuestions = '���������� ��� ������ ��� ������������ ��� � ������� ������ �� ������� ���� ���������� ��� ���.';
$strPrivDescMaxUpdates = '���������� ��� ������ ��� ������� ������� � ������ ��� � ������� ������ �� ���������� ��� ���.';
$strPrivDescProcess3 = '��������� ��� ������� ���������� ����� �������.'; 
$strPrivDescProcess4 = '��������� ��� �������� ������������� ������������ ��� ����� ����������.'; 
$strPrivDescReferences = '��� ���� ����� �� ����� ��� ������ MySQL.'; 
$strPrivDescReload = '��������� ��� ������������ ��� ���������� ��� ��� ��������� ��� ���������� ������� ���.'; 
$strPrivDescReplClient = '����� �� �������� ���� ������ �� ���� ��� ����� �� ������ ��� ������������� �����������.'; 
$strPrivDescReplSlave = '���������� ��� ���� ������������� ����������� ������������.'; 
$strPrivDescSelect = '��������� ��� �������� ���������.'; 
$strPrivDescShowDb = '����� �������� ���� ����� ����� ��� ������ ���������.'; 
$strPrivDescShutdown = '��������� ��� ������� ����������� ��� ����������.'; 
$strPrivDescSuper = '��������� �� �������, ����� ��� ���� � �������� ������� ��������� ���� ��������; ���������� ��� ��� ������������ ����������� ����������� ���� � ������� ������� ���������� � �� ������� ����������� ����� �������.'; 
$strPrivDescUpdate = '��������� ��� ������ ���������.'; 
$strPrivDescUsage = '����� ��������.'; 
$strPrivileges = '��������';
$strPrivilegesReloaded = '�� �������� ��������������� ��������.'; 
$strProcesslist = '����� ����������'; 
$strProperties = '���������';
$strPutColNames = '�������� �������� ������ ���� ����� ������';  

$strQBE = '��������� ���� ����������';
$strQBEDel = '��������';
$strQBEIns = '��������';
$strQueryFrame = '�������� ������������';
$strQueryFrameDebug = '����������� ��������� �����������';
$strQueryFrameDebugBox = '������� ���������� ��� �� ����� ������������:\n��: %s\n�������: %s\n�����������: %s\n\n��������� ���������� ��� �� ����� ������������:\n��: %s\n�������: %s\n�����������: %s\n\n��������� ��������� ������: %s\n��������� frameset: %s.';
$strQueryOnDb = '������ SQL ��� ���� <b>%s</b>:';
$strQuerySQLHistory = '�������� SQL';
$strQueryStatistics = '<b>���������� ������������</b>: ��� ��� ������ �����������, %s ����������� ����� ������ ���� ����������.';
$strQueryTime = '�� ��������� ���������� %01.4f ����/��';
$strQueryType = '����� ������������'; 
$strQueryWindowLock = '�� ��� ������� �� ��������� ��� ��������� ����';  

$strReType = '�������������';
$strReceived = '��������'; 
$strRecords = '��������';
$strReferentialIntegrity = '������� ������������ �������:';
$strRelationNotWorking = '�� ������������ ����������� ��� ������� �� �������������� ������� ����� ���������������. ��� �� ������ �����, ������� %s���%s.';
$strRelationView = '�������� �������';  
$strRelationalSchema = '�������� �����';  
$strRelations = '�������';  
$strReloadFailed = '� ������������ ��� MySQL �������.';
$strReloadMySQL = '������������ ��� MySQL';
$strReloadingThePrivileges = '������������ ���������'; 
$strRememberReload = '����������: ������ �� �������������� ��� ����������.';
$strRemoveSelectedUsers = '�������� ��� ����������� �������'; 
$strRenameTable = '����������� ������ ��';
$strRenameTableOK = '� ������� %s ������������� �� %s';
$strRepairTable = '����������� ������';
$strReplace = '�������������';
$strReplaceNULLBy = '������������� ����� NULL ��';  
$strReplaceTable = '������������� ��������� ������ �� �� ������';
$strReset = '���������';
$strResourceLimits = '���� �����'; 
$strRevoke = '��������';
$strRevokeAndDelete = '�������� ���� ��� ������� ��������� ��� ���� ������� ��� �������� ����.'; 
$strRevokeAndDeleteDescr = '�� ������� �� ���������� �� ����� �� �������� USAGE ������ ���� �������������� �� ��������.'; 
$strRevokeGrant = '�������� �����������';
$strRevokeGrantMessage = '����������� �� �������� ����������� ��� %s';
$strRevokeMessage = '����������� �� �������� ��� %s';
$strRevokePriv = '�������� ���������';
$strRowLength = '������� �������';
$strRowSize = ' ������� �������� ';
$strRows = '��������';
$strRowsFrom = '�������� ���������� ��� ��� �������';
$strRowsModeFlippedHorizontal = '��������� (���������� ������������)';
$strRowsModeHorizontal = '���������';
$strRowsModeOptions = '�� %s ����� �� ��������� ������������ ��� %s �����';
$strRowsModeVertical = '������';
$strRowsStatistic = '���������� ��������';
$strRunQuery = '������� ������������';
$strRunSQLQuery = '�������� �������/������� SQL ��� ���� ��������� %s';
$strRunning = '��� ���������� ��� %s';
$strRussian = '�������';  

$strSQL = 'SQL'; 
$strSQLOptions = '�������� SQL';
$strSQLParserBugMessage = '������� ��������� �� ���������� ��� �������� ���� SQL parser. �������� �������� �� ��������� ��� ���������� ��� ������� ��� ��� �� ���������� �������� ��� �������� �����. \'����� ������� ������ ������� �� ����� � �������� ������� �� ������� ������ ����� �����������. �������� ������ �� ���������� �� ��������� ��� ��� ������ ������� ��� MySQL.  ��� ���������� �� ����� ��������, � ��� � parser ����������� ���� � ������ ������� �����������, �������� ���������� �� ��������� ������ ��� ���������� �� �������� ��� ������� ������� ������ �� �� �������� ��� ���������� ��� ����� CUT ��� ���������:';  
$strSQLParserUserError = '�������� �� ������� ��� ����� ��� ��������� ���. �� ������ ����� ���������� MySQL, ��� ������� ������, ������ ������ �� ��� �������� �� ���������� �� ��������.';
$strSQLQuery = '������ SQL';
$strSQLResult = '���������� SQL'; 
$strSQPBugInvalidIdentifer = '\'������� �������������';  
$strSQPBugUnclosedQuote = '������� ����������';  
$strSQPBugUnknownPunctuation = '\'������� ������ ������';  
$strSave = '����������';
$strSaveOnServer = '���������� ���� ���������� ���� ������ %s';  
$strScaleFactorSmall = '� ������� ����� ���� ����� ��� �� ���������� �� ����� �� ��� ������';  
$strSearch = '���������';
$strSearchFormTitle = '��������� ��� ����';
$strSearchInTables = '���� ����� �������:';
$strSearchNeedle = '���� � ����� ��� ��������� (���������: "%"):';
$strSearchOption1 = '����������� ���� ��� ���� �����';
$strSearchOption2 = '����� ���� �����';
$strSearchOption3 = '��� ������ �����';
$strSearchOption4 = '�� regular expression';
$strSearchResultsFor = '������������ ���������� ��� "<i>%s</i>" %s:';
$strSearchType = '������:';
$strSecretRequired = '�� ������ ��������� ���������� ���� ��� ������� �����-������ (blowfish_secret).';  
$strSelect = '�������';
$strSelectADb = '�������� �������� ��� ���� ���������';
$strSelectAll = '������� ����';
$strSelectFields = '������� ������ (����������� ���)';
$strSelectNumRows = '���� ������';
$strSelectTables = '������� �������';  
$strSend = '��������';
$strSent = '���������'; 
$strServer = '����������� %s';  
$strServerChoice = '������� ����������';
$strServerStatus = '����������� ���������'; 
$strServerStatusUptime = '����� � ����������� MySQL ���������� ��� %s. �������� ���� %s.'; 
$strServerTabProcesslist = '����������'; 
$strServerTabVariables = '����������'; 
$strServerTrafficNotes = '<b>������ ����������</b>: ����� �� ������� �������� ���������� ������ ������� ����� ��� ���������� MySQL ��� ��� ������ ��� ����������� ���.';
$strServerVars = '��������� ��� ���������� ��� ����������'; 
$strServerVersion = '������ ����������';
$strSessionValue = '���� Session'; 
$strSetEnumVal = '�� � ����� ��� ������ ����� �enum� � �set�, �������� �������� ��� ����� ��������������� ��� ���� �����: \'�\',\'�\',\'�\'...<br /> �� ���������� �� �������� ��� ������� ������ ("\") � ���� ���������� ("\'"), �������� �� �� ������� ������ ���� ���� (��� ���������� \'\\\\���\' � \'�\\\'�\').';
$strShow = '��������';
$strShowAll = '�������� ����';
$strShowColor = '�������� ��������';  
$strShowCols = '�������� ������';
$strShowDatadictAs = '����� ������� ���������';  
$strShowFullQueries = '������ �������� ������������';  
$strShowGrid = '�������� ���������';  
$strShowPHPInfo = '�������� ����������� ��� PHP';
$strShowTableDimension = '�������� ���������� �������';  
$strShowTables = '�������� �������';
$strShowThisQuery = ' �������� ��� ���� ���� �� ���������';
$strShowingRecords = '�������� �������� ';
$strSimplifiedChinese = '������������ ��������';  
$strSingly = '(��������)';
$strSize = '�������';
$strSort = '����������';
$strSpaceUsage = '����� �����';
$strSplitWordsWithSpace = '�� ������ ���������� ��� ��� ��������� ����������� (" ").';
$strStatCheckTime = '���������� �������';
$strStatCreateTime = '����������';
$strStatUpdateTime = '��������� ���������';
$strStatement = '��������';
$strStatus = '���������'; 
$strStrucCSV = '�������� CSV';
$strStrucData = '���� ��� ��������';
$strStrucDrop = '�������� �Drop Table�';
$strStrucExcelCSV = '����� CSV ��� �������� MS Excel';
$strStrucOnly = '���� � ����';
$strStructPropose = '������������ ���� ������';  
$strStructure = '����';  
$strSubmit = '��������';
$strSuccess = '� SQL ������ ��� ����������� ��������';
$strSum = '������';
$strSwedish = '��������';  
$strSwitchToTable = '�������� ���� ������������ ������';  

$strTable = '������� ';
$strTableComments = '������ ������';
$strTableEmpty = '�� ����� ��� ������ ����� ����!';
$strTableHasBeenDropped = '� ������� %s ��������';
$strTableHasBeenEmptied = '� ������� %s �������';
$strTableHasBeenFlushed = '� ������� %s ������������� ("FLUSH")';
$strTableMaintenance = '��������� ������';
$strTableOfContents = '������� ������������';  
$strTableOptions = '�������� ������';  
$strTableStructure = '���� ������ ��� ��� ������';
$strTableType = '����� ������';
$strTables = '%s �������/�������';
$strTblPrivileges = '�������� �������'; 
$strTextAreaLength = ' �������� ��� ������� ���,<br /> ���� �� ����� ���� �� �� ������ �� ��������� ';
$strThai = '����������';  
$strTheContent = '�� ����������� ��� ������� ��� ����� ��������.';
$strTheContents = '�� ����������� ��� ������� ������������� �� ����������� ��� ����������� ������ ��� ������� �� ���� �������� � �������� ������.';
$strTheTerminator = '� ���������� ���������� ��� ������.';
$strThisHost = '����� � �����������'; 
$strThisNotDirectory = '��� ���� �������';  
$strThreadSuccessfullyKilled = '� ���������� %s �������.'; 
$strTime = '������'; 
$strToggleScratchboard = '(��)������������ ������ ����������';  
$strTotal = '��������';
$strTotalUC = '������'; 
$strTraditionalChinese = '����������� ��������';  
$strTraffic = '������'; 
$strTransformation_image_jpeg__inline = '��������� ��� ������ �������������� �� ��������; ��������: ������, ���� �� pixels (�������� ��� ������� ���������)';
$strTransformation_image_jpeg__link = '��������� ���� �������� ��� ����� ��� ������.';
$strTransformation_image_png__inline = '����� image/jpeg: inline';  
$strTransformation_text_plain__dateformat = '������� ��� ����� TIME, TIMESTAMP � DATETIME ��� �� ���������� ��������������� ��� ������ �����. � ����� ������� ����� � ������� (�� ����) ��� �� ��������� ���� ��� (��\' �������: 0). � ������� ������� ����� ����� ����������� ���� �������� ��� ��� ���������� ����������� ��� ������� strftime() ��� PHP.';
$strTransformation_text_plain__external = '���� ��� LINUX: ������� ��� ��������� �������� ��� ������� �� �������� ���� \'standard input\'. ���������� �� ���������� ��� ���������. ��\' ������� ���� ����� �� Tidy, ��� ������� ������������� ������ HTML. ��� ������ ���������, ������ ����������� �� �������� �� ������ libraries/transformations/text_plain__external.inc.php ��� �� �������� ��� ��������� ��� ����� ���������� �� �����������. � ����� ������� ����� � ������� ��� ��������� ��� ������ �� ��������������� ��� � ������� ������� ����� �� ���������� ���. � ����� �������, �� ����� �� 1 �� ���������� �� ���������� ��������������� ��� ������ htmlspecialchars() (��\' ������� ����: 1). � ������� �������, �� ����� �� 1 �� ������� NOWRAP ��� ���� ������������ ����� ���� ��� �� ���������� �� ���������� ����� ������� ���� ������� (��\' ������� ����: 1)';
$strTransformation_text_plain__formatted = '�������� ��� ������ ����������� ��� ������. ��� ���������������� ���������� ��������.';
$strTransformation_text_plain__imagelink = '��������� ��� ������ ��� ��� ��������, �� ����� �������� �� ����� �������. � ����� ������� ����� ��� ������� ���� "http://domain.com/", � ������� ������� ����� �� ������ �� pixels, � ����� ����� �� ����.';  
$strTransformation_text_plain__link = '��������� ��� ��������, �� ����� �������� �� ����� �������. � ����� ������� ����� ��� ������� ���� "http://domain.com/", � ������� ������� ����� ���� ������ ��� ��� ��������.';  
$strTransformation_text_plain__substr = '��������� ���� ����� ���� ��������������. � ����� ������� ����� � ���� ���� ����� ������ � �������� ��� �������� (��\' ������� 0). � ������� ������� ����� �� ����� ��� ��������. �� ������ ���� �� ���������� ��� �� �������������. � ����� ������� ��������� ����� ���������� �� ���������� �� ������� ���� ����������� ����� ��� (��\' �������: ...) .';
$strTransformation_text_plain__unformatted = '��������� ��� ������ HTML �� ��������� HTML. ��� ������� ����������� HTML.';
$strTruncateQueries = '������� ������������� ������������';  
$strTurkish = '��������';  
$strType = '�����';

$strUkrainian = '���������';  
$strUncheckAll = '��������� ����';
$strUnicode = 'Unicode';  
$strUnique = '��������';
$strUnknown = '�������';  
$strUnselectAll = '��������� ����';
$strUpdComTab = '�������� �������� ���� ���������� ��� �� ��� �������� �� ���������� ��� ������ Column_comments';  
$strUpdatePrivMessage = '�� �������� ��� ������ %s ������������.';
$strUpdateProfile = '��������� ���������:';
$strUpdateProfileMessage = '�� �������� �����������.';
$strUpdateQuery = '��������� ��� �������';
$strUsage = '�����';
$strUseBackquotes = '����� �������� ����������� ��� ������� ��� ������� ��� ��� ������';
$strUseHostTable = 'Use Host Table';  
$strUseTables = '����� �������';
$strUseTextField = '�������������� �� ����� ��������'; 
$strUseThisValue = '����� ����� ��� �����';  
$strUser = '�������';
$strUserAlreadyExists = '� ������� %s ������� ���!'; 
$strUserEmpty = '�� ����� ��� ������ ����� ����!';
$strUserName = '����� ������';
$strUserNotFound = '� ����������� ������� ��� ������� ���� ������ ���������.'; 
$strUserOverview = '�������� �������'; 
$strUsers = '�������';
$strUsersDeleted = '�� ����������� ������� ����������� ��������.'; 
$strUsersHavingAccessToDb = '������� �� �������� ��� ���� &quot;%s&quot;';  

$strValidateSQL = '��������� SQL';  
$strValidatorError = '� ���������� SQL ��� ������� �� �������������. �������� ������� ��� ����� ������������ ��� ����������� ���������� ��� php ���� ������������ ���� %sdocumentation%s.'; 
$strValue = '����';
$strVar = '���������'; 
$strViewDump = '�������� �������� ��� ������';
$strViewDumpDB = '�������� �������� ��� �����';
$strViewDumpDatabases = '��������� �������� ������';

$strWebServerUploadDirectory = '������������ ����������� ������� ����������';  
$strWebServerUploadDirectoryError = '� ������������ ��� ������� ��� ��� ���������� ������� ��� ������� �� ������';  
$strWelcome = '����������� ��� %s';
$strWestEuropean = '������� �������';  
$strWildcard = '���������';  
$strWindowNotFound = '��� ���� ������ �� ��������� �� target �������� ��� ���������. ���� �������� �� parent �������� � � ���������� ��� ��� ��������� ��� ���������� ������ ��������� ���� ��������� ���������.';  
$strWithChecked = '�� ���� ������������:';
$strWritingCommentNotPossible = '� ������� ��� ������� ��� ���� ������';  
$strWritingRelationNotPossible = '� ������� ��� ������ ��� ���� ������';  
$strWrongUser = '���������� ����� ������/������� ���������. \'������ ���������.';

$strXML = 'XML';

$strYes = '���';

$strZeroRemovesTheLimit = '��������: �� ������� ����� ��� �������� �� 0 (�����) ��������� � �����������.'; 
$strZip = '�������� �zip�';
// To Translate

$strBrowseForeignValues = 'Browse foreign values';  //to translate

$strCaseInsensitive = 'case-insensitive';  //to translate
$strCaseSensitive = 'case-sensitive';  //to translate
$strCharsetsAndCollations = 'Character Sets and Collations';  //to translate
$strCollation = 'Collation';  //to translate

?>
