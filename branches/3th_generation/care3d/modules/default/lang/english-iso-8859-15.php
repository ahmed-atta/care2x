<?php
    $defaultWords = array(
/*  HOME    */
        'Welcome to' => 'Welcome to',
        'Home' => 'Home',

/*  Publisher subnav */
       'Categories' => 'Categories',
       'Documents' => 'Documents',
       'Articles' => 'Articles',
       'Permissions' => 'Permissions',
       'No expire' => 'No expire',

/*  MODULE MGR  */
        'Module Manager' => 'Module Manager',
        'Module Manager :: Add' => 'Module Manager :: Add',
        'Module Manager :: Edit' => 'Module Manager :: Edit',
        'Refresh Module Listing' => 'Refresh Module Listing',
        'WARNING: This will drop your database' => 'WARNING: This will drop your database and create your Seagull environment from discovered data files. It will only work correctly if your current database user has full privileges, ie to drop and create databases.',
        'with sample data' => 'with sample data',
         'Maintainer' => 'Maintainer',
         'License' => 'License',
         'State' => 'Status',

/*  MODULE CONFIG MGR  */
        'Module Config Manager' => 'Module Config Manager',
        'Some errors occured. Please see following message(s)' => 'Some errors occured. Please see following message(s)',

/*  CONFIG MGR  */
        'Config Manager' => 'Config Manager',
        'config info successfully updated' => 'Config info successfully updated',
        'config info successfully updated but failed syncing sequences' => 'Config info successfully updated but failed syncing sequences',
        'Deny list' => 'Deny list',
        'Allow list' => 'Allow list',

/*  FOOTER  */
        'Execution Time' => 'Execution Time',
        'seconds' => 'seconds',
        'ms' => 'ms',
        'queries'=>'queries',
        'allocated'=>'allocated',
        'Powered by' => 'Powered by',
        'Seagull PHP Framework' => 'Seagull PHP Framework',

/*  GENERAL MESSAGES    */
        'authorisation failed' => 'You do not have sufficient privileges to view this area.',
        'authentication required' => 'You need to login to use this feature.  Fill your username and password below.',
        'session timeout' => 'Your session has timed out, please login again',
        'You have been successfully logged out' => 'You have been successfully logged out',
        'password emailed out' => 'A new password has been emailed to the address you registered with',
        'email not in system' => 'The credentials you entered could not be recognised, please try again',
        'email submitted successfully' => 'Your email has been submitted successfully',
        'There was a problem sending the email' => 'There was a problem sending the email',
        'message ID not recognised' => 'message ID not recognised',
        'Please fill in the indicated fields' => 'Please fill in all the indicated fields and try again',
        'Your alert has been sent successfully' => 'Your alert has been sent successfully',
        'Are you sure you want to delete this' => 'Are you sure you want to delete this',
        'module deregister msg' => 'An attempt will be made to drop this module\\\'s tables and data, are you sure you want to proceed?',
        'module deletion msg' => 'An attempt will be made to delete this module\\\'s files from your filesystem, are you sure you want to proceed?',
        'show uninstalled modules' => 'show uninstalled modules',
        'Below is a list' => 'Below is a list of modules registered in the \'module\' table.  Some modules may be present in
        your [install-dir]/seagull/modules directory, but will not show up in the list unless
        you tick the box below.',

/*  MODULE MGR */
        'Module' => 'Module',
        'Module list' => 'Module list',
        'Active' => 'Active',
        'install' => 'install',
        'uninstall' => 'uninstall',
        'deregister' => 'deregister',
        'remove' => 'remove',
        'module successfully updated' => 'Module info successfully updated',
        'module successfully removed' => 'Module successfully removed',
        'The name of the module must be the exact name of the folder containing files, beware of case sensitivity' => 'The name of the module must be the exact name of the folder containing files, beware of case sensitivity',
        'Here you can write what you want' => 'Here you can write what you want',
        'Simply provide an icon' => 'Simply provide an icon named "module_$moduleName.gif" in "www/themes/default_admin/images/16"',

/*  COMMENT MGR */
        'Are you sure you want to report that this comment IS spam?' => 'Are you sure you want to report that this comment IS spam?',
        'Are you sure you want to report that this comment IS NOT spam?' => 'Are you sure you want to report that this comment IS NOT spam?',
        'Are you sure you want to approve the comment?' => 'Are you sure you want to approve the comment?',
        'comments must be approved' => 'Note: Comments must be approved before being displayed.',

/*  NEWSLETTER BLOCK */
        'E-mail' => 'E-mail',
        'Lists' => 'Lists',
        'Subscribe' => 'Subscribe',
        'Unsubscribe' => 'Unsubscribe',
        'Send' => 'Send',

/*  VARIOUS */
        'Editor type' => 'WYSIWYG editor type',
        'user' => 'user',
        'Username' => 'Username',
        'Action' => 'Action',
        'Select' => 'Select',
        'delete' => 'delete',
        'delete selected' => 'delete selected',
        'Edit' => 'Edit',
        'View' => 'View',
        'move up' => 'move up',
        'move down' => 'move down',
        'finished' => 'finished',
        'back to top' => 'back to top',
        'currently_logged_on_as' => 'user',
        'guest' => 'guest',
        'login' => 'login',
        'logout' => 'logout',
        'session started at' => 'session started at',
        'logged in at' => 'logged in at',
        'displaying results' => 'displaying results',
        'to' => 'to',
        'from a total of' => 'from a total of',
        'back' => 'back',
        'next' => 'next',
        'finish' => 'finish',
        'yes' => 'yes',
        'no' => 'no',
        'Send it' => 'Send it',
        'Submit' => 'Submit',
        'Cancel' => 'Cancel',
        'Reset' => 'Reset',
        'reset' => 'reset',
        'Save' => 'Save',
        'add' => 'add',
        'edit' => 'edit',
        'move' => 'move',
        'Manage' => 'Manage',
        'Title'  => 'Title',
        'Status' => 'Status',
        'ID' => 'ID',
        'Name' => 'Name',
        'check to activate' => 'check to activate',
        'Password' => 'Password',
        'Login' => 'Login',
        'Forgot Password' => 'Forgot Your Password',
        'Not Registered' => 'Not Registered?',
        'Email' => 'Email',

/* Bug Reporter */
        'Bug Report' => 'Bug Report',
        'First Name' => 'First Name',
        'Last Name' => 'Last Name',
        'Severity of bug' => 'Severity of bug',
        'Comment' => 'Comment',
        'Your environment' => 'Your environment',
        'You must fill in your description' => 'You must fill in your description',
        'You must fill in your comment' => 'You must fill in your comment',
        'Your email is not correctly formatted' => 'Your email is not correctly formatted',
        'You must enter your email' => 'You must enter your email',

// Status
        'Enabled' => 'Enabled',
        'disable' => 'disable',
        'Disabled' => 'Disabled',
        'You must select an element to delete' => 'You must select an element to delete',
        'no results found' => 'no results found',
        'You have been banned' => 'You have been banned from this site. Contact the administrator for more information',
        'Invalid POST source' => 'The form appears to have been posted from an unauthorised source',
        'You are here' => 'You are here',
        'whats this?' => 'what\'s this?',
        'denotes required field' => 'denotes required field',

/*  Date and Time  */
/*  'at time' used at Output:showDateSelector  */
        'at time' => 'at',

        'aMonths' => array(
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ),
/*
  Author: Michael willemot <michael@sotto.be>
*/
        'Return to browse' => 'Return to browse',
        'ModuleManager Mgr' => 'ModuleManager Mgr',
        'Add' => 'Add',
        'Delete' => 'Delete',
        'With selected module(s)' => 'With selected module(s)', //table footer
        'Add a module' => 'Add a module',
        'Module successfully registered.' => 'Module successfully  registered',
        'Module(s) successfully removed.' => 'Module(s) successfully removed.',
        'Configurable' => 'Configurable',
        'Description' => 'Description',
        'Admin URI' => 'Admin URI',
        'Icon' => 'Icon',

        // validation
        'Please, specify a name' => 'Please, specify a name',
        'Please, specify a title' => 'Please, specify a title',
        'Please, specify a description' => 'Please, specify a description',
        'Please, specify the url to link to' => 'Please, specify the url to link to',
        'Please, specify the name of the icon-file' => 'Please, specify the name of the icon-file',

        //  errors
        'you do not have perms' => 'You do not have the required perms to perform this action',
        'you are not allowed to access this data' => 'You do not have the required perms to interact with this data',
        'this element has been deleted' => 'This element has been deleted',

/*

ConfigMgr
Author: Rafael Ferreira Silva <rafael@webphp.com.br>

*/

        'Please use the following form to edit your config file'=>'Please use the following form to edit your config file',
        'General Site Options'=>'General Site Options',
        'Base URL'=>'Base URL',
        'Session max lifetime (secs)'=>'Session max lifetime (secs)',
        'Site name'=>'Site name',
        'Show logo'=>'Show logo',
        'Keywords'=>'Keywords',
        'Gzip compression'=>'Gzip compression',
        'Output buffering'=>'Output buffering',
        'Enable IP banning'=>'Enable IP banning',
        'Enable Tidy html cleaning'=>'Enable Tidy html cleaning',
        'Session handler'=>'Session handler',
        'Extended Session' => 'Extended Session',
        'Enforce Single User' => 'Enforce Single User',
        'You are allowed to connect from one computer at a time, other sessions were terminated!' => 'You are allowed to connect from one computer at a time, other sessions were terminated!',
        'You have multiple sessions on this site!' => 'You have multiple sessions on this site!',
        'Enables extended session API when using database sessions. This allows the site to enforce one session per user.' => 'Enables extended session API when using database sessions. This allows the site to enforce one session per user.',
        'Enforces one session per user on this site (requires database session handling, and extended session to be on).' => 'Enforces one session per user on this site (requires database session handling, and extended session to be on).',
        'Guests' => 'Guests',
        'Members' => 'Members',
        'Total' => 'Total',
        'Enable Blocks'=>'Enable blocks',
        'Default article view type'=>'Default article view type',
        'Front controller script name'=>'Front controller script name',
        'Default module'=>'Default module',
        'Default manager'=>'Default manager',
        'Default master template'=>'Default master template',
        'This is the master template that will be loaded'=>'This is the master template that will be loaded',
        'Navigation Options'=>'Navigation Options',
        'Enable Navigation'=>'Enable Navigation',
        'Navigation driver'=>'Navigation driver',
        'Navigation Html renderer'=>'Navigation Html renderer',
        'Navigation menu stylesheet'=>'Navigation menu stylesheet',
        'Debugging Options'=>'Debugging Options',
        'Enable authorisation'=>'Enable authorisation',
        'Enable custom error handler'=>'Enable custom error handler',
        'Enable debug session'=>'Enable debug session',
        'Enable debug block'=>'Enable debug block - [USE WITH CAUTION!]',
        'Your database can be dropped if this block is enabled'=>'Your database can be dropped if this block is enabled, use for development purposes only',
        'Production website'=>'Production website',
        'Show backtrace'=>'Show backtrace',
        'Enable Profiling'=>'Enable Profiling',
        'Email admin threshold'=>'Email admin threshold',
        'Mark words which were not translated' => 'Mark words which were not translated',
        'Caching Options'=>'Caching Options',
        'Enable global caching'=>'Enable global caching',
        'Enable library caching' => 'Enable library caching',
        'Cache lifetime (secs)'=>'Cache lifetime (secs)',
        'Cleaning factor' => 'Cleaning factor',
        'Cleaning factor tip' => '0 - automatic cache cleaning, 1 - systematic cache cleaning, x (integer) > 1 - automatic cleaning randomly 1 times on x cache write',
        'Read control' => 'Read control',
        'Read control tip' => 'If enabled, a control key is embeded in cache file and this key is compared with the one calculated after the reading',
        'Write control' => 'Write control',
        'Write control tip' => 'Enable write control will lightly slow the cache writing but not the cache reading. Write control can detect some corrupt cache files but maybe it\'s not a perfect control',
        'Database Options'=>'Database Options',
        'Type'=>'Type',
        'MySQL Cluster' => 'MySQL Cluster',
        'Only future table creation will be affected, manually edit existing tables' => 'Only future table creation will be affected, manually edit existing tables',
        'Host'=>'Host',
        'Port'=>'Port',
        'Protocol'=>'Protocol',
        'Socket'=>'Socket',
        'DB username'=>'DB username',
        'DB password'=>'DB password',
        'DB name'=>'DB name',
        'Table prefix' => 'Table prefix',
        'This is used to prefix all tables in database, change with caution' => 'This is used to prefix all tables in database, change with caution',
        'Only letters and digits are allowed, first symbol must be a letter, last symbol can be an underscore' => 'Only letters and digits are allowed, first symbol must be a letter, last symbol can be an underscore',
        'Post-connection query'=>'Post-connection query',
        'Database Table Mappings'=>'Database Table Mappings',
        'Logging options'=>'Logging options',
        'Enable logs'=>'Enable logs',
        'Log name'=>'Log name',
        'Priority'=>'Priority',
        'Identifier'=>'Identifier',
        'Target username'=>'Target username',
        'Target password'=>'Target password',
        'Email options'=>'Email options',
        'Admin contact'=>'Admin contact',
        'Support contact'=>'Support contact',
        'Info contact'=>'Info contact',
        'Popup window options'=>'Popup window options',
        'Default popup window height'=>'Default popup window height',
        'Default popup window width'=>'Default popup window width',
        'Cookie options'=>'Cookie options',
        'Path'=>'Path',
        'Domain'=>'Domain',
        'Secure'=>'Secure',
        'Censorship'=>'Censorship',
        'Mode'=>'Mode',
        'Replace word with'=>'Replace word with',
        'Disallowed word'=>'Disallowed word',
        'P3P privacy policy'=>'P3P privacy policy',
        'Policies'=>'Policies',
        'Policy location'=>'Policy location',
        'Compact policy'=>'Compact policy',
        'Zero means until the browser is closed'=>'Zero means \'until the browser is closed\'',
        'If path to image is specified, image will be shown; if left blank, Site name from above will appear as text'=>'If path to image is specified, image will be shown; if left blank, \'Site name\' from above will appear as text',
        'Handy if you dont have access to Apache configuration'=>'Handy if you don\'t have access to Apache configuration',
        'This way no content items are really deleting from DB, just marked as deleted'=>'This way no content items are really deleting from DB, just marked as deleted',
        'Requires the tidy extension to be installed'=>'Requires the tidy extension to be installed',
        'Use the database session handler if youre running a load-balanced environment'=>'Use the database session handler if you\'re running a load-balanced environment',
        'You can turn the blocks off globally'=>'You can turn the blocks off globally',
        'This options allows you to change the default type of article displayed. Default Article View Type: Html Articles (2)'=>'This options allows you to change the default type of article displayed. Default Article View Type: Html Articles (2)',
        'The name of your Seagull index file'=>'The name of your Seagull index file',
        'Currently supported editors are xinha, fck and htmlarea, and you must have the relevant libs in your www dir' => 'Currently supported editors are xinha, fck and htmlarea, and you must have the relevant libs in your www dir',
        'This is the module that will be loaded if none are specified, ie, when you call index.php'=>'This is the module that will be loaded if none are specified, ie, when you call index.php',
        'This is the manager class that will be loaded if none are specified'=>'This is the manager class that will be loaded if none are specified - use the shortname, ie use "faq" and not "FaqMgr"',
        'Disable navigation altogether with this switch'=>'Disable navigation altogether with this switch',
        'Use this option to choose from various menu types - currently only 1 provided'=>'Use this option to choose from various menu types - currently only 1 provided',
        'Defines the appearance of the navigation menu. Preview and make additional changes in the navigation module manager'=>'Defines the appearance of the navigation menu. Preview and make additional changes in the navigation module manager',
        'Debugging easier when this is disabled'=>'Debugging easier when this is disabled',
        'Customise the way errors are handled'=>'Customise the way errors are handled',
        'If your IP appears in the TRUSTED_IPS array, you will be able to view system errors on screen even in production mode (see below)'=>'If your IP appears in the TRUSTED_IPS array, you will be able to view system errors on screen even in production mode (see below)',
        'Setting this to true will disable all screen-based error messages'=>'Setting this to true will disable all screen-based error messages',
        'Requires to Xdebug extension to be installed'=>'Requires to Xdebug extension to be installed',
        'Errors must be >= this level before they are emailed to the site admin'=>'Errors must be >= this level before they are emailed to the site admin',
        'It is recommended to disable this while developing'=>'It is recommended to disable this while developing',
        'Default is 24 hours'=>'Default is 24 hours',
        'Make sure you load the relevant schema'=>'Make sure you load the relevant schema - "mysql_SGL" maintains all sequences in a single table (less clutter) whereas "mysql" uses one table per sequence giving twice as many tables (better for performance)',
        'It is recommended to disable logging if you are running < PHP 4.3.x'=>'It is recommended to disable logging if you are running < PHP 4.3.x',
        'If sql is used, use log_table as the log table name below'=>'If \'sql\' is used, use \'log_table\' as the log table name below',
        'Use an absolute path or one relative to the Seagull root dir'=>'Use an absolute path or one relative to the Seagull root dir',
        'Error messages get sent here'=>'Error messages get sent here',
        'Contact us enquiries get sent here'=>'\'Contact us\' enquiries get sent here',
        'This will be your session identifier'=>'This will be your session identifier',
        'Disallowed words'=>'Disallowed words',
        'Enable Safe deleting'=>'Enable Safe deleting',
        'Default params' => 'Default params',
        'Use these params to specify, eg, a static article for your homepage' => 'Use these params to specify, eg, a static article for your homepage',
        'file'=>'file',
        'database'=>'database',
        'never' => 'never',
        'Show debug reporting link' => 'Show debug reporting link',
        'Send feedback to project for bugs' => 'Send feedback to project for bugs',
        'Words which system was unable to translate will be enclosed in "> <" marks' => 'Words which system was unable to translate will be enclosed in "> <" marks',
        'Output URL handler' => 'Output URL handler',
        'Input URL handlers' => 'Input URL handlers',
        'Define the URL handlers that will be run on incoming requests' => 'Define the URL handlers that will be run on incoming requests',
        'What format would you like your output URLs, Seagull Search Engine Friendly is the default' => 'What format would you like your output URLs, Seagull Search Engine Friendly is the default',
        'The classic URL handler has not been implemented yet' => 'The classic URL handler has not been implemented yet',
        'Template Engine' => 'Template engine',
        'Seagull allows you to use the template engine of your choice' => 'Seagull allows you to use the template engine of your choice',
        'The Smarty template hooks have not been implemented yet' => 'The Smarty template hooks have not been implemented yet',
        'This query is used to set the default character set for the current connection (MySQL 4.1 or higher). For example: SET NAMES utf8' => 'This query is used to set the default character set for the current connection (MySQL 4.1 or higher). For example: SET NAMES utf8',
        'Global Javascript Files' => 'Global javascript files',
        'Global Javascript OnReadyDOM' => 'Global javascript OnReadyDOM',
        'Global Javascript Onload' => 'Global javascript Onload',
        'Global Javascript OnUnload' => 'Global javascript OnUnload',
        'globalJavascriptFiles' => 'If you want a Javascript file included on every page of your site, put it here (separate with ";" if several files)',
        'globalJavascriptOnReadyDom' => 'The Javascript expression you put here will be called as soon as the DOM is ready, this happens before the onload event',
        'globalJavascriptOnload' => 'If you want a Javascript onload expression called on every page of your site, put it here',
        'globalJavascriptOnUnload' => 'If you want a Javascript onunload expression called on every page of your site, put it here',
        'Custom Config File' => 'Custom config file',
        'Custom output class' => 'Custom output class',

/*
 ConfigMgr: MTA options
*/
        'MTA options' => 'MTA options',
        'Backend' => 'Backend',
        'PEAR::Mail backend' => 'PEAR::Mail backend',
        'Sendmail path' => 'Sendmail path',
        'Mandatory if you use Sendmail as Backend' => 'Mandatory if you use \'Sendmail\' as Backend',
        'Sendmail arguments' => 'Sendmail arguments',
        'Optional if you use Sendmail as Backend' => 'Optional if you use \'Sendmail\' as Backend',
        'SMTP host' => 'SMTP host',
        'Optional if you use SMTP as Backend. Default: localhost' => 'Optional if you use \'SMTP\' as Backend. Default: localhost',
        'SMTP port' => 'SMTP port',
        'Optional if you use SMTP as Backend. Default: 25' => 'Optional if you use \'SMTP\' as Backend. Default: 25',
        'Use SMTP authentication' => 'Use SMTP authentication',
        'SMTP username' => 'SMTP username',
        'SMTP password' => 'SMTP password',
        'Mandatory if you use SMTP as Backend and SMTP authentication is enabled' => 'Mandatory if you use \'SMTP\' as Backend and \'SMTP authentication\' is enabled',
        'If users have cookies disabled, this will allow them to use sessions with Seagull' => 'If users have cookies disabled, this will allow them to use sessions with Seagull',
        'Allow Session in URL' => 'Allow Session in URL',
        'Check for Latest Version' => 'Check for Latest Version',
        'Check Now' => 'Check Now',
        'Your current version is up to date' => 'Your current version is up to date',
        'remote interface problem' => 'There was a problem querying the remote interface',
    );

