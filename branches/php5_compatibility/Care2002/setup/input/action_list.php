<?php
/*
 *	This is the list of actions to perform during the installation of Care2x
 *
 *	Most of this is self explanatory, so just make sure it's all good and you
 *	will be fine.  Have fun!
 *
 */


// Boot out people who shouldn't be here...
if (!defined('INSTALLER_PATH')) { die('Hacking attempt detected.'); }




// Initializations
$actions = array();
$actions['list'] = array();
$actions['writable_paths'] = array();
$actions['writable_files'] = array();




/*
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










// Important and useful information:

$actions['params']['config_input']  = INSTALLER_PATH . '/input/inc_init_main.php.dist';
$actions['params']['config_output'] = APP_PATH . '/include/inc_init_main.php';







// PHP Version Limits

$actions['params']['minimum_php_version'] = '4.3';
$actions['params']['maximum_php_version'] = '5.9';



// PHP Required Extensions
$actions['extensions']['gd']       = array('required'=>true);
$actions['extensions']['calendar'] = array('required'=>true);

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


?>