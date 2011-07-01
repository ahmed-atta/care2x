<?php

	/**
	 * Italian language file, based on the english language file for phpPgAdmin.
	 * Nicola Soranzo [nsoranzo@tiscali.it]
         *
	 * $Id: italian.php,v 1.1 2006/01/13 13:21:40 irroal Exp $
	 */

	// Language and character set - Lingua e set di caratteri
	$lang['applang'] = 'Italiano';
	$lang['appcharset'] = 'ISO-8859-1';
	$lang['applocale'] = 'it_IT';
	$lang['appdbencoding'] = 'LATIN1';

	// Welcome - Benvenuto
	$lang['strintro'] = 'Benvenuto in phpPgAdmin.';
	$lang['strppahome'] = 'Homepage di phpPgAdmin';
	$lang['strpgsqlhome'] = 'Homepage di PostgreSQL';
	$lang['strpgsqlhome_url'] = 'http://www.postgresql.org/';
	$lang['strlocaldocs'] = 'Documentazione su PostgreSQL (locale)';
	$lang['strreportbug'] = 'Riferisci un bug';
	$lang['strviewfaq'] = 'Visualizza le FAQ (domande ricorrenti)';
	$lang['strviewfaq_url'] = 'http://phppgadmin.sourceforge.net/?page=faq';

	// Basic strings - Stringhe basilari
	$lang['strlogin'] = 'Login';
	$lang['strloginfailed'] = 'Login fallito';
	$lang['strlogindisallowed'] = 'Login disabilitato';
	$lang['strserver'] = 'Server';
	$lang['strlogout'] = 'Logout';
	$lang['strowner'] = 'Proprietario';
	$lang['straction'] = 'Azione';
	$lang['stractions'] = 'Azioni';
	$lang['strname'] = 'Nome';
	$lang['strdefinition'] = 'Definizione';
	$lang['straggregates'] = 'Aggregazioni';
	$lang['strproperties'] = 'Propriet�';
	$lang['strbrowse'] = 'Visualizza';
	$lang['strdrop'] = 'Elimina';
	$lang['strdropped'] = 'Eliminato';
	$lang['strnull'] = 'Null';
	$lang['strnotnull'] = 'Non Nullo';
	$lang['strprev'] = '< Prec.';
	$lang['strnext'] = 'Succ. >';
	$lang['strfirst'] = '<< Primo';
	$lang['strlast'] = 'Ultimo >>';
	$lang['strfailed'] = 'Fallito';
	$lang['strcreate'] = 'Crea';
	$lang['strcreated'] = 'Creato';
	$lang['strcomment'] = 'Commento';
	$lang['strlength'] = 'Lunghezza';
	$lang['strdefault'] = 'Default';
	$lang['stralter'] = 'Modifica';
	$lang['strok'] = 'OK';
	$lang['strcancel'] = 'Annulla';
	$lang['strsave'] = 'Salva';
	$lang['strreset'] = 'Reset';
	$lang['strinsert'] = 'Inserisci';
	$lang['strselect'] = 'Seleziona';
	$lang['strdelete'] = 'Cancella';
	$lang['strupdate'] = 'Aggiorna';
	$lang['strreferences'] = 'Riferimenti'; 
	$lang['stryes'] = 'Si';
	$lang['strno'] = 'No';
	$lang['strtrue'] = 'TRUE';
	$lang['strfalse'] = 'FALSE';
	$lang['stredit'] = 'Modifica';
	$lang['strcolumns'] = 'Colonne';
	$lang['strrows'] = 'riga(ghe)';
	$lang['strrowsaff'] = 'riga(ghe) interessata(e).';
	$lang['strobjects'] = 'oggetto(i)';
	$lang['strexample'] = 'es.';
	$lang['strback'] = 'Indietro';
	$lang['strqueryresults'] = 'Risultato Query';
	$lang['strshow'] = 'Mostra';
	$lang['strempty'] = 'Svuota';
	$lang['strlanguage'] = 'Lingua';
	$lang['strencoding'] = 'Codifica';
	$lang['strvalue'] = 'Valore';
	$lang['strunique'] = 'Univoco';
	$lang['strprimary'] = 'Primaria';
	$lang['strimport'] = 'Importa';
	$lang['strexport'] = 'Esporta';
	$lang['strsql'] = 'SQL';
	$lang['strgo'] = 'Esegui';
	$lang['stradmin'] = 'Amministratore';
	$lang['strvacuum'] = 'Vacuum';
	$lang['stranalyze'] = 'Analizza';
	$lang['strcluster'] = 'Clusterizza';
	$lang['strclustered'] = 'Clusterizzato?';
	$lang['strreindex'] = 'Reindicizza';
	$lang['strrun'] = 'Esegui';
	$lang['stradd'] = 'Aggiungi';
	$lang['strevent'] = 'Evento';
	$lang['strwhere'] = 'Condizione';
	$lang['strinstead'] = 'Invece fai';
	$lang['strwhen'] = 'quando';
	$lang['strformat'] = 'Formato';
	$lang['strdata'] = 'Dati';
	$lang['strconfirm'] = 'Conferma';
	$lang['strexpression'] = 'Espressione';
	$lang['strellipsis'] = '...';
	$lang['strexpand'] = 'Espandi';
	$lang['strcollapse'] = 'Raccogli';
	$lang['strexplain'] = 'Spiega';
	$lang['strfind'] = 'Trova';
	$lang['stroptions'] = 'Opzioni';
	$lang['strrefresh'] = 'Ricarica';
	$lang['strdownload'] = 'Scarica';
	$lang['strinfo'] = 'Informazioni';
	$lang['stroids'] = 'OIDs';
	$lang['stradvanced'] = 'Avanzato';

	// Error handling - Gestione degli errori
	$lang['strnoframes'] = 'Devi usare un browser che supporti i frame per usare questa applicazione.';
	$lang['strbadconfig'] = 'Il file config.inc.php � obsoleto. Devi rigenerarlo utilizzando il nuovo file config.inc.php-dist .';
	$lang['strnotloaded'] = 'La tua installazione di PHP non supporta PostgreSQL. Devi ricompilare PHP usando l\'opzione di configurazione --with-pgsql .';
	$lang['strbadschema'] = 'Schema specificato non valido.';
	$lang['strbadencoding'] = 'Impostazione della codifica del client nel database fallito.';
	$lang['strsqlerror'] = 'Errore SQL:';
	$lang['strinstatement'] = 'Nel costrutto:';
	$lang['strinvalidparam'] = 'Parametri di script non validi.';
        $lang['strnodata'] = 'Nessuna riga trovata.';
	$lang['strnoobjects'] = 'Nessun oggetto trovato.';
	$lang['strrownotunique'] = 'Nessun identificatore univoco per questa riga.';

        // Tables - Tabelle
	$lang['strtable'] = 'Tabella';
	$lang['strtables'] = 'Tabelle';
	$lang['strshowalltables'] = 'Mostra tutte le Tabelle';
	$lang['strnotables'] = 'Nessuna tabella trovata.';
	$lang['strnotable'] = 'Tabella non trovata.';
	$lang['strcreatetable'] = 'Crea tabella';
	$lang['strtablename'] = 'Nome tabella';
	$lang['strtableneedsname'] = '� necessario specificare un nome per la tabella.';
	$lang['strtableneedsfield'] = '� necessario specificare almeno un campo.';
	$lang['strtableneedscols'] = 'Le tabelle richiedono un numero di colonne valido.';
	$lang['strtablecreated'] = 'Tabella creata.';
	$lang['strtablecreatedbad'] = 'Creazione della tabella fallita.';
	$lang['strconfdroptable'] = 'Sei sicuro di voler eliminare la tabella "%s"?';
	$lang['strtabledropped'] = 'Tabella eliminata.';
	$lang['strtabledroppedbad'] = 'Eliminazione della tabella fallita.';
	$lang['strconfemptytable'] = 'Sei sicuro di voler svuotare la tabella "%s"?';
	$lang['strtableemptied'] = 'Tabella svuotata.';
        $lang['strtableemptiedbad'] = 'Svuotamento della tabella fallito.';
        $lang['strinsertrow'] = 'Inserisci riga';
	$lang['strrowinserted'] = 'Riga inserita.';
	$lang['strrowinsertedbad'] = 'Inserimento della riga fallito.';
	$lang['streditrow'] = 'Modifica riga';
	$lang['strrowupdated'] = 'Riga aggiornata.';
	$lang['strrowupdatedbad'] = 'Aggiornamento della riga fallito.';
	$lang['strdeleterow'] = 'Cancella riga';
	$lang['strconfdeleterow'] = 'Sei sicuro di voler cancellare questa riga?';
	$lang['strrowdeleted'] = 'Riga cancellata.';
	$lang['strrowdeletedbad'] = 'Cancellazione della riga fallita.';
	$lang['strsaveandrepeat'] = 'Salva e ripeti';
	$lang['strfield'] = 'Campo';
	$lang['strfields'] = 'Campi';
	$lang['strnumfields'] = 'Numero di campi';
	$lang['strfieldneedsname'] = '� necessario specificare un nome per i campi.';
	$lang['strselectallfields'] = 'Seleziona tutti i campi';
        $lang['strselectneedscol'] = '� necessario scegliere almeno una colonna.';
	$lang['strselectunary'] = 'Gli operatori unari non possono avere un valore.';
	$lang['straltercolumn'] = 'Modifica colonna';
	$lang['strcolumnaltered'] = 'Colonna modificata.';
	$lang['strcolumnalteredbad'] = 'Modifica della colonna fallita.';
	$lang['strconfdropcolumn'] = 'Sei sicuro di voler eliminare la colonna "%s" dalla tabella "%s"?';
	$lang['strcolumndropped'] = 'Colonna eliminata.';
	$lang['strcolumndroppedbad'] = 'Eliminazione della colonna fallita.';
	$lang['straddcolumn'] = 'Aggiungi colonna.';
	$lang['strcolumnadded'] = 'Colonna aggiunta.';
	$lang['strcolumnaddedbad'] = 'Aggiunta della colonna fallita.';
	$lang['strcascade'] = 'CASCADE';
	$lang['strtablealtered'] = 'Tabella modificata.';
	$lang['strtablealteredbad'] = 'Modifica della tabella fallita.';
	$lang['strdataonly'] = 'Solo i dati';
	$lang['strstructureonly'] = 'Solo la struttura';
	$lang['strstructureanddata'] = 'Struttura e dati';

	// Users - Utenti
	$lang['struser'] = 'Utente';
	$lang['strusers'] = 'Utenti';
	$lang['strusername'] = 'Username';
	$lang['strpassword'] = 'Password';
	$lang['strsuper'] = 'Superuser?';
	$lang['strcreatedb'] = 'Pu� creare DB?';
	$lang['strexpires'] = 'Scadenza';
	$lang['strnousers'] = 'Nessun utente trovato';
	$lang['struserupdated'] = 'Utente aggiornato.';
	$lang['struserupdatedbad'] = 'Aggiornamento utente fallito.';
	$lang['strshowallusers'] = 'Mostra tutti gli utenti';
	$lang['strcreateuser'] = 'Crea utente';
	$lang['struserneedsname'] = '� necessario specificare un nome per l\'utente.';
	$lang['strusercreated'] = 'Utente creato.';
	$lang['strusercreatedbad'] = 'Creazione dell\'utente fallita.';
	$lang['strconfdropuser'] = 'Sei sicuro di voler eliminare l\'utente "%s"?';
	$lang['struserdropped'] = 'Utente eliminato.';
	$lang['struserdroppedbad'] = 'Eliminazione dell\'utente fallita.';
	$lang['straccount'] = 'Account';
	$lang['strchangepassword'] = 'Modifica password';
	$lang['strpasswordchanged'] = 'Password modificata.';
	$lang['strpasswordchangedbad'] = 'Modifica della password fallita.';
	$lang['strpasswordshort'] = 'La password � troppo corta.';
	$lang['strpasswordconfirm'] = 'Le due password non coincidono.';

        // Groups - Gruppi
	$lang['strgroup'] = 'Gruppo';
	$lang['strgroups'] = 'Gruppi';
	$lang['strnogroup'] = 'Gruppo non torvato.';
	$lang['strnogroups'] = 'Nessun gruppo trovato.';
	$lang['strcreategroup'] = 'Crea gruppo';
	$lang['strshowallgroups'] = 'Mostra tutti i gruppi';
	$lang['strgroupneedsname'] = '� necessario specificare un nome per il gruppo.';
	$lang['strgroupcreated'] = 'Gruppo creato.';
	$lang['strgroupcreatedbad'] = 'Creazione del gruppo fallita.';
	$lang['strconfdropgroup'] = 'Sei sicuro di voler eliminare il gruppo "%s"?';
	$lang['strgroupdropped'] = 'Gruppo eliminato.';
	$lang['strgroupdroppedbad'] = 'Eliminazione del gruppo fallita.';
	$lang['strmembers'] = 'Membri';
	$lang['straddmember'] = 'Aggiungi membro';
	$lang['strmemberadded'] = 'Membro aggiunto.';
	$lang['strmemberaddedbad'] = 'Aggiunta del membro fallita.';
	$lang['strdropmember'] = 'Elimina membro';
	$lang['strconfdropmember'] = 'Sei sicuro di voler eliminare il membro "%s" dal gruppo "%s"?';
	$lang['strmemberdropped'] = 'Membro eliminato.';
	$lang['strmemberdroppedbad'] = 'Eliminazione del membro fallita.';

        // Privileges - Privilegi
        $lang['strprivilege'] = 'Privilegio';
	$lang['strprivileges'] = 'Privilegi';
        $lang['strnoprivileges'] = 'Questo oggetto di default ha i privilegi del proprietario.';
	$lang['strgrant'] = 'Concedi';
	$lang['strrevoke'] = 'Revoca';
	$lang['strgranted'] = 'Privilegi concessi.';
	$lang['strgrantfailed'] = 'Concessione dei privilegi fallita.';
	$lang['strgrantbad'] = '� necessario specificare almeno un utente o gruppo ed almeno un privilegio.';
	$lang['stralterprivs'] = 'Modifica Privilegi';
	$lang['strgrantor'] = 'Grantor'; // ???
	$lang['strasterisk'] = '*';

        // Databases
	$lang['strdatabase'] = 'Database';
	$lang['strdatabases'] = 'Database';
	$lang['strshowalldatabases'] = 'Mostra tutti i database';
	$lang['strnodatabase'] = 'Database non trovato.';
	$lang['strnodatabases'] = 'Nessun database trovato.';
	$lang['strcreatedatabase'] = 'Crea database';
	$lang['strdatabasename'] = 'Nome del database';
	$lang['strdatabaseneedsname'] = '� necessario specificare un nome per il database.';
	$lang['strdatabasecreated'] = 'Database creato.';
	$lang['strdatabasecreatedbad'] = 'Creazione del database fallita.';
	$lang['strconfdropdatabase'] = 'Sei sicuro di volere eliminare il database "%s"?';
	$lang['strdatabasedropped'] = 'Database eliminato.';
	$lang['strdatabasedroppedbad'] = 'Eliminazione del database fallita.';
	$lang['strentersql'] = 'Inserire la query SQL da eseguire qui sotto:';
	$lang['strsqlexecuted'] = 'SQL eseguito.';
	$lang['strvacuumgood'] = 'Vacuum completato.';
	$lang['strvacuumbad'] = 'Vacuum fallito.';
	$lang['stranalyzegood'] = 'Analyze completato.';
	$lang['stranalyzebad'] = 'Analyze fallito';

	// Views - Viste
	$lang['strview'] = 'Vista';
	$lang['strviews'] = 'Viste';
	$lang['strshowallviews'] = 'Mostra tutte le viste';
	$lang['strnoview'] = 'Vista non trovata.';
	$lang['strnoviews'] = 'Nessuna vista trovata.';
	$lang['strcreateview'] = 'Crea vista';
	$lang['strviewname'] = 'Nome vista';
	$lang['strviewneedsname'] = '� necessario specificare un nome per la vista.';
	$lang['strviewneedsdef'] = '� necessario specificare una definizione per la vista.';
	$lang['strviewcreated'] = 'Vista creata.';
	$lang['strviewcreatedbad'] = 'Creazione della vista fallita.';
	$lang['strconfdropview'] = 'Sei sicuro di volere eliminare la vista "%s"?';
	$lang['strviewdropped'] = 'Vista eliminata.';
	$lang['strviewdroppedbad'] = 'Eliminazione della vista fallita.';
	$lang['strviewupdated'] = 'Vista aggiornata.';
	$lang['strviewupdatedbad'] = 'Aggiornamento della vista fallito.';

	// Sequences - Sequenze
	$lang['strsequence'] = 'Sequenza';
	$lang['strsequences'] = 'Sequenze';
	$lang['strshowallsequences'] = 'Mostra tutte le sequenze';
        $lang['strnosequence'] = 'Sequenza non trovata.';
        $lang['strnosequences'] = 'Nessuna sequenza trovata.';
	$lang['strcreatesequence'] = 'Crea sequenza';
	$lang['strlastvalue'] = 'Valore precedente';
	$lang['strincrementby'] = 'Incrementa di';
	$lang['strstartvalue'] = 'Valore iniziale';
	$lang['strmaxvalue'] = 'Valore massimo';
	$lang['strminvalue'] = 'Valore minimo';
	$lang['strcachevalue'] = 'Valore cache';
	$lang['strlogcount'] = 'Conta log';
	$lang['striscycled'] = '� iterata?';
	$lang['striscalled'] = '� chiamata?';
	$lang['strsequenceneedsname'] = '� necessario specificare un nome per la sequenza.';
	$lang['strsequencecreated'] = 'Sequenza creata.';
	$lang['strsequencecreatedbad'] = 'Creazione della sequenza fallita.';
	$lang['strconfdropsequence'] = 'Sei sicuro di volere eliminare la sequenza "%s"?';
	$lang['strsequencedropped'] = 'Sequenza eliminata.';
	$lang['strsequencedroppedbad'] = 'Eliminazione della sequenza fallita.';
	$lang['strsequencereset'] = 'Reset della sequenza effettuato.';
	$lang['strsequenceresetbad'] = 'Reset della sequenza fallito.'; 

	// Indexes - Indici
	$lang['strindexes'] = 'Indici';
	$lang['strindexname'] = 'Nome dell\'indice';
	$lang['strshowallindexes'] = 'Mostra tutti gli indici';
	$lang['strnoindex'] = 'Indice non trovato.';
	$lang['strnoindexes'] = 'Nessun indice trovato.';
	$lang['strcreateindex'] = 'Crea Indice';
	$lang['strtabname'] = 'Nome del tab';
	$lang['strcolumnname'] = 'Nome della colonna';
	$lang['strindexneedsname'] = '� necessario specificare un nome per l\'indice';
	$lang['strindexneedscols'] = 'Gli indici richiedono di un numero valido di colonne.';
	$lang['strindexcreated'] = 'Indice creato';
	$lang['strindexcreatedbad'] = 'Creazione indice fallita.';
	$lang['strconfdropindex'] = 'Sei sicuro di voler eliminare l\'indice "%s"?';
	$lang['strindexdropped'] = 'Indice eliminato.';
	$lang['strindexdroppedbad'] = 'Eliminazione dell\'indice fallita.';
        $lang['strkeyname'] = 'Nome della chiave';
	$lang['struniquekey'] = 'Chiave Univoca';
	$lang['strprimarykey'] = 'Chiave Primaria';
	$lang['strindextype'] = 'Tipo di indice';
	$lang['strtablecolumnlist'] = 'Colonne nella tabella';
	$lang['strindexcolumnlist'] = 'Colonne nell\'indice';
	$lang['strconfcluster'] = 'Sei sicuro di voler clusterizzare "%s"?';
	$lang['strclusteredgood'] = 'Clusterizzazione completata.';
	$lang['strclusteredbad'] = 'Clusterizzazione fallita.';

        // Rules - Regole
	$lang['strrules'] = 'Regole';
	$lang['strrule'] = 'Regola';
	$lang['strshowallrules'] = 'Mostra tutte le regole';
	$lang['strnorule'] = 'Regola non trovata.';
	$lang['strnorules'] = 'Nessuna regola trovata.';
	$lang['strcreaterule'] = 'Crea regola';
	$lang['strrulename'] = 'Nome della regola';
	$lang['strruleneedsname'] = '� necessario specificare un nome per la regola.';
	$lang['strrulecreated'] = 'Regola creata.';
	$lang['strrulecreatedbad'] = 'Creazione della regola fallita.';
	$lang['strconfdroprule'] = 'Sei sicuro di volere eliminare la regola "%s" su "%s"?';
	$lang['strruledropped'] = 'Regola eliminata.';
	$lang['strruledroppedbad'] = 'Eliminazione della regola fallita.';

	// Constraints - Vincoli
	$lang['strconstraints'] = 'Vincoli';
	$lang['strshowallconstraints'] = 'Mostra tutti i vincoli';
	$lang['strnoconstraints'] = 'Nessun vincolo trovato.';
	$lang['strcreateconstraint'] = 'Crea vincolo';
	$lang['strconstraintcreated'] = 'Vincolo creato.';
	$lang['strconstraintcreatedbad'] = 'Creazione del vincolo fallita.';
	$lang['strconfdropconstraint'] = 'Sei sicuro di volere eliminare il vincolo "%s" su "%s"?';
	$lang['strconstraintdropped'] = 'Vincolo eliminato.';
	$lang['strconstraintdroppedbad'] = 'Eliminazione vincolo fallita.';
	$lang['straddcheck'] = 'Aggiungi un Check';
	$lang['strcheckneedsdefinition'] = 'Il vincolo Check necessita di una definizione.';
	$lang['strcheckadded'] = 'Vincolo Check aggiunto.';
	$lang['strcheckaddedbad'] = 'Inserimento del vincolo Check fallito.';
	$lang['straddpk'] = 'Aggiungi una chiave primaria';
	$lang['strpkneedscols'] = 'La chiave primaria richiede almeno una colonna.';
	$lang['strpkadded'] = 'Chiave primaria aggiunta.';
	$lang['strpkaddedbad'] = 'Aggiunta della chiave primaria fallita.';
	$lang['stradduniq'] = 'Aggiungi una chiave univoca';
	$lang['struniqneedscols'] = 'La chiave univoca richiede almeno una colonna.';
	$lang['struniqadded'] = 'Chiave univoca aggiunta.';
	$lang['struniqaddedbad'] = 'Aggiunta chiave univoca fallita.';
	$lang['straddfk'] = 'Aggiungi una chiave esterna';
	$lang['strfkneedscols'] = 'La chiave esterna richiede almeno una colonna.';
	$lang['strfkneedstarget'] = 'La chiave esterna richiede una tabella obiettivo.';
	$lang['strfkadded'] = 'Chiave esterna aggiunta.';
	$lang['strfkaddedbad'] = 'Aggiunta della chiave esterna fallita.';
	$lang['strfktarget'] = 'Tabella obiettivo';
	$lang['strfkcolumnlist'] = 'Colonne della chiave';
	$lang['strondelete'] = 'ON DELETE';
	$lang['stronupdate'] = 'ON UPDATE';

	// Functions - Funzioni
	$lang['strfunction'] = 'Funzione';
	$lang['strfunctions'] = 'Funzioni';
	$lang['strshowallfunctions'] = 'Mostra tutte le funzioni';
	$lang['strnofunction'] = 'Funzione non trovata.';
	$lang['strnofunctions'] = 'Nessuna funzione trovata.';
	$lang['strcreatefunction'] = 'Crea funzione';
	$lang['strfunctionname'] = 'Nome della funzione';
	$lang['strreturns'] = 'Restituisce';
	$lang['strarguments'] = 'Argomenti';
	$lang['strproglanguage'] = 'Linguaggio di programmazione';
	$lang['strfunctionneedsname'] = '� necessario specificare un nome per la funzione.';
	$lang['strfunctionneedsdef'] = '� necessario specificare una definizione per la funzione.';
	$lang['strfunctioncreated'] = 'Funzione creata.';
	$lang['strfunctioncreatedbad'] = 'Creazione funzione fallita.';
	$lang['strconfdropfunction'] = 'Sei sicuro di volere eliminare la funzione "%s"?';
        $lang['strfunctiondropped'] = 'Funzione eliminata.';
        $lang['strfunctiondroppedbad'] = 'Eliminazione della funzione fallita.';
        $lang['strfunctionupdated'] = 'Funzione aggiornata.';
        $lang['strfunctionupdatedbad'] = 'Aggiornamento della funzione fallito.';

        // Triggers - Trigger
        $lang['strtrigger'] = 'Trigger';
	$lang['strtriggers'] = 'Trigger';
        $lang['strshowalltriggers'] = 'Mostra tutti i trigger';
        $lang['strnotrigger'] = 'Trigger non trovato.';
        $lang['strnotriggers'] = 'Nessun trigger trovato.';
        $lang['strcreatetrigger'] = 'Crea Trigger';
        $lang['strtriggerneedsname'] = '� necessario specificare un nome per il trigger.';
        $lang['strtriggerneedsfunc'] = '� necessario specificare una funzione per il trigger.';
        $lang['strtriggercreated'] = 'Trigger creato.';
        $lang['strtriggercreatedbad'] = 'Creazione del trigger fallita.';
        $lang['strconfdroptrigger'] = 'Sei sicuro di volere eliminare il trigger "%s" su "%s"?';
        $lang['strtriggerdropped'] = 'Trigger eliminato.';
        $lang['strtriggerdroppedbad'] = 'Eliminazione del trigger fallita.';
	$lang['strtriggeraltered'] = 'Trigger modificato.';
	$lang['strtriggeralteredbad'] = 'Modifica del trigger fallita.';

        // Types - Tipi
	$lang['strtype'] = 'Tipo';
	$lang['strtypes'] = 'Tipi';
        $lang['strshowalltypes'] = 'Mostra tutti i tipi';
        $lang['strnotype'] = 'Tipo non trovato.';
        $lang['strnotypes'] = 'Nessun tipo trovato.';
        $lang['strcreatetype'] = 'Crea Tipo';
        $lang['strtypename'] = 'Nome Tipo';
        $lang['strinputfn'] = 'Funzione di input';
        $lang['stroutputfn'] = 'Funzione di output';
        $lang['strpassbyval'] = 'Passato per valore?';
        $lang['stralignment'] = 'Allineamento';
        $lang['strelement'] = 'Elemento';
        $lang['strdelimiter'] = 'Delimitatore';
        $lang['strstorage'] = 'Memorizzazione';
        $lang['strtypeneedsname'] = '� necessario specificare un nome per il tipo.';
        $lang['strtypeneedslen'] = '� necessario specificare una lunghezza per il tipo.';
        $lang['strtypecreated'] = 'Tipo creato';
        $lang['strtypecreatedbad'] = 'Creazione del tipo fallita.';
        $lang['strconfdroptype'] = 'Sei sicuro di voler eliminare il tipo "%s"?';
        $lang['strtypedropped'] = 'Tipo eliminato.';
        $lang['strtypedroppedbad'] = 'Eliminazione del tipo fallita.';

        // Schemas - Schemi
        $lang['strschema'] = 'Schema';
        $lang['strschemas'] = 'Schemi';
        $lang['strshowallschemas'] = 'Mostra tutti gli schemi';
        $lang['strnoschema'] = 'Schema non trovato.';
        $lang['strnoschemas'] = 'Nessuno schema trovato.';
        $lang['strcreateschema'] = 'Crea schema';
        $lang['strschemaname'] = 'Nome dello schema';
        $lang['strschemaneedsname'] = '� necessario spcificare un nome per lo schema.';
        $lang['strschemacreated'] = 'Schema creato';
        $lang['strschemacreatedbad'] = 'Creazione dello schema fallita.';
        $lang['strconfdropschema'] = 'Sei sicuro di volere eliminare lo schema "%s"?';
        $lang['strschemadropped'] = 'Schema eliminato.';
        $lang['strschemadroppedbad'] = 'Eliminazione dello schema fallita.';

        // Reports - Report
        $lang['strreport'] = 'Report';
        $lang['strreports'] = 'Report';
        $lang['strshowallreports'] = 'Mostra tutti i report';
        $lang['strnoreports'] = 'Nessun report trovato.';
        $lang['strcreatereport'] = 'Crea report';
        $lang['strreportdropped'] = 'Report eliminato.';
        $lang['strreportdroppedbad'] = 'Eliminazione del report fallita.';
        $lang['strconfdropreport'] = 'Sei sicuro di volere eliminare il report "%s"?';
        $lang['strreportneedsname'] = '� necessario specificare un nome per il report.';
        $lang['strreportneedsdef'] = '� necessario inserire il codice SQL per il report.';
        $lang['strreportcreated'] = 'Report salvato';
        $lang['strreportcreatedbad'] = 'Salvataggio del report fallito.';

	// Domains - Domini
	$lang['strdomain'] = 'Dominio';
	$lang['strdomains'] = 'Domini';
	$lang['strshowalldomains'] = 'Mostra tutti i domini';
	$lang['strnodomains'] = 'Nessun dominio trovato.';
	$lang['strcreatedomain'] = 'Crea dominio';
	$lang['strdomaindropped'] = 'Dominio eliminato.';
	$lang['strdomaindroppedbad'] = 'Eliminazione del dominio fallita.';
	$lang['strconfdropdomain'] = 'Sei sicuro di voler eliminare il dominio "%s"?';
	$lang['strdomainneedsname'] = '� necessario specificare un nome per il dominio.';
	$lang['strdomaincreated'] = 'Dominio creato.';
	$lang['strdomaincreatedbad'] = 'Creazione del dominio fallita.';	
	$lang['strdomainaltered'] = 'Dominio modificato.';
	$lang['strdomainalteredbad'] = 'Modifica del dominio fallita.';	

	// Operators - Operatori
	$lang['stroperator'] = 'Operatore';
	$lang['stroperators'] = 'Operatori';
	$lang['strshowalloperators'] = 'Mostra tutti gli operatori';
	$lang['strnooperator'] = 'Operatore non trovato.';
	$lang['strnooperators'] = 'Nessun operatore trovato.';
	$lang['strcreateoperator'] = 'Crea operatore';
	$lang['strleftarg'] = 'Tipo dell\'argomento di sinistra';
	$lang['strrightarg'] = 'Tipo dell\'argomento di destra';
	$lang['strcommutator'] = 'Commutatore';
	$lang['strnegator'] = 'Negator';
	$lang['strrestrict'] = 'Restrict';
	$lang['strjoin'] = 'Join';
	$lang['strhashes'] = 'Supporta hash join';
	$lang['strmerges'] = 'Supporta merge join';
	$lang['strleftsort'] = 'Ordinamento sinistro';
	$lang['strrightsort'] = 'Ordinamento destro';
	$lang['strlessthan'] = 'Minore';
	$lang['strgreaterthan'] = 'Maggiore';
	$lang['stroperatorneedsname'] = '� necessario specificare un nome per l\'operatore.';
	$lang['stroperatorcreated'] = 'Operatore creato';
	$lang['stroperatorcreatedbad'] = 'Creazione dell\'operatore fallita.';
	$lang['strconfdropoperator'] = 'Sei sicuro di voler eliminare l\'operatore "%s"?';
	$lang['stroperatordropped'] = 'Operatore eliminato.';
	$lang['stroperatordroppedbad'] = 'Eliminazione dell\'operatore fallita.';

	// Casts - Cast
	$lang['strcasts'] = 'Cast';
	$lang['strnocasts'] = 'Nessun cast trovato.';
	$lang['strsourcetype'] = 'Tipo sorgente';
	$lang['strtargettype'] = 'Tipo destinazione';
	$lang['strimplicit'] = 'Implicito';
	$lang['strinassignment'] = 'Negli assegnamenti';
	$lang['strbinarycompat'] = '(Compatibile in binario)';
	
	// Conversions - Conversioni
	$lang['strconversions'] = 'Conversioni';
	$lang['strnoconversions'] = 'Nessuna conversione trovata.';
	$lang['strsourceencoding'] = 'Codifica sorgente';
	$lang['strtargetencoding'] = 'Codifica destinazione';
	
	// Languages - Linguaggi
	$lang['strlanguages'] = 'Linguaggi';
	$lang['strnolanguages'] = 'Nessun linguaggio trovato.';
	$lang['strtrusted'] = 'Trusted';

	// Info
	$lang['strnoinfo'] = 'Nessuna informazione disponibile.';
	$lang['strreferringtables'] = 'Tabella referente';
	$lang['strparenttables'] = 'Tabella padre';
	$lang['strchildtables'] = 'Tabella figlia';

	// Miscellaneous - Varie
        $lang['strtopbar'] = '%s in esecuzione su %s:%s -- Sei entrato come utente "%s", %s';
        $lang['strtimefmt'] = 'j M Y - g:iA';
	$lang['strhelp'] = 'Aiuto';

?>
