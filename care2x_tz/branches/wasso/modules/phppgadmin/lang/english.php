<?php

	/**
	 * English language file for phpPgAdmin.  Use this as a basis
	 * for new translations.
	 *
	 * $Id: english.php,v 1.1 2006/01/13 13:42:16 irroal Exp $
	 */

	// Language and character set
	$lang['applang'] = 'English';
	$lang['appcharset'] = 'ISO-8859-1';
	$lang['applocale'] = 'en_US';
	$lang['appdbencoding'] = 'LATIN1';

	// Welcome  
	$lang['strintro'] = 'Welcome to phpPgAdmin.';
	$lang['strppahome'] = 'phpPgAdmin Homepage';
	$lang['strpgsqlhome'] = 'PostgreSQL Homepage';
	$lang['strpgsqlhome_url'] = 'http://www.postgresql.org/';
	$lang['strlocaldocs'] = 'PostgreSQL Documentation (local)';
	$lang['strreportbug'] = 'Report a Bug';
	$lang['strviewfaq'] = 'View FAQ';
	$lang['strviewfaq_url'] = 'http://phppgadmin.sourceforge.net/?page=faq';
	
	// Basic strings
	$lang['strlogin'] = 'Login';
	$lang['strloginfailed'] = 'Login failed';
	$lang['strlogindisallowed'] = 'Login disallowed';
	$lang['strserver'] = 'Server';
	$lang['strlogout'] = 'Logout';
	$lang['strowner'] = 'Owner';
	$lang['straction'] = 'Action';
	$lang['stractions'] = 'Actions';
	$lang['strname'] = 'Name';
	$lang['strdefinition'] = 'Definition';
	$lang['straggregates'] = 'Aggregates';
	$lang['strproperties'] = 'Properties';
	$lang['strbrowse'] = 'Browse';
	$lang['strdrop'] = 'Drop';
	$lang['strdropped'] = 'Dropped';
	$lang['strnull'] = 'Null';
	$lang['strnotnull'] = 'Not Null';
	$lang['strprev'] = '< Prev';
	$lang['strnext'] = 'Next >';
	$lang['strfirst'] = '<< First';
	$lang['strlast'] = 'Last >>';
	$lang['strfailed'] = 'Failed';
	$lang['strcreate'] = 'Create';
	$lang['strcreated'] = 'Created';
	$lang['strcomment'] = 'Comment';
	$lang['strlength'] = 'Length';
	$lang['strdefault'] = 'Default';
	$lang['stralter'] = 'Alter';
	$lang['strok'] = 'OK';
	$lang['strcancel'] = 'Cancel';
	$lang['strsave'] = 'Save';
	$lang['strreset'] = 'Reset';
	$lang['strinsert'] = 'Insert';
	$lang['strselect'] = 'Select';
	$lang['strdelete'] = 'Delete';
	$lang['strupdate'] = 'Update';
	$lang['strreferences'] = 'References';
	$lang['stryes'] = 'Yes';
	$lang['strno'] = 'No';
	$lang['strtrue'] = 'TRUE';
	$lang['strfalse'] = 'FALSE';
	$lang['stredit'] = 'Edit';
	$lang['strcolumns'] = 'Columns';
	$lang['strrows'] = 'row(s)';
	$lang['strrowsaff'] = 'row(s) affected.';
	$lang['strobjects'] = 'object(s)';
	$lang['strexample'] = 'eg.';
	$lang['strback'] = 'Back';
	$lang['strqueryresults'] = 'Query Results';
	$lang['strshow'] = 'Show';
	$lang['strempty'] = 'Empty';
	$lang['strlanguage'] = 'Language';
	$lang['strencoding'] = 'Encoding';
	$lang['strvalue'] = 'Value';
	$lang['strunique'] = 'Unique';
	$lang['strprimary'] = 'Primary';
	$lang['strexport'] = 'Export';
	$lang['strimport'] = 'Import';
	$lang['strsql'] = 'SQL';
	$lang['strgo'] = 'Go';
	$lang['stradmin'] = 'Admin';
	$lang['strvacuum'] = 'Vacuum';
	$lang['stranalyze'] = 'Analyze';
	$lang['strcluster'] = 'Cluster';
	$lang['strclustered'] = 'Clustered?';
	$lang['strreindex'] = 'Reindex';
	$lang['strrun'] = 'Run';
	$lang['stradd'] = 'Add';
	$lang['strevent'] = 'Event';
	$lang['strwhere'] = 'Where';
	$lang['strinstead'] = 'Do Instead';
	$lang['strwhen'] = 'When';
	$lang['strformat'] = 'Format';
	$lang['strdata'] = 'Data';
	$lang['strconfirm'] = 'Confirm';
	$lang['strexpression'] = 'Expression';
	$lang['strellipsis'] = '...';
	$lang['strexpand'] = 'Expand';
	$lang['strcollapse'] = 'Collapse';
	$lang['strexplain'] = 'Explain';
	$lang['strfind'] = 'Find';
	$lang['stroptions'] = 'Options';
	$lang['strrefresh'] = 'Refresh';
	$lang['strdownload'] = 'Download';
	$lang['strinfo'] = 'Info';
	$lang['stroids'] = 'OIDs';
	$lang['stradvanced'] = 'Advanced';

	// Error handling
	$lang['strnoframes'] = 'You need a frames-enabled browser to use this application.';
	$lang['strbadconfig'] = 'Your config.inc.php is out of date. You will need to regenerate it from the new config.inc.php-dist.';
	$lang['strnotloaded'] = 'Your PHP installation does not support PostgreSQL. You need to recompile PHP using the --with-pgsql configure option.';
	$lang['strbadschema'] = 'Invalid schema specified.';
	$lang['strbadencoding'] = 'Failed to set client encoding in database.';
	$lang['strsqlerror'] = 'SQL error:';
	$lang['strinstatement'] = 'In statement:';
	$lang['strinvalidparam'] = 'Invalid script parameters.';
	$lang['strnodata'] = 'No rows found.';
	$lang['strnoobjects'] = 'No objects found.';
	$lang['strrownotunique'] = 'No unique identifier for this row.';

	// Tables
	$lang['strtable'] = 'Table';
	$lang['strtables'] = 'Tables';
	$lang['strshowalltables'] = 'Show all tables';
	$lang['strnotables'] = 'No tables found.';
	$lang['strnotable'] = 'No table found.';
	$lang['strcreatetable'] = 'Create table';
	$lang['strtablename'] = 'Table name';
	$lang['strtableneedsname'] = 'You must give a name for your table.';
	$lang['strtableneedsfield'] = 'You must specify at least one field.';
	$lang['strtableneedscols'] = 'Tables require a valid number of columns.';
	$lang['strtablecreated'] = 'Table created.';
	$lang['strtablecreatedbad'] = 'Table creation failed.';
	$lang['strconfdroptable'] = 'Are you sure you want to drop the table "%s"?';
	$lang['strtabledropped'] = 'Table dropped.';
	$lang['strtabledroppedbad'] = 'Table drop failed.';
	$lang['strconfemptytable'] = 'Are you sure you want to empty the table "%s"?';
	$lang['strtableemptied'] = 'Table emptied.';
	$lang['strtableemptiedbad'] = 'Table empty failed.';
	$lang['strinsertrow'] = 'Insert Row';
	$lang['strrowinserted'] = 'Row inserted.';
	$lang['strrowinsertedbad'] = 'Row insert failed.';
	$lang['streditrow'] = 'Edit Row';
	$lang['strrowupdated'] = 'Row updated.';
	$lang['strrowupdatedbad'] = 'Row update failed.';
	$lang['strdeleterow'] = 'Delete Row';
	$lang['strconfdeleterow'] = 'Are you sure you want to delete this row?';
	$lang['strrowdeleted'] = 'Row deleted.';
	$lang['strrowdeletedbad'] = 'Row deletion failed.';
	$lang['strsaveandrepeat'] = 'Insert & Repeat';
	$lang['strfield'] = 'Field';
	$lang['strfields'] = 'Fields';
	$lang['strnumfields'] = 'Num. Of Fields';
	$lang['strfieldneedsname'] = 'You must name your field.';
	$lang['strselectallfields'] = 'Select all fields';
	$lang['strselectneedscol'] = 'You must show at least one column.';
	$lang['strselectunary'] = 'Unary operators cannot have values.';
	$lang['straltercolumn'] = 'Alter Column';
	$lang['strcolumnaltered'] = 'Column altered.';
	$lang['strcolumnalteredbad'] = 'Column altering failed.';
	$lang['strconfdropcolumn'] = 'Are you sure you want to drop column "%s" from table "%s"?';
	$lang['strcolumndropped'] = 'Column dropped.';
	$lang['strcolumndroppedbad'] = 'Column drop failed.';
	$lang['straddcolumn'] = 'Add column';
	$lang['strcolumnadded'] = 'Column added.';
	$lang['strcolumnaddedbad'] = 'Column add failed.';
	$lang['strdataonly'] = 'Data Only';
	$lang['strcascade'] = 'CASCADE';
	$lang['strtablealtered'] = 'Table altered.';
	$lang['strtablealteredbad'] = 'Table alteration failed.';
	$lang['strdataonly'] = 'Data only';
	$lang['strstructureonly'] = 'Structure only';
	$lang['strstructureanddata'] = 'Structure and data';

	// Users
	$lang['struser'] = 'User';
	$lang['strusers'] = 'Users';
	$lang['strusername'] = 'Username';
	$lang['strpassword'] = 'Password';
	$lang['strsuper'] = 'Superuser?';
	$lang['strcreatedb'] = 'Create DB?';
	$lang['strexpires'] = 'Expires';
	$lang['strnousers'] = 'No users found.';
	$lang['struserupdated'] = 'User updated.';
	$lang['struserupdatedbad'] = 'User update failed.';
	$lang['strshowallusers'] = 'Show all users';
	$lang['strcreateuser'] = 'Create user';
	$lang['struserneedsname'] = 'You must give a name for your user.';
	$lang['strusercreated'] = 'User created.';
	$lang['strusercreatedbad'] = 'Failed to create user.';
	$lang['strconfdropuser'] = 'Are you sure you want to drop the user "%s"?';
	$lang['struserdropped'] = 'User dropped.';
	$lang['struserdroppedbad'] = 'Failed to drop user.';
	$lang['straccount'] = 'Account';
	$lang['strchangepassword'] = 'Change Password';
	$lang['strpasswordchanged'] = 'Password changed.';
	$lang['strpasswordchangedbad'] = 'Failed to change password.';
	$lang['strpasswordshort'] = 'Password is too short.';
	$lang['strpasswordconfirm'] = 'Password does not match confirmation.';
	
	// Groups
	$lang['strgroup'] = 'Group';
	$lang['strgroups'] = 'Groups';
	$lang['strnogroup'] = 'Group not found.';
	$lang['strnogroups'] = 'No groups found.';
	$lang['strcreategroup'] = 'Create group';
	$lang['strshowallgroups'] = 'Show all groups';
	$lang['strgroupneedsname'] = 'You must give a name for your group.';
	$lang['strgroupcreated'] = 'Group created.';
	$lang['strgroupcreatedbad'] = 'Group creation failed.';	
	$lang['strconfdropgroup'] = 'Are you sure you want to drop the group "%s"?';
	$lang['strgroupdropped'] = 'Group dropped.';
	$lang['strgroupdroppedbad'] = 'Group drop failed.';
	$lang['strmembers'] = 'Members';
	$lang['straddmember'] = 'Add member';
	$lang['strmemberadded'] = 'Member added.';
	$lang['strmemberaddedbad'] = 'Member add failed.';
	$lang['strdropmember'] = 'Drop member';
	$lang['strconfdropmember'] = 'Are you sure you want to drop the member "%s" from the group "%s"?';
	$lang['strmemberdropped'] = 'Member dropped.';
	$lang['strmemberdroppedbad'] = 'Member drop failed.';

	// Privileges
	$lang['strprivilege'] = 'Privilege';
	$lang['strprivileges'] = 'Privileges';
	$lang['strnoprivileges'] = 'This object has default owner privileges.';
	$lang['strgrant'] = 'Grant';
	$lang['strrevoke'] = 'Revoke';
	$lang['strgranted'] = 'Privileges changed.';
	$lang['strgrantfailed'] = 'Failed to change privileges.';
	$lang['strgrantbad'] = 'You must specify at least one user or group and at least one privilege.';
	$lang['stralterprivs'] = 'Alter Privileges';
	$lang['strgrantor'] = 'Grantor';
	$lang['strasterisk'] = '*';

	// Databases
	$lang['strdatabase'] = 'Database';
	$lang['strdatabases'] = 'Databases';
	$lang['strshowalldatabases'] = 'Show all databases';
	$lang['strnodatabase'] = 'No database found.';
	$lang['strnodatabases'] = 'No databases found.';
	$lang['strcreatedatabase'] = 'Create database';
	$lang['strdatabasename'] = 'Database name';
	$lang['strdatabaseneedsname'] = 'You must give a name for your database.';
	$lang['strdatabasecreated'] = 'Database created.';
	$lang['strdatabasecreatedbad'] = 'Database creation failed.';
	$lang['strconfdropdatabase'] = 'Are you sure you want to drop the database "%s"?';
	$lang['strdatabasedropped'] = 'Database dropped.';
	$lang['strdatabasedroppedbad'] = 'Database drop failed.';
	$lang['strentersql'] = 'Enter the SQL to execute below:';
	$lang['strsqlexecuted'] = 'SQL executed.';
	$lang['strvacuumgood'] = 'Vacuum complete.';
	$lang['strvacuumbad'] = 'Vacuum failed.';
	$lang['stranalyzegood'] = 'Analyze complete.';
	$lang['stranalyzebad'] = 'Analyze failed.';

	// Views
	$lang['strview'] = 'View';
	$lang['strviews'] = 'Views';
	$lang['strshowallviews'] = 'Show all views';
	$lang['strnoview'] = 'No view found.';
	$lang['strnoviews'] = 'No views found.';
	$lang['strcreateview'] = 'Create view';
	$lang['strviewname'] = 'View name';
	$lang['strviewneedsname'] = 'You must give a name for your view.';
	$lang['strviewneedsdef'] = 'You must give a definition for your view.';
	$lang['strviewcreated'] = 'View created.';
	$lang['strviewcreatedbad'] = 'View creation failed.';
	$lang['strconfdropview'] = 'Are you sure you want to drop the view "%s"?';
	$lang['strviewdropped'] = 'View dropped.';
	$lang['strviewdroppedbad'] = 'View drop failed.';
	$lang['strviewupdated'] = 'View updated.';
	$lang['strviewupdatedbad'] = 'View update failed.';

	// Sequences
	$lang['strsequence'] = 'Sequence';
	$lang['strsequences'] = 'Sequences';
	$lang['strshowallsequences'] = 'Show all sequences';
	$lang['strnosequence'] = 'No sequence found.';
	$lang['strnosequences'] = 'No sequences found.';
	$lang['strcreatesequence'] = 'Create sequence';
	$lang['strlastvalue'] = 'Last value';
	$lang['strincrementby'] = 'Increment by';	
	$lang['strstartvalue'] = 'Start value';
	$lang['strmaxvalue'] = 'Max value';
	$lang['strminvalue'] = 'Min value';
	$lang['strcachevalue'] = 'Cache value';
	$lang['strlogcount'] = 'Log count';
	$lang['striscycled'] = 'Is cycled?';
	$lang['striscalled'] = 'Is called?';
	$lang['strsequenceneedsname'] = 'You must specify a name for your sequence.';
	$lang['strsequencecreated'] = 'Sequence created.';
	$lang['strsequencecreatedbad'] = 'Sequence creation failed.'; 
	$lang['strconfdropsequence'] = 'Are you sure you want to drop sequence "%s"?';
	$lang['strsequencedropped'] = 'Sequence dropped.';
	$lang['strsequencedroppedbad'] = 'Sequence drop failed.';
	$lang['strsequencereset'] = 'Sequence reset.';
	$lang['strsequenceresetbad'] = 'Sequence reset failed.'; 

	// Indexes
	$lang['strindexes'] = 'Indexes';
	$lang['strindexname'] = 'Index Name';
	$lang['strshowallindexes'] = 'Show all indexes';
	$lang['strnoindex'] = 'No index found.';
	$lang['strnoindexes'] = 'No indexes found.';
	$lang['strcreateindex'] = 'Create index';
	$lang['strtabname'] = 'Tab name';
	$lang['strcolumnname'] = 'Column name';
	$lang['strindexneedsname'] = 'You must give a name for your index.';
	$lang['strindexneedscols'] = 'Indexes require a valid number of columns.';
	$lang['strindexcreated'] = 'Index created';
	$lang['strindexcreatedbad'] = 'Index creation failed.';
	$lang['strconfdropindex'] = 'Are you sure you want to drop the index "%s"?';
	$lang['strindexdropped'] = 'Index dropped.';
	$lang['strindexdroppedbad'] = 'Index drop failed.';
	$lang['strkeyname'] = 'Key name';
	$lang['struniquekey'] = 'Unique key';
	$lang['strprimarykey'] = 'Primary key';
 	$lang['strindextype'] = 'Type of index';
	$lang['strtablecolumnlist'] = 'Columns in table';
	$lang['strindexcolumnlist'] = 'Columns in index';
	$lang['strconfcluster'] = 'Are you sure you want to cluster "%s"?';
	$lang['strclusteredgood'] = 'Cluster complete.';
	$lang['strclusteredbad'] = 'Cluster failed.';

	// Rules
	$lang['strrules'] = 'Rules';
	$lang['strrule'] = 'Rule';
	$lang['strshowallrules'] = 'Show all rules';
	$lang['strnorule'] = 'No rule found.';
	$lang['strnorules'] = 'No rules found.';
	$lang['strcreaterule'] = 'Create rule';
	$lang['strrulename'] = 'Rule name';
	$lang['strruleneedsname'] = 'You must specify a name for your rule.';
	$lang['strrulecreated'] = 'Rule created.';
	$lang['strrulecreatedbad'] = 'Rule creation failed.';
	$lang['strconfdroprule'] = 'Are you sure you want to drop the rule "%s" on "%s"?';
	$lang['strruledropped'] = 'Rule dropped.';
	$lang['strruledroppedbad'] = 'Rule drop failed.';

	// Constraints
	$lang['strconstraints'] = 'Constraints';
	$lang['strshowallconstraints'] = 'Show all constraints';
	$lang['strnoconstraints'] = 'No constraints found.';
	$lang['strcreateconstraint'] = 'Create constraint';
	$lang['strconstraintcreated'] = 'Constraint created.';
	$lang['strconstraintcreatedbad'] = 'Constraint creation failed.';
	$lang['strconfdropconstraint'] = 'Are you sure you want to drop the constraint "%s" on "%s"?';
	$lang['strconstraintdropped'] = 'Constraint dropped.';
	$lang['strconstraintdroppedbad'] = 'Constraint drop failed.';
	$lang['straddcheck'] = 'Add check';
	$lang['strcheckneedsdefinition'] = 'Check constraint needs a definition.';
	$lang['strcheckadded'] = 'Check constraint added.';
	$lang['strcheckaddedbad'] = 'Failed to add check constraint.';
	$lang['straddpk'] = 'Add primary key';
	$lang['strpkneedscols'] = 'Primary key requires at least one column.';
	$lang['strpkadded'] = 'Primary key added.';
	$lang['strpkaddedbad'] = 'Failed to add primary key.';
	$lang['stradduniq'] = 'Add unique key';
	$lang['struniqneedscols'] = 'Unique key requires at least one column.';
	$lang['struniqadded'] = 'Unique key added.';
	$lang['struniqaddedbad'] = 'Failed to add unique key.';
	$lang['straddfk'] = 'Add foreign key';
	$lang['strfkneedscols'] = 'Foreign key requires at least one column.';
	$lang['strfkneedstarget'] = 'Foreign key requires a target table.';
	$lang['strfkadded'] = 'Foreign key added.';
	$lang['strfkaddedbad'] = 'Failed to add foreign key.';
	$lang['strfktarget'] = 'Target table';
	$lang['strfkcolumnlist'] = 'Columns in key';
	$lang['strondelete'] = 'ON DELETE';
	$lang['stronupdate'] = 'ON UPDATE';

	// Functions
	$lang['strfunction'] = 'Function';
	$lang['strfunctions'] = 'Functions';
	$lang['strshowallfunctions'] = 'Show all functions';
	$lang['strnofunction'] = 'No function found.';
	$lang['strnofunctions'] = 'No functions found.';
	$lang['strcreatefunction'] = 'Create function';
	$lang['strfunctionname'] = 'Function name';
	$lang['strreturns'] = 'Returns';
	$lang['strarguments'] = 'Arguments';
	$lang['strproglanguage'] = 'Programming language';
	$lang['strfunctionneedsname'] = 'You must give a name for your function.';
	$lang['strfunctionneedsdef'] = 'You must give a definition for your function.';
	$lang['strfunctioncreated'] = 'Function created.';
	$lang['strfunctioncreatedbad'] = 'Function creation failed.';
	$lang['strconfdropfunction'] = 'Are you sure you want to drop the function "%s"?';
	$lang['strfunctiondropped'] = 'Function dropped.';
	$lang['strfunctiondroppedbad'] = 'Function drop failed.';
	$lang['strfunctionupdated'] = 'Function updated.';
	$lang['strfunctionupdatedbad'] = 'Function update failed.';

	// Triggers
	$lang['strtrigger'] = 'Trigger';
	$lang['strtriggers'] = 'Triggers';
	$lang['strshowalltriggers'] = 'Show all triggers';
	$lang['strnotrigger'] = 'No trigger found.';
	$lang['strnotriggers'] = 'No triggers found.';
	$lang['strcreatetrigger'] = 'Create trigger';
	$lang['strtriggerneedsname'] = 'You must specify a name for your trigger.';
	$lang['strtriggerneedsfunc'] = 'You must specify a function for your trigger.';
	$lang['strtriggercreated'] = 'Trigger created.';
	$lang['strtriggercreatedbad'] = 'Trigger creation failed.';
	$lang['strconfdroptrigger'] = 'Are you sure you want to drop the trigger "%s" on "%s"?';
	$lang['strtriggerdropped'] = 'Trigger dropped.';
	$lang['strtriggerdroppedbad'] = 'Trigger drop failed.';
	$lang['strtriggeraltered'] = 'Trigger altered.';
	$lang['strtriggeralteredbad'] = 'Trigger alter failed.';

	// Types
	$lang['strtype'] = 'Type';
	$lang['strtypes'] = 'Types';
	$lang['strshowalltypes'] = 'Show all types';
	$lang['strnotype'] = 'No type found.';
	$lang['strnotypes'] = 'No types found.';
	$lang['strcreatetype'] = 'Create type';
	$lang['strtypename'] = 'Type name';
	$lang['strinputfn'] = 'Input function';
	$lang['stroutputfn'] = 'Output function';
	$lang['strpassbyval'] = 'Passed by val?';
	$lang['stralignment'] = 'Alignment';
	$lang['strelement'] = 'Element';
	$lang['strdelimiter'] = 'Delimiter';
	$lang['strstorage'] = 'Storage';
	$lang['strtypeneedsname'] = 'You must give a name for your type.';
	$lang['strtypeneedslen'] = 'You must give a length for your type.';
	$lang['strtypecreated'] = 'Type created';
	$lang['strtypecreatedbad'] = 'Type creation failed.';
	$lang['strconfdroptype'] = 'Are you sure you want to drop the type "%s"?';
	$lang['strtypedropped'] = 'Type dropped.';
	$lang['strtypedroppedbad'] = 'Type drop failed.';

	// Schemas
	$lang['strschema'] = 'Schema';
	$lang['strschemas'] = 'Schemas';
	$lang['strshowallschemas'] = 'Show all schemas';
	$lang['strnoschema'] = 'No schema found.';
	$lang['strnoschemas'] = 'No schemas found.';
	$lang['strcreateschema'] = 'Create schema';
	$lang['strschemaname'] = 'Schema name';
	$lang['strschemaneedsname'] = 'You must give a name for your schema.';
	$lang['strschemacreated'] = 'Schema created';
	$lang['strschemacreatedbad'] = 'Schema creation failed.';
	$lang['strconfdropschema'] = 'Are you sure you want to drop the schema "%s"?';
	$lang['strschemadropped'] = 'Schema dropped.';
	$lang['strschemadroppedbad'] = 'Schema drop failed.';

	// Reports
	$lang['strreport'] = 'Report';
	$lang['strreports'] = 'Reports';
	$lang['strshowallreports'] = 'Show all reports';
	$lang['strnoreports'] = 'No reports found.';
	$lang['strcreatereport'] = 'Create report';
	$lang['strreportdropped'] = 'Report dropped.';
	$lang['strreportdroppedbad'] = 'Report drop failed.';
	$lang['strconfdropreport'] = 'Are you sure you want to drop the report "%s"?';
	$lang['strreportneedsname'] = 'You must give a name for your report.';
	$lang['strreportneedsdef'] = 'You must give SQL for your report.';
	$lang['strreportcreated'] = 'Report saved.';
	$lang['strreportcreatedbad'] = 'Failed to save report.';

	// Domains
	$lang['strdomain'] = 'Domain';
	$lang['strdomains'] = 'Domains';
	$lang['strshowalldomains'] = 'Show all domains';
	$lang['strnodomains'] = 'No domains found.';
	$lang['strcreatedomain'] = 'Create domain';
	$lang['strdomaindropped'] = 'Domain dropped.';
	$lang['strdomaindroppedbad'] = 'Domain drop failed.';
	$lang['strconfdropdomain'] = 'Are you sure you want to drop the domain "%s"?';
	$lang['strdomainneedsname'] = 'You must give a name for your domain.';
	$lang['strdomaincreated'] = 'Domain created.';
	$lang['strdomaincreatedbad'] = 'Failed to create domain.';	
	$lang['strdomainaltered'] = 'Domain altered.';
	$lang['strdomainalteredbad'] = 'Failed to alter domain.';	

	// Operators
	$lang['stroperator'] = 'Operator';
	$lang['stroperators'] = 'Operators';
	$lang['strshowalloperators'] = 'Show all operators';
	$lang['strnooperator'] = 'No operator found.';
	$lang['strnooperators'] = 'No operators found.';
	$lang['strcreateoperator'] = 'Create operator';
	$lang['strleftarg'] = 'Left Arg Type';
	$lang['strrightarg'] = 'Right Arg Type';
	$lang['strcommutator'] = 'Commutator';
	$lang['strnegator'] = 'Negator';
	$lang['strrestrict'] = 'Restrict';
	$lang['strjoin'] = 'Join';
	$lang['strhashes'] = 'Hashes';
	$lang['strmerges'] = 'Merges';
	$lang['strleftsort'] = 'Left sort';
	$lang['strrightsort'] = 'Right sort';
	$lang['strlessthan'] = 'Less than';
	$lang['strgreaterthan'] = 'Greater than';
	$lang['stroperatorneedsname'] = 'You must give a name for your operator.';
	$lang['stroperatorcreated'] = 'Operator created';
	$lang['stroperatorcreatedbad'] = 'Operator creation failed.';
	$lang['strconfdropoperator'] = 'Are you sure you want to drop the operator "%s"?';
	$lang['stroperatordropped'] = 'Operator dropped.';
	$lang['stroperatordroppedbad'] = 'Operator drop failed.';

	// Casts
	$lang['strcasts'] = 'Casts';
	$lang['strnocasts'] = 'No casts found.';
	$lang['strsourcetype'] = 'Source type';
	$lang['strtargettype'] = 'Target type';
	$lang['strimplicit'] = 'Implicit';
	$lang['strinassignment'] = 'In assignment';
	$lang['strbinarycompat'] = '(Binary compatible)';
	
	// Conversions
	$lang['strconversions'] = 'Conversions';
	$lang['strnoconversions'] = 'No conversions found.';
	$lang['strsourceencoding'] = 'Source encoding';
	$lang['strtargetencoding'] = 'Target encoding';
	
	// Languages
	$lang['strlanguages'] = 'Languages';
	$lang['strnolanguages'] = 'No languages found.';
	$lang['strtrusted'] = 'Trusted';
	
	// Info
	$lang['strnoinfo'] = 'No information available.';
	$lang['strreferringtables'] = 'Referring tables';
	$lang['strparenttables'] = 'Parent tables';
	$lang['strchildtables'] = 'Child tables';

	// Miscellaneous
	$lang['strtopbar'] = '%s running on %s:%s -- You are logged in as user "%s", %s';
	$lang['strtimefmt'] = 'jS M, Y g:iA';
	$lang['strhelp'] = 'Help';

?>
