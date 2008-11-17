<?php
/* $Id: chinese_big5.inc.php,v 1.2 2008/10/07 13:18:01 robert Exp $ */

/**
 * Last translation by: Siu Sun <siusun@best-view.net>
 * Follow by the original translation of Taiyen Hung �x��<yen789@pchome.com.tw>
 */

$charset = 'big5';
$allow_recoding = TRUE;
$text_dir = 'ltr';
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'helvetica, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
$month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y, %I:%M %p';

$timespanfmt = '%s ��, %s �p��, %s ���� %s ��';


$strAPrimaryKey = '�D��w�g�s�W�� %s';
$strAbortedClients = '���';
$strAbsolutePathToDocSqlDir = '�п�J docSQL �ؿ����A���������|';
$strAccessDenied = '�ڵ��s��';
$strAccessDeniedExplanation = 'phpMyAdmin �xճs�u�� MySQL ��A��, ���A���ڵ��F�s�u. �z3�� config.inc.php ���ˬd�D��W��, �n�J�W�٤αK�X�νT�O�o�Ǹ�ƬO�P�t�κ޲z�H��Ҵ��Ѫ� MySQL ��A����ƬۦP';
$strAction = '���';
$strAddAutoIncrement = "�s�W AUTO_INCREMENT �ƭ�";
$strAddDeleteColumn = '�s�W/��� �����';
$strAddDeleteRow = '�s�W/��� �z��C';
$strAddDropDatabase = '�[�J \'�R����ƪ�\' �y�k';
$strAddIntoComments = '�[�J��Ѥ�r';
$strAddNewField = '�W�[�s���';
$strAddPriv = '�W�[�s�v��';
$strAddPrivMessage = '�z�w�g���U���o��ϥΪ̼W�[�F�s�v��.';
$strAddPrivilegesOnDb = '��H�U��Ʈw�[�J�v��';
$strAddPrivilegesOnTbl = '��H�U��ƪ�[�J�v��';
$strAddSearchConditions = '�W�[�˯q�� ("where" �l�y���D��)';
$strAddToIndex = '�s�W &nbsp;%s&nbsp; �կd���';
$strAddUser = '�s�W�ϥΪ�';
$strAddUserMessage = '�z�w�s�W�F�@�ӷs�ϥΪ�.';
$strAddedColumnComment = '��H�U���[�J��Ѥ�r';
$strAddedColumnRelation = '��H�U���[�J���p';
$strAdministration = '�t�κ޲z';
$strAffectedRows = '�v�T�C��: ';
$strAfter = '�b %s ����';
$strAfterInsertBack = '��^';
$strAfterInsertNewInsert = '�s�W�@���O��';
$strAll = '����';
$strAllTableSameWidth = '�H�ۦP�e����ܩҦ���ƪ�?';
$strAlterOrderBy = '�ھ���줺�e�ƧǰO��';
$strAnIndex = '�dޤw�g�s�W�� %s';
$strAnalyzeTable = '�*R��ƪ�';
$strAnd = '�P';
$strAny = '���';
$strAnyColumn = '������';
$strAnyDatabase = '����Ʈw';
$strAnyHost = '���D��';
$strAnyTable = '����ƪ�';
$strAnyUser = '���ϥΪ�';
$strArabic = '��ԧB��';
$strArmenian = '��^��';
$strAscending = '���W';
$strAtBeginningOfTable = '���ƪ�}�Y';
$strAtEndOfTable = '���ƪ�:�';
$strAttr = '�ݩ�';
$strAutodetect = '�۰ʰ���';
$strAutomaticLayout = '�۰ʮ榡';

$strBack = '�^�W�@��';
$strBaltic = '�iù�����';
$strBeginCut = '�}�l �Ũ�';
$strBeginRaw = '�}�l ��l���';
$strBinary = '�G�i��X';
$strBinaryDoNotEdit = '�G�i��X - ����s��';
$strBookmarkDeleted = '���Ҥw�g�R��.';
$strBookmarkLabel = '���ҦW��';
$strBookmarkQuery = 'SQL �y�k����';
$strBookmarkThis = '�N�� SQL �y�k�[�J����';
$strBookmarkView = '�d��';
$strBrowse = '�s��';
$strBulgarian = '�O�[�Q�Ȥ�';
$strBzError = 'phpMyAdmin �L�k#�Y�]��o�� php ������ Bz2 �Ҳտ�~. �j�C�n�D�� phpMyAdmin �]�w�ɳ]�w <code>$cfg[\'BZipDump\']</code> ��<code>FALSE</code>. �p�G�Q�ϥ� Bz2 #�Y�\��,�Ч�s php ��̷s����. �Ա��аѬ� php ��~��� %s .';
$strBzip = '"bzipped"';

