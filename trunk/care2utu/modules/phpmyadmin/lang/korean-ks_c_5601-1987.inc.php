<?php
/* $Id: korean-ks_c_5601-1987.inc.php,v 1.2 2008/10/07 13:18:01 robert Exp $ */

/* Translated by WooSuhan <kjh@unews.NOSPAM.co.kr> */

$charset = 'ks_c_5601-1987';
$text_dir = 'ltr';
$left_font_family = '"����", sans-serif';
$right_font_family = '"����", sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');

$day_of_week = array('��', '��', 'ȭ', '��', '��', '��', '��');
$month = array('�ؿ8���', '�û��', '���8���', '�ٻ��', 'Ǫ����', '������', '�߿�����', 'Ÿ�8���', '���Ŵ�', '�ϴÿ���', '��ƴ��', '�ŵ��');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
// $datefmt = '%y�� %B %d�� %p %I:%M ';
$datefmt = '%y-%m-%d %H:%M ';

$strAPrimaryKey = ' %s�� �⺻ Ű�� �߰��Ǿ�4ϴ�';
$strAccessDenied = 'b���� �źεǾ�4ϴ�.';
$strAction = '����';
$strAddDeleteColumn = '��(Į��) �߰�/��f';
$strAddDeleteRow = 'Criteria ��(���ڵ�) �߰�/��f';
$strAddNewField = '�ʵ� �߰��ϱ�';
$strAddPriv = '���� �߰��ϱ�';
$strAddPrivMessage = '�� ����; �߰��߽4ϴ�';
$strAddPrivilegesOnDb = '��= �����ͺ��̽��� ���� �߰��ϱ�';
$strAddPrivilegesOnTbl = '��= ���̺? ���� �߰��ϱ�';
$strAddSearchConditions = '�˻� v�� �߰� ("where" v��):';
$strAddToIndex = '%s�� ��(Į��)�� �ε��� �߰�';
$strAddUser = '�� ����� �߰�';
$strAddUserMessage = '�� ����ڸ� �߰��߽4ϴ�.';
$strAffectedRows = '���� ��(���ڵ�):';
$strAfter = '%s ��=��';
$strAfterInsertBack = '�ǵ��ư���';
$strAfterInsertNewInsert = '�� ��(���ڵ�) �����ϱ�';
$strAllTableSameWidth = '��� ���̺�; ��: �ʺ�� ����ұ��?';
$strAlterOrderBy = '��= ���� ���̺� d��(����)';
$strAnIndex = '%s �� �ε����� �ɷȽ4ϴ�';
$strAnalyzeTable = '���̺� �м�';
$strAnd = '�׸���';
$strAnyColumn = '��� ��(Į��)';
$strAnyDatabase = '�ƹ� �����ͺ��̽�';
$strAnyHost = '�ƹ�������';
$strAnyTable = '��� ���̺�';
$strAnyUser = '�ƹ���';
$strAscending = '�8����';
$strAtBeginningOfTable = '���̺��� ó=';
$strAtEndOfTable = '���̺��� ����';
$strAttr = '����';
$strAutodetect = '�ڵ�';

$strBack = '�ڷ�';
$strBinary = '���̳ʸ�';
$strBinaryDoNotEdit = ' ���̳ʸ� - ���� ���� ';
$strBookmarkDeleted = '�ϸ�ũ�� f���߽4ϴ�.';
$strBookmarkQuery = '�ϸ�ũ�� SQL ����';
$strBookmarkThis = '�� SQL ���Ǹ� �ϸ�ũ��';
$strBrowse = '����';
$strBzError = '�� php ������ Bz2 Ȯ������ ��s�� ������ phpMyAdmin�� ��������; ������ �� ��4ϴ�. ȯ�漳d���Ͽ���<code>$cfg[\'BZipDump\']</code>�� <code>FALSE</code>�� ��d�Ͻʽÿ�. ���� Bz2 ����; ����ϰ��� �Ѵٸ�, php����; ��׷��̵��ؾ� �մϴ�. �ڼ��� ����: php ��� ����Ʈ %s �� ���ʽÿ�.';
$strBzip = '"bz ����"';

$strCSVOptions = 'CSV �ɼ�';
$strCannotLogin = 'MySQL ���� �α����� �� ��4ϴ�';
$strCantLoad = ' %s Ȯ����; �ҷ��� �� ��4ϴ�.<br />PHP ȯ�漳d; �˻��Ͻʽÿ�.';
$strCantLoadMySQL = 'MySQL Ȯ����; �ҷ��� �� ��4ϴ�.<br />PHP ��d; �˻��Ͻʽÿ�..';
$strCantRenameIdxToPrimary = '�ε��� �̸�; �⺻ Ű�� �ٲ� �� ��4ϴ�!';
$strCarriage = 'ĳ���� ����: \\r';
$strChange = '����';
$strChangeDisplay = '����� �ʵ� ����';
$strChangePassword = '��ȣ ����';
$strCharsetOfFile = '���� ���ڼ�:';
$strCheckAll = '��� üũ';
$strCheckDbPriv = '�����ͺ��̽� ���� �˻�';
$strCheckPrivs = '������ ����';
$strCheckPrivsLong = '�����ͺ��̽� &quot;%s&quot; �� ���� ������ �˻�.';
$strCheckTable = '���̺� �˻�';
$strChoosePage = '������ ������ �����ϼ���';
$strColComFeat = '��(Į��) ����(�ڸ�Ʈ) ����ϱ�';
$strColumn = '��(Į��)';
$strColumnNames = '��(Į��) �̸�';
$strColumnPrivileges = '��(Į��)�� ���� ����';
$strComments = '����(�ڸ�Ʈ)';
$strCompleteInserts = '������ INSERT�� �ۼ�';
$strCompression = '����';
$strConfigFileError = 'phpMyAdmin�� ȯ�漳d ����; ��; �� ��4ϴ�!<br />PHP�� ������ �ְų� ��f�� �� ������ ��� ����Դϴ�.<br />�Ʒ� ��ũ�� ���� ȯ�漳d ���ϸ� �ҷ��鿩���ʽÿ�. �׸��� PHP ���� �޽��� Ȯ���Ͻʽÿ�. ��򰡿� ���ǥ(quote)�� �����ݷ�(;)�� ��n�ִ� ��찡 ~~ �ֽ4ϴ�.<br />���� �ƹ��͵� ������ ��8��, d������ ���Դϴ�.';
$strConfirm = 'd���� �� �۾�; �Ͻðڽ4ϱ�?';
$strConnections = '���� ��';
$strCopyTable = '���̺� ���� (�����ͺ��̽���<b>.</b>���̺��):';
$strCopyTableOK = '%s ���̺��� %s 8�� ����Ǿ�4ϴ�.';
$strCreate = ' ����� ';
$strCreateIndex = '%s �� ��(Į��)�� �ε��� ����� ';
$strCreateIndexTopic = '�� �ε��� �����';
$strCreateNewDatabase = '�� �����ͺ��̽� �����';
$strCreateNewTable = '�����ͺ��̽� %s�� ��ο� ���̺�; ����ϴ�.';
$strCreatePage = '�� ������ �����';

