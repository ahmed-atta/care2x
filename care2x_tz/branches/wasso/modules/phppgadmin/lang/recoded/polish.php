<?php

	/**
	 * Polish language file for WebDB.
	 * @maintainer Rafal Slubowski [slubek@users.sourceforge.net]
	 *
	 * $Id: polish.php,v 1.1 2006/01/13 13:42:17 irroal Exp $
	 */

	// Language and character set
	$lang['applang'] = 'Polski';
	$lang['appcharset'] = 'ISO-8859-2';
	$lang['applocale'] = 'pl_PL';
  	$lang['appdbencoding'] = 'LATIN2';
  
  	// Welcome
	$lang['strintro'] = 'Witaj w phpPgAdmin.';
	$lang['strppahome'] = 'Strona domowa phpPgAdmin';
	$lang['strpgsqlhome'] = 'Strona domowa PostgreSQL';
	$lang['strpgsqlhome_url'] = 'http://www.postgresql.org/';
	$lang['strlocaldocs'] = 'Dokumentacja PostgreSQL (lokalna)';
	$lang['strreportbug'] = 'Zg&#322;o&#347; raport o b&#322;&#281;dzie';
	$lang['strviewfaq'] = 'Przejrzyj FAQ';
	$lang['strviewfaq_url'] = 'http://phppgadmin.sourceforge.net/?page=faq';

	// Basic strings
	$lang['strlogin'] = 'Zaloguj';
	$lang['strloginfailed'] = 'Pr&oacute;ba zalogowania nie powiod&#322;a si&#281;';
	$lang['strlogindisallowed'] = 'Logowanie niedozwolone';
	$lang['strserver'] = 'Serwer';
	$lang['strlogout'] = 'Wyloguj si&#281;';
	$lang['strowner'] = 'W&#322;a&#347;ciciel';
	$lang['straction'] = 'Akcja';	
	$lang['stractions'] = 'Akcje';	
	$lang['strname'] = 'Nazwa';
	$lang['strdefinition'] = 'Definicja';
	$lang['straggregates'] = 'Funkcje agreguj&#261;ce';
	$lang['strproperties'] = 'W&#322;a&#347;ciwo&#347;ci';
	$lang['strbrowse'] = 'Przegl&#261;daj';
	$lang['strdrop'] = 'Usu&#324;';
	$lang['strdropped'] = 'Usuni&#281;ty';
	$lang['strnull'] = 'Null';
	$lang['strnotnull'] = 'Not Null';
	$lang['strprev'] = 'Poprzedni';
	$lang['strnext'] = 'Nast&#281;pny';
	$lang['strfirst'] = '<< Pierwszy';
	$lang['strlast'] = 'Ostatni >>';
	$lang['strfailed'] = 'Nieudany';
	$lang['strcreate'] = 'Utw&oacute;rz';
	$lang['strcreated'] = 'Utworzony';
	$lang['strcomment'] = 'Komentarz';
	$lang['strlength'] = 'D&#322;ugo&#347;&#263;';
	$lang['strdefault'] = 'Domy&#347;lny';
	$lang['stralter'] = 'Zmie&#324;';
	$lang['strok'] = 'OK';
	$lang['strcancel'] = 'Anuluj';
	$lang['strsave'] = 'Zapisz';
	$lang['strreset'] = 'Wyczy&#347;&#263;';
	$lang['strinsert'] = 'Wstaw';
	$lang['strselect'] = 'Wybierz';
	$lang['strdelete'] = 'Usu&#324;';
	$lang['strupdate'] = 'Zmie&#324;';
	$lang['strreferences'] = 'Odno&#347;niki';
	$lang['stryes'] = 'Tak';
	$lang['strno'] = 'Nie';
	$lang['strtrue'] = 'Prawda';
	$lang['strfalse'] = 'Fa&#322;sz';
	$lang['stredit'] = 'Edycja';
	$lang['strcolumns'] = 'Kolumny';
	$lang['strrows'] = 'wiersz(y)';
	$lang['strrowsaff'] = 'wiersz(y) dotyczy.';
	$lang['strobjects'] = 'obiekty';
	$lang['strexample'] = 'np.';
	$lang['strback'] = 'Wstecz';
	$lang['strqueryresults'] = 'Wyniki zapytania';
	$lang['strshow'] = 'Poka&#380;';
 	$lang['strempty'] = 'Wyczy&#347;&#263;';
	$lang['strlanguage'] = 'J&#281;zyk';
	$lang['strencoding'] = 'Kodowanie';
	$lang['strvalue'] = 'Warto&#347;&#263;';
	$lang['strunique'] = 'Unikatowy';
	$lang['strprimary'] = 'G&#322;&oacute;wny';
	$lang['strexport'] = 'Eksport';
	$lang['strimport'] = 'Import';
	$lang['strsql'] = 'SQL';
	$lang['strgo'] = 'Wykonaj';
	$lang['stradmin'] = 'Administruj';
	$lang['strvacuum'] = 'Przeczy&#347;&#263;';
	$lang['stranalyze'] = 'Analizuj';
	$lang['strcluster'] = 'Klaster';
	$lang['strclustered'] = 'Klastrowany?';
	$lang['strreindex'] = 'Przeindeksuj';
	$lang['strrun'] = 'Uruchom';
	$lang['stradd'] = 'Dodaj';
        $lang['strevent'] = 'Zdarzenie';
	$lang['strwhere'] = 'Gdzie';
	$lang['strinstead'] = 'Wykonaj zamiast';
	$lang['strwhen'] = 'Kiedy';
	$lang['strformat'] = 'Format';
	$lang['strdata'] = 'Dane';
	$lang['strconfirm'] = 'Potwierd&#378;';
	$lang['strexpression'] = 'Wyra&#380;enie';
	$lang['strellipsis'] = '...';
	$lang['strexpand'] = 'Rozwi&#324;';
	$lang['strcollapse'] = 'Zwi&#324;';
	$lang['strexplain'] = 'Explain';
	$lang['strfind'] = 'Znajd&#378;';
	$lang['stroptions'] = 'Opcje';
	$lang['strrefresh'] = 'Od&#347;wie&#380;';
	$lang['strdownload'] = 'Pobierz';
	$lang['strinfo'] = 'Informacje';
	$lang['stroids'] = 'OIDy';
	$lang['stradvanced'] = 'Zaawansowane';

	// Error handling
	$lang['strnoframes'] = 'Aby u&#380;ywa&#263; tej aplikacji potrzebujesz przegl&#261;darki obs&#322;uguj&#261;cej ramki.';
	$lang['strbadconfig'] = 'Tw&oacute;j plik config.inc.php jest przestarza&#322;y. Musisz go utworzy&#263; ponownie wykorzystuj&#261;c nowy config.inc.php-dist.';
	$lang['strnotloaded'] = 'Nie wkompilowa&#322;e&#347; do PHP obs&#322;ugi tej bazy danych.';
	$lang['strbadschema'] = 'Podano b&#322;&#281;dny schemat.';
	$lang['strbadencoding'] = 'B&#322;&#281;dne kodowanie bazy.';
	$lang['strsqlerror'] = 'B&#322;&#261;d SQL:';
	$lang['strinstatement'] = 'W poleceniu:';
	$lang['strinvalidparam'] = 'B&#322;&#281;dny parametr.';
	$lang['strnodata'] = 'Nie znaleziono danych.';
	$lang['strnoobjects'] = 'Nie znaleziono obiekt&oacute;w.';

	$lang['strrownotunique'] = 'Brak unikatowego identyfikatora dla tego wiersza.';

	// Tables
	$lang['strtable'] = 'Tabela';
	$lang['strtables'] = 'Tabele';
	$lang['strshowalltables'] = 'Poka&#380; wszystkie tabele';
	$lang['strnotable'] = 'Nie znaleziono tabeli.';
	$lang['strnotables'] = 'Nie znaleziono tabeli.';
	$lang['strcreatetable'] = 'Utw&oacute;rz tabel&#281;';
	$lang['strtablename'] = 'Nazwa tabeli';
	$lang['strtableneedsname'] = 'Musisz nazwa&#263; tabel&#281;.';
	$lang['strtableneedsfield'] = 'Musisz poda&#263; przynajmniej jedno pole.';
	$lang['strtableneedscols'] = 'Musisz poda&#263; prawid&#322;ow&#261; liczb&#281; kolumn.';
	$lang['strtablecreated'] = 'Utworzono tabel&#281;.';
	$lang['strtablecreatedbad'] = 'Pr&oacute;ba utworzenia tabeli si&#281; nie powiod&#322;a.';
	$lang['strconfdroptable'] = 'Czy na pewno chcesz usun&#261;&#263; tabel&#281; &quot;%s&quot;?';
	$lang['strtabledropped'] = 'Tabela usuni&#281;ta.';
	$lang['strtabledroppedbad'] = 'Pr&oacute;ba usuni&#281;cia tabeli si&#281; nie powiod&#322;a.';
	$lang['strconfemptytable'] = 'Czy na pewno chcesz wyczy&#347;ci&#263; tabel&#281; &quot;%s&quot;?';
	$lang['strtableemptied'] = 'Tabela wyczyszczona.';
	$lang['strtableemptiedbad'] = 'Pr&oacute;ba wyczyszczenia tabeli si&#281; nie powiod&#322;a.';
	$lang['strinsertrow'] = 'Wstaw wiersz';
	$lang['strrowinserted'] = 'Wiersz wstawiony.';
	$lang['strrowinsertedbad'] = 'Pr&oacute;ba wstawienia wiersza si&#281; nie powiod&#322;a.';
	$lang['streditrow'] = 'Edycja wiersza';
	$lang['strrowupdated'] = 'Wiersz zaktualizowany.';
	$lang['strrowupdatedbad'] = 'Pr&oacute;ba aktualizacji wiersza si&#281; nie powiod&#322;a.';
	$lang['strdeleterow'] = 'Usu&#324; wiersz';
	$lang['strconfdeleterow'] = 'Czy na pewno chcesz usun&#261;&#263; ten wiersz?';
	$lang['strrowdeleted'] = 'Wiersz usuni&#281;ty.';
	$lang['strrowdeletedbad'] = 'Pr&oacute;ba usuni&#281;cia wiersza si&#281; nie powiod&#322;a.';
	$lang['strsaveandrepeat'] = 'Zapisz i powt&oacute;rz';
	$lang['strfield'] = 'Pole';
	$lang['strfields'] = 'Pola';
	$lang['strnumfields'] = 'Ilo&#347;&#263; p&oacute;l';
	$lang['strfieldneedsname'] = 'Musisz nazwa&#263; pole';
	$lang['strselectallfields'] = 'Wybierz wszystkie pola';
        $lang['strselectneedscol'] = 'Musisz wybra&#263; przynajmniej jedn&#261; kolumn&#281;';
	$lang['strselectunary'] = 'Operatory bezargumentowe (IS NULL/IS NOT NULL) nie mog&#261; mie&#263; podanej warto&#347;ci';
	$lang['straltercolumn'] = 'Zmie&#324; kolumn&#281;';
	$lang['strcolumnaltered'] = 'Kolumna zmodyfikowana.';
	$lang['strcolumnalteredbad'] = 'Pr&oacute;ba modyfikacji kolumny si&#281; nie powiod&#322;a.';
	$lang['strconfdropcolumn'] = 'Czy na pewno chcesz usun&#261;&#263; kolumn&#281; &quot;%s&quot; z tabeli &quot;%s&quot;?';
	$lang['strcolumndropped'] = 'Kolumna usuni&#281;ta.';
	$lang['strcolumndroppedbad'] = 'Pr&oacute;ba usuni&#281;cia kolumny si&#281; nie powiod&#322;a.';
        $lang['straddcolumn'] = 'Dodaj kolumn&#281;';
	$lang['strcolumnadded'] = 'Kolumna dodana.';
	$lang['strcolumnaddedbad'] = 'Pr&oacute;ba dodania kolumny si&#281; nie powiod&#322;a.';
	$lang['strdataonly'] = 'Tylko dane';
	$lang['strcascade'] = 'CASCADE';
	$lang['strtablealtered'] = 'Tabela zmodyfikowana.';
	$lang['strtablealteredbad'] = 'Pr&oacute;ba modyfikacji tabeli si&#281; nie powiod&#322;a.';
	$lang['strdataonly'] = 'Tylko dane';
	$lang['strstructureonly'] = 'Tylko struktura';
	$lang['strstructureanddata'] = 'Struktura i dane';
			
	// Users
	$lang['struser'] = 'U&#380;ytkownik';
	$lang['strusers'] = 'U&#380;ytkownicy';
	$lang['strusername'] = 'Nazwa u&#380;ytkownika';
	$lang['strpassword'] = 'Has&#322;o';
	$lang['strsuper'] = 'Administrator?';
	$lang['strcreatedb'] = 'Tworzenie BD?';
	$lang['strexpires'] = 'Wygasa';	
	$lang['strnousers'] = 'Nie znaleziono u&#380;ytkownik&oacute;w.';
	$lang['struserupdated'] = 'Parametry u&#380;ytkownika zaktualizowane.';
	$lang['struserupdatedbad'] = 'Pr&oacute;ba aktualizacji parametr&oacute;w u&#380;ytkownika si&#281; nie powiod&#322;a.';
        $lang['strshowallusers'] = 'Poka&#380; wszystkich u&#380;ytkownik&oacute;w';
	$lang['strcreateuser'] = 'Utw&oacute;rz u&#380;ytkownika';
	$lang['struserneedsname'] = 'Musisz poda&#263; nazw&#281; u&#380;ytkownika.';
	$lang['strusercreated'] = 'U&#380;ytkownik utworzony.';
	$lang['strusercreatedbad'] = 'Pr&oacute;ba utworzenia u&#380;ytkownika si&#281; nie powiod&#322;a.';
	$lang['strconfdropuser'] = 'Czy na pewno chcesz usun&#261;&#263; u&#380;ytkownika &quot;%s&quot;?';
	$lang['struserdropped'] = 'U&#380;ytkownik usuni&#281;ty.';
	$lang['struserdroppedbad'] = 'Pr&oacute;ba usuni&#281;cia u&#380;ytkownika si&#281; nie powiod&#322;a.';
	$lang['straccount'] = 'Konto';
	$lang['strchangepassword'] = 'Zmie&#324; has&#322;o';
	$lang['strpasswordchanged'] = 'Has&#322;o zmienione.';
	$lang['strpasswordchangedbad'] = 'Pr&oacute;ba zmiany has&#322;a si&#281; nie powiod&#322;a.';
	$lang['strpasswordshort'] = 'Has&#322;o jest za kr&oacute;tkie.';
	$lang['strpasswordconfirm'] = 'Has&#322;o i potwierdzenie musz&#261; by&#263; takie same.';
							
	// Groups
	$lang['strgroup'] = 'Grupa';
	$lang['strgroups'] = 'Grupy';
	$lang['strnogroup'] = 'Nie znaleziono grupy.';
	$lang['strnogroups'] = 'Nie znaleziono grup.';
	$lang['strcreategroup'] = 'Utw&oacute;rz grup&#281;';
	$lang['strshowallgroups'] = 'Poka&#380; wszystkie grupy';
	$lang['strgroupneedsname'] = 'Musisz nazwa&#263; grup&#281;.';
	$lang['strgroupcreated'] = 'Grupa utworzona.';
	$lang['strgroupcreatedbad'] = 'Pr&oacute;ba utworzenia grupy si&#281; nie powiod&#322;a.';
	$lang['strconfdropgroup'] = 'Czy na pewno chcesz utworzy&#263; grup&#281; &quot;%s&quot;?';
	$lang['strgroupdropped'] = 'Grupa usuni&#281;ta.';
	$lang['strgroupdroppedbad'] = 'Pr&oacute;ba usuni&#281;cia grupy si&#281; nie powiod&#322;a.';
	$lang['strmembers'] = 'Cz&#322;onkowie';
	$lang['straddmember'] = 'Dodaj cz&#322;onka grupy';
	$lang['strmemberadded'] = 'Cz&#322;onek grupy dodany.';
	$lang['strmemberaddedbad'] = 'Pr&oacute;ba dodania cz&#322;onka grupy si&#281; nie powiod&#322;a.';
	$lang['strdropmember'] = 'Usu&#324; cz&#322;onka grupy';
	$lang['strconfdropmember'] = 'Czy na pewno chcesz usun&#261;&#263; &quot;%s&quot; z grupy &quot;%s&quot;?';
	$lang['strmemberdroppedbad'] = 'Pr&oacute;ba usuni&#281;cia cz&#322;onka grupy si&#281; nie powiod&#322;a.';
	$lang['strmemberdropped'] = 'Cz&#322;onek grupy usuni&#281;ty.';

	// Privileges
	$lang['strprivilege'] = 'Uprawnienie';
	$lang['strprivileges'] = 'Uprawnienia';
	$lang['strnoprivileges'] = 'Ten obiekt nie ma uprawnie&#324;.';
	$lang['strgrant'] = 'Nadaj';
	$lang['strrevoke'] = 'Zabierz';
	$lang['strgranted'] = 'Uprawnienia nadane.';
	$lang['strgrantfailed'] = 'Pr&oacute;ba nadania uprawnie&#324; si&#281; nie powiod&#322;a.';
	$lang['strgrantbad'] = 'Musisz poda&#263; u&#380;ytkownika lub grup&#281;, a tak&#380;e uprawnienia, jakie chcesz nada&#263;.';
	$lang['stralterprivs'] = 'Zmie&#324; uprawnienia';
	$lang['strgrantor'] = 'Grantor';
	$lang['strasterisk'] = '*';
				
	// Databases
	$lang['strdatabase'] = 'Baza danych';
	$lang['strdatabases'] = 'Bazy danych';
	$lang['strshowalldatabases'] = 'Poka&#380; wszystkie bazy danych';
	$lang['strnodatabase'] = 'Nie znaleziono bazy danych.';
	$lang['strnodatabases'] = 'Nie znaleziono &#380;adnej bazy danych.';
	$lang['strcreatedatabase'] = 'Utw&oacute;rz baz&#281; danych';
	$lang['strdatabasename'] = 'Nazwa bazy danych';
	$lang['strdatabaseneedsname'] = 'Musisz nazwa&#263; baz&#281; danych.';
	$lang['strdatabasecreated'] = 'Baza danych utworzona.';
	$lang['strdatabasecreatedbad'] = 'Pr&oacute;ba utworzenia bazy danych si&#281; nie powiod&#322;a.';
	$lang['strconfdropdatabase'] = 'Czy na pewno chcesz usun&#261;&#263; baz&#281; danych &quot;%s&quot;?';
	$lang['strdatabasedropped'] = 'Baza danych usuni&#281;ta.';
	$lang['strdatabasedroppedbad'] = 'Pr&oacute;ba usuni&#281;cia bazy danych si&#281; nie powiod&#322;a.';
	$lang['strentersql'] = 'Podaj polecenie SQL do wykonania:';
	$lang['strsqlexecuted'] = 'Wykonano polecenie SQL.';
	$lang['strvacuumgood'] = 'Czyszczenie bazy zako&#324;czone.';
	$lang['strvacuumbad'] = 'Pr&oacute;ba czyszczenia bazy si&#281; nie powiod&#322;a.';
	$lang['stranalyzegood'] = 'Analiza bazy zako&#324;czona.';
	$lang['stranalyzebad'] = 'Pr&oacute;ba analizy si&#281; nie powiod&#322;a.';

	// Views
	$lang['strview'] = 'Widok';
	$lang['strviews'] = 'Widoki';
	$lang['strshowallviews'] = 'Poka&#380; wszystkie widoki';
	$lang['strnoview'] = 'Nie znaleziono widoku.';
	$lang['strnoviews'] = 'Nie znaleziono widok&oacute;w.';
	$lang['strcreateview'] = 'Utw&oacute;rz widok';
	$lang['strviewname'] = 'Nazwa widoku';
	$lang['strviewneedsname'] = 'Musisz nazwa&#263; widok.';
	$lang['strviewneedsdef'] = 'Musisz zdefiniowa&#263; widok.';
	$lang['strviewcreated'] = 'Widok utworzony.';
	$lang['strviewcreatedbad'] = 'Pr&oacute;ba utworzenia widoku si&#281; nie powiod&#322;a.';
	$lang['strconfdropview'] = 'Czy na pewno chcesz usun&#261;&#263; widok &quot;%s&quot;?';
	$lang['strviewdropped'] = 'Widok usuni&#281;ty.';
	$lang['strviewdroppedbad'] = 'Pr&oacute;ba usuni&#281;cia widoku si&#281; nie powiod&#322;a.';
	$lang['strviewupdated'] = 'Widok zaktualizowany.';
	$lang['strviewupdatedbad'] = 'Pr&oacute;ba aktualizacji widoku si&#281; nie powiod&#322;a.';

	// Sequences
	$lang['strsequence'] = 'Sekwencja';
	$lang['strsequences'] = 'Sekwencje';
	$lang['strshowallsequences'] = 'Poka&#380; wszystkie sekwencje';
	$lang['strnosequence'] = 'Nie znaleziono sekwencji.';
	$lang['strnosequences'] = 'Nie znaleziono sekwencji.';
	$lang['strcreatesequence'] = 'Utw&oacute;rz sekwencj&#281;';
	$lang['strlastvalue'] = 'Ostatnia warto&#347;&#263;';
	$lang['strincrementby'] = 'Zwi&#281;kszana o';	
	$lang['strstartvalue'] = 'Warto&#347;&#263; pocz&#261;tkowa';
	$lang['strmaxvalue'] = 'Warto&#347;&#263; maks.';
	$lang['strminvalue'] = 'Warto&#347;&#263; min.';
	$lang['strcachevalue'] = 'cache_value';
	$lang['strlogcount'] = 'log_cnt';
	$lang['striscycled'] = 'is_cycled';
	$lang['striscalled'] = 'is_called';
	$lang['strsequenceneedsname'] = 'Musisz nazwa&#263; sekwencj&#281;';
	$lang['strsequencecreated'] = 'Utworzono sekwencj&#281;';
	$lang['strsequencecreatedbad'] = 'Pr&oacute;ba utworzenia sekwencji si&#281; nie powiod&#322;a.';
	$lang['strconfdropsequence'] = 'Czy na pewno chcesz usun&#261;&#263; sekwencj&#281; &quot;%s&quot;?';
	$lang['strsequencedropped'] = 'Sekwencja usuni&#281;ta.';
	$lang['strsequencedroppedbad'] = 'Pr&oacute;ba usuni&#281;cia sekwencji si&#281; nie powiod&#322;a.';
	$lang['strsequencereset'] = 'Sekwencja zresetowana.';
	$lang['strsequenceresetbad'] = 'Pr&oacute;ba zresetowania sekwencji si&#281; nie powiod&#322;a.';
						
	// Indeksy
	$lang['strindexes'] = 'Indeksy';
	$lang['strindexname'] = 'Nazwa indeksu';
	$lang['strshowallindexes'] = 'Poka&#380; wszystkie indeksy';
	$lang['strnoindex'] = 'Nie znaleziono indeksu.';
	$lang['strnoindexes'] = 'Nie znaleziono indeks&oacute;w.';
	$lang['strcreateindex'] = 'Utw&oacute;rz indeks';
	$lang['strtabname'] = 'Tab Name';
	$lang['strcolumnname'] = 'Nazwa kolumny';
	$lang['strindexneedsname'] = 'Musisz nazwa&#263; indeks.';
	$lang['strindexneedscols'] = 'W sk&#322;ad indeksu musi wchodzi&#263; przynajmniej jedna kolumna.';
	$lang['strindexcreated'] = 'Indeks utworzony';
	$lang['strindexcreatedbad'] = 'Pr&oacute;ba utworzenia indeksu si&#281; nie powiod&#322;a.';
	$lang['strconfdropindex'] = 'Czy na pewno chcesz usun&#261;&#263; indeks &quot;%s&quot;?';
	$lang['strindexdropped'] = 'Indeks usuni&#281;ty.';
	$lang['strindexdroppedbad'] = 'Pr&oacute;ba usuni&#281;cia indeksu si&#281; nie powiod&#322;a.';
	$lang['strkeyname'] = 'Nazwa klucza';
	$lang['struniquekey'] = 'Klucz Unikatowy';
	$lang['strprimarykey'] = 'Klucz G&#322;&oacute;wny';
	$lang['strindextype'] = 'Typ indeksu';
	$lang['strtablecolumnlist'] = 'Kolumny w tabeli';
	$lang['strindexcolumnlist'] = 'Kolumny w indeksie';
	$lang['strconfcluster'] = 'Czy na pewno chcesz zklastrowa&#263; &quot;%s&quot;?';
	$lang['strclusteredgood'] = 'Klastrowanie zako&#324;czone.';
	$lang['strclusteredbad'] = 'Pr&oacute;ba klastrowania si&#281; nie powiod&#322;a.';
	
	// Regu&#322;y
	$lang['strrule'] = 'Regu&#322;a';
	$lang['strrules'] = 'Regu&#322;y';
	$lang['strshowallrules'] = 'Poka&#380; wszystkie regu&#322;y';
	$lang['strnorule'] = 'Nie znaleziono regu&#322;y.';
	$lang['strnorules'] = 'Nie znaleziono regu&#322;.';
	$lang['strcreaterule'] = 'Utw&oacute;rz regu&#322;&#281;';
	$lang['strrulename'] = 'Nazwa regu&#322;y';
	$lang['strruleneedsname'] = 'Musisz nazwa&#263; regu&#322;&#281;.';
	$lang['strrulecreated'] = 'Utworzono regu&#322;&#281;.';
	$lang['strrulecreatedbad'] = 'Pr&oacute;ba utworzenia regu&#322;y si&#281; nie powiod&#322;a.';
	$lang['strconfdroprule'] = 'Czy na pewno chcesz usun&#261;&#263; regu&#322;&#281; &quot;%s&quot; na &quot;%s&quot;?';
	$lang['strruledropped'] = 'Regu&#322;a usuni&#281;ta.';
	$lang['strruledroppedbad'] = 'Pr&oacute;ba usuni&#281;cia regu&#322;y si&#281; nie powiod&#322;a.';
	
	// Wi&#281;zy integralno&#347;ci
	$lang['strconstraints'] = 'Wi&#281;zy integralno&#347;ci';
	$lang['strshowallconstraints'] = 'Poka&#380; wszystkie wi&#281;zy integralno&#347;ci';
	$lang['strnoconstraints'] = 'Nie znaleziono wi&#281;z&oacute;w integralno&#347;ci.';
	$lang['strcreateconstraint'] = 'Utw&oacute;rz wi&#281;zy integralno&#347;ci';
	$lang['strconstraintcreated'] = 'Utworzono wi&#281;zy integralno&#347;ci.';
	$lang['strconstraintcreatedbad'] = 'Pr&oacute;ba utworzenia wi&#281;z&oacute;w integralno&#347;ci si&#281; nie powiod&#322;a.';
	$lang['strconfdropconstraint'] = 'Czy na pewno chcesz usun&#261;&#263; wi&#281;zy integralno&#347;ci &quot;%s&quot; na &quot;%s&quot;?';
	$lang['strconstraintdropped'] = 'Wi&#281;zy integralno&#347;ci usuni&#281;te.';
	$lang['strconstraintdroppedbad'] = 'Pr&oacute;ba usuni&#281;cia wi&#281;z&oacute;w integralno&#347;ci si&#281; nie powiod&#322;a.';
	$lang['straddcheck'] = 'Dodaj warunek';
        $lang['strcheckneedsdefinition'] = 'Musisz zdefiniowa&#263; warunek.';
	$lang['strcheckadded'] = 'Dodano warunek.';
	$lang['strcheckaddedbad'] = 'peracja dodania warunku si&#281; nie powiod&#322;a.';
	$lang['straddpk'] = 'Dodaj klucz g&#322;&oacute;wny';
	$lang['strpkneedscols'] = 'Klucz g&#322;&oacute;wny musi zawiera&#263; przynajmniej jedn&#261; kolumn&#281;.';
	$lang['strpkadded'] = 'Dodano klucz g&#322;&oacute;wny.';
	$lang['strpkaddedbad'] = 'Pr&oacute;ba dodania klucza g&#322;&oacute;wnego si&#281; nie powiod&#322;a.';
	$lang['stradduniq'] = 'Dodaj klucz unikatowy';
	$lang['struniqneedscols'] = 'Klucz unikatowy musi zawiera&#263; przynajmniej jedn&#261; kolumn&#281;.';
	$lang['struniqadded'] = 'Dodano klucz unikatowy.';
	$lang['struniqaddedbad'] = 'Pr&oacute;ba dodania klucza unikatowego si&#281; nie powiod&#322;a.';
        $lang['straddfk'] = 'Dodaj klucz obcy';
	$lang['strfkneedscols'] = 'Obcy klucz musi zawiera&#263; przynajmniej jedn&#261; kolumn&#281;.';
	$lang['strfkneedstarget'] = 'Klucz obcy wymaga podania nazwy tabeli docelowej.';
	$lang['strfkadded'] = 'Dodano klucz obcy.';
	$lang['strfkaddedbad'] = 'Pr&oacute;ba dodania klucza obcego si&#281; nie powiod&#322;a.';
	$lang['strfktarget'] = 'Tabela docelowa';
	$lang['strfkcolumnlist'] = 'Kolumna w kluczu';
	$lang['strondelete'] = 'ON DELETE';
	$lang['stronupdate'] = 'ON UPDATE';
					
	// Functions
	$lang['strfunction'] = 'Funkcja';
	$lang['strfunctions'] = 'Funkcje';
	$lang['strshowallfunctions'] = 'Poka&#380; wszystkie funkcje';
	$lang['strnofunction'] = 'Nie znaleziono funkcji.';
	$lang['strnofunctions'] = 'Nie znaleziono funkcji.';
	$lang['strcreatefunction'] = 'Utw&oacute;rz funkcj&#281;';
	$lang['strfunctionname'] = 'Nazwa funkcji';
	$lang['strreturns'] = 'Zwraca';
	$lang['strarguments'] = 'Parametry';
	$lang['strproglanguage'] = 'J&#281;zyk';
	$lang['strfunctionneedsname'] = 'Musisz nazwa&#263; funkcj&#281;.';
	$lang['strfunctionneedsdef'] = 'Musisz zdefiniowa&#263; funkcj&#281;.';
	$lang['strfunctioncreated'] = 'Utworzono funkcj&#281;.';
	$lang['strfunctioncreatedbad'] = 'Pr&oacute;ba utworzenia funkcji si&#281; nie powiod&#322;a';
        $lang['strconfdropfunction'] = 'Czy na pewno chcesz usun&#261;&#263; funkcj&#281; &quot;%s&quot;?';
	$lang['strfunctiondropped'] = 'Funkcja usuni&#281;ta.';
	$lang['strfunctiondroppedbad'] = 'Pr&oacute;ba usuni&#281;cia funkcji si&#281; nie powiod&#322;a.';
	$lang['strfunctionupdated'] = 'Funkcja zaktualizowana.';
	$lang['strfunctionupdatedbad'] = 'Pr&oacute;ba aktualizacji funkcji si&#281; nie powiod&#322;a.';

	// Triggers
	$lang['strtrigger'] = 'Procedura wyzwalana';
	$lang['strtriggers'] = 'Procedury wyzwalane';
	$lang['strshowalltriggers'] = 'Poka&#380; wszystkie procedury wyzwalane';
	$lang['strnotrigger'] = 'Nie znaleziono procedury wyzwalanej.';
	$lang['strnotriggers'] = 'Nie znaleziono procedur wyzwalanych.';
	$lang['strcreatetrigger'] = 'Utw&oacute;rz procedur&#281; wyzwalan&#261;';
	$lang['strtriggerneedsname'] = 'Musisz nazwa&#263; procedur&#281; wyzwalan&#261;';
	$lang['strtriggerneedsfunc'] = 'Musisz podac funkcje swojego tragarza.';
	$lang['strtriggercreated'] = 'Utworzono procedur&#281; wyzwalan&#261;.';
	$lang['strtriggercreatedbad'] = 'Pr&oacute;ba utworzenia procedury wyzwalanej si&#281; nie powiod&#322;a';
        $lang['strconfdroptrigger'] = 'Czy na pewno chcesz usun&#261;&#263; procedur&#281; &quot;%s&quot; wyzwalan&#261; przez &quot;%s&quot;?';
	$lang['strtriggerdropped'] = 'Procedura wyzwalana usuni&#281;ta.';
	$lang['strtriggerdroppedbad'] = 'Pr&oacute;ba usuni&#281;cia procedury wyzwalanej si&#281; nie powiod&#322;a.';
	$lang['strtriggeraltered'] = 'Procedura wyzwalana zmieniona.';
	$lang['strtriggeralteredbad'] = 'Pr&oacute;ba modyfikacji procedury wyzwalanej si&#281; nie powiod&#322;a.';
		
	// Types
	$lang['strtype'] = 'Typ';
	$lang['strtypes'] = 'Typy';
	$lang['strshowalltypes'] = 'Poka&#380; wszystkie typy';
	$lang['strnotype'] = 'Nie znaleziono typu.';
	$lang['strnotypes'] = 'Nie znaleziono typ&oacute;w.';
	$lang['strcreatetype'] = 'Utw&oacute;rz typ';
	$lang['strtypename'] = 'Nazwa typu';
	$lang['strinputfn'] = 'Funkcja wej&#347;ciowa';
	$lang['stroutputfn'] = 'Funkcja wyj&#347;ciowa';
	$lang['strpassbyval'] = 'Przekazywany przez warto&#347;&#263;?';
	$lang['stralignment'] = 'Wyr&oacute;wnanie bajtowe';
	$lang['strelement'] = 'Typ element&oacute;w';
	$lang['strdelimiter'] = 'Znak oddzielaj&#261;cy elementy tabeli';
	$lang['strstorage'] = 'Technika przechowywania';
	$lang['strtypeneedsname'] = 'Musisz nazwa&#263; typ.';
	$lang['strtypeneedslen'] = 'Musisz poda&#263; d&#322;ugo&#347;&#263; typu.';
	$lang['strtypecreated'] = 'Typ utworzony';
	$lang['strtypecreatedbad'] = 'Pr&oacute;ba utworzenia typu si&#281; nie powiod&#322;a.';
	$lang['strconfdroptype'] = 'Czy na pewno chcesz usun&#261;&#263; typ &quot;%s&quot;?';
	$lang['strtypedropped'] = 'Typ usuni&#281;ty.';
	$lang['strtypedroppedbad'] = 'Pr&oacute;ba usuni&#281;cia typu si&#281; nie powiod&#322;a.';

	// Schemas
	$lang['strschema'] = 'Schemat';
	$lang['strschemas'] = 'Schematy';
	$lang['strshowallschemas'] = 'Poka&#380; wszystkie schematy';
	$lang['strnoschema'] = 'Nie znaleziono schematu.';
	$lang['strnoschemas'] = 'Nie znaleziono schemat&oacute;w.';
	$lang['strcreateschema'] = 'Utw&oacute;rz schemat';
	$lang['strschemaname'] = 'Nazwa schematu';
	$lang['strschemaneedsname'] = 'Musisz nada&#263; schematowi nazw&#281;.';
	$lang['strschemacreated'] = 'Schemat zosta&#322; utworzony';
	$lang['strschemacreatedbad'] = 'Pr&oacute;ba utworzenia schematu si&#281; nie powiod&#322;a.';
	$lang['strconfdropschema'] = 'Czy na pewno chcesz usun&#261;&#263; schemat &quot;%s&quot;?';
	$lang['strschemadropped'] = 'Schemat usuni&#281;ty.';
	$lang['strschemadroppedbad'] = 'Pr&oacute;ba usuni&#281;cia schematu si&#281; nie powiod&#322;a.';

	// Reports
	$lang['strreport'] = 'Raport';
	$lang['strreports'] = 'Raporty';
	$lang['strshowallreports'] = 'Poka&#380; wszystkie raporty';
	$lang['strnoreports'] = 'Nie znaleziono raport&oacute;w.';
	$lang['strcreatereport'] = 'Utw&oacute;rz raport';
	$lang['strreportdropped'] = 'Raport usuni&#281;ty.';
	$lang['strreportdroppedbad'] = 'Pr&oacute;ba usuni&#281;cia raportu si&#281; nie powiod&#322;a.';
	$lang['strconfdropreport'] = 'Czy na pewno chcesz usun&#261;&#263; raport &quot;%s&quot;?';
        $lang['strreportneedsname'] = 'Musisz nazwa&#263; raport.';
	$lang['strreportneedsdef'] = 'Musisz poda&#263; zapytanie SQL definiuj&#261;ce raport.';
	$lang['strreportcreated'] = 'Raport utworzony.';
	$lang['strreportcreatedbad'] = 'Pr&oacute;ba utworzenia raportu si&#281; nie powiod&#322;a.';

	// Domeny
	$lang['strdomain'] = 'Domena';
	$lang['strdomains'] = 'Domeny';
	$lang['strshowalldomains'] = 'Pokar&#380; wszystkie domeny';
	$lang['strnodomains'] = 'Nie znaleziono domen.';
	$lang['strcreatedomain'] = 'Utw&oacute;rz domen&#281;';
	$lang['strdomaindropped'] = 'Domena usuni&#281;ta.';
	$lang['strdomaindroppedbad'] = 'Pr&oacute;ba usuni&#281;cia domeny si&#281; nie powiod&#322;a.';
	$lang['strconfdropdomain'] = 'Czy na pewno chcesz usun&#261;&#263; domen&#281; &quot;%s&quot;?';
	$lang['strdomainneedsname'] = 'Musisz nazwa&#263; domen&#281;.';
	$lang['strdomaincreated'] = 'Domena utworzona.';
	$lang['strdomaincreatedbad'] = 'Pr&oacute;ba utworzenia domeny si&#281; nie powiod&#322;a.';
	$lang['strdomainaltered'] = 'Domena zmieniona.';
	$lang['strdomainalteredbad'] = 'Pr&oacute;ba modyfikacji domeny si&#281; nie powiod&#322;a.';

	// Operators
	$lang['stroperator'] = 'Operator';
	$lang['stroperators'] = 'Operatory';
	$lang['strshowalloperators'] = 'Poka&#380; wszystkie operatory';
	$lang['strnooperator'] = 'Nie znaleziono operatora.';
	$lang['strnooperators'] = 'Nie znaleziono operator&oacute;w.';
	$lang['strcreateoperator'] = 'Utw&oacute;rz operator';
	$lang['strleftarg'] = 'Typ lewego argumentu';
	$lang['strrightarg'] = 'Typ prawego argumentu';
    $lang['strcommutator'] = 'Commutator';
	$lang['strnegator'] = 'Negacja';
	$lang['strrestrict'] = 'Zastrze&#380;enie';
	$lang['strjoin'] = 'Po&#322;&#261;czenie';
    $lang['strhashes'] = 'Hashes';
    $lang['strmerges'] = 'Merges';
	$lang['strleftsort'] = 'Lewe sortowanie';
	$lang['strrightsort'] = 'Prawe sortowanie';
	$lang['strlessthan'] = 'Mniej ni&#380;';
	$lang['strgreaterthan'] = 'Wi&#281;cej ni&#380;';
	$lang['stroperatorneedsname'] = 'Musisz nazwa&#263; operator.';
	$lang['stroperatorcreated'] = 'Operator utworzony.';
	$lang['stroperatorcreatedbad'] = 'Pr&oacute;ba utworzenia operatora si&#281; nie powiod&#322;a.';
	$lang['strconfdropoperator'] = 'Czy na pewno chcesz usun&#261;&#263; operator &quot;%s&quot;?';
	$lang['stroperatordropped'] = 'Operator usuni&#281;ty.';
	$lang['stroperatordroppedbad'] = 'Pr&oacute;ba usuni&#281;cia operatora si&#281; nie powiod&#322;a.';

	// Casts
	$lang['strcasts'] = 'Rzutowania';
	$lang['strnocasts'] = 'Nie znaleziono rzutowa&#324;.';
	$lang['strsourcetype'] = 'Typ &#378;r&oacute;d&#322;owy';
	$lang['strtargettype'] = 'Typ docelowy';
	$lang['strimplicit'] = 'Niezaprzeczalny';
	$lang['strinassignment'] = 'W przydziale';
	$lang['strbinarycompat'] = '(Kompatybilny binarnie)';

	// Conversions
	$lang['strconversions'] = 'Konwersje';
	$lang['strnoconversions'] = 'Nie znaleziono konwersji.';
	$lang['strsourceencoding'] = 'Kodowanie &#378;r&oacute;d&#322;owe';
	$lang['strtargetencoding'] = 'Kodowanie docelowe';

	// Languages
	$lang['strlanguages'] = 'J&#281;zyki';
	$lang['strnolanguages'] = 'Nie znaleziono j&#281;zyk&oacute;w.';
	$lang['strtrusted'] = 'Zaufany';

	// Info
	$lang['strnoinfo'] = 'Brak informacji na ten temat';
	$lang['strreferringtables'] = 'Tabele zale&#380;ne';
	$lang['strparenttables'] = 'Tabela nadrz&#281;dne';
	$lang['strchildtables'] = 'Tabela podrz&#281;dna';
	
	// Miscellaneous
	$lang['strtopbar'] = '%s uruchomiony na %s:%s -- Jeste&#347; zalogowany jako &quot;%s&quot;, %s';
	$lang['strtimefmt'] = 'jS M, Y g:iA';
	$lang['strhelp'] = 'Pomoc';

?>