$strCSVOptions = 'CSV �ﶵ';
$strCannotLogin = '�L�k�n�J MySQL ��A��';
$strCantLoad = '�L�kŪ�� %s �Ҳ�,<br />���ˬd PHP �]�w';
$strCantLoadMySQL = '�����J MySQL �Ҳ�,<br />���ˬd PHP ���պA�]�w';
$strCantLoadRecodeIconv = '����Ū�� iconv �έ��s�s�X�{���ӧ@��r�s�X�ഫ, �г]�w php �ӱҰʳo�ǼҲթΨ�� phpMyAdmin �ϥΤ�r�s�X�ഫ�\��.';
$strCantRenameIdxToPrimary = '�L�k�N�dާ�W�� PRIMARY!';
$strCantUseRecodeIconv = '���s�X�Ҳ�Ū���,����ϥ� iconv �B libiconv �� recode_string �\��. ���ˬd�z�� php �]�w.';
$strCardinality = '�էO';
$strCarriage = '�k��: \\r';
$strCaseInsensitive = '�j�p�g���۲�';
$strCaseSensitive = '�j�p�g�۲�';
$strCentralEuropean = '���ڻy��';
$strChange = '�ק�';
$strChangeCopyMode = '�إ߷s�ϥΪ̤ΨϥάۦP���v��, �� ...';
$strChangeCopyModeCopy = '... �O�d�¨ϥΪ�.';
$strChangeCopyModeDeleteAndReload = ' ... �R���¨ϥΪ̤έ��sŪ���v����ƪ�.';
$strChangeCopyModeJustDelete = ' ... �R���¨ϥΪ�.';
$strChangeCopyModeRevoke = ' ... �o���Ҧ��¨ϥΪ̦��Ĥ��v���çR��.';
$strChangeCopyUser = '���n�J��T / �ƻs�ϥΪ�';
$strChangeDisplay = '�����ܤ����';
$strChangePassword = '���K�X';
$strCharset = '��r�榡 (Charset)';
$strCharsetOfFile = '�r�����ɮ�:';
$strCharsets = '�r����';
$strCharsetsAndCollations = '�r�����ήչ�';
$strCheckAll = '����';
$strCheckDbPriv = '�ˬd��Ʈw�v��';
$strCheckPrivs = '�d���v��';
$strCheckPrivsLong = '�d�߸�Ʈw &quot;%s&quot; ���v��.';
$strCheckTable = '�ˬd��ƪ�';
$strChoosePage = '�п�ܻݭn�s�誺���X';
$strColComFeat = '��������';
$strCollation = '�չ�';
$strColumn = '���';
$strColumnNames = '���W��';
$strColumnPrivileges = '��w����v��';
$strCommand = '��O';
$strComments = '���';
$strCompleteInserts = '�ϥΧ���s�W��O';
$strCompression = '#�Y';
$strConfigFileError = 'phpMyAdmin';
$strConfigureTableCoord = '�г]�w��� %s ��������';
$strConfirm = '�z�T�w�n�o�˰��H';
$strConnections = '�s�u';
$strCookiesRequired = 'Cookies �����Ұʤ~��n�J.';
$strCopyTable = '�ƻs��ƪ��G (�榡�� ��Ʈw�W��<b>.</b>��ƪ�W��):';
$strCopyTableOK = '�w�g�N��ƪ� %s �ƻs�� %s.';
$strCopyTableSameNames = '�L�k�ƻs��ۦP��ƪ�!';
$strCouldNotKill = 'phpMyAdmin �L�k���_��O %s. �i��o��O�w�g����.';
$strCreate = '�إ�';
$strCreateIndex = '�s�W &nbsp;%s&nbsp; �կd���';
$strCreateIndexTopic = '�s�W�@�կd�';
$strCreateNewDatabase = '�إ߷s��Ʈw';
$strCreateNewTable = '�إ߷s��ƪ���Ʈw %s';
$strCreatePage = '�إ߷s�@��';
$strCreatePdfFeat = '�إ� PDF';
$strCriteria = '�z��';
$strCroatian = '�Jù��Ȥ�';
$strCyrillic = '�訽����';
$strCzech = '���J��';

$strDBComment = '��Ʈw��Ѥ�r: ';
$strDBGContext = '���� (Context)';
$strDBGContextID = '���� (Context) ID';
$strDBGHits = '����';
$strDBGLine = '��';
$strDBGMaxTimeMs = '�̤j�ɶ�, ms';
$strDBGMinTimeMs = '�̤p�ɶ�, ms';
$strDBGModule = '�Ҳ�';
$strDBGTimePerHitMs = '�ɶ�/��, ms';
$strDBGTotalTimeMs = '�`�ɶ�, ms';
$strDanish = '���d�';
$strData = '���';
$strDataDict = '�ƾڦr��';
$strDataOnly = '�u�����';
$strDatabase = '��Ʈw';
$strDatabaseExportOptions = '��Ʈw��X�ﶵ';
$strDatabaseHasBeenDropped = '��Ʈw %s �w�Q�R��';
$strDatabaseNoTable = '�o��Ʈw�S����ƪ�!';
$strDatabaseWildcard = '��Ʈw (���\�ϥθU�Φr��):';
$strDatabases = '��Ʈw';
$strDatabasesDropped = '%s �Ӹ�Ʈw�w���\�R��.';
$strDatabasesStats = '��Ʈw�έp';
$strDatabasesStatsDisable = '����έp�ƾ�';
$strDatabasesStatsEnable = '�Ұʲέp�ƾ�';
$strDatabasesStatsHeavyTraffic = '��: �Ұʸ�Ʈw�έp�ƾڥi��|���ͤj�q�� Web ��A���� MySQL �������y�q.';
$strDbPrivileges = '��w��Ʈw�v��';
$strDbSpecific = '��w��Ʈw';
$strDefault = '�w�]��';
$strDefaultValueHelp = '�w�]��: �Хu��J�ӹw�]��, �L�ݥ[�W���ϱ׽u�Τ޸�';
$strDelOld = '�������ѦҨ��ƪ�w���s�b. �z�Ʊ�R���o�ǰѦҶ�?';
$strDelete = '�R��';
$strDeleteAndFlush = '�R���ϥΪ̤έ��sŪ���v��.';
$strDeleteAndFlushDescr = '�o�O�@�ӳ̲M�䪺���k,��sŪ���v���ݤ@�q�ɶ�.';
$strDeleteFailed = '�R������!';
$strDeleteUserMessage = '�z�w�g�N�ϥΪ� %s �R��.';
$strDeleted = '�O��w�Q�R��';
$strDeletedRows = '�w�R�����:';
$strDeleting = '�R�� %s';
$strDescending = '����';
$strDescription = '����';
$strDictionary = '�r��';
$strDisabled = '���Ұ�';
$strDisplay = '���';
$strDisplayFeat = '�\�����';
$strDisplayOrder = '��ܦ���';
$strDisplayPDF = '��� PDF ���n';
$strDoAQuery = '�H�d�Ҭd�� (�U�Φr�� : "%")';
$strDoYouReally = '�z�T�w�n ';
$strDocu = '������';
$strDrop = '�R��';
$strDropDB = '�R����Ʈw %s';
$strDropSelectedDatabases = '�R���w��ܤ���Ʈw';
$strDropTable = '�R����ƪ�';
$strDropUsersDb = '�R���P�ϥΪ̬ۦP�W�٤���Ʈw.';
$strDumpComments = '�[�J����ѧ@������ SQL-���';
$strDumpSaved = '�ƥ�w�x���ɮ� %s.';
$strDumpXRows = '�ƥ� %s ��, �� %s ��}�l.';
$strDumpingData = '�C�X�H�U��Ʈw���ƾڡG';
$strDynamic = '�ʺA';