$strDBGMaxTimeMs = '�ִ�ð�, ms';
$strDBGMinTimeMs = '�ּҽð�, ms';
$strDBGModule = '���';
$strData = '������';
$strDataDict = '������ ���� (��ü ��v����)';
$strDataOnly = '�����͸�';
$strDatabase = '�����ͺ��̽� ';
$strDatabaseHasBeenDropped = '�����ͺ��̽� %s �� f���߽4ϴ�.';
$strDatabaseWildcard = '�����ͺ��̽� (���ϵ�ī�幮�� ��� ����):';
$strDatabases = '�����ͺ��̽� ';
$strDatabasesDropped = '%s �����ͺ��̽��� ��f�߽4ϴ�.';
$strDatabasesStats = '�����ͺ��̽� ��뷮 ���';
$strDatabasesStatsDisable = '��� ����';
$strDatabasesStatsEnable = '��� ����';
$strDatabasesStatsHeavyTraffic = '����: �����ͺ��̽� ��� ����� %����� MySQL ���� ���̿� ū ���ϸ� �ݴϴ�.';
$strDbPrivileges = '�����ͺ��̽��� ���� ����';
$strDefault = '�⺻��';
$strDefaultValueHelp = '�⺻������, �������ó� ���ǥ ���� �� �ϳ��� ��; ��8�ʽÿ�. (��: a)';
$strDelete = '��f';
$strDeleteAndFlush = '����ڸ� ��f�ϰ� ������; ������.';
$strDeleteAndFlushDescr = '���� Ȯ���� �������, ������ ���̺�; �ٽ� �о���̴µ��� �ణ�� �ð��� �ɸ��ϴ�.';
$strDeleteUserMessage = '����� %s �� ��f�߽4ϴ�.';
$strDeleted = '������ ��(���ڵ�); ��f �Ͽ��4ϴ�.';
$strDeletedRows = '����� ��(���ڵ�):';
$strDeleting = ' %s ; ��f�մϴ�';
$strDescending = '�������(����)';
$strDisabled = '���Ұ�';
$strDisplay = '����';
$strDisplayOrder = '��� ��:';
$strDoAQuery = '��=8�� ���Ǹ� ����� (���ϵ�ī��: "%")';
$strDoYouReally = 'd���� ��=; �����Ͻðڽ4ϱ�? ';
$strDocu = '����';
$strDrop = '��f';
$strDropDB = '�����ͺ��̽� %s f��';
$strDropSelectedDatabases = '������ �����ͺ��̽� ��f(Drop)';
$strDropTable = '���̺� f��';
$strDropUsersDb = '����ڸ�� ��: �̸��� �����ͺ��̽��� ��f';
$strDumpXRows = '%s���� ��(���ڵ�); ���� (%s��° ���ڵ����).';
$strDumpingData = '���̺��� ���� ������';
$strDynamic = '����(���̳���)';

$strEdit = '��d';
$strEditPDFPages = 'PDF ������ ����';
$strEditPrivileges = '���� ��d';
$strEffective = '��f��';
$strEmpty = '����';
$strEmptyResultSet = '����� ��4ϴ�. (�� ���ڵ� ����.)';
$strEnabled = '��밡��';
$strEnd = '����';
$strEnglishPrivileges = ' ����: MySQL ���� �̸�: ����� ǥ��Ǿ�� �մϴ�. ';
$strError = '�7�';
$strExplain = 'SQL �ؼ�';
$strExport = '��������';
$strExportToXML = 'XML ���8�� ��������';
$strExtendedInserts = 'Ȯ��� inserts';
$strExtra = '�߰�';

$strFailedAttempts = '������ �õ�';
$strField = '�ʵ�';
$strFieldHasBeenDropped = '�ʵ� %s �� f���߽4ϴ�';
$strFields = '�ʵ�';
$strFieldsEmpty = ' �ʵ� ���� ��4ϴ�! ';
$strFieldsEnclosedBy = '�ʵ� ���α�';
$strFieldsEscapedBy = '�ʵ� Ư����(escape) ó��';
$strFieldsTerminatedBy = '�ʵ� ������ ';
$strFileCouldNotBeRead = '����; ��; �� ��4ϴ�';
$strFileNameTemplate = '���ϸ� ���ø�';
$strFileNameTemplateHelp = '�����ͺ��̽� �̸��� __DB__ ��, ���̺�? __TABLE__ ;, �ð� ǥ�⿡ %sany strftime%s �ɼ�; ����ϸ�, Ȯ���ڴ� �ڵ�8�� �߰��˴ϴ�. �׹��� �ؽ�Ʈ�� ��x�˴ϴ�.';
$strFileNameTemplateRemember = '���ø� ���';
$strFlushTable = '���̺� �ݱ�(ĳ�� ��f)';
$strFunction = '�Լ�';

$strGenTime = 'ó���� �ð�';
$strGlobalPrivileges = '��ü�� ����';
$strGo = '����';
$strGrants = '���α���';
$strGzip = 'gz ����';

