<?php
/* $Id$ */

// terc�medeki eksiklerimi ve ya sehv oldu�unu d���nd�y�n�z yerleri shehriyari@trcomm.net adresine g�ndere bilersiniz...
// �ehriyar �manov 30 Avqust 2003... Shehi

$charset = 'iso-8859-9';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';
$number_thousands_separator = ',';
$number_decimal_separator = '.';
// shortcuts for Byte, Kilo, Mega, Giga, Tera, Peta, Exa
$byteUnits = array('Bayt', 'KB', 'MB', 'QB', 'TB', 'PB', 'EB');

$day_of_week = array('Baz', 'Baz Ert', '�er� Ax�', '�er�', 'C�me Ax�', 'C�me', '�en');
$month = array('Yan', 'Fev', 'Mar', 'Apr', 'May', '�yun', '�yul', 'Avq', 'Sent', 'Okt', 'Noy', 'Dek');
// See http://www.php.net/manual/en/function.strftime.php to define the
// variable below
$datefmt = '%B %d, %Y saat %I:%M %p';
$timespanfmt = '%s g�n, %s saat, %s deqiqe ve %s saniye';

$strAPrimaryKey = '%s �zerine Birinci Dereceli A�ar elave edildi.';
$strAbortedClients = 'Dayand�r�ld�';
$strAbsolutePathToDocSqlDir = 'Xahi� edirik, docSQL direktoriyas�na webserver-deki m�tleq yolu (absolute path) g�sterin.';
$strAccessDenied = 'Giri� Tesdiq Edilmedi';
$strAction = 'Fealiyyetler';
$strAddDeleteColumn = 'Sahe S�tunlar�n� Elave Et/Sil';
$strAddDeleteRow = 'Kriteria Setirlerini Elave Et/Sil';
$strAddNewField = 'Yeni sahe elave et';
$strAddPriv = 'Yeni selahiyyet elave et';
$strAddPrivMessage = 'Yeni selahiyyet m�eyyen etdiniz.';
$strAddPrivilegesOnDb = 'A�a��dak� me\'lumat bazas� ���n selahiyyet m�eyyen et';
$strAddPrivilegesOnTbl = 'A�a��dak� cedvel ���n selahiyyetler m�eyyen et';
$strAddSearchConditions = 'Axtar�� �ertlerini gir ("where" ifadesinin esas metni):';
$strAddToIndex = '�ndekse &nbsp;%s&nbsp;s�tun elave et';
$strAddUser = 'Yeni �stifade�i Elave Et';
$strAddUserMessage = 'Yeni istifade�i elave etdiniz.';
$strAddedColumnComment = 'Bu s�tun ���n q�sa izahat elave edildi';
$strAddedColumnRelation = 'S�tun ���n elaqe elave edildi';
$strAdministration = 'Administrasiya';
$strAffectedRows = 'Deyi�en setir say�:';
$strAfter = 'Sonra: %s';
$strAfterInsertBack = 'Evvelki sehifeye qay�t';
$strAfterInsertNewInsert = 'Teze bir setir daha gir';
$strAll = 'All';
$strAllTableSameWidth = 'eyni enli b�t�n Cedveller g�sterilsinmi?';
$strAlterOrderBy = 'Cedvel s�ras�na buna g�re yeniden qur';
$strAnIndex = '%s �zerine indeks elave edildi';
$strAnalyzeTable = 'Cedveli analiz et';
$strAnd = 'Ve';
$strAny = 'Her hans�';
$strAnyColumn = 'Her hans� s�tun';
$strAnyDatabase = 'Her hans� baza';
$strAnyHost = 'Her hans� host';
$strAnyTable = 'Her hans� cedvel';
$strAnyUser = 'Her hans� istifade�i';
$strAscending = 'Artan s�rada';
$strAtBeginningOfTable = 'Cedvelin ba��na';
$strAtEndOfTable = 'Cedvelin sonuna';
$strAttr = 'X�susiyyetler';
$strAutodetect = 'Avtomatik';
$strAutomaticLayout = 'Automatik �ablon';

$strBack = 'Geri';
$strBeginCut = 'BEGIN CUT';
$strBeginRaw = 'BEGIN RAW';
$strBinary = 'Binary';
$strBinaryDoNotEdit = 'Binary - deyi�iklik etme';
$strBookmarkDeleted = 'Bookmark silindi.';
$strBookmarkLabel = 'Etiket';
$strBookmarkQuery = 'Bookmark-lanm�� SQL sor�usu';
$strBookmarkThis = 'Bu SQL sor�usunu bookmark-la';
$strBookmarkView = 'Sadece g�ster';
$strBrowse = '��indekiler';
$strBzError = 'phpMyAdmin was unable to compress the dump because of a broken Bz2 extension in this php version. It is strongly recommended to set the <code>$cfg[\'BZipDump\']</code> directive in your phpMyAdmin configuration file to <code>FALSE</code>. If you want to use the Bz2 compression features, you should upgrade to a later php version. See php bug report %s for details.';
$strBzip = '"bzip"lenmi�';

