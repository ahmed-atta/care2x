<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
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
$ck_lang_buffer="ck_lang$sid";

if(isset($lang)&&$lang)
{
	if(!$HTTP_COOKIE_VARS[$ck_lang_buffer]||($lang!=$HTTP_COOKIE_VARS[$ck_lang_buffer])) 
	{
	    if(!file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_indexframe.php')) $lang='en';
	    setcookie($ck_lang_buffer);
	    setcookie($ck_lang_buffer,$lang);
		$reload_page=1;
    }
}
else
{
if(!$HTTP_COOKIE_VARS[$ck_lang_buffer]) include('/chklang.php');
	else $lang=$HTTP_COOKIE_VARS[$ck_lang_buffer];
}

/* Load the language table */
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_indexframe.php')) include($root_path.'language/'.$lang.'/lang_'.$lang.'_indexframe.php');
else include($root_path.'language/en/lang_en_indexframe.php');



if(($mask==2)&&!$nonewmask)
{
	header ("location: indexframe2.php?sid=$sid&lang=$lang&boot=$boot&cookie=$cookie");
	exit;
}


/* Establish db connection */
require_once($root_path.'include/inc_db_makelink.php');
 
$sql='SELECT * FROM care_menu_main WHERE is_visible=1 OR LD_var="LDEDP" OR LD_var="LDLogin" ORDER by sort_nr ';

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


/* Set the template name */
$template='tp_indexframe.php';
/* Load the template */
require($root_path.'include/inc_template_load.php');
?>