$strEdit = '�s��';
$strEditPDFPages = '�s�� PDF ���X';
$strEditPrivileges = '�s���v��';
$strEffective = '���';
$strEmpty = '�M��';
$strEmptyResultSet = 'MySQL �Ǧ^���d�ߵ��G���� (��]�i�ର�G�S�����ŦX��󪺰O��)';
$strEnabled = '�Ұ�';
$strEnd = '�̫�@��';
$strEndCut = '���� �Ũ�';
$strEndRaw = '���� ��l���';
$strEnglish = '�^��';
$strEnglishPrivileges = '�`�N: MySQL �v���W�ٷ|�H�^�y���';
$strError = '��~';
$strEstonian = '�R�F���Ȥ�';
$strExcelOptions = 'Excel �ﶵ';
$strExecuteBookmarked = '�����Ҭd��';
$strExplain = '���� SQL';
$strExport = '��X';
$strExportToXML = '��X�� XML �榡';
$strExtendedInserts = '��s�W�Ҧ�';
$strExtra = '���[';

$strFailedAttempts = '�xե���';
$strField = '���';
$strFieldHasBeenDropped = '��ƪ� %s �w�Q�R��';
$strFields = '���';
$strFieldsEmpty = ' ����`�ƬO�Ū�! ';
$strFieldsEnclosedBy = '�u���v�ϥΦr���G';
$strFieldsEscapedBy = '�uESCAPE�v�ϥΦr���G';
$strFieldsTerminatedBy = '�u���9j�v�ϥΦr���G';
$strFileAlreadyExists = '�ɮ� %s �w�s�b,�Ч���ɮצW�٩ο�ܡu�мg�v�s�b�ɮסv�ﶵ.';
$strFileCouldNotBeRead = 'Ū�׵L�kŪ��';
$strFileNameTemplate = '�ɮצW�ټ˦�';
$strFileNameTemplateHelp = '�ϥ� __DB__ �@����Ʈw�W��, __TABLE__ ����ƪ�W��. %s��� strftime%s �����ɶ��Ϊ��[�ﶵ�|�۰ʥ[�J. ��L��r�N�|�O�d.';
$strFileNameTemplateRemember = '�O�d�˦��W��';
$strFixed = '�T�w';
$strFlushPrivilegesNote = '��: phpMyAdmin ������ MySQL �v����ƪ��o�ϥΪ��v��. �p�G�ϥΪ̦ۦ����ƪ�, ��ƪ?�e�N�i��P��ڨϥΪ̱��p����. �b�o���p�U, �z3�b�~��e %s���s��J%s �v����ƪ�.';
$strFlushTable = '�j����s��ƪ� ("FLUSH")';
$strFormEmpty = '��椺�|��@�Ǹ��!';
$strFormat = '�榡';
$strFullText = '��ܧ����r';
$strFunction = '���';

$strGenBy = '�إ�';
$strGenTime = '�إߤ��';
$strGeneralRelationFeat = '�@�����p�\��';
$strGerman = '�w�y';
$strGlobal = '����';
$strGlobalPrivileges = '�����v��';
$strGlobalValue = '�����';
$strGo = '���';
$strGrantOption = '���v';
$strGrants = 'Grants'; //should expressed in English
$strGreek = '��þ��';
$strGzip = '"gzipped"';

$strHasBeenAltered = '�w�g�ק�';
$strHasBeenCreated = '�w�g�إ�';
$strHaveToShow = '�z�ݭn��̤ܳ���ܤ@�����';
$strHebrew = '�ƧB�Ӥ�';
$strHome = '�D�ؿ�';
$strHomepageOfficial = 'phpMyAdmin �x���';
$strHomepageSourceforge = 'phpMyAdmin �U���';
$strHost = '�D��';
$strHostEmpty = '�п�J�D��W��!';
$strHungarian = '�I��Q��';

$strId = 'ID'; // use eng
$strIdxFulltext = '�����˯�';
$strIfYouWish = '�p�G�z�n��w��ƶפJ�����A�п�J�γr���j�}�����W��';
$strIgnore = '����';
$strIgnoringFile = '�����ɮ� %s';
$strImportDocSQL = 'Ū�� docSQL �ɮ�';
$strImportFiles = '��J�ɮ�';
$strImportFinished = '��J����';
$strInUse = '�ϥΤ�';
$strIndex = '�d�';
$strIndexHasBeenDropped = '�d� %s �w�Q�R��';
$strIndexName = '�dަW��&nbsp;:';
$strIndexType = '�d�����&nbsp;:';
$strIndexes = '�d�';
$strInnodbStat = 'InnoDB ���A';
$strInsecureMySQL = '�]�w�ɤ�����]�w (root�n�J�ΨS���K�X) �P�w�]�� MySQL �v����f�ۦP�C MySQL ��A���b�o�w�]���]�w�B�檺�ܷ|�ܮe��Q�J�I�A�z3��靈��]�w�h����w���|�}�C';
$strInsert = '�s�W';
$strInsertAsNewRow = '�x�s���s�O��';
$strInsertNewRow = '�s�W�@���O��';
$strInsertTextfiles = '�N��r�ɸ�ƶפJ��ƪ�';
$strInsertedRowId = '�s�W��ƦC id:';
$strInsertedRows = '�s�W�C��:';
$strInstructions = '��O';
$strInvalidName = '"%s" �O�@�ӫO�d�r,�z����N�O�d�r�ϥά� ��Ʈw/��ƪ�/��� �W��.';