$strCSVOptions = 'CSV variantlar�';
$strCannotLogin = 'MySQL server-e gire bilmirem';
$strCantLoad = '%s uzant�s�n� (extension) y�kleye bilmirem,<br />xahi� edirem PHP Konfiqurasiyan� g�zden ke�ir.';
$strCantLoadMySQL = 'MySQL uzant�s�n� (extension) y�kleye bilmirem,<br />xahi� edirem PHP Konfiqurasiyan� g�zden ke�ir.';
$strCantLoadRecodeIconv = 'Charset �evirmeleri ���n laz�m olan iconv ve ya recode uzant�lar�n� y�kleye bilmirem; ya php-ni bu uzant�lar� istifade ede bilmesi ���n yeniden qura�d�r�n ya da phpMyAdmin-de charset �evirme x�susiyyetini s�nd�r�n.';
$strCantRenameIdxToPrimary = '�ndeksi Birinci Dereceli (PRIMARY) olaraq yeniden adland�ra bilmirem!';
$strCantUseRecodeIconv = 'Can not use iconv nor libiconv nor recode_string function while extension reports to be loaded. Check your php configuration.';
$strCardinality = 'Cardinality';
$strCarriage = 'Carriage return: \\r';
$strChange = 'Deyi�dir';
$strChangeCopyMode = 'Eyni selahiyyetlere sahib yeni istifade�i qur ve ...';  
$strChangeCopyModeCopy = '... k�hnesini saxla.';  
$strChangeCopyModeDeleteAndReload = ' ... istifade�i cedvellerinden k�hnesini sil ve ard�ndan selahiyyetleri yeniden y�kle.';  
$strChangeCopyModeJustDelete = ' ... istifade�i cedvellerinden k�hnesini sil.';  
$strChangeCopyModeRevoke = ' ... k�hne istifade�inin selahiyyetlerini elinden alaraq onu sil.';  
$strChangeCopyUser = 'Sistem Giri� Me\'lumat�n� Deyi�dir / �stifade�ini Kopyala';  
$strChangeDisplay = 'G�sterilecek Saheni Se�';
$strChangePassword = 'Parolu Deyi�dir';
$strCharset = 'Charset';
$strCharsetOfFile = 'Fayl�n Charset-i:';
$strCheckAll = 'Ham�s�n� Se�';
$strCheckDbPriv = 'Me\'lumat Bazas� Selahiyyetlerini G�zden Ke�ir';
$strCheckPrivs = 'Selahiyyetleri G�zden Ke�ir';
$strCheckPrivsLong = '&quot;%s&quot; bazas� ���n selahiyyetleri g�zden ke�ir.';
$strCheckTable = 'Cedveli yoxla';
$strChoosePage = 'Xahi� edirem, deyi�dirilecek Sehifeni se�';
$strColComFeat = 'S�tun Q�sa �zahat�n� Deyi�dir';
$strColumn = 'S�tun';
$strColumnNames = 'S�tun adlar�';
$strColumnPrivileges = 'S�tunaxas Selahiyyetler';
$strCommand = 'Komanda';
$strComments = 'Q�sa �zahatlar';
$strCompleteInserts = 'Tam giri�li (complete inserts)';
$strCompression = 'S�x��d�rma';
$strConfigFileError = 'phpMyAdmin konfiqurasiya fayl�n�z� oxuya bilmedi!<br />Bunun sebebi fayldak� parse error ya da fayl�n m�vcud olmamas� ola biler.<br />Xahi� edirem a�a��dak� link-i istifade ederek konfiqurasiya fayl�n� �a��r�n ve ald���n�z php xeta mesaj(lar)�n� oxuyun. Bir �ox halda ya tek d�rnaq ya da n�qteli verg�l eksikliyi vard�r.<br />Eger bo� sehife ile qar��la�san�z, demek ki, her �ey qaydas�ndad�r.';
$strConfigureTableCoord = 'Xahi� edirem, %s cedveli ���n koordinatlar� yeniden m�eyyen et.';
$strConfirm = 'Bunu heqiqeten etmek istediyinizden eminmisiniz?';
$strConnections = 'Rabiteler (Connections)';
$strCookiesRequired = 'Sisteme girebilmeniz ���n �erez fayllar� (cookie-ler) aktiv olmal�d�r.';
$strCopyTable = 'Cedveli kopyala (me\'lumat bazas�<b>.</b>cedvel):';
$strCopyTableOK = '%s cedveli %s - e kopyaland�.';
$strCopyTableSameNames = 'Cedveli eynisinin �zerine kopyalaya bilmerem!';
$strCouldNotKill = 'phpMyAdmin %s emeliyyat thread-ini �ld�re (kill) bilmedi. B�y�k ehtimal art�q s�nd�r�lm��d�r.';
$strCreate = 'Qur';
$strCreateIndex = '&nbsp;%s&nbsp;s�tunda indeks yarat';
$strCreateIndexTopic = 'Yeni indeks qur';
$strCreateNewDatabase = 'Yeni me\'lumat bazas� yarat';
$strCreateNewTable = '%s bazas�nda yeni cedvel qur';
$strCreatePage = 'Yeni Sehife qur';
$strCreatePdfFeat = 'PDF-lerin qurulmas�';
$strCriteria = 'Kriteriyalar';

$strDBComment = 'Baza q�sa izahat�: ';
$strDBGContext = 'Metn (kontekst)';
$strDBGContextID = 'Kontekst N�mresi';
$strDBGHits = 'Hit-ler';
$strDBGLine = 'Setir';
$strDBGMaxTimeMs = 'Min m�ddet, ms';
$strDBGMinTimeMs = 'Max m�ddet, ms';
$strDBGModule = 'Modul';
$strDBGTimePerHitMs = 'Vaxt/Hit, ms';
$strDBGTotalTimeMs = 'Toplam m�ddet, ms';
$strData = 'Me\'lumat';
$strDataDict = 'Me\'lumat L��eti (Data Dictionary)';
$strDataOnly = 'Sadece me\'lumat';
$strDatabase = 'Me\'lumat Bazas� ';
$strDatabaseHasBeenDropped = '%s bazas� le�v edildi.';
$strDatabaseWildcard = 'Me\'lumat Bazas� (wildcard-lara icaze var):';
$strDatabases = 'Me\'lumat bazalar�';
$strDatabasesDropped = '%s baza m�veffeqiyyetle le�v edildi.';
$strDatabasesStats = 'Me\'lumat Bazas� Statistikalar�';
$strDatabasesStatsDisable = 'Statistikalar� Passivle�dir';
$strDatabasesStatsEnable = 'Statistikalar� Aktivle�dir';
$strDatabasesStatsHeavyTraffic = 'Qeyd: Me\'lumat Bazas� statistikalar�n� burada i�e salmaqla webserver-le MySQL server aras�nda a��r neqliyyat (traffic) meydana getire bilersiniz.';
$strDbPrivileges = 'Me\'lumat Bazas�na Mexsus Selahiyyetler';
$strDbSpecific = 'bazayaxas';  
$strDefault = 'Ba�lan��c deyer';
$strDefaultValueHelp = 'Ba�lan��c deyer girerken, sadece deyeri girin, ters kesr escape-leme ya da d�rnaqdan istifade etmeyin, bu format� te\'qib edin: a';
$strDelOld = 'Hal-haz�rki sehifen art�q m�vcud olmayan Cedvellere ba�l�d�r. Bu elaqelerin silinmesini istermisiniz?';
$strDelete = 'Sil';
$strDeleteAndFlush = 'B�t�n istifade�ileri sil ve ard�ndan selahiyyetleri yeniden y�kle.';
$strDeleteAndFlushDescr = 'Bu en temiz yoldur, amma selahiyyetlerin yeniden y�klenmesi zaman teleb ede biler.';
$strDeleteFailed = 'Silme M�veffeqiyyetsiz Oldu!';
$strDeleteUserMessage = '%s istifade�isini sildiniz.';
$strDeleted = 'Setir silindi';
$strDeletedRows = 'Silinen setir say�:';
$strDeleting = '%s silinir';
$strDescending = 'Azalan s�rada';
$strDisabled = 'S�nd�r�l�b';
$strDisplay = 'G�ster';
$strDisplayFeat = 'X�susiyyetleri G�ster';
$strDisplayOrder = 'S�ralama �ekli:';
$strDisplayPDF = 'PDF sxemini g�ster';
$strDoAQuery = '"n�muneye g�re sor�u" g�nderin (x�susi i�are: "%")';
$strDoYouReally = 'A�a��dak� sor�unu icra etdirmekten eminsiniz ';
$strDocu = 'Dokumentasiya';
$strDrop = 'Le�v et';
$strDropDB = '%s bazas�n� le�v et';
$strDropSelectedDatabases = 'Se�ilmi� Me\'lumat Bazalar�n� Le�v Et';
$strDropTable = 'Cedveli le�v et';
$strDropUsersDb = '�stifade�ilerle eyni adl� me\'lumat bazalar�n� le�v et.';
$strDumpComments = 's�tun izahatlar�n� daxili SQL q�sa izahatlar� �eklinde elave et';
$strDumpSaved = 'Sxem %s fayl�na qeyd edildi.';
$strDumpXRows = '%s setri %s n�mreli qeydden ba�layaraq g�ster.';
$strDumpingData = 'Sxemi ��xar�lan cedvel';
$strDynamic = 'dinamik';

