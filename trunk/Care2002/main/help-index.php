<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','help.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
 // globalize POST, GET, & COOKIE  vars
if(file_exists('../help/'.$lang.'/help_'.$lang.'_index.php')) include ('../help/'.$lang.'/help_'.$lang.'_index.php');
 else  include ('../help/en/help_en_index.php');
?>
