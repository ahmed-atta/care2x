<?php if (!defined('INSTALLER_PATH')) { die('Hacking attempt detected.'); }
/*
 *	This is the list of actions to perform during the installation of Care2x
 *
 *	Most of this is self explanatory, so just make sure it's all good and you
 *	will be fine.  Have fun!
 *
 *
 *	THE ACTION LIST STARTS HERE
 *
 *	Put the actions in order that they need to run.  This list will be modified
 *	by the index.php installer (by merging it with whatever is in the status
 *	array.  Any item hardcoded into this list will be run each and every time
 *	the installer script is loaded.
 */


$actions['list'][] = 'check_php_version';
$actions['list'][] = 'check_extensions';
$actions['list'][] = 'check_writables';

$actions['list'][] = 'prepare_post_data';



// This should be the last action
$actions['list'][] = 'do_post_action';







// Important and useful information:

$actions['params']['config_input']  = INSTALLER_PATH . '/input/inc_init_main.php.dist';
$actions['params']['config_output'] = APP_PATH . '/include/inc_init_main.php';







// PHP Version Limits

$actions['params']['minimum_php_version'] = '4.3';
$actions['params']['maximum_php_version'] = '5.9';



// PHP Required Extensions
$actions['extensions']['gd']       = array('required'=>true);
$actions['extensions']['calendar'] = array('required'=>true);
$actions['extensions']['pcre']     = array('required'=>true);

// Be careful with your references
$actions['extensions']['mysql']    = array('required'=>'pgsql');
$actions['extensions']['pgsql']    = array('required'=>'mysql');







// Writable directories
$actions['writable_paths'][] = APP_PATH.'/cache';
$actions['writable_paths'][] = APP_PATH.'/cache/barcodes';
$actions['writable_paths'][] = APP_PATH.'/counter';
$actions['writable_paths'][] = APP_PATH.'/fotos';
$actions['writable_paths'][] = APP_PATH.'/fotos/encounter';
$actions['writable_paths'][] = APP_PATH.'/fotos/registration';
$actions['writable_paths'][] = APP_PATH.'/fotos/news';
$actions['writable_paths'][] = APP_PATH.'/logs';
$actions['writable_paths'][] = APP_PATH.'/logs/access';
$actions['writable_paths'][] = APP_PATH.'/logs/access/'.date('Y');
$actions['writable_paths'][] = APP_PATH.'/logs/access_fail';
$actions['writable_paths'][] = APP_PATH.'/logs/access_fail/'.date('Y');
$actions['writable_paths'][] = APP_PATH.'/pharma';
$actions['writable_paths'][] = APP_PATH.'/pharma/img';
$actions['writable_paths'][] = APP_PATH.'/med_depot';
$actions['writable_paths'][] = APP_PATH.'/med_depot/img';
$actions['writable_paths'][] = APP_PATH.'/radiology';
$actions['writable_paths'][] = APP_PATH.'/radiology/dicom_img';
$actions['writable_paths'][] = APP_PATH.'/gui';
$actions['writable_paths'][] = APP_PATH.'/gui/img';
$actions['writable_paths'][] = APP_PATH.'/gui/img/logos_dept';
$actions['writable_paths'][] = APP_PATH.'/gui/smarty_template/templates_c';
$actions['writable_paths'][] = APP_PATH.'/include';
$actions['writable_paths'][] = APP_PATH.'/installer';

// Writable files
$actions['writable_files'][] = APP_PATH.'/installer/install.php';
$actions['writable_files'][] = APP_PATH.'/counter/hitcount.txt';
$actions['writable_files'][] = APP_PATH.'/include/inc_init_main.php';











$actions['fields']['db_host'] = array(
	'html_label'   => 'Database Server',
	'html_name'    => 'db_host',
	'html_size'    => 32,
	'html_max'     => 64,
	'html_type'    => 'text',
	
	'default' => 'localhost',
	'type'    => 'string',
	'preg'    => '/^[a-z0-9\._]{1,64}$/iU',
	'tip'     => 'Must contain only letters, numbers, periods, or an underscore character.  Length limit is 64.',
	
	'group'   => 1
);


$actions['fields']['db_port'] = array(
	'html_label'   => 'DB Listening Port',
	'html_name'    => 'db_port',
	'html_size'    => 7,
	'html_max'     => 5,
	'html_type'    => 'text',
	
	'default' => '10061',
	'type'    => 'number',
	
	'min'     => 1,
	'max'     => 65535,
	
	'tip'     => 'A number between 1 and 65536.  Defaults to 10061.',
	
	'group'   => 1
);


$actions['fields']['db_user'] = array(
	'html_label'   => 'DB Server Username',
	'html_name'    => 'db_user',
	'html_size'    => 28,
	'html_max'     => 24,
	'html_type'    => 'text',
	
	'default' => 'root',
	'type'    => 'string',
	'preg'    => '/^[a-z0-9_]{1,24}$/iU',
	'tip'     => 'Must contain only letters, numbers, or an underscore character.  Length limit is 24.',
	
	'group'   => 1
);


$actions['fields']['db_pass'] = array(
	'html_label'   => 'DB Server Password',
	'html_name'    => 'db_pass',
	'html_size'    => 32,
	'html_max'     => 48,
	'html_type'    => 'password',
	
	'default' => '',
	'type'    => 'string',
	'preg'    => '/^(.){0,48}$/iU',
	'tip'     => 'Can contain almost any typable character.  Length limit is 48.',
	
	'group'   => 1
);


$actions['fields']['db_name'] = array(
	'html_label'   => 'Database Name',
	'html_name'    => 'db_name',
	'html_size'    => 28,
	'html_max'     => 24,
	'html_type'    => 'text',
	
	'default' => 'care2x',
	'type'    => 'string',
	'preg'    => '/^[a-z0-9_]{1,24}$/iU',
	'tip'     => 'Must contain only letters, numbers, or an underscore character.  Length limit is 24.',
	
	'group'   => 1
);



$actions['fields']['admin_user'] = array(
	'html_label'   => 'Care2x Admin Username',
	'html_name'    => 'admin_user',
	'html_size'    => 22,
	'html_max'     => 20,
	'html_type'    => 'text',
	
	'default' => 'admin',
	'type'    => 'string',
	'preg'    => '/^[a-z0-9_]{1,20}$/iU',
	'tip'     => 'Must contain only letters, numbers, or an underscore character.  Length limit is 20.',
	
	'group'   => 2
);


$actions['fields']['admin_password1'] = array(
	'html_label'   => 'Password',
	'html_name'    => 'admin_password1',
	'html_size'    => 48,
	'html_max'     => 40,
	'html_type'    => 'password',
	
	'default' => '',
	'type'    => 'string',
	'preg'    => '/^(.){0,48}$/iU',
	'tip'     => 'Must contain only letters, numbers, or an underscore character.  Length limit is 48.',
	
	'group'   => 2
);


$actions['fields']['admin_password2'] = array(
	'html_label'   => 'Confirm Password',
	'html_name'    => 'admin_password2',
	'html_size'    => 48,
	'html_max'     => 40,
	'html_type'    => 'password',
	
	'default' => '',
	'type'    => 'string',
	'preg'    => '/^(.){0,48}$/iU',
	'tip'     => 'Must contain only letters, numbers, or an underscore character.  Length limit is 48.',
	
	'group'   => 2
);






?>