$strEdit = 'Deyi�dir';
$strEditPDFPages = 'PDF Sehifelerini Deyi�dir';
$strEditPrivileges = 'Selahiyyetleri Deyi�dir';
$strEffective = 'Effektiv';
$strEmpty = 'Bo�alt';
$strEmptyResultSet = 'MySQL bo� netice �oxlu�u g�nderdi (ye\'ni s�f�r setir).';
$strEnabled = 'Enabled';
$strEnd = 'Son';
$strEndCut = 'END CUT';
$strEndRaw = 'END RAW';
$strEnglishPrivileges = ' Qeyd: MySQL selahiyyet adlar� ingilis dilinde ifade edilmi�dir ';
$strError = 'Xeta';
$strExplain = 'SQL-i �zah Et';
$strExport = 'Eksport';
$strExportToXML = 'XML format�nda eksport et';
$strExtendedInserts = 'Geni�letilmi� giri�li (extended inserts)';
$strExtra = 'Elave X�s.';

$strFailedAttempts = 'U�ursuz Cehdler';
$strField = 'Sahe';
$strFieldHasBeenDropped = '%s sahesi le�v edildi';
$strFields = 'Sahe say�';
$strFieldsEmpty = ' Sahe say�ac� bo�dur! ';
$strFieldsEnclosedBy = 'Saheler ehate edildiyi i�are';
$strFieldsEscapedBy = 'Sahelerin escape edildiyi i�are';
$strFieldsTerminatedBy = 'Sahelerin yox edildiyi (terminate) i�are';
$strFileAlreadyExists = '%s fayl� serverda onsuz da m�vcuddur, ya fayl�n ad�n� deyi�dir ya da �zerine yazma variantlar�n�.';
$strFileCouldNotBeRead = 'Fayl oxuna bilmir';
$strFileNameTemplate = 'Fayl ad� nomenklaturas�';
$strFileNameTemplateHelp = '__DB__ ifadesini me\'lumat bazas� ad�, __TABLE__ ifadesini de cedvel ad� ve %sher hans� strftime%s se�eneklerini de vaxt ifadeleri ���n istifade edin; fayl uzant�s� avtomatik olaraq elave edilecekdir. Diger metnler oldu�u kimi saxlanacaqd�r.';
$strFileNameTemplateRemember = 'nomenklaturan� unutma';
$strFixed = 'fixed';
$strFlushPrivilegesNote = 'Qeyd: phpMyAdmin istifade�i selahiyyetlerini birba�a MySQL-in selahiyyetler cedvellerinden almaqdad�r. Eger elle nizamlamalar edilmi�se, bu cedvellerin i�erisindekiler webserver-in istifade etdiklerinden ferqli ola biler. Bu halda, davam etmeden evvel, selahiyyetleri yeniden y�klemelisiniz.';
$strFlushTable = 'Cedveli flush-la ("FLUSH")';
$strFormEmpty = 'Formda eksik girilmi� deyer var!';
$strFormat = 'Format';
$strFullText = 'Tam Metnler (Full Text)';
$strFunction = 'Funksiya';

$strGenBy = 'Qurucu';
$strGenTime = 'Haz�rlanma Vaxt�';
$strGeneralRelationFeat = '�mumi elaqe variantlar�';
$strGlobal = 'qlobal';  
$strGlobalPrivileges = 'Qlobal selahiyyetler';
$strGlobalValue = 'Qlobal deyer';
$strGo = 'Davam';
$strGrantOption = '�caze ver';
$strGrants = '�znler';
$strGzip = '"gzip"lenmi�';

$strHasBeenAltered = 'deyi�dirildi.';
$strHasBeenCreated = 'quruldu.';
$strHaveToShow = 'G�sterilmesi ���n en az bir s�tun se�melisiniz';
$strHome = 'Ba�lan��c';
$strHomepageOfficial = 'phpMyAdmin Resmi �nternet Sehifesi';
$strHomepageSourceforge = 'Sourceforge phpMyAdmin Download Sehifesi';
$strHost = 'Host';
$strHostEmpty = 'Host ad� bo�dur!';