$strJapanese = '���';
$strJumpToDB = '����Ʈw &quot;%s&quot;.';
$strJustDelete = '�u�q�v����Ʈw�R���ϥΪ�.';
$strJustDeleteDescr = ' &quot;�R��&quot; ���ϥΪ̤��M���n�J��Ʈw���ܭ��s��J��Ʈw����.';

$strKeepPass = '�Ф��n���K�X';
$strKeyname = '��W';
$strKill = 'Kill'; //should expressed in English
$strKorean = '���';

$strLaTeX = 'LaTeX';  // use eng
$strLaTeXOptions = 'LaTeX �ﶵ';
$strLandscape = '��V';
$strLength = '���';
$strLengthSet = '���/���X*';
$strLimitNumRows = '���O��/�C��';
$strLineFeed = '����: \\n';
$strLines = '���';
$strLinesTerminatedBy = '�u�U�@��v�ϥΦr���G';
$strLinkNotFound = '�䤣��s��';
$strLinksTo = '�s����';
$strLithuanian = '�߳��{��';
$strLoadExplanation = '�̨μҦ��O�Ѩt�Φ۰��ˬd, �p�G��~, �z�i�ۥѧ��.';
$strLoadMethod = 'LOAD �Ҧ�';
$strLocalhost = '���a';
$strLocationTextfile = '��r�ɮת���m';
$strLogPassword = '�K�X:';
$strLogUsername = '�n�J�W��:';
$strLogin = '�n�J';
$strLoginInformation = '�n�J��T';
$strLogout = '�n�X�t��';

$strMIME_MIMEtype = 'MIME ����';
$strMIME_available_mime = '�i�ϥ� MIME ����';
$strMIME_available_transform = '�i�ϥ��ഫ�覡';
$strMIME_description = '����';
$strMIME_file = '�ɮצW��';
$strMIME_nodescription = '�o���ഫ�覡�S������.<br />�ЦV�@�̬d�� %s �O�ƻ�γ~.';
$strMIME_transformation = '�s���ഫ�覡';
$strMIME_transformation_note = '����i�ϥΤ��ഫ�覡�ﶵ�� MINE �����ഫ�ﶵ, �Ьd�� %s�ഫ�覡����%s';
$strMIME_transformation_options = '�ഫ�覡�ﶵ';
$strMIME_transformation_options_note = '�ХΥH�U���榡��J�ഫ�ﶵ��: \'a\',\'b\',\'c\'...<br />�p�z�ݭn��J�ϱ׽u ("\") �γ�޸� ("\'") �ЦA�[�W�ϱ׽u (�Ҧp \'\\\\xyz\' or \'a\\\'b\').';
$strMIME_without = 'MIME �����H������ܬO�S���9j�ഫ�\��';
$strMissingBracket = '�䤣��A��';
$strModifications = '�ק�w�x�s';
$strModify = '�ק�';
$strModifyIndexTopic = '�ק�d�';
$strMoreStatusVars = '��h���p��T';
$strMoveTable = '���ʸ�ƪ��G(�榡�� ��Ʈw�W��<b>.</b>��ƪ�W��)';
$strMoveTableOK = '��ƪ� %s �w�g���ʨ� %s.';
$strMoveTableSameNames = '�L�k���ʨ�ۦP��ƪ�!';
$strMultilingual = '�h�y��';
$strMustSelectFile = '�z3��ܻݭn�s�W���ɮ�.';
$strMySQLCharset = 'MySQL ��r�s�X';
$strMySQLReloaded = 'MySQL ���s��J����';
$strMySQLSaid = 'MySQL �Ǧ^�G ';
$strMySQLServerProcess = 'MySQL ���� %pma_s1% �b %pma_s2% ���A�n�J�̬� %pma_s3%';
$strMySQLShowProcess = '��ܵ{�� (Process)';
$strMySQLShowStatus = '��� MySQL ��檬�A';
$strMySQLShowVars = '��� MySQL �t���ܼ�';

$strName = '�W��';
$strNext = '�U�@��';
$strNo = ' �_ ';
$strNoDatabases = '�S����Ʈw';
$strNoDatabasesSelected = '�S����Ʈw���.';
$strNoDescription = '�S������';
$strNoDropDatabases = '"DROP DATABASE" ��O�w�g����.';
$strNoExplain = '���L���� SQL';
$strNoFrames = 'phpMyAdmin ��A�X�ϥΦb�䴩<b>����</b>���s��.';
$strNoIndex = '�S���w�w�q���d�!';
$strNoIndexPartsDefined = '����d޸���٥��w�q!';
$strNoModification = '�S���ܧ�';
$strNoOptions = '�o�خ榡�õL�ﶵ';
$strNoPassword = '���αK�X';
$strNoPermission = 'Web ��A���S���v���x�s�ɮ� %s.';
$strNoPhp = '���� PHP �{���X';
$strNoPrivileges = '�S���v��';
$strNoQuery = '�S�� SQL �y�k!';
$strNoRights = '�z�{�b�S�������v��!';
$strNoSpace = '�Ŷ������x�s�ɮ� %s.';
$strNoTablesFound = '��Ʈw���S����ƪ�';
$strNoUsersFound = '�䤣��ϥΪ�';
$strNoUsersSelected = '�S����ܨϥΪ�.';
$strNoValidateSQL = '���L�ˬd SQL';
$strNone = '���A��';
$strNotNumber = '�o���O�@�ӼƦr!';
$strNotOK = '����T�w';
$strNotSet = '<b>%s</b> ��ƪ�䤣����٥��b %s �]�w';
$strNotValidNumber = '���O���Ī��C��!';
$strNull = 'Null'; //should expressed in English
$strNumSearchResultsInTable = '%s ����ƲŦX - ���ƪ� <i>%s</i>';
$strNumSearchResultsTotal = '<b>�`�p:</b> <i>%s</i> ����ƲŦX';
$strNumTables = '�Ӹ�ƪ�';

