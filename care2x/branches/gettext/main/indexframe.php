<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('../include/helpers/inc_environment_global.php');

/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','indexframe.php');
define('NO_CHAIN',1);

# Set here the window title
$wintitle='Menu - CARE2X';
require_once(CARE_BASE.'include/helpers/inc_front_chain_lang.php');

/**
* We check again the language variable lang. If table file not available use default (lang = "en")
*/

if(!isset($lang)||empty($lang))  include(CARE_BASE.'/include/helpers/chklang.php');

/* Load the language table */
if(file_exists(CARE_BASE.'language/'.$lang.'/lang_'.$lang.'_indexframe.php')){
	include(CARE_BASE.'language/'.$lang.'/lang_'.$lang.'_indexframe.php');
}else{
	include(CARE_BASE.'language/en/lang_en_indexframe.php');
	$lang='en'; // last desperate effort to set the language 
}

// echo $_COOKIE['ck_config']; // for debugging only


# Get the global config for language usage
require_once(CARE_BASE.'include/core/class_globalconfig.php');
$GLOBALCONFIG=array();
$gc=new GlobalConfig($GLOBALCONFIG);
$gc->getConfig('language_%');

# Load dept & ward classes
require_once(CARE_BASE.'modules/dept_admin/model/class_department.php');
require_once(CARE_BASE.'include/core/class_ward.php');
$dept=new Department();
$ward=new Ward();