$strId = 'N�mre';
$strIdxFulltext = 'Tam metn (Fulltext)';
$strIfYouWish = 'Cedvelin sadece be\'zi s�tunlar�n� y�klemek isteyirsinizse, saheleri aralar�na verg�l qoyaraq g�ster.';
$strIgnore = 'Diqqete Alma';
$strIgnoringFile = '%s Diqqete Almama (Ignore) fayl�';
$strImportDocSQL = 'docSQL Fayllar�n� �mport Et';
$strImportFiles = 'Fayllar� import et';
$strImportFinished = '�mport ba�a �atd�';
$strInUse = 'istifadede';
$strIndex = '�ndeks';
$strIndexHasBeenDropped = '%s indeksi le�v edildi';
$strIndexName = '�ndex ad�&nbsp;:';
$strIndexType = '�ndex tipi&nbsp;:';
$strIndexes = 'Indeksler';
$strInnodbStat = 'InnoDB Status';
$strInsecureMySQL = 'Konfiqurasiya fayl�n�zda MySQL ba�lan��c deyerleri (parolsuz root istifade�isi) m�vcuddur ki, bu da tehl�kesizlik n�qteyi nezerinden e\'tibarl� deyildir.';
$strInsert = 'Elave et';
$strInsertAsNewRow = 'Yeni setir olaraq elave et';
$strInsertNewRow = 'Yeni setir elave et';
$strInsertTextfiles = 'Metn fayl�ndan cedvele me\'lumat gir';
$strInsertedRowId = 'Elave edilen setir n�mresi (id):';
$strInsertedRows = 'Elave edilen setir say�:';
$strInstructions = '�nstruksiyalar';
$strInvalidName = '"%s" x�susi ifadedir, baza/cedvel/sahe adland�rmas�nda istifade edile bilmez.';

$strJumpToDB = '&quot;%s&quot; me\'lumat bazas�na ke�.';
$strJustDelete = 'Sadece olaraq selahiyyet cedvellerindeki istifade�ileri sil.';
$strJustDeleteDescr = '&quot;Silinmi�&quot; istifade�iler selahiyyetler yeniden y�klenene qeder server-e gire bilecekler.';

$strKeepPass = 'Parolu deyi�dirme';
$strKeyname = 'A�ar s�z';
$strKill = '�ld�r (Kill)';

$strLaTeX = 'LaTeX';
$strLaTeXOptions = 'LaTeX variantlar�';
$strLandscape = 'Land�aft';
$strLength = 'Uzunluq';
$strLengthSet = 'Uzunluq/Deyerler*';
$strLimitNumRows = 'Sehife ba��na d��en setir say�';
$strLineFeed = 'Linefeed: \\n';
$strLines = 'Setirler';
$strLinesTerminatedBy = 'Setir le�vedicisi (Lines terminated by)';
$strLinkNotFound = 'Link tap�lmad�';
$strLinksTo = 'Links to';
$strLoadExplanation = 'En yax�� metod ba�lan��c deyer olaraq i�aretlenmi�dir; amma i�lemezse onu deyi�dire bilersiniz.';
$strLoadMethod = 'LOAD metodu';
$strLocalhost = 'Yerli';
$strLocationTextfile = 'metn fayl�n�z�n yolunu g�ster';
$strLogPassword = 'Parol:';
$strLogUsername = '�stifade�i Ad�:';
$strLogin = 'Sisteme Giri�';
$strLoginInformation = 'Sisteme Giri� Me\'lumat�';
$strLogout = 'Sistemden ��x��';

$strMIME_MIMEtype = 'MIME-tipi';
$strMIME_available_mime = 'M�vcud olan MIME-tipleri';
$strMIME_available_transform = 'M�vcud transformasiyalar';
$strMIME_description = 'Haqq�nda';
$strMIME_file = 'Fayl ad�';
$strMIME_nodescription = 'No Description is available for this transformation.<br />Please ask the author, what %s does.';
$strMIME_transformation = 'Browser transformation';
$strMIME_transformation_note = 'For a list of available transformation options and their MIME-type transformations, click on %stransformation descriptions%s';
$strMIME_transformation_options = 'Transformasiya variantlar�';
$strMIME_transformation_options_note = 'Please enter the values for transformation options using this format: \'a\',\'b\',\'c\'...<br />If you ever need to put a backslash ("\") or a single quote ("\'") amongst those values, backslashes it (for example \'\\\\xyz\' or \'a\\\'b\').';
$strMIME_without = 'MIME-types printed in italics do not have a seperate transformation function';
$strMissingBracket = 'Missing Bracket';
$strModifications = 'Modifications have been saved';
$strModify = 'Modify';
$strModifyIndexTopic = 'Modify an index';
$strMoreStatusVars = 'More status variables';
$strMoveTable = 'Cedveli da�� (me\'lumat bazas�<b>.</b>cedvel):';
$strMoveTableOK = '%s cedveli %s - e da��nm��d�r.';
$strMoveTableSameNames = 'Can\'t move table to same one!';
$strMustSelectFile = 'You should select file which you want to insert.';
$strMySQLCharset = 'MySQL charset';
$strMySQLReloaded = 'MySQL yeniden y�klendi.';
$strMySQLSaid = 'MySQL deyir: ';
$strMySQLServerProcess = 'MySQL %pma_s1%, %pma_s2% �zerinde %pma_s3% istifade�isi olaraq i�lemektedir';
$strMySQLShowProcess = 'Prosesleri g�ster';
$strMySQLShowStatus = 'MySQL runtime me\'lumat�n� g�ster';
$strMySQLShowVars = 'MySQL sistem deyi�enlerini g�ster';