$strOK = '�T�w';
$strOftenQuotation = '�̱`�Ϊ��O�޸��A�u�D�����v��ܥu�� char �M varchar ���|�Q�]�A�_��';
$strOperations = '�޲z';
$strOptimizeTable = '�̨ΤƸ�ƪ�';
$strOptionalControls = '�D���n�ﶵ�A�Ψ�Ū�g�S��r��';
$strOptionally = '�D����';
$strOptions = '�ﶵ';
$strOr = '��';
$strOverhead = '�h�l';
$strOverwriteExisting = '�мg�w�s�b�ɮ�';

$strPHP40203 = '�z���ϥ� PHP ���� 4.2.3, �o�������@����r�`�r�����Y����~(mbstring). �аѾ\ PHP ���γ�i�s�� 19404. phpMyAdmin �ä���ĳ�ϥγo�Ӫ����� PHP .';
$strPHPVersion = 'PHP ����';
$strPageNumber = '���X:';
$strPaperSize = '�ȱi�j�p';
$strPartialText = '��ܳ����r';
$strPassword = '�K�X';
$strPasswordChanged = '%s ���K�X�w���\���.';
$strPasswordEmpty = '�п�J�K�X!';
$strPasswordNotSame = '�ĤG����J���K�X���P!';
$strPdfDbSchema = '"%s" ��Ʈw���n - �� %s ��';
$strPdfInvalidPageNum = 'PDF ���X�S���]�w!';
$strPdfInvalidTblName = '��ƪ� "%s" ���s�b!';
$strPdfNoTables = '�S����ƪ�';
$strPerHour = '�C�p��';
$strPerMinute = '�C����';
$strPerSecond = '�C��';
$strPhoneBook = '�q��ï';
$strPhp = '�إ� PHP �{���X';
$strPmaDocumentation = 'phpMyAdmin ������';
$strPmaUriError = ' �����]�w <tt>$cfg[\'PmaAbsoluteUri\']</tt> �b�]�w�ɤ�!';
$strPortrait = '���V';
$strPos1 = '�Ĥ@��';
$strPrevious = '�e�@��';
$strPrimary = '�D��';
$strPrimaryKey = '�D��';
$strPrimaryKeyHasBeenDropped = '�D��w�Q�R��';
$strPrimaryKeyName = '�D�䪺�W�٥����٬� PRIMARY!';
$strPrimaryKeyWarning = '("PRIMARY" <b>����</b>�O�D�䪺�W�٥H�άO<b>�ߤ@</b>�@�եD��!)';
$strPrint = '�C�L';
$strPrintView = '�C�L�˵�';
$strPrivDescAllPrivileges = '�]�A�Ҧ��v�����F���v (GRNANT).';
$strPrivDescAlter = '�e�\�ק�{����ƪ?���c.';
$strPrivDescCreateDb = '�e�\�إ߷s��Ʈw�θ�ƪ�.';
$strPrivDescCreateTbl = '�e�\�إ߷s��ƪ�.';
$strPrivDescCreateTmpTable = '�e�\�إ߼Ȯɩʸ�ƪ�.';
$strPrivDescDelete = '�e�\�R���O��.';
$strPrivDescDropDb = '�e�\�R����Ʈw�θ�ƪ�.';
$strPrivDescDropTbl = '�e�\�R����ƪ�.';
$strPrivDescExecute = '�e�\ ���w���x�s���{��. �� MySQL �����L��.';
$strPrivDescFile = '�e�\��J�ο�X�ƾڨ��ɮ�.';
$strPrivDescGrant = '�e�\�s�W�ϥΪ̤��v���ӵL�ݭ��sŪ���v����ƪ�.';
$strPrivDescIndex = '�e�\�إߤΧR���d�.';
$strPrivDescInsert = '�e�\�s�W�Ψ�N�ƾ�.';
$strPrivDescLockTables = '�e�\��W�{�ɳs�u����ƪ�.';
$strPrivDescMaxConnections = '����C�p�ɨϥΪ̶}�ҷs�s�u���ƥ�.';
$strPrivDescMaxQuestions = '����C�p�ɨϥΪ̬d�ߪ��ƥ�.';
$strPrivDescMaxUpdates = '����C�p�ɨϥΪ̧���ƪ�μƾڪ?��O���ƥ�.';
$strPrivDescProcess3 = '�e�\�����L�ϥΪ̤��{��.';
$strPrivDescProcess4 = '�e�\�˵�t�ΰ��M�槹�㤧�d��.';
$strPrivDescReferences = '�� MySQL �����L��.';
$strPrivDescReload = '�e�\���sŪ���A���]�w�αj���s��A���֨�O��.';
$strPrivDescReplClient = '�e�\�Τ�d�� slaves / masters �b��B.';
$strPrivDescReplSlave = '�ݭn�ƻs�� slaves.';
$strPrivDescSelect = '�e�\Ū��ƾ�.';
$strPrivDescShowDb = '�iŪ���Ӹ�Ʈw�M��.';
$strPrivDescShutdown = '�e�\�����A��.';
$strPrivDescSuper = '�e�\�s�u, �N��W�L�F�̤j�s�u����; �Ω�̰��t�κ޲z�p�]�w�����v���Τ����L�ϥΪ̫�O.';
$strPrivDescUpdate = '�e�\��s�ƾ�.';
$strPrivDescUsage = '�S���v��.';
$strPrivileges = '�v��';
$strPrivilegesReloaded = '�v���w���\���sŪ��.';
$strProcesslist = '�t�ΰ��M��';
$strProperties = '�ݩ�';
$strPutColNames = '�N���W�٩�b����';

