<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
// // globalize POST, GET, & COOKIE  vars
define('LANG_FILE','indexframe.php');
define(NO_CHAIN,1);

require_once($root_path.'include/inc_front_chain_lang.php');

/**
* We check again the language variable lang. If table file not available use default (lang = "en")
*/

if(!isset($lang)||empty($lang))  include($root_path.'chklang.php');

/* Load the language table */
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_indexframe.php')){
	include($root_path.'language/'.$lang.'/lang_'.$lang.'_indexframe.php');
}else{
	include($root_path.'language/en/lang_en_indexframe.php');
	$lang='en'; // last desperate effort to settle the language 
}

// echo $HTTP_COOKIE_VARS['ck_config']; // for debugging only

if(($mask==2)&&!$nonewmask)
{
	header ("location: indexframe2.php?sid=$sid&lang=$lang&boot=$boot&cookie=$cookie");
	exit;
}

 
$sql='SELECT nr,sort_nr,name,LD_var,url,is_visible FROM care_menu_main WHERE is_visible=1 OR LD_var="LDEDP" OR LD_var="LDLogin" ORDER by sort_nr ';

$result=$db->Execute($sql);
//$rows=$db->NumberOfRows($result);

//* Get the global config for language usage*/
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$GLOBALCONFIG=array();
$gc=new GlobalConfig($GLOBALCONFIG);
$gc->getConfig('language_%');

/* Prepare additional data for the gui template */
$charset=setCharSet();
$wintitle='Menu - Care 2002';
$login_name=$HTTP_COOKIE_VARS['ck_login_username'.$sid];
$login_dept=$HTTP_COOKIE_VARS['ck_thispc_dept'];

require_once($root_path.'include/inc_config_color.php'); // load color preferences

require('./gui_bridge/gui_indexframe.php');
?>
