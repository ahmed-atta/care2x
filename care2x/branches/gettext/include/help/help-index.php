<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('../helpers/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','help.php');
define('NO_CHAIN',1);

require_once('../helpers/inc_front_chain_lang.php');

if(file_exists('../help/'.$lang.'/help_'.$lang.'_index.php')) 
	include ('../help/'.$lang.'/help_'.$lang.'_index.php');
else
	include ('../help/en/help_en_index.php');
?>