$strQBE = '�̽d�Ҭd�� (QBE)';
$strQBEDel = '����';
$strQBEIns = '�s�W';
$strQueryFrame = '�d�ߵ�';
$strQueryFrameDebug = '�����T';
$strQueryFrameDebugBox = '�Y���ܼƨӦ� :\n��Ʈw: %s\n��ƪ�: %s\n��A��: %s\n\n�{�ɬd�ߤ����ܼƨӦ�:\n��Ʈw: %s\n��ƪ�: %s\n��A��: %s\n\n�}�Ҧa�}: %s\n���بӦ�: %s.';
$strQueryOnDb = '�b��Ʈw <b>%s</b> ��� SQL �y�k:';
$strQuerySQLHistory = 'SQL ��{';
$strQueryStatistics = '<b>�d�ڲέp</b>: ��έp�Ұʫ�, �@�� %s �Ӭd�߶ǰe�즹��A��.';
$strQueryTime = '�d�߻ݮ� %01.4f ��';
$strQueryType = '�d�ߤ覡';
$strQueryWindowLock = '���n�N�o�y�k�л\�쥻��~��SQL�y�k';

$strReType = '�T�{�K�X';
$strReceived = '����';
$strRecords = '�O��';
$strReferentialIntegrity = '�ˬd��ܧ����:';
$strRelationNotWorking = '���p��ƪ?���[�\�ॼ��Ұ�, %s�Ы�%s �d�X���D��].';
$strRelationView = '���p�˵�';
$strRelationalSchema = '���p���n';
$strRelations = '���p';
$strReloadFailed = '���s��JMySQL����';
$strReloadMySQL = '���s��J MySQL';
$strReloadingThePrivileges = '���sŪ���v��';
$strRememberReload = '�аO�ۭ��s�Ұʦ�A��.';
$strRemoveSelectedUsers = '�����w��ܨϥΪ�';
$strRenameTable = '�N��ƪ��W��';
$strRenameTableOK = '�w�g�N��ƪ� %s ��W�� %s';
$strRepairTable = '�״_��ƪ�';
$strReplace = '��N';
$strReplaceNULLBy = '�N NULL ��N��';
$strReplaceTable = '�H�ɮר�N��ƪ���';
$strReset = '���m';
$strResourceLimits = '�귽����';
$strRevoke = '����';
$strRevokeAndDelete = '�o���ϥΪ̩Ҧ����Ĥ��v���çR��.';
$strRevokeAndDeleteDescr = '�ϥΪ̤��M�� USAGE �v�������v����ƪ��sŪ��.';
$strRevokeGrant = '���� Grant �v��';
$strRevokeGrantMessage = '�z�w�����o��ϥΪ̪� Grant �v��: %s';
$strRevokeMessage = '�z�w�����o��ϥΪ̪��v��: %s';
$strRevokePriv = '�����v��';
$strRowLength = '��ƦC���';
$strRowSize = '��ƦC�j�p';
$strRows = '��ƦC�C��';
$strRowsFrom = '���O��A�}�l�C��:';
$strRowsModeFlippedHorizontal = '���� (������D)';
$strRowsModeHorizontal = '��';
$strRowsModeOptions = '��ܬ� %s �覡 �� �C�j %s �������W';
$strRowsModeVertical = '����';
$strRowsStatistic = '��ƦC�έp�ƭ�';
$strRunQuery = '���y�k';
$strRunSQLQuery = '�b��Ʈw %s ���H�U��O';
$strRunning = '�b %s ���';
$strRussian = '�X��';