$strName = 'Ad�';
$strNext = 'Sonrak�';
$strNo = 'Xeyir';
$strNoDatabases = 'Baza yoxdur';
$strNoDatabasesSelected = 'He� bir baza se�ilmemi�dir.';
$strNoDescription = 'Haqq�nda me\'lumat (description) m�vcud deyildir';
$strNoDropDatabases = '"DROP DATABASE" ifadeleri s�nd�r�lm��d�r (disabled).';
$strNoExplain = 'SQL �zah Et-i Ke�';
$strNoFrames = 'phpMyAdmin <b>frame-destekli</b> g�r�nt�leyicilerle (browser) daha yax�� i�leyir.';
$strNoIndex = '�ndeks te\'yin edilmedi!';
$strNoIndexPartsDefined = '�ndeks qisimleri te\'yin edilmedi!';
$strNoModification = 'Deyi�iklik Yoxdur';
$strNoOptions = 'Bu format�n variantlar� yoxdur';
$strNoPassword = 'Parol Yoxdur';
$strNoPermission = 'Webserver-in %s fayl�n� saxlama izni yoxdur.';
$strNoPhp = 'PHP Kodunu G�sterme';
$strNoPrivileges = 'Selahiyyet �at��mazl���';
$strNoQuery = 'Sor�u te\'yin edilmedi!';
$strNoRights = 'Burada olma haqq�n�z yoxdur!';
$strNoSpace = '%s fayl�n� saxlamaq ���n laz�m olan yer �at��m�r.';
$strNoTablesFound = 'Me\'lumat bazas�nda cedvel yoxdur.';
$strNoUsersFound = '�stifade�i(ler) tap�lmad�.';
$strNoUsersSelected = '�stifade�i se�ilmemi�dir.';
$strNoValidateSQL = 'SQL Tesdiqlemeni (Validation) Ke�';
$strNone = 'He� biri';
$strNotNumber = 'Bu reqem deyildir!';
$strNotOK = 'M�veffeqiyyetsiz';
$strNotSet = '<b>%s</b> cedveli %s i�erisinde ya <b>tap�lmad�</b> ya da qurulmam��d�r';
$strNotValidNumber = ' e\'tibarl� setir n�mresi deyildir!';
$strNull = 'Null';
$strNumSearchResultsInTable = '%s uy�unluq tap�ld� (<i>%s</i> cedvelinde)';
$strNumSearchResultsTotal = '<b>Cemi:</b> <i>%s</i> uy�unluq';
$strNumTables = 'Cedveller';

$strOK = 'M�veffeqiyyetle';
$strOftenQuotation = 'Often quotation marks. OPTIONALLY means that only char and varchar fields are enclosed by the "enclosed by"-character.';
$strOperations = 'Emeliyyatlar';
$strOptimizeTable = 'Cedveli optimalla�d�r';
$strOptionalControls = 'Optional. Controls how to write or read special characters.';
$strOptionally = 'OPTIONALLY';
$strOptions = 'Variantlar';
$strOr = 'ya da';
$strOverhead = 'A�ma deyeri';
$strOverwriteExisting = 'Overwrite existing file(s)';

$strPHP40203 = 'You are using PHP 4.2.3, which has a serious bug with multi-byte strings (mbstring). See PHP bug report 19404. This version of PHP is not recommended for use with phpMyAdmin.';
$strPHPVersion = 'PHP Versiyas�';
$strPageNumber = 'Sehife N�mresi:';
$strPartialText = 'Qismi Metnler';
$strPassword = 'Parol';
$strPasswordChanged = '%s ���n parol m�veffeqiyyetle deyi�dirilmi�dir.';
$strPasswordEmpty = 'Parol bo�dur!';
$strPasswordNotSame = 'Giridiyiniz parollar eyni deyil!';
$strPdfDbSchema = '"%s" bazan�n sxemi - Sehife %s';
$strPdfInvalidPageNum = 'Te\'yin edilmemi� PDF sehife n�mresi!';
$strPdfInvalidTblName = '"%s" cedveli m�vcud deyil!';
$strPdfNoTables = 'Cedvel yoxdur';
$strPerHour = 'saatda';
$strPerMinute = 'deqiqede';
$strPerSecond = 'saniyede';
$strPhp = 'PHP Kodunu Haz�rla';
$strPmaDocumentation = 'phpMyAdmin dokumentasiyas� (etrafl� me\'lumat ���n)';
$strPmaUriError = 'The <tt>$cfg[\'PmaAbsoluteUri\']</tt> directive MUST be set in your configuration file!';
$strPortrait = 'Portret';
$strPos1 = 'Ba�la';
$strPrevious = 'Evvelki';
$strPrimary = 'Birinci Dereceli';
$strPrimaryKey = 'Birinci Dereceli A�ar';
$strPrimaryKeyHasBeenDropped = 'Birinci dereceli a�ar le�v edildi';
$strPrimaryKeyName = 'Birinci dereceli a�ar�n ad�... (B�R�NC� DERECEL�) PRIMARY olmal�d�r!';
$strPrimaryKeyWarning = '("PRIMARY" sadece birinci dereceli a�ar�n ad� <b>olmal�d�r</b>!)';
$strPrint = '�ap et';
$strPrintView = '�ap g�r�nt�s�';
$strPrivDescAllPrivileges = 'GRANT-dan ba�qa b�t�n selahiyyetler daxildir.';
$strPrivDescAlter = 'M�vcud olan cedvellerin strukturunu deyi�dirmeye icaze verir.';
$strPrivDescCreateDb = 'Yeni bazalar ve cedveller qurma�a icaze verir.';
$strPrivDescCreateTbl = 'Yeni cedveller qurma�a icaze verir.';
$strPrivDescCreateTmpTable = 'Ke�ici cedveller qurma�a icaze verir.';
$strPrivDescDelete = 'Me\'lumat silmeye icaze verir.';
$strPrivDescDropDb = 'Baza ve cedvel le�v etmeye icaze verir.';
$strPrivDescDropTbl = 'Cedvelleri le�v etmeye icaze verir.';
$strPrivDescExecute = 'Allows running stored procedures; Has no effect in this MySQL version.';
$strPrivDescFile = 'Allows importing data from and exporting data into files.';
$strPrivDescGrant = 'Allows adding users and privileges without reloading the privilege tables.';
$strPrivDescIndex = 'Allows creating and dropping indexes.';
$strPrivDescInsert = 'Allows inserting and replacing data.';
$strPrivDescLockTables = 'Allows locking tables for the current thread.';
$strPrivDescMaxConnections = 'Limits the number of new connections the user may open per hour.';
$strPrivDescMaxQuestions = 'Limits the number of queries the user may send to the server per hour.';
$strPrivDescMaxUpdates = 'Limits the number of commands that change any table or database the user may execute per hour.';
$strPrivDescProcess3 = 'Allows killing processes of other users.';
$strPrivDescProcess4 = 'Allows viewing the complete queries in the process list.';
$strPrivDescReferences = 'Has no effect in this MySQL version.';
$strPrivDescReload = 'Allows reloading server settings and flushing the server\'s caches.';
$strPrivDescReplClient = 'Gives the right to the user to ask where the slaves / masters are.';
$strPrivDescReplSlave = 'Needed for the replication slaves.';
$strPrivDescSelect = 'Allows reading data.';
$strPrivDescShowDb = 'Gives access to the complete list of databases.';
$strPrivDescShutdown = 'Allows shutting down the server.';
$strPrivDescSuper = 'Allows connecting, even if maximum number of connections is reached; Required for most administrative operations like setting global variables or killing threads of other users.';
$strPrivDescUpdate = 'Allows changing data.';
$strPrivDescUsage = 'Selahiyyet te\'yin edilmedi.';
$strPrivileges = 'Selahiyyetler';
$strPrivilegesReloaded = 'The privileges were reloaded successfully.';
$strProcesslist = 'Proses siyah�s�';
$strProperties = 'X�susiyyetler';
$strPutColNames = 'Put fields names at first row';

