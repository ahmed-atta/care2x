<?php

	/**
	 * Spanish language file for phpPgAdmin.
	 * @maintainer Mart�n Marqu�s (martin@bugs.unl.edu.ar)
	 *
	 * $Id$
	 */

	// Language and character set
	$lang['applang'] = 'Spanish';
	$lang['appcharset'] = 'ISO-8859-1';
	$lang['applocale'] = 'es_ES';
  	$lang['appdbencoding'] = 'LATIN1';

        // Bienvenido
	$lang['strintro'] = 'Bienvenido a phpPgAdmin.';
	$lang['strppahome'] = 'P�gina web de phpPgAdmin';
	$lang['strpgsqlhome'] = 'P�gina web de PostgreSQL';
	$lang['strpgsqlhome_url'] = 'http://www.postgresql.org/';
	$lang['strlocaldocs'] = 'Documentaci�n de PostgreSQL (local)';
	$lang['strreportbug'] = 'Reportar problemas';
	$lang['strviewfaq'] = 'Ver Preguntas Frecuentes';
	$lang['strviewfaq_url'] = 'http://phppgadmin.sourceforge.net/?page=faq';

	// Basic strings
	$lang['strlogin'] = 'Autenticar';
	$lang['strloginfailed'] = 'Fall� la autenticaci�n';
	$lang['strlogindisallowed'] = 'Ingreso no autorizado';
	$lang['strserver'] = 'Servidor';
	$lang['strlogout'] = 'Salir';
	$lang['strowner'] = 'Propietario';
	$lang['straction'] = 'Acci�n';
	$lang['stractions'] = 'Acciones';
	$lang['strname'] = 'Nombre';
	$lang['strdefinition'] = 'Definici�n';
	$lang['straggregates'] = 'Agregados';
	$lang['strproperties'] = 'Propiedades';
	$lang['strbrowse'] = 'Examinar';
	$lang['strdrop'] = 'Eliminar';
	$lang['strdropped'] = 'Eliminado';
	$lang['strnull'] = 'Nulo';
	$lang['strnotnull'] = 'No Nulo';
	$lang['strprev'] = 'Previo';
	$lang['strnext'] = 'Pr�ximo';
        $lang['strfirst'] = '<< Principio';
        $lang['strlast'] = 'Final >>';
	$lang['strfailed'] = 'Fall�';
	$lang['strcreate'] = 'Crear';
	$lang['strcreated'] = 'Creado';
	$lang['strcomment'] = 'Comentario';
	$lang['strlength'] = 'Longitud';
	$lang['strdefault'] = 'Predeterminado';
	$lang['stralter'] = 'Modificar';
	$lang['strok'] = 'OK';
	$lang['strcancel'] = 'Cancelar';
	$lang['strsave'] = 'Guardar';
	$lang['strreset'] = 'Reestablecer';
	$lang['strinsert'] = 'Insertar';
	$lang['strselect'] = 'Seleccionar';
	$lang['strdelete'] = 'Eliminar';
	$lang['strupdate'] = 'Actualizar';
	$lang['strreferences'] = 'Referencia';
	$lang['stryes'] = 'Si';
	$lang['strno'] = 'No';
	$lang['strtrue'] = 'Verdadero';
	$lang['strfalse'] = 'Falso';
	$lang['stredit'] = 'Editar';
	$lang['strcolumns'] = 'Columnas';
	$lang['strrows'] = 'fila(s)';
	$lang['strrowsaff'] = 'fila(s) afectadas.';
	$lang['strobjects'] = 'objecto(s)';
	$lang['strexample'] = 'ej.';
	$lang['strback'] = 'Atr�s';
	$lang['strqueryresults'] = 'Resultado de la consulta';
	$lang['strshow'] = 'Mostrar';
	$lang['strempty'] = 'Vaciar';
	$lang['strlanguage'] = 'Idioma';
	$lang['strencoding'] = 'Codificaci�n';
	$lang['strvalue'] = 'Valor';
	$lang['strunique'] = '�nico';
	$lang['strprimary'] = 'Primaria';
	$lang['strexport'] = 'Exportar';
	$lang['strimport'] = 'Importar';
	$lang['strsql'] = 'SQL';
	$lang['strgo'] = 'Seguir';
	$lang['stradmin'] = 'Admin';
	$lang['strvacuum'] = 'Limpiar';
	$lang['stranalyze'] = 'Analizar';
	$lang['strcluster'] = 'Ordenar tabla';
	$lang['strclustered'] = '�Tabla Ordenada?';
	$lang['strreindex'] = 'Reindexar';
	$lang['strrun'] = 'Ejecutar';
	$lang['stradd'] = 'Agregar';
	$lang['strevent'] = 'Evento';
	$lang['strwhere'] = 'Donde';
	$lang['strinstead'] = 'Hacer en su lugar';
	$lang['strwhen'] = 'Cuando';
	$lang['strformat'] = 'Formato';
	$lang['strdata'] = 'Dato';
	$lang['strconfirm'] = 'Confirmar';
	$lang['strexpression'] = 'Expresi�n';
	$lang['strellipsis'] = '...';
	$lang['strexpand'] = 'Expandir';
	$lang['strcollapse'] = 'Colapsar';
        $lang['strexplain'] = 'Explicar';
        $lang['strfind'] = 'Buscar';
        $lang['stroptions'] = 'Opciones';
	$lang['strrefresh'] = 'Refrescar';
	$lang['strdownload'] = 'Bajar';
	$lang['strinfo'] = 'Informaci�n';
	$lang['stroids'] = 'OIDs';
	$lang['stradvanced'] = 'Advanzado';

	// Error handling
	$lang['strnoframes'] = 'Necesit�s un navegador con soporte de marcos para usar esta aplicaci�n.';
	$lang['strbadconfig'] = 'Su archivo config.inc.php est� desactualizado. Deber� regenerarlo a partir del archivo nuevo config.inc.php-dist.';
	$lang['strnotloaded'] = 'Su versi�n de PHP no tiene el soporte correcto de bases de datos.';
	$lang['strbadschema'] = 'El esquema especificado no es v�lido.';
	$lang['strbadencoding'] = 'No se pudo setear la codificaci�n del cliente en la base de datos.';
	$lang['strsqlerror'] = 'Error de SQL:';
	$lang['strinstatement'] = 'En la declaraci�n:';
	$lang['strinvalidparam'] = 'Par�metros de script no v�lidos.';
	$lang['strnodata'] = 'No se encontraron filas.';
	$lang['strnoobjects'] = 'No se encontraron objectos.';
	$lang['strrownotunique'] = 'No existe un identificador �nico para este registro.';

	// Tables
	$lang['strtable'] = 'Tabla';
	$lang['strtables'] = 'Tablas';
	$lang['strshowalltables'] = 'Mostrar Todas las Tablas';
	$lang['strnotables'] = 'No se encontraron tablas.';
	$lang['strnotable'] = 'No se encontr� la tabla.';
	$lang['strcreatetable'] = 'Crear tabla';
	$lang['strtablename'] = 'Nombre de la tabla';
	$lang['strtableneedsname'] = 'Debe darle un nombre a la tabla.';
	$lang['strtableneedsfield'] = 'Debe especificar al menos un campo.';
	$lang['strtableneedscols'] = 'Las tablas requieren un n�mero v�lido de columnas.';
	$lang['strtablecreated'] = 'Tabla creada.';
	$lang['strtablecreatedbad'] = 'Fall� al tratar crear la tabla.';
	$lang['strconfdroptable'] = '�Est� seguro que desea eliminar la tabla "%s"?';
	$lang['strtabledropped'] = 'Tabla eliminada.';
	$lang['strtabledroppedbad'] = 'Fall� al tratar de eliminar la tabla.';
	$lang['strconfemptytable'] = '�Est� seguro que desea vaciar la tabla "%s"?';
	$lang['strtableemptied'] = 'Tabla vaciada.';
	$lang['strtableemptiedbad'] = 'Fall� el vaciado de la tabla.';
	$lang['strinsertrow'] = 'Insertar Fila';
	$lang['strrowinserted'] = 'Fila insertada.';
	$lang['strrowinsertedbad'] = 'Fall� la inserci�n de fila.';
	$lang['streditrow'] = 'Editar fila';
	$lang['strrowupdated'] = 'Fila actualizada.';
	$lang['strrowupdatedbad'] = 'Fall� al intentar actualizar la fila.';
	$lang['strdeleterow'] = 'Eliminar Fila';
	$lang['strconfdeleterow'] = '�Est� seguro que quiere eliminar esta fila?';
	$lang['strrowdeleted'] = 'Fila eliminada.';
	$lang['strrowdeletedbad'] = 'Fall� la eliminaci�n de fila.';
	$lang['strsaveandrepeat'] = 'Guardar y Repetir';
	$lang['strfield'] = 'Campo';
	$lang['strfields'] = 'Campos';
	$lang['strnumfields'] = 'N�mero de Campos';
	$lang['strfieldneedsname'] = 'Debe darle un nombre al campo';
        $lang['strselectallfields'] = 'Seleccionar todos los campos.';
	$lang['strselectneedscol'] = 'Debe elegir al menos una columna';
	$lang['strselectunary'] = 'Operaciones unitarias no pueden tener valores.';
	$lang['straltercolumn'] = 'Modificar Columna';
	$lang['strcolumnaltered'] = 'Columna Modificada.';
	$lang['strcolumnalteredbad'] = 'Fall� la modificaci�n de columna.';
	$lang['strconfdropcolumn'] = '�Est� seguro que quiere eliminar la columna "%s" de la tabla "%s"?';
	$lang['strcolumndropped'] = 'Columna eliminada.';
	$lang['strcolumndroppedbad'] = 'Fall� la eliminaci�n de columna.';
        $lang['straddcolumn'] = 'Agregar Columna';
	$lang['strcolumnadded'] = 'Columna agregada.';
	$lang['strcolumnaddedbad'] = 'Fall� el agregado de columna.';
	$lang['strdataonly'] = 'Datos solamente';
	$lang['strcascade'] = 'EN CASCADA';
	$lang['strtablealtered'] = 'Tabla modificada.';
	$lang['strtablealteredbad'] = 'Fall� la modificaci�n  de la Tabla.';
	$lang['strstructureonly'] = 'Solo la estructura';
	$lang['strstructureanddata'] = 'Estructura y datos';

        // Users
	$lang['struser'] = 'Usuario';
	$lang['strusers'] = 'Usuarios';
	$lang['strusername'] = 'Nombre de usuario';
	$lang['strpassword'] = 'Contrase�a';
	$lang['strsuper'] = '�Es administrador?';
	$lang['strcreatedb'] = '�Puede crear BD?';
	$lang['strexpires'] = 'Expira';
	$lang['strnousers'] = 'No se encontraron usuarios.';
        $lang['struserupdated'] = 'Usuario actualizado.';
	$lang['struserupdatedbad'] = 'Fall� la actualizaci�n del usuario.';
	$lang['strshowallusers'] = 'Mostrar Todos los Usuarios';
	$lang['strcreateuser'] = 'Crear Usuario';
	$lang['struserneedsname'] = 'Debe dar un nombre a su usuario.';
	$lang['strusercreated'] = 'Usuario creado.';
	$lang['strusercreatedbad'] = 'Fall� al crear usuario.';
        $lang['struserdropped'] = 'Usuario eliminado.';
	$lang['strconfdropuser'] = '�Est� seguro que quiere eliminar el usuario "%s"?';
	$lang['struserdroppedbad'] = 'Fall� al eliminar el usuario.';
	$lang['straccount'] = 'Cuenta';
	$lang['strchangepassword'] = 'Cambiar Contrase�a';
	$lang['strpasswordchanged'] = 'Contrase�a modificada.';
	$lang['strpasswordchangedbad'] = 'Fall� al modificar contrase�a.';
	$lang['strpasswordshort'] = 'La contrase�a es muy corta.';
	$lang['strpasswordconfirm'] = 'Las contrase�as no coinciden.';

        // Groups
	$lang['strgroups'] = 'Grupos';
        $lang['strgroup'] = 'Grupo';
	$lang['strnogroup'] = 'Grupo no encontrado.';
	$lang['strnogroups'] = 'No se encontraron grupos.';
	$lang['strcreategroup'] = 'Crear Grupo';
	$lang['strshowallgroups'] = 'Mostrar Todos los Grupos';
	$lang['strgroupneedsname'] = 'Debe darle un nombre al grupo.';
	$lang['strgroupcreated'] = 'Grupo creado.';
	$lang['strgroupcreatedbad'] = 'Fall� la creaci�n del grupo.';
	$lang['strconfdropgroup'] = '�Est� seguro que quiere eliminar el grupo "%s"?';
	$lang['strgroupdropped'] = 'Grupo eliminado.';
	$lang['straddmember'] = 'Agregar un miembro';
	$lang['strmemberadded'] = 'Miembro agregado.';
	$lang['strmemberaddedbad'] = 'Fall� al intentar agregar nuevo miembro.';
	$lang['strdropmember'] = 'Sacar miembro';
	$lang['strconfdropmember'] = '�Est� seguro que quiere sacra el miembro "%s" del grupo "%s"?';
	$lang['strmemberdropped'] = 'Miembro eliminado.';
	$lang['strmemberdroppedbad'] = 'Fall� al intentar sacar un miembro.';
	$lang['strgroupdroppedbad'] = 'Fall� la eliminaci�n del grupo.';
	$lang['strmembers'] = 'Miembros';

	// Privilges
	$lang['strprivilege'] = 'Privilegio';
	$lang['strprivileges'] = 'Privilegios';
	$lang['strnoprivileges'] = 'Este objeto tiene privilegios de usuario por defecto.';
	$lang['strgrant'] = 'Otorgar';
	$lang['strrevoke'] = 'Revocar';
	$lang['strgranted'] = 'Privilegios otorgados/revocados.';
	$lang['strgrantfailed'] = 'Fall� al intendar otorgar privilegios.';
        $lang['strgrantor'] = 'Cedente';
        $lang['strasterisk'] = '*';
	$lang['strgrantbad'] = 'Debe especificar al menos un usuario o grupo y al menos un privilegio.';
	$lang['stralterprivs'] = 'Cambiar Privilegios';

	// Databases
	$lang['strdatabase'] = 'Base de Datos';
	$lang['strdatabases'] = 'Bases de Datos';
	$lang['strshowalldatabases'] = 'Mostrar Todas las Bases de Datos';
	$lang['strnodatabase'] = 'No se encontr� la Base de Datos.';
	$lang['strnodatabases'] = 'No se encontraron Bases de Datos.';
	$lang['strcreatedatabase'] = 'Crear base de datos';
	$lang['strdatabasename'] = 'Nombre de la base de datos';
	$lang['strdatabaseneedsname'] = 'Debe darle un nombre a la base de datos.';
	$lang['strdatabasecreated'] = 'Base de Datos creada.';
	$lang['strdatabasecreatedbad'] = 'Fall� la creaci�n de la base de datos.';	
	$lang['strconfdropdatabase'] = '�Est� seguro que quiere eliminar la base de datos "%s"?';
	$lang['strdatabasedropped'] = 'Base de datos eliminada.';
	$lang['strdatabasedroppedbad'] = 'Fall� al eliminar la base de datos.';
	$lang['strentersql'] = 'Ingrese la sentencia de SQL para ejecutar:';
	$lang['strsqlexecuted'] = 'SQL ejecutada.';
	$lang['strvacuumgood'] = 'Limpieza completada.';
	$lang['strvacuumbad'] = 'Fall� al intentar limpiar.';
	$lang['stranalyzegood'] = 'An�lisis completado.';
	$lang['stranalyzebad'] = 'Fall� al intentar analizar.';

	// Views
	$lang['strview'] = 'Vista';
	$lang['strviews'] = 'Vistas';
	$lang['strshowallviews'] = 'Mostrar todas las vistas';
	$lang['strnoview'] = 'No se encontr� la vista.';
	$lang['strnoviews'] = 'No se encontraron vistas.';
	$lang['strcreateview'] = 'Crear Vista';
	$lang['strviewname'] = 'Nombre de Vista';
	$lang['strviewneedsname'] = 'Debe darle un nombre a la vista.';
	$lang['strviewneedsdef'] = 'Debe darle una definici�n a su vista.';
	$lang['strviewcreated'] = 'Vista creada.';
	$lang['strviewcreatedbad'] = 'Fall� al crear la vista.';
	$lang['strconfdropview'] = '�Est� seguro que quiere eliminar la vista "%s"?';
	$lang['strviewdropped'] = 'Vista eliminada.';
	$lang['strviewdroppedbad'] = 'Fall� al intentar eliminar la vista.';
	$lang['strviewupdated'] = 'Vista actualizada.';
	$lang['strviewupdatedbad'] = 'Fall� al actualizar la vista.';

	// Sequences
	$lang['strsequence'] = 'Secuencia';
	$lang['strsequences'] = 'Secuencias';
	$lang['strshowallsequences'] = 'Mostrar todas las secuencias';
	$lang['strnosequence'] = 'No se encontr� la secuencia.';
	$lang['strnosequences'] = 'No se encontraron secuencias.';
	$lang['strcreatesequence'] = 'Crear secuencia';
	$lang['strlastvalue'] = '�ltimo Valor';
	$lang['strincrementby'] = 'Incremento';	
	$lang['strstartvalue'] = 'Valor Inicial';
	$lang['strmaxvalue'] = 'Valor M�ximo';
	$lang['strminvalue'] = 'Valor M�nimo';
	$lang['strcachevalue'] = 'Valor de Cache';
	$lang['strlogcount'] = 'Log Count';
	$lang['striscycled'] = '�Rotar?';
	$lang['striscalled'] = '�Nombre?';
	$lang['strsequenceneedsname'] = 'Debe darle un nombre a la secuencia.';
	$lang['strsequencecreated'] = 'Secuencia creada.';
	$lang['strsequencecreatedbad'] = 'Fall� la creaci�n de la secuencia.'; 
	$lang['strconfdropsequence'] = '�Est� seguro que quiere eliminar la secuencia "%s"?';
	$lang['strsequencedropped'] = 'Secuencia eliminada.';
	$lang['strsequencedroppedbad'] = 'Fall� la eliminaci�n de la secuencia.';
	$lang['strsequencereset'] = 'Secuencia reiniciada.';
	$lang['strsequenceresetbad'] = 'Fall� al intentar reiniciar la secuencia.'; 

	// Indexes
	$lang['strindexes'] = '�ndices';
	$lang['strindexname'] = 'Nombre del �ndice';
	$lang['strshowallindexes'] = 'Mostrar Todos los �ndices';
	$lang['strnoindex'] = 'No se encontr� el �ndice.';
	$lang['strnoindexes'] = 'No se encontraron �ndices.';
	$lang['strcreateindex'] = 'Crear �ndice';
	$lang['strindexname'] = 'Nombre del �ndice';
	$lang['strtabname'] = 'Tab Name';
	$lang['strcolumnname'] = 'Nombre de Columna';
	$lang['strindexneedsname'] = 'Debe darle un nombre al �ndice';
	$lang['strindexneedscols'] = 'Los �ndices requieren un n�mero v�lido de columnas.';
	$lang['strindexcreated'] = '�ndice creado';
	$lang['strindexcreatedbad'] = 'Fall� al crear el �ndice.';
	$lang['strconfdropindex'] = '�Est� seguro que quiere eliminar el �ndice "%s"?';
	$lang['strindexdropped'] = '�ndice eliminado.';
	$lang['strindexdroppedbad'] = 'Fall� al eliminar el �ndice.';
	$lang['strkeyname'] = 'Nombre de la llave';
	$lang['struniquekey'] = 'Llave �nica';
	$lang['strprimarykey'] = 'Llave primaria';
 	$lang['strindextype'] = 'Tipo de �ndice';
	$lang['strindexname'] = 'Nombre del �ndice';
	$lang['strtablecolumnlist'] = 'Columnas en Tabla';
	$lang['strindexcolumnlist'] = 'Columnas en el �ndice';
	$lang['strconfcluster'] = 'Est� seguro que quiere ordenar la tabla "%s"?';
	$lang['strclusteredgood'] = 'Ordenado completo.';
	$lang['strclusteredbad'] = 'Fall� al ordenar tabla.';

	// Rules
	$lang['strrules'] = 'Reglas';
	$lang['strrule'] = 'Regla';
	$lang['strshowallrules'] = 'Mostrar todas las reglas';
	$lang['strnorule'] = 'No se encontr� la regla.';
	$lang['strnorules'] = 'No se encontraron reglas.';
	$lang['strcreaterule'] = 'Crear regla';
	$lang['strrulename'] = 'Nombre de regla';
	$lang['strruleneedsname'] = 'Debe darle un nombre a la regla.';
	$lang['strrulecreated'] = 'Regla creada.';
	$lang['strrulecreatedbad'] = 'Fall� al crear la regla.';
	$lang['strconfdroprule'] = '�Est� seguro que quiere eliminar la regla "%s" en "%s"?';
	$lang['strruledropped'] = 'Regla eliminada.';
	$lang['strruledroppedbad'] = 'Fall� al eliminar la regla.';

	// Constraints
	$lang['strconstraints'] = 'Restricci�n';
	$lang['strshowallconstraints'] = 'Mostrar todas las restricciones';
	$lang['strnoconstraints'] = 'No se encontraron restricciones.';
	$lang['strcreateconstraint'] = 'Crear Restricci�n';
	$lang['strconstraintcreated'] = 'Restricci�n creada.';
	$lang['strconstraintcreatedbad'] = 'Fall� al crear la Restricci�n.';
	$lang['strconfdropconstraint'] = '�Est� seguro que quiere eliminar la restricci�n "%s" de "%s"?';
	$lang['strconstraintdropped'] = 'Restricci�n eliminada.';
	$lang['strconstraintdroppedbad'] = 'Fall� al eliminar la restricci�n.';
	$lang['straddcheck'] = 'Agregar chequeo';
	$lang['strcheckneedsdefinition'] = 'Restricci�n de chequeo necesita una definici�n.';
	$lang['strcheckadded'] = 'Restricci�n de chequeo agregada.';
	$lang['strcheckaddedbad'] = 'Fall� al intentar agregar restricci�n de chequeo.';
	$lang['straddpk'] = 'Agregar llave primaria';
	$lang['strpkneedscols'] = 'Llave primaria necesita al menos un campo.';
	$lang['strpkadded'] = 'Llave primaria agregada.';
	$lang['strpkaddedbad'] = 'Fall� al intentar crear la llave primaria.';
	$lang['stradduniq'] = 'Agregar llave �nica';
	$lang['struniqneedscols'] = 'Llave �nica necesita al menos un campo.';
	$lang['struniqadded'] = 'Agregar llave �nica.';
	$lang['struniqaddedbad'] = 'Fall� al intentar agregar la llave �nica.';
	$lang['straddfk'] = 'Agregar referencia';
	$lang['strfkneedscols'] = 'Referencia necesita al menos un campo.';
	$lang['strfkneedstarget'] = 'Referencia necesita una tabla para referenciar.';
	$lang['strfkadded'] = 'Referencia agregada.';
	$lang['strfkaddedbad'] = 'Fall� al agregar la referencia.';
	$lang['strfktarget'] = 'Tabla de destino';
	$lang['strfkcolumnlist'] = 'Campos en la llave';
	$lang['strondelete'] = 'AL ELIMINAR';
	$lang['stronupdate'] = 'AL ACTUALIZAR';

	// Functions
	$lang['strfunction'] = 'Funci�n';
	$lang['strfunctions'] = 'Funciones';
	$lang['strshowallfunctions'] = 'Mostrar todas las funciones';
	$lang['strnofunction'] = 'No se encontr� la funci�n.';
	$lang['strnofunctions'] = 'No se encontraron funciones.';
	$lang['strcreatefunction'] = 'Crear funci�n';
	$lang['strfunctionname'] = 'Nombre de la funci�n';
	$lang['strreturns'] = 'Devuelve';
	$lang['strarguments'] = 'Argumentos';
        $lang['strproglanguage'] = 'Lenguaje de programaci�n';
	$lang['strfunctionneedsname'] = 'Debe darle un nombre a la funci�n.';
	$lang['strfunctionneedsdef'] = 'Debe darle una definici�n a la funci�n.';
	$lang['strfunctioncreated'] = 'Funci�n creada.';
	$lang['strfunctioncreatedbad'] = 'Fall� la creaci�n de la funci�n.';
	$lang['strconfdropfunction'] = '�Est� seguro que quiere eliminar la funci�n "%s"?';
	$lang['strfunctiondropped'] = 'Funci�n eliminada.';
	$lang['strfunctiondroppedbad'] = 'Fall� al eliminar la funci�n.';
	$lang['strfunctionupdated'] = 'Funci�n actualizada.';
	$lang['strfunctionupdatedbad'] = 'Fall� al actualizar la funci�n.';

	// Triggers
	$lang['strtrigger'] = 'Disparador';
	$lang['strtriggers'] = 'Disparadores';
	$lang['strshowalltriggers'] = 'Mostrar todos los disparadores';
	$lang['strnotrigger'] = 'No se encontr� el disparador.';
	$lang['strnotriggers'] = 'No se encontraron disparadores.';
	$lang['strcreatetrigger'] = 'Crear Disparador';
	$lang['strtriggerneedsname'] = 'Debe darle un nombre al disparador.';
	$lang['strtriggerneedsfunc'] = 'Debe especificar una funci�n para el disparador.';
	$lang['strtriggercreated'] = 'Disparador creado.';
	$lang['strtriggercreatedbad'] = 'Fall� la creaci�n del disparador.';
	$lang['strconfdroptrigger'] = '�Est� seguro que quiere eliminar el disparador "%s" en "%s"?';
        $lang['strtriggeraltered'] = 'Disparador modificado.';
        $lang['strtriggeralteredbad'] = 'Fall� la modificaci�n del disparador.';
	$lang['strtriggerdropped'] = 'Disparador eliminado.';
	$lang['strtriggerdroppedbad'] = 'Fall� al eliminar el disparador.';

	// Types
	$lang['strtype'] = 'Tipo';
	$lang['strtypes'] = 'Tipos';
	$lang['strshowalltypes'] = 'Mostrar todos los tipos';
	$lang['strnotype'] = 'No se encontro el tipo.';
	$lang['strnotypes'] = 'No se encontraron tipos.';
	$lang['strcreatetype'] = 'Crear Tipo';
	$lang['strtypename'] = 'Nombre del tipo';
	$lang['strinputfn'] = 'Funci�n de entrada';
	$lang['stroutputfn'] = 'Funci�n de salida';
	$lang['strpassbyval'] = '�Pasar valor?';
	$lang['stralignment'] = 'Alineamiento';
	$lang['strelement'] = 'Elemento';
	$lang['strdelimiter'] = 'Delimitador';
	$lang['strstorage'] = 'Almacenamiento';
	$lang['strtypeneedsname'] = 'Debe especificar un nombre para el tipo.';
	$lang['strtypeneedslen'] = 'Debe especificar una longitud para el tipo.';
	$lang['strtypecreated'] = 'Tipo creado';
	$lang['strtypecreatedbad'] = 'Fall� al crear el tipo.';
	$lang['strconfdroptype'] = '�Est� seguro que quiere eliminar el tipo "%s"?';
	$lang['strtypedropped'] = 'Tipo eliminado.';
	$lang['strtypedroppedbad'] = 'Fall� al eliminar el tipo.';

	// Schemas
	$lang['strschema'] = 'Esquema';
	$lang['strschemas'] = 'Esquemas';
	$lang['strshowallschemas'] = 'Mostrar Todos los Esquemas';
	$lang['strnoschema'] = 'No se encontr� el esquema.';
	$lang['strnoschemas'] = 'No se encontraron esquemas.';
	$lang['strcreateschema'] = 'Crear Esquema';
	$lang['strschemaname'] = 'Nombre del esquema';
	$lang['strschemaneedsname'] = 'Debe especificar un nombre para el esquema.';
	$lang['strschemacreated'] = 'Esquema creado';
	$lang['strschemacreatedbad'] = 'Fall� al crear el esquema.';
	$lang['strconfdropschema'] = '�Est� seguro que quiere eliminar el esquema "%s"?';
	$lang['strschemadropped'] = 'Esquema eliminado.';
	$lang['strschemadroppedbad'] = 'Fall� al eliminar el esquema.';

	// Reports
	$lang['strreport'] = 'Reporte';
	$lang['strreports'] = 'Reportes';
	$lang['strshowallreports'] = 'Mostrar todos los reportes';
	$lang['strnoreports'] = 'No se encontro el reporte.';
	$lang['strcreatereport'] = 'Crear Reporte';
	$lang['strreportdropped'] = 'Reporte eliminado.';
	$lang['strreportdroppedbad'] = 'Fall� al eliminar el Reporte.';
	$lang['strconfdropreport'] = '�Est� seguro que quiere eliminar el reporte "%s"?';
	$lang['strreportneedsname'] = 'Debe especificar un nombre para el reporte.';
	$lang['strreportneedsdef'] = 'Debe especificar un SQL para el reporte.';
	$lang['strreportcreated'] = 'Reporte guardado.';
	$lang['strreportcreatedbad'] = 'Fall� al guardar el reporte.';
	$lang['strdomain'] = 'Domain';
	$lang['strdomains'] = 'Domains';
	$lang['strshowalldomains'] = 'Show all domains';
	$lang['strnodomains'] = 'No domains found.';
	$lang['strcreatedomain'] = 'Create Domain';
	$lang['strdomaindropped'] = 'Domain dropped.';
	$lang['strdomaindroppedbad'] = 'Domain drop failed.';
	$lang['strconfdropdomain'] = 'Are you sure you want to drop the domain "%s"?';
	$lang['strdomainneedsname'] = 'You must give a name for your domain.';
	$lang['strdomaincreated'] = 'Domain created.';
	$lang['strdomaincreatedbad'] = 'Failed to create domain.';
	$lang['strdomainaltered'] = 'Domain altered.';
	$lang['strdomainalteredbad'] = 'Failed to alter domain.';

	// Operators
        $lang['stroperator'] = 'Operador';
	$lang['stroperators'] = 'Operadores';
	$lang['strshowalloperators'] = 'Mostrar todos los operadoress';
	$lang['strnooperator'] = 'No se encontr� el operador.';
	$lang['strnooperators'] = 'No se encontraron operadores.';
	$lang['strcreateoperator'] = 'Crear Operador';
	$lang['strleftarg'] = 'Tipo de datos del arg. izquierdo';
	$lang['strrightarg'] = 'Tipo de datos del arg. derecho';
	$lang['strcommutator'] = 'Conmutador';
	$lang['strnegator'] = 'Negaci�n';
	$lang['strrestrict'] = 'Restringir';
	$lang['strjoin'] = 'Uni�n';
	$lang['strhashes'] = 'Hashes';
	$lang['strmerges'] = 'Fusiones';
	$lang['strleftsort'] = 'Ordenado izquierdo';
	$lang['strrightsort'] = 'Ordenado derecho';
	$lang['strlessthan'] = 'Menor que';
	$lang['strgreaterthan'] = 'Mayor que';
	$lang['stroperatorneedsname'] = 'Debe darle un nombre al operador.';
	$lang['stroperatorcreated'] = 'Operador creado';
	$lang['stroperatorcreatedbad'] = 'Fall� al intentar crear el operador.';
	$lang['strconfdropoperator'] = '�Est� seguro que quiere eliminar el operador "%s"?';
	$lang['stroperatordropped'] = 'Operador eliminado.';
	$lang['stroperatordroppedbad'] = 'Fall� al intentar eliminar el operador.';

	// Casts
	$lang['strcasts'] = 'Casts';
	$lang['strnocasts'] = 'No casts found.';
	$lang['strsourcetype'] = 'Source type';
	$lang['strtargettype'] = 'Target type';
	$lang['strimplicit'] = 'Implicito';
	$lang['strinassignment'] = 'En asignaci�n';
	$lang['strbinarycompat'] = '(Compatible con binario)';

	// Conversions
	$lang['strconversions'] = 'Conversiones';
	$lang['strnoconversions'] = 'No se encontraron conversiones.';
	$lang['strsourceencoding'] = 'Source encoding';
	$lang['strtargetencoding'] = 'Target encoding';

	// Languages
	$lang['strlanguages'] = 'Lenguajes';
	$lang['strnolanguages'] = 'No se encontraron lenguajes.';
	$lang['strtrusted'] = 'Trusted';

	// Info
	$lang['strnoinfo'] = 'No hay informaci�n disponible.';
	$lang['strreferringtables'] = 'Referring tables';
	$lang['strparenttables'] = 'Parent tables';
	$lang['strchildtables'] = 'Child tables';

	// Miscellaneous
	$lang['strtopbar'] = '%s corriendo en %s:%s -- Usted est� logueado con usuario "%s", %s';
	$lang['strtimefmt'] = 'd/m/Y, G:i:s';
	$lang['strhelp'] = 'Ayuda';

?>