$strSQL = 'SQL'; // should express in english
$strSQLOptions = 'SQL �ﶵ';
$strSQLParserBugMessage = '�o�i��O�z���F SQL �*R�{�����@�ǵ{����~�A�вӤ߬d�ݱz���y�k�A�ˬd�@�U�޸��O���T�ΨS����|�A��L�i��X���]�i��Ӧ۱z�W���ɮ׮ɦb�޸��~���a��ϥΤF�G�i��X�C�z�i�H�xզb MySQL �R�O�C�������ӻy�k�C�p MySQL ��A���o�X��~�H���A�o�i��0�U�z�h��X���D�Ҧb�C�p�z���M����ѨM���D�A�Φb�*R�{���X�{��~�A��b�R�O�C�Ҧ��ॿ�`���A�бN�ӥy�X�{��~�� SQL �y�k��X�A�ñN�H�U��"�Ũ�"����@�P��������:';
$strSQLParserUserError = '�i��O�z�� SQL �y�k�X�{��~�A�p MySQL ��A���o�X��~�H���A�o�i��0�U�z�h��X���D�Ҧb�C';
$strSQLQuery = 'SQL �y�k';
$strSQLResult = 'SQL �d�ߵ��G';
$strSQPBugInvalidIdentifer = '�L�Ī��ѧO�X (Invalid Identifer)';
$strSQPBugUnclosedQuote = '���������޸� (Unclosed quote)';
$strSQPBugUnknownPunctuation = '��������I�Ÿ� (Unknown Punctuation String)';
$strSave = '�x�s';
$strSaveOnServer = '�x�s���A���� %s �ؿ�';
$strScaleFactorSmall = '��ҭ��ƤӲ�, �L�k�N�Ϫ��b�@����';
$strSearch = '�j��';
$strSearchFormTitle = '�j�x�Ʈw';
$strSearchInTables = '��H�U��ƪ�:';
$strSearchNeedle = '�M�䤧��r�μƭ� (�U�Φr��: "%"):';
$strSearchOption1 = '���@�դ�r';
$strSearchOption2 = '�Ҧ���r';
$strSearchOption3 = '�����y';
$strSearchOption4 = '�H�W�h��ܪk (regular expression) �j��';
$strSearchResultsFor = '�j�� "<i>%s</i>" �����G %s:';
$strSearchType = '�M��:';
$strSecretRequired = '�]�w�ɮײ{�b�ݭn�K�X (passphrase) (blowfish_secret).';
$strSelect = '���';
$strSelectADb = '�п�ܸ�Ʈw';
$strSelectAll = '����';
$strSelectFields = '������ (�ܤ֤@��)';
$strSelectNumRows = '�d�ߤ�';
$strSelectTables = '��ܸ�ƪ�';
$strSend = '�U���x�s';
$strSent = '�e�X';
$strServer = '��A�� %s';
$strServerChoice = '��ܦ�A��';
$strServerStatus = '�B���T';
$strServerStatusUptime = '�o MySQL ��A���w�ҰʤF %s. ��A���� %s �Ұ�.';
$strServerTabProcesslist = '�B�z';
$strServerTabVariables = '��T';
$strServerTrafficNotes = '<b>��A���y�q</b>: �o�Ǫ���ܤF�� MySQL ��A���۱ҰʥH�Ӫ���y�q�έp�C';
$strServerVars = '��A����T�γ]�w';
$strServerVersion = '��A������';
$strSessionValue = '�{�Ǽƭ�';
$strSetEnumVal = '�p���榡�O "enum" �� "set", �ШϥΥH�U���榡��J: \'a\',\'b\',\'c\'...<br />�p�b�ƭȤW�ݭn��J�ϱ׽u (\) �γ�޸� (\') , �ЦA�[�W�ϱ׽u (�Ҧp \'\\\\xyz\' or \'a\\\'b\').';
$strShow = '���';
$strShowAll = '��ܥ���';
$strShowColor = '����C��';
$strShowCols = '�����';
$strShowDatadictAs = '�ƾڦr��榡';
$strShowFullQueries = '��ܧ���d��';
$strShowGrid = '��ܮخ�';
$strShowPHPInfo = '��� PHP ��T';
$strShowTableDimension = '��ܪ��j�p';
$strShowTables = '��ܸ�ƪ�';
$strShowThisQuery = '���s��� SQL �y�k ';
$strShowingRecords = '��ܰO��';
$strSimplifiedChinese = '²�餤��';
$strSingly = '(�u�|�Ƨǲ{�ɪ��O��)';
$strSize = '�j�p';
$strSort = '�Ƨ�';
$strSpaceUsage = '�w�ϥΪŶ�';
$strSplitWordsWithSpace = '�C�դ�r�H�Ů� (" ") �9j.';
$strStatCheckTime = '�̫��ˬd';
$strStatCreateTime = '�إ�';
$strStatUpdateTime = '�̫��s';
$strStatement = '�ԭz';
$strStatus = '���A';
$strStrucCSV = 'CSV ���';
$strStrucData = '���c�P���';
$strStrucDrop = '�[�J \'�R����ƪ�\' �y�k';
$strStrucExcelCSV = 'Ms Excel �� CSV �榡';
$strStrucOnly = '�u�����c';
$strStructPropose = '�*R��ƪ?�c';
$strStructure = '���c';
$strSubmit = '�e�X';
$strSuccess = '�z��SQL�y�k�w���Q���';
$strSum = '�`�p';
$strSwedish = '����';
$strSwitchToTable = '���w�ƻs����ƪ�';