$strHasBeenAltered = ';(��) �����Ͽ��4ϴ�.';
$strHasBeenCreated = ';(��) �ۼ��Ͽ��4ϴ�.';
$strHaveToShow = '����Ϸx� �� 1�� �̻��� ��(Į��); �����ؾ� �մϴ�.';
$strHome = '����������';
$strHomepageOfficial = 'phpMyAdmin ��� Ȩ';
$strHomepageSourceforge = '�ҽ����� phpMyAdmin �ٿ�ε�';
$strHost = 'ȣ��Ʈ';
$strHostEmpty = 'ȣ��Ʈ���� ��4ϴ�!';

$strIfYouWish = '���̺� ��(Į��)�� �����͸� �߰��� ���� �ʵ� ���; �޸��� ������ �ֽʽÿ�. ';
$strIgnore = 'Ignore';
$strIgnoringFile = '���� %s ; �����մϴ�';
$strImportFiles = '���� ��n�1�';
$strImportFinished = '��n�1Ⱑ �����4ϴ�';
$strInUse = '�����';
$strIndex = '�ε���';
$strIndexHasBeenDropped = '�ε��� %s �� f���߽4ϴ�';
$strIndexName = '�ε��� �̸�:';
$strIndexType = '�ε��� ~��:';
$strIndexes = '�ε���';
$strInsecureMySQL = 'ȯ�漳d���Ͽ� MySQL ���� ��ȣ�� ��4ϴ�. �̰�: �⺻��d���·� MySQL ���� �۵��Ѵٸ� ������ ħ���� �� ��8�Ƿ�, �� ���Ȼ� ��a; ��d�Ͻñ� �ٶ�ϴ�.';
$strInsert = '����';
$strInsertAsNewRow = '�� ��; �����մϴ�';
$strInsertNewRow = '�� ��; ����';
$strInsertTextfiles = '�ؽ�Ʈ����; �о ���̺? ������ ����';
$strInsertedRows = '���Ե� ��:';
$strInstructions = '���?';
$strInvalidName = '"%s" �� ����� �ܾ��̹Ƿ� �����ͺ��̽�, ���̺�, �ʵ�? ����� �� ��4ϴ�.';

$strJumpToDB = '�����ͺ��̽� &quot;%s&quot; �� �̵�.';
$strJustDelete = '���� ���̺?�� ����ڸ� ��f�ϱ⸸ ��.';
$strJustDeleteDescr = '�������� ���ŵǱ����� &quot;��f��&quot; ����ڵ鵵 ������ ���� ����� �� �ֽ4ϴ�.';

$strKeepPass = '��ȣ�� �������� ��=';
$strKeyname = 'Ű �̸�';
$strKill = 'Kill';

$strLength = '����';
$strLengthSet = '����/��*';
$strLimitNumRows = '������� ���ڵ� ��';
$strLineFeed = '��(��)�ٲ� ����: \\n';
$strLines = '��(��)';
$strLinesTerminatedBy = '��(��) ������';
$strLocalhost = 'Local';
$strLocationTextfile = 'SQL �ؽ�Ʈ������ ';
$strLogPassword = '��ȣ:';
$strLogUsername = '����ڸ�:';
$strLogin = '�α���';
$strLoginInformation = '�α��� d��';
$strLogout = '�α׾ƿ�';

$strModifications = '��d�� ������ ����Ǿ�4ϴ�.';
$strModify = '��d';
$strModifyIndexTopic = '�ε��� ��d';
$strMoreStatusVars = '�׹��� ���� ��';
$strMoveTable = '���̺� �̵� (�����ͺ��̽���<b>.</b>���̺��):';
$strMoveTableOK = '���̺� %s ; %s �� �Ű�4ϴ�.';
$strMySQLCharset = 'MySQL ���ڼ�';
$strMySQLReloaded = 'MySQL; ��õ��߽4ϴ�.';
$strMySQLSaid = 'MySQL �޽���: ';
$strMySQLServerProcess = '%pma_s2% (MySQL %pma_s1%)�� %pma_s3% ��d8�� ���Խ4ϴ�.';
$strMySQLShowProcess = 'MySQL �wμ��� ����';
$strMySQLShowStatus = 'MySQL ��Ÿ�� ���� ����';
$strMySQLShowVars = 'MySQL ȯ�漳d�� ����';

$strName = '�̸�';
$strNext = '��=';
$strNo = ' �ƴϿ� ';
$strNoDatabases = '�����ͺ��̽��� ��4ϴ�';
$strNoDatabasesSelected = '�����ͺ��̽��� �������� �ʾҽ4ϴ�.';
$strNoDescription = '������ ��4ϴ�';
$strNoDropDatabases = '"DROP DATABASE" ����: ������ �ʽ4ϴ�.';
$strNoExplain = '�ؼ�(EXPLAIN) ��';
$strNoFrames = 'phpMyAdmin : <b>�w���; ����ϴ�</b> ������ �� ���Դϴ�.';
$strNoIndex = '�ε����� ��d���� �ʾҽ4ϴ�!';
$strNoModification = '��ȭ ��=';
$strNoPassword = '��ȣ ��=';
$strNoPhp = 'PHP �ڵ� ���� ����';
$strNoPrivileges = '���� ��=';
$strNoQuery = 'SQL ���� ��=!';
$strNoRights = '��� ���<̾��? ��� ���� ��; ������ ��4ϴ�!';
$strNoTablesFound = '�����ͺ��̽��� ���̺��� ��4ϴ�.';
$strNoUsersFound = '����ڰ� ��4ϴ�.';
$strNoUsersSelected = '����ڸ� �������� �ʾҽ4ϴ�.';
$strNone = '��=';
$strNotNumber = ': ����(��ȣ)�� �ƴմϴ�!';
$strNotValidNumber = ': �ùٸ� �� ��ȣ�� �ƴմϴ�!';
$strNumTables = '���̺� ��';

$strOperations = '���̺� �۾�';
$strOptimizeTable = '���̺� ����ȭ';
$strOptionalControls = 'Ư���� �б�/���� �ɼ�';
$strOptionally = '�ɼ��Դϴ�.';
$strOptions = '���̺� ���d��';
$strOr = '�Ǵ�';
$strOverhead = '�δ�';