$strQBE = 'Sor�u';
$strQBEDel = 'Del';
$strQBEIns = 'Ins';
$strQueryFrame = 'Sor�u penceresi';
$strQueryFrameDebug = 'Debugging information';
$strQueryFrameDebugBox = 'Active variables for the query form:\nDB: %s\nTable: %s\nServer: %s\n\nCurrent variables for the query form:\nDB: %s\nTable: %s\nServer: %s\n\nOpener location: %s\nFrameset location: %s.';
$strQueryOnDb = 'SQL-query on database <b>%s</b>:';
$strQuerySQLHistory = 'SQL-tarix�esi';
$strQueryStatistics = '<b>Sor�u statistikas�</b>: A��ld�qdan bu yana, bu servere %s sor�u g�nderilmi�dir.';
$strQueryTime = 'sor�u %01.4f saniyede icra edildi';
$strQueryType = 'Sor�u tipi';

$strReType = 'Re-type';
$strReceived = 'Received';
$strRecords = 'Qeydiyyat';
$strReferentialIntegrity = 'Check referential integrity:';
$strRelationNotWorking = 'Elaqelendirilmi� cedveller ���n nezerde tutulmu� be\'zi x�susiyyetler passivle�dirilmi�dir. Sebebini ayd�nla�d�rmaq ���n %sbax%s.';
$strRelationView = 'Relation view';
$strRelationalSchema = 'Relational schema';
$strRelations = 'Relations';
$strReloadFailed = 'MySQL reload failed.';
$strReloadMySQL = 'Reload MySQL';
$strReloadingThePrivileges = 'Reloading the privileges';
$strRememberReload = 'Remember to reload the server.';
$strRemoveSelectedUsers = 'Remove selected users';
$strRenameTable = 'Cedveli yeniden adland�r';
$strRenameTableOK = '%s cedveli %s olaraq yeniden adland�r�lm��d�r';
$strRepairTable = 'Cedveli te\'mir et';
$strReplace = 'Replace';
$strReplaceTable = 'Replace table data with file';
$strReset = 'S�f�rla';
$strResourceLimits = 'Resource limits';
$strRevoke = 'Revoke';
$strRevokeAndDelete = 'Revoke all active privileges from the users and delete them afterwards.';
$strRevokeAndDeleteDescr = 'The users will still have the USAGE privilege until the privileges are reloaded.';
$strRevokeGrant = 'Revoke Grant';
$strRevokeGrantMessage = 'You have revoked the Grant privilege for %s';
$strRevokeMessage = 'You have revoked the privileges for %s';
$strRevokePriv = 'Revoke Privileges';
$strRowLength = 'S�ra uzunlu�u';
$strRowSize = ' S�ra boyu ';
$strRows = 'S�ra say�';
$strRowsFrom = 'setri g�ster; ba�lang�� qeydiyyat n�mresi';
$strRowsModeFlippedHorizontal = '�f�qi (tekrarlanan ba�l�qlar)';
$strRowsModeHorizontal = '�f�qi';
$strRowsModeOptions = '%s rejimde, ba�l�qlar %s blokdan bir tekrar ederek';
$strRowsModeVertical = '�aquli';
$strRowsStatistic = 'S�ra Statistikas�';
$strRunQuery = 'Emri �cra Et';
$strRunSQLQuery = '%s Me\'lumat bazas�na SQL sor�usu(-lar�) g�nder';
$strRunning = '%s �zerinde i�lemektedir';

