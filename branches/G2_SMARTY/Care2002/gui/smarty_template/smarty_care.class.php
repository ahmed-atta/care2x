<?php
/**
* SETUP Smarty for modul CARE2X 
*
* SMARTY.PHP 
* 19.12.2003 Thomas Wiedmann
* Converted to smarty_care.class.php by EL 2003-12-25
* For global smarty template class
*/

#Set the default template, change this to the desired default template
$default_template='default';
# Path to the smarty care templates and classes
 $sDocRoot = $root_path.'gui/smarty_template';

# Set the template 
# First check if the user config template is available
if(isset($cfg['template_theme'])||!empty($cfg['template_theme'])){
	$templatedir=$cfg['template_theme'];
}else{
	# Else get try to get the global config template
	if(!isset($GLOBAL_CONFIG)||!is_array($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
	
	# create global config object
	if(!isset($GLOBAL_CONFIG['template_smarty'])){	
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$gc=& new GlobalConfig($GLOBAL_CONFIG);
		# Get the global template config
		$gc->getConfig('template_smarty');
	}
	
	# If the global config template is not available, use hard coded template theme
	if(!isset($GLOBAL_CONFIG['template_smarty'])||empty($GLOBAL_CONFIG['template_smarty'])){
		$templatedir=$template_theme; // use this theme if the global item is not available
	}else{
		$templatedir=$GLOBAL_CONFIG['template_smarty'];
	}
}

# Last check if the template directory does not exist, use default template (last resort)
if(!file_exists("$sDocRoot/$templatedir/.")) $templatedir=$default_template;

/**
* LOAD Smarty Library
*/
require_once ($root_path.'classes/Smarty-2.6.0/libs/Smarty.class.php');

class smarty_care extends Smarty {
 
 /**
 * Konstruktor
 *
 * TODO:  PATH_DELIMITER = "\\" or "/"
 * TODO:  Basedirectory  = ""
 */
 function smarty_care ($dirname) {
 
 	global $root_path, $templatedir, $default_template, $sDocRoot;
	
  //$sDocRoot = $_SERVER['DOCUMENT_ROOT'];
  //$sDocRoot = $sDocRoot."/modules/nursing";
 
  $this->smarty();
  
  /**
  * if (OS == Windows) then change / to \\
  */
  
/*  if (substr(PHP_OS,0,3) == 'WIN') {
    $this->template_dir = str_replace("/","\\\\",$sDocRoot.'/templates');
    $this->compile_dir = str_replace("/","\\\\",$sDocRoot.'/templates_c');  
    $this->config_dir = str_replace("/","\\\\",$sDocRoot.'/configs');  
    $this->cache_dir = str_replace("/","\\\\",$sDocRoot.'/cache');    
  } else {
    $this->template_dir = $sDocRoot.'/templates';
    $this->compile_dir = $sDocRoot.'/templates_c';  
    $this->config_dir = $sDocRoot.'/configs';  
    $this->cache_dir = $sDocRoot.'/cache';    
  }*/
  
  # Another check if the working directory is really inside the template theme. 
  # If not, use default template theme.
  if(file_exists($sDocRoot."/templates/$templatedir/$dirname/.")){
      $this->template_dir = $sDocRoot."/templates/$templatedir";
      $this->compile_dir = $sDocRoot."/templates_c/$templatedir/$dirname";  
  }else{
      $this->template_dir = $sDocRoot."/templates/$default_template";
      $this->compile_dir = $sDocRoot."/templates_c/$default_template/$dirname";  
  }
    
	$this->config_dir = $sDocRoot.'/configs';  
    $this->cache_dir = $sDocRoot.'/cache';    
  
/*
	For temporary debugging
  echo     $this->template_dir."<p>";
  echo  $this->compile_dir."<p>";  
  echo  $this->config_dir."<p>";  
  echo  $this->cache_dir."<p>";    
*/
 
  /**
  * global configs
  */
  //$Logo = $_SERVER['DOCUMENT_ROOT'];
  //$Logo = $Logo."/classes/Smarty-2.6.0/misc/smarty_icon.gif";
  $Logo = $root_path.'classes/Smarty-2.6.0/misc/smarty_icon.gif';
  
/*  if (substr(PHP_OS,0,3) == 'WIN') {
   $Logo = str_replace("/","\\\\",$Logo);
  }
*/

  //$this->assign("SmartyLogo","<a href='http://smarty.php.net/'><img src='$Logo' border='00' height='31' width='88' /></a>");
  //$this->debug = false;
  $this->debug = true;
  // $this->caching = true;

 }
 
 function Copyright(){
 	global $root_path, $lang, $pgt;
	ob_start();
	include($root_path.'include/inc_load_copyrite.php');
	$sTemp = ob_get_contents();
	ob_end_clean();
 	return $sTemp;
 }
 
}

?>