$strPHP40203 = 'PHP 4.2.3���� ��Ƽ����Ʈ ���ڿ�(mbstring) ��⿡ ��װ� ��8�Ƿ� ��õ���� �ʽ4ϴ�. PHP ��� ����Ʈ 19404�� ���ʽÿ�.';
$strPHPVersion = 'PHP ����';
$strPageNumber = '������:';
$strPassword = '��ȣ';
$strPasswordChanged = '%s �� ��ȣ�� �ٲ��4ϴ�.';
$strPasswordEmpty = '��ȣ�� ���4ϴ�!';
$strPasswordNotSame = '��ȣ�� �������� �ʽ4ϴ�!';
$strPdfDbSchema = '"%s" �����ͺ��̽��� ��Ŵ(1��) - ������ %s';
$strPdfInvalidPageNum = 'PDF ������ ��ȣ�� ��d���� �ʾҽ4ϴ�!';
$strPdfInvalidTblName = '"%s" ���̺��� x������ �ʽ4ϴ�!';
$strPdfNoTables = '���̺��� ��4ϴ�';
$strPhp = 'PHP �ڵ� ����';
$strPmaDocumentation = 'phpMyAdmin ���?';
$strPmaUriError = 'ȯ�漳d ���Ͽ��� <tt>$cfg[\'PmaAbsoluteUri\']</tt> �ּҸ� �����Ͻʽÿ�!';
$strPos1 = 'ó=';
$strPrevious = '����';
$strPrimary = '�⺻';
$strPrimaryKey = '�⺻ Ű';
$strPrimaryKeyHasBeenDropped = '�⺻ Ű�� f���߽4ϴ�';
$strPrimaryKeyName = '�⺻ Ű�� �̸�: �ݵ�� PRIMARY���� �մϴ�!';
$strPrimaryKeyWarning = '("PRIMARY"�� �⺻ Ű���� <b>/����</b> �̸��Դϴ�!)';
$strPrint = '�μ�';
$strPrintView = '�μ�� ����';
$strPrivDescAllPrivileges = 'GRANT �̿��� ��� ����; ������.';
$strPrivDescAlter = '���̺� ��v ���� ���.';
$strPrivDescCreateDb = 'DB �� ���̺� �� ���.';
$strPrivDescCreateTbl = '���̺� �� ���.';
$strPrivDescCreateTmpTable = '�ӽ����̺� �� ���.';
$strPrivDescDelete = '������ ��f ���.';
$strPrivDescDropDb = 'DB �� ���̺� ��f ���.';
$strPrivDescDropTbl = '���̺� ��f ���.';
$strPrivDescExecute = '�����wν���(SP) ���; ���; �� MySQL ����� ȿ�� ��=.';
$strPrivDescFile = '�����͸� ���Ͽ��� ��n�1� �� ���Ϸ� �������� ���.';
$strPrivDescGrant = '���� ���̺�; �������� �ʰ� ����ڿ� ���� �߰��ϱ� ���.';
$strPrivDescIndex = '�ε��� �� �� ��f ���.';
$strPrivDescInsert = '������ �߰�(insert) �� ����(replace) ���.';
$strPrivDescLockTables = '���� �����忡 ���� ���̺� ���(lock) ���.';
$strPrivDescMaxConnections = 'Limits the number of new connections the user may open per hour.';
$strPrivDescMaxQuestions = 'Limits the number of queries the user may send to the server per hour.';
$strPrivDescMaxUpdates = 'Limits the number of commands that change any table or database the user may execute per hour.';
$strPrivDescProcess3 = '�ٸ� ������� �wμ��� ���̱⸦ ���.';
$strPrivDescReferences = '�� ������ MySQL���� �ҿ��� ��4ϴ�.';
$strPrivDescReload = 'ĳ�ø� ���� ���� ��õ��ϴ� ��; ���.';
$strPrivDescReplSlave = '��f����(replication slaves)�� �ʿ��մϴ�.';
$strPrivDescSelect = '������ �б� ���.';
$strPrivDescShowDb = '��ü �����ͺ��̽� ��� b��; ���';
$strPrivDescShutdown = '���� ~�� ���.';
$strPrivDescUpdate = '������ ���� ���.';
$strPrivDescUsage = '���� ��=.';
$strPrivileges = '������';
$strPrivilegesReloaded = '����; �ٽ� �ε��߽4ϴ�.';
$strProcesslist = '�wμ��� ���';
$strProperties = '�Ӽ�';
$strPutColNames = '��ó=�� �ʵ� �̸�; ���';

$strQBE = '���� �����';
$strQBEDel = '��f';
$strQBEIns = '����';
$strQueryFrame = '���� â';
$strQueryFrameDebug = '���� d��';
$strQueryOnDb = '�����ͺ��̽� <b>%s</b>�� SQL ����:';
$strQuerySQLHistory = 'SQL ����(���丮)';
$strQueryStatistics = '<b>SQL ���� ���</b>: �� ���� %s ���� ���ǰ� ����s�4ϴ�.';
$strQueryTime = '���� ����ð� %01.4f ��';
$strQueryType = '���� ~��';