$strSQL = 'SQL';
$strSQLOptions = 'SQL variantlar�';
$strSQLParserBugMessage = 'There is a chance that you may have found a bug in the SQL parser. Please examine your query closely, and check that the quotes are correct and not mis-matched. Other possible failure causes may be that you are uploading a file with binary outside of a quoted text area. You can also try your query on the MySQL command line interface. The MySQL server error output below, if there is any, may also help you in diagnosing the problem. If you still have problems or if the parser fails where the command line interface succeeds, please reduce your SQL query input to the single query that causes problems, and submit a bug report with the data chunk in the CUT section below:';
$strSQLParserUserError = 'There seems to be an error in your SQL query. The MySQL server error output below, if there is any, may also help you in diagnosing the problem';
$strSQLQuery = 'SQL sor�usu';
$strSQLResult = 'SQL result';
$strSQPBugInvalidIdentifer = 'Invalid Identifer';
$strSQPBugUnclosedQuote = 'Unclosed quote';
$strSQPBugUnknownPunctuation = 'Unknown Punctuation String';
$strSave = 'Qeyd Et';
$strSaveOnServer = 'Save on server in %s directory';
$strScaleFactorSmall = 'The scale factor is too small to fit the schema on one page';
$strSearch = 'Axtar��';
$strSearchFormTitle = 'Search in database';
$strSearchInTables = 'Inside table(s):';
$strSearchNeedle = 'Axtarmaq ���n s�z(ler) ve ya deyer(ler) (wildcard: "%"):';
$strSearchOption1 = 's�zlerin en az�ndan birini';
$strSearchOption2 = 'b�t�n s�zleri';
$strSearchOption3 = 'tamamile eyni s�z�';
$strSearchOption4 = 'requlyar ifade (regular expression) olaraq';
$strSearchResultsFor = '"<i>%s</i>" ���n axtar�� neticeleri %s:';
$strSearchType = 'Tap:';
$strSelect = 'Se�';
$strSelectADb = 'Me\'lumat bazas� se�';
$strSelectAll = 'Ham�s�n� Se�';
$strSelectFields = 'Sahe se�in (en az birini):';
$strSelectNumRows = 'in query';
$strSelectTables = 'Select Tables';
$strSend = 'Fayl olaraq qeyd et';
$strSent = 'G�nderildi';
$strServer = 'Server %s';
$strServerChoice = 'Server Se�imi';
$strServerStatus = 'Runtime Me\'lumat�';
$strServerStatusUptime = 'This MySQL server has been running for %s. It started up on %s.';
$strServerTabProcesslist = 'Prosesler';
$strServerTabVariables = 'Deyi�enler';
$strServerTrafficNotes = '<b>Server neqliyyat�</b>: Bu cedveller bu serverin a��l���ndan beri elde edilen neqliyyat� g�stermektedir.';
$strServerVars = 'Server deyi�enleri ve variantlar�';
$strServerVersion = 'Server versiyas�';
$strSessionValue = 'Sessiya deyeri';
$strSetEnumVal = 'Sahe tipi "enum" ve ya "set" ise, deyerleri bu formatda girin: \'a\',\'b\',\'c\'...<br />Eger bu deyerlerde ters-kesr ("\") ve ya tek d�rnaq ("\'") istifade etmek isteyirsinizse, onlar� ters-kesrle escape-leyin (meselen \'\\\\xyz\' ve ya \'a\\\'b\').';
$strShow = 'G�ster';
$strShowAll = 'Ham�s�n� g�ster';
$strShowColor = 'Rengini g�ster';
$strShowCols = 'S�tunlar� g�ster';
$strShowDatadictAs = 'Data Dictionary Format';
$strShowFullQueries = 'Emrleri Tam Olaraq G�ster';
$strShowGrid = 'Show grid';
$strShowPHPInfo = 'PHP me\'lumat�n� g�ster';
$strShowTableDimension = 'Cedvellerin �l��lerini g�ster';
$strShowTables = 'Cedvelleri g�ster';
$strShowThisQuery = ' Bu sor�unu burada yene g�ster ';
$strShowingRecords = 'G�sterilen setirler';
$strSingly = '(tek-tek)';
$strSize = 'Boy';
$strSort = 'S�rala';
$strSpaceUsage = 'Yer istifadesi';
$strSplitWordsWithSpace = 'S�zler bo�luq ifadesi (" ") ile ayr�lm��d�r.';
$strStatCheckTime = 'En son yoxlama';
$strStatCreateTime = 'Qurulu�';
$strStatUpdateTime = 'En son yenilenme';
$strStatement = 'Variantlar';
$strStatus = 'Status';
$strStrucCSV = 'CSV verilenleri';
$strStrucData = 'Qurulu� ve me\'lumat';
$strStrucDrop = '\'Cedveli le�v et\' elaveli';
$strStrucExcelCSV = 'Ms Excel verilenleri ���n CSV';
$strStrucOnly = 'Sadece qurulu�';
$strStructPropose = 'Alternativ cedvel strukturu';
$strStructure = 'Qurulu�';
$strSubmit = 'Submit';
$strSuccess = 'SQL sor�unuz m�veffeqiyyetle icra edilmi�dir';
$strSum = 'Cemi';
$strSwitchToTable = 'Kopyalanm�� cedvele ke�';

$strTable = 'Cedvel';
$strTableComments = 'Cedvel haqq�nda q�sa izahat';
$strTableEmpty = 'Cedveli ad� bo�dur!';
$strTableHasBeenDropped = '%s cedveli le�v edildi';
$strTableHasBeenEmptied = '%s cedveli bo�ald�ld�';
$strTableHasBeenFlushed = '%s cedveli flush-land�';
$strTableMaintenance = 'Cedvel temizliyi';
$strTableOfContents = '��indekiler Cedveli';
$strTableStructure = 'Table structure for table';
$strTableType = 'Cedvel tipi';
$strTables = '%s cedvel';
$strTblPrivileges = 'Cedvelexas selahiyyetler';
$strTextAreaLength = ' Uzun oldu�una g�re,<br /> bu sahedeki me\'lumatlar deyi�dirilmeye biler ';
$strTheContent = 'The content of your file has been inserted.';
$strTheContents = 'The contents of the file replaces the contents of the selected table for rows with identical primary or unique key.';
$strTheTerminator = 'The terminator of the fields.';
$strThisHost = 'Bu Host';
$strThisNotDirectory = 'Bu direktoriya deyildi';
$strThreadSuccessfullyKilled = 'Thread %s u�urla s�nd�r�ld� (killed).';
$strTime = 'M�ddet';
$strTotal = 'cemi';
$strTotalUC = 'Cemi';
$strTraffic = 'Neqliyyat';
$strTransformation_image_jpeg__inline = 'Displays a clickable thumbnail; options: width,height in pixels (keeps the original ratio)';
$strTransformation_image_jpeg__link = 'Displays a link to this image (direct blob download, i.e.).';
$strTransformation_image_png__inline = 'See image/jpeg: inline';
$strTransformation_text_plain__dateformat = 'Takes a TIME, TIMESTAMP or DATETIME field and formats it using your local dateformat. First option is the offset (in hours) which will be added to the timestamp (Default: 0). Second option is a different dateformat according to the parameters available for PHPs strftime().';
$strTransformation_text_plain__external = 'LINUX ONLY: Launches an external application and feeds the fielddata via standard input. Returns standard output of the application. Default is Tidy, to pretty print HTML code. For security reasons, you have to manually edit the file libraries/transformations/text_plain__external.inc.php and insert the tools you allow to be run. The first option is then the number of the program you want to use and the second option are the parameters for the program. The third parameter, if set to 1 will convert the output using htmlspecialchars() (Default is 1). A fourth parameter, if set to 1 will put a NOWRAP to the content cell so that the whole output will be shown without reformatting (Default 1)';
$strTransformation_text_plain__formatted = 'Preserves original formatting of the field. No Escaping is done.';
$strTransformation_text_plain__imagelink = 'Displays an image and a link, the field contains the filename; first option is a prefix like "http://domain.com/", second option is the width in pixels, third is the height.';
$strTransformation_text_plain__link = 'Displays a link, the field contains the filename; first option is a prefix like "http://domain.com/", second option is a title for the link.';
$strTransformation_text_plain__substr = 'Only shows part of a string. First option is an offset to define where the output of your text starts (Default 0). Second option is an offset how much text is returned. If empty, returns all the remaining text. The third option defines which chars will be appended to the output when a substring is returned (Default: ...) .';
$strTransformation_text_plain__unformatted = 'Displays HTML code as HTML entities. No HTML formatting is shown.';
$strTruncateQueries = 'Truncate Shown Queries';
$strType = 'Tip';

