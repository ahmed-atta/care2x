<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_editor_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$fileforward='editor-4plus1-read.php';

$dept_nr=$HTTP_SESSION_VARS['sess_dept_nr'];

if(($artnum)&&($mode=='save'))
{
    include($root_path.'include/inc_news_save.php');
}
?>