$strReType = '���Է�';
$strReceived = '��=';
$strRecords = '���ڵ��';
$strReferentialIntegrity = 'referential ���Ἲ �˻�:';
$strRelationNotWorking = 'linked Tables���� �۵��ϴ� �ΰ������ ������ �ʽ4ϴ�. ��/�� �˷x� %s���⸦ Ŭ��%s�Ͻʽÿ�.';
$strReloadFailed = 'MySQL ��õ��� �����Ͽ��4ϴ�.';
$strReloadMySQL = 'MySQL ��õ�';
$strReloadingThePrivileges = '������; �����մϴ�(Reloading the privileges)';
$strRememberReload = '���� ��õ��ϴ� ��; �������.';
$strRemoveSelectedUsers = '������ ����ڸ� ��f';
$strRenameTable = '���̺� �̸� �ٲٱ�';
$strRenameTableOK = '���̺� %s;(��) %s(8)�� �����Ͽ��4ϴ�.';
$strRepairTable = '���̺� ����';
$strReplace = '��ġ(Replace)';
$strReplaceTable = '���Ϸ� ���̺� ��ġ�ϱ�';
$strReset = '����Ʈ';
$strResourceLimits = '���ҽ� f��';
$strRevoke = 'f��';
$strRevokeAndDelete = '��� Ȱ��ȭ�� ����; ��Ż�ϰ� ����ڸ� ��f��.';
$strRevokeAndDeleteDescr = '�������� �ٽ� �ε�Ǳ����� �� ����ڵ�: ������ USAGE ����; ���� �ֽ4ϴ�.';
$strRevokeGrant = '���� f��';
$strRevokeGrantMessage = '%s�� ���� ����; f���߽4ϴ�.';
$strRevokeMessage = '%s�� ����; f���߽4ϴ�.';
$strRevokePriv = '���� f��';
$strRowLength = '�� ����';
$strRowSize = ' Row size ';
$strRows = '��(���ڵ�)';
$strRowsFrom = '��. ����(��)';
$strRowsModeFlippedHorizontal = '���� (rotated headers)';
$strRowsModeHorizontal = '����(����)';
$strRowsModeOptions = ' %s d�� (%s ĭ�� ��8�� ��� �ݺ�)';
$strRowsModeVertical = '����(����)';
$strRowsStatistic = '��(���ڵ�) ���';
$strRunQuery = '���� ����';
$strRunSQLQuery = '�����ͺ��̽� %s�� SQL ���Ǹ� ����';
$strRunning = '�Դϴ�. (%s)';

$strSQL = 'SQL';
$strSQLOptions = 'SQL �ɼ�';
$strSQLParserUserError = 'SQL ���ǹ��� ������ �ֽ4ϴ�. MySQL ���� ��=�� ��: ������ ����߽4ϴ�. �̰��� ��f�� ����ϴµ� ������ �� ���Դϴ�.';
$strSQLQuery = 'SQL ����';
$strSQLResult = 'SQL ���';
$strSQPBugInvalidIdentifer = '�߸�� �ĺ���(Identifer)';
$strSQPBugUnclosedQuote = '���ǥ(quote)�� ������ �ʾ�=';
$strSave = '����';
$strSearch = '�˻�';
$strSearchFormTitle = '�����ͺ��̽� �˻�';
$strSearchInTables = 'ã; ���̺�:';
$strSearchNeedle = 'ã; �ܾ�, �� (���ϵ�ī��: "%"):';
$strSearchOption1 = '�ƹ� �ܾ';
$strSearchOption2 = '��� �ܾ�';
$strSearchOption3 = 'dȮ�� ����';
$strSearchOption4 = 'd��ǥ���';
$strSearchType = 'ã�� ���:';
$strSelect = '����';
$strSelectADb = '�����ͺ��̽��� �����ϼ���';
$strSelectAll = '��� ����';
$strSelectFields = '�ʵ� ���� (�ϳ� �̻�):';
$strSelectNumRows = '����(in query)';
$strSend = '���Ϸ� ����';
$strSent = '����';
$strServer = '���� %s';
$strServerChoice = '���� ����';
$strServerStatus = '��Ÿ�� d��';
$strServerStatusUptime = '�� MySQL ����� %s ���� �����Ǿ�4ϴ�. <br/>���� ���۳�¥�� %s �Դϴ�.';
$strServerTabProcesslist = '�wμ��� ���';
$strServerTabVariables = 'ȯ�漳d��';
$strServerTrafficNotes = '<b>���� ���뷮</b>: �� ���̺�: MySQL���� ������ �̷��� ��Ʈ�� ���� ���¸� �����ݴϴ�.';
$strServerVars = '������ ȯ�漳d';
$strServerVersion = '���� ����';
$strSessionValue = '���� ��';
$strSetEnumVal = '�ʵ� ~�� "enum"�̳� "set"�� ���, ��=�� ��: ���8�� ��; �Է��Ͻʽÿ�: \'a\',\'b\',\'c\'...<br />���⿡ ��������(\)�� ��: ���ǥ(\')�� �־�� �Ѵٸ�, �� �տ� �������ø� ����Ͻʽÿ�. (��: \'\\\\xyz\' �Ǵ� \'a\\\'b\').';
$strShow = '����';
$strShowAll = '��� ����';
$strShowColor = '��� ����';
$strShowCols = '��(Į��) ����';
$strShowGrid = 'grid ����';
$strShowPHPInfo = 'PHP d�� ����';
$strShowTables = '���̺� ����';
$strShowThisQuery = ' �� ���Ǹ� �ٽ� ������ ';
$strShowingRecords = '��(���ڵ�) ����';
$strSingly = '(�ܵ�8��)';
$strSize = 'ũ��';
$strSort = 'd��';
$strSpaceUsage = '�� ��뷮';
$strSplitWordsWithSpace = '�ܾ�� �����̽�(" ")�� ���е˴ϴ�.';
$strStatCheckTime = '�˻�';
$strStatCreateTime = '��';
$strStatUpdateTime = '����Ʈ';
$strStatement = '�?';
$strStatus = '����';
$strStrucCSV = 'CSV ������';
$strStrucData = '��v�� ������ ���';
$strStrucDrop = '\'DROP TABLE\'�� �߰�';
$strStrucExcelCSV = 'MS���� CSV ������';
$strStrucOnly = '��v��';
$strStructPropose = 'f���ϴ� ���̺� ��v';
$strStructure = '��v';
$strSubmit = 'Ȯ��';
$strSuccess = 'SQL ���ǰ� �ٸ��� ����Ǿ�4ϴ�.';
$strSum = '��';
$strSwitchToTable = '������ ���̺�� �Űܰ�';