$strTable = '��ƪ�';
$strTableComments = '��ƪ��Ѥ�r';
$strTableEmpty = '�п�J��ƪ�W��!';
$strTableHasBeenDropped = '��ƪ� %s �w�Q�R��';
$strTableHasBeenEmptied = '��ƪ� %s �w�Q�M��';
$strTableHasBeenFlushed = '��ƪ� %s �w�Q�j����s';
$strTableMaintenance = '��ƪ���@';
$strTableOfContents = '�ؿ�';
$strTableOptions = '��ƪ�ﶵ';
$strTableStructure = '��ƪ�榡�G';
$strTableType = '��ƪ�����';
$strTables = '%s ��ƪ�';
$strTblPrivileges = '��w��ƪ��v��';
$strTextAreaLength = ' �ѩ��׭���<br /> ����줣��s�� ';
$strThai = '���';
$strTheContent = '�ɮפ��e�w�g�פJ��ƪ�';
$strTheContents = '�ɮפ��e�N�|��N��w����ƪ?�㦳�ۦP�D��ΰߤ@�䪺�O��';
$strTheTerminator = '�9j��쪺�r��';
$strThisHost = '��w�D��';
$strThisNotDirectory = '�o�ä��O�@�ӥؿ�';
$strThreadSuccessfullyKilled = '��O %s �w���\����.';
$strTime = '�ɶ�';
$strToggleScratchboard = '�ഫ�K��';
$strTotal = '�`�p';
$strTotalUC = '�`�@';
$strTraditionalChinese = '�c�餤��';
$strTraffic = '�y�q';
$strTransformation_image_jpeg__inline = '��ܥi��Ϲ�; �ﶵ; �e��,����[�H���,����] (�O�ɭ즳���)';
$strTransformation_image_jpeg__link = '��ܹϹ����s�u (�����U��).';
$strTransformation_image_png__inline = '�Ѭ� image/jpeg: ����';
$strTransformation_text_plain__dateformat = '�ϥ� TIME, TIMESTAMP �� DATETIME �åH���a�ɰϮɶ����. �Ĥ@�ӿﶵ�O�ץ� (�H�p�ɬ����) �ӽվ���ܤ��ɶ� (�w�]: 0). �ĤG�ӿﶵ�O��n榡 [��� PHPs strftime() ���Ѽ�].';
$strTransformation_text_plain__external = '�u���� LINUX : ���~���{���αN���e�H�зǿ�J�Ҧ���J. ��X�{�����зǿ�X. �w�]�O���, ��K��� HTML �X. �ѩ�O�w�z��, �z�ݭn�ۦ�s�� libraries/transformations/text_plain__external.inc.php �Υ[�J�ݭn�ϥΤu��@�����. �Ĥ@�ӿﶵ�����h�֭ӵ{���ݭn�ϥ�, �ĤG�ӿﶵ���o���{�����Ѽ�, �ĤT�ӿﶵ, �p�]�w�� 1 �N�|�ϥ� htmlspecialchars() �ഫ��X (�w�]: 1). �ĥ|�ӿﶵ, �p�]�w�� 1 �N�|�[�J NOWRAP �󤺮e����椺, �O��X���Ҧ����e�����|���s�Ʀ� (�w�]: 1)';
$strTransformation_text_plain__formatted = '�O�s�쥻���e���榡. ���i���� Escaping �B�z.';
$strTransformation_text_plain__imagelink = '��ܹϹ��γs��, �ƾڤ��e�O�ɮצW��; �Ĥ@�ӿﶵ�O��}�e�q (�� "http://domain.com/" ), �ĤG�ӿﶵ�O�e�ת�����,�ĤT�ӿﶵ�O���ת�����.';
$strTransformation_text_plain__link = '��ܳs��, �ƾڤ��e�O�ɮצW��; �Ĥ@�ӿﶵ�O��}�e�q (�� "http://domain.com/" ), �ĤG�ﶵ�O�s�������D.';
$strTransformation_text_plain__substr = '�u��ܳ���r��. �Ĥ@�ӿﶵ���r��}�l��X����m (offset)  (�w�]: 0). �ĤG�ӿﶵ���h�֭Ӧr���X. �d�Ŭ���X�l�U�Ҧ��r��. �ĤT�ӿﶵ���?��r���^����ܤ���r��󵲧� (�w�]: ...) .';
$strTransformation_text_plain__unformatted = '�H HTML �X��� HTML ����. ���|��ܥ�� HTML �榡.';
$strTruncateQueries = '�R���w��ܬd��';
$strTurkish = '�g�ը��';
$strType = '���A';

$strUkrainian = '�Q�J���';
$strUncheckAll = '�������';
$strUnicode = '�Τ@�X (Unicode)';
$strUnique = '�ߤ@';
$strUnknown = '����';
$strUnselectAll = '�������';
$strUpdComTab = '�аѬݻ�����d�ߦp���s Column_comments ��ƪ�';
$strUpdatePrivMessage = '�z�w�g��s�F %s ���v��.';
$strUpdateProfile = '��s���:';
$strUpdateProfileMessage = '��Ƥv�g��s.';
$strUpdateQuery = '��s�y�k';
$strUsage = '�ϥ�';
$strUseBackquotes = '�b��ƪ�����ϥΤ޸�';
$strUseHostTable = '�ϥΥD���ƪ�';
$strUseTables = '�ϥθ�ƪ�';
$strUseTextField = '��r��J';
$strUser = '�ϥΪ�';
$strUserAlreadyExists = '�ϥΪ� %s �v�s�b!';
$strUserEmpty = '�п�J�ϥΪ̦W��!';
$strUserName = '�ϥΪ̦W��';
$strUserNotFound = '��ܪ��ϥΪ̦b�v����ƪ?�䤣��.';
$strUserOverview = '�ϥΪ̤@��';
$strUsers = '�ϥΪ�';
$strUsersDeleted = '��ܪ��ϥΪ̤w���\�R��.';
$strUsersHavingAccessToDb = '�iŪ�� &quot;%s&quot; ���ϥΪ�';

$strValidateSQL = '�ˬd SQL';
$strValidatorError = 'SQL �*R�{������ҰʡA���ˬd�O�_�w�N %s���%s ���� PHP �ɮצw�ˡC';
$strValue = '��';
$strVar = '��T';
$strViewDump = '�˵��ƪ?�ƥ�n (dump schema)';
$strViewDumpDB = '�˵��Ʈw���ƥ�n (dump schema)';
$strViewDumpDatabases = '��ܸ�Ʈw���n (schema)';

$strWebServerUploadDirectory = 'Web ��A���W��ؿ�';
$strWebServerUploadDirectoryError = '�]�w���W��ؿ��~�A����ϥ�';
$strWelcome = '�w��ϥ� %s';
$strWestEuropean = '��ڻy��';
$strWildcard = '�U�Φr��';
$strWithChecked = '��ܪ���ƪ�G';
$strWritingCommentNotPossible = '�L�k�x�s��Ѥ�r';
$strWritingRelationNotPossible = '�L�k�x�s���p';
$strWrongUser = '��~���ϥΪ̦W�٩αK�X�A�ڵ��s��';

$strXML = 'XML'; //USE ENG

$strYes = ' �O ';

$strZeroRemovesTheLimit = '��: �]�w�o�ǿﶵ�� 0 (�s) �i�Ѱ�����.';
$strZip = '"zipped"';

$strBrowseForeignValues = 'Browse foreign values';  //to translate

$strUseThisValue = 'Use this value';  //to translate

$strWindowNotFound = 'The target browser window could not be updated. Maybe you have closed the parent window or your browser is blocking cross-window updates of your security settings';  //to translate

?>