$strUncheckAll = 'He� Birini Se�me';
$strUnique = 'Unikal';
$strUnselectAll = 'He� birini se�me';
$strUpdComTab = 'Please see Documentation on how to update your Column_comments Table';
$strUpdatePrivMessage = 'You have updated the privileges for %s.';
$strUpdateProfile = 'Profili yenile:';
$strUpdateProfileMessage = 'Profil yenilendi.';
$strUpdateQuery = 'Sor�unu Yenile';
$strUsage = 'Miqdar';
$strUseBackquotes = 'Cedvel ve sahe adlar�n� tek d�rnaq aras�na al';
$strUseHostTable = 'Use Host Table';
$strUseTables = 'Use Tables';
$strUseTextField = 'Use text field';
$strUser = '�stifade�i';
$strUserAlreadyExists = '%s istifade�isi m�vcuddur!';
$strUserEmpty = '�stifade�i ad� bo� qald�!';
$strUserName = '�stifade�i ad�';
$strUserNotFound = 'The selected user was not found in the privilege table.';
$strUserOverview = 'User overview';
$strUsers = 'Users';
$strUsersDeleted = 'The selected users have been deleted successfully.';
$strUsersHavingAccessToDb = 'Users having access to &quot;%s&quot;';  

$strValidateSQL = 'SQL Tesdiqle';
$strValidatorError = 'The SQL validator could not be initialized. Please check if you have installed the necessary php extensions as described in the %sdocumentation%s.';
$strValue = 'Deyer';
$strVar = 'Deyi�en';
$strViewDump = 'Cedvelin sxemini g�ster';
$strViewDumpDB = 'Me\'lumat bazas�n�n sxemini g�ster';

$strWebServerUploadDirectory = 'web-server upload direktoriyas�';
$strWebServerUploadDirectoryError = 'Upload i�leri ���n te\'yin etdiyiniz direktoriya tap�lmad�';
$strWelcome = '%s - (n)e Xo� Gelmi�siniz!';
$strWildcard = 'x�susi i�are';  
$strWithChecked = 'Se�ilenleri:';
$strWritingCommentNotPossible = 'Q�sa izahat yaz�l��� m�mk�n deyil';
$strWritingRelationNotPossible = 'Elaqe yaz�l��� m�mk�n deyil';
$strWrongUser = 'Yanl�� istifade�i ad� ve ya parol. Giri� tesdiq edilmedi.';

$strXML = 'XML';

$strYes = 'Beli';

$strZeroRemovesTheLimit = 'Qeyd: Bu variantlar� 0 (s�f�r)-a �evirmek h�dudu (limiti) qald�racaq.';
$strZip = '"zip"lenmi�';

$strAccessDeniedExplanation = 'phpMyAdmin tried to connect to the MySQL server, and the server rejected the connection. You should check the host, username and password in config.inc.php and make sure that they correspond to the information given by the administrator of the MySQL server.';  //to translate
$strAddAutoIncrement = 'Add AUTO_INCREMENT value';  //to translate
$strAddDropDatabase = 'Add DROP DATABASE';//to translate
$strAddIntoComments = 'Add into comments';//to translate
$strArabic = 'Arabic';  //to translate
$strArmenian = 'Armenian';  //to translate

$strBaltic = 'Baltic';  //to translate
$strBrowseForeignValues = 'Browse foreign values';  //to translate
$strBulgarian = 'Bulgarian';  //to translate

$strCaseInsensitive = 'case-insensitive';  //to translate
$strCaseSensitive = 'case-sensitive';  //to translate
$strCentralEuropean = 'Central European';  //to translate
$strCharsets = 'Charsets';  //to translate
$strCharsetsAndCollations = 'Character Sets and Collations';  //to translate
$strCollation = 'Collation';  //to translate
$strCroatian = 'Croatian';  //to translate
$strCyrillic = 'Cyrillic';  //to translate
$strCzech = 'Czech';  //to translate

$strDanish = 'Danish';  //to translate
$strDatabaseExportOptions = 'Database export options';//to translate
$strDatabaseNoTable = 'This database contains no table!';//to translate
$strDescription = 'Description';  //to translate
$strDictionary = 'dictionary';  //to translate

$strEnglish = 'English';  //to translate
$strEstonian = 'Estonian';  //to translate
$strExcelOptions = 'Excel options';  //to translate
$strExecuteBookmarked = 'Execute bookmarked query';  //to translate

$strGerman = 'German';  //to translate
$strGreek = 'Greek';  //to translate

$strHebrew = 'Hebrew';  //to translate
$strHungarian = 'Hungarian';  //to translate

$strJapanese = 'Japanese';  //to translate

$strKorean = 'Korean';  //to translate

$strLithuanian = 'Lithuanian';  //to translate

$strMultilingual = 'multilingual';  //to translate

$strPaperSize = 'Paper size';  //to translate
$strPhoneBook = 'phone book';  //to translate

$strQueryWindowLock = 'Do not overwrite this query from outside the window';  //to translate

$strReplaceNULLBy = 'Replace NULL by';  //to translate
$strRussian = 'Russian';  //to translate

$strSecretRequired = 'The configuration file now needs a secret passphrase (blowfish_secret).';  //to translate
$strSimplifiedChinese = 'Simplified Chinese';  //to translate
$strSwedish = 'Swedish';  //to translate

$strTableOptions = 'Table options';  //to translate
$strThai = 'Thai';  //to translate
$strToggleScratchboard = 'toggle scratchboard';  //to translate
$strTraditionalChinese = 'Traditional Chinese';  //to translate
$strTurkish = 'Turkish';  //to translate

$strUkrainian = 'Ukrainian';  //to translate
$strUnicode = 'Unicode';  //to translate
$strUnknown = 'unknown';  //to translate
$strUseThisValue = 'Use this value';  //to translate

$strViewDumpDatabases = 'View dump (schema) of databases';//to translate

$strWestEuropean = 'West European';  //to translate
$strWindowNotFound = 'The target browser window could not be updated. Maybe you have closed the parent window or your browser is blocking cross-window updates of your security settings';  //to translate

?>