$strTable = '���̺� ';
$strTableComments = '���̺� ����';
$strTableEmpty = '���̺���� ��4ϴ�!';
$strTableHasBeenDropped = '���̺� %s ; f���߽4ϴ�.';
$strTableHasBeenEmptied = '���̺� %s ; ���4ϴ�';
$strTableHasBeenFlushed = '���̺� %s ; �ݾҽ4ϴ�(ĳ�� ��f)';
$strTableMaintenance = '���̺� /���';
$strTableStructure = '���̺� ��v';
$strTableType = '���̺� ~��';
$strTables = '���̺� %s ��';
$strTblPrivileges = '���̺? ���� ����';
$strTextAreaLength = ' �ʵ��� ���� ������,<br />�� �ʵ带 ������ �� ��4ϴ� ';
$strTheContent = '���� ����; �����Ͽ��4ϴ�.';
$strTheContents = '���� ������ ������ ���̺��� �v��̸Ӹ� Ȥ: ��/�� Ű�� ��ġ�ϴ� ��; ��ġ(����)��Ű�ڽ4ϴ�.';
$strTheTerminator = '�ʵ� ~�� ��ȣ.';
$strThisNotDirectory = '���丮�� �ƴմϴ�';
$strThreadSuccessfullyKilled = '������ %s �� �׿��4ϴ�.';
$strTime = '�ð�';
$strTotal = '�հ�';
$strTotalUC = '��ü ��뷮';
$strTraffic = '���뷮';
$strType = '~��';

$strUncheckAll = '��� üũ����';
$strUnique = '��/��';
$strUnselectAll = '��� ���þ���';
$strUpdatePrivMessage = '%s �� ����; ����Ʈ�߽4ϴ�.';
$strUpdateProfile = '�w����� ����Ʈ:';
$strUpdateProfileMessage = '�w�����; ����Ʈ�߽4ϴ�.';
$strUpdateQuery = '���� ����Ʈ';
$strUsage = '����(��)';
$strUseBackquotes = '���̺�, �ʵ�? ������(`) ���';
$strUseTables = '����� ���̺�';
$strUser = '�����';
$strUserAlreadyExists = '����� %s �� �̹� x���մϴ�!';
$strUserEmpty = '����ڸ��� ��4ϴ�!';
$strUserName = '����ڸ�';
$strUserNotFound = '������ ����ڴ� ������ ���̺? x������ �ʽ4ϴ�.';
$strUserOverview = '����� ����';
$strUsers = '����ڵ�';
$strUsersDeleted = '������ ����ڵ�; ��f�߽4ϴ�.';
$strUsersHavingAccessToDb = '&quot;%s&quot; �� b���� �� �ִ� ����ڵ�';

$strValidateSQL = 'SQL �˻�';
$strValidatorError = 'SQL �˻�Ⱑ �ʱ�ȭ���� �ʾҽ4ϴ�. %s����%s���� ������ php Ȯ����; ��ġ�ߴ��� Ȯ���غ��ʽÿ�.';
$strValue = '��';
$strVar = '����';
$strViewDump = '���̺��� ����(��Ű��) ������ ����';
$strViewDumpDB = '�����ͺ��̽��� ����(��Ű��) ������ ����';

$strWebServerUploadDirectory = '%���� ��ε� ���丮';
$strWebServerUploadDirectoryError = '��ε� ���丮�� b���� �� ��4ϴ�';
$strWelcome = '%s�� �<̽4ϴ�';
$strWithChecked = '������ ��;:';
$strWrongUser = '����ڸ�/��ȣ�� Ʋ�Ƚ4ϴ�. b���� �źεǾ�4ϴ�.';

$strYes = ' �� ';

$strZeroRemovesTheLimit = '����: �� �ɼ�; 08�� �ϸ� f���� �����ϴ�.';
$strZip = 'zip ����';
$timespanfmt = '%s days, %s hours, %s minutes and %s seconds'; //to translate

$strAbortedClients = 'Aborted'; //to translate
$strAbsolutePathToDocSqlDir = 'Please enter the absolute path on webserver to docSQL directory';  //to translate
$strAddedColumnComment = 'Added comment for column';  //to translate
$strAddedColumnRelation = 'Added relation for column';  //to translate
$strAdministration = 'Administration'; //to translate
$strAll = 'All'; // To translate
$strAny = 'Any'; // To translate
$strAutomaticLayout = 'Automatic layout';  //to translate

$strBeginCut = 'BEGIN CUT';  //to translate
$strBeginRaw = 'BEGIN RAW';  //to translate
$strBookmarkLabel = 'Label'; // To translate
$strBookmarkView = 'View only'; // To translate

$strCantLoadRecodeIconv = 'Can not load iconv or recode extension needed for charset conversion, configure php to allow using these extensions or disable charset conversion in phpMyAdmin.';  //to translate
$strCantUseRecodeIconv = 'Can not use iconv nor libiconv nor recode_string function while extension reports to be loaded. Check your php configuration.';  //to translate
$strCardinality = 'Cardinality'; // To translate
$strChangeCopyMode = 'Create a new user with the same privileges and ...';  //to translate
$strChangeCopyModeCopy = '... keep the old one.';  //to translate
$strChangeCopyModeDeleteAndReload = ' ... delete the old one from the user tables and reload the privileges afterwards.';  //to translate
$strChangeCopyModeJustDelete = ' ... delete the old one from the user tables.';  //to translate
$strChangeCopyModeRevoke = ' ... revoke all active privileges from the old one and delete it afterwards.';  //to translate
$strChangeCopyUser = 'Change Login Information / Copy User';  //to translate
$strCharset = 'Charset';  //to translate
$strCommand = 'Command'; //to translate
$strConfigureTableCoord = 'Please configure the coordinates for table %s';  //to translate
$strCookiesRequired = '��Ű ����� �����ؾ� �մϴ� past this point.'; // To translate
$strCopyTableSameNames = 'Can\'t copy table to same one!';  //to translate
$strCouldNotKill = 'phpMyAdmin was unable to kill thread %s. It probably has already been closed.'; //to translate
$strCreatePdfFeat = 'Creation of PDFs';  //to translate
$strCriteria = 'Criteria'; // To translate

