<?php
/*
 * Base Installer include file 
 *
 */

error_reporting(E_ALL ^ E_NOTICE);
 



if (version_compare(PHP_VERSION, '4.3', '<'))
{
	// Very very old version of PHP.  Needs to be upgraded.
	trigger_error('Warning!  PHP version is less than 4.3, you should upgrade to at least php version 4.3', E_USER_WARNING);
	define('PHP_COMPAT', 40);
}
elseif (version_compare(PHP_VERSION, '5.0', '<'))
{
	define('PHP_COMPAT', 43);
}
elseif (version_compare(PHP_VERSION, '5.3', '<'))
{
	define('PHP_COMPAT', 50);	
}
else
{
	define('PHP_COMPAT', 53);
}




define('INSTALLER_PATH', str_replace('\\', '/', dirname(__FILE__)));
define('APP_PATH',       realpath(INSTALLER_PATH . '/..'));
define('INSTALLER_API',  true);


if (APP_PATH === false)
{
	// The only reason APP_PATH would be a literal false is if the
	// installer path could not be resolved to a literal path.  This
	// occurs if perms are bad or if base include is set too strict.
	// Either way, this situation is unrecoverable in any php version.
	
	trigger_error(INSTALLER_PATH . '/.. could not be resolved to a literal path.  This installation will fail.');	
}



require_once(INSTALLER_PATH.'/includes/InstallerConfig.php');
require_once(INSTALLER_PATH.'/includes/InstallerEngine.php');
require_once(INSTALLER_PATH.'/includes/InstallerSmarty.php');
require_once(INSTALLER_PATH.'/includes/Field.php');
require_once(INSTALLER_PATH.'/includes/TextField.php');
require_once(INSTALLER_PATH.'/includes/PasswordField.php');
require_once(INSTALLER_PATH.'/includes/SelectField.php');
require_once(INSTALLER_PATH.'/includes/SeparatorField.php');
require_once(INSTALLER_PATH.'/includes/ErrorStack.php');
require_once(INSTALLER_PATH.'/actions/BaseAction.php');
require_once(INSTALLER_PATH.'/actions/SQLAction.php');
require_once(INSTALLER_PATH.'/actions/SQLFile.php');
require_once(INSTALLER_PATH.'/actions/SQLOptions.php');
require_once(INSTALLER_PATH.'/tests/BaseTest.php');
require_once(INSTALLER_PATH.'/includes/BaseSet.php');
require_once(INSTALLER_PATH.'/includes/VersionSet.php');
require_once(INSTALLER_PATH.'/includes/Version.php');
require_once(INSTALLER_PATH.'/includes/VersionCheck.php');

class Installer{

	function Installer() {}
	
	function getTemplatePath($template_name){
		if(isset($GLOBALS['INSTALLER']['TEMPLATE_DIR'])){
			if(file_exists($GLOBALS['INSTALLER']['TEMPLATE_DIR'].'/'.$template_name)){
				return 	$GLOBALS['INSTALLER']['TEMPLATE_DIR'].'/'.$template_name;
			}
		}
		
		if(file_exists(INSTALLER_PATH.'/templates/'.$template_name)){
			return INSTALLER_PATH.'/templates/'.$template_name;
		}
		
		ErrorStack::addError("Could not find template file $template_name!", ERRORSTACK_ERROR, 'Installer');
		return $template_name;
	}	

	function getTestPath($class_name){
		if(isset($GLOBALS['INSTALLER']['TEST_DIRS']) && is_array($GLOBALS['INSTALLER']['TEST_DIRS'])){
			foreach($GLOBALS['INSTALLER']['TEST_DIRS'] as $dir){
				if(file_exists($dir.'/'.$class_name.'.php')){
					return $dir.'/'.$class_name.'.php';
				}
			}
		}
		
		if(file_exists(INSTALLER_PATH.'/tests/'.$class_name.'.php')){
			return INSTALLER_PATH.'/tests/'.$class_name.'.php';
		}
		
		ErrorStack::addError("Could not find file for Test class $class_name", ERRORSTACK_FATAL, 'Installer');
		return FALSE;
	}

	function getActionPath($class_name){
		if(isset($GLOBALS['INSTALLER']['ACTION_DIRS']) && is_array($GLOBALS['INSTALLER']['ACTION_DIRS'])){
			foreach($GLOBALS['INSTALLER']['ACTION_DIRS'] as $dir){
				if(file_exists($dir.'/'.$class_name.'.php')){
					return $dir.'/'.$class_name.'.php';
				}
			}
		}
		
		if(file_exists(INSTALLER_PATH.'/actions/'.$class_name.'.php')){
			return INSTALLER_PATH.'/actions/'.$class_name.'.php';
		}
		
		ErrorStack::addError("Could not find file for Action class $class_name", ERRORSTACK_FATAL, 'Installer');
		return FALSE;
	}
	
}

// Bootstrapping tests
// Setup PHP Version numbers
$version_components = split('\.', phpversion());
$GLOBALS['INSTALLER']['PHP_VERSION_MAJOR'] = $version_components[0];
$GLOBALS['INSTALLER']['PHP_VERSION_MINOR'] = $version_components[1];
$GLOBALS['INSTALLER']['PHP_VERSION_REMAINING'] = implode('.', array_splice($version_components, 2));

// A basic version check we need at least PHP 4.2 to run
$ver = $GLOBALS['INSTALLER']['PHP_VERSION_MAJOR'].'.'.$GLOBALS['INSTALLER']['PHP_VERSION_MINOR'];
if (version_compare($ver, '4.2', '<')) {
	print("Installer Error: PHP version 4.2 or greater is required to run the installer!");
	die();	
}

$GLOBALS['INSTALLER']['CONFIG_FILE'] = INSTALLER_PATH.'/config.php'; 
if(!file_exists($GLOBALS['INSTALLER']['CONFIG_FILE'])){
	print("Installer Error: Cound not find config file at ".$GLOBALS['INSTALLER']['CONFIG_FILE']);
	die();	
}

$GLOBALS['INSTALLER']['INSTALLER_CONFIG'] =& new InstallerConfig($GLOBALS['INSTALLER']['CONFIG_FILE']);
if($GLOBALS['INSTALLER']['INSTALLER_CONFIG']->parse() === FALSE){
	print("Installer Error: Error parsing config file {$GLOBALS['INSTALLER']['CONFIG_FILE']}<BR>\n");
	print($GLOBALS['INSTALLER']['INSTALLER_CONFIG']->getErrorsHTML());
	die();
}

// No timeout
set_time_limit(0);

//TODO Detect if session is already started, if so display error 
session_start();
if(isset($_REQUEST['restart_installer']) || !isset($_SESSION['INSTALLER']['ENGINE']) || !is_a($_SESSION['INSTALLER']['ENGINE'], 'InstallerEngine')){
	$_SESSION['INSTALLER']['ENGINE'] =& new InstallerEngine($GLOBALS['INSTALLER']['INSTALLER_CONFIG']); 	
}
$GLOBALS['INSTALLER']['ENGINE'] =& $_SESSION['INSTALLER']['ENGINE'];

if(isset($_REQUEST['previous_step'])){
	$GLOBALS['INSTALLER']['ENGINE']->previousStep();
}elseif(isset($_REQUEST['next_step'])){
	$GLOBALS['INSTALLER']['ENGINE']->nextStep();
}
?>
