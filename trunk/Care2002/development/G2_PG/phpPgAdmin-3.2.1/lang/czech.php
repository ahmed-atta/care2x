<?php

	/**
	 * Ceska lokalizace phpPgAdmin-u.
	 * Zalozeno na slovenske lokalizaci. Thx.
	 *                                      libor(at)conet.cz
	 */

	// Language and character set
	$lang['applang'] = '�esky';
	$lang['appcharset'] = 'windows-1250';
	$lang['applocale'] = 'cs_CZ';

	// Basic strings
	$lang['strintro'] = 'V�tejte v phpPgAdminu.';
	$lang['strlogin'] = 'P�ihl�en�';
	$lang['strloginfailed'] = 'P�ihl�en� selhalo';
	$lang['strserver'] = 'Server';
	$lang['strlogout'] = 'Odhl�sit';
	$lang['strowner'] = 'Vlastn�k';
	$lang['straction'] = 'Akce';
	$lang['stractions'] = 'Akce';
	$lang['strname'] = 'Jm�no';
	$lang['strdefinition'] = 'Definice';
	$lang['stroperators'] = 'Oper�tory';
	$lang['straggregates'] = 'Agreg�ty';
	$lang['strproperties'] = 'Vlastnosti';
	$lang['strbrowse'] = 'P�ehled';
	$lang['strdrop'] = 'Smazat';
	$lang['strdropped'] = 'Smazan�';
	$lang['strnull'] = 'Nulov�';
	$lang['strnotnull'] = 'Nenulov�';
	$lang['strprev'] = 'P�edchoz�';
	$lang['strnext'] = 'Dal��';
	$lang['strfailed'] = 'Selhalo';
	$lang['strcreate'] = 'Vytvo�it';
	$lang['strcreated'] = 'Vytvo�en�';
	$lang['strcomment'] = 'Koment��';
	$lang['strlength'] = 'D�lka';
	$lang['strdefault'] = 'P�edvolen�';
	$lang['stralter'] = 'Zm�nit';
	$lang['strok'] = 'OK';
	$lang['strcancel'] = 'Storno';
	$lang['strsave'] = 'Ulo�it';
	$lang['strreset'] = 'Reset';
	$lang['strinsert'] = 'Vlo�it';
	$lang['strselect'] = 'Vybrat';
	$lang['strdelete'] = 'Smazat';
	$lang['strupdate'] = 'Aktualizovat';
	$lang['strreferences'] = 'Reference';
	$lang['stryes'] = 'Yo';
	$lang['strno'] = 'Ne';
	$lang['stredit'] = 'Upravit';
	$lang['strcolumns'] = 'Sloupce';
	$lang['strrows'] = '��dky';
	$lang['strexample'] = 'nap�.';
	$lang['strback'] = 'Zp�t';
	$lang['strqueryresults'] = 'V�sledky dotazu';
	$lang['strshow'] = 'Uk�zat';
	$lang['strempty'] = 'Vypr�zdnit';
	$lang['strlanguage'] = 'Jazyk';
	$lang['strencoding'] = 'K�dovan�';
	$lang['strvalue'] = 'Hodnota';
	$lang['strunique'] = 'Unik�tn�';
	$lang['strprimary'] = 'Prim�rn�';
	$lang['strexport'] = 'Exportovat';
	$lang['strsql'] = 'SQL';
	$lang['strgo'] = 'Vykonej';
	$lang['stradmin'] = 'Admin';
	$lang['strvacuum'] = 'Vacuum';
	$lang['stranalyze'] = 'Analyzovt�';
	$lang['strcluster'] = 'Cluster';
	$lang['strreindex'] = 'Reindex';
	$lang['strrun'] = 'Spustit';
	$lang['stradd'] = 'P�idat';
	$lang['strevent'] = 'Ud�lost';
	$lang['strwhere'] = 'Kde';
	$lang['strinstead'] = 'Ud�lat nam�sto';
	$lang['strwhen'] = 'Kdy�';
	$lang['strformat'] = 'Form�t';

	// Error handling
	$lang['strnoframes'] = 'Tato aplikace vy�aduje prohl�ec s podporou fram�.';
	$lang['strbadconfig'] = 'Your config.inc.php is out of date. You will need to regenerate it from the new config.inc.php-dist.';
	$lang['strnotloaded'] = 'PHP nen� zakompilov�no s podporou PostgreSQL';
	$lang['strbadschema'] = 'Nastaveno �patn� sch�ma.';
	$lang['strbadencoding'] = 'Nastaven� k�dovan� v datab�ze selhalo.';
	$lang['strsqlerror'] = 'SQL chyba:';
	$lang['strinstatement'] = 'Ve v�razu:';
	$lang['strinvalidparam'] = 'Chybn� parametry skriptu.';
	$lang['strnodata'] = 'Nenalezeny ��dn� z�znamy.';

	// Tables
	$lang['strtable'] = 'Tabulka';
	$lang['strtables'] = 'Tabulky';
	$lang['strshowalltables'] = 'Zobrazit v�echny tabulky';
	$lang['strnotables'] = 'Nenalezeny ��dn� tabulky.';
	$lang['strnotable'] = 'Nenalezena ��dn� tabulka.';
	$lang['strcreatetable'] = 'Vytvo�it tabulku';
	$lang['strtablename'] = 'N�zev tabulky';
	$lang['strtableneedsname'] = 'Mus� zadat n�zov tabulky.';
	$lang['strtableneedsfield'] = 'Mus� zadat aspo� jedno pole.';
	$lang['strtableneedscols'] = 'Tables require a valid number of columns.';
	$lang['strtablecreated'] = 'Tabulka vytvo�en�.';
	$lang['strtablecreatedbad'] = 'Tabulka nebola vytvo�en�.';
	$lang['strconfdroptable'] = 'Opravdu chce� odstranit tabulku "%s"?';
	$lang['strtabledropped'] = 'Tabulka odstran�n�.';
	$lang['strtabledroppedbad'] = 'Tabulka nebyla odstran�n�.';
	$lang['strconfemptytable'] = 'Opravdu chce� vypr�zdnit tabulku "%s"?';
	$lang['strtableemptied'] = 'Tabulka vypr�zdn�na.';
	$lang['strtableemptiedbad'] = 'Tabulka nebyla vypr�zdn�na.';
	$lang['strinsertrow'] = 'Vlo�it ��dek';
	$lang['strrowinserted'] = '��dek vlo�en.';
	$lang['strrowinsertedbad'] = '��dek nebyl vlo�en.';
	$lang['streditrow'] = 'Upravit ��dek';
	$lang['strrowupdated'] = '��dek upraven.';
	$lang['strrowupdatedbad'] = '��dek nebyl upraven.';
	$lang['strdeleterow'] = 'Smazat ��dek';
	$lang['strconfdeleterow'] = 'Opravdu chce� smazat tento ��dek?';
	$lang['strrowdeleted'] = '��dek smaz�n.';
	$lang['strrowdeletedbad'] = '��dek nebyl smaz�n.';
	$lang['strsaveandrepeat'] = 'Ulo�it & opakovat';
	$lang['strfield'] = 'Pole';
	$lang['strfields'] = 'Pole';
	$lang['strnumfields'] = 'Po�et pol�';
	$lang['strfieldneedsname'] = 'Mus� pomenovat pole';
	$lang['strselectneedscol'] = 'Mus� vybrat aspo� jeden stoupec';
	$lang['straltercolumn'] = 'Zm�nit sloupec';
	$lang['strcolumnaltered'] = 'Sloupec zm�n�n�.';
	$lang['strcolumnalteredbad'] = 'Sloupec nebyl zm�n�n�.';
	$lang['strconfdropcolumn'] = 'Opravdu chce� smazat sloupec "%s" z tabulky "%s"?';
	$lang['strcolumndropped'] = 'Sloupec smaz�n.';
	$lang['strcolumndroppedbad'] = 'Sloupec nebyl smaz�n.';
	$lang['straddcolumn'] = 'P�idat sloupec';
	$lang['strcolumnadded'] = 'Sloupec p�idan�.';
	$lang['strcolumnaddedbad'] = 'Sloupec nebyl p�idan�.';
	$lang['strschemaanddata'] = 'Sch�ma & D�ta';
	$lang['strschemaonly'] = 'Jen Sch�ma';
	$lang['strdataonly'] = 'Jen D�ta';

	// Users
	$lang['struseradmin'] = 'Spr�va u�ivatel�';
	$lang['struser'] = 'U�ivatel';
	$lang['strusers'] = 'U�ivatel�';
	$lang['strusername'] = 'Jm�no u�ivatele';
	$lang['strpassword'] = 'Heslo';
	$lang['strsuper'] = 'Superuser?';
	$lang['strcreatedb'] = 'Vytv��et DB?';
	$lang['strexpires'] = 'Expiruje';
	$lang['strnousers'] = 'Nenalezen ��dn� u�ivatel.';
	$lang['struserupdated'] = 'U�ivatel upraven.';
	$lang['struserupdatedbad'] = 'U�ivatel nebyl upraven.';
	$lang['strshowallusers'] = 'Zobrazit v�echny u�ivatele';
	$lang['strcreateuser'] = 'Vytvo�it u�ivatele';
	$lang['strusercreated'] = 'U��vatel vytvo�en�.';
	$lang['strusercreatedbad'] = 'U��vatel nebyl vytvo�en�.';
	$lang['strconfdropuser'] = 'Opravdu chce� smazat u�ivatele "%s"?';
	$lang['struserdropped'] = 'U�ivatel smaz�n.';
	$lang['struserdroppedbad'] = 'U�ivatel nebyl smaz�n.';
		
	// Groups
	$lang['strgroupadmin'] = 'Spr�va skupin';
	$lang['strgroup'] = 'Skupina';
	$lang['strgroups'] = 'Skupiny';
	$lang['strnogroup'] = 'Skupina nenalezena.';
	$lang['strnogroups'] = 'Nebyly nalezeny ��dn� skupiny.';
	$lang['strcreategroup'] = 'Vytvo�it skupinu';
	$lang['strshowallgroups'] = 'Zobrazit v�echny skupiny';
	$lang['strgroupneedsname'] = 'Mus� zadat jm�no skupiny.';
	$lang['strgroupcreated'] = 'Skupina vytvo�en�.';
	$lang['strgroupcreatedbad'] = 'Skupina nebyla vytvo�en�.';
	$lang['strconfdropgroup'] = 'Opravdu chce� smazat skupinu "%s"?';
	$lang['strgroupdropped'] = 'Skupina smaz�na.';
	$lang['strgroupdroppedbad'] = 'Skupina nebyla smaz�na.';
	$lang['strmembers'] = '�lenov�';

	// Privileges
	$lang['strprivilege'] = 'Pr�vo';
	$lang['strprivileges'] = 'Pr�va';
	$lang['strnoprivileges'] = 'Tento objekt nem� pr�va.';
	$lang['strgrant'] = 'Povolit';
	$lang['strrevoke'] = 'Odobrat';
	$lang['strgranted'] = 'Pr�vo p�idan�.';
	$lang['strgrantfailed'] = 'Pr�vo nebylo p�idan�.';
	$lang['strgrantuser'] = 'Povolit u�ivatele';
	$lang['strgrantgroup'] = 'Povolit skupinu';

	

	// Databases
	$lang['strdatabase'] = 'Datab�ze';
	$lang['strdatabases'] = 'Datab�ze';
	$lang['strshowalldatabases'] = 'Zobrazit v�echny datab�ze';
	$lang['strnodatabase'] = 'Nenalezena ��dn� datab�ze.';
	$lang['strnodatabases'] = 'Nenalezena ��dn� datab�ze.';
	$lang['strcreatedatabase'] = 'Vytvo�it datab�zi';
	$lang['strdatabasename'] = 'N�zev datab�ze';
	$lang['strdatabaseneedsname'] = 'Mus� zadat n�zev pro datab�zi.';
	$lang['strdatabasecreated'] = 'Datab�ze vytvo�ena.';
	$lang['strdatabasecreatedbad'] = 'Datab�ze nebyla vytvo�ena.';	
	$lang['strconfdropdatabase'] = 'Opravdu chce� smazat datab�zi "%s"?';
	$lang['strdatabasedropped'] = 'Datab�ze smaz�na.';
	$lang['strdatabasedroppedbad'] = 'Datab�za nebyla smaz�na.';
	$lang['strentersql'] = 'Vlo� SQL dotaz:';
	$lang['strvacuumgood'] = 'Vy�i�t�n� provedeno.';
	$lang['strvacuumbad'] = 'Vy�i�t�n� selhalo.';
	$lang['stranalyzegood'] = 'Anal�za provedena.';
	$lang['stranalyzebad'] = 'Anal�za selhala.';

	// Views
	$lang['strview'] = 'N�hled';
	$lang['strviews'] = 'N�hledy';
	$lang['strshowallviews'] = 'Zobrazit v�echny n�hledy';
	$lang['strnoview'] = 'Nenalezen ��dn� n�hled.';
	$lang['strnoviews'] = 'Nenalezeny ��dn� n�hledy.';
	$lang['strcreateview'] = 'Vytvo�it n�hled';
	$lang['strviewname'] = 'N�zev n�hledu';
	$lang['strviewneedsname'] = 'Mus� zadat n�zev n�hledu.';
	$lang['strviewneedsdef'] = 'Mus� zadat definici n�hledu.';
	$lang['strviewcreated'] = 'N�hled vytvo�en.';
	$lang['strviewcreatedbad'] = 'N�hled nebyl vytvo�en.';
	$lang['strconfdropview'] = 'Opravdu chce� smazat n�hled "%s"?';
	$lang['strviewdropped'] = 'N�hled smaz�n.';
	$lang['strviewdroppedbad'] = 'N�hled nebyl smaz�n.';
	$lang['strviewupdated'] = 'N�hled upraven.';
	$lang['strviewupdatedbad'] = 'N�hled nebyl upraven.';

	// Sequences
	$lang['strsequence'] = 'Sekvence';
	$lang['strsequences'] = 'Sekvence';
	$lang['strshowallsequences'] = 'Zobrazit v�echny sekvence';
	$lang['strnosequence'] = '��dn� sekvence nenalezena.';
	$lang['strnosequences'] = '��dn� sekvence nenalezeny.';
	$lang['strcreatesequence'] = 'Vytvorit sekvenci';
	$lang['strlastvalue'] = 'Posledn� hodnota';
	$lang['strincrementby'] = 'Inkrementovat od';	
	$lang['strstartvalue'] = 'Po��te�n� hodnota';
	$lang['strmaxvalue'] = 'Max hodnota';
	$lang['strminvalue'] = 'Min hodnota';
	$lang['strcachevalue'] = 'Cache hodnota';
	$lang['strlogcount'] = 'Log Count';
	$lang['striscycled'] = 'Je cyklick�?';
	$lang['striscalled'] = 'Je called?';
	$lang['strsequenceneedsname'] = 'Mus� zadat n�zev sekvence.';
	$lang['strsequencecreated'] = 'Sekvence vytvo�ena.';
	$lang['strsequencecreatedbad'] = 'Sekvence nebyla vytvo�ena.'; 
	$lang['strconfdropsequence'] = 'Opravdu chce� smazat sekvence "%s"?';
	$lang['strsequencedropped'] = 'Sekvence smaz�na.';
	$lang['strsequencedroppedbad'] = 'Sekvence nebyla smaz�na.';

	// Indexes
	$lang['strindexes'] = 'Indexy';
	$lang['strindexname'] = 'N�zev indexu';
	$lang['strshowallindexes'] = 'Zobrazit v�echny indexy';
	$lang['strnoindex'] = 'Nenalezen ��dn� index.';
	$lang['strnoindexes'] = 'Nenalezeny ��dn� index.';
	$lang['strcreateindex'] = 'Vytvo�it index';
	$lang['strindexname'] = 'N�zev indexu';
	$lang['strtabname'] = 'N�zev tabulky';
	$lang['strcolumnname'] = 'N�zov stoupce';
	$lang['strindexneedsname'] = 'Mus� zadat n�zev indexu';
	$lang['strindexneedscols'] = 'Index vy�aduje korektn� po�et sloupc�.';
	$lang['strindexcreated'] = 'Index vytvo�en';
	$lang['strindexcreatedbad'] = 'Index nebyl vytvo�en.';
	$lang['strconfdropindex'] = 'Opravdu chce� smazat index "%s"?';
	$lang['strindexdropped'] = 'Index smaz�n.';
	$lang['strindexdroppedbad'] = 'Index nebyl smaz�n.';
	$lang['strkeyname'] = 'N�zev kl��e';
	$lang['struniquekey'] = 'Unik�tn� kl��';
	$lang['strprimarykey'] = 'Prim�rn� kl��';
 	$lang['strindextype'] = 'Typ indexu';
	$lang['strindexname'] = 'N�zev indexu';
	$lang['strtablecolumnlist'] = 'Sloupce v tabulce';
	$lang['strindexcolumnlist'] = 'Sloupce v indexu';

	// Rules
	$lang['strrules'] = 'Pravidla';
	$lang['strrule'] = 'Pravidlo';
	$lang['strshowallrules'] = 'Zobrazit v�echna pravidla';
	$lang['strnorule'] = 'Nenalezeno ��dn� pravidlo.';
	$lang['strnorules'] = 'Nenalezeny ��dn� pravidla.';
	$lang['strcreaterule'] = 'Vytvo�it pravidlo';
	$lang['strrulename'] = 'N�zev pravidla';
	$lang['strruleneedsname'] = 'Mus� zadat n�zev pravidla.';
	$lang['strrulecreated'] = 'Pravidlo vytvo�eno.';
	$lang['strrulecreatedbad'] = 'Pravidlo nebylo vytvo�eno.';
	$lang['strconfdroprule'] = 'Chce� opravdu smazat pravidlo "%s" na "%s"?';
	$lang['strruledropped'] = 'Pravidlo smaz�no.';
	$lang['strruledroppedbad'] = 'Pravidlo nebylo smaz�no.';

	// Constraints
	$lang['strconstraints'] = 'Omezen�';
	$lang['strshowallconstraints'] = 'Zobrazit v�echna omezen�';
	$lang['strnoconstraints'] = 'Nenalezeny ��dn� omezen�.';
	$lang['strcreateconstraint'] = 'Vytvo�it omezen�';
	$lang['strconstraintcreated'] = 'Omezen� vytvo�eno.';
	$lang['strconstraintcreatedbad'] = 'Omezen� nebylo vytvo�eno.';
	$lang['strconfdropconstraint'] = 'Chce� opravdu smazat omezen� "%s" na "%s"?';
	$lang['strconstraintdropped'] = 'Omezen� smaz�no.';
	$lang['strconstraintdroppedbad'] = 'Omezen� nebylo smaz�no.';
	$lang['straddcheck'] = 'P�idat kontrolu';
	$lang['strcheckneedsdefinition'] = 'Je nutn� kontrolu omezen� definovat.';
	$lang['strcheckadded'] = 'Kontrola omezen� p�id�na.';
	$lang['strcheckaddedbad'] = 'Kontrola omezen� nebyla p�id�na.';
	$lang['straddpk'] = 'P�idat prim�rn� kl��';
	$lang['strpkneedscols'] = 'Prim�rn� kl�� vy�aduje alespo� jeden sloupec.';
	$lang['strpkadded'] = 'Prim�rn� kl�� p�id�n.';
	$lang['strpkaddedbad'] = 'Prim�rn� kl�� nebyl p�id�n.';
	$lang['stradduniq'] = 'P�idat unik�tn� kl��';
	$lang['struniqneedscols'] = 'Unik�tn� kl�� vy�aduje alespo� jeden sloupec.';
	$lang['struniqadded'] = 'Unik�tn� kl�� p�id�n.';
	$lang['struniqaddedbad'] = 'Unik�tn� kl�� nebyl p�id�n.';
	$lang['straddfk'] = 'P�idat ciz� kl��';
	$lang['strfkneedscols'] = 'Ciz� kl�� vy�aduje alespo� jeden sloupec.';
	$lang['strfkadded'] = 'Ciz� kl�� p�id�n.';
	$lang['strfkaddedbad'] = 'Ciz� kl�� nebyl p�id�n.';
	$lang['strfktarget'] = 'C�lov� tabulka';

	// Functions
	$lang['strfunction'] = 'Funkce';
	$lang['strfunctions'] = 'Funkce';
	$lang['strshowallfunctions'] = 'Zobrazit v�echny funkce';
	$lang['strnofunction'] = 'Nenalezena ��dn� funkce.';
	$lang['strnofunctions'] = 'Nenalezeny ��dn� funkce.';
	$lang['strcreatefunction'] = 'Vytvo�it funkci';
	$lang['strfunctionname'] = 'N�zev funkce';
	$lang['strreturns'] = 'Vrac�';
	$lang['strarguments'] = 'Argumenty';
	$lang['strproglanguage'] = 'Jazyk';
	$lang['strfunctionneedsname'] = 'Mus� zadat n�zev funkce.';
	$lang['strfunctionneedsdef'] = 'Mus� zadat definici funkce.';
	$lang['strfunctioncreated'] = 'Funkce vytvo�ena.';
	$lang['strfunctioncreatedbad'] = 'Funkce nebyla vytvo�ena.';
	$lang['strconfdropfunction'] = 'Opravdu chce� smazat funkci "%s"?';
	$lang['strfunctiondropped'] = 'Funkce smaz�na.';
	$lang['strfunctiondroppedbad'] = 'Funkce nebyla smaz�na.';
	$lang['strfunctionupdated'] = 'Funkce upravena.';
	$lang['strfunctionupdatedbad'] = 'Funkce nebyla upravena.';

	// Triggers
	$lang['strtrigger'] = 'Trigger';
	$lang['strtriggers'] = 'Triggers';
	$lang['strshowalltriggers'] = 'Zobrazit v�echny triggery';
	$lang['strnotrigger'] = 'Nenalezen ��dn� trigger.';
	$lang['strnotriggers'] = 'Nenalezeny ��dn� triggery.';
	$lang['strcreatetrigger'] = 'Vytvo�it trigger';
	$lang['strtriggerneedsname'] = 'Mus� zadat n�zev triggeru.';
	$lang['strtriggerneedsfunc'] = 'Mus� zadat funkci triggeru.';
	$lang['strtriggercreated'] = 'Trigger vytvo�en.';
	$lang['strtriggercreatedbad'] = 'Trigger nebyl vytvo�en.';
	$lang['strconfdroptrigger'] = 'Chce� opravdu smazat trigger "%s" na "%s"?';
	$lang['strtriggerdropped'] = 'Trigger smaz�n.';
	$lang['strtriggerdroppedbad'] = 'Trigger nebyl smaz�n.';

	// Types
	$lang['strtype'] = 'Typ';
	$lang['strtypes'] = 'Typy';
	$lang['strshowalltypes'] = 'Zobrazit v�echny typy';
	$lang['strnotype'] = 'Nenalezen� ��dn� typ.';
	$lang['strnotypes'] = 'Nenalezeny ��dn� typy.';
	$lang['strcreatetype'] = 'Vytvo�it typ';
	$lang['strtypename'] = 'N�zev typu';
	$lang['strinputfn'] = 'Vstupn� funkce';
	$lang['stroutputfn'] = 'V�stupn� funkce';
	$lang['strpassbyval'] = 'Vol�n hodnotou?';
	$lang['stralignment'] = 'Zarovn�n�';
	$lang['strelement'] = 'Element';
	$lang['strdelimiter'] = 'Odd�lova�';
	$lang['strstorage'] = 'Storage';
	$lang['strtypeneedsname'] = 'Mus� zadat n�zev typu.';
	$lang['strtypeneedslen'] = 'Mus� zadat d�lku typu.';
	$lang['strtypecreated'] = 'Typ vytvo�en.';
	$lang['strtypecreatedbad'] = 'Typ nebyl vytvo�en.';
	$lang['strconfdroptype'] = 'Chce� opravdu smazat typ "%s"?';
	$lang['strtypedropped'] = 'Typ smaz�n.';
	$lang['strtypedroppedbad'] = 'Typ nebyl smaz�n.';

	// Schemas
	$lang['strschema'] = 'Sch�ma';
	$lang['strschemas'] = 'Sch�mata';
	$lang['strshowallschemas'] = 'Zobrazit v�echny sch�mata';
	$lang['strnoschema'] = 'Nenalezeno ��dn� sch�ma.';
	$lang['strnoschemas'] = 'Nenalezeny ��dn� sch�mata.';
	$lang['strcreateschema'] = 'Vytvorit sch�ma';
	$lang['strschemaname'] = 'N�zev sch�matu';
	$lang['strschemaneedsname'] = 'Mus� zadat n�zev sch�matu.';
	$lang['strschemacreated'] = 'Sch�ma vytvo�eno.';
	$lang['strschemacreatedbad'] = 'Sch�ma nebylo vytvo�eno.';
	$lang['strconfdropschema'] = 'Chce� opravdu smazat sch�ma "%s"?';
	$lang['strschemadropped'] = 'Sch�ma smaz�no.';
	$lang['strschemadroppedbad'] = 'Sch�ma nebylo smaz�no.';

	// Reports
	$lang['strreport'] = 'Report';
	$lang['strreports'] = 'Reporty';
	$lang['strshowallreports'] = 'Zobrazit v�echny reporty';
	$lang['strnoreports'] = 'Nenalezeny ��dn� reporty.';
	$lang['strcreatereport'] = 'Vytvo�it report';
	$lang['strreportdropped'] = 'Report smaz�n.';
	$lang['strreportdroppedbad'] = 'Report nebyl smaz�n.';
	$lang['strconfdropreport'] = 'Opravdu chce� smazat report "%s"?';
	$lang['strreportneedsname'] = 'Mus� zadat n�zev reportu.';
	$lang['strreportneedsdef'] = 'Mus� zadat SQL dotaz pro report.';
	$lang['strreportcreated'] = 'Report ulo�en.';
	$lang['strreportcreatedbad'] = 'Report nebyl ulo�en.';

	// Miscellaneous
	$lang['strtopbar'] = '%s be�� na %s:%s -- Jsi p�ihl�en� jako "%s", %s';
	$lang['strtimefmt'] = 'jS M, Y g:iA';

?>