$strDBComment = 'Database comment: ';//to translate
$strDBGContext = 'Context';  //to translate
$strDBGContextID = 'Context ID';  //to translate
$strDBGHits = 'Hits';  //to translate
$strDBGLine = 'Line';  //to translate
$strDBGTimePerHitMs = 'Time/Hit, ms';  //to translate
$strDBGTotalTimeMs = 'Total time, ms';  //to translate
$strDbSpecific = 'database-specific';  //to translate
$strDelOld = 'The current Page has References to Tables that no longer exist. Would you like to delete those References?';  //to translate
$strDeleteFailed = 'Deleted Failed!'; // To translate
$strDisplayFeat = 'Display Features';  //to translate
$strDisplayPDF = 'Display PDF schema';  //to translate
$strDumpComments = 'Include column comments as inline SQL-comments';//to translate
$strDumpSaved = 'Dump has been saved to file %s.';  //to translate

$strEndCut = 'END CUT';  //to translate
$strEndRaw = 'END RAW';  //to translate

$strFileAlreadyExists = 'File %s already exists on server, change filename or check overwrite option.';  //to translate
$strFixed = 'fixed'; // To translate
$strFlushPrivilegesNote = '����: phpMyAdmin: ������� ������; MySQL�� ������ ���̺?�� ��ٷ� �о�ɴϴ�. The content of this tables may differ from the privileges the server uses if manual changes have made to it. In this case, you should %sreload the privileges%s before you continue.'; //to translate
$strFormEmpty = 'Missing value in the form !'; // To translate
$strFormat = 'Format'; // To translate
$strFullText = 'Full Texts'; // To translate

$strGenBy = 'Generated by'; //to translate
$strGeneralRelationFeat = 'General ��� features';  //to translate
$strGlobal = 'global';  //to translate
$strGlobalValue = 'Global value'; //to translate
$strGrantOption = 'Grant'; //to translate

$strId = 'ID'; //to translate
$strIdxFulltext = 'Fulltext'; // To translate
$strImportDocSQL = 'Import docSQL Files';  //to translate
$strInnodbStat = 'InnoDB ����';  //to translate
$strInsertedRowId = 'Inserted row id:';  //to translate

$strLaTeX = 'LaTeX';  //to translate
$strLaTeXOptions = 'LaTeX options';  //to translate
$strLandscape = 'Landscape';  //to translate
$strLinkNotFound = 'Link not found';  //to translate
$strLinksTo = 'Links to';  //to translate

$strMIME_MIMEtype = 'MIME-type';//to translate
$strMIME_available_mime = 'Available MIME-types';//to translate
$strMIME_available_transform = 'Available transformations';//to translate
$strMIME_description = 'Description';//to translate
$strMIME_file = 'Filename';//to translate
$strMIME_nodescription = 'No Description is available for this transformation.<br />Please ask the author, what %s does.';//to translate
$strMIME_transformation = 'Browser transformation';//to translate
$strMIME_transformation_note = 'For a list of available transformation options and their MIME-type transformations, click on %stransformation descriptions%s';//to translate
$strMIME_transformation_options = 'Transformation options';//to translate
$strMIME_transformation_options_note = 'Please enter the values for transformation options using this format: \'a\',\'b\',\'c\'...<br />If you ever need to put a backslash ("\") or a single quote ("\'") amongst those values, backslashes it (for example \'\\\\xyz\' or \'a\\\'b\').';//to translate
$strMIME_without = 'MIME-types printed in italics do not have a seperate transformation function';//to translate
$strMissingBracket = 'Missing Bracket';  //to translate
$strMoveTableSameNames = 'Can\'t move table to same one!';  //to translate
$strMustSelectFile = 'You should select file which you want to insert.';  //to translate

$strNoIndexPartsDefined = 'No index parts defined!'; // To translate
$strNoOptions = 'This format has no options';//to translate
$strNoPermission = 'The web server does not have permission to save the file %s.';  //to translate
$strNoSpace = 'Insufficient space to save the file %s.';  //to translate
$strNoValidateSQL = 'Skip Validate SQL';  //to translate
$strNotOK = 'not OK';  //to translate
$strNotSet = '<b>%s</b> ���̺��� ��ų� or not set in %s';  //to translate
$strNull = 'Null'; // To translate
$strNumSearchResultsInTable = '%s match(es) inside table <i>%s</i>';//to translate
$strNumSearchResultsTotal = '<b>Total:</b> <i>%s</i> match(es)';//to translate

$strOK = 'OK';  //to translate
$strOftenQuotation = 'Often quotation marks. �ɼ�(OPTIONALLY): char �� varchar �ʵ尪; ���ǥ(")���ڷ� �ݴ´ٴ� ��; ���մϴ�.';  // To translate
$strOverwriteExisting = 'Overwrite existing file(s)';  //to translate

$strPartialText = 'Partial Texts'; // To translate
$strPerHour = 'per hour'; //to translate
$strPerMinute = 'per minute';//to translate
$strPerSecond = 'per second';//to translate
$strPortrait = 'Portrait';  //to translate
$strPrivDescProcess4 = 'Allows viewing the complete queries in the process list.'; //to translate
$strPrivDescReplClient = 'Gives the right to the user to ask where the slaves / masters are.'; //to translate
$strPrivDescSuper = '�ִ� ����� �ʰ���; ��쿡�� ����; ���; Required for most administrative operations like setting global variables or killing threads of other users.'; //to translate

$strQueryFrameDebugBox = 'Active variables for the query form:\nDB: %s\nTable: %s\nServer: %s\n\nCurrent variables for the query form:\nDB: %s\nTable: %s\nServer: %s\n\nOpener location: %s\nFrameset location: %s.';//to translate

$strRelationView = 'Relation view';  //to translate
$strRelationalSchema = 'Relational schema';  //to translate
$strRelations = 'Relations';  //to translate

$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';  //to translate
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';  //to translate
$strSaveOnServer = 'Save on server in %s directory';  //to translate
$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';  //to translate
$strSearchResultsFor = 'Search results for "<i>%s</i>" %s:';//to translate
$strSelectTables = 'Select Tables';  //to translate
$strShowDatadictAs = 'Data Dictionary Format';  //to translate
$strShowFullQueries = 'Show Full Queries';  //to translate
$strShowTableDimension = 'Show dimension of tables';  //to translate