$defaultWords['Maintenance'] = 'Maintenance';
$defaultWords['Maintenance Manager'] = 'Maintenance Manager';
$defaultWords['Back to Maintenance'] = 'Back to Maintenance';
$defaultWords['Congratulations, the target translation appears to be up to date'] = 'Congratulations, the target translation appears to be up to date';
$defaultWords['translation successfully updated'] = 'translation successfully updated';
$defaultWords['There was a problem updating the translation'] = 'There was a problem updating the translation';
$defaultWords['Data Objects rebuilt successfully'] = 'Data Objects rebuilt successfully';
$defaultWords['Cache files successfully deleted'] = 'Cache files successfully deleted';
$defaultWords['Manage Translations'] = 'Manage Translations';
$defaultWords['Check all modules for'] = 'Check all modules for';
$defaultWords['check all modules'] = 'check all modules';
$defaultWords['update'] = 'update';
$defaultWords['Module Name'] = 'Module Name';
$defaultWords['ok'] = 'ok';
$defaultWords['no file'] = 'no file';
$defaultWords['new strings'] = 'new strings';
$defaultWords['old strings'] = 'old strings';
$defaultWords['File not writeable'] = 'File not writeable';
$defaultWords['Sequences rebuilt successfully'] = 'Sequences rebuilt successfully';
$defaultWords['Rebuild DB Sequences'] = 'Rebuild DB Sequences';
$defaultWords['Rebuild Sequences Now'] = 'Rebuild Sequences Now';
$defaultWords['validate'] = 'validate';
$defaultWords['Process'] = 'Process';
$defaultWords['Manage Caches'] = 'Manage Caches';
$defaultWords['Templates'] = 'Templates';
$defaultWords['navigation'] = 'navigation';
$defaultWords['blocks'] = 'blocks';
$defaultWords['categories'] = 'categories';
$defaultWords['permissions'] = 'permissions';
$defaultWords['Clear Selected Caches Now'] = 'Clear Selected Caches Now';
$defaultWords['Rebuild Data Objects'] = 'Rebuild Data Objects';
$defaultWords['Rebuild Dataobjects Now'] = 'Rebuild Dataobjects Now';
$defaultWords['Delete cached configs'] = 'Delete cached configuration files';
$defaultWords['Cached configs successfully deleted'] = 'Cached configuration files successfully deleted';
$defaultWords['You are editing: Module'] = 'You\'re editing: Module';
$defaultWords['You are updating: Module'] = 'You are updating: Module';
$defaultWords['Master Value'] = 'Master Value';
$defaultWords['Translated Value'] = 'Translated Value';
$defaultWords['Save Translation'] = 'Save Translation';
$defaultWords['Create a module'] = 'Create a module';
$defaultWords['Manager Name'] = 'Manager Name';
$defaultWords['Create Templates'] = 'Create Templates';
$defaultWords['Create ini file'] = 'Create ini file';
$defaultWords['Create language files'] = 'Create language files';
$defaultWords['Create Module Now'] = 'Create Module Now';
$defaultWords['Module files successfully created'] = 'Module files successfully created';
$defaultWords['The source translation has'] = 'The source translation has';
$defaultWords['elements'] = 'elements';
$defaultWords['The target translation has'] = 'The target translation has';
$defaultWords['Please add'] = 'Please add';
$defaultWords['values for the following keys which appear to be missing from the'] = 'values for the following keys which appear to be missing from the';
$defaultWords['module'] = 'module';
$defaultWords['please specify an option'] = 'please specify an option';
$defaultWords['please check at least one box'] = 'please check at least one box';
$defaultWords['please enter module name'] = 'please enter module name';
$defaultWords['please enter manager name'] = 'please enter manager name';
$defaultWords['Manager already exists - please choose another manager name'] = 'Manager already exists - please choose another manager name';
$defaultWords['Extended locale support'] = 'Extended locale support';
$defaultWords['locale support info'] = 'Enabling this feature gives you access to the extensive I18Nv2 API but at the expense of performance';
$defaultWords['Locale category'] = 'Locale category';
$defaultWords['Paths'] = 'Paths';
$defaultWords['Install Root'] = 'Install root';
$defaultWords['Web Root'] = 'Web root';
$defaultWords['With selected record(s)'] = 'With selected record(s)';
$defaultWords['config options'] = 'Config Options';
$defaultWords['action'] = 'Action';
$defaultWords['preferences'] = 'preferences';
$defaultWords['Section ID'] = 'Section ID';
$defaultWords['Manager'] = 'Manager';
$defaultWords['None'] = 'None';
$defaultWords['Please supply full nav info'] = 'Please supply full nav info';
$defaultWords['Add module'] = 'Add module';
$defaultWords['New section'] = 'New section';
$defaultWords['manage'] = 'Manage';
$defaultWords['BodyHtml'] = 'Body';
$defaultWords['Translation options'] = 'Translation options';
$defaultWords['Container'] = 'Container';
$defaultWords['Fallback Language'] = 'Fallback Language';
$defaultWords['Add Missing Translations'] = 'Add Missing Translations';
$defaultWords['General'] = 'General';
$defaultWords['Navigation'] = 'Navigation';
$defaultWords['Debug'] = 'Debug';
$defaultWords['Caching'] = 'Caching';
$defaultWords['DB'] = 'DB';
$defaultWords['Logs'] = 'Logs';
$defaultWords['MTA'] = 'MTA';
$defaultWords['Popup'] = 'Popup';
$defaultWords['Translation'] = 'Translation';
$defaultWords['Cookie'] = 'Cookie';
$defaultWords['P3P'] = 'P3P';
$defaultWords['Admin GUI Feature'] = 'Admin GUI Feature';
$defaultWords['allow backend to display in separate GUI'] = 'allow backend to display in separate GUI';
$defaultWords['Configuration'] = 'Configuration';
$defaultWords['Sort by'] = 'Sort by';
$defaultWords['Publishing'] = 'Publishing';
$defaultWords['Admin GUI theme'] = 'Admin GUI theme';
$defaultWords['before'] = 'before';
$defaultWords['after'] = 'after';
$defaultWords['is'] = 'is';
$defaultWords['between'] = 'between';
$defaultWords['active'] = 'active';
$defaultWords['inactive'] = 'inactive';
$defaultWords['page'] = 'page';
$defaultWords['Session'] = 'Session';
$defaultWords['top'] = 'top';
$defaultWords['check all'] = 'check all';
$defaultWords['uncheck all'] = 'uncheck all';
$defaultWords['Add following methods'] = 'Add following methods';
$defaultWords['Editing options'] = 'Editing options';
$defaultWords['Publish'] = 'Publish';
$defaultWords['user profile'] = 'user profile';
$defaultWords['PEAR Manager'] = 'PEAR Manager';
$defaultWords['Choose channel'] = 'Choose channel';
$defaultWords['List installed packages'] = 'List installed packages';
$defaultWords['List remote packages'] = 'List remote packages';
$defaultWords['Search package'] = 'Search package';
$defaultWords['Pear Manager Notice'] = 'Calling the full list of PEAR packages the first time can take a while as some 300+ packages get transferred via REST/XML-RPC - so please be patient, allow 30 seconds for a 512 kbps line.';
$defaultWords['Package Name'] = 'Package Name';
$defaultWords['Local'] = 'Local';
$defaultWords['Latest'] = 'Latest';
$defaultWords['Install'] = 'Install';
$defaultWords['Uninstall'] = 'Uninstall';
$defaultWords['edit'] = 'Edit';
$defaultWords['Translation Maintenance'] = 'Translation Maintenance';
$defaultWords['Coming Soon - The ability to switch between translation storage containers.'] = 'Coming Soon - The ability to switch between translation storage containers.';
$defaultWords['Language to use when the current language does not have a translation.'] = 'Language to use when the current language does not have a translation.';
$defaultWords['Add missing translations to the database.'] = 'EXPERIMENTAL - Add missing translations to the database.';
$defaultWords['the target lang file'] = 'The Target Language file';
$defaultWords['is not writeable.'] = 'is not writeable.';
$defaultWords['does not exist.'] = 'does not exist.';
$defaultWords['Please change file permissions before editing.'] = 'Please change file permissions before editing.';
$defaultWords['Please create it.'] = 'Please create it.';
$defaultWords['Default theme'] = 'Default theme';
$defaultWords['Additional Include Paths'] = 'Additional include paths';
$defaultWords['Custom filter chain'] = 'Custom filter chain';
$defaultWords['Create CRUD actions'] = 'Create CRUD Actions';
$defaultWords['Broadcast message'] = 'Broadcast message';
$defaultWords['Rebuild Seagull'] = 'Rebuild Seagull';
$defaultWords['Module Manager :: Discovered'] = 'Module Manager :: Discovered';
$defaultWords['Register this module?'] = 'Register this module?';
$defaultWords['DataObject debug level'] = 'DataObject debug level';
$defaultWords['Please choose a simple, single word'] = 'Please choose a simple, single word for your module name, it will be used in URIs.';
$defaultWords['Please give the webserver write permissions to the modules directory'] = 'Please give the webserver write permissions to the modules directory';
$defaultWords['The manager, which can be'] = 'The manager, which can be one of several per module, is the controller object, so if you want it to deliver pizzas call it PizzaMgr.';
$defaultWords['Module Directory Override'] = 'Module directory override';
$defaultWords['Upload Directory Override'] = 'Upload directory override';
$defaultWords['Submit login'] = 'Submit login';
$defaultWords['send bug report'] = 'send bug report';
$defaultWords['select all'] = 'select all';
$defaultWords['templates'] = 'templates';
$defaultWords['translations'] = 'translations';
$defaultWords['Enter Captcha'] = 'Please enter the number shown below in the relevant field';
$defaultWords['You must enter the number in this field'] = 'You must enter the number in this field';
$defaultWords['prefixes not supported'] = 'Currently the module generator only works when there are no prefixes set on the db tables';

/* --- PEAR::Pager --- */
$defaultWords['altPrev'] = 'Previous';
$defaultWords['altNext'] = 'Next';
$defaultWords['altPage'] = 'Page';
$defaultWords['prevImg'] = '&laquo; previous';
$defaultWords['nextImg'] = 'next &raquo;';

?>