$strTableOfContents = 'Table of contents';  //to translate
$strThisHost = 'This Host'; //to translate
$strTransformation_image_jpeg__inline = 'Displays a clickable thumbnail; options: width,height in pixels (keeps the original ratio)';  //to translate
$strTransformation_image_jpeg__link = 'Displays a link to this image (direct blob download, i.e.).';//to translate
$strTransformation_image_png__inline = 'See image/jpeg: inline';  //to translate
$strTransformation_text_plain__dateformat = 'Takes a TIME, TIMESTAMP or DATETIME field and formats it using your local dateformat. First option is the offset (in hours) which will be added to the timestamp (Default: 0). Second option is a different dateformat according to the parameters available for PHPs strftime().';//to translate
$strTransformation_text_plain__external = 'LINUX ONLY: �ܺ� �wα׷�; �����ϰ� ǥ�� �Է�8�� fielddata �� ����մϴ�. Returns standard output of the application. Default is Tidy, to pretty print HTML code. For security reasons, you have to manually edit the file libraries/transformations/text_plain__external.inc.php and insert the tools you allow to be run. The first option is then the number of the program you want to use and the second option are the parameters for the program. The third parameter, if set to 1 will convert the output using htmlspecialchars() (Default is 1). A fourth parameter, if set to 1 will put a NOWRAP to the content cell so that the whole output will be shown without reformatting (Default 1)';//to translate
$strTransformation_text_plain__formatted = 'Preserves original formatting of the field. No Escaping is done.';//to translate
$strTransformation_text_plain__imagelink = 'Displays an image and a link, the field contains the filename; first option is a prefix like "http://domain.com/", second option is the width in pixels, third is the height.';  //to translate
$strTransformation_text_plain__link = 'Displays a link, the field contains the filename; first option is a prefix like "http://domain.com/", second option is a title for the link.';  //to translate
$strTransformation_text_plain__substr = 'Only shows part of a string. First option is an offset to define where the output of your text starts (Default 0). Second option is an offset how much text is returned. If empty, returns all the remaining text. The third option defines which chars will be appended to the output when a substring is returned (Default: ...) .';//to translate
$strTransformation_text_plain__unformatted = 'Displays HTML code as HTML entities. No HTML formatting is shown.';//to translate
$strTruncateQueries = 'Truncate Shown Queries';  //to translate

$strUpdComTab = 'Please see Documentation on how to update your Column_comments Table';  //to translate
$strUseHostTable = 'Use Host Table';  //to translate
$strUseTextField = 'Use text field'; //to translate

$strWildcard = 'wildcard';  //to translate
$strWritingCommentNotPossible = 'Writing of comment not possible';  //to translate
$strWritingRelationNotPossible = 'Writing of relation not possible';  //to translate

$strXML = 'XML';//to translate

$strLoadMethod = 'LOAD method';  //to translate
$strLoadExplanation = 'The best method is checked by default, but you can change if it fails.';  //to translate
$strExecuteBookmarked = 'Execute bookmarked query';  //to translate
$strExcelOptions = 'Excel options';  //to translate
$strReplaceNULLBy = 'Replace NULL by';  //to translate
$strQueryWindowLock = 'Do not overwrite this query from outside the window';  //to translate
$strPaperSize = 'Paper size';  //to translate
$strDatabaseNoTable = 'This database contains no table!';//to translate
$strViewDumpDatabases = 'View dump (schema) of databases';//to translate
$strAddIntoComments = 'Add into comments';//to translate
$strDatabaseExportOptions = 'Database export options';//to translate
$strAddDropDatabase = 'Add DROP DATABASE';//to translate
$strToggleScratchboard = 'toggle scratchboard';  //to translate
$strTableOptions = 'Table options';  //to translate
$strSecretRequired = 'The configuration file now needs a secret passphrase (blowfish_secret).';  //to translate
$strAccessDeniedExplanation = 'phpMyAdmin tried to connect to the MySQL server, and the server rejected the connection. You should check the host, username and password in config.inc.php and make sure that they correspond to the information given by the administrator of the MySQL server.';  //to translate
$strAddAutoIncrement = 'Add AUTO_INCREMENT value';  //to translate
$strCharsets = 'Charsets';  //to translate
$strDescription = 'Description';  //to translate
$strCharsetsAndCollations = 'Character Sets and Collations';  //to translate
$strCollation = 'Collation';  //to translate
$strMultilingual = 'multilingual';  //to translate
$strGerman = 'German';  //to translate
$strPhoneBook = 'phone book';  //to translate
$strDictionary = 'dictionary';  //to translate
$strSwedish = 'Swedish';  //to translate
$strDanish = 'Danish';  //to translate
$strCzech = 'Czech';  //to translate
$strTurkish = 'Turkish';  //to translate
$strEnglish = 'English';  //to translate
$strHungarian = 'Hungarian';  //to translate
$strCroatian = 'Croatian';  //to translate
$strBulgarian = 'Bulgarian';  //to translate
$strLithuanian = 'Lithuanian';  //to translate
$strEstonian = 'Estonian';  //to translate
$strCaseInsensitive = 'case-insensitive';  //to translate
$strCaseSensitive = 'case-sensitive';  //to translate
$strUkrainian = 'Ukrainian';  //to translate
$strHebrew = 'Hebrew';  //to translate
$strWestEuropean = 'West European';  //to translate
$strCentralEuropean = 'Central European';  //to translate
$strTraditionalChinese = 'Traditional Chinese';  //to translate
$strCyrillic = 'Cyrillic';  //to translate
$strArmenian = 'Armenian';  //to translate
$strArabic = 'Arabic';  //to translate
$strRussian = 'Russian';  //to translate
$strUnknown = 'unknown';  //to translate
$strBaltic = 'Baltic';  //to translate
$strUnicode = 'Unicode';  //to translate
$strSimplifiedChinese = 'Simplified Chinese';  //to translate
$strKorean = 'Korean';  //to translate
$strGreek = 'Greek';  //to translate
$strJapanese = 'Japanese';  //to translate
$strThai = 'Thai';  //to translate
$strUseThisValue = 'Use this value';  //to translate
$strWindowNotFound = 'The target browser window could not be updated. Maybe you have closed the parent window or your browser is blocking cross-window updates of your security settings';  //to translate
$strBrowseForeignValues = 'Browse foreign values';  //to translate
?>
